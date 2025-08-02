# MAPALA Politala - Sistem Pendaftaran

Sistem pendaftaran MAPALA Politala dengan konsep free registration untuk semua user dan login hanya untuk admin.

## 🚀 Fitur Utama

- ✅ **Free Registration** - Semua user bisa daftar tanpa login
- ✅ **Admin Only Login** - Hanya admin yang bisa login
- ✅ **PDF Generation** - Otomatis generate formulir & ID Card
- ✅ **WhatsApp Integration** - Link grup WhatsApp
- ✅ **Admin Panel** - Verifikasi pendaftar dan manajemen data

## 📋 Cara Setup

### 1. Install Dependencies
```bash
composer install
```

### 2. Setup Database
```bash
php setup_mapala_new.php
```

### 3. Jalankan Aplikasi
```bash
php spark serve
```

## 🔐 Login Admin

### Default Admin Accounts:
- **Username**: `admin`
- **Password**: `admin123`

- **Username**: `ketua`
- **Password**: `ketua123`

## 🔗 URL Penting

- **Beranda**: `http://localhost:8080`
- **Daftar MAPALA**: `http://localhost:8080/daftar`
- **Login Admin**: `http://localhost:8080/login`
- **Admin Dashboard**: `http://localhost:8080/admin`

## 📄 Output untuk User

Setelah admin approve, user akan mendapat:
- **Formulir Pendaftaran PDF**
- **ID Card MAPALA PDF**
- **Link Grup WhatsApp**

## 🛠️ Admin Panel Features

- ✅ Verifikasi pendaftar (approve/reject)
- ✅ Generate PDF formulir & ID Card
- ✅ Manajemen user
- ✅ Reports & statistik
- ✅ Export data

## 📱 WhatsApp Integration

Link otomatis ke grup WhatsApp:
```
https://wa.me/6281234567890?text=Halo, saya ingin bergabung dengan MAPALA Politala
```

## 🔧 Konfigurasi

### Environment (.env)
```env
database.default.hostname = localhost
database.default.database = mapala_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

## 📁 Struktur Database

### Tabel `users` (Pendaftar)
- NIM, nama, email, no WA/HP
- Data pribadi lengkap
- Foto upload
- Status (pending/approved/rejected)
- **Tidak ada password**

### Tabel `admins` (Admin)
- Username & password untuk login
- Role admin
- Status aktif/nonaktif

## 🔄 Flow Sistem

1. **User daftar** di `/daftar` (free, tanpa login)
2. **Admin login** di `/login`
3. **Admin verifikasi** pendaftar di `/admin/users`
4. **Admin approve/reject** dan generate PDF
5. **User mendapat** PDF + link WhatsApp

## 📞 Support

Untuk bantuan teknis:
- **Email**: admin@mapala-politala.ac.id
- **WhatsApp**: 081234567890

## 📝 Changelog

### v2.0.0 (Sistem Baru)
- ✅ Free registration untuk semua user
- ✅ Login hanya untuk admin
- ✅ Generate PDF formulir & ID Card
- ✅ Integrasi WhatsApp grup
- ✅ Admin panel yang lengkap
- ✅ Sistem verifikasi pendaftar
