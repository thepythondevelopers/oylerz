<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BService;
use App\Models\UserService;
use App\Models\Garage;
use App\Models\BGarage;
use App\Models\TimeSlot;
use App\Models\Service;
use App\Models\Location;
use App\Models\Coupon;
use App\User;
use App\Mail\VendorGuestBooking;
use App\Mail\VendorRegisteredBooking;
use App\Mail\VendorBookingAlert;
use Auth;
use Stripe;
use Session;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Str;
class BookingController extends Controller
{
    public $path ='vendor.modules.booking.';
    
    public function index()
    {
        $timeslot = TimeSlot::where('vendor_id',Auth::user()->id)->first();
        
        $service = UserService::where('user_id',Auth::user()->id)->where('status',1)->where('price','!=','')->get();
        $booking = Booking::where('vendor',Auth::user()->id)->orderBy('id','desc')->get();
        $location = Location::where('vendor_id',Auth::user()->id)->where('status',1)->get();
        return view($this->path.'index')->with('booking',$booking)->with('service',$service)->with('timeslot',$timeslot)->with('location',$location);
    }

    public function email_modal(){
            $v = view($this->path.'modals.email_check');
            return response()->json([
                'success' => true,
                'html' => $v->render()
            ]);
    }

    public function email_check(Request $request){
        $u = User::where('email',$request->email);
        if($u->count() > 0){
            $user = $u->first();
            $service = UserService::where('user_id',Auth::user()->id)->where('status',1)->where('price','!=','')->get();
            $g = Garage::where('user_id',$user->id)->get();
            $timeslot = TimeSlot::where('vendor_id',Auth::user()->id)->first();
            $location = Location::where('vendor_id',Auth::user()->id)->where('status',1)->get();
            $v = view($this->path.'modals.registered')->with('data',$request)->with('service',$service)->with('garage',$g)->with('timeslot',$timeslot)->with('location',$location);
            return response()->json([
                'success' => true,
                'html' => $v->render()
            ]);
        }else{
            return response()->json([
            'success' => false,
            'message' => 'Email id not found'
            ]);
        }
    }

    public function coupon_apply(Request $request){
        $service_id = $request->service;
        $c = Coupon::where('code',$request->coupon)->where('status',0);
        if($c->count() > 0){
            $price = UserService::whereIn('service_id',$service_id)->where('user_id',Auth::user()->id)->sum('price');
            $coupon = $c->first();
            if($coupon->type ==0)
            {
                $a_p = $price-$coupon->discount;
                if($a_p<0){
                    return response()->json([
                    'status' => 0,
                    'message' => 'Sorry Coupon Could not apply price is low to this coupon.'
                    ]);        
                }
                $html ='<label class="ser-chrg">Coupon</label>'.$coupon->discount.' <span class="cgr-amt"></label>';
                return response()->json([
                    'status' => 1,
                    'html' => $html,
                    'discount_price'=>'USD '.$a_p
                    ]);        

            }elseif ($coupon->type ==0) {
                $d = $coupon->discount/100*$price;
                $a_p = $price-$d;
                if($a_p<0){
                    return response()->json([
                    'status' => 0,
                    'message' => 'Sorry Coupon Could not apply price is low to this coupon.'
                    ]);        
                }
                $html ='<label class="ser-chrg">Coupon</label>'.$d.' <span class="cgr-amt"></label>';
                return response()->json([
                    'status' => 1,
                    'html' => $html,
                    'discount_price'=> 'USD '.$a_p
                    ]);        
            }    
        }else{
            return response()->json([
            'status' => 0,
            'message' => 'Coupon not found.'
            ]);
        }
        

    }

