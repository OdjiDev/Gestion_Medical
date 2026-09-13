<?php

namespace App\Http\Controllers;

use App\Models\Reception;
use Illuminate\Http\Request;
use App\Models\service_medicale;
use App\Models\Parametre;

use function Ramsey\Uuid\v1;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$receptions = Reception::with('service')::paginate(10);
        $receptions = Reception::with('service')
            ->orderBy('id', 'desc')
            ->paginate(10);
        //dd($receptions);
        return view('partials.reception', compact('receptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $services = service_medicale::all();
        $parametre = Parametre::first();
        return view('partials.ajout_reception', compact('services', 'parametre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'telephone' => 'nullable|string|max:20',
            'service_id' => 'required|exists:service_medicales,id',
            'amo' => 'required|boolean',
            'status' => 'nullable',
            'tarif' => 'nullable',
            'montantPayer' => 'nullable',
            'montantAmo' => 'nullable',
        ]);

          //dd($request);
        

        Reception::create($validated);


        return redirect('/reception')->with('success', 'Créé avec succès');
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
    public function edit(Reception $reception)
    {
        //
        $services = service_medicale::all();
        $parametre = Parametre::first();
        return view('partials.edit_reception', compact('reception', 'parametre','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reception $reception)
    {
        //

        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'telephone' => 'nullable|string|max:20',
            'service_id' => 'required|exists:service_medicales,id',
            'amo' => 'required|boolean',
            // 'prix' => 'required|integer',
            'status' => 'nullable',
            'tarif' => 'nullable',
            'montantPayer' => 'nullable',
            'montantAmo' => 'nullable',
            ]);
            //  dd($validated);
        $reception->update($validated);

        return redirect('/reception')->with('success', 'Modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reception $reception)
    {
        //
        $reception->delete();
        return redirect('/reception')->with('delete', 'Supprimer avec succès');
    }

    public function valide(String $id)
    {

        $reception = Reception::findOrFail($id);

        $reception->update([
            'status' => 'termine'
        ]);

        return redirect('/reception')->with('success', 'Terminer avec success');
    }
}
