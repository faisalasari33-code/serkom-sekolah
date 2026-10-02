@extends('template')

@section('title', 'edit - siswa')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Edit Data Siswa</h5>
    </div>
    <div class="card-body">

        <!-- Menampilkan Pesan Error Validasi -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mb-3" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li><small>{{ $error }}</small></li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="nisn">NISN</label>
                <input type="text" class="form-control" id="name" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" placeholder="Masukkan nisn..." autocomplete="off" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="nama_siswa">nama_siswa</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" placeholder="Masukkan nama anda..." autocomplete="off" required />
            </div>

             <div class="mb-3">
                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-select" id="role" name="jenis_kelamin" required>
                    <option value="">pilih jenis-kelamin</option>
                    <option value="Laki-Laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

             <div class="mb-3">
                  <label class="form-label" for="tanggal-masuk">tanggal_masuk</label>
                  <input type="text" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $siswa->tanggal_masuk ?? '') }}" placeholder="Contoh: 1985" />
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection