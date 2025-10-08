-- Create tugas table
CREATE TABLE IF NOT EXISTS `tugas` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `pasal` varchar(255) NOT NULL,
    `isi` text NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Create fungsi table
CREATE TABLE IF NOT EXISTS `fungsi` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `isi` text NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Tabel tugas dan fungsi akan kosong, data akan diisi melalui fitur edit
