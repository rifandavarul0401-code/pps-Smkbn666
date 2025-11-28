@extends('siswa.layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="mt-4">Dashboard Siswa</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pelanggaran</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalPelanggaran }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('siswa.riwayat-pelanggaran') }}">Lihat Detail</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Prestasi</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalPrestasi }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-trophy fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('siswa.riwayat-prestasi') }}">Lihat Detail</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Sanksi</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalSanksi }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-gavel fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('siswa.riwayat-sanksi') }}">Lihat Detail</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
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
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('siswa.total-poin') }}">Lihat Detail</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                Informasi Siswa
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
                        <p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                        <p><strong>Nama:</strong> {{ $siswa->nama_siswa }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $siswa->tanggal_lahir }}</p>
                        <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection