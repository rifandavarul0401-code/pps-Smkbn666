<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu Utama</div>
            <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            
            <div class="sb-sidenav-menu-heading">Profil</div>
            <a class="nav-link {{ request()->routeIs('siswa.profil') ? 'active' : '' }}" href="{{ route('siswa.profil') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Profil Saya
            </a>
            <a class="nav-link {{ request()->routeIs('siswa.data-siswa') ? 'active' : '' }}" href="{{ route('siswa.data-siswa') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
                Data Siswa
            </a>
            
            <div class="sb-sidenav-menu-heading">Riwayat</div>
            <a class="nav-link {{ request()->routeIs('siswa.riwayat-pelanggaran') ? 'active' : '' }}" href="{{ route('siswa.riwayat-pelanggaran') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-exclamation-triangle"></i></div>
                Riwayat Pelanggaran
            </a>
            <a class="nav-link {{ request()->routeIs('siswa.riwayat-prestasi') ? 'active' : '' }}" href="{{ route('siswa.riwayat-prestasi') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-trophy"></i></div>
                Riwayat Prestasi
            </a>
            <a class="nav-link {{ request()->routeIs('siswa.riwayat-sanksi') ? 'active' : '' }}" href="{{ route('siswa.riwayat-sanksi') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-gavel"></i></div>
                Riwayat Sanksi
            </a>
            
            <div class="sb-sidenav-menu-heading">Poin</div>
            <a class="nav-link {{ request()->routeIs('siswa.total-poin') ? 'active' : '' }}" href="{{ route('siswa.total-poin') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-calculator"></i></div>
                Total Poin Saya
            </a>
        </div>
    </div>
</nav>