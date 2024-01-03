
@if (isset($promotionImages))
    <div id="promotionControls" class="carousel slide sticky top-10 z-0" data-bs-ride="carousel" style="">
        <div class="carousel-indicators">
            @foreach ($promotionImages as $index => $promotionImage)
                <promotion-controls-button :index="{{ $index }}"></promotion-controls-button>
                <button
                    type="button"
                    data-bs-target="#promotionControls"
                    data-bs-interval="5"
                    data-bs-slide-to="{{ $index }}"
                    class="{{ $index === 0 ? 'active' : null}}"
                    aria-current="{{ $index  === 0 ? 'true' : null }}"
                    aria-label="Slide-{{ $index  + 1}}">
                ></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($promotionImages as $index => $promotionImage)
            <div class="carousel-item {{$index == 0?'active':''}}">
                <img src="{{ asset('storage/'.$promotionImage) }}" class="d-block w-full h-full object-cover" alt="">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#promotionControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#promotionControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endif
