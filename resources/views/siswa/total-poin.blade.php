@extends('siswa.layouts.app')

@section('title', 'Total Poin Saya')

@section('content')
<h1 class="mt-4">Total Poin Saya</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Total Poin Saya</li>
</ol>

<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Poin Pelanggaran</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $poinPelanggaran }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Poin Prestasi</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $poinPrestasi }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-trophy fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Poin</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalPoin }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calculator fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-info-circle me-1"></i>
        Informasi Poin
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <h5><i class="fas fa-info-circle"></i> Cara Perhitungan Poin:</h5>
            <ul class="mb-0">
                <li><strong>Poin Pelanggaran:</strong> Setiap pelanggaran yang dilakukan akan menambah poin negatif</li>
                <li><strong>Poin Prestasi:</strong> Setiap prestasi yang diraih akan mengurangi poin negatif</li>
                <li><strong>Total Poin:</strong> Poin Pelanggaran - Poin Prestasi</li>
                <li><strong>Catatan:</strong> Semakin rendah total poin, semakin baik</li>
            </ul>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <h6>Status Poin:</h6>
                @if($totalPoin <= 0)
                    <span class="badge bg-success fs-6">Sangat Baik</span>
                    <p class="mt-2 text-success">Selamat! Anda memiliki catatan yang sangat baik.</p>
                @elseif($totalPoin <= 25)
                    <span class="badge bg-warning fs-6">Perlu Perhatian</span>
                    <p class="mt-2 text-warning">Anda perlu lebih berhati-hati dalam berperilaku.</p>
                @else
                    <span class="badge bg-danger fs-6">Perlu Perbaikan</span>
                    <p class="mt-2 text-danger">Anda perlu segera memperbaiki perilaku dan meningkatkan prestasi.</p>
                @endif
            </div>
            <div class="col-md-6">
                <h6>Rekomendasi:</h6>
                @if($totalPoin > 0)
                    <ul>
                        <li>Patuhi tata tertib sekolah</li>
                        <li>Aktif dalam kegiatan positif</li>
                        <li>Tingkatkan prestasi akademik dan non-akademik</li>
                        <li>Konsultasi dengan guru BK jika diperlukan</li>
                    </ul>
                @else
                    <ul>
                        <li>Pertahankan perilaku yang baik</li>
                        <li>Terus tingkatkan prestasi</li>
                        <li>Jadilah contoh bagi teman-teman</li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection