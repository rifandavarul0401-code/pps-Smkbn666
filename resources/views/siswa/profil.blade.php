@extends('siswa.layouts.app')

@section('title', 'Profil Saya')

@section('content')
<h1 class="mt-4">Profil Saya</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profil Saya</li>
</ol>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                Informasi Profil
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4"><strong>NIS:</strong></div>
                    <div class="col-md-8">{{ $siswa->nis }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>NISN:</strong></div>
                    <div class="col-md-8">{{ $siswa->nisn }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Nama Lengkap:</strong></div>
                    <div class="col-md-8">{{ $siswa->nama_siswa }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Jenis Kelamin:</strong></div>
                    <div class="col-md-8">{{ $siswa->jenis_kelamin }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Tanggal Lahir:</strong></div>
                    <div class="col-md-8">{{ $siswa->tanggal_lahir }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Tempat Lahir:</strong></div>
                    <div class="col-md-8">{{ $siswa->tempat_lahir }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Alamat:</strong></div>
                    <div class="col-md-8">{{ $siswa->alamat }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>No. Telepon:</strong></div>
                    <div class="col-md-8">{{ $siswa->no_telp }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Kelas:</strong></div>
                    <div class="col-md-8">{{ $siswa->nama_kelas }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-image me-1"></i>
                Foto Profil
            </div>
            <div class="card-body text-center">
                @if($siswa->foto)
                    <img src="{{ asset('storage/siswa/' . $siswa->foto) }}" alt="Foto Siswa" class="img-fluid rounded" style="max-width: 200px;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-user fa-5x text-muted"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection