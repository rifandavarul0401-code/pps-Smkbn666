<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Catatan Pelanggaran Siswa - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #f8f9fa; }
        .stat-card { border: 1px solid #dee2e6; border-radius: 8px; background: white; }
        .page-header { background: white; border-bottom: 1px solid #dee2e6; padding: 1.5rem 0; margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.75rem; font-weight: 600; color: #212529; margin: 0; }
    </style>
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
                    <div class="page-header mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1><i class="fas fa-clipboard-list me-2"></i>Catatan Pelanggaran Siswa</h1>
                                <p class="text-muted mb-0">Daftar catatan pelanggaran yang dilakukan siswa</p>
                            </div>
                            <a href="{{ route('admin.pelanggaran-siswa.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Catatan
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="card stat-card">
                        <div class="card-header bg-light">
                            <i class="fas fa-table me-1"></i> Daftar Catatan Pelanggaran (Total: {{ $pelanggaran->count() }})
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Siswa</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Poin</th>
                                            <th>Status</th>
                                            <th>Bukti Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pelanggaran as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                                            <td>{{ $item->nis }} - {{ $item->nama_siswa }}</td>
                                            <td>{{ $item->jenisPelanggaran->nama_pelanggaran ?? 'N/A' }}</td>
                                            <td><span class="badge bg-danger">{{ $item->poin }} Poin</span></td>
                                            <td>
                                                @if($item->status_verifikasi == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($item->status_verifikasi == 'verified')
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->bukti_foto)
                                                    <i class="fas fa-image text-success"></i> Ada
                                                @else
                                                    <i class="fas fa-times text-muted"></i> Tidak ada
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada catatan pelanggaran</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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