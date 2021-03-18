<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('admin.view')){
            abort(403, 'Sorry !! You are Unauthorized to View any Admin !');
        }
        $admins = Admin::all();
        return view('backend.pages.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, 'Sorry !! You are Unauthorized to Create any Admin !');
        }
        $roles = Role::all();
        return view('backend.pages.admins.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, 'Sorry !! You are Unauthorized to Create any Admin !');
        }
        $request->validate([
           'name' => 'required|max:100|min:3',
           'username' => 'required|max:10|min:3',
           'email' => 'required|max:100|email|unique:admins',
           'password' => 'required|min:6|confirmed',
        ]);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        if($request->roles){
           $admin->assignRole($request->roles);
        }
        if($admin->save()){
            $notification=array(
                'message'=>'Successfully Save Admin',
                'alert-type'=>'success'
            );
        }
        return redirect()->route('admin.admins.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any Admin !');
        }
        $admin = Admin::find($id);
        $roles = Role::all();
        return view('backend.pages.admins.edit',compact('admin','roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any Admin !');
        }
        $admin = Admin::find($id);
        $request->validate([
            'name' => 'required|max:100|min:3',
            'username' => 'required|max:10|min:3',
            'email' => 'required|max:100|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
         ]);
         $admin->name = $request->name;
         $admin->username = $request->username;
         $admin->email = $request->email;
         if($request->password){
            $admin->password = Hash::make($request->password);
         }
         $admin->roles()->detach();
         if($request->roles){
            $admin->assignRole($request->roles);
         }
         if($admin->save()){
             $notification=array(
                 'message'=>'Successfully Update Admin',
                 'alert-type'=>'success'
             );
         }
         return redirect()->route('admin.admins.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.delete')){
            abort(403, 'Sorry !! You are Unauthorized to delete any Admin !');
        }
        $admin = Admin::find($id);
        if(!is_null($admin)){
            $admin->delete();
            $notification=array(
                'message'=>'Successfully Delete Admin',
                'alert-type'=>'success'
            );
        }
        return redirect()->back()->with($notification);
    }
}
