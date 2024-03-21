<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

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

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter->tooManyAttempts(
            $this->throttleKey($request),  // Define your own throttle key based on request properties
            2,  // Number of allowed attempts
            1   // Decay minutes
        );
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter->hit(
            $this->throttleKey($request), 
            1 
        );
    }

    protected function fireLockoutEvent(Request $request)
    {
        // Fire an event if needed
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter->availableIn(
            $this->throttleKey($request) 
        );
        notify()->error('throttle error ');

        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => trans('auth.throttle', ['seconds' => $seconds])]);
    }
}
