<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Achat_items;
use App\Models\Medicament;
use App\Models\fournisseur;
use Illuminate\Http\Request;

class Achat_itemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    //dd($request);
    $request->validate([
        'fournisseur_id' => 'required',
        'medicament_id' => 'required|array',
        'quantite' => 'required|array',
        'prix' => 'required|array',
    ]);

    $last = Achat::latest('id')->first();
    $numero = $last ? $last->id + 1 : 1;

    $reference = 'ACH-' . now()->format('Y') . '-' . str_pad($numero, 4, '0', STR_PAD_LEFT);

    $achat = Achat::create([
        'fournisseur_id' => $request->fournisseur_id,
        'reference' => $reference,
        'date' => now(),
        'total' => 0
    ]);

    $total = 0;

    $count = count($request->medicament_id);

    for ($i = 0; $i < $count; $i++) {

        $quantite = $request->quantite[$i];
        $prix = $request->prix[$i];
        $montant = $quantite * $prix;

        $medicament = Medicament::findOrFail($request->medicament_id[$i]);

        // augmenter stock
        $medicament->quantite += $quantite;
        $medicament->save();

        // enregistrer item
        Achat_items::create([
            'achat_id' => $achat->id,
            'medicament_id' => $medicament->id,
            'quantite' => $quantite,
            'prix' => $prix,
            'montant' => $montant,
        ]);

        $total += $montant;
    }

    // update total
    $achat->update([
        'total' => $total
    ]);

    return redirect('/achat')->with('success', 'Achat effectué avec succès');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
     
        $achat = Achat::with('items.medicament')->findOrFail($id);
        $fournisseurs = Fournisseur::all();

    return view('partials.edit_achat', compact('achat','fournisseurs'));

        
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
  {
    //  dd($request);
    $request->validate([
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'medicament_id'  => 'required|array',
        'quantite'       => 'required|array',
        'prix'           => 'required|array',
    ]);

    $achat = Achat::with('items')->findOrFail($id);

    // Remettre le stock précédent
    foreach ($achat->items as $item) {

        $medicament = Medicament::find($item->medicament_id);

        if ($medicament) {
            $medicament->quantite -= $item->quantite;
            $medicament->save();
        }
    }

    // Supprimer les anciens détails
    Achat_items::where('achat_id', $achat->id)->delete();

    $total = 0;

    foreach ($request->medicament_id as $index => $medicamentId) {

        if (empty($medicamentId)) {
            continue;
        }

        $quantite = $request->quantite[$index];
        $prix     = $request->prix[$index];
        $montant  = $quantite * $prix;

        $medicament = Medicament::findOrFail($medicamentId);

        // Mise à jour du stock
        $medicament->quantite += $quantite;
        $medicament->save();

        Achat_items::create([
            'achat_id'      => $achat->id,
            'medicament_id' => $medicamentId,
            'quantite'      => $quantite,
            'prix'          => $prix,
            'montant'       => $montant,
        ]);

        $total += $montant;
    }

    $achat->update([
        'fournisseur_id' => $request->fournisseur_id,
        'total'          => $total,
    ]);

    return redirect('/achat')->with('success', 'Achat effectué avec succès');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
