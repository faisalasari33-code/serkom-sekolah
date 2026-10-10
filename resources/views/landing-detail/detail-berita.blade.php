@extends('template.landing')

@section('title', ($berita->judul ?? 'Detail Berita') . ' - SDN 6 Mangunreja')

@push('styles')
<style>
    /* =========================
       HALAMAN DETAIL BERITA
    ========================= */
    .berita-detail-page {
        background: #fff;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .berita-detail-container {
        width: 100%;
        max-width: 960px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* BREADCRUMB & DIVIDER */
    .berita-breadcrumb {
        font-size: 15px;
        color: #444;
        margin-bottom: 12px;
        display: block;
    }

    .berita-breadcrumb a {
        color: #333;
        text-decoration: none;
    }

    .berita-breadcrumb a:hover {
        color: #0d6efd;
    }

    .berita-divider {
        border: 0;
        border-top: 1px solid #e5e5e5;
        margin: 12px 0 24px;
        opacity: 1;
    }

    /* JUDUL & META BERITA */
    .berita-detail-title {
        color: #1a1a1a;
        font-size: 36px;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 16px;
    }

    .berita-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        color: #666;
        font-size: 14px;
        margin-bottom: 28px;
    }

    .berita-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* FOTO UTAMA BERITA */
    .berita-img-wrapper {
        width: 100%;
        max-height: 480px;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 32px;
        background: #f0f0f0;
    }

    .berita-img {
        width: 100%;
        height: 100%;
        max-height: 480px;
        object-fit: cover;
    }

    /* KONTEN BERITA */
    .berita-content {
        color: #333;
        font-size: 16px;
        line-height: 1.85;
        white-space: pre-line;
        margin-bottom: 40px;
    }

    .berita-content p {
        margin-bottom: 18px;
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 768px) {
        .berita-detail-title {
            font-size: 28px;
        }

        .berita-img-wrapper {
            max-height: 320px;
        }
    }
</style>
@endpush

@section('content')
<section class="berita-detail-page">
    <div class="berita-detail-container">

        @php
            $judul = $berita->judul ?? 'Judul Berita';
            $penulis = $berita->penulis ?? $berita->author ?? 'Admin Sekolah';
            $tanggal = !empty($berita->created_at) ? \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') : '-';
            $isi = $berita->isi ?? $berita->konten ?? $berita->deskripsi ?? 'Belum ada konten berita.';
        @endphp

        <!-- Breadcrumb -->
        <div class="berita-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a> &raquo; 
            <a href="{{route('landing.berita')}}"> Berita</a> &raquo; 
            {{ Str::limit($judul, 30) }}
        </div>

        <hr class="berita-divider">

        <!-- Judul Berita -->
        <h1 class="berita-detail-title">{{ $judul }}</h1>

        <!-- Meta Berita (Penulis & Tanggal) -->
        <div class="berita-meta">
            <div class="berita-meta-item">
                <i class="fa-solid fa-user text-primary"></i>
                <span>{{ $penulis }}</span>
            </div>
            <div class="berita-meta-item">
                <i class="fa-solid fa-calendar-days text-primary"></i>
                <span>{{ $tanggal }}</span>
            </div>
        </div>

        <!-- Foto Utama Berita -->
        @if(!empty($berita->gambar ?? $berita->foto))
            <div class="berita-img-wrapper">
                <img 
                    src="{{ asset('storage/' . ($berita->gambar ?? $berita->foto)) }}" 
                    class="berita-img" 
                    alt="{{ $judul }}"
                    onerror="this.onerror=null;this.src='{{ asset('assets/img/default-news.jpg') }}';"
                >
            </div>
        @endif

        <!-- Isi Berita -->
        <div class="berita-content">
            {!! nl2br(e($isi)) !!}
        </div>

        <!-- Tombol Kembali -->
        <div>
            <a href="{{route('landing.berita')}}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Berita
            </a>
        </div>

    </div>
</section>
@endsection