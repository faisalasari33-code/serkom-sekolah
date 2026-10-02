@extends('template')
@section('title', 'create - users')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Tambah siswa baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="nisn"> NISN</label>
                <input type="text" class="form-control  @error('nisn') is-invalid @enderror" id="nisn" name="nisn" required />
            </div> 
            <div class="mb-3">
                <label class="form-label" for="nama_siswa">Nama siswa</label>
                <input type="text" class="form-control  @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">pilih gender anda</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" class="form-control  @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" name="tanggal_masuk" required />
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection