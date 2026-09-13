<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class service_medicale extends Model
{
    //

    protected $table = 'service_medicales';
    protected $fillable =[
        'type_service',
        'tarif',
    ];

    //un examen appartien a 0 ou plusieur service
    public function examens()
{
    return $this->hasMany(Examen::class);
}

    //un service appartient à un accueil
    // public function accueil()
    // {
    //     return $this->belongsTo(Accueil::class);
    // }
    }
