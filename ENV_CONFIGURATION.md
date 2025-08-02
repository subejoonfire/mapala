# 📋 Konfigurasi File .env - MAPALA Politala

## 📁 File yang Tersedia

### 1. `env.example` - Template Lengkap
File ini berisi semua kemungkinan konfigurasi yang bisa digunakan dalam sistem MAPALA Politala. Berisi:
- ✅ Konfigurasi standar CodeIgniter 4
- ✅ Konfigurasi khusus MAPALA Politala
- ✅ Konfigurasi untuk development dan production
- ✅ Konfigurasi database (SQLite & MySQL)
- ✅ Konfigurasi keamanan dan backup
- ✅ Konfigurasi email dan WhatsApp
- ✅ Konfigurasi PDF dan file upload

### 2. `env` - Konfigurasi Development
File ini sudah dikonfigurasi untuk development dengan pengaturan minimal yang diperlukan:
- ✅ Database SQLite
- ✅ Session configuration
- ✅ MAPALA-specific settings
- ✅ Development tools enabled

## 🚀 Cara Menggunakan

### Step 1: Copy File Template
```bash
# Copy file example ke .env
cp env.example .env

# Atau gunakan file yang sudah dikonfigurasi
cp env .env
```

### Step 2: Sesuaikan Konfigurasi
Edit file `.env` sesuai kebutuhan:

```bash
# Database Configuration
database.default.database = writable/mapala.db

# Base URL
app.baseURL = 'http://localhost:8080/'

# WhatsApp Group Link
app.whatsappGroupLink = 'https://chat.whatsapp.com/your-actual-group-link'

# Email Configuration
app.smtpUser = 'your-email@gmail.com'
app.smtpPass = 'your-app-password'
```

## 🔧 Konfigurasi Penting

### 📊 Database Configuration
```env
# SQLite (Default)
database.default.DBDriver = SQLite3
database.default.database = writable/mapala.db

# MySQL (Alternative)
# database.default.DBDriver = MySQLi
# database.default.hostname = localhost
# database.default.database = mapala_politala
# database.default.username = root
# database.default.password = your_password
```

### 🌐 App Configuration
```env
# Development
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

# Production
# CI_ENVIRONMENT = production
# app.baseURL = 'https://mapala-politala.ac.id/'
```

### 📧 Email Configuration
```env
app.emailFrom = 'noreply@mapala-politala.ac.id'
app.emailFromName = 'MAPALA Politala'
app.smtpHost = 'smtp.gmail.com'
app.smtpPort = 587
app.smtpUser = 'your-email@gmail.com'
app.smtpPass = 'your-app-password'
```

### 📱 WhatsApp Configuration
```env
app.whatsappGroupLink = 'https://chat.whatsapp.com/your-group-link-here'
```

### 📄 PDF Configuration
```env
app.pdfLogoPath = 'public/assets/images/logo-mapala.png'
app.pdfHeaderText = 'MAPALA POLITALA'
app.pdfFooterText = 'Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut'
```

### 📁 File Upload Configuration
```env
app.maxFileSize = 2048 # KB
app.allowedImageTypes = 'jpg,jpeg,png'
app.allowedDocumentTypes = 'pdf,doc,docx,xls,xlsx'

uploads.fotos = 'public/uploads/fotos/'
uploads.documents = 'public/uploads/documents/'
uploads.idCards = 'public/uploads/id-cards/'
uploads.temp = 'public/uploads/temp/'
```

## 🎯 Konfigurasi MAPALA Khusus

### 🏢 Organization Info
```env
app.organizationName = 'MAPALA Politala'
app.organizationFullName = 'Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut'
app.organizationAddress = 'Jl. A. Yani Km 6, Pelaihari, Tanah Laut, Kalimantan Selatan'
app.organizationPhone = '+62-812-3456-7890'
app.organizationEmail = 'info@mapala-politala.ac.id'
app.organizationWebsite = 'https://mapala-politala.ac.id'
```

### 📚 Program Studi
```env
app.programStudi = [
    'Akuntansi',
    'Teknologi Informasi', 
    'Teknologi Otomotif',
    'Agroindustri',
    'TPT',
    'TRKJ',
    'TRKJJ',
    'Akuntansi Perpajakan',
    'PPA',
    'TRPAB'
]
```

