<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paiement extends Model
{
    //
    protected $fillable = [
        'montant',
        'type_paiement',
        'date',
    ];
//un paiement appartient à un accueil
    public function accueil()
    {
        return $this->belongsTo(Accueil::class);
    }
//un paiement appartient à un patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
}
