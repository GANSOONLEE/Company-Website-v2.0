
@extends('auth.layouts.app')

@section('title', __('Login'))

@section('app')

    <!-- form -->
    <form action="{{ route('auth.login.post') }}" class="form" id="form" method="POST">
        @csrf
        <!-- Header -->
        <!-- Title -->
        <div class="form-header">
            <p class="form-header-title">Login</p>
            <a href="{{ route('frontend.home') }}"><img class="form-header-logo" src="{{asset('image/logo.png')}}" alt="">
            </a>
        </div>
        
        <!-- Body -->
        <!-- input area -->
        <div class="form-body">
            @include('auth.forms.login-form')
        </div>

        <!-- Footer -->
        <!-- already have account -->
        <div class="form-footer flex-row">
            <p class="register-text">Already have account?</p><a href="{{ route('auth.register') }}">Login</a>
        </div>

    </form>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css\auth\login.css') }}">
@endpush

@push('after-body')
    {{-- <script src="{{ asset('js\auth\login.js') }}"></script> --}}
@endpush