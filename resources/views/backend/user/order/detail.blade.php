
@inject('brands', 'App\Domains\Brand\Models\Brand')
@inject('categories', 'App\Domains\Category\Models\Category')
@inject('products', 'App\Domains\Product\Models\Product')

@extends('backend.layouts.app')

@section('title', "Order #$order->id")

@section('subtitle', 'Order Details')

@section('main')

    <table class="w-full">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->detail()->get() as $index => $item)
                @php
                    $cateogry = $products->where('product_code',DB::table('products_brand')->where('code', $item->sku_id)->first()->product_code)->first()->product_category;
                @endphp
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $cateogry }}</td>
                    <td>{{ $item->sku_id }}</td>
                    <td>{{ $item->number }}</td>
                    <td>
                        <input class="border !border-gray-400 rounded-sm" type="text" name="remark[]">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection