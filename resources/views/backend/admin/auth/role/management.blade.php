
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
                            <label for="weight" class="form-label required">@lang('user.weight')</label>
                            <input name="weight" id="weight" type="number" class="form-control dark:bg-gray-800 dark:text-white" placeholder="{{ __('user.weight') }}" value="{{ old('weight') }}">
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
        {{-- <x-form.get class="mb-3" :action="route('backend.admin.user.search')">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">@lang('Search')</label>
            <div class="relative flex align-items-center first-letter:relative input-group h-[6vh]">
                <div class="h-full absolute flex items-center ps-3 pointer-events-none">
                    <i class="fa-solid fa-search text-gray-400"></i>
                </div>
                <input type="search" id="default-search" name="q" class="h-full block w-full px-3 py-2 !pl-12 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search email, username, role..." value="{{ request()->input('q') }}">
                <button type="submit" class="h-full text-white absolute right-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('Search')</button>
            </div>
        </x-form.get> --}}
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
                        @lang('role.name')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('role.weight')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('role.count')
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @lang('action')
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles::orderBy('weight')->withTrashed()->paginate(10) as $role)
                    @php
                        $hasHigherThem = auth()->user()->hasHigherPermissionWeight($role) ? '' : 'disabled';
                    @endphp
                    <tr class="hover:bg-gray-200 dark:hover:bg-gray-800">
                        {{-- <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-25 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-1" class="sr-only">checkbox</label>
                            </div>
                        </td> --}}
                        <th data-column="id" hidden>
                            {{ $role->id }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $role->name }}
                        </th>
                        <td class="px-6 py-4" data-column="email">
                            {{ $role->weight }}
                        </td>
                        <td class="px-6 py-4" data-column="email">
                            {{ $role->getCountWithUser() }}
                        </td>
                        <td class="flex justify-between items-center px-6 py-4">
                            @if (!$role->deleted_at)
                                <button data-bs-toggle="modal" data-bs-target="#editModalForm" id="editButton" class="font-medium text-blue-600 dark:text-blue-500 hover:underline disabled:text-gray-600 disabled:hover:no-underline disabled:text-slate-700 disabled:cursor-not-allowed dark:disabled:text-slate-700" {{ $hasHigherThem }} >@lang('Edit')</button>
                                <x-form.delete id="deleteForm" :action="route('backend.admin.role.delete', ['id' => $role->id])" >
                                    <button class="font-medium text-red-600 dark:text-red-500 hover:underline disabled:text-gray-600 disabled:hover:no-underline disabled:text-slate-700 disabled:cursor-not-allowed dark:disabled:text-slate-700" {{ $hasHigherThem }} {{ $role->getCountWithUser() > 0 ? 'disabled' : '' }}>@lang('Delete')</button>
                                </x-form.delete>
                            @else
                                <x-form.patch :action="route('backend.admin.role.restore', ['id' => $role->id])">
                                    <button class="font-medium text-green-600 dark:text-green-500 hover:underline disabled:text-gray-600 disabled:hover:no-underline disabled:text-slate-700 disabled:cursor-not-allowed dark:disabled:text-slate-700" {{ $hasHigherThem }} {{ $role->getCountWithUser() > 0 ? 'disabled' : '' }}>@lang('Restore')</button>
                                </x-form.patch>
                                <x-form.delete id="destoryForm" :action="route('backend.admin.role.destroy', ['id' => $role->id])" >
                                    <button class="font-medium text-red-600 dark:text-red-500 hover:underline disabled:text-gray-600 disabled:hover:no-underline disabled:text-slate-700 disabled:cursor-not-allowed dark:disabled:text-slate-700" {{ $hasHigherThem }} {{ $role->getCountWithUser() > 0 ? 'disabled' : '' }}>@lang('ForceDelete')</button>
                                </x-form.delete>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $roles::orderBy('weight')->paginate(10)->links() }}

@endsection

@push('after-style')

@endpush

@push('after-script')
    <script>

        // Bootstrap 5 Modal

        let editButtonArray =  document.querySelectorAll('#editButton');
        editButtonArray.forEach(button => {
            
            let id = button.parentElement.parentElement.querySelector('[data-column="id"]').innerText;

            button.addEventListener('click', e => {

                let xhr = new XMLHttpRequest();
                xhr.open(
                    'GET',
                    route('backend.admin.role.get', { id: id }),
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
            form.querySelector('[name="weight"]').value = data.weight;

            let submitRoute = route("backend.admin.role.update", {id : data.id});
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