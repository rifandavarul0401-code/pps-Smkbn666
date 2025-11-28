@extends('bk.layouts.app')

@section('title', 'Monitoring Sanksi')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Monitoring Sanksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('bk.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Monitoring Sanksi</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-clipboard-check me-1"></i>
            Monitoring Pelaksanaan Sanksi
        </div>
        <div class="card-body">
            @if($sanksi->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped" id="monitoringTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis Sanksi</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sanksi as $index => $s)
                            @php
                                $today = now();
                                $mulai = \Carbon\Carbon::parse($s->tanggal_mulai);
                                $selesai = \Carbon\Carbon::parse($s->tanggal_selesai);
                                $totalHari = $mulai->diffInDays($selesai);
                                $hariLewat = $mulai->diffInDays($today);
                                $progress = $totalHari > 0 ? min(100, ($hariLewat / $totalHari) * 100) : 0;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $s->siswa->nama_siswa ?? '-' }}</strong><br>
                                    <small class="text-muted">{{ $s->siswa->nis ?? '-' }}</small>
                                </td>
                                <td>{{ $s->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $s->jenis_sanksi ?? '-' }}</td>
                                <td>
                                    <small>
                                        {{ $mulai->format('d/m/Y') }} - {{ $selesai->format('d/m/Y') }}<br>
                                        ({{ $totalHari }} hari)
                                    </small>
                                </td>
                                <td>
                                    @if($s->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($today > $selesai)
                                        <span class="badge bg-danger">Terlambat</span>
                                    @else
                                        <span class="badge bg-warning">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar 
                                            @if($progress >= 100) bg-success 
                                            @elseif($progress >= 75) bg-warning 
                                            @else bg-info @endif" 
                                            role="progressbar" style="width: {{ $progress }}%">
                                            {{ round($progress) }}%
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($s->status != 'selesai')
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#updateModal{{ $s->sanksi_id }}">
                                            <i class="fas fa-check"></i> Update
                                        </button>
                                    @else
                                        <span class="text-muted">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-clipboard-check fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada sanksi untuk dimonitor</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Update Status -->
@foreach($sanksi as $s)
<div class="modal fade" id="updateModal{{ $s->sanksi_id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Status Sanksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('bk.sanksi.update-status', $s->sanksi_id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p><strong>Siswa:</strong> {{ $s->siswa->nama_siswa ?? '-' }}</p>
                    <p><strong>Sanksi:</strong> {{ $s->jenis_sanksi ?? '-' }}</p>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="aktif" {{ $s->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="3" placeholder="Catatan pelaksanaan sanksi..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
$(document).ready(function() {
    $('#monitoringTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
});
</script>
@endsection