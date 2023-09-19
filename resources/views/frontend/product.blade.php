
@extends('frontend.layouts.app')

@section('title', 'Product')

@section('app')


    <div class="content">

        <!-- #TODO 加入新内容 -->
        @foreach ($productData as $product)
            <p>{{ $product }}</p>
        @endforeach
    </div>

@endsection

@push('after-body')
    <script src="{{asset('js/frontend/includes/product.js')}}"></script>
@endpush