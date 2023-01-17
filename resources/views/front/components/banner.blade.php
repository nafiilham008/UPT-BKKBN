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

<div id="carouselExampleControls" class="carousel slide relative" data-ride="carousel">
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
</div>
