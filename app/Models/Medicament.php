<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Medicament extends Model
{
    //
      use HasFactory;
    protected $fillable =[
        'quantite_alerte',
        'nom',
        'description',
        'prix_vente',
        'prix_achat',
        'quantite',
        'date_expiration',
        'amo',
    
    ];
    
    

}





  