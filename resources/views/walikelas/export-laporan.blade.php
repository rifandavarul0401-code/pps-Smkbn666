@extends('walikelas.layouts.app')

@section('title', 'Export Laporan')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Export Laporan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('walikelas.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Export Laporan</li>
    </ol>

    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4 h-100">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Laporan Pelanggaran
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="card-text flex-grow-1">
                        Export laporan pelanggaran siswa kelas {{ $kelas->nama_kelas ?? 'Tidak Ada' }} 
                        dalam format PDF. Laporan mencakup semua data pelanggaran yang telah dicatat.
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('walikelas.export.pelanggaran-pdf') }}" class="btn btn-danger w-100">
                            <i class="fas fa-file-pdf me-1"></i>
                            Download PDF Pelanggaran
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card mb-4 h-100">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-trophy me-1"></i>
                    Laporan Prestasi
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="card-text flex-grow-1">
                        Export laporan prestasi siswa kelas {{ $kelas->nama_kelas ?? 'Tidak Ada' }} 
                        dalam format PDF. Laporan mencakup semua data prestasi yang telah dicatat.
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('walikelas.export.prestasi-pdf') }}" class="btn btn-success w-100">
                            <i class="fas fa-file-pdf me-1"></i>
                            Download PDF Prestasi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card mb-4 h-100">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-chart-line me-1"></i>
                    Laporan Monitoring
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="card-text flex-grow-1">
                        Export laporan monitoring kelas {{ $kelas->nama_kelas ?? 'Tidak Ada' }} 
                        dalam format PDF. Laporan mencakup status dan perkembangan setiap siswa.
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('walikelas.export.monitoring-pdf') }}" class="btn btn-primary w-100">
                            <i class="fas fa-file-pdf me-1"></i>
                            Download PDF Monitoring
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Kelas -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Informasi Export
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Kelas yang Diampu:</h6>
                            <p class="mb-2"><strong>{{ $kelas->nama_kelas ?? 'Tidak Ada' }}</strong></p>
                            
                            <h6 class="text-primary">Wali Kelas:</h6>
                            <p class="mb-2">{{ auth()->user()->nama_lengkap }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Tanggal Export:</h6>
                            <p class="mb-2">{{ now()->format('d F Y, H:i') }} WIB</p>
                            
                            <h6 class="text-primary">Format File:</h6>
                            <p class="mb-2">PDF (Portable Document Format)</p>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Catatan:</strong> Semua laporan akan didownload dalam format PDF dan dapat langsung dicetak atau dibagikan.
                        File PDF akan berisi header sekolah, informasi kelas, dan data lengkap sesuai jenis laporan yang dipilih.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Data -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card bg-light mb-4">
                <div class="card-body text-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                    <h5 class="card-title">Data Pelanggaran</h5>
                    <p class="card-text">Siap untuk export</p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
            <div class="card bg-light mb-4">
                <div class="card-body text-center">
                    <i class="fas fa-trophy fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Data Prestasi</h5>
                    <p class="card-text">Siap untuk export</p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
            <div class="card bg-light mb-4">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Data Monitoring</h5>
                    <p class="card-text">Siap untuk export</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection