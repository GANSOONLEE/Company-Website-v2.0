@extends('backend.admin.layouts.app')

@section('title', __('sidebar.carousel-image'))

@section('main')

    <form action="{{ route('backend.admin.image.carousel-image-upload') }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        
        <section class="panel" id="general-panel" data-panel="general">
            <div class="panel-header flex-row">
                <p class="panel-title">{{ __('image.carousel.general-panel.title') }}</p>
                <label for="general-carousel-upload" class="upload-label">{{ __('image.upload') }}</label>
                <input type="file" name="image[general]" class="upload-image" id="general-carousel-upload">
            </div>
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
                <div class="panel-header flex-row">
                    <p class="panel-title">{{ __('image.carousel.' . $panel['panelName'] . '-panel.title') }}</p>
                    <label for="{{ $panel['panelName'] }}-carousel-upload" class="upload-label">{{ __('image.upload') }}</label>
                    <input type="file" name="image[{{ 'carousel/'.$panel['panelName'] }}]" class="upload-image" id="{{ $panel['panelName'] }}-carousel-upload">
                </div>
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
    </form>
@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\image\carousel-image.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\image\carousel-image.js') }}"></script>
@endpush