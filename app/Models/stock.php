<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    //
    protected $fillable =[
        'quantite',
        'type_mouvement',
    ];
    public function medicaments()
{
    return $this->belongsToMany(Medicament::class);
}
}   