@inject('model', '\App\Domains\Model\Models\Model')

@extends('backend.layouts.app')

@section('title', __('model.create-panel'))
@section('subtitle', __('model.create-panel-description'))

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
            <label for="name" class="form-label">{{ __('Name') }} (Proton)</label>
            <input type="text" class="dark:placeholder:text-white form-control dark:bg-gray-600 dark:text-white" id="name" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <button class="btn btn-sm btn-primary bg-primary px-5 py-2 float-right" type="submit">@lang('model.create-model')</button>
        </div>

    </form>

@endsection