    public function book_save(Request $request){
        $u = User::where('email',$request->email);
        if($u->count() > 0){
            $slot = TimeSlot::where('vendor_id',Auth::user()->id)->first();
        
        $booking = Booking::where('location_id',$request->location_id)->where('vendor',Auth::user()->id)->where('date',$request->date)->where('time_slot',$request->time_slot);

        if($booking->count() == $slot->slot){
            return response()->json([
            'status' => 0,
            'message' => 'Slot are booked for this time at this location.'
            ]);
        }
            $user = $u->first();
            $price = UserService::whereIn('service_id',$request->service)->where('user_id',Auth::user()->id)->sum('price');
       





        if($request->coupon!=null)
        {
            $c = Coupon::where('code',$request->coupon)->where('status',0);
        if($c->count() > 0){
         
            $coupon = $c->first();
            if($coupon->type ==0)
            {
                $a_p = $price-$coupon->discount;
                if($a_p<0){
                    return response()->json([
                    'status' => 0,
                    'message' => 'Sorry Coupon Could not apply price is low to this coupon.'
                    ]);        
                }
                 $coupon_discount=$coupon->discount;

            }elseif ($coupon->type ==0) {
                $d = $coupon->discount/100*$price;
                $a_p = $price-$d;
                if($a_p<0){
                    return response()->json([
                    'status' => 0,
                    'message' => 'Sorry Coupon Could not apply price is low to this coupon.'
                    ]);        
                }
                 $coupon_discount=$a_p;

            }    
            $coupon = $request->coupon;
        $after_coupon =$a_p;
        }else{
            return response()->json([
            'status' => 0,
            'message' => 'Coupon not found.'
            ]);
        }
        
    }else{
        $coupon = '';
        $coupon_discount='';
        $after_coupon ='';
    }    

        if($request->cash==1){
        $payment = 'Cash';
        $charge_id ='';
    }else{
                Stripe\Stripe::setApiKey(setting('stripe_secret'));
                $stripe_price = $coupon!='' ? $after_coupon : $price;
       $charge = Stripe\Charge::create ([
                "amount" => (int)$stripe_price*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Oylerz"
        ]);
        $payment = 'Stripe';
        $charge_id =$charge->id;
    }

     
            if($request->manual==1){
                $g = new BGarage();
                $g->year= $request->year;
                $g->make= $request->make;
                $g->model= $request->model;
                $g->trim= $request->trim;
                $g->mileage= $request->mileage;
                $g->save();
            }else{
            $u_garage = Garage::where('id',$request->garage)->first();
            $g = new BGarage();
            $g->year = $u_garage->year;
            $g->make = $u_garage->make;
            $g->model = $u_garage->model;
            $g->trim = $u_garage->trim;
            $g->mileage = $u_garage->mileage;
            $g->save();
        }
        $y =  Carbon::createFromFormat('d/m/Y', $request->date)->format('Y');
            $random = Str::random(10);
            $b = new Booking();
            $b->location_id = $request->location_id;
            $b->name = $request->name;
            $b->mobile = $request->mobile;
            $b->email = $user->email;
            $b->user_id = $user->id;
            $b->garage_id = $g->id;
            $b->date = $request->date;
            $b->time_slot = $request->time_slot;
            $b->vendor = Auth::user()->id; 
            $b->price = $price;
            $b->payment =$payment;
            $b->year = $y;
                    $b->charge_id = $charge_id;
        
            $b->order_id = $random;        
        $b->coupon = $coupon;
        $b->coupon_discount = $coupon_discount;
        $b->after_coupon = $after_coupon;
            $b->save();

            $b_s = Service::whereIn('id',$request->service)->get();
            foreach($b_s as $key=>$value){
                $bs = new BService();
                $bs->b_id = $b->id;
                $bs->name = $value->name;
                $bs->category_name = $value->parent_service($value->parent_id)->name;
                $bs->price = $value->service_price($value->id)->price;
                $bs->save();
            }
            $b = Booking::where('id',$b->id)->first();
            $b_service = BService::where('b_id',$b->id)->get();    
            $b_garage = BGarage::where('id',$b->garage_id)->first();

            $vendor = User::where('id',Auth::user()->id)->first(); 
        $pdf =  pdf_save($b,$b_service,$b_garage,$random);   
        Mail::to($vendor->email)->send(new VendorBookingAlert($pdf,$b,$b_service,$b_garage,$vendor));
            Mail::to($request->email)->send(new VendorRegisteredBooking($pdf,$b,$b_service,$b_garage));
        //Mail Send End
            return response()->json([
            'status' => 1,
            'message' => 'Booking Saved Successfully.'
            ]);
        }    
    }


