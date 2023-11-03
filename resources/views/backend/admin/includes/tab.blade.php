<section class="tab">

    <p class="section-title">{{ __('order.status') }}</p>

    <section class="tab-bar flex-row">

        <a href="#" class="tab-link active" id="order-placed">{{ __('order.placed') }}</a>
        <a href="#" class="tab-link" id="order-accepted">{{ __('order.accepted') }}</a>
        <a href="#" class="tab-link" id="order-in-progress">{{ __('order.in-progress') }}</a>
        <a href="#" class="tab-link" id="order-on-hold">{{ __('order.on-hold') }}</a>
        <a href="#" class="tab-link" id="order-completed">{{ __('order.completed') }}</a>

    </section>

    <section class="tab-header">
        <p class="header-text">{{ __('order.user-company') }}</p>
        <p class="header-text">{{ __('order.user-phone(whatapps)') }}</p>
        <p class="header-text">{{ __('order.order-code') }}</p>
        <p class="header-text">{{ __('order.order-item-count') }}</p>
        <p class="header-text">{{ __('order.created-at') }}</p>
    </section>

    <section class="tab-container">

        <div class="tab-content" id="order-placed">

            @foreach (auth()->user()->getOrderWithStatus('Placed') as $order)     
                <a href="{{ route('backend.admin.order.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                    <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at->addHours(8) }}</p>
                </a>
            @endforeach

        </div>

        <div class="tab-content" id="order-accepted">
            
            @foreach (auth()->user()->getOrderWithStatus('Accepted') as $order)     
                <a href="{{ route('backend.admin.order.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                    <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at->addHours(8) }}</p>
                </a>
            @endforeach

        </div>

        <div class="tab-content" id="order-in-progress">

            @foreach (auth()->user()->getOrderWithStatus('In Progress') as $order)     
                <a href="{{ route('backend.admin.order.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                    <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at->addHours(8) }}</p>
                </a>
            @endforeach

        </div>
        
        <div class="tab-content" id="order-on-hold">

            @foreach (auth()->user()->getOrderWithStatus('On Hold') as $order)     
                <a href="{{ route('backend.admin.order.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                    <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at->addHours(8) }}</p>
                </a>
            @endforeach

        </div>

        <div class="tab-content" id="order-completed">

             @foreach (auth()->user()->getOrderWithStatus('Completed') as $order)     
                <a href="{{ route('backend.user.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at }}</p>
                </a>
            @endforeach

        </div>

    </section>

</section>