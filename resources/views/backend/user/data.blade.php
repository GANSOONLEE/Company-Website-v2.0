@extends('backend.user.layouts.app')

@section('title', 'Data')

@section('main')

    <div id="alert"></div>

    <section class="data">
        
        <x-form.patch :action="route('backend.user.data.update')">

            <!-- Basic Information -->
            <div class="row">
    
                <div class="row-title">
                    <p class="row-title-text">Basics Information</p>
                </div>
    
                <div class="row-content">
    
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label read-only" for="">Name</label>
                            <input type="text" class="form-control" read-only disabled value="{{ $user->name }}">
                        </div>
        
                        <div class="col">
                            <label class="form-label read-only" for="">Email</label>
                            <input type="text" class="form-control" read-only disabled value="{{ $user->email }}">
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="">Whatasapp Number</label>
                            <input type="text" class="form-control" name="whatsapp_phone" disabled value="{{ $user->whatsapp_phone }}">
                        </div>
                        
                        <div class="col">
                            <label class="form-label" for="">Contact Number</label>
                            <input type="text" class="form-control" name="contact_phone" disabled value="{{ $user->contact_phone }}">
                        </div>
                    </div>
    
                </div>
    
            </div>
    
            <!-- Shop Information -->
            <div class="row">
    
                <div class="row-title">
                    <p class="row-title-text">Shop Information</p>
                </div>
    
                <div class="row-content">
                    
                    <div class="col">
                        <label class="form-label" for="">Address</label>
                        <textarea class="form-control" name="address" disabled>{{ $user->address }}</textarea>
                    </div>
    
                    <div class="row mt-3">
    
                        <div class="col">
                            <label class="form-label read-only" for="">Jobs</label>
                            <input type="text" class="form-control" value="{{ $user->profession }}" read-only disabled>
                        </div>
    
                        <div class="col">
                            <label class="form-label read-only" for="">Shops Name</label>
                            <input type="text" class="form-control" value="{{ $user->shop_name }}" read-only disabled>
                        </div>
    
                    </div>

                </div>
            </div>

            <!-- Button Action -->
            <div class="action">
                <p class="text">
                    The column remark "#" can't change!<br>
                    If you need to change please email<a href="mailto:frozenaircond.noreply@gmail.com">
                        Frozenaircond.noreply@gmail.com
                    </a>
                </p>
                <button data-button-action="change" class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#changePassword">
                    <i class="fa-solid fa-lock"></i>
                    @if ($user->password !== null)
                        Change Password
                    @else
                        Reset Password
                    @endif
                </button>
                <button data-button-action="edit" class="btn btn-secondary" type="button">
                    <i class="fa-solid fa-pen"></i>
                    Edit
                </button>
                <button class="btn btn-success" type="submit" disabled>
                    <i class="fa-solid fa-save"></i>
                    Save
                </button>
            </div>

        </x-form.patch>

        @include('backend.user.change-passowrd')

    </section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\user\data.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\user\data.js') }}"></script>
@endpush

