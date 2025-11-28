@extends('siswa.layouts.app')

@section('title', 'Riwayat Prestasi')

@section('content')
<h1 class="mt-4">Riwayat Prestasi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Riwayat Prestasi</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-trophy me-1"></i>
        Data Riwayat Prestasi
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis Prestasi</th>
                        <th>Deskripsi</th>
                        <th>Poin</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prestasi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->nama_prestasi }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->poin }}</td>
                        <td>
                            @if($item->status_verifikasi == 'verified')
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data prestasi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>
@endpush