    public function guest_booking_save(Request $request){
        
        $y =  Carbon::createFromFormat('d/m/Y', $request->date)->format('Y');

        
        $slot = TimeSlot::where('vendor_id',Auth::user()->id)->first();
        
        $booking = Booking::where('location_id',$request->location_id)->where('vendor',Auth::user()->id)->where('date',$request->date)->where('time_slot',$request->time_slot);

        if($booking->count() == $slot->slot){
            return response()->json([
            'status' => 0,
            'message' => 'Slot are booked for this time at this location.'
            ]);
        }    
        $price = UserService::whereIn('service_id',$request->newservice)->where('user_id',Auth::user()->id)->sum('price');   
        

        if($request->coupon!=null)
        {
            $c = Coupon::where('code',$request->coupon)->where('status',0);
        if($c->count() > 0){
         
            $coupon = $c->first();
            if($coupon->type ==0)
            {
                $a_p = $price-$coupon->discount;
                if($a_p<0){
                    return response()->json([
                    'status' => 0,
                    'message' => 'Sorry Coupon Could not apply price is low to this coupon.'
                    ]);        
                }
                 $coupon_discount=$coupon->discount;

            }elseif ($coupon->type ==0) {
                $d = $coupon->discount/100*$price;
                $a_p = $price-$d;
                if($a_p<0){
                    return response()->json([
                    'status' => 0,
                    'message' => 'Sorry Coupon Could not apply price is low to this coupon.'
                    ]);        
                }
                 $coupon_discount=$a_p;

            }    
            $coupon = $request->coupon;
        $after_coupon =$a_p;
        }else{
            return response()->json([
            'status' => 0,
            'message' => 'Coupon not found.'
            ]);
        }
        
    }else{
        $coupon = '';
        $coupon_discount='';
        $after_coupon ='';
    }    

        if($request->cash==1){
        $payment = 'Cash';
        $charge_id ='';
    }else{
                Stripe\Stripe::setApiKey(setting('stripe_secret'));
                $stripe_price = $coupon!='' ? $after_coupon : $price;
       $charge = Stripe\Charge::create ([
                "amount" => (int)$stripe_price*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Oylerz"
        ]);
        $payment = 'Stripe';
        $charge_id =$charge->id;
    }

        $g = new BGarage();
        $g->year = $request->year;
        $g->make = $request->make;
        $g->model = $request->model;
        $g->trim = $request->trim;
        $g->mileage = $request->mileage;
        $g->save();

        
        $random = Str::random(10);
        $b = new Booking();
        $b->location_id = $request->location_id;
        $b->name = $request->name;
            $b->mobile = $request->mobile;
        $b->garage_id = $g->id;
        $b->email = $request->email;
        $b->date = $request->date;
        $b->time_slot = $request->time_slot;
        $b->vendor = Auth::user()->id; 
        $b->price = $price;
        $b->payment =$payment;
        $b->year = $y;
        $b->charge_id = $charge_id;
        $b->order_id = $random;

        $b->coupon = $coupon;
        $b->coupon_discount = $coupon_discount;
        $b->after_coupon = $after_coupon;
        $b->save();
        
        $b_s = Service::whereIn('id',$request->newservice)->get();
        foreach($b_s as $key=>$value){
            $bs = new BService();
            $bs->b_id = $b->id;
            $bs->name = $value->name;
            $bs->category_name = $value->parent_service($value->parent_id)->name;
            $bs->price = $value->service_price($value->id)->price;
            $bs->save();
        }
        //Mail Send Start
        $b = Booking::where('id',$b->id)->first();
            $b_service = BService::where('b_id',$b->id)->get();    
            $b_garage = BGarage::where('id',$b->garage_id)->first();
            $vendor = User::where('id',Auth::user()->id)->first(); 
        $pdf =  pdf_save($b,$b_service,$b_garage,$random);  
        
        Mail::to($request->email)->send(new VendorGuestBooking($pdf,$b,$b_service,$b_garage));
        Mail::to($vendor->email)->send(new VendorBookingAlert($pdf,$b,$b_service,$b_garage,$vendor));
        //Mail Send End
        return response()->json([
            'status' => 1,
            'message' => 'Booking Saved Successfully.'
        ]);
    }

    public function view($id){
        $b = Booking::where('id',$id)->where('vendor',Auth::user()->id);
        if($b->count() > 0){    
            $b = $b->first();
            $b_service = BService::where('b_id',$id)->get();    
            $b_garage = BGarage::where('id',$b->garage_id)->first();
            return view($this->path.'view')->with('b',$b)->with('b_service',$b_service)->with('b_garage',$b_garage);        
        }
    }

    public function status(Request $request,$id){
        $b = Booking::where('id',$id)->where('vendor',Auth::user()->id);
        if($b->count() > 0){
            $b = $b->first();
            $b->status = $request->status;
            $b->save();
                    $status = [
               'success' => true,
               'message' => 'Status Updated.'
            ];

        return response()->json($status);     
        }
    }

    

    
}
