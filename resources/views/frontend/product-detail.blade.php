
@extends('frontend.layouts.app')

@section('title', __('Product Detail'))

@section('app')

    <div class="content">

        <div class="breadcrumbs">
            {{ Breadcrumbs::render('productDetail', $productData, $productData) }}
        </div>

        <!-- Product Detail -->
        <section class="product-detail">

            <!-- Product Cover & Image -->
            <section class="product-media" id="image-selector">

                <!-- Image Preview -->
                <div class="image-preview-container">
                    <img src="{{ asset('storage/'. $productCover) }}" alt="" class="image-preview" data-preview="image-selector">
                </div>

                <!-- Image Select -->
                <div class="image-selector-container">

                    <!-- Prev Button -->
                    <div class="prev-button" data-button="prev">
                        <i class="icon fa-solid fa-arrow-left"></i>
                    </div>

                    <!-- Image Selector -->
                    <div class="image-selector" data-item="image-selector">

                        <div class="item" data-item="image-selector">
                            <img data-item="image-selector" src="{{ asset('storage/'. $productCover) }}" alt="" class="item-image" data-image="image-selector">
                        </div>

                        <!-- Item -->
                        @foreach ($productImages as $productImage)
                        <div class="item" data-item="image-selector">
                            <img data-item="image-selector" src="{{ asset('storage/'.$productImage) }}" alt="" class="item-image" data-image="image-selector">
                        </div>
                        @endforeach


                    </div>

                    <!-- Next Button -->
                    <div class="next-button" data-button="next">
                        <i class="icon fa-solid fa-arrow-right"></i>
                    </div>

                </div>

            </section>

            <!-- Product Information -->
            <section class="product-information">

                <!-- Product Name -->
                <div class="product-header">
                    <p class="product-name">{{ ($productData->getProductName())[0]->name }}</p>
                </div>

                <!-- Product Detail -->
                <div class="product-content">

                    <!-- Available Car Model -->
                    <div class="available-car-model">
                        <p class="title">Available Car Model</p>
                        <ul class="item-list">
                            @foreach (($productData->getProductName()) as $name)  
                            <li class="item flex-row">
                                <span></span>
                                <p class="item-text">{{ $name->name }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Action Area -->
                    <div class="action-area">
                        <p class="form-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Please choose a brand">Brand</p>
                        <!-- Form -->
                        <form class="form" action="{{ route('frontend.product.detail.post',['productCode'=>$productData->product_code]) }}" method="post">
                            @csrf

                            <!-- Booking -->
                            <div class="brand-selector">
                                <!-- UNIT FOR brand-->
                                @foreach (($productData->getProductBrand()) as $brand)
                                <label for="{{ $brand->code }}" class="brand-label" data-image="{{ $brandCover[$brand->code][0] }}">
                                    <input name="brand" value="{{ $brand->code }}" id="{{ $brand->code }}" data-product="{{ $productData->product_code }}" data-category="{{ $productData->product_category }}" type="radio">
                                    <div class="brand-box">
                                        <p class="brand-name">{{ $brand->code }}</p>
                                        <img class="brand-logo" src="{{ asset("storage/brand/$brand->brand.svg") }}" alt="">
                                    </div>
                                </label>
                                @endforeach
                            </div>

                            <!-- Button -->
                            <div class="button-area">

                                <!-- Quantity Modifier -->
                                <div class="quantity-modifier">

                                    <div class="input-group">

                                        <!-- Remove -->
                                        <button class="remove-button" data-text="quantity-input" data-button-type="remove" type="button">
                                            <i class="icon fa-solid fa-minus"></i>
                                            <p class="button-text"></p>
                                        </button>

                                        <!-- Preview & Input -->
                                        <input type="number" min="0" max="100" name="quantity" value="0" id="quantity-input"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="The number must more then 0"
                                        >

                                        <!-- Add -->
                                        <button class="add-button" data-text="quantity-input" data-button-type="add" type="button">
                                            <i class="icon fa-solid fa-add"></i>
                                            <p class="button-text"></p>
                                        </button>
                                    </div>

                                </div>

                                <!-- Add To Cart -->
                                <div class="add-to-cart">
                                    <button class="btn btn-primary" type="submit">Add To Cart</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

            </section>

        </section>

        <div class="zoom-preview">
            <img id="zoom-preview" src="" alt="">
        </div>

        @auth
         
            <div class="action-bar">
                <a href="{{ route('backend.user.cart') }}">
                    <div class="cart-container">
                        @if(auth()->user()->getCartNumber() > 0)
                            <div class="notification">{{ auth()->user()->getCartNumber() }}</div>
                        @endif
                        <i class="icon fa-solid fa-cart-shopping"></i>
                    </div>
                </a>
            </div>

        @endauth


    </div>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css\frontend\product-detail.css') }}">
@endpush

@push('after-body')
    <script src="{{ asset('js\frontend\product-detail.js') }}"></script>
@endpush