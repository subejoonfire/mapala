<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .card-container {
            padding: 10px;
            border: 2px solid black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Ukuran ini untuk meniru kartu ID standar */
            width: 250px;
            height: 380px;
        }

        .card {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            padding: 10px;
            box-sizing: border-box;
            /* Logo sebagai background */
            background-image: url('<?= base_url('mapala.png') ?>');
            /* Ganti dengan nama file logo Anda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.8;
            /* Menyamarkan logo agar teks lebih jelas */
        }

        .card-header h3,
        .card-header h1,
        .card-header h2 {
            margin: 0;
            font-weight: bold;
        }

        .card-header h3 {
            font-size: 14px;
        }

        .card-header h1 {
            font-size: 20px;
        }

        .card-header h2 {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .photo-placeholder {
            width: 60px;
            height: 75px;
            border: 1px solid #000;
            margin: 5px auto;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 8px;
            color: #666;
            position: relative;
            overflow: hidden;
        }

        .photo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: none;
        }

        .card-body {
            margin-top: 15px;
            text-align: left;
        }

        .info-row {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .info-row .label {
            width: 80px;
        }

        .info-row .colon {
            margin-right: 5px;
        }

        .info-row .value {
            flex: 1;
        }

        .card-footer {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            font-size: 10px;
            font-style: italic;
            padding: 0 10px;
        }
    </style>
</head>

<body>
    <div class="card-container">
        <div class="card">
            <div class="card-header">
                <h3>LATIHAN DASAR XV</h3>
                <h1>MAPALA POLITALA</h1>
                <h2>TAHUN <?= $userData['angkatan'] ?></h2>
            </div>
            <div class="photo-placeholder">
                <?php if (!empty($userData['foto'])): ?>
                    <img src="<?= base_url('uploads/fotos/' . $userData['foto']) ?>" alt="Foto">
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <span class="label">Nama</span>
                    <span class="colon">:</span>
                    <span class="value"><?= $userData['nama_lengkap'] ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Gelar</span>
                    <span class="colon">:</span>
                    <span class="value"><?= $userData['program_studi'] ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Angkatan</span>
                    <span class="colon">:</span>
                    <span class="value"><?= $userData['angkatan'] ?></span>
                </div>
            </div>
            <div class="card-footer">
                <p>"Meningkatkan Jiwa Mentalisme, Totalitas Dan<br>Loyalitas Dalam Berorganisasi"</p>
            </div>
        </div>
    </div>
</body>

</html>