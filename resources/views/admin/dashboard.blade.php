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
    <style>
        .card {
            border-radius: 12px;
            background-color: #fff;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.4rem;
        }

        .text-primary {
            color: #007bff;
        }

        .text-success {
            color: #28a745;
        }

        .text-danger {
            color: #dc3545;
        }

        .pagination .page-item .page-link {
    border-radius: 2px;
    margin: 0 3px;
    color: #0d6efd;
    border: 1px solid #dee2e6;
    transition: all 0.2s ease-in-out;
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
}

.pagination .page-item .page-link:hover {
    background-color: #e2e6ea;
}

    </style>
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

</body>

</html>
