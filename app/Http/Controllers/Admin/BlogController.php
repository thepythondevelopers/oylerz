<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Redirect;
use Str;
use File;
class BlogController extends Controller
{
    public $path ='admin.modules.blog.';
    
    public function index(){
        $blog = Blog::get();
        return view($this->path.'index')->with('blog',$blog);
    }

    public function add(){
        return view($this->path.'add');
    }

       public function save(Request $request){
        $this->validate($request,[
                    'title' => 'required|unique:blogs|max:255',
             ]);
        $slug = str_replace(' ', '_', strtolower($request->title));
        $b = new Blog();
        $b->title = $request->title;
        $b->description = $request->description;
        $b->slug = $slug;
        
      if($request->image !=null){
        
        $img_path = 'images/blog/';
        $time = strtotime('now').Str::random(40);
        $ext = $request->image->getClientOriginalExtension();
        $image = $time.".".$ext;
        $request->image->move(public_path('images/blog'),$image);

        $image = $img_path.$image;    
        $b->image = $image;

        
     }
     $b->meta_title = $request->meta_title;
        $b->meta_keywords = $request->meta_keywords;
        $b->meta_description = $request->meta_description;
     $b->save();
     return redirect()->route('admin.blog')->with(['message' => 'Blog Saved Successfully.', 'message_type' => 'success']);
    }

    public function edit($id){
                
        $b = Blog::where('id',$id);
        if($b->count() > 0){
              $blog = $b->first();
        return view($this->path.'edit')->with('blog',$blog);
        }else{
            return redirect()->route('admin.blog');       
        }
    }

    public function update(Request $request,$id){
        $this->validate($request,[
                    'title' => 'required|max:255|unique:blogs,title,'. $id,
             ]);
        $slug = str_replace(' ', '_', strtolower($request->title));
        $b = Blog::where('id',$id);
        if($b->count() > 0){
        $b = $b->first();
        $b->title = $request->title;
        $b->slug = $slug;
        $b->description = $request->description;

      if($request->image !=null){
        $path = public_path($b->image);
        if($b->image!=''){
            if(File::exists($path)){
                unlink($path);
            }  
         }   
        $img_path = 'images/blog/';
        $time = strtotime('now').Str::random(40);
        $ext = $request->image->getClientOriginalExtension();
        $image = $time.".".$ext;
        $request->image->move(public_path('images/blog'),$image);

        $image = $img_path.$image;    
        $b->image = $image;

        
     }
     $b->meta_title = $request->meta_title;
        $b->meta_keywords = $request->meta_keywords;
        $b->meta_description = $request->meta_description;
     $b->save();
     return redirect()->route('admin.blog')->with(['message' => 'Blog Updated Successfully.', 'message_type' => 'success']);
    }else{
        return redirect()->route('admin.blog'); 
    }
    }

    public function view($id){
        $b = Blog::where('id',$id);
        if($b->count() > 0){
              $blog = $b->first();
        return view($this->path.'view')->with('blog',$blog);
        }else{
            return redirect()->route('admin.blog');       
        }
    }

    function delete(Request $request,$id){
        $user = Blog::where('id',$id)->delete();
        return back()->with(['message' => 'Successfully Deleted Blog', 'message_type' => 'success']);
    }

    function bulk_delete(Request $request){
        $ids = explode(',', $request->ids);
        $user = Blog::whereIn('id',$ids)->delete();
        return back()->with(['message' => 'Successfully Deleted Blog', 'message_type' => 'success']);
    }
}        