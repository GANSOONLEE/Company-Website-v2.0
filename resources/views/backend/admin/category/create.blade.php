
@extends('backend.layouts.app')

@section('title', __('category.create-panel'))

@section('subtitle', __('category.create-panel-description'))

@section('main')

    <x-form.post :action="route('backend.admin.category.store')" enctype="multipart/form-data">

        <div class="mb-3">
            <p class="text-xl mb-3">@lang('category.image')</p>
            <label for="image" class="form-label w-[14rem] h-[14rem] border-1 border-solid border-gray-600 cursor-pointer transition-all duration-[120ms] hover:bg-gray-300">
                <img src="" alt="" onload="this.style.display = 'block'" onerror="this.style.display = 'none'">
            </label>
            <input name="image" id="image" type="file" file="{{ old('image') }}" hidden>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label required">@lang('category.name')</label>
            <input name="name" id="name" type="text" class="form-control dark:bg-gray-800 dark:text-white" placeholder="name" value="{{ old('name') }}" required>
        </div>

        <button class="btn btn-primary bg-blue-600" type="submit">@lang('Submit')</button>

    </x-form.post>

@endsection

@push('after-script')

    <script>
        let imageInput = document.querySelector('input[type="file"]');
        imageInput.addEventListener('change', e => {

            let file = e.target.files[0];
            let reader = new FileReader();
            let image = e.target.closest('div.mb-3').querySelector('img');

            reader.readAsDataURL(file);
            reader.onloadend = () => {
                image.src = reader.result;
            }

        })
    </script>

@endpush