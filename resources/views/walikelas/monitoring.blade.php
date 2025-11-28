@extends('walikelas.layouts.app')

@section('title', 'Monitoring Kelas')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Monitoring Kelas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('walikelas.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Monitoring Kelas</li>
    </ol>

    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-line me-1"></i>
                    Monitoring Kelas {{ $kelas->nama_kelas ?? 'Tidak Ada' }} - {{ now()->format('F Y') }}
                </div>
                <div class="card-body">
                    @if(count($data) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="monitoringTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Poin Saat Ini</th>
                                        <th>Total Pelanggaran</th>
                                        <th>Total Prestasi</th>
                                        <th>Pelanggaran Bulan Ini</th>
                                        <th>Prestasi Bulan Ini</th>
                                        <th>Status</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $item)
                                    @php
                                        $siswa = $item['siswa'];
                                        $poin = $item['poin_saat_ini'];
                                        $statusClass = 'bg-success';
                                        $statusText = 'Baik';
                                        $tindakan = 'Pertahankan';
                                        
                                        if($poin < 50) {
                                            $statusClass = 'bg-danger';
                                            $statusText = 'Bermasalah';
                                            $tindakan = 'Panggil Orang Tua';
                                        } elseif($poin < 75) {
                                            $statusClass = 'bg-warning';
                                            $statusText = 'Perlu Perhatian';
                                            $tindakan = 'Bimbingan Khusus';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>
                                            <strong>{{ $siswa->nama_siswa }}</strong><br>
                                            <small class="text-muted">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge {{ $statusClass }} fs-6">{{ $poin }} poin</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger">{{ $item['total_pelanggaran'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $item['total_prestasi'] }}</span>
                                        </td>
                                        <td>
                                            @if($item['pelanggaran_bulan_ini'] > 0)
                                                <span class="badge bg-danger">{{ $item['pelanggaran_bulan_ini'] }}</span>
                                            @else
                                                <span class="badge bg-secondary">0</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item['prestasi_bulan_ini'] > 0)
                                                <span class="badge bg-success">{{ $item['prestasi_bulan_ini'] }}</span>
                                            @else
                                                <span class="badge bg-secondary">0</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $tindakan }}</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data untuk monitoring</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Monitoring -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Siswa Baik (≥75 poin)</div>
                            <div class="h4">{{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] >= 75; })->count() }}</div>
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
                            <div class="small text-white-50">Perlu Perhatian (50-74 poin)</div>
                            <div class="h4">{{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] >= 50 && $item['poin_saat_ini'] < 75; })->count() }}</div>
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
                            <div class="small text-white-50">Bermasalah (<50 poin)</div>
                            <div class="h4">{{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] < 50; })->count() }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="small text-white-50">Pelanggaran Bulan Ini</div>
                            <div class="h4">{{ collect($data)->sum('pelanggaran_bulan_ini') }}</div>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Monitoring -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Distribusi Status Siswa
                </div>
                <div class="card-body">
                    <canvas id="statusChart" width="100%" height="50"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Perbandingan Pelanggaran vs Prestasi
                </div>
                <div class="card-body">
                    <canvas id="comparisonChart" width="100%" height="50"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    $('#monitoringTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "order": [[ 3, "asc" ]] // Sort by poin (ascending, so lowest first)
    });
    
    // Status Chart
    const statusData = {
        baik: {{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] >= 75; })->count() }},
        perhatian: {{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] >= 50 && $item['poin_saat_ini'] < 75; })->count() }},
        bermasalah: {{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] < 50; })->count() }}
    };
    
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Baik (≥75)', 'Perlu Perhatian (50-74)', 'Bermasalah (<50)'],
            datasets: [{
                data: [statusData.baik, statusData.perhatian, statusData.bermasalah],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
    
    // Comparison Chart
    const comparisonCtx = document.getElementById('comparisonChart').getContext('2d');
    new Chart(comparisonCtx, {
        type: 'bar',
        data: {
            labels: ['Total Pelanggaran', 'Total Prestasi', 'Pelanggaran Bulan Ini', 'Prestasi Bulan Ini'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    {{ collect($data)->sum('total_pelanggaran') }},
                    {{ collect($data)->sum('total_prestasi') }},
                    {{ collect($data)->sum('pelanggaran_bulan_ini') }},
                    {{ collect($data)->sum('prestasi_bulan_ini') }}
                ],
                backgroundColor: ['#dc3545', '#28a745', '#ff6b6b', '#51cf66']
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection