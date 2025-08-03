<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card MAPALA Politala</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .download-section {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f0fdf4;
            border: 1px solid #16a34a;
            border-radius: 8px;
        }
        .download-btn {
            display: inline-block;
            background-color: #16a34a;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .download-btn:hover {
            background-color: #15803d;
        }
        .id-card {
            border: 3px solid #16a34a;
            border-radius: 15px;
            padding: 30px;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            position: relative;
            overflow: hidden;
        }
        .id-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(22, 163, 74, 0.1);
            border-radius: 50%;
            z-index: 1;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background-color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .title {
            color: #16a34a;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .subtitle {
            color: #374151;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .photo-section {
            text-align: center;
            margin: 20px 0;
            position: relative;
            z-index: 2;
        }
        .photo {
            width: 120px;
            height: 150px;
            border: 3px solid #16a34a;
            border-radius: 10px;
            object-fit: cover;
            background-color: #f9fafb;
        }
        .info-section {
            margin: 20px 0;
            position: relative;
            z-index: 2;
        }
        .info-row {
            display: flex;
            margin-bottom: 12px;
            align-items: center;
        }
        .info-label {
            width: 120px;
            font-weight: bold;
            color: #374151;
            font-size: 14px;
        }
        .info-value {
            flex: 1;
            color: #1f2937;
            font-size: 14px;
            padding: 5px 10px;
            background-color: white;
            border-radius: 5px;
            border: 1px solid #d1d5db;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            position: relative;
            z-index: 2;
        }
        .validity {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .signature {
            border-top: 1px solid #16a34a;
            padding-top: 10px;
            color: #374151;
            font-size: 12px;
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
            <h2 style="margin: 0 0 15px 0; color: #166534;">Download ID Card</h2>
            <p style="margin: 0 0 20px 0; color: #15803d;">Klik tombol di bawah untuk mengunduh ID Card dalam format PDF</p>
            <a href="/daftar/idcard/pdf" class="download-btn">
                🆔 Download PDF ID Card
            </a>
        </div>

        <!-- ID Card -->
        <div class="id-card">
            <!-- Header -->
            <div class="header">
                <div class="logo">M</div>
                <h1 class="title">MAPALA POLITALA</h1>
                <p class="subtitle">Politeknik Negeri Tanah Laut</p>
            </div>

            <!-- Photo -->
            <div class="photo-section">
                <?php if (!empty($userData['foto'])): ?>
                    <img src="/uploads/fotos/<?= $userData['foto'] ?>" alt="Foto" class="photo" onerror="this.style.display='none'">
                <?php else: ?>
                    <div class="photo" style="display: flex; align-items: center; justify-content: center; color: #6b7280; font-size: 12px;">
                        <div style="text-align: center;">
                            <div style="font-size: 24px; margin-bottom: 5px;">📷</div>
                            <div>Foto</div>
                            <div>3x4</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Information -->
            <div class="info-section">
                <div class="info-row">
                    <div class="info-label">Nama:</div>
                    <div class="info-value"><?= $userData['nama_lengkap'] ?? '-' ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Panggilan:</div>
                    <div class="info-value"><?= $userData['nama_panggilan'] ?? '-' ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Program Studi:</div>
                    <div class="info-value"><?= $userData['program_studi'] ?? '-' ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Angkatan:</div>
                    <div class="info-value"><?= $userData['angkatan'] ?? date('Y') ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. Telepon:</div>
                    <div class="info-value"><?= $userData['no_telp'] ?? '-' ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Gol. Darah:</div>
                    <div class="info-value"><?= $userData['gol_darah'] ?? '-' ?></div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="validity">
                    Berlaku sampai: <?= date('d/m/Y', strtotime('+1 year')) ?>
                </div>
                <div class="signature">
                    <div style="border-bottom: 1px solid #16a34a; width: 150px; margin: 0 auto 5px;"></div>
                    <div>Ketua MAPALA Politala</div>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div style="margin-top: 20px; text-align: center; color: #6b7280; font-size: 12px;">
            <p>ID Card ini dibuat secara otomatis pada <?= date('d/m/Y H:i') ?></p>
            <p>Status: <span style="color: #f59e0b; font-weight: bold;">PENDING VERIFIKASI</span></p>
        </div>
    </div>
</body>
</html>