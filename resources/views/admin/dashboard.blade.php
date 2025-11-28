<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .stat-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            transition: box-shadow 0.3s;
            background: white;
        }
        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .stat-card .card-body {
            padding: 1.5rem;
        }
        .stat-icon {
            font-size: 2.5rem;
            color: #6c757d;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 600;
            color: #212529;
            margin: 0.5rem 0;
        }
        .stat-label {
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .page-header {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }
        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #212529;
            margin: 0;
        }
        .info-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: white;
        }
        .info-card .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #495057;
        }
        .info-row {
            padding: 0.875rem 0;
            border-bottom: 1px solid #f1f3f5;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .badge-classic {
            background: #495057;
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 4px;
            font-weight: 500;
        }
        
        /* Dropdown tahun ajaran styling */
        .dropdown-toggle {
            min-width: 200px;
        }
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
                    <!-- Page Header -->
                    <div class="page-header mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</h1>
                                <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->nama_lengkap }}</p>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownTahunAjaran" data-bs-toggle="dropdown">
                                    @if($selectedTahunAjaran)
                                        @php
                                            $selected = $tahunAjaranList->where('tahun_ajaran_id', $selectedTahunAjaran)->first();
                                        @endphp
                                        {{ $selected ? $selected->tahun_ajaran . ' - ' . ucfirst($selected->semester) : 'Semua Tahun Ajaran' }}
                                    @else
                                        Semua Tahun Ajaran
                                    @endif
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Semua Tahun Ajaran</a></li>
                                    @foreach($tahunAjaranList as $ta)
                                        <li>
                                            <a class="dropdown-item {{ $selectedTahunAjaran == $ta->tahun_ajaran_id ? 'active' : '' }}" 
                                               href="{{ route('admin.dashboard', ['tahun_ajaran_id' => $ta->tahun_ajaran_id]) }}">
                                                {{ $ta->tahun_ajaran }} - {{ ucfirst($ta->semester) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="stat-label mb-1">Total Siswa</p>
                                            <h2 class="stat-number">{{ $stats['total_siswa'] }}</h2>
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
                                            <p class="stat-label mb-1">Total Pelanggaran</p>
                                            <h2 class="stat-number">{{ $stats['total_pelanggaran'] }}</h2>
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
                                            <p class="stat-label mb-1">Total Prestasi</p>
                                            <h2 class="stat-number">{{ $stats['total_prestasi'] }}</h2>
                                        </div>
                                        <div>
                                            <i class="fas fa-trophy stat-icon"></i>
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
                                            <p class="stat-label mb-1">Pending Verifikasi</p>
                                            <h2 class="stat-number">{{ $stats['pending_verifikasi'] }}</h2>
                                        </div>
                                        <div>
                                            <i class="fas fa-clock stat-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Charts -->
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="card info-card">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-2"></i>Pelanggaran & Prestasi per Bulan
                                </div>
                                <div class="card-body">
                                    <canvas id="monthlyChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card info-card">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-2"></i>Kategori Pelanggaran
                                </div>
                                <div class="card-body">
                                    <canvas id="categoryChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Tables -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card info-card">
                                <div class="card-header">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Pelanggaran Terbaru
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="pelanggaranTable" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Siswa</th>
                                                    <th>Jenis Pelanggaran</th>
                                                    <th>Poin</th>
                                                    <th>Status</th>
                                                    <th>Tahun Ajaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($recentPelanggaran as $pelanggaran)
                                                <tr>
                                                    <td>{{ $pelanggaran->tanggal ? $pelanggaran->tanggal->format('d/m/Y') : '-' }}</td>
                                                    <td>{{ $pelanggaran->siswa->nama_lengkap ?? '-' }}</td>
                                                    <td>{{ $pelanggaran->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                                    <td><span class="badge bg-danger">{{ $pelanggaran->poin ?? 0 }}</span></td>
                                                    <td>
                                                        @if($pelanggaran->status_verifikasi == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif($pelanggaran->status_verifikasi == 'verified')
                                                            <span class="badge bg-success">Verified</span>
                                                        @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $pelanggaran->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data pelanggaran</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="card info-card">
                                <div class="card-header">
                                    <i class="fas fa-trophy me-2"></i>Prestasi Terbaru
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <th>Jenis Prestasi</th>
                                                    <th>Poin</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($recentPrestasi as $prestasi)
                                                <tr>
                                                    <td>{{ $prestasi->siswa->nama_lengkap ?? '-' }}</td>
                                                    <td>{{ $prestasi->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                                    <td><span class="badge bg-success">+{{ $prestasi->poin }}</span></td>
                                                    <td>
                                                        @if($prestasi->status_verifikasi == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif($prestasi->status_verifikasi == 'verified')
                                                            <span class="badge bg-success">Verified</span>
                                                        @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak ada data prestasi</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card info-card">
                                <div class="card-header">
                                    <i class="fas fa-gavel me-2"></i>Sanksi Aktif
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Siswa</th>
                                                    <th>Jenis Sanksi</th>
                                                    <th>Mulai</th>
                                                    <th>Selesai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($activeSanksi as $sanksi)
                                                <tr>
                                                    <td>{{ $sanksi->pelanggaran->siswa->nama_lengkap ?? '-' }}</td>
                                                    <td>{{ $sanksi->jenis_sanksi }}</td>
                                                    <td>{{ $sanksi->tanggal_mulai->format('d/m/Y') }}</td>
                                                    <td>{{ $sanksi->tanggal_selesai->format('d/m/Y') }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak ada sanksi aktif</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Dropdown tahun ajaran sudah menggunakan Bootstrap dropdown

            @if($recentPelanggaran->count() > 0)
            $('#pelanggaranTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "order": [[ 0, "desc" ]]
            });
            @endif

            // Data untuk grafik
            const pelanggaranData = @json($pelanggaranPerBulan ?? []);
            const prestasiData = @json($prestasiPerBulan ?? []);
            const kategoriData = @json($pelanggaranKategori ?? []);

            // Grafik Pelanggaran & Prestasi per Bulan
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            
            const pelanggaranByMonth = Array(12).fill(0);
            const prestasiByMonth = Array(12).fill(0);
            
            if (pelanggaranData && pelanggaranData.length > 0) {
                pelanggaranData.forEach(item => {
                    pelanggaranByMonth[item.bulan - 1] = item.total;
                });
            }
            
            if (prestasiData && prestasiData.length > 0) {
                prestasiData.forEach(item => {
                    prestasiByMonth[item.bulan - 1] = item.total;
                });
            }

            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: monthNames,
                    datasets: [{
                        label: 'Pelanggaran',
                        data: pelanggaranByMonth,
                        borderColor: 'rgb(220, 53, 69)',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'Prestasi',
                        data: prestasiByMonth,
                        borderColor: 'rgb(25, 135, 84)',
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Grafik Kategori Pelanggaran
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            let categoryLabels = [];
            let categoryValues = [];
            
            if (kategoriData && kategoriData.length > 0) {
                categoryLabels = kategoriData.map(item => {
                    switch(item.kategori) {
                        case 'ringan': return 'Ringan';
                        case 'sedang': return 'Sedang';
                        case 'berat': return 'Berat';
                        default: return item.kategori || 'Lainnya';
                    }
                });
                categoryValues = kategoriData.map(item => item.total);
            } else {
                categoryLabels = ['Tidak ada data'];
                categoryValues = [1];
            }

            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        data: categoryValues,
                        backgroundColor: [
                            'rgba(25, 135, 84, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ],
                        borderColor: [
                            'rgb(25, 135, 84)',
                            'rgb(255, 193, 7)',
                            'rgb(220, 53, 69)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
