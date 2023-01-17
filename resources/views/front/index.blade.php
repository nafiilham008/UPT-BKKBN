@extends('layouts.front.app')

@section('title', __('Users'))

@section('content')
    <!-- jumbtron -->
    @include('front.components.banner')
    <div class="py-16 px-20">
        <h1 class="text-4xl text-black flex justify-center font-bold" style="font-family: 'Poppins', sans-serif;">
            Kediklatan BKKBN </h1>
        <div class="grid grid-cols-12 px py-16">
            <div class="col-span-6 flex justify-center">
                <img src="/bg-1.png" class="cover rounded-xl" alt="">
            </div>
            <div class="col-span-6 flex flex-col justify-center">
                <h1 class="text-base text-justify font-semibold" style="font-family: 'Poppins', sans-serif;">
                    Organisasi
                    keluarga berencana dimulai dari pembentukan Perkumpulan Keluarga Berencana pada tanggal 23 Desember
                    1957 di gedung Ikatan Dokter Indonesia. Nama perkumpulan itu sendiri berkembang menjadi Perkumpulan
                    Keluarga Berencana Indonesia (PKBI) atau Indonesia Planned Parenthood Federation (IPPF). PKBI
                    memperjuangkan terwujudnya keluarga- keluarga yang sejahtera melalui 3 macam usaha pelayanan yaitu
                    mengatur kehamilan atau menjarangkan kehamilan, mengobati kemandulan serta memberi nasihat
                    perkawinan.</h1>
                <button class="px-4 py-2 bg-[#0183CE] hover:bg-[#006198] rounded-xl mt-7 w-max text-white">Get
                    Started</button>
            </div>
        </div>
    </div>
    <div class="bg-[#0183CE]" style="height: 800px;">
        {{-- DIKLAT --}}
        @include('front.components.diklatflow')
    </div>
    <div class="grid grid-cols-12 w-full absolute" style="top: 2000px;">
        <div class="col-span-8">
            {{-- TAB --}}
            @include('front.components.tab')
        </div>
        <div class="col-span-4 pr-20">
            <!-- Sosial Media -->
            @include('front.components.social')
            <!-- Location -->
            @include('front.components.location')
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>

    <!-- js Tabs -->
    <script type="text/javascript">
        function changeAtiveTab(event, tabID) {
            let element = event.target;
            while (element.nodeName !== "A") {
                element = element.parentNode;
            }
            ulElement = element.parentNode.parentNode;
            aElements = ulElement.querySelectorAll("li > a");
            tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
            for (let i = 0; i < aElements.length; i++) {

                aElements[i].classList.remove("border-black");
                aElements[i].classList.remove("border-b-4");
                tabContents[i].classList.add("hidden");
                tabContents[i].classList.remove("block");
            }
            element.classList.add("border-white");
            element.classList.add("border-b-4");
            document.getElementById(tabID).classList.remove("hidden");
            document.getElementById(tabID).classList.add("block");
        }
    </script>

    {{-- <script>
        let currentSlide = 1;
        let timeBar = document.getElementById("time-bar");
        let slides = [];
        let infos = [];
        let pbs = [];

        // Loop through all the slides, infos, and progress bars and push them to their respective arrays
        for (let i = 1; i <= {{ count($banner) }}; i++) {
            slides.push(document.getElementById("slide-" + i));
            infos.push(document.getElementById("info-" + i));
            pbs.push(document.getElementById("pb-" + i));
        }

        // Function to switch to the next slide
        function switchToNext() {
            // Remove and add the animation class to the time bar
            timeBar.classList.remove("bar-anim");
            timeBar.classList.add("bar-anim");
            // Loop through all the slides, infos, and progress bars
            for (let i = 0; i < slides.length; i++) {
                if (i === currentSlide - 1) {
                    // If the current slide is the one we want to show, remove the out-right class
                    slides[i].classList.remove("out-right");
                    infos[i].classList.remove("out-fade-down");
                    pbs[i].classList.add("active-pb");
                } else {
                    // If the current slide is not the one we want to show, add the out-left class
                    slides[i].classList.add("out-left");
                    infos[i].classList.add("out-fade-down");
                    pbs[i].classList.remove("active-pb");
                }
            }
            // If the current slide is the last one, set the current slide to the first one
            if (currentSlide === slides.length) {
                currentSlide = 1;
            } else {
                currentSlide++;
            }
        }

        // Function to switch to the previous slide
        function switchToPrev() {
            // Loop through all the slides, infos, and progress bars
            for (let i = 0; i < slides.length; i++) {
                if (i === currentSlide - 1) {
                    // If the current slide is the one we want to show, remove the out-left class
                    slides[i].classList.remove("out-left");
                    infos[i].classList.remove("out-fade-down");
                    pbs[i].classList.add("active-pb");
                } else {
                    // If the current slide is not the one we want to show, add the out-right class
                    slides[i].classList.add("out-right");
                    infos[i].classList.add("out-fade-down");
                    pbs[i].classList.remove("active-pb");
                }
            }
            // If the current slide is the first one, set the current slide to the last one
            if (currentSlide === 1) {
                currentSlide = slides.length;
            } else {
                currentSlide--;
            }
        }

        // Set an interval to switch to the next slide every 10 seconds
        window.setInterval(function() {
            switchToNext()
        }, 10000);
    </script> --}}
@endpush
