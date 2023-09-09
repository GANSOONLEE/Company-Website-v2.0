
@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('app')

    @include('frontend.includes.carousel')

@endsection

@push('after-body')
    <script src="{{asset('js/frontend/includes/carousel.js')}}"></script>
@endpush