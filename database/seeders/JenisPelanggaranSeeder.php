<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggaran = [
            // A. KETERTIBAN
            ['nama_pelanggaran' => 'Membuat keributan / kegaduhan dalam kelas pada saat berlangsungnya pelajaran', 'deskripsi' => 'Ketertiban', 'poin' => 10, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Masuk dan atau keluar lingkungan sekolah tidak melalui gerbang sekolah', 'deskripsi' => 'Ketertiban', 'poin' => 20, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Berkata tidak jujur, tidak sopan/kasar', 'deskripsi' => 'Ketertiban', 'poin' => 10, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Mengotor (mencorat-coret) barang milik sekolah, guru, karyawan atau teman', 'deskripsi' => 'Ketertiban', 'poin' => 10, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Merusak atau menghilangkan barang milik sekolah, guru, karyawan atau teman', 'deskripsi' => 'Ketertiban', 'poin' => 25, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Mengambil (mencuri) barang milik sekolah, guru, karyawan atau teman', 'deskripsi' => 'Ketertiban', 'poin' => 50, 'kategori' => 'berat'],
            ['nama_pelanggaran' => 'Makan dan minum di dalam kelas saat berlangsungnya pelajaran', 'deskripsi' => 'Ketertiban', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Mengaktifkan alat komunikasi didalam kelas pada saat pelajaran berlangsung', 'deskripsi' => 'Ketertiban', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Membuang sampah tidak pada tempatnya', 'deskripsi' => 'Ketertiban', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Membawa teman selain siswa SMK BN maupun dengan siswa sekolah lain atau pihak lain', 'deskripsi' => 'Ketertiban', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Membawa benda yang tidak ada kaitannya dengan proses belajar mengajar', 'deskripsi' => 'Ketertiban', 'poin' => 10, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Bertengkar / bertentangan dengan teman di lingkungan sekolah', 'deskripsi' => 'Ketertiban', 'poin' => 15, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Memalsu tandatangan guru, walikelas, kepala sekolah', 'deskripsi' => 'Ketertiban', 'poin' => 40, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Menggunakan/menggelapkan SPP dari orang tua', 'deskripsi' => 'Ketertiban', 'poin' => 40, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Membentuk organisasi selain OSIS maupun kegiatan lainnya tanpa seijin Kepala Sekolah', 'deskripsi' => 'Ketertiban', 'poin' => 15, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Menyalahgunakan Uang SPP', 'deskripsi' => 'Ketertiban', 'poin' => 40, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Berbuat asusila', 'deskripsi' => 'Ketertiban', 'poin' => 100, 'kategori' => 'berat'],
            
            // B. ROKOK
            ['nama_pelanggaran' => 'Membawa rokok', 'deskripsi' => 'Rokok', 'poin' => 25, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Merokok / menghisap rokok di sekolah', 'deskripsi' => 'Rokok', 'poin' => 40, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Merokok/ menghisap rokok di luar sekolah memakai seragam sekolah', 'deskripsi' => 'Rokok', 'poin' => 40, 'kategori' => 'sedang'],
            
            // C. BUKU, MAJALAH ATAU KASET TERLARANG
            ['nama_pelanggaran' => 'Membawa buku, majalah, kaset terlarang atau HP berita gambar dan film porno', 'deskripsi' => 'Buku/Majalah Terlarang', 'poin' => 25, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Memperjual belikan buku, majalah atau kaset terlarang', 'deskripsi' => 'Buku/Majalah Terlarang', 'poin' => 75, 'kategori' => 'berat'],
            
            // D. SENJATA
            ['nama_pelanggaran' => 'Membawa senjata tajam tanpa ijin', 'deskripsi' => 'Senjata', 'poin' => 40, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Memperjual belikan senjata tajam di sekolah', 'deskripsi' => 'Senjata', 'poin' => 40, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Menggunakan senjata tajam untuk mengancam', 'deskripsi' => 'Senjata', 'poin' => 75, 'kategori' => 'berat'],
            ['nama_pelanggaran' => 'Menggunakan senjata tajam untuk melukai', 'deskripsi' => 'Senjata', 'poin' => 75, 'kategori' => 'berat'],
            
            // E. OBAT / MINUMAN TERLARANG
            ['nama_pelanggaran' => 'Membawa obat terlarang / minuman terlarang', 'deskripsi' => 'Obat/Minuman Terlarang', 'poin' => 75, 'kategori' => 'berat'],
            ['nama_pelanggaran' => 'Menggunakan obat / minuman terlarang di dalam lingkungan sekolah', 'deskripsi' => 'Obat/Minuman Terlarang', 'poin' => 100, 'kategori' => 'berat'],
            ['nama_pelanggaran' => 'Memperjual belikan obat / minuman terlarang di dalam / di luar sekolah', 'deskripsi' => 'Obat/Minuman Terlarang', 'poin' => 100, 'kategori' => 'berat'],
            
            // F. PERKELAHIAN
            ['nama_pelanggaran' => 'Perkelahian disekolah oleh siswa di dalam sekolah (intern)', 'deskripsi' => 'Perkelahian', 'poin' => 75, 'kategori' => 'berat'],
            ['nama_pelanggaran' => 'Perkelahian disekolah oleh sekolah lain', 'deskripsi' => 'Perkelahian', 'poin' => 25, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Perkelahian antar siswa SMK BN 658', 'deskripsi' => 'Perkelahian', 'poin' => 75, 'kategori' => 'berat'],
            
            // G. PELANGGARAN TERHADAP KEPALA SEKOLAH, GURU DAN KARYAWAN
            ['nama_pelanggaran' => 'Pelanggaran terhadap Kepala Sekolah, Guru dan Karyawan disertai ancaman', 'deskripsi' => 'Pelanggaran terhadap Guru/Karyawan', 'poin' => 75, 'kategori' => 'berat'],
            ['nama_pelanggaran' => 'Pelanggaran terhadap Kepala Sekolah, Guru dan Karyawan disertai pemukulan', 'deskripsi' => 'Pelanggaran terhadap Guru/Karyawan', 'poin' => 100, 'kategori' => 'berat'],
            
            // H. KERAJINAN - A. KETERLAMBATAN
            ['nama_pelanggaran' => 'Terlambat masuk sekolah lebih dari 15 menit (satu kali)', 'deskripsi' => 'Keterlambatan', 'poin' => 2, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Terlambat masuk sekolah lebih dari 15 menit (dua kali)', 'deskripsi' => 'Keterlambatan', 'poin' => 3, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Terlambat masuk sekolah lebih dari 15 menit (tiga kali dan seterusnya)', 'deskripsi' => 'Keterlambatan', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Terlambat masuk karena izin', 'deskripsi' => 'Keterlambatan', 'poin' => 3, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Terlambat masuk karena dicon tugas guru', 'deskripsi' => 'Keterlambatan', 'poin' => 2, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Terlambat masuk karena alasan yang dibuat-buat izin keluar saat proses belajar berlangsung dan tidak kembali', 'deskripsi' => 'Keterlambatan', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Pulang tanpa izin', 'deskripsi' => 'Keterlambatan', 'poin' => 10, 'kategori' => 'ringan'],
            
            // H. KERAJINAN - B. KEHADIRAN
            ['nama_pelanggaran' => 'Siswa tidak masuk karena sakit tanpa keterangan (surat)', 'deskripsi' => 'Kehadiran', 'poin' => 2, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Siswa tidak masuk karena izin tanpa keterangan (surat)', 'deskripsi' => 'Kehadiran', 'poin' => 2, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Siswa tidak masuk karena alpa', 'deskripsi' => 'Kehadiran', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Tidak mengikuti kegiatan belajar (membolos)', 'deskripsi' => 'Kehadiran', 'poin' => 10, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Siswa tidak masuk dengan membawa surat keterangan (surat) Palsu', 'deskripsi' => 'Kehadiran', 'poin' => 10, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Siswa keluar kelas saat proses belajar mengajar berlangsung tanpa izin', 'deskripsi' => 'Kehadiran', 'poin' => 5, 'kategori' => 'ringan'],
            
            // III. KERAPIAN - A. PAKAIAN
            ['nama_pelanggaran' => 'Memakai seragam tidak rapi / tidak dimasukkan', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Siswa putri memakai seragam yang ketat / rok pendek', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Tidak memakai perlengkapan upacara bendera (topi)', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Siswa memakai baju, rok atau celana', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Salah atau tidak memakai ikat di pinggang', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Salah memakai sepatu (tidak sesuai ketentuan)', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Tidak memakai kaos kaki', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Salah / tidak memakai kaos dalam', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Memakai topi yang bukan topi sekolah di lingkungan sekolah', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Siswa putri memakai permaiasan perlebihan', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            ['nama_pelanggaran' => 'Siswa putra memakai perhiasan atau aksesories (kalung, gelang, dll)', 'deskripsi' => 'Pakaian', 'poin' => 5, 'kategori' => 'ringan'],
            
            // III. KERAPIAN - B. RAMBUT
            ['nama_pelanggaran' => 'Potongan rambut putra tidak sesuai dengan ketentuan sekolah', 'deskripsi' => 'Rambut', 'poin' => 15, 'kategori' => 'sedang'],
            ['nama_pelanggaran' => 'Rambut dicat / diwarna-warnai (putra-putri)', 'deskripsi' => 'Rambut', 'poin' => 15, 'kategori' => 'sedang'],
            
            // III. KERAPIAN - C. BADAN
            ['nama_pelanggaran' => 'Bertato', 'deskripsi' => 'Badan', 'poin' => 100, 'kategori' => 'berat'],
            ['nama_pelanggaran' => 'Kuku di cat', 'deskripsi' => 'Badan', 'poin' => 20, 'kategori' => 'sedang'],
        ];

        foreach ($pelanggaran as $index => $item) {
            DB::table('jenis_pelanggaran')->insert([
                'kode_pelanggaran' => 'P' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'nama_pelanggaran' => $item['nama_pelanggaran'],
                'deskripsi' => $item['deskripsi'],
                'poin' => $item['poin'],
                'kategori' => $item['kategori'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
