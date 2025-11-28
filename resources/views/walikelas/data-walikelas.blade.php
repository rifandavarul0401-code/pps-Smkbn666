@extends('walikelas.layouts.app')

@section('title', 'Data Wali Kelas')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Wali Kelas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('walikelas.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Wali Kelas</li>
    </ol>

    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-tie me-1"></i>
                    Informasi Wali Kelas
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> {{ $guru->nama_guru ?? 'Tidak Ada' }}</p>
                            <p><strong>NIP:</strong> {{ $guru->nip ?? 'Tidak Ada' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Kelas yang Diampu:</strong> {{ $kelas->nama_kelas ?? 'Tidak Ada' }}</p>
                            <p><strong>Mata Pelajaran:</strong> {{ $guru->mata_pelajaran ?? 'Tidak Ada' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="dataTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pelanggaran-tab" data-bs-toggle="tab" data-bs-target="#pelanggaran" type="button" role="tab">
                <i class="fas fa-exclamation-triangle"></i> Data Pelanggaran ({{ $pelanggaran->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="prestasi-tab" data-bs-toggle="tab" data-bs-target="#prestasi" type="button" role="tab">
                <i class="fas fa-trophy"></i> Data Prestasi ({{ $prestasi->count() }})
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="dataTabContent">
        <!-- Pelanggaran Tab -->
        <div class="tab-pane fade show active" id="pelanggaran" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Pelanggaran yang Saya Catat
                </div>
                <div class="card-body">
                    @if($pelanggaran->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="pelanggaranTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Siswa</th>
                                        <th>Jenis Pelanggaran</th>
                                        <th>Poin</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pelanggaran as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                                        <td>
                                            <strong>{{ $p->siswa->nama_siswa }}</strong><br>
                                            <small class="text-muted">{{ $p->siswa->nis }}</small>
                                        </td>
                                        <td>{{ $p->jenisPelanggaran->nama_pelanggaran }}</td>
                                        <td>
                                            <span class="badge bg-danger">{{ $p->poin }} poin</span>
                                        </td>
                                        <td>
                                            @if($p->status_verifikasi == 'verified')
                                                <span class="badge bg-success">Terverifikasi</span>
                                            @elseif($p->status_verifikasi == 'rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->pelanggaran_id }}">
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
                            <i class="fas fa-exclamation-triangle fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data pelanggaran yang dicatat</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Prestasi Tab -->
        <div class="tab-pane fade" id="prestasi" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-trophy me-1"></i>
                    Prestasi yang Saya Catat
                </div>
                <div class="card-body">
                    @if($prestasi->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="prestasiTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Siswa</th>
                                        <th>Jenis Prestasi</th>
                                        <th>Poin</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prestasi as $index => $pr)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pr->tanggal->format('d/m/Y') }}</td>
                                        <td>
                                            <strong>{{ $pr->siswa->nama_siswa }}</strong><br>
                                            <small class="text-muted">{{ $pr->siswa->nis }}</small>
                                        </td>
                                        <td>{{ $pr->jenisPrestasi->nama_prestasi }}</td>
                                        <td>
                                            <span class="badge bg-success">+{{ $pr->poin }} poin</span>
                                        </td>
                                        <td>
                                            @if($pr->status_verifikasi == 'verified')
                                                <span class="badge bg-success">Terverifikasi</span>
                                            @elseif($pr->status_verifikasi == 'rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#prestasiDetailModal{{ $pr->prestasi_id }}">
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
                            <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data prestasi yang dicatat</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pelanggaran -->
@foreach($pelanggaran as $p)
<div class="modal fade" id="detailModal{{ $p->pelanggaran_id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pelanggaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Siswa:</strong> {{ $p->siswa->nama_siswa }}</p>
                        <p><strong>NIS:</strong> {{ $p->siswa->nis }}</p>
                        <p><strong>Tanggal:</strong> {{ $p->tanggal->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jenis Pelanggaran:</strong> {{ $p->jenisPelanggaran->nama_pelanggaran }}</p>
                        <p><strong>Poin:</strong> {{ $p->poin }}</p>
                        <p><strong>Status:</strong> 
                            @if($p->status_verifikasi == 'verified')
                                <span class="badge bg-success">Terverifikasi</span>
                            @elseif($p->status_verifikasi == 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Keterangan:</strong></p>
                        <p>{{ $p->keterangan }}</p>
                        
                        @if($p->bukti_foto)
                            <p><strong>Bukti Foto:</strong></p>
                            <img src="{{ asset('storage/' . $p->bukti_foto) }}" class="img-fluid" alt="Bukti Foto">
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
    $('#pelanggaranTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
    
    $('#prestasiTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
});
</script>
@endsection