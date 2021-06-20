<?php

namespace App\Http\Controllers;

use App\Centre;
use App\Role;
use App\Role_user;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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

    public function user()
    {
        
        $centres = Centre::All();
        $tasks = User::join('centres','centres.id','=','users.cen_id')
        ->select(['cen_name','name','users.id','phone','image','poste','type_user','email','genre']);
        if(request()->ajax()) {
            return datatables()->of($tasks)
            ->addColumn('action', 'action_button')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('user.user',['centres'=>$centres]);
    }

    function getUser(){

        $tasks = User::join('centres','centres.id','=','users.cen_id')
        ->select(['cen_name','name','users.id','phone','image','poste','type_user','email','genre']);
        if(request()->ajax()) {
            return datatables()->of($tasks)
            ->addColumn('photo', function ($row) { 
                $url="uploads/avatars/$row->image"; 
                $imges = '<img src="'.$url.'" width="50px" height="50px"/>'; 
                return $imges;
         })
            ->addColumn('action', function($row){
                $btn = '<a href="/user/update/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary shadow btn-circle editProduct" style="margin:5px"><i class="fa fa-edit"></i></a>';
                $btn = $btn.' <a href="/user/delete/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger shadow btn-circle deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action','photo'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('user.user');
     }

     public function saveuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','unique:users'],
            'email' => ['required','unique:users'],
            'genre' => ['required'],
            'phone' => ['required'],
            'password' => ['required'],
            'cen_id' => ['required'],
            'poste' => ['required'],
            'type_user' => ['required']
            
        ]);
    
        if ($validator->fails()) {
            return redirect('user')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = $request->email . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('uploads/avatars/'. $filename);  // online file
            //Image::make($image)->resize(300,300)->save(public_path('/uploads/avatars/'. $filename));
            $users = DB::table('users')->insert(
            ['name' =>$request->name,
            'email' =>$request->email,
            'genre' =>$request->genre,
            'phone' =>$request->phone,
            'cen_id' =>$request->cen_id,
            'poste' =>$request->poste,
            'password' => Hash::make($request->password),
            'created_at' =>NOW(),
            'updated_at' =>NOW(),
            'image'=>$filename]
        );
        
    }
        
        //return $product;
        return redirect('user')->with('success','Prescripteur ajouté');
    }


    public function updateuser($id)
    {
        //$list_taches = Role::All();
        $centres = Centre::All();
        $user = User::find($id);
        return view('user.updateuser',['user'=>$user,'id'=>$id,'centres'=>$centres]);
    }


    public function saveupdateuser(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'genre' => ['required'],
            'phone' => ['required'],
            'password' => ['required'],
            'cen_id' => ['required'],
            'poste' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect('user')
                        ->withErrors($validator)
                        ->withInput();
        }
        $image = $request->file('img');
            $filename = $request->email . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('uploads/avatars/'. $filename);  // online file
            //Image::make($image)->resize(300,300)->save(public_path('/uploads/avatars/'. $filename));
        //dd($request);
        DB::table('users')->where('id',$request->id)->update(array(
            'name' =>$request->name,
            'email' =>$request->email,
            'genre' =>$request->genre,
            'phone' =>$request->phone,
            'cen_id' =>$request->cen_id,
            'poste' =>$request->poste,
            'type_user' =>$request->type_user,
            'password' =>Hash::make($request->password),
            'updated_at' =>NOW(),
            'image' =>$filename));
            //dd($r);
        //return $product;
        return redirect('user')->with('success','Prescripteur modifié !');
    }


    public function delete_user($id){
        $comm = User::find($id);
        $comm->delete();
        return redirect('user')->with('success','Prescripteur supprimé !');
    }


    public function saveroleuser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [

            'role_id' => ['required'],
            'user_id' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect('roleuser')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        DB::table('role_user')->insert(
            ['role_id' =>$request->role_id, 'user_id' =>$request->user_id, 
            'created_at'=>NOW(),'updated_at'=>NOW()]
        );
        $user = User::all();
        $role = Role::all();
        return view('role.roleuser',['user'=>$user,'role'=>$role]);
    }

    public function roleuser()
    {
        //$request->user()->authorizeRoles(['doctor', 'director']);
        $users = User::all();
        $roles = Role::all();
        
        return view('role.roleuser',['users'=>$users,'roles'=>$roles]);
    }

    function getroleuser(){
        //$userrole = GetUserGroup::getUserRole();
        $tasks = from('role_user')->join('users','users.id','=','role_user.user_id')
        ->join('roles','roles.id','=','role_user.role_id')
        ->select(['roles.name as r_name','users.name as u_name']);
        //dd($tasks);
        if(request()->ajax()) {
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                $btn = '<a href="/ordonan/show/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn-primary btn-circle shadow editProduct" style="margin:5px"><i class="fa fa-edit"></i></a>';

                $btn = $btn.' <a href="/ordonan/delete/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn-danger btn-circle shadow deleteProduct"><i class="fa fa-trash"></i></a>';

                 return $btn;
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('role.roleuser');
     }
}
