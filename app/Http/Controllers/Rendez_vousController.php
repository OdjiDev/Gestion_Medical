<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Service_medicale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Rendez_vousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $demandes = Demande::with('patient')
                   
                ->orderBy('id', 'desc')
        ->paginate(10);
        $services = Service_medicale::all();

    return view('partials.rendez_vous', compact('demandes','services'));

        
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $patient = Auth::guard('patient')->user();
    
    if (!$patient) {
        abort(403, 'Aucun patient connecté');
        }
        
        $demandes = Demande::where('status', 'valide')
        ->where('patient_id', $patient->id)
        ->get();
        // dd($demandes);

    return view('patient.rdv', compact('demandes'));
        
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
