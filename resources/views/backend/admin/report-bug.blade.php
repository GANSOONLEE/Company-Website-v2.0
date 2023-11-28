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

    <form id="form" class="form" action="" method="post">

        <div class="row">

            <div class="col mb-3">
                <label for="email" class="form-label">{{ __('bug.email') }}</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" disabled required>
            </div>
            
            <div class="col mb-3">
                <label for="datetime" class="form-label">{{ __('bug.datetime') }}</label>
                <input type="datetime" class="form-control" id="datetime" name="datetime" value="{{ now() }}" disabled required>
            </div>

        </div>

        <div class="row">
            <input type="file" accept="image/png, image/jpeg">
            <label for="image-upload" class="form-label">{{ __('bug.screenshot') }}</label>
            <div data-remark="image-upload" data-area="drop & drag">

            </div>
        </div>

    </form>
    
</body>
<script defer src="{{ asset('js/backend/admin/report-bug.js') }}"></script>
</html>