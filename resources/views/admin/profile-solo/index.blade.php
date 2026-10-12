@extends('template.landing')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                {{-- Header / Banner Card --}}
                <div class="p-4 text-white text-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                    <h3 class="mb-1 fw-bold">Profil Saya</h3>
                    <p class="mb-0 text-white-50">Informasi Biodata Pribadi</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        
                        {{-- Kolom Foto --}}
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset($profil['foto']) }}" 
                                     alt="Foto Profil" 
                                     class="rounded-circle shadow-sm border border-3 border-white"
                                     style="width: 150px; height: 150px; object-fit: cover;"
                                     onerror="this.src='{{ asset('assets/img/avatars/1.png') }}'">
                            </div>
                            <h5 class="mt-3 fw-bold text-dark">{{ $profil['nama'] }}</h5>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold">
                                Aktif
                            </span>
                        </div>

                        {{-- Kolom Informasi Biodata --}}
                        <div class="col-md-8">
                            <h5 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                <i class="fas fa-id-card me-2"></i> Detail Biodata
                            </h5>
                            
                            <table class="table table-borderless table-sm align-middle mb-4">
                                <tr>
                                    <td class="text-muted fw-semibold" style="width: 35%;">Nama Lengkap</td>
                                    <td>: {{ $profil['nama'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">NISN</td>
                                    <td>: {{ $profil['nisn'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Alamat</td>
                                    <td>: {{ $profil['alamat'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Email</td>
                                    <td>: {{ $profil['email'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">No. Telepon</td>
                                    <td>: {{ $profil['telepon'] }}</td>
                                </tr>
                            </table>

                            <div class="d-flex gap-2">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm px-4 rounded-pill">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection