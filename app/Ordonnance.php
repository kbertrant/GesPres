<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    protected $fillable = [
        'pres_id','per_id', 'cen_id', 'num_ord','prix_total',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function personnel() {
        return $this->belongsTo(Personnel::class);
    }

    public function centre() {
        return $this->belongsTo(Centre::class);
    }
}
