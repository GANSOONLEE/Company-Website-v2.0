@extends('backend.admin.layouts.app')

@section('title', __('sidebar.edit-product'))

@section('main')

    <div id="alert"></div>

    @php
        $recordsPerPage = 25; // Display record per page
        $pageIndex = request('pageIndex', 1); // get PageIndex, default 1
        $startIndex = ($pageIndex - 1) * $recordsPerPage; // 计算起始索引
    @endphp

    <!-- Filter -->
    <section class="filter">
        @include('backend.admin.product.includes.filter')
    </section>

    <!-- Data List -->
    <section class="datalist">
        @include('backend.admin.product.includes.datalist')
    </section>

    <section id="pagination-footer" class="flex-row">
        @php
            $totalRecords = $productData->count(); // Total record
            $totalPages = ceil($totalRecords / $recordsPerPage); // Total page
            $displayPages = 12; // Page display
            $range = floor($displayPages / 2); // Range
            $start = max(1, $pageIndex - $range); // Start Page
            $end = min($totalPages, $start + $displayPages - 1); // End Page
        @endphp

        <!-- Page Selector -->
        <nav id="page-selector" aria-label="Page navigation">
            <ul class="pagination">

                <!-- Previous Button -->
                <li class="page-item {{ $pageIndex == 1 ? 'disabled' : '' }}"><a class="page-link" href="{{ url()->current() }}?pageIndex={{ $pageIndex - 1 }}">Previous</a></li>
    
                <!-- Previous ... -->
                @if($start > 1)
                    <li class="page-item"><a class="page-link" href="{{ url()->current() }}?pageIndex=1">1</a></li>
                    @if($start > 2)
                        <li class="page-item">
                            <a class="page-link" href="{{ url()->current() }}?pageIndex={{ $start-1 }}">...</a>
                        </li>
                    @endif
                @endif
    
                @for ($i = $start; $i <= $end; $i++)
                    <li class="page-item"><a class="page-link" href="{{ url()->current() }}?pageIndex={{ $i }}" class="page-link @if($i == $pageIndex) active @endif">{{ $i }}</a></li>
                @endfor
    
                <!-- Next ... -->
                @if($end < $totalPages)
                    @if($end < $totalPages - 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ url()->current() }}?pageIndex={{ $end+1 }}">...</a>
                        </li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ url()->current() }}?pageIndex={{ $totalPages }}">{{ $totalPages }}</a></li>
                @endif
    
                <!-- Next Button -->
                <li class="page-item {{ $pageIndex < $totalPages ? '' : 'disabled' }}"><a class="page-link" href="{{ url()->current() }}?pageIndex={{ $pageIndex + 1 }}">Next</a></li>
            </ul>
        </nav>
    
        <!-- Input TextBox -->
        <div class="page-input input-group">
            <input class="form-control" type="number" min="1" max="{{ $totalPages }}" v-model="pageIndex">
            <button id="gotoButton">Go</button>
        </div>
        
    </section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\edit-product.css') }}">
    <link rel="stylesheet" href="{{ asset('css\backend\admin\product\edit-product-form.css') }}">
@endpush

@push('after-script')
    <script defer src="{{ asset('js\backend\admin\product\edit-product.js') }}"></script>
@endpush