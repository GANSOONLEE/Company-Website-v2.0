
@inject('cartData', 'App\Domains\Cart\Models\Cart')

@extends('backend.layouts.app')

@section('title', 'Cart')

@section('subtitle', 'The product you add to cart.')

@section('main')

    <div class="bg-white dark:!bg-gray-800 relative shadow-md sm:rounded-sm overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <x-form.get :action="route('backend.user.cart.searchByText')" class="flex items-center mb-0">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-search"></i>
                        </div>
                        <input type="text" name="searchTerm" value="{{ request()->input('searchTerm') }}" class="bg-gray-50 border border-gray-300 !ps-10 text-gray-900 text-sm rounded-sm focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search product name, brand...">
                    </div>
                </x-form.get>
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">

                <a href="{{ route('frontend.product.index') }}" class="flex items-center justify-center text-white !bg-primary-700 hover:!bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-sm text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    <i class="fa-solid fa-add mr-2"></i>
                    Add product
                </a>

                <x-form.post :action="route('backend.user.order.store')">
                    <button type="submit" href="{{ route('backend.user.order.store') }}" class="flex items-center justify-center text-white !bg-green-700 hover:!bg-green-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-sm text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                        <i class="fa-solid fa-file mr-2"></i>
                        Make order
                    </button>
                </x-form.post>

                <div class="flex items-center space-x-3 w-full md:w-auto relative">

                    <!-- Dropdown Button -->
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-sm border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:!bg-gray-800 dark:!text-white dark:!border-gray-700 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                        <i class="fa-solid fa-filter mr-2"></i>
                        Filter
                        <i class="fa-solid fa-chevron-down ml-1.5"></i>
                    </button>

                    <!-- Dropdown List -->
                    <x-form.get class="fixed" :action="route('backend.user.cart.searchByCategory')">
                        <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-sm shadow dark:!bg-gray-700">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose category</h6>
                            <ul class="relative space-y-2 text-sm max-h-50 overflow-y-auto pb-2" aria-labelledby="filterDropdownButton">
    
                                <!-- Select All -->
                                <li class="sticky py-2 top-0 flex items-center bg-white dark:!bg-gray-700 border-b-[1px]">
                                    <input id="All" onchange="selectAll(event)" type="checkbox" value="All" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ request()->input('categories') ? array_diff($cartData->byCategory()->pluck('product_category')->toArray(), request()->input('categories')) === [] ? 'checked' : '' : 'checked' }}>
                                    <label for="All" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">All ({{ $carts->total() }})</label>
                                </li>

                                @foreach ($cartData->byCategory() as $category)
                                    <li class="flex items-center">
                                        <input role="category-checkbox" name="categories[]" onchange="checkAreSelectAll(event)" id="{{ $category->product_category }}" type="checkbox" value="{{ $category->product_category }}" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" {{ request()->input('categories') ? in_array($category->product_category, request()->input('categories')) ? 'checked' : '' : 'checked' }}>
                                        <label for="{{ $category->product_category }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $category->product_category . " ($category->category_count)" }}</label>
                                    </li>
                                @endforeach
    
                            </ul>
    
                            <!-- footer -->
                            <div class="py-2 border-t-[1px]">
                                <p class="text-xs"> 
                                    Selected <span id="selectCount">{{ request()->input('categories') ? count(request()->input('categories')) : $cartData->byCategory()->count() }}</span> category
                                </p>
                                <button class="flex items-center justify-center mt-2 text-white !bg-blue-700 hover:!bg-blue-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-sm text-sm px-2 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Search</button>
                            </div>
    
                        </div>
                    </x-form.get>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($carts->count() > 0)
                        @foreach ($carts as $index => $cart)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $index + 1 }}
                                </th>
                                <td class="px-6 py-2">
                                    {{ $cart->productName()->first()->name }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $cart->product()->first()->product_category }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $cart->sku_id }}
                                </td>
                                <td class="px-6 py-2">
                                    <input type="number" name="quantity" data-brand="{{ $cart->sku_id }}" data-quantity="{{ $cart->number }}" onchange="updateQuantity(event)" min="0" max="500" value="{{ $cart->number }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </td>
                                <td class="px-6 py-2">
                                    <a href="{{ route('frontend.product.detail', ["productCode" => $cart->product()->first()->product_code]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Link</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-3 text-center text-xl font-bold" colspan="6">You haven't any cart yet.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">

            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white">{{ $carts->firstItem() }} - {{ $carts->lastItem() }}</span>
                of
                <span class="font-semibold text-gray-900 dark:text-white">{{ $carts->total() }}</span>
            </span>
            
            {{ $carts->links() }}

        </nav>
    </div>

@endsection

@push('after-script')
    <script>

        function updateQuantity(event) {
            let quantityInput = event.target;
            let value = quantityInput.value;
            let brand = quantityInput.getAttribute('data-brand');
            let quantity = quantityInput.getAttribute('data-quantity');

            if (value == null || value == undefined) {
                return false;
            }

            if(value > 0) {
                sendPatchRequest(quantityInput, brand, value);
            }else {
                sendDeleteRequest(quantityInput, brand, value);
            }

        }

        function sendPatchRequest(target, brand, value) {

            let xhr = new XMLHttpRequest();
            xhr.open('POST', route('backend.user.cart.update', { brand: brand }), true);

            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    target.setAttribute('data-quantity', value);
                    console.info(xhr.responseText)
                } else if (xhr.readyState === 4) {
                    console.error('Error:', xhr);
                }
            };

            let formData = new FormData();
            formData.append('quantity', value)
            formData.append('_method', 'Patch')

            xhr.send(formData);

        }

        function sendDeleteRequest(target, brand, value) {

            if(!confirm('Do you sure you want to delete this?')){
            
                return false;
            }

            let xhr = new XMLHttpRequest();
            xhr.open('POST', route('backend.user.cart.delete', { brand: brand }), true);

            xhr.onreadystatechange = function () {
                if (xhr.status === 200) {
                    // check are response format correct
                    let data = JSON.parse(xhr.responseText);

                    // remove child
                    let row = target.closest('tr');
                    let rowParent = row.parentElement;
                    rowParent.removeChild(row);
                }
            };

            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

            let formData = new FormData();
            formData.append('_method', 'Delete')

            xhr.send(formData);
        }

        // Animation checkbox select all

        const selectAllCheckbox = document.querySelector('#All');
        const categoryCheckboxes = document.querySelectorAll('[role="category-checkbox"]');
        const selectCount = document.querySelector('#selectCount');

        function selectAll(event) {
            let target = event.target;
            let areSelected = target.checked;

            categoryCheckboxes.forEach(categoryCheckbox => {
                categoryCheckbox.checked = areSelected;
            });

            selectCount.innerText = document.querySelectorAll('input[role="category-checkbox"]:checked').length;
        }

        function checkAreSelectAll(event) {
            let target = event.target;
            let areSelected = target.checked;

            // convert to array
            let checkedArray = Array.from(categoryCheckboxes)
            selectAllCheckbox.checked = checkedArray.every(item => item.checked);

            selectCount.innerText = document.querySelectorAll('input[role="category-checkbox"]:checked').length;
        }

    </script>
@endpush