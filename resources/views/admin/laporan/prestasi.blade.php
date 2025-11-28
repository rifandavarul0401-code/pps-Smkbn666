<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Laporan Prestasi - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pagination {
            font-size: 0.875rem;
        }
        .pagination .page-link {
            padding: 0.375rem 0.75rem;
        }
    </style>
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
                    <h1 class="mt-4">Laporan Prestasi</h1>
                    
                    <!-- Filter -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Tahun Ajaran</label>
                                        <select name="tahun_ajaran_id" class="form-select">
                                            <option value="">Semua Tahun Ajaran</option>
                                            @foreach($tahunAjaranList as $ta)
                                                <option value="{{ $ta->tahun_ajaran_id }}" {{ $selectedTahunAjaran == $ta->tahun_ajaran_id ? 'selected' : '' }}>
                                                    {{ $ta->tahun_ajaran }} - {{ ucfirst($ta->semester) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="kategori" class="form-select">
                                            <option value="">Semua Kategori</option>
                                            <option value="akademik" {{ $selectedKategori == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                            <option value="non_akademik" {{ $selectedKategori == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                                            <option value="olahraga" {{ $selectedKategori == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                            <option value="seni" {{ $selectedKategori == 'seni' ? 'selected' : '' }}>Seni</option>
                                            <option value="lainnya" {{ $selectedKategori == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Pencarian</label>
                                        <input type="text" name="search" class="form-control" placeholder="Nama siswa atau jenis prestasi" value="{{ $search }}">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                                        <a href="{{ route('admin.laporan.prestasi') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Total Prestasi</h5>
                                    <h2>{{ $stats['total'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>Terverifikasi</h5>
                                    <h2>{{ $stats['verified'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5>Pending</h5>
                                    <h2>{{ $stats['pending'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-trophy me-1"></i>
                            Data Prestasi
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Siswa</th>
                                        <th>Jenis Prestasi</th>
                                        <th>Kategori</th>
                                        <th>Poin</th>
                                        <th>Status</th>
                                        <th>Tahun Ajaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prestasi as $index => $item)
                                    <tr>
                                        <td>{{ $prestasi->firstItem() + $index }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $item->siswa->nama_lengkap ?? '-' }}</td>
                                        <td>{{ $item->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                        <td><span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $item->jenisPrestasi->kategori ?? '-')) }}</span></td>
                                        <td><span class="badge bg-success">+{{ $item->poin }}</span></td>
                                        <td>
                                            @if($item->status_verifikasi == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($item->status_verifikasi == 'verified')
                                                <span class="badge bg-success">Verified</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data prestasi</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                            <div class="d-flex justify-content-center">
                                {{ $prestasi->appends(request()->query())->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
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