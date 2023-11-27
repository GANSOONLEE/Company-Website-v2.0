
@extends('auth.layouts.app')

@section('title', __('Register'))

@section('app')

    <img class="background-image" src="{{ asset('image/frozen air cond.webp') }}" alt="">

    <div class="container">

        <!-- form -->
        <form action="{{ route('auth.register.post') }}" class="form" id="form" method="POST">
            @csrf
            <!-- Header -->
            <!-- Title -->
            <div class="form-header">
                <p class="form-header-title">Register</p>
                <p class="login-text">
                    Already have account?
                    <a href="{{ route('auth.login') }}">Login</a>
                </p>
            </div>
            
            <!-- Body -->
            <!-- input area -->
            <div class="form-body">
                
                @include('auth.forms.register-form')

            </div>
        </form>

        <a href="{{ route('frontend.home') }}">
            <img class="form-header-logo" src="{{asset('image/logo.webp')}}" alt="" width="484" height="199">
        </a>
    
    </div>


@endsection

@push('before-body')
    <link rel="preload stylesheet" href="{{ asset('css\auth\register.css') }}">
@endpush

@push('after-body')
    <script defer src="{{ asset('js\auth\register.js') }}"></script>
@endpush