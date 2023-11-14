@extends('backend.admin.layouts.app')

@section('title', __('sidebar.category-create'))

@section('main')

    <div id="alert"></div>

    <form action="{{ route('backend.admin.category.create') }}" class="form" id="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6 button-area">
            <button type="submit" class="btn btn-primary">{{ __('category.submit') }}</button>
        </div>

        <div class="mb-3 category-cover-area">
            <div class="preview">
                <img class="category-cover-preview" src="" alt="">
            </div>
            <div class="upload">
                <p class="required">{{ __('category.category-cover') }}</p>
                <label class="form-label" for="category-cover">{{ __('category.upload-cover') }}</label>
                <input type="file" class="category-cover" name="category-cover" id="category-cover" request>
            </div>
        </div>

        <div class="mb-3 category-name-area">
            <label class="form-label required" for="category-name">{{ __('category.category-name') }}</label>
            <input class="form-control"
                type="text"
                class="category-name"
                name="category-name"
                id="category-name"
                placeholder="{{ __('category.category-name') }}"
                request
            >
        </div>

    </form>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\category\create-category.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\category\create-category.js') }}"></script>
@endpush