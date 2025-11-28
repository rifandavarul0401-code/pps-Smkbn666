# Struktur Migration

Struktur migration telah diorganisir berdasarkan domain/fungsi untuk memudahkan maintenance dan pengembangan.

## Struktur Folder

```
database/migrations/
├── Admin/                          # Migration untuk data admin
│   ├── create_admin_table.php
│   └── create_verifikasi_data_table.php
├── Auth/                           # Migration untuk authentication
│   ├── create_users_table.php
│   └── add_level_column_to_users_table.php
├── Bk/                            # Migration untuk data BK
│   ├── create_bk_table.php
│   └── create_bimbingan_konseling_table.php
├── Core/                          # Migration untuk core system
│   └── create_tahun_ajaran_table.php
├── Guru/                          # Migration untuk data guru
│   └── create_guru_table.php
├── Kepsek/                        # Migration untuk kepala sekolah
│   └── create_monitoring_pelanggaran_table.php
├── Kesiswaan/                     # Migration untuk data kesiswaan
│   └── create_kesiswaans_table.php
├── Pelanggaran/                   # Migration terkait pelanggaran
│   ├── create_pelanggaran_table.php
│   ├── create_jenis_pelanggaran_table.php
│   └── create_kategori_pelanggaran_table.php
├── Prestasi/                      # Migration terkait prestasi
│   ├── create_jenis_prestasi_table.php
│   └── create_prestasi_table.php
├── Sanksi/                        # Migration terkait sanksi
│   ├── create_sanksi_table.php
│   ├── create_pelaksanaan_sanksi_table.php
│   └── create_jenis_sanksi_table.php
├── Siswa/                         # Migration untuk data siswa
│   └── create_siswa_table.php
└── System/                        # Migration sistem Laravel
    ├── create_cache_table.php
    ├── create_jobs_table.php
    └── create_sessions_table.php
```

## Keuntungan Struktur Ini

1. **Domain-Driven Organization**: Migration dikelompokkan berdasarkan domain bisnis
2. **Mudah Maintenance**: Lebih mudah mencari migration yang terkait
3. **Logical Grouping**: Migration yang saling terkait berada dalam satu folder
4. **Clear Separation**: Pemisahan antara migration sistem dan aplikasi
5. **Scalable**: Mudah menambah migration baru sesuai domain

## Kategori Migration

### **Auth** - Authentication & Authorization
- User management
- Role & permission
- Login/logout functionality

### **Core** - Core System Tables
- Tahun ajaran
- Konfigurasi sistem
- Master data

### **Domain-Specific** - Business Logic
- **Pelanggaran**: Semua terkait pelanggaran siswa
- **Prestasi**: Semua terkait prestasi siswa
- **Sanksi**: Semua terkait sanksi
- **Siswa**: Data siswa
- **Guru**: Data guru
- **Admin**: Data admin
- **Bk**: Data BK
- **Kesiswaan**: Data kesiswaan

### **System** - Laravel Framework
- Cache tables
- Job queues
- Sessions
- Framework-related tables

## Urutan Eksekusi Migration

Laravel akan tetap menjalankan migration berdasarkan timestamp dalam nama file, bukan berdasarkan folder. Struktur folder ini hanya untuk organisasi.

## Contoh Penamaan

```
2025_11_17_063507_create_kategori_pelanggaran_table.php
│         │      │    │
│         │      │    └── Deskripsi migration
│         │      └────── Jam (06:35:07)
│         └───────────── Tanggal (17 November 2025)
└─────────────────────── Tahun (2025)
```

## Best Practices

1. **Konsisten**: Selalu letakkan migration di folder yang sesuai domain
2. **Deskriptif**: Gunakan nama yang jelas untuk migration
3. **Dependency**: Perhatikan urutan dependency antar table
4. **Rollback**: Selalu implementasikan method `down()` dengan benar

## Update yang Diperlukan

Jika menambah migration baru:
1. Tentukan domain/kategori migration
2. Buat di folder yang sesuai
3. Gunakan penamaan yang konsisten
4. Pastikan dependency table sudah ada