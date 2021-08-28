<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyTwoFaceController extends Controller
{
    public function index()
    {
        return view("auth.twofa.verify");
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            "code" => "required|digits:6",
        ]);

        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        $secretCode = Auth::user()->secret_code;

        if (!$googleAuthenticator->verifyCode($secretCode, $request->get("code"), 0)) {
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add("code", "Invalid authentication code");
            return redirect()->back()->withErrors($errors);
        }

        session(["2fa_verified" => true]);
        return redirect("home");
    }
}
