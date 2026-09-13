<?php

namespace App\Http\Controllers;

use App\Models\vente_m;
use Illuminate\Http\Request;
use App\Models\Parametre;
use App\Models\Medicament;



class vente_mController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $vente = vente_m::orderBy('id', 'desc')->paginate(10);

    return view('partials.vente_m', compact('vente'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parametre = Parametre::first();
        return view('partials.ajout_vente',compact('parametre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vte = vente_m::with('items.medicament')->findOrFail($id);
       

    return view('partials.print_vent', compact('vte'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vente_m $vente_m)
    {
        //
        $vente_m->delete();
        return redirect('/vente_m')->with('delete','Vente supprimer');
    }
}
