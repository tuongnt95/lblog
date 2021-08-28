<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index', ['roles' => Role::all()]);
    }

    public function edit(Role $role)
    {
        return view('role.add-edit', ['role' => $role, 'edit' => true]);
    }

    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required'
        ]);

        $role->name = $request->get('name');
        $role->guard_name = $request->get('guard_name');
        $role->save();
        return redirect()->route('role_setting');
    }
    public function create()
    {
        return view('role.add-edit', ['edit' => false]);
    }
    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required'
        ]);
        
        Role::create(['name' => $request->get('name'), 'guard_name' => $request->get('guard_name')]);
        return redirect()->route('role_setting');
    }
}
