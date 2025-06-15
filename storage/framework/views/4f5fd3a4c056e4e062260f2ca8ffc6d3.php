
<?php $__env->startSection('content'); ?>
    <?php
        $isAdminSistem = Auth::user()->role === 'admin_sistem';
    ?>

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List Data Pengajuan Surat</h4>
                                <form method="GET" class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                    <?php if($isAdminSistem): ?>
                                        <div class="flex-grow-1 flex-sm-grow-0" style="min-width: 200px;">
                                            <select name="kua_id" class="form-select">
                                                <option value="">-- Semua KUA --</option>
                                                <?php $__currentLoopData = $kualist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kua): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($kua->id); ?>"
                                                        <?php echo e(request('kua_id') == $kua->id ? 'selected' : ''); ?>>
                                                        <?php echo e($kua->nama); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>

                                    <div style="width: 400px">
                                        <input type="search" name="search" placeholder="Cari nama..." class="form-control"
                                            value="<?php echo e(request('search')); ?>">
                                    </div>

                                    <div class="d-flex gap-2 flex-wrap flex-sm-nowrap">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="<?php echo e(route('admin.surat.view')); ?>" class="btn btn-secondary">Reset</a>
                                    </div>
                                </form>

                                <div class="table-responsive custom-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-black">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Nomor HP</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Jenis Surat</th>
                                                <th>KUA Tujuan</th>
                                                <th>Jadwal Pengambilan</th>
                                                <th>Dokumen</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($index + 1); ?></td>
                                                    <td><?php echo e($item->user->name ?? '-'); ?></td>
                                                    <td><?php echo e($item->user->email ?? '-'); ?></td>
                                                    <td><?php echo e($item->user->nohp ?? '-'); ?></td>
                                                    <td><?php echo e($item->alamat); ?></td>
                                                    <td><?php echo e($item->tanggal_pengajuan); ?></td>
                                                    <td><?php echo e($item->jenis_surat); ?></td>
                                                    <td><?php echo e($item->kua->nama ?? '-'); ?> - <?php echo e($item->kua->alamat ?? '-'); ?>

                                                    <td>
                                                        <?php if($item->status === 'Disetujui'): ?>
                                                            <?php if($item->jadwal_pengambilan): ?>
                                                                <span class="text-success">
                                                                    <?php echo e(\Carbon\Carbon::parse($item->jadwal_pengambilan)->translatedFormat('d M Y, H:i')); ?>

                                                                    WIB
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="text-danger">Belum Diatur</span>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="text-muted">-</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td>
                                                        <?php if($item->status !== 'Menunggu Verifikasi'): ?>
                                                            <a href="<?php echo e(asset('storage/' . $item->file_path)); ?>"
                                                                target="_blank" class="text-primary">
                                                                <i class="mdi mdi-file-document mdi-24px"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="text-muted">Belum diverifikasi</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <span class="badge bg-primary"><?php echo e(ucfirst($item->status)); ?></span>
                                                    </td>
                                                    <td class="d-flex gap-2">
                                                        <form action="<?php echo e(route('Surat.updateStatus', $item->id)); ?>"
                                                            method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <select name="status" class="form-select form-select-sm"
                                                                onchange="handleSuratStatusChange(this, <?php echo e($item->id); ?>)">
                                                                <option value="">Pilih Status</option>
                                                                <?php
                                                                    $statusOptions = [
                                                                        'Diverifikasi',
                                                                        'Dokumen Lengkap',
                                                                        'Disetujui',
                                                                        'Selesai Diambil',
                                                                        'gagal diambil',
                                                                    ];
                                                                ?>
                                                                <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($status); ?>"
                                                                        <?php if($status == $item->status): ?> selected <?php endif; ?>>
                                                                        <?php echo e(ucfirst($status)); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </form>

                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#rejectModal<?php echo e($item->id); ?>" title="Tolak"
                                                            style="background: none; border: none; color: orange; cursor: pointer;">
                                                            <i class="mdi mdi-close-circle-outline mdi-24px"></i>
                                                        </button>

                                                        <form action="<?php echo e(route('Surat.delete', $item->id)); ?>"
                                                            method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" title="Hapus"
                                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                                style="background: none; border: none; color: red; cursor: pointer;">
                                                                <i class="mdi mdi-delete mdi-24px"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($data->isEmpty()): ?>
                                                <tr>
                                                    <td colspan="<?php echo e($isAdminSistem ? 15 : 15); ?>"
                                                        class="text-center py-4 text-muted">
                                                        <i class="mdi mdi-database-remove display-4 d-block mb-2"></i>
                                                        <strong>Belum ada data masuk.</strong>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 flex-column">
                                    <nav>
                                        <ul class="pagination pagination-sm">
                                            <?php echo e($data->links()); ?>

                                        </ul>
                                    </nav>
                                </div>

                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="modal fade" id="rejectModal<?php echo e($item->id); ?>" tabindex="-1"
                                        aria-labelledby="rejectModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="<?php echo e(route('Surat.reject', $item->id)); ?>" method="POST"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tolak Pengajuan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="catatan" class="form-label">Catatan
                                                                Penolakan</label>
                                                            <textarea name="catatan" id="catatan" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="dokumen_penolakan" class="form-label">Unggah
                                                                Dokumen (opsional)</label>
                                                            <input type="file" name="dokumen_penolakan"
                                                                class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                                            <small class="text-muted">
                                                                Format: PDF, JPG, JPEG, PNG. Maksimal 2MB.
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal Jadwal -->
                                    <div class="modal fade" id="jadwalModalSurat<?php echo e($item->id); ?>" tabindex="-1"
                                        aria-labelledby="jadwalModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="<?php echo e(route('Surat.updateStatus', $item->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="Disetujui">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="jadwalModalLabel">
                                                            Tentukan Jadwal Pengambilan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="jadwal_pengambilan">Tanggal & Waktu
                                                            Pengambilan</label>
                                                        <input type="datetime-local" name="jadwal_pengambilan"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Jadwal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal untuk pilih tanggal diambil -->
                                    <div class="modal fade" id="diambilModalSurat<?php echo e($item->id); ?>" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="<?php echo e(route('Surat.updateStatus', $item->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="Selesai Diambil">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tentukan Tanggal
                                                            Pengambilan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="diambil_pada">Tanggal dan
                                                            Jam:</label>
                                                        <input type="datetime-local" class="form-control"
                                                            name="diambil_pada" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Jadwal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/admin/surat/view.blade.php ENDPATH**/ ?>