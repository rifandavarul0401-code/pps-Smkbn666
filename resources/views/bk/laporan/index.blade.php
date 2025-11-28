@extends('bk.layouts.app')

@section('title', 'Laporan BK')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Laporan BK</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('bk.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan BK</li>
    </ol>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Total Pelanggaran</div>
                            <div class="h4">{{ $data['total_pelanggaran'] }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Total Prestasi</div>
                            <div class="h4">{{ $data['total_prestasi'] }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-trophy fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Total Sanksi</div>
                            <div class="h4">{{ $data['total_sanksi'] }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-gavel fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Siswa Bermasalah</div>
                            <div class="h4">{{ $data['siswa_bermasalah'] }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Bulanan -->
    <div class="row mb-4">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Laporan Bulan Ini
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border rounded p-3 mb-2">
                                <h4 class="text-danger">{{ $data['pelanggaran_bulan_ini'] }}</h4>
                                <small>Pelanggaran Bulan Ini</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3 mb-2">
                                <h4 class="text-warning">{{ $data['sanksi_aktif'] }}</h4>
                                <small>Sanksi Aktif</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-download me-1"></i>
                    Export Laporan
                </div>
                <div class="card-body">
                    <p class="mb-3">Download laporan lengkap BK dalam format PDF</p>
                    <a href="{{ route('bk.laporan.export-pdf') }}" class="btn btn-danger w-100">
                        <i class="fas fa-file-pdf me-1"></i>
                        Download Laporan PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Aktivitas -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-clipboard-list me-1"></i>
                    Ringkasan Aktivitas BK
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="text-primary">Verifikasi</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Pelanggaran diverifikasi</li>
                                <li><i class="fas fa-check text-success me-2"></i>Prestasi diverifikasi</li>
                                <li><i class="fas fa-clock text-warning me-2"></i>Menunggu verifikasi</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-primary">Sanksi & Konseling</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-gavel text-warning me-2"></i>Sanksi diberikan: {{ $data['total_sanksi'] }}</li>
                                <li><i class="fas fa-comments text-info me-2"></i>Konseling dilakukan</li>
                                <li><i class="fas fa-users text-primary me-2"></i>Siswa bermasalah: {{ $data['siswa_bermasalah'] }}</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-primary">Monitoring</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-chart-line text-success me-2"></i>Perkembangan siswa</li>
                                <li><i class="fas fa-clipboard-check text-info me-2"></i>Sanksi aktif: {{ $data['sanksi_aktif'] }}</li>
                                <li><i class="fas fa-file-alt text-primary me-2"></i>Catatan konseling</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection