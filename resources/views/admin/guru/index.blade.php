@extends('template')
@section('title', 'Data Guru')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Data Guru
    </h4>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Tabel Data Guru</h5>
            <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-4 user_role">
                    <div class="dataTables_length">
                        <label>Menunjukkan 
                            <select class="form-select form-select-sm d-inline-block w-auto mx-2">
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
                            <input type="search" class="form-control form-control-sm d-inline-block w-auto ms-2" placeholder="Cari data...">
                        </label>
                    </div>
                    <div class="dt-action-buttons text-end">
                        <!-- Route diarahkan ke guru.create -->
                        <a href="{{ route('guru.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Tambah Data Guru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $index => $guru)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($guru->foto)
                                    <!-- Menampilkan foto dari storage -->
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" width="40" height="40" class="rounded-circle object-fit-cover">
                                @else
                                    <span class="badge bg-label-secondary">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $guru->nip }}</td>
                            <td>{{ $guru->nama_guru }}</td>
                            <td>{{ $guru->mata_pelajaran }}</td>
                            <td class="text-center">
                               <div class="dropdown">
                                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="bx bx-dots-vertical-rounded"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="{{ route('guru.edit', $guru->id) }}">
                                             <i class="bx bx-edit-alt me-1"></i> Edit
                                         </a>
                                         <!-- Route hapus guru -->
                                         <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data guru ini?');" style="display:inline;">
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
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data guru tersedia.</td>
                        </tr>   
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <div class="text-muted">Menampilkan {{ count($gurus) }} entri</div>
        </div>
    </div>
</div>
@endsection