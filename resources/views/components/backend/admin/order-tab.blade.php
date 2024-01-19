@inject('orders', 'App\Domains\Order\Models\Order')

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
        data-tabs-toggle="#default-tab-content" role="tablist">
        @foreach ($tabs as $tab)
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-[2px] border-solid !border-transparent aria-selected:!border-b-blue-600" id="{{ $tab->id }}"
                    data-tabs-target="#{{ $tab->dataTabsTarget }}" type="button" role="tab"
                    aria-controls="{{ $tab->dataTabsTarget }}" aria-selected="false">@lang($tab->name)</button>
            </li>
        @endforeach
    </ul>
</div>
<div id="default-tab-content">
    @foreach ($tabs as $tab)
        <div class="hidden shadow md:shadow-none md:p-4 rounded-lg bg-gray-50 dark:bg-gray-800 overflow-x-auto" id="{{ $tab->dataTabsTarget }}" role="tabpanel" aria-labelledby="#{{ $tab->id }}">
            <table class="w-full">
                <thead>
                    <tr class=" bg-gray-300 text-bold dark:bg-gray-600">
                        <th class="sticky left-0 px-3 py-2 bg-inherit">@lang('Id')</th>
                        <th class="pl-3">@lang('order.shop_name')</th>
                        <th class="pl-3">@lang('order.order-item-count')</th>
                        <th class="pl-3">@lang('order.detail')</th>
                        <th class="pl-3">@lang('order.created-at')</th>
                        <th class="pl-3 pr-4">@lang('order.updated-at')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders::byState($tab->dataTabsTarget)->paginate(10)) > 0)
                    
                    @foreach ($orders::byState($tab->dataTabsTarget)->paginate(10) as $order)
    
                            <!-- Tootlip content -->
                            <div id="{{ $order->code }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium  transition-opacity duration-300 bg-light text-black rounded-lg shadow-sm opacity-0 tooltip dark:text-white dark:bg-gray-700">
                                {{ $order->user()->first()->whatsapp_phone }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>

                            <tr class="text-sm odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-700 dark:even:bg-gray-800 dark:hover:bg-gray-900">
                                <td class="sticky bg-inherit border-r-1 md:border-r-0 left-0 w-20 px-3 py-3">{{ $order->id }}</td>
                                <td class="pl-3 whitespace-nowrap">
                                    <p data-tooltip-target="{{ $order->code }}" class="w-min">
                                        {{ $order->user()->first()->shop_name }}</td>
                                    </p>
                                <td class="w-30 pl-3">{{ $order->detail()->count() }}</td>
                                <td class="w-30 pl-3">
                                    <a class="flex gap-x-4 hover:text-blue-600" href="{{ route('backend.admin.order.detail', ["id" => $order->id]) }}">
                                        <button><i class="fa-solid fa-search"></i></button>@lang('Detail')
                                    </a>
                                </td>
                                <td class="w-60 pl-3 nowrap">{{ $order->created_at }}</td>
                                <td class="w-60 pl-3 pr-4 nowrap">{{ $order->updated_at }}</td>
                            </tr>
                            
                        @endforeach
                    @else
                        <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-700 dark:even:bg-gray-800 dark:hover:bg-gray-900">
                            <td colspan="6" class="px-3 py-2 text-center text-bold">@lang('No Record')</td> 
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $orders::byState($tab->dataTabsTarget)->paginate(10)->links() }}

        </div>
    @endforeach
</div>
