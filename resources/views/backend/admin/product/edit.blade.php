@inject('models', 'App\Domains\Model\Models\Model')
@inject('brands', 'App\Domains\Brand\Models\Brand')
@inject('categories', 'App\Domains\Category\Models\Category')

@extends('backend.layouts.app')

@section('title', __('product.edit-panel'))

@section('subtitle', __('product.edit-panel-description'))

@section('main')

<x-form.patch :action="route('backend.admin.product.update', ['id' => $product->id])" class="overscroll-y-auto">

    <!-- Product Image Upload -->
    <div class="mb-3">
        <h4 class="text-2xl mb-4">@lang('product.image-upload')</h4>
        <ul class="product-image-list flex flex-row gap-x-2 w-full overflow-x-auto" style="max-width: 80%">

            @php
                $files = Storage::disk('public')->files("product/$product->product_category/$product->product_code");
                usort($files, function ($a, $b) {
                    if (strpos($a, 'cover') !== false) {
                        return -1;
                    } elseif (strpos($b, 'cover') !== false) {
                        return 1;
                    }
                    return strcmp($a, $b);
                });
            @endphp
            
            <!-- Image Label -->
            @foreach ($files as $filePath)
                @php
                    $id = Str::random(10);
                    $fileName = path_decode(pathinfo($filePath)['filename']);
                @endphp
                <li class="box flex flex-col mr-3" data-image="product">
                    <div class="container">
                        <label for="{{ $id }}" class="bg-slate-50 border-solid border-2 border-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-800 dark:border-zinc-200 dark:hover:bg-gray-600">
                            <div class="image-tips" hidden>
                                <div class="justify-center align-items-center">
                                    <p style="margin-bottom: 0">Upload Image<i class="fa-solid fa-upload" aria-hidden="true"></i></p>
                                </div>
                            </div>
                            <div class="image-preview">
                                <button class="btn btn-danger bg-danger" type="button" onclick="deleteListItem(this)">
                                    <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                </button>
                                <img src="{{ asset('storage/' . path_decode($filePath)) }}">
                            </div>
                        </label>
                    </div>
                    <input type="file" name="product-image[]" id="{{ $id }}" hidden="" onchange="render(this)">
                    <p>{{ $fileName }}</p>
                </li>
            @endforeach

        </ul>
    </div>

    <!-- Product Name -->
    <div class="mb-3">
        <h4 class="text-2xl mb-4">@lang('product.name')</h4>
        <ul class="product-name-list flex flex-column gap-y-2">

            <!-- row -->
            @foreach ($product->names()->pluck('name')->toArray() as $name)
                @php

                    $id = Str::random(12);

                    $matchedModel = '';
                    foreach ($models::orderBy('name')->get() as $model) {
                        if (stripos($name, $model->name) !== false) {
                            $matchedModel = $model->name;
                            break;
                        }
                    }

                    $serial = trim(str_ireplace($matchedModel, '', $name));

                    $splitName = (object)[
                        'model' => $matchedModel,
                        'serial' => $serial,
                    ];

                @endphp
                <li class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">@lang('product.model')</label>
                            <input value="{{ $splitName->model }}" type="text" list="model-{{ $id }}" name="model[]" id="{{ $id }}" class="form-control rounded-sm dark:bg-gray-700 dark:text-white">
                                <datalist id="model-{{ $id }}">
                                    @foreach ($models::orderBy('name')->pluck('name')->toArray() as $model)
                                        <option value="{{ $model }}"></option>
                                    @endforeach
                                </datalist>
                            </input>
                        </div>
                        <div class="col">
                            <label for="" class="form-label">@lang('product.model-serial')</label>
                            <input value="{{ $splitName->serial }}" type="text" name="model-serial[]" id="" class="form-control rounded-sm dark:bg-gray-700 dark:text-white" required="">
                        </div>
                        <div class="col flex align-items-end">
                            <button class="btn btn-danger bg-danger" type="button" onclick="deleteListItem(this)">@lang('Delete')</button>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>
    </div>

    <!-- Product Brand -->
    <div class="mb-3">
        <h4 class="text-2xl mb-4">@lang('product.brand-upload')</h4>
        <ul class="brand-input-list flex flex-column gap-y-2">

            <!-- row -->
            @foreach ($product->brands()->get() as $brand)
                @php
                    $id = Str::random(12);
                    $filePath = Storage::disk('public')->files("product/$product->product_category/$product->product_code/$brand->sku_id");
                    $hasImage = count($filePath) > 0 ? true : false;
                    $filePath = count($filePath) > 0 ? $filePath[0] : null;
                @endphp
                <li class="mb-3" data-mark="template">
                    <div class="flex flex-row gap-x-2">
                        <div class="w-1/5 flex align-items-end mr-3" data-column="">
                            <label for="{{ $id }}" class="bg-slate-50 border-solid border-2 border-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-800 dark:border-zinc-200 dark:hover:bg-gray-600 cursor-pointer">
                                <div class="image-tips" {{ !$hasImage ? '' : 'hidden' }}>
                                    <div class="justify-center align-items-center">
                                        <i class="fa-solid fa-upload px-2 py-2" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="relative image-preview" {{ $hasImage ? '' : 'hidden' }}>
                                    <button class="absolute right-5 top-3 btn btn-danger bg-danger" type="button" onclick="deleteListItem(this)">
                                        <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                    </button>
                                    <img src="{{ asset('storage/' . $filePath) }}">
                                </div>
                            </label>
                            <input type="file" name="brand-image[]" id="{{ $id }}" class="w-full form-control rounded-sm dark:bg-gray-700 dark:text-white" onchange="render(this)" hidden>
                        </div>
                        <div class="w-96" data-column="">
                            <label for="" class="form-label">
                                <select type="text" name="brand[]" id="" class="w-full form-select rounded-sm dark:bg-gray-700 dark:text-white" required="">
                                    @foreach ($brands->pluck('name')->toArray() as $brandName)
                                        <option value="{{ $brandName }}" {{ $brandName === $brand->brand ? 'selected' : '' }}>{{ $brandName }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="w-2/5" data-column="">
                            <label for="" class="form-label">
                                <input value="{{ $brand->code ?? old('brand-code[]') }}" type="text" name="brand-code[]" id="" class="form-control rounded-sm dark:bg-gray-700 dark:text-white" required="">
                            </label>
                        </div>
                        <div class="w-2/5" data-column="">
                            <label for="" class="form-label">
                                <input value="{{ $brand->frozen_code ?? old('frozen-code[]') }}" type="text" name="frozen-code[]" id="" class="form-control rounded-sm dark:bg-gray-700 dark:text-white" required="">
                            </label>
                        </div>
                        <div class="col">
                            <button class="btn btn-danger bg-danger text-nowrap" type="button" onclick="deleteListItem(this)">@lang('Delete')</button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Product Category -->
    <div class="mb-5">
        <h4 h4 class="text-2xl mb-4">@lang('product.category')</h4>
        <select name="product_category" type="text" class="form-select rounded-sm dark:bg-gray-700 dark:text-white" required>
            <option value="" hidden selected>@lang('product.category')</option>
            @foreach ($categories::pluck('name')->toArray() as $category)
                <option value="{{ $category }}" {{ $category === $product->product_category ? 'selected' : '' }}>{{ $category }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <h4 h4 class="text-2xl mb-4">@lang('product.remark')</h4>
        <textarea class="w-full resize-none bg-slate-50 border-solid border-2 border-gray-800 rounded-md
        hover:bg-gray-300 dark:bg-gray-800 dark:border-zinc-200 dark:hover:bg-gray-600" name="remark" rows="3" placeholder="{{ __('product.remark') }}">{{ $product->remarks }}</textarea>
    </div>

    <button class="btn btn-success bg-success w-full" type="submit">@lang('Submit')</button>

</x-form.patch>

<script>
    const models = @json($models->orderBy('name')->pluck('name')->toArray());
    const template = document.querySelector('[data-mark="template"]');

    // Image List Class
    class ImageList {

        element;
        elementList = [];

        constructor(element) {
            this.element = element;
        }

        buildElement() {
            let imageBox = new ImageBox(this.element, this);
            this.elementList.push(imageBox)
        }

        deleteElement(element) {
            let index = this.elementList.indexOf(element);
            this.elementList.splice(index);
            this.element.removeChild(element)
        }

        uploadElement() {
            this.buildElement();
        }

    }

    // Image Box
    class ImageBox {

        element;
        id;
        parentInstance;
        box;
        container;
        label;
        imageTips;
        imagePreview;
        deleteButton;
        input;
        image;

        build = true;

        constructor(element, parentInstance) {
            this.element = element;
            this.parentInstance = parentInstance
            let id = this.IDGenerator();
            this.id = id;

            // init
            let box = document.createElement("li");
            box.classList.add('box', 'flex', 'flex-col', 'mr-3');
            box.setAttribute('data-image', "product")
            this.box = box;

            this.element.appendChild(box)

            let container = document.createElement("div");
            container.classList.add('container');
            this.container = container;

            box.appendChild(container)

            let label = document.createElement('label');
            label.setAttribute('for', id);
            label.classList.add('bg-slate-50', 'border-solid', 'border-2', 'border-gray-800', 'rounded-md',
                'hover:bg-gray-300', 'dark:bg-gray-800', 'dark:border-zinc-200', 'dark:hover:bg-gray-600');
            this.label = label;

            container.appendChild(label);

            let imageTips = document.createElement("div");
            imageTips.classList.add('image-tips');
            this.imageTips = imageTips;

            label.appendChild(imageTips)

            let tips = document.createElement("div");
            tips.classList.add('justify-center', 'align-items-center');
            tips.innerHTML = "<p style='margin-bottom: 0'>Upload Image<i class='fa-solid fa-upload'></i></p>";

            imageTips.appendChild(tips);

            let imagePreview = document.createElement("div");
            imagePreview.classList.add('image-preview');
            imagePreview.hidden = true;
            this.imagePreview = imagePreview;

            label.appendChild(imagePreview)

            let button = document.createElement("button");
            button.classList.add('btn', 'btn-danger', 'bg-danger');
            button.setAttribute('type', 'button');
            this.deleteButton = button;

            imagePreview.appendChild(button);

            let icon = document.createElement("i");
            icon.classList.add('fa-solid', 'fa-trash');

            button.appendChild(icon);

            let image = document.createElement('img');
            image.src = "";
            this.image = image;

            imagePreview.appendChild(image);


            let input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('name', "product-image[]");
            input.id = id;
            input.hidden = true;
            this.input = input;

            box.appendChild(input)

            let name = document.createElement("p");
            this.name = name;

            box.appendChild(name)

            // Event Listener
            this.input.addEventListener('change', e => {
                this.readerImage(e);
            })

            this.deleteButton.addEventListener('click', e => {
                this.deleteBox();
            });

        }

        /**
         * Generate the unique id of the label and input
         */
        IDGenerator() {
            return Math.random().toString(36).substring(2, 12);
        }

        /**
         * Reader image at img
         */
        readerImage(e) {
            let reader = new FileReader();
            let file = e.target.files[0];

            reader.onloadend = e => {
                this.image.src = reader.result;
            }

            if (file) {
                this.name.innerText = file.name;
                reader.readAsDataURL(file);
                this.input.required = true;
            }

            this.showHideTips()

            if (this.build) {
                this.parentInstance.uploadElement();
                this.build = false;
            }
        }

        /**
         * Check the image and to show/hide 
         */
        showHideTips() {
            let src = this.image.src;
            if (src == null || src == "") {
                this.imageTips.hidden = false;
                this.imagePreview.hidden = true;
                return false;
            }

            this.imageTips.hidden = true;
            this.imagePreview.hidden = false;
        }

        /**
         * Delete the box 
         */
        deleteBox() {
            window.confirm('Are you sure you want to delete this?') ?
                this.parentInstance.deleteElement(this.box) :
                false;
        }

    }

    // Name Input List Class
    class NameInputList {
        element;
        elementList = [];

        constructor(element) {
            this.element = element;
        }

        buildElement() {
            let imageBox = new NameInputBox(this.element, this);
            this.elementList.push(imageBox)
            console.info(this.elementList)
        }

        deleteElement(elementNeedFind) {
            let index = this.elementList.findIndex(element => element.box === elementNeedFind);
            this.elementList.splice(index);
            this.element.removeChild(elementNeedFind)
            this.elementList[index - 1].build = true;
        }

        uploadElement() {
            this.buildElement();
        }
    }

    class NameInputBox {

        element;
        id;
        parentInstance;

        box;
        container;
        label;
        imageTips;
        imagePreview;
        deleteButton;
        input;
        image;

        build = true;

        constructor(element, parentInstance) {
            this.element = element;
            this.parentInstance = parentInstance;

            let id = this.IDGenerator();
            this.id = id;

            // init
            // Create li element
            // Create li element
            let liElement = document.createElement('li');
            liElement.classList.add('mb-3');
            this.box = liElement;

            // Create row div
            let rowDiv = document.createElement('div');
            rowDiv.classList.add('row');
            liElement.appendChild(rowDiv);

            // Create first column
            let firstColDiv = document.createElement('div');
            firstColDiv.classList.add('col');

            // Create label for model
            let labelForModel = document.createElement('label');
            labelForModel.setAttribute('for', '');
            labelForModel.classList.add('form-label');
            labelForModel.textContent = `{{ __('product.model') }}`;
            firstColDiv.appendChild(labelForModel);

            // Create input for model
            let modelInput = document.createElement('input');
            modelInput.setAttribute('type', 'text');
            modelInput.setAttribute('list', `model-${id}`);
            modelInput.setAttribute('name', 'model[]');
            modelInput.setAttribute('id', id);
            modelInput.classList.add('form-control', 'rounded-sm', 'dark:bg-gray-700', 'dark:text-white');
            firstColDiv.appendChild(modelInput);

            // Create datalist for model
            let modelDatalist = document.createElement('datalist');
            modelDatalist.setAttribute('id', `model-${id}`);

            // Assuming $models is an array of objects with a 'name' property
            models.forEach(model => {
                let option = document.createElement('option');
                option.setAttribute('value', model);
                modelDatalist.appendChild(option);
            });

            // Append datalist to model input
            modelInput.appendChild(modelDatalist);

            rowDiv.appendChild(firstColDiv);

            // Create second column
            let secondColDiv = document.createElement('div');
            secondColDiv.classList.add('col');

            // Create label for model-serial
            let labelForModelSerial = document.createElement('label');
            labelForModelSerial.setAttribute('for', '');
            labelForModelSerial.classList.add('form-label');
            labelForModelSerial.textContent = `{{ __('product.model-serial') }}`;
            secondColDiv.appendChild(labelForModelSerial);

            // Create input for model-serial
            let modelSerialInput = document.createElement('input');
            modelSerialInput.setAttribute('type', 'text');
            modelSerialInput.setAttribute('name', 'model-serial[]');
            modelSerialInput.setAttribute('id', '');
            modelSerialInput.classList.add('form-control', 'rounded-sm', 'dark:bg-gray-700', 'dark:text-white');
            modelSerialInput.setAttribute('required', '');
            secondColDiv.appendChild(modelSerialInput);

            rowDiv.appendChild(secondColDiv);

            // Append the li element to the desired container
            document.querySelector('.product-name-list').appendChild(liElement);

            let deleteCol = document.createElement('div');
            deleteCol.classList.add('col', 'flex', 'align-items-end');
            rowDiv.appendChild(deleteCol);

            let deleteRowButton = document.createElement("button");
            deleteRowButton.classList.add('btn', 'btn-danger', 'bg-danger');
            deleteRowButton.setAttribute('type', 'button');
            deleteRowButton.innerText = `{{ __('Delete') }}`;
            this.deleteRowButton = deleteRowButton;
            deleteCol.appendChild(deleteRowButton);

            // if (this.parentInstance.elementList.length == 0) {
            //     this.deleteRowButton.disabled = true;
            // }

            deleteRowButton.addEventListener('click', e => {
                this.deleteBox();
            })

            let inputs = [modelInput, modelSerialInput]; // Add other inputs here
            inputs.forEach(input => {
                input.addEventListener('input', () => {

                    if (this.build) {
                        this.parentInstance.buildElement();
                        this.build = false;
                    }

                });
            });
        }

        /**
         * Generate the unique id of the label and input
         */
        IDGenerator() {
            return Math.random().toString(36).substring(2, 12);
        }

        /**
         * Reader image at img
         */
        readerImage(e) {
            let reader = new FileReader();
            let file = e.target.files[0];

            reader.onloadend = e => {
                this.image.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
                this.input.required = true;
            }

            this.showHideTips()

            if (this.build) {
                this.parentInstance.uploadElement();
                this.build = false;
            }
        }

        /**
         * Check the image and to show/hide 
         */
        showHideTips() {

            let src = this.image.src;
            if (src == null || src == "") {
                this.imageTips.hidden = false;
                this.imagePreview.hidden = true;
                return false;
            }

            this.imageTips.hidden = true;
            this.imagePreview.hidden = false;

        }

        /**
         * Delete the box 
         */
        deleteBox() {
            window.confirm('Are you sure you want to delete this?') ?
                this.parentInstance.deleteElement(this.box) :
                false;
        }

    }

    // Brand Input List Class
    class InputList {
        element;
        elementList = [];

        constructor(element) {
            this.element = element;
        }

        buildElement() {
            let imageBox = new InputBox(this.element, this);
            this.elementList.push(imageBox)
            console.info(this.elementList)
        }

        deleteElement(elementNeedFind) {
            let index = this.elementList.findIndex(element => element.box === elementNeedFind);
            this.elementList.splice(index);
            this.element.removeChild(elementNeedFind)
            this.elementList[index - 1].build = true;
        }

        uploadElement() {
            this.buildElement();
        }
    }

    class InputBox {

        element;
        id;
        parentInstance;

        box;
        container;
        label;
        imageTips;
        imagePreview;
        deleteButton;
        input;
        image;

        build = true;

        constructor(element, parentInstance) {
            this.element = element;
            this.parentInstance = parentInstance;

            let id = this.IDGenerator();
            this.id = id;

            // init
            // Create li element
            let liElement = document.createElement('li');
            liElement.classList.add('mb-3');
            liElement.setAttribute('data-mark', 'template');
            this.box = liElement;

            // Create row div
            let rowDiv = document.createElement('div');
            rowDiv.classList.add('flex', 'flex-row', 'gap-x-2');
            liElement.appendChild(rowDiv);

            // Create Image column
            let imageColDiv = document.createElement('div');
            imageColDiv.classList.add('w-1/5', 'flex', 'align-items-end', 'mr-3');
            imageColDiv.setAttribute('data-column', '');

            // Create label for Image
            let labelForImage = document.createElement('label');
            labelForImage.setAttribute('for', id);
            labelForImage.classList.add('bg-slate-50', 'border-solid', 'border-2', 'border-gray-800', 'rounded-md',
                'hover:bg-gray-300', 'dark:bg-gray-800', 'dark:border-zinc-200', 'dark:hover:bg-gray-600',
                'cursor-pointer');

            // Create image-tips div
            let imageTipsDiv = document.createElement('div');
            imageTipsDiv.classList.add('image-tips');

            let justifyCenterDiv = document.createElement('div');
            justifyCenterDiv.classList.add('justify-center', 'align-items-center');

            let uploadIcon = document.createElement('i');
            uploadIcon.classList.add('fa-solid', 'fa-upload', 'px-2', 'py-2');
            uploadIcon.setAttribute('aria-hidden', 'true');

            justifyCenterDiv.appendChild(uploadIcon);
            imageTipsDiv.appendChild(justifyCenterDiv);
            labelForImage.appendChild(imageTipsDiv);
            this.imageTips = imageTipsDiv;

            // Create image-preview div
            let imagePreviewDiv = document.createElement('div');
            imagePreviewDiv.classList.add('image-preview');
            imagePreviewDiv.setAttribute('hidden', '');
            this.imagePreview = imagePreviewDiv;

            // let deleteButton = document.createElement('button');
            // deleteButton.classList.add('btn', 'btn-danger', 'bg-danger');
            // deleteButton.setAttribute('type', 'button');

            // let deleteIcon = document.createElement('i');
            // deleteIcon.classList.add('fa-solid', 'fa-trash');
            // deleteButton.appendChild(deleteIcon);

            let image = document.createElement('img');
            image.setAttribute('src', '');
            // imagePreviewDiv.appendChild(deleteButton);
            imagePreviewDiv.appendChild(image);
            this.image = image;

            labelForImage.appendChild(imagePreviewDiv);

            // Create input for file
            let fileInput = document.createElement('input');
            fileInput.setAttribute('type', 'file');
            fileInput.setAttribute('name', 'brand-image[]');
            fileInput.setAttribute('id', id);
            fileInput.classList.add('w-full', 'form-control', 'rounded-sm', 'dark:bg-gray-700', 'dark:text-white');
            fileInput.setAttribute('hidden', '');
            fileInput.setAttribute('required', '');
            this.input = fileInput;

            imageColDiv.appendChild(labelForImage);
            imageColDiv.appendChild(fileInput);

            rowDiv.appendChild(imageColDiv);

            let brandColDiv = document.createElement('div');
            brandColDiv.classList.add('w-96');
            brandColDiv.setAttribute('data-column', '');

            // Create label for Brand
            let labelForBrand = document.createElement('label');
            labelForBrand.setAttribute('for', '');
            labelForBrand.classList.add('form-label');

            let brandInput = document.createElement('select');
            brandInput.setAttribute('type', 'text');
            brandInput.setAttribute('name', 'brand[]');
            brandInput.setAttribute('id', '');
            brandInput.classList.add('w-full', 'form-select', 'rounded-sm', 'dark:bg-gray-700', 'dark:text-white');
            brandInput.setAttribute('required', '');

            const brands = @json($brands->orderBy('name')->pluck('name')->toArray());
            brands.forEach(brand => {
                let option = document.createElement('option');
                option.setAttribute('value', brand);
                option.innerText = brand;
                brandInput.appendChild(option);
            });

            labelForBrand.appendChild(brandInput);
            brandColDiv.appendChild(labelForBrand);
            rowDiv.appendChild(brandColDiv);

            // Create Code column
            let codeColDiv = document.createElement('div');
            codeColDiv.classList.add('w-2/5');
            codeColDiv.setAttribute('data-column', '');

            // Create label for Code
            let labelForCode = document.createElement('label');
            labelForCode.setAttribute('for', '');
            labelForCode.classList.add('form-label');

            let codeInput = document.createElement('input');
            codeInput.setAttribute('type', 'text');
            codeInput.setAttribute('name', 'brand-code[]');
            codeInput.setAttribute('id', '');
            codeInput.classList.add('form-control', 'rounded-sm', 'dark:bg-gray-700', 'dark:text-white');
            codeInput.setAttribute('required', '');

            labelForCode.appendChild(codeInput);
            codeColDiv.appendChild(labelForCode);
            rowDiv.appendChild(codeColDiv);

            // Create Frozen column
            let frozenColDiv = document.createElement('div');
            frozenColDiv.classList.add('w-2/5');
            frozenColDiv.setAttribute('data-column', '');

            // Create label for Frozen
            let labelForFrozen = document.createElement('label');
            labelForFrozen.setAttribute('for', '');
            labelForFrozen.classList.add('form-label');

            let frozenInput = document.createElement('input');
            frozenInput.setAttribute('type', 'text');
            frozenInput.setAttribute('name', 'frozen-code[]');
            frozenInput.setAttribute('id', '');
            frozenInput.classList.add('form-control', 'rounded-sm', 'dark:bg-gray-700', 'dark:text-white');
            frozenInput.setAttribute('required', '');

            labelForFrozen.appendChild(frozenInput);
            frozenColDiv.appendChild(labelForFrozen);
            rowDiv.appendChild(frozenColDiv);

            let deleteCol = document.createElement('div');
            deleteCol.classList.add('col');
            rowDiv.appendChild(deleteCol);

            let deleteRowButton = document.createElement("button");
            deleteRowButton.classList.add('btn', 'btn-danger', 'bg-danger', 'text-nowrap');
            deleteRowButton.setAttribute('type', 'button');
            deleteRowButton.innerText = `{{ __('Delete') }}`;
            this.deleteRowButton = deleteRowButton;

            // if (this.parentInstance.elementList.length == 0) {
            //     this.deleteRowButton.disabled = true;
            // }

            deleteCol.appendChild(deleteRowButton);

            // Append the li element to the desired container
            document.querySelector('ul.brand-input-list').appendChild(liElement);

            deleteRowButton.addEventListener('click', e => {
                this.deleteBox();
            })

            this.input.addEventListener('change', e => {
                this.readerImage(e);
            })

            let inputs = [brandInput, codeInput, frozenInput]; // Add other inputs here
            inputs.forEach(input => {
                input.addEventListener('input', () => {

                    if (this.build) {
                        this.parentInstance.buildElement();
                        this.build = false;
                    }

                });
            });
        }

        /**
         * Generate the unique id of the label and input
         */
        IDGenerator() {
            return Math.random().toString(36).substring(2, 12);
        }

        /**
         * Reader image at img
         */
        readerImage(e) {
            let reader = new FileReader();
            let file = e.target.files[0];

            reader.onloadend = e => {
                this.image.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
                this.input.required = true;
            }

            this.showHideTips()

            if (this.build) {
                this.parentInstance.uploadElement();
                this.build = false;
            }
        }

        /**
         * Check the image and to show/hide 
         */
        showHideTips() {

            let src = this.image.src;
            if (src == null || src == "") {
                this.imageTips.hidden = false;
                this.imagePreview.hidden = true;
                return false;
            }

            this.imageTips.hidden = true;
            this.imagePreview.hidden = false;

        }

        /**
         * Delete the box 
         */
        deleteBox() {
            window.confirm('Are you sure you want to delete this?') ?
                this.parentInstance.deleteElement(this.box) :
                false;
        }

    }

    let list = new ImageList(document.querySelector('ul.product-image-list'));
    list.buildElement();

    let name = new NameInputList(document.querySelector('ul.product-name-list'));
    name.buildElement();

    let brand = new InputList(document.querySelector('ul.brand-input-list'));
    brand.buildElement();

function deleteListItem(button)
{
    let listItem = button.closest('li');

    let result = confirm('Are you sure you want to delete this?');

    if (!listItem && !result) {
        return false;
    }

    // if image?
    if (button.parentElement.querySelector('img')){

        let xhr = new XMLHttpRequest();
        const link = button.parentElement.querySelector('img').src;

        // filter domain name
        const regex = /^https?:\/\/[^\/]+/;
        const filterUrl = link.replace(regex, "");

        xhr.open('post', route('backend.admin.product.delete-image'), true)

        xhr.onreadystatechange = () => {
            let data = JSON.parse(xhr.responseText);
        }
        
        // csrf token
        let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        
        let formData = new FormData();
        formData.append('link', link);
        formData.append('_method', 'delete');

        xhr.send(formData);

        let imageTips = listItem.querySelector('div.image-tips')
        let imagePreview = listItem.querySelector('div.image-preview')

        imageTips.hidden = false;
        imagePreview.hidden = true;

    }else{
        listItem.remove();
    }
}

function render(input)
{
    let reader = new FileReader();
    let file = input.files[0];

    reader.onloadend = event => {
        input.closest('li').querySelector('img').src = reader.result;
    }

    if (file) {
        input.closest('li').querySelector('p') ? input.closest('li').querySelector('p').innerText = file.name : null;
        reader.readAsDataURL(file);
        input.required = true;
    }

    showHideTips(input.closest('li'))
}

function showHideTips(li)
{
    let imageTips = li.querySelector('div.image-tips')
    let imagePreview = li.querySelector('div.image-preview')

    imageTips.hidden = true;
    imagePreview.hidden = false;
}
</script>

@endsection