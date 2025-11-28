@extends('bk.layouts.app')

@section('title', 'Berikan Sanksi')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Berikan Sanksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('bk.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bk.sanksi') }}">Pemberian Sanksi</a></li>
        <li class="breadcrumb-item active">Berikan Sanksi</li>
    </ol>

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-gavel me-1"></i>
                    Form Pemberian Sanksi
                </div>
                <div class="card-body">
                    <form action="{{ route('bk.sanksi.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="pelanggaran_id" class="form-label">Pilih Pelanggaran</label>
                            <select class="form-select @error('pelanggaran_id') is-invalid @enderror" id="pelanggaran_id" name="pelanggaran_id" required>
                                <option value="">-- Pilih Pelanggaran --</option>
                                @foreach($pelanggaranBelumSanksi as $p)
                                    <option value="{{ $p->pelanggaran_id }}" {{ old('pelanggaran_id') == $p->pelanggaran_id ? 'selected' : '' }}>
                                        {{ $p->siswa->nama_siswa }} ({{ $p->siswa->nis }}) - {{ $p->jenisPelanggaran->nama_pelanggaran }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pelanggaran_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_sanksi" class="form-label">Jenis Sanksi</label>
                            <select class="form-select @error('jenis_sanksi') is-invalid @enderror" id="jenis_sanksi" name="jenis_sanksi" required>
                                <option value="">-- Pilih Jenis Sanksi --</option>
                                <option value="Teguran Lisan" {{ old('jenis_sanksi') == 'Teguran Lisan' ? 'selected' : '' }}>Teguran Lisan</option>
                                <option value="Teguran Tertulis" {{ old('jenis_sanksi') == 'Teguran Tertulis' ? 'selected' : '' }}>Teguran Tertulis</option>
                                <option value="Pembersihan Lingkungan" {{ old('jenis_sanksi') == 'Pembersihan Lingkungan' ? 'selected' : '' }}>Pembersihan Lingkungan</option>
                                <option value="Skorsing" {{ old('jenis_sanksi') == 'Skorsing' ? 'selected' : '' }}>Skorsing</option>
                                <option value="Panggilan Orang Tua" {{ old('jenis_sanksi') == 'Panggilan Orang Tua' ? 'selected' : '' }}>Panggilan Orang Tua</option>
                            </select>
                            @error('jenis_sanksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_sanksi" class="form-label">Deskripsi Sanksi</label>
                            <textarea class="form-control @error('deskripsi_sanksi') is-invalid @enderror" 
                                      id="deskripsi_sanksi" name="deskripsi_sanksi" rows="4" 
                                      placeholder="Jelaskan detail sanksi yang diberikan..." required>{{ old('deskripsi_sanksi') }}</textarea>
                            @error('deskripsi_sanksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                           id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required>
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                           id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('bk.sanksi') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Berikan Sanksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Informasi
                </div>
                <div class="card-body">
                    <h6 class="text-primary">Pelanggaran Belum Sanksi:</h6>
                    <p class="mb-2">{{ $pelanggaranBelumSanksi->count() }} pelanggaran</p>
                    
                    <h6 class="text-primary mt-3">Jenis Sanksi:</h6>
                    <ul class="small">
                        <li>Teguran Lisan</li>
                        <li>Teguran Tertulis</li>
                        <li>Pembersihan Lingkungan</li>
                        <li>Skorsing</li>
                        <li>Panggilan Orang Tua</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection