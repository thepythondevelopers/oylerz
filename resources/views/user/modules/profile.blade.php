@extends('user.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">User Profile </h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head d-f j-c-s-b">
                            <h3 class="csm-title">User Profile</h3>
                        </div>
                    <div class="csm-body">
                        <form id="profile-update" method="POST" action="{{route('user.profile.save')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Name<span class="astrick">*</span></label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Mobile<span class="astrick">*</span></label>
                                    <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Email Id<span class="astrick">*</span></label>
                                    <input type="text" name="" value="{{$user->email}}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Service Address<span class="astrick">*</span></label>
                                    <textarea class="form-control" name="service_address" autocomplete="off">{{$user->service_address}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Billing Address<span class="astrick">*</span></label>
                                    <textarea class="form-control" name="billing_address" autocomplete="off">{{$user->billing_address}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Zip Code<span class="astrick">*</span></label>
                                    <input type="text" name="zip_code" class="form-control" value="{{$user->zip_code}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Avatar</label>
                                    <input type="file" name="avatar" class="form-control">
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
<script type="text/javascript">
    jQuery("form[id='profile-update']").validate({
    rules: {
    'name': 
      {
        required: true, 
        nowhitespace: true,
        maxlength:35   
      },
      'mobile': 
      {
        required: true, 
        nowhitespace: true,
        digits:true,
        minlength:10,
        maxlength:10
      },
      'service_address': 
      {
        required: true, 
        nowhitespace: true, 
      },
      'billing_address': 
      {
        required: true, 
        nowhitespace: true,
      },
      'zip_code': 
      {
        required: true, 
        nowhitespace: true,
      },
      'avatar': 
      {
        extension: "jpg|jpeg|png" 
      }
    },  
});
</script>
@endsection