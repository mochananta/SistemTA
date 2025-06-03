@extends('user.landing')

@section('content')
    <section id="profile" class="mt-12 py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-green-700 dark:text-green-400">Profil Saya</h2>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex flex-col sm:flex-row sm:items-center gap-6 mb-10">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="Avatar"
                    class="w-24 h-24 rounded-full object-cover border-4 border-green-500 shadow">

                <div class="flex-1">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</p>
                    @if ($user->nohp)
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $user->nohp }}</p>
                    @endif

                    <div class="mt-4 flex gap-4 items-center">
                        <a href="{{ route('profile.edit') }}" title="Edit Profil">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-gray-600 hover:text-blue-600 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9" />
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                            </svg>
                        </a>

                        <a href="{{ route('password.edit') }}" title="Ganti Password">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-gray-600 hover:text-yellow-600 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </a>

                        <form action="{{ route('profile.destroy') }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus akun ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus Akun">
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
                    @foreach ([
            'diproses' => 'Sedang Diproses',
            'disetujui' => 'Disetujui & Siap Diambil',
            'selesai' => 'Selesai Diambil',
            'gagal' => 'Gagal Diambil',
            'ditolak' => 'Ditolak',
        ] as $key => $judul)
                        <div class="mb-4">
                            <h4 class="text-xs font-bold text-gray-600 dark:text-gray-300 mb-1">{{ $judul }}</h4>
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
                                    @forelse ($pengajuanSurat[$key] as $surat)
                                        <tr class="border-t border-gray-200 dark:border-gray-600">
                                            <td class="px-2 py-1">{{ $surat->jenis_surat }}</td>
                                            <td class="px-2 py-1">{{ $surat->created_at->format('d M Y, H:i') }}</td>
                                            <td class="px-2 py-1">
                                                <span
                                                    class="px-2 py-0.5 rounded-full font-medium
                                                @switch($surat->status)
                                                    @case('Menunggu Verifikasi') bg-yellow-100 text-yellow-800 @break
                                                    @case('Diverifikasi') bg-blue-100 text-blue-800 @break
                                                    @case('Dokumen Lengkap') bg-green-100 text-green-800 @break
                                                    @case('Disetujui') bg-blue-100 text-blue-800 @break
                                                    @case('Selesai Diambil') bg-indigo-100 text-indigo-800 @break
                                                    @case('ditolak') bg-red-100 text-red-800 @break
                                                    @case('gagal diambil') bg-red-100 text-red-800 @break
                                                    @default bg-gray-200 text-gray-800
                                                @endswitch">
                                                    {{ ucfirst($surat->status) }}
                                                </span>
                                            </td>
                                            <td class="px-1 py-1">
                                                <button
                                                    onclick="document.getElementById('modal-{{ $surat->id }}').classList.remove('hidden')"
                                                    class="mt-1 inline-block text-xs font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 transition">
                                                    Detail
                                                </button>

                                                @if (in_array(strtolower($surat->status), ['gagal diambil', 'ditolak']))
                                                    <form action="{{ route('surat.reapply', $surat->id) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="mt-1 inline-block text-xs font-medium text-white bg-green-600 px-2 py-1 rounded hover:bg-green-700 transition"
                                                            onclick="return confirm('Ajukan ulang surat ini?')">
                                                            Ajukan Ulang
                                                        </button>
                                                    </form>
                                                @endif

                                                <div id="modal-{{ $surat->id }}"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden">
                                                    <div
                                                        class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md p-6 mx-4 animate-fadeIn">
                                                        <button
                                                            onclick="document.getElementById('modal-{{ $surat->id }}').classList.add('hidden')"
                                                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition text-xl font-bold">&times;
                                                        </button>

                                                        <h2
                                                            class="text-xl font-semibold text-gray-800 dark:text-white mb-4">
                                                            Detail Pengajuan Surat
                                                        </h2>

                                                        <div class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                                                            <div class="mt-2">
                                                                <span class="font-medium">Jenis Surat:</span>
                                                                <span>{{ $surat->jenis_surat }}</span>
                                                            </div>
                                                            <div class="mt-2">
                                                                <span class="font-medium">Tanggal Pengajuan:</span>
                                                                <span>{{ $surat->created_at->format('d M Y, H:i') }}</span>
                                                            </div>
                                                            <div class="mt-2">
                                                                <span class="font-medium">Status:</span>
                                                                <span>{{ ucfirst($surat->status) }}</span>
                                                            </div>
                                                            @if ($surat->jadwal_pengambilan)
                                                                <div class="mt-2">
                                                                    <span class="font-medium">Jadwal Pengambilan:</span>
                                                                    <span>{{ \Carbon\Carbon::parse($surat->jadwal_pengambilan)->format('d M Y, H:i') }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-gray-400 py-2">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 overflow-auto">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Riwayat Konsultasi</h3>

                    @foreach ([
                            'diproses' => 'Sedang Diproses',
                            'dijadwalkan' => 'Sudah Dijadwalkan',
                            'selesai' => 'Selesai',
                            'tidak_hadir' => 'Tidak Hadir',
                            'ditolak' => 'Ditolak',
                        ] as $key => $judul)
                        <div class="mb-4">
                            <h4 class="text-xs font-bold text-gray-600 dark:text-gray-300 mb-1">{{ $judul }}</h4>
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
                                    @php
                                        $data = $konsultasi[$key] ?? collect();
                                    @endphp

                                    @forelse ($data as $item)
                                        <tr class="border-t border-gray-200 dark:border-gray-600">
                                            <td class="px-2 py-1">{{ $item->jenis_konsultasi }}</td>
                                            <td class="px-2 py-1">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                            <td class="px-2 py-1">
                                                <span
                                                    class="px-2 py-0.5 rounded-full font-medium
                                    @switch($item->status)
                                        @case('Menunggu Verifikasi') bg-yellow-100 text-yellow-800 @break
                                        @case('Diproses') bg-blue-100 text-blue-800 @break
                                        @case('Dijadwalkan') bg-indigo-100 text-indigo-800 @break
                                        @case('Selesai') bg-green-100 text-green-800 @break
                                        @case('Tidak Hadir') bg-red-100 text-red-800 @break
                                        @case('Ditolak') bg-red-100 text-red-800 @break
                                        @default bg-gray-200 text-gray-800
                                    @endswitch">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="px-1 py-1">
                                                <button
                                                    onclick="document.getElementById('modal-konsultasi-{{ $item->id }}').classList.remove('hidden')"
                                                    class="mt-1 inline-block text-xs font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 transition">
                                                    Detail
                                                </button>

                                                <!-- Modal -->
                                                <div id="modal-konsultasi-{{ $item->id }}"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm hidden">
                                                    <div
                                                        class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md p-6 mx-4 animate-fadeIn">
                                                        <button
                                                            onclick="document.getElementById('modal-konsultasi-{{ $item->id }}').classList.add('hidden')"
                                                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition text-xl font-bold">&times;
                                                        </button>

                                                        <h2
                                                            class="text-xl font-semibold text-gray-800 dark:text-white mb-4">
                                                            Detail Konsultasi
                                                        </h2>

                                                        <div class="text-sm space-y-2 text-gray-700 dark:text-gray-300">
                                                            <div>
                                                                <span class="font-medium">Jenis Konsultasi:</span>
                                                                <span>{{ $item->jenis_konsultasi }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="font-medium">Tanggal Pengajuan:</span>
                                                                <span>{{ $item->created_at->format('d M Y, H:i') }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="font-medium">Status:</span>
                                                                <span>{{ $item->status }}</span>
                                                            </div>
                                                            @if ($item->jadwal_konsultasi_tanggal && $item->jadwal_konsultasi_jam)
                                                                <div>
                                                                    <span class="font-medium">Jadwal Konsultasi:</span>
                                                                    <span>{{ \Carbon\Carbon::parse($item->jadwal_konsultasi_tanggal . ' ' . $item->jadwal_konsultasi_jam)->format('d M Y, H:i') }}</span>
                                                                </div>
                                                            @endif
                                                            @if ($item->catatan)
                                                                <div>
                                                                    <span class="font-medium">Catatan:</span>
                                                                    <span>{{ $item->catatan }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-gray-400 py-2">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
