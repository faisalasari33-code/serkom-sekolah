@extends('template')

@section('title', 'edit - users')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Edit Data User</h5>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mb-3" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li><small>{{ $error }}</small></li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama..." autocomplete="off" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" placeholder="Masukkan username..." autocomplete="off" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Password Baru</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" />
                <div class="form-text"><small class="text-muted">Biarkan kosong jika password lama tidak ingin diganti.</small></div>
            </div>

         <div class="mb-3">
            <label class="form-label" for="role">Role / Hak Akses</label>
            <select class="form-control" id="role" name="role" required>
                <option value="" disabled>-- Pilih Role --</option>
                <option value="admin" {{ old('role', strtolower($user->role)) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="operator" {{ old('role', strtolower($user->role)) == 'operator' ? 'selected' : '' }}>Operator</option>
            </select>
         </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection