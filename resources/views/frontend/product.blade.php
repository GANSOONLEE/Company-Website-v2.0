
@extends('frontend.layouts.app')

@section('title', 'Product')

@section('app')

    @php
        $model = isset($model) ? $model : '';
    @endphp

    <div class="relative">

        <div class="fixed top-0 left-0 z-[1] h-screen w-screen">
            <img src="{{ asset('images/bee.png') }}" alt="" class="h-full w-full object-cover brightness-110">
        </div>

        <div id="top" class=" header">
            <div class="breadcrumbs">
                @if (request()->routeIs('frontend.product.list'))
                    {{ Breadcrumbs::render('frontend.product.list', $category) }}
                @else
                    {{ Breadcrumbs::render('frontend.product.query', $category, $model) }}
                @endif
            </div>
        </div>

        <div class="relative content flex flex-column z-99">

            <!-- Filter -->
            @include('frontend.includes.filter', ['category' => $category])

            <section class="container w-full px-8">

                <p class="container-title text-2xl font-bold">{{ $category . ' ' . $model }} </p>

                <!-- Product Card -->
                <section class="product-list">

                    <!-- Unit -->
                    @if (count($productData) > 0)
                        @foreach ($productData as $product)

                        <a class="product-detail-href bg-white" href="{{ route('frontend.product.detail', ['productCode' => $product->product_code ?? 'null']) }}">
                            <div class="custom-card">
                                <div class="custom-card-image flex justify-center items-center">

                                    <img class="absolute z-9 opacity-20 w-2/3" src="{{ asset("images/watermark.png") }}" alt="">

                                    @php
                                        $files = Storage::disk('public')->allFiles("$directory/$product->product_code");
                                        $productCover = '';

                                        if(count($files) > 0) {
                                            foreach ($files as $file) {
                                                $name = basename(substr($file, 0, strripos($file, '.')));
                                                if($name === 'cover') {
                                                    $productCover = $file;
                                                    break;
                                                }
                                            }
                                        }

                                    @endphp
                                    <img class="product-cover" src="{{ asset("storage/$productCover") }}" alt="">

                                    <div class="see-more">
                                        See More
                                    </div>
                                </div>
                                <div class="custom-card-header">
                                    @foreach (($product->names()->get()) as $names)
                                        <p class="whitespace-normal">{{ $names->name }}</p>
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

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css/frontend/includes/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/product.css') }}">
@endpush

@push('after-body')
    <script src="{{asset('js/frontend/product.js')}}"></script>
@endpush