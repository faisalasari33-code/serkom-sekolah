@extends('template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Data siswa
    </h4>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Tabel Data siswa</h5>
            <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                <!-- Form Pencarian di Kiri -->
                <div class="col-md-7">
                    <form action="{{ route('siswa.index') }}" method="GET" class="d-flex align-items-center gap-2">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari data siswa..." style="max-width: 250px;">
                        
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bx bx-search me-1"></i> Cari
                        </button>

                        @if(request('search'))
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bx bx-reset me-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>
                
                <!-- Tombol Tambah di Kanan -->
                <div class="col-md-5 text-md-end">
                    <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus me-1"></i> Tambah Data Siswa
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Masuk</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $index => $siswa)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->nama_siswa}}</td>
                            <td>{{ $siswa->jenis_kelamin }}</td>
                            <td>{{ $siswa->tanggal_masuk }}</td>
                            <td class="text-center">
                               <div class="dropdown">
                                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="bx bx-dots-vertical-rounded"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="{{ route('siswa.edit', $siswa->id) }}">
                                             <i class="bx bx-edit-alt me-1"></i> Edit
                                         </a>
                                         <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display:inline;">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="dropdown-item text-danger">
                                                 <i class="bx bx-trash me-1"></i> Hapus
                                             </button>
                                         </form>
                                     </div>
                               </div>
                            </td>
                          </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data tersedia.</td>
                        </tr>   
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection