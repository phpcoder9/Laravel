<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(){
        return view('auth.login');
    }
    
    public function register(Request $request){
        return view('auth.register');
    }

    public function authenticate(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credintials = $request->only(['email','password']);
        $remember = $request->has('remember');  
        if (auth()->attempt($credintials)) {
            notify()->success('Welcome! You have successfully logged in');
            return redirect()->route('dashboard');
        }else{
            notify()->error('Invalid credentials! Please try again');
            return redirect()->back()->withInput($request->only('email', 'remember'));       
        }
    }

    public function logout(Request $request){
        auth()->logout();
        notify()->success('Logout! You have successfully logged out');
        return redirect()->route('login');
    }
}
