<?php

namespace App\Http\Controllers;
use App\Medicament;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MedicamentController extends Controller
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

    public function medicam()//Request $request)
    {
        //$request->user()->authorizeRoles(['doctor', 'director']);
        
        $medicams = Medicament::all();
        return view('medicam.medicam',['medicams'=>$medicams]);
    }

    function getmedicam(){
        
       /*  $tasks = Personnel::join('personnels','villes.id','=','centres.vil_id')
        ->select(['per_name','per_matricule','per_poste','per_sexe'])->get(); */
        if(request()->ajax()) {
            return datatables()->of(Medicament::select('*'))
            ->addColumn('action', function($row){
   
                $btn = '<a href="/medicam/update/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-edit"></i></a>';

                $btn = $btn.' <a href="/medicam/delete/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class=" btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('medicam.medicam');
     }

    public function savemedicam(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'med_name' => ['required','unique:medicaments'],
            'med_price' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect('medicam')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        DB::table('medicaments')->insert(
            ['med_name' =>$request->med_name, 
            'med_price' =>$request->med_price, 
            'created_at'=>NOW(),'updated_at'=>NOW()]
        );
        
        return redirect('medicam')->with('success','Médicament ajouté !');
    }

    public function updatemedicam($id)
    {
        
        $medicam = Medicament::find($id);
        return view('medicam.updatemedicam',['id'=>$id,'medicam'=>$medicam]);
    }


    public function saveupdatemedicam(Request $request)
    {
        
        DB::table('medicaments')->where('id',$request->id)->update(array(
            'med_name' =>$request->med_name,
            'med_price' =>$request->med_price,
            'updated_at' =>NOW()));
        //return $product;
        return redirect('medicam')->with('success','Médicament modifié !');
    }


    public function delete_medicam($id){
        $comm = Medicament::find($id);
        $comm->delete();
        return redirect('medicam')->with('success','Médicament supprimé !');
    }


}
