
<?php $__env->startSection('content'); ?>
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Rekap Data Layanan Disetujui</h4>

                                <form method="GET" action="<?php echo e(route('admin.rekap.view')); ?>"
                                    class="d-flex flex-wrap gap-3 mb-4">
                                    <div style="min-width: 200px;">
                                        <select name="tipe" class="form-select" onchange="this.form.submit()">
                                            <option value="surat"
                                                <?php echo e(request('tipe', 'surat') == 'surat' ? 'selected' : ''); ?>>Pengajuan Surat
                                            </option>
                                            <option value="konsultasi"
                                                <?php echo e(request('tipe') == 'konsultasi' ? 'selected' : ''); ?>>Konsultasi</option>
                                        </select>
                                    </div>

                                    <?php if(auth()->user()->role === 'admin_sistem'): ?>
                                        <div style="min-width: 200px;">
                                            <select name="kua_id" class="form-select">
                                                <option value="">-- Filter KUA --</option>
                                                <?php $__currentLoopData = $kualist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kua): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($kua->id); ?>"
                                                        <?php echo e(request('kua_id') == $kua->id ? 'selected' : ''); ?>>
                                                        <?php echo e($kua->nama); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>

                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    <a href="<?php echo e(route('admin.rekap.view')); ?>" class="btn btn-secondary btn-sm">Reset</a>
                                </form>

                                <hr class="my-4">
                                <?php if(request('tipe', 'surat') === 'surat'): ?>
                                    <h5 class="mb-3">Data Pengajuan Surat Selesai Diambil</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>No HP</th>
                                                    <th>Alamat</th>
                                                    <th>KUA Tujuan</th>
                                                    <th>Jenis Surat</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>Jadwal Pengambilan</th>
                                                    <th>Diambil Pada</th>
                                                    <th>File</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $suratData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($i + 1); ?></td>
                                                        <td><?php echo e($item->user->name ?? '-'); ?></td>
                                                        <td><?php echo e($item->user->nohp ?? '-'); ?></td>
                                                        <td><?php echo e($item->alamat ?? '-'); ?></td>
                                                        <td><?php echo e($item->kua->nama ?? '-'); ?></td>
                                                        <td><?php echo e($item->jenis_surat); ?></td>
                                                        <td><?php echo e(\Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y')); ?>

                                                        </td>
                                                        <td><?php echo e($item->jadwal_pengambilan ? \Carbon\Carbon::parse($item->jadwal_pengambilan)->format('d-m-Y H:i') : '-'); ?>

                                                        </td>
                                                        <td><?php echo e($item->diambil_pada ? \Carbon\Carbon::parse($item->diambil_pada)->format('d-m-Y H:i') : '-'); ?>

                                                        </td>
                                                        <td>
                                                            <?php if($item->file_path): ?>
                                                                <a href="<?php echo e(asset('storage/' . $item->file_path)); ?>"
                                                                    target="_blank" class="text-primary">
                                                                    <i class="mdi mdi-file-document mdi-24px"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <span class="text-muted">Belum tersedia</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td> <span
                                                                class="badge bg-primary"><?php echo e(ucfirst($item->status)); ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="11" class="text-center py-4 text-muted">
                                                            <i class="mdi mdi-database-remove display-4 d-block mb-2"></i>
                                                            <strong>Belum ada data pengajuan surat selesai.</strong>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php elseif(request('tipe') === 'konsultasi'): ?>
                                    <h5 class="mb-3">Data Konsultasi Disetujui</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>No HP</th>
                                                    <th>Jenis Konsultasi</th>
                                                    <th>Alamat</th>
                                                    <th>KUA Tujuan</th>
                                                    <th>Isi Konsultasi</th>
                                                    <th>Tanggal Konsultasi</th>
                                                    <th>Jadwal Konsultasi</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $konsultasiData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($i + 1); ?></td>
                                                        <td><?php echo e($item->user->name ?? '-'); ?></td>
                                                        <td><?php echo e($item->user->nohp ?? '-'); ?></td>
                                                        <td><?php echo e($item->jenis_konsultasi); ?></td>
                                                        <td><?php echo e($item->alamat ?? '-'); ?></td>
                                                        <td><?php echo e($item->kua->nama ?? '-'); ?></td>
                                                        <td><?php echo e($item->isi_konsultasi ?? '-'); ?></td>
                                                        <td><?php echo e(\Carbon\Carbon::parse($item->tanggal_konsultasi)->format('d-m-Y')); ?>

                                                        </td>
                                                        <td>
                                                            <?php if($item->jadwal_konsultasi_tanggal && $item->jadwal_konsultasi_jam): ?>
                                                                <?php echo e(\Carbon\Carbon::parse($item->jadwal_konsultasi_tanggal)->format('d-m-Y')); ?>

                                                                <?php echo e($item->jadwal_konsultasi_jam); ?>

                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td> <span
                                                                class="badge bg-primary"><?php echo e(ucfirst($item->status)); ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="11" class="text-center py-4 text-muted">
                                                            <i class="mdi mdi-database-remove display-4 d-block mb-2"></i>
                                                            <strong>Belum ada data konsultasi selesai.</strong>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/admin/rekap/view.blade.php ENDPATH**/ ?>