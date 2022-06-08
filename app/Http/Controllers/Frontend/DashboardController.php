<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserService;
use App\Models\Booking;
use App\Models\Garage;
use App\Models\Contact;
use App\Models\Location;
use App\Models\TimeSlot;
use App\Models\BGarage;
use App\Models\BService;
use App\Models\Service;
use App\Models\CmsPage;
use App\Models\Blog;
use App\Models\Coupon;
use App\Models\BlogComment;
use App\Models\BlogSubscribe;
use App\Models\Car;
use Auth;
use Stripe;
use DateTime;
use App\Mail\ContactEmail;
use App\Mail\VendorGuestBooking;
use App\Mail\VendorRegisteredBooking;
use App\Mail\VendorBookingAlert;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Str;

class DashboardController extends Controller
{
    public $path ='frontend.modules.';

    public function dashboard(){        
        $cms = CmsPage::where('slug','Home')->first();
        $service = Service::where('parent_id','!=',0)->get();
         $loc_array = [];
         
        $location = Location::where('status',1)->get();
        foreach($location as $loc){
            $l =  [$loc->name,$loc->latitude,$loc->longitude];
    
            array_push($loc_array,$l);
        }
            $loc_array = json_encode(array_values($loc_array));
        
        return view($this->path.'dashboard')->with('cms',$cms)->with('service',$service)->with('loc_array',$loc_array);
    }



    public function step1(Request $request){

        $v = view($this->path.'dashboard_modal.step1')->with('data',$request);

        return response()->json([
            'status' => 1,
            'html' => $v->render()
        ]);
    }

    public function step2(Request $request){
        $v = view($this->path.'dashboard_modal.step2')->with('data',$request);

        return response()->json([
            'status' => 1,
            'html' => $v->render()
        ]);
    }

    public function step3(Request $request){
        if(Auth::user() && Auth::user()->role=='user'){
            $garage = Garage::where('user_id',Auth::user()->id)->get();
            $v = view($this->path.'dashboard_modal.step3')->with('data',$request)->with('garage',$garage);
        }else{
            $car = Car::get();
            $v = view($this->path.'dashboard_modal.step3')->with('data',$request)->with('cars',$car);
        }
                    return response()->json([
                'status' => 1,
                'html' => $v->render()
            ]);    
        
    }

    public function step4(Request $request){
        $v = view($this->path.'dashboard_modal.step4')->with('data',$request);

        return response()->json([
            'status' => 1,
            'html' => $v->render()
        ]);
    }

    public function step5(Request $request){
        $request_time_slot =   $newDate = date("H:i", strtotime($request->time_slot));
        
        $dt = DateTime::createFromFormat("d/m/Y", $request->date);
        $ts = $dt->getTimestamp();        
        $w = date('w', $ts);


        $distance = setting('radius');
        $latitude = $request->lat;
        $longitude = $request->long;
        $vendor_id = Location::whereRaw("( 3956 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) <= $distance")
                ->where('status',1)->pluck('vendor_id')->toArray();



                
                $time_slot = TimeSlot::whereIn('id',$vendor_id)->get();
                        
                $vendor_available = [];

                foreach($time_slot as $ts){
                    $day = $ts->days!=null ? json_decode($ts->days) : [];
                    $time = $ts->time_slot!=null ? json_decode($ts->time_slot) : [];
                                
                    if(in_array($w, $day)!=true && in_array($request_time_slot, $time)==true){
                        array_push($vendor_available,$ts->vendor_id);
                    }else{
                        
                    }
                }
              $location = Location::whereRaw("(3956 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) <= $distance")
                ->where('status',1)->where('vendor_id',$vendor_available)->get();
        
        
        $v = view($this->path.'dashboard_modal.step5')->with('data',$request)->with('location',$location);
        return response()->json([
            'status' => 1,
            'html' => $v->render()
        ]);
    }

