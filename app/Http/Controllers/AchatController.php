<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achat;
use App\Models\Fournisseur;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achats = achat::with('fournisseur')
            ->orderBy('id', 'desc')
            ->paginate(10);

return view('partials.achat', compact('achats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $fournisseurs = Fournisseur::all();

    return view('partials.achat_items', compact('fournisseurs'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $acht = Achat::with('items.medicament')->findOrFail($id);
    return view('partials.show_achat', compact('acht'));
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
    public function destroy(string $id)
    {
        //
    }
}
