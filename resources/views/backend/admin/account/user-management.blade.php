@extends('backend.admin.layouts.app')

@section('title', __('sidebar.user-management'))

@section('main')

    <section class="user-role">
        <p class="section-title">{{ __('account.user-role') }}</p>
        <table cellspacing="0.1">
            <thead>
                <tr>
                    <th>{{ __('account.user-name') }}</th>
                    <th>{{ __('account.user-email') }}</th>
                    <th>{{ __('account.role') }}</th>
                    <th>{{ __('account.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userData as $index => $user)
                    <tr class="user-row-data">
                        <td id="name" data-name="{{ $user->name }}" class="col-3">
                            {{ $user->name }}
                            @if ($user->name == auth()->user()->name)
                                {{ __('account.yourself')}}
                            @endif
                        </td>
                        <td id="email" class="col-2">{{ $user->email }}</td>
                        <td id="role" data-role="{{ $user->getRole()[0] }}" class="col-2">{{ __("account.roles." . $user->getRole()[0])}}</td>
                        <td id="action" class="col">
                            @if(auth()->user()->getRoleEntity()->weight > $user->getRoleEntity()->weight)
                                <button class="btn btn-primary col edit-button" id="edit-button" type="button">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    {{ __('account.edit') }}
                                </button>

                                @if(auth()->user()->getRoleEntity()->hasPermission('admin_account_banned'))
                                <button class="btn btn-danger col banned-button" id="banned-button" type="button">
                                    <i class="fa-solid fa-ban"></i>
                                    {{ __('account.banned') }}
                                </button>
                                @endif
                            @else
                                
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    @include('backend.admin.account.user-management-form')

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\user-management.css') }}">
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\user-management-form.css') }}">
@endpush


@push('after-script')
    <script src="{{ asset('js\backend\admin\account\user-management.js') }}"></script>
@endpush