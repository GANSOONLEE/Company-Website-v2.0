
<div class="filter">

    <form action="{{ route('backend.admin.product.search-product') }}" method="get" class="row">

        <!-- Name -->
        <div class="col">
            <label class="form-label" for="">{{ __('product.name') }}</label>
            <input data-select-filter="name" class="form-control" type="text " name="text" id="" placeholder="{{ __('product.name') }}"
            value="{{ isset($text) ? $text : "" }}">
        </div>

        <!-- Code -->
        <div class="col">
            <label class="form-label" for="">{{ __('product.brand-code') }}</label>
            <input data-select-filter="code" class="form-control" type="text " name="code" id="" placeholder="{{ __('product.brand-code') }}"
            value="{{ isset($code) ? $code : "" }}">
        </div>

        <!-- Category -->
        <div class="col">
            <label class="form-label" for="">{{ __('product.category') }}</label>
            <select data-select-filter="category" class="form-control" name="category" id="" placeholder="{{ __('product.category') }}">
                <option value="">All</option>
                @foreach ($categoryData as $data)
                <option value="{{ $data->name }}" {{ isset($category) ? $data->name == $category ? "selected" : "" : "" }}>{{ $data->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col button">
            <button class="btn btn-primary" type="submit">
                {{ __('product.search') }}
            </button>
        </div>
    </form>
</div>