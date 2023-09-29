<section class="tab">

    <p class="section-title">Status</p>

    <section class="tab-bar flex-row">

        <a href="#" class="tab-link active" id="order-placed">Placed</a>
        <a href="#" class="tab-link" id="order-accepted">Accepted</a>
        <a href="#" class="tab-link" id="order-in-progress">in Progress</a>
        <a href="#" class="tab-link" id="order-on-hold">On Hold</a>
        <a href="#" class="tab-link" id="order-completed">Completed</a>

    </section>

    <section class="tab-header">
        <p class="header-text">Order Code</p>
        <p class="header-text">Order Item Count</p>
        <p class="header-text">Created At</p>
    </section>

    <section class="tab-container">

        <div class="tab-content" id="order-placed">

            @foreach (auth()->user()->getOrderWithStatus('placed') as $order)     
                <a href="{{ route('backend.user.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at }}</p>
                </a>
            @endforeach

        </div>

        <div class="tab-content" id="order-accepted">
            
            @foreach (auth()->user()->getOrderWithStatus('accepted') as $order)     
                <a href="{{ route('backend.user.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at }}</p>
                </a>
            @endforeach

        </div>

        <div class="tab-content" id="order-in-progress">

            @foreach (auth()->user()->getOrderWithStatus('in-progress') as $order)     
                <a href="{{ route('backend.user.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at }}</p>
                </a>
            @endforeach

        </div>
        
        <div class="tab-content" id="order-on-hold">

             @foreach (auth()->user()->getOrderWithStatus('on-hold') as $order)     
                <a href="{{ route('backend.user.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at }}</p>
                </a>
            @endforeach

        </div>

        <div class="tab-content" id="order-completed">

             @foreach (auth()->user()->getOrderWithStatus('completed') as $order)     
                <a href="{{ route('backend.user.order-detail',["orderID" => $order->code]) }}" class="order-link">
                    <p class="order-code">{{ $order->code }}</p>
                    <p class="item-count">{{ $order->getItemCount() }}</p>
                    <p class="create">{{ $order->created_at }}</p>
                </a>
            @endforeach

        </div>

    </section>

</section>