@extends('backend.admin.layouts.app')

@section('title', __('order.order-detail'))

@section('main')

    {{ Breadcrumbs::render('orderDetail-admin', $order) }}

    <section class="order">

        <!-- Header -->
        <div class="order-header">

            <!-- customer -->
            <div class="customer-information">
                <p id="customer-shop-name">{{ $order->getUserInformation()->shop_name }}</p>
                <p id="customer-whatsapp-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
            </div>

            <!-- order -->
            <div class="order-information">
                <p id="order-status">{{ $order->status }}</p>
                <p id="created_at">{{ $order->created_at }}</p>
            </div>

        </div>

        <!-- Title -->
        <div class="order-title">
            <p>{{ __('order.product-category') }}</p>
            <p>{{ __('order.propduct-type') }}</p>
            <p>{{ __('order.product-name') }}</p>
            <p>{{ __('order.product-code') }}</p>
            <p>{{ __('order.number') }}</p>
        </div>

        <!-- Content -->
        <div class="order-content">

            <!-- item -->
            @foreach (($order->getOrderItems()) as $item)
            <a href="{{ route('frontend.product-detail', ["productCode" => $item->product_code]) }}" class="item-box">

                <!-- information -->
                <div class="item-information">
                    <p>{{ $item->product_category }}</p>
                    <p>{{ $item->product_type }}</p>
                    <p>{{ $item->name }}</p>
                    {{-- <p>{{ $item->brand }}</p> --}}
                    <p>{{ $item->code }}</p>
                    <p>{{ $item->number }}</p>
                </div>

            </a>
            @endforeach

        </div>

        <!-- Footer -->
        <div class="order-footer">
            {{ __('order.item-count', ["count"=>$order->getItemCount()]) }}
        </div>

    </section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\order\order-detail.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\order\order-detail.js') }}"></script>
@endpush