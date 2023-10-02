
<div class="filter row">

    <!-- Name -->
    <div class="col">
        <label class="form-label" for="">{{ __('product.name') }}</label>
        <input data-select-filter="name" class="form-control" type="text " name="" id="" placeholder="{{ __('product.name') }}">
    </div>

    <!-- Category -->
    <div class="col">
        <label class="form-label" for="">{{ __('product.category') }}</label>
        <select data-select-filter="category" class="form-control" name="" id="" placeholder="{{ __('product.category') }}">
            <option value="All">All</option>
            @foreach ($categoryData as $data)
            <option value="{{ $data->name }}">{{ $data->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Type -->
    <div class="col">
        <label class="form-label" for="">{{ __('product.type') }}</label>
        <select data-select-filter="type" class="form-control" name="" id="" placeholder="{{ __('product.type') }}">
            <option value="All">All</option>
            @foreach ($typeData as $data)
            <option value="{{ $data->name }}">{{ $data->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Status -->
    <div class="col">
        <label class="form-label" for="">{{ __('product.status') }}</label>
        <select data-select-filter="status" class="form-control" name="" id="" placeholder="{{ __('product.status') }}">
            <option value="All">All</option>
            @foreach ($statusData as $data)
            <option value="{{ $data }}">{{ $data }}</option>
            @endforeach
        </select>
    </div>

</div>