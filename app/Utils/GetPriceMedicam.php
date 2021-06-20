<?php 
namespace App\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetPriceMedicam
{
    static function getPriceMedicam($id_prod){
        
        $query_user = "SELECT med_price
        FROM medicaments
        WHERE id =(".$id_prod.")";
        $getprice = DB::select($query_user);
        return $getprice[0]->med_price;
    }

}