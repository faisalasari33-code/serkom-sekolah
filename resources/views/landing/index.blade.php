@extends('template.landing')

@section('title', ($profil->nama_sekolah ?? 'SDN 6 Mangunreja') . ' - Beranda')

@push('styles')
<style>
.home-page {
    --home-blue: #0b4382;
    --home-gold: #ffb703;
    font-size: 14px;
}

.home-page *,
.home-page *::before,
.home-page *::after {
    box-sizing: border-box;
}

.home-page .hero-wrapper {
    position: relative;
    width: 100%;
    height: min(76vh, 650px);
    min-height: 420px;
    overflow: hidden;
}

.home-page .hero-background {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    filter: brightness(.65);
}

.home-page .hero-overlay-container {
    position: absolute;
    top: 43%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 820px;
}

.home-page .hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(28px, 3.5vw, 48px);
    font-weight: 800;
    letter-spacing: 1px;
    line-height: 1.2;
    text-shadow: 0 4px 12px rgba(0,0,0,.75);
    overflow-wrap: anywhere;
}

.home-page .stats-card-container {
    position: relative;
    margin-top: -48px;
    margin-bottom: 24px;
    z-index: 2;
}

.home-page .stats-box {
    background: #5f6e83;
    border-radius: 14px;
    padding: 14px 10px;
    box-shadow: 0 8px 24px rgba(0,0,0,.14);
}

.home-page .stat-item {
    border-right: 1px solid rgba(255,255,255,.2);
}

.home-page .stat-item:last-child {
    border-right: none;
}

.home-page .stat-number {
    font-size: 26px !important;
    font-weight: 800;
    line-height: 1.3;
    color: white;
}

.home-page .stat-label {
    font-size: 12px !important;
    color: #e0e0e0;
}

.home-page .home-section {
    padding-top: 38px !important;
    padding-bottom: 38px !important;
}

.home-page .section-subtitle {
    color: #d97706;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.home-page .section-heading {
    color: var(--home-blue);
    font-size: 23px;
    line-height: 1.3;
    font-weight: 800;
    margin-bottom: 12px;
}

.home-page .section-line {
    width: 175px;
    height: 3px;
    border-radius: 2px;
    margin-top: 7px;
    margin-bottom: 15px;
    background: linear-gradient(to right, #e0a96d, #f4cb85 50%, transparent);
}

.home-page .section-copy {
    color: #667085;
    font-size: 13px;
    line-height: 1.8;
}

.home-page .kepsek-photo {
    width: 100%;
    height: 350px;
    object-fit: cover;
    object-position: center top;
    border-radius: 15px;
}

.home-page .kepsek-copy {
    color: #667085;
    font-size: 13px;
    line-height: 1.85;
}

.home-page .news-section {
    background: #031b33;
}

.home-page .news-section .news-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px !important;
    max-width: 350px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.home-page .news-section .news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
}

.home-page .news-image {
    width: 100%;
    height: 155px;
    object-fit: cover;
}

.home-page .gallery-card,
.home-page .eskul-card,
.home-page .guru-card {
    transition: transform .25s ease, box-shadow .25s ease;
}

.home-page .gallery-card:hover,
.home-page .eskul-card:hover,
.home-page .guru-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,.12) !important;
}

.home-page .gallery-image {
    width: 100%;
    height: 170px;
    object-fit: cover;
}

.home-page .eskul-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.home-page .eskul-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
}

.home-page .eskul-image-wrap {
    position: relative;
    height: 155px;
    overflow: hidden;
}

.home-page .eskul-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s ease;
}

.home-page .eskul-card .card-body {
    padding: 17px !important;
}

.home-page .eskul-card h5 {
    font-size: 15px !important;
}

.home-page .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.staff-section {
    padding: 40px 0 35px;
    background: #fff;
    overflow: hidden;
}

.staff-section .staff-label {
    color: #e88a00;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 1.5px;
    margin-bottom: 4px;
}

.staff-section .staff-heading {
    color: #0b4382;
    font-size: 30px;
    font-weight: 800;
    margin-bottom: 12px;
}

