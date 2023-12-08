@extends('backend.admin.layouts.app')

@section('title', __('sidebar.brand-edit'))

@section('main')


    <div class="header">
        <a href="{{ route('backend.admin.brand.brand-create') }}">
            <button type="button" class="create-brand">
                <i class="create-brand-icon fa-solid fa-add"></i>
                <p class="create-brand-text">{{ __('brand.create-brand') }}</p>
            </button>
        </a>
    </div>

    <input type="text" id="searchInput" placeholder="{{ __('brand.search') }}">

    <table class="data-table">
        <thead>
            <tr class="brand-row-header">
                <th>{{ __('brand.brand-name') }}</th>
                <th>{{ __('brand.brand-cover') }}</th>
                @if(auth()->user()->getRoleEntity()->hasPermission('admin_brand_delete'))
                <th>{{ __('brand.brand-button') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($brandData as $brand)
                @if(isset($brand['entity']->id))
                <tr class="brand-row-data" data-id="{{ $brand['entity']->id }}">
                    <td class="editable" data-field="name">{{ $brand['entity']->name }}</td>
                    <td>
                        <img src="{{ asset($brand['cover']) }}" alt="{{ $brand['entity']->name }}" width="100">
                    </td>
                    @if(auth()->user()->getRoleEntity()->hasPermission('admin_brand_delete'))
                    <td id="delete-button">
                        <div class="delete-button">
                            <button class="button btn btn-danger">{{ __('brand.delete') }}</button>
                        </div>
                    </td>
                    @endif
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    @include('backend.admin.brand.edit-brand-form')

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\brand\management-brand.css') }}">
    <link rel="stylesheet" href="{{ asset('css\backend\admin\brand\edit-brand-form.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\brand\management-brand.js') }}"></script>
@endpush