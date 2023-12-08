
<section class="create-product-form">

    <div class="panel">
        <div class="panel-header">
            <h4 class="panel-title">{{ __('product.image-upload') }} (<span id="product-image-uploaded-count">0</span>/10)</h4>
        </div>
        <div class="panel-body">

            <!-- Product media -->
            @for ($i = 0; $i < 10; $i++)
            <div class="product-media-container" data-index="{{ $i }}">

                <label for="product-{{ $i }}" class="product-media-upload">
                    <input type="file" name="product-{{ $i }}" id="product-{{ $i }}">
                    <i class="upload-icon">
                        <svg viewBox="0 0 23 21" xmlns="http://www.w3.org/2000/svg"><path d="M18.5 0A1.5 1.5 0 0120 1.5V12c-.49-.07-1.01-.07-1.5 0V1.5H2v12.65l3.395-3.408a.75.75 0 01.958-.087l.104.087L7.89 12.18l3.687-5.21a.75.75 0 01.96-.086l.103.087 3.391 3.405c.81.813.433 2.28-.398 3.07A5.235 5.235 0 0014.053 18H2a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 012 0h16.5z"></path><path d="M6.5 4.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM18.5 14.25a.75.75 0 011.5 0v2.25h2.25a.75.75 0 010 1.5H20v2.25a.75.75 0 01-1.5 0V18h-2.25a.75.75 0 010-1.5h2.25v-2.25z"></path></svg>
                    </i>
                    <img class="product-image" data-preview-media="product-{{ $i }}" src alt="" hidden>
                    <button type="button" class="delete-button btn btn-danger" data-delete="product-{{ $i }}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </label>
                <div class="product-media-information">
                    <p class="product-media-name" data-image-name="product-{{ $i }}"></p>
                </div>
            </div>
            @endfor

        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h4 class="panel-title">{{ __('product.model-upload') }}</h4>
        </div>
        <div class="panel-body column">

            <!-- Product name -->
            @for ($i = 0; $i < 10; $i++)
            <div class="product-name-container" data-index="{{ $i }}">
                <div class="col">
                    <label for="product-model-{{ $i }}" class="form-label"></label>
                    <input class="form-control" placeholder="{{ __('product.model') }}"
                        type="text"
                        name="product-model-{{ $i }}"
                        id="product-model-{{ $i }}"
                        list="model"
                    >
                    <datalist id="model">
                    @foreach ($modelData as $model)
                        <option value="{{ $model->name }}">
                    @endforeach
                    </datalist>
                </div>
                <div class="col">
                    <label for="product-model-serial-{{ $i }}" class="form-label"></label>
                    <input class="form-control" placeholder="{{ __('product.model-serial') }}" type="text" name="product-model-serial-{{ $i }}" id="product-model-serial-{{ $i }}">
                </div>

                <!-- Button -->
                <div class="col-2">
                    <label for="" class="form-label"></label>
                    <!-- First or another-->
                    @if ($i == 0)

                    @else
                    <button id="product-name-input-delete-button" type="button" class="form-control btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                        {{ __('product.delete') }}
                    </button>  
                    @endif
                </div>

            </div>
            @endfor

            <button id="product-name-input-add-button" type="button" class="form-control btn btn-primary">
                <i class="fa-solid fa-add"></i>
                {{ __('product.add-name-input') }}
            </button>  

        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h4 class="panel-title">{{ __('product.model-upload') }}</h4>
        </div>
        <div class="panel-body column">

            <!-- Product brand -->
            @for ($i = 0; $i < 10; $i++)
            <div class="product-brand-container" data-index="{{ $i }}">

                <!-- Brand cover -->
                <div class="col-2">
                    <label for="brand-{{ $i }}" class="form-label"></label>
                    <label for="brand-{{ $i }}" class="form-control brand-media-upload">
                        <input type="file" name="brand-{{ $i }}" id="brand-{{ $i }}">
                        <i class="upload-icon">
                            <svg viewBox="0 0 23 21" xmlns="http://www.w3.org/2000/svg"><path d="M18.5 0A1.5 1.5 0 0120 1.5V12c-.49-.07-1.01-.07-1.5 0V1.5H2v12.65l3.395-3.408a.75.75 0 01.958-.087l.104.087L7.89 12.18l3.687-5.21a.75.75 0 01.96-.086l.103.087 3.391 3.405c.81.813.433 2.28-.398 3.07A5.235 5.235 0 0014.053 18H2a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 012 0h16.5z"></path><path d="M6.5 4.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM18.5 14.25a.75.75 0 011.5 0v2.25h2.25a.75.75 0 010 1.5H20v2.25a.75.75 0 01-1.5 0V18h-2.25a.75.75 0 010-1.5h2.25v-2.25z"></path></svg>
                        </i>
                        <img data-preview-media="brand-{{ $i }}" src="" alt="" hidden>
                        <button type="button" class="delete-button btn btn-danger" data-delete-name="brand-{{ $i }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </label>
                    <div class="brand-media-information">
                        <p class="brand-media-name" data-image-name="brand-{{ $i }}"></p>
                    </div>
                </div>

                <!-- Brand -->
                <div class="col-2">
                    <label for="product-brand-{{ $i }}" class="form-label"></label>
                    {{-- <input class="form-control"  type="text" name="brand-{{ $i }}" id="product-brand-{{ $i }}"> --}}
                    <select aria-label="brand" class="form-control" name="product-brand-{{ $i }}" id="product-brand-{{ $i }}">
                        <option value="" disabled selected hidden>{{ __('product.brand') }}</option>
                        @foreach($brandData as $brand)
                            <option value="{{$brand->name}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Brand code -->
                <div class="col-3">
                    <label for="product-brand-code-{{ $i }}" class="form-label"></label>
                    <input class="form-control" placeholder="{{ __('product.brand-code') }}" type="text" name="product-brand-code-{{ $i }}" id="product-brand-code-{{ $i }}">
                </div>
                <!-- Frozen code -->
                <div class="col-3">
                    <label for="product-frozen-code-{{ $i }}" class="form-label"></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">FZ-</span>
                        <input class="form-control" placeholder="{{ __('product.frozen-code') }}" type="text" name="product-frozen-code-{{ $i }}" id="product-frozen-code-{{ $i }}">
                    </div>
                </div>

                <!-- Button -->
                <div class="col-2">
                    <label for="" class="form-label"></label>
                    <!-- First or another-->
                    @if ($i == 0)
                    
                    @else
                    <button id="product-brand-input-delete-button" type="button" class="form-control btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                        {{ __('product.delete') }}
                    </button>  
                    @endif
                </div>

            </div>
            @endfor
            
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
                    <select aria-label="category" class="form-control" name="product-category" id="product-category" required>
                        <option value="" disabled selected hidden>{!! __('product.plaese-select-category') !!}</option>
                        @foreach($categoryData as $category)
                            <option value="{{$category->name}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>

    <button class="btn btn-success" type="submit" id="submit-button">{{ __('product.submit') }}</button>

</section>