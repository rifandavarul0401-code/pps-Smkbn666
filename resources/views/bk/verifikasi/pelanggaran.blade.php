@extends('bk.layouts.app')

@section('title', 'Verifikasi Pelanggaran')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Verifikasi Pelanggaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('bk.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Verifikasi Pelanggaran</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-check-circle me-1"></i>
            Pelanggaran Menunggu Verifikasi
        </div>
        <div class="card-body">
            @if($pelanggaran->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped" id="pelanggaranTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Poin</th>
                                <th>Guru Pencatat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelanggaran as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->tanggal ? $p->tanggal->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <strong>{{ $p->siswa->nama_siswa }}</strong><br>
                                    <small class="text-muted">{{ $p->siswa->nis }}</small>
                                </td>
                                <td>{{ $p->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $p->jenisPelanggaran->nama_pelanggaran }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ $p->poin }} poin</span>
                                </td>
                                <td>{{ $p->guruPencatat->nama_guru ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success me-1" onclick="verifyPelanggaran({{ $p->pelanggaran_id }})">
                                        <i class="fas fa-check"></i> Verifikasi
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $p->pelanggaran_id }}">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->pelanggaran_id }}">
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
                    <i class="fas fa-check-circle fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada pelanggaran yang menunggu verifikasi</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Detail -->
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
                        <p><strong>Kelas:</strong> {{ $p->siswa->kelas->nama_kelas ?? '-' }}</p>
                        <p><strong>Tanggal:</strong> {{ $p->tanggal ? $p->tanggal->format('d/m/Y') : '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jenis Pelanggaran:</strong> {{ $p->jenisPelanggaran->nama_pelanggaran }}</p>
                        <p><strong>Poin:</strong> {{ $p->poin }}</p>
                        <p><strong>Guru Pencatat:</strong> {{ $p->guruPencatat->nama_guru ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Keterangan:</strong></p>
                        <p>{{ $p->keterangan ?? 'Tidak ada keterangan' }}</p>
                        
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

<!-- Modal Reject -->
<div class="modal fade" id="rejectModal{{ $p->pelanggaran_id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Pelanggaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('bk.pelanggaran.reject', $p->pelanggaran_id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Anda yakin ingin menolak pelanggaran ini?</p>
                    <p><strong>Siswa:</strong> {{ $p->siswa->nama_siswa }}</p>
                    <p><strong>Pelanggaran:</strong> {{ $p->jenisPelanggaran->nama_pelanggaran }}</p>
                    
                    <div class="mb-3">
                        <label for="catatan_verifikasi" class="form-label">Alasan Penolakan</label>
                        <textarea class="form-control" name="catatan_verifikasi" rows="3" placeholder="Berikan alasan penolakan..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
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
});

function verifyPelanggaran(id) {
    if (confirm('Anda yakin ingin memverifikasi pelanggaran ini?')) {
        fetch(`/bk/pelanggaran/${id}/verify`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal memverifikasi pelanggaran');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }
}
</script>
@endsection