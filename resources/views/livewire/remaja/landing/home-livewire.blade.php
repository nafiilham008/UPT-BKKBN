<div>
    <div id="app" class="lg:py-16 py-5"
        style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 100%);">
        <div class="relative">
            <div
                class="flex flex-col-reverse lg:flex-row lg:justify-between px-5 lg:px-[78px] lg:items-center mb-10 lg:mb-24">
                <a href="{{ route('user.list') }}" data-href="{{ route('user.list') }}" onclick="showLoading(event)"
                    class="flex gap-4 text-base text-[#272727] items-center font-medium">
                    <div>
                        <img src="{{ asset('img/remaja/assets/back-button.svg') }}" alt="">
                    </div>
                    Back to game list
                </a>
                <div class="flex lg:flex-none justify-center mb-10 lg:mb-0">
                    <img src="{{ asset('img/remaja/logo/logo.svg') }}" alt="">
                </div>
            </div>
            <div class="">
                <div class="px-5 lg:px-0">
                    <h1 class="font-titan text-[40px] text-center text-[#272727]/70 mb-5">Let's Start The Game</h1>
                    <h1 class="font-be-vietnam text-base text-center text-[#272727]/70 mb-12">Seberapa jauh kamu tau?Ayo
                        mulai main dan pastiin jawabanmu bener ya, Lest’s Play</h1>
                </div>

                <div class=" px-5 lg:px-[185px]">
                    <div class="rounded-[24px] flex flex-col justify-between lg:min-h-[600px] bg-white/40"
                        style="box-shadow: 0px 1px 14px 0px rgba(133, 145, 255, 0.30); backdrop-filter: blur(35px);">
                        <div class="px-5 lg:px-44 pt-10 {{ $step === 0 ? '' : 'd-none' }}">
                            @if ($step === 0)
                                @if (!empty($url))
                                    @if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false)
                                        <div class="plyr__video-embed" id="player{{ $step }}"
                                            style="position: relative;">
                                            <iframe src="{{ $url }}" frameborder="0" allowfullscreen
                                                allowtransparency allow="autoplay"
                                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                        </div>
                                    @elseif (strpos($url, 'drive.google.com') !== false)
                                        <iframe src="{{ $url }}" style="width:600px; height:500px;"
                                            frameborder="0">
                                        </iframe>
                                    @else
                                        <h3>Materi Error</h3>
                                    @endif

                                @endif
                            @endif

                        </div>

                        @if (!$currentQuestion)
                            <h1>Anda telah menyelesaikan semua soal!</h1>
                        @else
                            @if ($step !== 0)
                                <div class="lg:px-44 text-center mb-10 px-5">
                                    <p>Soal {{ $step }}</p>
                                </div>
                                <div class="lg:px-44 px-5">
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
                                            @if (count(array_filter(json_decode($currentQuestion->options, true), function ($opt) {
                                                        return $opt['is_correct'] == '1';
                                                    })) > 1)
                                                <!-- Keterangan untuk multiple choice -->
                                                @if ($loop->first)
                                                    <p>Silahkan pilih jawaban yang menurut Anda benar, dapat lebih dari
                                                        satu pilihan.
                                                    </p>
                                                @endif

                                                <!-- Checkbox untuk multiple choice -->
                                                <label>
                                                    <input type="checkbox"
                                                        name="answer[{{ $currentQuestion->id }}][{{ $option['value'] }}]"
                                                        wire:model="input.{{ $currentQuestion->id }}.{{ $option['value'] }}"
                                                        value="{{ $option['value'] }}"
                                                        @if (isset($input[$currentQuestion->id]) &&
                                                                isset($input[$currentQuestion->id][$option['value']]) &&
                                                                $input[$currentQuestion->id][$option['value']] === $option['value']
                                                        ) checked @endif>

                                                    {{ $option['value'] }}
                                                </label>
                                            @else
                                                <!-- Keterangan untuk single choice -->
                                                @if ($loop->first)
                                                    <p>Silahkan pilih satu jawaban yang menurut Anda benar.</p>
                                                @endif

                                                <!-- Radio untuk single choice -->
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
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            @endif


                            <div
                                class="py-8 px-5 lg:px-12 @if ($step !== 0) flex justify-between @else flex justify-end @endif">
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
            <div class="lg:block hidden absolute top-[50%] left-16">
                <img src="{{ asset('img/remaja/assets/board.svg') }}" alt="">
            </div>
            <div class="lg:block hidden absolute top-[75%] right-16">
                <img src="{{ asset('img/remaja/assets/pallete.svg') }}" alt="">
            </div>
        </div>
    </div>


</div>

@push('js')
    @livewireScripts
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    @if ($step === 0)
        <script>
            const player = new Plyr('#player{{ $step }}');
        </script>
    @endif
    {{-- @if ($step === 0)
        <script>
            const player{{ $step }} = new Plyr('#player{{ $step }}');
        </script>
    @endif --}}

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

    <script>
        function toggleCheckbox(checkboxElem) {
            if (checkboxElem.checked) {
                const allCheckboxes = document.querySelectorAll(`input[name="${checkboxElem.name}"]`);
                allCheckboxes.forEach(cb => {
                    if (cb !== checkboxElem) {
                        cb.checked = false;
                    }
                });
            }
        }
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

        input[type="radio"]:checked+.custom-radio {
            background-color: #FFBF00;
        }
    </style>
@endpush
