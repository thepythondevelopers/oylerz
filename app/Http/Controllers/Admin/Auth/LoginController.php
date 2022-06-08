<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /*public function __construct()
    {
        
        $this->middleware('admin')->except('logout','login');
        
    }*/
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function index(){
        
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role=='admin'){
                return redirect()->route('admin.dashboard')
                        ->withSuccess('You have Successfully loggedin');
            }
            
            Session::flush();
            Auth::logout();
            return redirect()->route('admin.index')->withSuccess('You are not authrized to login in Admin Dashboard');
        }
  
        return redirect()->route('admin.index')->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function logout(Request $request) {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }

}
