<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Auth;
class DashboardController extends Controller
{
    public $path ='user.modules.';
    
    public function index()
    {
        $d = date('d/m/Y');
        $booking_count = Booking::where('user_id',Auth::user()->id)->count();
        $booking_sum = Booking::where('user_id',Auth::user()->id)->sum('price');
        $booking_completed = Booking::where('user_id',Auth::user()->id)->where('status',1)->count();
        $booking_today = Booking::where('user_id',Auth::user()->id)->where('date',$d)->count();
        return view($this->path.'dashboard')->with('booking_count',$booking_count)->with('booking_sum',$booking_sum)->with('booking_completed',$booking_completed)->with('booking_today',$booking_today);
    }

    public function get_chart(Request $request){
        $year = $request->year==null ? date('Y') : $request->year;
        $data = Booking::where('user_id',Auth::user()->id)->where( 'year', $year )->get()->groupBy(function($val) {
            return Carbon::parse(strtotime($val->date))->format('M');
        });


            $booked = array();
            $period = \Carbon\CarbonPeriod::create('2021-01-01', '1 month', '2021-12-31');
            foreach ($period as $p) {
                $m = $p->format('M');
                
                if (isset($data[$m])) {
                    array_push($booked,$data[$m]->count());
                } else {
                   array_push($booked,0);
                }
            }
        $complete_data = Booking::where('user_id',Auth::user()->id)->where( 'year', $year )->where('status',1)->get()->groupBy(function($val) {
            return Carbon::parse(strtotime($val->date))->format('M');
        });


            $completed = array();
            $comp_period = \Carbon\CarbonPeriod::create('2021-01-01', '1 month', '2021-12-31');
            foreach ($comp_period as $p) {
                $m = $p->format('M');
                
                if (isset($complete_data[$m])) {
                   array_push($completed,$complete_data[$m]->count());
                } else {
                    array_push($completed,0);
                }
            }
            
        return response()->json([
           'booked' => $booked,
           'completed' => $completed
        ]);        
    }

    public function profile()
    {
        $user = Auth::user();
        return view($this->path.'profile')->with('user',$user);
    }

    public function profile_save(Request $request){
        $u = Auth::user();
        $u->name = $request->name;
        $u->mobile = $request->mobile;
        $u->service_address = $request->service_address;
        $u->billing_address = $request->billing_address;
        $u->zip_code = $request->zip_code;
      if($request->avatar !=null){
        $path = public_path(Auth::user()->avatar);
            if(File::exists($path)){
                unlink($path);
            }  
        $img_path = 'images/avatar/';
        $time = strtotime('now').Str::random(40);
        $ext = $request->avatar->getClientOriginalExtension();
        $image = $time.".".$ext;
        $request->avatar->move(public_path('images/avatar'),$image);

        $image = $img_path.$image;    
        $u->avatar = $image;
     }
     $u->save();
     return redirect()->back()->with(['message' => 'Profile Updated Successfully.', 'message_type' => 'success']);
    }

    

    
}
