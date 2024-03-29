
@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('app')

<div class="container">

    <div class="background-image"></div>

    @include('frontend.includes.carousel')

    <div class="content relative z-10 bg-white w-full overflow-hidden">

        <div class="absolute top-0 left-0 z-[1] w-full h-full">
            <img src="{{ asset('images/background.webp') }}" width="540" height="800" alt="" class="h-full w-full object-cover brightness-110">
        </div>

        <div class="relative z-[10] py-5 px-7">
    
            <!-- #TODO 加入新内容 -->
            <h1 class="!text-3xl text-center whitespace-normal flex flex-col md:flex-row gap-x-2 justify-center">
                <span>
                    Frozen Air Cond
                </span>
                <span>
                    Sdn. Bhd.
                </span>
            </h1>
            <h3 class="text-lg text-center text-gray-800">Since 2010</h3>

            <div class="section flex flex-col lg:flex-row w-full md:w-auto">
    
                <div class="area w-full max-w-[100%] md:max-w-[50%]">
                    <h4 class="section-title text-xl text-center font-bold mb-2 md:mb-[0]">Who are we</h4>
    
                    <div class="section-body mb-6">
                        Frozen Aircond Sdn Bhd is Company which is focusing on selling Car and Lorry air-conditioner , which we supply spare part and accessories and also has a workshop to repair aircond.<br><br>

                        Our Goal is for company grow up more and have business partners in every state of Malaysia including Sabah and Sarawak.<br><br>

                        We also have our own aim to share about information about car, Lorry and other vehicle aircond and other parts through video on our media social platform.<br>
                    </div>
                </div>
    
                <div class="area !w-2/3">
                    <img src="{{ asset('images/funny-1.png') }}" alt="">
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