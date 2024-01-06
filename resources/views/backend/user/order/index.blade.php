
@extends('backend.layouts.app')

@section('title', 'Order')

@section('subtitle', 'Your order history.')

@section('main')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        OrderID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->id }}
                        </th>
                        <td class="px-6 py-4">
                            
                            <div class="flex items-center gap-x-4">
                                @switch($order->status)
                                    @case('Pending')
                                        <span class="w-4 h-4 rounded-full bg-red-600 block"></span>
                                        @break
                                    @case('Accepted')
                                        <span class="w-4 h-4 rounded-full bg-orange-600 block"></span>
                                        @break
                                    @case('Process')
                                        <span class="w-4 h-4 rounded-full bg-yellow-600 block"></span>
                                        @break
                                    @case('Placed')
                                        <span class="w-4 h-4 rounded-full bg-green-600 block"></span>
                                        @break
                                    @case('Completed')
                                        <span class="w-4 h-4 rounded-full bg-blue-600 block"></span>
                                        @break
    
                                    @default
                                        @break
                                @endswitch
    
                                {{ $order->status }}
                            </div>

                        </td>
                        <td class="px-6 py-4">
                            {{ $order->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('backend.user.order.detail', ['id' => $order->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection