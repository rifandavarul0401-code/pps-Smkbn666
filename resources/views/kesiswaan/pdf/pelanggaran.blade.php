<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pelanggaran Kesiswaan</title>
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
        <h3 style="text-align: center; margin-bottom: 20px;">LAPORAN PELANGGARAN SISWA</h3>
        
        <table style="border: none; margin-bottom: 20px;">
            <tr style="border: none;">
                <td style="border: none; width: 20%;">Periode</td>
                <td style="border: none; width: 2%;">:</td>
                <td style="border: none; width: 28%;">{{ $periode }}</td>
                <td style="border: none; width: 20%;">Tanggal Cetak</td>
                <td style="border: none; width: 2%;">:</td>
                <td style="border: none; width: 28%;">{{ now()->format('d F Y') }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Total Data</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ $data->count() }} pelanggaran</td>
                <td style="border: none;">Dicetak Oleh</td>
                <td style="border: none;">:</td>
                <td style="border: none;">Bagian Kesiswaan</td>
            </tr>
        </table>
    </div>

    @if($data->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="4%">No</th>
                    <th width="10%">Tanggal</th>
                    <th width="12%">NIS</th>
                    <th width="20%">Nama Siswa</th>
                    <th width="10%">Kelas</th>
                    <th width="25%">Jenis Pelanggaran</th>
                    <th width="8%">Poin</th>
                    <th width="11%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $item->tanggal ? $item->tanggal->format('d/m/Y') : '-' }}</td>
                    <td class="text-center">{{ $item->siswa->nis ?? '-' }}</td>
                    <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                    <td class="text-center">{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $item->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                    <td class="text-center">{{ $item->poin ?? 0 }}</td>
                    <td class="text-center">
                        @if($item->status_verifikasi == 'verified')
                            Verified
                        @elseif($item->status_verifikasi == 'rejected')
                            Rejected
                        @else
                            Pending
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <p><strong>Ringkasan:</strong></p>
            <ul>
                <li>Total Pelanggaran: {{ $data->count() }} kasus</li>
                <li>Total Poin Pelanggaran: {{ $data->sum('poin') }} poin</li>
                <li>Pelanggaran Terverifikasi: {{ $data->where('status_verifikasi', 'verified')->count() }} kasus</li>
                <li>Pelanggaran Pending: {{ $data->where('status_verifikasi', 'pending')->count() }} kasus</li>
                <li>Pelanggaran Ditolak: {{ $data->where('status_verifikasi', 'rejected')->count() }} kasus</li>
            </ul>
        </div>
    @else
        <div style="text-align: center; margin: 50px 0;">
            <p><em>Tidak ada data pelanggaran untuk periode ini.</em></p>
        </div>
    @endif

    <div class="signature">
        <p>{{ now()->format('d F Y') }}</p>
        <p>Bagian Kesiswaan</p>
        <br><br><br>
        <p><strong>{{ auth()->user()->nama_lengkap }}</strong></p>
        <p>Staff Kesiswaan</p>
    </div>
</body>
</html>