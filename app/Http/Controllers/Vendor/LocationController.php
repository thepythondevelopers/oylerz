<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\User;
use File;
use Auth;
use Str;
class LocationController extends Controller
{
    public $path ='vendor.modules.location.';
    
    public function index()
    {
        $location = Location::where('vendor_id',Auth::user()->id)->get();
        return view($this->path.'index')->with('location',$location);
    }

    public function save(Request $request){
        $l = new Location();
        $l->vendor_id = Auth::user()->id;
        $l->name = $request->name;
        $l->address = $request->location_name;
        $l->country = $request->country;
        $l->status = $request->status;
        $l->postal_code = $request->pin_code;
        $l->longitude = $request->long;
        $l->latitude = $request->lat;
        $l->phone_number = $request->phone_number;
        $img_path = 'images/location_banner/';
        $time = strtotime('now').Str::random(40);
        $ext = $request->banner->getClientOriginalExtension();
        $image = $time.".".$ext;
        $request->banner->move(public_path('images/location_banner'),$image);

        $image = $img_path.$image;    
        $l->banner = $image;
        
        $l->save();
        return response()->json([
            'success' => true,
            'message' => 'Location Save Successfully.'
            ]);
    }

    public function view($id)
    {
        $location = Location::where('vendor_id',Auth::user()->id)->where('id',$id)->first();
        return view($this->path.'view')->with('location',$location);
    }

    public function edit($id)
    {
        $location = Location::where('vendor_id',Auth::user()->id)->where('id',$id)->first();
        return view($this->path.'edit')->with('location',$location);
    }

    public function update(Request $request,$id){
        $l = Location::where('id',$id)->where('vendor_id',Auth::user()->id)->first();
        $l->vendor_id = Auth::user()->id;
        $l->name = $request->name;
        $l->address = $request->location_name;
        $l->country = $request->country;
        $l->status = $request->status;
        $l->postal_code = $request->pin_code;
        $l->longitude = $request->long;
        $l->latitude = $request->lat;
        $l->phone_number = $request->phone_number;
        if($request->banner !=null){
            $path = public_path($l->banner);
            if(File::exists($path)){
                unlink($path);
            } 
        $img_path = 'images/location_banner/';
        $time = strtotime('now').Str::random(40);
        $ext = $request->banner->getClientOriginalExtension();
        $image = $time.".".$ext;
        $request->banner->move(public_path('images/location_banner'),$image);

        $image = $img_path.$image;    
        $l->banner = $image;
        }
        $l->save();
        return redirect()->route('vendor.location')->with(['message' => 'Location Updated Successfully.', 'message_type' => 'success']);
    }



    

    
}
