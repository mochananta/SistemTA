<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kementerian Agama Banyuwangi')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('user/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<body

    @if(session('kode_layanan') && session('nohp')) 
        data-kodelayanan="{{ session('kode_layanan') }}" 
        data-nohp="{{ session('nohp') }}" 
    @endif

    class="h-full w-full w-screen h-screen font-sans bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white transition-colors duration-300">

    <!-- Navigation -->
    @include('user.partical.navbar')



    <!-- Main Content -->
     @yield('content')

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('user/darkmode.js') }}"></script>
    <script src="{{ asset('user/kodelayanan.js') }}"></script>
    <script src="{{ asset('user/animasi.js') }}"></script>
    <script src="{{ asset('user/statistik.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@1.37.3"></script>
    <!-- Donut Chart -->
    <script>

    </script>

    <!-- Line Chart -->
    <script>

    </script>
</body>
</head>

</html>
