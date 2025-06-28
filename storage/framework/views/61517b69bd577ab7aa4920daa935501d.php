
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
                                <h4 class="card-title">List Data Konsultasi</h4>
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
                                                <th>Tanggal Konsultasi</th>
                                                <th>Jenis Konsultasi</th>
                                                <th>KUA Tujuan</th>
                                                <th>Nama Rumah Ibadah</th>
                                                <th>Jenis Rumah Ibadah</th>
                                                <th>Isi Konsultasi</th>
                                                <th>Jadwal Konsultasi</th>
                                                <th>Dokumen File</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemList">
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($data->firstItem() + $index); ?></td>
                                                    <td><?php echo e($item->user->name ?? '-'); ?></td>
                                                    <td><?php echo e($item->user->email ?? '-'); ?></td>
                                                    <td><?php echo e($item->user->nohp ?? '-'); ?></td>
                                                    <td><?php echo e($item->alamat); ?></td>
                                                    <td><?php echo e($item->tanggal_konsultasi); ?></td>
                                                    <td><?php echo e($item->jenis_konsultasi); ?></td>
                                                    <td><?php echo e($item->kua->nama ?? '-'); ?> - <?php echo e($item->kua->alamat ?? '-'); ?>

                                                    </td>
                                                    <td><?php echo e($item->rumahIbadah ? $item->rumahIbadah->nama . ' - ' . $item->rumahIbadah->alamat : '-'); ?>

                                                    </td>
                                                    <td><?php echo e($item->rumahIbadah ? $item->rumahIbadah->jenis : '-'); ?></td>
                                                    <td><?php echo e($item->isi_konsultasi); ?></td>
                                                    <td>
                                                        <?php if($item->status === 'Dijadwalkan' && $item->jadwal_konsultasi_tanggal && $item->jadwal_konsultasi_jam): ?>
                                                            <span class="text-success">
                                                                <?php echo e(\Carbon\Carbon::parse($item->jadwal_konsultasi_tanggal . ' ' . $item->jadwal_konsultasi_jam)->translatedFormat('d M Y, H:i')); ?>

                                                                WIB
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="text-muted">Belum Dijadwalkan</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($item->status !== 'Menunggu Verifikasi'): ?>
                                                            <a href="<?php echo e(asset('storage/' . $item->file_path)); ?>"
                                                                target="_blank" class="text-primary">
                                                                <i class="mdi mdi-file-document mdi-24px"></i>
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="text-muted">Belum diproses</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <span class="badge bg-primary"><?php echo e(ucfirst($item->status)); ?></span>
                                                    </td>
                                                    <td class="d-flex gap-2">
                                                        <form action="<?php echo e(route('Konsultasi.updateStatus', $item->id)); ?>"
                                                            method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <select name="status" class="form-select form-select-sm"
                                                                onchange="handleKonsultasiStatusChange(this, <?php echo e($item->id); ?>)">
                                                                <option value="">Pilih Status</option>
                                                                <?php
                                                                    $statusOptions = [
                                                                        'Diproses',
                                                                        'Dijadwalkan',
                                                                        'Selesai',
                                                                        'Tidak Hadir',
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

                                                        <form action="<?php echo e(route('Konsultasi.delete', $item->id)); ?>"
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
                            </div>
                        </div>
                    </div>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="modal fade" id="rejectModal<?php echo e($item->id); ?>" tabindex="-1"
                            aria-labelledby="rejectModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?php echo e(route('Konsultasi.reject', $item->id)); ?>" method="POST">
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
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal fade" id="jadwalModal<?php echo e($item->id); ?>" tabindex="-1"
                            aria-labelledby="jadwalModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?php echo e(route('Konsultasi.updateStatus', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="status" value="Dijadwalkan">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Atur Jadwal Konsultasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="jadwal_konsultasi_tanggal<?php echo e($item->id); ?>"
                                                    class="form-label">Tanggal</label>
                                                <input type="date" class="form-control"
                                                    name="jadwal_konsultasi_tanggal"
                                                    id="jadwal_konsultasi_tanggal<?php echo e($item->id); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jadwal_konsultasi_jam<?php echo e($item->id); ?>"
                                                    class="form-label">Jam</label>
                                                <input type="time" class="form-control" name="jadwal_konsultasi_jam"
                                                    id="jadwal_konsultasi_jam<?php echo e($item->id); ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan Jadwal</button>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/admin/konsultasi/view.blade.php ENDPATH**/ ?>