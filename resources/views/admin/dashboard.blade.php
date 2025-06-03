<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="#" />
</head>

<body>
    <div class="container-scroller">
        @include('admin.partical.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                @yield('content')
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('admin.partical.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ asset('admin/vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/justgage/justgage.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Ditolak',
                text: '{{ session('warning') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Dihapus',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif


    <script>
        const monthlyLabels = {!! json_encode($months ?? []) !!};
        const monthlyCounts = {!! json_encode(
            isset($monthlyCountsSurat, $monthlyCountsKonsultasi)
                ? collect($monthlyCountsSurat)->zip($monthlyCountsKonsultasi)->map(fn($pair) => $pair[0] + $pair[1])->toArray()
                : array_fill(0, 12, 0),
        ) !!};

        const jenisSuratLabels = {!! json_encode($jenisSuratLabels ?? []) !!};
        const jenisSuratCounts = {!! json_encode($jenisSuratCounts ?? []) !!};

        new Chart(document.getElementById('monthlyChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Total Layanan',
                    data: monthlyCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                responsive: true
            }
        });

        // Jenis Surat Pie Chart
        new Chart(document.getElementById('jenisSuratChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: jenisSuratLabels,
                datasets: [{
                    data: jenisSuratCounts,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <script>
        function handleSuratStatusChange(selectElement, id) {
            const selectedStatus = selectElement.value;

            if (selectedStatus === 'Disetujui') {
                const modal = new bootstrap.Modal(document.getElementById(`jadwalModalSurat${id}`));
                modal.show();
                return;
            }

            if (selectedStatus === 'Selesai Diambil') {
                const modal = new bootstrap.Modal(document.getElementById(`diambilModalSurat${id}`));
                modal.show();
                return;
            }

            if (selectedStatus !== '') {
                selectElement.form.submit();
            }
        }
    </script>

    <script>
        function handleKonsultasiStatusChange(selectElement, id) {
            const selectedStatus = selectElement.value;

            if (selectedStatus === 'Dijadwalkan') {
                const modalId = `#jadwalModal${id}`;
                const modal = new bootstrap.Modal(document.querySelector(modalId));
                modal.show();
                selectElement.value = '';
            } else if (selectedStatus !== '') {
                selectElement.form.submit();
            }
        }
    </script>



</body>

</html>
