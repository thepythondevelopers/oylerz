<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Service extends Model
{
	public function parent_service($id){
            return $r = \App\Models\Service::where('id',$id)->first();
   }

   public function service_price($id,$vendor_id=null){
         $v_id = $vendor_id!=null ? $vendor_id : Auth::user()->id;
            return $r = \App\Models\UserService::where('service_id',$id)->where('user_id',$v_id)->first();
   } 	
}
