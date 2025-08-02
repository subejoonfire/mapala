# 🔄 Cara Kerja DOCX Replacement System

## 📋 **Ringkasan**

Sistem sekarang sudah diperbaiki untuk **langsung copy template DOCX yang Anda berikan** dan **mengganti isi yang kosong/titik-titik dengan data user**. Tidak perlu membuat template baru!

## 🔧 **Cara Kerja Sistem**

### **1. Copy Template Asli**
```php
// System akan copy template DOCX yang sudah ada
copy('Formulir Pendaftaran Calang.docx', 'output_file.docx');
copy('ID CARD.docx', 'id_card_output.docx');
```

### **2. Buka dan Edit Konten**
- File DOCX dibuka sebagai ZIP archive
- Konten utama ada di `word/document.xml`
- System membaca dan mengedit XML tersebut

### **3. Replace Data dengan 4 Method**

#### **Method 1: Hapus Titik-titik/Underscore**
```php
// Hapus titik-titik panjang atau underscore
'.....................' → (dihapus)
'_______________' → (dihapus)
```

#### **Method 2: Replace Berdasarkan Label**
```php
// Cari pattern: Label + : + Data Kosong
'Nama Lengkap : [kosong]' → 'Nama Lengkap : John Doe'
'Alamat : [kosong]' → 'Alamat : Jl. Test No. 123'
```

#### **Method 3: Replace Placeholder**
```php
// Ganti placeholder khusus jika ada
'[NAMA_LENGKAP]' → 'John Doe'
'[PROGRAM_STUDI]' → 'Teknologi Informasi'
'TAHUN 2020' → 'TAHUN 2024'
```

#### **Method 4: Clean Up**
```php
// Bersihkan sisa titik-titik
': ......' → ': '
': ______' → ': '
```

## 📄 **Field yang Diganti**

### **Formulir Pendaftaran:**
- ✅ Nama Lengkap
- ✅ Nama Panggilan  
- ✅ Tempat dan Tanggal Lahir
- ✅ Jenis Kelamin
- ✅ Alamat
- ✅ No. Telp/HP
- ✅ Agama
- ✅ Prodi/Jurusan
- ✅ Gol. Darah
- ✅ Penyakit yang diderita
- ✅ Nama Ayah
- ✅ Nama Ibu
- ✅ Alamat Orangtua
- ✅ No. Telp/HP Orangtua
- ✅ Pekerjaan Ayah
- ✅ Pekerjaan Ibu
- ✅ Tahun (2020 → 2024)

### **ID Card:**
- ✅ Nama
- ✅ Gelar/Program Studi
- ✅ Angkatan
- ✅ Tahun (2023 → 2024)
- ✅ Status → "CALON ANGGOTA"

## 🎯 **Hasil yang Diharapkan**

### **Sebelum:**
```
Nama Lengkap    : .......................
Alamat          : .......................
Program Studi   : .......................
```

### **Sesudah:**
```
Nama Lengkap    : John Doe Test
Alamat          : Jl. Test No. 123, Jakarta  
Program Studi   : Teknologi Informasi
```

## 🧪 **Testing**

Untuk test sistem, jalankan:
```bash
php test_docx_replacement.php
```

Script ini akan:
1. ✅ Copy template asli
2. ✅ Replace dengan data dummy
3. ✅ Generate file: `test_formulir_output.docx` dan `test_idcard_output.docx`
4. ✅ Tampilkan hasil analisis

## 🔍 **Troubleshooting**

### **Jika Data Tidak Terganti:**

1. **Cek Format Template**
   - Pastikan ada titik-titik atau underscore setelah label
   - Format: `Label : .......` atau `Label : _______`

2. **Cek Struktur XML**
   ```bash
   # Jalankan untuk analisis
   php analyze_template.php
   ```

3. **Manual Check**
   - Buka template DOCX asli di Microsoft Word
   - Lihat apakah ada field kosong yang bisa diganti

### **Jika Template Rusak:**
- Sistem otomatis fallback ke template sederhana
- File tetap akan ter-generate meskipun template bermasalah

## 🎨 **Kustomisasi**

### **Menambah Field Baru:**
```php
// Di method generateRegistrationDOCX()
$labelReplacements = [
    // Tambahkan pattern baru
    '/(<w:t[^>]*>Field Baru<\/w:t>.*?<w:t[^>]*>:<\/w:t>.*?<w:t[^>]*>)[^<]*(<\/w:t>)/s' => '${1}' . htmlspecialchars($userData['field_baru']) . '${2}',
];
```

### **Mengubah Format Data:**
```php
// Contoh: Format tanggal
date('d F Y', strtotime($userData['tanggal_lahir'])) // 15 Mei 1995
date('d-m-Y', strtotime($userData['tanggal_lahir'])) // 15-05-1995
```

## 📊 **Status Sistem**

| Komponen | Status | Keterangan |
|----------|--------|------------|
| Template Copy | ✅ | Template asli dicopy dengan sempurna |
| XML Processing | ✅ | document.xml berhasil dibaca dan diedit |
| Pattern Matching | ✅ | Multiple pattern untuk akurasi tinggi |
| Data Replacement | ✅ | Semua field form diganti dengan data user |
| Fallback System | ✅ | Backup jika template bermasalah |
| File Generation | ✅ | Output DOCX siap download |

## 🚀 **Cara Penggunaan**

1. **User mengisi form** di `/daftar`
2. **System otomatis:**
   - Copy template DOCX asli
   - Replace data kosong dengan input user
   - Generate file baru dengan nama unique
3. **User download** file DOCX yang sudah terisi
4. **Buka dengan Microsoft Word** untuk melihat hasil

## 💡 **Tips Optimasi**

1. **Template harus memiliki field kosong** (titik-titik atau underscore)
2. **Format konsisten** untuk hasil terbaik
3. **Test dengan data dummy** sebelum production
4. **Backup template asli** sebelum modifikasi

---

**✅ Sistem sudah siap digunakan! Template DOCX Anda akan otomatis terisi dengan data pendaftar.**