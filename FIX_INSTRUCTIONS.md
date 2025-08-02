# Perbaikan Sistem Pendaftaran MAPALA Politala

## Masalah yang Ditemukan

Error "Terjadi kesalahan saat mendaftar" disebabkan oleh beberapa masalah:

1. **Ketidakcocokan field database**: Migration menambahkan field `pekerjaan_orangtua` tapi form menggunakan `pekerjaan_ayah` dan `pekerjaan_ibu`
2. **Direktori upload tidak ada**: Direktori untuk menyimpan foto dan dokumen tidak ada
3. **Tabel settings kosong**: Tabel settings belum diinisialisasi dengan data default
4. **Error handling kurang detail**: Tidak ada informasi error yang spesifik

## Solusi yang Telah Diterapkan

### 1. Perbaikan Migration
- File: `app/Database/Migrations/2025-08-02-165545_UpdateUsersTableWithNewFields.php`
- Mengubah field `pekerjaan_orangtua` menjadi `pekerjaan_ayah` dan `pekerjaan_ibu`
- Menambahkan error handling yang lebih robust di method `down()`

### 2. Perbaikan Controller
- File: `app/Controllers/Daftar.php`
- Menambahkan error handling yang lebih detail
- Memastikan direktori upload ada sebelum menyimpan file
- Menambahkan fallback untuk settings table
- Menambahkan logging untuk debugging

### 3. Perbaikan Model
- File: `app/Models/UserModel.php`
- Field `pekerjaan_ayah` dan `pekerjaan_ibu` sudah ada di `allowedFields`

### 4. Script Perbaikan Otomatis
- File: `fix_all.php` - Script komprehensif untuk memperbaiki semua masalah

## Cara Menjalankan Perbaikan

### Opsi 1: Menggunakan Script Otomatis (Direkomendasikan)

```bash
# Pastikan MySQL berjalan dan database mapala_db ada
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS mapala_db;"

# Jalankan script perbaikan
php fix_all.php
```

### Opsi 2: Manual Step by Step

1. **Buat direktori yang diperlukan**:
```bash
mkdir -p public/uploads/fotos public/uploads/documents
chmod -R 755 public/uploads
```

2. **Jalankan migration** (jika PHP CLI tersedia):
```bash
php spark migrate:latest
```

3. **Atau jalankan script database fix**:
```bash
php fix_database.php
```

4. **Inisialisasi settings**:
```bash
php init_settings.php
```

## Struktur Database yang Benar

### Tabel `users`
```sql
CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    nama_panggilan VARCHAR(50) NOT NULL,
    tempat_lahir VARCHAR(100) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    alamat TEXT NOT NULL,
    no_telp VARCHAR(20) NOT NULL,
    agama VARCHAR(20) NOT NULL,
    program_studi VARCHAR(50) NOT NULL,
    gol_darah ENUM('A', 'B', 'AB', 'O') NOT NULL,
    penyakit TEXT NULL,
    nama_ayah VARCHAR(100) NOT NULL,
    nama_ibu VARCHAR(100) NOT NULL,
    alamat_orangtua TEXT NOT NULL,
    no_telp_orangtua VARCHAR(20) NOT NULL,
    pekerjaan_ayah VARCHAR(200) NOT NULL,
    pekerjaan_ibu VARCHAR(200) NOT NULL,
    foto VARCHAR(255) NULL,
    status VARCHAR(20) DEFAULT 'pending',
    angkatan INT(4) NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);
```

### Tabel `settings`
```sql
CREATE TABLE settings (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) NOT NULL UNIQUE,
    value TEXT NOT NULL,
    description TEXT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);
```

## Testing

Setelah menjalankan perbaikan, test sistem dengan:

1. Buka halaman pendaftaran: `http://localhost:8080/daftar`
2. Isi form pendaftaran dengan data lengkap
3. Upload foto
4. Submit form
5. Pastikan tidak ada error dan redirect ke halaman success

## Troubleshooting

### Jika masih ada error:

1. **Cek log error**:
```bash
tail -f writable/logs/log-*.php
```

2. **Cek struktur database**:
```sql
DESCRIBE users;
DESCRIBE settings;
```

3. **Cek direktori upload**:
```bash
ls -la public/uploads/
```

4. **Cek permission**:
```bash
chmod -R 755 public/uploads writable/
```

### Error Umum:

1. **"Can't DROP 'pekerjaan_orangtua'"**: Migration sudah diperbaiki
2. **"Directory not found"**: Jalankan `fix_all.php`
3. **"Settings table not available"**: Jalankan `init_settings.php`
4. **"File upload failed"**: Pastikan direktori upload ada dan writable

## File yang Telah Diperbaiki

1. `app/Database/Migrations/2025-08-02-165545_UpdateUsersTableWithNewFields.php`
2. `app/Controllers/Daftar.php`
3. `app/Models/UserModel.php` (sudah benar)
4. `app/Views/daftar/index.php` (sudah benar)

## Script yang Dibuat

1. `fix_all.php` - Script komprehensif
2. `fix_database.php` - Perbaikan database saja
3. `init_settings.php` - Inisialisasi settings
4. `run_migration.php` - Runner migration (jika PHP CLI tersedia)

Sistem pendaftaran sekarang seharusnya berfungsi dengan baik setelah menjalankan perbaikan ini.