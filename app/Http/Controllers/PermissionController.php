<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        $rolePermissions = DB::table("role_has_permissions")->get();
        foreach($rolePermissions as $key=>$value){
            $id="cb-".$value->role_id."-".$value->permission_id;
            $ids[]=$id;
        }
        return view('permission.index', ['roles' => Role::all(), 'permissions' => Permission::all(), 'ids' => $ids]);
    }

    public function create()
    {
        return view('permission.add-edit', ['edit' => false]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required'
        ]);

        Permission::create(['name' => $request->get('name'), 'guard_name' => $request->get('guard_name')]);
        return redirect()->route('permission_setting');
    }

    public function edit(Permission $permission)
    {
        return view('permission.add-edit', ['permission' => $permission, 'edit' => true]);
    }

    public function update(Permission $permission, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required'
        ]);
        
        $permission->name = $request->get('name');
        $permission->guard_name = $request->get('guard_name');
        $permission->save();
        return redirect()->route('permission_setting');
    }
}
