<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Redirect;
use Str;
use File;
class CouponController extends Controller
{
    public $path ='admin.modules.coupon.';
    
    public function index(){
        $coupon = Coupon::where('status',0)->get();
        return view($this->path.'index')->with('coupon',$coupon);
    }

    public function add(){
        return view($this->path.'add');
    }

       public function save(Request $request){
        if($request->type==1 && $request->discount>=100){
            return redirect()->back()->with(['message' => 'Discount Should be less than 100 %.', 'message_type' => 'error']);
        }
        $c = new Coupon();
        $random = Str::random(10);
        $c->code =$random;
        $c->title = $request->title;
        $c->description = $request->description;
        $c->discount = $request->discount;
        $c->type = $request->type;
        $c->save();
        return redirect()->route('admin.coupon')->with(['message' => 'Coupon Saved Successfully.', 'message_type' => 'success']);
    }

    public function edit($id){
        $c = Coupon::where('id',$id);
        if($c->count() > 0){
              $coupon = $c->first();
        return view($this->path.'edit')->with('coupon',$coupon);
        }else{
            return redirect()->route('admin.coupon');       
        }
    }

    public function update(Request $request,$id){
        $c = Coupon::where('id',$id);
        if($c->count() > 0){
            if($request->type==1 && $request->discount>=100){
            return redirect()->back()->with(['message' => 'Discount Should be less than 100 %.', 'message_type' => 'error']);
        }
        $c = $c->first();
        $c->title = $request->title;
        $c->description = $request->description;
         $c->discount = $request->discount;
         $c->type = $request->type;
        $c->save();
      
     return redirect()->route('admin.coupon')->with(['message' => 'Coupon Updated Successfully.', 'message_type' => 'success']);
    }else{
        return redirect()->route('admin.coupon'); 
    }
    }

    public function view($id){
        $c = Coupon::where('id',$id);
        if($c->count() > 0){
              $coupon = $c->first();
        return view($this->path.'view')->with('coupon',$coupon);
        }else{
            return redirect()->route('admin.coupon');       
        }
    }

    function delete(Request $request,$id){
        $user = Coupon::where('id',$id)->update(['status',1]);
        return back()->with(['message' => 'Successfully Deleted Coupon', 'message_type' => 'success']);
    }

    function bulk_delete(Request $request){
        $ids = explode(',', $request->ids);
        $user = Blog::whereIn('id',$ids)->update(['status',1]);
        return back()->with(['message' => 'Successfully Deleted Coupon', 'message_type' => 'success']);
    }
}        