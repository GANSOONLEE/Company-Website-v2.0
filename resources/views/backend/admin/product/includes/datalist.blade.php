
<div class="datalist">

    <div id="model">
        
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ env('APP_NAME') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! __('product.delete-confirm-product') !!}
                </div>
                <div class="modal-footer" style="justify-content: space-between">
                    <button type="button" class="btn btn-danger" id="deleteButtonConfirm">{{ __('product.delete') }}</button>
                    <button type="button" class="btn btn-primary focus" data-bs-dismiss="modal">{{ __('product.cancel') }}</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <section class="view-slider-container">
        <div class="view-slider">
            <div>
                <input type="radio" name="view" id="image" value="image">
                <label for="image">
                    <i class="fa-regular fa-image"></i>
                </label>
            </div>
    
            <div>
                <input type="radio" name="view" id="list" value="list">
                <label for="list">
                    <i class="fa-solid fa-list"></i>
                </label>
            </div>
        </div>
        <div class="sort-by">
            <div>
                <input type="radio" name="sort" id="car" value="car">
                <label for="car">
                    <i class="fa-solid fa-car"></i>
                </label>
            </div>

            <div>
                <input type="radio" name="sort" id="asc" value="asc">
                <label for="asc">
                    <i class="fa-solid fa-arrow-down-wide-short"></i>
                </label>
            </div>
    
            <div>
                <input type="radio" name="sort" id="desc" value="desc">
                <label for="desc">
                    <i class="fa-solid fa-arrow-up-wide-short"></i>
                </label>
            </div>
        </div>
    </section>

    <table>
        <thead>

        </thead>
        <tbody>
            @php
                $sortBy = request('sortBy', 'car'); // get sortBy
                if ($sortBy == "car") {
                    $productData = $productData;
                }else if ($sortBy == "asc") {
                    $productData = $productData->sortBy('updated_at');
                }else{
                    $productData = $productData->sortByDesc('updated_at');
                }
            @endphp

            @foreach ($productData->slice($startIndex, $recordsPerPage) as $index => $data)
                <tr data-product-code="{{ $data->product_code }}">
                    
                    <td>
                        <a href="{{ route('frontend.product-detail', ["productCode" => $data->product_code]) }}">
                            <img class="product-cover" src="{{ asset("storage/product/$data->product_category/$data->product_code/cover.png") }}" alt="">
                        </a>
                    </td>
                    <td data-search-column="name">{{ $data->first_name }}</td>
                    <td data-search-column="brand">{{ $data->brand }}</td>
                    <td data-search-column="code" hidden>{{ $data->code }}</td>
                    <td data-search-column="category">{{ $data->product_category }}</td>
                    @php
                        $data->updated_at = Carbon\Carbon::parse($data->updated_at)->addHours(8);
                    @endphp
                    <td data-search-column="type" class="{{ $data->updated_at > "2023-11-21 15:00:00"  ? 'new' : 'old'}}">{{ $data->updated_at }}</td>
                    <td data-search-column="edit">
                        <a target="_blank" href="{{ route('backend.admin.product.edit-product-more', ['productCode' => $data->product_code]) }}">
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-pen"></i>
                                {{ __('product.edit') }}
                            </button>
                        </a>
                    </td>
                    <td data-search-column="delete">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-url="{{ route('backend.admin.product.delete', ['product_code' => $data->product_code]) }}">
                            <a button-event="delete">
                                <i class="fa-solid fa-trash"></i>
                                {{ __('product.delete') }}
                            </a>
                        </button>
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>

</div>