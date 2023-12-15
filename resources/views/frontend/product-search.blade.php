
@extends('frontend.layouts.app')

@section('title', 'Product')

@section('app')

    @php
        $model = isset($model) ? $model : '';
    @endphp

    <div class="header">
        <div class="breadcrumbs">
            {{ Breadcrumbs::render('frontend.product.search') }}
        </div>
    </div>

    <div class="content flex flex-column">

        <!-- Filter -->
        {{-- @include('frontend.includes.filter', ['category' => $category]) --}}

        <section class="container w-full px-8">

            <p class="container-title">Search</p>

            <!-- Product Card -->
            <section class="product-list">

                <!-- Unit -->
                @if (count($productData) > 0)
                    @foreach ($productData as $product)
                    <a class="product-detail-href" href="{{ route('frontend.product.detail', ['productCode' => $product->product_code]) }}">
                        <div class="custom-card">
                            <div class="custom-card-image">
                                <img class="product-cover" src="{{ asset("storage/product/$product->product_category/$product->product_code/cover.png") }}" alt="">
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