
@extends('auth.layouts.app')

@section('title', __('Register'))

@section('app')

    <!-- form -->
    <form action="{{ route('auth.register.post') }}" class="form" id="form" method="POST">
        @csrf
        <!-- Header -->
        <!-- Title -->
        <div class="form-header">
            <p class="form-header-title">Register</p>
            <a href="{{ route('frontend.home') }}"><img class="form-header-logo" src="{{asset('image/logo.png')}}" alt="">
            </a>
        </div>
        
        <!-- Body -->
        <!-- input area -->
        <div class="form-body">
            
            @include('auth.forms.register-form')
        </div>

        <!-- Footer -->
        <!-- already have account -->
       
        <div class="form-footer flex-row">
            <p class="login-text">Already have account?</p><a href="{{ route('auth.login') }}">Login</a>
        </div>
    </form>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css\auth\register.css') }}">
@endpush

@push('after-body')
    <script src="{{ asset('js\auth\register.js') }}"></script>
@endpush