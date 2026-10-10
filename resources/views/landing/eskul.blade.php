@extends('template.landing')

@section('title', 'Ekstrakurikuler - SDN 6 Mangunreja')

@push('styles')
<style>
    /* =========================
       HALAMAN EKSTRAKURIKULER
    ========================= */
    .ekskul-page {
        background: #fff;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .ekskul-container {
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

    .ekskul-page-title {
        color: #222;
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 30px;
    }

    /* GRID KARTU EKSKUL (2 KOLOM) */
    .ekskul-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .ekskul-card {
        display: flex;
        background: #fdfdfd;
        border: 1px solid #f0f0f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.03);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 220px;
        text-decoration: none;
        color: inherit;
    }

    .ekskul-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        color: inherit;
    }

    /* GAMBAR DI KIRI */
    .ekskul-img-wrapper {
        width: 48%;
        min-width: 48%;
        height: 100%;
        position: relative;
        overflow: hidden;
        background: #e9eef3;
    }

    .ekskul-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
    }

    .ekskul-card:hover .ekskul-img {
        transform: scale(1.05);
    }

    /* KONTEN TEKS DI KANAN */
    .ekskul-content {
        padding: 20px 22px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 52%;
        height: 100%;
    }

    .ekskul-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 12px;
        line-height: 1.3;
    }

    .ekskul-info-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
        margin-bottom: 6px;
    }

    .ekskul-info-item i {
        color: #777;
        width: 16px;
        text-align: center;
    }

    .ekskul-link {
        font-size: 14px;
        color: #0d6efd;
        font-weight: 600;
        margin-top: 10px;
        display: inline-block;
    }

    .ekskul-card:hover .ekskul-link {
        text-decoration: underline;
    }

    /* JIKA DATA KOSONG */
    .ekskul-empty {
        grid-column: 1 / -1;
        background: #fff;
        border: 1px dashed #ccd6e0;
        border-radius: 12px;
        padding: 55px 20px;
        text-align: center;
        color: #687789;
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 992px) {
        .ekskul-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .ekskul-card {
            flex-direction: column;
            height: auto;
        }
        .ekskul-img-wrapper, .ekskul-content {
            width: 100%;
        }
        .ekskul-img-wrapper {
            height: 200px;
        }
    }
</style>
@endpush

@section('content')
<section class="ekskul-page">
    <div class="ekskul-container">

        {{-- BREADCRUMB --}}
        <div class="ekskul-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a> &raquo; Ekstrakurikuler
        </div>

        <hr class="ekskul-divider">

        {{-- JUDUL HALAMAN --}}
        <h1 class="ekskul-page-title">Ekstrakurikuler</h1>

        {{-- DAFTAR EKSTRAKURIKULER --}}
        <div class="ekskul-grid">
            @forelse($ekstrakurikuler as $item)
                {{-- KARTU BISA DIKLIK LANGSUNG KE DETAIL --}}
                <a href="{{ url('/eskul-sekolah/' . $item->id) }}" class="ekskul-card">
                    <div class="ekskul-img-wrapper">
                        <img 
                            src="{{ !empty($item->foto) ? asset('storage/' . $item->foto) : asset('assets/img/default-ekskul.jpg') }}" 
                            alt="{{ $item->nama_ekstrakulikuler ?? 'Ekstrakurikuler' }}" 
                            class="ekskul-img"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ asset('assets/img/default-ekskul.jpg') }}';"
                        >
                    </div>

                    <div class="ekskul-content">
                        <h2 class="ekskul-title">
                            {{ $item->nama_ekstrakulikuler ?? 'Nama Ekstrakurikuler' }}
                        </h2>

                        <div class="ekskul-info-item">
                            <i class="fa-solid fa-users"></i>
                            <span>Jumlah Anggota: {{ $item->jumlah_anggota ?? '-' }}</span>
                        </div>

                        <div class="ekskul-info-item">
                            <i class="fa-solid fa-user"></i>
                            <span>Pembina: {{ $item->pembina ?? '-' }}</span>
                        </div>

                        <div>
                            <span class="ekskul-link">
                                Selengkapnya &raquo;
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="ekskul-empty">
                    <i class="fa-solid fa-people-group fa-3x mb-3 text-secondary"></i>
                    <h4 class="fw-bold">Belum Ada Data Ekstrakurikuler</h4>
                    <p class="mb-0">
                        Data kegiatan ekstrakurikuler akan ditampilkan di sini.
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</section>
@endsection