<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Redirect;
class ServiceController extends Controller
{
    public $path ='admin.modules.services.';
    
    public function index(){
        $service = Service::where('parent_id',0)->orderby('id','desc')->get();
        return view($this->path.'index')->with('service',$service);
    }

    public function save(Request $request){
        $s = new Service();
        $s->name = $request->name;
        $s->description = $request->description;
        if(isset($request->parent_id)){
            $s->parent_id = $request->parent_id;
        }
        $s->save();
        $status = [
               'success' => true,
               'message' => 'Service Saved Successfully.'
            ];

        return response()->json($status);      
    }

    public function view($id){
        $service = Service::where('id',$id)->first();
        $sub_service = Service::where('parent_id',$id);
        return view($this->path.'view')->with('service',$service)->with('sub_service',$sub_service);
    }

    public function edit($id){
        $service = Service::where('id',$id)->first();
        $sub_service = Service::where('parent_id',$id);
        return view($this->path.'edit')->with('service',$service)->with('sub_service',$sub_service);
    }

    public function update(Request $request,$id){
        $service = Service::where('id',$id)->first();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->save(); 
        return Redirect::route('admin.services')->with(['message' => 'Successfully Updated Service', 'message_type' => 'success']);
    }

    public function sub_edit($id){
        $service = Service::where('id',$id)->first();
        $vv = view($this->path.'edit_sub_service')->with('service',$service);

        $status = [
          'status' => 1,
          'html' => $vv->render()
      ];
      return response()->json($status);  
    }

    public function sub_update(Request $request,$id){
        $service = Service::where('id',$id)->first();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->save(); 
        $status = [
               'success' => true,
               'message' => 'Sub Service Updated Successfully.'
            ];

        return response()->json($status);      
    }

    public function sub_delete($id){
        Service::where('id',$id)->delete();
        $status = [
               'success' => true,
               'message' => 'Sub Service Deleted Successfully.'
            ];

        return response()->json($status);  
    }

    function delete(Request $request,$id){
        $service = Service::where('id',$id)->delete();
        return back()->with(['message' => 'Successfully Deleted Service', 'message_type' => 'success']);
    }

    function bulk_delete(Request $request){
        $ids = explode(',', $request->ids);
        $service = Service::whereIn('id',$ids)->delete();
        return back()->with(['message' => 'Successfully Deleted Services', 'message_type' => 'success']);
    }

    
}
