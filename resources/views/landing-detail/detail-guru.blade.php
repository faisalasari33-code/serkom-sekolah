@extends('template.landing')

@section('title', ($guru->nama_guru ?? 'Detail Staf & Guru') . ' - SDN 6 Mangunreja')

@push('styles')
<style>
    /* =========================
       HALAMAN DETAIL GURU/STAF
    ========================= */
    .guru-detail-page {
        background: #fff;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .guru-detail-container {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* BREADCRUMB & DIVIDER */
    .guru-breadcrumb {
        font-size: 15px;
        color: #444;
        margin-bottom: 12px;
        display: block;
    }

    .guru-breadcrumb a {
        color: #333;
        text-decoration: none;
    }

    .guru-breadcrumb a:hover {
        color: #0d6efd;
    }

    .guru-divider {
        border: 0;
        border-top: 1px solid #e5e5e5;
        margin: 12px 0 24px;
        opacity: 1;
    }

    /* JUDUL NAMA GURU */
    .guru-detail-title {
        color: #222;
        font-size: 40px;
        font-weight: 800;
        margin-bottom: 30px;
        line-height: 1.2;
    }

    /* LAYOUT UTAMA (FOTO + INFO) */
    .guru-detail-grid {
        display: grid;
        grid-template-columns: 360px 1fr;
        gap: 48px;
        align-items: start;
    }

    /* KOTAK FOTO BERLATAR MERAH */
    .guru-photo-wrapper {
        width: 100%;
        height: 480px;
        background-color: #d31818;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    .guru-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
    }

    /* GRID INFO DETAIL 2 KOLOM */
    .guru-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 28px 36px;
    }

    .guru-info-item {
        display: flex;
        flex-direction: column;
    }

    .guru-info-label {
        font-size: 15px;
        color: #666;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .guru-info-value {
        font-size: 18px;
        font-weight: 700;
        color: #222;
        margin: 0;
        word-break: break-word;
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 992px) {
        .guru-detail-grid {
            grid-template-columns: 280px 1fr;
            gap: 30px;
        }

        .guru-photo-wrapper {
            height: 380px;
        }

        .guru-detail-title {
            font-size: 32px;
        }
    }

    @media (max-width: 768px) {
        .guru-detail-grid {
            grid-template-columns: 1fr;
        }

        .guru-photo-wrapper {
            max-width: 340px;
            height: 440px;
            margin: 0 auto;
        }

        .guru-info-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 480px) {
        .guru-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<section class="guru-detail-page">
    <div class="guru-detail-container">

        @php
            $nama = $guru->nama_guru ?? 'Nama Guru';
            $nip = $guru->nip ?? '-';
            $mataPelajaran = $guru->mata_pelajaran ?? 'Tenaga Pendidik';
            
            // Value opsional/default jika nanti ditambahkan ke database
            $status = $guru->status ?? 'GTY/PTY';
            $nuptk = $guru->nuptk ?? '-';
            $aktif = $guru->aktif ?? '2025 - Sekarang';
            $gender = $guru->gender ?? 'Laki-laki';
            $agama = $guru->agama ?? 'Islam';
            $alamat = $guru->alamat ?? '-';
            $kontak = $guru->kontak ?? '-';
        @endphp

        <!-- Breadcrumb -->
        <div class="guru-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a> &raquo; 
            <a href="{{route('landing.guru')}}">Staf &amp; Guru</a> &raquo; 
            {{ $nama }}
        </div>

        <hr class="guru-divider">

        <!-- Judul Nama Guru -->
        <h1 class="guru-detail-title">{{ $nama }}</h1>

        <!-- Konten Utama (Foto & Detail) -->
        <div class="guru-detail-grid">
            
            <!-- Foto dengan Background Merah -->
            <div class="guru-photo-wrapper">
                <img 
                    src="{{ !empty($guru->foto) ? asset('storage/' . $guru->foto) : asset('assets/img/avatars/bangwil.jpeg') }}" 
                    class="guru-photo" 
                    alt="{{ $nama }}"
                    onerror="this.onerror=null;this.src='{{ asset('assets/img/avatars/bangwil.jpeg') }}';"
                >
            </div>

            <!-- Detail Info Guru -->
            <div class="guru-info-grid">

                <div class="guru-info-item">
                    <span class="guru-info-label">Mata Pelajaran / Jabatan</span>
                    <h3 class="guru-info-value">{{ $mataPelajaran }}</h3>
                </div>

                <div class="guru-info-item">
                    <span class="guru-info-label">Status</span>
                    <h3 class="guru-info-value">{{ $status }}</h3>
                </div>

                <div class="guru-info-item">
                    <span class="guru-info-label">NIP</span>
                    <h3 class="guru-info-value">{{ $nip }}</h3>
                </div>

                <div class="guru-info-item">
                    <span class="guru-info-label">NUPTK</span>
                    <h3 class="guru-info-value">{{ $nuptk }}</h3>
                </div>

                <div class="guru-info-item">
                    <span class="guru-info-label">Aktif</span>
                    <h3 class="guru-info-value">{{ $aktif }}</h3>
                </div>

                <div class="guru-info-item">
                    <span class="guru-info-label">Gender</span>
                    <h3 class="guru-info-value">{{ $gender }}</h3>
                </div>

                <div class="guru-info-item">
                    <span class="guru-info-label">Agama</span>
                    <h3 class="guru-info-value">{{ $agama }}</h3>
                </div>

                <div class="guru-info-item">
                    <span class="guru-info-label">Alamat</span>
                    <h3 class="guru-info-value">{{ $alamat }}</h3>
                </div>

                <div class="guru-info-item">
                    <span class="guru-info-label">Kontak</span>
                    <h3 class="guru-info-value">{{ $kontak }}</h3>
                </div>

            </div>

        </div>

    </div>
</section>
@endsection