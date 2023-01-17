{{-- <div class="hero-section">
    <div class="spotlight-container">
        <button class="ctrl-right" onclick='switchToNext()'>
            <iconify-icon icon="material-symbols:arrow-circle-right-outline-rounded" style="color: white;">
            </iconify-icon>
        </button>
        <button class="ctrl-left" onclick='switchToPrev()'>
            <iconify-icon icon="material-symbols:arrow-circle-left-outline-rounded" style="color: white;">
            </iconify-icon>
        </button>
        <div class="page-counter">
            @foreach ($banner as $key => $slider)
                <div class="page-ball" id="pb-{{ $key + 1 }}"></div>
            @endforeach
        </div>
        <div class="timer-bar">
            <div id="time-bar" class="bar-inner"></div>
        </div>
        @foreach ($banner as $key => $slider)
            <div class="slide-container out-right" id="slide-{{ $key + 1 }}">
                <div class="info-area-container">
                    <div class="spacer-div"></div>
                    <div class="info-area out-fade-down" id="info-{{ $key + 1 }}">
                        <h3 class="text-3xl text-white text-center">{{ $slider->title }}</h3>
                    </div>
                </div>
                <img src="{{ asset('uploads/images/thumbnail/' . $slider->thumbnail) }}" alt="">
            </div>
        @endforeach
    </div>
</div> --}}

{{-- <div id="carouselExampleControls" class="carousel slide relative" data-ride="carousel">
    <div class="carousel-inner relative w-full overflow-hidden">
        @foreach ($banner as $slide)
            <div class="carousel-item relative float-left w-full {{ $loop->first ? 'active' : '' }}">
                <img src="{{ $slide->thumbnail }}" class="block w-full cover3" alt="content" />
                <div class="" style="position: absolute; bottom: 100px">
                    <h1 class="px-96 text-[#E8E8E8] text-center text-3xl">
                        {{ $slide->title }}
                    </h1>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div> --}}

{{-- tes --}}
{{-- <div id="carouselExampleCaptions" class="carousel slide relative" data-ride="carousel">
    <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
        @foreach ($banner as $key => $slide)
            <button type="button" data-target="#carouselExampleCaptions" data-slide-to="{{ $key }}"
                class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                aria-label="Slide {{ $key + 1 }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner relative w-full overflow-hidden">
        @foreach ($banner as $key => $slide)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }} relative float-left w-full">
                <img src="{{ asset('uploads/images/thumbnail/' . $slide->thumbnail) }}" class="block w-full" alt="{{ $slide->thumbnail }}" />
                <div class="carousel-caption hidden md:block absolute text-center">
                    <h5 class="text-xl">{{ $slide->title }}</h5>
                    <p>{{ $slide->title }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <button
        class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
        type="button" data-target="#carouselExampleCaptions" data-slide="prev">
        <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button
        class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
        type="button" data-target="#carouselExampleCaptions" data-slide="next">
        <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> --}}

<div id="carouselExampleControls" class="carousel slide relative" data-bs-ride="carousel">
    <div class="carousel-inner relative w-full overflow-hidden">
        @foreach ($banner as $key => $slide)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }} relative float-left w-full">
                <img src="{{ asset('uploads/images/thumbnail/' . $slide->thumbnail) }}" class="block w-full cover3"
                    alt="{{ $slide->thumbnail }}" />
                <div class="" style="position: absolute; bottom: 100px">
                    <h1 class="px-96 text-[#E8E8E8] text-center text-3xl">
                        {{ $slide->title }}
                    </h1>
                </div>
            </div>
        @endforeach

        <button
            class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
            type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
            type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

{{-- <div class="relative">
    <div class="carousel slide" id="carouselExampleControls" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($slides as $key => $slide)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img class="w-full h-64 object-cover" src="{{ $slide->image_url }}" alt="{{ $slide->alt_text }}">
                    <div class="absolute bottom-0 px-16" style="left: 0; right: 0;">
                        <h1 class="text-white text-center text-3xl">{{ $slide->title }}</h1>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div> --}}
