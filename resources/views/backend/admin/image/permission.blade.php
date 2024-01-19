
@inject('images', 'App\Domains\Image\Models\Image')
@inject('roles', 'App\Domains\Auth\Models\Role')

@extends('backend.layouts.app')

@section('title', __('image.edit-image'))

@section('subtitle', __('image.edit-image-description'))

@section('main')

    <div class="overflow-x-auto shadow rounded-md p-1">

        <table class="w-full">
            <thead>
                <tr class="bg-gray-300 border !border-gray-300 !border-l-2 !border-t-2 !border-r-2 dark:bg-gray-600">
                    <th class="px-4 py-3">@lang('Id')</th>
                    <th class="px-4 border-solid border-l-[1px] border-gray-200">@lang('image.name')</th>
                    <th class="px-4 border-solid border-l-[1px] border-gray-200">@lang('image.allow-roles')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images->orderBy('created_at')->get() as $index => $image)
                    <tr class="border !border-gray-300 !border-l-2 !border-r-2 last:!border-b-2">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 border-solid border-l-[1px] border-gray-300">{{ $image->name }}</td>
                        <td class="px-4 py-2 border-solid border-l-[1px] border-gray-300 md:max-w-40">
                            @if (strpos($image->name, 'general') === 0)
                                @lang('permission.roles.all')
                            @else
                                <x-form.patch :action="route('backend.admin.image.update', ['id' => $image->id])">
                                    <div class="flex flex-wrap justify-start items-center gap-x-4">
                                        @foreach ($roles->pluck('name')->toArray() as $role)
                                        <div class="flex items-center gap-x-4">
                                            <input name="roles[]" id="{{ $image->name . "_" . $role }}" class="block border !border-gray-300 cursor-pointer" type="checkbox" value="{{ $role }}" {{ array_search($role, $image->allow_roles) !== false ? 'checked' : null }}>
                                            <label for="{{ $image->name . "_" . $role }}">@lang('permission.roles.' . $role)</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button class="btn btn-success mt-2">@lang('Update')</button>
                                </x-form.patch>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      
    </div>

@endsection

@push('after-style')

@endpush

@push('after-script')
    
@endpush