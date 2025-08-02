# Setup MAPALA Politala dengan MySQL

## Persyaratan
- PHP 8.0 atau lebih tinggi
- MySQL Server
- Composer

## Langkah Setup

### 1. Install Dependencies
```bash
composer install
```

### 2. Setup Database MySQL

#### Opsi A: Menggunakan Script Otomatis
```bash
php setup_mysql_simple.php
```

#### Opsi B: Manual Setup
1. Buat database MySQL:
```sql
CREATE DATABASE mapala_db;
```

2. Jalankan migration:
```bash
php spark migrate:refresh --all
```

3. Jalankan seeder:
```bash
php spark db:seed MainSeeder
```

### 3. Jalankan Aplikasi
```bash
php spark serve
```

Buka browser dan akses: http://localhost:8080

## Konfigurasi Database

File konfigurasi sudah diset untuk MySQL:
- Host: localhost
- Database: mapala_db
- Username: root
- Password: (kosong)
- Port: 3306

## Login Default
- Email: ahmad.rizki@politala.ac.id
- Password: password123

## Struktur Database
- users - Data anggota MAPALA
- divisi - Divisi-divisi MAPALA
- kegiatan - Kegiatan-kegiatan
- kegiatan_foto - Foto-foto kegiatan
- video_angkatan - Video angkatan
- kode_etik - Kode etik MAPALA
- id_card - Kartu identitas anggota

## Troubleshooting

### Error "Duplicate key name"
Jika muncul error duplicate key, jalankan:
```bash
php fix_migrations.php
```

### Error koneksi MySQL
Pastikan:
1. MySQL server sudah berjalan
2. User root sudah dikonfigurasi
3. Port 3306 tidak diblokir

### Error migration
Jika migration gagal:
1. Hapus database mapala_db
2. Buat ulang database
3. Jalankan: `php spark migrate:refresh --all`