@extends('template.landing')

@section('title', 'Berita - SDN 6 Mangunreja')

@push('styles')
<style>
    /* =========================
       HALAMAN INDEX BERITA
    ========================= */
    .berita-page {
        background: #fff;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .berita-container {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 24px;
    }

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

    .berita-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 28px;
    }

    .berita-page-title {
        color: #222;
        font-size: 38px;
        font-weight: 800;
        margin: 0;
    }

    .berita-filter-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .berita-select {
        padding: 8px 16px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
        background-color: #fff;
        color: #333;
    }

    .berita-search-btn {
        background-color: #0d6efd;
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: background-color 0.2s;
    }

    .berita-search-btn:hover {
        background-color: #0b5ed7;
    }

    .berita-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .berita-card {
        display: flex;
        background: #fdfdfd;
        border: 1px solid #f0f0f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.03);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 210px;
    }

    .berita-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .berita-img-wrapper {
        width: 42%;
        min-width: 42%;
        height: 100%;
        position: relative;
        overflow: hidden;
        background: #e9eef3;
    }

    .berita-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
    }

    .berita-card:hover .berita-img {
        transform: scale(1.05);
    }

    .berita-content {
        padding: 16px 18px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 58%;
        height: 100%;
    }

    .berita-category {
        color: #d97706;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .berita-title {
        font-size: 16px;
        font-weight: 700;
        line-height: 1.35;
        color: #1a1a1a;
        margin: 0 0 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .berita-title a {
        color: inherit;
        text-decoration: none;
    }

    .berita-title a:hover {
        color: #0d6efd;
    }

    .berita-date {
        font-size: 12px;
        color: #888;
        margin-bottom: 8px;
    }

    .berita-excerpt {
        font-size: 13px;
        color: #555;
        line-height: 1.45;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .berita-link {
        font-size: 13px;
        color: #0d6efd;
        font-weight: 600;
        text-decoration: none;
    }

    .berita-link:hover {
        text-decoration: underline;
    }

    .berita-empty {
        grid-column: 1 / -1;
        background: #fff;
        border: 1px dashed #ccd6e0;
        border-radius: 12px;
        padding: 55px 20px;
        text-align: center;
        color: #687789;
    }

    @media (max-width: 992px) {
        .berita-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .berita-card {
            flex-direction: column;
            height: auto;
        }
        .berita-img-wrapper, .berita-content {
            width: 100%;
        }
        .berita-img-wrapper {
            height: 180px;
        }
        .berita-header-row {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="berita-page">
    <div class="berita-container">

        {{-- BREADCRUMB --}}
        <div class="berita-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a> &raquo; Berita
        </div>

        <hr class="berita-divider">

        {{-- HEADER: JUDUL & FILTER --}}
        <div class="berita-header-row">
            <h1 class="berita-page-title">Berita</h1>

            <form action="{{ route('landing.berita') }}" method="GET" class="berita-filter-form">
                <select name="kategori" class="berita-select">
                    <option value="">Pilih Kategori</option>
                    <option value="Kegiatan" {{ request('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="Pengumuman" {{ request('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Prestasi" {{ request('kategori') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                </select>

                <button type="submit" class="berita-search-btn">
                    <i class="fas fa-search"></i> Mencari
                </button>
            </form>
        </div>

        {{-- HASIL PENCARIAN --}}
        @if(request('search') || request('kategori'))
            <p class="text-muted mb-4">
                Menampilkan berita untuk: 
                <strong>{{ request('search') ?? request('kategori') }}</strong>
            </p>
        @endif

        {{-- DAFTAR BERITA --}}
        <div class="berita-grid">
            @forelse($berita as $item)
                <div class="berita-card">
                    <div class="berita-img-wrapper">
                        <a href="{{ url('/berita-sekolah/' . $item->id_berita) }}" style="display:block; width:100%; height:100%;">
                            @if(!empty($item->foto))
                                <img
                                    src="{{ asset('storage/' . ($item->foto)) }}"
                                    alt="{{ $item->judul }}"
                                    class="berita-img"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/img/default-news.jpg') }}';"
                                >
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-secondary">
                                    <i class="fas fa-newspaper fa-3x"></i>
                                </div>
                            @endif
                        </a>
                    </div>

                    {{-- TEKS KONTEN BERITA --}}
                    <div class="berita-content">
                        <span class="berita-category">{{ $item->kategori ?? 'Kegiatan' }}</span>

                        <h2 class="berita-title">
                            <a href="{{ url('/berita-sekolah/' . $item->id_berita) }}">
                                {{ $item->judul }}
                            </a>
                        </h2>

                        <div class="berita-date">
                            @if(!empty($item->tanggal))
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($item->created_at ?? now())->translatedFormat('l, d F Y') }}
                            @endif
                        </div>

                        <p class="berita-excerpt">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->isi ?? $item->konten ?? $item->deskripsi ?? ''), 80) }}
                        </p>

                        <div>
                            <a href="{{ url('/berita-sekolah/' . $item->id_berita) }}" class="berita-link">
                                Selengkapnya &raquo;
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="berita-empty">
                    <i class="fas fa-newspaper fa-3x mb-3 text-secondary"></i>
                    <h4 class="fw-bold">Belum Ada Berita</h4>
                    <p class="mb-0">
                        @if(request('search') || request('kategori'))
                            Berita yang kamu cari belum ditemukan.
                        @else
                            Belum ada berita yang tersedia saat ini.
                        @endif
                    </p>

                    @if(request('search') || request('kategori'))
                        <a href="{{ route('landing.berita') }}" class="btn btn-outline-primary mt-3">
                            Tampilkan Semua Berita
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($berita, 'hasPages') && $berita->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $berita->links() }}
            </div>
        @endif

    </div>
</div>
@endsection