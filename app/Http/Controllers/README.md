# Struktur Controller

Struktur controller telah diorganisir berdasarkan role/fungsi untuk memudahkan maintenance dan pengembangan.

## Struktur Folder

```
app/Http/Controllers/
├── Admin/                          # Controller untuk Admin
│   ├── AdminController.php         # Dashboard & management utama admin
│   ├── PelanggaranSiswaController.php  # Catatan pelanggaran siswa
│   ├── PoinSiswaController.php     # Manajemen poin siswa
│   ├── PrestasiController.php      # Manajemen prestasi siswa
│   ├── SanksiController.php        # Manajemen sanksi
│   └── UserController.php          # Manajemen user
├── Auth/                           # Controller untuk Authentication
│   ├── LoginController.php         # Login functionality
│   └── RegisterController.php      # Registration functionality
├── Bk/                            # Controller untuk BK (Bimbingan Konseling)
│   └── BkController.php
├── Guru/                          # Controller untuk Guru
│   └── GuruController.php
├── Kepsek/                        # Controller untuk Kepala Sekolah
│   └── KepsekController.php
├── Kesiswaan/                     # Controller untuk Kesiswaan
│   └── KesiswaanController.php
├── Ortu/                          # Controller untuk Orang Tua
│   └── OrtuController.php
├── Siswa/                         # Controller untuk Siswa
│   └── SiswaController.php
└── Controller.php                 # Base Controller
```

## Keuntungan Struktur Ini

1. **Organisasi yang Jelas**: Setiap role memiliki folder sendiri
2. **Mudah Maintenance**: Lebih mudah mencari dan memperbaiki controller
3. **Scalable**: Mudah menambah controller baru sesuai role
4. **Namespace Terpisah**: Menghindari konflik nama class
5. **Team Development**: Tim dapat bekerja pada role berbeda tanpa konflik

## Namespace Convention

- Admin controllers: `App\Http\Controllers\Admin`
- Auth controllers: `App\Http\Controllers\Auth`
- Role-based controllers: `App\Http\Controllers\{Role}`

## Contoh Penggunaan

```php
// Import controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;

// Route definition
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::post('/login', [LoginController::class, 'login']);
```

## Update yang Diperlukan

Jika menambah controller baru:
1. Buat di folder yang sesuai dengan role
2. Gunakan namespace yang benar
3. Update routes/web.php dengan namespace lengkap
4. Update import statements jika diperlukan