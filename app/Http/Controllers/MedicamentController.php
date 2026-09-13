<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use App\Models\fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Events\Validated;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
         $q = $request->q;

             $medicaments = Medicament::where('nom', 'like', "%$q%")
             ->paginate(10);

             return view('partials.medicament',compact('medicaments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $fournisseurs = Fournisseur::all(); 
        return view('partials.ajouter_m',compact('fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
        //
    $validated = $request->validate([
    'nom' => 'required|string|min:3',
    'description' => 'required|string',
    'quantite' => 'integer|min:0',
    'quantite_alerte' => 'required|integer|min:0',
    'prix_achat' => 'required|numeric|min:0',
    'prix_vente' => 'required|numeric|min:0',
    'date_expiration' => 'required|date',
    'amo'=>'required',
]);

$prixAchat = $validated['prix_achat'];
$prixVente = $validated['prix_vente'];

if ($prixAchat >= $prixVente) {
    return back()->withErrors([
        'prix_vente' => 'Le prix de vente doit être supérieur au prix d’achat.'
    ])
        ->withInput();
}
        $validated['quantite'] = 0;
//dd($request);
    Medicament::create($validated);

            return redirect('/medicament')->with('success', 'Medicament ajouter avec succès');


    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    //     $medicaments = Medicament::with('fournisseur')->paginate(10);
    //    return view('partials.stock_m',compact('medicaments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicament $medicament)
    {
        //
        $fournisseurs = Fournisseur::all();
         return view('partials.edit_m', compact('medicament' ,'fournisseurs' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, medicament $medicament)
    {
        //
        //dd($request);
          $validated = $request->validate([
            'nom' =>'required|string|min:3',
            'description' =>'required|string',
           'quantite' => 'integer|min:0',
           'quantite_alerte' => 'required|integer|min:0',
            'prix_achat' =>'required|string',
            'prix_vente' =>'required|string',
            'date_expiration' =>'required|string',
            'amo'=>'required',
            
        ]);
        
$prixAchat = $validated['prix_achat'];
$prixVente = $validated['prix_vente'];

if ($prixAchat > $prixVente) {
    return back()->withErrors([
        'prix_vente' => 'Le prix de vente doit être supérieur au prix d’achat.'
    ]);
}
// dd($validated);
    $medicament->update($validated);

            return redirect('/medicament')->with('success', 'Medicament modifier avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(medicament $medicament)
    {
        //
          $medicament->delete();
        return redirect('/medicament')->with('delete','Medicament supprimer');

    }


   

public function search(Request $request)
{
    $query = $request->get('q');

    $medicaments = Medicament::where('nom', 'LIKE', "%{$query}%")
        ->limit(10)
        ->get(['id', 'nom','prix_vente','prix_achat','amo']);

    return response()->json($medicaments);
}

public function addStock(Request $request, $id)
{
    $medicament = Medicament::findOrFail($id);

    $qte = $request->quantite;

    if ($request->type == "add") {

        $medicament->quantite += $qte;

    } else if ($request->type == "remove") {

        $medicament->quantite -= $qte;

        if ($medicament->quantite < 0) {
             DB::rollBack();
            return back()->with('error', 'Stock insuffisant');

        }

    }

    $medicament->save();

    return redirect('/medicament')->with('success', 'Stock ajouté avec succès');
}

public function alertes(Medicament $medicaments)
{
    $medicaments = Medicament::whereColumn('quantite', '<=', 'quantite_alerte')->get();

    return view('partials.alertes', compact('medicaments'));
}

}


