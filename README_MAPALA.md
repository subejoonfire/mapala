# 🏔️ Sistem Informasi MAPALA Politala

Sistem informasi web untuk organisasi MAPALA (Mahasiswa Pecinta Alam) Politeknik Negeri Tanah Laut dengan tema hijau-putih yang dinamis dan modern.

## 🎯 Fitur Utama

### 👥 Level Akses
1. **Publik (tanpa login)**
   - Lihat profil 5 divisi MAPALA (view only)
   - Lihat kode etik organisasi
   - Lihat kegiatan MAPALA (foto & deskripsi saja)
   - Formulir pendaftaran anggota baru

2. **Anggota (login)**
   - Semua akses publik
   - Lihat dokumentasi kegiatan lengkap (foto, video, laporan, anggaran, LPJ)
   - Akses video tiap angkatan
   - Unduh semua dokumen kegiatan internal

### 🏢 Struktur Divisi
1. **Divisi Gunung Hutan** - Pendakian dan eksplorasi alam
2. **Divisi Rock Climbing** - Panjat tebing dan rock climbing
3. **Divisi Arung Jeram** - Kegiatan air dan water rescue
4. **Divisi Penelitian & Lingkungan** - Konservasi dan penelitian
5. **Divisi SAR** - Search and Rescue

### 📋 Formulir Pendaftaran
- Data pribadi lengkap
- Upload foto
- Program studi dropdown
- Generate PDF otomatis
- Link WhatsApp grup

### 📄 File yang Dihasilkan
1. **ID Card** - Kartu identitas anggota dengan foto dan data lengkap
2. **Formulir Pendaftaran** - PDF berisi data pendaftar yang sudah diisi

## 🛠️ Teknologi

- **Backend**: CodeIgniter 4
- **Database**: SQLite
- **Frontend**: Tailwind CSS
- **PDF**: TCPDF/FPDF
- **Icons**: Heroicons/SVG

## 🚀 Cara Menjalankan

### 1. Setup Database
```bash
# Jalankan script setup database
php setup_database.php
```

### 2. Jalankan Server
```bash
# Development server
php spark serve
```

### 3. Akses Aplikasi
```
URL: http://localhost:8080
```

## 📊 Struktur Database

### Tables:
- `users` - Data pengguna (admin, anggota, calon anggota)
- `divisi` - Data 5 divisi MAPALA
- `kegiatan` - Data kegiatan organisasi
- `kegiatan_foto` - Foto-foto kegiatan
- `video_angkatan` - Video dokumentasi per angkatan
- `kode_etik` - Kode etik organisasi
- `id_card` - Data ID Card anggota

### Sample Data:
- 5 divisi MAPALA
- 5 user (1 admin + 4 anggota)
- 5 kegiatan dengan foto
- 5 video angkatan (2020-2024)
- Kode etik organisasi

## 🔑 Login Default

```
Email: ahmad.rizki@politala.ac.id
Password: password123
```

## 🎨 Tema & Desain

### Warna Utama:
- **Hijau**: #16a34a (Primary)
- **Putih**: #ffffff (Background)
- **Hijau Muda**: #dcfce7 (Accent)

### Komponen UI:
- Responsive design
- Modern card layout
- Dynamic forms
- Photo galleries
- PDF generation
- WhatsApp integration

## 📱 Fitur Responsif

- Mobile-first design
- Tablet optimization
- Desktop enhancement
- Touch-friendly interface

## 🔧 Konfigurasi

### Environment (.env):
```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.DBDriver = SQLite3
database.default.database = writable/mapala.db
```

## 📁 Struktur File

```
app/
├── Database/
│   ├── Migrations/     # Database migrations
│   └── Seeds/         # Sample data
├── Controllers/       # Logic controllers
├── Models/           # Data models
└── Views/            # UI templates

public/
├── assets/           # CSS, JS, images
└── uploads/         # Uploaded files

writable/
└── mapala.db        # SQLite database
```

## 🚀 Deployment

1. Setup database dengan `php setup_database.php`
2. Konfigurasi environment production
3. Upload ke server
4. Set permissions folder writable
5. Akses aplikasi

## 📞 Support

Untuk bantuan teknis atau pertanyaan, silakan hubungi tim pengembang MAPALA Politala.

---

**MAPALA Politala** - Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut  
*Mencintai Alam, Mengabdi untuk Negeri* 🌿