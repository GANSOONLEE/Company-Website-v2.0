@inject('brands', 'App\Domains\Brand\Models\Brand')
@inject('categories', 'App\Domains\Category\Models\Category')
@inject('products', 'App\Domains\Product\Models\Product')

@extends('backend.layouts.app')

@section('title', __('order.detail'))

@section('subtitle', __('order.detail-description'))

@section('main')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
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
                        <span class="sr-only">@lang('order.remark')</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->detail()->get() as $index => $item)
                    @php
                        $cateogry = $products
                            ->where(
                                'product_code',
                                DB::table('products_brand')
                                    ->where('code', $item->sku_id)
                                    ->first()->product_code,
                            )
                            ->first()->product_category;
                    @endphp
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:!bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $cateogry }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->sku_id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->number }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="relative">
                                <input type="text" id="input-group-1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-4 !pe-8 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="{{ __('order.remark') }}">
                                <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none">
                                    <i class="fa-solid fa-pen"></i>
                                </div>
                            </div>
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
