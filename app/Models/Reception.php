<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
       protected $fillable = [
        'nom',
        'prenom',
        'amo',
        'service_id',
        'telephone',
        'status',
        'tarif',
        'montantPayer',
        'montantAmo',
    ];
public function service()
    {
        return $this->belongsTo(service_medicale::class, 'service_id');
    }
//     public function service()
// {
//     return $this->belongsTo(service_medicale::class, 'service_id');
// }

}