@extends('kesiswaan.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-download me-2"></i>Export Laporan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('kesiswaan.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Export Laporan</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-2"></i>Filter Laporan
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('kesiswaan.export-laporan') }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="type" class="form-label">Jenis Laporan</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="pelanggaran" {{ request('type') == 'pelanggaran' ? 'selected' : '' }}>Pelanggaran</option>
                            <option value="prestasi" {{ request('type') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                               value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                               value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2" name="format" value="preview">
                            <i class="fas fa-eye me-1"></i>Preview
                        </button>
                        <button type="submit" class="btn btn-danger" name="format" value="pdf">
                            <i class="fas fa-file-pdf me-1"></i>Download PDF
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    @if(isset($data))
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-2"></i>Laporan {{ ucfirst($type) }}
                <span class="badge bg-primary ms-2">{{ $data->count() }} data</span>
            </div>
            <div>
                @if($type == 'pelanggaran')
                    <a href="{{ route('kesiswaan.export.pelanggaran-pdf', request()->all()) }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>Download PDF
                    </a>
                @else
                    <a href="{{ route('kesiswaan.export.prestasi-pdf', request()->all()) }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>Download PDF
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($type == 'pelanggaran')
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Poin</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->siswa->nis ?? '-' }}</td>
                                <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $item->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                <td>{{ $item->jenisPelanggaran->poin ?? 0 }}</td>
                                <td>{{ ucfirst($item->status_verifikasi) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data pelanggaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jenis Prestasi</th>
                            <th>Tingkat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>{{ $item->siswa->nis ?? '-' }}</td>
                                <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $item->jenisPrestasi->nama_prestasi ?? '-' }}</td>
                                <td>{{ $item->tingkat ?? '-' }}</td>
                                <td>{{ ucfirst($item->status_verifikasi) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data prestasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-exclamation-triangle me-2"></i>Export Laporan Pelanggaran PDF
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="flex-grow-1">Download laporan pelanggaran siswa dalam format PDF. Laporan mencakup semua data pelanggaran yang telah tercatat.</p>
                    <div class="mt-auto">
                        <a href="{{ route('kesiswaan.export.pelanggaran-pdf') }}" class="btn btn-danger w-100">
                            <i class="fas fa-file-pdf me-1"></i>Download PDF Pelanggaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-trophy me-2"></i>Export Laporan Prestasi PDF
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="flex-grow-1">Download laporan prestasi siswa dalam format PDF. Laporan mencakup semua data prestasi yang telah tercatat.</p>
                    <div class="mt-auto">
                        <a href="{{ route('kesiswaan.export.prestasi-pdf') }}" class="btn btn-success w-100">
                            <i class="fas fa-file-pdf me-1"></i>Download PDF Prestasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mt-4">
        <div class="card-body text-center">
            <i class="fas fa-filter fa-3x text-muted mb-3"></i>
            <h5>Filter Laporan dengan Periode Tertentu</h5>
            <p class="text-muted">Gunakan form filter di atas untuk menampilkan laporan dengan periode tertentu, kemudian klik Preview untuk melihat data dan Download PDF untuk mengunduh</p>
        </div>
    </div>
    @endif
</div>
@endsection