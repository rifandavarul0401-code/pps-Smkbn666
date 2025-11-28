# Struktur Model

Struktur model telah diorganisir berdasarkan domain/fungsi untuk memudahkan maintenance dan pengembangan.

## Struktur Folder

```
app/Models/
├── Admin/                          # Model untuk data admin
│   └── Admin.php
├── Auth/                           # Model untuk authentication (kosong saat ini)
├── Bk/                            # Model untuk data BK
│   └── Bk.php
├── Guru/                          # Model untuk data guru
│   └── Guru.php
├── Kesiswaan/                     # Model untuk data kesiswaan
│   └── Kesiswaan.php
├── Pelanggaran/                   # Model terkait pelanggaran
│   ├── JenisPelanggaran.php       # Jenis-jenis pelanggaran
│   ├── KategoriPelanggaran.php    # Kategori pelanggaran
│   └── Pelanggaran.php            # Data pelanggaran siswa
├── Prestasi/                      # Model terkait prestasi
│   ├── JenisPrestasi.php          # Jenis-jenis prestasi
│   └── Prestasi.php               # Data prestasi siswa
├── Sanksi/                        # Model terkait sanksi
│   ├── JenisSanksi.php            # Jenis-jenis sanksi
│   ├── PelaksanaanSanksi.php      # Pelaksanaan sanksi
│   └── Sanksi.php                 # Data sanksi
├── Siswa/                         # Model untuk data siswa
│   └── Siswa.php
└── User.php                       # Base user model
```

## Keuntungan Struktur Ini

1. **Domain-Driven Design**: Model dikelompokkan berdasarkan domain bisnis
2. **Mudah Maintenance**: Lebih mudah mencari model yang terkait
3. **Scalable**: Mudah menambah model baru sesuai domain
4. **Namespace Terpisah**: Menghindari konflik nama class
5. **Logical Grouping**: Model yang saling terkait berada dalam satu folder

## Namespace Convention

- Domain-based models: `App\Models\{Domain}`
- Contoh: `App\Models\Pelanggaran\JenisPelanggaran`

## Relasi Antar Model

### Pelanggaran Domain
- `Pelanggaran` belongsTo `JenisPelanggaran`
- `Pelanggaran` belongsTo `Siswa`

### Prestasi Domain  
- `Prestasi` belongsTo `JenisPrestasi`
- `Prestasi` belongsTo `Siswa`

### Sanksi Domain
- `Sanksi` belongsTo `Pelanggaran`
- `Sanksi` hasMany `PelaksanaanSanksi`

### Siswa Domain
- `Siswa` hasMany `Pelanggaran`
- `Siswa` hasMany `Prestasi`

## Contoh Penggunaan

```php
// Import model
use App\Models\Pelanggaran\JenisPelanggaran;
use App\Models\Prestasi\Prestasi;
use App\Models\Siswa\Siswa;

// Penggunaan
$jenisPelanggaran = JenisPelanggaran::all();
$prestasi = Prestasi::with('jenisPrestasi')->get();
$siswa = Siswa::with(['pelanggaran', 'prestasi'])->find(1);
```

## Update yang Diperlukan

Jika menambah model baru:
1. Buat di folder yang sesuai dengan domain
2. Gunakan namespace yang benar
3. Update controller yang menggunakan model tersebut
4. Update relasi jika diperlukan