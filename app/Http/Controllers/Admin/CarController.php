<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use Redirect;
use Str;
use File;
class CarController extends Controller
{
    public $path ='admin.modules.cars.';
    
    public function index(){
        $car = Car::get();
        return view($this->path.'index')->with('car',$car);
    }

    public function add(){
        return view($this->path.'add');
    }

       public function save(Request $request){
        
        $b = new Car();
        $b->year = $request->year;
        $b->model = $request->model;
        $b->make = $request->make;
        
     $b->save();
     return redirect()->route('admin.car')->with(['message' => 'Car Saved Successfully.', 'message_type' => 'success']);
    }

    public function edit($id){
                
        $b = Car::where('id',$id);
        if($b->count() > 0){
              $blog = $b->first();
        return view($this->path.'edit')->with('blog',$blog);
        }else{
            return redirect()->route('admin.car');       
        }
    }

    public function update(Request $request,$id){
        
        $b = Car::where('id',$id);
        if($b->count() > 0){
        $b = $b->first();
        $b->year = $request->year;
        $b->model = $request->model;
        $b->make = $request->make;
     
     $b->save();
     return redirect()->route('admin.car')->with(['message' => 'Car Updated Successfully.', 'message_type' => 'success']);
    }else{
        return redirect()->route('admin.car'); 
    }
    }

    public function view($id){
        $b = Car::where('id',$id);
        if($b->count() > 0){
              $car = $b->first();
        return view($this->path.'view')->with('car',$car);
        }else{
            return redirect()->route('admin.blog');       
        }
    }

    function delete(Request $request,$id){
        $user = Car::where('id',$id)->delete();
        return back()->with(['message' => 'Successfully Deleted Car', 'message_type' => 'success']);
    }

    function bulk_delete(Request $request){
        $ids = explode(',', $request->ids);
        $user = Car::whereIn('id',$ids)->delete();
        return back()->with(['message' => 'Successfully Deleted Car', 'message_type' => 'success']);
    }
}        