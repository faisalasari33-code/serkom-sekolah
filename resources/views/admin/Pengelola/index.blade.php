@extends('template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Data Pengelola
    </h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bx bx-user-pin text-primary me-2"></i> Daftar Pengelola Sistem</h5>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Tambah Pengelola
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 25%;">Nama Lengkap</th>
                            <th style="width: 25%;">Username / Email</th>
                            <th style="width: 15%;">Role / Hak Akses</th>
                            <th style="width: 20%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            <span class="avatar-initial rounded-circle bg-label-primary">
                                                {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                                            </span>
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $user->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email ?? $user->username ?? '-' }}</td>
                                <td>
                                    @if(isset($user->role) && strtolower($user->role) == 'admin')
                                        <span class="badge bg-label-primary">Admin</span>
                                    @else
                                        <span class="badge bg-label-info">Operator</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.edit', $user->id_user) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.destroy', $user->id_user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengelola ini?');" style="display:inline;">
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
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bx bx-info-circle fs-3 d-block mb-2"></i> Belum ada data pengelola yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection