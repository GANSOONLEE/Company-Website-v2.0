@extends('backend.admin.layouts.app')

@section('title', __('sidebar.user-management'))

@section('main')

    <section class="user-role">
        <p class="section-title">{{ __('account.user-role') }}</p>
        <table>
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
                        <td id="name">{{ $user->name }}</td>
                        <td id="email">{{ $user->email }}</td>
                        <td id="role">{{ ($user->getRole())[0] }}</td>
                        <td id="action">
                            <button class="btn btn-primary" id="" type="button">{{ __('account.edit') }}</button>
                            <button class="btn btn-danger" id="" type="button">{{ __('account.banned') }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>


@endsection

@push('after-style')

@endpush


@push('after-script')

@endpush