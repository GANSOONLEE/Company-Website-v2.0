
<!-- Image -->
<section class="data-area">

    <!-- Cover -->
    <div class="product-cover">
        <label for="product-cover">
            <div class="cover-preview">
                <img class="cover-preview-image" src="" alt="">
            </div>
        </label>
        <input type="file" name="product-cover" class="product-cover" accept=".jpg, .png, .jpeg" required>
    </div>

    <!-- Another picture -->
    <section class="product-images">

        <!-- Image -->
        @for($i=0; $i<10; $i++)
        <div class="product-image">
            <label for="product-cover">
                <div class="cover-preview">
                    <img class="cover-preview-image" src="" alt="">
                </div>
            </label>
            <input type="file" name="product-image[]-{{$i}}" class="product-image" accept=".jpg, .png, .jpeg">
        </div>
        @endfor

    </section>

</section>

<!-- Model -->
<section class="data-area">

    <!-- Main name -->
    <section class="primary-name">

        <!-- Model -->
        <div class="mb-3">
            <label class="form-label" for="name-input-0">{{ __('product.model') }}</label>
            <input type="text" name="name-input[]" id="name-input-0">
        </div>

        <!-- Model Serial -->
        <div class="mb-3">
            <label class="form-label" for="name-input-0">{{ __('product.model-serial') }}</label>
            <input type="text" name="name-input[]" id="name-input-0">
        </div>

        <!-- Button -->
        <div class="mb-3">
            <button type="button">{{ __('product.add-name-input') }}</button>
        </div>

    </section>

    <!-- Another name -->
    <section class="another-name">

        @for($i=1; $i<11; $i++)
        <!-- Box -->
        <div class="another-name-box">
            <!-- Model -->
            <div class="mb-3">
                <label class="form-label" for="name-input-{{$i}}">{{ __('product.model') }}</label>
                <input type="text" name="name-input[]" id="name-input-{{$i}}">
            </div>
    
            <!-- Model Serial -->
            {{-- <div class="mb-3">
                <label class="form-label" for="name-input-{{$i}}">{{ __('product.model-serial') }}</label>
                <input type="text" name="name-input[]" id="name-input-{{$i}}">
            </div> --}}
        </div>
        @endfor

    </section>

</section>

<!-- Brand -->
<section class="data-area">
    <p class="section-title"></p>

    <!-- Main brand -->
    <section class="primary-brand">

        <!-- Brand Image -->
        <div class="mb-3">
            <div class="brand-preview">
                <img class="brand-preview-image" src="" alt="">
            </div>
        </div>

        <!-- Brand -->
        <div class="mb-3">
            <label class="form-label" for="brand-{{ $i }}">{{ __('product.brand') }}</label>
            <select name="brand-input-brand-[]" id="brand-{{ $i }}">
                @foreach($brandData as $brand)
                    <option value="{{$brand->name}}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Brand Code -->
        <div class="mb-3">
            <label class="form-label" for="brand-code-{{ $i }}">{{ __('product.brand-code') }}</label>
            <input type="text" name="brand-input-brand-code[]" id="brand-code-{{ $i }}">
        </div>

        <!-- Frozen Code -->
        <div class="mb-3">
            <label class="form-label" for="frozen-code-{{ $i }}">{{ __('product.frozen-code') }}</label>
            <input type="text" name="brand-input-frozen-code[]" id="frozen-code-{{ $i }}">
        </div>

        <!-- Button -->
        <div class="mb-3">
            <button type="button">{{ __('product.add-brand-input') }}</button>
        </div>

    </section>

    <!-- Another brand -->
    <section class="another-brand">

        @for($i=1; $i<11; $i++)
        <!-- Box -->
        <div class="another-brand-box">
            <!-- Brand Image -->
            <div class="mb-3">
                <div class="brand-preview">
                    <img class="brand-preview-image" src="" alt="">
                </div>
            </div>

            <!-- Brand -->
            <div class="mb-3">
                <label class="form-label" for="brand-{{ $i }}">{{ __('product.brand') }}</label>
                <select name="brand-input-brand-[]" id="brand-{{ $i }}">
                    @foreach($brandData as $brand)
                        <option value="{{$brand->name}}">{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Brand Code -->
            <div class="mb-3">
                <label class="form-label" for="brand-code-{{ $i }}">{{ __('product.brand-code') }}</label>
                <input type="text" name="brand-input-brand-code[]" id="brand-code-{{ $i }}">
            </div>
    
            <!-- Frozen Code -->
            <div class="mb-3">
                <label class="form-label" for="frozen-code-{{ $i }}">{{ __('product.frozen-code') }}</label>
                <input type="text" name="brand-input-frozen-code[]" id="frozen-code-{{ $i }}">
            </div>

        </div>
        @endfor

    </section>

</section>

<!-- Category & Type -->
<section class="data-area">

    <!-- Category -->
    <section class="category">
        <p class="section-title"></p>
        <div class="mb-3">
            <label class="form-label" for="product-category">{{ __('product.category') }}</label>
            <select name="" id="">
                @foreach($categoryData as $category)
                    <option value="{{$category->name}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </section>

    <!-- Type -->
    <section class="type">
        <p class="section-title"></p>
        <div class="mb-3">
            <label class="form-label" for="product-type">{{ __('product.type') }}</label>
            <select name="" id="">
                @foreach($typeData as $type)
                    <option value="{{$type->name}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
    </section>

</section>