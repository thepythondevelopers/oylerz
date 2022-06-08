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
                    	
                        <form id="profile-update" method="POST" action="{{route('admin.car.update',$blog->id)}}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Year<span class="astrick">*</span></label>
                                    <select name="year" class="form-control">
                                    {!! car_year($blog->year) !!}
                                    </select>
                                </div>
                            </div>
                            
                                
                                
                             <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Make<span class="astrick">*</span></label>
                                    <input type="text" name="make" value="{{$blog->make}}" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Model<span class="astrick">*</span></label>
                                    <input type="text" name="model" value="{{$blog->model}}" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="btn-wrap">
                                    <button type="submit" class="main-btn">Save</button>
                                </div>
                            </div>
                        
                        </form>  
                    
            </div>
                  </div>  
            </div>
        </div>
@stop        

@section('scripts')

<script type="text/javascript">
    jQuery("form[id='profile-update']").validate({
    rules: {
    'year': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:255   
      },
      'make': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:255   
      },
      'model': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:255   
      }
    },  
});



</script>
@endsection