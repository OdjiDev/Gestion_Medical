<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vente_items extends Model
{	
//	id	vente_id	medicament_id	quantite	prix	montant
    protected $fillable = [
        'vente_id',
        'medicament_id',
        'quantite',
        'prix',
        'montant',
       
        
    ];
    public function medicament()
{
    return $this->belongsTo(Medicament::class, 'medicament_id');
}
}
