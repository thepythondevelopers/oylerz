<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class LoginController extends Controller
{
    

    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role=='user'){
                $status = [
               'success' => true,
               'message' => 'Successfully Logged In.'
                ];

                return response()->json($status);         
            }
            
           // Session::flush();
            Auth::logout();
            $status = [
               'success' => false,
               'message' => 'You are authorize to login here.'
                ];

                return response()->json($status);
        }
  
        $status = [
               'success' => false,
               'message' => 'Invalid Credentials.'
                ];

                return response()->json($status);
    }

    

}
