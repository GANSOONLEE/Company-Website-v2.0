@inject('model', '\App\Models\CarModel')

@extends('backend.admin.layouts.app')

@section('title', __('Create Model'))

@section('main')

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('backend.admin.model.store') }}" method="post">
        
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Model')</button>
        </div>

    </form>

@endsection