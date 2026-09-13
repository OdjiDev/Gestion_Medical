<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Patient;
use App\Models\service_medicale;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Demande $demandes)
    {
        //
       $demandes = Demande::with('service')
                ->orderBy('id', 'desc')
                ->paginate(10);

         return view('partials.liste_demande',compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $motifs = ['Vaccination',' consultation',' hospitalisation','autre'];
        $services = service_medicale::all();
        return view('partials.demande',compact('services','motifs'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    //dd($request);
    $request->validate([
        'telephone' => 'required',
        'service_id' => 'required|exists:service_medicales,id',
        'contenu' => 'nullable',
        'date' => 'required',
        'motif' => 'required|in:consultation,Vaccination,hospitalisation,autre',
        'status' => 'en_attente',
    ]);
// 'patient_id',
//         'service_id',
//         'date',
//         'contenu',
    $patient = Patient::where('telephone', $request->telephone)->first();

    if (!$patient) {
        return back()->withErrors([
            'telephone' => 'Aucun patient trouvé avec ce numero'
        ]);
    }

    Demande::create([
        'patient_id' => $patient->id,
        'service_id' => $request->service_id,
        'contenu' => $request->contenu,
        'date' => $request->date,
        'status' => 'en_attente',
        'motif' => $request->motif,
    ]);

    return redirect('/liste_demande')
    ->with('success', 'Enregistré avec succès');
}  /**
     * Display the specified resource.
     */
   public function show(Demande $demande)
{
    return view('partials.show_demande', compact('demande'));
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

    public function valide(String $id)
    {
    
    $demande = Demande::findOrFail($id);

    $demande->update([
        'status' => 'valide'
    ]);

    return redirect('/liste_demande')->with('success', 'Demande validée');


    

        
    }
    public function rejete(String $id)
    {
        $demande = Demande::findOrFail($id);

    $demande->update([
        'status' => 'rejete'
    ]);

        return redirect('/liste_demande')->with('delete', 'Demande rejetée');

   

    }
}
