@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">Setting </h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">Setting</h3>
                        </div>
                    <div class="csm-body">
                        <form id="setting-update" method="POST" action="{{route('admin.setting.save')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Stripe Key<span class="astrick">*</span></label>
                                    <input type="text" name="stripe_key" value="{{setting('stripe_key')}}" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Stripe Secret<span class="astrick">*</span></label>
                                    <input type="text" name="stripe_secret" value="{{setting('stripe_secret')}}" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Google Maps Key<span class="astrick">*</span></label>
                                    <input type="text" name="google_maps_key" value="{{setting('google_maps_key')}}" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Radius (in Km)<span class="astrick">*</span></label>
                                    <input type="text" name="radius" value="{{setting('radius')}}" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Admin Mail<span class="astrick">*</span></label>
                                    <input type="text" name="admin_mail" value="{{setting('admin_mail')}}" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Tax Jar<span class="astrick">*</span></label>
                                    <input type="text" name="tax_jar" value="{{setting('tax_jar')}}" class="form-control" autocomplete="off">
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
<script type="text/javascript">
    jQuery("form[id='setting-update']").validate({
    rules: {
    'stripe_key': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:255   
      },
      'stripe_secret': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:255
      },
      'google_maps_key': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:255
      },
      'admin_mail':{
        required: true, 
        nowhitespace: true,
        customemail:true
      },
      'radius':{
        required: true, 
        nowhitespace: true,
      },
     'tax_jar':{
        required: true, 
        nowhitespace: true,
     },

     
    },  
});
</script>
@endsection