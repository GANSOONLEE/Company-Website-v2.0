
@extends('backend.layouts.app')

@section('title', __('sidebar.user-management-center'))

@section('subtitle', __('sidebar.user-management-center-description'))

@section('main')

    <div class="flex flex-wrap space-x-between mb-4">
        
        <x-control-panel title="{{ __('user.create-panel') }}" showButton="true" button-href="{{ route('backend.admin.user.create') }}" button-text="{{ __('user.create-panel-label') }}">
            @lang('user.create-panel-description')
        </x-control-panel>
    
        <x-control-panel title="{{ __('user.management-panel') }}" showButton="true" button-href="{{ route('backend.admin.user.management') }}" button-text="{{ __('user.management-panel-label') }}">
            @lang('user.management-panel-description')
        </x-control-panel>
        
    </div>

    <div class="flex flex-wrap space-x-between mb-4">
    
        <x-control-panel title="{{ __('user.permission-panel') }}" showButton="true" button-href="{{ route('backend.admin.user.permission') }}" button-text="{{ __('user.permission-panel-label') }}">
            @lang('user.permission-panel-description')
        </x-control-panel>
        
        <x-control-panel title="{{ __('user.banned-panel') }}" showButton="true" button-href="{{ route('backend.admin.user.ban') }}" button-text="{{ __('user.banned-panel-label') }}">
            @lang('user.banned-panel-description')
        </x-control-panel>
        
    </div>

@endsection