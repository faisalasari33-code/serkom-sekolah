@extends('template')
@section('title', 'Data Galeri')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Data Galeri
    </h4>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Tabel Data Galeri</h5>
            <a href="{{ route('galeri.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Tambah Galeri
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galeris as $index => $galeri)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($galeri->foto)
                                    <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Foto Galeri" width="60" height="40" class="rounded object-fit-cover shadow-sm">
                                @else
                                    <span class="badge bg-label-secondary">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $galeri->judul }}</td>
                            <td><span class="badge bg-label-primary">{{ $galeri->kategori }}</span></td>
                            <td>{{ Str::limit($galeri->keterangan, 30) }}</td>
                            <td>{{ $galeri->tanggal }}</td>
                            <td class="text-center">
                               <div class="dropdown">
                                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="bx bx-dots-vertical-rounded"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="{{ route('galeri.edit', $galeri->id) }}">
                                             <i class="bx bx-edit-alt me-1"></i> Edit
                                         </a>
                                         <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus galeri ini?');" style="display:inline;">
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
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data galeri tersedia.</td>
                        </tr>   
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection