<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    protected $fillable = [
        'cen_name', 'cen_numero', 'vil_id', 'contact',
    ];

    
}
