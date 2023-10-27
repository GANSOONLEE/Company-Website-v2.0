@extends('backend.admin.layouts.app')

@section('title', __('sidebar.edit-product-detail'))

@section('main')

    <!-- Image Container -->
    <section class="container">

        <!-- Cover -->
        <div class="product-cover">
            <input type="file" name="" id="product-cover" class="product-cover">
            <label for="product-cover" class="form-label">
                <button class="upload-cover">
                    
                </button>
            </label>
        </div>

    </section>
    
    <!-- Name Container -->
    <section class="container">

    </section>
    
    <!-- Brand Container -->
    <section class="container">

    </section>
    
    <!-- Category & Type -->
    <section class="container">

        <section class="sub-container">

        </section>

        <section class="sub-container">

        </section>

    </section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\edit-product-detail.css') }}">
@endpush

@push('after-script')
    
@endpush