<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{

    protected $fillable = [
        'med_name','med_price',
    ];

    public function personnel() {
        return $this->belongsTo(Personnel::class);
    }
}
