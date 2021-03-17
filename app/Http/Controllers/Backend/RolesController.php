<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
