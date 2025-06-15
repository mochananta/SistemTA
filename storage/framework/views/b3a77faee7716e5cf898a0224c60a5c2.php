<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['color' => 'yellow', 'icon' => 'fas fa-info-circle', 'title', 'message']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['color' => 'yellow', 'icon' => 'fas fa-info-circle', 'title', 'message']); ?>
<?php foreach (array_filter((['color' => 'yellow', 'icon' => 'fas fa-info-circle', 'title', 'message']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="bg-<?php echo e($color); ?>-50 dark:bg-<?php echo e($color); ?>-900 p-5 rounded-lg border border-<?php echo e($color); ?>-200 dark:border-<?php echo e($color); ?>-700 shadow-md">
    <h3 class="text-<?php echo e($color); ?>-700 dark:text-<?php echo e($color); ?>-300 text-2xl font-bold flex justify-center items-center gap-2">
        <i class="<?php echo e($icon); ?>"></i> <?php echo e($title); ?>

    </h3>
    <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
        <?php echo e($message); ?>

    </p>
</div>
<?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/components/status-box.blade.php ENDPATH**/ ?>