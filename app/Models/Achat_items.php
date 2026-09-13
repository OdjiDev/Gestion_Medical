<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat_items extends Model
{
    //
        protected $fillable = [
        'achat_id',
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
