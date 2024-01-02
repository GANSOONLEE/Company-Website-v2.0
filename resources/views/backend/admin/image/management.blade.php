
@inject('images', 'App\Domains\Image\Models\Image')

@extends('backend.layouts.app')

@section('title', __('image.management-panel'))

@section('subtitle', __('image.management-panel-description'))

@section('main')

    <x-form.post class="mb-3" :action="route('backend.admin.image.store')">
        
        <div class="flex gap-x-4 mb-[2px]">
            <input type="text" name="name" class="form-control border-[#dee2e6]" placeholder="{{ __('image.name') }}" aria-label="Name" aria-describedby="basic-addon1">
            <button type="submit" class="flex items-center gap-x-4 whitespace-nowrap px-3 rounded-sm text-white bg-blue-600">
                <i class="fa-solid fa-add"></i>@lang('Create')
            </button>
        </div>
        <p class="text-sm">There was be rename to "<span id="name"></span>"</p>

    </x-form.post>

    <table class="w-full bg-white">
        <thead class="border-b-[2px] border-solid border-b-gray-700">
            <tr>
                <th class="px-3 py-2">@lang('Id')</th>
                <th>@lang('image.name')</th>
            </tr>
        </thead>
        <tbody>
            @if (count($images->get()->pluck('name')->toArray()) > 0)
                @foreach ($images->orderBy('name')->get() as $index => $image)
                <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-600 dark:even:bg-gray-700 dark:hover:bg-gray-800">
                    <td class="px-3 py-2">{{ $index }}</td>
                    <td>{{ $image->name }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-xl px-3 py-2 text-center bg-gray-100
                    hover:bg-gray-300" colspan="2">@lang('No Record')</td>
                </tr>
            @endif
        </tbody>
    </table>

@endsection

@push('after-script')
    
    <script>
        let nameInput = document.querySelector('[name="name"]');
        let nameLabel = document.querySelector('#name');

        nameInput.addEventListener('keyup', e => {
            let text = nameInput.value;
            nameLabel.innerText = (text.toLowerCase()).replace(/ /g, '_');
        });

    </script>

@endpush