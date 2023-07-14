@extends('layouts.remaja.front.app')

@section('title', __('game'))

@section('content')
    <div>
        <div x-data="app()" x-init="initializeStep()" x-cloak id="app" class="py-16"
            style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 100%);">
            <div class="relative">
                <div class="flex justify-between px-[78px] items-center mb-24">
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
                <div class="">
                    <h1 class="font-titan text-[40px] text-center text-[#272727]/70 mb-5">Let's Start The Game</h1>
                    <h1 class="font-be-vietnam text-base text-center text-[#272727]/70 mb-12">Seberapa jauh kamu tau? Ayo
                        mulai
                        main dan pastiin jawabanmu bener ya, Lest’s Play</h1>
                    <div class="px-[185px]">
                        <div class="rounded-[24px] flex flex-col justify-between min-h-[600px] bg-white/40"
                            style="box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                            <div></div>
                            <div x-show.transition.in="step === 1">
                                <div class="outer">
                                    <div class="tcell">
                                        <div class="curtain-wrapper">
                                            <div class="curtain-ratio-keeper">
                                                <div class="curtain">

                                                    <div class="video video-frame "></div>
                                                    <iframe width="100%" height="100%"
                                                        src="//www.youtube.com/embed/56a8EjWTWLg" frameborder="0"
                                                        allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 2">
                                <div class="px-44">
                                    <h1 class="font-be-vietnam text-base text-[#272727]/70 text-center">Lorem ipsum dolor
                                        sit amet consectetur. Enim vestibulum faucibus non mattis urna commodo enim. Varius
                                        purus nulla in fermentum.</h1>
                                        {{-- image --}}
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <div class="w-[162px] h-[144px] flex justify-center items-center bg-white rounded-[30px] flex-shrink-0 border border-[#616161]"
                                            style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                            <img src="../img/remaja/assets/soal 1.svg" alt="">
                                        </div>
                                        <div class="w-[162px] h-[144px] flex justify-center items-center bg-white rounded-[30px] flex-shrink-0 border border-[#616161]"
                                            style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                            <img src="../img/remaja/assets/soal 2.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Benar
                                            </div>
                                        </label>
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Salah
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 3">
                                <div class="px-44">
                                    <h1 class="font-be-vietnam text-base text-[#272727]/70 text-center">Lorem ipsum dolor
                                        sit amet consectetur. Enim vestibulum faucibus non mattis urna commodo enim. Varius
                                        purus nulla in fermentum.</h1>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Benar
                                            </div>
                                        </label>
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Salah
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 4">
                                <div class="px-44">
                                    <h1 class="font-be-vietnam text-base text-[#272727]/70 text-center">Lorem ipsum dolor
                                        sit amet consectetur. Enim vestibulum faucibus non mattis urna commodo enim. Varius
                                        purus nulla in fermentum.</h1>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <div class="w-[162px] h-[144px] flex justify-center items-center bg-white rounded-[30px] flex-shrink-0 border border-[#616161]"
                                            style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                            <img src="" alt="">
                                        </div>
                                        <div class="w-[162px] h-[144px] flex justify-center items-center bg-white rounded-[30px] flex-shrink-0 border border-[#616161]"
                                            style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                            <img src="" alt="">
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Benar
                                            </div>
                                        </label>
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Salah
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 5">
                                <div class="px-44">
                                    <h1 class="font-be-vietnam text-base text-[#272727]/70 text-center">Lorem ipsum dolor
                                        sit amet consectetur. Enim vestibulum faucibus non mattis urna commodo enim. Varius
                                        purus nulla in fermentum.</h1>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <div class="w-[162px] h-[144px] flex justify-center items-center bg-white rounded-[30px] flex-shrink-0 border border-[#616161]"
                                            style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                            <img src="../img/remaja/assets/soal 1.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Benar
                                            </div>
                                        </label>
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Salah
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 6">
                                <div class="px-44">
                                    <h1 class="font-be-vietnam text-base text-[#272727]/70 text-center">Lorem ipsum dolor
                                        sit amet consectetur. Enim vestibulum faucibus non mattis urna commodo enim. Varius
                                        purus nulla in fermentum.</h1>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <div class="w-[162px] h-[144px] flex justify-center items-center bg-white rounded-[30px] flex-shrink-0 border border-[#616161]"
                                            style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                            <img src="../img/remaja/assets/soal 2.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Benar
                                            </div>
                                        </label>
                                        <label>
                                            <input type="radio" name="option" class="hidden" />
                                            <div
                                                class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                Salah
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 7">
                                <div class="px-44">
                                    <h1 class="font-be-vietnam text-base text-[#272727]/70 text-center">Good job <label
                                            class="font-bold">(nama
                                            user)</label>, kamu sudah menjawab semua ayo liat skor kamu berapa.</h1>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        <a href="/nilai"
                                            class="hover:bg-[#E1D8A9] transition-colors duration-300 bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam"
                                            @click="resetStep">
                                            View Score
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div
                                :class="{
                                    'py-8 px-12 flex justify-between': step !== 1,
                                    'py-8 px-12 flex justify-end': step ===
                                        1
                                }">
                                <button x-show="step > 1 && step < 7" @click="prevStep"
                                    class="flex gap-4 text-base text-[#272727] items-center font-medium">
                                    <div>
                                        <img src="../img/remaja/assets/back-button.svg" class="w-8 h-8" alt="">
                                    </div>
                                    Back
                                </button>
                                <button x-show="step < 7" @click="nextStep"
                                    class="flex gap-4 text-base text-[#272727] items-center font-medium">
                                    Next
                                    <div>
                                        <img src="../img/remaja/assets/next-button.svg" class="w-8 h-8" alt="">
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute top-[50%] left-16">
                    <img src="../img/remaja/assets/board.svg" alt="">
                </div>
                <div class="absolute top-[75%] right-16">
                    <img src="../img/remaja/assets/pallete.svg" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script>
    <script>
        window.app = function() {
            return {
                step: 1,
                initializeStep() {
                    const storedStep = localStorage.getItem('currentStep');
                    if (storedStep) {
                        this.step = parseInt(storedStep);
                    }
                },
                prevStep() {
                    if (this.step > 1) {
                        this.step--;
                        this.updateLocalStorage();
                    }
                },
                nextStep() {
                    if (this.step < 7) {
                        this.step++;
                        this.updateLocalStorage();
                    }
                },
                updateLocalStorage() {
                    localStorage.setItem('currentStep', this.step.toString());
                },
                resetStep() {
                    this.step = 1;
                    this.updateLocalStorage();
                }
            };
        };
    </script>

    <script>
        const radioButtons = document.querySelectorAll('input[type="radio"]');

        radioButtons.forEach((radio) => {
            radio.addEventListener('change', (event) => {
                const selectedRadio = event.target;
                const radioDiv = selectedRadio.nextElementSibling;

                // Hapus kelas "checked" dari semua tombol radio
                radioButtons.forEach((radio) => {
                    radio.nextElementSibling.classList.remove('checked');
                });

                // Tambahkan kelas "checked" pada tombol radio yang dipilih
                radioDiv.classList.add('checked');
            });
        });
    </script>
@endpush
@push('css')
    <style>
        .outer {
            display: table;
            height: 100%;
            margin: 0 auto;
            width: 100%;
            overflow: hidden;
        }

        .tcell {
            display: table-cell;
            vertical-align: middle;
            padding: 8px 8px;
        }

        .curtain-wrapper {
            min-width: 40%;
            max-width: 511px;
            margin: auto;
            border: 15px solid transparent;
            border-radius: 12px;
            background: #333;
            background: linear-gradient(to bottom right, gray, black), url("https://i.imgur.com/pwdit9N.png"), linear-gradient(to bottom right, #eee, #ccc);
            background-origin: padding-box, border-box, border-box;
            background-clip: padding-box, border-box, border-box;
            box-shadow: 1px 1px 3px black inset, 0 -1px white, 0 -1px 0 1px #bbb, 0 2px 0 1px #aaa, 0 2px 10px 1px rgb(0 0 0 / 20%);
            overflow: hidden;
        }

        .curtain-ratio-keeper {
            position: relative;
            padding-top: 56.25%;
        }

        .curtain {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: #333;
        }

        .video-frame {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <style>
        .custom-radio {
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .custom-radio.checked {
            background-color: #FFBF00;
        }
    </style>
@endpush
