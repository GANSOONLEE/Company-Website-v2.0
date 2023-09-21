@extends('backend.admin.layouts.app')

@section('title', __('sidebar.permission-management'))

@section('main')

    <!-- role -->
    @foreach ($roleData as $role)
        <section class="panel" data-role-level="{{ $role->weight }}">
            <p class="panel-title">{{ __('account.roles.' . $role->name) }}</p>
            <div class="panel-content">
                @foreach ($permissionsData as $permissionName)
                    <div class="switch-box">
                        <?php $hasPermission = false; ?>
                        @foreach ($role->getPermissions() as $permission)
                            @if ($permission['name'] === $permissionName)
                                <?php $hasPermission = true; ?>
                                <input type="checkbox" name="{{ $permission['name'] }}" id="{{ $permission['name'] }}" {{ $permission['inherited'] ? '' : 'disabled' }} checked>
                                <label for="{{ $permission['name'] }}" class="switch-label">
                                    {{ __('account.permission.'.$permission['name'])  }}
                                    <div class="switch-button">
                                        <div class="switch-marker">
                                            <p class="label"></p>
                                        </div>                                    
                                    </div>
                                </label>
                            @endif
                        @endforeach

                        @if (!$hasPermission)
                            
                            <input type="checkbox" name="{{ $permissionName }}" id="{{ $permissionName }}">
                            <label for="{{ $permissionName }}" class="switch-label">
                                {{ __('account.permission.'.$permissionName)  }}
                                <div class="switch-button flex-row">
                                    <div class="switch-marker">
                                        <p class="label"></p>
                                    </div>  
                                </div>
                            </label>
                        @endif
                    </div>
                @endforeach
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