@extends('backend.admin.layouts.app')

@section('title', __('sidebar.category-edit'))

@section('main')


    <div class="header">
        <a href="{{ route('backend.admin.category.category-create') }}">
            <button type="button" class="create-category">
                <i class="create-category-icon fa-solid fa-add"></i>
                <p class="create-category-text">{{ __('category.create-category') }}</p>
            </button>
        </a>
    </div>

    <input type="text" id="searchInput" placeholder="{{ __('category.search') }}">

    <table class="data-table">
        <thead>
            <tr class="category-row-header">
                <th>{{ __('category.category-name') }}</th>
                <th>{{ __('category.category-cover') }}</th>
                @if(auth()->user()->getRoleEntity()->hasPermission('admin_category_delete'))
                <th>{{ __('category.category-button') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($categoryData as $category)
                @if(isset($category['entity']->id))
                <tr class="category-row-data" data-id="{{ $category['entity']->id }}">
                    <td class="editable" data-field="name">{{ $category['entity']->name }}</td>
                    <td>
                        <img src="{{ asset($category['cover']) }}" alt="{{ $category['entity']->name }}" width="100">
                    </td>
                    @if(auth()->user()->getRoleEntity()->hasPermission('admin_category_delete'))
                    <td id="delete-button">
                        <div class="delete-button">
                            <button class="button btn btn-danger">{{ __('category.delete') }}</button>
                        </div>
                    </td>
                    @endif
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    @include('backend.admin.category.edit-category-form')

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\category\management-category.css') }}">
    <link rel="stylesheet" href="{{ asset('css\backend\admin\category\edit-category-form.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\category\management-category.js') }}"></script>
@endpush