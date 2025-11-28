<nav class="sb-sidenav accordion sb-sidenav-dark">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{ route('kesiswaan.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            
            <!-- Input & Verifikasi Pelanggaran -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePelanggaran">
                <i class="fas fa-exclamation-triangle"></i> Pelanggaran
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePelanggaran">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('kesiswaan.pelanggaran.create') }}">
                        <i class="fas fa-plus"></i> Input Pelanggaran
                    </a>
                </nav>
            </div>
            
            <!-- Input & Verifikasi Prestasi -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePrestasi">
                <i class="fas fa-trophy"></i> Prestasi
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePrestasi">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('kesiswaan.prestasi.create') }}">
                        <i class="fas fa-plus"></i> Input Prestasi
                    </a>
                </nav>
            </div>
            
            <!-- Verifikasi Data -->
            <a class="nav-link" href="{{ route('kesiswaan.verifikasi.index') }}">
                <i class="fas fa-check-circle"></i> Verifikasi Data
            </a>
            
            <!-- Monitoring All - ✅ Full Access -->
            <a class="nav-link" href="{{ route('kesiswaan.monitoring.index') }}">
                <i class="fas fa-chart-line"></i> Monitoring Semua
            </a>
            
            <!-- View Data Sendiri - ✅ Full Access -->
            <a class="nav-link" href="{{ route('kesiswaan.data-kesiswaan') }}">
                <i class="fas fa-eye"></i> Data Kesiswaan
            </a>
            
            <!-- View Data Anak - ✅ Full Access -->
            <a class="nav-link" href="{{ route('kesiswaan.data-siswa') }}">
                <i class="fas fa-users"></i> Data Siswa
            </a>
            
            <!-- Export Laporan - ✅ Full Access -->
            <a class="nav-link" href="{{ route('kesiswaan.export-laporan') }}">
                <i class="fas fa-download"></i> Export Laporan
            </a>
        </div>
    </div>
</nav>