@extends('user.landing')

@section('content')
    <section id="pengajuan-surat" class="mt-12 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-primary-600 dark:text-primary-400">
                <a href="/" class="font-medium text-gray-800 dark:text-gray-300 hover:text-primary-600">Beranda</a>
                <span class="mx-2 text-gray-400 dark:text-gray-500">/</span>
                <a href="/" class="font-medium text-gray-800 dark:text-gray-300 hover:text-primary-600">Layanan Konsultasi</a>
                <span class="mx-2 text-gray-400 dark:text-gray-500">/</span>
                <span class="text-gray-600 dark:text-gray-300">Pelayanan Rumah Ibadah</span>
            </div>
            <!-- Title -->
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-extrabold text-green-700 dark:text-green-400">Formulir Pelayanan Rumah Ibadah</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400 text-lg">
                    Silakan lengkapi data dan persyaratan berikut dengan benar.
                </p>
            </div>

            <!-- Grid 2 kolom -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Kiri - Persyaratan -->
                <div
                    class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 border border-green-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-file-alt mr-2 text-green-600 dark:text-green-400"></i> Persyaratan
                    </h3>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-3 leading-relaxed">
                        <li>Fotokopi KTP Calon Suami & Istri</li>
                        <li>Surat Pengantar dari RT/RW setempat</li>
                        <li>Pas Foto 3x4 (4 lembar)</li>
                        <li>Fotokopi Akta Kelahiran</li>
                        <li>Surat Izin Orang Tua (jika usia &lt; 21 tahun)</li>
                    </ul>
                    <p class="mt-4 text-sm italic text-gray-500 dark:text-gray-400">
                        * Semua dokumen wajib dibawa dalam bentuk fotokopi & asli saat verifikasi.
                    </p>
                </div>

                <!-- Kanan - Form -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        
                        <input type="hidden" name="jenis_surat" value="Rumah Ibadah">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                Lengkap</label>
                            <input type="text" id="nama" name="nama"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none"
                                placeholder="Masukkan nama lengkap..." required>
                        </div>

                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor
                                KTP</label>
                            <input type="text" id="nik" name="nik"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none"
                                placeholder="16 digit NIK" required>
                        </div>

                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Upload File</label>
                            <input type="file" id="nik" name="nik"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none"
                                placeholder="16 digit NIK" required>
                        </div>

                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                                Pernikahan</label>
                            <input type="date" id="tanggal" name="tanggal"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none"
                                required>
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat
                                Lengkap</label>
                            <textarea id="alamat" name="alamat" rows="3"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none"
                                placeholder="Contoh: Jl. Pahlawan No. 12, Kec. Sumbersari, Kab. Banyuwangi" required></textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 text-white bg-green-600 hover:bg-green-700 rounded-md font-semibold shadow-md transition-all duration-300">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Formulir
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
