<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu Utama</div>
            <a class="nav-link {{ request()->routeIs('bk.dashboard') ? 'active' : '' }}" href="{{ route('bk.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            
            <!-- <div class="sb-sidenav-menu-heading">Verifikasi</div> -->
            
            <div class="sb-sidenav-menu-heading">Sanksi</div>
            <a class="nav-link {{ request()->routeIs('bk.sanksi*') ? 'active' : '' }}" href="{{ route('bk.sanksi') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-gavel"></i></div>
                Pemberian Sanksi
            </a>
            <!-- <a class="nav-link {{ request()->routeIs('bk.sanksi.monitoring') ? 'active' : '' }}" href="{{ route('bk.sanksi.monitoring') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>
                Monitoring Sanksi
            </a> -->
            
            <div class="sb-sidenav-menu-heading">Konseling</div>
            <a class="nav-link {{ request()->routeIs('bk.konseling') ? 'active' : '' }}" href="{{ route('bk.konseling') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                Jadwal Konseling
            </a>
            
            <div class="sb-sidenav-menu-heading">Laporan</div>
            <a class="nav-link {{ request()->routeIs('bk.laporan*') ? 'active' : '' }}" href="{{ route('bk.laporan') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                Laporan BK
            </a>
        </div>
    </div>
</nav>