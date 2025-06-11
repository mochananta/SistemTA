@extends('admin.dashboard')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Rekap Data Layanan Disetujui</h4>

                                <form method="GET" action="{{ route('admin.rekap.view') }}"
                                    class="d-flex flex-wrap gap-3 mb-4">
                                    <div style="min-width: 200px;">
                                        <select name="tipe" class="form-select" onchange="this.form.submit()">
                                            <option value="surat"
                                                {{ request('tipe', 'surat') == 'surat' ? 'selected' : '' }}>Pengajuan Surat
                                            </option>
                                            <option value="konsultasi"
                                                {{ request('tipe') == 'konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                                        </select>
                                    </div>

                                    @if (auth()->user()->role === 'admin_sistem')
                                        <div style="min-width: 200px;">
                                            <select name="kua_id" class="form-select">
                                                <option value="">-- Filter KUA --</option>
                                                @foreach ($kualist as $kua)
                                                    <option value="{{ $kua->id }}"
                                                        {{ request('kua_id') == $kua->id ? 'selected' : '' }}>
                                                        {{ $kua->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    <a href="{{ route('admin.rekap.view') }}" class="btn btn-secondary btn-sm">Reset</a>
                                </form>

                                <hr class="my-4">
                                @if (request('tipe', 'surat') === 'surat')
                                    <h5 class="mb-3">Data Pengajuan Surat Selesai Diambil</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>No HP</th>
                                                    <th>Alamat</th>
                                                    <th>KUA Tujuan</th>
                                                    <th>Jenis Surat</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>Jadwal Pengambilan</th>
                                                    <th>Diambil Pada</th>
                                                    <th>File</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($suratData as $i => $item)
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $item->user->name ?? '-' }}</td>
                                                        <td>{{ $item->user->nohp ?? '-' }}</td>
                                                        <td>{{ $item->alamat ?? '-' }}</td>
                                                        <td>{{ $item->kua->nama ?? '-' }}</td>
                                                        <td>{{ $item->jenis_surat }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ $item->jadwal_pengambilan ? \Carbon\Carbon::parse($item->jadwal_pengambilan)->format('d-m-Y H:i') : '-' }}
                                                        </td>
                                                        <td>{{ $item->diambil_pada ? \Carbon\Carbon::parse($item->diambil_pada)->format('d-m-Y H:i') : '-' }}
                                                        </td>
                                                        <td>
                                                            @if ($item->file_path)
                                                                <a href="{{ asset('storage/' . $item->file_path) }}"
                                                                    target="_blank" class="text-primary">
                                                                    <i class="mdi mdi-file-document mdi-24px"></i>
                                                                </a>
                                                            @else
                                                                <span class="text-muted">Belum tersedia</span>
                                                            @endif
                                                        </td>
                                                        <td> <span
                                                                class="badge bg-primary">{{ ucfirst($item->status) }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="11" class="text-center py-4 text-muted">
                                                            <i class="mdi mdi-database-remove display-4 d-block mb-2"></i>
                                                            <strong>Belum ada data pengajuan surat selesai.</strong>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                @elseif (request('tipe') === 'konsultasi')
                                    <h5 class="mb-3">Data Konsultasi Disetujui</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>No HP</th>
                                                    <th>Jenis Konsultasi</th>
                                                    <th>Alamat</th>
                                                    <th>KUA Tujuan</th>
                                                    <th>Isi Konsultasi</th>
                                                    <th>Tanggal Konsultasi</th>
                                                    <th>Jadwal Konsultasi</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($konsultasiData as $i => $item)
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $item->user->name ?? '-' }}</td>
                                                        <td>{{ $item->user->nohp ?? '-' }}</td>
                                                        <td>{{ $item->jenis_konsultasi }}</td>
                                                        <td>{{ $item->alamat ?? '-' }}</td>
                                                        <td>{{ $item->kua->nama ?? '-' }}</td>
                                                        <td>{{ $item->isi_konsultasi ?? '-' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->format('d-m-Y') }}
                                                        </td>
                                                        <td>
                                                            @if ($item->jadwal_konsultasi_tanggal && $item->jadwal_konsultasi_jam)
                                                                {{ \Carbon\Carbon::parse($item->jadwal_konsultasi_tanggal)->format('d-m-Y') }}
                                                                {{ $item->jadwal_konsultasi_jam }}
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td> <span
                                                                class="badge bg-primary">{{ ucfirst($item->status) }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="11" class="text-center py-4 text-muted">
                                                            <i class="mdi mdi-database-remove display-4 d-block mb-2"></i>
                                                            <strong>Belum ada data konsultasi selesai.</strong>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
