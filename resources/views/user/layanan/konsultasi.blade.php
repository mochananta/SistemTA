@extends('user.landing')

@section('content')
    <section id="pengajuan-surat" class="mt-12 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-primary-600 dark:text-primary-400">
                <a href="/" class="font-medium text-gray-800 dark:text-gray-300 hover:text-primary-600">Beranda</a>
                <span class="mx-2 text-gray-400 dark:text-gray-500">/</span>
                <span class="text-gray-600 dark:text-gray-300">Layanan Konsultasi</span>
            </div>

            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Jenis Layanan Konsultasi</h2>
                <p class="mt-3 text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Pilih jenis surat yang ingin Anda ajukan sesuai dengan kebutuhan administrasi Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Card 1: Rekomendasi Pernikahan-->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
                    <div
                        class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-file-signature text-xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Rekomendasi Pernikahan</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Ajukan surat rekomendasi kegiatan keagamaan, pendidikan, atau sosial dari Kementerian Agama.
                    </p>
                    <a href="{{ url('/form/konsultasi-rekomendasi-nikah') }}"
                        class="text-sm font-semibold text-primary-600 hover:text-primary-800 dark:hover:text-primary-400">
                        Lihat Detail →
                    </a>
                </div>

                <!-- Card 2: Pendaftaran Pernikahan -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
                    <div
                        class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-check text-xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Pendaftaran Pernikahan</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Gunakan layanan ini untuk mengajukan izin resmi penyelenggaraan kegiatan keagamaan.
                    </p>
                   <a href="{{ url('/form/konsultasi-pendaftaran-pernikahan') }}"
                        class="text-sm font-semibold text-primary-600 hover:text-primary-800 dark:hover:text-primary-400">
                        Lihat Detail →
                    </a>
                </div>

                <!-- Card 3: Tempat Ibadah -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
                    <div
                        class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-4">
                        <i class="fa-solid fa-location-dot text-xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Wakaf</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Untuk mengajukan surat keterangan atau legalitas tempat ibadah di wilayah Anda.
                    </p>
                    <a href="{{ url('/form/konsultasi-wakaf') }}"
                        class="text-sm font-semibold text-primary-600 hover:text-primary-800 dark:hover:text-primary-400">
                        Lihat Detail →
                    </a>
                </div>

                <!-- Card 4: Tempat Ibadah -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 hover:shadow-lg transition">
                    <div
                        class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-mosque text-xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Rumah Ibadah</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Untuk mengajukan surat keterangan atau legalitas tempat ibadah di wilayah Anda.
                    </p>
                   <a href="{{ url('/form/konsultasi-ibadah') }}"
                        class="text-sm font-semibold text-primary-600 hover:text-primary-800 dark:hover:text-primary-400">
                        Lihat Detail →
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
