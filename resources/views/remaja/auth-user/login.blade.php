@extends('layouts.remaja.auth-remaja.app')

@section('title', __('Login'))

@section('content')
    <div class="relative bg h-auto">
        <div class="flex flex-col justify-center items-center py-28">
            <img src="../img/logo/logo-menjadi.svg" alt="" class="mb-9">
            <div class="rounded-[24px] bg-white/40 py-[22px] w-[522px] box-shadow">
                <h1 class="font-be-vietnam text-[32px] font-semibold text-center mb-1.5 text-black">Login</h1>
                <h1 class="font-be-vietnam text-xs font-medium text-center text-[#272727B2]/70">Enter your username and
                    password correctly</h1>
                <div class="px-20 py-10">
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
                    <div class="mb-3">
                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Password</h1>
                        <div class="relative">
                            <input type="password"
                                class="bg-white border border-[#5C7AEA] px-[18px] pl-10 py-3 w-full text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                placeholder="Password">
                            <div class="absolute top-2 left-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.25 8.303V7C5.25 5.20979 5.96116 3.4929 7.22703 2.22703C8.4929 0.961159 10.2098 0.25 12 0.25C13.7902 0.25 15.5071 0.961159 16.773 2.22703C18.0388 3.4929 18.75 5.20979 18.75 7V8.303C18.977 8.319 19.19 8.339 19.392 8.367C20.292 8.487 21.05 8.747 21.652 9.348C22.254 9.95 22.512 10.708 22.634 11.608C22.75 12.475 22.75 13.578 22.75 14.945V15.055C22.75 16.422 22.75 17.525 22.634 18.392C22.512 19.292 22.254 20.05 21.652 20.652C21.05 21.254 20.292 21.512 19.392 21.634C18.525 21.75 17.422 21.75 16.055 21.75H7.945C6.578 21.75 5.475 21.75 4.608 21.634C3.708 21.512 2.95 21.254 2.348 20.652C1.746 20.05 1.488 19.292 1.367 18.392C1.25 17.525 1.25 16.422 1.25 15.055V14.945C1.25 13.578 1.25 12.475 1.367 11.608C1.487 10.708 1.747 9.95 2.348 9.348C2.95 8.746 3.708 8.488 4.608 8.367C4.82122 8.33844 5.03534 8.3171 5.25 8.303ZM6.75 7C6.75 5.60761 7.30312 4.27225 8.28769 3.28769C9.27225 2.30312 10.6076 1.75 12 1.75C13.3924 1.75 14.7277 2.30312 15.7123 3.28769C16.6969 4.27225 17.25 5.60761 17.25 7V8.253C16.877 8.25 16.478 8.25 16.055 8.25H7.945C7.522 8.25 7.124 8.25 6.75 8.253V7ZM3.409 10.409C3.686 10.132 4.074 9.952 4.809 9.853C5.563 9.752 6.565 9.75 8 9.75H16C17.435 9.75 18.436 9.752 19.192 9.853C19.926 9.952 20.314 10.133 20.591 10.409C20.868 10.686 21.048 11.074 21.147 11.809C21.248 12.564 21.25 13.565 21.25 15C21.25 16.435 21.248 17.436 21.147 18.192C21.048 18.926 20.867 19.314 20.591 19.591C20.314 19.868 19.926 20.048 19.191 20.147C18.436 20.248 17.435 20.25 16 20.25H8C6.565 20.25 5.563 20.248 4.808 20.147C4.074 20.048 3.686 19.867 3.409 19.591C3.132 19.314 2.952 18.926 2.853 18.191C2.752 17.436 2.75 16.435 2.75 15C2.75 13.565 2.752 12.563 2.853 11.808C2.952 11.074 3.133 10.686 3.409 10.409Z"
                                        fill="#3754C1" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mb-4">
                        <div class="flex gap-3 items-center">
                            <input type="checkbox" id="pengantaranSelesai" name="selected[]"
                                class="form-checkbox h-5 w-5 text-[#BA2B60] rounded">
                            <label for="pengantaranSelesai" class="cursor-pointer text-xs text-black">Save
                                Remember me</label>
                        </div>
                        <a href=""
                            class="font-be-vietnam text-xs text-[#3754C1] hover:text-blue-700 transition-colors duration-300">Forgot
                            Password ?</a>
                    </div>
                    <div class="flex w-full px-16 gap-4 items-center mb-4">
                        <hr class="h-[0.5px] w-full border-[#5C7AEA] border">
                        <h1 class="font-be-vietnam text-xs text-black">Or</h1>
                        <hr class="h-[0.5px] w-full border-[#5C7AEA] border">
                    </div>
                    <div class="mb-4">
                        <button
                            class="button flex hover:bg-gray-200 transition-colors duration-300 items-center gap-1 font-poppins font-be-vietnam text-xs bg-white w-full rounded-full justify-center py-2 text-[#272727] ">
                            <iconify-icon icon="flat-color-icons:google" width="26" height="26">
                            </iconify-icon>
                            Sign In with Google
                        </button>
                    </div>
                   <div class="flex justify-center gap-1 mb-10">
                        <h1 class="font-be-vietnam text-xs text-[#272727]">Don’t have an account?</h1>
                        <a href="/register-user"
                            class="font-be-vietnam text-xs text-[#3754C1] hover:text-blue-700 transition-colors duration-300 font-semibold">Sign
                            Up</a>
                    </div>
                    <button
                        class="text-white bg-[#5C7AEA] hover:bg-blue-700 transition-colors duration-300 font-semibold text-base py-4 text-center w-full rounded-full button-shadow">
                        Sign In
                    </button>
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
