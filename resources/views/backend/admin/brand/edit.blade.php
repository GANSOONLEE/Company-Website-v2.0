@inject('brands', '\App\Domains\Brand\Models\Brand')

@extends('backend.layouts.app')

@section('title', __('brand.management-panel'))
@section('subtitle', __('brand.management-panel-description'))

@section('main')

    <div id="targetModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative c-bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        @lang('Edit') @lang('sidebar.brand')
                    </h3>
                    <button id="closeModalButton" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 pt-0">
                    <x-form.patch class="space-y-4" :action="route('backend.admin.brand.update', ['id' => ':id'])">
                        <div class="flex flex-column align-items-center w-full">
                            <p class="text-xl mb-3 align-self-start">@lang('brand.image')</p>
                            <label for="image" class="flex justify-center align-items-center form-label w-[14rem] h-[14rem] border-1 border-solid border-gray-600 cursor-pointer transition-all duration-[120ms] hover:bg-gray-300">
                                <img class="w-full h-full object-fit-cover" src="{{ asset('storage/cateogry/:name') }}" alt="" onload="this.style.display = 'block'" onerror="this.style.display = 'none'">
                            </label>
                            <input name="image" id="image" type="file" file="{{ old('image') }}" hidden>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">@lang('brand.name')</label>
                            <input value="" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="{{ __('category.name') }}" required>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('Submit')</button>
                    </x-form.patch>
                </div>
            </div>
        </div>
    </div> 

    <div class="overflow-x-auto rounded-sm shadow p-1">

        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-600">
                    <th class="px-3 py-2">@lang('ID')</th>
                    <th class="px-3 py-2">@lang('brand.image')</th>
                    <th class="px-3 py-2">@lang('brand.name')</th>
                    <th class="px-3 py-2">@lang('brand.product-count')</th>
                    <th class="px-3 py-2">@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands::byName()->paginate(10) as $brand)
                    <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 hover:dark:bg-gray-900" id="{{ $brand->id }}" data-name="{{ $brand->name }}">
                        <td class="px-3">{{ $brand->id }}</td>
                        <td class="px-3 py-2 flex justify-center w-32">
                            <img class="h-full w-full object-fit-cover" onload="this.style.display='block'" onerror="this.style.display='none'" src="{{ asset('storage/brand/' . $brand->image()) }}" alt="">
                        </td>
                        <td class="px-3 border-gray-100">{{ $brand->name }}</td>
                        <td class="px-3 w-64">{{ count($brand->products()->get()) }}</td>
                        <td class="px-3 py-2 w-56">
                            <div class="flex justify-between align-items-center gap-x-4">
                                <button id="editModalButton" class="btn btn-primary bg-primary" type="button">
                                    <a class="flex justify-center gap-x-4" href="#">
                                        <i class="fa-solid fa-pen"></i>@lang('Edit')
                                    </a>
                                </button>
                                <button class="btn btn-danger bg-danger" type="button" {{ count($brand->products()->get()) === 0 ? '' : 'disabled' }}>
                                    <a onclick="event.preventDefault(); confirm('{{ __('Delete-Confirm') }}') ? document.getElementById('delete-form-{{ $brand->id }}').submit() : null ;" class="flex justify-center gap-x-4" href="">
                                        <i class="fa-solid fa-trash"></i>@lang('Delete')
                                    </a>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <x-form.delete id="delete-form-{{ $brand->id }}" :action="route('backend.admin.brand.destroy', ['id' => $brand->id])" class="hidden">
                
                    </x-form.delete> 

                @endforeach
            </tbody>
        </table>

    </div>

    {{ $brands::byName()->paginate(10)->links() }}

    {{-- <x-form.patch :action="">

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }} (Proton)</label>
            <input type="text" class="dark:placeholder:text-white form-control dark:bg-gray-600 dark:text-white" id="name" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <button class="btn btn-sm btn-primary bg-primary px-5 py-2 float-right" type="submit">@lang('category.create-category')</button>
        </div>

    </x-form.patch> --}}
    <script type="module">

        const targetModal = document.querySelector('#targetModal');

        const options = {
            backdrop: 'static',
            backdropClasses : 'bg-gray-900/50 dark:bg-900/80 fixed inset-0 z-99',
            closable: true
        }

        const instanceOptions = {
            id: 'targetModal',
            override: true
        }

        const modal = new Modal(targetModal, options, instanceOptions);

        let editModalButtons = document.querySelectorAll('#editModalButton');
        editModalButtons.forEach(button => {
            button.addEventListener('click', e => {
                let action = targetModal.querySelector('form').action;
                const row = button.closest('tr');
                const id = row.id;
                const name = row.getAttribute('data-name');
                targetModal.querySelector('form').action = action.replace(':id', id);
                targetModal.querySelector('input[name="name"]').value = name;
                targetModal.querySelector('img').src = row.querySelector('img').src;
                modal.show()
            })
        });

        let closeModalButton = document.querySelector('#closeModalButton');
        closeModalButton.addEventListener('click', e => {
            targetModal.querySelector('form').action = `{{ route('backend.admin.category.update', ['id' => ':id']) }}`
            targetModal.querySelector('img').src = `{{ asset('storage/cateogry/:name') }}`
            modal.hide()
        })

        let imageInput = document.querySelector('input[type="file"]');
        imageInput.addEventListener('change', e => {

            let file = e.target.files[0];
            let reader = new FileReader();
            let image = e.target.closest('div').querySelector('img');

            reader.readAsDataURL(file);
            reader.onloadend = () => {
                image.src = reader.result;
            }

        })
    </script>

@endsection