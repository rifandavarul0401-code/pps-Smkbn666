<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Detail Poin Siswa - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    @include('admin.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('admin.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Detail Poin Siswa</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-user me-1"></i>
                            Informasi Siswa
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                                    <p><strong>Nama:</strong> {{ $siswa->nama_siswa }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($siswa->status) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5>Poin Pelanggaran</h5>
                                    <h2>{{ $totalPelanggaran }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Poin Prestasi</h5>
                                    <h2>{{ $totalPrestasi }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card @if($totalAkhir >= 100) bg-success @elseif($totalAkhir >= 50 && $totalAkhir <= 99) bg-warning @elseif($totalAkhir >= 1 && $totalAkhir <= 49) bg-danger @else bg-dark @endif text-white">
                                <div class="card-body">
                                    <h5>Total Poin Akhir</h5>
                                    <h2>{{ $totalAkhir }}</h2>
                                    <small>100 - {{ $totalPelanggaran }} + {{ $totalPrestasi }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Riwayat Pelanggaran
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Pelanggaran</th>
                                        <th>Poin</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pelanggaran as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                        <td>{{ $item->nama_pelanggaran }}</td>
                                        <td><span class="badge bg-danger">{{ $item->poin }}</span></td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada pelanggaran</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-trophy me-1"></i>
                            Riwayat Prestasi
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Prestasi</th>
                                        <th>Poin</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prestasi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                        <td>{{ $item->nama_prestasi }}</td>
                                        <td><span class="badge bg-success">+{{ $item->poin }}</span></td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada prestasi</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <a href="{{ route('admin.poin-siswa.index') }}" class="btn btn-secondary mb-4">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </main>
            
            <footer class="py-4 bg-light mt-auto border-top">
                <div class="container-fluid px-4">
                    <div class="text-muted text-center">Copyright &copy; Sistem Poin Pelanggaran 2025</div>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
