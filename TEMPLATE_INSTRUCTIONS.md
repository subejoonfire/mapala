# Instruksi Template DOCX MAPALA Politala

## Overview

Sistem pendaftaran MAPALA Politala sekarang menggunakan template DOCX yang sudah ada untuk menghasilkan dokumen yang konsisten dengan format yang diinginkan.

## Template yang Digunakan

### 1. Formulir Pendaftaran
- **File**: `app/Templates/formulir_pendaftaran_template.docx`
- **Asal**: `Formulir Pendaftaran Calang.docx`
- **Fungsi**: Template untuk formulir pendaftaran anggota baru

### 2. ID Card
- **File**: `app/Templates/id_card_template.docx`
- **Asal**: `ID CARD.docx`
- **Fungsi**: Template untuk kartu identitas anggota

## Cara Menggunakan Template

### 1. Menyiapkan Template

1. **Buka template di Microsoft Word atau LibreOffice**
2. **Ganti teks sampel dengan placeholder**:
   - Ganti "Nama Lengkap" dengan `${nama_lengkap}`
   - Ganti "Tempat Lahir" dengan `${tempat_lahir}`
   - Ganti "Tanggal Lahir" dengan `${tanggal_lahir}`
   - Dan seterusnya

### 2. Placeholder yang Tersedia

#### Formulir Pendaftaran:
```
${nama_lengkap}          - Nama lengkap pendaftar
${nama_panggilan}        - Nama panggilan
${tempat_lahir}          - Tempat lahir
${tanggal_lahir}         - Tanggal lahir (format: dd F Y)
${jenis_kelamin}         - Jenis kelamin (Laki-laki/Perempuan)
${alamat}                - Alamat lengkap
${no_telp}               - Nomor telepon
${agama}                 - Agama
${program_studi}         - Program studi
${gol_darah}             - Golongan darah
${penyakit}              - Penyakit yang diderita
${nama_ayah}             - Nama ayah
${nama_ibu}              - Nama ibu
${alamat_orangtua}       - Alamat orangtua
${no_telp_orangtua}      - Nomor telepon orangtua
${pekerjaan_ayah}        - Pekerjaan ayah
${pekerjaan_ibu}         - Pekerjaan ibu
${tanggal_dibuat}        - Tanggal dokumen dibuat
${status}                - Status pendaftaran
```

#### ID Card:
```
${nama_lengkap}          - Nama lengkap
${nama_panggilan}        - Nama panggilan
${program_studi}         - Program studi
${angkatan}              - Angkatan
${jenis_kelamin}         - Jenis kelamin
${tempat_lahir}          - Tempat lahir
${tanggal_lahir}         - Tanggal lahir
${alamat}                - Alamat
${no_telp}               - Nomor telepon
${agama}                 - Agama
${gol_darah}             - Golongan darah
${penyakit}              - Penyakit
${nama_ayah}             - Nama ayah
${nama_ibu}              - Nama ibu
${alamat_orangtua}       - Alamat orangtua
${no_telp_orangtua}      - Nomor telepon orangtua
${pekerjaan_ayah}        - Pekerjaan ayah
${pekerjaan_ibu}         - Pekerjaan ibu
${tanggal_dibuat}        - Tanggal dibuat
${status}                - Status (CALON ANGGOTA)
```

### 3. Contoh Penggunaan Placeholder

#### Di Template Formulir Pendaftaran:
```
Nama Lengkap: ${nama_lengkap}
Tempat Lahir: ${tempat_lahir}
Tanggal Lahir: ${tanggal_lahir}
Jenis Kelamin: ${jenis_kelamin}
Alamat: ${alamat}
No. Telp: ${no_telp}
Agama: ${agama}
Program Studi: ${program_studi}
Golongan Darah: ${gol_darah}
Penyakit: ${penyakit}

DATA ORANGTUA:
Nama Ayah: ${nama_ayah}
Nama Ibu: ${nama_ibu}
Alamat Orangtua: ${alamat_orangtua}
No. Telp Orangtua: ${no_telp_orangtua}
Pekerjaan Ayah: ${pekerjaan_ayah}
Pekerjaan Ibu: ${pekerjaan_ibu}

Tanggal Dibuat: ${tanggal_dibuat}
Status: ${status}
```

#### Di Template ID Card:
```
MAPALA POLITALA
Mahasiswa Pecinta Alam
Politeknik Negeri Tanah Laut

Nama: ${nama_lengkap}
Nama Panggilan: ${nama_panggilan}
Program Studi: ${program_studi}
Angkatan: ${angkatan}
Status: ${status}

Tanggal Diterbitkan: ${tanggal_dibuat}
```

## Cara Menyimpan Template

1. **Simpan template dengan format .docx**
2. **Pastikan placeholder menggunakan format `${nama_field}`**
3. **Jangan gunakan spasi atau karakter khusus dalam nama placeholder**
4. **Simpan di direktori `app/Templates/`**

## Testing Template

### 1. Jalankan script checker:
```bash
php check_templates.php
```

### 2. Test pendaftaran:
1. Buka halaman pendaftaran
2. Isi form dengan data lengkap
3. Submit form
4. Download dokumen yang dihasilkan
5. Periksa apakah format sesuai dengan template

## Troubleshooting

### Template tidak ditemukan:
- Pastikan file template ada di `app/Templates/`
- Periksa permission file (harus readable)

### Placeholder tidak terganti:
- Pastikan format placeholder benar: `${nama_field}`
- Periksa apakah nama field sesuai dengan yang ada di controller

### Dokumen kosong:
- Pastikan template tidak kosong
- Periksa apakah ada error di log

### Format tidak sesuai:
- Buka template asli dan bandingkan dengan yang dihasilkan
- Pastikan semua placeholder sudah diganti dengan benar

## File yang Terlibat

1. **Template Files**:
   - `app/Templates/formulir_pendaftaran_template.docx`
   - `app/Templates/id_card_template.docx`

2. **Controller**:
   - `app/Controllers/Daftar.php` (method `generateRegistrationDOCX` dan `generateIdCardDOCX`)

3. **Scripts**:
   - `check_templates.php` - Script untuk mengecek template

## Keuntungan Menggunakan Template

1. **Konsistensi**: Semua dokumen akan memiliki format yang sama
2. **Fleksibilitas**: Mudah mengubah format tanpa mengubah kode
3. **Profesional**: Dokumen terlihat lebih profesional
4. **Maintainable**: Mudah untuk maintenance dan update

## Catatan Penting

- Template harus disimpan dalam format .docx
- Placeholder harus menggunakan format yang benar
- Pastikan template tidak rusak atau corrupt
- Backup template asli sebelum melakukan perubahan
- Test template setelah setiap perubahan