
@extends('backend.layouts.app')

@section('title', __('product.management-panel'))

@section('subtitle', __('product.management-panel-description'))

@section('main')

    <div class="mb-4">
        <x-form.get :action="route('backend.admin.product.search')">
            <div class="input-group">
                <button type="submit" class="input-group-text text-white bg-blue-600 dark:border-gray-800" id="basic-addon1">
                    <i class="fa-solid fa-search"></i>
                </button>
                <input autocomplete="off" value="{{ request()->input('searchTerm') }}" type="text" name="searchTerm" class="form-control border-none dark:bg-gray-600 dark:border-gray-800 placeholder-shown:text-white dark:text-white" placeholder="{{ __('Search') }} Code, Name, Brand or Car Model">
            </div>
        </x-form.get>
    </div>

    <table class="pb-2 w-full border-gray-400 rounded-lg shadow">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-800">
                <th class="px-3">@lang('Id')</th>
                <th>@lang('product.name')</th>
                <th>@lang('product.category')</th>
                <th class="py-3">@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productData as $product)
                <tr class="text-sm">
                    <td class="px-3 w-20">{{ $product->id }}</td>
                    <td class="w-96">{{ $product->name ?? ':(' }}</td>
                    <td class="w-60">{{ $product->product_category }}</td>
                    <td class="flex justify-content-start gap-x-4 align-items-center py-2">
                        <a class="w-18 flex justify-center btn btn-primary bg-primary text-nowrap" href="{{ route('backend.admin.product.edit', ["id" => $product->id]) }}"><i class="fa-solid fa-edit mr-2"></i>@lang('Edit')</a>
                        <a class="w-18 flex justify-center btn btn-danger bg-danger text-nowrap ml-3" href="{{ route('backend.admin.product.delete', ["id" => $product->id]) }}"><i class="fa-solid fa-trash mr-2"></i>@lang('Delete')</a>
                        <a target="_product" class="w-18 flex justify-center btn btn-link text-nowrap ml-3" href="{{ route('frontend.product.detail', ["productCode" => $product->product_code]) }}"><i class="fa-solid fa-arrow-up-right-from-square mr-2"></i>@lang('Link')</a>
                    </td>
                </tr>
            @empty
                <td class="py-3 text-2xl text-center text-gray-600 font-bold" colspan="4">@lang('No Record')</td>
            @endforelse
        </tbody>
    </table>

    {{ $productData->links() }}

@endsection

@push('before-style')
   
@endpush

@push('after-script')

@endpush