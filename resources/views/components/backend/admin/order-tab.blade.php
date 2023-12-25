
@inject('orders', 'App\Domains\Order\Models\Order')

<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        @foreach($tabs as $tab)
        {{-- {{ dd($tab) }} --}}
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="{{ $tab->id }}" data-tabs-target="#{{ $tab->dataTabsTarget }}" type="button" role="tab" aria-controls="profile" aria-selected="false">@lang( $tab->name )</button>
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
    @foreach($tabs as $tab)
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="{{ $tab->dataTabsTarget }}" role="tabpanel" aria-labelledby="#{{ $tab->id }}">
            @foreach ($orders::byState($tab->dataTabsTarget)->paginate(10) as $order)
            
            @endforeach
        </div>
    @endforeach

    {{ $orders::byState($tab->name)->paginate(10)->links() }}
</div>
