@extends('backend.admin.layouts.app')

@section('title', __('sidebar.user-management'))

@section('main')

    <section class="user-role">
        <p class="section-title">{{ __('account.user-role') }}</p>
        <table cellspacing="0.1">
            <thead>
                <tr>
                    <th>{{ __('account.user-name') }}</th>
                    <th>{{ __('account.user-email') }}</th>
                    <th>{{ __('account.role') }}</th>
                    <th>{{ __('account.action') }}</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $pageNumber = 1; // init Page Index
                    $recordsPerPage = 5; // Display record per page
                    $pageIndex = request('pageIndex', 1); // get PageIndex, default 1
                    $startIndex = ($pageIndex - 1) * $recordsPerPage; // 计算起始索引
                @endphp
                
                @foreach ($userData->slice($startIndex, $recordsPerPage)  as $index => $user)
                <tr class="user-row-data">
                    <tr class="user-row-data">
                        <td id="name" data-name="{{ $user->name }}" class="col-3">
                            {{ $user->name }}
                            @if ($user->name == auth()->user()->name)
                                {{ __('account.yourself')}}
                            @endif
                        </td>
                        <td id="email" class="col-2">{{ $user->email }}</td>
                        <td id="role" data-role="{{ $user->roles()->name }}" class="col-2">{{ __("account.roles." . $user->roles()->name)}}</td>
                        <td id="action" class="col">
                            @if(auth()->user()->roles()->weight > $user->roles()->weight)
                                <button class="btn btn-primary col edit-button" id="edit-button" type="button">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    {{ __('account.edit') }}
                                </button>

                                @if(auth()->user()->getRoleEntity()->hasPermission('admin_account_banned'))
                                <button class="btn btn-danger col banned-button" id="banned-button" type="button">
                                    <i class="fa-solid fa-ban"></i>
                                    {{ __('account.banned') }}
                                </button>
                                @endif
                            @else
                                
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Selector -->
    <section id="pagination-footer" class="flex-row">
        @php
            $totalRecords = $userData->count(); // Total record
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

    @include('backend.admin.account.user-management-form')

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\user-management.css') }}">
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\user-management-form.css') }}">
@endpush


@push('after-script')
    <script src="{{ asset('js\backend\admin\account\user-management.js') }}"></script>
@endpush