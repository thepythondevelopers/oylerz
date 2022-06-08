<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Setting;
use App\Models\Booking;
use App\Models\BService;
use App\Models\BGarage;
use Auth;
class SettingController extends Controller
{
    public $path ='admin.modules.setting.';

    public function index(){
        return view($this->path.'index');
    }

    public function save(Request $request){
        foreach ($request->input() as $key => $value) {

            $s = Setting::where('name',$key);
            if($s->count() > 0){
                $s = $s->first();
                $s->value = $value;
                $s->save();    
            }
            
        }
        return redirect()->back()->with(['message' => 'Successfully Updated', 'message_type' => 'success']);
    }
}    