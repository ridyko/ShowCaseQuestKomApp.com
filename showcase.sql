-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 03 Bulan Mei 2026 pada 00.57
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `showcase`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL COMMENT 'Used as subdomain: slug.showcase.test',
  `tagline` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL COMMENT 'Rich content/documentation',
  `logo` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `demo_url` varchar(255) DEFAULT NULL,
  `source_url` varchar(255) DEFAULT NULL,
  `documentation_url` varchar(255) DEFAULT NULL,
  `tech_stack` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of technologies used' CHECK (json_valid(`tech_stack`)),
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of key features' CHECK (json_valid(`features`)),
  `version` varchar(255) NOT NULL DEFAULT '1.0.0',
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `category_id`, `name`, `slug`, `tagline`, `description`, `content`, `logo`, `cover_image`, `demo_url`, `source_url`, `documentation_url`, `tech_stack`, `features`, `version`, `status`, `is_featured`, `sort_order`, `view_count`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Buku Tamu Digital', 'bukutamu', 'Sistem manajemen tamu digital modern untuk instansi', 'Aplikasi Buku Tamu Digital adalah solusi modern untuk mengelola kunjungan tamu di kantor, sekolah, dan instansi pemerintah. Dilengkapi dengan fitur QR Code check-in, digital signature, notifikasi WhatsApp real-time, dan dashboard analitik yang komprehensif.', '## Fitur Utama\n\n- ✅ Check-in tamu via QR Code\n- ✅ Tanda tangan digital\n- ✅ Notifikasi WhatsApp real-time\n- ✅ Dashboard analitik\n- ✅ Export laporan PDF & Excel\n- ✅ Multi-tenant / White Label\n- ✅ Role-based access control\n\n## Teknologi\n\nDibangun dengan Laravel 11 dan PHP 8.3, menggunakan arsitektur MVC yang bersih dan terstruktur.\n\n## Instalasi\n\n```bash\ncomposer install\nphp artisan migrate --seed\nphp artisan serve\n```', NULL, NULL, NULL, NULL, NULL, '[\"Laravel 11\",\"PHP 8.3\",\"MySQL\",\"Bootstrap 5\",\"Chart.js\",\"QR Code\",\"WhatsApp API\"]', '[\"QR Check-in\",\"Digital Signature\",\"WhatsApp Notifications\",\"PDF Reports\",\"Excel Export\",\"Multi-tenant\",\"Activity Log\"]', '2.1.0', 'published', 1, 0, 1250, '2026-04-02 18:08:22', '2026-05-02 18:08:22', '2026-05-02 18:08:22', NULL),
(2, 1, 2, 'E-Cuti Application', 'e-cuti', 'Sistem pengajuan dan manajemen cuti pegawai online', 'E-Cuti adalah aplikasi manajemen cuti pegawai berbasis web yang memudahkan proses pengajuan, persetujuan, dan tracking cuti secara digital. Mendukung berbagai jenis cuti, hierarki persetujuan, dan pelaporan otomatis.', '## Tentang E-Cuti\n\nSistem manajemen cuti yang efisien untuk organisasi modern.\n\n## Fitur\n\n- 📋 Pengajuan cuti online\n- ✅ Approval bertingkat\n- 📊 Dashboard rekapitulasi\n- 📱 Responsive design\n- 🔔 Notifikasi email\n- 📄 Export rekapitulasi Excel', NULL, NULL, NULL, NULL, NULL, '[\"Laravel 11\",\"PHP 8.3\",\"MySQL\",\"AdminLTE\",\"DataTables\",\"SweetAlert2\"]', '[\"Online Leave Request\",\"Multi-level Approval\",\"Leave Balance Tracking\",\"Report Generation\",\"Email Notifications\",\"Role Management\"]', '1.5.0', 'published', 1, 1, 890, '2026-04-12 18:08:22', '2026-05-02 18:08:22', '2026-05-02 18:08:22', NULL),
(3, 1, 2, 'Evakin Performance', 'evakin', 'Evaluasi kinerja pegawai berbasis SKP dan capaian target', 'Evakin adalah sistem evaluasi kinerja pegawai yang mengacu pada standar SKP (Sasaran Kerja Pegawai). Mendukung input target, realisasi, dan perhitungan otomatis nilai kinerja dengan dashboard analitik.', '## Evakin - Evaluasi Kinerja\n\nSistem evaluasi kinerja pegawai berbasis web.\n\n## Fitur Utama\n\n- 🎯 Input target SKP\n- 📊 Tracking realisasi\n- 📈 Perhitungan otomatis\n- 📋 Laporan periodik\n- 👥 Penilaian 360°', NULL, NULL, NULL, NULL, NULL, '[\"Laravel 11\",\"PHP 8.3\",\"MySQL\",\"Bootstrap 5\",\"Chart.js\",\"DomPDF\"]', '[\"SKP Management\",\"Target Tracking\",\"Auto Calculation\",\"Periodic Reports\",\"Performance Dashboard\",\"360\\u00b0 Assessment\"]', '1.2.0', 'published', 1, 2, 675, '2026-04-17 18:08:22', '2026-05-02 18:08:22', '2026-05-02 18:08:22', NULL),
(4, 2, 2, 'Harwat Sarpras', 'harwat-sarpras', 'Sistem pemeliharaan sarana dan prasarana digital', 'Harwat Sarpras adalah aplikasi manajemen pemeliharaan sarana dan prasarana yang mencakup inventaris aset, work order, dan helpdesk maintenance. Dilengkapi dengan QR Code tracking dan dashboard monitoring.', '## Harwat Sarpras\n\nSistem pemeliharaan sarana dan prasarana terpadu.\n\n## Modul\n\n- 🏢 Inventaris Aset\n- 🔧 Work Order\n- 📱 QR Code Tracking\n- 🎫 Helpdesk\n- 📊 Dashboard Monitoring', NULL, NULL, NULL, NULL, NULL, '[\"Laravel 12\",\"PHP 8.2\",\"MySQL\",\"Tailwind CSS\",\"Alpine.js\",\"QR Code\"]', '[\"Asset Inventory\",\"Work Orders\",\"QR Tracking\",\"Helpdesk System\",\"Maintenance Schedule\",\"Report Generation\"]', '1.0.0', 'published', 0, 3, 340, '2026-04-27 18:08:22', '2026-05-02 18:08:22', '2026-05-02 18:08:22', NULL),
(5, 2, 6, 'WhatsApp Gateway', 'wa-gateway', 'API Gateway untuk integrasi pesan WhatsApp', 'WhatsApp Gateway API service yang memungkinkan aplikasi mengirim pesan WhatsApp secara otomatis. Mendukung multi-device, template messages, dan webhook integration.', '## WA Gateway\n\nRESTful API untuk integrasi WhatsApp.\n\n## Endpoints\n\n- POST /api/send-message\n- POST /api/send-template\n- GET /api/status\n- POST /api/webhook', NULL, NULL, NULL, NULL, NULL, '[\"Node.js\",\"Express\",\"Baileys\",\"MySQL\",\"Socket.io\"]', '[\"Send Messages\",\"Template Messages\",\"Multi-device\",\"Webhook\",\"Message Queue\",\"Rate Limiting\"]', '2.0.0', 'published', 0, 4, 520, '2026-04-22 18:08:22', '2026-05-02 18:08:22', '2026-05-02 18:08:22', NULL),
(6, 1, 1, 'Koperasi Online', 'koperasi', 'Sistem informasi koperasi simpan pinjam', 'Aplikasi koperasi simpan pinjam online yang mengelola anggota, simpanan, pinjaman, dan angsuran secara digital dengan laporan keuangan otomatis.', '## Koperasi Online\n\nSistem informasi koperasi simpan pinjam.\n\n## Fitur\n\n- 👥 Manajemen Anggota\n- 💰 Simpanan\n- 💳 Pinjaman\n- 📊 Laporan Keuangan', NULL, NULL, NULL, NULL, NULL, '[\"Laravel 10\",\"PHP 8.1\",\"MySQL\",\"Bootstrap 4\",\"jQuery\",\"DataTables\"]', '[\"Member Management\",\"Savings\",\"Loans\",\"Installments\",\"Financial Reports\",\"Interest Calculation\"]', '1.0.0', 'draft', 0, 5, 0, NULL, '2026-05-02 18:08:22', '2026-05-02 18:08:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_visits`
--

CREATE TABLE `app_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `device_type` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#6366f1',
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `color`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Web Application', 'web-application', 'fa-globe', '#6366f1', 'Aplikasi web berbasis browser', 0, 1, '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(2, 'Management System', 'management-system', 'fa-building', '#8b5cf6', 'Sistem manajemen dan administrasi', 1, 1, '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(3, 'E-Learning', 'e-learning', 'fa-graduation-cap', '#06b6d4', 'Platform pembelajaran digital', 2, 1, '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(4, 'IoT & Hardware', 'iot-hardware', 'fa-microchip', '#10b981', 'Proyek Internet of Things dan perangkat keras', 3, 1, '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(5, 'Mobile App', 'mobile-app', 'fa-mobile-alt', '#f59e0b', 'Aplikasi mobile Android/iOS', 4, 1, '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(6, 'API Service', 'api-service', 'fa-code', '#ef4444', 'RESTful API dan microservices', 5, 1, '2026-05-02 18:08:22', '2026-05-02 18:08:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_03_000001_create_categories_table', 1),
(5, '2026_05_03_000002_create_applications_table', 1),
(6, '2026_05_03_000003_create_screenshots_table', 1),
(7, '2026_05_03_000004_create_app_visits_table', 1),
(8, '2026_05_03_000005_create_settings_table', 1),
(9, '2026_05_03_000006_add_role_to_users_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `screenshots`
--

CREATE TABLE `screenshots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3h6hmUE2OI6rL7ewdYOSorRH2CH7Tbt3mXU9ULqK', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUxjdlRta0tVVnlNemh5bmRVWXM3RTJOdXU3MDJETnVGTndraFJYYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745514),
('3RfwByGivyyCgVuwrK0JvkBpJ8Xf7VG3MduJcISm', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGtDUElIMFd2SFFERUpwUlBNelZkWTZmRURlQjhOMk5OS05rZXVqViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746587),
('3SDNXtrs3Ejn8sWcBx7MOhkctV1vTlvQXLVKxsAC', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVRtSWVsNURNbkNBTVhVNU1tM3hTUWNackx6NVBidGpsTHZUc0FOViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760392),
('3ul9vmepcge1riL0z6WtU6Q21KKrbP3UoF1QLtAS', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDZWN1JMcDBEVlVMRTNnaVJMVzVUdjR4UGpWU05Yc2lYU0tSTFF0eSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746459),
('4nShdkxQF4BEoMfaahPHMuqfwW0bhajZmxdvSVeW', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkRLeHBoQmJYNXhzNTByNkU0dkZoUnI2TTRwS281amk4SjJNTUdiYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746031),
('4Ya53KiKM7Ddd33I5IBhyKKyJfYwz7CltM3yix4Z', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiOGd6U215N0Vxekl2SVZ5Wk00UGlncTdLVEpDeDQ4SXpTVm1WZHF0byI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760462),
('533XaChBw4MxV9uxj6xy4tQzIhfn25dnW2wOoDlk', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiem85R3B3RkE1OGk0d1hOdFdZVlpadmtmVm9DcVRVYzN3M0tKQXRMaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777758539),
('5HkRjObwNzkFR7fvGBuW0z9CdxBmKTQtBZC8lVy3', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkZyZkpPN212aUFldFQyZXBSVWI4WkNRZkdzY05kSUtYS1JFTHlIUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760293),
('63JxurgUL1El0c2JC2G1OJaxGnApIB27UTVjXiEg', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEFRcXI3NG1Ud0psYVRHeXNBbG01Qkd6SFZkQTRjTzNyaDhxbThuRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL3JlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746778),
('69u2ouZPEA7vn3gI45YpPIyvnGXGY6sIgoCEHTnL', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOWR5SmRLM2hmVm4xSDBvMW9UU0hTRjh1N3djVG5hWExFeHZEYW1PcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745642),
('6S8UrPYOugwrWDM8ByajdZYmuDUOrnkbu5wiZgwu', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFFDdzB0OHhmcjB3enB5dDY4dWVGek5wYXE5WlFlcHB3RnpKMlAyaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745729),
('6YBIavFxSwh37jPooVWuZeONREL2OztiebLIDt6D', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGI0SHVkT2xyc05RTndMTGE5U1JDODFyaExudXV2ZnBvSGZEbU1weCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777756805),
('91A9rCqPhWs4psHiWWkxvC0D5m2D8ikVmiOVl2BF', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDU1bjRabHU3Y1QxWGVRNHpXWFlBRDdDYkFmSFprRXF6MTFqQnpXMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745645),
('9IPnNaTs0nlszYF4V1BS8TO98aIr0sVVye0sHMf2', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkdFSmw1VW1qYkVyQm9LTmIxR3VKQnNjYmhFNm5qdFdWVGhuc1ZvZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760393),
('9vl5fxSFVqcF1apdl8akSA1R6HDPkVXXPhH4RhKy', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiT1piYzZ2S3puSU12Vll2bUNpVFZKcG90TlRpNXZKdzE5MzQyZ0EwNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777756310),
('9yjTButyWxMC4hnNx1grJR13YGGo39KIxGKqIoCv', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHhWUUFhcldQWWdLRHB1MGNOZWlIQTVtS3Z5dWxaNXRmc2JkYm9lMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777756529),
('a1LldWpvIDoqgynJTHGPeVKoZnXBFjXhjyMQSHAW', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQk9FNmJRTW4xekRGYnh6d0N1ekMxZndpVkc1eXJ2UFRDM2xyZFpKUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746833),
('A2Kw0FfK50ZOXKv4nbZODC02icsdHbwmWYnxfYeA', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibE90bm5Qelp2Vm1qbzdhRTRtaHg1blNhd0J3VnBlbVliTUNCZ0V5TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746430),
('avvCLxMSSV3bEsdn9SKDJbosLLYXZPvsEpunLDUN', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVdZYTQzZHZtQzRhd1plY3g3SzNnaDA1NTNzVnk1ODZzc2c5dG83YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746996),
('bSoXs6zn4khIIiEHQF6y2ADXHoZRiV2Wlo8ysVIX', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjRhWkJZVUlha2ZYaGtMbThoWDREMFZZdDBVd1ZJODNDNmdmTDNnUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760390),
('bVrr5GwleUA0kBuY2vtoqzyBwbMcgkFXMWFbDFBE', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTzRxNnNuZloxU0JnVU45OGJxRTJzaFpjUjRadms5YTd6NVYwQ3p1NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760380),
('CI3uMvb8UNw6xkib136Afdrn5h0KbBJr7bUlI1PH', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3daWGFwMkUxNmxmNWVFMTdUR3JtQ3RwbDNkNE9nVW5pdW5qOWl2OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745780),
('cvMVwWiVAQ04DsEdBNxZxRLzTOAE1vT0NZI3TbBm', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWVDZ0xvNEdIMFhVUU1DY0c3eWF2SFU2cEd5YVFVSHRCQ09ZMTFveSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759753),
('DDCPCndAF27NA9a47oy067Xky4hHUF9PYDOKGQEK', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTkVtdTdtZjlXbXlCbWMxaWc1VERMc3EyTFluUExibzg3WURlNldiVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777756287),
('ds2PeNz0JoqRwbHtDaOf21yxMYXWoSCQI8DQE8hE', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3RYNFJDTTQ1QXpvQnZrNGJDMGl0ZlR4cHRDemRDQU9DYTRTRGYwayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760392),
('DzqguwqbgLN0TqjI2PYHORqHRgSVpkbvYLFToQG8', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibm5ia3A0aGJJeFB5RDZ4RVpPbTh6blNoRDJ0ZEdNVnFiYVMxNFBONyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760388),
('e2TOeG5wccIRYek1m1VZGsaumZY4w9Ls4CYLxSLf', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicHJVM3pMYmR4RTJaSzFvOWFTbTRzV0pCcFF2eHVSdjBEeEc3ZXRWOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760350),
('EI0lJTqXBJtd5JRdmqInrKkIjg3rxA96xRuIQYZy', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjFXTEtyMnFGTDAxR1ZycmxvN1NZWDhuTUR4WXNMb01oWHpMUXZFSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759848),
('ePSgg8ncHiQZySWpRGnl7DT37J50NP0gWcF6PyEa', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVIxM2RGTVY0MDBtNGluVzZhRmE3dlVSZWZKZGRlSU5qdnJHRk5MMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746177),
('EqVH5Lm5I0jpztM3BAyRxB6apghdiQG6etfTdpxS', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakU4MTBWbVJQRklqSU52ckNqWUpLZDg0VjBObFFHaE42MWhrZlpVUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746099),
('eZuKeHAg50JGujeDWet2lWRZKuKlmTIrIQMCenei', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVZXQzJoVUZwRkpybU1VMERPSWhMbzJTQ2JoOGpXTzVMeGJNMFA0ZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760778),
('F2LKfZVlnkaI1wDcsY2Lyzy6y9awQ5SX2L7J6VTw', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1dLRWJQRGxNTU5xeU5iTDZ4QzdhcU9hdUFGREZSZTROSnJZUHFpSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760391),
('fQxBgjc8IdgSSUATT9IITZlxMfkAQN7uMObwXatA', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3RJMDRLemlrRkFvbjFTWVBpQ1VIQjhSS2daT05pREtPSTBHcHBlQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759881),
('FVd0y0QHiJX2hxW9tmNzEfcuijhRSXQU770XIKZH', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2NRaTFmdlkzdUVBQ1BHQ1ZxZHZvS0ViTkZ0MU42cGx4YkZkZXZRUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777761039),
('g8GzbrlN1V2QNTBrRaTzYZqZclZE5oNG8v8MAQ2D', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2xnbVVSNGRUbUxyd2F0NW5rbzNRVEFKRnR2YkJna3JaYmJKSzFENiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746673),
('gfInjH05URFHP4Xe6bjsFx5S92EGqQjXc8VNMhBw', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclJ4Z1hSaDlSZzBKVk5xZlJZcVJRd2VBNDM4OXhLZ1FrNG5tSldGbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746013),
('GJy3ZAYj73ObxZl58j33FRvEFCeHpCJN020WaQOj', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWhTeGwwY2Y5VWN0dm1ONUFyc3JQeVF6dU1UWDhkazczSEprSzE5QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746098),
('GTDXPt7SLCVG27yJywKRMpbUUuzXZBdwZz5Pqnby', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmtyenRTYXI2NlJpWkNlRTh4cXdFVmllcW9jdW1NdFMwVHJ6OWw0OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777758342),
('gtWAdB7jA0a97Yq0qu5IimwAFKV1euDkYwdICyCa', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYlZIdGZwcVlQNVlBemUyMVIzRXB1d2ZxbW9CeWFwMm5QeWNtMWs5bCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777761103),
('h3pUFQH0lWp6yiFYW9uLKS88sYFFn5grNK1vV8s3', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUZWUDEybm4wR2gzcEZqa0NVQ2hsSXFUTE84TGpUMmF0MVdaeEhSbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL3JlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746018),
('h83z80FCfh8l4QvIOeODaDS7JrnRtMngVHOzGDOc', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia2o3U2hoMXJYdW5UVjFLM1FlYUNLbXZqRzZoYzFudTNOczNsM2RVaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746491),
('HritSVJE3AQYGejJExZqQcZbZH65settH9vXGHSB', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXhxM0dCQ29CRTVtQnhNakU4RW9IUVphOWpMSkh4UmNRRTVsT2hCMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746828),
('HXFysbMBOmtMu4qiU0BpfF8EkYwK1gMKphEKx3GF', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODVUQlZwOGcxRGtIaktMMVJHa1ZNUHlwbGdCV2tSZnR4NGE2NE9JUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745725),
('i6mGGfFHanE4wepu6xdy0y1h2AbdJpVXLaJhTJaL', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkREWGk1M2RDTTR0ZGgyZ0NIN0dCaWNzRjdNejRFWGlaZ1BaTHFmciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777747020),
('IDeSjGody5W34Vv1RL8K4x7FZ7jQ0GJ7SmhBXO6s', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDBFQ0J0TXI1Q2ptV0ZpVk43SHJLdFpuRXhrcUttamNLZ0ZoVUlsUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746185),
('ifVXeAHSWPFlFuCA39MGca0L5LbtWJCj6aMnnoBj', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid25VTGdqUDFvWHJpV2V1WktzMWhwbWhxVHFLdUprbmswUWZXcWRWSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759073),
('j3jVXdyJJpunQunnkih1E5Bw8nPgNqeBqSnyP2nS', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoianJjVUoxTExlQTNoRmZhWXBDSUdxUTM1Y1NDM3lScGk3SFpidmM0bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760387),
('Kkfct76GlSlul9hCOSJ3MFKM2k4mg2ZnvFeqxJLX', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVUwSHFaWTJpZVo2MkN4RUloVnJEb3Jnbm40UmJIU2VwSXBxR2FkcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760152),
('L2dmjQyNi7s45or7mlTc95ghKao8NVift1G3fY9c', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2JrOFVrRUxUR3BCWUQ5YjlNVlRxQ3NVOVFCOXpReXk0YmU5YnFXUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760239),
('L5gpt1Nby6c2YlM8DjHoSGWzz9zWLJ3kTFeABrVK', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1Z4Q01mRllMekprU0dGbVZaQnNQc1N5d3J1S043dEFERE9yOU5TayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746686),
('lugCd3wsdsNwKjb35IFIZM8jVUYbt7Jq8bjNMkL6', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkVKTWFsN3Vta0wzTGZiVnBhN3FjbnBzNGJ2YkVPQnBaNGtZVXVJdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777758386),
('lv5bXAp6DsGfkDcLNnOlkXmf2o0sHI0E0GPvkxKh', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVRURVhMUzVMU0daMVJxWDNWQjdVdDdMS1FYZUxiRHdFRlJOYzRIeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746109),
('mnlR46mDyyPz3WW5slMnkJ6mfKnrM3ukuL77mKJY', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzVkREQ1VjM5a3doeVhmUVd2QXk3eWFHZGxEejEzTloyV2dLZVNYdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746675),
('MptPyetUYdNRcBgUhh95zvnGFJa8MVuBntV1uuRp', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiczRwbTRjVkF6YmxDdjFNNzZ1TmlWOTA5enFWRG5hWXMwdTd5b1lGbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760112),
('na2uTmj1h5i98UyCRbRd3iXtqntUCOMMjaYRqh70', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid3JhemxNSkVrZjZUOERlSDkyTHF3SVJaZW1iZDM4TEY5TWdFbHVuNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760391),
('nM0L5HzD7zKyzl2ujgzaQ25kU3KkCjKLIx2jqF6y', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWpwcHhuWWc0ZldGTjlaR09NUXhjSnIybkNmYUYzdm9zTERkWnVzUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745663),
('nrJ1FKpgV1fOpOrUDyNtLPemuwEcljLF3QgMLQhq', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNG91SDhTSElZaHpobm9zZ3FvM0dNcXhpd0d6Vlowb2lpOVdKeHVSMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746820),
('NSGKyv5BjwPARioak3u0he97syoLiyXfjI2r2TRj', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHJqOFpUNG9nSzVBSmRoNWdsUEszRFE0RDdsSDZqaGxWUWpGUFM5NCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL3JlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746029),
('OF3wdBjo5DXnMn0o6Z3hpITGPFV5rWcSWQxBt1Kt', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWt6MWZWRmRGMEphdTZFQ1hzWEduSmNtMnBMbVhqSVRBcUNjTjNPRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746918),
('ogy75cgH9HXHAjeipqWTutrxcOCef58Cw4Z0dIiR', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXFlcDBCa0Nta09Kdk5qQ3ZUYlVtUHE5NXJSS1JMQWttalRVVjlmbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760393),
('oTLVFjgjqzCle08LImyLCmaZv0lBrZHSD4EBQsk3', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHh4bjBiSnVGWHR4QWxISFFjaDBCRkQ1UkMzWmttMDJvSXVCU0JONiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760391),
('OzAgktGIi4WDU4IHBpu1OpmlXX1c9wemePP7OprY', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2xDMDYwMVc5U0pZbWRKM0N1eExkdElHZGFSNGg5d05QUDNtZlZFYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745427),
('PWAB6CWax53wLOPjGS9FEi8rWbxrHSfRRZ1w9YHq', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWpjZEJONzhiRHZUaDU4eGpXYzZLTTIzb0ZtOXJYTFpYMEs4MVFCbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759065),
('R7JdYGHoRvexBdGrtKHx3lvCvpdqhayvq2TZU6FZ', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1phVkV4Z3FBc3M4dnJlUVE0ckxiZFVOT3BwT2dPcVVYOEVxTExQdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760391),
('ScvVZ8Rk9UZBjJ6E9vq3Izo1IvJUkny0RAEN02va', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHNUTXdEOEtiWWlzUjJhY0ZTQ1hteU1VdHo5dEVnTjhDd0VsMHNjTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777756263),
('SKeBIJy589v2o63bjuednpvH75KLkRbbssGRUWhP', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnVWSjRJaTJVWnNJdlhoTzlocHp4MUlMY0hQbGdndk1TVjhlSEY5NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745878),
('SMMsZAGam7hTxQ9Rfke41WdhEx9Bl0rxCVPGO499', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHZaeU1OU05LU2NhSXRzREFJY2J1bGhRbXA4Z2p6YUpTblhWODNNaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746614),
('SQxV6loyMjQE2jhecvlLRRsH8ws0rKw2q4OBVknC', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3FUa3RQdzNNYzB0R0dzTENCODZXVGpOalJBVjRNR21EYlBXWXdzUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL3JlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745840),
('Suv7m24PAxargeib0N4k4nS0sy4FZHBkvRQ6v4An', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlZpVXlkY0xhUXpZa1ViSnk2Q3J5Qk5rV29vTzM2bGNaVkpqNFl6WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760244),
('T9kby3KMuJ8zYmFHVKAOUGoToW21dZYtVcByoQYm', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYUVXWDNrY1hEUFV3enZPY3FRSUY0TU42T1RLelozNFg1S210ZmZYbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777756556),
('thpC6SbTd6s0JgZzlShlLlfFSESf3X96gM44oYuF', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjZBWDhteDl6dVZkaFhzcW1qa21SQlFlcnhFYkpGWVhlcjRJOUZLYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760361),
('TM9OjnF7loEBTVYVspW1sFsujC1bYNhE46sTyiru', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiek5DQmQzalFuQjNJTFU1UGpwcHRvaExKaDJVcks2c2R3akdDR2N2cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777756815),
('ttZejBQ8HpjPZVPCPNmCopjv3QKoS9Lor6Yt12pH', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejVGblZhME5YdzlPQ3NzVGROSnFSWlY4R3c1Z25zT2JSa011WDhySyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760392),
('TW684TcnwYrnqhrRjXBqAi8IkRS12Y6kzGUOG7j6', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiRlJBT0YzNWk0V3VVQm5WSFlHak5rNzJtRkljenNSR21WRHlIb2h5VyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760325),
('u279lybIviptIvpGhxcOORdPzNNfxcF9An3cER39', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWpQekxpeXUzS2RqbHAxRnV6RW9Kc09aRnNIOHl0NHlqRkR1cjI2eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777747197),
('UuH41NtdEv7ffqGcZhVqqUWQ0BHR9O9sW1RUJFV6', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQ3hrRWJoc3RVWUROSzdSRVJlQ1VUdVFmTWg4NDVPdDRnR1NTVHlwaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760549),
('UYvu1ZgOYXUZZYJi68muIbLJqqkijMp6wpgOzs1b', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGVEOVh6UGNJMVQ3a0RIcmpLT3BBMHVYUm9JejZnOUpPbm5uRmJNMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759812),
('V0diZFilZ4VKwedYAZxh3EoaqWm7a5n4IqnH3HXE', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2twVkxRbUFQcXFxT2RUQktOTm5JWURDQTkxc1B2YjZBQjB5WEFhdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759761),
('vbaULaK4nLK2ZmHdleRpTZhfXlhm6RfERWbfVUv2', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGtJNm5vTFEwTWM5VTE3cGVONG5vVjVvSkNBZ096MW1hbDZxeUh0bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL3JlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746181),
('vBMVSI7RiryZ44rTn4CTxbX9vKJuDUkR8p47MsSM', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiandoUkFCUkIzdzJZd1hCWlU2UFhORk51Z1FjSFFjSzFDdmY4U2NkMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777747130),
('WmLZsTOejIXiXIe8mHByEBVE6mRqUA40KuoKgVmR', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazRDb1BHanVIYTRnUFZwVFFNMFRjUFFRdmttRDZkZ25Hb25GTUxYNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760206),
('wOhxinzPUEu2izZg3YWnUU8nJPEavy31uwdKFxSH', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmVHRFNsWDNzWnNhc2E1S2RYeGZ3cmRib1lvWWY2SDNOZFpwUmc2cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760455),
('wwSKZVBf31jnXhx1Hjo9hDGcSx5rHXj0K0sKBB53', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT1ZEVjNDb1c2aGs1SElaYU1YWTJpOEJLS0xsVDJJbEdHY2tRVmVhdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746111),
('X8UgS9wUBbsAhKmjmIHw9ZvEBMWaiDCK04cYvKe3', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzRKbHpvS3VjZzU1Z3dFTXVJNU1hT05HWEk2VVJ4Tk85Szlra3BlUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777745580),
('XfbG8Tpuk5052kdFc5YqG1ShABLI4uvWCUWirqbo', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGxHQWViWTJ5dHdjZUx4dU84cWRmS0p3QmVHVktjTU1RaTZRTGFxTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760537),
('xXeFNHfbxZeizIckjyR3J6q6fGufm7aVAsAXzSWl', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3FGc0hlY0pWQjdNWllwTVc4WHB6ZWFYS2JlMm9Rck1qWEIzOExmOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746410),
('yb4x336hE2PCfCIA750gdnI1J6LuzsvVZ3Pd5sPm', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUM2YlhOS2dSWkVaWjZOSmRneUs5Ums4RmNzaWtoaEUzNHRhU2t4USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777747051),
('yRDTjXtPNguJTW9QSJh9V5eIbMdiN5nVqbCnYZGT', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU05HWGxONHZRUEwxV1l4THZ3YXY1S2k4aWVBa05oTllPdzVaRVpzbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777758355),
('yVbX1RRsclqHHU4jlGAGXyH2VC2YyEhVqIGThFLF', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkI4alI2SXhZMWJ2Y0FUdUxsb251Q1I5Q0syNmhCZ1VkUEJsVWJYdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL3JlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777746984),
('yxsMjDhC5ixzs5bW8J4cpemJo86K7r6XBu7hIiqL', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEp5M2ZuQkRGYmhHVkxaejh0UWZPcGIzSWExblozT1FzZWI1UmdpcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759075),
('yZbCgeJKWzid9vbTyYGLkLLlmwTXCnW47x2Mvu7q', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidnVoYXl5QlcwRW15N2JaN1dlSmxOeHB2bjVKVGRCU2REeHozZVM4UiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777759863),
('zcqS53CoMEMSyrk4BSliWHGtee40BgummWauMYWg', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEREYVVBRUdSVzBYYnlQcUhRYlN6eUVBWGIzTzV5SG1YS0JpVTlpZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777756231),
('ZH29onHkjmaGU5SDReSECjiPkVmt6lEHA7LJN5lN', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1NmdkNOdTlOYzc0SlNiV2NtVUxtTGJBMmtIcDlDcmxHMnJtWHBwaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760296),
('zWhvRP0HB4C21Xe3YoxVFFZw2NfmJTJ6BzOKtn1h', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1Z5c1pGMDBVUlQySkU1RFVTcHhlTUN6OEV4eVFWdWVVbTZpYnc2SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hvd2Nhc2UvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1777760392);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Showcase Platform', 'general', 'text', 'Nama platform', '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(2, 'site_description', 'Platform portofolio interaktif untuk menampilkan aplikasi-aplikasi terbaik', 'general', 'textarea', 'Deskripsi platform', '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(3, 'site_keywords', 'showcase, portfolio, laravel, php, web development', 'seo', 'text', 'Keywords SEO', '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(4, 'contact_email', 'admin@showcase.test', 'general', 'email', 'Email kontak', '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(5, 'github_url', 'https://github.com', 'social', 'url', 'URL GitHub', '2026-05-02 18:08:22', '2026-05-02 18:08:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@showcase.test', 'admin', NULL, NULL, '$2y$12$JzuTCAlMXf/XXxn.9iFGAeWzGtCw0sMPFuOxonm1LkzjZdvxwfNS.', NULL, '2026-05-02 18:08:22', '2026-05-02 18:08:22'),
(2, 'Developer', 'dev@showcase.test', 'user', NULL, NULL, '$2y$12$7HI3QRx7iYxKM7bGL23s0uH5HMY/v0aptD0XbdvrVhtgVXBNJR9Za', NULL, '2026-05-02 18:08:22', '2026-05-02 18:08:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applications_slug_unique` (`slug`),
  ADD KEY `applications_user_id_foreign` (`user_id`),
  ADD KEY `applications_category_id_foreign` (`category_id`),
  ADD KEY `applications_status_is_featured_index` (`status`,`is_featured`),
  ADD KEY `applications_slug_index` (`slug`);

--
-- Indeks untuk tabel `app_visits`
--
ALTER TABLE `app_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_visits_application_id_created_at_index` (`application_id`,`created_at`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `screenshots`
--
ALTER TABLE `screenshots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screenshots_application_id_foreign` (`application_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `app_visits`
--
ALTER TABLE `app_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `screenshots`
--
ALTER TABLE `screenshots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `app_visits`
--
ALTER TABLE `app_visits`
  ADD CONSTRAINT `app_visits_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `screenshots`
--
ALTER TABLE `screenshots`
  ADD CONSTRAINT `screenshots_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
