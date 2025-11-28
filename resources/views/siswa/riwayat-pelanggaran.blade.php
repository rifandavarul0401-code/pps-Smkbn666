@extends('siswa.layouts.app')

@section('title', 'Riwayat Pelanggaran')

@section('content')
<h1 class="mt-4">Riwayat Pelanggaran</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Riwayat Pelanggaran</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-exclamation-triangle me-1"></i>
        Data Riwayat Pelanggaran
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis Pelanggaran</th>
                        <th>Deskripsi</th>
                        <th>Poin</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggaran as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->nama_pelanggaran }}</td>
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
                        <td colspan="6" class="text-center">Tidak ada data pelanggaran</td>
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