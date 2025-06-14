@extends('admin.dashboard')
@section('content')
    @php
        $isAdminSistem = Auth::user()->role === 'admin_sistem';
    @endphp

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List Data Pengajuan Surat</h4>
                                <form method="GET" class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                    @if ($isAdminSistem)
                                        <div class="flex-grow-1 flex-sm-grow-0" style="min-width: 200px;">
                                            <select name="kua_id" class="form-select">
                                                <option value="">-- Semua KUA --</option>
                                                @foreach ($kualist as $kua)
                                                    <option value="{{ $kua->id }}"
                                                        {{ request('kua_id') == $kua->id ? 'selected' : '' }}>
                                                        {{ $kua->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div style="width: 400px">
                                        <input type="search" name="search" placeholder="Cari nama..." class="form-control"
                                            value="{{ request('search') }}">
                                    </div>

                                    <div class="d-flex gap-2 flex-wrap flex-sm-nowrap">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="{{ route('admin.surat.view') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </form>

                                <div class="table-responsive custom-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-black">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Nomor HP</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Jenis Surat</th>
                                                <th>KUA Tujuan</th>
                                                <th>Jadwal Pengambilan</th>
                                                <th>Dokumen</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->user->name ?? '-' }}</td>
                                                    <td>{{ $item->user->email ?? '-' }}</td>
                                                    <td>{{ $item->user->nohp ?? '-' }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->tanggal_pengajuan }}</td>
                                                    <td>{{ $item->jenis_surat }}</td>
                                                    <td>{{ $item->kua->nama ?? '-' }} - {{ $item->kua->alamat ?? '-' }}
                                                    <td>
                                                        @if ($item->status === 'Disetujui')
                                                            @if ($item->jadwal_pengambilan)
                                                                <span class="text-success">
                                                                    {{ \Carbon\Carbon::parse($item->jadwal_pengambilan)->translatedFormat('d M Y, H:i') }}
                                                                    WIB
                                                                </span>
                                                            @else
                                                                <span class="text-danger">Belum Diatur</span>
                                                            @endif
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($item->status !== 'Menunggu Verifikasi')
                                                            <a href="{{ asset('storage/' . $item->file_path) }}"
                                                                target="_blank" class="text-primary">
                                                                <i class="mdi mdi-file-document mdi-24px"></i>
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Belum diverifikasi</span>
                                                        @endif
                                                    </td>
                                                    <td> <span class="badge bg-primary">{{ ucfirst($item->status) }}</span>
                                                    </td>
                                                    <td class="d-flex gap-2">
                                                        <form action="{{ route('Surat.updateStatus', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <select name="status" class="form-select form-select-sm"
                                                                onchange="handleSuratStatusChange(this, {{ $item->id }})">
                                                                <option value="">Pilih Status</option>
                                                                @php
                                                                    $statusOptions = [
                                                                        'Diverifikasi',
                                                                        'Dokumen Lengkap',
                                                                        'Disetujui',
                                                                        'Selesai Diambil',
                                                                        'gagal diambil',
                                                                    ];
                                                                @endphp
                                                                @foreach ($statusOptions as $status)
                                                                    <option value="{{ $status }}"
                                                                        @if ($status == $item->status) selected @endif>
                                                                        {{ ucfirst($status) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </form>

                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#rejectModal{{ $item->id }}" title="Tolak"
                                                            style="background: none; border: none; color: orange; cursor: pointer;">
                                                            <i class="mdi mdi-close-circle-outline mdi-24px"></i>
                                                        </button>

                                                        <form action="{{ route('Surat.delete', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Hapus"
                                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                                style="background: none; border: none; color: red; cursor: pointer;">
                                                                <i class="mdi mdi-delete mdi-24px"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if ($data->isEmpty())
                                                <tr>
                                                    <td colspan="{{ $isAdminSistem ? 15 : 15 }}"
                                                        class="text-center py-4 text-muted">
                                                        <i class="mdi mdi-database-remove display-4 d-block mb-2"></i>
                                                        <strong>Belum ada data masuk.</strong>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 flex-column">
                                    <nav>
                                        <ul class="pagination pagination-sm">
                                            {{ $data->links() }}
                                        </ul>
                                    </nav>
                                </div>

                                @foreach ($data as $item)
                                    <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="rejectModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('Surat.reject', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tolak Pengajuan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="catatan" class="form-label">Catatan
                                                                Penolakan</label>
                                                            <textarea name="catatan" id="catatan" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="dokumen_penolakan" class="form-label">Unggah
                                                                Dokumen (opsional)</label>
                                                            <input type="file" name="dokumen_penolakan"
                                                                class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                                            <small class="text-muted">
                                                                Format: PDF, JPG, JPEG, PNG. Maksimal 2MB.
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal Jadwal -->
                                    <div class="modal fade" id="jadwalModalSurat{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="jadwalModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('Surat.updateStatus', $item->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="Disetujui">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="jadwalModalLabel">
                                                            Tentukan Jadwal Pengambilan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="jadwal_pengambilan">Tanggal & Waktu
                                                            Pengambilan</label>
                                                        <input type="datetime-local" name="jadwal_pengambilan"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Jadwal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal untuk pilih tanggal diambil -->
                                    <div class="modal fade" id="diambilModalSurat{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('Surat.updateStatus', $item->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Selesai Diambil">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tentukan Tanggal
                                                            Pengambilan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="diambil_pada">Tanggal dan
                                                            Jam:</label>
                                                        <input type="datetime-local" class="form-control"
                                                            name="diambil_pada" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Jadwal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
