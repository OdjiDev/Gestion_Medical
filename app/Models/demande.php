<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    //
    protected $fillable = [
        
        'patient_id',
        
        'service_id',
        'date',
        'contenu',
        'motif',
        'status',
    ];

  
//l'accueil peut avoir plusieur paiement

public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    //un accueil possède plusieurs services médicales
public function service_medicale()
{
    return $this->hasMany(Service_medicale::class);
}

public function patient()
{
    return $this->belongsTo(Patient::class);
}
public function service()
{
    return $this->belongsTo(Service_medicale::class, 'service_id');
}

}
