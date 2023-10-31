@extends('backend.admin.layouts.app')

@section('title', __('sidebar.operation-record'))

@section('main')

    @php
        $data = [
            [
                'data' => ['a', 'b', 'c'],
            ],
            [
                'data' => ['d', 'e', 'f'],
            ],
            [
                'data' => ['g', 'h', 'i'],
            ],
            [
                'data' => ['j', 'k', 'l'],
            ],
        ];
    @endphp

    <div id="paginationBox">
        <pagination-component
            :array="{{ json_encode($operations) }}"
        ></pagination-component>
    </div>

    @foreach ($operations as $operation)
    <div class="flex-row">
        <p>{{ $operation->email }}</p>
        <p>{{ $operation->operation_type }}</p>
        <p>{{ $operation->operation_category }}</p>
        <p>{{ $operation->created_at }}</p>
        <p>{{ $operation->build() }}</p>
    </div>
    @endforeach

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\operation-record.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\account\operation-record.js') }}"></script>
@endpush