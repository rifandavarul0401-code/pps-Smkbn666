<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Kelola User - Admin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #f8f9fa; }
        .stat-card { border: 1px solid #dee2e6; border-radius: 8px; transition: box-shadow 0.3s; background: white; }
        .stat-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .page-header { background: white; border-bottom: 1px solid #dee2e6; padding: 1.5rem 0; margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.75rem; font-weight: 600; color: #212529; margin: 0; }
    </style>
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
                    <div class="page-header mt-4">
                        <h1><i class="fas fa-users me-2"></i>Kelola User</h1>
                        <p class="text-muted mb-0">Daftar semua user dan kelola level akses</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="card stat-card">
                        <div class="card-header bg-light">
                            <i class="fas fa-table me-1"></i> Daftar User (Total: {{ $users->count() }})
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Level</th>
                                            <th>Status</th>
                                            <th>Terdaftar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $user->username }}</strong></td>
                                            <td>{{ $user->nama_lengkap }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.users.updateLevel', $user->user_id) }}" class="d-inline">
                                                    @csrf
                                                    <select name="level" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                                        <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="kesiswaan" {{ $user->level == 'kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
                                                        <option value="guru" {{ $user->level == 'guru' ? 'selected' : '' }}>Guru</option>
                                                        <option value="kepsek" {{ $user->level == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
                                                        <option value="bk" {{ $user->level == 'bk' ? 'selected' : '' }}>BK</option>
                                                        <option value="wali_kelas" {{ $user->level == 'wali_kelas' ? 'selected' : '' }}>Wali Kelas</option>
                                                        <option value="siswa" {{ $user->level == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                                        <option value="ortu" {{ $user->level == 'ortu' ? 'selected' : '' }}>Orang Tua</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                @if($user->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('d M Y') }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.users.toggleStatus', $user->user_id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $user->is_active ? 'danger' : 'success' }}">
                                                        <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
                                                        {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
</body>
</html>
