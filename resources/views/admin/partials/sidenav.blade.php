<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu Utama</div>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            
            <div class="sb-sidenav-menu-heading">Manajemen Data</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Pengguna
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseUsers">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.siswa.index') }}">Data Siswa</a>
                    <a class="nav-link" href="{{ route('admin.guru.index') }}">Data Guru</a>
                    <a class="nav-link" href="{{ route('admin.kesiswaan.index') }}">Data Kesiswaan</a>
                    <!-- <a class="nav-link" href="{{ route('admin.bk.index') }}">Data BK</a> -->
                    <a class="nav-link" href="{{ route('admin.users') }}">Manajemen User</a>
                </nav>
            </div>
            
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSystem">
                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                Sistem
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseSystem">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.jenis-pelanggaran') }}">Jenis Pelanggaran</a>
                    <a class="nav-link" href="{{ route('admin.prestasi.jenis-prestasi.index') }}">Jenis Prestasi</a>
                    <a class="nav-link" href="{{ route('admin.jenis-sanksi') }}">Jenis Sanksi</a>
                </nav>
            </div>
            
            <div class="sb-sidenav-menu-heading">Data Siswa</div>
            <a class="nav-link" href="{{ route('admin.pelanggaran.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-exclamation-triangle"></i></div>
                Data Pelanggaran
            </a>
            <a class="nav-link" href="{{ route('admin.prestasi.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-trophy"></i></div>
                Data Prestasi
            </a>
            <a class="nav-link" href="{{ route('admin.sanksi.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-gavel"></i></div>
                Data Sanksi
            </a>
            <a class="nav-link" href="{{ route('admin.poin-siswa.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                Poin Siswa
            </a>
            
            <div class="sb-sidenav-menu-heading">Laporan</div>
            <a class="nav-link" href="{{ route('admin.laporan.pelanggaran') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Laporan Pelanggaran
            </a>
            <a class="nav-link" href="{{ route('admin.laporan.prestasi') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                Laporan Prestasi
            </a>
        </div>
    </div>
</nav>