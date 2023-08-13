@extends('layouts.remaja.auth-remaja.app')

@section('title', __('Forgot Password'))

@section('content')
    <div class="relative bg h-auto">
        <div class="flex flex-col justify-center items-center px-5 md:px-0 py-14 md:py-28">
            <img src="../img/logo/logo-menjadi.svg" alt="" class="mb-9">
            <div class="rounded-[24px] bg-white/40 py-[22px] w-full md:w-[522px] box-shadow">
                <h1 class="font-be-vietnam text-[32px] font-semibold text-center mb-1.5 text-black">Forgot Password?</h1>
                <h1 class="font-be-vietnam text-xs font-medium text-center text-[#272727]/70">Don’t worries, we’ll send you reset instruction</h1>
                <div class="md:px-20 px-5 py-10">
                    <div class="mb-4">
                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Email or Username</h1>
                        <div class="relative">
                            <input type="email"
                                class="bg-white border border-[#5C7AEA] px-[18px] pl-10 py-3 w-full text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                placeholder="Username@gmail.com">
                            <div class="absolute top-2 left-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 10C14.2091 10 16 8.20914 16 6C16 3.79086 14.2091 2 12 2C9.79086 2 8 3.79086 8 6C8 8.20914 9.79086 10 12 10Z"
                                        stroke="#3754C1" stroke-width="1.5" />
                                    <path
                                        d="M20 17.5C20 19.985 20 22 12 22C4 22 4 19.985 4 17.5C4 15.015 7.582 13 12 13C16.418 13 20 15.015 20 17.5Z"
                                        stroke="#3754C1" stroke-width="1.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    {{-- Munciul ketika email tidak terdaftar --}}
                    {{-- <div class="px-4 py-[14px] bg-[#FDFCDCB2]/70 rounded-[9px] flex items-center gap-4 mb-7">
                        <div class="">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 7V13M12 17.01L12.01 16.999M12 22C17.523 22 22 17.523 22 12C22 6.477 17.523 2 12 2C6.477 2 2 6.477 2 12C2 17.523 6.477 22 12 22Z"
                                    stroke="#3754C1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h1 class="font-be-vietnam text-[10px] font-medium text-[#272727]/70">We can’t seem to find the right email address for you, resend the email that you have registered</h1>
                    </div> --}}
                    <button
                        class="text-white bg-[#5C7AEA] hover:bg-blue-700 transition-colors duration-300 font-semibold text-base py-4 text-center w-full rounded-full button-shadow mb-5">
                        Next
                    </button>
                    <div class="flex justify-center">
                        <a onclick="showLoading(event)" href="/login-user"
                            class="font-be-vietnam text-base text-[#3754C1] hover:text-blue-700 transition-colors duration-300 font-medium  w-max">Back
                            to Sign In</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block absolute top-40 left-20">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_uuzf4huo.json" background="transparent"
                speed="1.5" style="width: 286px; height: 286px;" loop autoplay></lottie-player>
        </div>
        <div class="hidden lg:block absolute bottom-20 left-10">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_uuzf4huo.json" background="transparent"
                speed="1.5" style="width: 286px; height: 286px;" loop autoplay></lottie-player>
        </div>
        <div class="hidden lg:block absolute top-40 right-20">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_uuzf4huo.json" background="transparent"
                speed="1.5" style="width: 286px; height: 286px;" loop autoplay></lottie-player>
        </div>
        <div class="hidden lg:block absolute bottom-10 right-40">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_uuzf4huo.json" background="transparent"
                speed="1.5" style="width: 286px; height: 286px;" loop autoplay></lottie-player>
        </div>
    </div>
@endsection
