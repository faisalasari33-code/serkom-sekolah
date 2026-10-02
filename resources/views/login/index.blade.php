<!DOCTYPE html>
<html lang="id" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login - PUSPENDIK CBT Application</title>
    
    <!-- CSS Template Admin (Sneat/Bootstrap) -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    
    <style>
        body {
            background-color: #f4f5fb;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            font-family: "Public Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .login-top-bg {
            background-color: #1b4d8e; 
            height: 48vh; 
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 35px;
            color: #fff;
        }

        .login-container {
            position: relative;
            z-index: 2;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            border-radius: 16px !important;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12) !important;
            background: #ffffff;
            border: none;
            margin-top: 70px; 
        }

        .logo-title {
            font-weight: 700;
            font-size: 22px;
            letter-spacing: 0.5px;
            margin-top: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .logo-subtitle {
            font-size: 11px;
            letter-spacing: 1.5px;
            opacity: 0.9;
            text-transform: uppercase;
            font-weight: 500;
        }

        /* Perbaikan tipografi form agar lebih bersih */
        .form-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #566a7f;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            border: 1px solid #d9deee;
        }

        .form-control:focus {
            border-color: #1b4d8e;
            box-shadow: 0 0 0 0.25rem rgba(27, 77, 142, 0.15);
        }
    </style>
</head>

<body>

    <!-- Bagian Banner Biru di Atas -->
    <div class="login-top-bg" style="background-image: linear-gradient(rgba(45, 90, 148, 0.312), rgba(54, 98, 142, 0.9)), url('{{ asset('assets/img/backgrounds/sd.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
         <div style="width: 65px; height: 65px; border-radius: 50% !important; overflow: hidden !important; display: flex; align-items: center; justify-content: center; border: 2.5px solid rgba(255,255,255,0.8); box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
             <img src="{{ asset('assets/img/backgrounds/sd.jpeg') }}" alt="Logo Sekolah" style="width: 100%; height: 100%; object-fit: cover;">
         </div>
        <div class="logo-title">SDN 6 Mangunreja</div>
        <div class="logo-subtitle mt-1">SDN 6 Mangunreja Application</div>
    </div>

    <!-- Bagian Card Kotak Putih di Tengah -->
    <div class="container login-container">
        <div class="card login-card">
            <div class="card-body px-5 py-4">
                <h4 class="mb-1 text-center fw-bold text-dark mt-2" style="font-size: 24px;">Selamat Datang 👋</h4>
                <p class="mb-4 text-center text-muted" style="font-size: 13px;">Silahkan login menggunakan akun yang telah terdaftar.</p>

                <!-- Notifikasi Error Validasi -->
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible py-2 mb-3 rounded-3" role="alert">
                        <small>{{ $errors->first() }}</small>
                        <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('auth') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">USERNAME / EMAIL</label>
                        <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Masukkan username...">
                    </div>

                    <!-- Input Password dengan Toggle Mata -->
                    <div class="mb-3">
                        <label class="form-label">PASSWORD</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" name="password" class="form-control" autocomplete="new-password" placeholder="Masukkan password..." />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1">
                            <label class="form-check-label text-muted" for="remember" style="font-size: 13px;">Ingat saya</label>
                        </div>
                    </div>

                    <div class="mb-2">
                        <button class="btn btn-primary d-grid w-100 py-2 fw-bold rounded-3 shadow-sm" type="submit" style="background-color: #1b4d8e; border-color: #1b4d8e; font-size: 15px;">Masuk ke Dashboard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    
    <!-- Script Toggle Password Icon Mata -->
    <script>
        $(document).ready(function() {
            $('.form-password-toggle .input-group-text').on('click', function(e) {
                e.preventDefault();
                let passwordInput = $(this).closest('.input-group').find('input');
                let icon = $(this).find('i');
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });
        });
    </script>
</body>
</html>