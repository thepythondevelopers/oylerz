<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;
use Hash;
use App\Mail\VendorActive;
use App\Mail\VendorDeactive;
use Illuminate\Support\Facades\Mail;
class ProfileController extends Controller
{
    public $path ='admin.modules.profile.';
    
    public function index(){
        $user = User::where('role','vendor')->orderBy('id', 'DESC')->get();
        return view($this->path.'index')->with('user',$user);
    }

    public function add(){
        return view($this->path.'add');
    }

    public function save(Request $request){
        
        $u = new User();
        $u->name = $request->name;
        $u->mobile = $request->mobile;
        $u->email = $request->email; 
        $u->service_address = $request->service_address;
        $u->billing_address = $request->billing_address;
        $u->zip_code = $request->zip_code;
        $u->password = Hash::make($request->password);
        $u->role = 'vendor';
        $u->save();
        return Redirect::route('admin.profiles')->with(['message' => 'Successfully Updated Profile', 'message_type' => 'success']);      
    }

    public function view($id){
        $user = User::where('id',$id)->first();
        return view($this->path.'view')->with('user',$user);
    }

    public function edit($id){
        $user = User::where('id',$id)->first();
        return view($this->path.'edit')->with('user',$user);
    }

    public function update(Request $request,$id){
        $u = User::where('id',$id)->first();
        $u->mobile = $request->mobile;
        $u->email = $request->email; 
        $u->service_address = $request->service_address;
        $u->billing_address = $request->billing_address;
        $u->zip_code = $request->zip_code;
        if($request->password!=null){
            $u->password = Hash::make($request->password);
        }    
        $u->save(); 
        return Redirect::route('admin.profiles')->with(['message' => 'Successfully Updated Profile', 'message_type' => 'success']);
    }

    function delete(Request $request,$id){
        $user = User::where('id',$id)->delete();
        return back()->with(['message' => 'Successfully Deleted User', 'message_type' => 'success']);
    }

    function bulk_delete(Request $request){
        $ids = explode(',', $request->ids);
        $user = User::whereIn('id',$ids)->delete();
        return back()->with(['message' => 'Successfully Deleted User', 'message_type' => 'success']);
    }

    function email_check(Request $request){
        $user = User::where('email',$request->email);
        echo $text = $user->count() > 0 ? 'false' : 'true';
    }

    function email_check_edit(Request $request,$id){
        $user = User::where('email',$request->email)->where('id','!=',$id);
        echo $text = $user->count() > 0 ? 'false' : 'true'; 
    }

    public function status(Request $request,$id){
        $u = User::where('id',$id)->first();
        $u->status = $request->status;
        $u->save();
        if($request->status==1){
            Mail::to($u->email)->send(new VendorActive($u->name,$u->email));
        }else{
            Mail::to($u->email)->send(new VendorDeactive($u->name,$u->email));
        }
        $status = [
               'success' => true,
               'message' => 'Status Updated.'
            ];

        return response()->json($status);      
    }


}
