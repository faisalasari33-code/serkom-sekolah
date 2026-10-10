@extends('template.landing')

@section('title', 'Staf & Guru - SDN 6 Mangunreja')

@push('styles')
<style>
    /* =========================
       HALAMAN STAF & GURU
    ========================= */
    .guru-page {
        background: #fff;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .guru-container {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* =========================
       BREADCRUMB & JUDUL
    ========================= */
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

    .guru-page-title {
        color: #222;
        font-size: 40px;
        font-weight: 800;
        margin-bottom: 30px;
        line-height: 1.2;
    }

    /* =========================
       GRID KARTU GURU
    ========================= */
    .guru-list {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 24px;
    }

    /* KARTU UTAMA */
    .guru-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding-bottom: 15px;
    }

    /* HOVER PADA KARTU (TERANGKAT & ADA SHADOW) */
    .guru-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    /* KOTAK FOTO BERLATAR MERAH */
    .guru-photo-wrapper {
        width: 100%;
        height: 380px;
        background-color: #d31818;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
    }

    .guru-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 0.3s ease;
    }

    .guru-card:hover .guru-photo {
        transform: scale(1.04); /* Zoom halus pada foto saat hover */
    }

    /* TEKS NAMA & JABATAN (SELALU KELIATAN DI BAWAH FOTO) */
    .guru-info {
        padding: 16px 8px 0;
        text-align: center;
    }

    .guru-name {
        font-size: 16px;
        font-weight: 700;
        color: #222;
        margin: 0 0 6px;
        word-break: break-word;
        transition: color 0.2s ease;
    }

    .guru-card:hover .guru-name {
        color: #0d6efd; /* Warna nama berubah biru pas di-hover */
    }

    .guru-position {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    /* =========================
       RESPONSIVE DESIGN
    ========================= */
    @media (max-width: 1100px) {
        .guru-list {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
        .guru-photo-wrapper {
            height: 320px;
        }
    }

    @media (max-width: 768px) {
        .guru-page {
            padding-top: 80px;
        }

        .guru-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .guru-photo-wrapper {
            height: 260px;
        }

        .guru-page-title {
            font-size: 30px;
        }
    }

    @media (max-width: 480px) {
        .guru-list {
            grid-template-columns: minmax(0, 1fr);
        }

        .guru-photo-wrapper {
            height: 340px;
        }
    }
</style>
@endpush

@section('content')
<section class="guru-page">
    <div class="guru-container">

        <!-- Breadcrumb & Judul -->
        <div class="guru-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a> &raquo; Staf &amp; Guru
        </div>
        
        <hr class="guru-divider">

        <h1 class="guru-page-title">Staf &amp; Guru</h1>
        <div class="guru-list">
            @forelse($guru as $item)
                <a href="{{ route('landing.guru.detail', $item->id) }}" class="guru-card text-decoration-none">
                    <div class="guru-photo-wrapper">
                        <img 
                            src="{{ !empty($item->foto) ? asset('storage/' . $item->foto) : asset('assets/img/avatars/bangwil.jpeg') }}" 
                            class="guru-photo" 
                            alt="{{ $item->nama_guru ?? 'Guru' }}"
                            onerror="this.onerror=null;this.src='{{ asset('assets/img/avatars/bangwil.jpeg') }}';"
                        >
                    </div>
                    
                    <div class="guru-info">
                        <h2 class="guru-name">{{ $item->nama_guru ?? 'Nama Guru' }}</h2>
                        <p class="guru-position">{{ $item->mata_pelajaran ?? '-' }}</p>
                    </div>
                </a>
            @empty
                ...
            @endforelse
        </div>

    </div>
</section>
@endsection