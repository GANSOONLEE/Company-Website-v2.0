
<div class="datalist">

    <table>
        <thead>

        </thead>
        <tbody>
            @foreach ($productData as $data)
            <tr data-product-code="{{ $data->product_code }}">
                <td>
                    <img src="{{ asset("storage/product/$data->product_category/$data->product_code/cover.jpg") }}" alt="">
                </td>
                <td data-search-column="name">{{ $data->getProductName()[0]->name }}</td>
                <td data-search-column="category">{{ $data->product_category }}</td>
                <td data-search-column="type">{{ $data->product_type }}</td>
                <td data-search-column="status">{{ $data->product_status }}</td>
            </tr>                
            @endforeach
        </tbody>
    </table>

</div>