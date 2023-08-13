@extends('layouts.remaja.front.app')

@section('title', __('Profile'))

@section('content')
    <div>
        <div x-data="app()" x-init="initializeStep()" x-cloak id="app" class=""
            style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 30%);">
            <div class="relative">
                @include('layouts.remaja.component.navbar')
                <div class="py-20">
                    <div class="flex justify-center gap-5 items-center mb-[76px]">
                        <div class="relative">
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                class="rounded-full w-[200px] h-[200px] px-5 py-5" alt="">
                            <div class="absolute top-0 right-0 left-0">
                                <img src="{{ asset('img/remaja/assets/border.svg') }}" class="" alt="">
                            </div>
                        </div>
                        <div class="">
                            <h1 class="font-be-vietnam font-bold text-[#272727] text-xl">{{ Auth::user()->name }}</h1>
                            <h1 class="font-be-vietnam text-[#272727] text-base">{{ Auth::user()->email }}</h1>
                            <div class="flex gap-3 items-center">
                                @if (isset($detailUser->gender) && $detailUser->gender == 'man')
                                    <img src="{{ asset('img/remaja/assets/male.svg') }}" class="w-6 h-6" alt="">
                                @else
                                    <img src="{{ asset('img/remaja/assets/female.svg') }}" class="w-6 h-6" alt="">
                                @endif
                                @php
                                    use Carbon\Carbon;
                                @endphp

                                @if (empty($detailUser->birthdate))
                                    <h1 class="font-be-vietnam text-[#272727] font-semibold text-base">- (please fill in
                                        your birthdate first)</h1>
                                @else
                                    @php
                                        $birthdate = Carbon::parse($detailUser->birthdate);
                                        $now = Carbon::now();
                                        $age = $birthdate->diffInYears($now);
                                    @endphp
                                    <h1 class="font-be-vietnam text-[#272727] font-semibold text-base">{{ $age }}
                                        years old</h1>
                                @endif
                            </div>
                            <div class="mt-8">
                                <a href="{{ route('user.profile.edit') }}" data-href="{{ route('user.profile.edit') }}"
                                    onclick="showLoading(event)"
                                    class="profile-link text-base text-[#3754C1] border border-[#3754C1] rounded-[10px] px-9 py-3 font-semibold">Edit
                                    Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="px-[70px]">
                        <div class="flex gap-5 justify-center items-center border-b-2 pb-3 border-[#5C7AEA]/40 mb-11">
                            <button class="tablink text-base text-black font-be-vietnam"
                                onclick="changeTab(event, 'Pencapaian')">
                                Pencapaian
                            </button>
                            <button class="tablink text-base text-black font-be-vietnam"
                                onclick="changeTab(event, 'Penghargaan')">
                                Penghargaan
                            </button>
                        </div>
                        <div id="Pencapaian" class="tabcontent">
                            <div class="flex gap-8 items-center mb-4">
                                <div class="w-8 h-[73px] rounded-full bg-[#CF6EA7]"
                                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);"></div>
                                <h1 class="text-[40px] text-[#272727] font-bold font-be-vietnam">Pencapaian</h1>
                            </div>
                            <div class="px-16 mb-14">
                                <h1 class="text-base text-black font-light font-be-vietnam mb-[60px]">Lihat semua
                                    pencapaianmu disini,
                                    Wah kamu hebat dengan peringkatmu saat ini.</h1>
                                <div class="flex items-center justify-center gap-9">
                                    <div class="rounded-[24px] w-[327px] shadow-purple bg-[#52B788]/30 px-12 py-8 relative">
                                        <h1 class="text-xl text-black font-medium font-be-vietnam mb-[30px]">Peringkat</h1>
                                        <h1 class="text-[48px] text-black font-medium font-be-vietnam">
                                            {{ $ranking->ranking ?? 'N/A' }}</h1>
                                        <div class="absolute bottom-0 right-0">
                                            <img src="{{ asset('img/remaja/assets/trophy.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="rounded-[24px] w-[327px] shadow-purple bg-[#4895EF]/30 px-12 py-8 relative">
                                        <h1 class="text-xl text-black font-medium font-be-vietnam mb-[30px]">Dimainkan</h1>
                                        <h1 class="text-[48px] text-black font-medium font-be-vietnam">{{ $totalQuiz }}
                                        </h1>
                                        <div class="absolute bottom-0 right-0">
                                            <img src="{{ asset('img/remaja/assets/dimainkan.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="rounded-[24px] w-[327px] shadow-purple bg-[#9D4EDD]/30 px-12 py-8 relative">
                                        <h1 class="text-xl text-black font-medium font-be-vietnam mb-[30px]">Skor Tertinggi
                                        </h1>
                                        <h1 class="text-[48px] text-black font-medium font-be-vietnam">
                                            {{ $ranking->final_score ?? 'N/A' }}</h1>
                                        <div class="absolute bottom-0 right-0">
                                            <img src="{{ asset('img/remaja/assets/skor.svg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-8 items-center mb-4">
                                <div class="w-8 h-[73px] rounded-full bg-[#CF6EA7]"
                                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);"></div>
                                <h1 class="text-[40px] text-[#272727] font-bold font-be-vietnam">Permainan Selesai</h1>
                            </div>
                            <div class="px-16 mb-14">
                                <h1 class="text-base text-black font-light font-be-vietnam mb-[60px]">Terima kasih telah
                                    menyelesaikan permainan, semakin kamu banyak menyelesaikan permainan semakin banyak juga
                                    pengetahuanmu. Ayo coba mainkan permainan yang lain disini!</h1>
                                <div class="grid grid-cols-3 gap-7">
                                    @foreach ($quiz as $item)
                                        <div class="w-[336px] bg-white border border-gray-200 rounded-[24px]"
                                            style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                                            <a href="#">
                                                <img class="rounded-t-[24px] w-full h-52"
                                                    src="{{ asset('storage/' . $item->quiz->image) }}" alt="" />
                                            </a>
                                            <div class="p-5">
                                                <a href="#">
                                                    <h5
                                                        class="mb-2 text-[28px] font-be-vietnam font-semibold tracking-tight text-[#272727]">
                                                        {{ $item->quiz->title }}</h5>
                                                </a>
                                                <p class="mb-3 font-normal text-[#272727] text-sm">
                                                    {{ $item->quiz->description }}</p>
                                                <a href="{{ route('user.detail.result.view', $item->quiz->slug_url) }}"
                                                    data-href="{{ route('user.detail.result.view', $item->quiz->slug_url) }}"
                                                    onclick="showLoading(event)"
                                                    class="text-[#5C7AEA] text-lg gap-5 flex items-center">Lihat Review
                                                    <img src="{{ asset('img/remaja/assets/arrow-right.svg') }}"
                                                        alt="" class="w-6 h-6">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div id="Penghargaan" class="tabcontent">
                            <div class="flex gap-8 items-center mb-[68px]">
                                <div class="w-8 h-[73px] rounded-full bg-[#CF6EA7]"
                                    style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);"></div>
                                <h1 class="text-[40px] text-[#272727] font-bold font-be-vietnam">Sertifikat Pencapaian</h1>
                            </div>
                            <div class="px-16 mb-[14]">
                                <div class="grid grid-cols-3 gap-7">
                                    @foreach ($quiz as $item)
                                        <div class="w-[336px] bg-white border border-gray-200 rounded-[24px]"
                                            style="box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);">
                                            <a href="#">
                                                <img class="rounded-t-[24px] w-full h-52"
                                                    src="{{ asset('storage/' . $item->quiz->image) }}" alt="" />
                                            </a>
                                            <div class="p-5">
                                                <a href="#">
                                                    <h5
                                                        class="mb-2 text-[28px] font-be-vietnam font-semibold tracking-tight text-[#272727]">
                                                        {{ $item->quiz->title }}</h5>
                                                </a>
                                                <p class="mb-3 font-normal text-[#272727] text-sm">
                                                    {{ $item->quiz->description }}</p>
                                                <a href="{{ route('user.profile.certificate', $item->quiz->slug_url) }}"
                                                    data-href="{{ route('user.profile.certificate', $item->quiz->slug_url) }}"
                                                    onclick="showLoading(event)"
                                                    class="text-[#5C7AEA] text-lg gap-5 flex items-center">Unduh Sertifikat
                                                    <img src="{{ asset('img/remaja/assets/arrow-right.svg') }}"
                                                        alt="" class="w-6 h-6">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script>
    <script>
        // Initially hide all tabcontent
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Initially add active class for the first tab
        document.getElementsByClassName("tablink")[0].classList.add("active");

        // Initially display first tabcontent
        document.getElementById("Pencapaian").style.display = "block";

        function changeTab(evt, tabName) {
            var i, tabcontent, tablinks;

            // Hide all elements with class="tabcontent"
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the active class from all tablinks/buttons
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the specific tab content and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
@endpush
@push('css')
    <style>
        .profile-link {
            transition: background-color 0.3s ease, color 0.3s ease;
            box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);
        }

        .profile-link:hover {
            background-color: #3754C1;
            color: #ffffff;
            box-shadow: 2px 4px 17px 0px rgb(255, 255, 255);
        }

        .tablink {
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
            transition: color 0.3s;
        }

        .tablink.active {
            color: #392D83;
            font-weight: 700;
        }

        .shadow-purple {
            box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);
        }
    </style>
@endpush