### 🏛️ Agama
```env
app.religions = [
    'Islam',
    'Kristen',
    'Katolik', 
    'Hindu',
    'Buddha',
    'Konghucu'
]
```

### 🏔️ Jenis Kegiatan
```env
app.jenisKegiatan = [
    'pendakian',
    'rock_climbing',
    'arung_jeram',
    'penelitian',
    'sar',
    'pelatihan',
    'lainnya'
]
```

## 🔒 Security Configuration

### 🔐 Session Security
```env
session.driver = CodeIgniter\Session\Handlers\FileHandler
session.cookieName = mapala_session
session.expiration = 7200 # 2 hours
session.savePath = writable/session/
session.matchIP = false
session.timeToUpdate = 300
session.regenerateDestroy = false
```

### 🛡️ Security Settings
```env
app.sessionTimeout = 7200 # 2 hours
app.maxLoginAttempts = 5
app.lockoutTime = 900 # 15 minutes
```

## 🚀 Production Configuration

### 🌍 Production Settings
```env
# Environment
CI_ENVIRONMENT = production

# Base URL
app.baseURL = 'https://mapala-politala.ac.id/'
app.forceGlobalSecureRequests = true

# Security
session.secure = true
cookie.secure = true
cookie.sameSite = 'Strict'

# Error Reporting
debug.showErrors = false
debug.showDebugInfo = false
debug.showQueries = false
debug.showMemoryUsage = false
```

### 📊 Performance Settings
```env
# Cache
cache.handler = 'file'
cache.backup = 'file'
cache.storePath = 'writable/cache/'
cache.default = 'file'
cache.prefix = 'mapala_'

# Logging
logger.threshold = 1
```

## 🔧 Development Configuration

### 🛠️ Development Tools
```env
# Debug Tools
debug.showErrors = true
debug.showDebugInfo = true
debug.showQueries = true
debug.showMemoryUsage = true

# Logging
logger.threshold = 4
```

### 📝 Migration Settings
```env
migrations.enabled = true
migrations.table = migrations
migrations.path = 'App\Database\Migrations'
```

## 📋 Checklist Konfigurasi

### ✅ Essential Settings
- [ ] `CI_ENVIRONMENT` set to development/production
- [ ] `app.baseURL` configured correctly
- [ ] Database configuration (SQLite/MySQL)
- [ ] Session configuration
- [ ] File upload paths created

### ✅ MAPALA Settings
- [ ] WhatsApp group link configured
- [ ] Email settings configured
- [ ] Organization info updated
- [ ] Program studi list configured
- [ ] Agama list configured
- [ ] Jenis kegiatan configured

### ✅ Security Settings
- [ ] Session timeout configured
- [ ] Login attempts limit set
- [ ] File upload limits set
- [ ] Allowed file types configured

### ✅ Production Settings (if deploying)
- [ ] Environment set to production
- [ ] HTTPS enabled
- [ ] Debug tools disabled
- [ ] Error reporting configured
- [ ] Cache enabled

## 🚨 Troubleshooting

### ❌ Common Issues

#### 1. Database Connection Error
```bash
# Check if SQLite file exists
ls -la writable/mapala.db

# Create database if not exists
php run_migration.php
```

#### 2. File Upload Error
```bash
# Check upload directories
ls -la public/uploads/

# Create directories if not exists
mkdir -p public/uploads/{fotos,documents,id-cards,temp}
chmod 755 public/uploads/{fotos,documents,id-cards,temp}
```

#### 3. Session Error
```bash
# Check session directory
ls -la writable/session/

# Create session directory if not exists
mkdir -p writable/session/
chmod 755 writable/session/
```

#### 4. Permission Error
```bash
# Set correct permissions
chmod -R 755 writable/
chmod -R 755 public/uploads/
```

## 📞 Support

Jika mengalami masalah dengan konfigurasi:

1. **Check Logs**: `writable/logs/`
2. **Verify Permissions**: Pastikan folder writable bisa diakses
3. **Test Database**: `php check_database.php`
4. **Check Environment**: Pastikan file `.env` ada dan benar

---

**MAPALA Politala** - Environment Configuration Guide  
*Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut* 🌿