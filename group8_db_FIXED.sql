SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ──────────────────────────────────────────────
--  users
-- ──────────────────────────────────────────────
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id`                     bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`                   varchar(255)        NOT NULL,
  `first_name`             varchar(255)        DEFAULT NULL,
  `last_name`              varchar(255)        DEFAULT NULL,
  `username`               varchar(255)        UNIQUE DEFAULT NULL,
  `email`                  varchar(255)        NOT NULL UNIQUE,
  `email_verified_at`      timestamp           NULL DEFAULT NULL,
  `password`               varchar(255)        NOT NULL,
  `is_admin`               tinyint(1)          NOT NULL DEFAULT 0,
  `department`             varchar(100)        DEFAULT NULL,
  `block`                  varchar(10)         DEFAULT NULL,
  `failed_login_attempts`  tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `locked_until`           timestamp           NULL DEFAULT NULL,
  `remember_token`         varchar(100)        DEFAULT NULL,
  `created_at`             timestamp           NULL DEFAULT NULL,
  `updated_at`             timestamp           NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`,`name`,`first_name`,`last_name`,`username`,`email`,`password`,`is_admin`,`department`,`block`,`failed_login_attempts`,`locked_until`,`created_at`,`updated_at`) VALUES
(1,'Admin',NULL,NULL,'admin','admin@group8.com','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',1,NULL,NULL,0,NULL,NOW(),NOW()),
(2,'Michael Salvado','Michael','Salvado','michael_salvado','michael.salvado@group8.com','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',0,NULL,NULL,0,NULL,NOW(),NOW()),
(3,'Jefril Intima','Jefril','Intima','jefril_intima','jefril.intima@group8.com','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',0,NULL,NULL,0,NULL,NOW(),NOW()),
(4,'Flor Albert Asa','Flor Albert','Asa','flor_asa','flor.asa@group8.com','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',0,NULL,NULL,0,NULL,NOW(),NOW()),
(5,'Leandro Tuyor','Leandro','Tuyor','leandro_tuyor','leandro.tuyor@group8.com','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',0,NULL,NULL,0,NULL,NOW(),NOW()),
(6,'Juster Loreto','Juster','Loreto','juster_loreto','juster.loreto@group8.com','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',0,NULL,NULL,0,NULL,NOW(),NOW()),
(7,'Axel Jay Laride','Axel Jay','Laride','axel_laride','axel.laride@group8.com','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',0,NULL,NULL,0,NULL,NOW(),NOW());

-- ──────────────────────────────────────────────
--  members
-- ──────────────────────────────────────────────
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id`           bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`         varchar(255)        NOT NULL,
  `role`         varchar(255)        NOT NULL,
  `image`        varchar(255)        DEFAULT NULL,
  `bio`          text                NOT NULL,
  `age`          int(11)             NOT NULL,
  `year`         varchar(50)         NOT NULL,
  `email`        varchar(255)        NOT NULL UNIQUE,
  `skills`       json                DEFAULT NULL,
  `member_order` int(11)             NOT NULL DEFAULT 0,
  `created_at`   timestamp           NULL DEFAULT NULL,
  `updated_at`   timestamp           NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `members` (`id`,`name`,`role`,`image`,`bio`,`age`,`year`,`email`,`skills`,`member_order`,`created_at`,`updated_at`) VALUES
(1,'Michael Salvado','TEAM LEADER','michael.jpg','Michael is a full-stack web developer and front-end engineer. He has experience leading teams and managing projects.',22,'3rd Year','michael.salvado@group8.com','["Full-Stack Dev","Team Leadership","Project Mgmt"]',1,NOW(),NOW()),
(2,'Jefril Intima','DEVELOPER','epoy.jpg','Jefril specializes in backend development and systems architecture.',21,'3rd Year','jefril.intima@group8.com','["Backend Dev","Database Design","API Dev"]',2,NOW(),NOW()),
(3,'Flor Albert Asa','DESIGNER','flor.jpg','Flor specializes in UI/UX design and human-computer interaction.',21,'3rd Year','flor.asa@group8.com','["UI/UX Design","Graphic Design","Prototyping"]',3,NOW(),NOW()),
(4,'Leandro Tuyor','DEVELOPER','leandro.jpg','Leandro is passionate about front-end development and creating responsive web applications.',22,'3rd Year','leandro.tuyor@group8.com','["Frontend Dev","React","Responsive Design"]',4,NOW(),NOW()),
(5,'Juster Loreto','TESTER','juster.jpg','Juster specializes in quality assurance and software testing.',21,'3rd Year','juster.loreto@group8.com','["QA Testing","Automation","Bug Tracking"]',5,NOW(),NOW()),
(6,'Axel Jay Laride','DOCUMENTATION','axel.jpg','Axel handles technical documentation and project management.',21,'3rd Year','axel.laride@group8.com','["Technical Writing","Documentation","Coordination"]',6,NOW(),NOW());

-- ──────────────────────────────────────────────
--  password_reset_codes  (OTP reset system)
-- ──────────────────────────────────────────────
DROP TABLE IF EXISTS `password_reset_codes`;
CREATE TABLE `password_reset_codes` (
  `id`         bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email`      varchar(255)        NOT NULL,
  `code`       varchar(255)        NOT NULL,
  `used`       tinyint(1)          NOT NULL DEFAULT 0,
  `expires_at` timestamp           NOT NULL,
  `created_at` timestamp           NULL DEFAULT NULL,
  `updated_at` timestamp           NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `password_reset_codes_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────
--  cache / sessions / jobs (Laravel internals)
-- ──────────────────────────────────────────────
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key`        varchar(255) NOT NULL,
  `value`      mediumtext   NOT NULL,
  `expiration` int(11)      NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key`        varchar(255) NOT NULL,
  `owner`      varchar(255) NOT NULL,
  `expiration` int(11)      NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id`            varchar(255) NOT NULL,
  `user_id`       bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address`    varchar(45)  DEFAULT NULL,
  `user_agent`    text         DEFAULT NULL,
  `payload`       longtext     NOT NULL,
  `last_activity` int(11)      NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id`           bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue`        varchar(255)        NOT NULL,
  `payload`      longtext            NOT NULL,
  `attempts`     tinyint(3) UNSIGNED NOT NULL,
  `reserved_at`  int(10) UNSIGNED    DEFAULT NULL,
  `available_at` int(10) UNSIGNED    NOT NULL,
  `created_at`   int(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id`             varchar(255) NOT NULL,
  `name`           varchar(255) NOT NULL,
  `total_jobs`     int(11)      NOT NULL,
  `pending_jobs`   int(11)      NOT NULL,
  `failed_jobs`    int(11)      NOT NULL,
  `failed_job_ids` longtext     NOT NULL,
  `options`        mediumtext   DEFAULT NULL,
  `cancelled_at`   int(11)      DEFAULT NULL,
  `created_at`     int(11)      NOT NULL,
  `finished_at`    int(11)      DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id`         bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid`       varchar(255)        NOT NULL UNIQUE,
  `connection` text                NOT NULL,
  `queue`      text                NOT NULL,
  `payload`    longtext            NOT NULL,
  `exception`  longtext            NOT NULL,
  `failed_at`  timestamp           NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email`      varchar(255) NOT NULL,
  `token`      varchar(255) NOT NULL,
  `created_at` timestamp    NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
