-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 7 月 29 日 16:52
-- サーバのバージョン： 10.4.19-MariaDB
-- PHP のバージョン: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `06phpwork`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `approval_table`
--

CREATE TABLE `approval_table` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `doc_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `approval_table`
--

INSERT INTO `approval_table` (`id`, `user_id`, `doc_id`, `created_at`) VALUES
(21, 3, 1, '2021-07-15 23:23:06'),
(22, 3, 2, '2021-07-15 23:23:07'),
(24, 3, 4, '2021-07-15 23:23:09'),
(25, 3, 6, '2021-07-15 23:23:09'),
(26, 3, 7, '2021-07-15 23:23:10'),
(27, 3, 8, '2021-07-15 23:23:11'),
(28, 4, 1, '2021-07-15 23:23:19'),
(29, 4, 2, '2021-07-15 23:23:19'),
(30, 4, 3, '2021-07-15 23:23:20'),
(31, 4, 4, '2021-07-15 23:23:21'),
(32, 4, 6, '2021-07-15 23:23:22'),
(33, 4, 7, '2021-07-15 23:23:23'),
(37, 5, 1, '2021-07-15 23:23:37'),
(38, 5, 2, '2021-07-15 23:23:37'),
(39, 5, 3, '2021-07-15 23:23:38'),
(40, 6, 1, '2021-07-15 23:23:55'),
(41, 6, 2, '2021-07-15 23:23:55'),
(42, 6, 3, '2021-07-15 23:23:57'),
(43, 6, 4, '2021-07-15 23:23:58'),
(70, 1, 1, '2021-07-16 07:01:47'),
(71, 1, 3, '2021-07-16 07:01:48'),
(72, 1, 6, '2021-07-16 07:01:49'),
(73, 1, 7, '2021-07-16 07:01:50'),
(75, 2, 4, '2021-07-16 07:01:59'),
(90, 2, 8, '2021-07-17 02:06:04'),
(109, 1, 11, '2021-07-17 04:50:14'),
(112, 2, 2, '2021-07-25 11:20:01'),
(113, 2, 13, '2021-07-29 22:41:49');

-- --------------------------------------------------------

--
-- テーブルの構造 `document_table`
--

CREATE TABLE `document_table` (
  `id` int(12) NOT NULL,
  `doc_title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_contents` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upfile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(12) NOT NULL,
  `updated_by` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `document_table`
--

INSERT INTO `document_table` (`id`, `doc_title`, `doc_contents`, `upfile`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, '園芸農業総合支援事業の交付決定について', '園芸', NULL, '2021-07-14 23:50:45', '2021-07-29 23:02:41', 2, 2),
(2, '畜産総合対策事業の承認申請について', '畜産', NULL, '2021-07-14 23:51:53', '2021-07-29 22:34:11', 1, 2),
(3, '園芸農業補助金交付要綱の改正について', '園芸', NULL, '2021-07-14 23:56:27', '2021-07-29 22:34:18', 2, 2),
(4, '豚熱の県内発生状況について', '畜産', NULL, '2021-07-15 00:00:56', '2021-07-29 22:34:24', 1, 2),
(6, '農業振興協議会の開催について', '庶務', NULL, '2021-07-15 22:24:05', '2021-07-29 22:34:38', 2, 2),
(8, '産地生産基盤パワーアップ事業計画の提出について', '園芸', NULL, '2021-07-15 22:45:10', '2021-07-29 22:37:14', 1, 2),
(12, '水田協議会臨時職員の雇用について', '水田', NULL, '2021-07-22 02:52:13', '2021-07-29 22:34:53', 2, 2),
(13, '高収益時期作支援事業の受付会について', '園芸', NULL, '2021-07-22 06:57:18', '2021-07-29 22:36:07', 1, 2),
(14, 'スマート農業推進対策事業要望のとりまとめについて', '園芸', NULL, '2021-07-28 23:13:11', '2021-07-29 22:38:07', 2, 2),
(15, '収入保険研修会について', '水田', NULL, '2021-07-28 23:22:10', '2021-07-29 22:37:57', 2, 2),
(16, '水田農業機械補助事業の内示について', '水田', NULL, '2021-07-28 23:22:18', '2021-07-29 22:38:32', 2, 2),
(17, 'test5', 'aa', NULL, '2021-07-28 23:22:22', '2021-07-28 23:22:22', 2, 2),
(18, 'test', 'test', NULL, '2021-07-29 23:24:16', '2021-07-29 23:24:16', 2, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `file_table`
--

CREATE TABLE `file_table` (
  `id` int(12) NOT NULL,
  `doc_id` int(12) NOT NULL,
  `file_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `position`, `password`, `is_admin`, `is_deleted`, `created_at`) VALUES
(1, 'shige', 'Staff', '11', 0, 0, '2021-07-14 23:26:44'),
(2, 'rei', 'SeniorStaff', '22', 0, 0, '2021-07-14 23:27:21'),
(3, 'mika', 'AssistantManager', '33', 0, 0, '2021-07-14 23:29:43'),
(4, 'kimu', 'Manager', '44', 0, 0, '2021-07-14 23:31:53'),
(5, 'tatsu', 'AssistantDirector', '55', 0, 0, '2021-07-14 23:35:59'),
(6, 'hino', 'Director', '66', 0, 0, '2021-07-14 23:36:14'),
(7, 'kuma', 'DeputyDirector', '77', 0, 0, '2021-07-14 23:38:12'),
(8, 'jicho', 'DeputyDirectorGeneral', '88', 0, 0, '2021-07-14 23:40:20'),
(9, 'boo', 'DirectorGeneral', '99', 0, 0, '2021-07-14 23:44:45'),
(10, 'tom', 'Mayer', '00', 0, 0, '2021-07-15 22:34:46'),
(11, 'anonymous', 'Hacker', 'hello!', 0, 0, '2021-07-16 06:35:08'),
(12, '1000', 'test', 'test', 0, 0, '2021-07-22 02:52:41'),
(13, 'test', 'test', 'qq', 0, 0, '2021-07-24 15:38:06');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `approval_table`
--
ALTER TABLE `approval_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `document_table`
--
ALTER TABLE `document_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `file_table`
--
ALTER TABLE `file_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `approval_table`
--
ALTER TABLE `approval_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- テーブルの AUTO_INCREMENT `document_table`
--
ALTER TABLE `document_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `file_table`
--
ALTER TABLE `file_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
