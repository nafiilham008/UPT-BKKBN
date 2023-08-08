@extends('layouts.remaja.front.app')

@section('title', __('Edit Profile'))

@section('content')
    <div>
        <div x-data="app()" x-init="initializeStep()" x-cloak id="app" class=""
            style="background: linear-gradient(179deg, #7CDFFF 0%, rgba(255, 255, 255, 0.00) 70%);">
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
                                @if (isset($detail->gender) && $detail->gender == 'man')
                                    <img src="{{ asset('img/remaja/assets/male.svg') }}" alt="">
                                @else
                                    <img src="{{ asset('img/remaja/assets/female.svg') }}" alt="">
                                @endif
                                @php
                                    use Carbon\Carbon;
                                @endphp

                                @if (empty($detail->birthdate))
                                    <h1 class="font-be-vietnam text-[#272727] font-semibold text-base">- (please fill in
                                        your birthdate first)</h1>
                                @else
                                    @php
                                        $birthdate = Carbon::parse($detail->birthdate);
                                        $now = Carbon::now();
                                        $age = $birthdate->diffInYears($now);
                                    @endphp
                                    <h1 class="font-be-vietnam text-[#272727] font-semibold text-base">{{ $age }}
                                        years old</h1>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="px-[217px]">
                        <div class="px-[131px] py-[53px] bg-white/40 rounded-[24px] shadow2 w-full">
                            <form action="{{ route('user.profile.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h1 class="font-be-vietnam font-bold text-black text-2xl mb-[55px]">Edit Profile</h1>
                                <div class="flex mb-4 gap-4 items-center">
                                    <div class="w-full">
                                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Full Name</h1>
                                        <div class="relative ">
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                                placeholder="example: Muhammad Iqbal Ainu Rafie">

                                        </div>
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    {{-- <div class="w-full">
                                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Email</h1>
                                        <div class="relative">
                                            <input type="email" name="email"
                                                class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                                placeholder="example: ainurafie@gmail.com">
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="flex mb-4 gap-4 items-center">
                                    {{-- <div class="w-full">
                                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Full Name</h1>
                                        <div class="relative ">
                                            <input type="text" name="name"
                                                class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                                placeholder="example: Muhammad Iqbal Ainu Rafie">

                                        </div>
                                    </div> --}}
                                    <div class="w-full">
                                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Date of Birth</h1>
                                        <div class="relative">
                                            <input type="date" name="birthdate" value="{{ $detail->birthdate ?? '-' }}"
                                                class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs">
                                        </div>
                                        @error('birthdate')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex mb-4 gap-4">
                                    <div class="w-full">
                                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Gender</h1>
                                        <div class="relative">
                                            <select name="gender"
                                                class="bg-white border border-[#5C7AEA] px-[18px] py-3 w-96 text-[#272727]/30 rounded-full font-be-vietnam text-xs"
                                                style="appearance: left;">
                                                <option disabled>Choose Gender</option>
                                                <option value="man" {{ $detail->gender == 'man' ? 'selected' : '' }}>Man
                                                </option>
                                                <option value="woman" {{ $detail->gender == 'woman' ? 'selected' : '' }}>
                                                    Woman</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="relative w-full">
                                        <h1 class="font-be-vietnam text-xs font-semibold text-black mb-3">Profile Picture
                                        </h1>
                                        <label for="image" id="image-label" class="cursor-pointer">
                                            <span class="">
                                                <img id="img-preview"
                                                    class="w-24 h-24 border-2 border-[#5C7AEA] rounded-2xl hover:bg-slate-200 cursor-pointer"
                                                    src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                                    alt="Profile Picture">
                                            </span>
                                            <input class="hidden" type="file" name="avatar" id="image"
                                                onchange="previewImage()">
                                        </label>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <button
                                        class="cancel-button w-[164px] h-[50px] justify-center items-center flex text-[#5C7AEA] rounded-full bg-white text-base font-semibold">Cancel</button>
                                    <button type="submit"
                                        class="save-button w-[164px] h-[50px] justify-center items-center flex bg-[#5C7AEA] rounded-full text-white text-base font-semibold">Save</button>
                                </div>
                            </form>
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
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('#img-preview');

            if (image.files && image.files.length > 0) {
                const oFReader = new FileReader();
                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                };
                oFReader.readAsDataURL(image.files[0]);
            }
        }
    </script>
@endpush
@push('css')
    <style>
        .save-button {
            transition: background-color 0.3s ease, color 0.3s ease;
            box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);
        }

        .save-button:hover {
            background-color: #3754C1;
            color: #ffffff;
            box-shadow: 2px 4px 17px 0px rgb(255, 255, 255);
        }

        .cancel-button {
            transition: background-color 0.3s ease, color 0.3s ease;
            box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);
        }

        .cancel-button:hover {
            background-color: #3754C1;
            color: #ffffff;
            box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);
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

        .shadow2 {
            box-shadow: -2px -1px 14px 0px rgba(133, 145, 255, 0.30);
            backdrop-filter: blur(35px);
        }
    </style>
@endpush
