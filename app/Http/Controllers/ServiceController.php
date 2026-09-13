<?php

namespace App\Http\Controllers;

use App\Models\service_medicale;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $service=service_medicale::paginate(10);
        return view('partials.service_medicale', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('partials.ajout_service');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'type_service' => 'required|string',
        'tarif' => 'required|integer',
        ]);

        service_medicale::create($validated);

        return redirect('/service_medicale')->with('success', 'Créé avec succès');

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
    public function edit(service_medicale $service)
    {
        //
        return view('partials.edit_service',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, service_medicale $service)
    {
        //
         $validated = $request->validate([
        'type_service' => 'required|string',
        'tarif' => 'required|integer',
        ]);
// dd($validated);
        $service->update($validated);

         return redirect('/service_medicale')->with('success', 'Modifier avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service_medicale $service)
    {
        //
        $service->delete();
        return redirect('/service_medicale')->with('delete', 'Supprimer avec succès');
    }
}
