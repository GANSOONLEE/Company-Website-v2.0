
@inject('roles', 'App\Domains\Auth\Models\Role')

@extends('backend.layouts.app')

@section('title', __('user.management-panel'))

@section('subtitle', __('user.management-panel-description'))

@section('main')
    
    <!-- Modal -->
    <div class="modal fade text-black" id="editModalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog dark:text-white">
            <x-form.patch>
                <div class="modal-content dark:bg-gray-800">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalFormLabel">@lang('Edit')</h1>
                        <button type="button" class="btn-close text-black flex justify-center align-items-center" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input name="id" type="text" hidden>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label required">@lang('user.name')</label>
                            <input name="name" id="name" type="text" class="form-control dark:bg-gray-800 dark:text-white" placeholder="name" value="{{ old('name') }}">
                        </div>
            
                        <div class="mb-4">
                            <label for="email" class="form-label required">@lang('user.email')</label>
                            <input name="email" id="email" type="email" class="form-control dark:bg-gray-800 dark:text-white" placeholder="name@example.com" value="{{ old('email') }}">
                        </div>
            
                        <div class="mb-3">
                            <label for="role" class="form-label required">@lang('user.role')</label>
                            <select name="role" id="role" class="form-control dark:bg-gray-800 dark:text-white">
                                @foreach ($roles::byWeight('asc')->get() as $role)
                                    <option value="{{ $role->name }}" {{ auth()->user()->hasHigherPermissionWeight($role) ? null : 'disabled' }} role-type="{{ $role->type }}">@lang('account.roles.' . $role->name)</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary bg-danger" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary bg-primary">@lang('Submit')</button>
                    </div>
                </div>
            </x-form.patch>
        </div>
    </div>
        
    <div>
        <select class="mb-4" name="" id="" onchange="this.value != '#' ? location = this.value : null ;">
            <option value="#" hidden selected></option>
            <option value="{{ route("backend.admin.user.management", ["page" => '10']) }}">10</option>
            <option value="{{ route("backend.admin.user.management", ["page" => '15']) }}">15</option>
            <option value="{{ route("backend.admin.user.management", ["page" => '20']) }}">20</option>
        </select>
    </div>
    

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('user.name')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('user.email')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('user.role')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('action')
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php
                        $hasHigherThem = (auth()->user()->hasHigherPermissionWeight($user->roles()->first()) ? '' : 'disabled');
                    @endphp

                    <x-table.row
                        name='{{ $user->name }}'
                        email='{{ $user->email }}'
                        role='{{ __("account.roles." . $user->roles()->first()->name) }}'
                        weight='{{ $hasHigherThem }}'
                    >
                    </x-table.row>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->onEachSide(5)->links() }}

@endsection

@push('after-style')

@endpush

@push('after-script')
    <script>

        // Bootstrap 5 Modal

        let editButtonArray =  document.querySelectorAll('#editButton');
        editButtonArray.forEach(button => {
            
            let email = button.parentElement.parentElement.querySelector('[data-column="email"]').innerText;

            button.addEventListener('click', e => {

                let xhr = new XMLHttpRequest();
                xhr.open(
                    'GET',
                    route('backend.admin.user.get', { email: email }),
                    true
                )

                xhr.onreadystatechange = () => {
                    let data = JSON.parse(xhr.responseText);
                    console.log(data);

                    initForm(data);
                }

                xhr.send();

            });

        })

        function initForm(data){

            let form = document.querySelector('form');

            form.querySelector('[name="id"]').value = data.id;
            form.querySelector('[name="name"]').value = data.name;
            form.querySelector('[name="email"]').value = data.email;
            form.querySelector('[name="role"]').value = data.roles[0].name;

            let submitRoute = route("backend.admin.user.update", {userID : data.id});
            form.action = submitRoute;

        }
    </script>
@endpush