<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/mdi/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/vendors/base/vendor.bundle.base.css')); ?>">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/style.css')); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="#" />
</head>

<body>
    <div class="container-scroller">
        <?php echo $__env->make('admin.partical.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <?php echo $__env->yieldContent('content'); ?>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php echo $__env->make('admin.partical.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="<?php echo e(asset('admin/vendors/base/vendor.bundle.base.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/counter.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/dashboard-charts.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/template.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendors/chart.js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendors/progressbar.js/progressbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/jquery.cookie.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('admin/js/dashboard.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(isset($bulanLabels) && isset($jumlahPengajuan)): ?>
        <script>
            const pengajuanLabels = <?php echo json_encode($bulanLabels, 15, 512) ?>;
            const pengajuanData = <?php echo json_encode($jumlahPengajuan, 15, 512) ?>;
        </script>
        <script src="<?php echo e(asset('js/admin/dashboard-charts.js')); ?>"></script>
    <?php endif; ?>

    <?php if(isset($jumlahKonsultasi)): ?>
        <script>
            const konsultasiChart = document.getElementById('konsultasiChart').getContext('2d');
            new Chart(konsultasiChart, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($bulanLabels, 15, 512) ?>,
                    datasets: [{
                        label: 'Jumlah Konsultasi',
                        data: <?php echo json_encode($jumlahKonsultasi, 15, 512) ?>,
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
    <?php endif; ?>

    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?php echo e(session('success')); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>

    <?php if(session('warning')): ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Ditolak',
                text: '<?php echo e(session('warning')); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Dihapus',
                text: '<?php echo e(session('error')); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>

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
<?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>