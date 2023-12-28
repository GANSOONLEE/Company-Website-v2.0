
@extends('backend.layouts.app')

@section('title', __('operation.import'))

@section('subtitle', __('operation.import-description'))

@section("main")

    <x-form.post :action="route('backend.admin.data.import-data')">

        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            @lang('Import')
        </button>
        <p class="bg-gray-200 text-sm text-red-600 my-[.75rem] px-[.5rem] py-[.2rem] w-min whitespace-nowrap">`@lang('data.file-path', ["path" => $filePath])`</p>

        <table class="w-full">
            <thead>
                <tr class="bg-gray-400 dark:bg-gray-900">
                    <th class="px-3 py-2">@lang('Id')</th>
                    <th>@lang('database.table-column')</th>
                    <th>@lang('database.table-description-column')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($tables as $table)
                    <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-500 dark:even:bg-gray-600 dark:hover:bg-gray-700">
                        <td class="px-3">{{ $i++ }}</td>
                        <td>{{ $table->{"Tables_in_" . config('database.connections.mysql.database')} }}</td>
                        <td>@lang('database.description.' . $table->{"Tables_in_" . config('database.connections.mysql.database')})</td>
                        <td class="flex justify-start align-items-center gap-x-[.4rem] py-2">
                            {{-- <label for="table-file-{{ $i }}" class="px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 hover:bg-gray-300 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">@lang('Import')</label> --}}
                            <input name="table[]" id="table-file-{{ $i }}" type="file">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
                
    </x-form.post>

@endsection