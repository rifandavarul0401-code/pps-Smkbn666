@extends('guru.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-chart-bar me-2"></i>Laporan Kelas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Kelas</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-2"></i>Pilih Kelas
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <select class="form-select" name="kelas_id" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->kelas_id }}" {{ request('kelas_id') == $k->kelas_id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    @if($selectedKelas)
    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-2"></i>Laporan Kelas {{ $selectedKelas->nama_kelas }}
            <span class="badge bg-primary ms-2">{{ count($data) }} siswa</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Total Pelanggaran</th>
                            <th>Total Prestasi</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['siswa']->nis }}</td>
                                <td>{{ $item['siswa']->nama_siswa }}</td>
                                <td>{{ $item['total_pelanggaran'] }}</td>
                                <td>{{ $item['total_prestasi'] }}</td>
                                <td>{{ $item['poin'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data siswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body text-center">
            <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
            <h5>Pilih Kelas untuk Melihat Laporan</h5>
            <p class="text-muted">Gunakan form di atas untuk memilih kelas yang ingin dilihat laporannya</p>
        </div>
    </div>
    @endif
</div>
@endsection