

<body style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
    
    <!-- grid -->
    <div class="grid-template-rows: repeat(3, minmax(0, 1fr)); grid-auto-flow: row;">
        <p style="font-size: 1.4rem">Order: #{{ $order->id }}</p>
        <p style="">Create At: {{ $order->created_at }}</p>
        <p style=""></p>
    </div>
    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: left; border: 1px solid black; padding: .2rem .3rem">No.</th>
                <th style="text-align: left; border: 1px solid black; padding: .2rem .3rem">Category</th>
                <th style="text-align: left; border: 1px solid black; padding: .2rem .3rem">Name</th>
                <th style="text-align: left; border: 1px solid black; padding: .2rem .3rem">Brand</th>
                <th style="text-align: left; border: 1px solid black; padding: .2rem .3rem">Qty.</th>
                <th style="text-align: left; border: 1px solid black; padding: .2rem .3rem">Remark</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailArray as $index => $detail)
                <tr style="font-size: .8rem">
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $detail->category }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem; white-space: normal;">{{ $detail->name }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $detail->sku_id }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $detail->number }}</td>
                    <td style="border: 1px solid black; padding: .2rem .3rem">{{ $detail->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>