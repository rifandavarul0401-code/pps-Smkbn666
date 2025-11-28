<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Jenis Prestasi - Admin</title>
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
                    <h1 class="mt-4">Edit Jenis Prestasi</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i>
                            Form Edit Jenis Prestasi
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.prestasi.jenis-prestasi.update', $jenisPrestasi->jenis_prestasi_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="nama_prestasi" class="form-label">Nama Prestasi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_prestasi') is-invalid @enderror" 
                                           id="nama_prestasi" name="nama_prestasi" 
                                           value="{{ old('nama_prestasi', $jenisPrestasi->nama_prestasi) }}" required>
                                    @error('nama_prestasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select @error('kategori') is-invalid @enderror" 
                                            id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="akademik" {{ old('kategori', $jenisPrestasi->kategori) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                        <option value="non_akademik" {{ old('kategori', $jenisPrestasi->kategori) == 'non_akademik' ? 'selected' : '' }}>Non Akademik</option>
                                        <option value="olahraga" {{ old('kategori', $jenisPrestasi->kategori) == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                        <option value="seni" {{ old('kategori', $jenisPrestasi->kategori) == 'seni' ? 'selected' : '' }}>Seni</option>
                                        <option value="lainnya" {{ old('kategori', $jenisPrestasi->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="poin" class="form-label">Poin <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('poin') is-invalid @enderror" 
                                           id="poin" name="poin" min="1" 
                                           value="{{ old('poin', $jenisPrestasi->poin) }}" required>
                                    @error('poin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sanksi_rekomendasi" class="form-label">Keterangan</label>
                                    <textarea class="form-control @error('sanksi_rekomendasi') is-invalid @enderror" 
                                              id="sanksi_rekomendasi" name="sanksi_rekomendasi" rows="3">{{ old('sanksi_rekomendasi', $jenisPrestasi->sanksi_rekomendasi) }}</textarea>
                                    @error('sanksi_rekomendasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('admin.prestasi.jenis-prestasi.index') }}" class="btn btn-secondary">
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
                    <div class="text-muted text-center">Copyright &copy; Sistem Poin Pelanggaran 2025</div>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>