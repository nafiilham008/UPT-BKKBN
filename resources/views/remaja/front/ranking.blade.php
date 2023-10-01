@extends('layouts.remaja.front.app')

@section('title', __('Peringkat'))

@section('content')
    <div>
        <div id="lottie-background"></div>
        <div class="flex flex-col-reverse lg:flex-row lg:justify-between px-5 lg:px-[78px] lg:items-center mb-0 lg:mb-24">
            <a href="{{ route('user.list') }}" data-href="{{ route('user.list') }}" onclick="showLoading(event)"
                class="flex gap-4 text-base text-[#272727] items-center font-medium">
                <div>
                    <img src="{{ asset('img/remaja/assets/back-button.svg') }}" alt="">
                </div>
                Back to game list
            </a>
            <div class="flex lg:flex-none justify-center mb-10 lg:mb-0 mt-10">
                <img src="{{ asset('img/remaja/logo/logo.svg') }}" alt="">
            </div>
        </div>
        <div id="content" class="py-24 relative">
            <div class="flex md:gap-9 gap-2 justify-center items-end">
                @foreach ($topRanking as $index => $rank)
                    <div class="flex flex-col items-center">
                        <h1 class="font-be-vietnam font-semibold text-center text-lg text-black mb-6">
                            {{ $rank->users->name }}</h1>
                        <div class="relative rounded-full">
                            <img src="{{ asset('storage/' . $rank->users->avatar) }}"
                                class="md:w-[105px] md:h-[105px] w-[100px] h-[100px] rounded-full border-[8px] border-[#D6D6D6]"
                                alt="" style="box-shadow: 0px 4px 32px 0px rgba(0, 0, 0, 0.25);">
                            @if ($index === 0)
                                <div class="absolute -top-8 -right-5">
                                    <img src="{{ asset('img/remaja/assets/golden crown.svg') }}" alt="">
                                </div>
                                <img src="{{ asset('img/remaja/assets/podium-1.svg') }}" alt="">
                            @elseif ($index === 1)
                                <img src="{{ asset('img/remaja/assets/podium-2.svg') }}" alt="">
                            @elseif ($index === 2)
                                <img src="{{ asset('img/remaja/assets/podium-3.svg') }}" alt="">
                            @endif
                        </div>
                        <h1 class="font-be-vietnam font-bold text-[32px] text-black">{{ $rank->final_score }}</h1>
                    </div>
                @endforeach

            </div>

            <div class="hidden lg:block absolute left-20 top-10">
                <img src="{{ asset('img/remaja/assets/ilustrasi1.svg') }}" alt="">
            </div>
            <div class="hidden lg:block absolute right-20 top-32">
                <img src="{{ asset('img/remaja/assets/ilustrasi2.svg') }}" alt="">
            </div>
        </div>

        {{-- TOP 10 --}}
        <div class="bg-white relative md:px-20 px-5 py-7 relative">
            <div id="review" class="flex gap-8 items-center mb-16 mb-10">
                <div class="w-8 h-[73px] rounded-full bg-[#CF6EA7]"
                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);"></div>
                <h1 class="text-[40px] text-[#272727] font-bold font-be-vietnam">Top 7</h1>
            </div>
            @foreach ($all as $key => $ranking)
                <div class="grid grid-cols-4 rounded-[24px] border border-[#4895EF] mb-7"
                    style="background: rgba(255, 255, 255, 0.20); box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                    <div class="col-span-2 md:col-span-1 bg-[#4895EF]/20 flex items-center justify-center py-[54px] rounded-l-[24px]">
                        <div class="flex md:flex-row flex-col items-center gap-4">
                            <img src="{{ asset('storage/' . $rank->users->avatar) }}" alt=""
                                class="w-[78px] h-[78px] rounded-full border-4 border-[#4895EF]">
                            <h1 class="text-xl text-[#272727] text-center font-bold">{{ $ranking->users->name }}</h1>
                        </div>
                    </div>
                    <div class="col-span-2 md:col-span-3">
                        <div class="flex gap-5 md:gap-48 h-full px-5 md:px-[54px] items-center">
                            <div class="flex flex-col gap-9 items-center">
                                <h1 class="text-xl text-[#272727] font-bold">Game Finish</h1>
                                <h1 class="text-xl text-[#272727] font-medium">{{ $totalQuiz[$key]->total_quiz }}</h1>
                                {{-- {{ $ranking->game_finish }} --}}
                            </div>
                            {{-- <div class="flex flex-col gap-9 items-center">
                                <h1 class="text-xl text-[#272727] font-bold">Achievement</h1>
                                <h1 class="text-xl text-[#272727] font-medium">{{ $ranking->achievement }}</h1>
                            </div> --}}
                            <div class="flex flex-col gap-9 items-center">
                                <h1 class="text-xl text-[#272727] font-bold">Point</h1>
                                <h1 class="text-xl text-[#272727] font-medium">{{ $ranking->final_score }}</h1>
                            </div>
                        </div>
                        <div class=""></div>
                    </div>
                </div>
            @endforeach


            <div class="absolute top-[25%] left-0">
                <img src="{{ asset('img/remaja/assets/board.svg') }}" alt="">
            </div>
            <div class="absolute top-[90%] right-0">
                <img src="{{ asset('img/remaja/assets/board.svg') }}" alt="">
            </div>
            <div class="absolute top-[50%] right-0">
                <img src="{{ asset('img/remaja/assets/pallete.svg') }}" alt="">
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

        /* Style untuk layar dengan lebar maksimum 768px (misalnya mobile) */
        @media only screen and (max-width: 820px) {
            #lottie-background {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 1000px;
                z-index: -1;
            }
        }
    </style>
@endpush
