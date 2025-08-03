<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Calon Anggota Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }

        .container {
            background-color: white;
            padding: 30px;
            border: 1px solid #ccc;
            position: relative;
            width: 700px;
            /* A4 width on 96dpi screen */
            height: 1000px;
            /* A4 height on 96dpi screen */
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            height: 80%;
            background-image: url('<?= base_url('template_docx/formulir_pendaftaran/logo_kanan.png') ?>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
        }

        /* Header Section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .logo-left img,
        .logo-right img {
            width: 80px;
            height: auto;
        }

        .title-section {
            text-align: center;
            flex-grow: 1;
        }

        .title-section h1 {
            font-size: 14px;
            margin: 0;
        }

        .title-section h2 {
            font-size: 12px;
            margin: 5px 0 0;
            font-weight: normal;
        }

        /* Main Form Content */
        .form-content {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            position: relative;
            z-index: 2;
        }

        .fields-left {
            flex: 1;
            width: 60%;
        }

        .fields-right {
            width: 40%;
            display: flex;
            justify-content: flex-end;
        }

        .form-row {
            display: flex;
            align-items: flex-end;
            margin-bottom: 10px;
        }

        .form-row label {
            width: 150px;
            white-space: nowrap;
            padding-right: 5px;
        }

        .dotted-line {
            flex-grow: 1;
            border-bottom: 1px dotted #000;
            padding-left: 5px;
        }

        .photo-box {
            width: 120px;
            height: 160px;
            border: 1px solid #000;
            text-align: center;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 10px;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 40px;
            text-align: right;
            position: relative;
            z-index: 2;
        }

        .signature-section p {
            margin: 5px 0;
        }

        /* Aturan untuk cetak PDF */
        @media print {
            body {
                background-color: white;
            }

            .container {
                border: none;
                box-shadow: none;
                padding: 0;
                /* Mengatur ukuran kertas A4 secara presisi */
                width: 210mm;
                min-height: 297mm;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="watermark"></div>

        <div class="header">
            <div class="logo-left">
                <img src="<?= base_url('template_docx/formulir_pendaftaran/logo_kiri.png') ?>" alt="Logo Politala">
            </div>
            <div class="title-section">
                <h1>FORMULIR PENDAFTARAN CALON ANGGOTA BARU</h1>
                <h2>MAPALA POLITALA TAHUN <?= $userData['angkatan'] ?></h2>
            </div>
            <div class="logo-right">
                <img src="<?= base_url('template_docx/formulir_pendaftaran/logo_kanan.png') ?>" alt="Logo Mapala">
            </div>
        </div>

        <div class="form-content">
            <div class="fields-left">
                <div class="form-row">
                    <label>Nama Lengkap</label>
                    <span class="dotted-line"><?= $userData['nama_lengkap'] ?></span>
                </div>
                <div class="form-row">
                    <label>Nama Panggilan</label>
                    <span class="dotted-line"><?= $userData['nama_panggilan'] ?></span>
                </div>
                <div class="form-row">
                    <label>Tempat dan Tanggal Lahir</label>
                    <span class="dotted-line"><?= $userData['tempat_lahir'] . ', ' . date('d F Y', strtotime($userData['tanggal_lahir'])) ?></span>
                </div>
                <div class="form-row">
                    <label>Jenis Kelamin</label>
                    <span class="dotted-line"><?= $userData['jenis_kelamin'] ?></span>
                </div>
                <div class="form-row">
                    <label>Alamat</label>
                    <span class="dotted-line"><?= $userData['alamat'] ?></span>
                </div>
                <div class="form-row">
                    <label>No. Telp/HP</label>
                    <span class="dotted-line"><?= $userData['no_telp'] ?></span>
                </div>
                <div class="form-row">
                    <label>Agama</label>
                    <span class="dotted-line"><?= $userData['agama'] ?></span>
                </div>
                <div class="form-row">
                    <label>Prodi / Jurusan</label>
                    <span class="dotted-line"><?= $userData['program_studi'] ?></span>
                </div>
                <div class="form-row">
                    <label>Gol. Darah</label>
                    <span class="dotted-line"><?= $userData['gol_darah'] ?></span>
                </div>
                <div class="form-row">
                    <label>Penyakit yang diderita</label>
                    <span class="dotted-line"><?= $userData['penyakit'] ?: 'Tidak ada' ?></span>
                </div>
                <div class="form-row">
                    <label>Nama Orangtua</label>
                    <span class="dotted-line"></span>
                </div>
                <div class="form-row">
                    <label>Ayah</label>
                    <span class="dotted-line"><?= $userData['nama_ayah'] ?></span>
                </div>
                <div class="form-row">
                    <label>Ibu</label>
                    <span class="dotted-line"><?= $userData['nama_ibu'] ?></span>
                </div>
                <div class="form-row">
                    <label>Alamat Orangtua</label>
                    <span class="dotted-line"><?= $userData['alamat_orangtua'] ?></span>
                </div>
                <div class="form-row">
                    <label>No. Telp/HP Orangtua</label>
                    <span class="dotted-line"><?= $userData['no_telp_orangtua'] ?></span>
                </div>
                <div class="form-row">
                    <label>Pekerjaan Orangtua</label>
                    <span class="dotted-line"><?= $userData['pekerjaan_ayah'] . ' / ' . $userData['pekerjaan_ibu'] ?></span>
                </div>
            </div>

            <div class="fields-right">
                <div class="photo-box">
                    <?php if (!empty($userData['foto'])): ?>
                        <img src="<?= base_url('public/uploads/fotos/' . $userData['foto']) ?>" alt="Foto">
                    <?php else: ?>
                        <span>Pas Foto</span>
                        <span>3x4 Warna</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="signature-section">
            <p>Pelaihari, <?= date('d F Y') ?></p>
            <p>Hormat saya,</p>
            <br><br><br>
            <p>(<?= $userData['nama_lengkap'] ?>)</p>
        </div>
    </div>
</body>

</html>