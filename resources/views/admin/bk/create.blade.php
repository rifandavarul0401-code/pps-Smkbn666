<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Bimbingan Konseling - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    @include('admin.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('admin.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Bimbingan Konseling</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i>
                            Form Tambah Bimbingan Konseling
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.bk.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="siswa_id" class="form-label">Siswa</label>
                                            <select class="form-select @error('siswa_id') is-invalid @enderror" 
                                                    id="siswa_id" name="siswa_id" required>
                                                <option value="">Pilih Siswa</option>
                                                @foreach($siswa as $s)
                                                    <option value="{{ $s->siswa_id }}" {{ old('siswa_id') == $s->siswa_id ? 'selected' : '' }}>
                                                        {{ $s->nis }} - {{ $s->nama_siswa }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('siswa_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="guru_konselor_id" class="form-label">Guru Konselor</label>
                                            <select class="form-select @error('guru_konselor_id') is-invalid @enderror" 
                                                    id="guru_konselor_id" name="guru_konselor_id" required>
                                                <option value="">Pilih Guru Konselor</option>
                                                @foreach($guru as $g)
                                                    <option value="{{ $g->guru_id }}" {{ old('guru_konselor_id') == $g->guru_id ? 'selected' : '' }}>
                                                        {{ $g->nama_guru }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('guru_konselor_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jenis_layanan" class="form-label">Jenis Layanan</label>
                                            <select class="form-select @error('jenis_layanan') is-invalid @enderror" 
                                                    id="jenis_layanan" name="jenis_layanan" required>
                                                <option value="">Pilih Jenis Layanan</option>
                                                <option value="konseling_individu" {{ old('jenis_layanan') == 'konseling_individu' ? 'selected' : '' }}>Konseling Individu</option>
                                                <option value="konseling_kelompok" {{ old('jenis_layanan') == 'konseling_kelompok' ? 'selected' : '' }}>Konseling Kelompok</option>
                                                <option value="bimbingan_klasikal" {{ old('jenis_layanan') == 'bimbingan_klasikal' ? 'selected' : '' }}>Bimbingan Klasikal</option>
                                                <option value="konsultasi" {{ old('jenis_layanan') == 'konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                                            </select>
                                            @error('jenis_layanan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="topik" class="form-label">Topik</label>
                                            <input type="text" class="form-control @error('topik') is-invalid @enderror" 
                                                   id="topik" name="topik" value="{{ old('topik') }}" required>
                                            @error('topik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="keluhan_masalah" class="form-label">Keluhan/Masalah</label>
                                    <textarea class="form-control @error('keluhan_masalah') is-invalid @enderror" 
                                              id="keluhan_masalah" name="keluhan_masalah" rows="3" required>{{ old('keluhan_masalah') }}</textarea>
                                    @error('keluhan_masalah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="tindakan_solusi" class="form-label">Tindakan/Solusi</label>
                                    <textarea class="form-control @error('tindakan_solusi') is-invalid @enderror" 
                                              id="tindakan_solusi" name="tindakan_solusi" rows="3" required>{{ old('tindakan_solusi') }}</textarea>
                                    @error('tindakan_solusi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select @error('status') is-invalid @enderror" 
                                                    id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="tindak_lanjut" {{ old('status') == 'tindak_lanjut' ? 'selected' : '' }}>Tindak Lanjut</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="tanggal_konseling" class="form-label">Tanggal Konseling</label>
                                            <input type="date" class="form-control @error('tanggal_konseling') is-invalid @enderror" 
                                                   id="tanggal_konseling" name="tanggal_konseling" value="{{ old('tanggal_konseling') }}" required>
                                            @error('tanggal_konseling')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="tanggal_tindak_lanjut" class="form-label">Tanggal Tindak Lanjut</label>
                                            <input type="date" class="form-control @error('tanggal_tindak_lanjut') is-invalid @enderror" 
                                                   id="tanggal_tindak_lanjut" name="tanggal_tindak_lanjut" value="{{ old('tanggal_tindak_lanjut') }}">
                                            @error('tanggal_tindak_lanjut')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="hasil_evaluasi" class="form-label">Hasil Evaluasi</label>
                                    <textarea class="form-control @error('hasil_evaluasi') is-invalid @enderror" 
                                              id="hasil_evaluasi" name="hasil_evaluasi" rows="3">{{ old('hasil_evaluasi') }}</textarea>
                                    @error('hasil_evaluasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('admin.bk.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>