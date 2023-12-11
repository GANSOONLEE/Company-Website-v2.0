
@inject('products', 'App\Domains\Product\Models\Product')

@extends('backend.layouts.app')

@section('title', __('sidebar.product'))

@section('subtitle', __('sidebar.product-description'))

@section('main')

    <div class="flex flex-wrap space-x-between mb-4 dm:sm:flex-nowrap dm:sm:flex-col">

        <x-control-panel title="{{ __('product.create-panel') }}" showButton=true button-href="{{ route('backend.admin.product.create') }}" button-text="{{ __('product.create-panel-label') }}">
            @lang('product.create-panel-description')
        </x-control-panel>

        <x-control-panel title="{{ __('product.management-panel') }}" showButton=true button-href="{{ route('backend.admin.product.management') }}" button-text="{{ __('product.management-panel-label') }}">
            @lang('product.management-panel-description')
        </x-control-panel>
        
    </div>

@endsection