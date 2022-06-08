<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserService;
use App\Models\Booking;
use App\Models\BService;
use App\Models\BGarage;
use App\Models\TimeSlot;
use Auth;
class BookingController extends Controller
{
    public $path ='user.modules.booking.';

    public function index(){
        $booking = Booking::where('user_id',Auth::user()->id)->get();
        return view($this->path.'index')->with('booking',$booking);
    }

    public function view($id){
        $b = Booking::where('id',$id)->where('user_id',Auth::user()->id);
        if($b->count() > 0){
            $b = $b->first();
            $b_service = BService::where('b_id',$id)->get();    
            $b_garage = BGarage::where('id',$b->garage_id)->first();    
            return view($this->path.'view')->with('b',$b)->with('b_service',$b_service)->with('b_garage',$b_garage);
        }
    }

    public function reschedule($id){
        $b = Booking::where('id',$id)->first();
        if( round((strtotime(\Carbon\Carbon::createFromFormat('d/m/Y h:i a', $b->date.' '.$b->time_slot)->format('d-m-Y h:i a')) -strtotime(\Carbon\Carbon::now(user_location()->timezone)) )/3600, 1) > 1){ 
        $timeslot = TimeSlot::where('vendor_id',$b->vendor)->first();
        return view($this->path.'reschedule')->with('booking',$b)->with('timeslot',$timeslot);
        }else{
                    return redirect()->back()->with(['message' => 'Booking Time Slot should be less than 1 hour', 'message_type' => 'error']);
        }
    }

    public function reschedule_save(Request $request,$id){
        $b = Booking::where('id',$id)->first();
        if( round((strtotime(\Carbon\Carbon::createFromFormat('d/m/Y h:i a', $b->date.' '.$b->time_slot)->format('d-m-Y h:i a')) -strtotime(\Carbon\Carbon::now(user_location()->timezone)) )/3600, 1) > 1){ 
            
                    $slot = TimeSlot::where('vendor_id',$b->vendor)->first();
        
        $booking = Booking::where('location_id',$b->location_id)->where('vendor',$b->vendor)->where('date',$request->date)->where('time_slot',$request->time_slot)->where('id','!=',$id);

        if($booking->count() == $slot->slot){
                                return redirect()->back()->with(['message' => 'Slot are booked for this time.', 'message_type' => 'error']);
        }    
        $b->date = $request->date;
        $b->time_slot = $request->time_slot;
        $b->save();
         return redirect()->route('user.booking.view',$id)->with(['message' => 'Booking Reschedule Successfully.', 'message_type' => 'success']);
        }else{
                    return redirect()->route('user.booking.view',$id)->with(['message' => 'Booking Time Slot should be less than 1 hour', 'message_type' => 'error']);
        }
    }
}    