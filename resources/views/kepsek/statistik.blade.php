<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Statistik Sekolah - Kepala Sekolah</title>
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
                    <h1 class="mt-4">Statistik Sekolah</h1>
                    
                    <div class="row mt-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>Total Siswa</h5>
                                    <h2>{{ $stats['total_siswa'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Total Guru</h5>
                                    <h2>{{ $stats['total_guru'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5>Total Pelanggaran</h5>
                                    <h2>{{ $stats['total_pelanggaran'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5>Total Prestasi</h5>
                                    <h2>{{ $stats['total_prestasi'] }}</h2>
                                </div>
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