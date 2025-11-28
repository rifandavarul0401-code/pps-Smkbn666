@extends('guru.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-exclamation-triangle me-2"></i>Input Pelanggaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Input Pelanggaran</li>
    </ol>
    
    <div class="card">
        <div class="card-header">
            <i class="fas fa-plus me-2"></i>Form Input Pelanggaran
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('guru.pelanggaran.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="siswa_id" class="form-label">Siswa</label>
                        <select class="form-select" id="siswa_id" name="siswa_id" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->siswa_id }}">{{ $s->nis }} - {{ $s->nama_siswa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jenis_pelanggaran_id" class="form-label">Jenis Pelanggaran</label>
                        <select class="form-select" id="jenis_pelanggaran_id" name="jenis_pelanggaran_id" required>
                            <option value="">Pilih Jenis Pelanggaran</option>
                            @foreach($jenisPelanggaran as $jp)
                                <option value="{{ $jp->jenis_pelanggaran_id }}">{{ $jp->nama_pelanggaran }} ({{ $jp->poin }} poin)</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal Pelanggaran</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan tambahan (opsional)"></textarea>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="d-flex justify-content-between">
                    <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-danger">Simpan Pelanggaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection