<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	public function garage(){
    	return $this->hasOne('App\Models\Garage','id','garage_id');
    }    
}
