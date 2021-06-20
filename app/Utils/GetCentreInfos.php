<?php 
namespace App\Utils;

use App\Centre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetCentreInfos
{
    static function getCentreName($cen_id){
        $centre_name = Centre::find($cen_id);
        return $centre_name->cen_name;
    }

}