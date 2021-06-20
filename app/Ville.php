<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = [
        'vil_name','region',
    ];

    public function centres() {
        return $this->hasMany(Centre::class, 'vil_id');
    }
}
