<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan BK</title>
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
            font-size: 10px;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .section {
            margin-bottom: 30px;
        }
        .stats-box {
            border: 1px solid #000;
            padding: 10px;
            margin: 10px 0;
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
        <h3 style="text-align: center; margin-bottom: 20px;">LAPORAN BIMBINGAN KONSELING</h3>
        
        <table style="border: none; margin-bottom: 20px;">
            <tr style="border: none;">
                <td style="border: none; width: 20%;">Periode</td>
                <td style="border: none; width: 2%;">:</td>
                <td style="border: none; width: 28%;">{{ now()->format('F Y') }}</td>
                <td style="border: none; width: 20%;">Tanggal Cetak</td>
                <td style="border: none; width: 2%;">:</td>
                <td style="border: none; width: 28%;">{{ now()->format('d F Y') }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Dicetak Oleh</td>
                <td style="border: none;">:</td>
                <td style="border: none;">Bagian BK</td>
                <td style="border: none;">Guru BK</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ auth()->user()->nama_lengkap }}</td>
            </tr>
        </table>
    </div>

    <!-- Statistik Umum -->
    <div class="section">
        <h4>STATISTIK UMUM</h4>
        <div class="stats-box">
            <table style="border: none;">
                <tr style="border: none;">
                    <td style="border: none; width: 50%;">Total Pelanggaran Siswa</td>
                    <td style="border: none; width: 2%;">:</td>
                    <td style="border: none;">{{ $data['pelanggaran']->count() }} kasus</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none;">Total Sanksi Diberikan</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $data['sanksi']->count() }} sanksi</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none;">Siswa Bermasalah (< 50 poin)</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">{{ $data['siswa_bermasalah']->count() }} siswa</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Daftar Siswa Bermasalah -->
    <div class="section">
        <h4>DAFTAR SISWA BERMASALAH</h4>
        @if($data['siswa_bermasalah']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">NIS</th>
                        <th width="25%">Nama Siswa</th>
                        <th width="15%">Kelas</th>
                        <th width="10%">Poin</th>
                        <th width="15%">Status</th>
                        <th width="15%">Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['siswa_bermasalah'] as $index => $siswa)
                    @php
                        $poin = $siswa->poinSiswa ? $siswa->poinSiswa->total_poin : 100;
                        $status = $poin < 30 ? 'Kritis' : ($poin < 50 ? 'Bermasalah' : 'Perlu Perhatian');
                        $rekomendasi = $poin < 30 ? 'Konseling Intensif' : 'Konseling Rutin';
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $siswa->nis }}</td>
                        <td>{{ $siswa->nama_siswa }}</td>
                        <td class="text-center">{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        <td class="text-center">{{ $poin }}</td>
                        <td class="text-center">{{ $status }}</td>
                        <td class="text-center">{{ $rekomendasi }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; font-style: italic;">Tidak ada siswa bermasalah saat ini</p>
        @endif
    </div>

    <!-- Sanksi yang Diberikan -->
    <div class="section">
        <h4>SANKSI YANG DIBERIKAN</h4>
        @if($data['sanksi']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama Siswa</th>
                        <th width="15%">Kelas</th>
                        <th width="25%">Jenis Sanksi</th>
                        <th width="15%">Tanggal Mulai</th>
                        <th width="20%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['sanksi']->take(20) as $index => $sanksi)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $sanksi->siswa->nama_siswa }}</td>
                        <td class="text-center">{{ $sanksi->siswa->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $sanksi->jenis_sanksi }}</td>
                        <td class="text-center">{{ $sanksi->tanggal_mulai ? date('d/m/Y', strtotime($sanksi->tanggal_mulai)) : '-' }}</td>
                        <td class="text-center">{{ $sanksi->status_pelaksanaan == 'selesai' ? 'Selesai' : 'Berjalan' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($data['sanksi']->count() > 20)
                <p style="font-style: italic; text-align: center;">... dan {{ $data['sanksi']->count() - 20 }} sanksi lainnya</p>
            @endif
        @else
            <p style="text-align: center; font-style: italic;">Belum ada sanksi yang diberikan</p>
        @endif
    </div>

    <!-- Rekomendasi -->
    <div class="section">
        <h4>REKOMENDASI TINDAK LANJUT</h4>
        <ol>
            @if($data['siswa_bermasalah']->count() > 0)
                <li>Lakukan konseling intensif untuk {{ $data['siswa_bermasalah']->where('poinSiswa.total_poin', '<', 30)->count() }} siswa dengan status kritis</li>
                <li>Koordinasi dengan wali kelas untuk monitoring harian siswa bermasalah</li>
                <li>Panggil orang tua siswa dengan poin di bawah 30 untuk konsultasi</li>
            @endif
            <li>Evaluasi efektivitas sanksi yang telah diberikan</li>
            <li>Buat program pencegahan pelanggaran untuk semester mendatang</li>
            <li>Tingkatkan program konseling preventif</li>
        </ol>
    </div>

    <div class="signature">
        <p>{{ now()->format('d F Y') }}</p>
        <p>Guru Bimbingan Konseling</p>
        <br><br><br>
        <p><strong>{{ auth()->user()->nama_lengkap }}</strong></p>
        <p>NIP. -</p>
    </div>
</body>
</html>