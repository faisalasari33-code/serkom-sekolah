@extends('template.landing')

@section('title', $galeri->judul . ' - Galeri SDN 6 Mangunreja')

@push('styles')
<style>
    .galeri-detail-page {
        background: #f8f9fa;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .galeri-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .breadcrumb-text {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 20px;
    }

    .breadcrumb-text a {
        color: #0d6efd;
        text-decoration: none;
    }

    .breadcrumb-text a:hover {
        text-decoration: underline;
    }

    .galeri-card-main {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .galeri-media-box {
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        background: #000;
        margin-bottom: 24px;
    }

    .galeri-img-full {
        width: 100%;
        max-height: 550px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }

    .galeri-title {
        font-size: 26px;
        font-weight: 800;
        color: #222;
        margin-bottom: 12px;
    }

    .galeri-meta {
        font-size: 13px;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .galeri-description {
        font-size: 15px;
        color: #444;
        line-height: 1.7;
    }

    .side-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .side-item {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
        text-decoration: none;
        color: inherit;
        align-items: center;
    }

    .side-item:hover .style-title {
        color: #0d6efd !important;
    }

    .side-img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
<div class="galeri-detail-page">
    <div class="galeri-detail-container">

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-text">
            <a href="{{ url('/') }}">Beranda</a> &raquo; 
            <a href="{{ url('/galeri-sekolah') }}">Galeri</a> &raquo; 
            <span>Detail Galeri</span>
        </div>

        <div class="row g-4">
            {{-- KONTEN UTAMA --}}
            <div class="col-lg-8">
                <div class="galeri-card-main">
                    
                    {{-- TAMPILAN MEDIA (FOTO ATAU VIDEO) --}}
                    <div class="galeri-media-box">
                        @if($galeri->kategori === 'video' && !empty($galeri->video))
                            <div class="ratio ratio-16x9">
                                <iframe 
                                    src="{{ $galeri->video }}" 
                                    title="{{ $galeri->judul }}" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @else
                            <img 
                                src="{{ asset('storage/' . $galeri->foto) }}" 
                                alt="{{ $galeri->judul }}" 
                                class="galeri-img-full"
                                onerror="this.onerror=null;this.src='{{ asset('assets/img/avatars/logo.jpg') }}';"
                            >
                        @endif
                    </div>

                    {{-- BADGE & JUDUL --}}
                    <span class="badge {{ $galeri->kategori === 'video' ? 'bg-danger' : 'bg-primary' }} mb-2">
                        <i class="fa-solid {{ $galeri->kategori === 'video' ? 'fa-video' : 'fa-camera' }} me-1"></i>
                        {{ ucfirst($galeri->kategori) }}
                    </span>

                    <h1 class="galeri-title">{{ $galeri->judul }}</h1>

                    <div class="galeri-meta">
                        <span>
                            <i class="fa-regular fa-calendar-alt me-1"></i> 
                            {{ !empty($galeri->tanggal) ? \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') : \Carbon\Carbon::parse($galeri->created_at)->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    <div class="galeri-description">
                        {!! nl2br(e($galeri->keterangan ?? 'Tidak ada keterangan.')) !!}
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ url('/galeri-sekolah') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Galeri
                        </a>
                    </div>

                </div>
            </div>

            {{-- SIDEBAR: GALERI LAINNYA --}}
            <div class="col-lg-4">
                <div class="side-card">
                    <h5 class="fw-bold mb-3 text-dark">Galeri Lainnya</h5>
                    <hr class="mt-0 mb-3">

                    @forelse($galeriLain as $item)
                        <a href="{{ url('/galeri-sekolah/' . $item->id) }}" class="side-item">
                            @if($item->kategori === 'video')
                                <div class="position-relative bg-dark rounded d-flex align-items-center justify-content-center side-img">
                                    <i class="fa-solid fa-circle-play text-white fs-4"></i>
                                </div>
                            @else
                                <img src="{{ asset('storage/' . $item->foto) }}" class="side-img" alt="{{ $item->judul }}" onerror="this.onerror=null;this.src='{{ asset('assets/img/avatars/logo.jpg') }}';">
                            @endif

                            <div>
                                <h6 class="mb-1 text-dark fw-semibold style-title" style="font-size: 14px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $item->judul }}
                                </h6>
                                <small class="text-muted" style="font-size: 11px;">
                                    {{ ucfirst($item->kategori) }}
                                </small>
                            </div>
                        </a>
                    @empty
                        <p class="text-muted small mb-0">Belum ada galeri lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection