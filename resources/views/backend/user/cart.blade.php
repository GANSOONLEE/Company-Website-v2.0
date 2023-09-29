@extends('backend.user.layouts.app')

@section('title', 'Cart')

@section('main')

<div id="alert">
    <bootstrap-alert></bootstrap-alert>
</div>

<section class="cart">

    <!-- filter -->
    <section class="filter flex-column">

        <p class="filter-title">Filter</p>

        <div class="filter-container flex-row">
            <div class="filter category-filter flex-column">
    
                <label class="form-label" for="">Category</label>
                <select class="form-select" data-search-input="category" name="" id="">
                    <option value="all"> -- Clear Filter -- </option>
                    @foreach ($categoryData as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
    
            </div>
    
            <div class="filter type-filter flex-column">
    
                <label class="form-label" for="">Type</label>
                <select class="form-select" data-search-input="type" name="" id="">
                    <option value="all"> -- Clear Filter -- </option>
                    @foreach ($typeData as $typeData)
                        <option value="{{ $typeData->name }}">{{ $typeData->name }}</option>
                    @endforeach
                </select>
    
            </div>
        </div>


    </section>

    <!-- cart list -->
    <section class="cart-list">

        <div class="cart-list-header flex-row">
            <div class="button-area flex-row">
                <a class="btn btn-success" href="" id="refresh">
                    <i class="fa-solid fa-refresh"></i>
                    <button>Refresh</button>
                </a>
    
                <a class="btn btn-primary" href="{{ route('frontend.category') }}">
                    <i class="fa-solid fa-shopping-cart"></i>
                    <button>Goto Shop</button>
                </a>
            </div>

            <div class="button-area flex-row">
                <a class="btn" id="create-order">
                    <i class="fa-solid fa-add"></i>
                    <button>Create Order</button>
                </a>
            </div>
        </div>

        <div class="cart-list-body">

            <table data-select-table="table">
                <thead>
                    <tr>
                        {{-- <th>SKU ID</th> --}}
                        <th></th>
                        <th>Image</th>
                        <th>Product Name</th>
                        {{-- <th>Product Code</th> --}}
                        <th>Category</th>
                        <th>Product Type</th>
                        <th>Brand Code</th>
                        <th>Number</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Cart -->
                    @foreach ($cartData as $cart)
                    @php
                        $name = $cart->getProductInformationEntity()->getProductName()[0]->name;
                        $product_code = $cart->getProductInformation('product_code');
                        $category = $cart->getProductInformation('product_category');
                        $type = $cart->getProductInformation('product_type');
                        $brand = $cart->getBrandInformation('brand');
                        $sku_id = $cart->getBrandInformation('sku_id');
                        $code = $cart->getBrandInformation('code');
                        $number = $cart->number;
                    @endphp
                    <tr>
                        {{-- <td>{{ $cart->sku_id }}</td> --}}
                        <td>
                            <input data-sku-id="{{ $sku_id }}" data-number="{{ $number }}" type="checkbox" name="" id="">
                        </td>
                        <td>
                            <a target="_product" href="{{ route('frontend.product-detail', ["productCode"=>$product_code]) }}">
                                <img src="{{ asset("storage/product/$category/$product_code/$code/cover.png") }}" alt="">
                            </a>
                        </td>
                        <td data-select-column="name">{{ $name }}</td>
                        <td data-select-column="name" class="sku-id" style="display: none" id="{{ $sku_id }}">{{ $sku_id }}</td>
                        {{-- <td data-select-column="product_code">{{ $product_code }}</td> --}}
                        <td data-select-column="category">{{ $category }}</td>
                        <td data-select-column="type">{{ $type }}</td> 
                        <td data-select-column="code">{{ $code }}</td>
                        <td data-select-column="number">
                            <div class="editable popovers-edit">
                                <div class="number flex-row">
                                    <p>{{ $number }}</p>
                                    <i class="fa-solid fa-pen"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </section>

</section>

<div class="popovers">

    <form>
        @csrf
        <div class="popovers-header">
            <p class="popovers-title">Edit number</p>
        </div>
        
        <div class="popovers-content">
            <input type="text" id="brand_code" style="display: none">
            <textarea name="number" id="number" cols="10" rows="2"></textarea>
        </div>
        
        <div class="popovers-footer">
            <button class="btn btn-primary" type="button" id="popover-update">Update</button>
        </div>

    </form>

</div>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\user\cart.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\user\cart.js') }}"></script>
@endpush
