<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Jenis Prestasi - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .table-container {
            max-height: 600px;
            overflow-y: auto;
        }
        .pagination {
            margin: 0;
        }
        .pagination .page-link {
            color: #0d6efd;
            border: 1px solid #dee2e6;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .table th {
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
            z-index: 10;
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
                    <h1 class="mt-4">Jenis Prestasi</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-trophy me-1"></i>
                            Daftar Jenis Prestasi
                            <a href="{{ route('admin.prestasi.jenis-prestasi.create') }}" class="btn btn-primary btn-sm float-end">
                                <i class="fas fa-plus"></i> Tambah Jenis Prestasi
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-container">
                                <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Prestasi</th>
                                        <th>Kategori</th>
                                        <th>Poin</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jenisPrestasi as $index => $item)
                                        <tr>
                                            <td>{{ ($jenisPrestasi->currentPage() - 1) * $jenisPrestasi->perPage() + $index + 1 }}</td>
                                            <td>{{ $item->nama_prestasi }}</td>
                                            <td>
                                                @if($item->kategori == 'akademik')
                                                    <span class="badge bg-primary">Akademik</span>
                                                @elseif($item->kategori == 'non_akademik')
                                                    <span class="badge bg-info">Non Akademik</span>
                                                @elseif($item->kategori == 'olahraga')
                                                    <span class="badge bg-success">Olahraga</span>
                                                @elseif($item->kategori == 'seni')
                                                    <span class="badge bg-warning text-dark">Seni</span>
                                                @else
                                                    <span class="badge bg-secondary">Lainnya</span>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-success">+{{ $item->poin }}</span></td>
                                            <td>{{ $item->sanksi_rekomendasi ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('admin.prestasi.jenis-prestasi.edit', $item->jenis_prestasi_id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.prestasi.jenis-prestasi.destroy', $item->jenis_prestasi_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jenis prestasi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus {{ $item->nama_prestasi }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <!-- Debug: {{ route('admin.prestasi.jenis-prestasi.destroy', $item->jenis_prestasi_id) }} -->
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data jenis prestasi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                </table>
                            </div>
                            
                            <!-- Info dan Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted small">
                                    Menampilkan {{ $jenisPrestasi->firstItem() ?? 0 }} - {{ $jenisPrestasi->lastItem() ?? 0 }} 
                                    dari {{ $jenisPrestasi->total() }} data
                                </div>
                                <div>
                                    {{ $jenisPrestasi->links('custom.pagination') }}
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