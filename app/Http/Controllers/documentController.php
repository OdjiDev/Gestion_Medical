<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DocumentPatient;
use App\Models\Patient;

class DocumentController extends Controller
{
    public function send(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'nom' => 'required|string',
            'fichier' => 'required|mimes:pdf|max:5120',
        ]);

        $file = $request->file('fichier');

        $fileName = 'fiches/'.$patient->id.'_'.time().'.pdf';

        Storage::disk('public')->put(
            $fileName,
            file_get_contents($file)
        );

        DocumentPatient::create([
            'patient_id' => $patient->id,
            'nom' => $request->nom,
            'fichier' => $fileName,
            'date_envoi' => now(),
        ]);

        return back()->with('success', 'PDF envoyé avec succès ✔');
    }
}