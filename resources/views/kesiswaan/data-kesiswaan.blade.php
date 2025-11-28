<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Data Kesiswaan - Sistem Poin Pelanggaran</title>
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
                    <h1 class="mt-4"><i class="fas fa-eye me-2"></i>Data Kesiswaan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('kesiswaan.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Kesiswaan</li>
                    </ol>
                    
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-white-75 small">Total Siswa</div>
                                            <div class="text-lg fw-bold">{{ $stats['total_siswa'] }}</div>
                                        </div>
                                        <div><i class="fas fa-users fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-white-75 small">Total Kelas</div>
                                            <div class="text-lg fw-bold">{{ $stats['total_kelas'] }}</div>
                                        </div>
                                        <div><i class="fas fa-school fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-white-75 small">Total Pelanggaran</div>
                                            <div class="text-lg fw-bold">{{ $stats['total_pelanggaran'] }}</div>
                                        </div>
                                        <div><i class="fas fa-exclamation-triangle fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-white-75 small">Total Prestasi</div>
                                            <div class="text-lg fw-bold">{{ $stats['total_prestasi'] }}</div>
                                        </div>
                                        <div><i class="fas fa-trophy fa-2x"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-clock me-2"></i>Data Pending Verifikasi
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            <h3 class="text-danger">{{ $stats['pelanggaran_pending'] }}</h3>
                                            <p class="text-muted">Pelanggaran Pending</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <h3 class="text-warning">{{ $stats['prestasi_pending'] }}</h3>
                                            <p class="text-muted">Prestasi Pending</p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('kesiswaan.verifikasi.index') }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-check-circle me-1"></i>Verifikasi Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-2"></i>Ringkasan Data
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Siswa Aktif</span>
                                            <span class="fw-bold">{{ $stats['total_siswa'] }}</span>
                                        </div>
                                        <div class="progress mt-1">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Pelanggaran Terverifikasi</span>
                                            <span class="fw-bold">{{ $stats['total_pelanggaran'] - $stats['pelanggaran_pending'] }}</span>
                                        </div>
                                        <div class="progress mt-1">
                                            <div class="progress-bar bg-danger" style="width: {{ $stats['total_pelanggaran'] > 0 ? (($stats['total_pelanggaran'] - $stats['pelanggaran_pending']) / $stats['total_pelanggaran']) * 100 : 0 }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-0">
                                        <div class="d-flex justify-content-between">
                                            <span>Prestasi Terverifikasi</span>
                                            <span class="fw-bold">{{ $stats['total_prestasi'] - $stats['prestasi_pending'] }}</span>
                                        </div>
                                        <div class="progress mt-1">
                                            <div class="progress-bar bg-warning" style="width: {{ $stats['total_prestasi'] > 0 ? (($stats['total_prestasi'] - $stats['prestasi_pending']) / $stats['total_prestasi']) * 100 : 0 }}%"></div>
                                        </div>
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