@extends('bk.layouts.app')

@section('title', 'Verifikasi Prestasi')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Verifikasi Prestasi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('bk.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Verifikasi Prestasi</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-medal me-1"></i>
            Prestasi Menunggu Verifikasi
        </div>
        <div class="card-body">
            @if($prestasi->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped" id="prestasiTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis Prestasi</th>
                                <th>Tingkat</th>
                                <th>Guru Pencatat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestasi as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->tanggal ? $p->tanggal->format('d/m/Y') : ($p->created_at ? $p->created_at->format('d/m/Y') : '-') }}</td>
                                <td>
                                    <strong>{{ $p->siswa->nama_siswa }}</strong><br>
                                    <small class="text-muted">{{ $p->siswa->nis }}</small>
                                </td>
                                <td>{{ $p->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $p->jenisPrestasi->nama_prestasi }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $p->tingkat ?? '-' }}</span>
                                </td>
                                <td>{{ $p->guruPencatat->nama_guru ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success me-1" onclick="verifyPrestasi({{ $p->prestasi_id }})">
                                        <i class="fas fa-check"></i> Verifikasi
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $p->prestasi_id }}">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->prestasi_id }}">
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
                    <i class="fas fa-medal fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada prestasi yang menunggu verifikasi</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Detail -->
@foreach($prestasi as $p)
<div class="modal fade" id="detailModal{{ $p->prestasi_id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Prestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Siswa:</strong> {{ $p->siswa->nama_siswa }}</p>
                        <p><strong>NIS:</strong> {{ $p->siswa->nis }}</p>
                        <p><strong>Kelas:</strong> {{ $p->siswa->kelas->nama_kelas ?? '-' }}</p>
                        <p><strong>Tanggal:</strong> {{ $p->tanggal ? $p->tanggal->format('d/m/Y') : ($p->created_at ? $p->created_at->format('d/m/Y') : '-') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jenis Prestasi:</strong> {{ $p->jenisPrestasi->nama_prestasi }}</p>
                        <p><strong>Tingkat:</strong> {{ $p->tingkat ?? '-' }}</p>
                        <p><strong>Guru Pencatat:</strong> {{ $p->guruPencatat->nama_guru ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Deskripsi:</strong></p>
                        <p>{{ $p->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        
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
<div class="modal fade" id="rejectModal{{ $p->prestasi_id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Prestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('bk.prestasi.reject', $p->prestasi_id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Anda yakin ingin menolak prestasi ini?</p>
                    <p><strong>Siswa:</strong> {{ $p->siswa->nama_siswa }}</p>
                    <p><strong>Prestasi:</strong> {{ $p->jenisPrestasi->nama_prestasi }}</p>
                    
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
    $('#prestasiTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
});

function verifyPrestasi(id) {
    if (confirm('Anda yakin ingin memverifikasi prestasi ini?')) {
        fetch(`/bk/prestasi/${id}/verify`, {
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
                alert('Gagal memverifikasi prestasi');
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