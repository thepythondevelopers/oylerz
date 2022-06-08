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
                                    <label class="form-label">Section 1</label>
                                    <textarea class="form-control" name="description" autocomplete="off" >{{$cms->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Section 2 Title</label>
                                    <input type="text" class="form-control" name="description1" autocomplete="off" value="{{$cms->description1}}">
                                    
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Section 3 Title</label>
                                    <input type="text" class="form-control" name="description2" autocomplete="off" value="{{$cms->description2}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Section 4</label>
                                    <textarea id="description3" class="form-control" name="description3" autocomplete="off">{{$cms->description3}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Section 5 Title</label>
                                    <input type="text" class="form-control" name="description4" autocomplete="off" value="{{$cms->description4}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Copy Right</label>
                                    <input type="text" class="form-control" name="description5" autocomplete="off" value="{{$cms->description5}}">
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
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'description3', {
   allowedContent:true,
} );

</script>
@endsection