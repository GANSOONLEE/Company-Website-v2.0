<section class="tab">

    <p class="section-title">{{ __('order.status') }}</p>

    <section class="tab-bar">

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
            @foreach ($orderData as $order) 
                @if ($order->status == "Placed")
                    <a href="{{ route('backend.admin.order.order-detail',["orderID" => $order->code]) }}" class="order-link">
                        <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                        <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                        <p class="order-code">{{ $order->code }}</p>
                        <p class="item-count">{{ $order->getItemCount() }}</p>
                        <p class="create">{{ $order->created_at->addHours(8) }}</p>
                    </a>
                @endif    
            @endforeach

        </div>

        <div class="tab-content" id="order-accepted">
            @foreach ($orderData as $order)     
                @if ($order->status == "Accepted")
                    <a href="{{ route('backend.admin.order.order-detail',["orderID" => $order->code]) }}" class="order-link">
                        <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                        <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                        <p class="order-code">{{ $order->code }}</p>
                        <p class="item-count">{{ $order->getItemCount() }}</p>
                        <p class="create">{{ $order->created_at->addHours(8) }}</p>
                    </a>
                @endif
            @endforeach

        </div>

        <div class="tab-content" id="order-in-progress"> 
            @foreach ($orderData as $order)
                @if ($order->status == "In Progress")             
                    <a href="{{ route('backend.admin.order.order-detail',["orderID" => $order->code]) }}" class="order-link">
                        <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                        <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                        <p class="order-code">{{ $order->code }}</p>
                        <p class="item-count">{{ $order->getItemCount() }}</p>
                        <p class="create">{{ $order->created_at->addHours(8) }}</p>
                    </a>
                 @endif
            @endforeach

        </div>
        
        <div class="tab-content" id="order-on-hold">
            @foreach  ($orderData as $order)
                @if ($order->status == "On Hold")    
                    <a href="{{ route('backend.admin.order.order-detail',["orderID" => $order->code]) }}" class="order-link">
                        <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                        <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                        <p class="order-code">{{ $order->code }}</p>
                        <p class="item-count">{{ $order->getItemCount() }}</p>
                        <p class="create">{{ $order->created_at->addHours(8) }}</p>
                    </a>
                @endif
            @endforeach

        </div>

        <div class="tab-content" id="order-completed">
            @foreach ($orderData as $order)    
                @if ($order->status == "Completed")     
                    <a href="{{ route('backend.user.order-detail',["orderID" => $order->code]) }}" class="order-link">
                        <p class="user-company">{{ $order->getUserInformation()->shop_name }}</p>
                        <p class="user-phone">{{ $order->getUserInformation()->whatsapp_phone }}</p>
                        <p class="order-code">{{ $order->code }}</p>
                        <p class="item-count">{{ $order->getItemCount() }}</p>
                        <p class="create">{{ $order->created_at->addHours(8) }}</p>
                    </a>
                @endif
            @endforeach

        </div>

    </section>

</section>