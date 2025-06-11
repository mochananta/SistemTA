@extends('admin.dashboard')
@section('content')
<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Rumah Ibadah</h4>
                    <form action="{{ route('admin.ibadah.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama Tempat</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis</label>
                            <input type="text" name="jenis" class="form-control" value="{{ old('jenis', $item->jenis) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $item->alamat) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $item->kecamatan) }}">
                        </div>

                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $item->kontak) }}">
                        </div>

                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('admin.ibadah.view') }}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
