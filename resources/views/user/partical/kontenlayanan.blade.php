    <!-- Statistik Layanan -->
    <section id="statistik" class="py-16 bg-green-50 dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div
                    class="inline-block px-3 py-1 text-xs font-semibold text-primary-600 dark:text-primary-400 bg-primary-100 dark:bg-gray-700 rounded-full transition-colors duration-300">
                    Statistik Layanan</div>
                <h2 class="text-3xl font-bold mt-4 text-gray-900 dark:text-white">Data Layanan Kementerian Agama</h2>
                <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Transparansi data pelayanan dalam pelayanan publik. Berikut data statistik yang kami telah berikan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-4xl font-bold text-primary-600 dark:text-primary-400">
                        {{ number_format($statistikLayanan['Pendaftaran Pernikahan'] ?? 0) }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Pendaftaran Pernikahan</p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-4xl font-bold text-primary-600 dark:text-primary-400">
                        {{ number_format($statistikLayanan['Wakaf'] ?? 0) }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Wakaf</p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-4xl font-bold text-primary-600 dark:text-primary-400">
                        {{ number_format($statistikLayanan['Rumah Ibadah'] ?? 0) }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Rumah Ibadah</p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-4xl font-bold text-primary-600 dark:text-primary-400">
                        {{ number_format($statistikLayanan['Rekomendasi Pernikahan'] ?? 0) }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Rekomendasi Pernikahan</p>
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Distribusi Jenis Layanan</h3>

                        <div class="relative inline-block text-left">
                            <button id="toggleFilterMenu"
                                class="inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-3 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none">
                                ☰
                            </button>

                            <div id="filterMenu"
                                class="hidden absolute right-0 z-10 mt-2 w-36 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5">
                                <div class="py-1">
                                    <button data-filter="all"
                                        class="w-full text-left px-5 py-2 text-xs text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Semua</button>
                                    <button data-filter="surat"
                                        class="w-full text-left px-5 py-2 text-xs text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Surat</button>
                                    <button data-filter="konsultasi"
                                        class="w-full text-left px-5 py-2 text-xs text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Konsultasi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="donutChart" class="w-full h-64"></div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Perkembangan Layanan per Bulan
                    </h3>
                    <div id="lineChart" class="w-full h-64"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="data" class="py-16 bg-white dark:bg-gray-800 transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <div
                    class="inline-block px-3 py-1 text-xs font-semibold text-primary-600 dark:text-primary-400 bg-primary-100 dark:bg-gray-700 rounded-full transition-colors duration-300">
                    Data Tempat Ibadah
                </div>
                <h2 class="text-3xl font-bold mt-4 text-gray-900 dark:text-white">
                    Data Tempat Ibadah di Banyuwangi
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Menampilkan jenis tempat ibadah, jumlah, dan lokasinya berdasarkan data terbaru.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg p-6 overflow-x-auto">
                <div class="relative mb-4">
                    <input type="text" id="searchInput" placeholder="Cari Nama Tempat Ibadah..."
                        class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                        onkeyup="searchRumahIbadah()">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                        </svg>
                    </div>
                </div>
                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-200 dark:bg-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Tempat</th>
                            <th class="px-6 py-3">Jenis</th>
                            <th class="px-6 py-3">Alamat</th>
                            <th class="px-6 py-3">Kecamatan</th>
                            <th class="px-6 py-3">Kontak</th>
                        </tr>
                    </thead>
                    <tbody id="rumahIbadahBody" class="bg-white dark:bg-gray-800">
                        @forelse ($rumahIbadah as $index => $item)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $item->nama }}</td>
                                <td class="px-6 py-4">{{ $item->jenis }}</td>
                                <td class="px-6 py-4">{{ $item->alamat }}</td>
                                <td class="px-6 py-4">{{ $item->kecamatan ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->kontak ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center px-6 py-4 text-gray-500 dark:text-gray-400">
                                    Tidak ada data rumah ibadah tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6 text-center">
                    {{-- <a href=""
                        class="inline-block bg-indigo-600 text-white text-sm px-5 py-2 rounded hover:bg-indigo-700 transition">
                        Lihat Semua Rumah Ibadah
                    </a> --}}
                </div>
            </div>
        </div>
    </section>

    