.staff-section .staff-line {
    width: 300px;
    max-width: 100%;
    height: 4px;
    border-radius: 5px;
    background: linear-gradient(to right, #e5a04b, #f8e7cc, transparent);
    margin-bottom: 20px;
}

.staff-section .staff-description {
    color: #344054;
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 25px;
}

.staff-section .staff-more {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 13px;
    border-radius: 8px;
    background: #1260b5;
    color: #fff;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.staff-section .staff-more:hover {
    background: #0b4382;
}

.staff-section .staff-controls {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    margin-bottom: 25px;
}

.staff-section .staff-arrow {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #eee;
    border-radius: 9px;
    background: #fff;
    color: #4389cc;
    font-size: 21px;
    cursor: pointer;
}

.staff-section .staff-track {
    display: grid;
    grid-auto-columns: calc((100% - 48px) / 4);
    grid-auto-flow: column;
    gap: 16px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
    padding: 4px 0 10px;
}

.staff-section .staff-track::-webkit-scrollbar {
    display: none;
}

.staff-section .staff-card {
    min-width: 0;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 3px 8px rgba(0, 0, 0, .04);
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.staff-section .staff-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
}

.staff-section .staff-photo {
    display: block;
    width: 100%;
    height: 380px;
    object-fit: cover;
    object-position: center top;
    transition: transform 0.4s ease;
}

.staff-section .staff-card-body {
    min-height: 88px;
    padding: 12px 10px;
    text-align: center;
}

.staff-section .staff-name {
    color: #383838;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.5;
    margin-bottom: 5px;
}

.staff-section .staff-role {
    color: #4b4b4b;
    font-size: 13px;
    line-height: 1.6;
    margin-bottom: 0;
}

@media (max-width: 991px) {
    .staff-section .staff-track {
        grid-auto-columns: calc((100% - 16px) / 2);
    }
    .staff-section .staff-photo {
        height: 320px;
    }
}

@media (max-width: 575px) {
    .staff-section {
        padding: 30px 0 25px;
    }
    .staff-section .staff-heading {
        font-size: 24px;
    }
    .staff-section .staff-label {
        font-size: 11px;
    }
    .staff-section .staff-description {
        font-size: 13px;
    }
    .staff-section .staff-track {
        grid-auto-columns: 75%;
        gap: 12px;
    }
    .staff-section .staff-photo {
        height: 300px;
    }
    .staff-section .staff-name {
        font-size: 14px;
    }
    .staff-section .staff-role {
        font-size: 12px;
    }
}

.home-page .gallery-subtitle {
    color: #e88900;
    font-size: 12px;
    letter-spacing: 1px;
    margin-bottom: 4px !important;
}

.home-page .gallery-heading {
    color: #07539b;
    font-size: 26px;
    font-weight: 800;
}

.home-page .gallery-line {
    width: 220px;
    height: 3px;
    margin-top: 8px;
    margin-bottom: 12px;
    background: linear-gradient(to right, #e99b22, transparent);
}

.home-page .gallery-description {
    color: #26364a;
    font-size: 13px;
    line-height: 1.6;
    margin-top: 12px;
}

.home-page .gallery-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 12px;
    background: #0860ad;
    color: white;
    border-radius: 7px;
    text-decoration: none;
    font-size: 12px;
    white-space: nowrap;
}

.home-page .gallery-button:hover {
    background: #064a87;
}

.home-page .gallery-card {
    height: 100%;
    overflow: hidden;
    background: white;
    border-radius: 13px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
}

.home-page .gallery-image-wrap {
    position: relative;
    width: 100%;
    height: 190px;
    overflow: hidden;
}

.home-page .gallery-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.home-page .gallery-card-body {
    padding: 12px 14px;
}

.home-page .gallery-card-body h6 {
    margin: 0;
    color: #333;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 600;
}

@media (max-width: 767px) {
    .home-page .gallery-heading {
        font-size: 22px;
    }
    .home-page .gallery-description {
        font-size: 12px;
    }
    .home-page .gallery-image-wrap {
        height: 180px;
    }
    .home-page .gallery-card-body h6 {
        font-size: 13px;
    }
}

.home-page .kepsek-layout {
    display: flex;
    align-items: center;
    gap: 35px;
}

.home-page .section-heading {
    font-size: 36px;
}

.home-page .kepsek-copy {
    font-size: 16px;
    line-height: 1.8;
}

@media (max-width: 767px) {
    .home-page .kepsek-layout {
        flex-direction: column;
        align-items: stretch;
        gap: 20px;
    }
    .home-page .kepsek-layout > .flex-shrink-0 {
        flex: none;
        width: 100%;
    }
    .home-page .kepsek-photo {
        width: 100%;
        max-width: 280px;
        height: 350px;
        margin: 0 auto;
    }
    .home-page .section-heading {
        font-size: 25px;
    }
    .home-page .kepsek-copy {
        font-size: 14px;
    }
}
</style>
@endpush

@section('content')
<div class="home-page">
    <div class="hero-wrapper p-0 m-0">
        <img src="{{ asset('assets/img/backgrounds/ss.png') }}" class="hero-background" alt="Gedung Sekolah">
        <div class="hero-overlay-container text-center text-white">
            <h1 class="hero-title mb-3 text-uppercase">
                {{ $profil->nama_sekolah }}
            </h1>
            <p class="lead mt-2 fs-5 fs-md-4" style="font-size: 15px; font-weight: bold;">
                Mendidik dengan Hati untuk Membentuk Generasi Cerdas, Berkarakter Kuat, dan Siap Menghadapi Tantangan Masa Depan
            </p>
        </div>
    </div>

    <div class="container stats-card-container">
        <div class="stats-box text-white w-100">
            <div class="row text-center align-items-center g-0">
                <div class="col-3 stat-item py-1">
                    <div class="stat-number">{{ $profil->akreditasi ?? 'A' }}</div>
                    <div class="stat-label">Akreditasi</div>
                </div>

                <div class="col-3 stat-item py-1">
                    <div class="stat-number">
                        {{ isset($totalSiswa) && $totalSiswa > 0 ? $totalSiswa : ($profil->jumlah_siswa ?? '0') }}
                    </div>
                    <div class="stat-label">Siswa</div>
                </div>

                <div class="col-3 stat-item py-1">
                    <div class="stat-number">
                        {{ $totalGuru ?? count($guru) }}
                    </div>
                    <div class="stat-label">Guru &amp; Staf</div>
                </div>

                <div class="col-3 stat-item py-1">
                    <div class="stat-number">
                        {{ $totalEskul ?? count($ekstrakurikuler) }}
                    </div>
                    <div class="stat-label">Ekstrakurikuler</div>
                </div>
            </div>
        </div>
    </div>

    <section class="home-section bg-white">
        <div class="container">
            <div class="kepsek-layout">
                <div class="flex-shrink-0">
                    <div class="rounded-4 overflow-hidden shadow-sm">
                        <img
                            src="{{ !empty($profil->foto_kepala_sekolah) ? asset('storage/profile/' . str_replace('profile/', '', $profil->foto_kepala_sekolah)) : asset('assets/img/avatars/bangwil.jpeg') }}"
                            alt="Kepala Sekolah"
                            class="kepsek-photo">
                    </div>
                </div>
                <div class="flex-grow-1">
                    <p class="section-subtitle mb-1">
                        KOMITMEN KAMI UNTUK PENDIDIKAN
                    </p>
                    <h3 class="section-heading mb-2">
                        Sambutan Kepala Sekolah
                    </h3>
                    <div class="section-line"></div>
                    <p class="kepsek-copy mb-3">
                        {{ $profil->sambutan_kepsek ?? 'Puji syukur ke hadirat Tuhan YME atas segala rahmat dan karunia-Nya. Selamat datang di website resmi sekolah kami. Website ini kami hadirkan sebagai sarana informasi dan komunikasi antara sekolah dengan orang tua, peserta didik, serta masyarakat luas.' }}
                    </p>
                    <p class="kepsek-copy mb-4">
                        Melalui media ini, kami berharap seluruh informasi mengenai kegiatan, prestasi, serta program pendidikan dapat tersampaikan secara transparan, cepat, dan akurat.
                    </p>
                    <div class="pt-1">
                        <h6 class="fw-bold mb-0 text-dark">
                            {{ $profil->kepala_sekolah }}
                        </h6>
                        <span class="text-muted small">Kepala Sekolah</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="berita" class="news-section home-section py-5">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="text-center mb-5">
                <span
                    class="badge px-3 py-2 rounded-pill fw-semibold mb-2"
                    style="background:rgba(217,119,6,.15);color:#f59e0b;border:1px solid rgba(245,158,11,.3);font-size:10px;letter-spacing:1px;">
                    BERITA KEGIATAN SEKOLAH
                </span>
                <h2 class="fw-bold text-white mb-2" style="font-size:26px;">
                    Berita Terbaru
                </h2>
                <div class="section-line mx-auto mb-3" style="width: 50px; height: 3px; background-color: #f59e0b;"></div>
                <p class="text-white-50 mx-auto section-copy" style="max-width:600px;">
                    Dapatkan informasi terbaru mengenai kegiatan, pengumuman, dan prestasi civitas akademika SDN 6 Mangunreja.
                </p>
            </div>

            <div class="row justify-content-center g-4 align-items-stretch px-2 px-md-4" style="margin-left: auto; margin-right: auto;">
                @forelse($berita as $item)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="card news-card border-0 shadow-sm w-100 h-100 d-flex flex-column p-4 bg-white rounded-4">
                            @if(!empty($item->foto))
                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    class="news-image rounded-3 mb-3 w-100"
                                    style="height: 200px; object-fit: cover;"
                                    alt="Berita"
                                    onerror="this.src='{{ asset('assets/img/avatars/bangwil.jpeg') }}'">
                            @endif

                            <h5 class="fw-bold text-dark lh-base mb-2" style="font-size:16px;">
                                {{ $item->judul }}
                            </h5>

                            <p class="text-muted small mb-3" style="font-size:12px;">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                            </p>

                            <p class="text-secondary small lh-sm mb-4 flex-grow-1" style="font-size:13px;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}
                            </p>

                            <div class="mt-auto pt-2">
                                <a href="{{ route('landing.berita') }}"
                                class="small text-decoration-underline text-primary fw-semibold">
                                    Selengkapnya »
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-white-50 small">Belum ada berita terbaru.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('landing.berita') }}"
                class="text-white text-decoration-none fw-semibold" style="font-size: 14px;">
                    » Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <section id="galeri" class="home-section gallery-section py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-3 gap-3">
                <div>
                    <p class="gallery-subtitle mb-1">DOKUMENTASI KEGIATAN</p>
                    <h3 class="gallery-heading mb-0">Galeri Sekolah</h3>
                    <div class="gallery-line"></div>
                </div>

                <a href="{{ route('landing.galeri') }}" class="gallery-button">
                    <i class="fa-solid fa-chevron-right"></i>
                    Lihat Semua
                </a>
            </div>

            <div class="gallery-description">
                Galeri sekolah menampilkan berbagai dokumentasi kegiatan dan momen berharga siswa selama proses pembelajaran dan pengembangan diri. Melalui foto dan video, Anda dapat melihat secara langsung suasana belajar, prestasi, serta aktivitas siswa di lingkungan sekolah kami.
            </div>

            <div class="row g-3 mt-3">
                @forelse($galeri as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-card h-100">
                            <div class="gallery-image-wrap" style="height: 200px; overflow: hidden; background: #000; position: relative;">
                                @if(!empty($item->video))
                                    <video class="w-100 h-100" style="object-fit: cover;" controls>
                                        <source src="{{ asset('storage/' . $item->video) }}" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                @elseif(!empty($item->foto))
                                    <img 
                                        src="{{ asset('storage/' . $item->foto) }}" 
                                        class="gallery-image w-100 h-100" 
                                        style="object-fit: cover;" 
                                        alt="{{ $item->judul }}"
                                    >
                                @else
                                    <img 
                                        src="{{ asset('assets/img/avatars/logo.jpg') }}" 
                                        class="gallery-image w-100 h-100" 
                                        style="object-fit: cover;" 
                                        alt="Default"
                                    >
                                @endif
                            </div>
                            <div class="gallery-card-body">
                                <h6>{{ $item->judul }}</h6>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted mb-0">Belum ada galeri tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="ekstrakurikuler" class="home-section position-relative"
             style="background:linear-gradient(135deg,#021526 0%,#031b33 50%,#082846 100%);">
        <div class="container position-relative">
            <div class="text-center mb-4">
                <span
                    class="badge px-3 py-2 rounded-pill fw-semibold mb-2"
                    style="background:rgba(217,119,6,.15);color:#f59e0b;border:1px solid rgba(245,158,11,.3);font-size:10px;letter-spacing:1px;">
                    WADAH BAKAT &amp; PRESTASI
                </span>
                <h2 class="fw-bold text-white mb-2" style="font-size:24px;">
                    Ekstrakurikuler Sekolah
                </h2>
                <div class="section-line mx-auto"></div>
                <p class="text-white-50 section-copy mx-auto" style="max-width:600px;">
                    Mengembangkan potensi, minat, dan bakat siswa melalui berbagai pilihan kegiatan ekstrakurikuler.
                </p>
            </div>
            <div class="row g-3 justify-content-center">
                @forelse($ekstrakurikuler as $eskul)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card eskul-card border-0 rounded-4 overflow-hidden bg-white shadow-sm h-100">
                            <div class="eskul-image-wrap">
                                <img
                                    src="{{ !empty($eskul->foto) ? asset('storage/' . $eskul->foto) : asset('assets/img/avatars/logo.jpg') }}"
                                    class="eskul-image"
                                    alt="Foto Ekstrakurikuler"
                                    onerror="this.src='{{ asset('assets/img/avatars/logo.jpg') }}'"
                                >
                            </div>

                            <div class="card-body bg-white d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold mb-2 text-dark">
                                        {{ strtoupper($eskul->nama_ekstrakulikuler ?? $eskul->nama ?? 'FUTSAL') }}
                                    </h5>

                                    <p class="text-muted small mb-3 line-clamp-2" style="font-size:12px;line-height:1.6;">
                                        {{ $eskul->deskripsi ?? 'Kegiatan ekstrakurikuler untuk melatih kedisiplinan, kerja sama tim, dan kebugaran siswa.' }}
                                    </p>
                                </div>

                                <div class="pt-3 border-top d-flex align-items-center gap-2 text-muted">
                                    <i class="fa-solid fa-user-tie text-primary"></i>
                                    <div>
                                        <span class="d-block text-muted" style="font-size:10px;">Pembina</span>
                                        <strong class="text-dark" style="font-size:12px;">
                                            {{ $eskul->pembina ?? '-' }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-white-50 small">
                            Belum ada data ekstrakurikuler yang ditambahkan.
                        </p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('landing.eskul') }}"
                   class="text-white text-decoration-none fw-semibold" style="font-size: 14px;">
                    » Lihat Semua Ekstrakulikuler
                </a>
           </div>
        </div>
    </section>

    <section class="staff-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center gap-3 staff-header">
                <div>
                    <p class="staff-label">TENAGA PENDIDIK PROFESIONAL</p>
                    <h2 class="staff-heading">Guru &amp; Staf Berkualitas</h2>
                    <div class="staff-line"></div>
                </div>

                <a href="{{ route('landing.guru') }}" class="staff-more">
                    <span style="font-size:22px;line-height:1">›</span>
                    Lihat Semua
                </a>
            </div>
            <p class="staff-description">
                Guru dan staf kami terdiri dari tenaga profesional yang kompeten, berpengalaman, dan berdedikasi tinggi dalam memberikan layanan pendidikan berkualitas. Dengan pendekatan pembelajaran yang inovatif dan berorientasi pada kebutuhan siswa, kami berkomitmen menciptakan lingkungan belajar yang inspiratif dan produktif.
            </p>

            <div class="staff-controls">
                <button type="button" class="staff-arrow" id="staffPrev" aria-label="Sebelumnya">
                    &#8249;
                </button>
                <button type="button" class="staff-arrow" id="staffNext" aria-label="Berikutnya">
                    &#8250;
                </button>
            </div>

            <div class="staff-carousel">
                <div class="staff-track" id="staffTrack">
                    @forelse($guru as $g)
                        <article class="staff-card">
                            <img
                                src="{{ !empty($g->foto) ? asset('guru/' . $g->foto) : asset('assets/img/avatars/bangwil.jpeg') }}"
                                class="staff-photo"
                                alt="{{ $g->nama_guru ?? $g->nama_lengkap ?? $g->nama ?? 'Guru' }}"
                                loading="lazy"
                                onerror="this.onerror=null;this.src='{{ asset('assets/img/avatars/bangwil.jpeg') }}';"
                            >
                            <div class="staff-card-body">
                                <h3 class="staff-name">
                                    {{ $g->nama_guru ?? $g->nama_lengkap ?? '-' }}
                                </h3>
                                <p class="staff-role">
                                    {{ $g->mapel ? $g->mapel->nama_mapel : '-' }}
                                </p>
                            </div>
                        </article>
                    @empty
                        <div class="py-4 text-muted">
                            Belum ada data guru dan staf.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>

<section class="py-5 bg-light" id="siswa">
   <div class="container">
       <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" style="width: 5%;">No</th>
                                <th scope="col">NISN</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tanggal Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswa as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nisn ?? '-' }}</td>
                                    <td class="fw-semibold">{{ $item->nama_siswa ?? '-' }}</td>
                                    <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                                    <td>{{ $item->tanggal_masuk ? \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Data siswa tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
       </div>
   </div>
</section>
@endsection