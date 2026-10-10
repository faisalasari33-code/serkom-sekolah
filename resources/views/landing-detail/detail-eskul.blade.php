@extends('template.landing')

@section('title', ($ekstrakurikuler->nama_ekstrakulikuler ?? 'Detail Ekstrakurikuler') . ' - SDN 6 Mangunreja')

@push('styles')
<style>
    /* =========================
       HALAMAN DETAIL EKSKUL
    ========================= */
    .ekskul-detail-page {
        background: #fff;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .ekskul-detail-container {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* BREADCRUMB & DIVIDER */
    .ekskul-breadcrumb {
        font-size: 15px;
        color: #444;
        margin-bottom: 12px;
        display: block;
    }

    .ekskul-breadcrumb a {
        color: #333;
        text-decoration: none;
    }

    .ekskul-breadcrumb a:hover {
        color: #0d6efd;
    }

    .ekskul-divider {
        border: 0;
        border-top: 1px solid #e5e5e5;
        margin: 12px 0 24px;
        opacity: 1;
    }

    /* JUDUL NAMA EKSKUL */
    .ekskul-detail-title {
        color: #222;
        font-size: 40px;
        font-weight: 800;
        margin-bottom: 30px;
        line-height: 1.2;
    }

    /* LAYOUT UTAMA (FOTO + INFO) */
    .ekskul-detail-grid {
        display: grid;
        grid-template-columns: 420px 1fr;
        gap: 48px;
        align-items: start;
    }

    /* KOTAK GAMBAR EKSKUL */
    .ekskul-photo-wrapper {
        width: 100%;
        height: 380px;
        background-color: #e9eef3;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    .ekskul-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    /* GRID DETAIL INFO */
    .ekskul-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 28px 36px;
        margin-bottom: 32px;
    }

    .ekskul-info-item {
        display: flex;
        flex-direction: column;
    }

    .ekskul-info-label {
        font-size: 15px;
        color: #666;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .ekskul-info-value {
        font-size: 18px;
        font-weight: 700;
        color: #222;
        margin: 0;
        word-break: break-word;
    }

    /* BOX DESKRIPSI KEGIATAN */
    .ekskul-deskripsi-box {
        background: #fdfdfd;
        border: 1px solid #f0f0f0;
        border-radius: 16px;
        padding: 24px;
    }

    .ekskul-deskripsi-title {
        font-size: 18px;
        font-weight: 700;
        color: #222;
        margin-bottom: 12px;
    }

    .ekskul-deskripsi-text {
        font-size: 15px;
        color: #555;
        line-height: 1.8;
        margin: 0;
        white-space: pre-line;
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 992px) {
        .ekskul-detail-grid {
            grid-template-columns: 320px 1fr;
            gap: 30px;
        }

        .ekskul-photo-wrapper {
            height: 320px;
        }

        .ekskul-detail-title {
            font-size: 32px;
        }
    }

    @media (max-width: 768px) {
        .ekskul-detail-grid {
            grid-template-columns: 1fr;
        }

        .ekskul-photo-wrapper {
            max-width: 100%;
            height: 300px;
        }

        .ekskul-info-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 480px) {
        .ekskul-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<section class="ekskul-detail-page">
    <div class="ekskul-detail-container">

        @php
            $namaEkskul = $ekstrakurikuler->nama_ekstrakulikuler ?? $ekstrakurikuler->nama_ekskul ?? 'Nama Ekstrakurikuler';
            $jadwal = $ekstrakurikuler->jadwal_latihan ?? $ekstrakurikuler->jadwal ?? '-';
            $pembina = $ekstrakurikuler->pembina ?? $ekstrakurikuler->nama_pembina ?? '-';
            $jumlahAnggota = $ekstrakurikuler->jumlah_anggota ?? '-';
            $lokasi = $ekstrakurikuler->lokasi ?? 'Lapangan / Lingkungan Sekolah';
            $deskripsi = $ekstrakurikuler->deskripsi ?? 'Belum ada deskripsi kegiatan untuk ekstrakurikuler ini.';
        @endphp

        <!-- Breadcrumb -->
        <div class="ekskul-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a> &raquo; 
            <a href="{{route('landing.eskul')}}">Ekstrakurikuler</a> &raquo; 
            {{ $namaEkskul }}
        </div>

        <hr class="ekskul-divider">

        <!-- Judul Ekskul -->
        <h1 class="ekskul-detail-title">{{ $namaEkskul }}</h1>

        <!-- Konten Utama (Foto & Detail Info) -->
        <div class="ekskul-detail-grid">
            
            <!-- Foto Ekskul -->
            <div class="ekskul-photo-wrapper">
                <img 
                    src="{{ !empty($ekstrakurikuler->foto) ? asset('storage/' . $ekstrakurikuler->foto) : asset('assets/img/default-ekskul.jpg') }}" 
                    class="ekskul-photo" 
                    alt="{{ $namaEkskul }}"
                    onerror="this.onerror=null;this.src='{{ asset('assets/img/default-ekskul.jpg') }}';"
                >
            </div>

            <!-- Detail Informasi Ekskul -->
            <div>
                <div class="ekskul-info-grid">

                    <div class="ekskul-info-item">
                        <span class="ekskul-info-label">Jadwal Latihan</span>
                        <h3 class="ekskul-info-value">{{ $jadwal }}</h3>
                    </div>

                    <div class="ekskul-info-item">
                        <span class="ekskul-info-label">Pembina</span>
                        <h3 class="ekskul-info-value">{{ $pembina }}</h3>
                    </div>

                    <div class="ekskul-info-item">
                        <span class="ekskul-info-label">Jumlah Anggota</span>
                        <h3 class="ekskul-info-value">{{ $jumlahAnggota }}</h3>
                    </div>

                    <div class="ekskul-info-item">
                        <span class="ekskul-info-label">Lokasi Kegiatan</span>
                        <h3 class="ekskul-info-value">{{ $lokasi }}</h3>
                    </div>

                </div>

                <!-- Box Deskripsi -->
                <div class="ekskul-deskripsi-box">
                    <h3 class="ekskul-deskripsi-title">Deskripsi Kegiatan</h3>
                    <p class="ekskul-deskripsi-text">{{ $deskripsi }}</p>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection