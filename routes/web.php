<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelanggaranSiswaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\PelanggaranController as AdminPelanggaranController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Guru\PelanggaranController as GuruPelanggaranController;
use App\Http\Controllers\Guru\PrestasiController as GuruPrestasiController;
use App\Http\Controllers\Bk\VerifikasiController;
use App\Http\Controllers\kesiswaan\KesiswaanController;
use App\Http\Controllers\Guru\GuruController;

use App\Http\Controllers\Bk\BkController;
use App\Http\Controllers\Kepsek\KepsekController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\Ortu\OrtuController;
use App\Http\Controllers\WaliKelas\WaliKelasController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::middleware(['auth', 'level:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // User Management
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{id}/update-level', [AdminController::class, 'updateLevel'])->name('admin.users.updateLevel');
    Route::post('/admin/users/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.users.toggleStatus');
    
    // Jenis Pelanggaran Management
    Route::get('/admin/jenis-pelanggaran', [AdminController::class, 'jenisPelanggaran'])->name('admin.jenis-pelanggaran');
    Route::get('/admin/jenis-pelanggaran/create', [AdminController::class, 'createJenisPelanggaran'])->name('admin.jenis-pelanggaran.create');
    Route::post('/admin/jenis-pelanggaran', [AdminController::class, 'storeJenisPelanggaran'])->name('admin.jenis-pelanggaran.store');
    Route::get('/admin/jenis-pelanggaran/{id}/edit', [AdminController::class, 'editJenisPelanggaran'])->name('admin.jenis-pelanggaran.edit');
    Route::put('/admin/jenis-pelanggaran/{id}', [AdminController::class, 'updateJenisPelanggaran'])->name('admin.jenis-pelanggaran.update');
    Route::delete('/admin/jenis-pelanggaran/{id}', [AdminController::class, 'deleteJenisPelanggaran'])->name('admin.jenis-pelanggaran.delete');
    

    
    // Kategori Pelanggaran Management
    Route::get('/admin/kategori-pelanggaran', [AdminController::class, 'kategoriPelanggaran'])->name('admin.kategori-pelanggaran');
    Route::get('/admin/kategori-pelanggaran/create', [AdminController::class, 'createKategoriPelanggaran'])->name('admin.kategori-pelanggaran.create');
    Route::post('/admin/kategori-pelanggaran', [AdminController::class, 'storeKategoriPelanggaran'])->name('admin.kategori-pelanggaran.store');
    Route::get('/admin/kategori-pelanggaran/{id}/edit', [AdminController::class, 'editKategoriPelanggaran'])->name('admin.kategori-pelanggaran.edit');
    Route::put('/admin/kategori-pelanggaran/{id}', [AdminController::class, 'updateKategoriPelanggaran'])->name('admin.kategori-pelanggaran.update');
    Route::delete('/admin/kategori-pelanggaran/{id}', [AdminController::class, 'deleteKategoriPelanggaran'])->name('admin.kategori-pelanggaran.delete');
    
    // Guru Management
    Route::get('/admin/guru', [App\Http\Controllers\Admin\GuruController::class, 'index'])->name('admin.guru.index');
    Route::get('/admin/guru/create', [App\Http\Controllers\Admin\GuruController::class, 'create'])->name('admin.guru.create');
    Route::post('/admin/guru', [App\Http\Controllers\Admin\GuruController::class, 'store'])->name('admin.guru.store');
    Route::get('/admin/guru/{id}/edit', [App\Http\Controllers\Admin\GuruController::class, 'edit'])->name('admin.guru.edit');
    Route::put('/admin/guru/{id}', [App\Http\Controllers\Admin\GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/admin/guru/{id}', [App\Http\Controllers\Admin\GuruController::class, 'destroy'])->name('admin.guru.destroy');
    
    // Kesiswaan Management
    Route::get('/admin/kesiswaan', [App\Http\Controllers\Admin\KesiswaanController::class, 'index'])->name('admin.kesiswaan.index');
    Route::get('/admin/kesiswaan/create', [App\Http\Controllers\Admin\KesiswaanController::class, 'create'])->name('admin.kesiswaan.create');
    Route::post('/admin/kesiswaan', [App\Http\Controllers\Admin\KesiswaanController::class, 'store'])->name('admin.kesiswaan.store');
    Route::get('/admin/kesiswaan/{id}/edit', [App\Http\Controllers\Admin\KesiswaanController::class, 'edit'])->name('admin.kesiswaan.edit');
    Route::put('/admin/kesiswaan/{id}', [App\Http\Controllers\Admin\KesiswaanController::class, 'update'])->name('admin.kesiswaan.update');
    Route::delete('/admin/kesiswaan/{id}', [App\Http\Controllers\Admin\KesiswaanController::class, 'destroy'])->name('admin.kesiswaan.destroy');
    
    // BK Management
    Route::get('/admin/bk', [App\Http\Controllers\Admin\BkController::class, 'index'])->name('admin.bk.index');
    Route::get('/admin/bk/create', [App\Http\Controllers\Admin\BkController::class, 'create'])->name('admin.bk.create');
    Route::post('/admin/bk', [App\Http\Controllers\Admin\BkController::class, 'store'])->name('admin.bk.store');
    Route::get('/admin/bk/{id}/edit', [App\Http\Controllers\Admin\BkController::class, 'edit'])->name('admin.bk.edit');
    Route::put('/admin/bk/{id}', [App\Http\Controllers\Admin\BkController::class, 'update'])->name('admin.bk.update');
    Route::delete('/admin/bk/{id}', [App\Http\Controllers\Admin\BkController::class, 'destroy'])->name('admin.bk.destroy');
    
    // Catatan Pelanggaran Siswa
    Route::get('/admin/pelanggaran-siswa', [PelanggaranSiswaController::class, 'index'])->name('admin.pelanggaran-siswa.index');
    Route::get('/admin/pelanggaran-siswa/create', [PelanggaranSiswaController::class, 'create'])->name('admin.pelanggaran-siswa.create');
    Route::post('/admin/pelanggaran-siswa', [PelanggaranSiswaController::class, 'store'])->name('admin.pelanggaran-siswa.store');
    
    // Sanksi Management
    Route::get('/admin/sanksi', [App\Http\Controllers\Admin\SanksiController::class, 'index'])->name('admin.sanksi.index');
    Route::get('/admin/sanksi/create', [App\Http\Controllers\Admin\SanksiController::class, 'create'])->name('admin.sanksi.create');
    Route::post('/admin/sanksi', [App\Http\Controllers\Admin\SanksiController::class, 'store'])->name('admin.sanksi.store');
    Route::get('/admin/sanksi/{id}/pelaksanaan', [App\Http\Controllers\Admin\SanksiController::class, 'pelaksanaan'])->name('admin.sanksi.pelaksanaan');
    Route::post('/admin/sanksi/{id}/pelaksanaan', [App\Http\Controllers\Admin\SanksiController::class, 'storePelaksanaan'])->name('admin.sanksi.pelaksanaan.store');
    
    // Jenis Sanksi Management
    Route::get('/admin/jenis-sanksi', [AdminController::class, 'jenisSanksi'])->name('admin.jenis-sanksi');
    Route::get('/admin/jenis-sanksi/create', [AdminController::class, 'createJenisSanksi'])->name('admin.jenis-sanksi.create');
    Route::post('/admin/jenis-sanksi', [AdminController::class, 'storeJenisSanksi'])->name('admin.jenis-sanksi.store');
    Route::get('/admin/jenis-sanksi/{id}/edit', [AdminController::class, 'editJenisSanksi'])->name('admin.jenis-sanksi.edit');
    Route::put('/admin/jenis-sanksi/{id}', [AdminController::class, 'updateJenisSanksi'])->name('admin.jenis-sanksi.update');
    Route::delete('/admin/jenis-sanksi/{id}', [AdminController::class, 'deleteJenisSanksi'])->name('admin.jenis-sanksi.delete');
    
    // Jenis Prestasi Management
    Route::prefix('admin/prestasi/jenis-prestasi')->name('admin.prestasi.jenis-prestasi.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PrestasiController::class, 'jenisPrestasi'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\PrestasiController::class, 'createJenisPrestasi'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\PrestasiController::class, 'storeJenisPrestasi'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\PrestasiController::class, 'editJenisPrestasi'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\PrestasiController::class, 'updateJenisPrestasi'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\PrestasiController::class, 'destroyJenisPrestasi'])->name('destroy');
    });
    
    // Poin Siswa
    Route::get('/admin/poin-siswa', [App\Http\Controllers\Admin\PoinSiswaController::class, 'index'])->name('admin.poin-siswa.index');
    Route::get('/admin/poin-siswa/{id}', [App\Http\Controllers\Admin\PoinSiswaController::class, 'detail'])->name('admin.poin-siswa.detail');
    
    // Siswa Management
    Route::resource('admin/siswa', AdminSiswaController::class, ['as' => 'admin']);
    
    // Pelanggaran Management
    Route::resource('admin/pelanggaran', AdminPelanggaranController::class, ['as' => 'admin']);
    Route::post('admin/pelanggaran/{pelanggaran}/verify', [AdminPelanggaranController::class, 'verify'])->name('admin.pelanggaran.verify');
    
    // Prestasi Management
    Route::resource('admin/prestasi', AdminPrestasiController::class, ['as' => 'admin']);
    Route::post('admin/prestasi/{prestasi}/verify', [AdminPrestasiController::class, 'verify'])->name('admin.prestasi.verify');
    
    // Laporan
    Route::get('/admin/laporan/pelanggaran', [App\Http\Controllers\Admin\LaporanPelanggaranController::class, 'index'])->name('admin.laporan.pelanggaran');
    Route::get('/admin/laporan/prestasi', [App\Http\Controllers\Admin\LaporanController::class, 'prestasi'])->name('admin.laporan.prestasi');
    

});

Route::middleware(['auth', 'level:kesiswaan'])->group(function () {
    Route::get('/kesiswaan/dashboard', [KesiswaanController::class, 'dashboard'])->name('kesiswaan.dashboard');
    
    // Data Kesiswaan
    Route::get('/kesiswaan/data-kesiswaan', [KesiswaanController::class, 'dataKesiswaan'])->name('kesiswaan.data-kesiswaan');
    
    // Data Siswa
    Route::get('/kesiswaan/data-siswa', [KesiswaanController::class, 'dataSiswa'])->name('kesiswaan.data-siswa');
    
    // Export Laporan
    Route::get('/kesiswaan/export-laporan', [KesiswaanController::class, 'exportLaporan'])->name('kesiswaan.export-laporan');
    
    // Input Pelanggaran
    Route::get('/kesiswaan/pelanggaran/create', [App\Http\Controllers\kesiswaan\PelanggaranController::class, 'create'])->name('kesiswaan.pelanggaran.create');
    Route::post('/kesiswaan/pelanggaran', [App\Http\Controllers\kesiswaan\PelanggaranController::class, 'store'])->name('kesiswaan.pelanggaran.store');
    
    // Input Prestasi
    Route::get('/kesiswaan/prestasi/create', [App\Http\Controllers\kesiswaan\PrestasiController::class, 'create'])->name('kesiswaan.prestasi.create');
    Route::post('/kesiswaan/prestasi', [App\Http\Controllers\kesiswaan\PrestasiController::class, 'store'])->name('kesiswaan.prestasi.store');
    
    // Verifikasi Data
    Route::get('/kesiswaan/verifikasi', [App\Http\Controllers\kesiswaan\VerifikasiController::class, 'index'])->name('kesiswaan.verifikasi.index');
    Route::post('/kesiswaan/verifikasi/pelanggaran/{id}/verify', [App\Http\Controllers\kesiswaan\VerifikasiController::class, 'verifyPelanggaran'])->name('kesiswaan.verifikasi.pelanggaran.verify');
    Route::post('/kesiswaan/verifikasi/pelanggaran/{id}/reject', [App\Http\Controllers\kesiswaan\VerifikasiController::class, 'rejectPelanggaran'])->name('kesiswaan.verifikasi.pelanggaran.reject');
    Route::post('/kesiswaan/verifikasi/prestasi/{id}/verify', [App\Http\Controllers\kesiswaan\VerifikasiController::class, 'verifyPrestasi'])->name('kesiswaan.verifikasi.prestasi.verify');
    Route::post('/kesiswaan/verifikasi/prestasi/{id}/reject', [App\Http\Controllers\kesiswaan\VerifikasiController::class, 'rejectPrestasi'])->name('kesiswaan.verifikasi.prestasi.reject');
    
    // Monitoring
    Route::get('/kesiswaan/monitoring', [App\Http\Controllers\kesiswaan\MonitoringController::class, 'index'])->name('kesiswaan.monitoring.index');
    
    // Export PDF
    Route::get('/kesiswaan/export/pelanggaran-pdf', [KesiswaanController::class, 'exportPelanggaranPdf'])->name('kesiswaan.export.pelanggaran-pdf');
    Route::get('/kesiswaan/export/prestasi-pdf', [KesiswaanController::class, 'exportPrestasiPdf'])->name('kesiswaan.export.prestasi-pdf');
});

Route::middleware(['auth', 'level:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    
    // Daftar Siswa
    Route::get('/guru/daftar-siswa', [GuruController::class, 'daftarSiswa'])->name('guru.daftar-siswa');
    
    // Riwayat Input
    Route::get('/guru/riwayat-input', [GuruController::class, 'riwayatInput'])->name('guru.riwayat-input');
    
    // Laporan Kelas
    Route::get('/guru/laporan-kelas', [GuruController::class, 'laporanKelas'])->name('guru.laporan-kelas');
    
    // Pelanggaran untuk Guru
    Route::get('/guru/pelanggaran', [GuruPelanggaranController::class, 'index'])->name('guru.pelanggaran.index');
    Route::get('/guru/pelanggaran/create', [GuruPelanggaranController::class, 'create'])->name('guru.pelanggaran.create');
    Route::post('/guru/pelanggaran', [GuruPelanggaranController::class, 'store'])->name('guru.pelanggaran.store');
    
    // Prestasi untuk Guru
    Route::get('/guru/prestasi', [GuruPrestasiController::class, 'index'])->name('guru.prestasi.index');
    Route::get('/guru/prestasi/create', [GuruPrestasiController::class, 'create'])->name('guru.prestasi.create');
    Route::post('/guru/prestasi', [GuruPrestasiController::class, 'store'])->name('guru.prestasi.store');
});

Route::middleware(['auth', 'level:kepsek'])->group(function () {
    Route::get('/kepsek/dashboard', [KepsekController::class, 'dashboard'])->name('kepsek.dashboard');
    Route::get('/kepsek/statistik', [KepsekController::class, 'statistik'])->name('kepsek.statistik');
    Route::get('/kepsek/siswa', [KepsekController::class, 'siswa'])->name('kepsek.siswa');
    Route::get('/kepsek/guru', [KepsekController::class, 'guru'])->name('kepsek.guru');
    Route::get('/kepsek/laporan/pelanggaran', [KepsekController::class, 'laporanPelanggaran'])->name('kepsek.laporan.pelanggaran');
    Route::get('/kepsek/laporan/prestasi', [KepsekController::class, 'laporanPrestasi'])->name('kepsek.laporan.prestasi');
    Route::get('/kepsek/laporan/sanksi', [KepsekController::class, 'laporanSanksi'])->name('kepsek.laporan.sanksi');
    Route::get('/kepsek/laporan/bulanan', [KepsekController::class, 'laporanBulanan'])->name('kepsek.laporan.bulanan');
    
    // Persetujuan
    Route::get('/kepsek/persetujuan/sanksi-berat', [App\Http\Controllers\Kepsek\PersetujuanController::class, 'sanksiBerat'])->name('kepsek.persetujuan.sanksi-berat');
    Route::get('/kepsek/persetujuan/penghargaan', [App\Http\Controllers\Kepsek\PersetujuanController::class, 'penghargaan'])->name('kepsek.persetujuan.penghargaan');
    Route::post('/kepsek/persetujuan/sanksi/{id}/approve', [App\Http\Controllers\Kepsek\PersetujuanController::class, 'approveSanksi'])->name('kepsek.persetujuan.sanksi.approve');
    Route::post('/kepsek/persetujuan/prestasi/{id}/approve', [App\Http\Controllers\Kepsek\PersetujuanController::class, 'approvePrestasi'])->name('kepsek.persetujuan.prestasi.approve');
});

Route::middleware(['auth', 'level:bk'])->group(function () {
    Route::get('/bk/dashboard', [BkController::class, 'dashboard'])->name('bk.dashboard');
    
    // Verifikasi untuk BK
    Route::get('/bk/verifikasi/pelanggaran', [VerifikasiController::class, 'pelanggaran'])->name('bk.verifikasi.pelanggaran');
    Route::get('/bk/verifikasi/prestasi', function() { return redirect()->route('bk.verifikasi.pelanggaran'); });
    Route::post('/bk/pelanggaran/{pelanggaran}/verify', [VerifikasiController::class, 'verifyPelanggaran'])->name('bk.pelanggaran.verify');
    Route::post('/bk/pelanggaran/{pelanggaran}/reject', [VerifikasiController::class, 'rejectPelanggaran'])->name('bk.pelanggaran.reject');
    
    // Sanksi
    Route::get('/bk/sanksi', [BkController::class, 'sanksi'])->name('bk.sanksi');
    Route::get('/bk/sanksi/create', [BkController::class, 'createSanksi'])->name('bk.sanksi.create');
    Route::post('/bk/sanksi', [BkController::class, 'storeSanksi'])->name('bk.sanksi.store');
    Route::get('/bk/sanksi/monitoring', [BkController::class, 'monitoringSanksi'])->name('bk.sanksi.monitoring');
    Route::post('/bk/sanksi/{id}/update-status', [BkController::class, 'updateStatusSanksi'])->name('bk.sanksi.update-status');
    
    // Konseling
    Route::get('/bk/konseling', [BkController::class, 'konseling'])->name('bk.konseling');
    Route::get('/bk/konseling/catatan', [BkController::class, 'catatanKonseling'])->name('bk.konseling.catatan');
    
    // Laporan
    Route::get('/bk/laporan', [BkController::class, 'laporanBk'])->name('bk.laporan');
    Route::get('/bk/laporan/export-pdf', [BkController::class, 'exportLaporanBkPdf'])->name('bk.laporan.export-pdf');
});

Route::middleware(['auth', 'level:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/profil', [SiswaController::class, 'profil'])->name('siswa.profil');
    Route::get('/siswa/data-siswa', [SiswaController::class, 'dataSiswa'])->name('siswa.data-siswa');
    Route::get('/siswa/riwayat-pelanggaran', [SiswaController::class, 'riwayatPelanggaran'])->name('siswa.riwayat-pelanggaran');
    Route::get('/siswa/riwayat-prestasi', [SiswaController::class, 'riwayatPrestasi'])->name('siswa.riwayat-prestasi');
    Route::get('/siswa/riwayat-sanksi', [SiswaController::class, 'riwayatSanksi'])->name('siswa.riwayat-sanksi');
    Route::get('/siswa/total-poin', [SiswaController::class, 'totalPoin'])->name('siswa.total-poin');
});

