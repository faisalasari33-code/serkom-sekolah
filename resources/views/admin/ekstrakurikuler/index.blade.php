@extends('template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Data Ekstrakurikuler</h4>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <h5 class="card-header">Tabel Data Ekstrakurikuler</h5>
        <div class="card-body border-bottom">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-md-auto d-flex align-items-center gap-2">
                    <span>Menunjukkan</span>
                    <select class="form-select form-select-sm d-inline-block w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>entri</span>
                </div>
                <div class="col-md-auto d-flex align-items-center gap-2">
                    <label for="search" class="mb-0">Cari:</label>
                    <input type="search" class="form-control form-control-sm" placeholder="Cari data..." style="width: 200px;">
                    <a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus me-1"></i> Tambah Data Ekstrakurikuler
                    </a>
                </div>
            </div>
        </div>
        
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <tr class="text-nowrap">
                        <th class="text-center" style="width: 50px;">NO</th>
                        <th class="text-center" style="width: 80px;">FOTO</th>
                        <th>NAMA EKSKUL</th>
                        <th>PEMBINA</th>
                        <th class="text-center">JADWAL LATIHAN</th>
                        <th>DESKRIPSI LATIHAN</th>
                        <th class="text-center" style="width: 60px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ekstrakulikulers as $item)
                        <tr class="align-middle">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Ekskul" width="40" height="40" class="rounded-circle object-fit-cover">
                                @else
                                    <span class="badge bg-label-secondary">Tidak ada</span>
                                @endif
                            </td>
                            <td><strong>{{ $item->nama_ekstrakulikuler }}</strong></td>
                            <td>{{ $item->pembina }}</td>
                            <td class="text-center">
                                <span class="badge bg-label-info">{{ $item->jadwal_latihan }}</span>
                            </td>
                            <td>{{ $item->deskripsi }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('ekstrakurikuler.edit', $item->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('ekstrakurikuler.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display:inline;">
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
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data ekstrakurikuler yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center py-3">
            <small class="text-muted">Menampilkan {{ count($ekstrakulikulers) }} entri</small>
        </div>
    </div>
</div>
@endsection