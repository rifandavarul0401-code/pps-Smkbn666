<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Monitoring - {{ $kelas->nama_kelas }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 16px;
        }
        .header p {
            margin: 2px 0;
            font-size: 12px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section table {
            width: 100%;
        }
        .info-section td {
            padding: 3px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            font-size: 9px;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .status-baik {
            background-color: #d4edda;
        }
        .status-perhatian {
            background-color: #fff3cd;
        }
        .status-bermasalah {
            background-color: #f8d7da;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .summary-box {
            border: 1px solid #000;
            padding: 10px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SEKOLAH MENENGAH ATAS</h1>
        <h2>SMA NEGERI 1 EXAMPLE</h2>
        <p>Jl. Contoh No. 123, Kota Example, Provinsi Example</p>
        <p>Telp: (021) 12345678 | Email: info@sman1example.sch.id</p>
    </div>

    <div class="info-section">
        <h3 style="text-align: center; margin-bottom: 20px;">LAPORAN MONITORING KELAS</h3>
        
        <table style="border: none; margin-bottom: 20px;">
            <tr style="border: none;">
                <td style="border: none; width: 20%;">Kelas</td>
                <td style="border: none; width: 2%;">:</td>
                <td style="border: none; width: 28%;">{{ $kelas->nama_kelas }}</td>
                <td style="border: none; width: 20%;">Wali Kelas</td>
                <td style="border: none; width: 2%;">:</td>
                <td style="border: none; width: 28%;">{{ $guru->nama_guru }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Periode</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ now()->format('F Y') }}</td>
                <td style="border: none;">Tanggal Cetak</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ now()->format('d F Y') }}</td>
            </tr>
        </table>
    </div>

    @if(count($data) > 0)
        <table>
            <thead>
                <tr>
                    <th width="4%">No</th>
                    <th width="12%">NIS</th>
                    <th width="20%">Nama Siswa</th>
                    <th width="8%">Poin</th>
                    <th width="8%">Total Pelanggaran</th>
                    <th width="8%">Total Prestasi</th>
                    <th width="8%">Pelanggaran Bulan Ini</th>
                    <th width="8%">Prestasi Bulan Ini</th>
                    <th width="12%">Status</th>
                    <th width="12%">Rekomendasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                @php
                    $siswa = $item['siswa'];
                    $poin = $item['poin_saat_ini'];
                    $statusClass = '';
                    $statusText = 'Baik';
                    $rekomendasi = 'Pertahankan prestasi';
                    
                    if($poin < 50) {
                        $statusClass = 'status-bermasalah';
                        $statusText = 'Bermasalah';
                        $rekomendasi = 'Panggil orang tua, bimbingan khusus';
                    } elseif($poin < 75) {
                        $statusClass = 'status-perhatian';
                        $statusText = 'Perlu Perhatian';
                        $rekomendasi = 'Bimbingan dan monitoring';
                    } else {
                        $statusClass = 'status-baik';
                    }
                @endphp
                <tr class="{{ $statusClass }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td class="text-center">{{ $poin }}</td>
                    <td class="text-center">{{ $item['total_pelanggaran'] }}</td>
                    <td class="text-center">{{ $item['total_prestasi'] }}</td>
                    <td class="text-center">{{ $item['pelanggaran_bulan_ini'] }}</td>
                    <td class="text-center">{{ $item['prestasi_bulan_ini'] }}</td>
                    <td class="text-center">{{ $statusText }}</td>
                    <td style="font-size: 8px;">{{ $rekomendasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary-box">
            <h4 style="margin-top: 0;">RINGKASAN MONITORING</h4>
            <div style="display: flex; justify-content: space-between;">
                <div style="width: 48%;">
                    <p><strong>Statistik Siswa:</strong></p>
                    <ul style="margin: 5px 0; padding-left: 20px;">
                        <li>Total Siswa: {{ count($data) }} orang</li>
                        <li>Siswa Baik (≥75 poin): {{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] >= 75; })->count() }} orang</li>
                        <li>Perlu Perhatian (50-74 poin): {{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] >= 50 && $item['poin_saat_ini'] < 75; })->count() }} orang</li>
                        <li>Bermasalah (<50 poin): {{ collect($data)->filter(function($item) { return $item['poin_saat_ini'] < 50; })->count() }} orang</li>
                    </ul>
                </div>
                <div style="width: 48%;">
                    <p><strong>Aktivitas Bulan Ini:</strong></p>
                    <ul style="margin: 5px 0; padding-left: 20px;">
                        <li>Total Pelanggaran: {{ collect($data)->sum('pelanggaran_bulan_ini') }} kasus</li>
                        <li>Total Prestasi: {{ collect($data)->sum('prestasi_bulan_ini') }} prestasi</li>
                        <li>Rata-rata Poin Kelas: {{ round(collect($data)->avg('poin_saat_ini'), 1) }} poin</li>
                    </ul>
                </div>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <h4>REKOMENDASI TINDAK LANJUT:</h4>
            <ol>
                @if(collect($data)->filter(function($item) { return $item['poin_saat_ini'] < 50; })->count() > 0)
                    <li>Segera panggil orang tua siswa dengan status bermasalah untuk konsultasi</li>
                @endif
                @if(collect($data)->filter(function($item) { return $item['poin_saat_ini'] >= 50 && $item['poin_saat_ini'] < 75; })->count() > 0)
                    <li>Berikan bimbingan khusus untuk siswa yang perlu perhatian</li>
                @endif
                <li>Lakukan monitoring rutin setiap minggu</li>
                <li>Koordinasi dengan guru mata pelajaran untuk perbaikan perilaku</li>
                <li>Berikan apresiasi kepada siswa dengan prestasi baik</li>
            </ol>
        </div>
    @else
        <div style="text-align: center; margin: 50px 0;">
            <p><em>Tidak ada data siswa untuk monitoring.</em></p>
        </div>
    @endif

    <div class="signature">
        <p>{{ now()->format('d F Y') }}</p>
        <p>Wali Kelas {{ $kelas->nama_kelas }}</p>
        <br><br><br>
        <p><strong>{{ $guru->nama_guru }}</strong></p>
        <p>NIP. {{ $guru->nip }}</p>
    </div>
</body>
</html>