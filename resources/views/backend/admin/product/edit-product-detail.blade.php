@extends('backend.admin.layouts.app')

@section('title', __('sidebar.edit-product-detail'))

@section('main')

<form action="" method="post" enctype="multipart/form-data">

    <!-- Image Container -->
    <section class="container">

        <div class="section-title">
            <p class="section-title-text">{{ __('product.image-upload') }}</p>
        </div>

        <div class="content">

            <!-- Cover -->
            <div class="product-cover">
                <input type="file" name="" id="product-cover" class="product-cover" accept=".jpg, .jpeg, .bmp, .png, .svg">
                <label for="product-cover" class="form-label">
                    <div class="upload-cover preview">
                        <img src="{{ asset("storage/product/$product->product_category/$product->product_code/cover.png") }}" alt="">
                        <i class="fa-solid fa-add"></i>
                        <p class="cover-text">{{ __('product.upload-cover') }}</p>
                    </div>
                </label>
            </div>
    
            <!-- Product Image-->
            <div class="product-image">
    
                <!-- Unit of image-->
                @for ($i = 0; $i < 10; $i++)
                <div class="product-image-box">
                    <input type="file" name="" id="product-image-" class="product-image" accept=".jpg, .jpeg, .bmp, .png, .svg">
                    <label for="product-image-" class="form-label">
                        <div class="upload-image preview">
                            @if (count($productImages) > $i)  
                                <img src="{{ asset("storage/$productImages[$i]") }}" alt="">
                            @else
                                <img src="" alt="" onerror="this.style.display='none'">
                            @endif
                            <i class="fa-solid fa-add"></i>
                            <p class="image-text">{{ __('product.upload') }}</p>
                        </div>
                    </label>
                </div>
                @endfor
    
            </div>

        </div>
    </section>
    
    <!-- Name Container -->
    <section class="container">

        <div class="section-title">
            <p class="section-title-text">{{ __('product.model-upload') }}</p>
        </div>

        <div class="content flex-column">

            <!-- existent record-->
            @foreach ($product->getProductName() as $name)
                <div class="name">
                    <input class="form-control" type="text" name="fullname[]" id="" value="{{ $name->name }}">
                </div>
            @endforeach

            <!-- blank record -->
            @for ($i = 0; $i < 10-count($product->getProductName()); $i++)
                <div class="name">
                    <input class="form-control" type="text" name="fullname[]" id="">
                </div>
            @endfor
            
        </div>

    </section>
    
    <!-- Brand Container -->
    <section class="container">

        <div class="section-title">
            <p class="section-title-text">{{ __('product.brand-upload') }}</p>
        </div>

        <div class="content flex-column">
            
            <!-- existent record-->
            @foreach ($product->getProductBrand() as $index => $brand)

                <div class="brand-box flex-row">

                    <!-- Brand Image 品牌照片 -->
                    <div class="image">
                        <input type="file" name="" id="brand-image-{{ $index }}">
                        <label for="brand-image-{{ $index }}">
                            <img src="{{ asset("storage/product/$product->product_category/$product->product_code/$brand->code/cover.png") }}" alt="" class="image-upload">
                            <i class="fa-solid fa-add"></i>
                            <p class="image-text">{{ __('product.upload') }}</p>
                        </label>
                    </div>

                    <!-- Brand 品牌 -->
                    <div class="brand">
                        <label for="" class="form-label">{{ __('product.brand') }}</label>
                        <select class="form-control" name="" id="">
                            @foreach ($brands as $brandData)
                                <option value="{{ $brandData->name }}" {{ $brand->brand == $brandData->name ? "selected" : ""}}>{{ $brandData->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand Code 品牌編號 -->
                    <div class="brand-code">
                        <label for="" class="form-label">{{ __('product.brand-code') }}</label>
                        <input class="form-control" type="text" name="brand-code[]" value="{{ $brand->code }}">
                    </div>

                    <!-- Frozen Code Frozen編號 -->
                    <div class="frozen-code">
                        <label for="" class="form-label">{{ __('product.brand') }}</label>
                        <input class="form-control" type="text" name="brand-frozen[]" value="{{ $brand->frozen_code }}">
                    </div>

                </div>

            @endforeach

            <!-- blank record -->
            @for ($i = count($product->getProductBrand()); $i < 10; $i++)
            <div class="brand-box">

                <!-- Brand Image 品牌照片 -->
                <div class="image">
                    <input type="file" name="" id="brand-image-{{ $i }}">
                    <label for="brand-image-{{ $i }}">
                        <img src="" alt="" class="image-upload" onerror="this.style.display = 'none'">
                        <i class="fa-solid fa-add"></i>
                        <p class="image-text">{{ __('product.upload') }}</p>
                    </label>
                </div>

                <!-- Brand 品牌 -->
                <div class="brand">
                    <select class="form-control" name="" id="">
                        <option value="" selected hidden readonly disabled>{{ __('product.brand') }}</option>
                        @foreach ($brands as $brandData)
                            <option value="{{ $brandData->name }}">{{ $brandData->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Brand Code 品牌編號 -->
                <div class="brand-code">
                    <input class="form-control" type="text" name="brand-code[]" value="" placeholder="{{ __('product.brand-code') }}">
                </div>

                <!-- Frozen Code Frozen編號 -->
                <div class="frozen-code">
                    <input class="form-control" type="text" name="brand-frozen[]" value="" placeholder="{{ __('product.frozen-code') }}">
                </div>
            </div>
            @endfor

        </div>

    </section>
    
    <!-- Category & Type -->
    <section class="container child">

        <section class="sub-container">

            <div class="section-title">
                <p class="section-title-text">{{ __('product.category') }}</p>
            </div>

            <div class="content">
                <select name="" id="" class="form-control">
                    @foreach ($categories as $category)  
                    <option value="{{ $category->name }}" {{ $product->product_category == $category->name ? "selected" : ""}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

        </section>

        <section class="sub-container">

            <div class="section-title">
                <p class="section-title-text">{{ __('product.type') }}</p>
            </div>

            <div class="content">
                <select name="" id="" class="form-control">
                    @foreach ($types as $type)
                    <option value="{{ $type->name }}" {{ $product->product_type == $type->name ? "selected" : ""}}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

        </section>

    </section>

    <!-- Button Container -->
    <section class="container">

    </section>

</form>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\edit-product-detail.css') }}">
@endpush

@push('after-script')
    
@endpush