@extends('template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Profil Sekolah
    </h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header Profil ala Sneat -->
    <div class="card mb-4">
        <div class="user-profile-header-banner" style="height: 180px; background: linear-gradient(135deg, #696cff 0%, #484ec4 100%);"></div>
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4 px-4" style="margin-top: -45px;">
            <div class="flex-shrink-0 mx-sm-0 mx-auto">
                @if(isset($profile->logo) && $profile->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo Sekolah" class="d-block h-auto ms-0 rounded-circle user-profile-img bg-white p-2 shadow" style="width: 100px; height: 100px; object-fit: contain;" />
                @else
                    <img src="{{ asset('assets/img/avatars/8.png') }}" alt="Default Logo" class="d-block h-auto ms-0 rounded-circle user-profile-img bg-white p-2 shadow" style="width: 100px; height: 100px; object-fit: cover;" />
                @endif
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
                <div class="d-flex align-items-center justify-content-between flex-md-row flex-column gap-4 text-start ms-sm-3">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark">{{ $profile->nama_sekolah ?? 'SDN 6 Mangunreja' }}</h3>
                        <p class="text-muted mb-0"><i class="bx bx-badge-check text-primary me-1"></i> NPSN: {{ $profile->npsn ?? '-' }}</p>
                    </div>
                    <div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class="bx bx-edit-alt me-1"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Informasi Profil -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5 mb-4">
            <!-- Foto Gedung Sekolah -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-action-title mb-0"><i class="bx bx-image text-primary me-2"></i> Foto Sekolah</h5>
                </div>
                <div class="card-body text-center">
                    @if(isset($profile->foto) && $profile->foto)
                        <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Sekolah" class="img-fluid rounded w-100 shadow-sm" style="height: 180px; object-fit: cover;" />
                    @else
                        <div class="p-4 bg-light rounded text-muted">
                            <small>Belum ada foto gedung sekolah</small>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kartu Info Singkat -->
            <div class="card">
                <div class="card-body">
                    <small class="text-muted uppercase fw-semibold d-block mb-3">INFORMASI UTAMA</small>
                    <ul class="list-unstyled mb-0">
                        <!-- Kepala Sekolah + Foto -->
                        <li class="d-flex align-items-center mb-3">
                            @if(isset($profile->foto_kepala_sekolah) && $profile->foto_kepala_sekolah)
                                <img src="{{ asset('storage/' . $profile->foto_kepala_sekolah) }}" alt="Kepala Sekolah" class="rounded-circle me-3 shadow-sm" style="width: 45px; height: 45px; object-fit: cover;" />
                            @else
                                <div class="bg-label-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="bx bx-user text-primary fs-4"></i>
                                </div>
                            @endif
                            <div>
                                <span class="fw-semibold text-muted d-block" style="font-size: 11px;">KEPALA SEKOLAH</span>
                                <span class="text-dark fw-medium">{{ $profile->kepala_sekolah ?? '-' }}</span>
                            </div>
                        </li>

                        <!-- Tahun Berdiri -->
                        <li class="d-flex align-items-center mb-3">
                            <div class="bg-label-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <i class="bx bx-calendar text-primary fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-semibold text-muted d-block" style="font-size: 11px;">TAHUN BERDIRI</span>
                                <span class="text-dark fw-medium">{{ $profile->tahun_berdiri ?? '-' }}</span>
                            </div>
                        </li>

                        <!-- Kontak -->
                        <li class="d-flex align-items-center mb-3">
                            <div class="bg-label-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <i class="bx bx-phone text-primary fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-semibold text-muted d-block" style="font-size: 11px;">KONTAK</span>
                                <span class="text-dark fw-medium">{{ $profile->kontak ?? '-' }}</span>
                            </div>
                        </li>

                        <!-- Alamat -->
                        <li class="d-flex align-items-center">
                            <div class="bg-label-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <i class="bx bx-map text-primary fs-4"></i>
                            </div>
                            <div>
                                <span class="fw-semibold text-muted d-block" style="font-size: 11px;">ALAMAT</span>
                                <span class="text-dark fw-medium" style="word-break: break-word;">{{ $profile->alamat ?? '-' }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Visi Misi & Deskripsi -->
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Visi & Misi -->
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"><i class="bx bx-target-lock text-primary me-2"></i> Visi & Misi</h5>
                </div>
                <div class="card-body">
                    <div class="text-dark" style="white-space: pre-line; word-break: break-word; line-height: 1.6;">
                        {{ $profile->{'visi-misi'} ?? 'Belum diisi.' }}
                    </div>
                </div>
            </div>

            <!-- Deskripsi / Sejarah -->
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"><i class="bx bx-book-open text-primary me-2"></i> Deskripsi / Sejarah Sekolah</h5>
                </div>
                <div class="card-body">
                    <div class="text-dark" style="white-space: pre-line; word-break: break-word; line-height: 1.6;">
                        {{ $profile->deskripsi ?? 'Belum diisi.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection