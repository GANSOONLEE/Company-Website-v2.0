@inject('brands', 'App\Domains\Brand\Models\Brand')
@inject('categories', 'App\Domains\Category\Models\Category')
@inject('products', 'App\Domains\Product\Models\Product')

@extends('backend.layouts.app')

@section('title', __('order.detail'))

@section('subtitle', __('order.detail-description'))

@section('main')

    <div class="flex justify-between items-center">

        <button class="">@lang('order.complete')</button>

        <a href="{{ route('backend.admin.order.document.pdf', ['orderId' => $order->id]) }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fa-solid fa-file w-3.5 h-3.5 me-2"></i>
            @lang('order.download-pdf')
        </a>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="dark:text-white">
                    <th scope="col" class="px-6 py-3">
                        @lang('Id')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('product.category')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('order.product-code')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('order.number')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('order.remark')
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($order->sortDetailByCategory()->get() as $index => $item)

                    <tr class="bg-white border-b dark:!bg-gray-800 dark:border-gray-700 hover:!bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->product_category }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->code }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->number }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <x-form.patch :action="route('backend.admin.order.update', ['id' => $item->detail_id])" class="relative flex gap-x-[1rem]">
                                <div class="relative">
                                    <input type="text" id="input-group-1"
                                    name="remark" value="{{ $item->detail_remarks }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full ps-[.5rem] !pe-8 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="{{ __('order.remark') }}">
                                    <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none">
                                        <i class="fa-solid fa-pen"></i>
                                        <span class="sr-only">Edit</span>
                                    </div>
                                </div>
                                <button class="rounded-sm bg-primary text-white px-4" type="submit">@lang('Update')</button>
                            </x-form.patch>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection

@push('after-style')
@endpush

@push('after-script')
@endpush
