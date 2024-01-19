

@extends('backend.layouts.app')

@section('title', __('sidebar.admin'))

@section('subtitle', __('sidebar.admin-description'))

@section('main')

    <div class="flex flex-column w-full dark:text-rose-500">

        <h4 class="flex justify-content-start align-items-center text-2xl font-bold mb-2"><i class="fa-solid fa-shopping-cart mr-2"></i>@lang('sidebar.product')</h4>

        <div class="flex flex-wrap space-x-between mb-4 dm:sm:flex-nowrap dm:sm:flex-col">
    
            <x-control-panel title="{{ __('product.create-panel') }}" showButton=true button-href="{{ route('backend.admin.product.create') }}" button-text="{{ __('product.create-panel-label') }}" button-color="dark:bg-rose-600 dark:hover:bg-rose-700">
                @lang('product.create-panel-description')
            </x-control-panel>
    
            <x-control-panel title="{{ __('product.management-panel') }}" showButton=true button-href="{{ route('backend.admin.product.management') }}" button-text="{{ __('product.management-panel-label') }}" button-color="dark:bg-rose-600 dark:hover:bg-rose-700">
                @lang('product.management-panel-description')
            </x-control-panel>
            
        </div>

    </div>

    <div class="flex flex-column w-full dark:text-sky-400">

        <h4 class="flex justify-content-start align-items-center text-2xl font-bold mb-2"><i class="fa-solid fa-file mr-2"></i>@lang('sidebar.order')</h4>

        <div class="flex flex-wrap space-x-between mb-4 dm:sm:flex-nowrap dm:sm:flex-col">
    
            <x-control-panel title="{{ __('order.view-order') }}" showButton=true button-href="{{ route('backend.admin.order.index') }}" button-text="{{ __('order.view-order-panel-label') }}" button-color="dark:bg-sky-500 dark:hover:bg-sky-600">
                @lang('order.view-order-panel-description')
            </x-control-panel>
    
            <x-control-panel title="{{ __('order.history-order') }}" showButton=true button-href="{{ route('backend.admin.order.list') }}" button-text="{{ __('order.history-order-panel-label') }}" button-color="dark:bg-sky-500 dark:hover:bg-sky-600">
                @lang('order.history-order-panel-description')
            </x-control-panel>
            
        </div>

    </div>

    <div class="flex flex-column w-full dark:text-emerald-500">

        <h4 class="flex justify-content-start align-items-center text-2xl font-bold mb-2"><i class="fa-solid fa-user-tie mr-2"></i>@lang('sidebar.management-center')</h4>

        <div class="flex flex-wrap space-x-between mb-4 dm:sm:flex-nowrap dm:sm:flex-col">
    
            <x-control-panel title="{{ __('user.management-panel') }}" showButton="true" button-href="{{ route('backend.admin.user.management') }}" button-text="{{ __('user.management-panel-label') }}" button-color="dark:bg-emerald-600 dark:hover:bg-emerald-700">
                @lang('user.management-panel-description')
            </x-control-panel>
    
            <x-control-panel title="{{ __('role.management-panel') }}" showButton="true" button-href="{{ route('backend.admin.role.management') }}" button-text="{{ __('role.management-panel-label') }}" button-color="dark:bg-emerald-600 dark:hover:bg-emerald-700">
                @lang('role.management-panel-description')
            </x-control-panel>
            
        </div>

    </div>


@endsection