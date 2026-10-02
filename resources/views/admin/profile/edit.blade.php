@extends('template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin / Profil Sekolah /</span> Edit Profil
    </h4>

    <!-- Notifikasi Error Validasi -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <h6 class="alert-heading fw-bold mb-1">Terjadi Kesalahan!</h6>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bx bx-edit-alt text-primary me-2"></i> Form Perbarui Profil Sekolah</h5>
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Kolom Kiri: Data Identitas Utama -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="npsn">NPSN</label>
                                    <input type="text" class="form-control @error('npsn') is-invalid @enderror" id="npsn" name="npsn" value="{{ old('npsn', $profile->npsn ?? '') }}" placeholder="Masukkan NPSN sekolah" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="nama_sekolah">Nama Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah', $profile->nama_sekolah ?? '') }}" placeholder="Contoh: SDN 6 Mangunreja" required />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="kepala_sekolah">Kepala Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kepala_sekolah') is-invalid @enderror" id="kepala_sekolah" name="kepala_sekolah" value="{{ old('kepala_sekolah', $profile->kepala_sekolah ?? '') }}" placeholder="Nama lengkap beserta gelar" required />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="tahun_berdiri">Tahun Berdiri</label>
                                    <input type="text" class="form-control @error('tahun_berdiri') is-invalid @enderror" id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profile->tahun_berdiri ?? '') }}" placeholder="Contoh: 1985" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="kontak">Kontak / No. Telepon</label>
                                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak" name="kontak" value="{{ old('kontak', $profile->kontak ?? '') }}" placeholder="Contoh: 081234567890" />
                                </div>
                            </div>

                            <!-- Kolom Kanan: Upload File & Alamat -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="logo">Logo Sekolah</label>
                                    @if(isset($profile->logo) && $profile->logo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" class="rounded border p-1" style="height: 60px; object-fit: contain;" />
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/jpeg,image/png,image/jpg" />
                                    <div class="form-text">Format: JPG, JPEG, PNG (Maks. 2MB)</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="foto">Foto Sekolah</label>
                                    @if(isset($profile->foto) && $profile->foto)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto" class="rounded border" style="height: 80px; width: 120px; object-fit: cover;" />
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg" />
                                    <div class="form-text">Format: JPG, JPEG, PNG (Maks. 2MB)</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap sekolah">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Bagian Teks Panjang (Visi Misi & Deskripsi) -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="visi-misi">Visi & Misi</label>
                                <textarea class="form-control @error('visi-misi') is-invalid @enderror" id="visi-misi" name="visi-misi" rows="5" placeholder="Tuliskan Visi dan Misi sekolah di sini...">{{ old('visi-misi', $profile->{'visi-misi'} ?? '') }}</textarea>
                                @error('visi-misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label" for="deskripsi">Deskripsi / Sejarah Sekolah</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" placeholder="Tuliskan sejarah singkat atau deskripsi sekolah...">{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection