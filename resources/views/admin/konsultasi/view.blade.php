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
                                <h4 class="card-title">List Data Konsultasi</h4>
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
                                                <th>Tanggal Konsultasi</th>
                                                <th>Jenis Konsultasi</th>
                                                <th>KUA Tujuan</th>
                                                <th>Nama Rumah Ibadah</th>
                                                <th>Jenis Rumah Ibadah</th>
                                                <th>Isi Konsultasi</th>
                                                <th>Dokumen File</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemList">
                                            @foreach ($data as $index => $item)
                                                <tr>
                                                    <td>{{ $data->firstItem() + $index }}</td>
                                                    <td>{{ $item->user->name ?? '-' }}</td>
                                                    <td>{{ $item->user->email ?? '-' }}</td>
                                                    <td>{{ $item->user->nohp ?? '-' }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->tanggal_konsultasi }}</td>
                                                    <td>{{ $item->jenis_konsultasi }}</td>
                                                    <td>{{ $item->kua->nama ?? '-' }} - {{ $item->kua->alamat ?? '-' }}
                                                    </td>
                                                    <td>{{ $item->rumahIbadah ? $item->rumahIbadah->nama . ' - ' . $item->rumahIbadah->alamat : '-' }}
                                                    </td>
                                                    <td>{{ $item->rumahIbadah ? $item->rumahIbadah->jenis : '-' }}</td>
                                                    <td>{{ $item->isi_konsultasi }}</td>
                                                    <td>
                                                        @if ($item->status !== 'Menunggu Verifikasi')
                                                            <a href="{{ asset('storage/' . $item->file_path) }}"
                                                                target="_blank" class="text-primary">
                                                                <i class="mdi mdi-file-document mdi-24px"></i>
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Belum diproses</span>
                                                        @endif
                                                    </td>
                                                    <td> <span class="badge bg-primary">{{ ucfirst($item->status) }}</span>
                                                    </td>
                                                    <td class="d-flex gap-2">
                                                        <form action="{{ route('Konsultasi.updateStatus', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <select name="status" class="form-select form-select-sm"
                                                                onchange="handleKonsultasiStatusChange(this, {{ $item->id }})">
                                                                <option value="">Pilih Status</option>
                                                                @php
                                                                    $statusOptions = [
                                                                        'Diproses',
                                                                        'Dijadwalkan',
                                                                        'Selesai',
                                                                        'Tidak Hadir',
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

                                                        <form action="{{ route('Konsultasi.delete', $item->id) }}"
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
                            </div>
                        </div>
                    </div>
                    @foreach ($data as $item)
                        <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="rejectModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('Konsultasi.reject', $item->id) }}" method="POST">
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
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal fade" id="jadwalModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="jadwalModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('Konsultasi.updateStatus', $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Dijadwalkan">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Atur Jadwal Konsultasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="jadwal_konsultasi_tanggal{{ $item->id }}"
                                                    class="form-label">Tanggal</label>
                                                <input type="date" class="form-control"
                                                    name="jadwal_konsultasi_tanggal"
                                                    id="jadwal_konsultasi_tanggal{{ $item->id }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jadwal_konsultasi_jam{{ $item->id }}"
                                                    class="form-label">Jam</label>
                                                <input type="time" class="form-control" name="jadwal_konsultasi_jam"
                                                    id="jadwal_konsultasi_jam{{ $item->id }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan Jadwal</button>
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
@endsection
