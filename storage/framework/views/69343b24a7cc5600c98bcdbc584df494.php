
<?php $__env->startSection('content'); ?>
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Rumah Ibadah</h4>

                                <form action="<?php echo e(route('rumah-ibadah.import')); ?>" method="POST" enctype="multipart/form-data"
                                    class="d-flex flex-wrap align-items-center gap-3 mb-4">
                                    <?php echo csrf_field(); ?>
                                    <div style="min-width: 200px;">
                                        <input type="file" name="file" class="form-control" accept=".xls,.xlsx"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="mdi mdi-file-excel me-2"></i>
                                        Import Excel
                                    </button>
                                </form>

                                <form method="GET" action="<?php echo e(route('admin.ibadah.view')); ?>"
                                    class="d-flex flex-wrap align-items-center gap-3 mb-3">
                                    <div style="min-width: 180px;">
                                        <select name="jenis" class="form-select">
                                            <option value="">-- Filter Jenis --</option>
                                            <?php $__currentLoopData = $jenisList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($jenis); ?>"
                                                    <?php echo e(request('jenis') == $jenis ? 'selected' : ''); ?>><?php echo e($jenis); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div style="min-width: 180px;">
                                        <select name="kecamatan" class="form-select">
                                            <option value="">-- Filter Kecamatan --</option>
                                            <?php $__currentLoopData = $kecamatanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($kec); ?>"
                                                    <?php echo e(request('kecamatan') == $kec ? 'selected' : ''); ?>><?php echo e($kec); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div style="min-width: 250px;">
                                        <input type="search" name="search" placeholder="Cari nama tempat..."
                                            class="form-control" value="<?php echo e(request('search')); ?>">
                                    </div>

                                    <div class="d-flex gap-2 flex-wrap flex-sm-nowrap">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="<?php echo e(route('admin.ibadah.view')); ?>" class="btn btn-secondary">Reset</a>
                                    </div>
                                </form>

                                <div class="table-responsive custom-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-black">
                                                <th>No</th>
                                                <th>Nama Tempat</th>
                                                <th>Jenis</th>
                                                <th>Alamat</th>
                                                <th>Kontak</th>
                                                <th>Kecamatan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr class="border-b">
                                                    <td class="p-2"><?php echo e($data->firstItem() + $index); ?></td>
                                                    <td class="p-2"><?php echo e($item->nama); ?></td>
                                                    <td class="p-2"><?php echo e($item->jenis); ?></td>
                                                    <td class="p-2"><?php echo e($item->alamat); ?></td>
                                                    <td class="p-2"><?php echo e($item->kontak ?? '-'); ?></td>
                                                    <td class="p-2"><?php echo e($item->kecamatan ?? '-'); ?></td>
                                                    </td>
                                                    <td class="p-2 d-flex gap-2">
                                                        <a href="<?php echo e(route('admin.ibadah.edit', $item->id)); ?>"
                                                            title="Edit" class="text-primary">
                                                            <i class="mdi mdi-pencil mdi-24px"></i>
                                                        </a>

                                                        <form action="<?php echo e(route('admin.ibadah.delete', $item->id)); ?>"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                                            class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" title="Hapus"
                                                                style="background: none; border: none; color: red; cursor: pointer;">
                                                                <i class="mdi mdi-delete mdi-24px"></i>
                                                            </button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="7" class="text-center py-4 text-muted">
                                                        <i class="mdi mdi-database-remove display-4 d-block mb-2"></i>
                                                        <strong>Belum ada data masuk.</strong>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end align-items-center mb-4 flex-column">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <?php echo e($data->links()); ?>

                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/admin/ibadah/view.blade.php ENDPATH**/ ?>