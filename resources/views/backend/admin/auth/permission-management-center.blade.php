
@extends('backend.layouts.app')

@section('title', __('sidebar.permission-management-center'))

@section('subtitle', __('sidebar.permission-management-center-description'))

@section('main')

    <div class="flex flex-wrap space-x-between mb-4">
    
        <x-control-panel title="{{ __('permission.management-panel') }}" showButton="true" button-href="{{ route('backend.admin.permission.management') }}" button-text="{{ __('permission.management-panel-label') }}">
            @lang('permission.management-panel-description')
        </x-control-panel>
        
    </div>

@endsection