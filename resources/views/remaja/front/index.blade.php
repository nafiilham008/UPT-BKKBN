@extends('layouts.remaja.front.app')

@section('title', __('Menjadi Remaja'))

@section('content')
    <div>
        <div id="lottie-background" class="h-[500px]"></div>
        @include('layouts.remaja.component.navbar')
        <div id="content" class="lg:py-24 py-12 h-auto lg:px-0 px-5">
            <h1 class="font-titan lg:text-[40px] text-2xl text-[#272727]/70 mb-5">Let's Start The Game</h1>
            <h1 class="font-be-vietnam lg:text-base text-base text-center text-[#272727]/70">Lorem ipsum dolor sit amet
                consectetur. Donec
                eu
                tortor quis mollis cursus sed<br>vestibulum nec sit. Iaculis id blandit ut in at urna.</h1>
            <a href="{{ route('user.list') }}" class="mb-10 w-64 h-64">
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_nvkvb2j5.json" background="transparent"
                    speed="1" class="w-64 h-64" loop autoplay></lottie-player>
            </a>
            {{-- <a href="" class="h-max w-max">
                <div
                    class="bg-[#FAA307] hover:bg-[#FFCA3A] transition-colors duration-300 py-4 px-[75px] font-be-vietnam font-medium text-base text-white rounded-[12px]">
                    Learn More
                </div>
            </a> --}}
        </div>
        <div class="bg-white relative lg:px-[200px] px-5 py-7">
            <div class="flex gap-8 items-center mb-16">
                <div class="w-8 h-[73px] rounded-full bg-[#CF6EA7]"
                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);"></div>
                <h1 class="lg:text-[40px] text-[30px] text-[#272727] font-bold font-be-vietnam">About Menjadi Remaja</h1>
            </div>
            <div class="lg:grid lg:grid-cols-3 lg:gap-[30px] flex flex-col lg:space-y-0 space-y-10 lg:flex-none justify-center items-center mb-24">
                <div class="bg-[#B1DAF3] rounded-[24px] py-10 px-6 relative w-full"
                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                    <div class="">
                        <h1 class="text-[#272727] text-[32px] font-semibold font-be-vietnam mb-4">Efisien</h1>
                        <h1 class="text-[#272727] text-lg font-be-vietnam">Aplikasi mudah digunakan dan materi mudah
                            dimengerti</h1>
                    </div>
                    <div class="absolute right-0 top-[-40px]">
                        <img src="{{ asset('img/remaja/ilustrasi/sand-clock.svg') }}" alt="">
                    </div>
                </div>
                <div class="bg-[#E0F3FF] rounded-[24px] py-10 px-6 relative w-full"
                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                    <div class="">
                        <h1 class="text-[#272727] text-[32px] font-semibold font-be-vietnam mb-4">Menarik</h1>
                        <h1 class="text-[#272727] text-lg font-be-vietnam">Pembelajaran dengan gamifikasi yang menyenangkan
                            untuk anak.</h1>
                    </div>
                    <div class="absolute right-[-30px] top-[-40px]">
                        <img src="{{ asset('img/remaja/ilustrasi/rocket.svg') }}" alt="">
                    </div>
                </div>
                <div class="bg-[#C2E0F2] rounded-[24px] py-10 px-6 relative w-full"
                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                    <div class="">
                        <h1 class="text-[#272727] text-[32px] font-semibold font-be-vietnam mb-4">Informatif</h1>
                        <h1 class="text-[#272727] text-lg font-be-vietnam">Materi yang disajikan mudah untuk dipahami</h1>
                    </div>
                    <div class="absolute right-[-30px] top-[-40px]">
                        <img src="{{ asset('img/remaja/ilustrasi/lamp.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="flex justify-center mb-7">
                <img src="{{ asset('img/remaja/ilustrasi/profession.svg') }}" alt="">
            </div>
            <div class="flex gap-8 items-center mb-7">
                <div class="w-8 h-[73px] rounded-full bg-[#CF6EA7]"
                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);"></div>
                <h1 class="lg:text-[40px] text-[30px] text-[#272727] font-bold font-be-vietnam">Menjadi Remaja</h1>
            </div>
            <h1 class="text-lg text-[#212121] font-be-vietnam"><label class="font-bold">Menjadi Remaja</label> adalah sebuah
                media yang
                mewadaih anak-anak yang akan menginjak remaja dan belum mengenal dirinya dengan baik. Disajikan dan dikemas
                dengan sesuatu yang menyenangkan agar dapat diterima oleh semua anak Indonesia. Belajar sambil bermain?
                Kenapa Tidak</h1>
            <div class="absolute right-0 top-0">
                <img src="{{ asset('img/remaja/assets/book-right.svg') }}" alt="">
            </div>
            <div class="absolute left-0 top-96">
                <img src="{{ asset('img/remaja/assets/book-left.svg') }}" alt="">
            </div>
            <div class="absolute right-0 top-[600px]">
                <img src="{{ asset('img/remaja/assets/book-right.svg') }}" alt="">
            </div>
        </div>
        <div class="bg-[#EFF4FF] py-[70px] lg:px-0 px-5 flex justify-center">
            <div class="">
                <h1 class="text-2xl text-black text-center font-semibold font-inter mb-4">Ayo coba main sekarang dan kenali
                    dirimu! </h1>
                <h1 class="text-lg text-black text-center font-medium font-inter mb-9">KLIK tombol di bawah ini atau KLIK
                    tombol<label class="font-bold"> ‘PLAY’</label> di atas </h1>
                <div class="flex justify-center">
                    <button
                        class="text-white rounded-full px-28 py-[14px] bg-[#110946] transition-colors duration-300 hover:bg-[#6B629C]  font-be-vietnam text-base"
                        style="box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);">Ayo Mulai</button>
                </div>
            </div>
        </div>
    </div>
    <audio src="{{ asset('audio/backsound-home.mp3') }}" autoplay></audio>
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
        document.getElementById('logout-form').addEventListener('submit', function() {
            window.location.href = "{{ route('user.index') }}";
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

        lottie-player {
            width: 257px;
            height: 257px;
        }

        /* Style untuk layar dengan lebar maksimum 768px (misalnya mobile) */
        @media only screen and (max-width: 769px) {
            #lottie-background {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 600px;
                z-index: -1;
            }
        }
    </style>
@endpush
