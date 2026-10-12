@extends('template.landing')

@section('title', 'Profil Sekolah - SDN 6 Mangunreja')

@push('styles')
<style>
    .profil-page {
        background: #fdfdfd;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .profil-container {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .profil-breadcrumb {
        font-size: 15px;
        color: #444;
        margin-bottom: 12px;
        display: block;
    }

    .profil-breadcrumb a {
        color: #333;
        text-decoration: none;
    }

    .profil-breadcrumb a:hover {
        color: #0d6efd;
    }

    .profil-divider {
        border: 0;
        border-top: 1px solid #e5e5e5;
        margin: 12px 0 24px;
        opacity: 1;
    }

    .profil-page-title {
        color: #222;
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 30px;
    }

    .profil-hero-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        padding: 36px;
        margin-bottom: 30px;
    }

    .profil-hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 36px;
        align-items: center;
    }

    .profil-hero-img-wrapper {
        width: 100%;
        height: 360px;
        border-radius: 16px;
        overflow: hidden;
        background: #e9eef3;
    }

    .profil-hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profil-label {
        display: inline-block;
        background: #e7f1ff;
        color: #0d6efd;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .profil-school-name {
        font-size: 32px;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0 0 14px;
        line-height: 1.25;
    }

    .profil-deskripsi {
        color: #555;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 24px;
        white-space: pre-line;
    }

    .profil-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .profil-stat-card {
        background: #fff;
        border: 1px solid #f0f0f0;
        border-radius: 16px;
        padding: 22px 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: transform 0.25s ease;
    }

    .profil-stat-card:hover {
        transform: translateY(-4px);
    }

    .profil-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #f0f6ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin: 0 auto 12px;
    }

    .profil-stat-number {
        font-size: 18px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 2px;
        word-break: break-word;
    }

    .profil-stat-label {
        font-size: 13px;
        color: #666;
        margin: 0;
    }

    .profil-sambutan-card {
        background: linear-gradient(135deg, #f8faff 0%, #ffffff 100%);
        border: 1px solid #e7eeff;
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 30px;
        display: flex;
        gap: 28px;
        align-items: center;
    }

    .profil-kepsek-foto {
        width: 140px;
        height: 140px;
        min-width: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }

    .profil-sambutan-title {
        font-size: 20px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .profil-kepsek-nama {
        font-size: 15px;
        font-weight: 700;
        color: #0d6efd;
        margin-bottom: 10px;
    }

    .profil-sambutan-text {
        font-size: 14px;
        color: #555;
        line-height: 1.75;
        margin: 0;
    }

    @media (max-width: 992px) {
        .profil-hero-grid {
            grid-template-columns: 1fr;
        }

        .profil-stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .profil-sambutan-card {
            flex-direction: column;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .profil-hero-card {
            padding: 20px;
        }

        .profil-hero-img-wrapper {
            height: 230px;
        }

        .profil-stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="profil-page">
    <div class="profil-container">
        @php
            $namaSekolah = $profil->nama_sekolah ?? 'SDN 6 Mangunreja';
            $kepalaSekolah = $profil->kepala_sekolah ?? 'Belum diatur';
            $npsn = $profil->npsn ?? '-';
            $alamat = $profil->alamat ?? '-';
            $kontak = $profil->kontak ?? '-';
            $tahunBerdiri = $profil->tahun_berdiri ?? '-';
            $deskripsi = $profil->deskripsi ?? 'Belum ada deskripsi profil sekolah.';
            $visi = $profil->visi ?? 'Belum ada data visi sekolah.';
            $misi = $profil->misi ?? 'Belum ada data misi sekolah.';
        @endphp

        <div class="profil-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a> &raquo; Profil Sekolah
        </div>

        <hr class="profil-divider">

        <h1 class="profil-page-title">Profil Sekolah</h1>

        <div class="profil-hero-card">
            <div class="profil-hero-grid">
                <div>
                    <span class="profil-label">Tentang Kami</span>
                    <h2 class="profil-school-name">{{ $namaSekolah }}</h2>

                    <p class="profil-deskripsi">{{ $deskripsi }}</p>

                    <a href="#visi-misi" class="btn btn-primary rounded-pill px-4 py-2">
                        Visi &amp; Misi &nbsp; <i class="fa-solid fa-arrow-down"></i>
                    </a>
                </div>

                <div>
                    <div class="profil-hero-img-wrapper">
                        @if(!empty($profil?->foto))
                            <img
                                src="{{ asset('storage/' . $profil->foto) }}"
                                alt="{{ $namaSekolah }}"
                                class="profil-hero-img"
                            >
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light text-secondary">
                                <div class="text-center">
                                    <i class="fa-solid fa-school fa-4x mb-3 text-primary"></i>
                                    <h5 class="fw-bold mb-0">{{ $namaSekolah }}</h5>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- STATISTIK & INFO DARI FIELD MODEL --}}
        <div class="profil-stats-grid">
            <div class="profil-stat-card">
                <div class="profil-stat-icon">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div class="profil-stat-number">{{ $npsn }}</div>
                <p class="profil-stat-label">NPSN</p>
            </div>

            <div class="profil-stat-card">
                <div class="profil-stat-icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <div class="profil-stat-number">{{ $tahunBerdiri }}</div>
                <p class="profil-stat-label">Tahun Berdiri</p>
            </div>

            <div class="profil-stat-card">
                <div class="profil-stat-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="profil-stat-number" style="font-size: 15px;">{{ $kontak }}</div>
                <p class="profil-stat-label">Kontak</p>
            </div>

            <div class="profil-stat-card">
                <div class="profil-stat-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="profil-stat-number" style="font-size: 14px; font-weight: 600;">{{ $alamat }}</div>
                <p class="profil-stat-label">Alamat</p>
            </div>
        </div>

        {{-- SAMBUTAN KEPALA SEKOLAH --}}
        <div class="profil-sambutan-card">
            <img 
                src="{{ !empty($profil?->foto_kepala_sekolah) ? asset('storage/' . $profil->foto_kepala_sekolah) : asset('assets/img/avatars/bangwil.jpeg') }}" 
                alt="Kepala Sekolah" 
                class="profil-kepsek-foto"
                onerror="this.onerror=null;this.src='{{ asset('assets/img/default-avatar.jpg') }}';"
            >
            <div>
                <h3 class="profil-sambutan-title">Kepala Sekolah</h3>
                <div class="profil-kepsek-nama">{{ $kepalaSekolah }}</div>
                <p class="profil-sambutan-text">
                    "Selamat datang di website resmi {{ $namaSekolah }}. Kami berikhtiar menyajikan pendidikan dasar terbaik untuk membentuk generasi yang cerdas, berkarakter mulia, dan siap menghadapi masa depan."
                </p>
            </div>
        </div>

        {{-- VISI & MISI (DIPISAH MENJADI 2 CARD BERJAJAR) --}}
        <div class="row g-4 align-items-stretch mb-5" id="visi-misi">
            {{-- Card Visi --}}
            <div class="col-lg-6 col-md-12 d-flex align-items-stretch">
                <div class="card border-0 shadow-sm w-100 h-100 p-4 bg-white rounded-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle p-2 me-3" style="background: rgba(217,119,6,.15); color: #f59e0b;">
                            <i class="fa-solid fa-bullseye fs-4"></i>
                        </div>
                        <h4 class="fw-bold text-dark m-0" style="font-size: 20px;">Visi Sekolah</h4>
                    </div>
                    <div class="section-line mb-3" style="width: 40px; height: 3px; background-color: #f59e0b;"></div>
                    <p class="text-secondary small lh-base flex-grow-1" style="font-size: 14px; white-space: pre-line;">
                        {{ $visi }}
                    </p>
                </div>
            </div>

            {{-- Card Misi --}}
            <div class="col-lg-6 col-md-12 d-flex align-items-stretch">
                <div class="card border-0 shadow-sm w-100 h-100 p-4 bg-white rounded-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle p-2 me-3" style="background: rgba(13,110,253,.15); color: #0d6efd;">
                            <i class="fa-solid fa-list-check fs-4"></i>
                        </div>
                        <h4 class="fw-bold text-dark m-0" style="font-size: 20px;">Misi Sekolah</h4>
                    </div>
                    <div class="section-line mb-3" style="width: 40px; height: 3px; background-color: #0d6efd;"></div>
                    <div class="text-secondary small lh-base flex-grow-1" style="font-size: 14px; white-space: pre-line;">
                        {!! nl2br(e($misi)) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection