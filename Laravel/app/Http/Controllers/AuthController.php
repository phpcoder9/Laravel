<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
   public function authStore(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8', 
        ]);
        $user = new User();
        if($request->hasFile('image')){
           $image  =  UploadFile($request,'image','images') ?? null;
           $user->image = $image;
        }
        $user->name = $request->name;
        $user->email= $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::login($user);
        notify()->success('Registration successful');
        return redirect()->route('dashboard');
    }
    public function logout(Request $request){
        auth()->logout();
        notify()->success('Logout! You have successfully logged out');
        return redirect()->route('login');
    }
}
