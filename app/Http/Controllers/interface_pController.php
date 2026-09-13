<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service_medicale;
use App\Models\patient;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;

class interface_pController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('patient.interface');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patient = auth('patient')->user();
        $motifs = ['consultation', 'Vaccination', ' consultation', ' hospitalisation', 'autre'];
        $services = service_medicale::all();
        return view('patient.ajouter_demande', compact('services', 'motifs', 'patient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'service_id' => 'required|exists:service_medicales,id',
            'contenu' => 'nullable',
            'date' => 'required',
            'motif' => 'required|in:consultation,Vaccination,hospitalisation,autre',
        ]);

        Demande::create([
            'patient_id' =>  auth('patient')->id(),
            'service_id' => $request->service_id,
            'contenu' => $request->contenu,
            'date' => $request->date,
            'status' => 'en_attente',
            'motif' => $request->motif,
        ]);
        // dd($request);
        return redirect('/patient/interface')
            ->with('success', 'Enregistré avec succès');
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

        $demandes = Demande::where('status', 'en_attente')
            ->where('patient_id', $patient->id)
            ->get();
        // dd($demandes);

        return view('patient.mes_demande', compact('demandes'));
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
