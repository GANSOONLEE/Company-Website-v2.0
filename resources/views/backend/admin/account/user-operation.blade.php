@extends('backend.admin.layouts.app')

@section('title', __('sidebar.operation-record'))

@section('main')

    <div id="alert">

    </div>

    <div id="pagination">

        <!-- Filter -->
        <section id="pagination-header">

        </section>

        <!-- Body -->
        <section id="pagination-body">
            
            <!-- Column Title -->
            <section id="column-name">

                

            </section>

            <!-- Record -->
            <section id="record-list">

                @php
                    $pageNumber = 1; // init Page Index
                    $recordsPerPage = 10; // Display record per page
                    $pageIndex = request('pageIndex', 1); // get PageIndex, default 1
                    $startIndex = ($pageIndex - 1) * $recordsPerPage; // 计算起始索引
                @endphp

                <div class="column-title">

                    <!-- No. -->
                    <td>
                        <p class="title">{{ __('operation.number') }}</p>
                    </td>

                    <!-- Operator Email -->
                    <td>
                        <p class="title">{{ __('operation.operator-email') }}</p>
                    </td>

                    <!-- Operation -->
                    <td colspan="3">
                        <p class="title">{{ __('operation.operation') }}</p>
                    </td>

                    <td class="title">
                        <p class="title"></p>
                    </td>

                    <td>
                        <p class="title"></p>
                    </td>

                    <!-- Time -->
                    <td>
                        <p class="title">{{ __('operation.datetime') }}</p>
                    </td>

                </div>

                @foreach ($operations->slice($startIndex, $recordsPerPage) as $index => $operation)

                    <!-- Record Box -->
                    <div class="record-row" data-identify="{{ $operation->operation_category }}">

                        <!-- No. -->
                        <td class="record">
                            <p>{{ $index+1 }}</p>
                        </td>

                        <!-- Operator Email -->
                        <td class="record">
                            <p>{{ $operation->email }}</p>
                        </td>

                        <!-- Operation -->
                        <td class="record">
                            <p>{{ __('operation.type.' . $operation->operation_type) }}</p>
                            <p>{{ __('operation.category.' . $operation->operation_category) }}</p>
                            <p>{{ $operation->build() }}</p>
                        </td>

                        <!-- Time -->
                        <td class="record">
                            <p>{{ $operation->created_at->addHours(8) }}</p>
                        </td>
                    </div>

                @endforeach

            </section>

        </section>

        <!-- Selector -->
        <section id="pagination-footer" class="flex-row">
            @php
                $totalRecords = $operations->count(); // Total record
                $totalPages = ceil($totalRecords / $recordsPerPage); // Total page
                $displayPages = 5; // Page display
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

    </div>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\operation-record.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\account\operation-record.js') }}"></script>
@endpush