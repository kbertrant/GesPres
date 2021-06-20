<?php
namespace App\Http\Controllers;

use App\Lunette;
use App\Med_pres;
use App\Medicament;
use App\Ordonnance;
use App\Personnel;
use App\User;
use App\Utils\GetPriceMedicam;
use App\Utils\GetCentreInfos;
use App\Utils\GetPersonnelId;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LunetteController extends Controller
{
    public function emprunt()
    {
        $cen_id = Auth::user()->cen_id;
        $centre = GetCentreInfos::getCentreName($cen_id);
        return view('emprunt.emprunt',['centre'=>$centre]);
    }

    function getemprunt(){
        //$userrole = GetUserGroup::getUserRole();
        $tasks = Lunette::join('personnels','personnels.id','=','lunettes.per_id')
        ->join('users','users.id','=','lunettes.pres_id')
        ->join('centres','centres.id','=','lunettes.cen_id')
        ->where('pres_id','=',Auth::user()->id)
        ->select(['per_name','name','lunettes.id','date_fin','date_emp','num_emp','etat_emp','cen_name','per_matricule','prix_emp','per_poste']);
        //dd($tasks);
        if(request()->ajax()) {
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                $btn = '<a href="/emprunt/show/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-edit"></i></a>';

                $btn = $btn.' <a href="#" data-toggle="tooltip"  data-id="#" data-original-title="Delete" class="btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('emprunt.emprunt');
     }


    public function saveemprunt(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'per_id' => ['required'],
            
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('emprunt')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $pec = new Lunette;
        $pec->per_id =GetPersonnelId::getPersonnelId($request->per_id);
        $pec->pres_id =Auth::user()->id;
        $pec->cen_id =Auth::user()->cen_id;
        $pec->num_emp =$request->num_emp;
        $pec->prix_emp =0;
        $pec->etat_emp ="En cours";
        $pec->date_emp=TODAY();
        $pec->date_fin= date('Y-m-d', strtotime('+2 years'));
        $pec->created_at=NOW();
        $pec->updated_at=NOW();
        $pec->save();
        
        
        //return $product;
        return redirect('emprunt')->with('success','Emprunt enregistré !');
    }


    public function updateemprunt($id)
    {
        $cen_id = Auth::user()->cen_id;
        $centre = GetCentreInfos::getCentreName($cen_id);
        $emprunt = DB::select("SELECT lunettes.*,personnels.*, users.*,centres.*
        FROM lunettes 
        INNER JOIN personnels ON personnels.id = lunettes.per_id
        INNER JOIN users ON users.id = lunettes.pres_id
        INNER JOIN centres ON centres.id = lunettes.cen_id
        WHERE lunettes.id =(".$id.")");
        
        return view('emprunt.updateemprunt',['emprunt'=>$emprunt,'id'=>$id,'centre'=>$centre]);
    }


    public function saveupdateemprunt(Request $request)
    {
        //dd($request);
        //update client infos
        $pec = Lunette::find($request->id);
         
        DB::table('lunettes')->where('id',$request->id)->update(array(
        'code_pec' =>$pec->code_pec,
        'name_pec' =>$request->name_pec,
        'obser_pec' =>$request->obser_pec,
        'etat_pec' =>$request->etat_pec,
        'updated_at'=>NOW()));
        
       
        return redirect('emprunt')->with('success','Lunettes modifiées !');
    }


    public function delete_emprunt($id){
        $comm = Lunette::find($id);
        $comm->delete();
        return redirect('emprunt')->with('success','Lunettes supprimées !');
    }

    public function showemprunt($id){
        $cen_id = Auth::user()->cen_id;
        $centre = GetCentreInfos::getCentreName($cen_id);
        $emprunt = DB::select("SELECT lunettes.*,personnels.*, users.*,centres.*
        FROM lunettes 
        INNER JOIN personnels ON personnels.id = lunettes.per_id
        INNER JOIN users ON users.id = lunettes.pres_id
        INNER JOIN centres ON centres.id = lunettes.cen_id 
        WHERE lunettes.id =(".$id.")");

        if($emprunt[0]->pro_id==0){
            $agent_name = $emprunt[0]->per_name;
        }else{
            $agent = Personnel::find($emprunt[0]->pro_id);
            $agent_name = $agent->per_name;
        }
       
        return view('emprunt.showemprunt',['agent_name'=>$agent_name,'emprunt'=>$emprunt,'id'=>$id,'centre'=>$centre]);
    }

    function getallemprunt(){
        //$userrole = GetUserGroup::getUserRole();
        $tasks = Lunette::join('personnels','personnels.id','=','lunettes.per_id')
        ->join('users','users.id','=','lunettes.pres_id')
        ->join('centres','centres.id','=','lunettes.cen_id')
        ->select(['per_name','name','lunettes.id','date_fin','date_emp','cen_name','per_matricule','prix_emp','per_poste']);
        //dd($tasks);
        if(request()->ajax()) {
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                $btn = '<a href="/emprunt/show/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-edit"></i></a>';

                $btn = $btn.' <a href="/emprunt/delete/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('emprunt.allemprunt');
     }
}
