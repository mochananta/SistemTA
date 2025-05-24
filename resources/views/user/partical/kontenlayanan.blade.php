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
                <!-- Card 1 -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-4xl font-bold text-primary-600 dark:text-primary-400">554,124+</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Jamaah Haji yang dilayani</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-4xl font-bold text-primary-600 dark:text-primary-400">221,000</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Pernikahan tercatat</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-4xl font-bold text-primary-600 dark:text-primary-400">1.65 Juta</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Pelajar madrasah</p>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-4xl font-bold text-primary-600 dark:text-primary-400">82,400+</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Wakaf tanah terdaftar</p>
                </div>
            </div>

            <div class="mb-12">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Distribusi Layanan Kementerian
                    Agama (2023)</h3>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-all duration-300">
                    <div id="donutChart" class="w-full h-64"></div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Perkembangan Layanan Kementerian
                    Agama (2019-2023)</h3>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transition-all duration-300">
                    <div id="lineChart" class="w-full h-64"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="data" class="py-16 bg-white dark:bg-gray-800 transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <div
                    class="inline-block px-3 py-1 text-xs font-semibold text-primary-600 dark:text-primary-400 bg-primary-100 dark:bg-gray-700 rounded-full">
                    Data Tempat Ibadah
                </div>
                <h2 class="text-3xl font-bold mt-4 text-gray-900 dark:text-white">
                    Data Tempat Ibadah di Indonesia
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Menampilkan jenis tempat ibadah, jumlah, dan lokasinya berdasarkan data terbaru.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg p-6 overflow-x-auto">
                <div class="mb-4 flex justify-between items-center">
                    <input type="text" id="searchInput" placeholder="Cari data..."
                        class="w-full md:w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" />
                    {{-- <button id="downloadCSV"
                        class="ml-4 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Download CSV
                    </button> --}}
                </div>
                <table id="ibadahTable"
                    class="min-w-full table-auto text-sm text-left text-gray-500 dark:text-gray-300">
                    <thead
                        class="bg-gray-100 dark:bg-gray-700 text-xs uppercase font-medium text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Tempat</th>
                            <th class="px-6 py-3">Jenis</th>
                            <th class="px-6 py-3">Alamat</th>
                            <th class="px-6 py-3">Kecamatan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">Masjid Istiqlal</td>
                            <td class="px-6 py-4">Masjid</td>
                            <td class="px-6 py-4">Jakarta Pusat</td>
                            <td class="px-6 py-4">20000</td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-6 py-4">2</td>
                            <td class="px-6 py-4">Gereja Katedral</td>
                            <td class="px-6 py-4">Gereja Katolik</td>
                            <td class="px-6 py-4">Jakarta Pusat</td>
                            <td class="px-6 py-4">5000</td>
                        </tr>
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-6 py-4">3</td>
                            <td class="px-6 py-4">Pura Besakih</td>
                            <td class="px-6 py-4">Pura</td>
                            <td class="px-6 py-4">Bali</td>
                            <td class="px-6 py-4">3500</td>
                        </tr>
                        <!-- Tambahkan data lainnya -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    