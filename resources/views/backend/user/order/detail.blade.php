
@inject('brands', 'App\Domains\Brand\Models\Brand')
@inject('categories', 'App\Domains\Category\Models\Category')
@inject('products', 'App\Domains\Product\Models\Product')

@extends('backend.layouts.app')

@section('title', "Order #$order->id")

@section('subtitle', 'Order Details')

@section('main')

    <div class="relative overflow-x-auto shadow-md rounded-lg !rounded-bl-none mt-3">
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
                    <tr class="bg-white border-b dark:!bg-gray-800 dark:border-gray-700 hover:!bg-gray-50 dark:hover:bg-gray-600">
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
                            <input onchange="updateQuantity(event)" data-brand="{{ $item->sku_id }}" data-order="{{ $order->id }}" class="bg-gray-200 focus:bg-gray-50" type="number" min="0" max="200" name="quantity" value="{{ $item->number }}" required>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add item -->
    {{-- <div class="flex justify-center gap-x-[.75rem] rounded-md !rounded-tl-none p-2 !px-[.75rem] w-max bg-[#e42910] hover:bg-[#EE4D2D] cursor-pointer text-white text-base">
        <i class="fa-solid fa-add"></i>Add Items
    </div> --}}

@endsection

@push('after-script')
    <script>
        function updateQuantity(event) {

            let xhr = new XMLHttpRequest();
            xhr.open('POST', route('backend.user.order.modifyItem', ['id' => event.target.getAttribute('data-order')]), true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    console.info(data);
                } else if (xhr.readyState === 4) {
                    console.error('Error:', xhr.status);
                }
            };

            let formData = new FormData();
            formData.append('brand', event.target.getAttribute('data-brand'),)
            formData.append('quantity', parseInt(event.target.value))
            formData.append('_method', 'Patch')

            xhr.send(formData);

        }
    </script>
@endpush