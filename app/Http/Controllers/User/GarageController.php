<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Garage;
use Auth;
class GarageController extends Controller
{
    public $path ='user.modules.garage.';
    
    public function index()
    {
        $garage = Garage::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view($this->path.'index')->with('garage',$garage);
    }

    public function add(){
        return view($this->path.'add');   
    }

    public function save(Request $request){
        $g = new Garage();
        $g->user_id = Auth::user()->id;
        $g->name = $request->name;
        $g->year = $request->year;
        $g->make = $request->make;
        $g->model = $request->model;
        $g->trim = $request->trim;
        $g->mileage = $request->mileage;
        $g->save();
        return redirect()->route('user.garage')->with(['message' => 'Successfully Saved', 'message_type' => 'success']);      

    }

    public function edit($id){
        $garage = Garage::where('user_id',Auth::user()->id)->where('id',$id)->first();
        return view($this->path.'edit')->with('garage',$garage);   
    }

    public function update(Request $request,$id){
        $g = Garage::where('user_id',Auth::user()->id)->where('id',$id)->first();
        $g->name = $request->name;
        $g->year = $request->year;
        $g->make = $request->make;
        $g->model = $request->model;
        $g->trim = $request->trim;
        $g->mileage = $request->mileage;
        $g->save();
        return redirect()->route('user.garage')->with(['message' => 'Successfully Updated', 'message_type' => 'success']);        
    }

    function delete(Request $request,$id){
        $user = Garage::where('id',$id)->delete();
        return back()->with(['message' => 'Successfully Deleted Garage', 'message_type' => 'success']);
    }

    function bulk_delete(Request $request){
        $ids = explode(',', $request->ids);
        $user = Garage::whereIn('id',$ids)->delete();
        return back()->with(['message' => 'Successfully Deleted Garage', 'message_type' => 'success']);
    }

    function view($id){
        $garage = Garage::where('user_id',Auth::user()->id)->where('id',$id)->first();
        return view($this->path.'view')->with('g',$garage);      
    }

    
}
