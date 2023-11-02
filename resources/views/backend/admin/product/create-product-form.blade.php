
<!-- Image -->
<section class="data-area">
    <p class="section-title">{{ __('product.image-upload') }}</p>
    <!-- Cover -->
    <div class="section-content">
        <div class="product-cover">
            <label for="product-cover">
                <div class="cover-preview">
                    <img class="cover-preview-image thumbnail" src="" alt="" onerror="this.style.display = 'none'" onload="this.style.display = 'block'">
                </div>
            </label>
            <input type="file" name="product-cover" id="product-cover" class="product-cover-input" accept=".jpg, .png, .jpeg" required>
            <p class="description">{{ __('product.cover') }}</p>
        </div>

        <!-- Another picture -->
        <section class="product-images">

            <!-- Image -->
            @for($i=0; $i<10; $i++)
            <div class="product-image">
                <label for="product-picture-{{$i}}">
                    <div class="picture-preview">
                        <img class="picture-preview-image thumbnail" src="" alt="" onerror="this.style.display = 'none'" onload="this.style.display = 'block'">
                    </div>
                </label>
                <input type="file" name="product-image[]" id="product-picture-{{$i}}" class="product-image" accept=".jpg, .png, .jpeg">
            </div>
            @endfor

        </section>
    </div>

</section>

<!-- Model -->
<section class="data-area">
    <p class="section-title">{{ __('product.model-upload') }}</p>
    <!-- Main name -->
    <section class="primary-name">

        <!-- Model -->
        <div class="row">
            <div class="mb-3 col">
                <label class="form-label" for="name-input-0">{{ __('product.model') }}</label>
                <input list="datalistOptions" type="text" class="form-control" name="name-input-model[]" id="name-input-0" required>
                <datalist id="datalistOptions">
                    @foreach ($modelData as $model)
                    <option value="{{ $model->name }}">
                    @endforeach
                </datalist>
            </div>

            <!-- Model Serial -->
            <div class="mb-3 col">
                <label class="form-label" for="name-input-0">{{ __('product.model-serial') }}</label>
                <input type="text" class="form-control" name="name-input-model-serial[]" id="name-input-0" required>
            </div>

            <!-- Button -->
            <div class="mb-3 col">
                <button class="btn btn-primary" id="add-name-input" type="button">{{ __('product.add-name-input') }}</button>
            </div>
        </div>

    </section>

    <!-- Another name -->
    <section class="another-name">

        @for($i=1; $i<11; $i++)
        <!-- Box -->
        <div class="another-name-box row">
            <!-- Model -->
            <div class="mb-3 col-4">
                {{-- <label class="form-label" for="name-input-{{$i}}">{{ __('product.model') }}</label> --}}
                <input list="datalistOptions-{{$i}}" type="text" class="form-control" name="name-input-model[]" id="name-input-{{$i}}">
                <datalist id="datalistOptions-{{$i}}">
                    @foreach ($modelData as $model)
                    <option value="{{ $model->name }}">
                    @endforeach
                </datalist>
            </div>
    
            <!-- Model Serial -->
            <div class="mb-3 col-4">
                {{-- <label class="form-label" for="name-input-{{$i}}">{{ __('product.model-serial') }}</label> --}}
                <input type="text" class="form-control" name="name-input-model-serial[]" id="name-input-{{$i}}">
            </div>
        </div>
        @endfor

    </section>
</section>

