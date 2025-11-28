@extends('walikelas.layouts.app')

@section('title', 'Input Pelanggaran')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Input Pelanggaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('walikelas.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Input Pelanggaran</li>
    </ol>

    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Form Input Pelanggaran - Kelas {{ $kelas->nama_kelas ?? 'Tidak Ada' }}
                </div>
                <div class="card-body">
                    <form action="{{ route('walikelas.pelanggaran.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="siswa_id" class="form-label">Pilih Siswa</label>
                                <select class="form-select @error('siswa_id') is-invalid @enderror" id="siswa_id" name="siswa_id" required>
                                    <option value="">-- Pilih Siswa --</option>
                                    @foreach($siswa as $s)
                                        <option value="{{ $s->siswa_id }}" {{ old('siswa_id') == $s->siswa_id ? 'selected' : '' }}>
                                            {{ $s->nis }} - {{ $s->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal Pelanggaran</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                       id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_pelanggaran_id" class="form-label">Jenis Pelanggaran</label>
                            <select class="form-select @error('jenis_pelanggaran_id') is-invalid @enderror" 
                                    id="jenis_pelanggaran_id" name="jenis_pelanggaran_id" required>
                                <option value="">-- Pilih Jenis Pelanggaran --</option>
                                @foreach($jenisPelanggaran as $jp)
                                    <option value="{{ $jp->jenis_pelanggaran_id }}" 
                                            data-poin="{{ $jp->poin }}"
                                            {{ old('jenis_pelanggaran_id') == $jp->jenis_pelanggaran_id ? 'selected' : '' }}>
                                        {{ $jp->nama_pelanggaran }} ({{ $jp->poin }} poin)
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_pelanggaran_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan Detail</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" name="keterangan" rows="4" 
                                      placeholder="Jelaskan detail pelanggaran yang terjadi..." required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('walikelas.dashboard') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Pelanggaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Informasi
                </div>
                <div class="card-body">
                    <h6 class="text-primary">Kelas yang Diampu:</h6>
                    <p class="mb-2"><strong>{{ $kelas->nama_kelas ?? 'Tidak Ada' }}</strong></p>
                    
                    <h6 class="text-primary mt-3">Jumlah Siswa:</h6>
                    <p class="mb-2">{{ $siswa->count() }} siswa</p>
                    
                    <h6 class="text-primary mt-3">Tahun Ajaran:</h6>
                    <p class="mb-0">{{ $tahunAjaran->tahun_ajaran ?? 'Tidak Ada' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('jenis_pelanggaran_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const poin = selectedOption.getAttribute('data-poin');
    
    if (poin) {
        // Bisa ditambahkan notifikasi poin jika diperlukan
        console.log('Poin pelanggaran:', poin);
    }
});
</script>
@endsection