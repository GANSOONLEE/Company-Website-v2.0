@extends('backend.admin.layouts.app')

@section('title', __('sidebar.banned-account'))

<style>
    /* .app{
        background-color: #222 !important;
        min-height: 100vh;
        color: #eee !important;
    } */
</style>

@section('main')

    <section class="panel-section">
        <div class="panel" id="Unavaiable">
            <div class="panel-title">
                <p class="panel-title-text">{{ __('account.unavaiable-account') }}</p>
            </div>

            @if (count($unavailable) > 0)
                <div class="panel-content">
                    @foreach ($unavailable as $user)
                    <div class="unavailable-account">
                        {{ $user->name }}
                    </div>
                    @endforeach
                </div>
                @else
                    <div class="panel-content not-data">

                    </div>
                @endif
        </div>

        <div class="panel" id="Avaiable">
            <div class="panel-title">
                <p class="panel-title-text">{{ __('account.avaiable-account') }}</p>
            </div>

            @if (count($available) > 0)
                <div class="panel-content">
                    @foreach ($available as $user)
                    <div class="unavailable-account">
                        {{ $user->name }}
                    </div>
                    @endforeach
                </div>
            @else
                <div class="panel-content not-data">

                </div>
            @endif
            
        </div>

        <div class="panel" id="Banned">
            <div class="panel-title">
                <p class="panel-title-text">{{ __('account.banned-account') }}</p>
            </div>

            @if (count($banned) > 0)
                <div class="panel-content">
                    @foreach ($banned as $user)
                        <div class="unavailable-account">
                            {{ $user->name }}
                        </div>
                    @endforeach
                </div>
            @else
                <div class="panel-content not-data">

                </div>
            @endif
        </div>
    </section>

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('css\backend\admin\account\banned-account.css') }}">
@endpush

@push('after-script')
    <script src="{{ asset('js\backend\admin\account\banned-account.js') }}"></script>
@endpush
