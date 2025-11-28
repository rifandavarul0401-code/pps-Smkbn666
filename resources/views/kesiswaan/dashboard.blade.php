<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard Kesiswaan - Sistem Poin Pelanggaran</title>
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
    @include('kesiswaan.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('kesiswaan.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="page-header mt-4">
                        <h1><i class="fas fa-graduation-cap me-2"></i>Dashboard Kesiswaan</h1>
                        <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->nama_lengkap }}</p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="stat-label mb-1">Siswa Aktif</p>
                                            <h2 class="stat-number">{{ $stats['siswa_aktif'] }}</h2>
                                        </div>
                                        <div>
                                            <i class="fas fa-users stat-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="stat-label mb-1">Perlu Verifikasi</p>
                                            <h2 class="stat-number">{{ $stats['perlu_verifikasi'] }}</h2>
                                        </div>
                                        <div>
                                            <i class="fas fa-check-circle stat-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="stat-label mb-1">Pelanggaran Bulan Ini</p>
                                            <h2 class="stat-number">{{ $stats['pelanggaran_bulan_ini'] }}</h2>
                                        </div>
                                        <div>
                                            <i class="fas fa-exclamation-triangle stat-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="stat-label mb-1">Prestasi Bulan Ini</p>
                                            <h2 class="stat-number">{{ $stats['prestasi_bulan_ini'] }}</h2>
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
                        <div class="col-lg-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-header">
                                    <i class="fas fa-tasks me-2"></i>Tugas Hari Ini
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('kesiswaan.verifikasi.index') }}" class="btn btn-warning">
                                            <i class="fas fa-check-circle me-2"></i>Verifikasi Data ({{ $stats['perlu_verifikasi'] }})
                                        </a>
                                        <a href="{{ route('kesiswaan.pelanggaran.create') }}" class="btn btn-danger">
                                            <i class="fas fa-exclamation-triangle me-2"></i>Input Pelanggaran
                                        </a>
                                        <a href="{{ route('kesiswaan.prestasi.create') }}" class="btn btn-success">
                                            <i class="fas fa-trophy me-2"></i>Input Prestasi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-2"></i>Monitoring Terbaru
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <small class="text-muted">15 menit yang lalu</small>
                                        <p class="mb-0 mt-1">Verifikasi pelanggaran Ahmad</p>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">1 jam yang lalu</small>
                                        <p class="mb-0 mt-1">Input prestasi Siti Juara 1 Olimpiade</p>
                                    </div>
                                    <div class="mb-0">
                                        <small class="text-muted">2 jam yang lalu</small>
                                        <p class="mb-0 mt-1">Monitoring data siswa kelas XII</p>
                                    </div>
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