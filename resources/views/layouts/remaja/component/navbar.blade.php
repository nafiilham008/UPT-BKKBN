<div class="sticky top-0 z-20">
    <nav
        class="flex flex-wrap items-center justify-between w-full py-4 md:py-3 lg:px-14 px-4 text-lg text-gray-700 bg-transparent">
        <div>
            <a href="{{ route('user.index') }}">
                <img src="{{ asset('img/remaja/logo/logo.svg') }}" alt="">
            </a>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" class="h-6 w-6 cursor-pointer md:hidden block"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>

        <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">

            <ul
                class="pt-4 text-base text-[#272727] font-be-vietnam md:flex  md:items-center md:justify-between md:pt-0">
                @guest
                    <li>
                        <a class="px-[19px] font-semibold rounded-full py-2 border border-[#3754C1] text-green-500 items-center flex gap-3 min-w-[189px] justify-center"
                            href="{{ route('remaja.login') }}" style="box-shadow: 2px 4px 17px 0px rgba(12, 0, 86, 0.25);">
                            {{-- ketika belum login --}}
                            <span>Sign</span>
                        </a>
                    </li>
                @endguest
                <li>
                    <a class="md:p-4 py-2 block hover:text-purple-400" href="{{ route('user.index') }}">Home</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block hover:text-purple-400" href="{{ route('user.list') }}"
                        data-href="{{ route('user.list') }}" onclick="showLoading(event)">Game List</a>
                </li>
                <li>
                    <a class="md:p-4 py-2 block hover:text-purple-400" href="{{ route('user.detail.rangking') }}"
                        data-href="{{ route('user.detail.rangking') }}" onclick="showLoading(event)">Ranking</a>
                </li>


                @auth
                    <li>
                        <div class="relative">
                            <button
                                class="px-[19px] font-semibold rounded-full py-2 border border-[#3754C1] text-[#3754C1] items-center flex gap-3 min-w-[189px] justify-center focus:outline-none"
                                id="dropdownButton">
                                @if (auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-8 h-8 rounded-full"
                                        alt="">
                                @else
                                    <img src="../img/remaja/assets/user.svg" class="w-8 h-8 rounded-full" alt="">
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white hidden" id="dropdownMenu">
                                <div class="py-1" role="menu" aria-orientation="vertical"
                                    aria-labelledby="dropdownButton">
                                    <a href="{{ route('user.profile') }}" data-href="{{ route('user.profile') }}"
                                        onclick="showLoading(event)"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Profile</a>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>

                    </li>
                @endauth
            </ul>
        </div>

    </nav>
</div>
