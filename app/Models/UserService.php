<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    public function service(){
    	return $this->hasOne('App\Models\Service','id','service_id');
    }

    public function user(){
      return $this->hasOne('App\User','id','user_id');
    }

    public function parent_service($id){
         $data = \App\Models\Service::where('id',$id);
         if($data->count() > 0){
            $data = $data->first();
            return $r = \App\Models\Service::where('id',$data->parent_id)->first();
         }else{
            return '';
         }
   }   
}
