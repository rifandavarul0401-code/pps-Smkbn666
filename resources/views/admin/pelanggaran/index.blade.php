<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Data Pelanggaran - Admin</title>
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
                    <h1 class="mt-4">Data Pelanggaran</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Daftar Pelanggaran
                            <a href="{{ route('admin.pelanggaran.create') }}" class="btn btn-primary btn-sm float-end">
                                <i class="fas fa-plus"></i> Tambah Pelanggaran
                            </a>
                        </div>
                        <div class="card-body">
                            @if($pelanggaran->count() > 0)
                                <table id="dataPelanggaranTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">Siswa</th>
                                            <th width="25%">Jenis Pelanggaran</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="10%">Poin</th>
                                            <th width="10%">Status</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pelanggaran as $item)
                                            <tr>
                                                <td>{{ $pelanggaran->firstItem() + $loop->index }}</td>
                                                <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                                <td>{{ $item->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                                <td><span class="badge bg-danger">{{ $item->poin }}</span></td>
                                                <td>
                                                    @if($item->status_verifikasi == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($item->status_verifikasi == 'verified')
                                                        <span class="badge bg-success">Verified</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.pelanggaran.show', $item->pelanggaran_id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.pelanggaran.edit', $item->pelanggaran_id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if($item->status_verifikasi == 'pending')
                                                        <form action="{{ route('admin.pelanggaran.verify', $item->pelanggaran_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin memverifikasi pelanggaran ini?')">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm" title="Verifikasi">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.pelanggaran.destroy', $item->pelanggaran_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggaran ini? Data yang dihapus tidak dapat dikembalikan.')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted">Tidak ada data pelanggaran</p>
                                </div>
                            @endif
                            
                            @if($pelanggaran->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                <nav>
                                    {{ $pelanggaran->links('pagination::bootstrap-4', ['class' => 'pagination pagination-sm']) }}
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
            @if($pelanggaran->count() > 0)
            $('#dataPelanggaranTable').DataTable({
                "pageLength": 10,
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
                "columnDefs": [
                    { "orderable": false, "targets": [6] }
                ]
            });
            @endif
        });
    </script>
</body>
</html>