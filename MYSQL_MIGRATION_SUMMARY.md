# Ringkasan Konversi SQLite ke MySQL

## File yang Diubah

### 1. Konfigurasi Database
- **env**: Diubah dari SQLite ke MySQL
- **app/Config/Database.php**: Diubah konfigurasi default ke MySQL

### 2. Migration Files (Diperbaiki)
- **2024-01-01-000001_CreateUsers.php**: Hapus duplikasi unique key
- **2024-01-01-000002_CreateDivisi.php**: Hapus duplikasi unique key
- **2024-01-01-000003_CreateKegiatan.php**: Hapus duplikasi unique key
- **2024-01-01-000006_CreateKodeEtik.php**: Hapus duplikasi unique key
- **2024-01-01-000007_CreateIdCard.php**: Hapus duplikasi unique key

### 3. Script Setup Baru
- **setup_mysql_simple.php**: Script setup MySQL yang lengkap
- **fix_migrations.php**: Script untuk memperbaiki migration files
- **check_migrations.php**: Script untuk mengecek migration files
- **setup_mysql.php**: Script setup MySQL alternatif

## Konfigurasi MySQL

### Database Settings
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'mapala_db',
'DBDriver' => 'MySQLi',
'port' => 3306,
'charset' => 'utf8',
'DBCollat' => 'utf8_general_ci'
```

### Environment (.env)
```ini
database.default.hostname = localhost
database.default.database = mapala_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

## Cara Setup

### Langkah 1: Pastikan MySQL Berjalan
```bash
# Cek status MySQL
sudo systemctl status mysql
# atau
sudo service mysql status
```

### Langkah 2: Jalankan Setup Script
```bash
php setup_mysql_simple.php
```

### Langkah 3: Jalankan Aplikasi
```bash
php spark serve
```

## Troubleshooting

### Error "Duplicate key name"
```bash
php fix_migrations.php
php spark migrate:refresh --all
```

### Error Koneksi MySQL
1. Pastikan MySQL server berjalan
2. Cek user root bisa akses tanpa password
3. Cek port 3306 tidak diblokir

### Error Migration
```bash
# Hapus database lama
mysql -u root -e "DROP DATABASE IF EXISTS mapala_db;"

# Buat database baru
mysql -u root -e "CREATE DATABASE mapala_db;"

# Jalankan migration
php spark migrate:refresh --all
```

## Perbedaan SQLite vs MySQL

| Aspek | SQLite | MySQL |
|-------|--------|-------|
| File | writable/mapala.db | Database server |
| Konfigurasi | Sederhana | Perlu server |
| Performance | Baik untuk kecil | Lebih baik untuk besar |
| Concurrent | Terbatas | Mendukung multi-user |
| Backup | Copy file | mysqldump |

## Script yang Tersedia

1. **setup_mysql_simple.php** - Setup lengkap dengan perbaikan migration
2. **fix_migrations.php** - Perbaiki duplikasi unique key
3. **check_migrations.php** - Cek status migration files
4. **setup_database.php** - Script setup lama (sudah diupdate)
5. **run_migration.php** - Script migration lama (sudah diupdate)

## Login Default
- Email: ahmad.rizki@politala.ac.id
- Password: password123