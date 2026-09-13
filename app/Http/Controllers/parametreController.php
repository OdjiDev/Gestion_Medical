<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;

class parametreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $parametre = Parametre::first();
       $tauxAmo = $parametre->amo ?? 0;

    return view('parametre.parametre', compact('parametre','tauxAmo'));
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
         $validated = $request->validate([
        'amo' => 'required|numeric|min:0|max:100'
    ]);

    Parametre::updateOrCreate(
        ['id' => 1],
        $validated
    );
  return back()->with('success', 'Paramètre AMO enregistré avec succès');
    
        //
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
