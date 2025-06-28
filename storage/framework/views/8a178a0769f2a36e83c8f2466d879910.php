<?php $__env->startSection('content'); ?>
    <section id="profile" class="mt-12 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <!-- Judul -->
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-semibold text-green-700 dark:text-green-400">Profil Saya</h2>
                </div>

                <?php if($errors->any()): ?>
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="list-disc list-inside mt-1">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if(session('warning_nhp') && auth()->user()->nohp == null): ?>
                    <?php if (isset($component)) { $__componentOriginalf0940b4d501e1b7a4494cca474f29f21 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0940b4d501e1b7a4494cca474f29f21 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-box','data' => ['color' => 'yellow','icon' => 'fas fa-exclamation-triangle','title' => 'Lengkapi Data Profil','message' => 'Akun Anda belum memiliki nomor HP. Harap lengkapi agar bisa melanjutkan pengajuan atau konsultasi.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'yellow','icon' => 'fas fa-exclamation-triangle','title' => 'Lengkapi Data Profil','message' => 'Akun Anda belum memiliki nomor HP. Harap lengkapi agar bisa melanjutkan pengajuan atau konsultasi.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0940b4d501e1b7a4494cca474f29f21)): ?>
<?php $attributes = $__attributesOriginalf0940b4d501e1b7a4494cca474f29f21; ?>
<?php unset($__attributesOriginalf0940b4d501e1b7a4494cca474f29f21); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0940b4d501e1b7a4494cca474f29f21)): ?>
<?php $component = $__componentOriginalf0940b4d501e1b7a4494cca474f29f21; ?>
<?php unset($__componentOriginalf0940b4d501e1b7a4494cca474f29f21); ?>
<?php endif; ?>
                <?php endif; ?>

                <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Foto Profil</label>
                        <input type="file" name="profile_photo" accept="image/*"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm">
                        <?php if($user->profile_photo_path): ?>
                            <img src="<?php echo e(asset('storage/' . $user->profile_photo_path)); ?>"
                                class="w-16 h-16 rounded-full mt-2">
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No HP</label>
                        <input type="text" name="nohp" value="<?php echo e(old('nohp', $user->nohp)); ?>"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm">
                    </div>
                    <a href="<?php echo e(route('password.edit')); ?>" class="text-sm text-blue-600 hover:underline">
                        Ingin mengganti password?
                    </a>
                    <div class="text-center">
                        <button type="submit"
                            class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SistemTA\resources\views/profile/edit-profile.blade.php ENDPATH**/ ?>