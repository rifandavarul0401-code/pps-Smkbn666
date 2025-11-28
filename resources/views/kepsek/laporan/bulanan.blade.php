<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Laporan Bulanan - Kepala Sekolah</title>
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
                    <h1 class="mt-4">Laporan Bulanan</h1>
                    
                    <div class="card mt-4 mb-4">
                        <div class="card-body">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Pilih Bulan</label>
                                        <input type="month" name="bulan" class="form-control" value="{{ $bulan }}">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5>Total Pelanggaran</h5>
                                    <h2>{{ $stats['pelanggaran'] }}</h2>
                                    <small>Bulan {{ date('F Y', strtotime($bulan)) }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Total Prestasi</h5>
                                    <h2>{{ $stats['prestasi'] }}</h2>
                                    <small>Bulan {{ date('F Y', strtotime($bulan)) }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5>Total Sanksi</h5>
                                    <h2>{{ $stats['sanksi'] }}</h2>
                                    <small>Bulan {{ date('F Y', strtotime($bulan)) }}</small>
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