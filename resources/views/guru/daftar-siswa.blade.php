@extends('guru.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-users me-2"></i>Daftar Siswa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar Siswa</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-search me-2"></i>Filter Siswa
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="search" 
                               value="{{ request('search') }}" placeholder="Cari nama atau NIS">
                    </div>
                    <div class="col-md-4 mb-3">
                        <select class="form-select" name="kelas">
                            <option value="">Semua Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->kelas_id }}" {{ request('kelas') == $k->kelas_id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <a href="{{ route('guru.daftar-siswa') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-2"></i>Data Siswa
            <span class="badge bg-primary ms-2">{{ $siswa->total() }} siswa</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Poin</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                            <tr>
                                <td>{{ $siswa->firstItem() + $index }}</td>
                                <td>{{ $s->nis }}</td>
                                <td>{{ $s->nama_siswa }}</td>
                                <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $s->total_poin }}</td>
                                <td>{{ ucfirst($s->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data siswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $siswa->links() }}
        </div>
    </div>
</div>
@endsection