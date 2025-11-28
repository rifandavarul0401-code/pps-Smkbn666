<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Laporan Prestasi - Kepala Sekolah</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .pagination { font-size: 0.875rem; }
        .pagination .page-link { padding: 0.375rem 0.75rem; }
    </style>
</head>
<body class="sb-nav-fixed">
    @include('kepsek.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('kepsek.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Laporan Prestasi</h1>
                    
                    <div class="card mt-4">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Siswa</th>
                                        <th>Jenis Prestasi</th>
                                        <th>Poin</th>
                                        <th>Status</th>
                                        <th>Tahun Ajaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prestasi as $p)
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
                                        <td>{{ $p->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $prestasi->links('pagination::bootstrap-5') }}
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