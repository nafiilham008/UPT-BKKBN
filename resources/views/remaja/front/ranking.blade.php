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
            <div class="flex gap-9 justify-center items-end">
                <div class="flex flex-col items-center">
                    <h1 class="font-be-vietnam font-semibold text-lg text-black mb-6">Marsha Lenathea</h1>
                    <div class="relative rounded-full" style="box-shadow: 0px 4px 32px 0px rgba(0, 0, 0, 0.25);">
                        <img src="../img/remaja/assets/marsha.png"
                            class="w-[105px] h-[105px] rounded-full border-[8px] border-[#D6D6D6] " alt="">
                    </div>
                    <img src="../img/remaja/assets/podium-2.svg" alt="">
                    <h1 class="font-be-vietnam font-bold text-[32px] text-black">203</h1>
                </div>
                <div class="flex flex-col items-center">
                    <h1 class="font-be-vietnam font-semibold text-lg text-black mb-6">Marsha Lenathea</h1>
                    <div class="relative rounded-full" style="box-shadow: 0px 4px 32px 0px rgba(0, 0, 0, 0.25);">
                        <img src="../img/remaja/assets/marsha.png"
                            class="w-[105px] h-[105px] rounded-full border-[8px] border-[#FBCA02] " alt="">
                        <div class="absolute -top-8 -right-5">
                            <img src="../img/remaja/assets/golden crown.svg" alt="">
                        </div>
                    </div>
                    <img src="../img/remaja/assets/podium-1.svg" alt="">
                    <h1 class="font-be-vietnam font-bold text-[32px] text-black">203</h1>
                </div>
                <div class="flex flex-col items-center">
                    <h1 class="font-be-vietnam font-semibold text-lg text-black mb-6">Marsha Lenathea</h1>
                    <div class="relative rounded-full" style="box-shadow: 0px 4px 32px 0px rgba(0, 0, 0, 0.25);">
                        <img src="../img/remaja/assets/marsha.png"
                            class="w-[105px] h-[105px] rounded-full border-[8px] border-[#977547] " alt="">
                    </div>
                    <img src="../img/remaja/assets/podium-3.svg" alt="">
                    <h1 class="font-be-vietnam font-bold text-[32px] text-black">203</h1>
                </div>
            </div>
            <div class="absolute left-20 top-10">
                <img src="../img/remaja/assets/ilustrasi1.svg" alt="">
            </div>
            <div class="absolute right-20 top-32">
                <img src="../img/remaja/assets/ilustrasi2.svg" alt="">
            </div>
        </div>
        <div class="bg-white relative px-20 py-7 relative">
            <div id="review" class="flex gap-8 items-center mb-16 mb-10">
                <div class="w-8 h-[73px] rounded-full bg-[#CF6EA7]"
                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);"></div>
                <h1 class="text-[40px] text-[#272727] font-bold font-be-vietnam">Top 10</h1>
            </div>
            <div class="grid grid-cols-4 rounded-[24px] border border-[#4895EF] mb-7"
                style="background: rgba(255, 255, 255, 0.20); box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                <div class="col-span-1 bg-[#4895EF]/20 flex items-center justify-center py-[54px] rounded-l-[24px]">
                    <div class="flex items-center gap-4">
                        <img src="../img/remaja/assets/marsha.png" alt=""
                            class="w-[78px] h-[78px] rounded-full border-4 border-[#4895EF]">
                        <h1 class="text-xl text-[#272727] font-bold">Marsha Lenathea</h1>
                    </div>
                </div>
                <div class="col-span-3">
                    <div class="flex gap-48 h-full px-[54px] items-center">
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Game Finish</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Achivment</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Point</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                    </div>
                    <div class=""></div>
                </div>
            </div>
            <div class="grid grid-cols-4 rounded-[24px] border border-[#FF99AC] mb-7"
                style="background: rgba(255, 255, 255, 0.20); box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                <div class="col-span-1 bg-[#FF99AC]/20 flex items-center justify-center py-[54px] rounded-l-[24px]">
                    <div class="flex items-center gap-4">
                        <img src="../img/remaja/assets/marsha.png" alt=""
                            class="w-[78px] h-[78px] rounded-full border-4 border-[#FF99AC]">
                        <h1 class="text-xl text-[#272727] font-bold">Marsha Lenathea</h1>
                    </div>
                </div>
                <div class="col-span-3">
                    <div class="flex gap-48 h-full px-[54px] items-center">
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Game Finish</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Achivment</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Point</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                    </div>
                    <div class=""></div>
                </div>
            </div>
            <div class="grid grid-cols-4 rounded-[24px] border border-[#52B788] mb-7"
                style="background: rgba(255, 255, 255, 0.20); box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                <div class="col-span-1 bg-[#52B788]/20 flex items-center justify-center py-[54px] rounded-l-[24px]">
                    <div class="flex items-center gap-4">
                        <img src="../img/remaja/assets/marsha.png" alt=""
                            class="w-[78px] h-[78px] rounded-full border-4 border-[#52B788]">
                        <h1 class="text-xl text-[#272727] font-bold">Marsha Lenathea</h1>
                    </div>
                </div>
                <div class="col-span-3">
                    <div class="flex gap-48 h-full px-[54px] items-center">
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Game Finish</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Achivment</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Point</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                    </div>
                    <div class=""></div>
                </div>
            </div>
            <div class="grid grid-cols-4 rounded-[24px] border border-[#9D4EDD] mb-7"
                style="background: rgba(255, 255, 255, 0.20); box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                <div class="col-span-1 bg-[#9D4EDD]/20 flex items-center justify-center py-[54px] rounded-l-[24px]">
                    <div class="flex items-center gap-4">
                        <img src="../img/remaja/assets/marsha.png" alt=""
                            class="w-[78px] h-[78px] rounded-full border-4 border-[#9D4EDD]">
                        <h1 class="text-xl text-[#272727] font-bold">Marsha Lenathea</h1>
                    </div>
                </div>
                <div class="col-span-3">
                    <div class="flex gap-48 h-full px-[54px] items-center">
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Game Finish</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Achivment</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                        <div class="flex flex-col gap-9 items-center">
                            <h1 class="text-xl text-[#272727] font-bold">Point</h1>
                            <h1 class="text-xl text-[#272727] font-medium">4</h1>
                        </div>
                    </div>
                    <div class=""></div>
                </div>
            </div>
            <div class="absolute top-[25%] left-0">
                <img src="../img/remaja/assets/board.svg" alt="">
            </div>
            <div class="absolute top-[90%] right-0">
                <img src="../img/remaja/assets/board.svg" alt="">
            </div>
            <div class="absolute top-[50%] right-0">
                <img src="../img/remaja/assets/pallete.svg" alt="">
            </div>
        </div>
    </div>

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
@endpush
@push('css')
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
@endpush
