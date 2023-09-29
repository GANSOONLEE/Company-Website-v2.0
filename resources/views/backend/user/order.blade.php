@extends('backend.user.layouts.app')

@section('title', 'Order')

@section('main')
    @include('backend.user.includes.tab')
@endsection

@push('after-style')
    
    <link rel="stylesheet" href="{{ asset('css\backend\user\includes\tab.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\user\includes\tab.js') }}"></script>
@endpush