
@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('app')

    @include('frontend.includes.carousel')

    <div class="content">

        <!-- #TODO 加入新内容 -->

    </div>

@endsection

@push('after-body')
    <script src="{{asset('js/frontend/includes/carousel.js')}}"></script>
@endpush