
<section class="filter">
    <div class="filter-title">
        <i class="fa-solid fa-filter"></i>
        <p>FILTER</p>
    </div>

    <form action="{{ route('frontend.product.search.post', ['productCategory' => $category]) }}" method="GET">
        {{-- @csrf --}}

        <!-- Search Field -->
        {{-- <div class="container search-container">
            <label for="search-bar">
                <i class="fa-solid fa-search"></i>
            </label>
            <input class="form-search" type="search" placeholder="Search" name="search" id="search-bar">
        </div> --}}
{{-- 
        <div class="container type-container">
            @foreach ($typeData as $type)
            <label class="label" for="{{ $type->name }}">
                <input  type="radio" name="type" value="{{ $type->name }}" id="{{ $type->name }}">
                <div class="box type-box">
                    {{ $type->name }}
                </div>
            </label>
            @endforeach
        </div> --}}

        <div class="container model-container">
            @foreach ($modelData as $model)
            <label class="label" for="{{ $model->name }}">
                <input  type="radio" name="model" value="{{ $model->name }}" id="{{ $model->name }}">
                <div class="box model-box">
                    {{ $model->name }}
                </div>
            </label>
            @endforeach
        </div>

        <div class="button">
            <button class="btn btn-primary" type="submit">{{ __('Search or Reset') }}</button>
        </div>

    </form>

    <form class="top-side" action="{{ route('frontend.product.search.post', ['productCategory' => $category]) }}" method="GET">
        {{-- @csrf --}}

        <!-- Search Field -->
        {{-- <div class="container search-container">
            <label for="search-bar">
                <i class="fa-solid fa-search"></i>
            </label>
            <input class="form-search" type="search" placeholder="Search" name="search" id="search-bar">
        </div> --}}

        <div class="container type-container">
            {{-- <select name="type" id="">
                <option name="type" value="" id="" hidden readonly></option>
                @foreach ($typeData as $type)
                    <option name="type" value="{{ $type->name }}" id="{{ $type->name }}">{{ $type->name }}</option>
                @endforeach
            </select> --}}
            {{-- @foreach ($typeData as $type)
            <label class="label" for="{{ $type->name }}">
                <input  type="radio" name="type" value="{{ $type->name }}" id="{{ $type->name }}">
                <div class="box type-box">
                    {{ $type->name }}
                </div>
            </label>
            @endforeach --}}
        </div>

        <div class="container model-container">
            <select name="model" id="">
                <option name="model" value="" id="" hidden readonly></option>
                @foreach ($modelData as $model)
                    <option name="model" value="{{ $model->name }}" id="{{ $model->name }}">{{ $model->name }}</option>
                @endforeach
            </select>
            {{-- @foreach ($modelData as $model)
            <label class="label" for="{{ $model->name }}">
                <input  type="radio" name="model" value="{{ $model->name }}" id="{{ $model->name }}">
                <div class="box model-box">
                    {{ $model->name }}
                </div>
            </label>
            @endforeach --}}
        </div>

        <div class="button">
            <button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
        </div>

    </form>

</section>