@inject('orders', 'App\Domains\Order\Models\Order')

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
        data-tabs-toggle="#default-tab-content" role="tablist">
        @foreach ($tabs as $tab)
            {{-- {{ dd($tab) }} --}}
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-[2px] border-solid !border-transparent aria-selected:!border-b-blue-600" id="{{ $tab->id }}"
                    data-tabs-target="#{{ $tab->dataTabsTarget }}" type="button" role="tab"
                    aria-controls="{{ $tab->dataTabsTarget }}" aria-selected="false">@lang($tab->name)</button>
            </li>
        @endforeach
        {{-- <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
        </li>
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Contacts</button>
        </li> --}}
    </ul>
</div>
<div id="default-tab-content">
    @foreach ($tabs as $tab)
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="{{ $tab->dataTabsTarget }}" role="tabpanel" aria-labelledby="#{{ $tab->id }}">
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

                    @if (count($orders::byState($tab->dataTabsTarget)->paginate(10)) > 0)
                    
                    @foreach ($orders::byState($tab->dataTabsTarget)->paginate(10) as $order)
    
                            <!-- Tootlip content -->
                            <div id="{{ $order->code }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium  transition-opacity duration-300 bg-light text-black rounded-lg shadow-sm opacity-0 tooltip dark:text-white dark:bg-gray-700">
                                {{ $order->user()->first()->shop_name }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>

                            <tr class="odd:bg-gray-100 even:bg-gray-200 hover:bg-gray-300 dark:odd:bg-gray-700 dark:even:bg-gray-800 dark:hover:bg-gray-900">
                                <td class="w-20 px-3 py-2">{{ $order->id }}</td>
                                <td>
                                    <p data-tooltip-target="{{ $order->code }}" class="w-min">
                                        {{ $order->user()->first()->name }}</td>
                                    </p>
                                <td class="w-30">{{ $order->detail()->count() }}</td>
                                <td class="w-30">
                                    <a href="{{ route('backend.admin.order.detail', ["id" => $order->id]) }}">
                                        <button><i class="fa-solid fa-search"></i></button>
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
            {{ $orders::byState($tab->dataTabsTarget)->paginate(10)->links() }}
        </div>
    @endforeach
</div>
