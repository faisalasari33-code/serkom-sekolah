<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'dashboard')</title>

    @include('template.styles')
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('template.sidebar')

            <div class="layout-page">
                @include('template.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                     <div class="card">
                    <div class="d-flex align-items-start row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary mb-3">Selamat Datang di halaman admin 🎉</h5>
                          <p class="mb-6">
                            "Every strike brings me closer to the next home run."- Babe Ruth.<br />Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-2 px-0 px-md-6">
                          <img
                            src="{{ asset('assets/img/illustrations/man-with-laptop-light.png')}}"
                            height="175"
                            alt="View Badge User" />
                        </div>
                      </div>
                    </div>
                  </div>
                        @yield('content')   
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-o">Daftar Data anggota</h5>

                    <a href="#" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus"> Tambah user
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('template.script') 
</body>
</html>