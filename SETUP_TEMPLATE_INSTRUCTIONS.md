# Setup Template DOCX - Panduan Lengkap

## Overview
Sistem pendaftaran MAPALA telah diperbarui untuk menggunakan template DOCX yang Anda sediakan dengan fitur auto-fill data user dan integrasi foto.

## Status Implementasi ✅
- ✅ Template processor untuk formulir pendaftaran
- ✅ Template processor untuk ID card  
- ✅ Integrasi foto otomatis
- ✅ Auto-fill seluruh data user
- ✅ Error handling dan validasi
- ✅ Testing lengkap

## File Template yang Tersedia

### Template yang Sudah Siap Pakai
1. **app/template_formulir_simple.docx** - Template formulir siap pakai dengan placeholder
2. **app/template_id_card_simple.docx** - Template ID card siap pakai dengan placeholder

### Template Asli Anda
1. **app/Formulir Pendaftaran Calang.docx** - Template asli formulir
2. **app/ID CARD.docx** - Template asli ID card

## Cara Menggunakan Template Asli Anda

### Langkah 1: Edit Template Asli
1. Buka file `app/Formulir Pendaftaran Calang.docx` dengan Microsoft Word
2. Ganti data statis dengan placeholder berikut:

#### Placeholder untuk Formulir Pendaftaran:
```
${nama_lengkap}           - Nama lengkap user
${nama_panggilan}         - Nama panggilan
${tempat_lahir}           - Tempat lahir
${tanggal_lahir}          - Tanggal lahir (format: 15 Maret 2002)
${tempat_tanggal_lahir}   - Tempat, tanggal lahir (format: Banjarmasin, 15 Maret 2002)
${jenis_kelamin}          - Jenis kelamin
${alamat}                 - Alamat lengkap
${no_telp}                - Nomor telepon
${agama}                  - Agama
${program_studi}          - Program studi
${gol_darah}              - Golongan darah
${penyakit}               - Penyakit (atau "Tidak ada")
${nama_ayah}              - Nama ayah
${nama_ibu}               - Nama ibu
${alamat_orangtua}        - Alamat orangtua
${no_telp_orangtua}       - Nomor telepon orangtua
${pekerjaan_ayah}         - Pekerjaan ayah
${pekerjaan_ibu}          - Pekerjaan ibu
${tanggal_daftar}         - Tanggal pendaftaran
${angkatan}               - Angkatan
${status}                 - Status pendaftaran
${foto}                   - Placeholder untuk foto
```

### Langkah 2: Edit Template ID Card
1. Buka file `app/ID CARD.docx` dengan Microsoft Word
2. Ganti data statis dengan placeholder berikut:

#### Placeholder untuk ID Card:
```
${nama_lengkap}     - Nama lengkap
${nama_panggilan}   - Nama panggilan
${program_studi}    - Program studi
${angkatan}         - Angkatan
${jenis_kelamin}    - Jenis kelamin
${gol_darah}        - Golongan darah
${no_telp}          - Nomor telepon
${status}           - Status (CALON ANGGOTA)
${tanggal_terbit}   - Tanggal terbit ID card
${tahun}            - Tahun terbit
${foto}             - Placeholder untuk foto
```

### Langkah 3: Update Controller (Opsional)
Jika Anda ingin menggunakan template asli yang sudah diedit, ubah path di `app/Controllers/Daftar.php`:

```php
// Untuk formulir (line ~167)
$templatePath = ROOTPATH . 'app/Formulir Pendaftaran Calang.docx';

// Untuk ID card (line ~299) 
$templatePath = ROOTPATH . 'app/ID CARD.docx';
```

## Cara Kerja Sistem

### 1. Pendaftaran User
- User mengisi form pendaftaran dan upload foto
- Data disimpan ke database
- Sistem otomatis generate 2 dokumen:
  - Formulir pendaftaran lengkap dengan foto
  - ID card sementara dengan foto

### 2. Proses Auto-Fill
- Sistem membaca template DOCX
- Mengganti semua placeholder dengan data user
- Mengintegrasikan foto user ke dokumen
- Menyimpan dokumen final di `public/uploads/documents/`

### 3. Download
- User dapat langsung download kedua dokumen
- Format nama file: `formulir_pendaftaran_[nama]_[timestamp].docx`
- Format nama file: `id_card_[nama]_[timestamp].docx`

## Testing yang Sudah Dilakukan

### Test 1: Tanpa Foto
```bash
php test_document_generation.php
```
✅ Berhasil generate formulir dan ID card tanpa foto

### Test 2: Dengan Foto
```bash
php test_with_photo.php
```
✅ Berhasil generate formulir dan ID card dengan foto terintegrasi

### Test Results
- File formulir: ~8-11KB (tanpa/dengan foto)
- File ID card: ~7-10KB (tanpa/dengan foto)
- Foto terintegrasi dengan ukuran yang sesuai
- Semua data terisi otomatis

## Troubleshooting

### Jika Template Tidak Bisa Dibaca
1. Pastikan file template dalam format .docx (bukan .doc)
2. Pastikan template tidak password-protected
3. Pastikan file tidak corrupt

### Jika Placeholder Tidak Diganti
1. Pastikan placeholder menggunakan format `${variabel}` persis
2. Tidak ada spasi di dalam kurung kurawal
3. Variabel name case-sensitive

### Jika Foto Tidak Muncul
1. Pastikan foto dalam format JPG/PNG
2. Pastikan ukuran foto tidak terlalu besar (max 2MB)
3. Pastikan path foto benar di `public/uploads/fotos/`

## File yang Dapat Dihapus (Testing)
```bash
# File testing (dapat dihapus)
rm check_template.php
rm prepare_templates.php  
rm test_document_generation.php
rm test_with_photo.php
rm public/uploads/fotos/dummy_photo.jpg
rm public/uploads/documents/test_*.docx
```

## Kesimpulan

Sistem sudah siap untuk production dengan fitur:
- ✅ Auto-fill formulir pendaftaran lengkap
- ✅ Auto-fill ID card dengan foto
- ✅ Template processor yang robust
- ✅ Error handling yang baik
- ✅ Kompatibel dengan template DOCX yang ada

Untuk menggunakan template asli Anda, cukup edit template dan tambahkan placeholder sesuai panduan di atas.