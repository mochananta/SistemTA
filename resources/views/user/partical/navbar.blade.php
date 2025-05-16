<nav id="navbar" class="fixed top-0 w-full bg-white dark:bg-gray-800 shadow-lg transition-all duration-300 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('user/kemenag.png')}}" alt="Logo Kementerian Agama" class="h-10 w-10 object-contain">
                <span class="font-semibold text-primary-700 dark:text-primary-300 text-sm sm:text-base md:text-lg">Kementerian Agama</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden xl:flex xl:space-x-6 xl:items-center">
                <a href="{{ url('/') }}"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Beranda</a>
                <a href="{{ url('/') }}#layanan"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Layanan</a>
                <a href="{{ url('/') }}#statistik"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Statistik</a>
                <a href="{{ url('/') }}#data"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Data Keagamaan</a>
                <a href="{{ url('/') }}#lacak"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Lacak Layanan</a>
            </div>

            <!-- Auth Buttons or User Dropdown (Desktop) -->
            <div class="hidden xl:flex items-center gap-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-3 py-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('default-avatar.png') }}"
                                alt="Avatar"
                                class="w-8 h-8 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-3 w-40 bg-white dark:bg-gray-700 rounded-lg shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 mr-2 text-red-500"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3H6.75A2.25 2.25 0 004.5 5.25v13.5A2.25 2.25 0 006.75 21h6.75a2.25 2.25 0 002.25-2.25V15M18 12H9m0 0l3-3m-3 3l3 3" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                    </div>
                @else
                    <!-- Login/Register Buttons -->
                    <a href="{{ route('login') }}"
                    class="px-4 py-2 text-sm font-medium bg-primary-600 text-white rounded-lg shadow hover:bg-primary-700 transition">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}"
                    class="px-4 py-2 text-sm font-medium border border-primary-600 text-primary-600 rounded-lg shadow hover:bg-primary-600 hover:text-white transition">
                        Sign up
                    </a>
                @endauth
            </div>

            <!-- Right side icons -->
            <div class="flex items-center gap-2 ml-2">
                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle"
                    class="p-2 rounded-full text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg id="sunIcon" class="h-5 w-5 hidden dark:block" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg id="moonIcon" class="h-5 w-5 block dark:hidden" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <!-- Hamburger for Mobile -->
                <button id="mobileMenuButton"
                    class="xl:hidden p-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

<!-- Mobile Menu -->
<div id="mobileMenu" class="xl:hidden bg-white dark:bg-gray-800 shadow-md transition-all duration-300 ease-in-out">
    <div class="px-6 py-4 space-y-3">
        <!-- Link Menu -->
        <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Beranda</a>
        <a href="#layanan" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Layanan</a>
        <a href="#statistik" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Statistik</a>
        <a href="#data" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Data Keagamaan</a>
        <a href="#lacak" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Lacak Layanan</a>

        <!-- Authenticated User Menu -->
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="block w-1/2 text-center px-4 py-2 text-sm font-medium border border-primary-600 text-primary-600 rounded-lg shadow-md hover:bg-primary-600 hover:text-white transition">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 text-sm font-medium bg-primary-600 text-white rounded-lg shadow-md hover:bg-primary-700 transition">Sign In</a>
            <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 text-sm font-medium border border-primary-600 text-primary-600 rounded-lg shadow-md hover:bg-primary-600 hover:text-white transition">Sign Up</a>
        @endauth
    </div>
</div>




</nav>