<!-- Brand -->
<section class="data-area">
    <p class="section-title">{{ __('product.brand-upload') }}</p>

    <!-- Main brand -->
    <section class="primary-brand row">

        <!-- Brand Image -->
        <div class="mb-3 col-1">
            <label class="brand-image-label" for="brand-image-0">
                <div class="brand-preview">
                    <img class="brand-preview-image thumbnail" src="" alt="">
                </div>
            </label>
            <input type="file" name="brand-cover[]" id="brand-image-0" class="brand-image" accept=".jpg, .png, .jpeg" required>
        </div>

        <!-- Brand -->
        <div class="mb-3 col-3">
            <label class="form-label" for="brand-0">{{ __('product.brand') }}</label>
            <select class="form-control" name="brand-input-brand[]" id="brand-0" required>
                <option value="Default" disabled selected hidden></option>
                @foreach($brandData as $brand)
                    <option value="{{$brand->name}}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Brand Code -->
        <div class="mb-3 col-3">
            <label class="form-label" for="brand-code-0">{{ __('product.brand-code') }}</label>
            <input class="form-control" type="text" name="brand-input-brand-code[]" id="brand-code-0" required>
        </div>

        <!-- Frozen Code -->
        <div class="mb-3 col-3">
            <label class="form-label" for="frozen-code-0">{{ __('product.frozen-code') }}</label>
            <input class="form-control" type="text" name="brand-input-frozen-code[]" id="frozen-code-0">
        </div>

        <!-- Button -->
        <div class="mb-3 col-2">
            <button type="button" class="btn btn-primary" id="add-brand-input">
                <i class="fa-solid fa-add"></i>
                <p>{{ __('product.add-brand-input') }}</p>
            </button>
            
        </div>

    </section>

    <!-- Another brand -->
    <section class="another-brand">

        @for($i=1; $i<11; $i++)
        <!-- Box -->
        <div class="another-brand-box row">
            <!-- Brand Image -->
            <div class="mb-3 col-1">
                <label class="brand-image-label" for="brand-image-{{$i}}">
                    <div class="brand-preview">
                        <img class="brand-preview-image thumbnail" src="" alt="">
                    </div>
                </label>
                <input type="file" name="brand-cover[]" id="brand-image-{{$i}}" class="brand-image" accept=".jpg, .png, .jpeg" >
            </div>

            <!-- Brand -->
            <div class="mb-3 col-3">
                {{-- <label class="form-label" for="brand-{{ $i }}">{{ __('product.brand') }}</label> --}}
                <select class="form-control" name="brand-input-brand[]" id="brand-{{ $i }}">
                    @foreach($brandData as $brand)
                        <option value="{{$brand->name}}">{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Brand Code -->
            <div class="mb-3 col-3">
                {{-- <label class="form-label" for="brand-code-{{ $i }}">{{ __('product.brand-code') }}</label> --}}
                <input class="form-control" type="text" name="brand-input-brand-code[]" id="brand-code-{{ $i }}">
            </div>
    
            <!-- Frozen Code -->
            <div class="mb-3 col-3">
                {{-- <label class="form-label" for="frozen-code-{{ $i }}">{{ __('product.frozen-code') }}</label> --}}
                <input class="form-control" type="text" name="brand-input-frozen-code[]" id="frozen-code-{{ $i }}">
            </div>

            <!-- Delete Button -->
            <div class="mb-3 col-2">
                <button type="button" class="btn btn-danger" id="delete-brand-input">
                    <i class="fa-solid fa-trash"></i>
                    <p>{{ __('product.delete') }}</p>
                </button>
            </div>

        </div>
        @endfor

    </section>

</section>

<!-- Category & Type -->
<section class="data-area row flex-row">

    <!-- Category -->
    <section class="category col-6">
        {{-- <p class="section-title">{{ __('product.category-upload') }}</p> --}}
        <p class="form-label section-title" for="product-category">{{ __('product.category') }}</p>
        <div class="mb-3">
            <select class="form-control" name="product-category" id="" required>
                <option value="Default" disabled selected hidden>{!! __('product.plaese-select-category') !!}</option>
                @foreach($categoryData as $category)
                    <option value="{{$category->name}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </section>

    <!-- Type -->
    <section class="type col-6">
        {{-- <p class="section-title">{{ __('product.type-upload') }}</p> --}}
        <p class="form-label section-title" for="product-type">{{ __('product.type') }}</p>
        <div class="mb-3">
            <select class="form-control" name="product-type" id="" required>
                <option value="Default" disabled selected hidden>{!! __('product.plaese-select-type') !!}</option>
                @foreach($typeData as $type)
                    <option value="{{$type->name}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
    </section>

</section>

<button type="submit" class="btn btn-success">{{ __('product.submit') }}</button>