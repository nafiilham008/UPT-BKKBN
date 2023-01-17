<div class="flex flex-wrap px-20" id="tabs-id">
    <div class="w-full ">
        <ul
            class="flex mb-0 list-none bg-[#0672B0] rounded-t-xl w-full justify-center lg:flex-wrap pt-3 pb-4 lg:flex-row flex-col">
            @foreach ($constant as $key => $item)
                <li class="-mb-px mr-2 last:mr-0 md:text-center ">
                    <a class="text-sm font-bold uppercase lg:px-5 py-3 block cursor-pointer text-white flex justify-center items-center text-start gap-2"
                        style="font-family: 'Poppins', sans-serif;"
                        onclick="changeAtiveTab(event,'{{ $item['label'] }}')">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="relative flex flex-col min-w-0 break-words w-full mb-6">
        <div class="flex-auto">
            <div class="tab-content tab-space">
                <div class="block" id="Berita">
                    <div class="bg-white px-10 py-10 shadow-xl rounded-b-xl">
                        @foreach ($postNews as $item)
                            <div class="grid grid-cols-12 mt-10">
                                <div class="col-span-4">
                                    <img src="{{ asset('uploads/images/thumbnail/' . $item->thumbnail) }}"
                                        class="cover2 rounded-xl" alt="">
                                </div>
                                <div class="col-span-8 px-4 flex flex-col justify-center">
                                    <a href="#" class="text-base text-[#2B5268] font-semibold "
                                        style="font-family: 'Poppins', sans-serif;">{{ $item->title }}</a>
                                    <h1 class="text-sm text-justify text-[#434343] py-3 line-clamp-3"
                                        style="font-family: 'Poppins', sans-serif;">{!! $item->description !!} <a
                                            href="#"
                                            class="text-base text-[#2B5268] ml-1 font-semibold">Selengkapnya...</a>
                                    </h1>
                                    <div class="flex">
                                        <div class="flex">
                                            <iconify-icon icon="uil:calender" style="color: #b0b0b0;" width="15"
                                                height="15"></iconify-icon>
                                            <h1 class="text-xs text-[#b0b0b0] ml-1">
                                                {{ $item->created_at->format('d F Y') }}</h1>
                                        </div>
                                        <div class="flex ml-4">
                                            <iconify-icon icon="mdi:clock-time-three-outline" style="color: #b0b0b0;"
                                                width="15" height="15">
                                            </iconify-icon>
                                            <h1 class="text-xs text-[#b0b0b0] ml-1">
                                                {{ $item->created_at->format('H:i:s') }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="hidden" id="Artikel">
                    <div class="bg-white px-10 py-10 shadow-xl rounded-b-xl">
                        @foreach ($postArticle as $item)
                            <div class="grid grid-cols-12 mt-10">
                                <div class="col-span-4">
                                    <img src="{{ asset('uploads/images/thumbnail/' . $item->thumbnail) }}"
                                        class="cover2 rounded-xl" alt="">
                                </div>
                                <div class="col-span-8 px-4 flex flex-col justify-center">
                                    <a href="#" class="text-base text-[#2B5268] font-semibold "
                                        style="font-family: 'Poppins', sans-serif;">{{ $item->title }}</a>
                                    <h1 class="text-sm text-justify text-[#434343] py-3 line-clamp-3"
                                        style="font-family: 'Poppins', sans-serif;">{!! $item->description !!} <a
                                            href="#"
                                            class="text-base text-[#2B5268] ml-1 font-semibold">Selengkapnya...</a>
                                    </h1>
                                    <div class="flex">
                                        <div class="flex">
                                            <iconify-icon icon="uil:calender" style="color: #b0b0b0;" width="15"
                                                height="15"></iconify-icon>
                                            <h1 class="text-xs text-[#b0b0b0] ml-1">
                                                {{ $item->created_at->format('d F Y') }}</h1>
                                        </div>
                                        <div class="flex ml-4">
                                            <iconify-icon icon="mdi:clock-time-three-outline" style="color: #b0b0b0;"
                                                width="15" height="15">
                                            </iconify-icon>
                                            <h1 class="text-xs text-[#b0b0b0] ml-1">
                                                {{ $item->created_at->format('H:i:s') }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="hidden" id="Informasi">
                    <div class="bg-white px-10 py-10 shadow-xl rounded-b-xl">

                        @foreach ($postInformation as $item)
                            <div class="grid grid-cols-12 mt-10">
                                <div class="col-span-4">
                                    <img src="{{ asset('uploads/images/thumbnail/' . $item->thumbnail) }}"
                                        class="cover2 rounded-xl" alt="">
                                </div>
                                <div class="col-span-8 px-4 flex flex-col justify-center">
                                    <a href="#" class="text-base text-[#2B5268] font-semibold "
                                        style="font-family: 'Poppins', sans-serif;">{{ $item->title }}</a>
                                    <h1 class="text-sm text-justify text-[#434343] py-3 line-clamp-3"
                                        style="font-family: 'Poppins', sans-serif;">{!! $item->description !!} <a
                                            href="#"
                                            class="text-base text-[#2B5268] ml-1 font-semibold">Selengkapnya...</a>
                                    </h1>
                                    <div class="flex">
                                        <div class="flex">
                                            <iconify-icon icon="uil:calender" style="color: #b0b0b0;" width="15"
                                                height="15"></iconify-icon>
                                            <h1 class="text-xs text-[#b0b0b0] ml-1">
                                                {{ $item->created_at->format('d F Y') }}</h1>
                                        </div>
                                        <div class="flex ml-4">
                                            <iconify-icon icon="mdi:clock-time-three-outline" style="color: #b0b0b0;"
                                                width="15" height="15">
                                            </iconify-icon>
                                            <h1 class="text-xs text-[#b0b0b0] ml-1">
                                                {{ $item->created_at->format('H:i:s') }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
