<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
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
        if(is_null($this->user) || !$this->user->can('role.view')){
            abort(403, 'Sorry !! You are Unauthorized to View any role !');
        }
       $roles = Role::all();
       return view('backend.pages.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, 'Sorry !! You are Unauthorized to Create any role !');
        }
       $all_permission = Permission::all();
       $permission_group = User::getpermissiongroups();
       return view('backend.pages.roles.create',compact('all_permission','permission_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, 'Sorry !! You are Unauthorized to Create any role !');
        }
        $request->validate([
            'name' => 'required|max:100|unique:roles'
        ],[
            'name.required' => 'Please Give a Role Name'
        ]);
        $role = Role::create(['name' => $request->name,'guard_name' => 'admin']);
        $permissions = $request->input('permissions');

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        $notification=array(
            'message'=>'Successfully Save Role',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.roles.index')->with($notification);
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
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        $role = Role::findById($id, 'admin');
        $all_permission = Permission::all();
        $permission_group = User::getpermissiongroups();
        return view('backend.pages.roles.edit',compact('role','all_permission','permission_group'));
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
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ],[
            'name.required' => 'Please Give a Role Name'
        ]);
        $role = Role::findById($id, 'admin');
        $role->name = $request->name;
        $permissions = $request->input('permissions');

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        $role->save();
        $notification=array(
            'message'=>'Successfully Update Role',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.roles.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('role.delete')){
            abort(403, 'Sorry !! You are Unauthorized to delete any role !');
        }
        $role = Role::findById($id, 'admin');
        if (!is_null($role)) {
            $role->delete();
        }

        $notification=array(
            'message'=>'Successfully Delete Role',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.roles.index')->with($notification);
    }
}
