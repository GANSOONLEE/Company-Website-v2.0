
@extends('frontend.layouts.app')

@section('title', 'Product')

@section('app')

    @php
        $model = isset($model) ? $model : '';
    @endphp

    <div id="top" class="header">
        <div class="breadcrumbs">
            @if (request()->routeIs('frontend.product.list'))
                {{ Breadcrumbs::render('frontend.product.list', $category) }}
            @else
                {{ Breadcrumbs::render('frontend.product.query', $category, $model) }}
            @endif
        </div>
    </div>

    <div class="content flex flex-column">

        <!-- Filter -->
        @include('frontend.includes.filter', ['category' => $category])

        <section class="container w-full px-8">

            <p class="container-title">{{ $category . ' ' . $model }} </p>

            <!-- Product Card -->
            <section class="product-list">

                <!-- Unit -->
                @if (count($productData) > 0)
                    @foreach ($productData as $product)

                    <a class="product-detail-href" href="{{ route('frontend.product.detail', ['productCode' => $product->product_code ?? 'null']) }}">
                        <div class="custom-card">
                            <div class="custom-card-image flex justify-center align-items">

                                <img class="absolute z-9 opacity-40" src="{{ asset("images/watermark-9.png") }}" alt="">
                                <img class="product-cover" src="{{ asset("$directory/$product->product_code/cover.png") }}" alt="">

                                <div class="see-more">
                                    See More
                                </div>
                            </div>
                            <div class="custom-card-header">
                                @foreach (($product->names()->get()) as $names)
                                    <p>{{ $names->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <h1>No any record</h1>
                @endif

            </section>

            {{ $productData->links() }}

        </section>

    </div>

    <!-- Promotion Side-Popup -->
    <a href="{{ route('frontend.home') }}#promotionControls" class="flex items-center fixed z-99 top-30 right-[0] max-w-sm py-[0.425rem] px-3 pr-8 translate-x-[11px] bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 animate-[bounce_.6s_ease-in-out_alternate-reverse_infinite]">
        <h5 class="flex items-center gap-x-[1rem] text-base font-bold tracking-tight text-gray-900 hover:text-blue-700 dark:text-white"><i class="fa-solid fa-bullhorn text-lg"></i>Promotion</h5>
    </a>

    <!-- Wahtapps Side-Popup -->
    <a href="https://api.whatsapp.com/send?phone=60172430100" class="flex items-center fixed z-99 top-[11.6rem] right-[0] max-w-sm py-[0.425rem] px-3 pr-8 translate-x-[5px] bg-green-800 border !border-green-800 rounded-lg shadow hover:bg-green-900 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 animate-[bounce_.6s_ease-in-out_alternate-reverse_infinite]">
        <h5 class="flex items-center gap-x-[1rem] text-base font-bold tracking-tight text-gray-200 hover:text-white dark:text-white"><i class="fa-brands fa-whatsapp text-lg"></i>Whatsapp</h5>
    </a>

    <a href="#top" class="flex justify-center itesm-center w-10 h-10 fixed right-6 bottom-8 shadow rounded-full bg-white z-999">
        <i class="fa-solid fa-arrow-up text-base"></i>
    </a>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css/frontend/includes/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/product.css') }}">
@endpush

@push('after-body')
    <script src="{{asset('js/frontend/product.js')}}"></script>
@endpush