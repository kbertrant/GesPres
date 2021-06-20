<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Med_pres extends Model
{
    protected $fillable = [
        'ord_id','med_id', 'mp_condition', 'mp_prise',
         'mp_type', 'mp_fois', 'mp_jour', 'mp_periode',
         'mp_duree','mp_price','mp_qte','mp_total','mp_posologie',
    ];

    public function ordonnance() {
        return $this->belongsTo(Ordonnance::class);
    }

    public function medicament() {
        return $this->belongsTo(Medicament::class);
    }
}
