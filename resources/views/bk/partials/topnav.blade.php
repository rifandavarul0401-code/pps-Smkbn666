<nav class="sb-topnav navbar navbar-expand navbar-dark bg-warning">
    <a class="navbar-brand ps-3" href="{{ route('bk.dashboard') }}">Dashboard BK</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-user me-1"></i>{{ auth()->user()->nama_lengkap }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                        <i class="fas fa-user me-2"></i>Profil
                    </a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Modal Profile -->
<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle me-2"></i>Profil BK
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="bg-warning text-dark rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 3rem;">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <table class="table table-borderless">
                    <tr>
                        <td width="40%"><strong>Nama Lengkap</strong></td>
                        <td>: {{ auth()->user()->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tingkat</strong></td>
                        <td>: <span class="badge bg-warning text-dark">{{ strtoupper(auth()->user()->level) }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>