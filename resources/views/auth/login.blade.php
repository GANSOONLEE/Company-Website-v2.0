
@extends('auth.layouts.app')

@section('title', __('Login'))

@section('app')

    <!-- form -->
    <img class="background-image" src="{{ asset('image/frozen air cond.webp') }}" alt="">
    
    <div class="container">
        <a href="{{ route('frontend.home') }}"><img class="form-header-logo" src="{{asset('image/logo.webp')}}" alt="">
        </a>
        <form action="{{ route('auth.login.post') }}" class="form" id="form" method="POST">
            @csrf
            <!-- Header -->
            <!-- Title -->
            <div class="form-header">
                <p class="form-header-title">Login</p>
                <p class="register-text">
                    Haven't any account?
                    <a href="{{ route('auth.register') }}">Register</a>
                </p>
                
            </div>
            
            <!-- Body -->
            <!-- input area -->
            <div class="form-body">
                @include('auth.forms.login-form')
            </div>
    
            <!-- Footer -->
            <!-- already have account -->
            {{-- <div class="form-footer flex-row">
                <p class="register-text">Haven't any account?</p><a href="{{ route('auth.register') }}">Register</a>
            </div> --}}
    
        </form>
    </div>

@endsection

@push('before-body')
    <link rel="preload stylesheet" as="style" href="{{ asset('css\auth\login.css') }}">
@endpush

@push('after-body')
    <script defer src="{{ asset('js\auth\login.js') }}"></script>
@endpush