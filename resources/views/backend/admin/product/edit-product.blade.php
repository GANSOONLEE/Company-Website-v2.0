@extends('backend.admin.layouts.app')

@section('title', __('sidebar.edit-product'))

@section('main')

    <!-- Edit Panel -->
    <section class="basic-information-edit-panel">
        @php
            $product = 2
        @endphp
        @if (isset($product))
            @include('backend.admin.product.includes.panel')
        @else
            <div class="no-product">
                1
            </div>
        @endif
    </section>

    <!-- Filter -->
    <section class="filter">
        @include('backend.admin.product.includes.filter')
    </section>

    <!-- Data List -->
    <section class="datalist">
        @include('backend.admin.product.includes.datalist')
    </section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\edit-product.css') }}">
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\edit-product-form.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\product\edit-product.js') }}"></script>
@endpush