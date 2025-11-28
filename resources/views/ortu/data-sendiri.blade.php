<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Data Sendiri - Orang Tua</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    @include('ortu.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('ortu.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Sendiri</h1>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user me-1"></i>
                            Informasi Orang Tua
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="200"><strong>Username</strong></td>
                                    <td>: {{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Lengkap</strong></td>
                                    <td>: {{ $orangtua->nama_orangtua ?? $user->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Hubungan</strong></td>
                                    <td>: {{ $orangtua ? ucfirst($orangtua->hubungan) : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pekerjaan</strong></td>
                                    <td>: {{ $orangtua->pekerjaan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pendidikan</strong></td>
                                    <td>: {{ $orangtua->pendidikan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Telepon</strong></td>
                                    <td>: {{ $orangtua->no_telp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: {{ $orangtua->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Level</strong></td>
                                    <td>: <span class="badge bg-info">{{ strtoupper($user->level) }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>: <span class="badge bg-success">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                                </tr>
                            </table>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>