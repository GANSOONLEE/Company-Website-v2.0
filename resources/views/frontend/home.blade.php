
@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('app')

<div class="container">

    <div class="background-image"></div>

    @include('frontend.includes.carousel')

    <div class="content relative z-10 bg-white w-full overflow-hidden">

        <div class="absolute top-0 left-0 z-[1] w-full h-full">
            <img src="{{ asset('images/background.png') }}" alt="" class="h-full w-full object-cover">
        </div>

        <div class="relative z-[10] py-5 px-7">
    
            <!-- #TODO 加入新内容 -->
            <h2 class="text-2xl">Frozen Aircond Sdn. Bhd.</h2>
            <div class="section flex flex-col md:flex-row w-full md:w-auto">
    
                <div class="area w-full max-w-[100%] md:max-w-[50%]">
                    <h4 class="section-title text-xl text-center font-bold mb-2 md:mb-[0]">Who are we</h4>
    
                    <div class="section-body mb-6">
                        Frozen Air Cond Sdn Bhd, is an automatic air conditioning spare part supply to supplier or mechanic.
                    </div>
                </div>
    
                <div class="area">
                    <img src="{{ asset('image/frozen air cond.webp') }}" alt="">
                </div>
            </div>

        </div>

    </div>

@endsection

@push('before-body')
    <link rel="preload stylesheet" as="style" href="{{asset('css/frontend/home.css')}}">
@endpush

@push('after-body')

@endpush