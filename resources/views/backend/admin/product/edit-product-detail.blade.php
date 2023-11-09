@extends('backend.admin.layouts.app')

@section('title', __('sidebar.edit-product-detail'))

@section('main')

<div id="alert">
    <custom-alert
        :message = "'你好'"
        :status = "'success'"
    ></custom-alert>
</div>

<div id="modal">
    <bootstrap-modal
        :app="'{{ env('APP_NAME') }}'"
        :message="'{{ __('product.delete-confirm') }}'"
        :delete="'{{ __('product.delete') }}'"
        :cancel="'{{ __('product.cancel') }}'"
    ></bootstrap-modal>
</div>

<form action="{{ route('backend.admin.product.edit', ['product_code'=>$product->product_code]) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Image Container -->
    <section class="container">

        <div class="section-title">
            <p class="section-title-text">{{ __('product.image-upload') }}</p>
        </div>

        <div class="content">

            <!-- Cover -->
            <div class="product-cover">
                <input type="file" name="product-cover" id="product-cover" class="product-cover product-image" accept=".jpg, .jpeg, .bmp, .png, .svg">
                <label for="product-cover" class="form-label">
                    <div class="upload-cover preview">
                        @if (Storage::disk('public')->exists("product/$product->product_category/$product->product_code/cover.png"))
                            <img class="image-preview" src="{{ asset("storage/product/$product->product_category/$product->product_code/cover.png") }}" alt="">
                        @else
                            <img class="image-preview" src="{{ asset("storage/product/$product->product_category/$product->product_code/cover.jpg") }}" alt="">
                        @endif
                        <div class="delete-button btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <i class="fa-solid fa-add"></i>
                        <p class="cover-text">{{ __('product.upload-cover') }}</p>
                    </div>
                </label>
            </div>
    
            <!-- Product Image-->
            <div class="product-image">
    
                <!-- Unit of image-->
                @for ($i = 0; $i < 10; $i++)
                <div class="product-image-box box-list">
                    <input data-slot="product-{{ $i+1 }}" type="file" name="product-image-{{ $i+1 }}" id="product-image-{{ $i+1 }}" class="product-image" accept=".jpg, .jpeg, .bmp, .png, .svg">
                    <label for="product-image-{{ $i+1 }}" class="form-label">
                        <div class="upload-image preview">
                            @if (count($productImages) > $i)
                            <img class="image-preview" src="{{ asset("storage/$productImages[$i]") }}" alt="" onerror="this.style.display='none'" onload="this.style.display='block'">
                            <div class="delete-button btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                            @else
                                <img class="image-preview" src="" alt="" onerror="this.style.display='none'" onload="this.style.display='block'">
                                <div class="delete-button btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                    <i class="fa-solid fa-trash"></i>
                                </div>
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

        <div class="content name-content">

            <!-- existent record-->
            @foreach ($product->getProductName() as $name)
                <div class="name">
                    <input class="form-control" type="text" name="fullname[]" id="" placeholder="{{ __('product.name') }}" value="{{ $name->name }}">
                </div>
            @endforeach

            <!-- blank record -->
            @for ($i = 0; $i < 10-count($product->getProductName()); $i++)
                <div class="name">
                    <input class="form-control" type="text" name="fullname[]" id="" placeholder="{{ __('product.name') }}">
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
                    <div class="image box-list">
                        <input class="brand-image" data-slot="brand-{{ $index+1 }}" type="file" name="brand-image-{{ $index }}" id="brand-image-{{ $index }}">
                        <label for="brand-image-{{ $index }}">
                            @if (Storage::disk('public')->exists("/product/$product->product_category/$product->product_code/". str_replace(' ', '%20', urlencode($brand->code)) . "/cover.jpg"))
                                <img class="brand-preview" onerror="this.style.display='none'" onload="this.style.display ='block'" src="{{ asset("storage/product/$product->product_category/$product->product_code/". str_replace('+', '%20', urlencode($brand->code)) . "/cover.jpg") }}" alt="" class="image-upload">
                            @else
                                <img class="brand-preview" onerror="this.style.display='none'" onload="this.style.display ='block'" src="{{ asset("storage/product/$product->product_category/$product->product_code/". str_replace('+', '%20', urlencode($brand->code)) . "/cover.png") }}" alt="" class="image-upload">
                            @endif

                            <div class="delete-button btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                <i class="fa-solid fa-trash"></i>
                            </div>
                            <i class="fa-solid fa-add"></i>
                            <p class="image-text">{{ __('product.upload') }}</p>
                        </label>
                    </div>

                    <!-- Brand 品牌 -->
                    <div class="brand">
                        <label for="" class="form-label">{{ __('product.brand') }}</label>
                        <select class="form-control" name="brand[]" id="">
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
                        <label for="" class="form-label">{{ __('product.frozen-code') }}</label>
                        {{-- <div class="input-group"> --}}
                            {{-- <span class="input-group-text" id="basic-addon1">FZ-</span> --}}
                            <input class="form-control" type="text" name="frozen-code[]" value="{{ $brand->frozen_code }}">
                        {{-- </div> --}}
                    </div>

                </div>

            @endforeach

            
            <!-- blank record -->
            @php
                $i = count($product->getProductBrand())+2;
            @endphp
            @for ($i = (count($product->getProductBrand())+1); $i < 10; $i++)
            
            <div class="brand-box">
                
                <!-- Brand Image 品牌照片 -->
                <div class="image box-list">
                    <input class="brand-image" data-slot="brand-{{ $i }}" type="file" name="brand-image-{{ $i }}" id="brand-image-{{ $i }}" value="slot-{{ $i }}">
                    <label for="brand-image-{{ $i }}">
                        <img class="brand-preview" src="" alt="" class="image-upload" onerror="this.style.display = 'none'" onload="this.style.display ='block'" >
                        <div class="delete-button btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                        <i class="fa-solid fa-add"></i>
                        <p class="image-text">{{ __('product.upload') }}</p>
                    </label>
                </div>

                <!-- Brand 品牌 -->
                <div class="brand">
                    <select class="form-control" name="brand[]" id="">
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
                    {{-- <div class="input-group"> --}}
                        {{-- <span class="input-group-text" id="basic-addon1">FZ-</span> --}}
                        <input class="form-control" type="text" name="frozen-code[]" value="" placeholder="{{ __('product.frozen-code') }}">
                    {{-- </div> --}}
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
                <select name="category" id="" class="form-control">
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
                <select name="type" id="" class="form-control">
                    @foreach ($types as $type)
                    <option value="{{ $type->name }}" {{ $product->product_type == $type->name ? "selected" : ""}}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

        </section>

    </section>

    <!-- Button -->
    <button class="btn btn-primary">{{ __('product.submit') }}</button>

</form>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\edit-product-detail.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js/backend/admin/product/edit-product-detail.js') }}"></script>
@endpush