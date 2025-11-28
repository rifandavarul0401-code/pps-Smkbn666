<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Pelanggaran - Admin</title>
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
                    <h1 class="mt-4">Tambah Pelanggaran</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i>
                            Form Tambah Pelanggaran
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.pelanggaran.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="siswa_id" class="form-label">Siswa</label>
                                    <select class="form-select @error('siswa_id') is-invalid @enderror" name="siswa_id" required>
                                        <option value="">Pilih Siswa</option>
                                        @foreach($siswa as $s)
                                            <option value="{{ $s->siswa_id }}" {{ old('siswa_id') == $s->siswa_id ? 'selected' : '' }}>
                                                {{ $s->nama_lengkap }} - {{ $s->nis }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('siswa_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="jenis_pelanggaran_id" class="form-label">Jenis Pelanggaran</label>
                                    <select class="form-select @error('jenis_pelanggaran_id') is-invalid @enderror" name="jenis_pelanggaran_id" required>
                                        <option value="">Pilih Jenis Pelanggaran</option>
                                        @foreach($jenisPelanggaran as $jp)
                                            <option value="{{ $jp->jenis_pelanggaran_id }}" {{ old('jenis_pelanggaran_id') == $jp->jenis_pelanggaran_id ? 'selected' : '' }}>
                                                {{ $jp->nama_pelanggaran }} ({{ $jp->poin }} poin)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_pelanggaran_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pelanggaran</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.pelanggaran.index') }}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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