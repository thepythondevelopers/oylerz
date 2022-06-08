@extends('admin.layouts.layout')

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
                    <form id="profile-update" method="POST" action="{{route('admin.profile.update',$user->id)}}">    
                        <input type="hidden" name="" id="email-check" data-action="{{route('admin.profile.email.check.edit',$user->id)}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Full Name<span class="astrick">*</span></label>
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
                                    <input type="text" name="email" class="form-control" value="{{$user->email}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Password<span class="astrick">*</span></label>
                                    <input type="password" name="password" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Service Address<span class="astrick">*</span></label>
                                    <textarea class="form-control" name="service_address" autocomplete="off" >{{$user->service_address}}</textarea>
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
                                    <input type="text" name="zip_code" class="form-control" autocomplete="off" value="{{$user->zip_code}}">
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
    var $emailTseturl = $("body").find("#email-check").attr('data-action');
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
      'email': 
      {
        required: true, 
        nowhitespace: true,
        customemail:true,
                            remote: {
                          url: $emailTseturl,
                          type: "get"
            }
      },
      'service_address':{
        required: true, 
        nowhitespace: true,
      },
      'billing_address':{
        required: true, 
        nowhitespace: true,
      },
      'password':{
        nowhitespace: true,
        minlength:8,
      }
    }, 
    messages: {
        email: {
            remote: "Email already used!"
        } 
    }, 
});
</script>
@stop