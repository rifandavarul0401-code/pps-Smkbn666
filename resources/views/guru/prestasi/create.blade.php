@extends('guru.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4"><i class="fas fa-trophy me-2"></i>Input Prestasi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Input Prestasi</li>
    </ol>
    
    <div class="card">
        <div class="card-header">
            <i class="fas fa-plus me-2"></i>Form Input Prestasi
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <form method="POST" action="{{ route('guru.prestasi.store') }}">
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
                        <label for="jenis_prestasi_id" class="form-label">Jenis Prestasi</label>
                        <select class="form-select" id="jenis_prestasi_id" name="jenis_prestasi_id" required>
                            <option value="">Pilih Jenis Prestasi</option>
                            @foreach($jenisPrestasi as $jp)
                                <option value="{{ $jp->jenis_prestasi_id }}">{{ $jp->nama_prestasi }} ({{ $jp->poin }} poin)</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tingkat" class="form-label">Tingkat</label>
                        <select class="form-select" id="tingkat" name="tingkat" required>
                            <option value="">Pilih Tingkat</option>
                            <option value="Sekolah">Sekolah</option>
                            <option value="Kecamatan">Kecamatan</option>
                            <option value="Kabupaten">Kabupaten</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan tambahan (opsional)"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Prestasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection