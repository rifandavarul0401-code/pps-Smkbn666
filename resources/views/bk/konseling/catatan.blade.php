@extends('bk.layouts.app')

@section('title', 'Catatan Konseling')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Catatan Konseling</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('bk.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Catatan Konseling</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-file-alt me-1"></i>
            Catatan Konseling Siswa Bermasalah
        </div>
        <div class="card-body">
            @if($catatan->count() > 0)
                <div class="row">
                    @foreach($catatan as $siswa)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-left-danger">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $siswa->nama_siswa }}</h6>
                                    <span class="badge bg-danger">{{ $siswa->poinSiswa ? $siswa->poinSiswa->total_poin : 100 }} poin</span>
                                </div>
                                <small class="text-muted">{{ $siswa->nis }} - {{ $siswa->kelas->nama_kelas ?? '-' }}</small>
                            </div>
                            <div class="card-body">
                                <h6 class="text-danger">Riwayat Pelanggaran:</h6>
                                @if($siswa->pelanggaran->count() > 0)
                                    <ul class="list-unstyled">
                                        @foreach($siswa->pelanggaran->take(3) as $p)
                                        <li class="mb-2">
                                            <small>
                                                <i class="fas fa-exclamation-triangle text-warning me-1"></i>
                                                {{ $p->jenisPelanggaran->nama_pelanggaran ?? 'Pelanggaran' }}
                                                <span class="text-muted">({{ $p->tanggal ? $p->tanggal->format('d/m/Y') : '-' }})</span>
                                            </small>
                                        </li>
                                        @endforeach
                                        @if($siswa->pelanggaran->count() > 3)
                                            <li><small class="text-muted">... dan {{ $siswa->pelanggaran->count() - 3 }} lainnya</small></li>
                                        @endif
                                    </ul>
                                @else
                                    <p class="text-muted small">Belum ada riwayat pelanggaran</p>
                                @endif
                                
                                <div class="mt-3">
                                    <h6 class="text-primary">Rekomendasi Konseling:</h6>
                                    @php
                                        $poin = $siswa->poinSiswa ? $siswa->poinSiswa->total_poin : 100;
                                        $rekomendasi = [];
                                        
                                        if($poin < 30) {
                                            $rekomendasi = [
                                                'Konseling intensif mingguan',
                                                'Panggil orang tua segera',
                                                'Buat kontrak perilaku',
                                                'Monitoring harian'
                                            ];
                                        } elseif($poin < 50) {
                                            $rekomendasi = [
                                                'Konseling bi-weekly',
                                                'Koordinasi dengan wali kelas',
                                                'Program mentoring',
                                                'Evaluasi bulanan'
                                            ];
                                        }
                                    @endphp
                                    
                                    @if(count($rekomendasi) > 0)
                                        <ul class="list-unstyled">
                                            @foreach($rekomendasi as $r)
                                            <li class="mb-1">
                                                <small><i class="fas fa-check text-success me-1"></i>{{ $r }}</small>
                                            </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#catatanModal{{ $siswa->siswa_id }}">
                                    <i class="fas fa-edit"></i> Buat Catatan
                                </button>
                                <button class="btn btn-sm btn-success">
                                    <i class="fas fa-calendar-plus"></i> Jadwal Konseling
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada catatan konseling</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Catatan -->
@foreach($catatan as $siswa)
<div class="modal fade" id="catatanModal{{ $siswa->siswa_id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Catatan Konseling - {{ $siswa->nama_siswa }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tanggal_konseling" class="form-label">Tanggal Konseling</label>
                            <input type="date" class="form-control" id="tanggal_konseling" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_konseling" class="form-label">Jenis Konseling</label>
                            <select class="form-select" id="jenis_konseling">
                                <option value="Individual">Individual</option>
                                <option value="Kelompok">Kelompok</option>
                                <option value="Keluarga">Bersama Keluarga</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="topik_bahasan" class="form-label">Topik Bahasan</label>
                        <input type="text" class="form-control" id="topik_bahasan" placeholder="Topik yang dibahas dalam konseling">
                    </div>
                    
                    <div class="mb-3">
                        <label for="hasil_konseling" class="form-label">Hasil Konseling</label>
                        <textarea class="form-control" id="hasil_konseling" rows="4" placeholder="Catatan hasil konseling, respon siswa, dan perkembangan..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                        <textarea class="form-control" id="tindak_lanjut" rows="3" placeholder="Rencana tindak lanjut dan jadwal konseling berikutnya..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="evaluasi" class="form-label">Evaluasi</label>
                        <select class="form-select" id="evaluasi">
                            <option value="">-- Pilih Evaluasi --</option>
                            <option value="Sangat Baik">Sangat Baik - Siswa sangat kooperatif</option>
                            <option value="Baik">Baik - Siswa kooperatif</option>
                            <option value="Cukup">Cukup - Siswa cukup kooperatif</option>
                            <option value="Kurang">Kurang - Siswa kurang kooperatif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanCatatan({{ $siswa->siswa_id }})">
                    <i class="fas fa-save"></i> Simpan Catatan
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
function simpanCatatan(siswaId) {
    // Simulasi penyimpanan catatan
    alert('Catatan konseling berhasil disimpan untuk siswa ID: ' + siswaId);
    $('#catatanModal' + siswaId).modal('hide');
}
</script>
@endsection