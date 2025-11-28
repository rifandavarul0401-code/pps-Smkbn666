<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Orang Tua</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #f8f9fa; }
        .stat-card { border: 1px solid #dee2e6; border-radius: 8px; transition: box-shadow 0.3s; background: white; }
        .stat-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .page-header { background: white; border-bottom: 1px solid #dee2e6; padding: 1.5rem 0; margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.75rem; font-weight: 600; color: #212529; margin: 0; }
        .stat-icon { font-size: 2.5rem; color: #6c757d; }
        .stat-number { font-size: 2rem; font-weight: 600; color: #212529; margin: 0.5rem 0; }
        .stat-label { font-size: 0.875rem; color: #6c757d; text-transform: uppercase; letter-spacing: 0.5px; }
    </style>
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
                    <div class="page-header mt-4">
                        <h1><i class="fas fa-users me-2"></i>Dashboard Orang Tua</h1>
                        <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->nama_lengkap }}</p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-primary">
                                <h5><i class="fas fa-child me-2"></i>Monitoring: {{ $stats['nama_anak'] ?? 'Ahmad Pratama' }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="stat-label mb-1">Total Poin</p>
                                            <h2 class="stat-number">{{ $stats['total_poin'] ?? 100 }}</h2>
                                        </div>
                                        <div>
                                            <i class="fas fa-chart-bar stat-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="stat-label mb-1">Pelanggaran</p>
                                            <h2 class="stat-number text-danger">{{ $stats['total_pelanggaran'] ?? 0 }}</h2>
                                        </div>
                                        <div>
                                            <i class="fas fa-exclamation-triangle stat-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="stat-label mb-1">Prestasi</p>
                                            <h2 class="stat-number text-success">{{ $stats['total_prestasi'] ?? 0 }}</h2>
                                        </div>
                                        <div>
                                            <i class="fas fa-trophy stat-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card stat-card">
                                <div class="card-header">
                                    <i class="fas fa-history me-2"></i>Riwayat Terbaru
                                </div>
                                <div class="card-body">
                                    @if($pelanggaran->count() > 0 || $prestasi->count() > 0)
                                        <h6>Pelanggaran Terbaru:</h6>
                                        @forelse($pelanggaran as $p)
                                            <div class="mb-2">
                                                <small class="text-muted">{{ $p->tanggal_pelanggaran->format('d M Y') }}</small>
                                                <p class="mb-0 text-danger">{{ $p->jenisPelanggaran->nama_pelanggaran ?? '-' }} ({{ $p->poin }} poin)</p>
                                            </div>
                                        @empty
                                            <p class="text-muted">Tidak ada pelanggaran</p>
                                        @endforelse
                                        
                                        <hr>
                                        <h6>Prestasi Terbaru:</h6>
                                        @forelse($prestasi as $pr)
                                            <div class="mb-2">
                                                <small class="text-muted">{{ $pr->tanggal_prestasi->format('d M Y') }}</small>
                                                <p class="mb-0 text-success">{{ $pr->jenisPrestasi->nama_prestasi ?? '-' }} (-{{ $pr->poin }} poin)</p>
                                            </div>
                                        @empty
                                            <p class="text-muted">Tidak ada prestasi</p>
                                        @endforelse
                                    @else
                                        <p class="text-muted">Belum ada riwayat</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>