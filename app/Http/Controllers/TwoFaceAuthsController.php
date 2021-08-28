<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFaceAuthsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {   
        $secretCode = Auth::user()->secret_code;
        if($secretCode){
            return view("auth.twofa.disable");
        }
        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        // $googleAuthenticator = new PHPGangsta_GoogleAuthenticator();
        
        $secretCode = $googleAuthenticator->createSecret();
        
        $qrCodeUrl = $googleAuthenticator->getQRCodeGoogleUrl(
            Auth::user()->email, $secretCode, config("app.name")
        );
        
    
        session(["secret_code" => $secretCode]);

        return view("auth.twofa.index", compact("qrCodeUrl"));
    }

    public function enable(Request $request)
    {
        $this->validate($request, [
            "code" => "required|digits:6"
        ]);
        
        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        
        $secretCode = session("secret_code");
        
        if (!$googleAuthenticator->verifyCode($secretCode, $request->get("code"), 0)) {
            return redirect("home")->with("error", "Invalid code");
        }
        
        $user = Auth::user();
        $user->secret_code = $secretCode;
        $user->save();

        return redirect("home")->with("status", "2FA enabled!");
    }

    public function disable(Request $request)
    {
        $this->validate($request, [
            "code" => "required|digits:6"
        ]);
        
        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        $secretCode = Auth::user()->secret_code;

        if (!$googleAuthenticator->verifyCode($secretCode, $request->get("code"), 0)) {
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add("code", "Invalid authentication code");
            return redirect()->back()->withErrors($errors);
        }
        
        $user = Auth::user();
        $user->secret_code = null;
        $user->save();

        return $this->index();
    }
}
