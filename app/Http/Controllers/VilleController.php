<?php

namespace App\Http\Controllers;
use App\Ville;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VilleController extends Controller
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

    public function ville(Request $request)
    {
        //$request->user()->authorizeRoles(['doctor', 'director']);
        
        
        
        return view('ville.ville');
    }

    function getville(){
        
        
        if(request()->ajax()) {
            return datatables()->of(Ville::select('*'))
            ->addColumn('action', function($row){
   
                $btn = '<a href="/ville/update/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-edit"></i></a>';

                $btn = $btn.' <a href="/ville/delete/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class=" btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('ville.ville');
     }


    public function saveville(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'vil_name' => ['required','unique:villes'],
            'region' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect('ville')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        DB::table('villes')->insert(
            ['vil_name' =>$request->vil_name,'region' =>$request->region,'created_at'=>NOW(),'updated_at'=>NOW()]
        );
    
        return view('ville.ville')->with('success','Ville ajoutée !');
    }

    public function updateville($id)
    {
        
        $ville = Ville::find($id);
        return view('ville.updateville',['id'=>$id,'ville'=>$ville]);
    }

    public function saveupdateville(Request $request)
    {
        
        DB::table('villes')->where('id',$request->id)->update(array(
            'vil_name' =>$request->vil_name,
            'region' =>$request->region,
            'updated_at' =>NOW()));
        //return $product;
        return redirect('ville')->with('modif','Ville modifié !');
    }


    public function delete_ville($id){
        $comm = Ville::find($id);
        $comm->delete();
        return redirect('ville')->with('success','Ville supprimée !');
    }
}
