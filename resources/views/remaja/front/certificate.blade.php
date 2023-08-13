@extends('layouts.remaja.front.app')

@section('title', __('certificate'))

@section('content')
    <div>
        <div x-data="app()" x-init="initializeStep()" x-cloak id="app" class="py-16"
            style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 100%);">
            <div class="relative">
                <div class="flex justify-between px-[78px] items-center mb-24">
                    <a href="{{ route('user.profile') }}" data-href="{{ route('user.profile') }}" onclick="showLoading(event)"
                        class="flex gap-4 text-base text-[#272727] items-center font-medium">
                        <div>
                            <img src="{{ asset('img/remaja/assets/back-button.svg') }}" alt="">
                        </div>
                        Back to profile
                    </a>
                    <div class="">
                        <img src="{{ asset('img/remaja/logo/logo.svg') }}" alt="">
                    </div>
                </div>
                <div class="">
                    <h1 class="font-titan text-[40px] text-center text-[#272727]/70 mb-5">Let's Start The Game</h1>
                    <h1 class="font-be-vietnam text-base text-center text-[#272727]/70 mb-12">Seberapa jauh kamu tau? Ayo
                        mulai
                        main dan pastiin jawabanmu bener ya, Lest’s Play</h1>
                    <div class="px-[185px]">
                        <div class="rounded-[24px] flex flex-col gap-10 items-center justify-center min-h-[600px] bg-white/40"
                            style="box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                            <div class="flex justify-end w-full px-[68px]">
                                <a href="{{ route('user.profile.certificate.print', $resultQuiz->quiz->slug_url) }}"
                                    class="px-4 py-1 flex items-center text-xs text-[#272727]/80 font-semibold bg-[#708AEC]/40 font-be-vietnam rounded-full hover:bg-blue-800 active:bg-blue-800 hover:text-white active:text-white transition-all duration-200 ease-in-out"
                                    style="box-shadow: 2px 4px 11px 0px rgba(92, 122, 234, 0.20);">
                                    Download
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="ml-4 h-5 w-5 fill-current">
                                        <g clip-path="url(#clip0_427_174)">
                                            <path
                                                d="M12.0001 11C12.2653 11 12.5196 11.1054 12.7072 11.2929C12.8947 11.4804 13.0001 11.7348 13.0001 12V18.584L14.2931 17.292C14.4808 17.1045 14.7354 16.9993 15.0008 16.9994C15.2661 16.9996 15.5205 17.1052 15.7081 17.293C15.8956 17.4808 16.0008 17.7353 16.0006 18.0007C16.0004 18.2661 15.8948 18.5205 15.7071 18.708L12.8831 21.527C12.6301 21.779 12.3831 22 12.0001 22C11.6641 22 11.4341 21.831 11.2121 21.62L8.29306 18.708C8.10528 18.5205 7.99969 18.2661 7.9995 18.0007C7.99931 17.7353 8.10455 17.4808 8.29206 17.293C8.47957 17.1052 8.73399 16.9996 8.99935 16.9994C9.26472 16.9993 9.51928 17.1045 9.70706 17.292L11.0001 18.584V12C11.0001 11.7348 11.1054 11.4804 11.293 11.2929C11.4805 11.1054 11.7348 11 12.0001 11ZM11.5001 2C14.2841 2 16.6601 3.75 17.5861 6.212C18.8196 6.55118 19.9126 7.27559 20.7055 8.2796C21.4985 9.2836 21.9499 10.5147 21.994 11.7933C22.0381 13.0719 21.6726 14.3311 20.9507 15.3874C20.2288 16.4436 19.1883 17.2416 17.9811 17.665C17.9064 16.9897 17.6037 16.3601 17.1231 15.88C16.612 15.3666 15.9318 15.0564 15.2091 15.007L15.0001 15V12C15.0008 11.2191 14.697 10.4687 14.1533 9.90818C13.6095 9.34769 12.8687 9.02132 12.0881 8.9984C11.3075 8.97548 10.5488 9.25784 9.97309 9.78546C9.39739 10.3131 9.05012 11.0444 9.00506 11.824L9.00006 12V15C8.60564 14.9994 8.21499 15.0769 7.85063 15.2279C7.48627 15.3789 7.1554 15.6005 6.87706 15.88C6.33912 16.4176 6.02622 17.1399 6.00206 17.9C4.96098 17.6873 4.0147 17.1485 3.30038 16.3619C2.58605 15.5752 2.1408 14.5815 2.02916 13.5248C1.91751 12.4681 2.14528 11.4033 2.67945 10.4847C3.21362 9.56618 4.02642 8.84159 5.00006 8.416C5.02215 6.70669 5.71671 5.07489 6.93331 3.87401C8.14991 2.67313 9.79061 1.99986 11.5001 2Z"
                                                fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_427_174">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                            <div class="relative">
                                <img src="{{ asset('img/remaja/assets/sertifikat.svg') }}" alt="">
                                <div class="absolute top-[168px] left-[54px]">
                                    <h1 class="font-montserrat font-semibold text-2xl">{{ $resultQuiz->users->name }}</h1>
                                </div>
                                <div class="absolute top-52 left-[54px]">
                                    <h1 class="font-montserrat  text-[8px] w-[360px]">Telah Menyelesaikan Game <label
                                            class="font-semibold">{{ $resultQuiz->quiz->title }}</label> pada <label
                                            class="font-semibold">{{ $resultQuiz->created_at->format('j, F Y') }}</label></h1>
                                </div>
                                <div class="absolute top-[310px] left-[54px] w-[100px]">
                                    <h1 class="font-montserrat font-semibold text-center text-[8px]">{{ $resultQuiz->quiz->users->name }}</h1>
                                </div>
                                <div class="absolute top-[330px] left-[54px] w-[100px]">
                                    <h1 class="font-montserrat text-center text-[6px]">Pengajar</h1>
                                </div>
                                <div class="absolute top-[250px] left-8">
                                    <img src="{{ asset('img/remaja/assets/tanda tangan.png') }}" class="w-40 h-auto" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute top-[50%] left-16">
                    <img src="{{ asset('img/remaja/assets/board.svg') }}" alt="">
                </div>
                <div class="absolute top-[75%] right-16">
                    <img src="{{ asset('img/remaja/assets/pallete.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
