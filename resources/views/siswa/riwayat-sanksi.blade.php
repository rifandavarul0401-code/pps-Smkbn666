@extends('siswa.layouts.app')

@section('title', 'Riwayat Sanksi')

@section('content')
<h1 class="mt-4">Riwayat Sanksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('siswa.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Riwayat Sanksi</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-gavel me-1"></i>
        Data Riwayat Sanksi
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Sanksi</th>
                        <th>Jenis Pelanggaran</th>
                        <th>Jenis Sanksi</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sanksi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->nama_pelanggaran }}</td>
                        <td>{{ $item->jenis_sanksi }}</td>
                        <td>{{ $item->deskripsi_sanksi }}</td>
                        <td>
                            @if($item->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning">Aktif</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data sanksi</td>
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