-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2025 at 02:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dompet`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_23_011535_add_timestamps_to_transactions', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` mediumint NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Bank Mini'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cjU5BltxrKAsIq4P3BBns2SoaUI7mpst7CKaDriH', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT1dqa2NJaXNpbjhmNVFTaVRXZjhsbHJyWTk2MlpGNGx0NlpuV1c3biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1740190628),
('W4PhSV8N7awGImNuNtC1I8UuRmd4eyBFQSqGr6qy', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWjRLSHc4WVZNeldEWjNTbWVOUm94NzdUMTVnNmNTb2dLYm5BY05uMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93YWxsZXQvYXBwcm92YWxzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1737692602);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` enum('top_up','tunai','transfer') DEFAULT NULL,
  `saldo` decimal(15,2) NOT NULL DEFAULT '0.00',
  `recipient_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('Approved','Rejected','Pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `type`, `saldo`, `recipient_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 4, 'top_up', '10000.00', NULL, 'Approved', '2025-01-22 18:20:01', '2025-01-22 18:22:48'),
(3, 4, 'top_up', '20000.00', NULL, 'Approved', '2025-01-22 18:20:17', '2025-01-22 18:22:50'),
(4, 4, 'tunai', '420000.00', NULL, 'Approved', '2025-01-22 18:25:33', '2025-01-22 18:26:24'),
(5, 4, 'top_up', '3000000.00', NULL, 'Approved', '2025-01-22 18:29:44', '2025-01-22 18:31:58'),
(6, 4, 'top_up', '100000.00', NULL, 'Rejected', '2025-01-22 18:36:35', '2025-01-22 18:37:22'),
(7, 4, 'transfer', '200000.00', 1, 'Approved', '2025-01-22 18:56:38', '2025-01-22 18:56:38'),
(8, 4, 'tunai', '3000000.00', NULL, 'Approved', '2025-01-22 18:56:49', '2025-01-22 18:56:49'),
(9, 4, 'transfer', '1200000.00', 1, 'Approved', '2025-01-22 19:03:46', '2025-01-22 19:03:46'),
(10, 4, 'tunai', '1800000.00', NULL, 'Approved', '2025-01-22 19:03:54', '2025-01-22 19:03:54'),
(11, 4, 'top_up', '99999999.00', NULL, 'Approved', '2025-01-22 19:06:06', '2025-01-22 19:06:16'),
(12, 4, 'transfer', '999999.00', 1, 'Approved', '2025-01-22 19:06:42', '2025-01-22 19:06:42'),
(13, 4, 'tunai', '9000000.00', NULL, 'Approved', '2025-01-22 19:39:38', '2025-01-22 19:39:38'),
(14, 4, 'top_up', '10000000.00', NULL, 'Approved', '2025-01-22 19:39:57', '2025-01-22 19:40:43'),
(15, 4, 'tunai', '50000000.00', NULL, 'Approved', '2025-01-22 19:42:47', '2025-01-22 19:42:47'),
(16, 4, 'transfer', '5000.00', 4, 'Approved', '2025-01-22 19:50:03', '2025-01-22 19:50:03'),
(17, 4, 'transfer', '3000000.00', 1, 'Approved', '2025-01-22 19:50:16', '2025-01-22 19:50:16'),
(18, 4, 'top_up', '999999999.00', NULL, 'Approved', '2025-01-22 19:51:15', '2025-01-22 19:51:32'),
(19, 4, 'tunai', '1046999999.00', NULL, 'Approved', '2025-01-22 19:52:05', '2025-01-22 19:52:05'),
(20, 4, 'top_up', '500000.00', NULL, 'Approved', '2025-01-22 20:05:40', '2025-01-22 20:06:10'),
(21, 4, 'tunai', '250000.00', NULL, 'Approved', '2025-01-22 20:13:11', '2025-01-22 20:13:11'),
(22, 4, 'top_up', '100000000000.00', NULL, 'Approved', '2025-01-22 20:13:55', '2025-01-22 20:14:16'),
(23, 4, 'tunai', '250000.00', NULL, 'Approved', '2025-01-22 20:17:27', '2025-01-22 20:17:27'),
(24, 4, 'transfer', '100000000.00', 1, 'Approved', '2025-01-22 20:37:01', '2025-01-22 20:37:01'),
(25, 4, 'top_up', '73278312832.00', NULL, 'Rejected', '2025-01-22 20:39:51', '2025-01-22 20:40:07'),
(26, 3, 'top_up', '8000000.00', NULL, 'Approved', '2025-01-23 19:20:35', '2025-01-23 19:20:35'),
(27, 4, 'tunai', '9000000.00', NULL, 'Approved', '2025-01-23 19:21:55', '2025-01-23 19:21:55'),
(28, 4, 'top_up', '290000.00', NULL, 'Approved', '2025-01-23 19:52:49', '2025-01-23 19:52:49'),
(29, 3, 'tunai', '9000000.00', NULL, 'Approved', '2025-01-23 19:55:47', '2025-01-23 19:55:47'),
(30, 1, 'top_up', '800000.00', NULL, 'Approved', '2025-01-23 19:56:24', '2025-01-23 19:56:24'),
(31, 8, 'top_up', '10000000.00', NULL, 'Approved', '2025-01-23 19:56:51', '2025-01-23 19:56:51'),
(32, 8, 'tunai', '5000000.00', NULL, 'Approved', '2025-01-23 19:57:32', '2025-01-23 19:57:32'),
(33, 8, 'top_up', '6000000.00', NULL, 'Approved', '2025-01-23 19:58:10', '2025-01-23 20:05:27'),
(34, 4, 'tunai', '99891290000.00', NULL, 'Approved', '2025-01-23 20:21:33', '2025-01-23 20:21:33'),
(35, 4, 'top_up', '10000000000.00', NULL, 'Approved', '2025-01-23 20:32:06', '2025-01-23 20:32:15'),
(36, 4, 'transfer', '1000.00', 8, 'Approved', '2025-01-23 20:33:12', '2025-01-23 20:33:12'),
(37, 4, 'transfer', '1.00', 4, 'Approved', '2025-01-23 20:33:31', '2025-01-23 20:33:31'),
(38, 8, 'tunai', '1000000.00', NULL, 'Approved', '2025-01-23 20:50:55', '2025-01-23 20:50:55'),
(39, 1, 'top_up', '89000.00', NULL, 'Approved', '2025-01-23 20:53:59', '2025-01-23 20:53:59'),
(40, 8, 'transfer', '100000.00', 4, 'Approved', '2025-01-23 21:11:49', '2025-01-23 21:11:49'),
(41, 8, 'tunai', '901000.00', NULL, 'Approved', '2025-01-23 21:12:55', '2025-01-23 21:12:55'),
(42, 8, 'top_up', '1000000.00', NULL, 'Approved', '2025-01-23 21:13:00', '2025-01-23 21:23:22'),
(43, 4, 'tunai', '99000.00', NULL, 'Approved', '2025-01-23 21:16:58', '2025-01-23 21:16:58'),
(44, 4, 'transfer', '5000000.00', 8, 'Approved', '2025-01-23 21:17:08', '2025-01-23 21:17:08'),
(45, 4, 'transfer', '5000000.00', 8, 'Approved', '2025-01-23 21:17:19', '2025-01-23 21:17:19'),
(46, 8, 'top_up', '100000000000.00', NULL, 'Approved', '2025-01-23 21:22:50', '2025-01-23 21:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` mediumint NOT NULL DEFAULT '0',
  `saldo` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `saldo`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2025-01-19 20:09:33', '$2y$12$/yAwfSeEtNdYJVBKEHr6QO9pUlwYkA1amJakwOFD.LZojVe0r62Qm', NULL, 1, '106288999.00', '2025-01-19 20:09:34', '2025-01-23 20:53:59'),
(3, 'Faris', 'faris@gmail.com', NULL, '$2y$12$UWqI8zxVVXj9SsLuvOgCaerde9oBMWiZWntwSdHLTQiC3qCT0Ve9a', NULL, 2, '0.00', '2025-01-20 18:53:08', '2025-01-23 20:50:37'),
(4, 'Kun Faris Al-Malik', 'login@login.login', NULL, '$2y$12$eOmhS5nh8AndF5Gz6G5Pn.qa6SSVMVX4hXcjG0Cd2O0NCv3ZGxpbW', NULL, 3, '9990000000.00', '2025-01-20 18:53:35', '2025-01-23 21:17:19'),
(8, 'Rio', 'rio@gmail.com', NULL, '$2y$12$.i6Ar2rHpW4Ppeb8lrfoaOrsYKY3UI4D8uUgI1jLVoMDUck467VOW', NULL, 3, '100020000000.00', '2025-01-23 19:53:49', '2025-01-23 21:23:22'),
(9, 'ADMIN!!!', 'add@add.com', NULL, '$2y$12$t5WGGKx2gMNcLfHecrvRAeRCAzF8LdHqWL7Jr1TQyW/YPxAIXxwnO', NULL, 1, '0.00', '2025-01-23 20:36:53', '2025-01-23 20:36:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__users` (`user_id`),
  ADD KEY `FK_transactions_users` (`recipient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `FK_users_roles1` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_transactions_users` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
