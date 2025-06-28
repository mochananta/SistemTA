<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Rumah Ibadah</h4>
                    <form action="<?php echo e(route('admin.ibadah.update', $item->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="form-group">
                            <label>Nama Tempat</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo e(old('nama', $item->nama)); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis</label>
                            <input type="text" name="jenis" class="form-control" value="<?php echo e(old('jenis', $item->jenis)); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required><?php echo e(old('alamat', $item->alamat)); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="<?php echo e(old('kecamatan', $item->kecamatan)); ?>">
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" value="<?php echo e(old('kontak', $item->kontak)); ?>">
                        </div>

                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="<?php echo e(route('admin.ibadah.view')); ?>" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SistemTA\resources\views/admin/ibadah/edit.blade.php ENDPATH**/ ?>