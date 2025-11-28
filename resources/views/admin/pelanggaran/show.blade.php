<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Pelanggaran - Admin</title>
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
                    <h1 class="mt-4">Detail Pelanggaran</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-eye me-1"></i>
                            Informasi Pelanggaran
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Siswa:</strong></td>
                                            <td>{{ $pelanggaran->siswa->nama_lengkap ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIS:</strong></td>
                                            <td>{{ $pelanggaran->siswa->nis ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kelas:</strong></td>
                                            <td>{{ $pelanggaran->siswa->kelas->nama_kelas ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Pelanggaran:</strong></td>
                                            <td>{{ $pelanggaran->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Poin:</strong></td>
                                            <td><span class="badge bg-danger">{{ $pelanggaran->poin }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Tanggal:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($pelanggaran->tanggal)->format('d M Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($pelanggaran->status_verifikasi == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($pelanggaran->status_verifikasi == 'verified')
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Guru Pencatat:</strong></td>
                                            <td>{{ $pelanggaran->guruPencatat->nama_lengkap ?? 'Admin' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Keterangan:</strong></td>
                                            <td>{{ $pelanggaran->keterangan ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('admin.pelanggaran.index') }}" class="btn btn-secondary">Kembali</a>
                                <div>
                                    @if($pelanggaran->status_verifikasi == 'pending')
                                        <form action="{{ route('admin.pelanggaran.verify', $pelanggaran->pelanggaran_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check"></i> Verifikasi
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.pelanggaran.edit', $pelanggaran->pelanggaran_id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
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