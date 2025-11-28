<nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
    <a class="navbar-brand ps-3" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
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
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle me-2"></i>Profil Admin
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 3rem;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
                <table class="table table-borderless">
                    <tr>
                        <td width="40%"><strong>Nama Lengkap</strong></td>
                        <td>: {{ auth()->user()->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tingkat</strong></td>
                        <td>: <span class="badge bg-primary">{{ strtoupper(auth()->user()->level) }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>Illuminate\Database\QueryException
vendor\laravel\framework\src\Illuminate\Database\Connection.php:824
SQLSTATE[HY000]: General error: 1 no such table: kesiswaans (Connection: sqlite, SQL: select * from "kesiswaans" order by "created_at" desc)