SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `password_reset_tokens`;
DROP TABLE IF EXISTS `failed_jobs`;
DROP TABLE IF EXISTS `job_batches`;
DROP TABLE IF EXISTS `jobs`;
DROP TABLE IF EXISTS `cache_locks`;
DROP TABLE IF EXISTS `cache`;
DROP TABLE IF EXISTS `members`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `department` varchar(100) DEFAULT NULL,
  `block` varchar(10) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`name`, `email`, `is_admin`, `password`, `created_at`, `updated_at`) VALUES
('Admin', 'admin@group8.com', 1, '$2y$12$o/wsOF.XY20Pqq13Ha2LXO5hPnBsF.62bV6ovgCl3Qp2tTowptK/W', NOW(), NOW()),
('Michael Salvado', 'michael.salvado@group8.com', 0, '$2y$12$G1iO5V30NBaOtS8NakTqO.h0oHCQW28YTqXSDQHehGus8qfK8chXe', NOW(), NOW()),
('Jefril Intima', 'jefril.intima@group8.com', 0, '$2y$12$beyR3Lxq44XZKFrK4WL.B.vkv4yKPllhd2KGuZB23gLz4i2GFFq9i', NOW(), NOW()),
('Flor Albert Asa', 'flor.asa@group8.com', 0, '$2y$12$Z/2rFeFCCsqH16Y7ihXSN.8p7SiG2yog7jQ6ro96oavl.6Ejb5Y8u', NOW(), NOW()),
('Leandro Tuyor', 'leandro.tuyor@group8.com', 0, '$2y$12$NDIFGKjjF4jiHgKTBwPz6OHaZJiwE3kXquA4tgHTOR/JJHL7PpcFe', NOW(), NOW()),
('Juster Loreto', 'juster.loreto@group8.com', 0, '$2y$12$mH5g0zANdt8RKMSPUPptgOoWIuXcq4Y6Q8f6tclKZ1m/xCsZuoW6e', NOW(), NOW()),
('Axel Jay Laride', 'axel.laride@group8.com', 0, '$2y$12$43Mn4YDvS3W688ojjNgeOOJ9AUXQ0DxeNJxavAhzuNAsN4uKm6n8C', NOW(), NOW());

CREATE TABLE `members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bio` text NOT NULL,
  `age` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `member_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `members` (`name`, `role`, `image`, `bio`, `age`, `year`, `email`, `skills`, `member_order`, `created_at`, `updated_at`) VALUES
('Michael Salvado', 'TEAM LEADER', 'michael.jpg', 'Michael is a full-stack web developer and front-end engineer. He has experience leading teams and managing projects.', 22, '3rd Year', 'michael.salvado@group8.com', '["Full-Stack Dev","Team Leadership","Project Mgmt"]', 1, NOW(), NOW()),
('Jefril Intima', 'DEVELOPER', 'epoy.jpg', 'Jefril specializes in backend development and systems architecture.', 21, '3rd Year', 'jefril.intima@group8.com', '["Backend Dev","Database Design","API Dev"]', 2, NOW(), NOW()),
('Flor Albert Asa', 'DESIGNER', 'flor.jpg', 'Flor specializes in UI/UX design and human-computer interaction.', 21, '3rd Year', 'flor.asa@group8.com', '["UI/UX Design","Graphic Design","Prototyping"]', 3, NOW(), NOW()),
('Leandro Tuyor', 'DEVELOPER', 'leandro.jpg', 'Leandro is passionate about front-end development and creating responsive web applications.', 22, '3rd Year', 'leandro.tuyor@group8.com', '["Frontend Dev","React","Responsive Design"]', 4, NOW(), NOW()),
('Juster Loreto', 'TESTER', 'juster.jpg', 'Juster specializes in quality assurance and software testing.', 21, '3rd Year', 'juster.loreto@group8.com', '["QA Testing","Automation","Bug Tracking"]', 5, NOW(), NOW()),
('Axel Jay Laride', 'DOCUMENTATION', 'axel.jpg', 'Axel handles technical documentation and project management.', 21, '3rd Year', 'axel.laride@group8.com', '["Technical Writing","Documentation","Coordination"]', 6, NOW(), NOW());

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2026_03_13_091352_add_is_admin_to_users_table', 1),
('2026_03_13_120215_create_members_table', 1),
('2026_03_21_000000_add_profile_fields_to_users_table', 1);

SET FOREIGN_KEY_CHECKS = 1;