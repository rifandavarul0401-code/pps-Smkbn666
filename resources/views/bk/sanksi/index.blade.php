@extends('bk.layouts.app')

@section('title', 'Pemberian Sanksi')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pemberian Sanksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('bk.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pemberian Sanksi</li>
    </ol>

    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('bk.sanksi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Berikan Sanksi Baru
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-gavel me-1"></i>
            Daftar Sanksi yang Diberikan
        </div>
        <div class="card-body">
            @if($sanksi->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped" id="sanksiTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Pelanggaran</th>
                                <th>Jenis Sanksi</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sanksi as $index => $s)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $s->siswa->nama_siswa ?? '-' }}</strong><br>
                                    <small class="text-muted">{{ $s->siswa->nis ?? '-' }}</small>
                                </td>
                                <td>{{ $s->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $s->pelanggaran->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                <td>{{ $s->jenis_sanksi ?? '-' }}</td>
                                <td>
                                    {{ $s->tanggal_mulai ? date('d/m/Y', strtotime($s->tanggal_mulai)) : '-' }} - 
                                    {{ $s->tanggal_selesai ? date('d/m/Y', strtotime($s->tanggal_selesai)) : '-' }}
                                </td>
                                <td>
                                    @if($s->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-warning">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $s->sanksi_id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-gavel fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada sanksi yang diberikan</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Detail -->
@foreach($sanksi as $s)
<div class="modal fade" id="detailModal{{ $s->sanksi_id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Sanksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Siswa:</strong> {{ $s->siswa->nama_siswa ?? '-' }}</p>
                        <p><strong>NIS:</strong> {{ $s->siswa->nis ?? '-' }}</p>
                        <p><strong>Kelas:</strong> {{ $s->siswa->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jenis Sanksi:</strong> {{ $s->jenis_sanksi ?? '-' }}</p>
                        <p><strong>Status:</strong> 
                            @if($s->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning">Aktif</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Deskripsi Sanksi:</strong></p>
                        <p>{{ $s->deskripsi_sanksi }}</p>
                        
                        @if($s->catatan_pelaksanaan)
                            <p><strong>Catatan Pelaksanaan:</strong></p>
                            <p>{{ $s->catatan_pelaksanaan }}</p>
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
    $('#sanksiTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
});
</script>
@endsection