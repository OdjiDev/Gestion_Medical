<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentPatient extends Model
{
    protected $table = 'documents_patients';

    protected $fillable = [
        'patient_id',
        'demande_id ',
        'nom',
        'fichier',
        'date_envoi',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}