<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu Utama</div>
            <a class="nav-link" href="{{ route('kepsek.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            
            <div class="sb-sidenav-menu-heading">Monitoring</div>
            <a class="nav-link" href="{{ route('kepsek.siswa') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Data Siswa
            </a>
            <a class="nav-link" href="{{ route('kepsek.guru') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                Data Guru
            </a>
            
            <div class="sb-sidenav-menu-heading">Laporan</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                Laporan
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseReports">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('kepsek.laporan.pelanggaran') }}">Laporan Pelanggaran</a>
                    <a class="nav-link" href="{{ route('kepsek.laporan.prestasi') }}">Laporan Prestasi</a>
                    <a class="nav-link" href="{{ route('kepsek.laporan.sanksi') }}">Laporan Sanksi</a>
                    <a class="nav-link" href="{{ route('kepsek.laporan.bulanan') }}">Laporan Bulanan</a>
                </nav>
            </div>
            
            <div class="sb-sidenav-menu-heading">Persetujuan</div>
            <a class="nav-link" href="{{ route('kepsek.persetujuan.sanksi-berat') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-check-double"></i></div>
                Persetujuan Sanksi Berat
            </a>
            <a class="nav-link" href="{{ route('kepsek.persetujuan.penghargaan') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-award"></i></div>
                Persetujuan Penghargaan
            </a>
        </div>
    </div>
</nav>