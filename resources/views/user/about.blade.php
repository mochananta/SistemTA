@extends('user.landing')

@section('content')
    <section id="about-developer" class="mt-12 py-20 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-primary-600 dark:text-primary-400">
                <a href="/" class="font-medium text-gray-800 dark:text-gray-300 hover:text-primary-600">Beranda</a>
                <span class="mx-2 text-gray-400 dark:text-gray-500">/</span>
                <span class="text-gray-600 dark:text-gray-300">Tentang Tim Developer</span>
            </div>

            <!-- Judul -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white">Tim Developer</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Sistem ini dikembangkan oleh mahasiswa Politeknik Negeri Banyuwangi sebagai bagian dari Tugas Akhir
                    dalam rangka digitalisasi pelayanan publik KUA.
                </p>
            </div>

            <!-- Kartu Developer: 2 Kolom Rata Tengah -->
            <div class="flex flex-wrap justify-center gap-10 max-w-5xl mx-auto">

                <!-- Anggota 1 -->
                <div
                    class="bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-lg p-8 w-80 text-center hover:shadow-xl transition">
                    <img src="{{ asset('user/nanta.jpg') }}" alt="Moh. Ananta"
                        class="w-32 h-32 mx-auto rounded-full mb-4 shadow object-cover">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Moh. Ananta</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Backend Developer</p>
                    <p class="text-xs mt-1 text-gray-500 dark:text-gray-400">Politeknik Negeri Banyuwangi</p>
                    <div class="flex justify-center space-x-4 mt-4 text-lg text-gray-600 dark:text-gray-300">
                        <a href="https://instagram.com/your_ig" target="_blank" class="hover:text-pink-500"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://linkedin.com/in/your_linkedin" target="_blank" class="hover:text-blue-600"><i
                                class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/your_github" target="_blank"
                            class="hover:text-gray-800 dark:hover:text-white"><i class="fab fa-github"></i></a>
                    </div>
                </div>

                <!-- Anggota 2 -->
                <div
                    class="bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-lg p-8 w-80 text-center hover:shadow-xl transition">
                    <img src="{{ asset('img/foto2.jpg') }}" alt="Nama Developer"
                        class="w-32 h-32 mx-auto rounded-full mb-4 shadow object-cover">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Nama Developer</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Frontend Developer</p>
                    <p class="text-xs mt-1 text-gray-500 dark:text-gray-400">Politeknik Negeri Banyuwangi</p>
                    <div class="flex justify-center space-x-4 mt-4 text-lg text-gray-600 dark:text-gray-300">
                        <a href="#"><i class="fab fa-instagram hover:text-pink-500"></i></a>
                        <a href="#"><i class="fab fa-linkedin hover:text-blue-600"></i></a>
                        <a href="#"><i class="fab fa-github hover:text-gray-800 dark:hover:text-white"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
