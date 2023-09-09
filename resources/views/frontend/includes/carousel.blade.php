
<div id="promotionControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($promotionImages as $index => $promotionImage)
        {{-- <button
            type="button"
            data-bs-target="#promotionControls"
            data-bs-slide-to="{{$index}}"
            class="{{$index==0?'active':''}}"
            aria-current="{{$index==0?'true':''}}"
            ia-label="Slide {{$index+1}}">
        </button> --}}
        <promotion-button :index="{{ $index }}"></promotion-button>
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
