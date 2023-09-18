@extends('backend.admin.layouts.app')

@section('title', __('sidebar.create-product'))

@section('main')

    <div id="alert">
        <bootstrap-alert></bootstrap-alert>
    </div>

    <form action="{{ route('backend.admin.product.create') }}" method="POST" class="form" id="form" enctype="multipart/form-data">
        @csrf
        @include('backend.admin.product.create-product-form')
    </form>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\create-product.css') }}">
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\create-product-form.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\product\create-product.js') }}"></script>
@endpush