<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pelanggaran - {{ $kelas->nama_kelas }}</title>
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
            padding: 8px;
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
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
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

    @if($pelanggaran->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="12%">Tanggal</th>
                    <th width="15%">NIS</th>
                    <th width="25%">Nama Siswa</th>
                    <th width="25%">Jenis Pelanggaran</th>
                    <th width="8%">Poin</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggaran as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $p->tanggal->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $p->siswa->nis }}</td>
                    <td>{{ $p->siswa->nama_siswa }}</td>
                    <td>{{ $p->jenisPelanggaran->nama_pelanggaran }}</td>
                    <td class="text-center">{{ $p->poin }}</td>
                    <td class="text-center">
                        @if($p->status_verifikasi == 'verified')
                            Verified
                        @elseif($p->status_verifikasi == 'rejected')
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
                <li>Total Pelanggaran: {{ $pelanggaran->count() }} kasus</li>
                <li>Total Poin Pelanggaran: {{ $pelanggaran->sum('poin') }} poin</li>
                <li>Pelanggaran Terverifikasi: {{ $pelanggaran->where('status_verifikasi', 'verified')->count() }} kasus</li>
                <li>Pelanggaran Pending: {{ $pelanggaran->where('status_verifikasi', 'pending')->count() }} kasus</li>
            </ul>
        </div>
    @else
        <div style="text-align: center; margin: 50px 0;">
            <p><em>Tidak ada data pelanggaran untuk periode ini.</em></p>
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