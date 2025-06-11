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
    <script src="{{ asset('admin/js/counter.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard-charts.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (isset($bulanLabels) && isset($jumlahPengajuan))
        <script>
            const pengajuanLabels = @json($bulanLabels);
            const pengajuanData = @json($jumlahPengajuan);
        </script>
        <script src="{{ asset('js/admin/dashboard-charts.js') }}"></script>
    @endif

    @if (isset($jumlahKonsultasi))
        <script>
            const konsultasiChart = document.getElementById('konsultasiChart').getContext('2d');
            new Chart(konsultasiChart, {
                type: 'bar',
                data: {
                    labels: @json($bulanLabels),
                    datasets: [{
                        label: 'Jumlah Konsultasi',
                        data: @json($jumlahKonsultasi),
                        backgroundColor: '#00c292'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        </script>
    @endif

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
