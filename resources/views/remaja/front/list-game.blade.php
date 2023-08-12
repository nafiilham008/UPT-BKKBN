@extends('layouts.remaja.front.app')

@section('title', __('List Game'))

@section('content')
    <div>
        <div class="" style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 100%);">
            @include('layouts.remaja.component.navbar')
            <div
                class="flex lg:flex-row flex-col gap-8 items-end lg:items-center mb-16 lg:py-[135px] py-12 lg:px-[186px] px-5">
                <div class="flex items-center" style="box-shadow: 2px 4px 17px 0px rgba(189, 179, 252, 0.25);">
                    <div class="rounded-l-[12px] bg-[#5C7AEA] lg:px-9 px-4 py-4">
                        <h1 class="text-white font-be-vietnam font-semibold text-base">Kategori</h1>
                    </div>
                    <div class="relative h-full">
                        <div class="select-wrapper">
                            <select name="" id="kategori-select"
                                class="lg:w-[265px] w-[150px] text-center font-be-vietnam cursor-pointer pr-10 pl-3 py-4 font-medium border border-[#3754C1] text-black text-sm rounded-r-[12px] appearance-none">
                                <option value="" selected disabled>Pilih Kategori</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            <img src="{{ asset('img/remaja/assets/arrow-down.svg') }}" alt="" class="arrow-icon">
                        </div>
                    </div>

                </div>
                <div class="">
                    <form>
                        <label for="default-search" class="mb-2 text-sm font-medium text-black sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <img src="{{ asset('img/remaja/assets/icon-search.svg') }}" alt="" class="">
                            </div>
                            <input type="search" id="default-search"
                                class="block w-56 md:w-96 p-4 pr-10 text-sm font-be-vietnam text-black border border-[#3754C1] rounded-[12px] bg-white focus:ring-blue-500 focus:border-blue-500 placeholder:text-[#272727]/40"
                                placeholder="Search" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="lg:grid lg:grid-cols-3 lg:space-y-0 space-y-10  lg:gap-7 px-5 lg:px-[186px]">
                @foreach ($quiz as $quizItem)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-[24px]" data-category="{{ $quizItem->category_quiz->id }}"
                        style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                        <a href="{{ route('user.detail.game', $quizItem->slug_url) }}"
                            data-href="{{ route('user.detail.game', $quizItem->slug_url) }}" onclick="showLoading(event)">
                            <img class="rounded-t-[24px] w-full h-52" src="{{ asset('storage/' . $quizItem->image) }}"
                                alt="" />
                        </a>
                        <div class="p-5">
                            <a href="{{ route('user.detail.game', $quizItem->slug_url) }}"
                                data-href="{{ route('user.detail.game', $quizItem->slug_url) }}"
                                onclick="showLoading(event)">
                                <h5 class="mb-2 text-[28px] font-be-vietnam font-semibold tracking-tight text-[#272727]">
                                    {{ $quizItem->title }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-[#272727] text-sm">{{ $quizItem->description }}</p>
                            <a href="{{ route('user.detail.game', $quizItem->slug_url) }}"
                                data-href="{{ route('user.detail.game', $quizItem->slug_url) }}"
                                onclick="showLoading(event)" class="text-[#5C7AEA] text-lg gap-5 flex items-center">Mulai
                                Bermain
                                <img src="../img/remaja/assets/arrow-right.svg" alt="" class="w-6 h-6">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script>
        document.getElementById('default-search').addEventListener('input', function() {
            var searchValue = this.value.toLowerCase();
            var gameContainers = document.querySelectorAll('.max-w-sm');

            gameContainers.forEach(function(container) {
                var title = container.querySelector('.font-semibold').innerText.toLowerCase();
                var description = container.querySelector('.font-normal').innerText.toLowerCase();

                if (title.includes(searchValue) || description.includes(searchValue)) {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            });
        });

        document.getElementById('kategori-select').addEventListener('change', function() {
            var selectedCategoryId = this.value;
            var gameContainers = document.querySelectorAll('.max-w-sm');

            gameContainers.forEach(function(container) {
                var gameCategoryId = container.getAttribute('data-category');

                if (selectedCategoryId === '' || selectedCategoryId === gameCategoryId) {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            });
        });
    </script>
@endpush
@push('css')
    <style>
        .relative {
            position: relative;
        }

        .h-full {
            height: 100%;
        }

        .min-w-[265px] {
            min-width: 265px;
        }

        .text-center {
            text-align: center;
        }

        .font-be-vietnam {
            /* Add your font styles here */
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .py-5 {
            padding-top: 1.25rem;
            /* Adjust as needed */
            padding-bottom: 1.25rem;
            /* Adjust as needed */
        }

        .font-medium {
            font-weight: 500;
        }

        .border {
            /* Add border styles here */
        }

        .text-black {
            color: #000;
        }

        .text-sm {
            font-size: 0.875rem;
            /* Adjust as needed */
        }

        .rounded-r-[12px] {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .appearance-none {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            /* Add additional appearance styles here if needed */
        }

        .select-wrapper {
            position: relative;
            display: inline-block;
        }

        .arrow-icon {
            position: absolute;
            top: 50%;
            right: 0.75rem;
            transform: translateY(-50%);
            width: 1.5rem;
            height: 1.5rem;
            pointer-events: none;
        }

        #content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush
