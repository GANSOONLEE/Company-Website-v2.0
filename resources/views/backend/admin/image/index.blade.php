
@extends('backend.layouts.app')

@section('title', __('sidebar.image-management-center'))

@section('subtitle', __('sidebar.image-management-center-description'))

@section('main')

    <div class="flex flex-wrap space-x-between mb-4">
    
        <x-control-panel title="{{ __('image.management-panel') }}" showButton="true" button-href="{{ route('backend.admin.image.management') }}" button-text="{{ __('image.management-panel-label') }}">
            @lang('image.management-panel-description')
        </x-control-panel>

        <x-control-panel title="{{ __('image.permission-panel') }}" showButton="true" button-href="{{ route('backend.admin.image.permission') }}" button-text="{{ __('image.permission-panel-label') }}">
            @lang('image.permission-panel-description')
        </x-control-panel>
        
    </div>

@endsection