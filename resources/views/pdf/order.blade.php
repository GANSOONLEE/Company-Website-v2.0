<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order #{{ $order->id }}</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+SC');
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+TC');
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+TC');
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+SC');

        @page { margin: 1rem; }

        body{
            margin: 5px;
            font-family:  'Noto Sans SC', 'Noto Serif SC', 'Noto Sans TC', 'Noto Serif TC', 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <p style="width: 100%; font-size: 1.6rem; font-weight: bold; color: black; text-align: center;">{{ config('app.name') }} Sdn. Bhd.</p>

    <!-- Watermark -->
    <img style="position: absolute; width: 16rem; height: auto; left: 50%; top: 1rem; transform:translateX(-50%); opacity: 0.1" src="{{ public_path('images/logo.webp') }}" alt="">

    <h1 style="font-size: 1.8rem; margin: 0; line-height: 0">Order: #{{ $order->id }}</h1>
    <h4 style="font-size: 1rem; margin-top: 0; font-weight: normal; color: gray">{{ $order->user()->first()->shop_name }}</h4>

    <table style="width: 100%">
        <tr>
            <td style="font-size: .8rem; width: 33%; text-align: left">Order Date: {{ $order->created_at }}</td>
            <td style="font-size: .8rem; width: 33%; text-align: center">Update At: {{ $order->updated_at }}</td>
            <td style="font-size: .8rem; width: 33%; text-align: right">Print At: {{ now() }}</td>
        </tr>
    </table>

    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                @foreach ($headers as $name)   
                    <td style="text-align: left; border: 1px solid black; padding: .2rem .3rem;">{{ $name }}</td>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $index => $item)
                <tr style="font-size: .8rem">
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $item->product_category }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem; white-space: normal;">{{ $item->name }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $item->code }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $item->number }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $item->detail_remarks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
</body>
</html>