@extends('template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Data Galeri</h4>

    <div class="card mb-4">
        <h5 class="card-header">Form Edit Galeri</h5>
        <div class="card-body">
            <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Galeri</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required onchange="toggleMediaInput()">
                        <option value="foto" {{ old('kategori', $galeri->kategori) == 'foto' ? 'selected' : '' }}>Foto</option>
                        <option value="video" {{ old('kategori', $galeri->kategori) == 'video' ? 'selected' : '' }}>Video (.mp4)</option>
                    </select>
                </div>

                <div class="mb-3" id="wrapper-foto">
                    <label class="form-label">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah foto.</small>
                    @if($galeri->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Foto Saat Ini" width="120" class="rounded shadow-sm">
                        </div>
                    @endif
                </div>

                <div class="mb-3" id="wrapper-video" style="display: none;">
                    <label class="form-label">Ganti File Video MP4 (Opsional)</label>
                    <input type="file" name="video" class="form-control" accept="video/mp4,video/mov,video/ogg">
                    <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah video.</small>
                    @if($galeri->video)
                        <div class="mt-2">
                            <video width="200" controls class="rounded shadow-sm">
                                <source src="{{ asset('storage/' . $galeri->video) }}" type="video/mp4">
                            </video>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $galeri->tanggal) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status Publikasi</label>
                    <select name="status" class="form-select" required>
                        <option value="draft" {{ old('status', $galeri->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="publish" {{ old('status', $galeri->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" required>{{ old('keterangan', $galeri->keterangan) }}</textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                    <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleMediaInput() {
    var kategori = document.getElementById('kategori').value;
    var wrapperFoto = document.getElementById('wrapper-foto');
    var wrapperVideo = document.getElementById('wrapper-video');

    if (kategori === 'video') {
        wrapperFoto.style.display = 'none';
        wrapperVideo.style.display = 'block';
    } else {
        wrapperFoto.style.display = 'block';
        wrapperVideo.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleMediaInput();
});
</script>
@endsection