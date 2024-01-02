
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

    {{-- <div class="shadow border !border-gray-300 rounded-md px-3 py-2 mb-3"> --}}
        <x-form.get class="mb-3" :action="route('backend.admin.user.search')">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">@lang('Search')</label>
            <div class="relative flex align-items-center first-letter:relative input-group h-[6vh]">
                <div class="h-full absolute flex items-center ps-3 pointer-events-none">
                    <i class="fa-solid fa-search text-gray-400"></i>
                </div>
                <input type="search" id="default-search" name="q" class="h-full block w-full px-3 py-2 !pl-12 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search email, username, role..." value="{{ request()->input('q') }}">
                <button type="submit" class="h-full text-white absolute right-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('Search')</button>
            </div>
        </x-form.get>
    {{-- </div> --}}

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    {{-- <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th> --}}
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
                        id='{{ $user->id }}'
                        areTrashed='{{ $user->deleted_at ? false : true }}'
                        weight='{{ $hasHigherThem }}'
                    >
                    </x-table.row>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}

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

        let deleteForm = document.querySelector('#deleteForm');
        deleteForm.addEventListener('submit', e => {
            confirm('Are you sure you want to delete this user? (You cant restore it later.)') ?
                deleteForm.submit() :
                e.preventDefault();
        });
        
        let destoryForm = document.querySelector('#destoryForm');
        destoryForm.addEventListener('submit', e => {
            confirm('Are you sure you want to delete this user foreveer?') ?
                destoryForm.submit() :
                e.preventDefault();
        });
    </script>
@endpush