Route::middleware(['auth', 'level:ortu'])->group(function () {
    Route::get('/ortu/dashboard', [OrtuController::class, 'dashboard'])->name('ortu.dashboard');
    Route::get('/ortu/data-sendiri', [OrtuController::class, 'dataSendiri'])->name('ortu.data-sendiri');
    Route::get('/ortu/data-anak', [OrtuController::class, 'dataAnak'])->name('ortu.data-anak');
});

Route::middleware(['auth', 'level:wali_kelas'])->group(function () {
    Route::get('/walikelas/dashboard', [WaliKelasController::class, 'dashboard'])->name('walikelas.dashboard');
    
    // Input Pelanggaran
    Route::get('/walikelas/pelanggaran/create', [WaliKelasController::class, 'createPelanggaran'])->name('walikelas.pelanggaran.create');
    Route::post('/walikelas/pelanggaran', [WaliKelasController::class, 'storePelanggaran'])->name('walikelas.pelanggaran.store');
    
    // Data Wali Kelas
    Route::get('/walikelas/data-walikelas', [WaliKelasController::class, 'dataWaliKelas'])->name('walikelas.data-walikelas');
    
    // Siswa Kelas
    Route::get('/walikelas/siswa-kelas', [WaliKelasController::class, 'siswaKelas'])->name('walikelas.siswa-kelas');
    
    // Monitoring
    Route::get('/walikelas/monitoring', [WaliKelasController::class, 'monitoring'])->name('walikelas.monitoring');
    
    // Export Laporan
    Route::get('/walikelas/export-laporan', [WaliKelasController::class, 'exportLaporan'])->name('walikelas.export-laporan');
    Route::get('/walikelas/export/pelanggaran-pdf', [WaliKelasController::class, 'exportPelanggaranPdf'])->name('walikelas.export.pelanggaran-pdf');
    Route::get('/walikelas/export/prestasi-pdf', [WaliKelasController::class, 'exportPrestasiPdf'])->name('walikelas.export.prestasi-pdf');
    Route::get('/walikelas/export/monitoring-pdf', [WaliKelasController::class, 'exportMonitoringPdf'])->name('walikelas.export.monitoring-pdf');
});
