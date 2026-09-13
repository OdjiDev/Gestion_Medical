<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vente_m extends Model
{
    //total	reference	date	
 protected $table = 'ventes';
    protected $fillable = [
        'date',
        'reference',
        'total',
        'montant_payer',
        'montant_amo',
        'amo',
    ];


public function items()
{
    return $this->hasMany(vente_items::class, 'vente_id');
}
}