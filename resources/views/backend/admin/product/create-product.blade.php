@extends('backend.admin.layouts.app')

@section('title', __('sidebar.create-product'))

@section('main')

    <div id="alert"></div>
    @include('backend.admin.product.includes.feedback')

    <form action="{{ route('backend.admin.product.create-product-post') }}" method="POST" class="form" id="form" enctype="multipart/form-data">
        @csrf
        @include('backend.admin.product.create-product-form')
    </form>

@endsection

@push('after-style')
    <link rel="preload stylesheet" as="style" href="{{ asset('css\backend\admin\product\create-product.css') }}">
    <link rel="preload stylesheet" as="style" href="{{ asset('css\backend\admin\product\create-product-form.css') }}">
    
@endpush

@push('after-script')
    <script async src="{{ asset('js\backend\admin\product\create-product.js') }}"></script>
@endpush