@extends('walikelas.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Wali Kelas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    
    @if($kelas)
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Kelas yang Diampu:</strong> {{ $kelas->nama_kelas }} - {{ $kelas->jurusan }}
            <br><small>Kapasitas: {{ $kelas->kapasitas }} siswa</small>
        </div>
    @else
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Anda belum memiliki kelas yang diampu. Silakan hubungi administrator.
        </div>
    @endif
                    
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Total Siswa</div>
                            <div class="h4">{{ $total_siswa }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Total Pelanggaran</div>
                            <div class="h4">{{ $total_pelanggaran }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Total Prestasi</div>
                            <div class="h4">{{ $total_prestasi }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-trophy fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-exclamation-triangle me-2"></i>Pelanggaran Terbaru
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Jenis</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPelanggaran as $p)
                                <tr>
                                    <td>{{ $p->siswa->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $p->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                    <td>{{ $p->tanggal ? $p->tanggal->format('d/m/Y') : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-trophy me-2"></i>Prestasi Terbaru
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Jenis</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPrestasi as $p)
                                <tr>
                                    <td>{{ $p->siswa->nama_lengkap ?? '-' }}</td>
                                    <td>{{ $p->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                    <td>{{ $p->tanggal_prestasi ? \Carbon\Carbon::parse($p->tanggal_prestasi)->format('d/m/Y') : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>
@endsection