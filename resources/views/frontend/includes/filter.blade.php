
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

        <div class="container type-container">
            @foreach ($typeData as $type)
            <label class="label" for="{{ $type->name }}">
                <input  type="radio" name="type" value="{{ $type->name }}" id="{{ $type->name }}">
                <div class="box type-box">
                    {{ $type->name }}
                </div>
            </label>
            @endforeach
        </div>

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

</section>