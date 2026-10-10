@extends('template')
@section('title', 'Edit Berita')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin / Berita /</span> Edit Berita
    </h4>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Edit Berita</h5>
            <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-sm">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="judul">Judul Berita</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="isi">Isi Berita</label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="6" required>{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Foto Berita Saat Ini</label>
                    @if($berita->foto)
                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" class="img-thumbnail mb-2" style="max-height: 150px;">
                    @else
                        <p class="text-muted small">Tidak ada foto.</p>
                    @endif
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti foto. Format: JPG, PNG, JPEG (Max 2MB).</div>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Perbarui Berita
                </button>
            </form>
        </div>
    </div>
</div>
@endsection