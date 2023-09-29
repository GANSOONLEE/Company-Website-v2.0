<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') . " | Order Detail " .  $order->code }}</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- 導入應用文件 -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    
    <link rel="stylesheet" href="{{ asset('css\backend\user\order-detail.css') }}">
</head>
<body>

    <div class="breadcrumbs">
        {{ Breadcrumbs::render('orderDetail', $order) }}
    </div>

    <section class="order">

        <!-- header -->
        <div class="order-header">

            <div class="order-information">
                <div class="info">
                    <em>1</em>
                    <p class="key">Order ID: </p>
                    <p class="value">{{ $order->code }}</p>
                </div>
                <div class="info">
                    <p class="key">Item Count: </p>
                    <p class="value">{{ $order->getItemCount() }}</p>
                </div>
                <div class="info">
                    <p class="key">Created At: </p>
                    <p class="value">{{ $order->created_at }}</p>
                </div>
            </div>

        </div>

        <!-- content -->
        <div class="order-content">

            <!-- container -->
            <div class="order-container">

                <!-- item -->
                @foreach (($order->getOrderItems()) as $item)
                    @php
                        $brand = DB::table('products_brand')
                            ->where('sku_id', $item->sku_id)
                            ->first();

                        $product = DB::table('products')
                            ->where('product_code', $brand->product_code)
                            ->first();

                        $category = $product->product_category;
                    @endphp

                    <a href="{{ route('frontend.product-detail', ["productCode" => $item->product_code]) }}" class="order-item">
                        <div class="item-image">
                            <img src="{{ asset("storage/product/$category/$product->product_code/cover.jpg") }}" alt="">
                        </div>
                        <div class="item-information">
                            <p>{{ $category }}</p>
                            <p>{{ $brand->brand }}</p>
                            <p>{{ $brand->code }}</p>
                        </div>
                    </a>
                @endforeach

            </div>

        </div>

        <!-- footer -->
        <div class="order-footer">

        </div>

    </section>

</body>
</html>