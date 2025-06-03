    <!-- Form Lacak Layanan -->
    <section id="lacak" class="py-16 bg-green-50 dark:bg-gray-900 transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <div
                    class="inline-block px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400 bg-green-100 dark:bg-gray-700 rounded-full">
                    Pelacakan Layanan
                </div>
                <h2 class="text-3xl font-bold mt-4 text-gray-900 dark:text-white">
                    Lacak Status Layanan Anda
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Pantau progres layanan Anda secara real-time dengan transparansi dan akses mudah terhadap data
                    layanan publik.
                </p>
            </div>

            <div class="max-w-xl mx-auto bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <form method="POST" action="{{ route('lacak.cek') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="kode_layanan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            ID No Layanan
                        </label>
                        <input type="text" id="kode_layanan" name="kode_layanan" placeholder="Masukkan No Layanan"
                            required
                            class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label for="nohp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor HP
                        </label>
                        <input type="text" id="nohp" name="nohp" placeholder="Masukkan No HP" required
                            class="mt-1 block w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <button type="submit"
                        class="w-full py-2 px-4 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        Lacak Layanan
                    </button>
                </form>

                @if (session('lacak_error'))
                    <div class="mt-4 text-red-600 font-medium">
                        {{ session('lacak_error') }}
                    </div>
                @endif

                @if (session('lacak_data'))
                    @php $data = session('lacak_data'); @endphp

                    <div
                        class="mt-8 max-w-xl mx-auto bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6 border dark:border-gray-700">
                        <div class="space-y-4">
                            {{-- Nomor Layanan --}}
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-300">Nomor
                                    Layanan</label>
                                <input type="text" readonly value="{{ $data->kode_layanan }}" id="kode_layanan_field"
                                    class="w-full mt-1 px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white font-semibold tracking-wider" />
                            </div>

                            {{-- Nama Pemohon --}}
                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-300">Nama
                                    Pemohon/Pengirim</label>
                                <input type="text" readonly value="{{ $data->user->name ?? '-' }}"
                                    id="nama_pemohon_field"
                                    class="w-full mt-1 px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white" />
                            </div>

                            {{-- Jenis Layanan --}}
                            @php
                                $isSurat = get_class($data) === \App\Models\PengajuanSurat::class;
                                $label = $isSurat ? 'PENGAJUAN SURAT' : 'KONSULTASI';
                                $jenis = strtoupper($isSurat ? $data->jenis_surat : $data->jenis_konsultasi);
                            @endphp

                            <div>
                                <label class="text-sm font-semibold text-gray-600 dark:text-gray-300">Layanan</label>
                                <input type="text" readonly value="{{ $label . ' / ' . $jenis }}" id="layanan_field"
                                    class="w-full mt-1 px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white font-medium uppercase" />
                            </div>

                            <div class="status-detail-box mt-6">
                                @switch(strtolower($data->status))
                                    @case('disetujui')
                                        <div
                                            class="bg-green-50 dark:bg-green-900 p-5 rounded-lg border border-green-200 dark:border-green-700 shadow-md">
                                            <h3
                                                class="text-green-700 dark:text-green-300 text-2xl font-bold mb-3 flex justify-center items-center gap-2">
                                                <i class="fas fa-check-circle"></i> Disetujui
                                            </h3>
                                            @if ($isSurat)
                                                <p class="text-sm text-gray-800 dark:text-gray-200">
                                                    Pengajuan Anda telah disetujui. Silakan datang ke kantor KUA untuk mengambil
                                                    dokumen pada:
                                                </p>
                                                <ul class="mt-2 text-sm text-gray-700 dark:text-gray-100 space-y-1">
                                                    <li><strong>Tanggal & Waktu:</strong>
                                                        {{ \Carbon\Carbon::parse($data->jadwal_pengambilan)->translatedFormat('d M Y, H:i') }}
                                                    </li>
                                                </ul>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 italic">
                                                    Mohon hadir sesuai jadwal dan bawa identitas diri.
                                                </p>
                                            @else
                                                <p class="text-sm text-gray-800 dark:text-gray-200">
                                                    Silakan datang ke kantor KUA sesuai jadwal konsultasi berikut:
                                                </p>
                                                <ul class="mt-2 text-sm text-gray-700 dark:text-gray-100 space-y-1">
                                                    <li><strong>Tanggal:</strong>
                                                        {{ \Carbon\Carbon::parse($data->tanggal_konsultasi)->format('d M Y') }}
                                                    </li>
                                                    <li><strong>Jam:</strong> {{ $data->jam_konsultasi }}</li>
                                                </ul>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 italic">
                                                    Harap hadir tepat waktu dan bawa dokumen pendukung jika diminta.
                                                </p>
                                            @endif
                                            <div class="text-center mt-4">
                                                <a href="{{ route('lacak.download', ['kode_layanan' => $data->kode_layanan]) }}"
                                                    class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded transition">
                                                    <i class="fas fa-download mr-2"></i> Download Bukti Pengajuan (PDF)
                                                </a>
                                            </div>
                                        </div>
                                    @break

                                    @case('ditolak')
                                        <div
                                            class="bg-red-50 dark:bg-red-900 p-5 rounded-lg border border-red-200 dark:border-red-700 shadow-md">
                                            <h3
                                                class="text-red-700 dark:text-red-300 text-2xl font-bold mb-3 flex justify-center items-center gap-2">
                                                <i class="fas fa-times-circle"></i> Ditolak
                                            </h3>
                                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                                Pengajuan Anda ditolak. Silakan baca catatan berikut:
                                            </p>
                                            <div
                                                class="mt-3 bg-white dark:bg-gray-800 text-red-700 dark:text-red-200 p-3 rounded border border-red-300 dark:border-red-600 text-sm">
                                                {{ $data->catatan ?? 'Tidak ada catatan yang diberikan.' }}
                                            </div>
                                            @if ($data->dokumen_penolakan)
                                                <div class="mt-3">
                                                    <a href="{{ asset('storage/' . $data->dokumen_penolakan) }}"
                                                        target="_blank" class="text-blue-600 hover:underline text-sm">
                                                        <i class="fas fa-file-download mr-1"></i> Unduh Dokumen Penolakan
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @break

                                    @case('diverifikasi')
                                        <x-status-box color="blue" icon="fas fa-user-check" title="Diverifikasi"
                                            message="Permohonan Anda telah diverifikasi oleh admin. Selanjutnya akan diproses lebih lanjut." />
                                    @break

                                    @case('dokumen lengkap')
                                        <x-status-box color="indigo" icon="fas fa-folder-open" title="Dokumen Lengkap"
                                            message="Semua dokumen telah diterima. Tunggu jadwal berikutnya dari petugas." />
                                    @break

                                    @case('selesai diambil')
                                        <x-status-box color="green" icon="fas fa-box-open" title="Selesai Diambil"
                                            message="Layanan telah selesai. Dokumen diambil pada {{ \Carbon\Carbon::parse($data->diambil_pada)->translatedFormat('d M Y, H:i') }}." />
                                    @break

                                    @case('gagal diambil')
                                        <x-status-box color="red" icon="fas fa-exclamation-triangle" title="Gagal Diambil"
                                            message="Anda tidak mengambil dokumen dalam waktu 2 hari setelah jadwal yang telah ditentukan. Silakan hubungi petugas untuk proses lebih lanjut atau ajukan ulang bila diperlukan." />
                                    @break

                                    @default
                                        <x-status-box color="yellow" icon="fas fa-hourglass-half" title="Menunggu Verifikasi"
                                            message="Permohonan Anda sedang diproses. Harap menunggu notifikasi selanjutnya." />
                                @endswitch
                            </div>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </section>
