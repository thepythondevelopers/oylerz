@extends('layouts.app')

@section('content')
<section class="login-screen" style="background-image: url('{{asset('frontend/images/banner-img.png')}}');">
    <a href="{{route('dashboard')}}" class="logo-img mb-5"><img src="{{asset('backend/images/logo.png')}}"></a>
</section>


            <div class="login-card register--card mb-4">
                @if(session('success'))
                    <div class="alert alert-danger fade in alert-dismissible show">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size:20px">×</span>
                          </button>{{session('success')}}
                        </div>
                @endif
                <h3 class="log-title mb-4">{{ __('Register') }}</h3>
                    <form id="profile-create" method="POST" action="{{ route('register') }}" >
                        <input type="hidden" name="" id="email-check" data-action="{{route('admin.profile.email.check')}}">
                        @csrf
                      <div class="row">
                        <div class="col-lg-4">
                        <div class="form-group ">
                            <label for="name" class="form-label">{{ __('Name') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name"   autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="form-group ">
                            <label for="number" class="form-label">Mobile</label>

                                <input id="number" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}"  autocomplete="off">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                     <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="number" class="form-label">Service Address</label>
                                <textarea  class="form-control @error('service_address') is-invalid @enderror" name="service_address" value="{{ old('service_address') }}"  autocomplete="off"></textarea>
                                @error('service_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                     </div>
                       <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="number" class="form-label">Billing Address</label>
                                <textarea  class="form-control @error('billing_address') is-invalid @enderror" name="billing_address" value="{{ old('billing_address') }}"  autocomplete="off"></textarea>

                                @error('billing_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                     <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="password" class="form-label">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group ">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>    
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>
                        
                      <div class="col-lg-12">
                        <div class="form-group text-center mb-0 mt-4 text-center">
                                <button type="submit" class="oylerz-btn primary-btn">
                                    {{ __('Register') }}
                                </button>
                        </div>
                    </div>
                </div>
                    </form>
                
            </div>

@endsection

@section('scripts')
<script type="text/javascript">
    var $emailTseturl = $("body").find("#email-check").attr('data-action');
            jQuery("form[id='profile-create']").validate({

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
        required: true, 
        nowhitespace: true,
        minlength:8,
      },
    'password_confirmation' : {
                    minlength : 5,
                    equalTo : "#password"
                }
    }, 
    messages: {
        email: {
            remote: "Email already used!"
        } 
    },
        submitHandler: function(form) {
          form.submit();
    
    } 
});
</script>
@stop