<?php $__env->startSection('content'); ?>
    <section class="mt-12 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6 text-sm text-primary-600 dark:text-primary-400">
                <a href="/" class="font-medium text-gray-800 dark:text-gray-300 hover:text-primary-600">Beranda</a>
                <span class="mx-2 text-gray-400 dark:text-gray-500">/</span>
                <span class="text-gray-600 dark:text-gray-300">Rumah Ibadah</span>
            </div>

            <div class="mb-10 text-center">
                <h2 class="text-3xl font-extrabold text-green-700 dark:text-green-400">Daftar Rumah Ibadah</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400 text-lg">Berikut adalah daftar rumah ibadah yang terdaftar di
                    wilayah Banyuwangi.</p>
            </div>

            <form method="GET" class="mb-8 grid grid-cols-1 md:grid-cols-12 gap-4 text-sm">

                <div class="md:col-span-3 relative">
                    <label for="q" class="sr-only">Cari Nama</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-green-600">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="q" id="q" value="<?php echo e(request('q')); ?>"
                            placeholder="Cari nama tempat..."
                            class="pl-10 pr-3 py-2 w-full border border-gray-300 rounded dark:bg-gray-800 dark:text-white" />
                    </div>
                </div>

                <div class="md:col-span-3 relative">
                    <label for="jenis" class="sr-only">Jenis</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-green-600">
                            <i class="fas fa-place-of-worship"></i>
                        </span>
                        <select name="jenis" id="jenis"
                            class="pl-10 pr-8 py-2 w-full border border-gray-300 rounded dark:bg-gray-800 dark:text-white appearance-none">
                            <option value="">-- Semua Jenis --</option>
                            <?php $__currentLoopData = $jenisList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($jenis); ?>" <?php echo e(request('jenis') == $jenis ? 'selected' : ''); ?>>
                                    <?php echo e($jenis); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 relative">
                    <label for="kecamatan" class="sr-only">Kecamatan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-green-600">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <select name="kecamatan" id="kecamatan"
                            class="pl-10 pr-8 py-2 w-full border border-gray-300 rounded dark:bg-gray-800 dark:text-white appearance-none">
                            <option value="">-- Semua Kecamatan --</option>
                            <?php $__currentLoopData = $kecamatanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kecamatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kecamatan); ?>"
                                    <?php echo e(request('kecamatan') == $kecamatan ? 'selected' : ''); ?>>
                                    <?php echo e($kecamatan); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 flex flex-col md:flex-row gap-2 items-start md:items-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                    <a href="<?php echo e(route('user.partical.rumahibadahdetail')); ?>"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                        <i class="fas fa-sync-alt mr-1"></i> Reset
                    </a>
                </div>
            </form>

            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-200 dark:bg-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Tempat</th>
                            <th class="px-4 py-3">Jenis</th>
                            <th class="px-4 py-3">Alamat</th>
                            <th class="px-4 py-3">Kecamatan</th>
                            <th class="px-4 py-3">Kontak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-3"><?php echo e($data->firstItem() + $index); ?></td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white"><?php echo e($item->nama); ?></td>
                                <td class="px-4 py-3"><?php echo e($item->jenis); ?></td>
                                <td class="px-4 py-3"><?php echo e($item->alamat); ?></td>
                                <td class="px-4 py-3"><?php echo e($item->kecamatan ?? '-'); ?></td>
                                <td class="px-4 py-3"><?php echo e($item->kontak ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Data tidak
                                    ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">
                <?php echo e($data->appends(request()->query())->links('pagination::tailwind')); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SistemTA\resources\views/user/partical/rumahibadahdetail.blade.php ENDPATH**/ ?>