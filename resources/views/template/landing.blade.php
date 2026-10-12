```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>@yield('title', $profil->nama_sekolah ?? 'SDN 6 Mangunreja')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100vh;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        .custom-navbar {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100% !important;
            z-index: 1000 !important;
            transition: all 0.2s ease-in-out !important;
            background: rgba(18, 30, 49, 0.45) !important;
            backdrop-filter: blur(8px) !important;
            -webkit-backdrop-filter: blur(8px) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .custom-navbar .navbar-brand,
        .custom-navbar .navbar-nav > .nav-item > .nav-link {
            color: #ffffff !important;
        }

        .custom-navbar.scrolled {
            position: fixed !important;
            background-color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15) !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }

        .custom-navbar.scrolled .navbar-brand,
        .custom-navbar.scrolled .navbar-nav > .nav-item > .nav-link {
            color: #1a2536 !important;
        }

        .custom-navbar .dropdown-menu {
            background-color: #ffffff !important;
            border: none;
            border-radius: 10px;
            padding: 8px;
            min-width: 190px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            z-index: 1050;
        }

        .custom-navbar .dropdown-menu .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 14px;
            border-radius: 7px;
            font-weight: 500;
            color: #333333 !important;
            background-color: #ffffff !important;
            transition: background-color 0.2s, color 0.2s;
        }

        .custom-navbar .dropdown-menu .dropdown-item i {
            color: #176b87 !important;
            width: 18px;
        }

        .custom-navbar .dropdown-menu .dropdown-item:hover,
        .custom-navbar .dropdown-menu .dropdown-item:focus {
            background-color: #eaf4f8 !important;
            color: #176b87 !important;
        }

        .custom-navbar .dropdown-menu .dropdown-item:hover i,
        .custom-navbar .dropdown-menu .dropdown-item:focus i {
            color: #176b87 !important;
        }

        .g-k {
            width: 220px;
            height: 3px;
            background: linear-gradient(to right, #e0a96d 0%, #f4cb85 40%, rgba(244, 203, 133, 0) 100%);
            border-radius: 2px;
            margin-top: 8px;
            margin-bottom: 20px;
        }

        .hover-white:hover {
            color: #ffffff !important;
            padding-left: 4px;
            transition: all 0.2s ease;
        }

        @media (max-width: 575.98px) {
            .custom-navbar .navbar-collapse {
                background: rgba(18, 30, 49, 0.97);
                padding: 15px;
                margin-top: 10px;
                border-radius: 10px;
            }

            .custom-navbar.scrolled .navbar-collapse {
                background: #ffffff;
            }

            .custom-navbar .navbar-nav {
                align-items: flex-start !important;
                gap: 8px !important;
            }

            .custom-navbar .dropdown-menu {
                margin-top: 5px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-sm custom-navbar p-2" data-solid="{{ !empty($solidNavbar) ? 'true' : 'false' }}">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}">
                <img
                    src="{{ !empty($profil->logo) ? asset('storage/profile/' . str_replace('profile/', '', $profil->logo)) : asset('assets/img/avatars/logo.jpg') }}"
                    alt="Logo SDN 6 Mangunreja"
                    class="rounded-circle"
                    style="width: 45px; height: 45px; object-fit: cover;"
                    onerror="this.onerror=null;this.src='https://via.placeholder.com/45';"
                >
                <span style="font-size: 20px;">{{ $profil->nama_sekolah ?? 'SDN 6 Mangunreja' }}</span>
            </a>

            <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#toggle" aria-controls="toggle" aria-expanded="false" aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="toggle">
                <ul class="navbar-nav ms-auto gap-4 align-items-center fw-semibold" style="font-size: 15px;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="informasiDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Informasi
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="informasiDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('landing.berita') }}">
                                    <i class="fas fa-newspaper me-2"></i>
                                    Berita
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('landing.galeri') }}">
                                    <i class="fas fa-images me-2"></i>
                                    Galeri
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing.profil') }}">Profil Sekolah</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('landing.eskul')}}">Ekstrakurikuler</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('landing.guru')}}">Guru &amp; Staf</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="text-white pt-5 pb-4" style="background-color: #021526; border-top: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="container">
            <div class="row g-4 justify-content-center align-items-start mb-4">
                <div class="col-lg-5 col-md-6 text-start">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img
                            src="{{ asset('assets/img/avatars/logo.jpg') }}"
                            alt="Logo SDN 6 Mangunreja"
                            class="rounded-circle"
                            style="width: 40px; height: 40px; object-fit: cover;"
                        >
                        <h5 class="fw-bold mb-0 text-white" style="font-size: 18px;">SDN 6 Mangunreja</h5>
                    </div>

                    <p class="text-white-50 mb-3" style="font-size: 13px; line-height: 1.6; max-width: 400px;">
                        Mewujudkan peserta didik yang bertaqwa, berprestasi, berkarakter, dan berwawasan lingkungan melalui pendidikan yang berkualitas.
                    </p>

                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="fa-brands fa-facebook-f" style="font-size: 12px;"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="fa-brands fa-instagram" style="font-size: 12px;"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="fa-brands fa-youtube" style="font-size: 12px;"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 text-start">
                    <h6 class="fw-bold text-white mb-2" style="font-size: 15px;">Navigasi Cepat</h6>
                    <div class="g-k mb-3"></div>
                    <ul class="list-unstyled text-white-50 d-flex flex-column gap-2 mb-0" style="font-size: 13px;">
                        <li>
                            <a href="{{ url('/#profil') }}" class="text-white-50 text-decoration-none hover-white">
                                <i class="fa-solid fa-chevron-right me-1" style="font-size: 10px;"></i>
                                Profil Sekolah
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('landing.berita') }}" class="text-white-50 text-decoration-none hover-white">
                                <i class="fa-solid fa-chevron-right me-1" style="font-size: 10px;"></i>
                                Berita &amp; Kegiatan
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/#galeri') }}" class="text-white-50 text-decoration-none hover-white">
                                <i class="fa-solid fa-chevron-right me-1" style="font-size: 10px;"></i>
                                Galeri Foto
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/#ekstrakurikuler') }}" class="text-white-50 text-decoration-none hover-white">
                                <i class="fa-solid fa-chevron-right me-1" style="font-size: 10px;"></i>
                                Ekstrakurikuler
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/#guru') }}" class="text-white-50 text-decoration-none hover-white">
                                <i class="fa-solid fa-chevron-right me-1" style="font-size: 10px;"></i>
                                Guru &amp; Staf
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-top mt-4 pt-3 text-center text-white-50" style="border-color: rgba(255, 255, 255, 0.08) !important; font-size: 12px;">
                <p class="mb-0">&copy; {{ date('Y') }} <strong>SDN 6 Mangunreja</strong>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const navbar = document.querySelector('.custom-navbar');

        if (navbar) {
            const solid = navbar.dataset.solid === 'true';

            function updateNavbar() {
                if (solid || window.scrollY > 40) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }

            window.addEventListener('scroll', updateNavbar);
            updateNavbar();
        }       
    </script>
    @stack('scripts')
</body>
</html>
