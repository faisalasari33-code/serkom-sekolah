@extends('template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin / Galeri /</span> Tambah Data Galeri
    </h4>

    <div class="card mb-4">
        <h5 class="card-header">Form Tambah Galeri Baru</h5>
        <div class="card-body">
            
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">JUDUL GALERI</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul galeri" value="{{ old('judul') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">KATEGORI</label>
                    <select name="kategori" id="kategori" class="form-select" onchange="toggleMediaType()" required>
                        <option value="foto" {{ old('kategori') == 'foto' ? 'selected' : '' }}>Foto</option>
                        <option value="video" {{ old('kategori') == 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">TANGGAL</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">STATUS GALERI</label>
                    <select name="status" class="form-select" required>
                        <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="mb-3" id="wrapper-foto">
                    <label class="form-label">UPLOAD FOTO</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/png, image/jpeg, image/jpg">
                    <div class="form-text">Format: JPEG, PNG, JPG (Maksimal 5MB).</div>
                </div>

                <div class="mb-3 d-none" id="wrapper-video">
                    <label class="form-label">UPLOAD FILE VIDEO</label>
                    <input type="file" name="video" id="video" class="form-control" accept="video/mp4,video/mkv,video/ogg">
                    <div class="form-text">Format file: MP4, MOV, OGG (Maksimal 50MB).</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">KETERANGAN</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tulis keterangan foto/video di sini...">{{ old('keterangan') }}</textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                    <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function toggleMediaType() {
        const kategori = document.getElementById('kategori').value;
        const wrapperFoto = document.getElementById('wrapper-foto');
        const wrapperVideo = document.getElementById('wrapper-video');

        if (kategori === 'video') {
            wrapperVideo.classList.remove('d-none');
            wrapperFoto.classList.add('d-none');
        } else {
            wrapperFoto.classList.remove('d-none');
            wrapperVideo.classList.add('d-none');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        toggleMediaType();
    });
</script>
@endsection