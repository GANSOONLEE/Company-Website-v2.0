
@extends('frontend.layouts.app')

@section('title', ('Category'))

@section('app')

    <div class="relative overflow-hidden">
        
        <div class="fixed top-0 left-0 z-[1] h-screen w-screen">
            <img src="{{ asset('images/bee.png') }}" alt="" class="h-full w-full object-cover brightness-110">
        </div>
        
        <div class="relative top-0 left-0 flex flex-col pl-6 pt-4 z-9">
    
            @foreach ($categoryTitle as $index => $categoryArray)
            
                <div class="flex flex-col w-full">
    
                    <p class="text-2xl font-bold">{{ $index }}</p>
    
                    <div class="content">
        
                        @foreach ($categoryArray as $category)
                            <a class="category-box" href="{{ route('frontend.product.list', ['category' => $category->name]) }}">
                                <section class="category-card">
                                    <img class="category-cover" src="{{ asset($category->cover)}}" alt="">
                                    <div class="category-description bg-white">
                                        <p class="category-description-text">
                                            {{ $category->name }}
                                        </p>
                                    </div>
                                </section>
                            </a>    
                        @endforeach
    
                    </div>
                </div>
    
            @endforeach
            
        </div>

    </div>


    <!-- Promotion Side-Popup -->
    <a href="{{ route('frontend.home') }}#promotionControls" class="z-99 flex items-center fixed top-30 right-[0] max-w-sm py-[0.425rem] px-3 pr-8 translate-x-[11px] bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 animate-[bounce_.6s_ease-in-out_alternate-reverse_infinite]">
        <h5 class="flex items-center gap-x-[1rem] text-base font-bold tracking-tight text-gray-900 hover:text-blue-700 dark:text-white"><i class="fa-solid fa-bullhorn text-lg"></i>Promotion</h5>
    </a>

    <!-- Wahtapps Side-Popup -->
    <a href="https://api.whatsapp.com/send?phone=60172430100" class="z-99 flex items-center fixed top-[11.6rem] right-[0] max-w-sm py-[0.425rem] px-3 pr-8 translate-x-[5px] bg-green-800 border !border-green-800 rounded-lg shadow hover:bg-green-900 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 animate-[bounce_.6s_ease-in-out_alternate-reverse_infinite]">
        <h5 class="flex items-center gap-x-[1rem] text-base font-bold tracking-tight text-gray-200 hover:text-white dark:text-white"><i class="fa-brands fa-whatsapp text-lg"></i>Whatsapp</h5>
    </a>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{asset('css/frontend/category.css')}}">
@endpush