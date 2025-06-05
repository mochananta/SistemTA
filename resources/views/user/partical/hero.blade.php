    <!-- Hero Section -->
    <section class="mt-[4rem] py-10 bg-green-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <!-- Left Content -->
                <div class="md:w-1/2 space-y-6">
                    <h1 class="text-4xl sm:text-5xl font-bold text-green-900 dark:text-white">
                        Layanan Kementerian Agama <br>
                        <span class="text-green-700">Kab. Banyuwangi</span>
                    </h1>
                    <p class="text-lg text-gray-700 dark:text-gray-300">Memberikan pelayanan terbaik melalui layanan
                        konsultasi dan pengajuan surat untuk mendukung kehidupan beragama yang harmonis, berkeadilan,
                        dan tertib administrasi bagi seluruh masyarakat Banyuwangi.

                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ url('/') }}#layanan"
                            class="px-6 py-3 bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg shadow-lg transition duration-300">Layanan
                            Kami
                        </a>

                    </div>
                </div>

                <!-- Right Image -->
                <div class="md:w-1/2 relative">
                    <img src="https://images.unsplash.com/photo-1564121211835-e88c852648ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Kementerian Agama"
                        class="w-full h-auto rounded-xl shadow-lg transition transform hover:scale-[1.02] duration-500">
                    {{-- <div
                        class="absolute bottom-4 right-4 bg-gray-100/100 dark:bg-gray-800/100 backdrop-blur-md p-3 rounded-lg shadow-lg flex gap-6">
                        <div class="text-center">
                            <span class="text-green-700 dark:text-green-400 text-xl font-bold">34</span>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Provinsi</p>
                        </div>
                        <div class="text-center">
                            <span class="text-green-700 dark:text-green-400 text-xl font-bold">514</span>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Kabupaten/Kota</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
