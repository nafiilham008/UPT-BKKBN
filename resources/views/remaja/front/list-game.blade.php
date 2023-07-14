@extends('layouts.remaja.front.app')

@section('title', __('test'))

@section('content')
    <div>
        <div class=""
            style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 100%);">
            @include('layouts.remaja.component.navbar')
            <div class="flex gap-8 items-center mb-16 py-[135px] px-[186px]">
                <div class="flex items-center" style="box-shadow: 2px 4px 17px 0px rgba(189, 179, 252, 0.25);">
                    <div class="rounded-l-[12px] bg-[#5C7AEA] px-9 py-4">
                        <h1 class="text-white font-be-vietnam font-semibold text-base">Kategori</h1>
                    </div>
                    <div class="relative h-full">
                        <div class="select-wrapper">
                            <select name="" id="kategori-select"
                                class="w-[265px] text-center font-be-vietnam cursor-pointer pr-10 pl-3 py-4 font-medium border border-[#3754C1] text-black text-sm rounded-r-[12px] appearance-none">
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="">Kesehatan Kesehatan Kesehatan Kesehatan Kesehatan Kesehatan</option>
                                <option value="">Remaja</option>
                            </select>
                            <img src="../img/remaja/assets/arrow-down.svg" alt="" class="arrow-icon">
                        </div>
                    </div>
                </div>
                <div class="">
                    <form>
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-black sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <img src="../img/remaja/assets/icon-search.svg" alt="" class="">
                            </div>
                            <input type="search" id="default-search"
                                class="block w-96 p-4 pr-10 text-sm font-be-vietnam text-black border border-[#3754C1] rounded-[12px] bg-white focus:ring-blue-500 focus:border-blue-500 placeholder:text-[#272727]/40"
                                placeholder="Search" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-7 px-[186px]">
                <div class="max-w-sm bg-white border border-gray-200 rounded-[24px]" style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                    <a href="#">
                        <img class="rounded-t-[24px] w-full h-52" src="../img/remaja/ilustrasi/kenali.svg" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-[28px] font-be-vietnam font-semibold tracking-tight text-[#272727]">Kenali Dirimu!</h5>
                        </a>
                        <p class="mb-3 font-normal text-[#272727] text-sm">Kenali dirimu disini</p>
                        <a href="/game" onclick="showLoading(event)" class="text-[#5C7AEA] text-lg gap-5 flex items-center">Mulai Bermain
                            <img src="../img/remaja/assets/arrow-right.svg" alt="" class="w-6 h-6">
                        </a>
                    </div>
                </div>
                <div class="max-w-sm bg-white border border-gray-200 rounded-[24px]" style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                    <a href="#">
                        <img class="rounded-t-[24px] w-full h-52" src="../img/remaja/ilustrasi/sehat.svg" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-[28px] font-be-vietnam font-semibold tracking-tight text-[#272727]">Stay Healty</h5>
                        </a>
                        <p class="mb-3 font-normal text-[#272727] text-sm">Jaga kesehatanmu demi masa depan</p>
                        <a href="/game" onclick="showLoading(event)" class="text-[#5C7AEA] text-lg gap-5 flex items-center">Mulai Bermain
                            <img src="../img/remaja/assets/arrow-right.svg" alt="" class="w-6 h-6">
                        </a>
                    </div>
                </div>
                <div class="max-w-sm bg-white border border-gray-200 rounded-[24px]" style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                    <a href="#">
                        <img class="rounded-t-[24px] w-full h-52" src="../img/remaja/ilustrasi/batasan.svg" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-[28px] font-be-vietnam font-semibold tracking-tight text-[#272727]">Kenali Batasmu!</h5>
                        </a>
                        <p class="mb-3 font-normal text-[#272727] text-sm">Batasi dirimu demi kebaikan</p>
                        <a href="/game" onclick="showLoading(event)" class="text-[#5C7AEA] text-lg gap-5 flex items-center">Mulai Bermain
                            <img src="../img/remaja/assets/arrow-right.svg" alt="" class="w-6 h-6">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
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
