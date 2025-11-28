<nav class="sb-sidenav accordion sb-sidenav-dark">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link {{ request()->routeIs('walikelas.dashboard') ? 'active' : '' }}" href="{{ route('walikelas.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            
            <!-- Input Pelanggaran -->
            <a class="nav-link {{ request()->routeIs('walikelas.pelanggaran.*') ? 'active' : '' }}" href="{{ route('walikelas.pelanggaran.create') }}">
                <i class="fas fa-exclamation-triangle"></i> Input Pelanggaran
            </a>
            
            <!-- View Data Sendiri -->
            <a class="nav-link {{ request()->routeIs('walikelas.data-walikelas') ? 'active' : '' }}" href="{{ route('walikelas.data-walikelas') }}">
                <i class="fas fa-eye"></i> View Data Sendiri
            </a>
            
            <!-- Data Siswa Kelas Saya -->
            <a class="nav-link {{ request()->routeIs('walikelas.siswa-kelas') ? 'active' : '' }}" href="{{ route('walikelas.siswa-kelas') }}">
                <i class="fas fa-users"></i> Data Siswa Kelas Saya
            </a>
            
            <!-- Export Laporan PDF -->
            <a class="nav-link {{ request()->routeIs('walikelas.export-laporan') ? 'active' : '' }}" href="{{ route('walikelas.export-laporan') }}">
                <i class="fas fa-download"></i> Export Laporan PDF
            </a>
        </div>
    </div>
</nav>