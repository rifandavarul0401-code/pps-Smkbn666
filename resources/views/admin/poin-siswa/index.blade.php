<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Poin Siswa - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                    <h1 class="mt-4">Sistem Poin Siswa</h1>
                    <p class="text-muted">Total Poin = Poin Pelanggaran - Poin Prestasi</p>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-chart-bar me-1"></i>
                            Rekapitulasi Poin Siswa
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Poin Pelanggaran</th>
                                        <th>Poin Prestasi</th>
                                        <th>Total Poin</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($poinSiswa as $index => $item)
                                    <tr>
                                        <td>{{ ($poinSiswa->currentPage() - 1) * $poinSiswa->perPage() + $index + 1 }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td><span class="badge bg-danger">{{ $item->poinSiswa->poin_pelanggaran ?? 0 }}</span></td>
                                        <td><span class="badge bg-success">{{ $item->poinSiswa->poin_prestasi ?? 0 }}</span></td>
                                        <td>
                                            <strong class="{{ $item->total_poin < 100 ? 'text-success' : 'text-danger' }}">
                                                {{ $item->total_poin }}
                                            </strong>
                                        </td>
                                        <td>
                                            @if($item->total_poin == 100)
                                                <span class="badge bg-success">Baik</span>
                                            @elseif($item->total_poin >= 50 && $item->total_poin <= 99)
                                                <span class="badge bg-warning">Perlu Perhatian</span>
                                            @elseif($item->total_poin >= 1 && $item->total_poin <= 49)
                                                <span class="badge bg-danger">Bermasalah</span>
                                            @elseif($item->total_poin == 0)
                                                <span class="badge bg-dark">Sangat Bermasalah</span>
                                            @elseif($item->total_poin > 100)
                                                <span class="badge bg-success">Baik</span>
                                            @else
                                                <span class="badge bg-dark">Sangat Bermasalah</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.poin-siswa.detail', $item->siswa_id) }}" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-3">
                                {{ $poinSiswa->links('custom.pagination') }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Keterangan Status
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li><span class="badge bg-success">Baik</span> - Total poin ≥ 100 (Poin awal 100)</li>
                                        <li><span class="badge bg-warning">Perlu Perhatian</span> - Total poin 50-99</li>
                                        <li><span class="badge bg-danger">Bermasalah</span> - Total poin 1-49</li>
                                        <li><span class="badge bg-dark">Sangat Bermasalah</span> - Total poin ≤ 0</li>
                                    </ul>
                                    <p class="text-muted small mt-2">
                                        <strong>Catatan:</strong> Setiap siswa dimulai dengan 100 poin. Pelanggaran mengurangi poin, prestasi menambah poin.
                                    </p>
                                </div>
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
