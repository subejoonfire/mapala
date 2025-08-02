# 📋 Panduan Instalasi Sistem MAPALA Politala

## 🛠️ Prasyarat

### 1. Install PHP 8.0+
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install php8.0 php8.0-cli php8.0-mbstring php8.0-xml php8.0-sqlite3 php8.0-curl php8.0-gd php8.0-zip

# CentOS/RHEL
sudo yum install php php-cli php-mbstring php-xml php-sqlite3 php-curl php-gd php-zip

# macOS dengan Homebrew
brew install php

# Windows dengan XAMPP/WAMP
# Download dari https://www.apachefriends.org/
```

### 2. Install Composer
```bash
# Download installer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 3. Install Node.js (untuk Tailwind CSS)
```bash
# Ubuntu/Debian
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs

# macOS
brew install node

# Windows
# Download dari https://nodejs.org/
```

## 🚀 Instalasi Sistem

### 1. Clone Repository
```bash
git clone <repository-url>
cd mapala-politala
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies (jika ada)
npm install
```

### 3. Setup Environment
```bash
# Copy environment file
cp env .env

# Edit .env file sesuai kebutuhan
nano .env
```

### 4. Setup Database
```bash
# Jalankan script setup database
php setup_database.php
```

### 5. Setup Folder Permissions
```bash
# Buat folder uploads
mkdir -p public/uploads
mkdir -p public/uploads/fotos
mkdir -p public/uploads/documents
mkdir -p public/uploads/id-cards

# Set permissions
chmod -R 755 writable/
chmod -R 755 public/uploads/
```

### 6. Jalankan Server
```bash
# Development server
php spark serve

# Atau dengan Apache/Nginx
# Konfigurasi web server sesuai dokumentasi CodeIgniter 4
```

## 📊 Verifikasi Instalasi

### 1. Cek Database
```bash
# Cek file database SQLite
ls -la writable/mapala.db

# Cek isi database
sqlite3 writable/mapala.db ".tables"
```

### 2. Cek Login Default
```
URL: http://localhost:8080
Email: ahmad.rizki@politala.ac.id
Password: password123
```

### 3. Cek Fitur Utama
- ✅ Halaman beranda
- ✅ Profil divisi
- ✅ Kode etik
- ✅ Kegiatan
- ✅ Formulir pendaftaran
- ✅ Login anggota
- ✅ Download PDF

## 🔧 Troubleshooting

### Error: PHP not found
```bash
# Cek versi PHP
php -v

# Jika tidak ada, install PHP
sudo apt install php8.0
```

### Error: Database connection
```bash
# Cek file database
ls -la writable/mapala.db

# Jika tidak ada, jalankan setup
php setup_database.php
```

### Error: Permission denied
```bash
# Set permissions
chmod -R 755 writable/
chmod -R 755 public/uploads/
```

### Error: Composer not found
```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

## 📁 Struktur File Setelah Instalasi

```
mapala-politala/
├── app/
│   ├── Database/
│   │   ├── Migrations/     # ✅ Database migrations
│   │   └── Seeds/         # ✅ Sample data
│   ├── Controllers/       # ✅ Logic controllers
│   ├── Models/           # ✅ Data models
│   └── Views/            # ✅ UI templates
├── public/
│   ├── assets/           # ✅ CSS, JS, images
│   └── uploads/          # ✅ Uploaded files
├── writable/
│   └── mapala.db         # ✅ SQLite database
├── .env                  # ✅ Environment config
├── setup_database.php    # ✅ Database setup script
└── README_MAPALA.md      # ✅ Documentation
```

## 🎯 Fitur yang Tersedia

### ✅ Sudah Siap:
- Database SQLite dengan sample data
- 5 divisi MAPALA
- 5 user (admin + anggota)
- 5 kegiatan dengan foto
- Kode etik organisasi
- Formulir pendaftaran
- Generate PDF (ID Card + Formulir)
- Video angkatan
- Login system

### 🔄 Perlu Dikembangkan:
- Controllers untuk logic aplikasi
- Views untuk UI/UX
- PDF generation library
- WhatsApp integration
- File upload handling
- Authentication system

## 📞 Support

Jika mengalami masalah saat instalasi, silakan:

1. Cek log error di `writable/logs/`
2. Pastikan semua prasyarat terpenuhi
3. Hubungi tim pengembang MAPALA Politala

---

**MAPALA Politala** - Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut  
*Mencintai Alam, Mengabdi untuk Negeri* 🌿