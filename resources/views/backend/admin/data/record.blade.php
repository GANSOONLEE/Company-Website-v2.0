
@extends('backend.layouts.app')

@section('title', __('operation.record'))

@section('subtitle', __('operation.record-description', ["days" => 15]))

@section("main")

    <x-form.get class="mb-3" :action="route('backend.admin.data.record-search')">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">@lang('Search')</label>
        <div class="relative flex align-items-center first-letter:relative input-group h-[6vh]">
            <div class="h-full absolute flex items-center ps-3 pointer-events-none">
                <i class="fa-solid fa-search text-gray-400"></i>
            </div>
            <input type="search" id="default-search" name="q" class="h-full block w-full px-3 py-2 !pl-12 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search email, username, role..." value="{{ request()->input('q') }}">
            <button type="submit" class="h-full text-white absolute right-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm px-3 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('Search')</button>
        </div>
    </x-form.get>

    <table class="w-full">
        <thead>
            <tr class="bg-gray-400 dark:bg-gray-900">
                <th class="px-3 py-2">ID</th>
                <th>@lang('user.email')</th>
                <th>@lang('operation.method')</th>
                <th>@lang('operation.object')</th>
                <th>@lang('operation.detail')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($operations) > 0)
                @foreach ($operations as $operation)
                    <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300">
                        <td class="px-3 py-2">{{ $operation->id }}</td>
                        <td>{{ $operation->email }}</td>
                        <td>@lang('operation.type.' . $operation->operation_type)</td>
                        <td>@lang('operation.category.' . $operation->operation_category)</td>
                        <td>{{ $operation->operation_detail }}</td>
                        <td>{{ $operation->created_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="bg-gray-200 hover:bg-gray-300">
                    <td colspan="6" class="text-center py-2">Not Record</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $operations->links() }}

@endsection