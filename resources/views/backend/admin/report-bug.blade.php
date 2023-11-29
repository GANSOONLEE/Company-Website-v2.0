<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="bugs report">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | {{ __('bug.report-bugs') }}</title>

     <!-- Bootstrap 5 -->
     <link rel="preload stylesheet" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script async src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>

    <!-- Css -->
    <link rel="preload stylesheet" as="style" href="{{ asset('css/app.css') }}">
    <link rel="preload stylesheet" as="style" href="{{ asset('css/backend/admin/report-bug.css') }}">
</head>
<body>

    <div id="alert"></div>

    <form id="form" class="form" action="{{ route('backend.admin.bug.bug-report.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="row">

            <div class="col mb-3">
                <label for="email" class="form-label required">{{ __('bug.email') }}</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly required>
            </div>
            
            <div class="col mb-3">
                <label for="datetime" class="form-label required">{{ __('bug.datetime') }}</label>
                <input type="datetime" class="form-control" id="datetime" name="datetime" value="{{ now() }}" readonly required>
            </div>

        </div>

        <div class="row">
            <input type="file" id="image-upload" accept="image/png, image/jpeg" class="required" name="screenshot">
            <label for="image-upload" class="form-label">
                {{ __('bug.screenshot') }}
                <div data-remark="image-upload" data-area="drop & drag">
                    <img class="image-preview" src="" alt="" hidden>
                    <div class="tips">
                        <p>{{ __('bug.select-or-drag-your-image-here') }}</p>
                        <i class="fa-solid fa-file"></i>
                    </div>
                </div>
            </label>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="description" class="form-label required">{{ __('bug.description') }} {{ __('bug.description-example') }}</label>
                <textarea class="form-control" id="description" placeholder="{{ __('bug.description-example') }}" name="description" required></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label for="additional" class="form-label">{{ __('bug.additional') }}</label>
                <input type="text" class="form-control" placeholder="{{ __('bug.additional') }}" id="additional" name="additional">
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <button type="submit" class="btn btn-primary">{{ __('bug.submit') }}</button>
            </div>
        </div>

    </form>
    
</body>
<script defer src="{{ asset('js/backend/admin/report-bug.js') }}"></script>
</html>