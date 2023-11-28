
<section class="create-product-form">

    <div class="panel">
        <div class="panel-header">
            <h4 class="panel-title">{{ __('product.image-upload') }} (<span id="product-image-uploaded-count">0</span>/10)</h4>
        </div>
        <div class="panel-body">

            @php
                $imagePath = [];
                foreach ($productImages as $key => $image) {
                    $imagePath[$key] = $image;
                }
                for($i = count($productImages); $i < 10; $i++) {
                    $imagePath["product-$i"] = '';
                }
            @endphp

            <!-- Product media -->
            @foreach ($imagePath as $key => $image)

            <div class="product-media-container" data-index="{{ $key }}">

                <label for="{{ $key }}" class="product-media-upload">
                    <input type="file" name="{{ $key }}" id="{{ $key }}">
                    <img class="product-image" data-preview-media="{{ $key }}" src="{{ asset(is_object($image) ? $image->path : '' )}}" alt="" {{ is_object($image) ? '' : 'hidden' }}>
                    <i class="upload-icon">
                        <svg viewBox="0 0 23 21" xmlns="http://www.w3.org/2000/svg"><path d="M18.5 0A1.5 1.5 0 0120 1.5V12c-.49-.07-1.01-.07-1.5 0V1.5H2v12.65l3.395-3.408a.75.75 0 01.958-.087l.104.087L7.89 12.18l3.687-5.21a.75.75 0 01.96-.086l.103.087 3.391 3.405c.81.813.433 2.28-.398 3.07A5.235 5.235 0 0014.053 18H2a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 012 0h16.5z"></path><path d="M6.5 4.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM18.5 14.25a.75.75 0 011.5 0v2.25h2.25a.75.75 0 010 1.5H20v2.25a.75.75 0 01-1.5 0V18h-2.25a.75.75 0 010-1.5h2.25v-2.25z"></path></svg>
                    </i>
                    <button type="button" class="delete-button btn btn-danger" data-delete="{{ $key }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </label>
                <div class="product-media-information">
                    <p class="product-media-name" data-image-name="{{ $key }}">{{ is_object($image) ? $image->name : '' }}</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h4 class="panel-title">{{ __('product.model-upload') }}</h4>
        </div>
        <div class="panel-body column">

            @php
                $productNameArray = [];
                $productNameCollection = $product->getProductName();
                foreach ($productNameCollection as $index => $productName) {

                    $matchedModel = '';
                    foreach ($modelData as $model) {
                        if (stripos($productName->name, $model->name) !== false) {
                            $matchedModel = $model->name;
                            break;
                        }
                    }

                    $serial = trim(str_ireplace($matchedModel, '', $productName->name));

                    $productNameArray[] = (object)[
                        'model' => $matchedModel,
                        'serial' => $serial,
                    ];
                }

                for ($i = count($productNameCollection); $i < 10; $i++) { 
                    $productNameArray[] = '';
                }
            @endphp

            <!-- Product name -->
            @foreach ($productNameArray as $index => $productName)
            <div class="product-name-container" data-index="{{ $index }}"
                {{ is_object($productName) ? '' : 'hidden' }}
            >
                <div class="col">
                    <label for="product-model-{{ $index }}" class="form-label"></label>
                    <input class="form-control" placeholder="{{ __('product.model') }}"
                        type="text"
                        name="product-model-{{ $index }}"
                        id="product-model-{{ $index }}"
                        list="model"
                        value="{{ is_object($productName) ? $productName->model : '' }}"
                    >
                    <datalist id="model">
                    @foreach ($modelData as $model)
                        <option value="{{ $model->name }}">
                    @endforeach
                    </datalist>
                </div>
                <div class="col">
                    <label for="product-model-serial-{{ $index }}" class="form-label"></label>
                    <input class="form-control" placeholder="{{ __('product.model-serial') }}"
                        type="text"
                        name="product-model-serial-{{ $index }}"
                        id="product-model-serial-{{ $index }}"
                        value="{{ is_object($productName) ? $productName->serial : '' }}"
                    >
                </div>

                <!-- Button -->
                <div class="col-2">
                    <label for="" class="form-label"></label>
                    <!-- First or another-->
                    @if ($index == 0)

                    @else
                    <button id="product-name-input-delete-button" type="button" class="form-control btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                        {{ __('product.delete') }}
                    </button>  
                    @endif
                </div>

            </div>
            @endforeach

            <button id="product-name-input-add-button" type="button" class="form-control btn btn-primary">
                <i class="fa-solid fa-add"></i>
                {{ __('product.add-name-input') }}
            </button>  

        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h4 class="panel-title">{{ __('product.brand-upload') }}</h4>
        </div>
        <div class="panel-body column">

            @php
                $productBrandArray = [];
                $productBrandCollection = $product->getProductBrand();

                if(count($productBrandCollection) < 0){
                    return;
                };

                foreach ($productBrandCollection as $index => $productBrand) {

                    
                    // add brand cover path
                    $baseDirectory = "/product/$product->product_category/$product->product_code/$productBrand->code";
                    $brandCover = \Illuminate\Support\Facades\Storage::disk('public')->files($baseDirectory);
                    if(count($brandCover) > 0){
                        $productBrand->brand_media = '/storage/' . $brandCover[0];

                        // add brand cover name
                        $imageInstance = new \Illuminate\Http\UploadedFile(\Illuminate\Support\Facades\Storage::disk('public')->path($brandCover[0]), $brandCover[0]);
                        $productBrand->brand_media_name = $imageInstance->getClientOriginalName();
    
                        // filter "FZ-" at frozen_code
                        $productBrand->frozen_code = str_replace('FZ-', '', $productBrand->frozen_code);
                        $productBrandArray[] = $productBrand;
                    }

                }

                for ($i = count($productBrandCollection); $i < 10; $i++) { 
                    $productBrandArray[] = '';
                }
            @endphp

            <!-- Product brand -->
            @foreach ($productBrandArray as $index => $productBrand)
            <div class="product-brand-container" data-index="{{ $index }}" {{ is_object($productBrand) ? '' : 'hidden' }}>

                <!-- Brand cover -->
                <div class="col-2">
                    <label for="brand-{{ $index }}" class="form-label"></label>
                    <label for="brand-{{ $index }}" class="form-control brand-media-upload">
                        <input type="file" name="brand-{{ $index }}" id="brand-{{ $index }}">
                        <img data-preview-media="brand-{{ $index }}"
                            src="{{ is_object($productBrand) ? $productBrand->brand_media : '' }}" alt=""
                            {{ is_object($productBrand) ? '' : 'hidden' }}>
                        <i class="upload-icon">
                            <svg viewBox="0 0 23 21" xmlns="http://www.w3.org/2000/svg"><path d="M18.5 0A1.5 1.5 0 0120 1.5V12c-.49-.07-1.01-.07-1.5 0V1.5H2v12.65l3.395-3.408a.75.75 0 01.958-.087l.104.087L7.89 12.18l3.687-5.21a.75.75 0 01.96-.086l.103.087 3.391 3.405c.81.813.433 2.28-.398 3.07A5.235 5.235 0 0014.053 18H2a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 012 0h16.5z"></path><path d="M6.5 4.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM18.5 14.25a.75.75 0 011.5 0v2.25h2.25a.75.75 0 010 1.5H20v2.25a.75.75 0 01-1.5 0V18h-2.25a.75.75 0 010-1.5h2.25v-2.25z"></path></svg>
                        </i>
                        <button type="button" class="delete-button btn btn-danger" data-delete-name="brand-{{ $index }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </label>
                    <div class="brand-media-information">
                        <p class="brand-media-name" data-image-name="brand-{{ $index }}">{{ is_object($productBrand) ?$productBrand->brand_media_name : '' }}</p>
                    </div>
                </div>

                <!-- Brand -->
                <div class="col-2">
                    <label for="product-brand-{{ $index }}" class="form-label"></label>
                    {{-- <input class="form-control"  type="text" name="brand-{{ $i }}" id="product-brand-{{ $i }}"> --}}
                    <select class="form-control" name="product-brand-{{ $index }}" id="product-brand-{{ $index }}">
                        <option value="" disabled selected hidden>{{ __('product.brand') }}</option>
                        @foreach($brandData as $brand)
                            <option value="{{$brand->name}}"
                                {{ is_object($productBrand) ? $brand->name === $productBrand->brand ? 'selected' : '' : '' }}
                            >{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Brand code -->
                <div class="col-3">
                    <label for="product-brand-code-{{ $index }}" class="form-label"></label>
                    <input class="form-control" placeholder="{{ __('product.brand-code') }}"
                        type="text"
                        name="product-brand-code-{{ $index }}"
                        id="product-brand-code-{{ $index }}"
                        value="{{ is_object($productBrand) ? $productBrand->code : '' }}"
                    >
                </div>
                <!-- Frozen code -->
                <div class="col-3">
                    <label for="product-frozen-code-{{ $index }}" class="form-label"></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">FZ-</span>
                        <input class="form-control" placeholder="{{ __('product.frozen-code') }}"
                            type="text"
                            name="product-frozen-code-{{ $index }}"
                            id="product-frozen-code-{{ $index }}"
                            value="{{ is_object($productBrand) ? $productBrand->frozen_code : '' }}"
                        >
                    </div>
                </div>

                <!-- Button -->
                <div class="col-2">
                    <label for="" class="form-label"></label>
                    <!-- First or another-->
                    @if ($index == 0)
                    
                    @else
                    <button id="product-brand-input-delete-button" type="button" class="form-control btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                        {{ __('product.delete') }}
                    </button>  
                    @endif
                </div>

            </div>
            @endforeach
            
            <button id="product-brand-input-add-button" type="button" class="form-control btn btn-primary">
                <i class="fa-solid fa-add"></i>
                {{ __('product.add-brand-input') }}
            </button>  
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h4 class="panel-title">{{ __('product.category-upload') }}</h4>
        </div>
        <div class="panel-body column">

            <!-- Product category -->
            <div class="product-category-container" data-index="0">
                <div class="col">
                    <label for="product-category" class="form-label"></label>
                    {{-- <input class="form-control" placeholder="{{ __('product.category') }}" type="text" name="product-category" id="product-category"> --}}
                    <select class="form-control" name="product-category" id="" required>
                        <option value="" disabled selected hidden>{!! __('product.plaese-select-category') !!}</option>
                        @foreach($categoryData as $category)
                            <option value="{{$category->name}}"
                                {{ $product->product_category == $category->name ? 'selected' : ''}}
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>

    <button class="btn btn-success" type="submit" id="submit-button">{{ __('product.submit') }}</button>

</section>