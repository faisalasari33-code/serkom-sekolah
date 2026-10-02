@extends('template')
@section('title', 'Data Berita')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Data Berita
    </h4>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Tabel Data Berita</h5>
            <a href="{{ route('berita.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Tambah Berita
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul Berita</th>
                            <th>Isi Berita</th>
                            <th>Tanggal</th>
                            <th>ID User</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($beritas as $index => $berita)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($berita->foto)
                                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" width="60" height="40" class="rounded object-fit-cover">
                                @else
                                    <span class="badge bg-label-secondary">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $berita->judul }}</td>
                            <td>
                                {{ Str::limit($berita->isi, 10) }}
                                @if(strlen($berita->isi) > 10)
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#detailModal{{ $berita->id_berita }}" class="text-primary fw-bold ms-1" style="font-size: 12px;">Selengkapnya</a>
                                @endif
                            </td>
                            <td>{{ $berita->tanggal }}</td>
                            <td>{{ $berita->id_user }}</td>
                            <td class="text-center">
                               <div class="dropdown">
                                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="bx bx-dots-vertical-rounded"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="{{ route('berita.edit', $berita->id_berita) }}">
                                             <i class="bx bx-edit-alt me-1"></i> Edit
                                         </a>
                                         <form action="{{ route('berita.destroy', $berita->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');" style="display:inline;">
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
                            <td colspan="7" class="text-center text-muted py-4">Belum ada berita tersedia.</td>
                        </tr>   
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($beritas as $berita)
<div class="modal fade" id="detailModal{{ $berita->id_berita }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $berita->judul }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 text-center">
                    @if($berita->foto)
                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" class="img-fluid rounded shadow-sm" style="max-height: 250px; object-fit: cover;">
                    @else
                        <span class="text-muted">Tidak ada foto</span>
                    @endif
                </div>
                <p class="text-muted small mb-2"><i class="bx bx-calendar"></i> Tanggal: {{ $berita->tanggal }}</p>
                <hr>
                <p style="white-space: pre-line; text-align: justify;">{{ $berita->isi }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection