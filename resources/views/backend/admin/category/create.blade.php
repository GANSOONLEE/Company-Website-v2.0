
@inject('categoriesTitle', 'App\Domains\Category\Models\CategoryTitle')

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

        <div class="mb-3">
            <label for="order" class="form-label required">@lang('category.order')</label>
            <select name="order" id="order" class="form-select dark:bg-gray-800 dark:text-white" placeholder="order">
                <option value="" readonly hidden>@lang('category.order')</option>
                @foreach ($categoriesTitle->get() as $categoryTitle)
                    <option value="{{ $categoryTitle->id }}">{{ $categoryTitle->title }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary bg-blue-600" type="submit">@lang('Submit')</button>

    </x-form.post>

    <div class="flex flex-col md:flex-row justify-between">

        <x-control-panel :class="'mt-4'" :title="trans('category.create-title')">

            <x-form.post :action="route('backend.admin.categoryTitle.store')">

                <div class="mb-3">
                    <label for="title" class="form-label required">@lang('category.title')</label>
                    <input name="title" id="title" type="text" class="form-control dark:bg-gray-800 dark:text-white" placeholder="title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label required">@lang('category.order')</label>
                    <input name="order" id="order" type="number" min="1" max="100" class="form-control dark:bg-gray-800 dark:text-white" placeholder="order" value="{{ old('order') }}" required>
                </div>

                <button class="btn btn-success bg-green-600 text-white">@lang('Submit')</button>

            </x-form.post>

        </x-control-panel>

        <x-control-panel :class="'mt-4'" :title="trans('category.update-title')">

            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr>
                        <th class="px-3 py-2">@lang('Id')</th>
                        <th>
                            <span class="hidden md:table-cell">@lang('category.title')</span>
                            <span class="table-cell md:hidden">@lang('order.detail')</span>
                        </th>
                        <th class="hidden md:table-cell">@lang('category.order')</th>
                        <th class="sr-only">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoriesTitle->orderBy('order')->get() as $index => $categoryTitle)
                        <x-form.patch :action="route('backend.admin.categoryTitle.update', ['id' => $categoryTitle->id])">
                            <tr class="border-gray-400 border-b-[1px] border-t-[1px] md:border-none">
                                <td class="px-3 mb-[.5rem] md:mb-[0] py-2">{{ $index + 1 }}</td>
                                <td class="block pb-[.5rem] md:pb-[0] md:!table-cell">
                                    <input class="w-full" type="text" name="title" value="{{ $categoryTitle->title }}" placeholder="{{ trans('category.title') }}">
                                </td>
                                <td class="block pb-[.5rem] md:pb-[0] md:!table-cell">
                                    <input class="w-full" type="number" name="order" value="{{ $categoryTitle->order }}" placeholder="{{ trans('category.order') }}">
                                </td>
                                <td class="block pb-3 md:!pb-[0] md:!table-cell">
                                    <div>
                                        <button class="btn btn-success bg-green-600 text-white">@lang('Submit')</button>

                                        <x-form.delete :action="route('backend.admin.categoryTitle.delete', ['id' => $categoryTitle->id])">
                                            <button class="btn btn-danger bg-red-600 text-white">@lang('Delete')</button>
                                        </x-form.delete>
                                    </div>
                                </td>
                            </tr>
                        </x-form.patch>
                    @endforeach
                </tbody>
            </table>

            {{-- <button class="btn btn-success bg-green-600 text-white">@lang('Submit')</button> --}}

        </x-control-panel>

    </div>

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