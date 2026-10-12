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
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Tabel Data Berita</h5>
            
            <!-- Filter, Search, dan Tombol Tambah disamakan dengan Galeri -->
            <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                <!-- Form Pencarian di Kiri -->
                <div class="col-md-7">
                    <form action="{{ route('berita.index') }}" method="GET" class="d-flex align-items-center gap-2">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari judul berita..." style="max-width: 250px;">
                        
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bx bx-search me-1"></i> Cari
                        </button>

                        @if(request('search'))
                            <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bx bx-reset me-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Tombol Tambah di Kanan -->
                <div class="col-md-5 text-md-end">
                    <a href="{{ route('berita.create') }}" class="btn btn-primary btn-sm">
                        <i class="bx bx-plus me-1"></i> Tambah Data Berita
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">NO</th>
                            <th>FOTO</th>
                            <th>JUDUL BERITA</th>
                            <th>ISI BERITA</th>
                            <th>TANGGAL</th>
                            <th class="text-center" style="width: 80px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beritas as $key => $item)
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
                            <td>{{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->format('Y-m-d') }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if($item->id_user == Auth::id())
                                            <a class="dropdown-item" href="{{ route('berita.edit', $item->id_berita) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('berita.destroy', $item->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bx bx-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada berita tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection