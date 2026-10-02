@extends('Template') 

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">      
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="d-flex align-items-start row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}! 🎉</h5>
                                <p class="mb-4">
                                    Selamat datang di Panel Administrator Website Resmi <strong>SDN 6 Mangunreja</strong>.<br />
                                    Kelola data siswa, pengelola, dan kegiatan sekolah dengan mudah melalui menu di samping.
                                </p>
                                <a href="{{ route('admin.index') }}" class="btn btn-sm btn-outline-primary">Kelola Pengelola</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                                    height="175"
                                    alt="View Badge User" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-3">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-user fs-4"></i>
                                </span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded text-body-secondary"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{route('siswa.index')}}">Refresh Data</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-1">Total Siswa</p>
                        <h4 class="card-title mb-2">{{ $totalSiswa ?? 0 }}</h4>
                        <small class="text-success fw-medium">
                            <i class="bx bx-check-shield"></i> Terdaftar aktif
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-3">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-info">
                                    <i class="bx bx-user-pin fs-4"></i>
                                </span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded text-body-secondary"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">Lihat Pengelola</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-1">Total Pengelola</p>
                        <h4 class="card-title mb-2">{{ $totalPengelola ?? 0 }}</h4>
                        <small class="text-info fw-medium">
                            <i class="bx bx-shield"></i> Admin & Operator
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-3">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="bx bx-football fs-4"></i>
                                </span>
                            </div>
                             <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded text-body-secondary"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="{{ route('ekstrakulikuler.index') }}">Lihat eskul</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-1">Total Ekstrakurikuler</p>
                        <h4 class="card-title mb-2">{{ $totalEkskul ?? 0 }}</h4>
                        <small class="text-warning fw-medium">
                            <i class="bx bx-trophy"></i> Kegiatan Sekolah
                        </small>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection