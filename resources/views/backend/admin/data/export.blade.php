
@extends('backend.layouts.app')

@section('title', __('operation.export'))

@section('subtitle', __('operation.export-description'))

@section("main")

    <x-form.post :action="route('backend.admin.data.export-data')">

        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            @lang('Export')
        </button>

        <div class="overflow-x-auto shadow rounded-md p-1">

            <table class="relative w-full overflow-x-auto">
                <thead>
                    <tr class="bg-gray-400 dark:bg-gray-900">
                        <th class="px-3 py-2">@lang('Id')</th>
                        <th class="px-3 py-2 sticky -left-2 z-9 bg-inherit">@lang('database.table-column')</th>
                        <th class="px-3 py-2">@lang('database.table-description-column')</th>
                        <th class="px-3 py-2">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($tables as $table)
                        <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-500 dark:even:bg-gray-600 dark:hover:bg-gray-700">
                            <td class="px-3 py-2">{{ $i++ }}</td>
                            <td class="px-3 py-2 sticky -left-2 z-9 bg-inherit block shadow-[5px_3px_10px_-6px_#00000033] md:shadow-none">{{ $table->{"Tables_in_" . config('database.connections.mysql.database')} }}</td>
                            <td class="px-3 py-2">@lang('database.description.' . $table->{"Tables_in_" . config('database.connections.mysql.database')})</td>
                            <td class="px-3 py-2 flex justify-start align-items-center gap-x-[.4rem]">
                                <input name="table[]" id="table-checkbox-{{ $i }}" type="checkbox" value="{{ $table->{"Tables_in_" . config('database.connections.mysql.database')} }}" class="w-4 h-4 text-blue-600 bg-gray-50 border !border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="table-checkbox-{{ $i }}">@lang('Export')</label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
                
    </x-form.post>

@endsection