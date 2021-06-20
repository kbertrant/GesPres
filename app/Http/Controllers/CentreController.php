<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Centre;
use App\Ordonnance;
use App\Ville;
use Illuminate\Http\Request;

class CentreController extends Controller
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

    public function centre()//Request $request)
    {
        
        
        $villes = Ville::all();
        return view('centre.centre',['villes'=>$villes]);
    }

    function getcentrez(){
        
        $tasks = Centre::join('villes','villes.id','=','centres.vil_id')
        ->select(['cen_name','cen_numero','centres.id','contact','vil_name'])->get();
        if(request()->ajax()) {
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                $btn = '<a href="/centre/update/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-edit"></i></a>';

                $btn = $btn.' <a href="/centre/delete/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class=" btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('centre.centre');
     }

    public function addcentre(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'cen_name' => ['required','unique:centres'],
            'cen_numero' => ['required','unique:centres'],
            'contact' => ['required'],
            'vil_id' => ['required'],
            
        ]);

        if ($validator->fails()) {
            return redirect('centre')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        DB::table('centres')->insert(
            ['cen_name' =>$request->cen_name, 'cen_numero' =>$request->cen_numero, 
            'contact' =>$request->contact, 'vil_id' =>$request->vil_id
            ,'created_at'=>NOW(),'updated_at'=>NOW()]
        );
        
        
        $villes = Ville::all();
        return view('centre.centre',['villes'=>$villes]);
    }

    public function updatecentre($id)
    {
        
        $centre = Centre::find($id);
        $villes = Ville::all();
        return view('centre.updatecentre',['centre'=>$centre,'id'=>$id,'villes'=>$villes]);
    }


    public function saveupdatecentre(Request $request)
    {
        
        DB::table('centres')->where('id',$request->id)->update(array(
            'cen_name' =>$request->cen_name,
            'cen_numero' =>$request->cen_numero,
            
            'contact' =>$request->contact,
            
            'vil_id' =>$request->vil_id,
            'updated_at' =>NOW()));
        //return $product;
        return redirect('centre')->with('modif','Centre modifié !');
    }


    public function delete_centre($id){
        $comm = Centre::find($id);
        $comm->delete();
        return redirect('centre')->with('success','Centre supprimé !');
    }


    public function centreStat(){
        $centres = Centre::all();
        return view('centre.centrestat',['centres'=>$centres]);
    }


    public function getCentreStat(Request $request){
        $id = $request->get('cen_id');
        $date_fin = $request->get('date_fin');
        $date_debut = $request->get('date_debut');
        $data = ['code' => 200, 'nbre' => '', 'cout_total' => '', 'cen_name' => '', 'cen_name' => ''];
        $ord = Ordonnance::where('cen_id', '=',  $id)->whereBetween('created_at',[$date_debut,$date_fin])->get();
        
        if(is_null($ord)) {
            $data['code'] = 400;
            $data['message'] = 'User not found !';
        } else {
            $data['code'] = 200;
            $data['cen_name'] = $ord;
            
            //$data['agent_name'] = $agent[0]->per_name;
        }

        return new JsonResponse($data);
    }
}

