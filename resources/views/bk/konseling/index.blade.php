@extends('bk.layouts.app')

@section('title', 'Jadwal Konseling')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Jadwal Konseling</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('bk.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Jadwal Konseling</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-comments me-1"></i>
            Siswa yang Memerlukan Konseling
        </div>
        <div class="card-body">
            @if($siswa_bermasalah->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped" id="konselingTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Poin Saat Ini</th>
                                <th>Status</th>
                                <th>Prioritas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa_bermasalah as $index => $siswa)
                            @php
                                $poin = $siswa->poinSiswa ? $siswa->poinSiswa->total_poin : 100;
                                $prioritas = 'Rendah';
                                $badgeClass = 'bg-warning';
                                
                                if($poin < 30) {
                                    $prioritas = 'Sangat Tinggi';
                                    $badgeClass = 'bg-danger';
                                } elseif($poin < 50) {
                                    $prioritas = 'Tinggi';
                                    $badgeClass = 'bg-warning';
                                } elseif($poin < 75) {
                                    $prioritas = 'Sedang';
                                    $badgeClass = 'bg-info';
                                }
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>
                                    <strong>{{ $siswa->nama_siswa }}</strong><br>
                                    <small class="text-muted">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</small>
                                </td>
                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($poin < 30) bg-danger 
                                        @elseif($poin < 50) bg-warning 
                                        @else bg-info @endif">
                                        {{ $poin }} poin
                                    </span>
                                </td>
                                <td>
                                    @if($poin < 30)
                                        <span class="badge bg-danger">Kritis</span>
                                    @elseif($poin < 50)
                                        <span class="badge bg-warning">Bermasalah</span>
                                    @else
                                        <span class="badge bg-info">Perlu Perhatian</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $badgeClass }}">{{ $prioritas }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#jadwalModal{{ $siswa->siswa_id }}">
                                        <i class="fas fa-calendar-plus"></i> Jadwalkan
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada siswa yang memerlukan konseling saat ini</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Jadwal Konseling -->
@foreach($siswa_bermasalah as $siswa)
<div class="modal fade" id="jadwalModal{{ $siswa->siswa_id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Jadwalkan Konseling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p><strong>Siswa:</strong> {{ $siswa->nama_siswa }}</p>
                    <p><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                    <p><strong>Poin:</strong> {{ $siswa->poinSiswa ? $siswa->poinSiswa->total_poin : 100 }} poin</p>
                </div>
                
                <form>
                    <div class="mb-3">
                        <label for="tanggal_konseling" class="form-label">Tanggal Konseling</label>
                        <input type="date" class="form-control" id="tanggal_konseling" min="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="waktu_konseling" class="form-label">Waktu</label>
                        <input type="time" class="form-control" id="waktu_konseling">
                    </div>
                    
                    <div class="mb-3">
                        <label for="topik_konseling" class="form-label">Topik Konseling</label>
                        <select class="form-select" id="topik_konseling">
                            <option value="">-- Pilih Topik --</option>
                            <option value="Perilaku">Perbaikan Perilaku</option>
                            <option value="Akademik">Masalah Akademik</option>
                            <option value="Sosial">Hubungan Sosial</option>
                            <option value="Keluarga">Masalah Keluarga</option>
                            <option value="Motivasi">Motivasi Belajar</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="catatan_awal" class="form-label">Catatan Awal</label>
                        <textarea class="form-control" id="catatan_awal" rows="3" placeholder="Catatan atau persiapan untuk konseling..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="jadwalkanKonseling({{ $siswa->siswa_id }})">
                    <i class="fas fa-save"></i> Jadwalkan
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
$(document).ready(function() {
    $('#konselingTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "order": [[ 4, "asc" ]] // Sort by poin (ascending)
    });
});

function jadwalkanKonseling(siswaId) {
    // Simulasi penjadwalan
    alert('Konseling berhasil dijadwalkan untuk siswa ID: ' + siswaId);
    $('#jadwalModal' + siswaId).modal('hide');
}
</script>
@endsection