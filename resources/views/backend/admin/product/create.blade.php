
@inject('products', 'App\Domains\Product\Models\Product')

@extends('backend.layouts.app')

@section('title', __('product.create-panel'))

@section('subtitle', __('product.create-panel-description'))

@section('main')

@php
    
@endphp

    @include('backend.admin.product.create-form')

@endsection