@extends('layouts.remaja.auth-remaja.app')

@section('title', __('Change Password'))

@section('content')
    <div class="relative bg h-auto">
        <div class="flex flex-col justify-center items-center py-28">
            <img src="../img/logo/logo-menjadi.svg" alt="" class="mb-9">
            <div class="rounded-[24px] bg-white/40 py-[22px] w-[522px] box-shadow">
                <h1 class="font-be-vietnam text-[32px] font-semibold text-center mb-1.5 text-black">Code Verification</h1>
                <h1 class="font-be-vietnam text-xs font-medium text-center text-[#272727]/70">Enter your verification code that we have sent via email</h1>
                <h1 id="maskedEmail" class="font-be-vietnam text-xs font-medium text-center text-[#272727]/70">iqbal@gmail.com</h1>
                <div class="px-20 py-10">
                    <div class="mb-7">
                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Code OTP</h1>
                        <div class="relative mb-3">
                            <input type="text"
                                class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs upercase">
                        </div>
                        <div class="flex justify-between">
                            <div class="flex gap-1 items-center">
                                <h1 class="font-be-vietnam text-xs text-[#272727] font-medium">Time :</h1>
                                <div class="countdown font-be-vietnam text-xs text-[#272727] font-medium" id="countdown"></div>
                            </div>
                            <button class="font-be-vietnam text-xs resendButton cursor-not-allowed text-[#808080]" disabled>Resend Code</button>
                        </div>
                    </div>
                    <button
                        class="text-white bg-[#5C7AEA] hover:bg-blue-700 transition-colors duration-300 font-semibold text-base py-4 text-center w-full rounded-full button-shadow mb-5">
                        Reset
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
@push('js')
<script>
    // Menghitung mundur dari menit ke detik
    function countdown(minutes) {
        let seconds = minutes * 60;

        const countdownElement = document.getElementById('countdown');
        const resendButtons = document.getElementsByClassName('resendButton');

        const countdownInterval = setInterval(() => {
            const displayMinutes = Math.floor(seconds / 60);
            const displaySeconds = seconds % 60;

            countdownElement.textContent = displayMinutes.toString().padStart(2, '0') + ':' + displaySeconds.toString().padStart(2, '0');

            if (seconds <= 0) {
                clearInterval(countdownInterval);
                countdownElement.textContent = '00:00';

                // Mengaktifkan kembali tombol "Resend Code"
                for (let i = 0; i < resendButtons.length; i++) {
                    resendButtons[i].disabled = false;
                    resendButtons[i].classList.remove('cursor-not-allowed', 'text-[#808080]');
                    resendButtons[i].classList.add('cursor-pointer', 'text-[#3754C1]');
                }
            } else {
                seconds--;

                // Menonaktifkan tombol "Resend Code"
                for (let i = 0; i < resendButtons.length; i++) {
                    resendButtons[i].disabled = true;
                    resendButtons[i].classList.remove('cursor-pointer', 'text-[#3754C1]');
                    resendButtons[i].classList.add('cursor-not-allowed', 'text-[#808080]');
                }
            }
        }, 1000);
    }
    countdown(1);
</script>
<script>
    const email = "iqbal@gmail.com";
    const maskedEmail = maskEmail(email);
    const maskedEmailElement = document.getElementById('maskedEmail');
    maskedEmailElement.textContent = maskedEmail;
  
    function maskEmail(email) {
      const parts = email.split("@");
      const username = parts[0];
      const domain = parts[1];
  
      const maskedUsername = maskUsername(username);
  
      return maskedUsername + "@" + domain;
    }
  
    function maskUsername(username) {
      const maskedPart = username.substring(0, 2) + "***";
      return maskedPart;
    }
  </script>
@endpush