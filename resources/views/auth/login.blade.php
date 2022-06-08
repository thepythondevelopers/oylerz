@extends('layouts.app')

@section('content')
<section class="login-screen" style="background-image: url('{{asset('frontend/images/banner-img.png')}}');">
    <a href="javascript:void(0);" class="logo-img mb-5"><img src="{{asset('backend/images/logo.png')}}"></a>
</section>

            <div class="login-card">
                @if(session('success'))
                    <div class="alert alert-danger fade in alert-dismissible show">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size:20px">×</span>
                          </button>{{session('success')}}
                        </div>
                @endif
                <h3 class="log-title mb-4">{{ __('Login') }}</h3>
                
                    <form class="login-Form" method="POST" action="{{ route('login') }}" id="login-Form">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         </div>

                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="form-group d-f j-c-s-b a-i-c">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>  
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif                      
                        </div>

                        <div class="form-group mt-3 text-center mb-0">
                                <button type="submit" class="oylerz-btn primary-btn">
                                    {{ __('Login') }}
                                </button>

                                
                            
                        </div>
                    </form>
            </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".alert-dismissible .close").click(function(){
          $(this).parent().remove();
        });
            jQuery("form[id='login-Form']").validate({

    rules: {

      
      'email': 
      {
        required: true, 
        nowhitespace: true,
        customemail:true,
      },
      'password':{
        required: true, 
        nowhitespace: true,
        minlength:8,
      }
    },
        submitHandler: function(form) {
          form.submit();
    
    } 
});
</script>
@stop