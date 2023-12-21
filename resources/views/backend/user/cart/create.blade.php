
@extends('backend.layouts.app')

@section('title', 'Cart')

@section('subtitle', 'The product you add to cart.')

@section('main')

    <div class="mb-3 w-full flex justify-content-end align-items-center gap-x-4">
        <x-form.post :action="route('backend.admin.order.store')">
            <input type="text" name="selectedCheckbox" id="selectedCheckbox" value="" hidden>
            <button type="submit" class="btn btn-primary bg-primary">Make Order</button>
        </x-form.post>
        <div id="reset-cart-button"></div>
    </div>

    @if(session('success'))
        <script>
            localStorage.removeItem('selectedIds');
        </script>
    @endif

    <table class="w-full">
        <thead>
            <tr class="bg-gray-400 dark:bg-gray-800">
                <th id="select-all-checkbox" class="flex justify-center align-items-center py-4"></th>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Qty.</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="mt-2">
            @foreach (auth()->user()->cart()->byProductName()->paginate(10) as $cart)
            <tr class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700">
                <td class="w-18">
                    <div id="cart-checkbox" class="flex justify-center align-items-center">
                        <input type="checkbox" data-input="row-{{ $cart->id }}">
                    </div>
                </td>
                <td class="w-18" data-column="id" id="row-{{ $cart->id }}">{{ $cart->id }}</td>
                <td class="w-80">{{ $cart->productName()->first()->name }}</td>
                <td class="w-40">{{ $cart->product()->first()->product_category }}</td>
                <td class="w-30">{{ $cart->productBrand()->first()->brand }}</td>
                <td class="w-20">{{ $cart->number }}</td>
                <td class="w-40">
                    <div class="py-2 flex justify-content-between">
                        <a href="#">
                            <button class="flex justify-center gap-x-2 btn btn-primary bg-primary">
                                <i class="fa-solid fa-pen mr-2"></i>Edit
                            </button>
                        </a>
                        <a href="{{ route('frontend.product.detail', ["productCode" => $cart->product()->first()->product_code]) }}">
                            <button class="flex justify-center gap-x-2 btn btn-link bg-link dark:text-white">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-2"></i>Link
                            </button>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ auth()->user()->cart()->byUpdateTime()->paginate(10)->links() }}

@endsection

@push('after-style')

@endpush

@push('after-script')

@endpush