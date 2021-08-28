<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $data = User::orderBy('id','DESC')->get();
        
        return response()->json(
            [
                'success' => $data
            ],
            $this->successStatus
        );
    }
}
