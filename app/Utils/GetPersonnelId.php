<?php 
namespace App\Utils;

use App\Personnel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetPersonnelId
{
    static function getPersonnelId($per_name){
        $per_id = Personnel::where('per_name','=',$per_name)->get();
        return $per_id[0]->id;
    }

    static function getAgentId($per_name){
        $per_id = Personnel::where('per_name','=',$per_name)->get();
        return $per_id[0]->pro_id;
    }

}