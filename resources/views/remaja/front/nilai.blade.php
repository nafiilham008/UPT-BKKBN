@extends('layouts.remaja.front.app')

@section('title', __('score'))

@section('content')
    <div>
        <div id="lottie-background"></div>
        <div class="flex justify-between px-[78px] items-center pt-16">
            <a href="/list-game" onclick="showLoading(event)" class="flex gap-4 text-base text-[#272727] items-center font-medium">
                <div>
                    <img src="../img/remaja/assets/back-button.svg" alt="">
                </div>
                Back to game list
            </a>
            <div class="">
                <img src="../img/remaja/logo/logo.svg" alt="">
            </div>
        </div>
        <div id="content" class="py-24 relative">
            <h1 class="font-titan text-[48px] text-center text-[#110946] mb-5">Good Job </h1>
            <h1 class="font-be-vietnam text-base text-center text-[#272727]/70 mb-11">Kamu melakukannya dengan baik</h1>

            <section class="bg-no-repeat bg-center bg-cover rotate-section mb-11">
                <div class="w-[231px] h-[231px] items-center flex justify-center"
                    style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                    <h1 class="text-[#FF9C07] text-[64px] font-be-vietnam font-semibold">88</h1>
                </div>
            </section>
            <h1 class="font-be-vietnam text-base text-center text-[#272727]/90 mb-5" style="font-weight: 500">Lihat dimana
                kesalahannya dan dimana posisimu saat ini </h1>
            <div class="flex gap-[50px] items-center">
                <a href="#review" onclick="scrollToReview()"
                    class="w-[245px] h-11 flex justify-center items-center text-white text-base rounded-full transition-colors duration-300 bg-[#4CAF50] hover:bg-[#45A249]"
                    style="box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25); 1x">Review</a>
                <a href="/ranking" onclick="showLoading(event)"
                    class="w-[245px] flex h-11 justify-center items-center text-white text-base rounded-full transition-colors duration-300 bg-[#FF0707] hover:bg-[#D60606]"
                    style="box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25); 1x">Rangking</a>
            </div>
            <div class="absolute left-20 top-10">
                <img src="../img/remaja/assets/ilustrasi1.svg" alt="">
            </div>
            <div class="absolute right-20 top-32">
                <img src="../img/remaja/assets/ilustrasi2.svg" alt="">
            </div>
        </div>
        <div class="bg-white relative px-20 py-7">
            <div id="review" class="flex gap-8 items-center mb-16 mb-10">
                <div class="w-8 h-[73px] rounded-full bg-[#CF6EA7]"
                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);"></div>
                <h1 class="text-[40px] text-[#272727] font-bold font-be-vietnam">Review Materi</h1>
            </div>
            <div class="border rounded-[24px] border-[#4895EF] mb-6"
                style="background: rgba(255, 255, 255, 0.20); box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                <div class="bg-white pt-10 pb-5 px-10 rounded-t-[24px]">
                    <h1 class="font-be-vietnam text-base text-[#272727] mb-5">Lorem ipsum dolor sit amet consectetur. Enim
                        vestibulum faucibus non mattis urna commodo enim. Varius purus nulla in fermentum?</h1>
                    <div
                        class="bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                        Benar
                    </div>
                </div>
                <div class="bg-[#4895EF]/20 pt-6 pb-4 px-10 rounded-b-[24px]">
                    <h1 class="font-be-vietnam text-lg text-[#272727] font-bold mb-2">Penjelasan</h1>
                    <h1 id="myText" class="font-be-vietnam text-base text-[#272727] mb-5 line-clamp">
                        Lorem ipsum dolor sit amet consectetur. Pulvinar lorem id amet eget. Malesuada placerat nibh
                        dignissim erat volutpat sed at. Nisi sed sed scelerisque ornare. Urna tincidunt senectus gravida
                        tincidunt ornare. Viverra posuere sit maecenas consectetur viverra. Ligula augue non sodales
                        pellentesque velit dolor cras ut. Scelerisque amet mauris dignissim enim. Dignissim ullamcorper
                        massa dignissim placerat nunc mauris. Amet elementum nec nisl lectus auctor ac et nisl. Consequat
                        ultrices donec faucibus nibh placerat auctor eget nec eu. Vehicula pulvinar vulputate vel turpis
                        consequat vulputate. Aliquam in pharetra tristique dignissim quis enim. Nullam ornare volutpat
                        dignissim platea.
                    </h1>

                    <button id="toggleButton" onclick="toggleText()" class="text-[#5C7AEA] font-be-vietnam text-base">Read
                        more..</button>
                </div>
            </div>
            <div class="border rounded-[24px] border-[#DA1E37] mb-6"
                style="background: rgba(255, 255, 255, 0.20); box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                <div class="bg-white pt-10 pb-5 px-10 rounded-t-[24px]">
                    <h1 class="font-be-vietnam text-base text-[#272727] mb-5">Lorem ipsum dolor sit amet consectetur. Enim
                        vestibulum faucibus non mattis urna commodo enim. Varius purus nulla in fermentum?</h1>
                    <div
                        class="bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                        Salah
                    </div>
                </div>
                <div class="bg-[#DA1E37]/20 pt-6 pb-4 px-10 rounded-b-[24px]">
                    <h1 class="font-be-vietnam text-lg text-[#272727] font-bold mb-2">Penjelasan</h1>
                    <h1 id="myText" class="font-be-vietnam text-base text-[#272727] mb-5 line-clamp">
                        Lorem ipsum dolor sit amet consectetur. Pulvinar lorem id amet eget. Malesuada placerat nibh
                        dignissim erat volutpat sed at. Nisi sed sed scelerisque ornare. Urna tincidunt senectus gravida
                        tincidunt ornare. Viverra posuere sit maecenas consectetur viverra. Ligula augue non sodales
                        pellentesque velit dolor cras ut. Scelerisque amet mauris dignissim enim. Dignissim ullamcorper
                        massa dignissim placerat nunc mauris. Amet elementum nec nisl lectus auctor ac et nisl. Consequat
                        ultrices donec faucibus nibh placerat auctor eget nec eu. Vehicula pulvinar vulputate vel turpis
                        consequat vulputate. Aliquam in pharetra tristique dignissim quis enim. Nullam ornare volutpat
                        dignissim platea.
                    </h1>

                    <button id="toggleButton" onclick="toggleText()" class="text-[#5C7AEA] font-be-vietnam text-base">Read
                        more..</button>
                </div>
            </div>
        </div>
    </div>
    <audio src="../audio/backsound-score.mp3" autoplay></audio>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script>
        // Menambahkan animasi Lottie sebagai background
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-background'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://lottie.host/a3ca3ccb-0cf4-4389-896a-0b1e480d0bb7/ChyNBZwob9.json',
            rendererSettings: {
                preserveAspectRatio: 'xMidYMid slice',
            },
            onComplete: function() {
                adjustContentHeight();
            }
        });

        function adjustContentHeight() {
            var lottieBackground = document.getElementById('lottie-background');
            var content = document.getElementById('content');
            content.style.height = lottieBackground.offsetHeight + 'px';
        }

        window.addEventListener('resize', function() {
            adjustContentHeight();
        });
    </script>
    <script>
        const section = document.querySelector('section');
        let rotation = 0;

        function rotateBackground() {
            rotation += 3;
            section.style.backgroundPosition = `center center ${rotation}deg`;
            requestAnimationFrame(rotateBackground);
        }

        rotateBackground();
    </script>
    <script>
        function toggleText() {
            var textElement = document.getElementById("myText");
            var buttonText = document.getElementById("toggleButton");

            if (textElement.classList.contains("line-clamp")) {
                textElement.classList.remove("line-clamp");
                textElement.classList.add("expanded");
                buttonText.textContent = "Read less";
            } else {
                textElement.classList.remove("expanded");
                textElement.classList.add("line-clamp");
                buttonText.textContent = "Read more..";
            }
        }
    </script>
    <script>
        function scrollToReview() {
            const reviewElement = document.getElementById("review");
            reviewElement.scrollIntoView({
                behavior: "smooth"
            });
        }
    </script>
@endpush
@push('css')
    <style>
        html {
            scroll-behavior: smooth;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .rotate-section {
            position: relative;
            overflow: hidden;
        }

        .rotate-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../img/remaja/assets/ring.svg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            animation: rotate 5s infinite linear;
            z-index: -1;
        }
    </style>
    <style>
        #lottie-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: max-content;
            z-index: -1;
        }

        #content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
    <style>
        .line-clamp {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Menampilkan hanya 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .expanded {
            -webkit-line-clamp: unset !important;
        }
    </style>
@endpush
