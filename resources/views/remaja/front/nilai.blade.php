@extends('layouts.remaja.front.app')

@section('title', __('score'))

@section('content')
    <div>
        <div id="lottie-background"></div>
        <div class="flex justify-between px-[78px] items-center pt-16">
            <a href="" class="flex gap-4 text-base text-[#272727] items-center font-medium">
                <div>
                    <img src="../img/remaja/assets/back-button.svg" alt="">
                </div>
                Back to game list
            </a>
            <div class="">
                <img src="../img/remaja/logo/logo.svg" alt="">
            </div>
        </div>
        <div id="content" class="py-24">
            <h1 class="font-titan text-[48px] text-center text-[#110946] mb-5">Good Job </h1>
            <h1 class="font-be-vietnam text-base text-center text-[#272727]/70 mb-11">Kamu melakukannya dengan baik</h1>
            <div
                class="w-[231px] h-[231px] flex justify-center items-center rounded-full bg-[#FF9C07] text-white text-[64px] font-be-vietnam mb-20" style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                88
            </div>
            <div class="flex gap-[50px] items-center">
                <button class="w-[245px] h-11 justify-center items-center text-white text-base rounded-full bg-[#4CAF50]" style="box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25); 1x">Review</button>
                <button class="w-[245px] h-11 justify-center items-center text-white text-base rounded-full bg-[#FF0707]" style="box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25); 1x">Rangking</button>
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
