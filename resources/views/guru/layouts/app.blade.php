<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard Guru - Sistem Poin Pelanggaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #f8f9fa; }
        .sb-sidenav { width: 240px; position: fixed; height: 100vh; overflow-y: auto; }
        .sb-sidenav .sb-sidenav-menu-heading { font-size: 0.75rem; }
        .sb-sidenav .nav-link { padding: 0.75rem 1rem; }
        .sb-sidenav .nav-link .sb-nav-link-icon { margin-right: 0.5rem; }
        #layoutSidenav_content { margin-left: 240px; min-height: 100vh; }
        .table-responsive { overflow-x: auto; }
        main { padding: 1rem; }
        .container-fluid { max-width: 100%; }
    </style>
</head>
<body class="sb-nav-fixed">
    @include('guru.partials.topnav')
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('guru.partials.sidenav')
        </div>
        
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
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