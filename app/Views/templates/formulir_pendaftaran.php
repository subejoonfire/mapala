<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran MAPALA Politala</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e5e7eb;
        }
        .download-section {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 8px;
        }
        .download-btn {
            display: inline-block;
            background-color: #0ea5e9;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .download-btn:hover {
            background-color: #0284c7;
        }
        .form-section {
            margin-bottom: 25px;
        }
        .form-section h3 {
            color: #1f2937;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        .form-group {
            flex: 1;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #374151;
        }
        .form-group .value {
            padding: 8px 12px;
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            min-height: 20px;
        }
        .photo-section {
            text-align: center;
            margin: 20px 0;
        }
        .photo-section img {
            max-width: 200px;
            max-height: 200px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
        }
        @media print {
            .download-section {
                display: none;
            }
            body {
                background-color: white;
            }
            .container {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Download Section -->
        <div class="download-section">
            <h2 style="margin: 0 0 15px 0; color: #0c4a6e;">Download Dokumen</h2>
            <p style="margin: 0 0 20px 0; color: #0369a1;">Klik tombol di bawah untuk mengunduh formulir pendaftaran dalam format PDF</p>
            <a href="/daftar/formulir/pdf" class="download-btn">
                📄 Download PDF Formulir Pendaftaran
            </a>
        </div>

        <!-- Header -->
        <div class="header">
            <h1 style="color: #1f2937; margin: 0;">FORMULIR PENDAFTARAN</h1>
            <h2 style="color: #0ea5e9; margin: 10px 0;">MAPALA POLITALA</h2>
            <p style="color: #6b7280; margin: 0;">Tahun Angkatan <?= date('Y') ?></p>
        </div>

        <!-- Data Pribadi -->
        <div class="form-section">
            <h3>A. DATA PRIBADI</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Lengkap:</label>
                    <div class="value"><?= $userData['nama_lengkap'] ?? '-' ?></div>
                </div>
                <div class="form-group">
                    <label>Nama Panggilan:</label>
                    <div class="value"><?= $userData['nama_panggilan'] ?? '-' ?></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Tempat Lahir:</label>
                    <div class="value"><?= $userData['tempat_lahir'] ?? '-' ?></div>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir:</label>
                    <div class="value"><?= $userData['tanggal_lahir'] ? date('d/m/Y', strtotime($userData['tanggal_lahir'])) : '-' ?></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Jenis Kelamin:</label>
                    <div class="value"><?= $userData['jenis_kelamin'] ?? '-' ?></div>
                </div>
                <div class="form-group">
                    <label>Golongan Darah:</label>
                    <div class="value"><?= $userData['gol_darah'] ?? '-' ?></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Agama:</label>
                    <div class="value"><?= $userData['agama'] ?? '-' ?></div>
                </div>
                <div class="form-group">
                    <label>Program Studi:</label>
                    <div class="value"><?= $userData['program_studi'] ?? '-' ?></div>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <div class="value"><?= $userData['alamat'] ?? '-' ?></div>
            </div>
            <div class="form-group">
                <label>No. Telepon:</label>
                <div class="value"><?= $userData['no_telp'] ?? '-' ?></div>
            </div>
            <div class="form-group">
                <label>Riwayat Penyakit (jika ada):</label>
                <div class="value"><?= $userData['penyakit'] ?: 'Tidak ada' ?></div>
            </div>
        </div>

        <!-- Data Orang Tua -->
        <div class="form-section">
            <h3>B. DATA ORANG TUA</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Ayah:</label>
                    <div class="value"><?= $userData['nama_ayah'] ?? '-' ?></div>
                </div>
                <div class="form-group">
                    <label>Pekerjaan Ayah:</label>
                    <div class="value"><?= $userData['pekerjaan_ayah'] ?? '-' ?></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Ibu:</label>
                    <div class="value"><?= $userData['nama_ibu'] ?? '-' ?></div>
                </div>
                <div class="form-group">
                    <label>Pekerjaan Ibu:</label>
                    <div class="value"><?= $userData['pekerjaan_ibu'] ?? '-' ?></div>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat Orang Tua:</label>
                <div class="value"><?= $userData['alamat_orangtua'] ?? '-' ?></div>
            </div>
            <div class="form-group">
                <label>No. Telepon Orang Tua:</label>
                <div class="value"><?= $userData['no_telp_orangtua'] ?? '-' ?></div>
            </div>
        </div>

        <!-- Foto -->
        <?php if (!empty($userData['foto'])): ?>
        <div class="form-section">
            <h3>C. FOTO</h3>
            <div class="photo-section">
                <img src="/uploads/fotos/<?= $userData['foto'] ?>" alt="Foto Pendaftar" onerror="this.style.display='none'">
            </div>
        </div>
        <?php endif; ?>

        <!-- Tanda Tangan -->
        <div class="form-section">
            <h3>D. TANDA TANGAN</h3>
            <div style="margin-top: 50px; text-align: center;">
                <div style="border-bottom: 1px solid #000; width: 200px; margin: 0 auto;"></div>
                <p style="margin-top: 5px; color: #6b7280;">Tanda Tangan Pendaftar</p>
            </div>
        </div>

        <!-- Footer -->
        <div style="margin-top: 40px; text-align: center; color: #6b7280; font-size: 12px;">
            <p>Dokumen ini dibuat secara otomatis pada <?= date('d/m/Y H:i') ?></p>
            <p>MAPALA Politala - Politeknik Negeri Tanah Laut</p>
        </div>
    </div>
</body>
</html>