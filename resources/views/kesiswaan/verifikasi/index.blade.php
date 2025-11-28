<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Verifikasi Data - Kesiswaan</title>
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
                    <h1 class="mt-4">Verifikasi Data</h1>
                    
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <!-- Pelanggaran Pending -->
                    <div class="card mt-4">
                        <div class="card-header bg-warning text-white">
                            <i class="fas fa-exclamation-triangle me-2"></i>Pelanggaran Perlu Verifikasi ({{ $pelanggaranPending->count() }})
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
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pelanggaranPending as $p)
                                        <tr>
                                            <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                                            <td>{{ $p->siswa->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $p->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                            <td><span class="badge bg-danger">-{{ $p->poin }}</span></td>
                                            <td>{{ $p->keterangan }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('kesiswaan.verifikasi.pelanggaran.verify', $p->pelanggaran_id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check"></i> Verifikasi
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('kesiswaan.verifikasi.pelanggaran.reject', $p->pelanggaran_id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada pelanggaran yang perlu diverifikasi</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Prestasi Pending -->
                    <div class="card mt-4">
                        <div class="card-header bg-info text-white">
                            <i class="fas fa-trophy me-2"></i>Prestasi Perlu Verifikasi ({{ $prestasiPending->count() }})
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
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($prestasiPending as $p)
                                        <tr>
                                            <td>{{ $p->tanggal_prestasi ? \Carbon\Carbon::parse($p->tanggal_prestasi)->format('d/m/Y') : $p->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $p->siswa->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $p->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                            <td><span class="badge bg-success">+{{ $p->poin }}</span></td>
                                            <td>{{ $p->keterangan }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('kesiswaan.verifikasi.prestasi.verify', $p->prestasi_id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check"></i> Verifikasi
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('kesiswaan.verifikasi.prestasi.reject', $p->prestasi_id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada prestasi yang perlu diverifikasi</td>
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
