@extends('backend.admin.layouts.app')

@section('title', __('sidebar.carousel-image'))

@section('main')

    <form action="" method="post" class="form" enctype="multipart/form-data">
        <label for="carousel-upload" class="upload">{{ __('image.upload') }}</label>
        <input type="file" name="carousel-image" id="carousel-upload">
    </form>

    <section class="panel" id="general-panel" data-panel="general">
        <p class="panel-title">{{ __('image.carousel.general-panel.title') }}</p>
        <div class="image-container" id="drop-container">
            @foreach ($fileData as $index => $file)
                <div class="image-box" draggable="true" id="{{ 'image-'. $index }}"  data-id="{{ 'general' . $index }}">
                    <img class="image-preview" src="{{ asset($file->path) }}" data-path="{{ $file->relativePath() }}" alt="">
                    <p class="image-name">{{ $file->getFullName() }}</p>
                </div>
            @endforeach
        </div>
    </section>

    @foreach ($panelData as $panel)
        <section class="panel" id="{{ $panel['panelName'] . '-panel' }}" data-panel="{{ $panel['panelName'] }}">
            <p class="panel-title">{{ __('image.carousel.' . $panel['panelName'] . '-panel.title') }}</p>
            <div class="image-container" id="drop-container">
                @foreach ($panel['panelImage'] as $index => $image)
                    <div class="image-box" draggable="true" id="{{ 'image-'. $index }}"  data-id="{{ $panel['panelName']. '-' . $index }}">
                        <img class="image-preview" src="{{ asset($image->path) }}" data-path="{{ $image->relativePath() }}" alt="">
                        <p class="image-name">{{ $image->getFullName() }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\image\carousel-image.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\image\carousel-image.js') }}"></script>
@endpush