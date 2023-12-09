
@inject('roles', 'App\Domains\Auth\Models\Role')
@inject('users', 'App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('user.management-panel'))

@section('subtitle', __('user.management-panel-description'))

@section('main')

    

@endsection

@push('after-script')

@endpush