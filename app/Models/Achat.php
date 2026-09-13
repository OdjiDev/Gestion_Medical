<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    //
    protected $fillable = [
        'date',
        'reference',
        'total',
        'fournisseur_id',
    ];


public function fournisseur()
{
    return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
}

public function items()
{
    return $this->hasMany(Achat_items::class, 'achat_id');
}

}
