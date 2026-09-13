<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\demande;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $patients = Patient::paginate(10);
        $q = $request->q;

        $patients = Patient::where('nom', 'like', "%$q%")
            ->orWhere('email', 'like', "%$q%")
            ->paginate(10);
        $demandes = Demande::all();

        return view('partials.patient', compact('patients', 'demandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('partials.ajout_patient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'adress' => 'required|string',
            'telephone' => 'required|string',
            'sexe' => 'required|in:M,F',
            'n_dossier' => 'nullable|stringe',

        ]);

        $validated['password'] = bcrypt($validated['password']);
        // Génération automatique du numéro de dossier
        if (empty($validated['n_dossier'])) {
            // Exemple : "DOSS-" + timestamp + 4 chiffres aléatoires
            $validated['n_dossier'] = 'DOSS-' . time() . '-' . rand(1000, 9999);
        }
        Patient::create($validated);
        return redirect('/patient')->with('success', 'Patient créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(patient $patient)
    {

        return view('patient.interface', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
        return view('partials.edit_patient', compact('patient'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
        // dd( $request);
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'adress' => 'required|string',
            'telephone' => 'required|string',
            'sexe' => 'in:M,F',
        ]);
        // Si un mot de passe est fourni, on le hash
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            // sinon on supprime le champ pour ne pas écraser le mot de passe existant
            unset($validated['password']);
        }
        $patient->update($validated);
        return redirect('/patient')->with('success', 'Patient modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
        $patient->delete();
        return redirect('/patient')->with('delete', 'Patient suprimer avec succès');
    }
}
