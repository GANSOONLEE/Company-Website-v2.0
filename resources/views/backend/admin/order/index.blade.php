
@extends('backend.layouts.app')

@section('title', __('order.view-order'))

@section('subtitle', __('order.view-order-description'))

@section('main')

    <x-backend.admin.orderTab>

        <x-slot name="pending">
            1
        </x-slot>

        <x-slot name="accepted">
            2
        </x-slot>

        <x-slot name="process">
            3
        </x-slot>

        <x-slot name="placed">
            4
        </x-slot>

        <x-slot name="completed">
            5
        </x-slot>

    </x-backend.admin.orderTab>

@endsection

@push('after-style')

@endpush

@push('after-script')

@endpush