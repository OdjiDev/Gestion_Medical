<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'email',
        'password',
        'sexe',
        'adress',
        'telephone',
        'n_dossier',
    ];
//
//     public function users()
// {
//     return $this->belongsTo(User::class, 'user_id');
// }

 /**
     * Un patient peut avoir plusieurs rendez-vous
     */
    public function rendezVous(): HasMany
    {
        return $this->hasMany(Rendez_Vous::class);
    }

    /*
    chaque patient est accuellir par l'accueill
    */

   public function demandes()
{
    return $this->hasMany(Demande::class);
}

    //un patient peut faire plusieur paiement 
     public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function documents()
{
    return $this->hasMany(DocumentPatient::class);
}
    


}
