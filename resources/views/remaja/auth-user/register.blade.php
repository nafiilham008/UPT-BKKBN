@extends('layouts.remaja.auth-remaja.app')

@section('title', __('Register'))

@section('content')
    <div class="relative bg h-auto">
        <div class="flex flex-col justify-center h-full items-center py-28">
            <img src="../img/logo/logo-menjadi.svg" alt="" class="mb-9">

            <div class="rounded-[24px] bg-white/40 py-[22px]     box-shadow">
                <h1 class="font-be-vietnam text-[32px] font-semibold text-center mb-1.5 text-black">Create an Account </h1>
                <h1 class="font-be-vietnam text-xs font-medium text-center text-[#272727B2]/70">Fill in all available fields,
                    make sure you fill in the data below correctly</h1>
                <div class="px-20 py-10 w-full">
                    <div class="flex mb-4 gap-4 items-center">
                        <div class="w-full">
                            <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Full Name</h1>
                            <div class="relative ">
                                <input type="text"
                                    class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                    placeholder="example: Muhammad Iqbal Ainu Rafie">

                            </div>
                        </div>
                        <div class="w-full">
                            <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Email</h1>
                            <div class="relative">
                                <input type="email"
                                    class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                    placeholder="example: ainurafie@gmail.com">
                            </div>
                        </div>
                    </div>
                    <div class="flex mb-4 gap-4 items-center">
                        <div class="w-full">
                            <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Date of Birth</h1>
                            <div class="relative">
                                <input type="date"
                                    class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs">

                            </div>
                        </div>
                        <div class="w-full">
                            <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Gender</h1>
                            <div class="relative">
                                <select
                                    class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                    style="appearance: left;">
                                    <option disabled>Choose Gender</option>
                                    <option>Men</option>
                                    <option>Woman</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex mb-4 gap-4 items-center">
                        <div class="w-full">
                            <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Password</h1>
                            <div class="relative">
                                <input type="password"
                                    class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-full text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="w-full">
                            <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Confirm Password</h1>
                            <div class="relative">
                                <input type="password"
                                    class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-full text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                    placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full px-16 gap-4 items-center mb-4">
                        <hr class="h-[0.5px] w-full border-[#5C7AEA] border">
                        <h1 class="font-be-vietnam text-xs text-black">Or</h1>
                        <hr class="h-[0.5px] w-full border-[#5C7AEA] border">
                    </div>
                    <div class="mb-4 flex justify-center">
                        <button
                            class="button flex hover:bg-gray-200 transition-colors duration-300 items-center gap-1 font-poppins font-be-vietnam text-xs bg-white w-96 text-center rounded-full justify-center py-2 text-[#272727] ">
                            <iconify-icon icon="flat-color-icons:google" width="26" height="26">
                            </iconify-icon>
                            Sign In with Google
                        </button>
                    </div>
                    <div class="flex justify-center gap-1 mb-10">
                        <h1 class="font-be-vietnam text-xs text-[#272727]">Already have an account?</h1>
                        <a href="/login-user"
                            class="font-be-vietnam text-xs text-[#3754C1] hover:text-blue-700 transition-colors duration-300 font-semibold">Sign
                            In</a>
                    </div>
                    <div class="mb-4 flex justify-center">
                        <button
                            class="text-white bg-[#5C7AEA] hover:bg-blue-700 transition-colors duration-300 font-semibold text-base py-4 text-center w-96 text-center rounded-full button-shadow">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-40 left-20">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_uuzf4huo.json" background="transparent"
                speed="1.5" style="width: 286px; height: 286px;" loop autoplay></lottie-player>
        </div>
        <div class="absolute bottom-20 left-10">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_uuzf4huo.json" background="transparent"
                speed="1.5" style="width: 286px; height: 286px;" loop autoplay></lottie-player>
        </div>
        <div class="absolute top-40 right-20">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_uuzf4huo.json" background="transparent"
                speed="1.5" style="width: 286px; height: 286px;" loop autoplay></lottie-player>
        </div>
        <div class="absolute bottom-10 right-40">
            <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_uuzf4huo.json" background="transparent"
                speed="1.5" style="width: 286px; height: 286px;" loop autoplay></lottie-player>
        </div>
    </div>
@endsection
