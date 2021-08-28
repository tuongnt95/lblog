<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        return view('user.index',compact('data'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all()->pluck('name','name');
        // $user->assignRole('admin');
        $userRole = $user->roles->pluck('name')->all();
        $edit = true;

        // print_r ($roles);

        // echo $userRole[0];

        return view('user.add-edit',compact('user','roles','userRole', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $role = $request->input('role');

        echo $role;

        $input = $request->all();

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('role'));

        return redirect()->route('user_setting')
                        ->with('success','User updated successfully');
    }

    public function create()
    {
        $roles = Role::all()->pluck('name','name');
        $edit = false;
        return view('user.add-edit',compact('roles', 'edit'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make('12345678');

        $user = User::create($input);
        $user->assignRole($request->input('role'));

        return redirect()->route('user_setting')
                        ->with('success','User created successfully');
    }
}
