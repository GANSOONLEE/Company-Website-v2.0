
@extends('frontend.layouts.app')

@section('title', __('Product Detail'))

@section('app')

    <div id="alert"></div>

    <div class="content">



        <!-- Product Detail -->
        <section class="product-detail">

            <!-- Product Cover & Image -->
            <section class="product-media" id="image-selector">

                <!-- Image Preview -->
                <div class="image-preview-container">
                    <img data-item="image-selector" src="{{ asset('storage/'. $productCover) }}" alt="" class="image-preview item-image" data-preview="image-selector">
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
                            <img data-item="image-selector" src="{{ str_replace('#', '%23', asset('storage/'.$productImage)) }}" alt="" class="item-image" data-image="image-selector">
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
                    @if (count($productData->getProductName()) > 0)
                        <p class="product-name">{{ ($productData->getProductName())[0]->name }}</p>
                    @endif
                </div>

                <!-- Product Detail -->
                <div class="product-content">

                    <!-- Available Car Model -->
                    <div class="available-car-model h-full">
                        <p class="title !text-xl">Available Car Model</p>
                        <ul class="item-list !text-base">
                            @foreach (($productData->getProductName()) as $name)  
                            <li class="item flex-row">
                                <span></span>
                                <p class="item-text">{{ $name->name }}</p>
                            </li>
                            @endforeach
                        </ul>

                        <div class="flex text-sm justify-self-end text-gray-800 mt-[2rem]">
                            {{ $productData->remarks }}
                        </div>
                    </div>

                    @auth
                        @php
                            $permission = auth()->user()->getRoleEntity()->hasPermission('user_backend') ? '' : 'disabled';
                        @endphp
                    @endauth

                    @guest
                        @php
                            $permission = 'disabled';
                        @endphp
                    @endguest

                    <!-- Action Area -->
                    <div class="action-area">
                        <p class="form-title" data-bs-toggle="tooltip" data-bs-placement="top" title="Please choose a brand">Brand</p>
                        
                        <!-- Form -->
                        <x-form.post id="post-form" class="form" :action="route('backend.user.cart.store')">
                            
                            <!-- Booking -->
                            <div class="brand-selector flex flex-col lg:flex-row w-full">

                                @php    
                                    $auth = "false";
                                    if(auth()->check()){
                                        $auth = "true";
                                    }
                                @endphp

                                <!-- UNIT FOR brand-->
                                @foreach (($productData->getProductBrand()) as $brand)

                                @if (is_array($brandCover) && isset($brandCover) && $brandCover !== [] && isset($brandCover[$brand->sku_id][0]) )
                                    <label data-auth="{{ $auth }}" for="{{ $brand->code }}" class="brand-label w-full lg:w-[calc(100% / 1.75)] whitespace-nowrap" data-image="{{ "storage/" . url_encode($brandCover[$brand->sku_id][0]) }}">  
                                @else
                                    <label data-auth="{{ $auth }}" for="{{ $brand->code }}" class="brand-label" data-image="">  
                                @endif

                                    <input name="brand" value="{{ $brand->code }}" id="{{ $brand->code }}" data-product="{{ $productData->product_code }}" data-category="{{ $productData->product_category }}" type="radio" {{ $permission }}>
                                    <div class="brand-box">
                                        <p class="brand-name">{{ str_replace('_', '/', $brand->code) }}</p>
                                        @if (file_exists(public_path("storage/brand/$brand->brand.svg")))
                                            <img class="brand-logo" src="{{ asset(url_encode("storage/brand/$brand->brand.svg")) }}" alt="">
                                        @elseif(file_exists(public_path("storage/brand/$brand->brand.png")))
                                            <img class="brand-logo" src="{{ asset(url_encode("storage/brand/$brand->brand.png")) }}" alt="">
                                        @else
                                            <img class="brand-logo" src="{{ asset(url_encode("storage/brand/$brand->brand.jpg")) }}" alt="">
                                        @endif
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
                                        <button class="remove-button" data-text="quantity-input" data-button-type="remove" type="button" {{ $permission }}>
                                            <i class="icon fa-solid fa-minus"></i>
                                            <p class="button-text"></p>
                                        </button>

                                        <!-- Preview & Input -->
                                        <input type="number" min="0" max="100" name="quantity" value="0" id="quantity-input"
                                            data-bs-toggle="tooltip" oninput="document.querySelector('#quantity').value = this.value" data-bs-placement="top" title="The number must more then 0"
                                            {{ $permission }}
                                        >

                                        <!-- Add -->
                                        <button class="add-button" data-text="quantity-input" data-button-type="add" type="button" {{ $permission }}>
                                            <i class="icon fa-solid fa-add"></i>
                                            <p class="button-text"></p>
                                        </button>
                                    </div>

                                </div>

                                <!-- If not pending order -->

                        @if (auth()->user()->order()->where('status', 'Pending')->count() <= 0)

                                <!-- Add To Cart -->
                                <div class="add-to-cart">
                                    <button class="btn btn-primary" type="submit" {{ $permission }} {{ count($productData->getProductName()) > 0 ? "" : "disabled" }}>Add To Cart</button>
                                </div>

                            </div>
                                
                        @else
                            <div class="relative w-full">

                                
                                <div class="inline-flex rounded-sm shadow-sm w-full" role="group">
                                    <button type="submit" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-[#EE4D2D] border-t border-b border-orange-200 rounded-s-sm hover:bg-[#ff3b13] hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Add To Cart
                                    </button>
                                    <label for="menuButton">
                                        <div type="button" class="px-3 py-2 text-sm font-medium text-white bg-[#EE4D2D] border-t border-b border-orange-200 rounded-e-sm hover:bg-[#ff3b13] hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                            <i class="fa-solid fa-chevron-down duration-[125ms] peer-checked:rotate-180"></i>
                                        </div>
                                    </label>
                                </div>
                                
                            </x-form.post>
                            
                                <input class="peer" type="checkbox" id="menuButton" hidden>

                                <ol class="absolute right-[0] bg-white rounded-md shadow-lg hidden peer-checked:block">
                                    @foreach (auth()->user()->order()->where('status', 'Pending')->get() as $order) 
                                        <li class="px-5 py-2 text-[#EE4D2D] cursor-pointer hover:bg-orange-100 hover:text-[#ff2a00]">
                                            <x-form.post :action="route('backend.user.order.stoneItem', ['id' => $order->id])">
                                                <input type="text" id="brand" name="brand" hidden required>
                                                <input type="text" id="quantity" name="quantity" hidden required>
                                                <button type="submit">Add to Order #{{ $order->id }}</button>
                                            </x-form.post> 
                                        </li>
                                    @endforeach
                                </ol>

                            </div>
                        @endif
                    </div>

                </div>

            </section>

        </section>

        <!-- Zoom in popup -->
        <div class="zoom-preview flex justify-center items-center">
            <div id="popupModal" class="relative w-full max-w-[29.2rem] h-auto p-3 bg-white rounded-md shadow overflow-hidden">
                <!-- Title -->
                <h3 class="text-xl font-bold pb-2 border-b-[1px] border-solid border-gray-600 ">Product Image</h3>
        
                <!-- Content -->
                <div class="relative pt-2">
                    <!-- Main product image -->
                    <div class="slot">
                        <span class="flex justify-center items-center absolute bottom-4 left-4 bg-gray-500 text-white opacity-60 rounded-full m-3 px-[.5rem] py-1">1 of {{ 1 + count($productImages) }}</span>
                        <img class="w-full object-cover" src="{{ asset('storage/'. $productCover) }}" alt="Main Product Image">
                    </div>
        
                    <!-- Additional product images -->
                    @foreach ($productImages as $index => $productImage)
                        <div class="slot hidden">
                            <span class="flex justify-center items-center absolute bottom-4 left-4 bg-gray-500 text-white opacity-60 rounded-full m-3 px-[.5rem] py-1">{{ $index + 2 }} of {{ 1 + count($productImages) }}</span>
                            <img class="w-full object-cover" src="{{ str_replace('#', '%23', asset('storage/'.$productImage)) }}" alt="Product Image {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
        
                <!-- Navigation arrows -->
                <div class="absolute w-full top-[50%] -translate-y-[50%]">
                    <div class="flex w-[93%] justify-between mt-2">
                        <button id="prevBtn" class="px-[0.65rem] py-1 rounded-full bg-gray-500 text-gray-300">&lt;</button>
                        <button id="nextBtn" class="px-[0.65rem] py-1 rounded-full bg-gray-500 text-gray-300">&gt;</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Logo => Goto user cart page -->
        @auth
            @if(auth()->user()->getRoleEntity()->hasPermission('user_backend'))
                <div class="action-bar">
                    <a href="{{ route('backend.user.cart.create') }}">
                        <div class="cart-container">
                            @if(auth()->user()->getCartNumber() > 0)
                                <div class="notification" id="notification-total-cart">{{ auth()->user()->getCartNumber() }}</div>
                            @endif
                            <i class="icon fa-solid fa-cart-shopping"></i>
                        </div>
                    </a>
                </div>
            @endif
        @endauth


    </div>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{ asset('css\frontend\product-detail.css') }}">
@endpush

@push('after-body')
    <script src="{{ asset('js\frontend\product-detail.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mainImage = document.getElementById("mainImage");
            const productImages = document.querySelectorAll(".relative div.slot");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");
            let currentIndex = 0;

            // Show the specified image
            function showImage(index) {
                productImages.forEach((img, i) => {
                    img.classList.toggle("hidden", i !== index);
                });
            }

            // Show the next image
            function showNextImage() {
                currentIndex = (currentIndex + 1) % productImages.length;
                showImage(currentIndex);
            }

            // Show the previous image
            function showPrevImage() {
                currentIndex = (currentIndex - 1 + productImages.length) % productImages.length;
                showImage(currentIndex);
            }

            // Event listeners for navigation buttons
            nextBtn.addEventListener("click", showNextImage);
            prevBtn.addEventListener("click", showPrevImage);
            document.addEventListener("keydown", e => {
                if(e.keyCode !== 37){
                    return;
                }
                showNextImage();
            })
            document.addEventListener("keydown", e => {
                if(e.keyCode !== 39){
                    return;
                }
                showPrevImage();
            })
        });
    </script>
@endpush