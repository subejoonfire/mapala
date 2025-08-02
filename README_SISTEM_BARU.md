# MAPALA Politala - Sistem Pendaftaran Baru

## 📋 Deskripsi Sistem

Sistem pendaftaran MAPALA Politala yang baru dengan konsep:
- **Free Registration**: Semua user bisa daftar tanpa perlu login
- **Admin Only Login**: Hanya admin yang bisa login ke sistem
- **PDF Generation**: Otomatis generate PDF formulir dan ID Card
- **WhatsApp Integration**: Link grup WhatsApp untuk anggota

## 🚀 Cara Setup

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

## 📁 Struktur Database

### Tabel `users` (Pendaftar)
- `id` - Primary key
- `nim` - NIM mahasiswa (unique)
- `nama_lengkap` - Nama lengkap
- `email` - Email (unique)
- `no_wa` - Nomor WhatsApp
- `no_hp` - Nomor HP
- `tempat_lahir` - Tempat lahir
- `tanggal_lahir` - Tanggal lahir
- `tempat_tinggal` - Alamat lengkap
- `program_studi` - Program studi
- `agama` - Agama
- `penyakit` - Riwayat penyakit (opsional)
- `pengalaman_organisasi` - Pengalaman organisasi (opsional)
- `alasan_mapala` - Alasan bergabung MAPALA
- `foto` - Foto diri
- `status` - Status (pending/approved/rejected)
- `angkatan` - Angkatan tahun
- `created_at` - Waktu pendaftaran
- `updated_at` - Waktu update

### Tabel `admins` (Admin)
- `id` - Primary key
- `username` - Username admin (unique)
- `password` - Password (hashed)
- `nama_lengkap` - Nama lengkap admin
- `email` - Email admin (unique)
- `role` - Role (admin)
- `status` - Status (aktif/nonaktif)
- `created_at` - Waktu dibuat
- `updated_at` - Waktu update

## 🔄 Flow Sistem

### 1. Pendaftaran User
1. User mengakses `/daftar`
2. Mengisi formulir pendaftaran
3. Upload foto
4. Submit data
5. Redirect ke halaman sukses
6. Admin akan verifikasi data

### 2. Verifikasi Admin
1. Admin login di `/login`
2. Akses `/admin/users`
3. Lihat daftar pendaftar
4. Approve/reject pendaftar
5. Generate PDF dan ID Card
6. Kirim link WhatsApp

### 3. Output untuk User
Setelah disetujui, user akan mendapat:
- **Formulir Pendaftaran PDF**
- **ID Card MAPALA PDF**
- **Link Grup WhatsApp**

## 📄 Fitur PDF

### 1. Formulir Pendaftaran
- Data lengkap pendaftar
- Foto pendaftar
- Tanda tangan digital
- QR Code untuk verifikasi

### 2. ID Card MAPALA
- Foto pendaftar
- Nomor ID Card
- Divisi yang dipilih
- Jabatan dalam divisi
- Masa berlaku
- QR Code

## 🔗 URL Penting

- **Beranda**: `http://localhost:8080`
- **Daftar MAPALA**: `http://localhost:8080/daftar`
- **Login Admin**: `http://localhost:8080/login`
- **Admin Dashboard**: `http://localhost:8080/admin`
- **Manajemen User**: `http://localhost:8080/admin/users`

## 📱 Integrasi WhatsApp

### Link Grup WhatsApp
- Format: `https://wa.me/6281234567890?text=Halo, saya ingin bergabung dengan MAPALA Politala`
- Admin bisa set nomor WhatsApp grup
- User akan mendapat link otomatis setelah approval

## 🛠️ Admin Panel Features

### 1. User Management
- Lihat semua pendaftar
- Filter berdasarkan status
- Approve/reject pendaftar
- Edit data pendaftar
- Hapus data pendaftar

### 2. PDF Generation
- Generate formulir pendaftaran
- Generate ID Card
- Download PDF
- Email PDF ke user

### 3. Reports
- Laporan pendaftar per periode
- Statistik pendaftar
- Export data ke Excel

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

### Upload Directories
```
public/uploads/
├── fotos/          # Foto pendaftar
├── documents/      # Dokumen PDF
├── id_cards/       # ID Card images
├── kegiatan/       # Foto kegiatan
└── divisi/         # Foto divisi
```

## 🚨 Troubleshooting

### Error Migration
```bash
php spark migrate:refresh --all
```

### Error Seeder
```bash
php spark db:seed MainSeeder
```

### Error Upload
```bash
chmod -R 755 public/uploads/
```

### Error PDF Generation
- Pastikan TCPDF terinstall
- Cek permission folder uploads
- Cek memory limit PHP

## 📞 Support

Untuk bantuan teknis, hubungi:
- **Email**: admin@mapala-politala.ac.id
- **WhatsApp**: 081234567890
- **Telegram**: @mapala_politala

## 📝 Changelog

### v2.0.0 (Sistem Baru)
- ✅ Free registration untuk semua user
- ✅ Login hanya untuk admin
- ✅ Generate PDF formulir & ID Card
- ✅ Integrasi WhatsApp grup
- ✅ Admin panel yang lengkap
- ✅ Sistem verifikasi pendaftar

### v1.0.0 (Sistem Lama)
- ❌ Login/register untuk semua user
- ❌ Password untuk pendaftar
- ❌ Dashboard member
- ❌ Sistem yang kompleks