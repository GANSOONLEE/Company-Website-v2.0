@extends('backend.user.layouts.app')

@section('title', 'Cart')

@section('main')

<div id="alert">
    <bootstrap-alert></bootstrap-alert>
</div>

<section class="cart">

    <!-- filter -->
    <section class="filter flex-column">
        
        <p class="filter-title">Filter</p>
        
        <form action="{{ route('backend.user.cart.search-cart') }}" method="get">
    
            <div class="filter-container flex-row">
                <div class="filter name-filter flex-column">
        
                    <label class="form-label" for="">Name</label>
                    <input type="text" class="form-control" data-select-filter="name" name="name" id="" value="{{ isset($name) ? $name : "" }}">
        
                </div>
                <div class="filter category-filter flex-column">
        
                    <label class="form-label" for="">Category</label>
                    <select class="form-select" data-select-filter="category" name="category" id="">
                        <option value=""> -- Clear Filter -- </option>
                        @foreach ($categoryData as $data)
                            <option value="{{ $data->name }}" {{ isset($category) ? $data->name == $category ? "selected" : "" : "" }}>{{ $data->name }}</option>
                        @endforeach
                    </select>
        
                </div>

                <div class="filter category-filter flex-column">
                    <label class="form-label" for="" aira-label="search">Search</label>
                    <button class="form-control btn btn-success" type="submit" style="justify-self: flex-end">Search</button>
                </div>
            </div>

        </form>

    </section>

    <!-- cart list -->
    <section class="cart-list">

        <div class="cart-list-header flex-row">
            <div class="button-area flex-row">
                <a class="btn btn-success" href="" id="refresh">
                    <i class="fa-solid fa-refresh"></i>
                    <button>Refresh</button>
                </a>
    
                <a class="btn btn-primary" href="{{ route('frontend.product.list') }}">
                    <i class="fa-solid fa-shopping-cart"></i>
                    <button>Goto Shop</button>
                </a>
            </div>

            <div class="button-area flex-row">
                <a class="btn" id="create-order">
                    <i class="fa-solid fa-add"></i>
                    <button>Create Order</button>
                </a>
            </div>
        </div>

        <div class="cart-list-body">

            @php
                $pageNumber = 1; // init Page Index
                $recordsPerPage = 8; // Display record per page
                $pageIndex = request('pageIndex', 1); // get PageIndex, default 1
                $startIndex = ($pageIndex - 1) * $recordsPerPage; // 计算起始索引
            @endphp

            <table data-select-table="table">
                <thead>
                    <tr>
                        {{-- <th>SKU ID</th> --}}
                        <th></th>
                        <th>Image</th>
                        <th>Product Name</th>
                        {{-- <th>Product Code</th> --}}
                        <th>Category</th>
                        <th>Product Type</th>
                        <th>Brand Code</th>
                        <th>Number</th>
                    </tr>
                </thead>
                <tbody style="max-height: 70vh;">

                    <!-- Cart -->
                    @foreach ($cartData->slice($startIndex, $recordsPerPage) as $index => $cart)
                    @php
                        if($cart instanceof \ App\Domains\Cart\Models\Cart){

                            $name = $cart->getProductInformationEntity()->getProductName()[0]->name;
                            $product_code = $cart->getProductInformation('product_code');
                            $category = $cart->getProductInformation('product_category');
                            $brand = $cart->getBrandInformation('brand');
                            $sku_id = $cart->getBrandInformation('sku_id');
                            $code = $cart->getBrandInformation('code');
                            $number = $cart->number;
                            
                        }else{
                            $name = $cart->first_name;
                            $product_code = $cart->product_code;
                            $category = $cart->product_category;
                            $brand = $cart->brand;
                            $sku_id = $cart->sku_id;
                            $code = $cart->code;
                            $number = $cart->number;
                        }
                    @endphp
                    <tr>
                        {{-- <td>{{ $cart->sku_id }}</td> --}}
                        <td>
                            <input data-sku-id="{{ $sku_id }}" data-number="{{ $number }}" type="checkbox" name="" id="">
                        </td>
                        <td>
                            <a target="_product" href="{{ route('frontend.product.detail', ["productCode"=>$product_code]) }}">
                                @if (file_exists(public_path("storage/product/$category/$product_code/$code/cover.png")))
                                <img src="{{ asset("storage/product/$category/$product_code/$code/cover.png") }}" alt="">
                                @else
                                <img src="{{ asset("storage/product/$category/$product_code/$code/cover.jpg") }}" alt="">
                                @endif
                            </a>
                        </td>
                        <td data-search-column="name">{{ $name }}</td>
                        <td data-search-column="sku-id" class="sku-id" style="display: none" id="{{ $sku_id }}">{{ $sku_id }}</td>
                        {{-- <td data-search-column="product_code">{{ $product_code }}</td> --}}
                        <td data-search-column="category">{{ $category }}</td>
                        {{-- <td data-search-column="type">{{ $type }}</td>  --}}
                        <td data-search-column="code">{{ $code }}</td>
                        <td data-search-column="number">
                            <div class="editable popovers-edit">
                                <div class="number flex-row">
                                    <p>{{ $number }}</p>
                                    <i class="fa-solid fa-pen"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- Pagination -->
            <section id="pagination-footer" class="flex-row">

                @php
                    $totalRecords = count($cartData); // Total record
                    $totalPages = ceil($totalRecords / $recordsPerPage); // Total page
                    $displayPages = 5; // Page display
                    $range = floor($displayPages / 2); // Range
                    $start = max(1, $pageIndex - $range); // Start Page
                    $end = min($totalPages, $start + $displayPages - 1); // End Page

                    if (!function_exists('updateUrlParameter')) {
                        function updateUrlParameter($url, $key, $value)
                        {
                            $parsedUrl = parse_url($url);
                            parse_str($parsedUrl['query'] ?? '', $query);

                            // 更新或添加指定参数
                            $query[$key] = $value;

                            $parsedUrl['query'] = http_build_query($query);

                            return buildUrl($parsedUrl);
                        }
                    }

                    if (!function_exists('buildUrl')) {
                        function buildUrl($parsedUrl)
                        {
                            return $parsedUrl["path"] . '?' . $parsedUrl["query"];
                        }
                    }
                @endphp
        
                <!-- Page Selector -->
                <nav id="page-selector" aria-label="Page navigation">
                    <ul class="pagination">
        
                        <!-- Previous Button -->
                        <li class="page-item {{ $pageIndex == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ updateUrlParameter(url()->full(), 'pageIndex', $pageIndex - 1) }}">Previous</a>
                        </li>
                        
                        <!-- Previous ... -->
                        @if($start > 1)
                            <li class="page-item"><a class="page-link" href="{{ updateUrlParameter(url()->full(), 'pageIndex', 1) }}">1</a></li>
                            @if($start > 2)
                                <li class="page-item">
                                    <a class="page-link" href="{{ updateUrlParameter(url()->full(), 'pageIndex', $start - 1) }}">...</a>
                                </li>
                            @endif
                        @endif
                        
                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item">
                                <a class="page-link {{$pageIndex == $i? 'selected' : '' }}" href="{{ updateUrlParameter(url()->full(), 'pageIndex', $i) }}" class="page-link @if($i == $pageIndex) active @endif">{{ $i }}</a>
                            </li>
                        @endfor
                        
                        <!-- Next ... -->
                        @if($end < $totalPages)
                            @if($end < $totalPages - 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ updateUrlParameter(url()->full(), 'pageIndex', $end + 1) }}">...</a>
                                </li>
                            @endif
                            <li class="page-item"><a class="page-link" href="{{ updateUrlParameter(url()->full(), 'pageIndex', $totalPages) }}">{{ $totalPages }}</a></li>
                        @endif
                        
                        <!-- Next Button -->
                        <li class="page-item {{ $pageIndex < $totalPages ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ updateUrlParameter(url()->full(), 'pageIndex', $pageIndex + 1) }}">Next</a>
                        </li>
                        
                    </ul>
                </nav>
                
            </section>

        </div>

    </section>

</section>

<div class="popovers">

    <form>
        @csrf
        <div class="popovers-header">
            <p class="popovers-title">Edit number</p>
        </div>
        
        <div class="popovers-content">
            <input type="text" id="brand_code" style="display: none">
            <textarea name="number" id="number" cols="10" rows="2"></textarea>
        </div>
        
        <div class="popovers-footer">
            <button class="btn btn-primary" type="button" id="popover-update">Update</button>
        </div>

    </form>

</div>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\user\cart.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\user\cart.js') }}"></script>
@endpush