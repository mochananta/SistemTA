
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Selamat datang kembali, Admin!</h3>
                        <h6 class="font-weight-normal mb-2">Login terakhir
                            <?php echo e(\Carbon\Carbon::parse(auth()->user()->last_login_at)->diffForHumans()); ?>.</h6>
                    </div>
                    <div class="ms-lg-5 d-lg-flex d-none">
                        <button type="button" class="btn bg-white btn-icon" title="Tampilan Grid">
                            <i class="mdi mdi-view-grid text-success"></i>
                        </button>
                        <button type="button" class="btn bg-white btn-icon ms-2" title="Tampilan List">
                            <i class="mdi mdi-format-list-bulleted font-weight-bold text-primary"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="card text-white" style="background-color: #1E5631;">
                    <div class="card-body text-center">
                        <i class="mdi mdi-home-city-outline mdi-36px mb-2"></i>
                        <h6 class="mb-1">Total Rumah Ibadah</h6>
                        <h4 class="fw-semibold count-up" data-value="<?php echo e($totalRumahIbadah); ?>">0</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white" style="background-color: #2E7D32;">
                    <div class="card-body text-center">
                        <i class="mdi mdi-bank-outline mdi-36px mb-2"></i>
                        <h6 class="mb-1">Total KUA Terdaftar</h6>
                        <h4 class="fw-semibold count-up" data-value="<?php echo e($totalKua); ?>">0</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-dark" style="background-color: #C5B358;">
                    <div class="card-body text-center">
                        <i class="mdi mdi-calendar-check-outline mdi-36px mb-2"></i>
                        <h6 class="mb-1">Layanan Pengajuan Surat Selesai</h6>
                        <h4 class="fw-semibold count-up" data-value="<?php echo e($suratSelesai); ?>">0</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white" style="background-color: #4E6E5D;">
                    <div class="card-body text-center">
                        <i class="mdi mdi-comment-check-outline mdi-36px mb-2"></i>
                        <h6 class="mb-1">Konsultasi Selesai</h6>
                        <h4 class="fw-semibold count-up" data-value="<?php echo e($konsultasiSelesai); ?>">0</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="card-title">Pengajuan Surat Perbulan</h4>
                            <form method="GET" action="<?php echo e(route('admin.index')); ?>">
                                <select name="tahun_pengajuan" onchange="this.form.submit()"
                                    class="form-select form-select-sm">
                                    <?php $__currentLoopData = $tahunListPengajuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($th); ?>"
                                            <?php echo e($th == $tahunPengajuanDipilih ? 'selected' : ''); ?>>
                                            <?php echo e($th); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </form>
                        </div>
                        <canvas id="pengajuanTracker" height="150"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="card-title">Konsultasi Perbulan</h4>
                            <form method="GET" action="<?php echo e(route('admin.index')); ?>">
                                <select name="tahun_konsultasi" onchange="this.form.submit()"
                                    class="form-select form-select-sm">
                                    <?php $__currentLoopData = $tahunListKonsultasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($th); ?>" <?php echo e($th == $tahunDipilih ? 'selected' : ''); ?>>
                                            <?php echo e($th); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </form>
                        </div>
                        <canvas id="konsultasiChart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/admin/index.blade.php ENDPATH**/ ?>