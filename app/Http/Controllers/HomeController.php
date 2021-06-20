<?php
use App\User;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nb_person = DB::table('personnels')->count('personnels.id');
        $all_ordos = DB::table('ordonnances')->sum('prix_total');
        $num_ordos = DB::table('ordonnances')->count('id');
        $nb_med_pres = DB::table('med_prescrits')->count('id');
        return view('home',['nb_person'=>$nb_person,'nb_med_pres'=>$nb_med_pres,
        'all_ordos'=>round($all_ordos,2),'num_ordos'=>$num_ordos]);
    }

    public function profile()
    {
        
        /** @var Application $application */
        
        $user = Auth::user();
        return view('user.profile', ['user'=> $user]);
    }
}