    public function coupon_check(Request $request){
        $service_id = json_decode($request->service);
        $c = Coupon::where('code',$request->coupon)->where('status',0);
        if($c->count() > 0){
            $price = UserService::whereIn('service_id',$service_id)->sum('price');
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
                    'discount_price'=>$a_p
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
                    'discount_price'=>$a_p
                    ]);        
            }    
        }else{
            return response()->json([
            'status' => 0,
            'message' => 'Coupon not found.'
            ]);
        }
        //$price = UserService::whereIn('service_id',$request->service)->sum('price');

    }
    public function step6(Request $request){
        $slot = TimeSlot::where('vendor_id',$request->vendor)->first();
        
        $booking = Booking::where('location_id',$request->location_id)->where('vendor',$request->vendor)->where('date',$request->date)->where('time_slot',$request->time_slot);
        if($booking->count() == $slot->slot){
            return response()->json([
            'status' => 0,
            'message' => 'Slot are booked for this time at this location.'
            ]);
        }
        $price = UserService::whereIn('service_id',$request->service)->sum('price');
        $v = view($this->path.'dashboard_modal.step6')->with('data',$request)->with('price',$price);
        return response()->json([
            'status' => 1,
            'html' => $v->render()
        ]);
    }

    public function vendor_service(Request $request,$id){
        $l = Location::where('id',$id)->first();
        $us = UserService::where('user_id',$l->vendor_id)->where('status',1)->where('price','!=','')->get();
        
        $html ='<label  id="service-error"></label><ul class="select-ser-list">';
        foreach($us as $key=>$s){
            $html .='<input name="vendor" type="hidden" value="'.$l->vendor_id.'">';
            $html .='<li>
                                           <div class="select-ser-card">
                                            <label class="ser-chrg">'.$s->service->name.'<span class="badge badge-info ml-4">';
                                            $html .=$s->parent_service($s->service_id) !=null ? $s->parent_service($s->service_id)->name : '';
                                            $html .='</span></label> 
                                            <div class="custom-control custom-checkbox check-without-label">
                                               <input type="checkbox" name="service[]" class="custom-control-input" id="customCheck'.$key.'" required value="'.$s->service_id.'">
                                               <label class="custom-control-label" for="customCheck'.$key.'"></label>
                                            </div>
                                             </div>
                                             <ul class="service-charges-list">
                                               <li><label class="ser-chrg">'.$s->service->name.'</label></li>
                                               <li class="grand-total"><label class="ser-chrg">'.$s->service->name.'</label> <span class="cgr-amt"> USD '.$s->price.'</span></li>
                                             </ul>
                                          </li>';
            }                              
            $html .='</ul>';
        return response()->json([
            'status' => 1,
            'html' => $html
        ]);    
    }
    
    public function schedule_save(Request $request){
        
        $service_id = json_decode($request->service);
        $price = UserService::whereIn('service_id',$service_id)->sum('price');
     Stripe\Stripe::setApiKey(setting('stripe_secret'));
        
        
        if($request->coupon!=null)
        {
         $c = Coupon::where('code',$request->coupon)->where('status',0);
        
        if($c->count() > 0){
            $price = UserService::whereIn('service_id',$service_id)->sum('price');
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
             $coupon_discount=$d;   
            }    
            $coupon = $request->coupon;
        
        $after_coupon =$a_p;
        $charge = Stripe\Charge::create ([
                "amount" => (int)$after_coupon*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Oylerz",
        ]);
        }else{
            return response()->json([
            'status' => 0,
            'message' => 'Coupon not found.'
            ]);
        }
        
         
    }
    else{
        $coupon = '';
        $coupon_discount='';
        $after_coupon ='';
        $charge = Stripe\Charge::create ([
                "amount" => (int)$price*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Oylerz",
        ]);
    }    
        if(Auth::user() && Auth::user()->role=='user'){
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
            
        }else{
            $g = new BGarage();
            $g->year= $request->year;
            $g->make= $request->make;
            $g->model= $request->model;
            $g->trim= $request->trim;
            $g->mileage= $request->mileage;
            $g->save();
        }
        $y =  Carbon::createFromFormat('d/m/Y', $request->date)->format('Y');
        $random = Str::random(10);
        $b = new Booking();
                $b->name = $request->name;
                $b->email = $request->email;
        $b->address1 = $request->address1;
        $b->address= $request->address;
        $b->location_id= $request->location_id;

        $b->latitude= $request->lat;
        $b->longitude= $request->long;
        // $b->address2= $request->address2;
        // $b->city= $request->city;
        // $b->state= $request->state;
        $b->country= $request->country;
        $b->zip_code= $request->pin_code;
        $b->date= $request->date;
        $b->time_slot= $request->time_slot;
        $b->mobile= $request->mobile;
        $b->garage_id = $g->id;
        $b->vendor= $request->vendor;
        $b->price = $price;
        $b->payment ='Stripe';
        $b->charge_id = $charge->id;
        $b->year = $y;
        $b->order_id = $random;    
        $b->coupon = $coupon;
        $b->coupon_discount = $coupon_discount;
        $b->after_coupon = $after_coupon;

        $b->save();
        $b_s = Service::whereIn('id',$service_id)->get();
            foreach($b_s as $key=>$value){
                $bs = new BService();
                $bs->b_id = $b->id;
                $bs->name = $value->name;
                $bs->category_name = $value->parent_service($value->parent_id)->name;
                $bs->price = $value->service_price($value->id,$request->vendor)->price;
                $bs->save();
            }
        //Mail Send Start
        $b = Booking::where('id',$b->id)->first();
            $b_service = BService::where('b_id',$b->id)->get();    
            $b_garage = BGarage::where('id',$b->garage_id)->first();
        $vendor = User::where('id',$request->vendor)->first(); 
        $pdf =  pdf_save($b,$b_service,$b_garage,$random);      
         if(Auth::user() && Auth::user()->role=='user'){
            Mail::to($request->email)->send(new VendorRegisteredBooking($pdf,$b,$b_service,$b_garage));
            Mail::to($vendor->email)->send(new VendorBookingAlert($pdf,$b,$b_service,$b_garage,$vendor));
         }else{
            Mail::to($request->email)->send(new VendorGuestBooking($pdf,$b,$b_service,$b_garage));
            Mail::to($vendor->email)->send(new VendorBookingAlert($pdf,$b,$b_service,$b_garage,$vendor));
         }   
        //Mail Send End    
        $v = view($this->path.'dashboard_modal.thank_you');

        return response()->json([
            'status' => 1,
            'html' => $v->render()
        ]);
    }    

    public function service(){
        $service = Service::where('parent_id','!=',0)->get();
            return view($this->path.'service')->with('service',$service);
    }

    public function contact(){
        $data = CmsPage::where('slug','Contact')->first();
        $loc_array = [];
         
        $location = Location::where('status',1)->get();
        foreach($location as $loc){
            $l =  [$loc->name,$loc->latitude,$loc->longitude];
    
            array_push($loc_array,$l);
        }
            $loc_array = json_encode(array_values($loc_array));
        return view($this->path.'contact.contact')->with('data',$data)->with('loc_array',$loc_array);
    }

    public function contact_save(Request $request){
        $c = new Contact();
        $c->name = $request->name;
        $c->email = $request->email;
        $c->subject = $request->subject;
        $c->message = $request->message;
        $c->save();
        
        Mail::to(setting('admin_mail'))->send(new ContactEmail($request->name,$request->email,$request->subject,$request->message));
        return redirect()->back()->with(['message' => 'Message Send Successfully.', 'message_type' => 'success']);
    }

    public function testemail(){

        $m = Mail::raw('Hello, welcome to Laravel raw without', function ($message) {
  $message
    ->to('t@gmail.com')
    ->subject('Laravel Mail Test');
});
        dd($m);
   //   Mail::to('admin@gg.com')->send(new ContactEmail($request->name,$request->email,$request->subject,$request->message));
    }

    public function store(Request $request){
        $cms = CmsPage::where('slug','Store Near You')->first();
     return view($this->path.'store.store')->with('data',$request)->with('cms',$cms);   
    }

    public function store_search(Request $request){
           $distance = setting('radius');
        $latitude = $request->lat;
        $longitude = $request->long;

        $location = Location::whereRaw("(3956 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) <= $distance")
                ->where('status',1)->get();
                
         $html = '';
         if($location->count() >0){
             foreach($location as $l){
                $html .='<div class="col-lg-4">
                                    <div class="loc-card">
                                      <figure class="loc-img"><img src="'.url($l->banner).'"></figure>
                                       <ul class="loc-info-list">
                                          <li><label>Name</label> <p>'.$l->name.'</p></li>
                                          <li><label>Address</label> <p>'.$l->address.'</p></li>
                                          <li><label>Country</label> <p>'.$l->country.'</p></li>
                                        </ul>
                                    </div>
                                  </div>';
             }      
         }else{
            $html .='<div class="alert alert-danger mt-3" role="alert"><strong>No data found:-</strong> Please search for other location</div>';
         }     
         return $html;
    }

    public function blog(Request $request){
        $blog = Blog::get();
        $cms = CmsPage::where('slug','Blog')->first();
     return view($this->path.'blog')->with('blog',$blog)->with('cms',$cms);   
    }

    public function blog_slug(Request $request,$slug){
        $b = Blog::where('slug',$slug);
        if($b->count() > 0){
            $blog_comment = BlogComment::where('blog_id',$b->first()->id)->get();
            return view($this->path.'blog_single')->with('blog',$b->first())->with('blog_comment',$blog_comment);       
        }
        
    }

    public function blog_comment(Request $request,$id){
        $blog_comment = new BlogComment();
        $blog_comment->blog_id = $id;
        $blog_comment->fname = $request->fname;
        $blog_comment->email = $request->email;
        $blog_comment->comment = $request->comment;
        $blog_comment->save();
        return redirect()->back()->with(['message' => 'Comment Submitted Successfully.', 'message_type' => 'success']);

    }

    public function coupon(Request $request){
        $c = Coupon::where('status',0)->get();
        $cms = CmsPage::where('slug','Coupon')->first();
     return view($this->path.'coupon')->with('c',$c)->with('data',$cms);   
    }

    public function about(){
        $data = CmsPage::where('slug','About')->first();
        return view($this->path.'about.about')->with('data',$data);
    }

    public function blog_subscribe(Request $request){
        $bs = BlogSubscribe::where('email',$request->email);
        if($bs->count() > 0){

        }else{
            $bs = new BlogSubscribe();
            $bs->email = $request->email;
            $bs->save();
        }
        return response()->json([
            'status' => 1,
            'message' => 'Subscribed Successfully.'
        ]);
    }

    public function check(){
          // $client = \TaxJar\Client::withApiKey(setting('tax_jar'));
        $client = \TaxJar\Client::withApiKey(setting('tax_jar'));
   
        $tax = $client->taxForOrder([
  'from_country' => 'US',
  'from_zip' => '07102',
  'from_state' => 'NJ',
  'from_city' => 'Newark',
  'from_street' => '49 Washington St',
  'to_country' => 'US',
  'to_zip' => '07306',
  'to_state' => 'NJ',
  'to_city' => 'Jersey City',
  'to_street' => '54 Journal Square Plaza',
  'amount' => 15,
  'shipping' => 1.5,
  'line_items' => [
    [
      'quantity' => 1,
      'unit_price' => 15
    ]
  ]
]);
          /*$rates = $client->ratesForLocation(90002, [
  'city' => 'LOS ANGELES',
  'country' => 'US'
]);

echo $rates->combined_rate;*/
    }
    
}


