
@inject('roles', 'App\Domains\Auth\Models\Role')
@inject('users', 'App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('user.create-panel'))

@section('subtitle', __('user.create-panel-description'))

@section('main')

    <x-form.post :action="route('backend.admin.user.store')">

        <x-control-panel>

            <div class="mb-3">
                <label for="name" class="form-label required">@lang('user.name')</label>
                <input name="name" id="name" type="text" class="form-control dark:bg-gray-800 dark:text-white" placeholder="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label required">@lang('user.email')</label>
                <input name="email" id="email" type="email" class="form-control dark:bg-gray-800 dark:text-white" placeholder="name@example.com" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label required">@lang('user.role')</label>
                <select name="role" id="role" class="form-select dark:bg-gray-800 dark:text-white" aria-label="Default select example">
                    <option hidden selected></option>
                    @foreach ($roles::byWeight('asc')->get() as $role)
                        <option value="{{ $role->name }}" {{ auth()->user()->hasHigherPermissionWeight($role) ? null : 'disabled' }} role-type="{{ $role->type }}">@lang('account.roles.' . $role->name)</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3" data-identify="preferrsion">
                <label for="preferrsion" class="form-label">@lang('user.job')</label>
                <select name="profession" id="preferrsion" class="form-select dark:bg-gray-800 dark:text-white">
                    <option hidden selected></option>
                    @foreach ($users::getJobOptionsAttribute() as $job)
                        <option value="{{ $job }}">{{ $job }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary bg-blue-600" type="submit">@lang('Submit')</button>

        </x-control-panel>

    </x-form.post>

@endsection

@push('after-script')

    <script>

        let role = document.querySelector('#role');
        role.addEventListener('change', e => {
            let value = e.target.value;
            let type = e.target.querySelector(`[value=${value}]`).getAttribute('role-type')

            let preferrsion = document.querySelector('[data-identify="preferrsion"]');

            type === 'user' ?
                preferrsion.hidden = false :
                preferrsion.hidden === true ?
                    null :
                    preferrsion.hidden = true ;
                    
        })
            
    </script>    

@endpush