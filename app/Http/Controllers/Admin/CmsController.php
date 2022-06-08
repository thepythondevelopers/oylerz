<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Redirect;

class CmsController extends Controller
{
    public $path ='admin.modules.cms.';

    public function index(){
        $cms = CmsPage::get();
        return view($this->path.'index')->with('cms',$cms);
    }

    public function edit($id){
        $cms = CmsPage::where('id',$id)->first();
        if($cms->slug=='About'){
            return view($this->path.'about_edit')->with('cms',$cms);    
        }
        if($cms->slug=='Footer'){
            return view($this->path.'footer_edit')->with('cms',$cms);    
        }
        if($cms->slug=='Home'){
            return view($this->path.'home_edit')->with('cms',$cms);    
        }
        if($cms->slug=='Under Map'){
            return view($this->path.'under_map')->with('cms',$cms);    
        }

        if($cms->slug=='Blog'){
            return view($this->path.'blog')->with('cms',$cms);    
        }

        if($cms->slug=='Coupon'){
            return view($this->path.'coupon')->with('cms',$cms);    
        }

        if($cms->slug=='Store Near You'){
            return view($this->path.'store_near_you')->with('cms',$cms);    
        }
        return view($this->path.'edit')->with('cms',$cms);
    }

    public function update(Request $request,$id){
        $cms = CmsPage::where('id',$id)->first();
        $cms->title = $request->title;
        $cms->description = $request->description;
        $cms->description1 = $request->description1;
        $cms->description2 = $request->description2;
        $cms->description3 = $request->description3;
        $cms->description4 = $request->description4;
        $cms->description5 = $request->description5;

        $cms->meta_title = $request->meta_title;
        $cms->meta_keywords = $request->meta_keywords;
        $cms->meta_description = $request->meta_description;
        
        $cms->save();
        return Redirect::route('admin.cms')->with(['message' => 'Successfully Saved.', 'message_type' => 'success']);
    }
}    