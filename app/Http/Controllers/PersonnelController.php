<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
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

    public function person()//Request $request)
    {
        //$request->user()->authorizeRoles(['doctor', 'director']);
        
        $persons = Personnel::where('is_personnel','=',1)->get();
        return view('personnel.personnel',['persons'=>$persons]);
    }

    function getperson(){
        
       /*  $tasks = Personnel::join('personnels','villes.id','=','centres.vil_id')
        ->select(['per_name','per_matricule','per_poste','per_sexe'])->get(); */
        if(request()->ajax()) {
            return datatables()->of(Personnel::select('*'))
            ->addColumn('action', function($row){
   
                $btn = '<a href="/person/update/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-edit"></i></a>';

                $btn = $btn.' <a href="/person/delete/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class=" btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('personnel.personnel');
     }

    public function saveperson(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'per_name' => ['required','unique:personnels'],
            'per_matricule' => ['required','unique:personnels'],
            'per_poste' => ['required'],
            'per_naiss' => ['required'],
            'per_sexe' => ['required']
            
        ]);

        if ($validator->fails()) {
            return redirect('person')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        DB::table('personnels')->insert(
            ['per_name' =>$request->per_name, 'per_matricule' =>$request->per_matricule, 
            'per_poste' =>$request->per_poste,'is_personnel' =>$request->is_personnel,
            'per_naiss' =>$request->per_naiss,
            'per_sexe' =>$request->per_sexe,'per_statut' =>$request->per_statut,
            'per_classe' =>$request->per_classe, 'pro_id' =>1
            ,'created_at'=>NOW(),'updated_at'=>NOW()]
        );
        
        $persons = Personnel::where('is_personnel','=',1)->get();
        
        return view('personnel.personnel',['persons'=>$persons])->with('modif','Personnel modifié !');
    }

    public function updateperson($id)
    {
        
        $person = Personnel::find($id);
        $persons =  DB::table('personnels')->orderBy('per_name', 'asc')->get();
        return view('personnel.updatepersonnel',['id'=>$id,'person'=>$person,'persons'=>$persons]);
    }


    public function saveupdateperson(Request $request)
    {
        
        DB::table('personnels')->where('id',$request->id)->update(array(
            'per_name' =>$request->per_name,
            'per_matricule' =>$request->per_matricule,
            'per_poste' =>$request->per_poste,
            'per_naiss' =>$request->per_naiss,
            'per_sexe' =>$request->per_sexe,
            'per_statut' =>$request->per_statut,
            'per_classe' =>$request->per_classe,
            'is_personnel' =>$request->is_personnel,
            'updated_at' =>NOW()));
        //return $product;
        return redirect('person')->with('modif','Personnel modifié !');
    }


    public function delete_person($id){
        $comm = Personnel::find($id);
        $comm->delete();
        return redirect('person')->with('success','Personnel supprimé !');
    }

    function getmedecin(){
        
        $tasks = DB::table('users')->where('type_user', 'doctor')
         ->select(['id','name','email','phone','genre','type_user'])->get(); 
         if(request()->ajax()) {
             return datatables()->of($tasks)
             ->addColumn('action', function($row){
    
                 $btn = '<a href="#" data-toggle="tooltip"  data-id="#" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct"><i class="fa fa-edit fa-2x"></i></a>';
 
                 $btn = $btn.' <a href="#" data-toggle="tooltip"  data-id="#" data-original-title="Delete" class=" btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash fa-2x"></i></a>';
 
                  return $btn;
          })
             ->rawColumns(['action'])
             ->addIndexColumn()
             ->make(true);
         }
         return view('personnel.listmedecin');
      }


}
