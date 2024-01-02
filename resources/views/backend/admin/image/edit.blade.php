

@extends('backend.layouts.app')

@section('title', __('image.edit-image'))

@section('subtitle', __('image.edit-image-description'))

@section('main')

    <div class="flex justify-between items-center mb-1">

        <div class="flex flex-col justify-start">
            <x-form.patch id="imageEditForm" class="flex items-center gap-x-4" :action="route('backend.admin.image.update', ['id' => $image->id])">
                <input class="text-xl read-only:border-none read-only:bg-transparent" type="text" name="name" id="" value="{{ $image->name }}" placeholder="{{ __('image.name') }}" required readonly>
    
                <!-- Edit Button -->
                <button id="readonly" type="button">
                    <i class="fa-solid fa-pen"></i>
                </button>
    
                <!-- Reset Button -->
                <button onclick="resetForm()" id="edit" type="button" hidden>
                    <i class="fa-solid fa-xmark"></i>
                </button>
    
                <!-- Submit Button -->
                <button id="edit" hidden>
                    <i class="fa-solid fa-check"></i>
                </button>
            </x-form.patch>
            <p class="text-sm" id="info-text" hidden></p>
        </div>

        <x-form.post class="flex items-center" :action="route('backend.admin.image.upload', ['id' => $image->id])">
            <label class="p-[.75rem] bg-gray-800 hover:bg-gray-700 text-sm text-white" for="image-upload">
                @lang('Select File')
            </label>
            <p class="text-sm px-2 mr-4 bg-gray-100" id="file-count">@lang('File Have Select', ['count' => 0])</p>
            <input type="file" name="image" id="image-upload" multiple accept="image/png, image/jpeg" hidden>
            <button class="btn btn-primary rounded-sm">@lang('Submit')</button>
        </x-form.post>

    </div>

    <table class="w-full">
        <thead class="border-b-[2px] border-b-gray-400">
            <tr>
                <th class="px-3 py-2">@lang('Id')</th>
                <th>@lang('image.thumbnail')</th>
                <th class="px-3">@lang('image.name')</th>
                <th class="px-3">@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @if (count($image->getImages()) > 0)
                @foreach ($image->getImages() as $index => $image)
                    <tr>
                        <td class="px-3">{{ $index + 1 }}</td>
                        <td class="w-40 py-3">
                            <img class="w-full h-full object-cover" src="{{ asset("storage/$image") }}" alt="">    
                        </td>
                        <td class="px-3">
                            <p class="text-base text-green-800 ">
                                {{ basename($image) }}
                            </p>
                        </td>
                        <td class="px-3">
                            <button class="flex items-center gap-x-4 btn btn-danger">
                                <i class="fa-solid fa-trash"></i>@lang('Delete')
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="px-3 py-2 text-center" colspan="4">@lang('No Record')</td>
                </tr>
            @endif
        </tbody>
    </table>

@endsection

@push('after-style')
    
@endpush

@push('after-script')
    <script>
        const imageUpload = document.querySelector('#image-upload');
        const fileCount = document.querySelector('#file-count');
        imageUpload.addEventListener('change', e => {
            let count = e.target.files.length;
            let text = `{{ __('File Have Select', ['count' => ':count']) }}`
            let innerText = text.replace(':count', count);
            
            fileCount.innerText = innerText;
        })

        const editButton = document.querySelector('#readonly');
        const editForm = document.querySelector('#imageEditForm');
        
        const textInput = editForm.querySelector('input[type="text"]');
        const textInputOriginValue = textInput.value;
        const buttons = document.querySelectorAll('#edit');
        const infoText = document.querySelector('#info-text');

        editButton.addEventListener('click', e => {
            textInput.readOnly = false;
            editButton.hidden = true;
            buttons.forEach(button => {
                button.hidden = false;
            });
        });

        textInput.addEventListener('keyup', e => {
            let text = textInput.value;
            infoText.hidden = false;
            infoText.innerText = `{{ __('Rename') }}` + (text.toLowerCase()).replace(/ /g, '_');
        });

        function resetForm()
        {
            textInput.readOnly = true;
            textInput.value = textInputOriginValue;
            infoText.hidden = true;
            editButton.hidden = false;
            buttons.forEach(button => {
                button.hidden = true;
            });
        }

        // Submit
        editForm.addEventListener('submit', e => {
            
            let newValue = textInput.value;

            if(newValue === textInputOriginValue){
                infoText.hidden = false;
                infoText.innerText = 'You have not change anything.';
                e.preventDefault();
            }

        });

    </script>
@endpush