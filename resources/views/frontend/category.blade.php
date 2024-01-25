
@extends('frontend.layouts.app')

@section('title', ('Category'))

@section('app')

    <div class="relative overflow-hidden">
        
        <div class="fixed top-0 left-0 z-[1] h-screen w-screen">
            <img src="{{ asset('images/bee.png') }}" alt="" class="h-full w-full object-cover brightness-110">
        </div>
        
        <div class="relative top-0 left-0 flex flex-col px-4 pt-4 z-9">
    
            @foreach ($categoryTitle as $index => $categoryArray)
            
                <div class="flex flex-col w-full">
    
                    <p class="text-2xl font-bold">{{ $index }}</p>
    
                    <div class="category-list">
        
                        @foreach ($categoryArray as $category)
                            <a class="category-box md:w-[29%] h-full w-[calc(100% - 20px)] rounded-[4px] overflow-hidden shadow" href="{{ route('frontend.product.list', ['category' => $category->name]) }}">
                                <section>
                                    <img class="category-cover" src="{{ asset($category->cover)}}" alt="">
                                    <div class="category-description bg-white px-4 py-3 text-lg font-bold">
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
    <div class="fixed z-99 top-36 -right-[5px]">
        <a href="{{ route('frontend.home') }}#promotionControls" class="relative flex items-center max-w-sm py-[0.425rem] px-3 pr-8 translate-x-[11px] bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 ">
            <h5 class="flex items-center gap-x-[1rem] text-base font-bold tracking-tight text-gray-900 hover:text-blue-700 dark:text-white"><i class="fa-solid fa-bullhorn text-lg"></i>Promotion</h5>
        </a>
        {{-- <div class=" animate-[bounce_.6s_ease-in-out_alternate-reverse_infinite]"> --}}
            <img class="flex justify-center items-center absolute -bottom-[1rem] left-12 w-6 animate-[bounce_.6s_ease-in-out_alternate-reverse_infinite]" src="{{ asset('images/hand-pointer.svg') }}" alt="">
        {{-- </div> --}}
    </div>

    <!-- Wahtapps Side-Popup -->
    <a href="https://api.whatsapp.com/send?phone=60172430100" class="flex items-center fixed z-99 top-[13.5rem] -right-[5px] max-w-sm py-[0.425rem] px-3 pr-8 translate-x-[5px] bg-green-800 border !border-green-800 rounded-lg shadow hover:bg-green-900 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 animate-[bounce_.6s_ease-in-out_alternate-reverse_infinite]">
        <h5 class="flex items-center gap-x-[1rem] text-base font-bold tracking-tight text-gray-200 hover:text-white dark:text-white"><i class="fa-brands fa-whatsapp text-lg"></i>Whatsapp</h5>
    </a>

    <a href="#top" class="flex justify-center itesm-center w-10 h-10 fixed right-6 bottom-8 shadow rounded-full bg-white z-99">
        <i class="fa-solid fa-arrow-up text-base"></i>
    </a>

@endsection