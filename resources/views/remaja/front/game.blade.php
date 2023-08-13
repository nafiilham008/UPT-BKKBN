@extends('layouts.remaja.front.app')

@section('title', __('game'))

@section('content')
    {{-- <div>
        <div x-data="app()" x-init="initializeStep()" x-cloak id="app" class="py-16"
            style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 100%);">
            <div class="relative">
                <div class="flex justify-between px-[78px] items-center mb-24">
                    <a href="/list-game" onclick="showLoading(event)"
                        class="flex gap-4 text-base text-[#272727] items-center font-medium">
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
                            @foreach ($question as $key => $item)
                                <div x-show.transition.in="step === {{ $key + 1 }}">
                                    <div class="px-44">
                                        <h1 class="font-be-vietnam text-base text-[#272727]/70 text-center">
                                            {{ $item->question }}</h1>
                                        <div class="flex justify-center items-center gap-5 mt-6">
                                            @if ($item->image)
                                                <div class="w-[162px] h-[144px] flex justify-center items-center bg-white rounded-[30px] flex-shrink-0 border border-[#616161]"
                                                    style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex justify-center items-center gap-5 mt-6">
                                            <label>
                                                <input type="radio" name="option" class="hidden"
                                                    @change="handleOptionChange(true)" :checked="isOptionChecked(true)" />
                                                <div
                                                    class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                    Benar
                                                </div>
                                            </label>
                                            <label>
                                                <input type="radio" name="option" class="hidden"
                                                    @change="handleOptionChange(false)" :checked="isOptionChecked(false)" />
                                                <div
                                                    class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">
                                                    Salah
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div
                                :class="{
                                    'py-8 px-12 flex justify-between': step !== 1,
                                    'py-8 px-12 flex justify-end': step ===
                                        1
                                }">
                                <!-- Tombol Next akan muncul hanya jika ada opsi yang dipilih -->
                                <button x-show="step > 1 && step < totalSteps && isOptionChecked()" @click="nextStep"
                                    class="flex gap-4 text-base text-[#272727] items-center font-medium">
                                    Next
                                    <div>
                                        <img src="../img/remaja/assets/next-button.svg" class="w-8 h-8" alt="">
                                    </div>
                                </button>
                                <!-- Tombol Back akan muncul selain jika kita berada di stepper pertama -->
                                <button x-show="step > 1" @click="prevStep"
                                    class="flex gap-4 text-base text-[#272727] items-center font-medium">
                                    <div>
                                        <img src="../img/remaja/assets/back-button.svg" class="w-8 h-8" alt="">
                                    </div>
                                    Back
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
    </div> --}}
    <livewire:remaja.landing.home-livewire :dataQuestion="$question" />
@endsection

