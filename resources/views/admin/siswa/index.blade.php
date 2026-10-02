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
                <div class="col-md-4 user_role">
                    <div class="dataTables_length" id="DataTables_Table_0_length">
                        <label>Menunjukkan 
                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select form-select-sm d-inline-block w-auto mx-2">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select> entri
                        </label>
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center justify-content-md-end justify-content-center flex-wrap gap-3">
                    <div class="dataTables_filter">
                        <label>Cari: 
                            <input type="search" class="form-control form-control-sm d-inline-block w-auto ms-2" placeholder="Cari data..." aria-controls="DataTables_Table_0">
                        </label>
                    </div>
                    <div class="dt-action-buttons text-end">
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Tambah Data Siswa
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Kosong -->
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
                            <td>{{ $siswa->tanggal_masuk}}</td>
                            <td class="text-center">
                                 <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('siswa.edit', $siswa->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengelola ini?');" style="display:inline;">
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
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data tersedia.</td>
                        </tr>    
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <div class="text-muted">Menampilkan {{ count($siswas) }} entri</div>
        </div>
    </div>
</div>
@endsection