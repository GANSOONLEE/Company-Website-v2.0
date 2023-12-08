
<div class="panel">

    <!-- Product Cover -->
    <div class="product-image">
        <img src="{{ asset("storage/product/$product->product_category/$product->product_code/cover.jpg") }}" alt="" class="product-image-cover">
    </div>

    <!-- Product Information -->
    <div class="product-information">

        <!-- Basic Information -->
        <div class="basic-information">
            {{-- {{ $product->product_code }} --}}
        </div>

        <!-- Action Area -->
        <div class="action-area">

            <!-- Form -->
            <form action="" method="post" id="form" enctype="multipart/form-data">

                <!-- Product Cover 封面 -->
                <input id="cover-upload" type="file" accept="image/*">
                <div class="column">
                    <label for="cover-upload" class="form-label cover-upload">
                        <div class="upload-container">
                            <p>{{ __('product.upload') }}</p>
                        </div>
                    </label>
                </div>

                <!-- Product Category 類別 -->
                <div class="column">
                    <label for="product-category" class="form-label">{{ __('product.category') }}</label>
                    <select id="product-category" class="form-control" required>
                        @foreach ($categoryData as $data)
                        <option value="{{ $data->name }}" {{ $data->name==$product->product_category? 'selected' : '' }}>{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                

                <!-- Product Type 類型 -->
                <div class="column">
                    <label for="product-type" class="form-label">{{ __('product.type') }}</label>
                    <select id="product-type" class="form-control" required>
                        @foreach ($typeData as $data)
                        <option value="{{ $data->name }}" {{ $data->name==$product->product_type? 'selected' : '' }}>{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Product Status 狀態 -->
                <div class="column">
                    <label for="product-status" class="form-label">{{ __('product.status') }}</label>
                    <select id="product-status" class="form-control" required>
                        @foreach ($statusData as $data)
                        <option value="{{ $data }}" {{ $data==$product->product_status? 'selected' : '' }}>{{ $data }}</option>
                        @endforeach
                    </select>
                </div>

            </form>

            <!-- Edit More -->
            <div class="edit-more">
                <a href="{{ route('backend.admin.product.edit-more', ['productCode' => $product->product_code]) }}">
                    <button class="btn btn-success">
                        {{ __('product.edit-more') }}
                    </button>
                </a>
            </div>

        </div>

    </div>

</div>