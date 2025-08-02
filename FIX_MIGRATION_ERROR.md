# 🔧 Cara Mengatasi Error Migration

## ❌ **Error yang Terjadi:**
```
Unknown column 'tempat_tinggal' in 'users'
```

## ✅ **Solusi Mudah:**

### **Opsi 1: Setup Database Manual (Recommended)**

1. **Jalankan script setup database:**
   ```bash
   php setup_database.php
   ```

2. **Script ini akan:**
   - Membuat database `mapala_db` (jika belum ada)
   - Membuat tabel `users` dengan struktur yang benar
   - Membuat tabel-tabel lain yang diperlukan
   - Insert data default (admin, settings)

### **Opsi 2: Setup Database via MySQL**

1. **Login ke MySQL:**
   ```bash
   mysql -u root -p
   ```

2. **Jalankan SQL script:**
   ```sql
   source setup_database.sql;
   ```

### **Opsi 3: Import Manual**

1. **Buka phpMyAdmin atau MySQL client**
2. **Buat database baru:** `mapala_db`
3. **Import file:** `setup_database.sql`

## 🔧 **Konfigurasi Database**

Pastikan file `app/Config/Database.php` memiliki konfigurasi yang benar:

```php
public array $default = [
    'DSN'      => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'mapala_db',
    'DBDriver' => 'MySQLi',
    'DBPrefix' => '',
    'pConnect' => false,
    'DBDebug'  => true,
    'charset'  => 'utf8mb4',
    'DBCollat' => 'utf8mb4_general_ci',
    'swapPre'  => '',
    'encrypt'  => false,
    'compress' => false,
    'strictOn' => false,
    'failover' => [],
    'port'     => 3306,
];
```

## 🚀 **Test Aplikasi**

Setelah database setup:

1. **Start server:**
   ```bash
   php spark serve --host=0.0.0.0 --port=8080
   ```

2. **Buka browser:**
   ```
   http://localhost:8080/daftar
   ```

3. **Test form pendaftaran** dengan data dummy

## 📋 **Struktur Tabel Users Baru**

```sql
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_panggilan` varchar(50) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `program_studi` varchar(50) NOT NULL,
  `gol_darah` enum('A','B','AB','O') NOT NULL,
  `penyakit` text DEFAULT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `alamat_orangtua` text NOT NULL,
  `no_telp_orangtua` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `angkatan` int(4) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
);
```

## ⚠️ **Catatan Penting**

- **Data lama akan hilang** jika menggunakan script setup (karena DROP TABLE)
- **Backup data** jika diperlukan sebelum menjalankan script
- **Migration CodeIgniter** tidak digunakan karena ada konflik struktur tabel

## 🎯 **Hasil Akhir**

Setelah setup berhasil, Anda akan memiliki:
- ✅ Form pendaftaran dengan field lengkap
- ✅ Generate dokumen DOCX otomatis  
- ✅ Download formulir dan ID card
- ✅ Database dengan struktur yang benar

## 🆘 **Jika Masih Error**

1. **Cek koneksi database** di `app/Config/Database.php`
2. **Pastikan MySQL service** berjalan
3. **Cek permission** direktori `public/uploads/`
4. **Restart web server** setelah perubahan konfigurasi

---

**Pilih salah satu opsi di atas dan form pendaftaran akan berfungsi dengan baik! 🚀**