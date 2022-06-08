<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;
use Hash;
class UserController extends Controller
{
    public $path ='admin.modules.user.';
    
    public function index(){
        $user = User::where('role','user')->get();
        return view($this->path.'index')->with('user',$user);
    }


    public function view($id){
        $user = User::where('id',$id)->first();
        return view($this->path.'view')->with('user',$user);
    }



}
