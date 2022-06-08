<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    
    public function test()
    {

        return view('frontend.modules.dashboard');
    }

    public function backend(){
        dd(\Auth::user());
        return view('backend.modules.dashboard');   
    }

    public function garage(){
        return view('backend.modules.garage');   
    }

    public function booking(){
        return view('backend.modules.booking');   
    }

    
}
