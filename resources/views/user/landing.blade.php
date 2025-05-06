<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kementerian Agama Banyuwangi')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<body
    class="h-full w-full w-screen h-screen font-sans bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white transition-colors duration-300">
    <!-- Navigation -->
    @include('user.partical.navbar')



    <!-- Main Content -->
     @yield('content')
     
    <!-- Statistik Section -->
    {{-- <section id="statistik" class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <div class="inline-block px-3 py-1 text-xs font-semibold text-primary-600 dark:text-primary-400 bg-primary-100 dark:bg-gray-700 rounded-full transition-colors duration-300">Data Keagamaan</div>
                <h2 class="text-3xl font-bold mt-4 text-gray-900 dark:text-white">Statistik Komposisi Agama di Indonesia</h2>
                <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Data keagamaan pemeluk berbagai agama yang tersebar di wilayah Indonesia. Data dapat menjadi acuan untuk berbagai kebijakan agama yang harmonis di masyarakat.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
                <div class="w-full lg:w-1/2">
                    <div class="space-y-6">
                        <!-- Islam -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Islam</span>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">86.7%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-green-500 h-2.5 rounded-full" style="width: 86.7%"></div>
                            </div>
                        </div>

                        <!-- Kristen/Protestan -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Kristen/Protestan</span>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">7.6%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-blue-500 h-2.5 rounded-full" style="width: 7.6%"></div>
                            </div>
                        </div>

                        <!-- Katolik -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Katolik</span>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">3.1%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-indigo-500 h-2.5 rounded-full" style="width: 3.1%"></div>
                            </div>
                        </div>

                        <!-- Hindu -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Hindu</span>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">1.7%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-purple-500 h-2.5 rounded-full" style="width: 1.7%"></div>
                            </div>
                        </div>

                        <!-- Buddha -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Buddha</span>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">0.8%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 0.8%"></div>
                            </div>
                        </div>

                        <!-- Konghucu -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">Konghucu</span>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">0.1%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="bg-red-500 h-2.5 rounded-full" style="width: 0.1%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-gray-500 dark:text-gray-400 italic">
                        * Catatan: Data Sensus Penduduk di Indonesia
                    </div>
                </div>

                <div class="w-full lg:w-1/2 mt-8 lg:mt-0">
                    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 transition-all duration-300">
                        <div id="pieChart" class="w-full h-64"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Footer -->
    @include('user.partical.footer')

    <button id="backToTop"
        class="fixed bottom-8 right-8 bg-primary-600 text-white p-3 rounded-full shadow-lg opacity-0 transition-opacity duration-300 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('user/darkmode.js') }}"></script>
    <script src="{{ asset('user/animasi.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@1.37.3"></script>
    <!-- Donut Chart -->
    <script>
        var optionsDonut = {
            series: [554124, 221000, 1650000, 82400],
            chart: {
                type: 'donut',
                height: 300
            },
            labels: ['Jamaah Haji', 'Pernikahan', 'Pelajar Madrasah', 'Wakaf Tanah'],
            colors: ['#10B981', '#3B82F6', '#8B5CF6', '#F59E0B'],
            legend: {
                position: 'bottom'
            }
        };

        var donutChart = new ApexCharts(document.querySelector("#donutChart"), optionsDonut);
        donutChart.render();
    </script>

    <!-- Line Chart -->
    <script>
        var optionsLine = {
            series: [{
                name: "Layanan",
                data: [1200000, 1500000, 1600000, 1800000, 2000000]
            }],
            chart: {
                height: 300,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: ['2019', '2020', '2021', '2022', '2023']
            },
            colors: ['#6366F1']
        };

        var lineChart = new ApexCharts(document.querySelector("#lineChart"), optionsLine);
        lineChart.render();
    </script>
</body>
</head>

</html>
