@extends('backend.admin.layouts.app')

@section('title', __('sidebar.permission-management'))

@section('main')

    <div class="nav">
        <div class="hover">
            <i class="fa-regular fa-id-card"></i>
        </div>
        <ul class="nav-links">
            @foreach ($roleData as $role)
                <a href="#{{ $role->name }}"><li class="nav-link">{{ __("account.roles.$role->name") }}</li></a>
            @endforeach
        </ul>
    </div>

    <!-- role -->
    @foreach ($roleData as $role)
        <section class="panel" data-role-level="{{ $role->weight }}" id="{{ $role->name }}">
            <p class="panel-title">{{ __("account.roles.$role->name") }}</p>
            <div class="panel-content">
                @foreach ($permissionsData as $permissionsCategoryName => $permissionsName)
                <div class="permission-category">
                    <p class="permission-category-title">{{ __('account.category.' . $permissionsCategoryName) }}</p>
                    <div class="permission-category-content">
                        @foreach ($permissionsName as $permissionName)
                            <?php $hasPermission = false; ?>
                            @foreach ($role->getPermissions() as $permission)
                                @if ($permission['name'] === $permissionName)
                                    <?php $hasPermission = true; ?>
                                    <div class="switch-box" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("account.permission.$permissionName.description") }}">
                                        <input type="checkbox" name="{{ $permission['name'] }}" id="{{ $permission['name'] }}" {{ $permission['inherited'] ? '' : 'disabled' }} checked>
                                        <label for="{{ $permission['name'] }}" class="switch-label">
                                            {{ __('account.permission.' . $permission['name'] . ".name") }}
                                            <div class="switch-button">
                                                <div class="switch-marker">
                                                    <p class="label"></p>
                                                </div>                                    
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            @endforeach

                            @if (!$hasPermission)
                                <div class="switch-box" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('account.permission.'.$permissionName.'.description') }}">
                                    <input type="checkbox" name="{{ $permissionName }}" id="{{ $role->name . '-' . $permissionName }}">
                                    <label for="{{ $role->name . '-' . $permissionName }}" class="switch-label">
                                        {{ __("account.permission." . $permissionName . ".name") }}
                                        <div class="switch-button flex-row">
                                            <div class="switch-marker">
                                                <p class="label"></p>
                                            </div>  
                                        </div>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-success submit-button" class="" data-role="{{ $role->name }}">{{ __('account.renew') }}</button>
            </div>
        </section>
    @endforeach


@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\permission-management.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\account\permission-management.js') }}"></script>
@endpush