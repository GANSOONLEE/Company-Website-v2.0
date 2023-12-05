@extends('backend.admin.layouts.app')

@section('title', __('sidebar.edit-product'))

@section('main')

    <div id="alert"></div>
    @include('backend.admin.product.includes.feedback')

    <form action="{{ route('backend.admin.product.edit-product-detail-put', ['product_code'=>$product->product_code]) }}" method="POST" class="form" id="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('backend.admin.product.edit-product-form')
    </form>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\edit-product-detail.css') }}"> 
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\product\edit-product-detail.js') }}"></script>
@endpush