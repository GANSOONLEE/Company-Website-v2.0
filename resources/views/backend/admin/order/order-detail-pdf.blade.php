<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>{{ env('APP_NAME') . ' | ' . $order->code }}</title>

    <style>
        @page{
            margin: 1cm;
            margin-top: 0;
        }
        body{
            text-align: left;
            width: 100%;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        div.order-information{
            margin-bottom: 1rem;
            width: 100%;
        }
        table{
            border: 1px solid black;
            border-collapse: collapse;
            border-spacing: 10px;
            width: 100%;
        }
        tr, th, td{
            padding: .2rem 1rem;
            border: 1px solid black;
            text-wrap: wrap;
            white-space: wrap;
        }
        div.sub{
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }
        .sub td, .sub p{
            padding: 0;
            width: 50%;
        }
        .left{
            padding: 0;
            text-align: left;
        }
        .right{
            padding: 0;
            text-align: right;
        }
        td{
            font-size: 1rem;
            margin-bottom: 0;
            margin-block-start: .4rem;
            margin-block-end: .4rem;
            text-wrap: nowrap;
        }
        p.customer-compony{
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: .6rem;
        }
        td.small{
            padding-top: .4rem;
            font-size: .8rem;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="order-information">
        
        <p class="customer-compony" style="text-align: center; width: 100vw">{{ $order->getUserInformation()->shop_name }}</p>
        <table class="ordere-information" style="border: none; border-spacing: 0">
            <tr class="sub" style="border: none; padding: 0; font-size: 2rem;">
                <td style="border: none" class="left">Phone (Whatsapp) : {{ $order->getUserInformation()->whatsapp_phone }}</td>
                <td style="border: none" class="right">Order ID: {{ $order->code }}</td>
            </tr>
            <tr class="sub" style="border: none; padding: 0;">
                <td style="border: none" class="left small">Created At : {{ $order->created_at->addHours(8) }}</td>
                <td style="border: none" class="right small">Printed At : {{ now()->addHours(8) }}</td>
            </tr>
        </div>

    </div>

    <table>

        <thead>
            <tr style="font-size: .8rem">
                <th>No.</th>
                <th>Category</th>
                {{-- <th>Type</th> --}}
                <th>Name</th>
                <th>Code</th>
                <th>Quantity</th>
            </tr>
        </thead>

        <tbody>
            @php
                $quantity = 0;
            @endphp
            @foreach ($order->getOrderItems() as $index => $item)
                @php
                    $quantity += $item->number;
                @endphp
                <tr style="font-size: .8rem">
                    <td>{{ $index+1 }}.</td>
                    <td>{{ $item->product_category }}</td>
                    {{-- <td>{{ $item->product_type }}</td> --}}
                    <td>{{ $item->name }}</td>
                    <td>{{ str_replace('_', '/', $item->code) }}</td>
                    <td>{{ $item->number }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <table style="border: none; margin-top: 1.2rem;">
        <tr class="sub" style="border: none;">
            <td class="total-item left" style="border: none;">Total Items: {{ $order->getItemCount() }}</td>
            <td class="quantity right" style="border: none;">Total Quantity: {{ $quantity }}</td>
        </tr>
    </table>

</body>
</html>