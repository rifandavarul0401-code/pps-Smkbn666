@extends('walikelas.layouts.app')

@section('title', 'Siswa Kelas Saya')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Siswa Kelas Saya</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('walikelas.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Siswa Kelas Saya</li>
    </ol>

    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users me-1"></i>
                    Kelas {{ $kelas->nama_kelas ?? 'Tidak Ada' }} - {{ $siswa->count() }} Siswa
                </div>
                <div class="card-body">
                    @if($siswa->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="siswaTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Poin Saat Ini</th>
                                        <th>Total Pelanggaran</th>
                                        <th>Total Prestasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siswa as $index => $s)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $s->nis }}</td>
                                        <td>
                                            <strong>{{ $s->nama_siswa }}</strong><br>
                                            <small class="text-muted">{{ $s->nisn }}</small>
                                        </td>
                                        <td>
                                            @if($s->jenis_kelamin == 'L')
                                                <span class="badge bg-primary">Laki-laki</span>
                                            @else
                                                <span class="badge bg-info">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $poin = $s->total_poin;
                                                $badgeClass = 'bg-success';
                                                if($poin < 50) $badgeClass = 'bg-danger';
                                                elseif($poin < 75) $badgeClass = 'bg-warning';
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $poin }} poin</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger">{{ $s->pelanggaran->count() }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $s->prestasi->count() }}</span>
                                        </td>
                                        <td>
                                            @if($s->status == 'aktif')
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailSiswaModal{{ $s->siswa_id }}">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada siswa di kelas ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Kelas -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Total Siswa</div>
                            <div class="h4">{{ $siswa->count() }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Siswa Poin Baik (≥75)</div>
                            <div class="h4">{{ $siswa->filter(function($s) { return $s->total_poin >= 75; })->count() }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-thumbs-up fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Siswa Perlu Perhatian (50-74)</div>
                            <div class="h4">{{ $siswa->filter(function($s) { return $s->total_poin >= 50 && $s->total_poin < 75; })->count() }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Siswa Bermasalah (<50)</div>
                            <div class="h4">{{ $siswa->filter(function($s) { return $s->total_poin < 50; })->count() }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Siswa -->
@foreach($siswa as $s)
<div class="modal fade" id="detailSiswaModal{{ $s->siswa_id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Siswa - {{ $s->nama_siswa }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary">Data Pribadi</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td width="40%">NIS</td><td>: {{ $s->nis }}</td></tr>
                            <tr><td>NISN</td><td>: {{ $s->nisn }}</td></tr>
                            <tr><td>Nama</td><td>: {{ $s->nama_siswa }}</td></tr>
                            <tr><td>Jenis Kelamin</td><td>: {{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                            <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $s->tempat_lahir }}, {{ $s->tanggal_lahir }}</td></tr>
                            <tr><td>Alamat</td><td>: {{ $s->alamat }}</td></tr>
                            <tr><td>No. Telepon</td><td>: {{ $s->no_telp }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">Status Poin</h6>
                        <div class="mb-3">
                            @php
                                $poin = $s->total_poin;
                                $badgeClass = 'bg-success';
                                $status = 'Baik';
                                if($poin < 50) { $badgeClass = 'bg-danger'; $status = 'Bermasalah'; }
                                elseif($poin < 75) { $badgeClass = 'bg-warning'; $status = 'Perlu Perhatian'; }
                            @endphp
                            <span class="badge {{ $badgeClass }} fs-6">{{ $poin }} poin - {{ $status }}</span>
                        </div>
                        
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border rounded p-2">
                                    <h5 class="text-danger">{{ $s->pelanggaran->count() }}</h5>
                                    <small>Total Pelanggaran</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-2">
                                    <h5 class="text-success">{{ $s->prestasi->count() }}</h5>
                                    <small>Total Prestasi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- Tab untuk Riwayat -->
                <ul class="nav nav-tabs" id="riwayatTab{{ $s->siswa_id }}" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pelanggaran-tab{{ $s->siswa_id }}" data-bs-toggle="tab" data-bs-target="#pelanggaran{{ $s->siswa_id }}" type="button" role="tab">
                            Riwayat Pelanggaran ({{ $s->pelanggaran->count() }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="prestasi-tab{{ $s->siswa_id }}" data-bs-toggle="tab" data-bs-target="#prestasi{{ $s->siswa_id }}" type="button" role="tab">
                            Riwayat Prestasi ({{ $s->prestasi->count() }})
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content mt-3" id="riwayatTabContent{{ $s->siswa_id }}">
                    <div class="tab-pane fade show active" id="pelanggaran{{ $s->siswa_id }}" role="tabpanel">
                        @if($s->pelanggaran->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Poin</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($s->pelanggaran->take(5) as $p)
                                        <tr>
                                            <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                                            <td>{{ $p->jenisPelanggaran->nama_pelanggaran }}</td>
                                            <td><span class="badge bg-danger">{{ $p->poin }}</span></td>
                                            <td>
                                                @if($p->status_verifikasi == 'verified')
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Tidak ada riwayat pelanggaran</p>
                        @endif
                    </div>
                    
                    <div class="tab-pane fade" id="prestasi{{ $s->siswa_id }}" role="tabpanel">
                        @if($s->prestasi->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jenis Prestasi</th>
                                            <th>Poin</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($s->prestasi->take(5) as $pr)
                                        <tr>
                                            <td>{{ $pr->tanggal->format('d/m/Y') }}</td>
                                            <td>{{ $pr->jenisPrestasi->nama_prestasi }}</td>
                                            <td><span class="badge bg-success">+{{ $pr->poin }}</span></td>
                                            <td>
                                                @if($pr->status_verifikasi == 'verified')
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Tidak ada riwayat prestasi</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
$(document).ready(function() {
    $('#siswaTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "order": [[ 4, "asc" ]] // Sort by poin (ascending, so lowest first)
    });
});
</script>
@endsection