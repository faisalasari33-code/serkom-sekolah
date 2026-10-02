@extends('template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin / Ekstrakurikuler /</span> Edit Data
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Ekstrakurikuler</h5>
                    <a href="{{ route('ekstrakulikuler.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bx bx-arrow-back me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('ekstrakurikuler.update', $ekskul->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="nama_ekstrakulikuler">Nama Ekstrakurikuler</label>
                            <input type="text" class="form-control" id="nama_ekstrakulikuler" name="nama_ekstrakulikuler" value="{{ old('nama_ekstrakulikuler', $ekskul->nama_ekstrakulikuler) }}" placeholder="Contoh: Pramuka, Paskibra, Futsal" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pembina">Nama Pembina</label>
                            <input type="text" class="form-control" id="pembina" name="pembina" value="{{ old('pembina', $ekskul->pembina) }}" placeholder="Nama guru atau pelatih pembimbing" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jadwal_latihan">Jadwal Latihan</label>
                            <input type="text" class="form-control" id="jadwal_latihan" name="jadwal_latihan" value="{{ old('jadwal_latihan', $ekskul->jadwal_latihan) }}" placeholder="Contoh: Setiap Hari Jumat, 15:00 WIB" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="deskripsi">Deskripsi Kegiatan</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Tuliskan deskripsi singkat mengenai kegiatan ekstrakurikuler ini">{{ old('deskripsi', $ekskul->deskripsi) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="foto">Foto Dokumentasi</label>
                            
                            @if($ekskul->foto)
                                <div class="mb-2">
                                    <span class="d-block text-muted small mb-1">Foto Saat Ini:</span>
                                    <img src="{{ asset('storage/' . $ekskul->foto) }}" alt="Foto Ekskul" class="rounded shadow-sm" width="100" style="object-fit: cover; height: 100px;">
                                </div>
                            @else
                                <div class="mb-2 text-muted small">Belum ada foto yang diunggah.</div>
                            @endif

                            <input type="file" class="form-control" id="foto" name="foto" />
                            <div class="form-text">Format: JPG, JPEG, PNG. Ukuran maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto.</div>
                        </div>

                        {{-- Tombol Submit --}}
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection