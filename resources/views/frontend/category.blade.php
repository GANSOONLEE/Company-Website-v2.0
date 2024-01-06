
@extends('frontend.layouts.app')

@section('title', ('Category'))

@section('app')

    <div class="content">

        @foreach ($categoryData as $index => $category)
            <a class="category-box" href="{{ route('frontend.product.list', ['category' => $category['name']]) }}">
                <section class="category-card">
                    <img class="category-cover" src="{{ asset($category['cover'])}}" alt="">
                    <div class="category-description">
                        <p class="category-description-text">
                            {{ $category['name'] }}
                        </p>
                    </div>
                </section>
            </a>    
        @endforeach
        
    </div>

    <!-- Promotion Side-Popup -->
    <a href="{{ route('frontend.home') }}" class="flex items-center fixed top-30 right-[0] max-w-sm py-[0.425rem] px-3 pr-8 translate-x-[5px] bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="flex items-center gap-x-[1rem] text-base font-bold tracking-tight text-gray-900 hover:text-blue-700 dark:text-white"><i class="fa-solid fa-bullhorn text-lg"></i>Promotion</h5>
    </a>

    <!-- Wahtapps Side-Popup -->
    <a href="https://api.whatsapp.com/send?phone=60172430100" class="flex items-center fixed top-[12rem] right-[0] max-w-sm py-[0.425rem] px-3 pr-8 translate-x-[5px] bg-green-800 border !border-green-800 rounded-lg shadow hover:bg-green-900 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <h5 class="flex items-center gap-x-[1rem] text-base font-bold tracking-tight text-gray-200 hover:text-white dark:text-white"><i class="fa-brands fa-whatsapp text-lg"></i>Whatsapp</h5>
    </a>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{asset('css/frontend/category.css')}}">
@endpush