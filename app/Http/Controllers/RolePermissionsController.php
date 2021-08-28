<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

class RolePermissionsController extends Controller
{
    public function __construct()
    {
        DB::table('role_has_permissions')->delete();
    }

    public function update(Request $request)
    {
        $roles = $request->get('roles');
        $allRoles = Role::all()->pluck('id');

        foreach ($roles as $key=>$value) {
            foreach($value as $k=>$v){
                Permission::find($v)->assignRole(Role::find($key));
            }
        }

        return redirect()->route('permission_setting')
            ->withSuccess(__('Permissions saved successfully.'));
    }
}
