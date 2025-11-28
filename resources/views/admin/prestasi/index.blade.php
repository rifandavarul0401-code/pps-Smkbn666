<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Data Prestasi - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .pagination {
            font-size: 0.75rem !important;
        }
        .pagination .page-link {
            padding: 0.25rem 0.5rem !important;
            font-size: 0.75rem !important;
            min-width: 32px !important;
            height: 32px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .pagination .page-item {
            margin: 0 1px !important;
        }
        .pagination-sm .page-link {
            padding: 0.2rem 0.4rem !important;
            font-size: 0.7rem !important;
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
                    <h1 class="mt-4">Data Prestasi</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-trophy me-1"></i>
                            Daftar Prestasi
                            <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary btn-sm float-end">
                                <i class="fas fa-plus"></i> Tambah Prestasi
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="prestasiTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Siswa</th>
                                        <th>Jenis Prestasi</th>
                                        <th>Tanggal</th>
                                        <th>Poin</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prestasi as $item)
                                        <tr>
                                            <td>{{ $prestasi->firstItem() + $loop->index }}</td>
                                            <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                            <td>{{ $item->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                            <td>{{ $item->tanggal_prestasi ? \Carbon\Carbon::parse($item->tanggal_prestasi)->format('d M Y') : ($item->created_at ? $item->created_at->format('d M Y') : '-') }}</td>
                                            <td><span class="badge bg-success">+{{ $item->poin }}</span></td>
                                            <td>
                                                @if($item->status_verifikasi == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-success">Verified</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.prestasi.show', $item->prestasi_id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.prestasi.edit', $item->prestasi_id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($item->status_verifikasi == 'pending')
                                                    <form action="{{ route('admin.prestasi.verify', $item->prestasi_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.prestasi.destroy', $item->prestasi_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus prestasi ini? Data yang dihapus tidak dapat dikembalikan.')">
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
                                            <td colspan="7" class="text-center">Tidak ada data prestasi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                            @if($prestasi->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                <nav>
                                    {{ $prestasi->links('pagination::bootstrap-4', ['class' => 'pagination pagination-sm']) }}
                                </nav>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        $(document).ready(function() {
            @if($prestasi->count() > 0)
            $('#prestasiTable').DataTable({
                "pageLength": 20,
                "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [
                    { "orderable": false, "targets": [6] }
                ]
            });
            @endif
        });
    </script>
</body>
</html>