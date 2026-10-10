@extends('template')
@section('title', 'Data Galeri')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Data Galeri
    </h4>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            
            <form action="{{ route('galeri.index') }}" method="GET" class="d-flex align-items-center">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul galeri..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    @if(request()->has('search'))
                        <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>

            <div class="dt-action-buttons text-end">
                <a href="{{ route('galeri.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Galeri
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">NO</th>
                            <th>MEDIA</th>
                            <th>JUDUL</th>
                            <th>KATEGORI</th>
                            <th>KETERANGAN</th>
                            <th>STATUS</th>
                            <th>TANGGAL</th>
                            <th class="text-center" style="width: 80px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galeri as $index => $item)
                          <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($item->video)
                                    <video style="width: 100px; height: 60px; object-fit: cover;" class="rounded shadow-sm" controls>
                                        <source src="{{ asset('storage/' . $item->video) }}" type="video/mp4">
                                    </video>
                                @elseif($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Galeri" width="60" height="40" class="rounded object-fit-cover shadow-sm">
                                @else
                                    <span class="badge bg-label-secondary">TIDAK ADA MEDIA</span>
                                @endif
                            </td>
                            
                            <td><strong>{{ $item->judul }}</strong></td>
                            
                            <td>
                                @if(strtolower($item->kategori) === 'video')
                                    <span class="badge bg-label-danger"><i class="bx bx-video me-1"></i> VIDEO</span>
                                @else
                                    <span class="badge bg-label-primary"><i class="bx bx-image me-1"></i> FOTO</span>
                                @endif
                            </td>
                            
                            <td>{{ Str::limit($item->keterangan, 30) }}</td>
                            
                            <td>
                                @if(isset($item->status) && strtolower($item->status) == 'publish')
                                    <span class="badge bg-label-success">PUBLISH</span>
                                @else
                                    <span class="badge bg-label-secondary">DRAFT</span>
                                @endif
                            </td>
                            
                            <td>{{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->format('d-m-Y') }}</td>
                            
                            <td class="text-center">
                               <div class="dropdown">
                                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="bx bx-dots-vertical-rounded"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <a class="dropdown-item" href="{{ route('galeri.edit', $item->id) }}">
                                             <i class="bx bx-edit-alt me-1"></i> Edit
                                         </a>
                                         <form action="{{ route('galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus galeri ini?');" style="display:inline;">
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
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data galeri tersedia.</td>
                        </tr>   
                        @endempty
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection