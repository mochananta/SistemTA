@extends('admin.dashboard')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Rumah Ibadah</h4>

                                <form action="{{ route('rumah-ibadah.import') }}" method="POST" enctype="multipart/form-data"
                                    class="d-flex flex-wrap align-items-center gap-3 mb-4">
                                    @csrf
                                    <div style="min-width: 200px;">
                                        <input type="file" name="file" class="form-control" accept=".xls,.xlsx"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="mdi mdi-file-excel me-2"></i>
                                        Import Excel
                                    </button>
                                </form>

                                <form method="GET" action="{{ route('admin.ibadah.view') }}"
                                    class="d-flex flex-wrap align-items-center gap-3 mb-3">
                                    <div style="min-width: 180px;">
                                        <select name="jenis" class="form-select">
                                            <option value="">-- Filter Jenis --</option>
                                            @foreach ($jenisList as $jenis)
                                                <option value="{{ $jenis }}"
                                                    {{ request('jenis') == $jenis ? 'selected' : '' }}>{{ $jenis }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="min-width: 180px;">
                                        <select name="kecamatan" class="form-select">
                                            <option value="">-- Filter Kecamatan --</option>
                                            @foreach ($kecamatanList as $kec)
                                                <option value="{{ $kec }}"
                                                    {{ request('kecamatan') == $kec ? 'selected' : '' }}>{{ $kec }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="min-width: 250px;">
                                        <input type="search" name="search" placeholder="Cari nama tempat..."
                                            class="form-control" value="{{ request('search') }}">
                                    </div>

                                    <div class="d-flex gap-2 flex-wrap flex-sm-nowrap">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="{{ route('admin.ibadah.view') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </form>

                                <div class="table-responsive custom-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-black">
                                                <th>No</th>
                                                <th>Nama Tempat</th>
                                                <th>Jenis</th>
                                                <th>Alamat</th>
                                                <th>Kontak</th>
                                                <th>Kecamatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $index => $item)
                                                <tr class="border-b">
                                                    <td class="p-2">{{ $data->firstItem() + $index }}</td>
                                                    <td class="p-2">{{ $item->nama }}</td>
                                                    <td class="p-2">{{ $item->jenis }}</td>
                                                    <td class="p-2">{{ $item->alamat }}</td>
                                                    <td class="p-2">{{ $item->kontak ?? '-' }}</td>
                                                    <td class="p-2">{{ $item->kecamatan ?? '-' }}</td>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4 text-muted">
                                                        <i class="mdi mdi-database-remove display-4 d-block mb-2"></i>
                                                        <strong>Belum ada data masuk.</strong>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end align-items-center mb-4 flex-column">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            {{ $data->links() }}
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
