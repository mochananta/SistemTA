@extends('user.landing')

@section('content')
    <section id="pengajuan-surat" class="mt-12 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-primary-600 dark:text-primary-400">
                <a href="/" class="font-medium text-gray-800 dark:text-gray-300 hover:text-primary-600">Beranda</a>
                <span class="mx-2 text-gray-400 dark:text-gray-500">/</span>
                <a href="{{ route('user.layanan.surat') }}""
                    class="font-medium text-gray-800 dark:text-gray-300 hover:text-primary-600">Pengajuan Surat</a>
                <span class="mx-2 text-gray-400 dark:text-gray-500">/</span>
                <span class="text-gray-600 dark:text-gray-300">Pelayanan Ikrar Wakaf</span>
            </div>
            <!-- Title -->
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-extrabold text-green-700 dark:text-green-400">Formulir Pelayanan Wakaf</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400 text-lg">
                    Silakan lengkapi data dan persyaratan berikut dengan benar.
                </p>
            </div>

            <!-- Grid 2 kolom -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div
                    class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 border border-green-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-file-alt mr-2 text-green-600 dark:text-green-400"></i> Persyaratan Wakaf
                    </h3>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-3 leading-relaxed">
                        <li>
                            <button onclick="toggleModal()" class="text-green-600 hover:underline font-semibold">
                                Persyaratan (Klik di sini)
                            </button>
                        </li>
                        <li> Jadikan Persyaratan Dalam Satu File Berbentuk (PDF)</li>
                        <li> Masukan Kedalam Form Upload Dokumen</li>
                    </ul>
                    <!-- Pop Up daftar Persyaratan-->
                    <div id="modalPersyaratan"
                        class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-lg w-full max-h-[80vh] overflow-y-auto">
                            <h4 class="text-lg font-bold mb-4 text-green-700 dark:text-green-400">Daftar Persyaratan
                            </h4>
                            <!-- Konten persyaratan di sini -->
                            <div class="mb-6">
                                <h4 class="mb-3 font-semibold text-lg text-green-600 dark:text-green-400">Persyaratan
                                    Pengajuan Tanah Wakaf </h4>

                                <h5 class="mb-2 font-semibold text-md text-green-700 dark:text-green-300">Dari Wakif (yang
                                    mewakafkan):</h5>
                                <ol class="list-decimal list-inside text-gray-700 dark:text-gray-300 space-y-1 mb-4">
                                    <li>Fotokopi KTP</li>
                                    <li>Sertifikat tanah / bukti kepemilikan asli</li>
                                    <li>SPPT PBB terakhir</li>
                                    <li>Surat pernyataan tanah tidak dalam sengketa</li>
                                    <li>Surat pernyataan tanah tidak dalam agunan</li>
                                    <li>Surat pernyataan ikhlas mewakafkan</li>
                                    <li><em>(Opsional)</em> Surat keterangan tanah dari desa/kelurahan</li>
                                    <li><em>(Opsional)</em> Fotokopi KK</li>
                                </ol>

                                <h5 class="mb-2 font-semibold text-md text-green-700 dark:text-green-300">Dari Nadzir
                                    (pengelola wakaf):</h5>
                                <ol class="list-decimal list-inside text-gray-700 dark:text-gray-300 space-y-1">
                                    <li>Fotokopi KTP</li>
                                    <li>Surat pernyataan kesanggupan sebagai nadzir</li>
                                    <li><em>(Opsional)</em> SK pengangkatan nadzir (jika organisasi/yayasan)</li>
                                    <li><em>(Opsional)</em> SK kepengurusan (jika badan hukum)</li>
                                    <li><em>(Opsional)</em> Pas foto 3×4</li>
                                </ol>
                            </div>


                            <div class="mt-6 text-right">
                                <button onclick="toggleModal()"
                                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                    <script>
                        function toggleModal() {
                            const modal = document.getElementById('modalPersyaratan');
                            modal.classList.toggle('hidden');
                        }
                    </script>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-file-alt mr-2 text-green-600 dark:text-green-400"></i> Alur Pelayanan
                    </h3>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-3 leading-relaxed">
                        <li>Mengisi Form data dan tanggal pengajuan</li>
                        <li>Manginputkan file pengajua surat</li>
                        <li>Klik tombol kirim Formulir</li>
                        <li>Jika data permohonan berhasil dikirim, pemohon akan mendapatkan nomor layanan melalui kotak
                            dialog (jangan lupa menyalin nomor layanan agar formulir konsultasi dapat di lacak)</li>
                        <li>Untuk memastikan Pengajuan Surat sudah selesai, anda bisa mengecek status layanan dimenu Lacak
                            Layanan dengan memasukkan nomor layanan dan nomor hp pemohon.</li>
                        <li>Status layanan: - Menunggu persetujuan, permohonan menunggu persetujuan kepala kantor/unit kerja
                            terkait - Masih dalam proses, permohonan masih dalam proses verifikasi kepala kantor/unit kerja
                            terkait.</li>
                        <li>Selesai, permohonan sudah disetujui, bila surat membutuhkan jawaban dokumen siap untuk
                            didownload pemohon melalui lacak layanan.</li>
                        <li> Anda dapat memeriksa status pengajuan surat pada bagian Profil. </li>
                    </ul>
                    <p class="mt-4 text-sm italic text-gray-500 dark:text-gray-400">
                        * Semua dokumen wajib diupload saat pengajuan.
                    </p>
                </div>

                <!-- Kanan - Form -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        <input type="hidden" name="jenis_surat" value="Wakaf">

                        <div>
                            <label for="tanggal_pengajuan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-calendar-alt mr-1 text-green-600"></i> Tanggal Pengajuan
                            </label>
                            <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none"
                                required>
                        </div>

                        <div x-data="{ open: false }">
                            <label for="kua_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-mosque mr-1 text-green-600"></i> Pilih KUA <span
                                    class="text-red-600">*</span>
                            </label>
                            <div class="relative">
                                <select id="kua_id" name="kua_id" required @focus="open = true" @blur="open = false"
                                    class="appearance-none mt-1 block w-full px-4 py-2 pr-10 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none transition">
                                    <option value="" disabled selected>-- Pilih KUA Tujuan --</option>
                                    @foreach ($kuas as $kua)
                                        <option value="{{ $kua->id }}">
                                            {{ \Illuminate\Support\Str::limit($kua->nama . ' - ' . $kua->alamat, 60) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg x-bind:class="open ? 'rotate-180' : ''"
                                        class="w-4 h-4 text-gray-500 dark:text-gray-400 transform transition-transform duration-200"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 italic">
                                Pilih KUA sesuai lokasi tujuan pengajuan.
                            </p>
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-map-marker-alt mr-1 text-green-600"></i> Alamat Lengkap
                            </label>
                            <textarea id="alamat" name="alamat" rows="3"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none"
                                placeholder="Contoh: Jl. Pahlawan No. 12, Kec. Sumbersari, Kab. Banyuwangi" required></textarea>
                        </div>

                        <div>
                            <label for="file_path" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-upload mr-1 text-green-600"></i> Upload Dokumen Persyaratan <span
                                    class="text-red-600">*</span>
                            </label>
                            <input type="file" id="file_path" name="file_path" required
                                class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-100
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-md file:border-0 file:text-sm file:font-semibold
                                       file:bg-green-50 file:text-green-700
                                       hover:file:bg-green-100
                                       dark:file:bg-green-900 dark:file:text-green-200 dark:hover:file:bg-green-800
                                       transition" />

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 italic">
                                File wajib diunggah. Format diperbolehkan: <strong>PDF, JPG, JPEG, PNG</strong>. Maksimal
                                ukuran: <strong>5MB</strong>.
                            </p>
                        </div>


                        <div class="text-right">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 text-white bg-green-600 hover:bg-green-700 rounded-md font-semibold shadow-md transition-all duration-300">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Formulir
                            </button>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 italic">
                            Setelah mengirim, Anda akan mendapat <strong>Nomor Layanan</strong> untuk pelacakan status, juga
                            via WhatsApp jika tersedia.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
