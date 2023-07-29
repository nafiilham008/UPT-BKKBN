<div class="sticky top-0 z-20">
    <nav
        class="flex flex-wrap items-center justify-between w-full py-4 md:py-3 md:px-14 px-4 text-lg text-gray-700 bg-transparent">
        <div>
            <a href="#">
                <img src="../img/remaja/logo/logo.svg" alt="">
            </a>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-6 w-6 cursor-pointer md:hidden block"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>

        <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
            <ul
                class="pt-4 text-base text-[#272727] font-be-vietnam md:flex  md:items-center md:justify-between md:pt-0">
                <li>
                    <a class="md:p-4 py-2 block hover:text-purple-400" href="/test">Home</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block hover:text-purple-400" href="/list-game">Game List</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block hover:text-purple-400" href="#">Rating</a>
                </li>
                @guest
                    <li>
                        <a class="px-[19px] font-semibold rounded-full py-2 border border-[#3754C1] text-[#3754C1] items-center flex gap-3 min-w-[189px] justify-center"
                            href="{{ route('remaja.login') }}" style="box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);">
                            {{-- ketika belum login --}}
                            <span>Sign</span>
                        </a>
                    </li>
                @endguest

                @auth
                    <li>
                        <a class="px-[19px] font-semibold rounded-full py-2 border border-[#3754C1] text-[#3754C1] items-center flex gap-3 min-w-[189px] justify-center"
                            href="#" style="box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);">
                            <img src="../img/remaja/assets/user.svg" alt="">
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>

    </nav>
</div>
