<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Sanksi - Admin</title>
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
                    <h1 class="mt-4">Tambah Sanksi</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i>
                            Form Tambah Sanksi
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sanksi.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="pelanggaran_id" class="form-label">Pilih Pelanggaran Siswa <span class="text-danger">*</span></label>
                                    <small class="form-text text-muted">Pilih pelanggaran siswa yang akan diberi sanksi</small>
                                    <select class="form-select @error('pelanggaran_id') is-invalid @enderror" 
                                            id="pelanggaran_id" name="pelanggaran_id" required>
                                        <option value="">-- Pilih Pelanggaran Siswa --</option>
                                        @foreach($pelanggaran as $p)
                                            <option value="{{ $p->pelanggaran_id }}" {{ old('pelanggaran_id') == $p->pelanggaran_id ? 'selected' : '' }}>
                                                {{ $p->nama_siswa }} ({{ $p->nis }}) - {{ $p->nama_pelanggaran }} - {{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pelanggaran_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_sanksi" class="form-label">Pilih Jenis Sanksi <span class="text-danger">*</span></label>
                                    <small class="form-text text-muted">Pilih jenis sanksi yang akan diberikan kepada siswa</small>
                                    <select class="form-select @error('jenis_sanksi') is-invalid @enderror" 
                                            id="jenis_sanksi" name="jenis_sanksi" required>
                                        <option value="" disabled selected>-- Pilih Jenis Sanksi --</option>
                                        <option value="Teguran Lisan" {{ old('jenis_sanksi') == 'Teguran Lisan' ? 'selected' : '' }}>Teguran Lisan</option>
                                        <option value="Teguran Tertulis" {{ old('jenis_sanksi') == 'Teguran Tertulis' ? 'selected' : '' }}>Teguran Tertulis</option>
                                        <option value="Skorsing" {{ old('jenis_sanksi') == 'Skorsing' ? 'selected' : '' }}>Skorsing</option>
                                        <option value="Pembinaan" {{ old('jenis_sanksi') == 'Pembinaan' ? 'selected' : '' }}>Pembinaan</option>
                                        <option value="Kerja Sosial" {{ old('jenis_sanksi') == 'Kerja Sosial' ? 'selected' : '' }}>Kerja Sosial</option>
                                        <option value="Panggilan Orang Tua" {{ old('jenis_sanksi') == 'Panggilan Orang Tua' ? 'selected' : '' }}>Panggilan Orang Tua</option>
                                    </select>
                                    @error('jenis_sanksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi_sanksi" class="form-label">Deskripsi Sanksi</label>
                                    <textarea class="form-control @error('deskripsi_sanksi') is-invalid @enderror" 
                                              id="deskripsi_sanksi" name="deskripsi_sanksi" rows="3">{{ old('deskripsi_sanksi') }}</textarea>
                                    @error('deskripsi_sanksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                               id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required>
                                        @error('tanggal_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                               id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                                        @error('tanggal_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="aktif" selected>Aktif</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="dibatalkan">Dibatalkan</option>
                                    </select>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('admin.sanksi.index') }}" class="btn btn-secondary">
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
        document.addEventListener('DOMContentLoaded', function() {
            const pelanggaranSelect = document.getElementById('pelanggaran_id');
            const jenisSanksiSelect = document.getElementById('jenis_sanksi');
            
            // Tambahkan tooltip untuk membantu user
            pelanggaranSelect.setAttribute('title', 'Pilih pelanggaran siswa yang akan diberi sanksi');
            jenisSanksiSelect.setAttribute('title', 'Pilih jenis sanksi yang akan diberikan');
            
            // Event listener untuk dropdown pelanggaran
            pelanggaranSelect.addEventListener('change', function() {
                if (this.value) {
                    console.log('Pelanggaran dipilih:', this.options[this.selectedIndex].text);
                    // Auto focus ke jenis sanksi setelah memilih pelanggaran
                    jenisSanksiSelect.focus();
                }
            });
            
            // Event listener untuk dropdown jenis sanksi
            jenisSanksiSelect.addEventListener('change', function() {
                console.log('Jenis sanksi dipilih:', this.value);
            });
        });
    </script>
</body>
</html>
