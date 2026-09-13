<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rendez_vous extends Model
{
    //

    protected $table = 'rendez_vous';
    protected $fillable =[
        'patient_id',
        'user_id',
        'objectif',
        'contenu',
    ];
   /**
     * Chaque rendez-vous appartient à un patient
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function service()
{
    return $this->belongsTo(Service_medicale::class, 'service_id');
}
}
