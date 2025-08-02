-- Setup Database untuk Form Pendaftaran MAPALA Politala

-- Drop table jika sudah ada
DROP TABLE IF EXISTS `users`;

-- Buat table users dengan struktur baru
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_panggilan` varchar(50) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `program_studi` varchar(50) NOT NULL,
  `gol_darah` enum('A','B','AB','O') NOT NULL,
  `penyakit` text DEFAULT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `alamat_orangtua` text NOT NULL,
  `no_telp_orangtua` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `angkatan` int(4) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Buat table divisi jika belum ada
CREATE TABLE IF NOT EXISTS `divisi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Buat table kegiatan jika belum ada
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  `tanggal` date NOT NULL,
  `tempat` varchar(200) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Buat table settings jika belum ada
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default settings
INSERT INTO `settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('whatsapp_group_link', 'https://chat.whatsapp.com/example', NOW(), NOW()),
('whatsapp_group_name', 'MAPALA Politala Official', NOW(), NOW())
ON DUPLICATE KEY UPDATE 
  `updated_at` = NOW();

-- Buat table admins jika belum ada
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin (password: admin123)
INSERT INTO `admins` (`username`, `password`, `nama`, `email`, `created_at`, `updated_at`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@mapala.com', NOW(), NOW())
ON DUPLICATE KEY UPDATE 
  `updated_at` = NOW();

COMMIT;