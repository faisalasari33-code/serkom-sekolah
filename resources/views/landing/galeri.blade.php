@extends('template.landing')

@section('title', 'Galeri - SDN 6 Mangunreja')

@push('styles')
<style>
    .gallery-section {
        background: #fff;
        min-height: 70vh;
        padding: 100px 0 60px;
    }

    .gallery-breadcrumb {
        font-size: 15px;
        color: #444;
        margin-bottom: 12px;
        display: block;
    }

    .gallery-breadcrumb a {
        color: #333;
        text-decoration: none;
    }

    .gallery-breadcrumb a:hover {
        color: #0d6efd;
    }

    .gallery-divider {
        border: 0;
        border-top: 1px solid #e5e5e5;
        margin: 12px 0 24px;
        opacity: 1;
    }

    .gallery-page-title {
        color: #222;
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 30px;
    }

    .gallery-card {
        height: 100%;
        border: 1px solid #efefef;
        border-radius: 16px;
        overflow: hidden;
        background: #fdfdfd;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .03);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 22px rgba(0, 0, 0, .08);
    }

    .gallery-image-wrapper {
        position: relative;
        width: 100%;
        height: 240px;
        overflow: hidden;
        background: #e9ecef;
    }

    .gallery-image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: pointer;
        transition: transform .4s ease;
    }

    .gallery-card:hover .gallery-image {
        transform: scale(1.05);
    }

    .gallery-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(0, 0, 0, 0.55);
        color: #fff;
        font-size: 13px;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
        backdrop-filter: blur(2px);
        pointer-events: none;
    }

    .gallery-body {
        padding: 18px 20px;
        text-align: center;
        background: #fafafa;
        min-height: 85px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-title {
        color: #2c3e50;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .gallery-empty {
        padding: 60px 20px;
        background: #fff;
        border: 1px dashed #ccd6e0;
        border-radius: 16px;
    }

    .gallery-modal-image {
        display: block;
        width: 100%;
        max-height: 80vh;
        object-fit: contain;
    }

    @media (max-width: 767.98px) {
        .gallery-section {
            padding-top: 80px;
        }

        .gallery-image-wrapper {
            height: 210px;
        }
    }
</style>
@endpush

@section('content')
            <section class="gallery-section">
                <div class="container">

                    <div class="gallery-breadcrumb">
                        <a href="{{ url('/') }}">Beranda</a> &raquo; Galeri
                    </div>

                    <hr class="gallery-divider">
                    <h1 class="gallery-page-title">Galeri</h1>
                    <div class="row g-4">
                        @forelse($galeri as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="gallery-card">
                                    <div class="gallery-image-wrapper">
                @if($item->kategori === 'video' && !empty($item->video))

                    <video controls class="w-100 h-100" style="object-fit: cover;">
                        <source src="{{ asset('storage/' . $item->video) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>

                    <div class="gallery-badge bg-danger text-white">
                        <i class="fa-solid fa-video"></i>
                        <span>Video</span>
                    </div>
                @else
                    <img
                        src="{{ asset('storage/' . $item->foto) }}"
                        class="gallery-image"
                        alt="{{ $item->judul }}"
                        loading="lazy"
                        data-bs-toggle="modal"
                        data-bs-target="#galeriModal"
                        data-image="{{ asset('storage/' . $item->foto) }}"
                        data-title="{{ $item->judul }}"
                        onerror="this.onerror=null;this.src='{{ asset('assets/img/avatars/logo.jpg') }}';"
                    >

                    <div class="gallery-badge">
                        <i class="fa-solid fa-camera"></i>
                        <span>Foto</span>
                    </div>
                @endif
            </div>

                        <div class="gallery-body">
                            <h5 class="gallery-title">
                                {{ $item->judul }}
                            </h5>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="gallery-empty text-center">
                        <i class="fa-regular fa-images fa-3x text-secondary mb-3"></i>
                        <h5 class="fw-bold">Belum Ada Galeri</h5>
                        <p class="text-secondary mb-0">
                            Foto galeri yang sudah dipublikasikan admin akan tampil di sini.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<div class="modal fade" id="galeriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="galeriModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body text-center pt-0">
                <img src="" id="galeriModalImage" class="gallery-modal-image" alt="">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.gallery-image').forEach(function(image) {
        image.addEventListener('click', function() {
            document.getElementById('galeriModalImage').src = this.dataset.image;
            document.getElementById('galeriModalTitle').textContent = this.dataset.title;
        });
    });
</script>
@endpushZ