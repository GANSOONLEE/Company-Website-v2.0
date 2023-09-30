@extends('backend.admin.layouts.app')

@section('title', __('order.view-order'))

@section('main')

    @include('backend.admin.includes.tab')

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\order\view-order.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\order\view-order.js') }}"></script>
@endpush