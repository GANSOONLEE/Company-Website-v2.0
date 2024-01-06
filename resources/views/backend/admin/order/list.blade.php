@inject('orders', 'App\Domains\Order\Models\Order')

@extends('backend.layouts.app')

@section('title', __('order.history-order'))

@section('subtitle', __('order.history-order-description', ["days" => 45]))

@section('main')

    <table class="w-full">
        <thead>
            <tr class=" bg-gray-300 text-bold dark:bg-gray-600">
                <th class="px-3 py-2">ID</th>
                <th>Buyer</th>
                <th>Item</th>
                <th>Detail</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>

            @if ($orders->byHistory()->count() > 0)
            
            @foreach ($orders->byHistory()->paginate(15) as $order)

                    <!-- Tootlip content -->
                    <div id="{{ $order->code }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium  transition-opacity duration-300 bg-light text-black rounded-lg shadow-sm opacity-0 tooltip dark:text-white dark:bg-gray-700">
                        {{ $order->user()->first()->shop_name }}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <tr class="text-base odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-700 dark:even:bg-gray-800 dark:hover:bg-gray-900">
                        <td class="w-20 px-3 py-2">{{ $order->id }}</td>
                        <td class="whitespace-nowrap">
                            <p data-tooltip-target="{{ $order->code }}" class="w-min">
                                {{ $order->user()->first()->name }}</td>
                            </p>
                        <td class="w-30">{{ $order->detail()->count() }}</td>
                        <td class="w-30">
                            <a class="flex gap-x-4 hover:text-blue-600" href="{{ route('backend.admin.order.detail', ["id" => $order->id]) }}">
                                <button><i class="fa-solid fa-search"></i></button>@lang('Detail')
                            </a>
                        </td>
                        <td class="w-60 nowrap">{{ $order->created_at }}</td>
                    </tr>
                    
                @endforeach
            @else
                <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-700 dark:even:bg-gray-800 dark:hover:bg-gray-900">
                    <td colspan="5" class="px-3 py-2 text-center text-bold">No Record</td> 
                </tr>
            @endif
        </tbody>
    </table>

    {{ $orders->byHistory()->paginate(15)->links() }}

@endsection

@push('after-style')
    
@endpush

@push('after-script')
    
@endpush