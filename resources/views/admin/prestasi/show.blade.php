<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Detail Prestasi - Admin</title>
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
                    <h1 class="mt-4">Detail Prestasi</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-trophy me-1"></i>
                            Informasi Prestasi
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Siswa:</strong></td>
                                            <td>{{ $prestasi->siswa->nama_siswa ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIS:</strong></td>
                                            <td>{{ $prestasi->siswa->nis ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kelas:</strong></td>
                                            <td>{{ $prestasi->siswa->kelas->nama_kelas ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Prestasi:</strong></td>
                                            <td>{{ $prestasi->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kategori:</strong></td>
                                            <td>
                                                @if($prestasi->jenisPrestasi)
                                                    <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $prestasi->jenisPrestasi->kategori)) }}</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Tanggal Prestasi:</strong></td>
                                            <td>{{ $prestasi->tanggal_prestasi ? \Carbon\Carbon::parse($prestasi->tanggal_prestasi)->format('d M Y') : ($prestasi->created_at ? $prestasi->created_at->format('d M Y') : '-') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Poin:</strong></td>
                                            <td><span class="badge bg-success fs-6">+{{ $prestasi->poin }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($prestasi->status_verifikasi == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-success">Verified</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Guru Pencatat:</strong></td>
                                            <td>{{ $prestasi->createdBy->name ?? 'Admin' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dicatat pada:</strong></td>
                                            <td>{{ $prestasi->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6><strong>Keterangan:</strong></h6>
                                    <p class="border p-3 rounded bg-light">{{ $prestasi->keterangan ?? 'Tidak ada keterangan' }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2 mt-4">
                                <a href="{{ route('admin.prestasi.edit', $prestasi->prestasi_id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @if($prestasi->status_verifikasi == 'pending')
                                    <form action="{{ route('admin.prestasi.verify', $prestasi->prestasi_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check"></i> Verifikasi
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.prestasi.destroy', $prestasi->prestasi_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus prestasi ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
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