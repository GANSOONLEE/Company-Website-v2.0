
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
            @foreach ($productData->slice($startIndex, $recordsPerPage) as $index => $data)
                <tr data-product-code="{{ $data->product_code }}">
                    
                    <td>
                        <a href="{{ route('frontend.product-detail', ["productCode" => $data->product_code]) }}">
                            <img src="{{ asset("storage/product/$data->product_category/$data->product_code/cover.png") }}" alt="">
                        </a>
                    </td>
                    <td data-search-column="name">{{ $data->first_name }}</td>
                    @if(auth()->user()->email == "yipjwen0229@gmail.com" || auth()->user()->email = "vincentgan0402@gmail.com")
                        <td data-search-column="brand">{{ $data->brand }}</td>
                    @endif
                    <td data-search-column="code" hidden>{{ $data->code }}</td>
                    <td data-search-column="category">{{ $data->product_category }}</td>
                    @if(auth()->user()->email == "yipjwen0229@gmail.com" || auth()->user()->email = "vincentgan0402@gmail.com")
                        @php
                            $data->updated_at = Carbon\Carbon::parse($data->updated_at)->addHours(8);
                        @endphp
                        <td data-search-column="type" class="{{ $data->updated_at > "2023-11-21 15:00:00"  ? 'new' : 'old'}}">{{ $data->updated_at }}</td>
                    @endif
                    <td data-search-column="edit">
                        <a target="_blank" href="{{ route('backend.admin.product.edit-product-more', ['productCode' => $data->product_code]) }}">
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