@extends('backend.admin.layouts.app')

@section('title', __('sidebar.permission-management'))

@section('main')

    @foreach ($operations as $operation)
        {{ $operation->email }}
        {{ $operation->operation_type }}
        {{ $operation->operation_category }}
    @endforeach

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\permission-management.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\account\permission-management.js') }}"></script>
@endpush