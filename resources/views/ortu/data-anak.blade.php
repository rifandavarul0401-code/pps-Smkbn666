<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Data Anak - Orang Tua</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    @include('ortu.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('ortu.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Anak</h1>
                    
                    @if($siswaUser)
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-child me-1"></i>
                            Informasi Siswa: {{ $siswaUser->nama_lengkap }}
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h3 class="text-primary">{{ $totalPoin }}</h3>
                                            <p class="text-muted">Total Poin</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h3 class="text-danger">{{ $pelanggaran->count() }}</h3>
                                            <p class="text-muted">Pelanggaran</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h3 class="text-success">{{ $prestasi->count() }}</h3>
                                            <p class="text-muted">Prestasi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h5>Riwayat Pelanggaran</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis Pelanggaran</th>
                                        <th>Poin</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pelanggaran as $p)
                                    <tr>
                                        <td>{{ $p->tanggal_pelanggaran->format('d M Y') }}</td>
                                        <td>{{ $p->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                        <td><span class="badge bg-danger">{{ $p->poin }}</span></td>
                                        <td><span class="badge bg-{{ $p->status == 'verified' ? 'success' : 'warning' }}">{{ ucfirst($p->status) }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada pelanggaran</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                            <h5 class="mt-4">Riwayat Prestasi</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis Prestasi</th>
                                        <th>Poin</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prestasi as $pr)
                                    <tr>
                                        <td>{{ $pr->tanggal_prestasi->format('d M Y') }}</td>
                                        <td>{{ $pr->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                        <td><span class="badge bg-success">-{{ $pr->poin }}</span></td>
                                        <td><span class="badge bg-{{ $pr->status == 'verified' ? 'success' : 'warning' }}">{{ ucfirst($pr->status) }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada prestasi</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        Data siswa tidak ditemukan
                    </div>
                    @endif
                </div>
            </main>
            
            <footer class="py-4 bg-light mt-auto border-top">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Sistem Poin Pelanggaran 2025</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>