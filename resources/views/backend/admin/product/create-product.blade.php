@extends('backend.admin.layouts.app')

@section('title', __('sidebar.create-product'))

@section('main')

    @php
        $title = env('APP_NAME');
        $content = __('product.content');
        $confirm = __('product.confirm');
    @endphp

    @if(isset($title))
        <notification-modal :modal-title="'{{ $title }}'" :modal-content="'{{ $content }}'" :modal-confirm="'{{ $confirm }}'"/></notification-modal>
    @endif

    <form action="" method="POST" class="form" id="form" enctype="multipart/form-data">
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