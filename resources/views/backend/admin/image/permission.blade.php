
@inject('images', 'App\Domains\Image\Models\Image')
@inject('roles', 'App\Domains\Auth\Models\Role')

@extends('backend.layouts.app')

@section('title', __('image.edit-image'))

@section('subtitle', __('image.edit-image-description'))

@section('main')

    <table class="w-full">
        <thead>
            <tr>
                <th class="px-4 py-3">@lang('Id')</th>
                <th>@lang('image.name')</th>
                <th>@lang('image.allow-roles')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images->orderBy('created_at')->get() as $index => $image)
                <tr>
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td>{{ $image->name }}</td>
                    <td>
                        <x-form.patch :action="route('backend.admin.image.update', ['id' => $image->id])">
                            @foreach ($roles->pluck('name')->toArray() as $role)
                                <div class="flex items-center gap-x-4">
                                    <input name="roles[]" id="{{ $image->name . "_" . $role }}" class="block border !border-gray-300" type="checkbox" value="{{ $role }}" {{ array_search($role, $image->allow_roles) > 0 ? 'selected' : null }}>
                                    <label for="{{ $image->name . "_" . $role }}">@lang('permission.roles.' . $role)</label>
                                </div>
                            @endforeach
                            <button>@lang('Update')</button>
                        </x-form.patch>
                    </td>
                    <td>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@push('after-style')

@endpush

@push('after-script')
    
@endpush