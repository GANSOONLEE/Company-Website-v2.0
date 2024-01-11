
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
                        <td class="relative px-6 py-4">

                            <!-- Popup -->
                            <div id="top" class="absolute -top-8 w-[10rem] transition-all !duration-200" style="opacity: 0">
                                <div class="relative flex px-3 py-2 rounded-lg bg-white shadow">
                                    <p class="text-center" id="message">You can't delete the last item!</p>
                                    <button class="flex justify-end">
                                        <i class="fa-solid fa-xmark" onclick="this.closest('#top').style.opacity = '0'"></i>
                                    </button>
                                    <div class="absolute top-full left-[25%] -translate-y-[50%] bg-white w-[.75rem] h-[.75rem] rotate-45"></div>
                                </div>
                            </div>

                            <input onchange="updateQuantity(event)" data-brand="{{ $item->sku_id }}" data-quantity="{{ $item->number }}" data-order="{{ $order->id }}" class="bg-gray-200 focus:bg-gray-50" type="number" min="0" max="200" name="quantity" value="{{ $item->number }}" required>
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

            let brand = event.target.getAttribute('data-brand');
            let quantity = parseInt(event.target.value);

            if (quantity == null || quantity == undefined) {
                return false;
            }

            if(quantity > 0) {
                sendPatchRequest(event.target, brand, quantity);
            }else {
                sendDeleteRequest(event.target, brand, quantity);
            }

        }

        function sendPatchRequest(target, brand, quantity) {

            let xhr = new XMLHttpRequest();
            xhr.open('POST', route('backend.user.order.modifyItem', { id: event.target.getAttribute('data-order') }), true);

            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    target.setAttribute('data-quantity', quantity);
                } else if (xhr.readyState === 4) {
                    console.error('Error:', xhr);
                }
            };

            let formData = new FormData();
            formData.append('brand', brand)
            formData.append('quantity', quantity)
            formData.append('_method', 'Patch')

            xhr.send(formData);

        }
        
        function sendDeleteRequest(target, brand, quantity) {

            if(!confirm('Do you sure you want to delete this?')){
                return false;
            }

            let xhr = new XMLHttpRequest();
            xhr.open('POST', route('backend.user.order.dropItem', { id: event.target.getAttribute('data-order') }), true);

            xhr.onreadystatechange = function () {
                console.log(xhr.responseText)
                try{
                    if (xhr.status === 200) {
                        // check are response format correct
                        let data = JSON.parse(xhr.responseText);
    
                        // remove child
                        let row = target.closest('tr');
                        let rowParent = row.parentElement;
                        rowParent.removeChild(row);
                    }
                }catch (e) {
                    console.log(e)
                    let currentQuantity = target.getAttribute('data-quantity');
                    target.closest('td').querySelector('#top').style.opacity = 1
                    target.value = currentQuantity;
                }
            };

            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

            let formData = new FormData();
            formData.append('brand', brand)
            formData.append('_method', 'Delete')

            xhr.send(formData);
        }
        
    </script>
@endpush