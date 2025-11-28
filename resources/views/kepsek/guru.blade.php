<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Data Guru - Kepala Sekolah</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .pagination { font-size: 0.875rem; }
        .pagination .page-link { padding: 0.375rem 0.75rem; }
    </style>
</head>
<body class="sb-nav-fixed">
    @include('kepsek.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('kepsek.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Guru</h1>
                    
                    <div class="card mt-4">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Bidang Studi</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($guru as $g)
                                    <tr>
                                        <td>{{ $g->nip }}</td>
                                        <td>{{ $g->nama_guru }}</td>
                                        <td>{{ $g->bidang_studi }}</td>
                                        <td>{{ $g->email }}</td>
                                        <td><span class="badge bg-success">{{ $g->status }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $guru->links('pagination::bootstrap-5') }}
                            </div>
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