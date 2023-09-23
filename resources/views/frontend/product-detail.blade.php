
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
            <section class="product-media">

                <!-- Image Preview -->
                <div class="image-preview-container">
                    <img src="{{ asset('storage/'. $productCover) }}" alt="" class="image-preview">
                </div>

                <!-- Image Select -->
                <div class="image-selector-container">

                    <!-- Prev Button -->
                    <div class="prev-button">
                        <i class="icon fa-solid fa-arrow-left"></i>
                    </div>

                    <!-- Image Selector -->
                    <div class="image-selector">

                        <!-- Item -->
                        @foreach ($productImages as $productImage)
                        <div class="item">
                            <img src="{{ asset('storage/'.$productImage) }}" alt="" class="item-image">
                        </div>
                        @endforeach

                    </div>

                    <!-- Next Button -->
                    <div class="next-button">
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
                        <form class="form" action="" method="post">
                            @csrf

                            <!-- Booking -->
                            <div class="brand-selector">
                                <!-- UNIT FOR brand-->
                                @foreach (($productData->getProductBrand()) as $brand)
                                <label for="{{ $brand->code }}" class="brand-label" data-image="{{ $brandCover[$brand->code][0] }}">
                                    <input name="brand" id="{{ $brand->code }}" type="radio">
                                    <div class="brand-box">
                                        <p class="brand-name">{{ $brand->code }}</p>
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


    </div>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css\frontend\product-detail.css') }}">
@endpush

@push('after-body')
    <script src="{{ asset('js\frontend\product-detail.js') }}"></script>
@endpush