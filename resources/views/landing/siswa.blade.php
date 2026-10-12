@extends('template.landing')

@section('content')
<div class="container py-5">
    <!-- Header Halaman -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Daftar Seluruh Siswa</h1>
        <p class="text-muted">Cari dan lihat data peserta didik yang aktif di sekolah kami</p>
    </div>

    <!-- Kotak Pencarian -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('landing.siswa') }}" method="GET" class="input-group shadow-sm">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Nama atau NISN..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
                @if(request('search'))
                    <a href="{{ route('landing.siswa') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Tabel Data Siswa -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 5%;">No</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nisn ?? '-' }}</td>
                                <td class="fw-semibold">{{ $item->nama_siswa ?? '-' }}</td>
                                <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $item->tanggal_masuk ? \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Data siswa tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection