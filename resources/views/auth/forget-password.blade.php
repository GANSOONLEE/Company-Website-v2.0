
@extends('auth.layouts.app')

@section('title', __('Helper Center'))

@section('app')

    <div id="alert"></div>

    <div class="form">
        
        <!-- header -->
        <div class="form-header">
            <p class="form-header-title">Helper Center</p>
        </div>
        
        <!-- body -->

        <div class="form-body">

            <div class="form-body__container" data-index="0">
                <div data-click="next" class="helper-box">
                    <p>I forget my password 🔒</p>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        
            <div class="form-body__container" data-index="1">
                <div data-click="next" data-secclick="send email" class="helper-box">
                    <p>Send email to reset password 📩</p>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <input class="form-control" type="email" placeholder="email" required name="email">
            </div>
    
            <div class="form-body__container" data-index="2">
                <div class="result">
                    <i class="fa-solid fa-circle-check" style="color: #03a800;"></i>
                    <p>Sending Email, Please check you mailbox.</p>
                </div>
            </div>

        </div>
    
        <!-- body END -->

    </div>

@endsection

@push('before-body')
    <link rel="preload stylesheet" as="style" href="{{ asset('css\auth\forget-password.css') }}">
@endpush

@push('after-body')
    <script defer src="{{ asset('js\auth\forget-password.js') }}"></script>
@endpush