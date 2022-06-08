@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
           
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Blog</h3>
                        </div>
                    <div class="csm-body">
                    	
                        <form id="profile-update" method="POST" action="{{route('admin.blog.save')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Title<span class="astrick">*</span></label>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control" autocomplete="off">
                                    @if ($errors->has('title'))
            <label class=" label error" role="alert">
                {{ $errors->first('title') }}
            </label>
        @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                             <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" autocomplete="off" >{{old('description')}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <textarea class="form-control" name="meta_title" autocomplete="off" >{{old('meta_title')}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Keyword</label>
                                    <textarea class="form-control" name="meta_keywords" autocomplete="off" >{{old('meta_keywords')}}</textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" autocomplete="off" >{{old('meta_description')}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="btn-wrap">
                                    <button type="submit" class="main-btn">Save</button>
                                </div>
                            </div>
                        </div>
                        </form>  
                    
            </div>
                  </div>  
            </div>
        </div>
@stop        

@section('scripts')
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    jQuery("form[id='profile-update']").validate({
    rules: {
    'title': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:255   
      },
      'image': 
      {
        extension: "jpg|jpeg|png" 
      }
    },  
});



    CKEDITOR.replace( 'description' );


</script>
@endsection