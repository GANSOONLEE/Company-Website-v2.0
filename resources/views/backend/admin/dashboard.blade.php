@extends('backend.admin.layouts.app')

@section('title', __('sidebar.dashboard'))

@section('main')

    <div id="alert">
        
    </div>

    @include('backend.admin.components.layouts')


@endsection

@push('after-style')

    <!-- Card Layouts -->
    <link rel="stylesheet" href="{{ asset('css/backend/admin/components/layouts.css') }}">

    <!-- Components -->
    <link rel="stylesheet" href="{{ asset('css/backend/admin/components/chart/pie-chart.css') }}">
@endpush

@push('after-script')

    <!-- Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Components -->
    <script src="{{ asset('js/backend/admin/dashboard.js') }}"></script>
    
@endpush