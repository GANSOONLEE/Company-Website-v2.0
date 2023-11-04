
{{-- 
    ┌────────────┐
    │    Main    │
    └────────────┘
    ┌─────┐┌─────┐
    │ Sub ││ Sub │
    └─────┘└─────┘
--}}


<!-- Card Section -->
<section class="custom-card">

    <div class="main-card">

        <div class="card-title">
            <h4 class="card-title-text">
                {{ __('dashboard.item-quantity', ["count"=> \App\Models\Product::all()->count() ]) }}
            </h4>
            <button type="button" id="refresh-button">
                {{ __('dashboard.refresh') }}
            </button>
        </div>
        
        <div class="card-body" id="pie-chart">
            <div class="section-title">
                <p class="section-title-text">
                    
                </p>
            </div>
            <div id="pie-chart">
            
            </div>
        </div>

    </div>

    <div class="sub-card-container">

        <div class="sub-card">
            <div class="card-title">
                <h3 class="card-title-text">
                    
                </h3>
            </div>
        </div>

        <div class="sub-card">
            <div class="card-title">
                <h3 class="card-title-text">
                    
                </h3>
            </div>
        </div>

    </div>

</section>
