
@extends('backend.layouts.app')

@section('title', __('operation.export'))

@section('subtitle', __('operation.export-description'))

@section("main")

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
                <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300">
                    <td class="px-3">{{ $i++ }}</td>
                    <td>{{ $table->Tables_in_frozen_aircond_development }}</td>
                    <td>@lang('database.description.' . $table->Tables_in_frozen_aircond_development)</td>
                    <td class="py-2">
                        <button class="flex justify-center gap-x-[1rem] btn bg-primary text-white hover:text-gray-200">
                            <i class="fa-solid fa-file-export"></i>@lang('Export')
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection