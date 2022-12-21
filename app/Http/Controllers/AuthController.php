<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if(auth()->user()){
            return redirect('/admin');
        }
        return view('auth.login');
    }

    public function postLogin(Request $request){
        $cred = $request->only('email','password');
        if(Auth::attempt($cred)){
            if(auth()->user()->is_admin == '1'){
                return redirect('/admin');
            }
            else{
                return redirect()->back()->with('error', 'Wrong username or password.');
            }
           
        }
        return redirect()->back()->with('error', 'Wrong username or password.');
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin/login');
    }
}
