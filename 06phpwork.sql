-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 7 月 31 日 03:55
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
(73, 1, 7, '2021-07-16 07:01:50'),
(75, 2, 4, '2021-07-16 07:01:59'),
(90, 2, 8, '2021-07-17 02:06:04'),
(109, 1, 11, '2021-07-17 04:50:14'),
(113, 2, 13, '2021-07-29 22:41:49'),
(115, 1, 1, '2021-07-30 00:02:53'),
(117, 1, 3, '2021-07-30 00:02:56'),
(118, 1, 14, '2021-07-30 00:02:57'),
(119, 1, 15, '2021-07-30 00:02:59'),
(120, 1, 16, '2021-07-30 00:03:01'),
(122, 3, 17, '2021-07-30 20:57:57'),
(123, 3, 12, '2021-07-30 20:58:03'),
(124, 3, 18, '2021-07-30 20:58:09'),
(126, 2, 1, '2021-07-31 09:52:30'),
(129, 1, 12, '2021-07-31 10:14:37'),
(132, 1, 17, '2021-07-31 10:17:05');

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
(1, '園芸農業総合支援事業の交付決定について', '園芸', NULL, '2021-07-14 23:50:45', '2021-07-30 21:06:32', 2, 3),
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
(17, '高収益時期作支援事業のホームページ掲載について', '園芸', NULL, '2021-07-28 23:22:22', '2021-07-30 20:59:03', 2, 3),
(18, '令和3年度畜産農家離脱調査について', '畜産', NULL, '2021-07-29 23:24:16', '2021-07-30 21:02:49', 2, 3),
(19, '乳用牛飼養戸数調査', '畜産', NULL, '2021-07-31 10:00:06', '2021-07-31 10:00:06', 1, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `file_table`
--

CREATE TABLE `file_table` (
  `id` int(12) NOT NULL,
  `doc_id` int(12) NOT NULL,
  `file_name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(140) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_at` datetime NOT NULL,
  `uploaded_by` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `file_table`
--

INSERT INTO `file_table` (`id`, `doc_id`, `file_name`, `file_path`, `caption`, `uploaded_at`, `uploaded_by`) VALUES
(6, 1, 'hisai6.jpg', '../files/2021073102532951c32a4a7d1104b0f5aab1651539d7f1.jpg', '園芸イメージ', '2021-07-31 09:53:29', 2),
(7, 4, 'tonko-33.pdf', '../files/202107310254427fafe2a5870361da22c2c0532fdd3999.pdf', '豚コレラ農水省チラシ', '2021-07-31 09:54:42', 2),
(8, 12, 'tanbo.jpeg', '../files/202107310257399a123634f869a17259ae17313eef69c4.jpeg', '水田イメージ', '2021-07-31 09:57:39', 2),
(9, 19, 'f009-r02-001.xls', '../files/2021073103132043d4bdf7f4dbc03cdc721ab228810cc8.xls', '農水省統計調査', '2021-07-31 10:13:20', 1);

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
(11, 'anonymous', 'Hacker', 'hello!', 0, 0, '2021-07-16 06:35:08');

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- テーブルの AUTO_INCREMENT `document_table`
--
ALTER TABLE `document_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- テーブルの AUTO_INCREMENT `file_table`
--
ALTER TABLE `file_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
