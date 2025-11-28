<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Persetujuan Sanksi Berat - Kepala Sekolah</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                    <h1 class="mt-4">Persetujuan Sanksi Berat</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="card mt-4">
                        <div class="card-header bg-danger text-white">
                            <i class="fas fa-gavel me-2"></i>Sanksi Pelanggaran Berat ({{ $sanksiPending->count() }})
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Siswa</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Sanksi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sanksiPending as $s)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($s->tanggal_mulai)->format('d/m/Y') }}</td>
                                            <td>{{ $s->pelanggaran->siswa->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $s->pelanggaran->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                            <td>{{ $s->jenis_sanksi }}</td>
                                            <td><span class="badge bg-warning">{{ ucfirst($s->status) }}</span></td>
                                            <td>
                                                <form method="POST" action="{{ route('kepsek.persetujuan.sanksi.approve', $s->sanksi_id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada sanksi berat yang perlu persetujuan</td>
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