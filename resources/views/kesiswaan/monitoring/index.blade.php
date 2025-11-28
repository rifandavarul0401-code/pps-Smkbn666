<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Monitoring Semua - Kesiswaan</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    @include('kesiswaan.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('kesiswaan.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Monitoring Semua Data</h1>
                    
                    <!-- Statistics -->
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>Total Siswa</h5>
                                    <h2>{{ $stats['total_siswa'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5>Total Pelanggaran</h5>
                                    <h2>{{ $stats['total_pelanggaran'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Total Prestasi</h5>
                                    <h2>{{ $stats['total_prestasi'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5>Pending Verifikasi</h5>
                                    <h2>{{ $stats['pending_verifikasi'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Pelanggaran -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <i class="fas fa-exclamation-triangle me-2"></i>Pelanggaran Terbaru
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Siswa</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Poin</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentPelanggaran as $p)
                                        <tr>
                                            <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                                            <td>{{ $p->siswa->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $p->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                            <td><span class="badge bg-danger">-{{ $p->poin }}</span></td>
                                            <td>
                                                @if($p->status_verifikasi == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($p->status_verifikasi == 'verified')
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data pelanggaran</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Prestasi -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <i class="fas fa-trophy me-2"></i>Prestasi Terbaru
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Siswa</th>
                                            <th>Jenis Prestasi</th>
                                            <th>Poin</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentPrestasi as $p)
                                        <tr>
                                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $p->siswa->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $p->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                            <td><span class="badge bg-success">+{{ $p->poin }}</span></td>
                                            <td>
                                                @if($p->status_verifikasi == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($p->status_verifikasi == 'verified')
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data prestasi</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
