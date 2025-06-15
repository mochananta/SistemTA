

<?php $__env->startSection('content'); ?>
    <?php
        $konsultasiList = $konsultasi;
    ?>
    <section id="profile" class="mt-12 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-green-700 dark:text-green-400">Profil Saya</h2>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex flex-col sm:flex-row sm:items-center gap-6 mb-10">
                <img src="<?php echo e(Auth::user()->profile_photo_url); ?>" alt="Avatar"
                    class="w-24 h-24 rounded-full object-cover border-4 border-green-500 shadow">

                <div class="flex-1">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        <?php echo e($user->name); ?>

                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        <?php echo e($user->email); ?>

                    </p>
                    <?php if($user->nohp): ?>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                            <?php echo e($user->nohp); ?>

                        </p>
                    <?php endif; ?>

                    <div class="mt-4 flex gap-4 items-center">
                        <!-- Edit Profile -->
                        <a href="<?php echo e(route('profile.edit')); ?>" title="Edit Profil"
                            class="hover:scale-110 transition-transform duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-gray-600 hover:text-blue-600 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9" />
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                            </svg>
                        </a>

                        <!-- Ganti Password -->
                        <a href="<?php echo e(route('password.edit')); ?>" title="Ganti Password"
                            class="hover:scale-110 transition-transform duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-gray-600 hover:text-yellow-600 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </a>

                        <!-- Hapus Akun -->
                        <form action="<?php echo e(route('profile.destroy')); ?>" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus akun ini?')" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" title="Hapus Akun"
                                class="hover:scale-110 transition-transform duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-gray-600 hover:text-red-600 mt-1 transition" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6" />
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    <line x1="10" x2="10" y1="11" y2="17" />
                                    <line x1="14" x2="14" y1="11" y2="17" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 overflow-auto">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Riwayat Pengajuan Surat</h3>
                    <?php $__currentLoopData = [
            'diproses' => 'Sedang Diproses',
            'disetujui' => 'Disetujui & Siap Diambil',
            'selesai' => 'Selesai Diambil',
            'gagal' => 'Gagal Diambil',
            'ditolak' => 'Ditolak',
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $judul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-4">
                            <h4 class="text-xs font-bold text-gray-600 dark:text-gray-300 mb-1"><?php echo e($judul); ?></h4>
                            <table class="w-full text-xs table-auto border border-gray-200 dark:border-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-2 py-1 text-left">Jenis</th>
                                        <th class="px-2 py-1 text-left">Tanggal</th>
                                        <th class="px-2 py-1 text-left">Status</th>
                                        <th class="px-2 py-1 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $pengajuanSurat[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="border-t border-gray-200 dark:border-gray-600">
                                            <td class="px-2 py-1"><?php echo e($surat->jenis_surat); ?></td>
                                            <td class="px-2 py-1"><?php echo e($surat->created_at->format('d M Y, H:i')); ?></td>
                                            <td class="px-2 py-1">
                                                <span
                                                    class="px-2 py-0.5 rounded-full font-medium
                                                <?php switch($surat->status):
                                                    case ('Menunggu Verifikasi'): ?> bg-yellow-100 text-yellow-800 <?php break; ?>
                                                    <?php case ('Diverifikasi'): ?> bg-blue-100 text-blue-800 <?php break; ?>
                                                    <?php case ('Dokumen Lengkap'): ?> bg-green-100 text-green-800 <?php break; ?>
                                                    <?php case ('Disetujui'): ?> bg-blue-100 text-blue-800 <?php break; ?>
                                                    <?php case ('Selesai Diambil'): ?> bg-indigo-100 text-indigo-800 <?php break; ?>
                                                    <?php case ('ditolak'): ?> bg-red-100 text-red-800 <?php break; ?>
                                                    <?php case ('gagal diambil'): ?> bg-red-100 text-red-800 <?php break; ?>
                                                    <?php default: ?> bg-gray-200 text-gray-800
                                                <?php endswitch; ?>">
                                                    <?php echo e(ucfirst($surat->status)); ?>

                                                </span>
                                            </td>
                                            <td class="px-1 py-1">
                                                <button
                                                    onclick="document.getElementById('modal-<?php echo e($surat->id); ?>').classList.remove('hidden')"
                                                    class="mt-1 inline-block text-xs font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 transition">
                                                    Detail
                                                </button>

                                                <?php if(in_array(strtolower($surat->status), ['ditolak', 'gagal diambil'])): ?>
                                                    <button
                                                        onclick="document.getElementById('modal-edit-<?php echo e($surat->id); ?>').classList.remove('hidden')"
                                                        class="text-xs bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">
                                                        Ajukan Ulang
                                                    </button>
                                                <?php endif; ?>

                                                <div id="modal-edit-<?php echo e($surat->id); ?>"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden">
                                                    <div
                                                        class="relative bg-white dark:bg-gray-900 rounded-xl shadow-lg w-full max-w-lg p-6 mx-4">
                                                        <button
                                                            onclick="document.getElementById('modal-edit-<?php echo e($surat->id); ?>').classList.add('hidden')"
                                                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition text-xl font-bold">&times;
                                                        </button>

                                                        <h2
                                                            class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">
                                                            Ajukan Ulang Surat
                                                        </h2>

                                                        <form method="POST"
                                                            action="<?php echo e(route('pengajuan.update', $surat->id)); ?>"
                                                            enctype="multipart/form-data" class="space-y-4 text-sm">
                                                            <?php echo csrf_field(); ?>

                                                            <div>
                                                                <label>Alamat:</label>
                                                                <input type="text" name="alamat"
                                                                    value="<?php echo e($surat->alamat); ?>" required
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                            </div>

                                                            <div>
                                                                <label>Tanggal Pengajuan:</label>
                                                                <input type="date" name="tanggal_pengajuan"
                                                                    value="<?php echo e(\Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('Y-m-d')); ?>"
                                                                    required
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                            </div>

                                                            <div>
                                                                <label>Pilih KUA:</label>
                                                                <select name="kua_id" required
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                                    <?php $__currentLoopData = $kuas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kua): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($kua->id); ?>"
                                                                            <?php echo e($surat->kua_id == $kua->id ? 'selected' : ''); ?>>
                                                                            <?php echo e($kua->nama); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>

                                                            <div>
                                                                <label>Ganti File (jika perlu):</label>
                                                                <input type="file" name="file_path"
                                                                    accept=".pdf,.jpg,.jpeg,.png"
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                            </div>

                                                            <div class="text-right">
                                                                <button type="submit"
                                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                                                    Kirim Pengajuan Ulang
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div id="modal-<?php echo e($surat->id); ?>"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden">
                                                    <div
                                                        class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md p-6 mx-4 animate-fadeIn">
                                                        <button
                                                            onclick="document.getElementById('modal-<?php echo e($surat->id); ?>').classList.add('hidden')"
                                                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition text-xl font-bold">&times;
                                                        </button>

                                                        <h2
                                                            class="text-xl font-semibold text-gray-800 dark:text-white mb-4">
                                                            Detail Pengajuan Surat
                                                        </h2>

                                                        <div class="text-sm space-y-3 text-gray-700 dark:text-gray-300">
                                                            <div>
                                                                <span class="font-medium">Jenis Surat:</span>
                                                                <span><?php echo e($surat->jenis_surat); ?></span>
                                                            </div>
                                                            <div>
                                                                <span class="font-medium">Tanggal Pengajuan:</span>
                                                                <span><?php echo e($surat->created_at->format('d M Y, H:i')); ?></span>
                                                            </div>
                                                            <div>
                                                                <span class="font-medium">Alamat:</span>
                                                                <span><?php echo e($surat->alamat ?? '-'); ?></span>
                                                            </div>
                                                            <div>
                                                                <span class="font-medium">KUA Tujuan:</span>
                                                                <span><?php echo e($surat->kua->nama ?? '-'); ?></span>
                                                            </div>
                                                            <?php if($surat->jadwal_pengambilan): ?>
                                                                <div>
                                                                    <span class="font-medium">Jadwal Pengambilan:</span>
                                                                    <span><?php echo e(\Carbon\Carbon::parse($surat->jadwal_pengambilan)->format('d M Y, H:i')); ?></span>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if($surat->diambil_pada): ?>
                                                                <div>
                                                                    <span class="font-medium">Diambil Pada</span>
                                                                    <span><?php echo e(\Carbon\Carbon::parse($surat->diambil_pada)->format('d M Y, H:i')); ?></span>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if($surat->file_path): ?>
                                                                <div>
                                                                    <span class="font-medium">Dokumen Surat:</span>
                                                                    <a href="<?php echo e(asset('storage/' . $surat->file_path)); ?>"
                                                                        target="_blank" class="text-blue-600 underline">
                                                                        Lihat Dokumen
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-gray-400 py-2">Tidak ada data</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 overflow-auto">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Riwayat Konsultasi</h3>

                    <?php $__currentLoopData = [
            'diproses' => 'Sedang Diproses',
            'dijadwalkan' => 'Sudah Dijadwalkan',
            'selesai' => 'Selesai',
            'tidak_hadir' => 'Tidak Hadir',
            'ditolak' => 'Ditolak',
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $judul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-4">
                            <h4 class="text-xs font-bold text-gray-600 dark:text-gray-300 mb-1"><?php echo e($judul); ?></h4>
                            <table class="w-full text-xs table-auto border border-gray-200 dark:border-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-2 py-1 text-left">Jenis</th>
                                        <th class="px-2 py-1 text-left">Tanggal</th>
                                        <th class="px-2 py-1 text-left">Status</th>
                                        <th class="px-2 py-1 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $data = $konsultasiList[$key] ?? collect();
                                    ?>

                                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $konsultasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="border-t border-gray-200 dark:border-gray-600">
                                            <td class="px-2 py-1"><?php echo e($konsultasi->jenis_konsultasi); ?></td>
                                            <td class="px-2 py-1"><?php echo e($konsultasi->created_at->format('d M Y, H:i')); ?></td>
                                            <td class="px-2 py-1">
                                                <span
                                                    class="px-2 py-0.5 rounded-full font-medium
                                                <?php switch($konsultasi->status):
                                                    case ('Menunggu Verifikasi'): ?> bg-yellow-100 text-yellow-800 <?php break; ?>
                                                    <?php case ('Diproses'): ?> bg-blue-100 text-blue-800 <?php break; ?>
                                                    <?php case ('Dijadwalkan'): ?> bg-indigo-100 text-indigo-800 <?php break; ?>
                                                    <?php case ('Selesai'): ?> bg-green-100 text-green-800 <?php break; ?>
                                                    <?php case ('Tidak Hadir'): ?> bg-red-100 text-red-800 <?php break; ?>
                                                    <?php case ('Ditolak'): ?> bg-red-100 text-red-800 <?php break; ?>
                                                    <?php default: ?> bg-gray-200 text-gray-800
                                                <?php endswitch; ?>">
                                                    <?php echo e($konsultasi->status); ?>

                                                </span>
                                            </td>
                                            <td class="px-1 py-1">
                                                <button
                                                    onclick="document.getElementById('modal-konsultasi-<?php echo e($konsultasi->id); ?>').classList.remove('hidden')"
                                                    class="mt-1 inline-block text-xs font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 transition">
                                                    Detail
                                                </button>

                                                <?php if(in_array(strtolower($konsultasi->status), ['ditolak', 'tidak hadir'])): ?>
                                                    <button
                                                        onclick="document.getElementById('modal-reapply-konsultasi-<?php echo e($konsultasi->id); ?>').classList.remove('hidden')"
                                                        class="text-xs bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">
                                                        Ajukan Ulang
                                                    </button>
                                                <?php endif; ?>

                                                <div id="modal-reapply-konsultasi-<?php echo e($konsultasi->id); ?>"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden">
                                                    <div
                                                        class="relative bg-white dark:bg-gray-900 rounded-xl shadow-lg w-full max-w-lg p-6 mx-4">
                                                        <button
                                                            onclick="document.getElementById('modal-reapply-konsultasi-<?php echo e($konsultasi->id); ?>').classList.add('hidden')"
                                                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition text-xl font-bold">&times;
                                                        </button>

                                                        <h2
                                                            class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">
                                                            Ajukan Ulang Konsultasi</h2>

                                                        <form method="POST"
                                                            action="<?php echo e(route('konsultasi.update', $konsultasi->id)); ?>"
                                                            enctype="multipart/form-data" class="space-y-4 text-sm">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>

                                                            <input type="hidden" name="is_reapply" value="1">
                                                            <div>
                                                                <label>Alamat:</label>
                                                                <input type="text" name="alamat"
                                                                    value="<?php echo e($konsultasi->alamat); ?>" required
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                            </div>

                                                            <div>
                                                                <label>Tanggal Konsultasi:</label>
                                                                <input type="date" name="tanggal_konsultasi"
                                                                    value="<?php echo e(\Carbon\Carbon::parse($konsultasi->tanggal_konsultasi)->format('Y-m-d')); ?>"
                                                                    required
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                            </div>

                                                            <div>
                                                                <label>Pilih KUA:</label>
                                                                <select name="kua_id" required
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                                    <?php $__currentLoopData = $kuas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kua): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($kua->id); ?>"
                                                                            <?php echo e($konsultasi->kua_id == $kua->id ? 'selected' : ''); ?>>
                                                                            <?php echo e($kua->nama); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>

                                                            <div>
                                                                <label>Isi Konsultasi:</label>
                                                                <input type="text" name="isi_konsultasi"
                                                                    value="<?php echo e($konsultasi->isi_konsultasi); ?>" required
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                            </div>

                                                            <div>
                                                                <label>Ganti File (opsional):</label>
                                                                <input type="file" name="file_path"
                                                                    accept=".pdf,.jpg,.jpeg,.png"
                                                                    class="w-full border rounded px-3 py-2 dark:bg-gray-800 dark:text-white">
                                                            </div>

                                                            <div class="text-right">
                                                                <button type="submit"
                                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                                                    Kirim Pengajuan Ulang
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <div id="modal-konsultasi-<?php echo e($konsultasi->id); ?>"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden">
                                                    <div
                                                        class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md p-6 mx-4 animate-fadeIn">
                                                        <button
                                                            onclick="document.getElementById('modal-konsultasi-<?php echo e($konsultasi->id); ?>').classList.add('hidden')"
                                                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition text-xl font-bold">&times;
                                                        </button>

                                                        <h2
                                                            class="text-xl font-semibold text-gray-800 dark:text-white mb-4">
                                                            Detail Konsultasi</h2>

                                                        <div class="text-sm space-y-3 text-gray-700 dark:text-gray-300">
                                                            <div><span class="font-medium">Jenis Konsultasi:</span>
                                                                <span><?php echo e($konsultasi->jenis_konsultasi); ?></span>
                                                            </div>
                                                            <div><span class="font-medium">Alamat:</span>
                                                                <span><?php echo e($konsultasi->alamat); ?></span>
                                                            </div>
                                                            <div><span class="font-medium">KUA Tujuan:</span>
                                                                <span><?php echo e($konsultasi->kua->nama ?? '-'); ?></span>
                                                            </div>
                                                            <div><span class="font-medium">Tanggal Pengajuan:</span>
                                                                <span><?php echo e($konsultasi->created_at->format('d M Y, H:i')); ?></span>
                                                            </div>

                                                            <?php if($konsultasi->jadwal_konsultasi_tanggal && $konsultasi->jadwal_konsultasi_jam): ?>
                                                                <div>
                                                                    <span class="font-medium">Jadwal Konsultasi:</span>
                                                                    <span><?php echo e(\Carbon\Carbon::parse($konsultasi->jadwal_konsultasi_tanggal . ' ' . $konsultasi->jadwal_konsultasi_jam)->format('d M Y, H:i')); ?></span>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if($konsultasi->file_path): ?>
                                                                <div>
                                                                    <span class="font-medium">Dokumen Konsultasi:</span>
                                                                    <a href="<?php echo e(asset('storage/' . $konsultasi->file_path)); ?>"
                                                                        target="_blank" class="text-blue-600 underline">
                                                                        Lihat Dokumen
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if($konsultasi->jenis_konsultasi === 'Rumah Ibadah' && $konsultasi->rumahIbadah): ?>
                                                                <div class="mt-4 border-t pt-3">
                                                                    <h3
                                                                        class="font-semibold text-gray-800 dark:text-white">
                                                                        Detail Rumah Ibadah</h3>
                                                                    <div><span class="font-medium">Nama:</span>
                                                                        <span><?php echo e($konsultasi->rumahIbadah->nama); ?></span>
                                                                    </div>
                                                                    <div><span class="font-medium">Jenis:</span>
                                                                        <span><?php echo e($konsultasi->rumahIbadah->jenis); ?></span>
                                                                    </div>
                                                                    <div><span class="font-medium">Alamat:</span>
                                                                        <span><?php echo e($konsultasi->rumahIbadah->alamat); ?></span>
                                                                    </div>
                                                                    <div><span class="font-medium">Kontak:</span>
                                                                        <span><?php echo e($konsultasi->rumahIbadah->kontak ?? '-'); ?></span>
                                                                    </div>
                                                                    <div><span class="font-medium">Kecamatan:</span>
                                                                        <span><?php echo e($konsultasi->rumahIbadah->kecamatan ?? '-'); ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-gray-400 py-2">Tidak ada data</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/profile/profile.blade.php ENDPATH**/ ?>