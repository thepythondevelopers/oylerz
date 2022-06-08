@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">CMS Page </h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">CMS Page</h3>
                        </div>
                    <div class="csm-body">
                    <form id="profile-update" method="POST" action="{{route('admin.cms.update',$cms->id)}}">    
                        {{ csrf_field() }}
                        <div class="row">
                            
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">How'z Section</label>
                                    <textarea class="form-control" name="description1" autocomplete="off" >{{$cms->description1}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Service Section</label>
                                    <textarea class="form-control" name="description2" autocomplete="off" >{{$cms->description2}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <textarea class="form-control" name="meta_title" autocomplete="off" >{{$cms->meta_title}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Keyword</label>
                                    <textarea class="form-control" name="meta_keywords" autocomplete="off" >{{$cms->meta_keywords}}</textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" autocomplete="off" >{{$cms->meta_description}}</textarea>
                                </div>
                            </div>
    
                            
                            
                            <div class="col-lg-12">
                                <div class="btn-wrap">
                                    <button type="submit" class="main-btn">Update</button>
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
    
    CKEDITOR.replace( 'description1', {   allowedContent:true} );
    CKEDITOR.replace( 'description2', {   allowedContent:true} );
    

</script>
@endsection