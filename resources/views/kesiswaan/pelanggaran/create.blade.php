<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Input Pelanggaran - Kesiswaan</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    @include('kesiswaan.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('kesiswaan.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Input Pelanggaran</h1>
                    
                    <div class="card mt-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('kesiswaan.pelanggaran.store') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label">Siswa</label>
                                    <select name="siswa_id" class="form-select" required>
                                        <option value="">Pilih Siswa</option>
                                        @foreach($siswa as $s)
                                            <option value="{{ $s->siswa_id }}">{{ $s->nama_lengkap }} - {{ $s->kelas->nama_kelas ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Jenis Pelanggaran</label>
                                    <select name="jenis_pelanggaran_id" class="form-select" required>
                                        <option value="">Pilih Jenis Pelanggaran</option>
                                        @foreach($jenisPelanggaran as $jp)
                                            <option value="{{ $jp->jenis_pelanggaran_id }}">{{ $jp->nama_pelanggaran }} - {{ ucfirst($jp->kategori) }} (-{{ $jp->poin }} poin)</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kesiswaan.dashboard') }}" class="btn btn-secondary">Batal</a>
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
