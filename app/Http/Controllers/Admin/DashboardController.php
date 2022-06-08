<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\BlogSubscribe;
class DashboardController extends Controller
{
    public $path ='admin.modules.';
    
    public function index()
    {

        $d = date('d/m/Y');
        $booking_count = Booking::count();
        $booking_sum = Booking::sum('price');
        $booking_completed = Booking::where('status',1)->count();
        $booking_today = Booking::where('date',$d)->count();
        $active_vendor = User::where('role','vendor')->where('status',1)->count();
        $blocked_vendor = User::where('role','vendor')->where('status',0)->count();
        $vendor = User::where('role','vendor')->where('status',1)->get();
        return view($this->path.'dashboard')->with('booking_count',$booking_count)->with('booking_sum',$booking_sum)->with('booking_completed',$booking_completed)->with('booking_today',$booking_today)->with('active_vendor',$active_vendor)->with('blocked_vendor',$blocked_vendor)->with('vendor',$vendor);
    }

    public function get_chart(Request $request){
        $year = $request->year==null ? date('Y') : $request->year;

        $data = Booking::where( 'year', $year )->where(function ($query) use ($request) {
            if($request->vendor_id!=null){
                $query->where('vendor', '=', $request->vendor_id);            
            }
    
        })->get()->groupBy(function($val) {
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
        $complete_data = Booking::where( 'year', $year )->where(function ($query) use ($request) {
            if($request->vendor_id!=null){
                $query->where('vendor', '=', $request->vendor_id);            
            }
    
        })->where('status',1)->get()->groupBy(function($val) {
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
        return view($this->path.'setting')->with('user',$user);
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

    function blog_subscribe(Request $request){
        $data = BlogSubscribe::get();
        return view($this->path.'blog_subscribe')->with('data',$data);
    }
    
}
