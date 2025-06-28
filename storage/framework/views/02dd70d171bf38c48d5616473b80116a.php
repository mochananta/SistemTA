<nav id="navbar" class="fixed top-0 w-full bg-white dark:bg-gray-800 shadow-lg transition-all duration-300 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-3">
                <img src="<?php echo e(asset('user/kemenag.png')); ?>" alt="Logo Kementerian Agama" class="h-10 w-10 object-contain">
                <span
                    class="font-semibold text-primary-700 dark:text-primary-300 text-sm sm:text-base md:text-lg">Kementerian
                    Agama</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden xl:flex xl:space-x-6 xl:items-center">
                <a href="<?php echo e(url('/')); ?>"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Beranda</a>
                <a href="<?php echo e(url('/')); ?>#layanan"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Layanan</a>
                <a href="<?php echo e(url('/')); ?>#statistik"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Statistik</a>
                <a href="<?php echo e(url('/')); ?>#data"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Data
                    Keagamaan</a>
                <a href="<?php echo e(url('/')); ?>#lacak"
                    class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition">Lacak
                    Layanan</a>
            </div>

            <div class="hidden xl:flex items-center gap-4" x-data="{ open: false }">
                <?php if(auth()->guard()->check()): ?>
                    <div class="relative">
                        <button @click="open = !open"
                            class="flex items-center gap-2 px-3 py-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition">
                            <img src="<?php echo e(Auth::user()->profile_photo_url ?? asset('default-avatar.png')); ?>" alt="Avatar"
                                class="w-8 h-8 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                <?php echo e(\Illuminate\Support\Str::limit(Auth::user()->name, 9, '...')); ?>

                            </span>
                            <svg x-bind:class="open ? 'rotate-180' : ''"
                                class="w-4 h-4 text-gray-500 dark:text-gray-300 transform transition-transform duration-200"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition x-cloak
                            class="absolute right-0 mt-3 w-44 bg-white dark:bg-gray-700 rounded-lg shadow-xl py-2 z-50">
                            <a href="<?php echo e(route('user.profile')); ?>"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.121 17.804A8 8 0 1112 20a7.965 7.965 0 01-6.879-2.196zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Profil Saya
                            </a>

                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-red-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3H6.75A2.25 2.25 0 004.5 5.25v13.5A2.25 2.25 0 006.75 21h6.75a2.25 2.25 0 002.25-2.25V15M18 12H9m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>"
                        class="px-4 py-2 text-sm font-medium bg-primary-600 text-white rounded-lg shadow hover:bg-primary-700 transition">
                        Sign in
                    </a>
                    <a href="<?php echo e(route('register')); ?>"
                        class="px-4 py-2 text-sm font-medium border border-primary-600 text-primary-600 rounded-lg shadow hover:bg-primary-600 hover:text-white transition">
                        Sign up
                    </a>
                <?php endif; ?>
            </div>

            <div class="flex items-center gap-2 ml-2">
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

                <button id="mobileMenuButton"
                    class="xl:hidden p-2 rounded-md text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobileMenu"
        class="hidden xl:hidden bg-white dark:bg-gray-800 shadow-md transition-all duration-300 ease-in-out">
        <div class="px-6 py-4 space-y-3">
            <!-- Link Menu -->
            <a href="<?php echo e(url('/')); ?>"
                class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Beranda</a>
            <a href="#layanan"
                class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Layanan</a>
            <a href="#statistik"
                class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Statistik</a>
            <a href="#data"
                class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Data
                Keagamaan</a>
            <a href="#lacak"
                class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Lacak
                Layanan</a>
            <?php if(auth()->guard()->check()): ?>
                <div class="flex items-center gap-3 px-3 py-2 border-t border-gray-200 dark:border-gray-600 pt-4">
                    <img src="<?php echo e(Auth::user()->profile_photo_url ?? asset('default-avatar.png')); ?>" alt="Avatar"
                        class="w-10 h-10 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold text-gray-800 dark:text-white">
                            <?php echo e(\Illuminate\Support\Str::limit(Auth::user()->name, 18, '...')); ?>

                        </span>
                        <a href="<?php echo e(route('user.profile')); ?>"
                            class="text-sm text-blue-600 hover:underline dark:text-blue-400">Lihat Profil</a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="block w-full text-center mt-3 px-4 py-2 text-sm font-medium border border-red-600 text-red-600 rounded-lg shadow-md hover:bg-red-600 hover:text-white transition">
                        Logout
                    </button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>"
                    class="block w-full text-center px-4 py-2 text-sm font-medium bg-primary-600 text-white rounded-lg shadow-md hover:bg-primary-700 transition">Sign
                    In</a>
                <a href="<?php echo e(route('register')); ?>"
                    class="block w-full text-center px-4 py-2 text-sm font-medium border border-primary-600 text-primary-600 rounded-lg shadow-md hover:bg-primary-600 hover:text-white transition">Sign
                    Up</a>
            <?php endif; ?>
        </div>
    </div>




</nav>
<?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/user/partical/navbar.blade.php ENDPATH**/ ?>