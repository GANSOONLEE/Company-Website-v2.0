@extends('backend.user.layouts.app')

@section('title', 'Cart')

@section('main')

<section class="cart">

    <!-- filter -->
    <section class="filter">

        <div class="filter category-filter flex-column">

            <label class="form-label" for="">Category</label>
            <select class="form-select" name="" id="">
                <option value=""></option>
                @foreach ($categoryData as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>

        </div>

    </section>

    <!-- cart list -->
    <section class="cart-list">

        <div class="cart-list-header">
            <a href="">
                <button>go to shop</button>
            </a>
        </div>

        <div class="cart-list-body">

            <table>
                <thead>
                    <tr>
                        {{-- <th>SKU ID</th> --}}
                        <th>Image</th>
                        <th>Product Code</th>
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
                        $product_code = $cart->getProductInformation('product_code');
                        $category = $cart->getProductInformation('product_category');
                        $type = $cart->getProductInformation('product_type');
                        $brand = $cart->getBrandInformation('brand');
                        $code = $cart->getBrandInformation('code');
                        $number = $cart->number;
                    @endphp
                    <tr>
                        {{-- <td>{{ $cart->sku_id }}</td> --}}
                        <td>
                            <img src="{{ asset("storage/product/$category/$product_code/$code/cover.png") }}" alt="">
                        </td>
                        <td name="product_code">{{ $product_code }}</td>
                        <td name="category">{{ $category }}</td>
                        <td name="type">{{ $type }}</td> 
                        <td name="code">{{ $code }}</td>
                        <td name="number">{{ $number }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </section>

</section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\user\cart.css') }}">
@endpush

@push('after-script')
    
@endpush

