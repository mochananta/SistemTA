<?php $__env->startSection('content'); ?>
    <div class="mt-20 py-20 flex items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Verifikasi Email</h2>

            <?php if(session('status')): ?>
                <div class="mb-4 text-green-600 text-sm">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mb-4 text-red-600 text-sm">
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-600 focus:border-green-600"
                        placeholder="Isi email anda..." required autofocus>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold transition">
                    Kirim Link Reset
                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.landing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>