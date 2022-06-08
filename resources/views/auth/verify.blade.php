@extends('layouts.app')

@section('content')
<section class="login-screen" style="background-image: url('{{asset('frontend/images/banner-img.png')}}');">
    <a href="javascript:void(0);" class="logo-img mb-5"><img src="{{asset('backend/images/logo.png')}}"></a>
</section>
<div class="login-card">
                <h3 class="log-title mb-4">{{ __('Verify Your Email Address') }}</h3>

               
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>

@endsection
