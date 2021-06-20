<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{

    protected $fillable = [
        'per_name','per_matricule', 'per_naiss', 'per_poste', 'per_sexe',
         'per_statut', 'per_classe', 'is_personnel','pro_id',
    ];

    public function lunettes() {
        return $this->hasMany(Lunette::class, 'per_id');
    }

    public function ordonnances() {
        return $this->hasMany(Ordonnance::class, 'per_id');
    }
}
