@extends('backend.admin.layouts.app')

@section('title', __('sidebar.carousel-image'))

@section('main')

    <section class="panel">
        <p class="panel-title">{{ __('image.carousel.general-panel.title') }}</p>
        <div class="image-container" id="drop-container">
            @foreach ($fileData as $index => $file)
                <div class="image-box" draggable="true" id="{{ 'image-'. $index }}"  data-id="{{ $index }}">
                    <img class="image-preview" src="{{ asset($file->path) }}" alt="">
                    <p class="image-name">{{ $file->getFullName() }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="panel">
        <p class="panel-title">{{ __('image.carousel.promotion-one-panel.title') }}</p>
        <div class="image-container" id="drop-container">
        </div>
    </section>

    <section class="panel">
        <p class="panel-title">{{ __('image.carousel.promotion-two-panel.title') }}</p>
        <div class="image-container" id="drop-container">
        </div>
    </section>

    


@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\image\carousel-image.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\image\carousel-image.js') }}"></script>
@endpush