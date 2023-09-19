@extends('backend.admin.layouts.app')

@section('title', __('sidebar.role-management'))

@section('main')

    <section class="user-role">
        <p class="section-title">{{ __('account.user-role') }}</p>
        <table cellspacing="0.1">
            <thead>
                <tr>
                    <th>{{ __('account.role') }}</th>
                    <th>{{ __('account.role-weight') }}</th>
                    <th>{{ __('account.role-name') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roleData as $index => $role)
                    <tr class="user-row-data">
                        <td id="name" data-name="{{ $role->name }}" class="col-3">
                            {{ $role->name }}
                        </td>
                        <td id="email" class="col-2">
                            {{ $role->weight }}
                        </td>
                        <td id="role" data-role="{{ $role->name }}" class="col-2">
                            {{ __("account.roles." . $role->name)}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    @include('backend.admin.account.role-craete-panel')

@endsection

@push('after-style')

@endpush

@push('after-script')
    
@endpush