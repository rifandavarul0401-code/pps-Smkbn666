<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Laporan Sanksi - Kepala Sekolah</title>
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
                    <h1 class="mt-4">Laporan Sanksi</h1>
                    
                    <div class="card mt-4">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Siswa</th>
                                        <th>Jenis Sanksi</th>
                                        <th>Pelanggaran</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sanksi as $s)
                                    <tr>
                                        <td>{{ $s->pelanggaran->siswa->nama_lengkap ?? '-' }}</td>
                                        <td>{{ $s->jenis_sanksi }}</td>
                                        <td>{{ $s->pelanggaran->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                        <td>{{ $s->tanggal_mulai->format('d/m/Y') }}</td>
                                        <td>{{ $s->tanggal_selesai->format('d/m/Y') }}</td>
                                        <td>
                                            @if($s->status == 'aktif')
                                                <span class="badge bg-warning">Aktif</span>
                                            @elseif($s->status == 'selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($s->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $sanksi->links('pagination::bootstrap-5') }}
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