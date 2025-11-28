@extends('guru.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-history me-2"></i>Riwayat Input</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Riwayat Input</li>
    </ol>
    
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-exclamation-triangle me-2"></i>Riwayat Pelanggaran
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Siswa</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelanggaran as $p)
                                    <tr>
                                        <td>{{ $p->tanggal }}</td>
                                        <td>{{ $p->siswa->nama_siswa ?? '-' }}</td>
                                        <td>{{ $p->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                        <td>{{ ucfirst($p->status_verifikasi) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada data</td>
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
                    <i class="fas fa-trophy me-2"></i>Riwayat Prestasi
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Siswa</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($prestasi as $p)
                                    <tr>
                                        <td>{{ $p->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $p->siswa->nama_siswa ?? '-' }}</td>
                                        <td>{{ $p->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                        <td>{{ ucfirst($p->status_verifikasi) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada data</td>
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
@endsection