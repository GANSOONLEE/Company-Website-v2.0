@extends('backend.admin.layouts.app')

@section('title', __('order.order-detail'))

@section('main')

    {{ Breadcrumbs::render('orderDetail-admin', $order) }}

    <section class="order" data-order-code={{ $order->code }}>

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
                <p id="created_at">{{ $order->created_at->addHours(8) }}</p>
            </div>

        </div>

        <!-- Title -->
        <div class="order-table">

            <div class="order-title">
                <p>{{ __('order.product-category') }}</p>
                {{-- <p>{{ __('order.propduct-type') }}</p> --}}
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
                        {{-- <p>{{ $item->product_type }}</p> --}}
                        <p>{{ \App\Models\Brand::findProductName($item->code) }}</p>
                        {{-- <p>{{ $item->brand }}</p> --}}
                        <p>{{ $item->code }}</p>
                        <p>{{ $item->number }}</p>
                    </div>

                </a>
                @endforeach
            </div>

        </div>

        <!-- Footer -->
        <div class="order-footer">
            <p>{{ __('order.item-count', ["count"=>$order->getItemCount()]) }}</p>

            <!-- follow status to display button -->
            <div class="button-area">

            <a target="_download" href="{{ route('backend.admin.order.order-detail-pdf', ['orderID'=> $order->code]) }}">
                <button class="btn btn-success" type="button">{{ __('order.download-pdf') }}</button>
            </a>

            @if ($order->status === "Placed")
                <!-- If placed -->
                <button class="btn btn-primary" type="button" data-button="Accepted">{{ __('order.accepted') }}</button>
            @elseif($order->status === "Accepted")
                <!-- If accepted -->
                <button class="btn btn-primary" type="button" data-button="In Progress">{{ __('order.in-progress') }}</button>
            @elseif($order->status === "In Progress")
                <button class="btn btn-secondary" type="button" data-button="On Hold">{{ __('order.on-hold') }}</button>
                <button class="btn btn-primary" type="button" data-button="Completed">{{ __('order.completed') }}</button>
            @elseif($order->status === "On Hold")
                <!-- If on-hold -->
                <button class="btn btn-primary" type="button" data-button="In Progress">{{ __('order.in-progress') }}</button>
            @elseif($order->status === "Completed")
                <button class="btn btn-primary" type="button" disabled>{{ __('order.completed') }}</button>
            @endif
            </div>
        </div>

    </section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\order\order-detail.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\order\order-detail.js') }}"></script>
@endpush