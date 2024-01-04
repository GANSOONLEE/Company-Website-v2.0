
@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('app')

<div class="container">

    <div class="background-image"></div>

    @include('frontend.includes.carousel')

    <div class="content position-relative z-10 bg-white">

        <!-- #TODO 加入新内容 -->
        <h2 class="text-2xl">Frozen Aircond Sdn. Bhd.</h2>

        <div class="section">

            <div class="area">
                <h4 class="section-title">Who are we</h4>

                <div class="section-body">
                    Frozen Air Cond Sdn Bhd, is an automatic air conditioning spare part supply to supplier or mechanic.
                </div>
            </div>

            <div class="area">
                <img src="{{ asset('image/frozen air cond.webp') }}" alt="">
            </div>
        </div>

    </div>

@endsection

@push('before-body')
    <link rel="preload stylesheet" as="style" href="{{asset('css/frontend/home.css')}}">
@endpush

@push('after-body')

@endpush