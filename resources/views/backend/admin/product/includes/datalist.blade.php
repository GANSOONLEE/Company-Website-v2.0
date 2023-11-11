
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

    <table>
        <thead>

        </thead>
        <tbody>
            @php
                $recordsPerPage = 10; // Display record per page
                $pageIndex = request('pageIndex', 1); // get PageIndex, default 1
                $startIndex = ($pageIndex - 1) * $recordsPerPage; // 计算起始索引
            @endphp

            {{-- @foreach ($productData->slice($startIndex, $recordsPerPage) as $index => $data) --}}
            @foreach ($productData as $data)

                <tr data-product-code="{{ $data->product_code }}">
                    
                    <td>
                        <img src="{{ asset("storage/product/$data->product_category/$data->product_code/cover.png") }}" alt="">
                    </td>
                    <td data-search-column="name">{{ $data->getProductName()[0]->name }}</td>
                    <td data-search-column="category">{{ $data->product_category }}</td>
                    <td data-search-column="type">{{ $data->product_type }}</td>
                    <td data-search-column="status">{{ $data->product_status }}</td>
                    <td data-search-column="edit">
                        <a href="{{ route('backend.admin.product.edit-product-more', ['productCode' => $data->product_code]) }}">
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-pen"></i>
                                {{ __('product.edit') }}
                            </button>
                        </a>
                    </td>
                    <td data-search-column="delete">
                        <a button-event="delete" style="display: none" href="{{ route('backend.admin.product.delete', ['product_code' => $data->product_code]) }}">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fa-solid fa-trash"></i>
                                {{ __('product.delete') }}
                            </button>
                        </a>
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>

</div>