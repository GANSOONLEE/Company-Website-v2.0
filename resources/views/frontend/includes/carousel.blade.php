
@if (isset($promotionImages))
    <div id="promotionControls" class="carousel slide sticky top-10 z-0" data-bs-ride="carousel" style="">
        <div class="carousel-indicators">
            @foreach ($promotionImages as $index => $promotionImage)
                <button
                    type="button"
                    data-bs-target="#promotionControls"
                    data-bs-interval="5"
                    data-bs-slide-to="{{ $index }}"
                    class="{{ $index === 0 ? 'active' : null}}"
                    aria-current="{{ $index  === 0 ? 'true' : null }}"
                    aria-label="Slide-{{ $index  + 1}}">
                >
                </button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($promotionImages as $index => $promotionImage)
            <div class="relative carousel-item {{$index == 0?'active':''}}">
                <span class="sm:flex justify-center items-center absolute hidden bottom-4 left-4 bg-gray-100 text-gray-800 opacity-80 md:opacity-60 rounded-full text-xs md:text-base m-3 md:m-4 px-2 py-2 md:px-[.75rem] md:py-1">{{ $index + 1 }} of {{ count($promotionImages) }}</span>
                <img loading="lazy" src="{{ asset('storage/'.$promotionImage) }}" class="d-block w-full h-full object-cover" alt="">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev hover:bg-gradient-to-l from-transparent to-gray-800" type="button" data-bs-target="#promotionControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next hover:bg-gradient-to-r from-transparent to-gray-800" type="button" data-bs-target="#promotionControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endif
