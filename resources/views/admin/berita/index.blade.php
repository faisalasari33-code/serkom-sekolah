@extends('template')
@section('title', 'Data Berita')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Data Berita
    </h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <h5 class="card-header">Tabel Data Berita</h5>

        <div class="card-body">
            <!-- Filter, Search, dan Tombol Tambah -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-4 d-flex align-items-center mb-2 mb-md-0">
                    <label class="me-2">Menunjukkan</label>
                    <select class="form-select form-select-sm w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <label class="ms-2">entri</label>
                </div>

                <div class="col-md-8 d-flex justify-content-md-end align-items-center gap-2">
                    <div class="d-flex align-items-center">
                        <label class="me-2">Cari:</label>
                        <input type="search" class="form-control form-control-sm" placeholder="Cari data...">
                    </div>
                    <a href="{{ route('berita.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus me-1"></i> Tambah Data Berita
                    </a>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">NO</th>
                            <th>FOTO</th>
                            <th>JUDUL BERITA</th>
                            <th>ISI BERITA</th>
                            <th>STATUS</th>
                            <th>TANGGAL</th>
                            <th class="text-center" style="width: 80px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berita as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="badge bg-label-secondary">No Image</span>
                                @endif
                            </td>
                            <td><strong>{{ Str::limit($item->judul, 30) }}</strong></td>
                            <td>{{ Str::limit(strip_tags($item->isi), 40) }}</td>
                            <td>
                                @if(strtolower($item->status ?? 'draft') == 'publish')
                                    <span class="badge bg-label-success fw-bold">PUBLISH</span>
                                @else
                                    <span class="badge bg-label-secondary fw-bold">DRAFT</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->format('Y-m-d') }}</td>
                            <td class="text-center">
                                <!-- Menu Dropdown Aksi (Titik Tiga) -->
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('berita.edit', $item->id_berita) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('berita.destroy', $item->id_berita) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                            <td colspan="7" class="text-center py-4">Belum ada berita tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <p class="text-muted small mb-0">Menampilkan {{ count($berita) }} entri</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection