
<div id="promotionControls" class="carousel slide" data-bs-ride="carousel" style="">
    <div class="carousel-indicators">
        @foreach ($promotionImages as $index => $promotionImage)
        <promotion-controls-button :index="{{ $index }}"></promotion-controls-button>
        @endforeach
      </div>
    <div class="carousel-inner">
        @foreach ($promotionImages as $index => $promotionImage)
        <div class="carousel-item {{$index==0?'active':''}}">
            <img src="{{ asset('storage/'.$promotionImage) }}" class="d-block w-100" alt="">
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
