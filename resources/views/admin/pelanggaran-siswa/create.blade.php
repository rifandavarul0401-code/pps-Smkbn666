<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Pelanggaran Siswa - Admin</title>
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
                    <h1 class="mt-4">Tambah Pelanggaran Siswa</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i>
                            Form Input Pelanggaran Siswa
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.pelanggaran-siswa.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="siswa_id" class="form-label">Siswa <span class="text-danger">*</span></label>
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

                                <div class="mb-3">
                                    <label for="jenis_pelanggaran_id" class="form-label">Jenis Pelanggaran <span class="text-danger">*</span></label>
                                    <select class="form-select @error('jenis_pelanggaran_id') is-invalid @enderror" 
                                            id="jenis_pelanggaran_id" name="jenis_pelanggaran_id" required>
                                        <option value="">Pilih Jenis Pelanggaran</option>
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
                                    <label class="form-label">Poin</label>
                                    <input type="text" class="form-control" id="poin_display" readonly 
                                           placeholder="Poin akan muncul setelah memilih jenis pelanggaran">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                              id="keterangan" name="keterangan" rows="3" required>{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('admin.pelanggaran-siswa.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            
            <footer class="py-4 bg-light mt-auto border-top">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Sistem Poin Pelanggaran 2025</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        document.getElementById('jenis_pelanggaran_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const poin = selectedOption.getAttribute('data-poin');
            document.getElementById('poin_display').value = poin ? poin + ' poin' : '';
        });
    </script>
</body>
</html>
