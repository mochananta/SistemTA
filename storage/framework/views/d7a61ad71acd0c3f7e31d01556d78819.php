<section id="layanan" class="py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block w-20 h-1 bg-primary-500 mb-4"></div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Layanan Publik</h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Silakan pilih jenis layanan yang ingin Anda ajukan secara online.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-6xl mx-auto">
            <!-- Card 1: Konsultasi -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow hover:shadow-lg transition duration-300 border border-gray-200 dark:border-gray-700">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-comments text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">Layanan Konsultasi</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                    Konsultasi seputar pernikahan, keagamaan, atau pendidikan. Ajukan pertanyaan Anda langsung kepada petugas kami.
                </p>
                <a href="<?php echo e(route('user.layanan.konsultasi')); ?>" class="inline-block px-6 py-2 text-sm font-semibold bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">
                    Ajukan Konsultasi
                </a>
            </div>

            <!-- Card 2: Pengajuan Surat -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow hover:shadow-lg transition duration-300 border border-gray-200 dark:border-gray-700">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-6">
                    <i class="fas fa-envelope-open-text text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-3">Pengajuan Surat</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                    Ajukan permohonan surat resmi seperti surat rekomendasi, izin kegiatan, atau dokumen lainnya melalui sistem online kami.
                </p>
                <a href="<?php echo e(route('user.layanan.surat')); ?>" class="inline-block px-6 py-2 text-sm font-semibold bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">
                    Ajukan Surat
                </a>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\SistemTA\resources\views/user/partical/layanan.blade.php ENDPATH**/ ?>