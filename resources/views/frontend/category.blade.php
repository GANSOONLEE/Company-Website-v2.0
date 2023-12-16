
@extends('frontend.layouts.app')

@section('title', ('Category'))

@section('app')

    <div class="content">

        <!-- #TODO 加入新内容 -->

        @foreach ($categoryData as $index => $category)
            <a class="category-box" href="{{ route('frontend.product.list', ['category' => $category['name']]) }}">
                <section class="category-card">
                    <img class="category-cover" src="{{ asset($category['cover'])}}" alt="">
                    <div class="category-description">
                        <p class="category-description-text">
                            {{ $category['name'] }}
                        </p>
                    </div>
                </section>
            </a>    
        @endforeach

    </div>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{asset('css/frontend/category.css')}}">
@endpush