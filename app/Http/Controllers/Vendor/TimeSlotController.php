<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\User;
use Auth;
class TimeSlotController extends Controller
{
    public $path ='vendor.modules.timeslot.';
    
    public function index()
    {
        $ts = TimeSlot::where('vendor_id',Auth::user()->id)->first();
        
        return view($this->path.'manage')->with('ts',$ts);
    }

    public function save(Request $request){
        $ts = TimeSlot::where('vendor_id',Auth::user()->id);
        if($ts->count() > 0){
            $t = $ts->first();
        }else{
            $t = new TimeSlot();
            $t->vendor_id = Auth::user()->id;
        }
            $t->slot = $request->slot;
            $t->days = json_encode($request->days);
            $t->time_slot = json_encode($request->time_slot);
            $t->save();
        return redirect()->route('vendor.timeslot')->with(['message' => 'Time Slot Updated.', 'message_type' => 'success']);
    }
}    