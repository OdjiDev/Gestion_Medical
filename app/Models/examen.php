<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class examen extends Model
{
    //
    protected $fillable =[
        'service_id',
        'resultat',
        'date',
    ];
    //un service medicale appartien a 0 ou plusieur
   public function serviceMedicale()
{
    return $this->belongsTo(ServiceMedicale::class);
}

}
