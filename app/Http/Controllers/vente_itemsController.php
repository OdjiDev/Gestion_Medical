<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\vente_items;
use App\Models\vente_m;
use App\Models\Medicament;
use App\Models\Parametre;


class vente_itemsController extends Controller
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
    $request->validate([
        'medicament_id' => 'required|array',
        'quantite' => 'required|array',
        'prix' => 'array',
        'amo' => 'numeric',
        'montant_amo' => 'nullable|numeric',
        'montant_payer' => 'nullable|numeric',
    ]);
//  dd($request);
    DB::beginTransaction();

    try {
        
        $count = count($request->medicament_id);

        //  Vérifier TOUT le stock avant
        for ($i = 0; $i < $count; $i++) {

            $medicament = Medicament::findOrFail($request->medicament_id[$i]);
            $quantite = $request->quantite[$i];

            if ($medicament->quantite < $quantite) {
                DB::rollBack();
                return back()->with('error', 'Stock insuffisant ');
            }
        }

        $last = vente_m::latest('id')->first();
$numero = $last ? $last->id + 1 : 1;

$reference = 'VNT-' . now()->format('Y') . '-' . str_pad($numero, 4, '0', STR_PAD_LEFT);


        //  Créer la vente seulement si tout est OK
        $vente = vente_m::create([
    'reference'      => $reference,
    'date'           => now(),
    'total'         => 0,
    'amo'           => $request->amo ?? 0, //  AJOUT ICI
    'montant_amo'   => $request->montant_amo ?? 0,
    'montant_payer' => $request->montant_payer ?? 0,
]);

        $total = 0;

        //  Enregistrer les items
        for ($i = 0; $i < $count; $i++) {

            $quantite = $request->quantite[$i];
            $prix = $request->prix[$i];
            $montant = $quantite * $prix;

            $medicament = Medicament::findOrFail($request->medicament_id[$i]);

            // diminuer stock
            $medicament->quantite -= $quantite;
            $medicament->save();

            // enregistrer item
          vente_items::create([
    'vente_id'       => $vente->id,
    'medicament_id'  => $medicament->id,
    'quantite'       => $quantite,
    'prix'           => $prix,
    'montant'        => $montant,
]);
            $total += $montant;
        }

        // mettre à jour total
        $vente->update([
            'total' => $total
        ]);

        DB::commit();

        return redirect('/vente_m')->with('success', 'Vente effectuée');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', $e->getMessage());
    }
}
    

    

    /**
     * Display the specified resource.
     */
    public function show($id)
{
$vte = vente_m::with('items.medicament')->findOrFail($id);
    return view('partials.show_v_item', compact('vte'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
     $parametre = Parametre::first();
    $vente = vente_m::with('items.medicament')->findOrFail($id);

    return view('partials.edit_items', compact('vente','parametre'));
}

    /**
     * Update the specified resource in storage.
     */


public function update(Request $request, string $id)
{
    $request->validate([
        'medicament_id' => 'required|array',
        'quantite' => 'required|array',
        'prix' => 'required|array',

        // AMO optionnel (IMPORTANT)
        'montant_amo' => 'nullable|numeric',
        'montant_payer' => 'nullable|numeric',
        'amo' => 'nullable|integer',
    ]);
    

    DB::beginTransaction();

    try {

        $vente = vente_m::findOrFail($id);

        // =========================
        // RESTORE OLD STOCK
        // =========================
        $oldItems = vente_items::where('vente_id', $vente->id)->get();

        foreach ($oldItems as $item) {
            $medicament = Medicament::find($item->medicament_id);

            if ($medicament) {
                $medicament->quantite += $item->quantite;
                $medicament->save();
            }
        }

        // delete old items
        vente_items::where('vente_id', $vente->id)->delete();

        // =========================
        // INIT
        // =========================
        $total = 0;
        $amoEligible = 0;
        $count = count($request->medicament_id);

        // =========================
        // RECREATE ITEMS
        // =========================
        for ($i = 0; $i < $count; $i++) {

            $medicamentId = $request->medicament_id[$i];
            $quantite = (float) $request->quantite[$i];
            $prix = (float) $request->prix[$i];

            $medicament = Medicament::findOrFail($medicamentId);

            // STOCK CHECK
            if ($medicament->quantite < $quantite) {
                throw new \Exception('Stock insuffisant pour ' . $medicament->nom);
            }

            $montant = $quantite * $prix;
            $total += $montant;

            if ($medicament->amo == 1) {
                $amoEligible += $montant;
            }

            // update stock
            $medicament->quantite -= $quantite;
            $medicament->save();

            // save item
            vente_items::create([
                'vente_id' => $vente->id,
                'medicament_id' => $medicamentId,
                'quantite' => $quantite,
                'prix' => $prix,
                'montant' => $montant,
            ]);
        }

        // =========================
        // AMO CALCULATION
        // =========================
        $amoActive = (int) $request->input('amo', 0);
        $tauxAmo = (float) Parametre::first()->amo;

        $montantAmo = 0;
        $montantPayer = $total;

        if ($amoActive === 1) {
            $montantAmo = ($amoEligible * $tauxAmo) / 100;
            $montantPayer = max(0, $total - $montantAmo);
        } else {
            $montantAmo = 0;
            $montantPayer = $total;
        }

        // =========================
        // UPDATE VENTE
        // =========================
        $vente->update([
            'total' => $total,
            'date' => now(),
            'amo' => $amoActive,
            'montant_amo' => $montantAmo,
            'montant_payer' => $montantPayer,
        ]);

        DB::commit();

        return redirect('/vente_m')->with('success', 'Vente mise à jour avec succès');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
}
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(string $id)
    {
        //
    }
}


