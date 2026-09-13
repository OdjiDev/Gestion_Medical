<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fournisseur extends Model
{
    //
    protected $fillable = [
        
        'nom',
        'adresse',
        'email',
        'telephone',
    ];
    // public function medicament ()
    // {
    //     return $this->hasMany(Medicament::class);
    // }
}
