@extends('admin.dashboard')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Item List</h4>
                                <div class="table-responsive custom-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-black">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>Nomor Handphone</th>
                                                <th>Alamat</th>
                                                <th>Jam Konsultasi</th>
                                                <th>Tanggal Konsultasi</th>
                                                <th>Jenis Konsultasi</th>
                                                <th>KUA Tujuan</th>
                                                <th>Isi Konsultasi</th>
                                                <th>Dokumen File</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemList">
                                            @foreach ($data as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->nik }}</td>
                                                    <td>{{ $item->nohp }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->jam_konsultasi }}</td>
                                                    <td>{{ $item->tanggal_konsultasi }}</td>
                                                    <td>{{ $item->jenis_konsultasi }}</td>
                                                    <td>{{ $item->kua->nama ?? '-' }} - {{ $item->kua->alamat ?? '-' }}</td>
                                                    <td>{{ $item->isi_konsultasi }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/' . $item->file_path) }}"
                                                            target="_blank" title="Lihat File"
                                                            style="color: #0d6efd; text-decoration: none; margin-right: 8px;">
                                                            <i class="mdi mdi-file-document mdi-24px"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('Konsultasi.approve', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="catatan"
                                                                value="Diterima oleh admin">
                                                            <button type="submit" title="Setujui"
                                                                style="background: none; border: none; color: green; padding: 0; margin-right: 8px; cursor: pointer;">
                                                                <i class="mdi mdi-check-circle-outline mdi-24px"></i>
                                                            </button>
                                                        </form>

                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#rejectModal{{ $item->id }}" title="Tolak"
                                                            style="background: none; border: none; color: orange; padding: 0; margin-right: 8px; cursor: pointer;">
                                                            <i class="mdi mdi-close-circle-outline mdi-24px"></i>
                                                        </button>

                                                        <form action="{{ route('Konsultasi.delete', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Hapus"
                                                                style="background: none; border: none; color: red; padding: 0; cursor: pointer;">
                                                                <i class="mdi mdi-delete mdi-24px"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                                        <button type="submit" class="btn btn-primary">Submit</button>
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
