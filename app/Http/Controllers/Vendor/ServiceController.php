<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\UserService;
class ServiceController extends Controller
{
    public $path ='vendor.modules.services.';
    

    public function index(){
        $user_service = UserService::where('user_id',\Auth::user()->id)->where('status',1)->get();
        return view($this->path.'index')->with('user_service',$user_service);
    }
    public function add()
    {
        $service = Service::where('parent_id',0)->get();
        $user_service = UserService::where('user_id',\Auth::user()->id)->where('status',1)->pluck('service_id')->toArray();
        return view($this->path.'add')->with('service',$service)->with('user_service',$user_service);
    }

    public function save(Request $request){
        $u_service = UserService::where('user_id',\Auth::user()->id)->where('status',1)->pluck('service_id')->toArray();
        $r = array_diff($u_service, $request->service_id);

        UserService::where('user_id',\Auth::user()->id)->whereIn('service_id',$r)->update(['status' => 0,'price'=>'']);
        
        foreach($request->service_id as $key=>$service_id){
            $result= UserService::where('service_id',$service_id)->where('user_id',\Auth::user()->id);
            if($result->count() > 0){
                $service = $result->first();
                $service->status = 1;
                $service->save();
            }else{
                $us = new UserService();
                $us->user_id= \Auth::user()->id;
                $us->service_id= $service_id;
                $us->save();    
            }
            
        }    
        return redirect()->route('vendor.service')->with(['message' => 'Services Updated Successfully.', 'message_type' => 'success']);
    }

    public function edit($id){
        $user_service = UserService::where('user_id',\Auth::user()->id)->where('status',1)->where('id',$id);
        if($user_service->count() > 0){
            return view($this->path.'edit')->with('user_service',$user_service->first());   
        }
    }

    public function update(Request $request,$id){
        $us = UserService::where('id',$id)->where('user_id',\Auth::user()->id)->first();
        $us->price = $request->price;
        $us->save();
        return redirect()->route('vendor.service')->with(['message' => 'Price is updated Successfully.', 'message_type' => 'success']);
    }


    
}
