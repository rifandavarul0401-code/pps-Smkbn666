@extends('kesiswaan.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-users me-2"></i>Data Siswa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('kesiswaan.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Siswa</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-search me-2"></i>Filter Data Siswa
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('kesiswaan.data-siswa') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="search" class="form-label">Cari Siswa</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="NIS, NISN, atau Nama">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-select" id="kelas" name="kelas">
                            <option value="">Semua Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->kelas_id }}" {{ request('kelas') == $k->kelas_id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i>Cari
                        </button>
                        <a href="{{ route('kesiswaan.data-siswa') }}" class="btn btn-secondary">
                            <i class="fas fa-refresh me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-2"></i>Daftar Siswa
            <span class="badge bg-primary ms-2">{{ $siswa->total() }} siswa</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>JK</th>
                            <th>Poin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                            <tr>
                                <td>{{ $siswa->firstItem() + $index }}</td>
                                <td>{{ $s->nis }}</td>
                                <td>{{ $s->nisn }}</td>
                                <td>{{ $s->nama_siswa }}</td>
                                <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $s->jenis_kelamin }}</td>
                                <td>{{ $s->total_poin }}</td>
                                <td>{{ ucfirst($s->status) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal{{ $s->siswa_id }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data siswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $siswa->links() }}
        </div>
    </div>
</div>

@foreach($siswa as $s)
<div class="modal fade" id="modal{{ $s->siswa_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail {{ $s->nama_siswa }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>NIS:</strong> {{ $s->nis }}</p>
                <p><strong>NISN:</strong> {{ $s->nisn }}</p>
                <p><strong>Nama:</strong> {{ $s->nama_siswa }}</p>
                <p><strong>Kelas:</strong> {{ $s->kelas->nama_kelas ?? '-' }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                <p><strong>Total Poin:</strong> {{ $s->total_poin }}</p>
                <p><strong>Status:</strong> {{ ucfirst($s->status) }}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection