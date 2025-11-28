<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Jenis Sanksi - Admin</title>
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
                    <h1 class="mt-4">Edit Jenis Sanksi</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i>
                            Form Edit Jenis Sanksi
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.jenis-sanksi.update', $jenisSanksi->jenis_sanksi_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="nama_sanksi" class="form-label">Nama Sanksi</label>
                                    <input type="text" class="form-control @error('nama_sanksi') is-invalid @enderror" name="nama_sanksi" value="{{ old('nama_sanksi', $jenisSanksi->nama_sanksi) }}" required>
                                    @error('nama_sanksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3">{{ old('deskripsi', $jenisSanksi->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input list="kategori-list" class="form-control @error('kategori') is-invalid @enderror" name="kategori" value="{{ old('kategori', $jenisSanksi->kategori) }}" placeholder="Ketik atau pilih kategori" required>
                                    <datalist id="kategori-list">
                                        <option value="Ringan">
                                        <option value="Sedang">
                                        <option value="Berat">
                                        <option value="Teguran Lisan">
                                        <option value="Teguran Tertulis">
                                        <option value="Skorsing">
                                        <option value="Pembinaan Khusus">
                                    </datalist>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.jenis-sanksi') }}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
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