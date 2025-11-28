<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu Utama</div>
            <a class="nav-link" href="{{ route('guru.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            
            <div class="sb-sidenav-menu-heading">Data Siswa</div>
            <a class="nav-link" href="{{ route('guru.daftar-siswa') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Daftar Siswa
            </a>
            
            <div class="sb-sidenav-menu-heading">Pelanggaran & Prestasi</div>
            <a class="nav-link" href="{{ route('guru.pelanggaran.create') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-exclamation-triangle"></i></div>
                Input Pelanggaran
            </a>
            <a class="nav-link" href="{{ route('guru.prestasi.create') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-trophy"></i></div>
                Input Prestasi
            </a>
            <a class="nav-link" href="{{ route('guru.riwayat-input') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                Riwayat Input
            </a>
            
            <div class="sb-sidenav-menu-heading">Laporan</div>
            <a class="nav-link" href="{{ route('guru.laporan-kelas') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                Laporan Kelas
            </a>
        </div>
    </div>
</nav>