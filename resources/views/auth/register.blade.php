
@extends('auth.layouts.app')

@section('title', __('Register'))

@section('app')

    <!-- form -->
    <form action="" class="form" id="form">

        <!-- Header -->
        <!-- Title -->
        <div class="form-header">
            <p class="form-header-title">Register</p>
            <img class="form-header-logo" src="{{asset('image/logo.png')}}" alt="">
        </div>
        
        <!-- Body -->
        <!-- input area -->
        <div class="form-body">
            @include('auth.forms.register-form')
        </div>

        <!-- Footer -->
        <!-- button area -->
        <div class="footer">

        </div>


    </form>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css\auth\register.css') }}">
@endpush

@push('after-body')
    <script src="{{ asset('js\auth\register.js') }}"></script>
@endpush