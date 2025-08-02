# Form Pendaftaran MAPALA Politala - Sistem Terbaru

## Fitur Utama

Sistem form pendaftaran MAPALA Politala telah diperbarui dengan fitur-fitur berikut:

### 1. Form Pendaftaran Lengkap
Form pendaftaran sekarang mencakup semua field yang diperlukan sesuai format standar:

**Data Pribadi:**
- Nama Lengkap
- Nama Panggilan
- Tempat dan Tanggal Lahir
- Jenis Kelamin
- Alamat
- No. Telp/ HP
- Agama
- Prodi / Jurusan
- Gol. Darah
- Penyakit yang diderita
- Foto

**Data Orangtua:**
- Nama Ayah
- Nama Ibu
- Alamat Orangtua
- No. Telp./ HP Orangtua
- Pekerjaan Ayah
- Pekerjaan Ibu

### 2. Generate Dokumen DOCX Otomatis
Setelah pendaftaran berhasil, sistem akan otomatis membuat:
- **Formulir Pendaftaran (DOCX)**: Dokumen lengkap berisi semua data yang telah diisi
- **ID Card MAPALA (DOCX)**: Kartu identitas sementara untuk calon anggota

### 3. Download Otomatis
User dapat langsung mendownload dokumen yang telah dibuat setelah pendaftaran berhasil.

## Instalasi & Setup

### 1. Install Dependencies
```bash
php composer.phar require phpoffice/phpword
```

### 2. Install PHP Extensions
```bash
sudo apt install -y php-intl php-xml php-zip php-gd php-mbstring
```

### 3. Jalankan Migration
```bash
php spark migrate
```

### 4. Buat Direktori Upload
```bash
mkdir -p public/uploads/documents public/uploads/fotos
```

### 5. Set Permissions
```bash
chmod 755 public/uploads/documents public/uploads/fotos
```

## Struktur Database Terbaru

Tabel `users` sekarang memiliki struktur field sebagai berikut:

```sql
- id (int, primary key)
- nama_lengkap (varchar 100)
- nama_panggilan (varchar 50)
- tempat_lahir (varchar 100)
- tanggal_lahir (date)
- jenis_kelamin (enum: 'Laki-laki', 'Perempuan')
- alamat (text)
- no_telp (varchar 20)
- agama (varchar 20)
- program_studi (varchar 50)
- gol_darah (enum: 'A', 'B', 'AB', 'O')
- penyakit (text, nullable)
- nama_ayah (varchar 100)
- nama_ibu (varchar 100)
- alamat_orangtua (text)
- no_telp_orangtua (varchar 20)
- pekerjaan_ayah (varchar 100)
- pekerjaan_ibu (varchar 100)
- foto (varchar 255)
- status (varchar 20)
- angkatan (year)
- created_at (datetime)
- updated_at (datetime)
```

## Alur Pendaftaran

1. **User mengisi form** di halaman `/daftar`
2. **Validasi data** dilakukan di server
3. **Upload foto** ke direktori `public/uploads/fotos`
4. **Simpan data** ke database
5. **Generate dokumen DOCX**:
   - Formulir pendaftaran
   - ID Card
6. **Redirect ke halaman sukses** dengan link download
7. **User dapat download** dokumen yang telah dibuat

## File-file yang Dimodifikasi

### Controllers
- `app/Controllers/Daftar.php` - Controller utama untuk pendaftaran

### Models
- `app/Models/UserModel.php` - Model untuk tabel users

### Views
- `app/Views/daftar/index.php` - Form pendaftaran
- `app/Views/daftar/success.php` - Halaman sukses dengan download links

### Routes
- `app/Config/Routes.php` - Route untuk download dokumen

### Migration
- `app/Database/Migrations/[timestamp]_UpdateUsersTableWithNewFields.php`

## Validasi Form

Sistem melakukan validasi untuk semua field yang required:
- Nama lengkap, nama panggilan
- Tempat dan tanggal lahir
- Jenis kelamin
- Alamat dan nomor telepon
- Agama dan program studi
- Golongan darah
- Data orangtua lengkap
- Upload foto (max 2MB, format JPG/JPEG/PNG)

## Format Dokumen Output

### Formulir Pendaftaran
- Format: Microsoft Word (.docx)
- Berisi: Semua data pribadi dan orangtua
- Layout: Tabel dengan format rapi
- Header: Logo dan nama organisasi

### ID Card
- Format: Microsoft Word (.docx)
- Berisi: Nama, program studi, angkatan, status
- Layout: Kartu identitas sederhana
- Status: "CALON ANGGOTA"

## Troubleshooting

### Error: "ext-intl is missing"
```bash
sudo apt install php-intl
```

### Error: "Cannot create directory"
```bash
chmod 755 public/uploads
mkdir -p public/uploads/documents public/uploads/fotos
```

### Error: "Class PhpWord not found"
```bash
php composer.phar require phpoffice/phpword
```

## Kustomisasi

### Mengubah Template Dokumen
Edit method `generateRegistrationDOCX()` dan `generateIdCardDOCX()` di `app/Controllers/Daftar.php`

### Menambah Field Baru
1. Tambahkan field di form (`app/Views/daftar/index.php`)
2. Update validation rules di controller
3. Tambahkan kolom di database via migration
4. Update model (`app/Models/UserModel.php`)
5. Update template dokumen

### Mengubah Styling
Edit file CSS di `app/Views/layout/main.php` atau template yang digunakan

## Support

Untuk pertanyaan atau bantuan, silakan hubungi tim developer MAPALA Politala.