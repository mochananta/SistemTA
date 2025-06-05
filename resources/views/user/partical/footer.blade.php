<footer class="bg-primary-800 dark:bg-gray-900 text-white py-12 transition-colors duration-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <div>
                <div class="flex items-center space-x-2 mb-6">
                    <div class="h-8 w-8 bg-white rounded-full flex items-center justify-center">
                        <span class="text-primary-700 text-sm font-bold">KA</span>
                    </div>
                    <span class="font-semibold text-white text-lg">Kementerian Agama</span>
                </div>
                <p class="text-gray-300 mb-4">
                    Membina dan mengembangkan kehidupan beragamaan yang harmonis, toleran, dan damai di Indonesia.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt mt-1 text-primary-400"></i>
                        <span>Jl. Adi Sucipto No.112, Sobo, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur
                            68418</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-phone mt-1 text-primary-400"></i>
                        <span> (0333) 421349</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-envelope mt-1 text-primary-400"></i>
                        <span>www.kemenagbanyuwangi.web.id</span>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Layanan Utama</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('user.layanan.konsultasi') }}"
                            class="text-white-300 hover:text-white hover:underline transition">Layanan
                            Konsultasi</a></li>
                    <li><a href="{{ route('user.layanan.surat') }}"
                            class="text-white-300 hover:text-white hover:underline transition">Layanan
                            Pengajuan Surat</a></li>
                    <li><a href="{{ url('/') }}#statistik"
                            class="text-white-300 hover:text-white hover:underline transition">Layanan
                            Statistik</a></li>
                    <li><a href="{{ url('/') }}#data"
                            class="text-white-300 hover:text-white hover:underline transition">Layanan
                            Data Tempat Ibadah</a></li>

                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white hover:underline transition">Pusat Bantuan</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white hover:underline transition">FAQ</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white hover:underline transition">Kritik & Saran</a></li>
                </ul>
            </div>
        </div>

        <div class="pt-8 mt-8 border-t border-gray-700 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">© 2023 Kementerian Agama Republik Indonesia. All Rights Reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-400 hover:text-white text-sm transition">Kebijakan Privasi</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition">Syarat & Ketentuan</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
