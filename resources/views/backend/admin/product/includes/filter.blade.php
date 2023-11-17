
<div class="filter">

    <form action="{{ route('backend.admin.product.search') }}" method="get" class="row">

        <!-- Name -->
        <div class="col">
            <label class="form-label" for="">{{ __('product.name') }}</label>
            <input data-select-filter="name" class="form-control" type="text " name="text" id="" placeholder="{{ __('product.name') }}"
            value="{{ isset($text) ? $text : "" }}">
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

        <!-- Type -->
        <div class="col">
            <label class="form-label" for="">{{ __('product.type') }}</label>
            <select data-select-filter="type" class="form-control" name="type" id="" placeholder="{{ __('product.type') }}">
                <option value="">All</option>
                @foreach ($typeData as $data)
                <option value="{{ $data->name }}" {{ isset($type) ? $data->name == $type ? "selected" : "" : "" }}>{{ $data->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div class="col button">
            {{-- <label class="form-label" for="">{{ __('product.status') }}</label> --}}
            {{-- <select data-select-filter="status" class="form-control" name="" id="" placeholder="{{ __('product.status') }}">
                <option value="">All</option>
                @foreach ($statusData as $data)
                <option value="{{ $data }}">{{ $data }}</option>
                @endforeach
            </select> --}}
            <button class="btn btn-primary" type="submit">
                {{ __('product.search') }}
            </button>
        </div>
    </form>
</div>