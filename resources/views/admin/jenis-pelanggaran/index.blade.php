<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Jenis Pelanggaran - Admin</title>
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
                    <h1 class="mt-4">Jenis Pelanggaran</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-list me-1"></i>
                            Daftar Jenis Pelanggaran
                            <a href="{{ route('admin.jenis-pelanggaran.create') }}" class="btn btn-primary btn-sm float-end">
                                <i class="fas fa-plus"></i> Tambah Jenis Pelanggaran
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-container">
                                <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Kode</th>
                                        <th width="30%">Nama Pelanggaran</th>
                                        <th width="15%">Kategori</th>
                                        <th width="10%">Poin</th>
                                        <th width="15%">Deskripsi</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jenisPelanggaran as $index => $item)
                                    <tr>
                                        <td>{{ ($jenisPelanggaran->currentPage() - 1) * $jenisPelanggaran->perPage() + $index + 1 }}</td>
                                        <td><span class="badge bg-secondary">{{ $item->kode_pelanggaran }}</span></td>
                                        <td>{{ $item->nama_pelanggaran }}</td>
                                        <td>
                                            @if($item->kategori == 'ringan')
                                                <span class="badge bg-success">Ringan</span>
                                            @elseif($item->kategori == 'sedang')
                                                <span class="badge bg-warning text-dark">Sedang</span>
                                            @else
                                                <span class="badge bg-danger">Berat</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $item->poin }}</strong></td>
                                        <td>{{ $item->deskripsi ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.jenis-pelanggaran.edit', $item->jenis_pelanggaran_id) }}" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.jenis-pelanggaran.delete', $item->jenis_pelanggaran_id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Yakin ingin menghapus jenis pelanggaran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada jenis pelanggaran</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                </table>
                            </div>
                            
                            <!-- Info dan Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted small">
                                    Menampilkan {{ $jenisPelanggaran->firstItem() ?? 0 }} - {{ $jenisPelanggaran->lastItem() ?? 0 }} 
                                    dari {{ $jenisPelanggaran->total() }} data
                                </div>
                                <div>
                                    {{ $jenisPelanggaran->links('custom.pagination') }}
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
