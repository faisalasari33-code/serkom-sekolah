@extends('template')
@section('title', 'Edit - Guru')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Edit Data Guru</h5>
    </div>
    <div class="card-body">

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

        <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label" for="nip">NIP</label>
                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip', $guru->nip) }}" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="nama_guru">Nama Guru</label>
                <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" id="nama_guru" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="mata_pelajaran">Mata Pelajaran</label>
                <input type="text" class="form-control @error('mata_pelajaran') is-invalid @enderror" id="mata_pelajaran" name="mata_pelajaran" value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}" required />
            </div>

    
            <div class="mb-3">
                <label class="form-label" for="foto">Foto Guru</label>
                @if($guru->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" width="80" class="rounded shadow-sm">
                        <div class="form-text">Foto saat ini (biarkan kosong jika tidak ingin mengubah foto).</div>
                    </div>
                @endif
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" />
                <small class="text-muted">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('guru.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection