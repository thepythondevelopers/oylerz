<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserService;
use App\Models\Booking;
use App\Models\BService;
use App\Models\BGarage;
use Auth;
class BookingController extends Controller
{
    public $path ='admin.modules.booking.';

    public function index(){
        $booking = Booking::get();
        return view($this->path.'index')->with('booking',$booking);
    }

    public function view($id){
        $b = Booking::where('id',$id);
        if($b->count() > 0){
            $b = $b->first();
            $b_service = BService::where('b_id',$id)->get();    
            $b_garage = BGarage::where('id',$b->garage_id)->first();    
            return view($this->path.'view')->with('b',$b)->with('b_service',$b_service)->with('b_garage',$b_garage);
        }
    }
}    