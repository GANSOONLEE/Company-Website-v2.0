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
    @foreach ($roleData as $index => $role)
        {{ $index }}{{ $role->weight }}{{ $role->name }}
        <section class="panel" data-role-level="{{ $role->weight }}" id="{{ $role->name }}">
            <p class="panel-title">{{ __("account.roles.$role->name") }}</p>
            <div class="panel-content">
                @foreach ($permissionsData as $permissionsCategoryName => $permissionsName)
                    <div class="permission-category">
                        <p class="permission-category-title">{{ __('account.category.' . $permissionsCategoryName) }}</p>
                        <div class="permission-category-content">
                            @foreach ($permissionsName as $singlePermission)
                                <?php
                                    $hasPermission = collect($role->getPermissions())->contains('name', $singlePermission);
                                    $labelId = $role->name . '-' . $singlePermission;
                                ?>
                                <div class="switch-box" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("account.permission.$singlePermission.description") }}">
                                    <input type="checkbox" name="{{ $singlePermission }}" id="{{ $labelId }}" {{ $hasPermission ? 'checked' : '' }}>
                                    <label for="{{ $labelId }}" class="switch-label">
                                        {{ __("account.permission." . $singlePermission . ".name") }}
                                        <div class="switch-button">
                                            <div class="switch-marker">
                                                <p class="label"></p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-success submit-button" data-role="{{ $role->name }}">{{ __('account.renew') }}</button>
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