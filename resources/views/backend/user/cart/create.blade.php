
@extends('backend.layouts.app')

@section('title', 'Cart')

@section('subtitle', 'The product you add to cart.')

@section('main')

    @if(session('success'))
        <script>
            
        </script>
    @endif

    <div class="flex justify-between mb-3 w-full">
        <a href="{{ route('frontend.product.index') }}">
            <button class="flex justify-center gap-x-4 btn btn-success">
                <i class="fa-solid fa-shopping-cart"></i>Goto Shop
            </button>
        </a>
        <div class="flex justify-content-end align-items-center gap-x-4">
            <x-form.post :action="route('backend.admin.order.store')">
                <input type="text" name="selectedCheckbox" id="selectedCheckbox" value="" hidden>
                <button type="submit" class="btn btn-primary bg-primary">Make Order</button>
            </x-form.post>
            <button type="button" class="btn btn-danger bg-danger" onclick="resetCheckbox()">Reset</button>
        </div>
    </div>

    <p>If the Qty. isn't change, you may try again maybe it's network problem.</p> 
    <table class="w-full">
        <thead>
            <tr class="bg-gray-400 dark:bg-gray-800">
                <th class="px-1 py-4"></th>
                <th>ID</th>
                {{-- <th class="mr-4">Image</th> --}}
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
                <td class="px-1 py-2 w-18">
                    <div class="flex justify-center align-items-center">
                        <input data-input="row-{{ $cart->id }}" class="cursor-pointer border-1 border-solid !border-[#bbbbbb] rounded-sm" type="checkbox" name="" id="">
                    </div>
                </td>
                <td class="w-18" data-column="id" id="row-{{ $cart->id }}">{{ $cart->id }}</td>
                {{-- <td class="w-[6rem] pr-[1rem]">
                    <img class="w-full h-full object-fit-cover py-1" src="{{ asset($cart->getImage()) }}" alt="" onload="this.style.display='block'" onerror="this.style.display='none'">
                </td> --}}
                <td class="w-80">{{ $cart->productName()->first()->name }}</td>
                <td class="w-40">{{ $cart->product()->first()->product_category }}</td>
                <td class="w-30">{{ $cart->productBrand()->first()->brand }}</td>
                <td id="qunatityEdit" class="pr-[1rem] w-20">{{ $cart->number }}</td>
                <td class="w-40">
                    <div class="py-2 flex justify-content-between">
                        <button id="editButton" data-id="{{ $cart->id }}" class="flex justify-center gap-x-2 btn btn-primary bg-primary">
                            <i class="fa-solid fa-pen mr-2"></i>Edit
                        </button>
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

@push('after-script')
    <script>
        let checkboxArray = document.querySelectorAll('input[type="checkbox"]');
        let valueInput = document.querySelector('#selectedCheckbox');
        valueInput.value = localStorage.getItem('selectedIds');
        checkboxArray.forEach(element => {
            element.addEventListener('click', e => {
                let id = element.closest('tr').querySelector('td[data-column="id"]').id;
                if(element.checked){
                    addToLocalStorage(id);
                }else{
                    removeFromLocalStorage(id);
                }
            })
        });
        function addToLocalStorage(cartId) {
            let selectedIds = JSON.parse(localStorage.getItem('selectedIds')) || [];
            selectedIds.push(cartId);
            localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
            let valueInput = document.querySelector('#selectedCheckbox');
            valueInput.value = localStorage.getItem('selectedIds');
        }
        function removeFromLocalStorage(cartId) {
            let selectedIds = JSON.parse(localStorage.getItem('selectedIds')) || [];
            selectedIds = selectedIds.filter(id => id !== cartId);
            localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
            let valueInput = document.querySelector('#selectedCheckbox');
            valueInput.value = localStorage.getItem('selectedIds');
        }
        document.addEventListener('DOMContentLoaded', function () {
            let selectedIds = JSON.parse(localStorage.getItem('selectedIds')) || [];
            selectedIds.forEach(cartId => {
                let checkbox = document.querySelector(`input[data-input="${cartId}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                }
            });
        });
        function resetCheckbox() {
            localStorage.removeItem("selectedIds");
            let checkboxArray = document.querySelectorAll('input[type="checkbox"]');
            checkboxArray.forEach(checkbox => {
                checkbox.checked = false;
            })
            let valueInput = document.querySelector('#selectedCheckbox');
            valueInput.value = '';
        }
    </script>

    <script>
        let editButtons = document.querySelectorAll('#editButton');
        let qunatityEdit = document.querySelectorAll('#qunatityEdit');
        editButtons.forEach((editButton, index) => {
            editButton.addEventListener('click', e => {
                let number = qunatityEdit[index].innerText;
                let id = e.target.getAttribute('data-id');
                qunatityEdit[index].innerHTML = `
                    <div class="flex justify-center items-center gap-x-4">
                        <input class="w-full px-2" name="Number" placeholder="Qty." value="${number}">
                        <button onclick="updateCartNumber(event, ${id}, ${index})">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>`;
            });
        });

        function updateCartNumber(event, id, index) {
            let number = document.querySelector('[name="Number"]').value;
            qunatityEdit[index].innerHTML = number;

            let xhr = new XMLHttpRequest();
            xhr.open('post', route('backend.user.cart.update'), true);

            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

            let formData = new FormData();
            formData.append('id', id);
            formData.append('quantity', number);
            formData.append('_method', 'PATCH');

            xhr.send(formData);
        }
    </script>
@endpush