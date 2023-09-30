@extends('backend.admin.layouts.app')

@section('title', __('order.order-detail'))

@section('main')

    <section class="order">

        <!-- Header -->
        <div class="order-header">

            <!-- customer -->
            <div class="customer-information">


            </div>

            <!-- order -->
            <div class="order-informatino">
                
            </div>

        </div>

        <!-- Content -->
        <div class="order-content">

            <!-- item -->
            @foreach (($order->getOrderItems()) as $item)
                @php
                    $brand = DB::table('products_brand')
                        ->where('sku_id', $item->sku_id)
                        ->first();

                    $product = DB::table('products')
                        ->where('product_code', $brand->product_code)
                        ->first();

                    $category = $product->product_category;
                @endphp

            <a href="" class="item-box">

                <!-- information -->
                <div class="item-information">
                    {{ $category }}
                </div>

                <!-- remark -->
                <div class="item-remark">

                </div>
            </a>
            @endforeach

        </div>

        <!-- Footer -->
        <div class="order-footer">

        </div>

    </section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\order\order-detail.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\order\order-detail.js') }}"></script>
@endpush