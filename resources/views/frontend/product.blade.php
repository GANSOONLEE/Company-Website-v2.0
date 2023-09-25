
@extends('frontend.layouts.app')

@section('title', 'Product')

@section('app')

    <div class="content">

        <!-- Filter -->
        <section class="filter">
            @include('frontend.includes.filter')
        </section>


        <section class="container">

            <p class="container-title">Product</p>

            <!-- Product Card -->
            <section class="product-list">

                <!-- Unit -->
                @foreach ($productData as $product)
                <a class="product-detail-href" href="{{ route('frontend.product-detail', ['productCode' => $product->product_code]) }}">
                    <div class="custom-card">
                        <div class="custom-card-image">
                            <img class="product-cover" src="{{ asset("$directory/$product->product_code/cover.jpg") }}" alt="">
                        </div>
                        <div class="custom-card-header">
                            @foreach (($product->getProductName()) as $name)
                                <p>{{ $name->name }}</p>
                            @endforeach
                        </div>
                        <div class="custom-card-information">
                            @foreach (($product->getProductBrand()) as $brand)
                                <p>{{ $brand->brand }}</p>
                            @endforeach
                        </div>
                    </div>
                </a>
                @endforeach

            </section>

        </section>

    </div>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css/frontend/includes/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/product.css') }}">
@endpush

@push('after-body')
    <script src="{{asset('js/frontend/product.js')}}"></script>
@endpush