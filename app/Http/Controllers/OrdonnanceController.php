<?php

namespace App\Http\Controllers;

use App\Med_pres;
use App\Medicament;
use App\Ordonnance;
use App\Personnel;
use App\User;
use App\Utils\GetPriceMedicam;
use App\Utils\GetCentreInfos;
use App\Utils\GetPersonnelId;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrdonnanceController extends Controller
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
    
    
    public function ordonan()
    {
        $cen_id = Auth::user()->cen_id;
        $centre = GetCentreInfos::getCentreName($cen_id);

        $medicams = DB::table('medicaments')->orderBy('med_name', 'asc')->get();
        return view('ordonan.ordonan',['medicams'=>$medicams,'centre'=>$centre]);
    }

    function getordonan(){
        //$userrole = GetUserGroup::getUserRole();
        $tasks = Ordonnance::join('personnels','personnels.id','=','ordonnances.per_id')
        ->join('users','users.id','=','ordonnances.pres_id')
        ->join('centres','centres.id','=','ordonnances.cen_id')
        ->where('pres_id','=',Auth::user()->id)
        ->select(['per_name','name','ordonnances.id','ordonnances.created_at','cen_name','per_matricule','prix_total','per_poste']);
        //dd($tasks);
        if(request()->ajax()) {
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                $btn = '<a href="/ordonan/show/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-print"></i></a>';

                $btn = $btn.' <a href="#" data-toggle="tooltip"  data-id="#" data-original-title="Delete" class="btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('ordonan.ordonan');
     }


    public function saveordonan(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'per_id' => ['required'],
            
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('ordonan')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $pec = new Ordonnance;
        $pec->per_id = GetPersonnelId::getPersonnelId($request->per_id) ;
        $pec->pres_id =Auth::user()->id;
        $pec->cen_id =Auth::user()->cen_id;
        $pec->num_ord =$request->num_ord;
        $pec->prix_total =0;
        $pec->created_at=NOW();
        $pec->updated_at=NOW();
        $pec->save();
        
        $somme = array();
        $s = 0;
        foreach ($request->med_id as $p) {
            $i = $s++;
            $mp_price = GetPriceMedicam::getPriceMedicam($p);

            if($request->mp_condition[$i]=="Detail"){
                $mp_qte = $request->mp_prise[$i]*$request->mp_fois[$i]*$request->mp_duree[$i];
            }else{
                $mp_qte = 1;
            }

            $detail = DB::table('med_prescrits')->insert(
                ['ord_id' =>$pec->id,
                'med_id' =>$p,
                'mp_condition' =>$request->mp_condition[$i],
                'mp_prise' =>$request->mp_prise[$i],
                'mp_type' =>$request->mp_type[$i],
                'mp_fois' =>$request->mp_fois[$i],
                'mp_jour' =>$request->mp_jour[$i],
                'mp_periode' =>$request->mp_periode[$i],
                'mp_duree' =>$request->mp_duree[$i],
                'mp_posologie' =>$request->mp_prise[$i]." ".$request->mp_type[$i]."
                 ".$request->mp_fois[$i]." fois ".$request->mp_jour[$i]." 
                 ".$request->mp_periode[$i]." pendant ". $request->mp_duree[$i]." jour(s)",
                
                'mp_qte' =>$mp_qte,
                'mp_price' =>$mp_price,
                'mp_total' =>$mp_price*$mp_qte,
                
                'created_at' =>NOW(),
                'updated_at' =>NOW()]
            );
            
            array_push($somme, $mp_price*$mp_qte);
        }
        //récuperer la commande et inserer le montant total
        $up_pec = Ordonnance::findOrFail($pec->id);
        $up_pec->prix_total = array_sum($somme);
        $up_pec->save();
        
        //return $product;
        return redirect('ordonan')->with('success','Ordonnance enregistrée !');
    }


    public function updateordonan($id)
    {
        $cen_id = Auth::user()->cen_id;
        $centre = GetCentreInfos::getCentreName($cen_id);
        $ordonan = DB::select("SELECT ordonnances.*,personnels.*, users.*,centres.*
        FROM ordonnances 
        INNER JOIN personnels ON personnels.id = ordonnances.per_id
        INNER JOIN users ON users.id = ordonnances.pres_id
        INNER JOIN centres ON centres.id = ordonnances.cen_id
        WHERE ordonnances.id =(".$id.")");

        $med_prescits = DB::select("SELECT *
        FROM med_prescrits 
        WHERE ord_id =(".$id.")");
        
        return view('ordonan.updateordonan',['ordonan'=>$ordonan,'med_prescits'=>$med_prescits,'id'=>$id,'centre'=>$centre]);
    }


    public function saveupdatepec(Request $request)
    {
        //dd($request);
        //update client infos
        $pec = Ordonnance::find($request->id);
        
        // delete all product where equal to pec id
        DB::table('med_prescrits')->where('ord_id',$request->id)->delete();
        
        DB::table('ordonnances')->where('id',$request->id)->update(array(
        'code_pec' =>$pec->code_pec,
        'name_pec' =>$request->name_pec,
        'obser_pec' =>$request->obser_pec,
        'etat_pec' =>$request->etat_pec,
        'updated_at'=>NOW()));
        
        $somme = array();
        $s = 0;
        foreach ($request->designation as $p) {
            $i = $s++;
            $detail = DB::table('med_prescrits')->insert(
                ['quantite' =>$request->quantite[$i],
                'designation' =>$request->designation[$i],
                'prix_unitaire' =>$request->prix_unitaire[$i],
                'pec_id' =>$request->id,
                'pro_id' =>$request->id,
                'created_at' =>NOW(),
                'updated_at' =>NOW()]
            );
            array_push($somme, $request->prix_unitaire[$i]*$request->quantite[$i]);
        }
        //récuperer la commande et inserer le montant total
        $up_pec = Ordonnance::findOrFail($request->id);
        $up_pec->cout_pec = array_sum($somme);
        $up_pec->save();
        return redirect('ordonan')->with('success','Ordonnance modifiée !');
    }


    public function delete_ordonan($id){
        $comm = Ordonnance::find($id);
        $comm->delete();
        return redirect('ordonan')->with('success','Ordonnance supprimée !');
    }

    public function showordonan($id){
        $cen_id = Auth::user()->cen_id;
        $centre = GetCentreInfos::getCentreName($cen_id);
        $ordonan = DB::select("SELECT ordonnances.*,personnels.*,personnels.id as pp, users.*,centres.*
        FROM ordonnances 
        INNER JOIN personnels ON personnels.id = ordonnances.per_id
        INNER JOIN users ON users.id = ordonnances.pres_id
        INNER JOIN centres ON centres.id = ordonnances.cen_id 
        WHERE ordonnances.id =(".$id.")");

        if($ordonan[0]->pro_id==$ordonan[0]->pp){
            $agent_name = $ordonan[0]->per_name;
            $agent_matricule = $ordonan[0]->per_matricule;
        }else{
            $agent = Personnel::find($ordonan[0]->pro_id);
            $agent_name = $agent->per_name;
            $agent_matricule =$agent->per_matricule;
        }
        //$agent_matricule = $ordonan[0]->per_matricule;

        $med_prescrits = DB::select("SELECT medicaments.*, med_prescrits.*
        FROM med_prescrits 
        INNER JOIN medicaments ON medicaments.id = med_prescrits.med_id
        WHERE ord_id =(".$id.")");
        
        return view('ordonan.showordonan',['agent_name'=>$agent_name,'agent_matricule'=>$agent_matricule,
        'ordonan'=>$ordonan,'med_prescrits'=>$med_prescrits,'id'=>$id,'centre'=>$centre]);
    }

    function getallordonan(){
        //$userrole = GetUserGroup::getUserRole();
        $tasks = Ordonnance::join('personnels','personnels.id','=','ordonnances.per_id')
        ->join('users','users.id','=','ordonnances.pres_id')
        ->join('centres','centres.id','=','ordonnances.cen_id')
        ->select(['per_name','name','ordonnances.id','ordonnances.created_at','cen_name','per_matricule','prix_total','per_poste']);
        //dd($tasks);
        if(request()->ajax()) {
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                $btn = '<a href="/ordonan/show/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-print"></i></a>';

                $btn = $btn.' <a href="/ordonan/delete/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('ordonan.allordonan');
     }

    public function autoPerson(Request $request){
        $search = $request->get('term');
          $result = Personnel::where('per_name', 'LIKE', '%'. $search. '%')
          ->select("per_name")->orderBy('per_name', 'asc')->get();
          $data = array();
            foreach ($result as $hsl)
            {
                $data[] = $hsl->per_name;
            }
          return response()->json($data);
    }

    public function autoMedicam(Request $request){
        $search = $request->get('term');
          $result = Medicament::where('med_name', 'LIKE', '%'. $search. '%')
          ->select("med_name")->orderBy('med_name', 'asc')->get();
          $data = array();
            foreach ($result as $hsl)
            {
                $data[] = $hsl->med_name;
            }
          return response()->json($data);
    }

    public function getinfos(Request $request){
        $id = $request->get('id');
        $data = ['code' => 200, 'message' => '', 'agent_name' => '', 'agent_sexe' => '', 'per_matricule' => '', 'per_naiss' => '', 'per_statut' => '', 'per_name' => ''];
        //$query = "SELECT id,per_matricule,agent_sexe,personnels.agent_name,";
        $us = Personnel::where('per_name', '=',  $id)->get();
        $user = Personnel::where('pro_id', '=',  GetPersonnelId::getAgentId($id))->get();
        if(is_null($user)) {
            $data['code'] = 400;
            $data['message'] = 'Personnel introuvable !';
        } else {
            $data['code'] = 200;
            $data['message'] = $user[0]->id;
            $data['per_matricule'] = $user[0]->per_matricule;
            $data['per_naiss'] = $us[0]->per_naiss;
            $data['per_statut'] = $user[0]->per_statut;
            $data['per_name'] = $user[0]->per_name;
            $data['per_sexe'] = $us[0]->per_sexe;
            //$data['agent_name'] = $agent[0]->per_name;
        }

        return new JsonResponse($data);
    }
}
