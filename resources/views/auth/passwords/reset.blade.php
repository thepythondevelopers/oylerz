@extends('layouts.app')

@section('content')
<section class="login-screen" style="background-image: url('{{asset('frontend/images/banner-img.png')}}');">
    <a href="{{route('dashboard')}}" class="logo-img mb-5"><img src="{{asset('backend/images/logo.png')}}"></a>
</section>
<div class="login-card">
                 <h3 class="log-title mb-4">{{ __('Reset Password') }}</h3>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>

                          
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                           
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        
                        </div>

                        <div class="form-group  mb-0">
                            <div class="btn-wrap">
                                <button type="submit" class="oylerz-btn primary-btn">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection
