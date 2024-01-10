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

        body{
            font-family:  'Noto Sans SC', 'Noto Serif SC', 'Noto Sans TC', 'Noto Serif TC', 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
    </style>
</head>
<body>
    
    <!-- grid -->
    <div class="grid-template-rows: repeat(3, minmax(0, 1fr)); grid-auto-flow: row;">
        <p style="font-size: 1.4rem">Order: #{{ $order->id }}</p>
        <p style="">Create At: {{ $order->created_at }}</p>
        <p style=""></p>
    </div>
    
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