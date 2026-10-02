@extends('template')
@section('title', 'create - guru')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Tambah guru baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label" for="nip">NIP</label>
                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" required />
            </div> 

            <div class="mb-3">
                <label class="form-label" for="nama_guru">Nama Guru</label>
                <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" id="nama_guru" name="nama_guru" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="mata_pelajaran">Mata Pelajaran</label>
                <input type="text" class="form-control @error('mata_pelajaran') is-invalid @enderror" id="mata_pelajaran" name="mata_pelajaran" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="foto">Foto Guru</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" />
                <small class="text-muted">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="{{ route('guru.index') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection