
@extends('backend.layouts.app')

@section('title', __('sidebar.role-management-center'))

@section('subtitle', '管理身份組的權限和身分組相關的行爲')

@section('main')

    <div class="flex flex-wrap space-x-between mb-4 dm:sm:flex-nowrap dm:sm:flex-col">
            
        <x-control-panel title="{{ __('role.create-panel') }}" showButton="true" button-href="{{ route('backend.admin.role.create') }}" button-text="{{ __('role.create-panel-label') }}">
            @lang('role.create-panel-description')
        </x-control-panel>

        <x-control-panel title="{{ __('role.management-panel') }}" showButton="true" button-href="{{ route('backend.admin.role.management') }}" button-text="{{ __('role.management-panel-label') }}">
            @lang('role.management-panel-description')
        </x-control-panel>
        
    </div>

@endsection