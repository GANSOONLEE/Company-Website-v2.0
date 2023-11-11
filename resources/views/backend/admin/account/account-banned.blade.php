@extends('backend.admin.layouts.app')

@section('title', __('sidebar.banned-account'))

@section('main')






    <div class="panel-content">
        @foreach ($users as $user)
        <div class="unavailable-account">
            {{ $user->name }}
        </div>
        @endforeach
    </div>


@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\banned-account.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\account\banned-account.js') }}"></script>
@endpush
