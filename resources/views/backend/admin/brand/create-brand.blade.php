@extends('backend.admin.layouts.app')

@section('title', __('sidebar.brand-create'))

@section('main')

    <div id="alert"></div>

    <form action="{{ route('backend.admin.brand.create') }}" class="form" id="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6 button-area">
            <button type="submit" class="btn btn-primary">{{ __('brand.submit') }}</button>
        </div>

        <div id="dropBox" class="mb-3 brand-cover-area">
            <div id="image-display" class="preview container-custom">
                <img class="brand-cover-preview" id="brand-cover-preview" src="" alt="">
            </div>
            <div class="upload">
                <p class="required">{{ __('brand.brand-cover') }}</p>
                <label class="form-label" for="brand-cover">{{ __('brand.upload-cover') }}</label>
                <input type="file" class="brand-cover" name="brand-cover" id="brand-cover" request>
            </div>
            <p id="error"></p>
        </div>

        <div class="mb-3 brand-name-area">
            <label class="form-label required" for="brand-name">{{ __('brand.brand-name') }}</label>
            <input class="form-control"
                type="text"
                class="brand-name"
                name="brand-name"
                id="brand-name"
                placeholder="{{ __('brand.brand-name') }}"
                request
            >
        </div>

    </form>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\brand\create-brand.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\brand\create-brand.js') }}"></script>
@endpush