<?php

namespace App\Http\Controllers;
use App\Models\fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fournisseurs = fournisseur::paginate(10);
        return view('partials.fournisseur', compact('fournisseurs'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('partials.ajout_fors');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, fournisseur $fournisseur)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:100',
        'email' => 'nullable|email|max:255',
        'telephone' => 'required|string|size:8|regex:/^[0-9]+$/',
        'adresse' => 'required|string',
    ]);
    //dd($validated);

    fournisseur::create($validated);

    return redirect('/fournisseur')->with('success', 'Fournisseur créé avec succès');
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
    public function edit(fournisseur $fournisseur)
    {
        //
        return view('partials.edit_fours',compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fournisseur $fournisseur)
    {
        //
        $validated = $request->validate([
        'nom' => 'required|string|max:100',
        'email' => 'nullable|email|max:255',
        'telephone' => 'required|string|size:8|regex:/^[0-9]+$/',
        'adresse' => 'required|string',
    ]);

     $fournisseur->update($validated);

    return redirect('/fournisseur')->with('success', 'Fournisseur modifie avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fournisseur $fournisseur)
    {
        //
        $fournisseur->delete();
        return redirect('/fournisseur')->with('delete', 'Fournisseur supprimer');
    }
}
