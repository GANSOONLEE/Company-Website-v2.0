
@extends('frontend.layouts.app')

@section('title', 'Product')

@section('app')

    @php
    if (isset($_GET['model'])) {
        $model = $_GET['model'];
    }else{
        $model = null;
    }
    @endphp

    <div class="header">
        <div class="breadcrumbs">
            @if (isset($model))
            {{ Breadcrumbs::render('model', $category, $model) }}
            @else
            {{ Breadcrumbs::render('model', $category) }}
            @endif
        </div>
        
    </div>

    <div class="content">

        <!-- Filter -->
        @include('frontend.includes.filter')

        <section class="container">

            <p class="container-title">{{ $category . ' ' . $model}} </p>

            <!-- Product Card -->
            <section class="product-list">

                <!-- Unit -->
                @if (count($productData) > 0)
                    @foreach ($productData as $product)
                    <a class="product-detail-href" href="{{ route('frontend.product-detail', ['productCode' => $product->product_code]) }}">
                        <div class="custom-card">
                            <div class="custom-card-image">
                                <img class="product-cover" src="{{ asset("$directory/$product->product_code/cover.png") }}" alt="">
                                <div class="see-more">
                                    See More
                                </div>
                            </div>
                            <div class="custom-card-header">
                                @foreach (($product->getProductName()) as $name)
                                    <p>{{ $name->name }}</p>
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