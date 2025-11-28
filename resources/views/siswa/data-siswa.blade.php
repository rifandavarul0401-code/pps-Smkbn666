@extends('siswa.layouts.app')

@section('title', 'Data Siswa')

@section('content')
<h1 class="mt-4">Data Siswa</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Siswa</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-id-card me-1"></i>
        Data Lengkap Siswa
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td width="200"><strong>NIS</strong></td>
                    <td>{{ $siswa->nis }}</td>
                </tr>
                <tr>
                    <td><strong>NISN</strong></td>
                    <td>{{ $siswa->nisn }}</td>
                </tr>
                <tr>
                    <td><strong>Nama Lengkap</strong></td>
                    <td>{{ $siswa->nama_siswa }}</td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin</strong></td>
                    <td>{{ $siswa->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Lahir</strong></td>
                    <td>{{ $siswa->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td><strong>Tempat Lahir</strong></td>
                    <td>{{ $siswa->tempat_lahir }}</td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>{{ $siswa->alamat }}</td>
                </tr>
                <tr>
                    <td><strong>No. Telepon</strong></td>
                    <td>{{ $siswa->no_telp }}</td>
                </tr>
                <tr>
                    <td><strong>Kelas</strong></td>
                    <td>{{ $siswa->nama_kelas }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Dibuat</strong></td>
                    <td>{{ $siswa->created_at }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection