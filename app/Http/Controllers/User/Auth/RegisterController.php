<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class RegisterController extends Controller
{
    

    public function register(Request $request)
    {
        $u = new User();
        $u->role='user';
        $u->name = $request->name;
        $u->mobile = $request->mobile;
        $u->email = $request->email;
        $u->service_address = $request->service_address;
        $u->password = Hash::make($request->password);
        $u->save();
        $status = [
               'success' => true,
               'message' => 'Registration Saved Successfully.'
            ];

        return response()->json($status); 
    }



}
