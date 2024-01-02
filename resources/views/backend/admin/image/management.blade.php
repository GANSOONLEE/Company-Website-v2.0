
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
        <p class="text-sm">@lang('Rename') "<span id="name"></span>"</p>

    </x-form.post>

    <table class="w-full bg-white dark:!bg-gray-800">
        <thead class="border-b-[2px] border-solid border-b-gray-700">
            <tr>
                <th class="px-4 py-3">@lang('Id')</th>
                <th>@lang('image.name')</th>
                <th>@lang('image.count')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @if (count($images->get()->pluck('name')->toArray()) > 0)
                @foreach ($images->orderBy('name')->paginate(8) as $index => $image)
                <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-700 dark:even:bg-gray-800 dark:hover:bg-gray-900">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td>{{ $image->name }}</td>
                    <td>{{ $image->mediaCount() }}</td>
                    <td class="w-96">
                        <div class="flex justify-start items-center gap-x-4">

                            <!-- File Hyperlinks -->
                            <a href="{{ route('backend.admin.image.edit', ['id' => $image->id]) }}">
                                <button class="flex justify-center items-center px-3 py-2 rounded-sm bg-primary text-white">
                                    <i class="fa-solid fa-file pr-4"></i>@lang('File')
                                </button>
                            </a>

                            <!-- Delete Button -->
                            <x-form.delete id="deleteImageForm" :action="route('backend.admin.image.destroy', ['id' => $image->id])">
                                <button class="flex justify-center items-center px-3 py-2 text-danger outline-1 outline-danger outline dark:text-red-300">
                                    <i class="fa-solid fa-trash pr-4"></i>@lang('Delete')
                                </button>
                            </x-form.delete>
                        </div>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-xl px-3 py-2 text-center bg-gray-100
                    hover:bg-gray-300" colspan="4">@lang('No Record')</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $images->orderBy('name')->paginate(8)->links() }}

@endsection

@push('after-script')
    
    <script>
        let nameInput = document.querySelector('[name="name"]');
        let nameLabel = document.querySelector('#name');

        nameInput.addEventListener('keyup', e => {
            let text = nameInput.value;
            nameLabel.innerText = (text.toLowerCase()).replace(/ /g, '_');
        });

        // Form Event
        let deleteImageForm = document.querySelector('#deleteImageForm');
        deleteImageForm.addEventListener('submit', e => {
            confirm('Are you sure you want to delete it?') ?
                deleteImageForm.submit() :
                e.preventDefault();
        });

    </script>

@endpush