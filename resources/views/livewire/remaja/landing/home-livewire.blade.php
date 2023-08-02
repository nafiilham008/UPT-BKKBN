<div>
    <div id="app" class="py-16"
        style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 100%);">
        <div class="relative">
            <div class="flex justify-between px-[78px] items-center mb-24">
                <a href="{{ route('user.list') }}" data-href="{{ route('user.list') }}" onclick="showLoading(event)"
                    class="flex gap-4 text-base text-[#272727] items-center font-medium">
                    <div>
                        <img src="{{ asset('img/remaja/assets/back-button.svg') }}" alt="">
                    </div>
                    Back to game list
                </a>
                <div class="">
                    <img src="{{ asset('img/remaja/logo/logo.svg') }}" alt="">
                </div>
            </div>
            <div class="">
                <h1 class="font-titan text-[40px] text-center text-[#272727]/70 mb-5">Let's Start The Game</h1>
                <h1 class="font-be-vietnam text-base text-center text-[#272727]/70 mb-12">Seberapa jauh kamu tau?
                    Ayo
                    mulai
                    main dan pastiin jawabanmu bener ya, Lest’s Play</h1>
                <div class="px-[185px]">
                    <div class="rounded-[24px] flex flex-col justify-between min-h-[600px] bg-white/40"
                        style="box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                        @if ($step === 0)
                            <div class="px-44 pt-10">
                                <div id="player" data-plyr-provider="youtube"
                                    data-plyr-embed-id="{{ $url }}"
                                    data-plyr-config='{"youtube": {"noCookie": true}}'></div>
                            </div>
                        @else
                            <div></div>
                        @endif
                        @if (!$currentQuestion)
                            <p>Anda telah menyelesaikan semua soal!</p>
                        @else
                            @if ($step !== 0)
                                <p>Question {{ $step }}</p>
                                <div class="px-44">
                                    <h1 class="font-be-vietnam text-base text-[#272727]/70 text-center">
                                        {{ $currentQuestion->question }}</h1>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        @if ($currentQuestion->image)
                                            <div class="w-[162px] h-[144px] flex justify-center items-center bg-white rounded-[30px] flex-shrink-0 border border-[#616161]"
                                                style="box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                                                <img src="{{ asset('storage/' . $currentQuestion->image) }}"
                                                    alt="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex justify-center items-center gap-5 mt-6">
                                        @foreach (json_decode($currentQuestion->options, true) as $option)
                                            <label>
                                                <input type="radio" name="answer[{{ $currentQuestion->id }}]"
                                                    class="hidden" wire:model="input.{{ $currentQuestion->id }}"
                                                    value="{{ $option['value'] }}"
                                                    @if (isset($input[$currentQuestion->id]) && $input[$currentQuestion->id] === $option['value']) checked @endif>
                                                <div
                                                    class="custom-radio bg-[#FAEBBE] w-[129px] h-[52px] flex justify-center items-center rounded-[12px] text-black font-be-vietnam">

                                                    {{ $option['value'] }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endif


                            <div
                                class="py-8 px-12 @if ($step !== 0) flex justify-between @else flex justify-end @endif">
                                <!-- Stepper and Buttons -->
                                @if ($step !== 0)
                                    <button wire:click="previousQuestion"
                                        class="flex gap-4 text-base text-[#272727] items-center font-medium">
                                        <div>
                                            <img src="{{ asset('img/remaja/assets/back-button.svg') }}" class="w-8 h-8"
                                                alt="">
                                        </div>
                                        Sebelumnya
                                    </button>
                                @endif
                                @if ($step == $totalQuestions)
                                    <button wire:click="submitAnswers"
                                        class="flex gap-4 text-base text-[#272727] items-center font-medium"
                                        @if (!isset($input[$currentQuestion->id])) disabled @endif>
                                        Selesai
                                    </button>
                                @else
                                    @if ($step !== 0)
                                        <button wire:click="nextQuestion"
                                            class="flex gap-4 text-base text-[#272727] items-center font-medium"
                                            @if (!isset($input[$currentQuestion->id])) disabled @endif>
                                            Selanjutnya
                                            <div>
                                                <img src="{{ asset('img/remaja/assets/next-button.svg') }}"
                                                    class="w-8 h-8" alt="">
                                            </div>
                                        </button>
                                    @else
                                        <button wire:click="nextQuestion"
                                            class="flex gap-4 text-base text-[#272727] items-center font-medium">
                                            Selanjutnya
                                            <div>
                                                <img src="{{ asset('img/remaja/assets/next-button.svg') }}"
                                                    class="w-8 h-8" alt="">
                                            </div>
                                        </button>
                                    @endif
                                @endif
                            </div>
                        @endif
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

@push('js')
    @livewireScripts
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script>
        const player = new Plyr('#player');
    </script>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('saveAnswer', (questionId, answer) => {
                let userAnswers = JSON.parse(localStorage.getItem('user_answers')) || {};
                userAnswers[questionId] = answer;
                console.log(questionId);
                localStorage.setItem('user_answers', JSON.stringify(userAnswers));
            });

            if (localStorage.getItem('user_answers')) {
                let userAnswers = JSON.parse(localStorage.getItem('user_answers'));
                Livewire.emit('loadAnswers', Object.entries(userAnswers));
            }

            Livewire.on('reset', () => {
                localStorage.removeItem('user_answers');
            });
        });
    </script>
@endpush
@push('css')
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

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

        .custom-radio:checked {
            background-color: #FFBF00;
        }
    </style>
@endpush
