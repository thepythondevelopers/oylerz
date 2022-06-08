@extends('admin.layouts.layout')

@section('content')
<div class="content-wrap">
            <div class="content-head mb-4 d-f j-c-s-b a-i-c">
                <h3 class="page-title">User Profile </h3>
            </div>
            <div class="content-body">
                <div class="csm-card">
                    <div class="csm-card-head a-i-c d-f j-c-s-b">
                            <h3 class="csm-title">User Profile</h3>
                        </div>
                    <div class="csm-body">

                        <div class="profile-card">
                            <figure class="profile_bg" style="background-image: url('{{asset('frontend/images/banner-img.png')}}');">                    
                            </figure>
                            <span class="profile_img"><img src="{{$user->avatar !=null ? asset($user->avatar) : asset('backend/images/user.png')}}"></span>
                            <div class="profile_information">
                                <h3 class="pro_name">{{$user->name}}</h3>
                                <ul class="profile-info">
                                    <li><label class="pro-label">Mobile</label><p>{{$user->mobile}}</p></li>
                                    <li><label class="pro-label">Email Id</label><p>{{$user->email}}</p></li>
                                    <li><label class="pro-label">Service Address</label><p>{{$user->service_address}}</p></li>
                                    <li><label class="pro-label">Billing Address</label><p>{{$user->billing_address}}</p></li>
                                    <li><label class="pro-label">Zip Code</label><p>{{$user->zip_code}}</p></li>
                                    <li><label class="pro-label">Status</label><div class="switch-button switch-button-success switch-button-lg">
                                        <input type="checkbox" class="custom-control-input" name="status" id="status" @if($user->status==1) checked @endif>
                                       <span><label for="status"></label></span>
                                     </div></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="btn-wrap d-f mt-2">
                                    <a href="{{route('admin.profiles')}}" class="main-btn">Back</a>
                                    
                                </div>
                            </div>
                        </div>
                         
                    </div>
                  </div>  
            </div>
        </div>
@stop        

@section('scripts')
<script type="text/javascript">
     $('#status').change(function () {
        val = $(this).is(':checked') ? 1 : 0;
        checkbox_change(val);
  });
function checkbox_change(val){
     $.ajax({
                url : "{{route('admin.profile.status',$user->id)}}",
                type: 'POST',  
                data:{status : val},     
                dataTYPE:'JSON',
                headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').val()
                },
                beforeSend: function() {                         
                },
                success: function (data) {                                   
                  if(data.success==true){
                    toastr.success(data.message);
                   }
                },
                complete: function(result) {
                },
                error: function (jqXhr, textStatus, errorMessage) {
                     
                }

        });
 }    
</script>
@endsection