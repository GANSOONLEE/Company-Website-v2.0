
@inject('roles', 'App\Domains\Auth\Models\Role')
@inject('users', 'App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('role.create-panel'))

@section('subtitle', __('role.create-panel-description'))

@section('main')

    <x-form.post :action="route('backend.admin.role.store')">

        <x-control-panel>

            <div class="mb-3">
                <label for="name" class="form-label required">@lang('role.name')</label>
                <input name="name" id="name" type="text" class="form-control dark:bg-gray-800 dark:text-white" placeholder="new_example" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label required">@lang('role.weight')</label>
                <input name="weight" id="weight" type="number" min="1" max="99" class="form-control invalid:border-red-500 dark:bg-gray-800 dark:text-white" placeholder="name@example.com" value="{{ old('weight') }}">
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