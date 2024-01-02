
@inject('roles', 'App\Domains\Auth\Models\Role')
@inject('permissions', 'App\Domains\Auth\Models\Permission')

@extends('backend.layouts.app')

@section('title', __('permission.management-panel'))

@section('subtitle', __('permission.management-panel-description'))

@section('main')

    <!-- Main modal -->
    @if (isset($permissionsChecked))
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">

            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        @lang('permission.management-panel')
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="flex flex-wrap justify-start gap-x-4 gap-y-[1rem] p-[1rem] md:p-5">

                    @foreach ($permissions::orderBy('permission_category')->get() as $permission)
                        <div class="flex justify-center items-center border !border-gray-300 rounded-md overflow-hidden">
                            <div class="flex justify-center items-center px-3 py-2 h-full border-r-[1px] border-gray-300 bg-gray-200">
                                <input class="block disabled:!bg-gray-400" type="checkbox" name="permission[]" id="{{ $permission->name }}" {{ in_array($permission->name, array_column($permissionsChecked, 'name')) ? "checked" : null }} {{ ($index = array_search($permission->name, array_column($permissionsChecked, 'name'))) !== false ? $permissionsChecked[$index]->inherited ? 'disabled' : null : null }}>
                            </div>
                            <div class="px-3 py-2 !pl-4">
                                <label class="whitespace-nowrap" for="{{ $permission->name }}">@lang('permission.permissions.' . $permission->name . '.name')</label>
                            </div>
                        </div>
                    @endforeach

                </div>
                
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('Update')</button>

                    <button data-modal-hide="static-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">@lang('Cancel')</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal toggle -->
    <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        @lang('Edit')
    </button>
    @endif

    <x-form.patch class="w-full flex justify-start gap-x-4" :action="route('backend.admin.permission.managementPage')">

        <div class="flex justify-start items-center gap-x-[.75rem] mb-3">
            <label class="whitespace-nowrap" for="role">@lang('role.name')</label>
            <select class="form-select" name="role" id="role">
                @foreach ($roles->orderBy('weight')->get()->pluck('name')->toArray() as $name)
                    <option value="{{ $name }}" {{ isset($role) ? $name === $role->name ? 'selected' : null : null }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <button class="block h-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">
                @lang('Submit')
            </button>
        </div>

    </x-form.patch>

@endsection