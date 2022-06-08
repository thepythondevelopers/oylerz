@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
           
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Coupon</h3>
                        </div>
                    <div class="csm-body">
                    	
                        <form id="coupon-add" method="POST" action="{{route('admin.coupon.save')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Title<span class="astrick">*</span></label>
                                    <input type="text" name="title" value="" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Discount<span class="astrick">*</span></label>
                                    <input type="text" name="discount" class="form-control">
                                </div>
                            </div>
                             <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Description<span class="astrick">*</span></label>
                                    <textarea class="form-control" name="description" autocomplete="off" ></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Type<span class="astrick">*</span></label>
                                    <select class="form-control" name="type">
                                        <option value="0">Fixed</option>
                                        <option value="1">Percentage</option>
                                    </select>
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
    jQuery("form[id='coupon-add']").validate({
    rules: {
    'title': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:255   
      },
      'discount': 
      {
        required: true, 
        nowhitespace: true,
        digits:true,
        maxlength:3    
      },
      'description':{
        required: true, 
        nowhitespace: true
      }
    },  
});



    CKEDITOR.replace( 'description' );


</script>
@endsection