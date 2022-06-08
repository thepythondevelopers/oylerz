@extends('layouts.app')

@section('content')
<section class="login-screen" style="background-image: url('{{asset('frontend/images/banner-img.png')}}');">
    <a href="{{route('dashboard')}}" class="logo-img mb-5"><img src="{{asset('backend/images/logo.png')}}"></a>
</section>
<div class="login-card">
<h3 class="log-title mb-4">{{ __('Reset Password') }}</h3>
               

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>                        
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                    </div>
                       <div class="col-md-12">
                        <div class="form-group mb-0">
                            <div class=" btn-wrap text-center">
                                <button type="submit" class="oylerz-btn primary-btn">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
               
           
       


</div>
@endsection
