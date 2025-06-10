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

<body @if (session('kode_layanan')) data-kodelayanan="{{ session('kode_layanan') }}" @endif
    class="h-full w-full w-screen h-screen font-sans bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white transition-colors duration-300">

    <!-- Navigation -->
    @include('user.partical.navbar')


    <!-- Main Content -->
    @yield('content')
    @push('script')
    @endpush

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
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@1.37.3"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('user/darkmode.js') }}"></script>
    <script src="{{ asset('user/kodelayanan.js') }}"></script>
    <script src="{{ asset('user/animasi.js') }}"></script>
    <script src="{{ asset('user/statistik.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>


    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3500)" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
            class="fixed top-5 right-5 z-50 flex items-center gap-3 bg-green-500 text-white text-sm px-4 py-3 rounded-lg shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        window.chartData = {
            donutLabels: @json($labels ?? []),
            donutSeries: @json($donutSeries ?? []),
            lineLabels: @json($lineLabels ?? []),
            lineSurat: @json($lineSurat ?? []),
            lineKonsultasi: @json($lineKonsultasi ?? []),
        };
    </script>

    <script>
        const kecamatanSelect = document.getElementById('kecamatan');
        const jenisSelect = document.getElementById('jenis');
        const rumahIbadahSelect = document.getElementById('rumah_ibadah_id');

        kecamatanSelect.addEventListener('change', fetchRumahIbadah);
        jenisSelect.addEventListener('change', fetchRumahIbadah);

        function fetchRumahIbadah() {
            const kecamatan = kecamatanSelect.value;
            const jenis = jenisSelect.value;
            console.log('Dipilih kecamatan:', kecamatan, 'jenis:', jenis);

            if (!kecamatan || !jenis) {
                rumahIbadahSelect.innerHTML = '<option value="">-- Pilih Rumah Ibadah --</option>';
                return;
            }

            fetch(`/api/rumah-ibadah?kecamatan=${encodeURIComponent(kecamatan)}&jenis=${encodeURIComponent(jenis)}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Data rumah ibadah diterima:', data);
                    rumahIbadahSelect.innerHTML = '<option value="">-- Pilih Rumah Ibadah --</option>';
                    data.forEach(item => {
                        const opt = document.createElement('option');
                        opt.value = item.id;
                        opt.textContent = `${item.nama} - ${item.alamat}`;
                        rumahIbadahSelect.appendChild(opt);
                    });
                })
                .catch(error => {
                    console.error('Gagal memuat rumah ibadah:', error);
                });
        }
    </script>

    <script>
        $(function() {
            if ($('#kode_layanan_field').length) {
                let kodeLayanan = $('#kode_layanan_field').val();
                let nohp = $('#hidden_nohp').val(); // ambil dari hidden field, bukan input yang sudah hilang

                if (kodeLayanan && nohp) {
                    setInterval(function() {
                        $.ajax({
                            url: '/api/status-layanan',
                            method: 'GET',
                            data: {
                                kode_layanan: kodeLayanan,
                                nohp: nohp
                            },
                            success: function(res) {
                                $('.status-layanan-text').text(res.status);
                                $('.status-layanan-updated').text(res.updated_at);

                                if (res.catatan) {
                                    $('.catatan-text').text(res.catatan);
                                    $('.status-layanan-catatan').show();
                                } else {
                                    $('.catatan-text').text('');
                                    $('.status-layanan-catatan').hide();
                                }

                                let box = $('.status-detail-box');
                                let html = '';

                                switch (res.status) {
                                    case 'disetujui':
                                        html = `<div class="bg-green-50 dark:bg-green-900 p-5 rounded-lg border border-green-200 dark:border-green-700 shadow-md">
                                    <h3 class="text-green-700 dark:text-green-300 text-2xl font-bold mb-3 flex justify-center items-center gap-2">
                                        <i class="fas fa-check-circle"></i> Disetujui
                                    </h3>
                                    <p class="text-sm text-gray-800 dark:text-gray-200">
                                        Silakan bawa berkas asli ke kantor KUA tujuan untuk proses lebih lanjut.
                                    </p>
                                </div>`;
                                        break;

                                    case 'ditolak':
                                        html = `<div class="bg-red-50 dark:bg-red-900 p-5 rounded-lg border border-red-200 dark:border-red-700 shadow-md">
                                    <h3 class="text-red-700 dark:text-red-300 text-2xl font-bold mb-3 flex justify-center items-center gap-2">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </h3>
                                    <p class="text-sm text-gray-800 dark:text-gray-200">
                                        Pengajuan Anda ditolak. Silakan baca catatan berikut:
                                    </p>
                                    <div class="mt-3 bg-white dark:bg-gray-800 text-red-700 dark:text-red-200 p-3 rounded border border-red-300 dark:border-red-600 text-sm">
                                        ${res.catatan || 'Tidak ada catatan yang diberikan.'}
                                    </div>
                                </div>`;
                                        break;

                                    default:
                                        html = `<div class="bg-gray-50 dark:bg-gray-700 p-5 rounded-lg border border-gray-300 dark:border-gray-600 shadow-md">
                                    <p>Status saat ini: ${res.status}</p>
                                </div>`;
                                }

                                box.html(html);
                            },
                            error: function(err) {
                                console.error('Gagal ambil status layanan:', err);
                            }
                        });
                    }, 10000); // polling 10 detik
                }
            }
        });
    </script>

    <script>
        function searchRumahIbadah() {
            const keyword = document.getElementById('searchInput').value;
            const tbody = document.getElementById('rumahIbadahBody');

            if (keyword.trim() === '') return;

            fetch(`/search-rumah-ibadah?q=${encodeURIComponent(keyword)}`)
                .then(res => res.json())
                .then(data => {
                    tbody.innerHTML = '';

                    if (data.length === 0) {
                        tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center px-6 py-4 text-gray-500 dark:text-gray-400">
                                Tidak ada hasil ditemukan.
                            </td>
                        </tr>`;
                        return;
                    }

                    data.forEach((item, index) => {
                        tbody.innerHTML += `
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-6 py-4">${index + 1}</td>
                            <td class="px-6 py-4">${item.nama}</td>
                            <td class="px-6 py-4">${item.jenis}</td>
                            <td class="px-6 py-4">${item.alamat}</td>
                            <td class="px-6 py-4">${item.kecamatan ?? '-'}</td>
                            <td class="px-6 py-4">${item.kontak ?? '-'}</td>
                        </tr>`;
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kuaSelect = document.getElementById('kua_id');
            const kecamatanSelect = document.getElementById('kecamatan');

            kuaSelect.addEventListener('change', async function() {
                const kuaId = this.value;
                if (!kuaId) return;

                try {
                    const response = await fetch(`/api/kuas/${kuaId}`);
                    const data = await response.json();

                    let optionExists = false;
                    for (const option of kecamatanSelect.options) {
                        if (option.value === data.kecamatan) {
                            option.selected = true;
                            optionExists = true;
                            break;
                        }
                    }

                    if (!optionExists && data.kecamatan) {
                        const newOption = document.createElement('option');
                        newOption.value = data.kecamatan;
                        newOption.textContent = data.kecamatan + ' (otomatis)';
                        newOption.selected = true;
                        kecamatanSelect.appendChild(newOption);
                    }

                } catch (err) {
                    console.error('Gagal ambil kecamatan:', err);
                }
            });
        });
    </script>


</body>
</head>

</html>
