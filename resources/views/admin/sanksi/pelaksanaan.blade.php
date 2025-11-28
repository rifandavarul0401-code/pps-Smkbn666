<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Pelaksanaan Sanksi - Admin</title>
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
                    <h1 class="mt-4">Pelaksanaan Sanksi</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-info-circle me-1"></i>
                            Informasi Sanksi
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Siswa:</strong> {{ $sanksi->nis }} - {{ $sanksi->nama_siswa }}</p>
                                    <p><strong>Jenis Sanksi:</strong> {{ $sanksi->jenis_sanksi }}</p>
                                    <p><strong>Deskripsi:</strong> {{ $sanksi->deskripsi_sanksi ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($sanksi->tanggal_mulai)->format('d/m/Y') }}</p>
                                    <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($sanksi->tanggal_selesai)->format('d/m/Y') }}</p>
                                    <p><strong>Status:</strong> 
                                        @if($sanksi->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($sanksi->status == 'aktif')
                                            <span class="badge bg-primary">Aktif</span>
                                        @elseif($sanksi->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Catatan Pelaksanaan
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sanksi.pelaksanaan.store', $sanksi->sanksi_id) }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror" 
                                               id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan', date('Y-m-d')) }}" required>
                                        @error('tanggal_pelaksanaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                                id="status" name="status" required>
                                            <option value="terlaksana">Terlaksana</option>
                                            <option value="tidak_terlaksana">Tidak Terlaksana</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                              id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('admin.sanksi.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-list me-1"></i>
                            Riwayat Pelaksanaan
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pelaksanaan as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('d/m/Y') }}</td>
                                        <td>
                                            @if($item->status == 'terlaksana')
                                                <span class="badge bg-success">Terlaksana</span>
                                            @elseif($item->status == 'tidak_terlaksana')
                                                <span class="badge bg-danger">Tidak Terlaksana</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->catatan ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada catatan pelaksanaan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
