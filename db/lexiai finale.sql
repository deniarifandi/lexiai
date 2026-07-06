-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jul 2026 pada 05.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lexiai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `reading_answers`
--

CREATE TABLE `reading_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attempt_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer` text DEFAULT NULL,
  `ai_score` decimal(5,2) DEFAULT NULL,
  `comprehension_score` decimal(5,2) DEFAULT NULL,
  `grammar_score` decimal(5,2) DEFAULT NULL,
  `vocabulary_score` decimal(5,2) DEFAULT NULL,
  `ai_feedback` longtext DEFAULT NULL,
  `suggestion` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reading_attempts`
--

CREATE TABLE `reading_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) DEFAULT 'in_progress',
  `started_at` datetime NOT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `total_score` decimal(5,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reading_materials`
--

CREATE TABLE `reading_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `level` enum('beginner','intermediate','advanced') NOT NULL DEFAULT 'beginner',
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `estimated_minutes` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reading_materials`
--

INSERT INTO `reading_materials` (`id`, `title`, `topic`, `level`, `content`, `image`, `estimated_minutes`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Sustainable Agriculturef', 'Sustainable agriculture', 'beginner', 'Agriculture plays a vital role in providing food, raw materials, and employment for millions of people around the world. Modern farmers use both traditional knowledge and new technologies to improve crop production while protecting natural resources. Good agricultural practices include selecting high-quality seeds, applying fertilizers at the correct rate, managing irrigation efficiently, and controlling pests through environmentally friendly methods.\r\n\r\nSoil health is one of the most important factors in successful farming. Healthy soil contains organic matter, nutrients, microorganisms, and enough moisture to support plant growth. Farmers can improve soil quality by adding compost, practicing crop rotation, and reducing excessive tillage. These methods help maintain soil fertility, prevent erosion, and increase long-term productivity.\r\n\r\nSustainable agriculture aims to meet current food needs without harming the environment or reducing the ability of future generations to produce food. By conserving water, protecting biodiversity, and using resources efficiently, farmers can achieve higher yields while minimizing environmental impacts. Sustainable farming benefits not only farmers but also consumers and ecosystems.', NULL, 10, 1, '2026-07-05 13:12:38', '2026-07-05 13:12:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reading_questions`
--

CREATE TABLE `reading_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `reference_answer` text NOT NULL,
  `keywords` text DEFAULT NULL,
  `order_number` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reading_questions`
--

INSERT INTO `reading_questions` (`id`, `material_id`, `question`, `reference_answer`, `keywords`, `order_number`, `created_at`, `updated_at`) VALUES
(6, 6, 'What is the main role of agriculture?', 'To provide food, raw materials, and employment.', 'Sustainable Farming', 1, '2026-07-05 13:13:09', '2026-07-05 13:13:09'),
(7, 6, 'What do modern farmers use to improve crop production?', 'Traditional knowledge and new technologies.', 'Sustainable Farming', 2, '2026-07-05 13:13:34', '2026-07-05 13:15:13'),
(8, 6, 'Name one good agricultural practice mentioned in the text.', 'Any one of these: selecting high-quality seeds, applying fertilizers correctly, efficient irrigation, or environmentally friendly pest management.', '', 3, '2026-07-05 13:13:52', '2026-07-05 13:15:35'),
(9, 6, 'Why is soil health important?', 'Because it supports successful plant growth and farming.', '', 4, '2026-07-05 13:15:58', '2026-07-05 13:15:58'),
(10, 6, 'What does healthy soil contain?', 'Organic matter, nutrients, microorganisms, and moisture.', '', 5, '2026-07-05 13:16:27', '2026-07-05 13:16:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `is_active`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'deni arifandi', 'deni@polbangtan.ac.id', 'user', '$2y$10$rw7cwpRBtKq8TZxkKVc5feQ5AAqIVv9Kddp.Ge3eBeRnG2QBOpSpC', 1, '2026-07-06 02:47:21', '2026-07-04 01:28:27', '2026-07-06 02:47:21', NULL),
(3, 'admin pol', 'admin@polbangtan.ac.id', 'admin', '$2y$10$rw7cwpRBtKq8TZxkKVc5feQ5AAqIVv9Kddp.Ge3eBeRnG2QBOpSpC', 1, '2026-07-05 13:11:51', '2026-07-04 01:28:27', '2026-07-05 13:11:51', NULL),
(6, 'iir', 'iirbro8@gmail.com', NULL, '$2y$10$BG/q9KfUJ1gFZEPX6WeKouZVvy/8vAW1qtez.dwfNEzcTPM6.O39q', 1, '2026-07-05 09:51:27', '2026-07-05 08:06:28', '2026-07-05 09:51:27', NULL),
(7, 'ichi', 'ichi@gmail.com', NULL, '$2y$10$gW8Ayj6wUGFClXeLE1tTLuwwDAZ1H.30i1C3JqZhwuELgPysOkps6', 1, '2026-07-05 10:18:13', '2026-07-05 10:18:01', '2026-07-05 10:18:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_remember_tokens`
--

CREATE TABLE `user_remember_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `selector` char(24) NOT NULL,
  `token_hash` char(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `reading_answers`
--
ALTER TABLE `reading_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indeks untuk tabel `reading_attempts`
--
ALTER TABLE `reading_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indeks untuk tabel `reading_materials`
--
ALTER TABLE `reading_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reading_questions`
--
ALTER TABLE `reading_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reading_material` (`material_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `user_remember_tokens`
--
ALTER TABLE `user_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `reading_answers`
--
ALTER TABLE `reading_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reading_attempts`
--
ALTER TABLE `reading_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reading_materials`
--
ALTER TABLE `reading_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `reading_questions`
--
ALTER TABLE `reading_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_remember_tokens`
--
ALTER TABLE `user_remember_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `reading_answers`
--
ALTER TABLE `reading_answers`
  ADD CONSTRAINT `reading_answers_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `reading_attempts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reading_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `reading_questions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reading_attempts`
--
ALTER TABLE `reading_attempts`
  ADD CONSTRAINT `reading_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reading_attempts_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `reading_materials` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reading_questions`
--
ALTER TABLE `reading_questions`
  ADD CONSTRAINT `fk_reading_material` FOREIGN KEY (`material_id`) REFERENCES `reading_materials` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_remember_tokens`
--
ALTER TABLE `user_remember_tokens`
  ADD CONSTRAINT `fk_remember_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
