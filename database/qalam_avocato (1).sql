-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2023 at 02:15 PM
-- Server version: 5.7.43
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qalam_avocato`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `position_id`, `name`, `username`, `email`, `password`, `is_super`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Essa Amawi', 'admin', 'e_amawi@lawjo.net', '$2y$10$7x5WYlPbGLFhTrJy62XUXuEXIRgXxWwCL8ks177mT7irb6UIH1Bmm', 1, '00962786000977', NULL, 'yRr5UXExZXsmFLMNaiVdG9BcVrIOOSqsD0FIpVHnbEthrj87NDxiUvLy6tA7', '2023-06-20 11:36:18', '2023-08-29 23:22:46', NULL),
(2, 1, 'Essa Amawi 2', 'e_amawi', 'info@lawjo.net', '$2y$10$DPl.RVGmLV39jPIvrya63uzNPHh6hGEtcXECf34Y9e.qX57uaUaxC', 0, NULL, NULL, '22vR3ZMlDKGvs67x7dxl1GZVaN3B6R7hBUIwE31yXbdopqnaGgJpc78M5uw2', '2023-06-21 19:15:26', '2023-08-19 11:46:11', '2023-08-19 11:46:11'),
(4, 2, 'يوسف مومني', 'momani', 'momani@lawjo.net', '$2y$10$bSlKfG8aloMAv8Hc5rVnUuaI7L1oHiyZMug5NBpV8btWf8XIQ9wA6', 0, '00962772264125', NULL, 'JAfuzru6qwPmJdvMGEVExgnJQhU0AhPT9NSjrPXXD87Pxws3Ko8hs5hydz6g', '2023-06-22 09:55:26', '2023-08-29 23:26:23', NULL),
(5, 2, 'محامى تيست 123321', 'testlawer', 'testlawer@qalam.com11', '$2y$10$3NMgczAzXpTe3SCjuVcI/ePAL2pDYRLYyhyGay1lm4xh9RIzk7Nra', 0, NULL, NULL, NULL, '2023-07-03 19:58:38', '2023-08-17 19:54:36', '2023-08-17 19:54:36'),
(6, 3, 'abdelrahman obeidat', 'abdelrahmanobeidat', 'abdelrahmanobeidat.lawjo@gmail.com', '$2y$10$.gairGrfd1M/DWe/YRwP9eqgxrRQ0weiAhDh3KmZuehst.tJV.5Vy', 0, NULL, NULL, 'dLZJev7Z6lG5M0u9KSMzo1AQpLlPuL415zQLYY3ZwsOVuBqB7wHwy0Okul24', '2023-07-04 22:06:33', '2023-07-04 22:06:33', NULL),
(7, 3, 'سكرتير تجربه', 'user3', 'testsecratia@gmail.com', '$2y$10$fCON8QtoZJrKeZIwSx2/WeNOvZAP6OOcg6ha5I/3uu53JkHi4ogmG', 0, NULL, NULL, NULL, '2023-07-05 17:31:05', '2023-08-19 11:47:30', '2023-08-19 11:47:30'),
(9, 1, 'testadmin', 'user1', 'testadmin@gmail.com', '$2y$10$eyttrmFliANBiluQmMl6becUP2lNUOt5PETXynS7GrtOg3mm0CZLS', 1, '01096615', 'الاردن', NULL, '2023-07-13 16:15:49', '2023-08-26 15:26:50', NULL),
(10, 2, 'test', 'user2', 'user2@gmail.com', '$2y$10$D7O51VPw1AfnibXAj5FLyuItMI6mLKslAfX.x4lvE5uQa3CpygITK', 0, NULL, NULL, NULL, '2023-07-13 16:19:17', '2023-08-19 11:47:10', '2023-08-19 11:47:10'),
(11, 2, 'مالك ابورمان', 'malik', 'malikaburomman95@gmail.com', '$2y$10$ZZdlZxrcegIXiuHsvxkwB.Rm9cxXFX/iRX0jBfQotkshTnLgcqrDS', 0, NULL, NULL, NULL, '2023-07-15 13:19:16', '2023-08-17 19:54:18', '2023-08-17 19:54:18'),
(12, 1, 'مصعب القطاونة', 'Musab', 'qatawneh@lawjo.net', '$2y$10$A4qPayzHxlKKHyLJJbH49erF3LFEwQb8JtSXe35MEKRkOG12XEQ3O', 1, '00962796390922', NULL, NULL, '2023-07-15 13:20:16', '2023-08-29 23:20:39', NULL),
(14, 2, 'عبير الرواحنة', 'Abeer', 'abeerhmod.ah@gmail.com', '$2y$10$w21UVluai449kQkWdwABNO.qR2HUqpBIh1rFylFiBNGhMoCf1Xefm', 0, '00962796559143', NULL, 'xQTfhzNl9db1DUkhuzl7pLKWlclTFhHAzbgdXDh0vVyxYoIXqGanRMPLWOIc', '2023-07-15 13:22:28', '2023-08-29 23:25:53', NULL),
(15, 1, '1111', 'admin1', 'testadmin@gmail.com', '$2y$10$JS42KpSM/j/xayZ/h4LpKO91Ty17UsvKvfW69rqleML3.0abdMzva', 1, NULL, NULL, NULL, '2023-08-26 19:17:18', '2023-08-26 19:17:52', '2023-08-26 19:17:52'),
(16, 1, '1111', 'admin111', 'testadmin@gmail.com', '$2y$10$VLZz7WG7TmtSWio3EmBMQur40zZ.85bnmLGQSJ3w6Hg7GuzD6UNte', 1, NULL, NULL, NULL, '2023-08-26 19:17:32', '2023-08-26 19:17:52', '2023-08-26 19:17:52'),
(17, 2, 'احمد القضاة', 'aqudah', 'ahmadqudah0@yahoo.com', '$2y$10$ujcbPRZ6RtPgKmvIfB1BOuD8KNLQKa0dZwElUDMmJss5YmGImF.mK', 0, '00962790058967', NULL, NULL, '2023-08-29 23:15:01', '2023-08-29 23:15:01', NULL),
(18, 2, 'فارس الفايز', 'f.fayez', 'faresalfayez74@gmail.com', '$2y$10$YO0Rv294MDwlv/jfgPmUU.mt0GZK9hDI4GnRmW2yYRBXTlJkFuY4a', 0, '00962780161203', NULL, 'KqWcG9ataLDny8B8HmoHReI6ngHPYbM14T1nTm8C0FClp4gHSKHJSHiA5yRX', '2023-08-29 23:17:38', '2023-08-29 23:17:38', NULL),
(19, 2, 'عبدالرحمن عبيدات', 'a.obeidat', 'abdelobeidat@lawjo.net', '$2y$10$qNtYGVvyp809ffy9lSIxVu.ULjpkZ81oNXnkLDokfKiDE3nabTZHu', 0, '00962780298290', NULL, NULL, '2023-08-29 23:25:12', '2023-08-29 23:25:12', NULL),
(20, 2, 'جمان الخطيب', 'joman', 'Joman.alkhateeb2000@hotmail.com', '$2y$10$wKisdlKK/0xuJ0TgsIAJreZLobU3Y9QKnS2xhAN7X77nN7F3VCYbe', 0, '00962797824981', NULL, 'tOtB3iGJOMHCxGudbOrMCDph23T32qIBjwmo8scjdnz2OpdCVet5YQDn2VTj', '2023-08-31 13:41:46', '2023-08-31 13:41:46', NULL),
(21, 2, 'سوار الشيخ ياسين', 'sewar', 'sewar.derar90@gmail.com', '$2y$10$/q0mL0BhcWTjv1H9f4gEK.h.c9hwVMaD7Svu/plkrFe27nDKJGAUm', 0, '00962796539030', NULL, '0Abh8Auv2hugq8LMQVvhldHPJPi7XpeKLU2ksEWEQQgpcPkS7JAu3kogBWUV', '2023-08-31 13:43:29', '2023-08-31 13:43:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `base_permissions`
--

CREATE TABLE `base_permissions` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `model_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_secondary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `commercial_registration_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_registration_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_file_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_office` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('personal_relationships','international_organizations','social_media','friends','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `governorate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `client_customer_type` enum('male','female','gov','company','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `id_secondary`, `email`, `username`, `password`, `name_ar`, `name_en`, `code`, `phone`, `fax`, `start_date`, `commercial_registration_no`, `tax_registration_no`, `tax_file_no`, `tax_office`, `type`, `country`, `governorate`, `city`, `district`, `post_number`, `building_number`, `street_name`, `active`, `client_customer_type`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LSS-00001', 'ahmed@qalam.net', NULL, '$2y$10$wLRy4emNL4IOh1JJUhkIDOJ7Yg2oyiQnOiAAeTBj1FfN9HMU8izle', 'أحمد محمد عطيه ابو سعده', NULL, '1', '0798178144', NULL, NULL, '5763991', NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, 'عمان - المقابلين', 1, 'male', NULL, '2023-06-24 18:51:22', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(2, NULL, NULL, 'naela', '$2y$10$M5YgK3sMUDf9EmKcPadkNuUJ1h4mhGjcQMEYbRltKSDocfxDKF5QO', 'نائله نديم طاهر هدهد', NULL, '2', NULL, NULL, NULL, '9532011479', NULL, NULL, NULL, 'personal_relationships', 'اردني', NULL, NULL, NULL, NULL, NULL, 'عبدون', 1, 'female', NULL, '2023-07-04 22:12:26', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(3, 'CL-3', NULL, 'abdelrahmanobeidat.lawjo@gmail.com', '$2y$10$xp8a0M80UJAo1hnkfXBzm.SxD.fA4/6rf/wtsPGMPwWTFZ95L4fRW', 'زيد جميل ابراهيم القسوس', NULL, '3', '0799437494', NULL, NULL, '9651028579', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-10 14:35:22', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(19, 'CL-4', NULL, 'عبدالرحمن', '$2y$10$HPObk/zyz3NIB5tUucB9H.BJyv/tcoZ8uGdtIkFjVH6KzxfwgmD9K', 'شفا للصناعات الغذائيه', NULL, '4', '05600260', NULL, NULL, '200013104', NULL, NULL, NULL, 'personal_relationships', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 10:28:09', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(20, 'CL-5', NULL, 'عبدالرحمن بلال', '$2y$10$BspFELziO7rzhKK0.y8hG.BgVAKK.AW.GlfOiS1QvHBw1FOgNaboS', 'شركة الذكاء للتصميم الجرافيكي', NULL, '20', '0792616668', NULL, NULL, '200171440', NULL, NULL, NULL, 'personal_relationships', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 10:29:49', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(21, 'CL-6', NULL, 'عبدالرحمن 1', '$2y$10$m24pT3gSs1SzWUg.rj3g1uhv7WynHVMD5qpx9133VT8rJC7mGI4Ri', 'شركة حمزه عباس وشريكه', NULL, '21', '0795876544', NULL, NULL, '200016720', NULL, NULL, NULL, 'personal_relationships', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 10:35:09', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(22, 'CL-7', NULL, 'عبدالرحمن2', '$2y$10$iLGMXznZAigfti0/U365Q.qHQEGqfhOFW/SBhUSbThkn8EdG7Al3S', 'شركة نانسي لمستحضرات التجميل', NULL, '22', '0796464400', NULL, NULL, '200151717', NULL, NULL, NULL, 'personal_relationships', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 10:36:05', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(23, 'CL-8', NULL, 'عبدالبرحمن3', '$2y$10$9ZidHTKHznLUCL36DTFl7OQKeBD5VHUOf8IK9EudA/RjXwyq6FZzu', 'الشرق الأوسط للأدخنه', NULL, '22', '0786934340', NULL, NULL, '200087559', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 10:36:57', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(24, 'CL-9', NULL, 'عبدالرحمن 4', '$2y$10$due8lfGs.nK.O56wkNuDV.rdgjKdiMHd2Iax2S3in.pKb62asPiLe', 'شركه داره عمان العربيه للهندسه', NULL, '24', NULL, NULL, NULL, '200002757', NULL, NULL, NULL, 'personal_relationships', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 10:38:10', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(25, 'CL-10', NULL, 'عبدالرجمن 5', '$2y$10$6pUyJt0Q08LpjXgxpIyYHepdrvmY0vaJS6dJx8rSadNceY9ydpOg.', 'شركه أكاديميه و مدارس التمكين', NULL, '25', '0795505522', NULL, NULL, '200147258', NULL, NULL, NULL, 'personal_relationships', 'الأردن', NULL, NULL, NULL, NULL, NULL, 'الغرفه الأقتصاديه بدايه عمان', 1, 'company', NULL, '2023-07-11 10:39:17', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(26, 'CL-11', NULL, 'عبدالرحمن 5', '$2y$10$DGSKYiRJcxJz8ww38Pjz6upqvRwF9luvj/onl9ORX9CXmm7v34Y0e', 'هيثم ابو سالم', NULL, '25', NULL, NULL, NULL, '9851045557', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:21:29', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(27, NULL, NULL, 'عبدالرحمن 6', '$2y$10$lPKnAXGNmjmoKol7iz7GWOR6u09C9pA0PIrjob51HV6zTmzv9ZKmO', 'طارق محمد عبد المعطي', NULL, '25', '0788351268', NULL, NULL, '9861020488', NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:22:18', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(28, 'CL-15', NULL, 'عبدالرحمن 7', '$2y$10$M7DjpBWQKYdOvieiR1SmvOtuAeT8euXFLfr3aZ6qNjfplp8dy64Nq', 'شركه الديره للصيانه و قطع الغيار', NULL, '25', NULL, NULL, NULL, '200105060', NULL, NULL, NULL, 'personal_relationships', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:23:29', '2023-07-11 11:25:33', '2023-07-11 11:25:33'),
(29, 'CL-16', NULL, 'عبدالرحمن 8', '$2y$10$OocCQlvTUxOlHqyZSCmz0uYteghfOyN0TX0lj8hTrecUc6CaV8biS', 'شركه الماسه الحمراء (عبدالله محمود أمين)', NULL, '25', NULL, NULL, NULL, '9891054609', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:24:19', '2023-07-11 11:25:41', '2023-07-11 11:25:41'),
(30, 'LSS-00001', NULL, 'LSS-00001', '$2y$10$BoWWtZmksMCnZKSSDeONFuxAI0eX49aUX6zorE3zEn4y/ynExWlWO', 'أحمد محمد عطيه ابو سعده', NULL, '1', '0798178144', NULL, NULL, '5763991', NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:28:04', '2023-08-05 17:09:21', NULL),
(31, 'CL-2', NULL, 'نائله', '$2y$10$a8Gd70gu4ByBrZ/Hi2bPUu21vEEu/gkZts86AWAMxP45uQhV22PgW', 'نائله نديم طاهر هدهد', NULL, '1', NULL, NULL, NULL, '9532011479', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-11 11:28:56', '2023-07-11 11:28:56', NULL),
(32, 'CL-3', NULL, 'زيد', '$2y$10$U7HuHYp6o.Laem.aL11r5.vfry0xHUBtm59FVrNL5.6yFXuxlR3j.', 'زيد جميل ابراهيم القسوس', NULL, '1', '799437494', NULL, NULL, '9651028579', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:29:44', '2023-07-11 11:29:44', NULL),
(33, 'CL-4', NULL, 'شفا', '$2y$10$nue6MU8HQO9g1AmYh4Smee00VAGe6iK8K4rmVe6caar9618oWmGhy', 'شفا للصناعات الغذائيه', NULL, '1', '05600260', NULL, NULL, '200013104', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:30:31', '2023-07-11 11:30:31', NULL),
(34, 'CL-5', NULL, 'شركة الذكاء', '$2y$10$1k9incde4xxuyt5rv7X2veZ1qx8pmfokDmtQLsLuXzm2ak.pinosq', 'شركة الذكاء للتصميم الجرافيكي', NULL, '1', '0792616668', NULL, NULL, '200171440', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:31:08', '2023-07-11 11:31:08', NULL),
(35, 'CL-6', NULL, 'شركة حمزه', '$2y$10$rX29tl9QTBqqEUgc4uzaWuS/pxj2hP9i6ad2W6fLKhXujiu1zPR86', 'شركة حمزه عباس وشريكه', NULL, '1', '0795876544', NULL, NULL, '200016720', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:31:48', '2023-09-18 10:02:55', '2023-09-18 10:02:55'),
(36, 'CL-7', NULL, 'شركة نانسي', '$2y$10$n9eUw76IWXnHJoa7PWhPzOq8vfeyQs/U8tHIrZEMhqWVmBjKpmuMK', 'شركة نانسي لمستحضرات التجميل', NULL, '1', '0796464400', NULL, NULL, '200151717', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:32:26', '2023-07-11 11:32:26', NULL),
(37, 'CL-8', NULL, 'الشرق الأوسط', '$2y$10$q0h7Ov7VbsBwZjeUZe3vUeIe2Y.8BaNq3iKdNN9u0PSFB0f3mbZ/m', 'الشرق الأوسط للأدخنه', NULL, '1', '0786934340', NULL, NULL, '200087559', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:33:10', '2023-09-19 16:38:32', '2023-09-19 16:38:32'),
(38, 'CL-9', NULL, 'شركه داره', '$2y$10$rwyjQ2z8dkayAFhsleQvjOuY5xyPg7W3masDRpqWg17E7./kZp7a.', 'شركه داره عمان العربيه للهندسه', NULL, '1', NULL, NULL, NULL, '200002757', NULL, NULL, NULL, 'personal_relationships', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:44:55', '2023-07-11 11:44:55', NULL),
(39, 'CL-10', NULL, 'شركه أكاديميه', '$2y$10$vJe.Api1/7DfF/qbYNXOUOg3isKDrpXTR28cJSBnpcAmolmKdIMZ.', 'شركه أكاديميه و مدارس التمكين', NULL, '38', '0795505522', NULL, NULL, '200147258', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:45:41', '2023-07-11 11:45:41', NULL),
(40, 'CL-11', NULL, 'هيثم', '$2y$10$8kFmpC8KVydeGxaGZsBBjOYmbsWzgbGzM9XuKqAedYzBZNgil250q', 'هيثم ابو سالم', NULL, '38', NULL, NULL, NULL, '9851045557', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:46:17', '2023-07-11 11:46:17', NULL),
(41, 'CL-14', NULL, 'طارق', '$2y$10$WJsl45tPeApcT10V3I1onuYluFoaAc/Hz8u7bpcL/4Bout2up2.kC', 'طارق محمد عبد المعطي', NULL, '38', '0788351268', NULL, NULL, '9861020488', NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:46:56', '2023-07-11 11:46:56', NULL),
(42, 'CL-15', NULL, 'شركه الديره', '$2y$10$dHXB146IdAkgBa4MIOKf2O/XsJmoeC7XOloIqkBJXjzn85lHj0FmO', 'شركه الديره للصيانه و قطع الغيار', NULL, '38', NULL, NULL, NULL, '200105060', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:47:27', '2023-09-20 10:03:07', '2023-09-20 10:03:07'),
(43, 'CL-16', NULL, 'شركه الماسه عبدالله', '$2y$10$W4bA98G1TR4jXoY3YhjnqOAiVvTUB9ox4fZndEG3EZVITskvMdNBu', 'شركه الماسه الحمراء (عبدالله محمود أمين)', NULL, '38', NULL, NULL, NULL, '9891054609', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:48:06', '2023-07-11 11:48:06', NULL),
(44, 'CL-19', NULL, 'محمد', '$2y$10$TNDShjX7LUZdU2nnNRTkUehSGoHkyB8NkQ6iOw3rbdSUF/hGjuyra', 'محمد عبد بلوط', NULL, '38', '0788176120', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:49:17', '2023-07-11 11:49:17', NULL),
(45, 'CL-18', NULL, 'الشرق', '$2y$10$sgeiOakMwT3j/HODYIjkh.8J6HOhobceV6TARkHqqZJJvw8kLoiMS', 'الشرق الأوسط للأدخنه', NULL, '38', '0786934340', NULL, NULL, '200087559', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:50:30', '2023-07-11 11:50:30', NULL),
(46, 'CL-19', NULL, 'شركة حمزه ضريبه', '$2y$10$QzIw3n4L5dCt5xWGU14KoekeMfQ3v2/d1/V2xTQ72mvtl6g/fJ3Ly', 'شركة حمزه عباس وشريكه (ضريبه)', NULL, '38', '0795876544', NULL, NULL, '200016720', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:52:04', '2023-07-11 11:54:24', '2023-07-11 11:54:24'),
(47, 'CL-12', NULL, 'شركة حمزه ضريبه)', '$2y$10$CjlkwXxWblFNHDlXxfwaIO0wkcgkbkS6bET4.dxdmkpSouiWkSk6a', 'شركة حمزه عباس وشريكه', NULL, '38', '0795876544', NULL, NULL, '200016720', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:55:27', '2023-09-18 10:03:08', NULL),
(48, 'CL-20', NULL, 'هشام', '$2y$10$xjgmGe4oWBboDXo1Cs8NruZutBFvrCOYT7FnUtq28TzLa94grZHQ2', 'هشام حمام', NULL, '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:56:13', '2023-07-11 11:56:13', NULL),
(49, 'CL-21', NULL, 'شركة نانسي أستئناف', '$2y$10$N3WDEKwGeDzQ2k5671i2N.XuQJ7.hBtqNIPDIRQZoOjiC2BAc5YNq', 'شركة نانسي لمستحضرات التجميل أستئناف', NULL, '38', '0796464400', NULL, NULL, '200151717', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 11:57:04', '2023-07-11 11:57:04', NULL),
(50, 'CL-22', NULL, 'هيثم صلح جزاء', '$2y$10$1lZVO.djKPcdMLfqm2fXt.NsNsfgFiopFkZIIPoiMSRPjda377czi', 'هيثم ابو سالم صلح جزاء', NULL, '38', NULL, NULL, NULL, '9851045557', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 11:59:02', '2023-07-11 11:59:02', NULL),
(51, 'CL-23', NULL, 'عبد العزيز', '$2y$10$yM6Cn5wQJ7IVOdKfvtKtGem9zbiLDxkUu2xcDdNhbGS.FoWMum.ba', 'عبد العزيز سريه', NULL, '38', '0772538606', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 12:00:04', '2023-07-11 12:00:04', NULL),
(52, 'CL-23', NULL, 'شركه الأزياء', '$2y$10$LQ3/8rsepXPBRM2GFTvR2OsPOoFtSytREZhQohC.1J.WL9H1KVuVa', 'شركه الأزياء التقليديه لصناعه الالبسه', NULL, '38', '0795170007', NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 12:00:43', '2023-07-11 12:00:43', NULL),
(53, 'CL-17', NULL, 'الشرق الأوسط 17', '$2y$10$OVY.XcuOeh7ukFQo2WDOreN3DA91y6RLpha/.PEVlpdIW/5GQq08.', 'الشرق الأوسط للأدخنه 17', NULL, '38', '0786934340', NULL, NULL, '200094445', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 12:01:56', '2023-09-19 16:30:11', '2023-09-19 16:30:11'),
(54, 'CL-24', NULL, 'شركه الديره 24', '$2y$10$e2xEtpJfr3w3yH.xo4U9yeSui2TmJxQo8itSxZsCs5VqmFAE6Otn.', 'شركه الديره للصيانه و قطع الغيار', NULL, '38', NULL, NULL, NULL, '200105060', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 12:02:48', '2023-07-11 12:02:48', NULL),
(55, 'CL-25', NULL, 'أيات الله', '$2y$10$qq5BKcqhY2xe0k0r7GwBzOUxBCu9UPmOID7T2Pd35DbKZmI5AEOlq', 'أيات الله حسن نايف الحصري', NULL, '38', '0798156586', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-11 12:03:33', '2023-09-10 14:50:33', NULL),
(56, 'LSN-00005', NULL, 'عبير', '$2y$10$/Cvt4Hr3d1.8toMAabaL7ecFGmOZ6JAAmwZRKsXZp7TkI1ETXN9Vi', 'عبير حسين علي يونس', NULL, '38', '0787995364', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-11 12:04:14', '2023-08-20 16:30:04', NULL),
(57, 'CL-27', NULL, 'أحمد يوسف', '$2y$10$eD4E3Q3sVrKG3L8be1r3TuNaHrK/NOFzKOIL.XizNQm2ZQgaB74gK', 'أحمد يوسف حسن العبسي', NULL, '38', '0799319073', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 12:04:47', '2023-07-11 12:04:47', NULL),
(58, 'CL-28', NULL, 'منى', '$2y$10$A4XrzkhWwy6W2u9gGXziROluXAEPsU7lWCfSwnb9gHJ/oT94EOuEO', 'منى احمد صالح أبو خشب', NULL, '38', '0781346893', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-11 12:05:28', '2023-07-11 12:05:28', NULL),
(59, 'CL-29', NULL, 'أنوار', '$2y$10$9SQ/BN2J.lfSS0WZD8kGLuJASIxnQbyVjim1/72MQvcD3Gg8g2xAK', 'أنوار فايز فتحي درويش', NULL, '38', '0785643119', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-11 12:06:11', '2023-07-11 12:06:11', NULL),
(60, 'CL-30', NULL, 'محمود', '$2y$10$//3xl/NxOkbk//RZ8SM.vOxmIkq7X.MNAKTiCZPsREi9QSEBnRQAi', 'محمود مدحت الدلو', NULL, '38', '070597728141', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-11 12:07:10', '2023-07-11 12:07:10', NULL),
(61, 'CL-31', NULL, 'تاريخ', '$2y$10$eBgZ/XSjHYV1Vh/vqeBgWeS0h7hC3IkuRaHGiym9hFyIz.TTIGnxu', 'تاريخ و فن الموازييك', NULL, '38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 12:07:51', '2023-07-11 12:07:51', NULL),
(62, 'CL-32', NULL, 'زيد أستئناف', '$2y$10$UKtaHH6df6s0YwqTcHKv.uwySa5RCR.VV6qMrDw0WTLhechpIj7PS', 'زيد جميل ابراهيم القسوس أستئناف', NULL, '38', '0799437494', NULL, NULL, '9651028579', NULL, NULL, NULL, 'personal_relationships', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-07-11 12:09:12', '2023-07-11 12:09:12', NULL),
(63, 'CL-33', NULL, 'نظيمه', '$2y$10$XiR.JDnDB67deYRzixQNeeEk1TvPgLRpjsY2clRTXlAhLZv0qYWRa', 'نظيمه عبدالحفيظ عبدالستار الشيخ', NULL, '63', '0772413209', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'السلفادور', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-16 11:10:29', '2023-07-16 11:10:29', NULL),
(64, 'LSN_00012', NULL, 'صالح', '$2y$10$rLHFaAZKM9iSZY/GWsdcbuTkSUfVTR1/lSF29yF9qvU69YWwzHNJq', 'صالح أبو حسن', NULL, '64', '0790959337', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-16 16:42:28', '2023-07-16 16:42:28', NULL),
(65, 'LSN_00011', NULL, 'موفق', '$2y$10$nPsrF7K1UVjKddjsP1oxLOSrDuBM3NM9fxWTbJ3Xn4GTY3f5Er5wy', 'موفق حسن غنام', NULL, '64', '0787461831', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-16 16:45:51', '2023-07-16 16:45:51', NULL),
(66, 'LSN-00014', NULL, 'أحمد موفق', '$2y$10$ROFiAj34KPWhuBwZn4eeYeiOjiYPAsuCECajP.dVAiLSx06zm.PbC', 'أحمد موفق حسن غنام', NULL, '64', '0786714607', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-16 16:47:15', '2023-07-16 16:47:15', NULL),
(67, 'LSN-00015', NULL, 'محمد موفق', '$2y$10$qLi0eXGlJyuEi8gpanUTAuzuWUM4p30gDK3kQumaxooEDjSIL6rNq', 'محمد موفق حسن غنام', NULL, '64', '0787461831', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-16 16:48:21', '2023-07-16 16:48:21', NULL),
(68, 'LSN-00017', NULL, 'بسام', '$2y$10$8GgHfizRysZaZjRzjaexReaS2bTHlStaEiaXtSZW0xdVwLFcAdylS', 'بسام وصفي الجمال', NULL, '64', '0790652925', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-16 16:55:29', '2023-07-16 16:55:29', NULL),
(69, 'LSN-00016', NULL, 'رنا', '$2y$10$zv3ZtuVVOWIcl7SFprFM/eGGs5y2O4u7y2pH0SQPOC54bJdzR7RLK', 'رنا محمد نوام', NULL, '64', '0785598256', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-16 16:56:43', '2023-07-16 16:56:43', NULL),
(70, 'LSN-00018', NULL, 'شادي', '$2y$10$GT2HpPCgEKVqX4lCeAWuweG71WpqSgAPZOE/5TG4RZywNklWrPPVK', 'شادي ماهر سعيد عماره', NULL, '64', '0795298460', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-16 17:02:29', '2023-07-16 17:02:29', NULL),
(71, 'LSJ-00010', NULL, 'محمد مدحت', '$2y$10$ypdpSV/IJWgoF1BTSatXaOSbENSVvDqj94dkuR52aGSmYF5ZX4N2.', 'محمد مدحت الدلو', NULL, '71', '00970597728141', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الأردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-18 13:32:48', '2023-07-18 13:32:48', NULL),
(72, 'LSN-00010', NULL, 'أسراء', '$2y$10$tuTPV7BuxopapHyDnXyuk.V4yiCWNTND43fOGPcufYZn/Rfd1utSW', 'أسراء محمد حبش', NULL, '72', '0790560683', NULL, NULL, '8001506343', NULL, NULL, NULL, 'international_organizations', 'سوريا', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-23 13:56:48', '2023-07-23 13:56:48', NULL),
(73, 'LSN-00020', NULL, 'خلدون', '$2y$10$7DJ3BDzcspXb0M15Gg8ePeJp8Izf2DNw4Ng.Blrwt6HahiLcERtre', 'خلدون عبدالله الرشايده', NULL, '73', '0795044039', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-23 16:31:57', '2023-07-23 21:50:20', NULL),
(74, 'LSN_00019', NULL, 'عبدالله', '$2y$10$K5KhLhD4euFkykQA6gtq8OF2R62z1r.8dWuFO4DBctFZ0JO2rBd5S', 'عبدالله نمر محمد باكير', NULL, '74', '0786734407', NULL, NULL, '010120000269', NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-25 14:31:42', '2023-07-25 14:31:42', NULL),
(75, 'LSZ-00014', NULL, 'ياسر', '$2y$10$BXk0KL/2lV/IRbg1EA7r0uptX2Saxp8exBLoE3fSY9vbkSZj/Bv.e', 'ياسر محمد عثمان الرجوب', NULL, '75', '0788637344', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, 'الرمثا', 1, 'male', NULL, '2023-07-30 10:35:22', '2023-07-30 10:35:22', NULL),
(76, '7782/2023', NULL, 'محمد برهوم', '$2y$10$a8yiuOF55Qa2bF7eO4C2Z.pmZiUPuFA6bSb/7csuOCR1JIBaKgCC.', 'شركه الذكاء للتصميم الجرفيكي محمد برهوم و بتول اماره', NULL, '76', NULL, NULL, NULL, '9971024458', NULL, NULL, NULL, 'personal_relationships', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-30 13:50:11', '2023-09-18 10:59:10', '2023-09-18 10:59:10'),
(77, 'LSN-00021', NULL, 'أحمد تينه', '$2y$10$.03s2TNQZtd8sAxmnXaAqe3OBGJXXRL72jJ4rEim8NmQ.DbGV18iy', 'أحمد صالح طينه', NULL, '77', '0790358926', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'سوريا', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-07-30 14:19:52', '2023-08-15 13:42:57', NULL),
(78, 'LSI-00006', NULL, 'سائده', '$2y$10$YshfG9bScVdyqOVZGG49UuRmREUuhh0z.NgPyrP7dhIM8cGkKpwCm', 'سائده توفيق فايز', NULL, '77', '0799342055', NULL, NULL, '9712010445', NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-30 14:21:39', '2023-07-30 14:21:39', NULL),
(79, 'LSI-00005', NULL, 'ندى', '$2y$10$hPQFcpzH0DiJD/5oQO8yyeyTW3uMVXTgE2GfiLOGI0tU4Nu9V1ywS', 'ندى محمد عبدالله ابو الندى', NULL, '77', '0796455797', NULL, NULL, '9912056090', NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-07-30 14:24:08', '2023-07-30 14:24:08', NULL),
(80, 'LSN-00022', NULL, 'ناديه', '$2y$10$GInXy9KmsSFuXkK5saDrzuke.XfMIVA3eLqqjCpUNnvaTUldN2swy', 'ناديه محمد عبدالله سلامه', NULL, '80', '0799285569', NULL, NULL, '5678855', NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-06 17:32:55', '2023-08-06 17:32:55', NULL),
(81, NULL, NULL, 'أحمد بيدس', '$2y$10$PSg8TwQ6SzKEXzeF21jtZub4Zkyy6s3diauoUvPmMRZtBTQLlxGLq', 'أحمد بيدس', NULL, '81', NULL, NULL, NULL, '2000618258', NULL, NULL, NULL, 'personal_relationships', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-07 17:33:37', '2023-08-07 17:33:37', NULL),
(82, 'LSN-00023', NULL, 'يافا فياض', '$2y$10$vSXBs7.qRWblWnY/AfCJQeGUBe39oYc.xiNYUAbuKQzITP3bzi0CW', 'يافا محمد يوسف فياض', NULL, '82', '0796811839', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-08 13:20:52', '2023-08-08 13:20:52', NULL),
(83, 'LSN-00024', NULL, 'محمد فياض', '$2y$10$Ci1afN8qTiOnQRzIngzG2uFdYLZYPh./CIwLAAvjs7WqegrQMdGxK', 'محمد يوسف فياض', NULL, '82', '0787995197', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-08 13:22:37', '2023-08-08 13:22:37', NULL),
(84, 'LSJ-00011', NULL, 'يزن بنات', '$2y$10$CN6jVvzRO/09LH1vsnN93eXLwi0CCOODmfUf7iI6L13ygsTfOWzB2', 'يزن سيد خليل بنات', NULL, '84', '0787797196', NULL, NULL, '8007434405', NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, 'الزرقاء', 1, 'male', NULL, '2023-08-09 16:56:29', '2023-08-09 16:56:29', NULL),
(85, 'LSN-00027', NULL, 'سرين شريح', '$2y$10$R3L0q.l6AfmkGou5qbD3eeUwuZG3AcaEFZwrca23U10q3JGadC3lm', 'سرين شريح', NULL, '85', '0785430725', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-14 14:51:10', '2023-08-14 14:51:10', NULL),
(86, 'LSN-00026', NULL, 'أشرف الجوابره', '$2y$10$iMDNCw9HdhqYiN6q4jLXdeSr.hnt./LbwbgDV5aEa6WCC07i3nUPy', 'أشرف محمد حسن الجوابره', NULL, '86', '0798931376', NULL, NULL, '9731014186', NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-16 17:52:31', '2023-08-16 17:52:31', NULL),
(87, 'LSI-00007', NULL, 'رتيبه المصري', '$2y$10$6DysddgGNBBDBEjRQeZdfe5sX4QxWrfZtOiae4lV2SZkuRkODwcii', 'رتيبه موسى عبدالله المصري', NULL, '86', '0796117092', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-16 17:54:10', '2023-08-16 17:54:10', NULL),
(88, 'LSN-00025', NULL, 'أمل الفليفل', '$2y$10$qaI.Q.Wy4tE.RsgcAthvk.DF.XB1W7McZwFpdXbDlZ6wfo.KBgkfy', 'أمل جبريل الفليفل', NULL, '86', '0795031922', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-16 17:55:28', '2023-08-16 17:55:28', NULL),
(89, 'LSZ-00020', NULL, 'رامز الحفناوي', '$2y$10$.oZTn/Z1ZZ1DgU9T2TKNyuqZ1X1T1oS8oQcIk2tZvziW0EN2JEy8a', 'رامز سمير محمد الحفناوي', NULL, '89', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-20 13:50:24', '2023-09-17 16:51:23', NULL),
(90, 'LSZ-00018', NULL, 'سعيد عكلوك', '$2y$10$mmzYVrdOpWxWZOnIu2MhqOKQrpCjXR67adaRsopFpuTDtv0/d3H8i', 'سعيد محمد عبدالغني عكلوك', NULL, '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-20 13:59:51', '2023-09-17 16:48:09', NULL),
(91, 'LSZ-00017', NULL, 'إبراهيم عكلوك', '$2y$10$C1ZNThc6QLVndHLTOiRDMeaCjWqSeVcBF89SkF1176fw.LsPGcese', 'إبراهيم محمد عبدالغني عكلوك', NULL, '91', NULL, NULL, NULL, '1000295217', NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-20 14:03:28', '2023-09-17 16:46:57', NULL),
(92, 'LSZ-00019', NULL, 'غسان كردشان', '$2y$10$VQKt76mecSL.iLG3fYQSg.WeutaQ8EPcU9mXGQD1943g47CNWauGC', 'غسان عارف محمد كردشان', NULL, '92', '0785104941', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-20 14:06:27', '2023-09-17 16:49:34', NULL),
(93, 'LSZ-00015', NULL, 'رجاء أبو أصبع', '$2y$10$eyfIPGLFC21dNuGpIYfr8uMbEpcZOKan/vfX0Rhor0edXkYqpRZTG', 'رجاء محمد خليل أبو أصبع', NULL, '93', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-20 14:10:54', '2023-09-17 16:43:03', NULL),
(94, 'LSZ-00016', NULL, 'هنا الديك', '$2y$10$9/7x4Sn0/qs1SGj0wzgOteh3PvCieOdSPNJA7OjdrfgmaDXoyhqPG', 'هنا قاسم محمد الديك', NULL, '94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-20 14:14:00', '2023-09-17 16:45:02', NULL),
(95, 'LSZ-00021', NULL, 'جمانه خضر', '$2y$10$r6mUoGEEdFWBNEgTcE2HXeoAXRN.LLiiWHkhey5Q4Zb4fW2Sq7I06', 'جمانه صالح حامد خضر', NULL, '95', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-20 14:20:20', '2023-09-17 16:52:21', NULL),
(96, 'الزرقاء', NULL, 'فائزه عباس', '$2y$10$JuU8TsEkFuQXKOjqTDY4h.HbuJxGUvdvO9BqtdFXuEKGeh3z3FgTC', 'فائزه حسام الدين معين عباس', NULL, '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-20 14:22:50', '2023-08-28 14:07:29', NULL),
(97, 'LSZ-00023', NULL, 'زياد داود', '$2y$10$j/rJxkbQ8Sk6yYpdVxix8udiI83VotgFFNmKg5WD7wWkPr0YJVJEm', 'زياد داود عبد داود', NULL, '97', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-20 14:26:20', '2023-09-17 16:55:10', NULL),
(98, 'LSZ-00024', NULL, 'نيفين الخطيب', '$2y$10$yoxtr2YguHbuK7Mll3xVY.mwwrsR861dJVmkazOFRqCtmm55.bmhe', 'نيفين خميس أسماعيل الخطيب', NULL, '98', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-20 14:38:46', '2023-09-17 16:56:21', NULL),
(99, 'LSZ-00025', NULL, 'ماهر  أبو طالب', '$2y$10$NhqrhgBeKd34/YHuzZxKkeXWOVivXZARb/zzw/v26MjtG7R3QgIhe', 'ماهر عبدالمطلب هاشم أبو طالب', NULL, '99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-20 14:42:48', '2023-09-17 16:57:26', NULL),
(100, 'LSI-00015', NULL, 'أمنه جاموس', '$2y$10$FJ4X6dRfZsgU6BhO2IDQ4uxIVxD4MSOT60.Fz.JnYwdClOlzc9ZbC', 'أمنه صبحي راغب جاموس', NULL, '100', '0787964407', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-28 13:45:35', '2023-09-20 10:31:02', NULL),
(101, 'LSI-00019', NULL, 'رضيه شعبان', '$2y$10$GBQBZyHPH/E07lADTvg7ceRSPZOUr5XH4ilKaJ5z8ta4QOhxQUK8e', 'رضيه عبدالقادر أحمد شعبان', NULL, '100', '0799738312', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-28 13:46:55', '2023-09-20 10:33:27', NULL),
(102, 'LSI-00018', NULL, 'عزيه قريص', '$2y$10$KrcGFPZfqeAK8RbQ3s8Yf.d8SQkZ1th0qgdF56p/xon4koV.JjJhq', 'عزيه محمد عطيه قريص', NULL, '100', '0781096183', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-28 13:48:53', '2023-09-20 10:33:07', NULL),
(103, 'LSI-00020', NULL, 'أروى أبو شعيره', '$2y$10$3/t3Dq070zTBgs.AVjJ.b.fTDznMfGrQfC5cMOnRjwRaQya8NJ4H.', 'أروى ابراهيم سليم أبو شعيره', NULL, '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-28 13:49:53', '2023-09-20 10:33:48', NULL),
(104, 'LSI-00017', NULL, 'بدريه الناجي', '$2y$10$PQEpU3wDMTLQgAS/L5787uK4FnfQZWyvOnh8HV/lwyBNyqRLACYaO', 'بدريه محمد عبدالرحمن الناجي', NULL, '100', '0789218913', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-28 13:52:06', '2023-09-20 10:32:22', NULL),
(105, 'LSK-00008', NULL, 'زياد المصري', '$2y$10$Fl4wP/pQ14DMAm3OAtbjz.pxkR9rZyMF9qGhvJqNhSRLG2MSQwqXO', 'زياد خليل المصري', NULL, '100', '0799170679', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-28 13:53:18', '2023-09-19 14:43:04', NULL),
(106, 'LSK-00006', NULL, 'حسين محمد', '$2y$10$Iuv1fRASEZErU1EPA1SbZO.t453Bk.gl/XCmM6SBAzYwlj2sDUgyK', 'حسين أحمد محمد', NULL, '100', '0797245083', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-28 13:54:06', '2023-09-19 14:42:22', NULL),
(107, 'LSK-00007', NULL, 'أحمد الخطيب', '$2y$10$hJ6WfXLTKLGICh2e9PWcjukq5slmXs9dnYub3qSseT/F0fpEXNmI2', 'أحمد ابراهيم الخطيب', NULL, '100', '0791904577', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-28 13:55:59', '2023-09-19 14:42:46', NULL),
(108, 'LSK-00010', NULL, 'عمران ابو صيام', '$2y$10$cZnfX60axKKUmGhJCeD0aOF11/.xTYdeI1GRxmL8Q88vM863Tape6', 'عمران نواف ابو صيام', NULL, '100', '0780278254', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-28 13:57:29', '2023-09-19 14:43:49', NULL),
(109, 'LSK-00004', NULL, 'ابراهيم المصري', '$2y$10$SSPuZqfg004gtmRIx/SXXOWAaRnnDRd0bk0CEWPTim0XsyiSobx.y', 'ابراهيم عبدالله خليل المصري', NULL, '109', '0798470578', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-28 14:06:36', '2023-09-19 14:41:36', NULL),
(110, 'المكتب عمان', NULL, 'ناهد كباريه', '$2y$10$/I.O5jK1lSg1w7RjBJr5ou596Ew7PkUI10wehOv7RdgMv75xFH.ve', 'ناهد مثقال عبدالحفيظ كباريه', NULL, '109', '0786727956', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-28 14:10:34', '2023-08-28 14:10:34', NULL),
(111, 'المكتب عمان', NULL, 'سهام عوض', '$2y$10$s5Nn3axeJOLcgl5TIWlWkuYYFgo/0PCCqc90ksAxXzltg4ajyVhB2', 'عادل محمد سلامه عبدالدين', NULL, '111', '0799371553', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-28 15:37:27', '2023-09-20 13:06:56', NULL),
(112, 'LSK-00011', NULL, 'ليلى أبو شرف', '$2y$10$1kJQKYac2RIjV4Wcq9UwY./TF2dNc1CIdUkDTBW02kTR61BNtwywy', 'ليلى محمد أسماعيل أبو شرف', NULL, '112', '0798417690', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-30 14:22:58', '2023-09-19 14:44:11', NULL),
(113, NULL, NULL, 'سمير الحفناوي', '$2y$10$/9wTJFZc5VdJNdCo1KG2gOcqgb6Bc/Tk4cN4GyB0TrKdlNyuYRpEa', 'سمير حسين محمد الحفناوي', NULL, '113', '0782726558', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-30 15:16:27', '2023-09-17 11:57:24', NULL),
(114, 'LSZ-00016', NULL, 'هناء الديك', '$2y$10$zrVbleM/gSSFBv.oI6mk5ezg8ThJiusGYGGwbsaCEOnzfi7Z/jQ/.', 'هناء قاسم محمد الديك', NULL, '114', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-30 15:20:44', '2023-09-17 16:44:56', NULL),
(115, 'LSK-00013', NULL, 'محمد أبو شرف', '$2y$10$L13cSJfg1MLi7Omh6vh98eWxXQWUjcVRaidbBcLJSdiP44lw8KiNa', 'محمد عطالله محمد أبو شرف', NULL, '114', '0787061070', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-30 15:34:16', '2023-09-19 14:45:21', NULL),
(116, 'LSK-00009', NULL, 'سامر ربيع', '$2y$10$jVZQJ.7Avo1SpNBDTTP7C.kshsJWT34LyPzFgcxli8kTWUxNkmxzi', 'سامر حسن ربيع', NULL, '115', '0796809232', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-30 15:37:27', '2023-09-19 14:43:22', NULL),
(117, 'LSK-00005', NULL, 'حسن أبو صبيح', '$2y$10$T/Yx9VgcXe8WHchDr2I4P.iay6S0fOGJBNygD3N9ngPtrx5uPZ0x6', 'حسن محمود علي أبو صبيح', NULL, '115', '0797675811', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-30 15:50:28', '2023-09-19 14:42:00', NULL),
(118, 'LSK-00014', NULL, 'محمود ابو صبيح', '$2y$10$vEXDXbD0YeehPWQAPKcXqeYfP/yhm.5YdvN31.tPVPagBiyZsqEcK', 'محمود علي مسلم ابو صبيح', NULL, '118', '0798432790', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-30 15:52:36', '2023-09-19 14:45:53', NULL),
(119, 'LSK-00012', NULL, 'علي أبو صبيح', '$2y$10$9wkCAz4gSkgsnhIQuykZNeBfiyhjmx0.KwkxqMteGr0LjSwLLmYbK', 'علي محمود علي أبو صبيح', NULL, '119', '0798432790', NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-30 15:54:45', '2023-09-19 14:44:43', NULL),
(120, 'LSK-00015', NULL, 'محمد ابو صبيح', '$2y$10$1YwLv2jl4b2yUYqwy7Kpoui9EQI1S3nhNCSs26EwXuDH5wlqGSHKS', 'محمد محمود علي  ابو صبيح', NULL, '118', '0799669472', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-30 15:57:17', '2023-09-19 14:46:07', NULL),
(121, 'LSI-00016', NULL, 'رقيه الجعفري', '$2y$10$B96ReBQt7r7OO.nYuZnADu/fpNSEhCfG9ayRqDd17nqyRKy0jRCDe', 'رقيه جهاد جلال الجعفري', NULL, '121', '0780309489', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-31 12:56:22', '2023-09-20 10:31:39', NULL),
(122, 'LSK-00021', NULL, 'أحمد أبو شرف', '$2y$10$VMJqRgYGPxfAoVA9yH7dGeClQBJe05898pSCWbq6fXKHhor8BIngO', 'أحمد عطالله محمد أبو شرف', NULL, '122', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-31 13:01:38', '2023-09-19 16:02:15', NULL),
(123, 'LSK-00022', NULL, 'محمود أبو شرف', '$2y$10$1pY9RU4EE7S1RrxWdjODUetPyAeGjX4LrztIeh0ukV2yR5./3EMcy', 'محمود عطالله محمد أبو شرف', NULL, '122', '079563302', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-31 13:02:12', '2023-09-19 16:02:42', NULL),
(124, 'LSK-00017', NULL, 'شادي أحمد', '$2y$10$ORWSunneqGiNTScKlktNauHpp6SBB0eZuUxd6R4vCoR4WNuEflL6y', 'شادي حسن حسين أحمد', NULL, '122', '0797163534', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-31 13:03:05', '2023-09-19 15:59:43', NULL),
(125, 'LSK-00018', NULL, 'دعاء محمد', '$2y$10$eL05r6qeQc8xhl9rxAeuzOBmF/xrsV.wIt/5ZU4ilgoYgBebuw4hG', 'دعاء سليمان أحمد محمد', NULL, '122', '0799959266', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-31 13:03:44', '2023-09-19 16:00:21', NULL),
(126, 'LSK-00023', NULL, 'فاطمه أحمد', '$2y$10$F6TGYA1DMMTQeBDJ4HlfbOLpXC985FkYRXyaL1sztelV/fuCmcEIm', 'فاطمه عبدالله شكري أحمد', NULL, '122', '0799959466', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-31 13:04:19', '2023-09-19 16:03:35', NULL),
(127, 'LSK-00019', NULL, 'عمر الوشاحي', '$2y$10$.wFXvnSfnqIev4z0NiqsC.CJShb55Tw4rEVnNV1Wr0cKf5njgh00a', 'عمر حمدان الوشاحي', NULL, '127', '0799801243', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'سوريا', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-08-31 13:06:35', '2023-09-19 16:00:42', NULL),
(128, 'LSK-00020', NULL, 'حسنيه ابو صيام', '$2y$10$bqE/KSZt6XfImRmvOPU4fujRmonbkas304SSQOYNMjEydS4UQNuNG', 'حسنيه رياض محمود ابو صيام', NULL, '127', '0780019532', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-08-31 13:08:04', '2023-09-19 16:01:14', NULL),
(129, NULL, NULL, 'علي محمد', '$2y$10$XGK13pbSF1LjnVmf1/Jqk.0g4Bwjvmj8nZlslMikqGyvoyUcha4ze', 'علي رمضان حسين محمد', NULL, '129', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', 'مصر', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-04 12:36:49', '2023-09-04 12:36:49', NULL),
(130, 'LSI-00009', NULL, 'سلاف المصري', '$2y$10$fygAsw1jZBz4VCFmQhdE4uuNfg20tZ9mmdj1ps0ZZQVNpBr2QL0.i', 'سلاف سامر المصري', NULL, '130', '0799297712', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-04 16:24:04', '2023-09-14 15:11:38', NULL),
(131, NULL, NULL, 'ألفت محاميد', '$2y$10$R3NwqW7/CNmgUmnt7Y1y4O2/i0Rf3pQK8NKUc6ByjSoVCDX3MWY9u', 'ألفت جابر محاميد', NULL, '130', '0796107707', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'سوريا', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-04 16:25:20', '2023-09-04 16:27:34', NULL),
(132, 'LSI-00011', NULL, 'عزام بياطري', '$2y$10$24XsWqt/zjZSdj8DnTiaROZ73Bg5iezLq.GwMquX5iSPCufTceZZm', 'عزام أحمد بياطري', NULL, '130', '0797468372', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-04 16:27:14', '2023-09-14 15:22:14', NULL),
(133, NULL, NULL, 'لاريسا الهندسي', '$2y$10$ChcmfpSiZ.Scq.h3JvQKLe7gc6qzzYLMaVvEmQYK820Pe7F9WZOb2', 'لاريسا الهندسي', NULL, '133', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-05 14:47:23', '2023-09-05 14:47:23', NULL),
(134, 'LSZ-00027', NULL, 'زهر الجوابره', '$2y$10$cTio5./P4FkTvN8iuUtVbe5HryXQg86.rCEggE7TXKte3RHjPM/Ha', 'زهر يحيى الجوابره', NULL, '134', '0788029144', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-10 14:45:31', '2023-09-24 13:18:06', NULL),
(135, 'LSI-00021', NULL, 'هبه ناجي', '$2y$10$YCywsdkRvSRjG8n7rOaF4e3VAcSsw45I2LiYKvb9XlyfS8KaUv5Ce', 'هبه أحمد عبد الفتاح ناجي', NULL, '135', '0780548132', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-10 15:17:26', '2023-09-20 12:10:40', NULL),
(136, NULL, NULL, 'الشبكه الأوسطيه', '$2y$10$WXQqFT5.OLLHjfAWFWvabuCLgfCLu6ee8RteZpPwKw.beT0ZF/1Fe', 'الشبكه الشرق الأوسطيه', NULL, '136', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-09-11 16:50:17', '2023-09-11 16:50:17', NULL),
(137, 'LSS-00005', NULL, 'جلال أبو فرق', '$2y$10$Zzv1aKihOtY.etrtipkAh.PufFr3FS96TLaG7VYXlSlFWwqgwH18S', 'جلال فايز مصطفى أبو فرق', NULL, '137', '0779500134', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-12 14:38:26', '2023-09-12 14:38:26', NULL),
(138, NULL, NULL, 'الأنوروا', '$2y$10$HVblAbhYp1dzit7GiBQj6OdEfdmsrV1657FEVT7Y7gDH9Fi4qAn9O', 'الأنوروا', NULL, '138', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-09-12 17:03:50', '2023-09-12 17:03:50', NULL),
(139, NULL, NULL, 'عائشه السمان', '$2y$10$YaoOO38xJfw1QXWLg8SZKuRQia.bID7aGfy8PYDBt2Q7ct/m3XRCK', 'عائشه السمان', NULL, '139', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-17 12:17:46', '2023-09-17 12:17:54', NULL),
(140, 'LSN-00031', NULL, 'محمد حسان', '$2y$10$JdDyQeJ78mZO65zqnNYzAe7u1d.ygdriBrreDxxdpkevhOkwqjypW', 'محمد باسل نبيل حسان', NULL, '140', '0798559713', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-17 14:29:21', '2023-09-17 14:29:21', NULL),
(141, 'LSS-00007', NULL, 'احمد عبدالله', '$2y$10$Vv3dKbGVIwO8Zl6AR29LXOdy0mwlh.vDdWuohTl45cl.wd5YH/MZq', 'احمد حسن سالم عبدالله', NULL, '141', '0799125972', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'سوريا', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-17 15:03:25', '2023-09-17 15:03:25', NULL),
(142, NULL, NULL, 'محمد القضاة', '$2y$10$ajlPLNl3iD4HK8rUmjCKwOn65QMzspZjFR4L09OlmRiG8rBt9HnrC', 'محمد جهاد عبدالكريم القضاة', NULL, '142', '0799659918', NULL, NULL, '9961044590', NULL, NULL, NULL, 'personal_relationships', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-17 15:48:35', '2023-09-18 11:16:14', '2023-09-18 11:16:14'),
(143, 'LSN-00030', NULL, 'ريما عطاونه', '$2y$10$angY0UQhCYU1VoGtAakAH.qYwsR0vzyRdBwtH2lmh0Sd22ZuVgw9q', 'ريما سليمان عطاونه', NULL, '143', '0785203903', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'سوريا', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-18 11:25:42', '2023-09-18 11:25:42', NULL),
(144, 'LSS-00006', NULL, 'عادل سلامه', '$2y$10$U/bUHn.oa35PjYgXQcszZe5syNDJckiqsOLGvfL9Kcyg5pwWlZXjG', 'عادل محمد سلامه', NULL, '143', '0799289511', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-18 11:26:41', '2023-09-20 13:06:16', '2023-09-20 13:06:16'),
(145, 'LSN-00029', NULL, 'فؤاد عطاونه', '$2y$10$x/UQDDbQTTvYAG5.gB9Ol.hZOfCpLrXYYXE2O/eJLWj3feaU35102', 'فؤاد سلطان عطاونه', NULL, '143', '0785203903', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-18 11:28:11', '2023-09-18 11:28:11', NULL),
(146, NULL, NULL, 'علاء ضيف الله', '$2y$10$VydtR5RxiRDa3FNxrlzYDur.51Czh.txHYBA/k27.uVfRi/F9HPs6', 'علاء نايف ضيف الله', NULL, '146', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-18 13:34:13', '2023-09-18 13:34:13', NULL),
(147, 'LSS-00026', NULL, 'امل سواركه', '$2y$10$b95FmVA062c1Rb5QSPzhZOn7wqlRxw4zi3aN2BCWKRsoc55cRqjuC', 'بنات امل سواركه (بنتان)', NULL, '147', '0797598770', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-18 13:55:39', '2023-09-18 13:55:39', NULL),
(148, 'LSN-00032', NULL, 'عيسى  شحاده', '$2y$10$xwCIeDpjZNbLrVD.zagCUeaQNPbWIiiJ3q9DcCsALUEPnhoQq9tm.', 'عيسى رمضان عيسى شحاده', NULL, '148', '0790215627', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-18 15:34:47', '2023-09-18 15:34:47', NULL),
(149, NULL, NULL, 'حياة الجوابرة', '$2y$10$urAuZYFhYtN4AsOAUr31IuF1Nz4dVcJcavPxBqxQNhE.AodWam8Ya', 'حياة محمد الجوابرة', NULL, '149', '0796827418- 0788029144', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-19 15:28:50', '2023-09-24 13:17:34', '2023-09-24 13:17:34'),
(150, 'LSK-00016', NULL, 'هبة البدوي', '$2y$10$/X8fykiHzTlKu62boQHqxue67bsmdMf/vRKDeV57ru4F/zsC2amJ2', 'هبة السيد البدوي', NULL, '150', '0796352846', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-20 12:05:54', '2023-09-20 12:05:54', NULL),
(151, NULL, NULL, 'مؤسسه مالك', '$2y$10$pqxzZp15Fs1kSyknig1TV.YpP8Er4oWgQcC.N/PNUvk6TbP9uEYgq', 'مؤسسه مالك أبوغنيمه لبناء قدرات الشباب', NULL, '151', '0795480767', NULL, NULL, NULL, NULL, NULL, NULL, 'personal_relationships', 'الاردن', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'company', NULL, '2023-09-21 14:47:30', '2023-09-21 14:47:30', NULL),
(152, 'LSI-00008', NULL, 'سناء  أسماعيل', '$2y$10$Ulwzw7a98kt3AUMJtlufo.hiZc9L68OPi32n/s/jxj722bCG7riym', 'سناء خليل محمد أسماعيل', NULL, '152', '0799483175', NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'female', NULL, '2023-09-24 12:14:59', '2023-09-24 12:14:59', NULL),
(153, 'LSK-00025', NULL, 'احمد محمد', '$2y$10$o0hcabeYlYX2BlMzVUNPBeGpX59lm2YqY8rfiJPQIrrGj.RB27DKG', 'احمد يوسف خليل محمد', NULL, '153', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'international_organizations', 'فلسطين', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'male', NULL, '2023-09-24 16:26:04', '2023-09-24 16:26:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_files`
--

CREATE TABLE `client_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_files`
--

INSERT INTO `client_files` (`id`, `client_id`, `file_name`, `file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'صوره العميل', 'images/clients/d8cSZaakdwRprIbkiCCvg08jqJoNWx3NBdlGOeSR.jpg', '2023-06-25 22:37:54', '2023-06-25 22:44:06', '2023-06-25 22:44:06'),
(2, 1, 'ًصوره شخصيه', 'images/clients/JU0RzeTvJSgadxspkrkm3QAvmyOtzqOrz8T4ZEyY.jpg', '2023-06-26 00:58:08', '2023-06-26 00:59:40', '2023-06-26 00:59:40'),
(3, 1, 'الصوره الشخصيه', 'images/clients/T32cCOYX88h8fHldrOJGKbyLlWwbwuzWTIH5S8F5.jpg', '2023-06-26 00:59:01', '2023-06-26 00:59:16', '2023-06-26 00:59:16'),
(4, 75, 'الرقم الشخصي', 'images/clients/tuDQQmWmcXlDTSwMRYyo5qWnRndCSQkKgM1MGTGZ.pdf', '2023-08-19 12:43:58', '2023-08-19 12:43:58', NULL),
(5, 75, 'تجربة', 'images/clients/pfcQK7kio3ucyV0Mk3G0ks2De9B7RD6hiyQyCim8.jpg', '2023-08-19 12:45:55', '2023-08-19 12:46:32', '2023-08-19 12:46:32'),
(6, 75, 'تجربة 2 doc', 'images/clients/2WqlNo1V1RxliW5ABPpe0dcHqkRSqr4rtt4XygJw.doc', '2023-08-19 12:46:57', '2023-08-19 12:47:44', '2023-08-19 12:47:44'),
(7, 30, 'تجربة', 'images/clients/NUx77pCAGi6KOz1cnyk6P5QYFiu8oCzmB1ZBhvDr.xls', '2023-08-20 14:29:47', '2023-08-20 14:31:04', '2023-08-20 14:31:04'),
(8, 30, 'تجربة', 'images/clients/6SUZilN9wliuz4fhzxId4FmLWRLVweb7e5qb3jqZ.xls', '2023-08-20 14:31:14', '2023-08-20 14:31:19', '2023-08-20 14:31:19'),
(9, 30, 'تجربة 2', 'images/clients/fE6dSFLiqv0bkMC2m0vlPNCJDmlwgfIIc4Qnmbny.xls', '2023-08-20 14:32:13', '2023-08-20 14:32:19', NULL),
(10, 99, 'تيست', 'images/clients/F3T35yORWLnF9gYTRTl6zQF3PrccCePVU7Xbm4EM.jpg', '2023-08-25 16:14:27', '2023-08-25 16:18:00', '2023-08-25 16:18:00'),
(11, 99, 'تيست', 'images/clients/PWa275DBlPlmauxNetgWMycLZfQ0jDs5Sq9SBQhq.jpg', '2023-08-26 15:29:30', '2023-08-26 15:31:09', '2023-08-26 15:31:09'),
(12, 94, 'تجربة', 'images/clients/ixESQtTt9h4OrIWbiB7V9Bquj5EBPMKvJh09yKdb.jpg', '2023-08-26 19:05:16', '2023-08-26 19:05:26', '2023-08-26 19:05:26'),
(13, 94, 'تجربة 2', 'images/clients/6xhF0PUQygWAzW8gfzPgq0FIfpEjeezDbqwDFRfu.jpg', '2023-08-26 19:05:47', '2023-08-26 19:07:15', '2023-08-26 19:07:15'),
(14, 111, 'الصوره الشخصيه', 'images/clients/KGJIpI1sxPgC2voSXRt6C6kCemYtHKSoUb7HRuiH.jpg', '2023-09-05 12:45:41', '2023-09-05 12:45:59', '2023-09-05 12:45:59'),
(15, 111, 'الصوره الشخصيه', 'images/clients/lzrsmWwFmfLbfha6hvm9aeIdFKJHCFXEQGs0gT7d.jpg', '2023-09-05 12:50:58', '2023-09-05 12:51:45', '2023-09-05 12:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `client_permissions`
--

CREATE TABLE `client_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_client_id` bigint(20) UNSIGNED NOT NULL,
  `sub_client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name_ar`, `name_en`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'إدارة', 'administration', 1, '2023-06-20 11:36:18', '2023-06-20 11:36:18', NULL),
(2, 'اداره المحاماه', NULL, 1, '2023-06-21 19:24:45', '2023-06-21 19:24:45', NULL),
(3, 'اداره السكرتاريه', NULL, 1, '2023-06-26 17:33:51', '2023-06-26 17:33:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_22_231940_create_admins_table', 1),
(6, '2021_11_15_214136_create_departments_table', 1),
(7, '2021_11_16_202917_create_positions_table', 1),
(8, '2021_11_21_221832_create_staff_table', 1),
(9, '2021_12_29_000711_create_clients_table', 1),
(10, '2022_02_08_232031_add_description_to_positions_table', 1),
(11, '2022_02_09_000518_add_graduation_to_staff_table', 1),
(12, '2022_12_26_151122_create_base_permissions_table', 1),
(13, '2023_02_23_183537_create_permissions_table', 1),
(14, '2023_02_23_214631_add_position_id_to_admins_table', 1),
(15, '2023_06_17_153535_create_problems_table', 1),
(16, '2023_06_20_164823_create_problems_other_person_other_lawer_table', 1),
(17, '2023_06_23_131809_create_client_files_table', 1),
(18, '2023_06_24_131940_create_problems_procedure_table', 1),
(19, '2023_07_15_212030_create_problems_procedure_files_table', 1),
(20, '2023_07_17_230250_create_client_permissions_table', 1),
(21, '2023_08_11_112205_create_problem_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `position_id`, `permission_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin-viewAny', '2023-06-20 11:36:18', '2023-06-20 11:36:18'),
(2, 1, 'Admin-store', '2023-06-20 11:36:18', '2023-06-20 11:36:18'),
(3, 1, 'Admin-update', '2023-06-20 11:36:19', '2023-06-20 11:36:19'),
(4, 1, 'Admin-delete', '2023-06-20 11:36:19', '2023-06-20 11:36:19'),
(5, 1, 'Permission-store', '2023-06-20 11:36:19', '2023-06-20 11:36:19'),
(6, 1, 'Permission-viewAny', '2023-06-20 11:36:19', '2023-06-20 11:36:19'),
(7, 1, 'Permission-update', '2023-06-20 11:36:19', '2023-06-20 11:36:19'),
(8, 1, 'Permission-delete', '2023-06-20 11:36:19', '2023-06-20 11:36:19'),
(13, 1, 'Client-viewAny', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(14, 1, 'Client-store', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(15, 1, 'Client-update', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(16, 1, 'Client-delete', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(17, 1, 'Department-viewAny', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(18, 1, 'Department-store', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(19, 1, 'Department-update', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(20, 1, 'Department-delete', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(21, 1, 'Position-viewAny', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(22, 1, 'Position-store', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(23, 1, 'Position-update', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(24, 1, 'Position-delete', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(25, 1, 'Problem-viewAny', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(26, 1, 'Problem-store', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(27, 1, 'Problem-update', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(28, 1, 'Problem-delete', '2023-06-21 19:23:33', '2023-06-21 19:23:33'),
(29, 2, 'Problem-viewAny', '2023-06-22 15:47:39', '2023-06-22 15:47:39'),
(30, 2, 'Problem-store', '2023-06-22 15:47:39', '2023-06-22 15:47:39'),
(31, 2, 'Problem-update', '2023-06-22 15:47:39', '2023-06-22 15:47:39'),
(32, 2, 'Problem-delete', '2023-06-22 15:47:39', '2023-06-22 15:47:39'),
(41, 3, 'Problem-viewAny', '2023-06-27 00:22:23', '2023-06-27 00:22:23'),
(42, 3, 'Problem-store', '2023-06-27 00:22:23', '2023-06-27 00:22:23'),
(43, 3, 'Problem-update', '2023-06-27 00:22:23', '2023-06-27 00:22:23'),
(44, 3, 'Problem-delete', '2023-06-27 00:22:23', '2023-06-27 00:22:23'),
(45, 3, 'Client-viewAny', '2023-07-05 17:45:33', '2023-07-05 17:45:33'),
(46, 3, 'Client-store', '2023-07-05 17:45:34', '2023-07-05 17:45:34'),
(47, 3, 'Client-update', '2023-07-05 17:45:34', '2023-07-05 17:45:34'),
(48, 3, 'Client-delete', '2023-07-05 17:45:34', '2023-07-05 17:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `department_id`, `name_ar`, `name_en`, `description_ar`, `description_en`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'مدير عام', 'General manager', NULL, NULL, 1, '2023-06-20 11:36:18', '2023-06-20 11:36:18', NULL),
(2, 2, 'محامى', NULL, NULL, NULL, 1, '2023-06-21 19:25:06', '2023-06-21 19:25:06', NULL),
(3, 3, 'سكرتاريه', NULL, NULL, NULL, 1, '2023-06-26 17:34:21', '2023-06-26 17:34:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_secondary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `client_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_lawer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `problem_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `problem_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_session_date` date DEFAULT NULL,
  `file_open_date` date DEFAULT NULL,
  `number_days_remind` int(11) DEFAULT NULL,
  `court` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double(8,2) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `reviewer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('pending','running','completed','canceled','stopped') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('procedure','case') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finish_notes` text COLLATE utf8mb4_unicode_ci,
  `finish_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `send_email` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`id`, `id_secondary`, `admin_id`, `client_id`, `client_type`, `other_person`, `other_lawer`, `problem_number`, `problem_date`, `next_session_date`, `file_open_date`, `number_days_remind`, `court`, `judge`, `cost`, `notes`, `subject`, `reviewer`, `deadline`, `status`, `type`, `finish_notes`, `finish_date`, `created_by`, `send_email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 4, 1, 'summoner', NULL, NULL, '552', NULL, '2023-06-26', NULL, NULL, NULL, NULL, 0.00, '0', NULL, NULL, '2023-06-30', 'running', 'procedure', NULL, NULL, NULL, 0, '2023-06-24 18:53:00', '2023-07-13 18:37:20', '2023-07-13 18:37:20'),
(2, NULL, 4, 1, 'claimant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-03', 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-03 20:02:27', '2023-08-17 19:54:36', '2023-07-13 18:36:55'),
(3, NULL, 2, 2, 'respondent', NULL, NULL, '357-2021', NULL, NULL, '2021-06-21', NULL, 'محكمة بداية عمان - الغرفة الاقتصادية', 'مناور ابوالغنم', 100000.00, 'تم رد الدعوى (لصالحنا)', NULL, NULL, NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-07-04 22:19:43', '2023-07-23 12:43:45', '2023-07-23 12:43:45'),
(4, 'LٍٍSS-00001', 4, 30, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-28', NULL, NULL, NULL, NULL, 'أستشاره', 'أستشاره', 'المكتب / اول مرة', NULL, 'completed', 'procedure', 'تم تقديم الأستشاره للموكل', '2023-09-03 10:26:54', NULL, 0, '2023-07-13 14:17:25', '2023-09-03 10:26:54', NULL),
(5, NULL, 4, 30, 'claimant', NULL, NULL, NULL, '2023', NULL, '2023-05-28', NULL, 'لا', '0', 0.00, '1- تم عمل معامله أثبات جنسيه.\r\n2- تم أجراء معامله أبناء أردنيات.\r\n3- تم أصدار جواز سفر خاص.\r\nالمضي في أجراءات أصدار البطاقه البيضاء.', NULL, NULL, NULL, 'pending', 'case', NULL, NULL, NULL, 0, '2023-07-16 11:59:42', '2023-07-23 12:43:24', '2023-07-23 12:43:24'),
(6, 'LSS-00001', 4, 30, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-05-28', NULL, NULL, NULL, NULL, 'معامله أثبات جنسيه', 'معامله أثبات جنسيه', 'السفارة الفلسطينية', '2023-07-05', 'completed', 'procedure', 'تم أستخراج أثبات جنسيه للموكل', '2023-09-03 10:27:11', NULL, 0, '2023-07-16 16:26:31', '2023-09-03 10:27:11', NULL),
(7, NULL, 4, 30, 'claimant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'معامله بطاقه أبناء أردنيات', 'معامله بطاقه أبناء أردنيات', 'دائرة الأحوال المدنية والجوازات ووزارة الداخلية', '2023-07-07', NULL, 'procedure', NULL, NULL, NULL, 0, '2023-07-16 16:27:40', '2023-08-16 16:06:09', NULL),
(8, 'LSS-00001', 4, 30, 'claimant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر خاص', 'أصدار جواز سفر خاص', 'دائرة الأحوال المدنية والجوازات', '2023-07-07', 'completed', 'procedure', 'تم السير في معاملة اصدار جواز سفر خاص وتم رفض المعاملة لاسباب امنية', NULL, NULL, 0, '2023-07-16 16:28:43', '2023-08-16 16:05:35', NULL),
(9, 'LSS-00001', 4, 30, 'claimant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'معاملة البطاقه البيضاء', 'معاملة البطاقه البيضاء', 'دائرة الأحوال المدنية والجوازات', '2023-07-07', 'completed', 'procedure', 'تم رفض طلب اصدار البطاقه البيضاء', '2023-08-16 04:04:29', NULL, 0, '2023-07-16 16:29:05', '2023-08-16 16:05:19', NULL),
(10, NULL, 4, 71, 'summoner', NULL, NULL, '1', '2023', NULL, NULL, NULL, NULL, NULL, NULL, 'تم تتبع طلب التأشيره وتم الرفض لأسباب أمنيه', NULL, NULL, '2023-07-18', NULL, 'procedure', NULL, NULL, NULL, 0, '2023-07-18 13:34:26', '2023-08-17 19:54:18', '2023-07-24 14:03:19'),
(11, NULL, 14, 59, 'other', NULL, NULL, '112901673', NULL, NULL, '2023-07-18', NULL, NULL, NULL, NULL, 'تم تسجيل قضيه أثبات نسب والجلسه القادمه  08/08/2023', 'قضيه أثبات نسب', 'محمكمه عين الباشا الشرعيه', '2023-07-18', 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-07-18 13:40:08', '2023-08-20 13:54:41', NULL),
(12, 'LSS-00003', 1, 44, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-12', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره', 'تم تقديم الأستشاره', 'المكتب', '2023-06-12', 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-18 15:39:49', '2023-08-20 13:55:04', NULL),
(13, 'LSS-00003', 14, 44, 'claimant', NULL, NULL, '647', NULL, NULL, '2023-06-21', NULL, NULL, NULL, NULL, 'مراجعه الأحوال المدنيه لأستخراج شهاده ميلاد وتم أستلامها بعد تصحيح الخطأ الأداري ونقل كافه الأختام', 'أستخراج شهاده ميلاد', 'الأحوال المدنيه', '2023-06-21', NULL, 'procedure', NULL, NULL, NULL, 0, '2023-07-18 15:47:34', '2023-08-27 15:08:01', NULL),
(14, NULL, 4, 51, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-02', NULL, NULL, NULL, NULL, 'تم تحديد السكن من الأقامه و الحدود للموكل وذلك كخطوه أستباقيه لأصدار بطاقات أبناء أردنيات', 'تحديد السكن', 'دائرة الأحوال المدنية والجوازات', NULL, 'completed', 'procedure', 'تم الحصول على تحديد سكن الموكل وذلك لغايات المضي في أجراءات أستخراج بطاقات أمنيه التي تساعد في الحصول على بطاقات أبناء أردنيات', '2023-08-29 10:21:11', NULL, 0, '2023-07-18 16:36:38', '2023-08-29 10:21:39', NULL),
(15, NULL, 14, 55, 'claimant', NULL, NULL, '902', '2023', NULL, '2023-07-06', NULL, 'محكمة مأدبا الشرعيه', 'احمد فايز احمد الخلايله', 41.00, 'قضيه تفريق للغيبه و الضرر, تاريخ أول جلسه 17/07/2023', 'تم قيد دعوى تفريق للغيبه و الضرر', 'محكمة مادبا الشرعية', NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-07-23 12:02:11', '2023-08-23 14:11:34', NULL),
(16, NULL, 14, 44, 'claimant', NULL, NULL, '647', '2023', NULL, '2023-06-21', NULL, 'محمكه صلح حقوق مأدبا', 'معن الحياري', 65.00, 'تم اجراء تثبيت قيد ولاده أبنته (ميرا) وتم اصدار حكم قطعي بالموافقه (عبير)', 'تم اجراء تثبيت قيد ولاده أبنته (ميرا) وتم اصدار حكم قطعي بالموافقه', 'محكمه صلح حقوق مأدبا', '2023-06-21', 'running', 'case', 'تم اجراء تثبيت قيد ولاده أبنته (ميرا)', '2023-09-04 12:10:10', NULL, 0, '2023-07-23 12:08:34', '2023-09-04 12:10:10', NULL),
(17, 'LSN-00006', 14, 55, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-27', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره للموكله في المكتب', 'تقديم أستشاره', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 12:19:35', '2023-08-20 13:55:28', NULL),
(18, NULL, 14, 55, 'claimant', NULL, NULL, '697', '2023', NULL, '2023-07-04', NULL, 'محكمة مأدبا الشرعيه', 'هيثم  الشيحان', 7.00, 'تم أستصدار حجه وصايا مؤقته للصغير عز الدين و ختمها بتاريخ  و تم دفع رسم أستصدار الوصيه 6 دنانير و 1 دينار مشروحات 07/04/2023', 'أستصدار حجه وصايا مؤقته للصغير عز الدين', 'محكمه مأدبا الشرعيه/ توثيقات', NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-07-23 12:24:37', '2023-08-23 14:02:14', '2023-08-23 14:02:14'),
(19, 'LSN-00006', 14, 55, 'claimant', NULL, NULL, '697', NULL, NULL, '2023-07-04', NULL, NULL, NULL, NULL, NULL, 'للمسح', 'محكمه مأدبا الشرعيه/ توثيقات', '2023-07-04', 'running', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 12:26:47', '2023-09-04 14:56:35', NULL),
(20, NULL, 14, 44, 'claimant', NULL, NULL, '880', '2023', NULL, '2023-07-02', NULL, 'محكمة مأدبا الشرعيه', 'حمد مطلب سالم السلايطه', 41.00, 'تم قيد دعوى أثبات زواج تحت رقم 880/2023 و موعد اول جلسه في 07/17/2023 لسماع الشهود', 'قيد دعوى أثبات زواج', 'محكمه مأدبا الشرعيه', NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-07-23 12:42:28', '2023-09-17 10:22:47', NULL),
(21, NULL, 14, 56, 'claimant', NULL, NULL, '10800696', '2023', NULL, '2023-07-04', NULL, 'محكمة مأدبا الشرعيه', 'هيثم سليمان عارف الشيحان', 8.00, 'تم استصدار حجه وصاية مؤقته للأبن عدي  07/04/2023', 'أستصدار حجه وصاية مؤقته', 'محكمة مادبا الشرعية', NULL, 'running', 'case', 'تم أستصدار حجه وصاية مؤقته', '2023-09-04 12:25:48', NULL, 0, '2023-07-23 12:51:36', '2023-09-17 10:42:48', NULL),
(22, 'LSN-00005', 4, 56, 'claimant', NULL, NULL, '10800696', NULL, NULL, '2023-07-02', NULL, NULL, NULL, NULL, 'معاملة استخراج رقم شخصي لزوج عبير', 'استخراج رقم شخصي', 'دائرة الاقامة والحدود', '2023-07-10', 'completed', 'procedure', 'تم أستصدار الرقم الشخصي للموكله', '2023-09-04 12:09:34', NULL, 0, '2023-07-23 12:54:42', '2023-09-04 12:09:34', NULL),
(23, NULL, 14, 56, 'claimant', NULL, NULL, '903', '2023', NULL, '2023-07-06', NULL, 'محكمة مأدبا الشرعيه', 'احمد فايز احمد الخلايله', 41.00, 'تم قيد دعوى تفريق للغيبه و الضرر بتاريخ 07/06/2023 وموعد أول جلسه في 07/26/2023', 'قيد دعوى تفريق للغيبه و الضرر', 'محكمة مادبا الشرعية', NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-07-23 12:57:45', '2023-09-17 10:42:38', NULL),
(24, 'LSS-00002', 4, 57, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-27', NULL, NULL, NULL, NULL, 'تم مراجعه مكتب متابعه و التفتيش لدى وزاره الداخليه و اعلمنا الموظفه  ان الاعفاء من الغرامات بأمرين اما ان يدفع الغرامه او ان من ابناء الاردنيات', 'الاستفسار عن الاعفاء من الغرامات', 'المتابعه و التفتيش', NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:20:43', '2023-08-16 16:19:11', NULL),
(25, 'LSN-00018', 4, 70, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-23', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل و زوجته', 'تم تقديم الأستشاره للموكل و زوجته', 'المكتب', NULL, 'running', 'procedure', 'تم التواصل من قبل الموكل و أفاد بعدم رغبته في المضي في أجراءاتنا القانونيه', '2023-08-16 04:20:57', NULL, 0, '2023-07-23 13:22:53', '2023-08-16 16:20:57', NULL),
(26, 'LSI-00004', 4, 63, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-16', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكله', 'تم تقديم الأستشاره للموكله', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:24:01', '2023-08-16 16:21:19', NULL),
(27, 'LSZ-00003', 4, 63, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-21', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكله', 'تم تقديم الأستشاره للموكله', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:25:14', '2023-08-16 16:22:20', NULL),
(28, 'LSٍS-00002', 4, 41, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-11', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل و المضي في الأجراءات بعد موافقه الموكل على المضي بها.', 'تقديم الأستشاره للموكل', 'المكتب', '2023-08-30', 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:32:57', '2023-08-16 16:22:11', NULL),
(29, 'LSٍS-00002', 4, 41, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-19', NULL, NULL, NULL, NULL, 'تم مراجعه دائره الشؤون الفلسطينيه للأستفسار عن كتاب حسن السيره و السلوك من المخابرات', 'مراجعه دائره الشؤون الفلسطينيه للأستفسار عن كتاب حسن السيره و السلوك من المخابرات', 'دائره الشؤون الفلسطينيه', '2023-08-25', 'completed', 'procedure', 'تم رفض الطلب لأسباب أمنيه', '2023-08-19 04:51:17', NULL, 0, '2023-07-23 13:36:22', '2023-08-19 16:51:17', NULL),
(30, 'LSٍN-00016', 4, 69, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-17', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكله', 'تم تقديم الأستشاره للموكله', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:38:36', '2023-08-16 16:21:29', NULL),
(31, 'LSٍN-00017', 4, 68, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-17', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'تم تقديم الأستشاره للموكل', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:39:36', '2023-08-16 16:25:17', NULL),
(32, 'LSٍN-00011', 4, 65, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-16', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'تم تقديم الأستشاره للموكل', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:45:38', '2023-08-16 16:25:29', NULL),
(33, 'LSٍN-00015', 4, 67, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-16', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'تم تقديم الأستشاره للموكل', NULL, NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:47:43', '2023-08-16 16:22:42', NULL),
(34, 'LSٍN-00014', 4, 57, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-16', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'تم تقديم الأستشاره للموكل', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:48:31', '2023-08-16 16:22:30', NULL),
(35, 'LSٍN-00012', 4, 64, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-16', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'تم تقديم الأستشاره للموكل', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:49:05', '2023-08-16 16:22:52', NULL),
(36, 'LSN-00010', 4, 72, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-05', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكله.\r\nتمت الموافقه من الموكله للمضي في أجراءات قضيتها.', 'تم تقديم الأستشاره للموكل', NULL, '2023-08-29', 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:58:03', '2023-08-16 16:25:41', NULL),
(37, 'LSN-00003', 4, 58, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-29', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكله', 'تم تقديم الأستشاره للموكل', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 13:59:38', '2023-08-16 16:23:03', NULL),
(38, 'LSN-00002', 4, 59, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-20', NULL, NULL, NULL, NULL, NULL, 'تم مراجعه مديرية شؤون اللاجئين السوريين و تم التحقق من معامله تصويب الوضع المقدمه مسبقاً', 'مديرية شؤون اللاجئين السوريين', NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 14:07:32', '2023-08-20 16:31:27', NULL),
(39, 'LSN-00002', 4, 59, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-25', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'تم تقديم الأستشاره للموكل', 'المكتب', NULL, 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 14:08:41', '2023-08-16 16:23:38', NULL),
(40, NULL, 14, 59, 'claimant', NULL, NULL, '673', '2023', NULL, '2023-06-25', NULL, 'محكمة عين الباشا الشرعيه', 'علي رضوان فرج الزبيدي', 46.00, 'تم قيد دعوى أثبات نسب بتاريخ 18/7/2023 وتاريخ أول جلسه في يوم 08/08/2023', 'قيد دعوى أثبات نسب', 'محكمة عين الباشا الشرعية', NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-07-23 14:13:49', '2023-09-17 10:56:51', NULL),
(41, 'LSN-00020', 4, 73, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-23', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره القانونيه', NULL, 'المكتب', NULL, 'running', 'procedure', NULL, NULL, NULL, 0, '2023-07-23 16:33:13', '2023-07-23 16:33:13', NULL),
(42, 'LSJ-00010', 4, 60, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-03', NULL, NULL, NULL, NULL, 'تم التواصل و مراجعه وزاره الخارجيه و وزاره الداخليه لمتابعه الطلب الخاص بالسيد محمود مدحت.\r\n\r\nتم الرفض لأسباب أمنيه في يوم 07/17/2023', 'مراجعه وزاره الخارجيه و وزاره الداخليه', 'وزاره الخارجيه و وزاره الداخليه', '2023-07-15', 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-24 13:31:44', '2023-08-17 19:54:18', NULL),
(43, '357/2023', 1, 31, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-24', NULL, NULL, NULL, NULL, 'تم ختم المذكره و الأنتباه لمضي المدد', 'ختم المذكره', 'محكمه أستئناف عمان', '2023-07-29', 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-07-24 14:14:42', '2023-08-16 16:27:20', NULL),
(44, 'LSN-00010', 14, 72, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-24', NULL, NULL, NULL, NULL, 'تم مراجعه المحكمه الشرعيه لتسجيل الدعوى لكن لعدم وجود أي رقم للمدعى عليه طلبت المحكمه مراجعه الأقامه و الحدود لأحضار كشف ثم مخاطبه دائره قاضي القضاه لغايات السماح بتسجيل الدعوى.', 'للمسح', 'إدارة الإقامة و الحدود (عبير)', '2023-07-27', 'running', 'procedure', NULL, NULL, NULL, 0, '2023-07-25 13:08:56', '2023-09-04 16:18:54', NULL),
(45, 'LSN-00019', 1, 74, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-25', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره القانونيه للموكل.\r\nتم التوقيع على الوكاله من قبل الموكل و الموافقه من طرفه للمضي في الاجراءات القانونيه لألغاء الغرامات المترتبه عليه.', NULL, 'أستشاره', '2023-07-29', 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-25 14:34:36', '2023-07-25 15:37:13', NULL),
(46, 'LSZ-00014', 1, 75, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-30', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره القانونيه للموكل.\r\nتمت موافقه الموكل على توقيع التوكيل للمضي في إجراءات تصويب أوضاع الموكل و أبنائه.', 'تم تقديم الأستشاره القانونيه للموكل', 'أستشاره', '2023-08-10', 'completed', 'procedure', NULL, NULL, NULL, 0, '2023-07-30 10:37:07', '2023-08-16 16:25:05', NULL),
(47, NULL, 4, 76, 'claimant', NULL, NULL, '7782', '2023', NULL, '2023-07-27', NULL, 'صلح جزاء شرق عمان', 'عبير حمد', 0.00, 'تأجلت الجلسه لأحضار محمد برهوم لسماع افادته ليوم 09/13', NULL, NULL, NULL, 'pending', 'case', NULL, NULL, NULL, 0, '2023-07-30 13:56:52', '2023-09-18 10:32:28', '2023-09-18 10:32:28'),
(48, NULL, 1, 31, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-05', NULL, NULL, NULL, NULL, NULL, 'مراجعة اراضي', 'دائرة الاراضي', '2023-08-05', 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-05 18:59:30', '2023-08-05 18:59:30', NULL),
(49, NULL, 1, 80, 'plaintiff', NULL, NULL, NULL, NULL, NULL, '2023-07-06', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-07 12:55:24', '2023-08-20 16:37:12', NULL),
(50, NULL, 4, 81, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-07', NULL, 'صلح حقوق عمان', 'نيفين', NULL, 'تم تسجيل القضيه و تحديد أول جلسه بتاريخ 14/09/2023', 'تعويض عن ضرر', NULL, NULL, 'pending', 'case', NULL, NULL, NULL, 0, '2023-08-07 17:35:29', '2023-08-15 13:41:22', '2023-08-15 13:41:22'),
(51, NULL, 4, 81, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-07', NULL, 'صلح حقوق عمان', 'نيفين', NULL, 'تم تسجيل القضيه و تحديد أول جلسه بتاريخ 14/09/2023', 'تعويض عن ضرر', NULL, NULL, 'pending', 'case', NULL, NULL, NULL, 0, '2023-08-07 17:35:39', '2023-08-15 13:41:05', '2023-08-15 13:41:05'),
(52, NULL, 4, 81, 'plaintiff', NULL, NULL, '18297', '2023', NULL, '2023-08-07', NULL, 'صلح حقوق عمان', 'نيفين', 0.00, 'تم تسجيل القضيه و تحديد أول جلسه بتاريخ 14/09/2023', 'تعويض عن ضرر', NULL, NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-08-07 17:35:45', '2023-09-11 10:31:38', NULL),
(53, NULL, 14, 79, 'plaintiff', NULL, NULL, '0', NULL, NULL, '2023-08-09', NULL, NULL, NULL, NULL, NULL, 'تم مراجعه محكمه مأدبا استثناءً واستصدار مشروحات لمخاطبه إداره الاقامه و الحدود و تم تسليمها و بأنتظار الرد', 'محكمه مأدبا الشرعيه', NULL, 'running', 'procedure', NULL, NULL, NULL, 0, '2023-08-09 15:23:47', '2023-08-20 13:56:25', NULL),
(54, 'LSN-00024', 4, 83, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-13', NULL, NULL, NULL, NULL, NULL, 'تم مراجعه شؤون اللاجئين السوريين و تم تقديم طلب تصويب الأوضاع', 'مديرية شؤون اللاجئين السوريين', NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-14 16:11:16', '2023-08-14 16:11:16', NULL),
(55, 'LSN-00024', 4, 82, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-13', NULL, NULL, NULL, NULL, NULL, 'تم مراجعه شؤون اللاجئين السوريين و تم تقديم طلب تصويب الأوضاع', 'مديرية شؤون اللاجئين السوريين', NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-14 16:31:43', '2023-08-14 16:31:43', NULL),
(56, NULL, 4, 83, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-15', NULL, NULL, NULL, 6.00, 'تم دفع 6 دنانير على طلب نموذج أثبات الدخول و الخروج', 'أستخراج أرقام شخصيه للموكل ولأفراد أسرته', NULL, NULL, 'completed', 'case', 'تم أستخراج أرقام شخصيه', '2023-08-15 02:30:26', NULL, 0, '2023-08-15 13:33:57', '2023-09-03 10:05:07', '2023-09-03 10:05:07'),
(57, 'LSN-00021', 4, 77, 'claimant', NULL, NULL, '9742', NULL, NULL, '2023-08-08', NULL, NULL, NULL, NULL, NULL, 'تقديم مشروحات من مديريه شؤون اللاجئين السوريين لدى دائره الاحوال المدنيه و الجوازات لتصويب وضع الموكل و أبنه أسامه', 'مديريه شؤون اللاجئين السوريين', NULL, 'running', 'procedure', NULL, NULL, NULL, 0, '2023-08-15 13:47:56', '2023-08-15 13:47:56', NULL),
(58, NULL, 4, 77, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-10', NULL, NULL, NULL, 2.00, NULL, 'أستخراج رقم شخصي للموكل وأبنه أسامه', NULL, NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-08-15 14:05:35', '2023-09-04 13:46:41', '2023-09-04 13:46:41'),
(59, 'LSN-00021', 4, 77, 'claimant', NULL, NULL, '793174', NULL, NULL, '2023-08-10', NULL, NULL, NULL, NULL, NULL, 'أستخراج شهاده ميلاد لأبن الموكل أسامه', 'دائره الأحوال المدنيه و الجوازات', NULL, 'completed', 'procedure', 'تم أستخراج شهاده ميلاد لأسامه أبن الموكل', '2023-09-04 01:44:12', NULL, 0, '2023-08-15 14:16:26', '2023-09-04 13:44:12', NULL),
(60, 'LSN-00021', 4, 77, 'claimant', NULL, NULL, '4', NULL, NULL, '2023-08-10', NULL, NULL, NULL, NULL, NULL, 'أستخراج رقم شخصي للموكل وأبنه أسامه', 'وزاره الداخليه/ دائره الأقامه و الحدود', NULL, 'completed', 'procedure', 'تم أستخراج رقم شخصي للموكل', '2023-09-04 01:38:24', NULL, 0, '2023-08-15 14:18:13', '2023-09-04 13:38:24', NULL),
(61, NULL, 14, 82, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-15', NULL, NULL, NULL, 1.00, NULL, 'أستخراج رقم شخصي', NULL, NULL, 'completed', 'case', 'تم أستخراج الرقم الشخصي', '2023-08-15 02:27:22', NULL, 0, '2023-08-15 14:24:00', '2023-09-04 13:32:40', '2023-09-04 13:32:40'),
(62, NULL, 14, 56, 'plaintiff', NULL, NULL, '10800696', '2023', NULL, '2023-07-02', NULL, NULL, NULL, 0.00, 'أستخراج رقم شخصي', 'أستخراج رقم شخصي', NULL, NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-08-16 16:15:46', '2023-09-04 12:09:37', '2023-09-04 12:09:37'),
(63, NULL, 1, 113, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 13:51:11', '2023-09-12 14:28:03', NULL),
(64, NULL, 1, 90, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'completed', 'procedure', 'تم تقديم الأستشاره', '2023-08-30 09:57:27', NULL, 0, '2023-08-20 14:00:35', '2023-08-30 09:57:27', NULL),
(65, NULL, 1, 91, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'running', 'procedure', 'تم تقديم الأستشاره', '2023-08-30 09:57:32', NULL, 0, '2023-08-20 14:04:17', '2023-08-30 09:57:32', NULL),
(66, NULL, 1, 92, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 14:07:00', '2023-08-20 14:07:00', NULL),
(67, NULL, 1, 93, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 14:11:39', '2023-08-20 14:11:39', NULL),
(68, NULL, 1, 94, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 14:19:08', '2023-08-20 14:19:08', NULL),
(69, NULL, 1, 95, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 14:21:01', '2023-08-20 14:21:01', NULL),
(70, 'LSZ-00022', 1, 96, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 14:23:30', '2023-09-17 16:54:17', NULL),
(71, NULL, 1, 97, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 14:27:01', '2023-08-20 14:27:01', NULL),
(72, NULL, 1, 98, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 14:39:30', '2023-08-20 14:39:30', NULL),
(73, NULL, 1, 99, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'تم تقديم أستشاره', 'تقديم أستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 14:43:37', '2023-08-20 14:43:37', NULL),
(74, 'LSN-00005', 4, 56, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-08', NULL, NULL, NULL, NULL, 'تم تقديم طلب لأستخراج شهاده عدم محكوميه لغايات تقديم طلب لأستصدار جواز سفر', 'شهاده عدم محكوميه', 'وزاره العدل', '2023-08-08', 'completed', 'procedure', 'تم الحصول على شهاده عدم محكوميه بتاريخ 08/08/2023', '2023-08-20 04:06:01', NULL, 0, '2023-08-20 16:00:48', '2023-08-20 16:06:01', NULL),
(75, 'LSN-00005', 4, 56, 'claimant', NULL, NULL, '792471', NULL, NULL, '2023-08-08', NULL, NULL, NULL, NULL, 'تم أستصدار شهاده زواج', 'أستصدار شهاده زواج', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', NULL, 'completed', 'procedure', 'تم أصدار شهاده زواج', '2023-08-20 04:14:54', NULL, 0, '2023-08-20 16:11:36', '2023-08-20 16:14:54', NULL),
(76, NULL, 4, 80, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-20', NULL, NULL, NULL, NULL, NULL, 'تم مراجعه مديريه شؤون اللاجئين السوريين و أخذ أفاده الموكله و أبنائها', 'مديريه شؤون اللاجئين السوريين', NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-20 16:39:17', '2023-08-20 16:39:17', NULL),
(77, NULL, 4, 80, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-06', NULL, NULL, NULL, 3.00, NULL, 'أستصدار أرقام شخصيه للموكله وأبنائها', NULL, NULL, 'completed', 'case', 'تم أستصدار أرقام شخصيه للموكله و أبنائها', '2023-08-20 04:51:36', NULL, 0, '2023-08-20 16:41:06', '2023-09-03 16:05:10', '2023-09-03 16:05:10'),
(78, NULL, 4, 59, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, NULL, 'تم مراجعه الأحوال المدنيه لأصدار شهاده ميلاد للطفل بالاسم الصحيح و تبين أن أسم الأم لازال هو القديم لدى الأحوال المدنيه و تم التواصل مع مديريه شؤون اللاجئين و سيتم تزويدنا بكتاب لغايات التصحيح', 'دائره الأحوال المدنيه و الجوازات', NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-21 11:56:04', '2023-08-21 11:56:04', NULL),
(79, NULL, 14, 79, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, NULL, 'للتعديل', NULL, '2023-08-23', 'completed', 'procedure', 'تم أستصدار حجه وصايا مؤقته للغايات المرجوه للمضي في أستخراج الوثائق المطلوبه لأبناء الموكله', '2023-08-23 01:30:10', NULL, 0, '2023-08-23 13:22:04', '2023-09-13 12:24:02', NULL),
(80, NULL, 14, 63, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, NULL, 'للتعديل', 'محكمه أربد الشرعيه', '2023-08-23', 'running', 'procedure', NULL, NULL, NULL, 0, '2023-08-23 13:31:50', '2023-09-14 13:47:20', NULL),
(81, NULL, 4, 54, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-07-17', NULL, NULL, NULL, 0.00, NULL, 'أستصدار رقم شخصي لأبن الموكله', NULL, NULL, 'running', 'case', NULL, NULL, NULL, 0, '2023-08-23 14:43:01', '2023-09-04 13:28:38', '2023-09-04 13:28:38'),
(82, NULL, 4, 55, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-07-18', NULL, NULL, NULL, NULL, 'تم تقديم طلب بطاقات أبناء أردنيات لأبناء الموكله', 'طلب بطاقات أبناء أردنيات لأبناء الموكله', 'دائره الأحوال المدنيه و الجوازات', NULL, 'completed', 'procedure', 'تم الرفض على طلب بطاقات أبناء الأردنيات لأن الموكله على ذمه زوجها', '2023-08-23 03:02:25', NULL, 0, '2023-08-23 14:52:09', '2023-08-23 15:02:25', NULL),
(83, NULL, 1, 84, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-09', NULL, NULL, NULL, NULL, NULL, 'بتاريخ 09/8/2023 تم تقديم استشاره بخصوص الية تصويب الأوضاع الخاصة بالموكل وإصدار جواز سفر مؤقت', NULL, NULL, 'pending', 'procedure', NULL, NULL, NULL, 0, '2023-08-23 16:02:59', '2023-08-23 16:02:59', NULL),
(84, 'LSN-00010', 4, 72, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-27', NULL, NULL, NULL, NULL, NULL, 'بتاريخ 27/08/2023 تم مراجعه مديرية شؤون اللاجئين السوريين و تم أخذ أقوال الموكله بحضورنا و تم تصحيح الأسم لدى نظام الأمن العام و باقي الجهات الرسميه و الحكوميه و تم الأفاده بأنهم سيقومون بتسليم كتاب موجه للأحوال المدنيه يفيد بتصحيح أسم الموكله فور أكتمال الكتاب.', 'مديرية شؤون اللاجئين السوريين', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-27 16:19:10', '2023-08-27 16:19:10', NULL),
(85, 'LSI-00007', 4, 87, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-27', NULL, NULL, NULL, NULL, 'أستحال تقديم طلب للحصول على جواز السفر بسبب عدم كفايه الأوراق الثبوتيه لأتمام الطلب و مع الأتصال مع الموكله أفادت بأنها لا تملك الأوراق الكافيه المطلوبه. تم توصيتها بأغلاق الملف', 'تقديم طلب للحصول على جواز السفر', 'وزاره الداخليه', NULL, 'completed', 'procedure', 'أستحال تقديم طلب للحصول على جواز السفر بسبب عدم كفايه الأوراق الثبوتيه لأتمام الطلب و مع الأتصال مع الموكله أفادت بأنها لا تملك الأوراق الكافيه المطلوبه. تم توصيتها بأغلاق الملف', '2023-08-27 04:43:16', 6, 0, '2023-08-27 16:42:50', '2023-08-27 16:43:16', NULL),
(86, 'الزرقاء', 4, 95, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, NULL, 'أستصدار بطاقة أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', NULL, 'completed', 'procedure', 'تم أستصدار بطاقه أبناء أردنيات', '2023-08-28 02:04:33', 6, 0, '2023-08-27 17:04:17', '2023-08-28 14:04:33', NULL),
(87, 'LSN-00027', 4, 85, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, NULL, 'بتاريخ 21/8/2023 تم مراجعه شؤون اللاجئين السوريين و تم الأفاده بأنه قد تم تصويب أسم الموكله بناءً على طلبنا و سيتم تجهيز الكتاب الخاص في هذا الشأن ليتم تسليمه لوزاره التربيه و التعليم لأستخراج وثائق في أسمائهم الصحيحه كما أنه تم تغير جنسيتهم و تواريخ ميلادهم لدى النظام و سيتم أستخراج وثائقهم بمعلوماتهم الصحيحه من الجهات و الدوائر الحكوميه', 'مديرية شؤون اللاجئين السوريين', NULL, 'running', 'procedure', NULL, NULL, 6, 0, '2023-08-28 14:23:03', '2023-08-28 14:23:03', NULL),
(88, NULL, 4, 111, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-28', NULL, NULL, NULL, NULL, NULL, 'تم التوجه الى دائره الأحوال المدنيه و استصدار شهاده ولاده لأبن الموكله', 'دائره الأحوال المدنيه و الجوازات', NULL, 'completed', 'procedure', 'تم أستصدار شهاده ولاه لأبن الموكله', '2023-08-28 03:50:28', 6, 0, '2023-08-28 15:39:42', '2023-08-28 15:50:28', NULL),
(89, NULL, 4, 111, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-28', NULL, 'مديريه الأقامه و الحدود', NULL, 2.00, 'تم دفع دينارين- دينار لكل رقم شخصي', 'أستصدار رقم شخصي للموكله ولشهاده وفاه زوجها', NULL, NULL, 'completed', 'case', 'تم أستصدار أرقام شخصيه للموكله', '2023-08-28 03:49:57', 6, 0, '2023-08-28 15:46:31', '2023-09-03 15:08:10', '2023-09-03 15:08:10'),
(90, NULL, 1, 51, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-06-21', NULL, NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', NULL, NULL, 'completed', 'procedure', 'تم تقديم الأستشاره', '2023-08-29 10:14:00', 6, 0, '2023-08-29 10:13:44', '2023-08-29 10:14:00', NULL),
(91, NULL, 4, 51, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-10', NULL, NULL, NULL, NULL, NULL, 'تقديم طلب أثبات جنسيه', 'السفاره الفلسطينيه', NULL, 'completed', 'procedure', 'تم الحصول على أثبات الجنسيه للموكل و عائلته', '2023-08-29 10:20:23', 6, 0, '2023-08-29 10:18:03', '2023-08-29 10:20:23', NULL),
(92, NULL, 1, 111, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-27', NULL, NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكله', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-29 11:52:42', '2023-08-29 11:52:42', NULL),
(93, NULL, 1, 110, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-27', NULL, NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره', NULL, NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-29 11:53:42', '2023-08-29 11:53:42', NULL),
(94, NULL, 1, 109, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-29 11:55:09', '2023-08-29 11:55:09', NULL),
(95, NULL, 1, 108, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-29 11:56:18', '2023-08-29 11:56:18', NULL),
(96, NULL, 4, 90, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-29', NULL, NULL, NULL, NULL, NULL, 'أستخراج أثبات جنسيه', 'سفاره السلطه الفلسطينيه', NULL, 'completed', 'procedure', 'تم أستخراج أثبات جنسيه للموكل', '2023-09-03 10:26:25', 6, 0, '2023-08-30 10:00:30', '2023-09-03 10:26:25', NULL),
(97, NULL, 4, 91, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, NULL, 'أستخراج أثبات جنسيه', 'سفاره السلطه الفلسطينيه', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 10:00:31', '2023-08-30 10:00:31', NULL),
(98, NULL, 4, 90, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-29', NULL, NULL, NULL, 1.00, 'تم دفع 1 دينار طوابع لطلب أثبات دخول/ مغادره لغايات أستصدار الرقم الشخصي', 'أستصدار رقم شخصي', NULL, NULL, 'completed', 'case', 'تم أستصدار رقم شخصي للموكل', '2023-08-30 10:16:35', 6, 0, '2023-08-30 10:10:28', '2023-09-03 10:25:32', '2023-09-03 10:25:32'),
(99, NULL, 4, 91, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-08-29', NULL, NULL, NULL, 0.00, NULL, 'أستصدار رقم شخصي', NULL, NULL, 'completed', 'case', 'تم أستصدار رقم شخصي للموكل', '2023-08-30 10:16:32', 6, 0, '2023-08-30 10:11:50', '2023-09-03 09:58:05', '2023-09-03 09:58:05'),
(100, NULL, 1, 107, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'أربد الحديقه', 'تم تقديم الأستشاره للموكل', NULL, NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 13:03:08', '2023-08-30 13:03:08', NULL),
(101, NULL, 1, 106, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'أربد الحديقه', 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 13:04:18', '2023-08-30 13:04:43', NULL),
(102, NULL, 1, 105, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'أربد الحديقه', 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 13:05:20', '2023-08-30 13:05:20', NULL),
(103, NULL, 1, 104, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, 'مكتب أربد', 'تم تقديم الأستشاره للموكله', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 13:06:09', '2023-08-30 13:06:09', NULL),
(104, NULL, 1, 103, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, 'مكتب أربد', 'تم تقديم الأستشاره للموكله', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 13:07:11', '2023-08-30 13:07:11', NULL),
(105, NULL, 1, 102, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, 'مكتب أربد', 'تم تقديم الأستشاره للموكله', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 13:08:55', '2023-08-30 13:08:55', NULL),
(106, NULL, 1, 101, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, 'مكتب أربد', 'تم تقديم الأستشاره للموكله', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 13:09:33', '2023-08-30 13:09:33', NULL),
(107, NULL, 1, 100, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, 'مكتب أربد', 'تم تقديم الأستشاره للموكله', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 13:10:34', '2023-08-30 13:10:34', NULL),
(108, NULL, 1, 112, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', NULL, 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 14:23:48', '2023-08-30 14:23:48', NULL),
(109, NULL, 1, 113, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'الزرقاء', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:17:56', '2023-08-30 15:17:56', NULL),
(110, NULL, 1, 114, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-16', NULL, NULL, NULL, NULL, 'الزرقاء', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:21:25', '2023-08-30 15:21:25', NULL),
(111, NULL, 1, 115, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:35:12', '2023-08-30 15:35:12', NULL),
(112, NULL, 1, 116, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:38:05', '2023-08-30 15:38:05', NULL),
(113, NULL, 1, 117, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, NULL, 'تم تقجيم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:51:12', '2023-08-30 15:51:12', NULL),
(114, NULL, 1, 118, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:53:41', '2023-08-30 15:53:41', NULL),
(115, NULL, 1, 119, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:56:04', '2023-08-30 15:56:04', NULL),
(116, NULL, 1, 120, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:58:00', '2023-08-30 15:58:00', NULL),
(117, NULL, 1, 120, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره للموكل', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-30 15:58:10', '2023-08-30 15:58:10', NULL),
(118, NULL, 1, 121, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-22', NULL, NULL, NULL, NULL, 'القادسيه', 'تم تقديم الاستشاره', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-31 12:57:16', '2023-08-31 12:57:16', NULL),
(119, NULL, 1, 126, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-30', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-31 13:09:11', '2023-08-31 13:10:29', NULL),
(120, NULL, 1, 125, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-30', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-31 13:09:44', '2023-08-31 13:12:04', NULL),
(121, NULL, 1, 123, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-30', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-31 13:10:10', '2023-08-31 13:13:10', NULL),
(122, NULL, 1, 124, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-30', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-31 13:11:10', '2023-08-31 13:11:10', NULL),
(123, NULL, 1, 122, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-30', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-31 13:13:33', '2023-08-31 13:13:33', NULL),
(124, NULL, 1, 128, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-30', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-31 13:15:19', '2023-08-31 13:15:38', NULL),
(125, NULL, 1, 127, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-30', NULL, NULL, NULL, NULL, 'الحديقه', 'تم تقديم الأستشاره القانونيه', 'أستشاره', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-08-31 13:16:24', '2023-08-31 13:16:24', NULL),
(126, NULL, 4, 91, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-29', NULL, NULL, NULL, NULL, NULL, 'أستصدار رقم شخصي', 'وزاره الداخليه', NULL, 'running', 'procedure', NULL, NULL, 6, 0, '2023-09-03 09:53:24', '2023-09-03 09:53:24', NULL),
(127, NULL, 4, 83, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-25', NULL, NULL, NULL, NULL, 'أستخراج أرقام شخصيه للموكل ولأفراد أسرته', 'أستخراج أرقام شخصيه للموكل ولأفراد أسرته', 'وزاره الداخليه', NULL, 'completed', 'procedure', 'تم أستخراج أرقام شخصيه للموكل و عائلته المكونه من 7 أفراد', '2023-09-03 10:04:58', 6, 0, '2023-09-03 10:00:19', '2023-09-12 14:02:19', NULL),
(128, NULL, 4, 90, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-29', NULL, NULL, NULL, NULL, NULL, 'أستصدار رقم شخصي', 'وزاره الداخليه', NULL, 'completed', 'procedure', 'تم أستصدار رقم شخصي للموكل', '2023-09-03 10:25:53', 6, 0, '2023-09-03 10:19:45', '2023-09-03 10:25:53', NULL),
(129, NULL, 4, 111, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-28', NULL, NULL, NULL, NULL, 'أستصدار رقم شخصي للموكله ولشهاده وفاه زوجها', 'أستصدار رقم شخصي للموكله ولشهاده وفاه زوجها', 'وزاره الداخليه/ دائره الأقامه و الحدود', NULL, 'completed', 'procedure', 'تم أستصدار أرقام شخصيه للموكله و عائلتها', '2023-09-04 02:22:03', 6, 0, '2023-09-03 15:01:03', '2023-09-04 14:22:03', NULL),
(130, 'LSN-00022', 4, 80, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-26', NULL, NULL, NULL, NULL, 'أستصدار أرقام شخصيه للموكله وأبنائها', 'أستصدار أرقام شخصيه للموكله وأبنائها', 'وزاره الداخليه/ دائره الأقامه و الحدود', NULL, 'completed', 'procedure', 'تم أستصدار أرقام شخصيه للموكله و عائلتها', '2023-09-04 02:21:41', 6, 0, '2023-09-03 15:54:47', '2023-09-04 14:21:41', NULL),
(131, NULL, 4, 99, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-03', NULL, NULL, NULL, NULL, NULL, 'أستخراج أثبات جنسيه للموكل  لأبنه و أبنته', 'السفاره الفلسطينيه', NULL, 'completed', 'procedure', 'تم أستخراج أثبات جنسيه للموكل لأبنه و أبنته', '2023-09-03 05:04:44', 6, 0, '2023-09-03 17:02:38', '2023-09-03 17:04:44', NULL),
(132, NULL, 4, 58, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-03', NULL, NULL, NULL, NULL, 'أستخراج أثبات جنسيه للموكله', 'أستخراج أثبات جنسيه للموكله', 'سفاره السلطه الفلسطينيه', NULL, 'completed', 'procedure', 'تم أستخراج أثبات جنسيه للموكله', '2023-09-03 05:07:24', 6, 0, '2023-09-03 17:05:35', '2023-09-03 17:07:24', NULL),
(133, NULL, 4, 129, 'plaintiff', NULL, NULL, '6037', '2023', NULL, '2023-09-04', NULL, 'صلح حقوق شمال عمان', NULL, 2544.80, 'تم تسجيل القضيه و تفهمت الجلسه بيوم 19/9/2023', 'مطالبه ماليه - قضيه عماليه', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-04 12:38:38', '2023-09-19 14:50:07', NULL),
(134, NULL, 4, 36, 'plaintiff', NULL, NULL, '6817', '2020', NULL, '2023-09-04', NULL, 'صلح جزاء شمال عمان', NULL, 11000.00, NULL, 'أساءه أمانه و تزوير و سرقه', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-04 12:44:08', '2023-09-04 12:44:08', NULL),
(135, NULL, 4, 82, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-08-15', 0, NULL, NULL, NULL, NULL, 'أستخراج رقم شخصي للموكله', 'وزاره الداخليه/ دائره الأقامه و الحدود', NULL, 'completed', 'procedure', 'تم أستخراج رقم شخصي', '2023-09-04 01:33:14', 6, 0, '2023-09-04 13:29:54', '2023-09-04 13:33:14', NULL),
(136, NULL, 14, 79, 'plaintiff', NULL, NULL, '3070', '2023', NULL, '2023-08-22', NULL, 'أربد الشرعيه', NULL, 6.00, 'تم دفع 6 دنانير لحجه الوصايا', 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه وزاره التنميه الأجتماعيه', NULL, NULL, 'completed', 'case', 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه وزاره التنميه الأجتماعيه', '2023-09-04 02:01:06', 6, 0, '2023-09-04 13:50:54', '2023-09-04 14:01:06', NULL),
(137, NULL, 14, 79, 'plaintiff', NULL, NULL, '3073', '2023', NULL, '2023-08-22', NULL, 'أربد الشرعيه', NULL, 6.00, 'تم دفع 6 دنانير لحجه الوصايا', 'بتاريخ 22/08/2023 تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه لوزاره الداخليه', NULL, NULL, 'completed', 'case', 'تم أستصدار حجه وصايا على أبناء الموكله لغايه لوزاره الداخليه', '2023-09-04 01:58:09', 6, 0, '2023-09-04 13:52:14', '2023-09-04 13:58:09', NULL),
(138, NULL, 14, 79, 'plaintiff', NULL, NULL, '3069', '2023', NULL, '2023-08-22', NULL, 'أربد الشرعيه', NULL, 6.00, 'تم دفع 6 دنانير لحجه الوصايا', 'بتاريخ 22/08/2023 تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه لوزاره التربيه و التعليم', NULL, NULL, 'completed', 'case', 'تم أستصدار حجه وصايا لغايه وزاره التربيه و التعليم', '2023-09-04 01:55:13', 6, 0, '2023-09-04 13:53:13', '2023-09-04 13:55:13', NULL),
(139, NULL, 14, 63, 'plaintiff', NULL, NULL, '3076', '2023', NULL, '2023-08-22', NULL, 'أربد الشرعيه', NULL, 6.00, 'تم دفع مبلغ 6 دنانير', 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه لوزاره التنميه الأجتماعيه', NULL, NULL, 'completed', 'case', 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه لوزاره التنميه الأجتماعيه', '2023-09-04 02:17:59', 6, 0, '2023-09-04 14:10:42', '2023-09-04 14:17:59', NULL),
(140, NULL, 14, 63, 'plaintiff', NULL, NULL, '3072', '2023', NULL, '2023-08-22', NULL, 'أربد الشرعيه', NULL, 6.00, 'تم دفع مبلغ 6 دنانير', 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكل لغايه وزاره الداخليه', NULL, NULL, 'completed', 'case', 'تم أستصدار حجه وصايا  على أبناء الموكل لغايه وزاره الداخليه', '2023-09-04 02:16:56', 6, 0, '2023-09-04 14:11:46', '2023-09-04 14:16:56', NULL),
(141, NULL, 14, 63, 'plaintiff', NULL, NULL, '3075', '2023', NULL, '2023-08-22', NULL, 'أربد الشرعيه', NULL, 6.00, 'تم دفع مبلغ 6 دنانير', 'أستصدار حجه وصايا لغايه وزاره التربيه و التعليم', NULL, NULL, 'completed', 'case', 'تم أستصدار حجه وصايا لغايه وزاره التربيه و التعليم', '2023-09-04 02:15:11', 6, 0, '2023-09-04 14:12:28', '2023-09-04 14:15:11', NULL),
(142, NULL, 14, 55, 'plaintiff', NULL, NULL, '108000697', '2023', NULL, '2023-07-04', NULL, 'محكمة مأدبا الشرعيه', NULL, 6.00, 'تم دفع 6 دنانير', 'أستصدار حجه وصايا مؤقته للصغير عز الدين', NULL, NULL, 'running', 'case', 'تم أستخراج حجه وصايا للموكله', '2023-09-04 02:54:57', 6, 0, '2023-09-04 14:25:14', '2023-09-04 14:54:57', NULL),
(143, NULL, 4, 34, 'plaintiff', NULL, NULL, '2437', '2023', NULL, '2023-03-19', NULL, 'صلح جزاء شمال عمان', NULL, 0.00, NULL, 'أحتيال- أساءه أمانه', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-04 15:22:06', '2023-09-04 15:22:06', NULL),
(144, NULL, 14, 72, 'plaintiff', NULL, NULL, '1108', '2023', NULL, '2023-08-03', NULL, 'محكمة مأدبا الشرعيه', NULL, 0.00, 'تم تسجيل قضيه أثبات نسب', 'تسجيل قضيه أثبات نسب', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-04 16:08:25', '2023-09-04 16:08:25', NULL),
(145, NULL, 4, 52, 'plaintiff', NULL, NULL, '255', '2023', NULL, '2023-09-04', NULL, 'إستئناف الضريبه', NULL, 0.00, 'دعوى للمرة الثانية', 'منع مطالبة بضريبة دخل العام 2013', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-04 16:41:27', '2023-09-18 10:16:39', NULL),
(146, NULL, 4, 42, 'plaintiff', NULL, NULL, '2852', '2023', NULL, '2023-09-04', NULL, 'ضد عاطف', NULL, 0.00, NULL, 'أستئناف', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-04 16:46:48', '2023-09-20 10:02:44', '2023-09-20 10:02:44'),
(147, NULL, 4, 47, 'plaintiff', NULL, NULL, '574', '2020', NULL, '2020-09-05', NULL, 'محكمة بداية الضريبة', NULL, 0.00, NULL, 'منع مطالبة بضريبة مبيعات', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-05 13:57:06', '2023-09-18 10:15:24', NULL),
(148, NULL, 4, 35, 'plaintiff', NULL, NULL, '154', '2023', NULL, '2023-09-05', NULL, 'أستئناف الضريبيه', NULL, 0.00, NULL, 'ضريبيه', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-05 14:01:03', '2023-09-18 10:02:34', '2023-09-18 10:02:34'),
(149, NULL, 4, 54, 'plaintiff', NULL, NULL, '8681', '2023', NULL, '2022-08-03', NULL, 'ضد شادي', NULL, 0.00, NULL, 'عماليه', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-05 14:06:21', '2023-09-05 14:08:56', NULL),
(150, NULL, 4, 133, 'defendant', NULL, NULL, '6032', '2023', NULL, '2021-09-05', NULL, 'بدايه حقوق عمان', NULL, 0.00, NULL, 'مطالبه ماليه', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-05 14:49:18', '2023-09-05 14:49:18', NULL),
(151, NULL, 4, 97, 'plaintiff', NULL, NULL, '69', '2022', NULL, '2023-09-07', NULL, 'صلح حقوق الأزرق', NULL, 0.00, NULL, 'دعوى تثبيت قيد ولاده', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-10 11:23:34', '2023-09-10 11:23:34', NULL),
(152, NULL, 14, 55, 'plaintiff', NULL, NULL, '1304', '2022', NULL, '2023-09-07', NULL, 'محكمه مأدبا الشرعيه', NULL, 0.00, NULL, 'تم قيد دعوى تفريق للأفتداء', 'محكمه مادبا الشرعيه', NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-10 14:22:10', '2023-09-17 10:40:20', NULL),
(153, NULL, 17, 40, 'plaintiff', NULL, NULL, '2355', '2020', NULL, '2023-09-06', NULL, 'غرب عمان', NULL, 0.00, NULL, NULL, NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-11 10:34:35', '2023-09-19 14:50:27', NULL),
(154, NULL, 4, 49, 'plaintiff', NULL, NULL, '5100', '2023', NULL, '2023-09-01', NULL, 'أستئناف', NULL, 0.00, NULL, NULL, NULL, NULL, 'pending', 'case', NULL, NULL, 6, 0, '2023-09-11 10:41:27', '2023-09-11 10:42:49', '2023-09-11 10:42:49'),
(155, NULL, 4, 49, 'plaintiff', NULL, NULL, '5100', '2023', NULL, '2023-09-01', NULL, 'أستئناف', NULL, 0.00, NULL, 'أستئناف', 'أستئناف', NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-11 10:42:19', '2023-09-12 12:01:38', NULL),
(156, NULL, 4, 38, 'plaintiff', NULL, NULL, '3583', '2023', NULL, '2023-09-10', NULL, 'صلح حقوق شمال عمان', NULL, 0.00, NULL, NULL, NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-11 10:46:41', '2023-09-11 10:46:41', NULL),
(157, NULL, 4, 48, 'plaintiff', NULL, NULL, '9112', '2023', NULL, '2023-09-11', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-11 14:23:12', '2023-09-11 14:23:12', NULL),
(158, NULL, 4, 37, 'plaintiff', NULL, NULL, '270', '2023', NULL, '2023-09-11', NULL, 'بدايه حقوق الزرقاء', NULL, 0.00, NULL, NULL, NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-11 14:53:33', '2023-09-11 14:53:33', NULL),
(159, NULL, 18, 39, 'plaintiff', NULL, NULL, '167', '2022', NULL, '2023-09-11', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-11 15:10:18', '2023-09-12 12:16:38', NULL),
(160, NULL, 4, 62, 'plaintiff', NULL, NULL, '8408', '2022', NULL, '2023-09-01', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-11 16:36:27', '2023-09-11 16:48:18', NULL),
(161, NULL, 4, 45, 'plaintiff', NULL, NULL, '7833', '2023', NULL, '2023-09-11', NULL, 'أستئناف عمان', NULL, 0.00, NULL, 'تعويض', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-11 16:46:07', '2023-09-17 12:14:51', NULL),
(162, NULL, 4, 76, 'plaintiff', NULL, NULL, '7782', '2023', NULL, '2023-07-27', NULL, 'صلح جزاء شرق عمان', NULL, 0.00, NULL, 'اساءه أمانه بدلاله الماده 15', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-12 13:50:22', '2023-09-18 10:58:57', '2023-09-18 10:58:57');
INSERT INTO `problems` (`id`, `id_secondary`, `admin_id`, `client_id`, `client_type`, `other_person`, `other_lawer`, `problem_number`, `problem_date`, `next_session_date`, `file_open_date`, `number_days_remind`, `court`, `judge`, `cost`, `notes`, `subject`, `reviewer`, `deadline`, `status`, `type`, `finish_notes`, `finish_date`, `created_by`, `send_email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(163, NULL, 18, 132, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 13:57:48', '2023-09-12 13:57:48', NULL),
(164, NULL, 18, 131, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 13:59:30', '2023-09-12 13:59:30', NULL),
(165, NULL, 18, 116, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:00:16', '2023-09-12 14:00:16', NULL),
(166, NULL, 18, 73, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:00:34', '2023-09-12 14:00:34', NULL),
(167, NULL, 18, 127, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:00:59', '2023-09-12 14:00:59', NULL),
(168, NULL, 18, 83, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'completed', 'procedure', 'تم تصويب اوضاعه ومقابلة اللجنة الامنية والذهاب الى المخيم واتمام الامور  / عدم التسكين بسبب وجود حالة انسانية', '2023-09-18 03:59:37', 6, 0, '2023-09-12 14:02:42', '2023-09-18 15:59:37', NULL),
(169, NULL, 18, 82, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'running', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:02:58', '2023-09-12 14:02:58', NULL),
(170, NULL, 18, 80, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:03:15', '2023-09-12 14:03:15', NULL),
(171, NULL, 18, 74, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'completed', 'procedure', 'تم تصويب اوضاعه ومقابلة اللجنة الامنية والذهاب الى المخيم واعطائه اجازة  تجدد شهريا', '2023-09-18 03:58:27', 6, 0, '2023-09-12 14:03:38', '2023-09-18 15:58:27', NULL),
(172, NULL, 18, 124, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:03:55', '2023-09-12 14:03:55', NULL),
(173, NULL, 18, 94, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تصويب وضع', 'مديرية شؤون اللاجئين السوريين', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:04:11', '2023-09-12 14:04:11', NULL),
(174, NULL, 18, 101, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تجديد بطاقات أبناء أردنيات+ أقامه', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:05:45', '2023-09-12 14:05:45', NULL),
(175, NULL, 18, 122, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر خاص', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:07:24', '2023-09-12 14:07:24', NULL),
(176, NULL, 18, 115, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر خاص', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:07:38', '2023-09-12 14:07:38', NULL),
(177, NULL, 18, 123, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر خاص', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:07:54', '2023-09-12 14:07:54', NULL),
(178, NULL, 18, 112, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر خاص', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:08:12', '2023-09-12 14:08:12', NULL),
(179, NULL, 18, 110, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:09:09', '2023-09-12 14:09:09', NULL),
(180, NULL, 18, 99, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:09:36', '2023-09-12 14:09:36', NULL),
(181, NULL, 17, 103, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:11:00', '2023-09-12 14:11:00', NULL),
(182, NULL, 17, 107, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:11:31', '2023-09-12 14:11:31', NULL),
(183, NULL, 17, 108, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:12:04', '2023-09-12 14:12:04', NULL),
(184, NULL, 17, 102, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:12:40', '2023-09-12 14:12:40', NULL),
(185, NULL, 17, 109, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:13:22', '2023-09-12 14:13:22', NULL),
(186, NULL, 17, 68, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:13:44', '2023-09-12 14:13:44', NULL),
(187, NULL, 17, 93, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:13:56', '2023-09-12 14:13:56', NULL),
(188, NULL, 17, 89, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار بطاقات أبناء أردنيات', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:14:25', '2023-09-12 14:14:25', NULL),
(189, NULL, 17, 100, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر مؤقت', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:15:06', '2023-09-12 14:15:06', NULL),
(190, NULL, 17, 84, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر مؤقت', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:15:22', '2023-09-12 14:15:22', NULL),
(191, NULL, 17, 120, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر مؤقت', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:15:51', '2023-09-12 14:15:51', NULL),
(192, NULL, 17, 117, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر مؤقت', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:16:02', '2023-09-12 14:16:02', NULL),
(193, NULL, 17, 119, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر مؤقت', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:16:13', '2023-09-12 14:16:13', NULL),
(194, NULL, 17, 118, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر مؤقت', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:16:28', '2023-09-12 14:16:28', NULL),
(195, NULL, 17, 87, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'أصدار جواز سفر خاص', 'وزاره الداخليه/ دائره الأحوال المدنيه و الجوازات', '2023-09-25', 'running', 'procedure', NULL, NULL, 6, 0, '2023-09-12 14:17:23', '2023-09-12 14:17:23', NULL),
(196, NULL, 1, 138, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-12', NULL, NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره بخصوص:\r\n\r\nأولاً: مفهوم تصويب الأوضاع:\r\nهو اجراء امني اداري مشترك يستهدف اعادة تعريف الأشخاص المقيمين على أرض المملكة ليظهروا بالوصف الحقيقي لهم دون مُسألة قانونية، بما يساعد على فلترة قاعدة البيانات السكانية الوطنية.\r\n\r\nثانياً: إجراءات تصويب الأوضاع:\r\n1- يتم اصطحاب اللاجئ (زيارة رقم 1) الى مديرية شؤون اللاجئين السوريين في منطقة شفابدران/عمان أول مرة لغايات القيام بما يلي:\r\n\r\nأ- تقديم إفادة حول الوضع القانوني الخاص به وآلية دخوله للمملكة.\r\nب- أخذ بصمة عين خاصة به.\r\nج- تسليم الوثائق المزورة والوثائق غير الصحيحة (كوثائق المفوضية) التي بحوزته.\r\nد- إنشاء رقم شخصي جديد (\"داخلي\") خاص بالحالة.\r\n\r\n2- يتلو ذلك قيام الجهات المعنية بدراسة الملف وتقديم التوصية بشأن الحالة للجنة الأمنية.\r\n3- يتم عرض الحالة (زيارة رقم 2) على اللجنة الامنية، والتي تصدر قرارها بناءً على اجتماعها مع اللاجئ؛ حيث يكون قرارها عادة:\r\n\r\nأ- تصويب الأوضاع مع التسكين.\r\nب- تصويب الأوضاع مع التسكين لكن بكفالة.\r\nج- تصويب الأوضاع دون تسكين.\r\n\r\n4- بعد ذلك (وفي معظم الأحيان في ذات اليوم الخاص بالزيارة رقم 2) يتم اصطحاب اللاجئ الذي تقرر تسكينه في المخيم (ولو كان تسكيناً مع كفالة) الى مخيم الحديقة في الرمثا بواسطة حافلة تابعة للأمن العام.\r\n5- لدى وصول اللاجئ الى المخيم يتم قيد بياناته اصولاً والتأكد من بصمة عينه، ويباشر بعد ذلك في إجراءات تسكينه او اجراءات تكفيله حسب مقتضى الحال.\r\n6- يتلو ذلك ولدى المتابعة لدى مديرية شؤون اللاجئين الحصول على كتب لكل جهة من الجهات لغايات تصويب الأوضاع لديها وحسب مقتضى الحال.\r\n7- تبقى الأرقام الشخصية السابقة للاجئ (كسوري عادة) سارية لغايات الربط فيما بين معاملاته السابقة وشخصه بعد تصويب اوضاعه، إلا انه يمنح رقماً شخصياً جديداً لغايات الاستخدام في المعاملات من لحظة تصويب أوضاعه يبدأ بالرقم (800).\r\n\r\nثالثاً: مسائل ذات علاقة بتصويب الاوضاع:\r\n1- إن عملية تصويب الاوضاع للاجئ تتم لغايات اعادة تعريف هويته غير الصحيحة/المزورة بهوية أخرى صحيحة.\r\n2- يبقى وصف اللاجئ بعد تصويب اوضاعه على انه لاجئ (لغايات المعاملات الامنية والادارية)، إلا ان إقامته من لحظة تصويبه لاوضاعه تصبح إقامة صحيحة (بالحدود القانونية التي يعترف بها الأردن باقامة اللاجئين على أراضيه).\r\n3- نحرص عادة في الإجراءات التي نتولاها على ضرورة مرافقة اللاجيء الى الجهات الامنية المختصة لغايات تثبيت رقمه الشخصي الجديد على جواز سفره (حتى قبل معاملات تسكينه ما أمكن)، وذلك لغايات نيل اللاجئ شهادة تعريفية صحيحة.\r\n4- لدى استيقاف الأجهزة الامنية لأي من اللاجئين ومشاهدة أي وثيقة تعريفية خاصة به تحمل الرقم الشخصي الذي يبدأ ب800 والتحقق من الرقم عبر جهاز السيطرة، فسيظهر على النظام مباشرة لجهاز الأمن بأن الشخص الماثل أمامه هو لاجئ فلسطيني أتى من سوريا وتم تصويب أوضاعه. فيما ستكون الأرقام الشخصية القديمة سارية للغايات الامنية كذلك دون الاعلان عنها؛ وذلك لغايات ربط المعاملات والإجراءات والتصرفات التي قام بها اللاجئ قبل تصويب أوضاعه.\r\n5- وفقاً لاحكام القانون، فيحق للضابطة العدلية تقييد حرية أي من الأشخاص الذين لا يحملون بطاقات تعريفية حتى قيامهم بإحضار من يعرف عنهم او تقديمهم لأوراق رسمية ثبوتية، وفي سبيل ذلك فقد قدمنا النصح سابقاً للزملاء في مخيم الحديقة -بناءً على طلب الاخوة في مفرزة الأمن العام التابعة للمخيم- حول ضرورة تثبيت الارقام الشخصية و/أو التأكد من ان اللاجئ يحمل رقم شخصي جديد على وثائق رسمية تعود لهم. ولا زلنا بانتظار التأكيد.\r\n\r\nبناءً على ما تقدم، فإننا نرى بأن اللاجئ الذي اتبع إجراءات تصويب اوضاعه ومن ثم قام بتصويب الوثائق الخاصة به اصولاً وحصل على رقم شخصي جديد مثبت على الوثائق القانونية التعريفية الخاصة به، قد بات في مأمن دون أي قيد قانوني عليه (فيما خلا بعض مسائل غرامات الاقامة السابقة المتراكمة عليه والتي يمكن التعامل معها قانوناً دون مساس بوضع اللاجئ -طالما بقي هذا الوصف ملازماً له وفقاً لما تقره المملكة من اجراءات قانونية وفي حدود اعتراف المملكة بمسألة اللجوء-).', NULL, NULL, 'completed', 'procedure', 'تم تقديم الأستشاره', '2023-09-18 02:52:18', 6, 0, '2023-09-12 17:05:44', '2023-09-18 14:52:18', NULL),
(197, NULL, 14, 51, 'plaintiff', NULL, NULL, NULL, '2023', NULL, '2023-09-06', NULL, NULL, NULL, 0.00, '6/9/2023 تم تجهيز استدعاءات الحجة ولكن عند التواصل معه لطلب أرقام لجوازات اولاده طلب تأجيل السير المعاملة.', NULL, NULL, NULL, 'pending', 'case', NULL, NULL, 6, 0, '2023-09-17 11:07:36', '2023-09-17 11:07:36', NULL),
(198, NULL, 14, 113, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-17', NULL, NULL, NULL, NULL, '- 6/9/2023 تم التواصل معه يرغب بتصحيح قيود بناته نيفين و نسرين و استصدارشهادة ميلاد له وطلبت منهم البيينات وأسماء الشهود وتم ارسالها فور وصولها لمجموعة المكتب بتاريخ 7/9/2023 ولغايات دراسة وتجهيز الدعوى وموعد لتسجيلها.', '- 6/9/2023 تم التواصل معه يرغب بتصحيح قيود بناته نيفين و نسرين و استصدارشهادة ميلاد له وطلبت منهم البيينات وأسماء الشهود وتم ارسالها فور وصولها لمجموعة المكتب بتاريخ 7/9/2023 ولغايات دراسة وتجهيز الدعوى وموعد لتسجيلها.', 'أحوال الزرقاء', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-17 11:57:07', '2023-09-17 11:57:07', NULL),
(199, NULL, 4, 50, 'plaintiff', NULL, NULL, '2073', '2021', NULL, '2023-09-17', NULL, 'شمال عمان', NULL, 0.00, NULL, 'تأجلت الجلسه لشهودنا الساعه 10', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-17 12:16:11', '2023-09-17 12:16:11', NULL),
(200, NULL, 4, 139, 'plaintiff', NULL, NULL, '795', '2021', NULL, '2023-09-17', NULL, 'صلح جزاء شمال عمان', NULL, 0.00, NULL, 'ذم و قدح و تحقير جرائم ألكترونيه', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-17 12:19:00', '2023-09-17 12:19:00', NULL),
(201, NULL, 1, 47, 'plaintiff', NULL, NULL, '154', '2023', NULL, '2023-07-04', NULL, 'أستئناف الضريبيه', NULL, 0.00, NULL, 'جرم تهرب ضريبي', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-18 10:04:33', '2023-09-18 10:14:19', NULL),
(202, NULL, 4, 34, 'plaintiff', NULL, NULL, '7782', '2023', NULL, '2023-07-18', NULL, 'صلح جزاء شرق عمان', NULL, 0.00, NULL, 'بتول أماره اساءه أمانه بدلاله الماده 15', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-18 10:55:07', '2023-09-18 11:06:34', NULL),
(203, NULL, 4, 146, 'plaintiff', NULL, NULL, '7538', '2023', NULL, '2023-09-18', NULL, 'بدايه حقوق عمان', NULL, 0.00, NULL, 'استرداد', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-18 13:36:15', '2023-09-18 13:36:15', NULL),
(204, 'LSN-00024', 4, 83, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-19', NULL, NULL, NULL, NULL, 'تم تقديم طلب من الموكل وذلك لغايات الحصول على بدل مواصلات', 'طلب رسوم', NULL, NULL, 'completed', 'procedure', 'تم دفع بدل المواصلات للموكل و ذلك لغايات قدومهم من مخيم الحديقه الى عمان لتصويب أوضاعهم', '2023-09-25 10:10:00', 6, 0, '2023-09-19 14:33:05', '2023-09-25 10:10:00', NULL),
(205, NULL, 4, 45, 'plaintiff', NULL, NULL, '270', '2023', NULL, '2023-09-11', NULL, 'بدايه حقوق الزرقاء', NULL, 0.00, NULL, NULL, NULL, NULL, 'pending', 'case', NULL, NULL, 6, 0, '2023-09-19 16:38:04', '2023-09-19 16:38:04', NULL),
(206, NULL, 4, 54, 'plaintiff', NULL, NULL, '2852', '2023', NULL, '2023-09-04', NULL, 'ضد عاطف', NULL, 0.00, NULL, 'استئناف', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-20 09:55:41', '2023-09-20 10:02:19', NULL),
(207, 'LSK-00016', 1, 150, 'claimant', NULL, NULL, '0', NULL, NULL, '2023-08-21', NULL, NULL, NULL, NULL, 'تم تقديم الأستشاره', '21/8/2023 تم تقديم الأستشاره بخصوص تأجيل الطلاق حتى الحصول على الجنسية الأردنية', NULL, NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-20 12:07:22', '2023-09-20 12:08:51', NULL),
(208, NULL, 4, 111, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-20', NULL, NULL, NULL, NULL, NULL, 'أستصدار أرقام شخصيه لأبناء زوجه الموكل', 'وزاره الداخليه/ دائره الأقامه و الحدود', '2023-09-20', 'running', 'procedure', NULL, NULL, 6, 0, '2023-09-20 14:00:52', '2023-09-20 14:00:52', NULL),
(209, NULL, 4, 45, 'plaintiff', NULL, NULL, '5099', '2023', NULL, '2023-09-20', NULL, 'صلح جزاء الزرقاء', NULL, 0.00, NULL, 'مخالفه قانون الشركات', NULL, NULL, 'running', 'case', NULL, NULL, 6, 0, '2023-09-20 15:19:12', '2023-09-20 15:19:12', NULL),
(210, 'LSI-00021', 1, 135, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-06', 0, NULL, NULL, NULL, NULL, 'تم تقديم اسشارة بخصوص البعد القانوني لدعوى التفريق للغيبه', 'مكتب عمان', NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-25 10:40:35', '2023-09-25 10:40:35', NULL),
(211, 'LSI-00011', 1, 132, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-19', NULL, NULL, NULL, NULL, NULL, 'تم تقديم استشارة بتاريخ بخصوص الوضع الأمني والقانوني للعائلة وابنه الذي اكمل الثامنه عشر من عمره.', NULL, NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-25 13:35:59', '2023-09-25 13:35:59', NULL),
(212, 'LSK-00025', 1, 153, 'claimant', NULL, NULL, NULL, NULL, NULL, '2023-09-20', NULL, NULL, NULL, NULL, NULL, 'بتاريخ تم تقديم الاستشاره بخصوص امكانيه البعد القانوني بعد الهروب من مخيم الحديقه.', NULL, NULL, 'pending', 'procedure', NULL, NULL, 6, 0, '2023-09-25 13:38:03', '2023-09-25 13:38:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `problems_other_person_other_lawer`
--

CREATE TABLE `problems_other_person_other_lawer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `problem_id` bigint(20) UNSIGNED NOT NULL,
  `other_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_lawer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `problems_other_person_other_lawer`
--

INSERT INTO `problems_other_person_other_lawer` (`id`, `problem_id`, `other_person`, `other_lawer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'وزارة الداخلية', NULL, '2023-06-24 18:53:00', '2023-06-24 18:53:00', NULL),
(2, 3, 'شركه الحاج طاهر الهدهد', NULL, '2023-07-04 22:19:43', '2023-07-04 22:19:43', NULL),
(3, 5, 'أحوال شخصيه', NULL, '2023-07-16 11:59:42', '2023-07-16 11:59:42', NULL),
(4, 15, 'عبدالناصر فهمي', NULL, '2023-07-23 12:02:11', '2023-07-23 12:02:11', NULL),
(5, 16, NULL, NULL, '2023-07-23 12:08:34', '2023-07-23 12:08:34', NULL),
(6, 18, NULL, NULL, '2023-07-23 12:24:37', '2023-07-23 12:24:37', NULL),
(7, 20, NULL, NULL, '2023-07-23 12:42:28', '2023-07-23 12:42:28', NULL),
(8, 21, NULL, NULL, '2023-07-23 12:51:36', '2023-07-23 12:51:36', NULL),
(9, 23, NULL, NULL, '2023-07-23 12:57:45', '2023-07-23 12:57:45', NULL),
(10, 40, NULL, NULL, '2023-07-23 14:13:49', '2023-07-23 14:13:49', NULL),
(11, 47, 'ايمن هارون', NULL, '2023-07-30 13:56:52', '2023-07-30 13:56:52', NULL),
(12, 50, NULL, NULL, '2023-08-07 17:35:29', '2023-08-07 17:35:29', NULL),
(13, 51, NULL, NULL, '2023-08-07 17:35:39', '2023-08-07 17:35:39', NULL),
(14, 52, NULL, NULL, '2023-08-07 17:35:45', '2023-08-07 17:35:45', NULL),
(15, 56, NULL, NULL, '2023-08-15 13:33:57', '2023-08-15 13:33:57', NULL),
(16, 58, NULL, NULL, '2023-08-15 14:05:35', '2023-08-15 14:05:35', NULL),
(17, 61, NULL, NULL, '2023-08-15 14:24:00', '2023-08-15 14:24:00', NULL),
(18, 62, NULL, NULL, '2023-08-16 16:15:46', '2023-08-16 16:15:46', NULL),
(19, 77, NULL, NULL, '2023-08-20 16:41:06', '2023-08-20 16:41:06', NULL),
(20, 81, NULL, NULL, '2023-08-23 14:43:01', '2023-08-23 14:43:01', NULL),
(21, 89, NULL, NULL, '2023-08-28 15:46:31', '2023-08-28 15:46:31', NULL),
(22, 98, NULL, NULL, '2023-08-30 10:10:28', '2023-08-30 10:10:28', NULL),
(23, 99, NULL, NULL, '2023-08-30 10:11:50', '2023-08-30 10:11:50', NULL),
(24, 133, 'شركه منذر أحمد و شريكته', NULL, '2023-09-04 12:38:38', '2023-09-04 12:38:38', NULL),
(25, 134, 'طلعت ماهر عقل', NULL, '2023-09-04 12:44:08', '2023-09-04 12:44:08', NULL),
(26, 136, NULL, NULL, '2023-09-04 13:50:54', '2023-09-04 13:50:54', NULL),
(27, 137, NULL, NULL, '2023-09-04 13:52:14', '2023-09-04 13:52:14', NULL),
(28, 138, NULL, NULL, '2023-09-04 13:53:13', '2023-09-04 13:53:13', NULL),
(29, 139, NULL, NULL, '2023-09-04 14:10:42', '2023-09-04 14:10:42', NULL),
(30, 140, NULL, NULL, '2023-09-04 14:11:46', '2023-09-04 14:11:46', NULL),
(31, 141, NULL, NULL, '2023-09-04 14:12:28', '2023-09-04 14:12:28', NULL),
(32, 142, NULL, NULL, '2023-09-04 14:25:14', '2023-09-04 14:25:14', NULL),
(33, 143, 'محمد عدنان', NULL, '2023-09-04 15:22:06', '2023-09-04 15:22:06', NULL),
(34, 144, NULL, NULL, '2023-09-04 16:08:25', '2023-09-04 16:08:25', NULL),
(35, 145, NULL, NULL, '2023-09-04 16:41:27', '2023-09-04 16:41:27', NULL),
(36, 146, NULL, NULL, '2023-09-04 16:46:48', '2023-09-04 16:46:48', NULL),
(37, 147, NULL, NULL, '2023-09-05 13:57:06', '2023-09-05 13:57:06', NULL),
(38, 148, NULL, NULL, '2023-09-05 14:01:03', '2023-09-05 14:01:03', NULL),
(39, 149, NULL, NULL, '2023-09-05 14:06:21', '2023-09-05 14:06:21', NULL),
(40, 150, 'حسين عوده', NULL, '2023-09-05 14:49:18', '2023-09-05 14:49:18', NULL),
(41, 151, 'مدير الأحوال المدنيه', NULL, '2023-09-10 11:23:34', '2023-09-10 11:23:34', NULL),
(42, 152, NULL, NULL, '2023-09-10 14:22:10', '2023-09-10 14:22:10', NULL),
(43, 153, NULL, NULL, '2023-09-11 10:34:35', '2023-09-11 10:34:35', NULL),
(44, 154, NULL, NULL, '2023-09-11 10:41:27', '2023-09-11 10:41:27', NULL),
(45, 155, NULL, NULL, '2023-09-11 10:42:19', '2023-09-11 10:42:19', NULL),
(46, 156, NULL, NULL, '2023-09-11 10:46:41', '2023-09-11 10:46:41', NULL),
(47, 157, 'سعاد محمد مصطفى', NULL, '2023-09-11 14:23:12', '2023-09-11 14:23:12', NULL),
(48, 158, NULL, NULL, '2023-09-11 14:53:33', '2023-09-11 14:53:33', NULL),
(49, 159, NULL, NULL, '2023-09-11 15:10:18', '2023-09-11 15:10:18', NULL),
(50, 160, NULL, NULL, '2023-09-11 16:36:27', '2023-09-11 16:36:27', NULL),
(51, 161, NULL, NULL, '2023-09-11 16:46:07', '2023-09-11 16:46:07', NULL),
(52, 162, NULL, NULL, '2023-09-12 13:50:22', '2023-09-12 13:50:22', NULL),
(53, 197, NULL, NULL, '2023-09-17 11:07:36', '2023-09-17 11:07:36', NULL),
(54, 199, NULL, NULL, '2023-09-17 12:16:11', '2023-09-17 12:16:11', NULL),
(55, 200, 'ليث أبو طالب', NULL, '2023-09-17 12:19:00', '2023-09-17 12:19:00', NULL),
(56, 201, 'المدعي العام', NULL, '2023-09-18 10:04:33', '2023-09-18 10:04:33', NULL),
(57, 202, 'ايمن هارون', NULL, '2023-09-18 10:55:07', '2023-09-18 10:55:07', NULL),
(58, 203, 'نقابه المهندسين الأردنين', NULL, '2023-09-18 13:36:15', '2023-09-18 13:36:15', NULL),
(59, 205, NULL, NULL, '2023-09-19 16:38:04', '2023-09-19 16:38:04', NULL),
(60, 206, 'ضد عاطف', NULL, '2023-09-20 09:55:41', '2023-09-20 09:55:41', NULL),
(61, 209, 'الحق العام', NULL, '2023-09-20 15:19:12', '2023-09-20 15:19:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `problems_procedure`
--

CREATE TABLE `problems_procedure` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `problem_id` bigint(20) UNSIGNED NOT NULL,
  `id_secondary` int(11) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `next_session_date` date DEFAULT NULL,
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `total_cost` double(8,2) DEFAULT NULL,
  `lawer_payment` double(8,2) DEFAULT NULL,
  `client_payment` double(8,2) DEFAULT NULL,
  `judge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `problems_procedure`
--

INSERT INTO `problems_procedure` (`id`, `problem_id`, `id_secondary`, `file_name`, `file`, `notes`, `date`, `next_session_date`, `from`, `to`, `total_cost`, `lawer_payment`, `client_payment`, `judge`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, 'images/problem_procedure_files/WaFEObHt1YusQFuKyo1TN7WWemJPmP1RqE1vX8Bo.jpg', 'تفاصيل الاجراء', '2023-07-03', NULL, '21:11:00', '14:11:00', 1200.00, 500.00, 700.00, NULL, NULL, NULL, '2023-07-03 20:12:48', '2023-07-03 20:12:48'),
(2, 2, NULL, NULL, 'images/problem_procedure_files/aF4KV2IwXh4dfddZSqvV4j185LlvlsyEwL6pDVUU.jpg', 'تم الترخيص', '2023-07-04', NULL, '12:10:00', '12:30:00', 15.00, 10.00, 5.00, NULL, NULL, NULL, '2023-07-04 22:02:44', '2023-07-04 22:02:44'),
(3, 3, NULL, NULL, 'images/problem_procedure_files/AO1Wx9KPBt7BJkYdazdGJiGb7Lf4E3ZAoP7hsh2k.jpg', 'تم رد الدعوى لصالحنا', '2023-06-19', NULL, '09:09:00', '09:20:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-04 22:20:59', '2023-07-04 22:20:59'),
(4, 4, NULL, NULL, 'images/problem_procedure_files/1ybgGs2HMQQ71RSjQxQFhfhBYXbADQMlB12DB8mk.pdf', 'تم مراجعة الدخالية وصدر قرار برفض استخراج جواز السفر المؤقت لاسباب امنية', '2023-07-13', NULL, '23:04:00', '22:05:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-13 18:47:27', '2023-07-13 18:47:27'),
(5, 40, NULL, NULL, NULL, 'تم قيد دعوى (اثبات نسب) لدى هيئة القاضي علي الزبيدي', '2023-07-18', '2023-08-08', '09:07:00', '09:53:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-23 15:11:06', '2023-09-17 10:58:27'),
(6, 20, NULL, NULL, NULL, 'تم قيد الدعوى - اثبات زواج - لدى القاضي حمد السلايطه- في المحاكم الشرعيه يتم أخذ الكسور و بالتالي يصبح المبلغ 41 دينار', '2023-07-04', '2023-07-17', '09:16:00', '09:18:00', 41.00, 41.00, 0.00, NULL, NULL, NULL, '2023-07-23 15:14:56', '2023-09-17 10:31:28'),
(7, 20, NULL, NULL, NULL, 'حضر الشاهدان وتم تقديم التوضيح بخصوص الشهادة الشفوية ورفعت للتدقيق', '2023-07-27', '2023-07-27', '09:16:00', '09:18:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-07-24 09:58:53', '2023-07-23 15:17:35', '2023-07-24 09:58:53'),
(8, 20, NULL, NULL, NULL, 'تجربة', '2023-07-27', '2023-08-01', '09:16:00', '09:18:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-07-23 15:19:00', '2023-07-23 15:18:13', '2023-07-23 15:19:00'),
(9, 20, NULL, NULL, NULL, 'تم التعامل مع الدعوى كحالة فردية لاتحمل أوراق يمكن الاستعانه بها أمام القانون بالتزامن مع تجنب دفع الغرامة المفروضة وعليه نحن بصدد ايجاد مخرج من موضوع الوكالة الشفوية واتمام الدعوى-	تم تقديم التوضيح ولسماع الشهود وايجاد مخرج (موضوع الوكالة الشفوية) الجلسة القادمة الخميس 27/7/2023 وتم تسليمه 10 دنانير مواصلات. الفاتوره المرفقه مقسمه على مرتين- في كل مره تم دفع 10 دنانير و تم جمعهم في فاتوره واحده لتوقيعها من الموكل على استلامه المبلغ كامل كبدل مواصلات', '2023-07-27', '2023-07-27', '09:55:00', '11:00:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-24 09:58:08', '2023-09-17 10:26:40'),
(10, 25, NULL, NULL, NULL, 'تم الإلتقاء بهم واعطاء الاستشاره القانونية اللازمة', '2023-07-23', '2023-07-23', '10:30:00', '11:15:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-24 13:07:58', '2023-07-24 13:07:58'),
(11, 25, NULL, NULL, NULL, 'تم الاتصال بنا وطلب عدم المضي بالاجراءات', '2023-07-24', '2023-07-24', '10:30:00', '10:35:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-24 13:09:08', '2023-07-24 13:09:08'),
(12, 41, NULL, NULL, NULL, 'تم الالتقاء واعطاء الاستشارة القانونية وطلب بعض الاوراق لغايات المضي بالاجراءات', '2023-07-23', '2023-07-23', '15:40:00', '16:30:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-24 13:12:23', '2023-07-24 13:12:23'),
(13, 20, NULL, NULL, NULL, 'تم ايجاد مخرج لموضوع الوكالة الشفوية وتسليمه للقاضي وأجلها للتدقيق وسماع الشهود في الجلسة القادمة', '2023-07-27', '2023-07-31', '09:30:00', '11:38:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-27 23:39:25', '2023-07-27 23:39:25'),
(14, 20, NULL, NULL, NULL, 'تم ايجاد مخرج لموضوع الوكالة الشفوية وتسليمه للقاضي وأجلها للتدقيق وسماع الشهود في الجلسة القادمة', '2023-07-27', '2023-07-31', '09:30:00', '11:38:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-27 23:39:29', '2023-07-27 23:39:29'),
(15, 44, NULL, NULL, NULL, 'تم مراجعة المركز الأمني وتسيم صورة عن جواز سفر المدعو علي حسب رد الاقامة والحدود وبانتظار الرد', '2023-07-27', '2023-07-31', '10:00:00', '11:00:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-07-27 23:45:35', '2023-07-27 23:44:20', '2023-07-27 23:45:35'),
(16, 44, NULL, NULL, NULL, 'تم مراجعة المركز الأمني وتسيم صورة عن جواز سفر المدعو علي حسب رد الاقامة والحدود وبانتظار الرد', '2023-07-31', '2023-07-31', '10:00:00', '11:00:00', 1.00, 1.00, 0.00, NULL, NULL, '2023-09-04 16:18:14', '2023-07-27 23:46:49', '2023-09-04 16:18:14'),
(17, 23, NULL, NULL, NULL, '26/72/2023 موعد اول جلسة وتم تاأجيلها لتاريخ 20/8/2023 لتبيلغ المدعى عليه', '2023-07-26', '2023-07-26', '09:00:00', '10:30:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-31 18:14:32', '2023-07-31 18:14:32'),
(18, 23, NULL, NULL, NULL, 'تم قيد دعوى تفريق للغيبة لدى هيئة أحمد الخلايلة تحت الرقم 903/2023 وموعد اول جلسة يوم الاربعاء 26/7/2023.', '2023-07-06', '2023-07-06', '09:15:00', '11:30:00', 41.00, 41.00, 41.00, NULL, NULL, NULL, '2023-07-31 18:17:18', '2023-07-31 18:17:18'),
(19, 20, NULL, NULL, NULL, 'لم يحضر المدعى عليه او الشهود فتم تأجيلها الى يوم الخميس 17/8/2023 وتم تبليغ بلوط عبر الواتسب.', '2023-07-31', '2023-07-31', '09:19:00', '12:30:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-07-31 18:21:03', '2023-07-31 18:21:03'),
(20, 15, NULL, NULL, NULL, 'تم قيد الدعوى لدى محكمة مادبا الشرعية هيئة أحمد الخلايلة تحت الرقم 902/2023 وموعد اول جلسة 26/7/2023.', '2023-07-06', '2023-07-06', '09:21:00', '18:21:00', 41.00, 0.00, 0.00, NULL, NULL, '2023-08-06 12:38:50', '2023-07-31 18:22:50', '2023-08-06 12:38:50'),
(21, 15, NULL, NULL, NULL, 'تم تأجيلها للتبليغ ليوم الاحد 20/8/2023.', '2023-07-26', '2023-07-26', '09:21:00', '11:00:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-07-31 18:26:27', '2023-07-31 18:25:03', '2023-07-31 18:26:27'),
(22, 15, NULL, NULL, NULL, 'تم تأجيلها للتبليغ ليوم الاحد 20/8/2023.', '2023-07-26', '2023-08-20', '09:21:00', '11:00:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-08-05 17:49:53', '2023-07-31 18:26:12', '2023-08-05 17:49:53'),
(23, 23, NULL, NULL, NULL, 'تم تأجيلها للتبليغ الاحد 20/8/2023.', '2023-07-26', '2023-08-20', '09:00:00', '11:30:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-08-05 17:58:37', '2023-07-31 18:27:40', '2023-08-05 17:58:37'),
(24, 44, NULL, NULL, NULL, 'تم استلام الرد من ادارة الاقامة والحدود وتسليمه لمحكمة بتاريخ 2/8/2023 لمخاطبة دائرة قاضي القضاة لاستصدار الرقم التعريفي لغيات قيد الدعوى', '2023-08-02', NULL, '11:00:00', '12:30:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-09-04 16:18:14', '2023-08-03 08:49:43', '2023-09-04 16:18:14'),
(25, 15, NULL, NULL, NULL, 'تم حضور جلسة الاصلاح الأسري وانهائها وتم حضور أول جلسة في الدعوى وتأجيلها للتبليغ', '2023-08-20', '2023-07-17', '09:00:00', '10:30:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-08-06 12:38:50', '2023-08-05 17:53:08', '2023-08-06 12:38:50'),
(26, 15, NULL, NULL, NULL, 'تم حضور جلسة الاصلاح الأسري وانهائها وتم حضور أول جلسة في الدعوى وتأجيلها للتبليغ', '2023-08-20', '2023-07-17', '09:00:00', '10:30:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-08-06 12:38:50', '2023-08-05 17:55:50', '2023-08-06 12:38:50'),
(27, 23, NULL, NULL, NULL, 'تم حضور جلسة الاصلاح الأسري وانهائها وحضور أول جلسة لدى القاضي وتأجيلها للتبليغ', '2023-07-17', '2023-07-17', '10:30:00', '11:30:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-05 18:00:14', '2023-08-05 18:00:14'),
(28, 15, NULL, NULL, NULL, 'تم دفع رسوم تسجيل 40.20 دينار', '2023-07-04', '2023-07-04', '10:16:00', '11:18:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-06 12:22:14', '2023-08-06 12:21:16', '2023-08-06 12:22:14'),
(29, 15, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-06', '2023-07-17', '10:16:00', '11:18:00', 40.20, 40.20, 0.00, NULL, NULL, NULL, '2023-08-06 12:31:41', '2023-08-23 14:15:21'),
(30, 15, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:16:00', '11:18:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-06 14:46:34', '2023-08-06 12:32:00', '2023-08-06 14:46:34'),
(31, 15, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:16:00', '11:18:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-06 14:46:34', '2023-08-06 12:32:36', '2023-08-06 14:46:34'),
(32, 15, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:16:00', '11:18:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-06 14:46:34', '2023-08-06 12:32:53', '2023-08-06 14:46:34'),
(33, 18, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-04', '2023-07-04', '10:00:00', '11:00:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-23 13:57:57', '2023-08-06 12:44:29', '2023-08-23 13:57:57'),
(34, 18, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:00:00', '11:00:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-23 13:57:57', '2023-08-06 12:44:39', '2023-08-23 13:57:57'),
(35, 18, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:00:00', '11:00:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-23 13:57:57', '2023-08-06 12:44:45', '2023-08-23 13:57:57'),
(36, 18, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:00:00', '11:00:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-23 13:58:17', '2023-08-06 12:53:52', '2023-08-23 13:58:17'),
(37, 18, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:00:00', '11:00:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-23 13:58:17', '2023-08-06 12:54:15', '2023-08-23 13:58:17'),
(38, 18, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:00:00', '11:00:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-23 13:58:17', '2023-08-06 12:57:42', '2023-08-23 13:58:17'),
(39, 18, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-04', '10:00:00', '11:00:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-23 14:01:45', '2023-08-06 12:59:17', '2023-08-23 14:01:45'),
(40, 18, NULL, NULL, NULL, 'تم تسجيل دعوى تفريق للغيبه و الضرر رقم الدعوى 902/2023 محكمه مأدبا الشرعيه', '2023-07-26', '2023-07-06', '10:00:00', '11:10:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-23 14:01:45', '2023-08-06 13:04:08', '2023-08-23 14:01:45'),
(41, 44, NULL, NULL, NULL, 'تم استصدار رقم تعريفي للمدعى عليه (علي صالح خلف 3333424131) وتم قيد الدعوى لدى محكمة مادبا الشرعية هيئة حمد السلايطة تحت الرقم 1108/2023 وموعد الجلسة الأولى في 20/8/2023', '2023-08-06', NULL, '10:00:00', '12:00:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-09-04 16:18:14', '2023-08-06 19:30:02', '2023-09-04 16:18:14'),
(42, 16, NULL, NULL, NULL, 'تم قيد دعوى اثبات زواج  دعوى  رقم 880/2023 لدى محكمه مأدبا الشرعيه و موعد اول جلسه في 07/17/2023', '2023-02-07', NULL, '10:00:00', '12:00:00', 40.20, 40.20, 0.00, NULL, NULL, '2023-08-07 16:29:18', '2023-08-07 16:26:25', '2023-08-07 16:29:18'),
(43, 56, NULL, NULL, NULL, 'تم اصدار أثبات دخول / مغادره من إداره الأقامه و الحدود للموكل و أسرته البالغ عددهم 7 أشخاص و تم دفع لكل شخص رسم بقيمه دينار', '2023-08-15', NULL, '11:10:00', '13:30:00', 7.00, 7.00, 0.00, NULL, NULL, NULL, '2023-08-15 13:37:59', '2023-08-15 13:37:59'),
(44, 58, NULL, NULL, NULL, 'تم أستخراج أثبات دخول / مغادره للموكل لغايات الحصول على الرقم الشخصي', '2023-08-10', NULL, '11:05:00', '13:20:00', 1.00, 1.00, -1.00, NULL, NULL, NULL, '2023-08-15 14:09:00', '2023-08-15 14:09:00'),
(45, 58, NULL, NULL, NULL, 'تم تقديم طلب للحصول على الرقم الشخصي لأبن الموكل- أسامه طينه', '2023-08-10', NULL, '11:09:00', '13:00:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-15 14:13:33', '2023-08-15 14:13:33'),
(46, 61, NULL, NULL, NULL, 'تم استخراج إثبات دخول / مغادره لغايات استخراج الرقم الشخصي', '2023-08-15', NULL, '11:24:00', '13:00:00', 1.00, 1.00, 0.00, NULL, NULL, NULL, '2023-08-15 14:25:39', '2023-08-15 14:25:39'),
(47, 61, NULL, NULL, NULL, 'تم أستخراج رقم شخصي', '2023-08-15', NULL, '10:25:00', '13:00:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-15 14:27:01', '2023-08-15 14:27:01'),
(48, 56, NULL, NULL, NULL, 'تم أستخراج الأرقام الشخصيه للموكل وأسرته', '2023-08-15', NULL, '10:27:00', '13:00:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-15 14:29:06', '2023-08-15 14:29:06'),
(49, 14, NULL, NULL, NULL, 'تم تقديم طلب استدعاء لبطاقه أبناء الأردنيات من قبل زوجه الموكل', '2023-08-10', NULL, '11:07:00', '13:01:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-16 12:15:34', '2023-08-16 12:15:34'),
(50, 29, NULL, NULL, NULL, 'تمت مراجعه دائره الشؤون الفلسطينيه و أفادوا بأنه تم رفض الطلب لأسباب أمنيه', '2023-08-13', NULL, '11:22:00', '12:12:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-16 15:24:17', '2023-08-16 15:24:17'),
(51, 9, NULL, NULL, NULL, 'تم رفض طلب اصدار البطاقه البيضاء (بطاقه ابناء غزه)', '2023-08-16', NULL, '10:00:00', '12:12:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-16 16:03:04', '2023-08-16 16:03:04'),
(52, 62, NULL, NULL, NULL, 'تم أستخراج رقم شخصي للموكله', '2023-07-03', NULL, '10:15:00', '11:11:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-16 16:17:26', '2023-08-16 16:17:26'),
(53, 25, 3, NULL, NULL, 'cfasd', '2023-08-19', NULL, '12:49:00', '12:52:00', 0.00, 0.00, 100.00, NULL, NULL, '2023-08-19 12:55:04', '2023-08-19 12:51:22', '2023-08-19 12:55:04'),
(54, 15, 2, NULL, NULL, '0', '2023-07-04', '2023-08-22', '13:08:00', '13:12:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-08-23 14:12:10', '2023-08-19 13:10:20', '2023-08-23 14:12:10'),
(55, 74, 1, NULL, NULL, 'تم تقديم طلب شهاده عدم محكوميه', '2023-08-08', NULL, '14:00:00', '15:00:00', 6.55, 6.55, 0.00, NULL, NULL, NULL, '2023-08-20 16:05:03', '2023-08-20 16:05:03'),
(56, 75, 1, NULL, NULL, 'تم أصدار شهاده زواج', '2023-08-08', NULL, '11:12:00', '12:00:00', 1.00, 1.00, 0.00, NULL, NULL, NULL, '2023-08-20 16:14:43', '2023-08-20 16:21:08'),
(57, 44, 4, NULL, NULL, 'تم تأجيل الجلسه للتبليغ بواسطه دائره قاضي القضاة وتم أستصدار التباليغ و الكتب لغايات تسليمها للدائره و تأجلت الى يوم الأحد 22/10/2023', '2023-08-20', NULL, '10:16:00', '12:11:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-09-04 16:18:14', '2023-08-20 16:20:09', '2023-09-04 16:18:14'),
(58, 77, 1, NULL, NULL, 'تم تقديم طلب لأستصدار إثبات دخول / مغادره لغايات أستصدار أرقام شخصيه', '2023-08-06', NULL, '10:41:00', '11:50:00', 3.00, 3.00, 0.00, NULL, NULL, '2023-08-20 16:45:48', '2023-08-20 16:42:51', '2023-08-20 16:45:48'),
(59, 77, 1, NULL, NULL, 'تم تقديم طلب لأستصدار إثبات دخول / مغادره لغايات أستصدار أرقام شخصيه', '2023-08-06', NULL, '10:41:00', '11:50:00', 3.00, 3.00, 0.00, NULL, NULL, '2023-08-20 16:45:48', '2023-08-20 16:43:05', '2023-08-20 16:45:48'),
(60, 77, 1, NULL, NULL, 'تم تقديم طلب لأستصدار إثبات دخول / مغادره لغايات أستصدار أرقام شخصيه', '2023-08-06', NULL, '10:41:00', '11:50:00', 3.00, 3.00, 0.00, NULL, NULL, '2023-08-20 16:45:48', '2023-08-20 16:43:51', '2023-08-20 16:45:48'),
(61, 77, 1, NULL, NULL, 'تم تقديم طلب لأستصدار إثبات دخول / مغادره لغايات أستصدار أرقام شخصيه', '2023-08-06', NULL, '10:41:00', '13:00:00', 3.00, 3.00, 0.00, NULL, NULL, NULL, '2023-08-20 16:45:13', '2023-08-20 16:45:13'),
(62, 77, 2, NULL, NULL, 'تم أستصدار أرقام شخصيه للموكله و أبنائها', '2023-08-09', NULL, '10:47:00', '12:12:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-20 16:51:14', '2023-08-20 16:51:14'),
(63, 53, 1, NULL, NULL, 'الرد على طلب كشف دخول ومغادره', '2023-08-20', NULL, '10:39:00', '11:00:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-21 11:42:56', '2023-08-21 11:42:56'),
(64, 79, 1, NULL, NULL, 'أستصدار حجه وصايا مؤقته لثلاث غايات, كل غايه بقيمه 6 دنانير +1 دينار رسوم قيديه', '2023-08-22', NULL, '09:00:00', '12:11:00', 18.00, 19.00, 0.00, NULL, NULL, NULL, '2023-08-23 13:26:10', '2023-08-23 13:26:10'),
(65, 79, 2, NULL, NULL, 'حجه وصايا مؤقته لغايات وزاره التربيه و التعليم', '2023-08-22', NULL, '09:26:00', '12:40:00', 6.00, 6.00, 0.00, NULL, NULL, NULL, '2023-08-23 13:27:40', '2023-08-23 13:27:40'),
(66, 79, 3, NULL, NULL, 'حجه وصايا مؤقته لغايات وزاره التنميه الأجتماعيه', '2023-08-22', NULL, '09:27:00', '12:45:00', 6.00, 6.00, 0.00, NULL, NULL, NULL, '2023-08-23 13:28:21', '2023-08-23 13:28:21'),
(67, 79, 4, NULL, NULL, 'حجه وصايا مؤقته لغايات وزاره الداخليه', '2023-08-22', NULL, '09:50:00', '12:55:00', 6.00, 6.00, 0.00, NULL, NULL, NULL, '2023-08-23 13:29:17', '2023-08-23 13:29:17'),
(68, 80, 1, NULL, NULL, 'تم دفع مبلغ 6 دنانير لكل غايه بمجموع 18 دينار لثلاث غايات و ذلك لأستخراج الوثائق المطلوبه لأبناء الموكله لاحقاً', '2023-08-22', NULL, '09:00:00', '10:00:00', 18.00, 18.00, 0.00, NULL, NULL, NULL, '2023-08-23 13:34:09', '2023-08-23 13:34:09'),
(69, 80, 2, NULL, NULL, 'حجه وصايا مؤقته لغايات وزاره التربيه و التعليم', '2023-08-22', NULL, '09:00:00', '10:00:00', 6.00, 6.00, 0.00, NULL, NULL, NULL, '2023-08-23 13:34:53', '2023-08-23 13:34:53'),
(70, 80, 3, NULL, NULL, 'حجه وصايا مؤقته لغايات وزاره التنميه الأجتماعيه', '2023-08-22', NULL, '09:34:00', '10:40:00', 6.00, 6.00, 0.00, NULL, NULL, NULL, '2023-08-23 13:35:38', '2023-08-23 13:35:38'),
(71, 80, 4, NULL, NULL, 'حجه وصايا مؤقته لغايات وزاره الداخليه', '2023-08-23', NULL, '10:35:00', '11:30:00', 6.00, 6.00, 0.00, NULL, NULL, NULL, '2023-08-23 13:36:23', '2023-08-23 13:36:23'),
(72, 19, 1, NULL, NULL, 'تم دفع 6 دنانير لأستصدار حجه الوصايا و 1 دينار رسوم لمشروحات', '2023-07-04', NULL, '10:04:00', '12:12:00', 7.00, 7.00, 0.00, NULL, NULL, NULL, '2023-08-23 14:06:17', '2023-08-23 14:06:17'),
(73, 19, 2, NULL, NULL, 'تم مراجعه المركز الأمني لأستلام الرد (حجه وصايا مؤقته) و تم أستلامها في 07/10/2023', '2023-07-10', NULL, '10:06:00', '11:11:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-23 14:07:24', '2023-08-23 14:07:24'),
(74, 15, 2, NULL, NULL, 'تم حضور أول جلسه أصلاح و ختمها تقرر موعد أول جلسه في  26/07/2023للقضيه التفريق للغيبه والضرر', '2023-07-17', '2023-07-26', '10:15:00', '12:12:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-23 14:24:03', '2023-08-23 14:24:03'),
(75, 15, 3, NULL, NULL, 'تم الحضور للجلسه و تم تأجيلها للتبليغ ليوم 20/08/2023', '2023-07-26', '2023-08-20', '10:24:00', '12:12:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-23 14:30:21', '2023-08-23 14:30:21'),
(76, 15, 4, NULL, NULL, 'تم أستلام التبليغ 20/08/2023 و تم تسليم كتاب التبليغ بالوساطه للدائره بتاريخ 23/08/2023 الى التنفيذ لأرسال التبليغ للمُبلغ', '2023-08-20', '2023-10-22', '10:30:00', '11:11:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-23 14:34:54', '2023-08-23 14:34:54'),
(77, 81, 1, NULL, NULL, 'تم أستصدار رقم شخصي لأابن الموكله', '2023-08-23', NULL, '10:43:00', '12:12:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-09-03 15:53:03', '2023-08-23 14:44:55', '2023-09-03 15:53:03'),
(78, 81, 1, NULL, NULL, 'تم أستصدار رقم شخصي لأبن الموكله', '2023-08-23', NULL, '10:43:00', '12:12:00', 0.00, 0.00, 0.00, NULL, NULL, '2023-09-03 15:53:03', '2023-08-23 14:45:49', '2023-09-03 15:53:03'),
(79, 81, 1, NULL, NULL, 'تم أستصدار رقم شخصي لأبن الموكله', '2023-08-23', NULL, '10:43:00', '12:12:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-23 14:49:20', '2023-08-23 14:49:20'),
(80, 82, 1, NULL, NULL, 'تم الرفض على طلب بطاقات أبناء الأردنيات لأن الموكله على ذمه زوجها', '2023-08-09', NULL, '13:01:00', '14:02:00', 0.00, 0.00, 0.00, NULL, NULL, NULL, '2023-08-23 15:02:19', '2023-08-23 15:02:19'),
(81, 44, 5, NULL, NULL, 'تم تسجيل قضيه أثبات نسب', '2023-08-03', NULL, '09:00:00', '11:00:00', 45.20, 45.20, 0.00, NULL, 6, '2023-09-04 16:09:55', '2023-08-27 16:25:43', '2023-09-04 16:09:55'),
(82, 86, 1, NULL, NULL, 'تم أستصدار بطاقه أبناء أردنيات', '2023-08-22', NULL, '10:10:00', '11:00:00', 0.00, 0.00, 0.00, NULL, 6, '2023-08-28 14:04:17', '2023-08-28 14:02:37', '2023-08-28 14:04:17'),
(83, 86, 1, NULL, NULL, 'تم أستصدار بطاقه أبناء أردنيات', '2023-08-22', NULL, '10:10:00', '11:00:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-28 14:03:54', '2023-08-28 14:03:54'),
(84, 88, 1, NULL, NULL, 'تم أستصدار شهاده ولاده و دفع 11 دينار', '2023-08-28', NULL, '10:39:00', '12:12:00', 11.00, 11.00, 0.00, NULL, 6, NULL, '2023-08-28 15:41:38', '2023-08-28 15:41:38'),
(85, 88, 2, NULL, NULL, 'أستصدار شهاده ميلاد لأبن الموكله', '2023-08-28', NULL, '10:00:00', '11:00:00', 11.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-28 15:43:48', '2023-08-28 15:43:48'),
(86, 88, 3, NULL, NULL, 'تقديم النموذج لطلب أستصدار شهاده ميلاد', '2023-08-28', NULL, '10:00:00', '11:10:00', 11.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-28 15:45:02', '2023-08-28 15:45:02'),
(87, 89, 1, NULL, NULL, 'تم أستصدار رقم شخصي للموكله و لشهاده وفاه زوجها', '2023-08-28', NULL, '12:47:00', '14:00:00', 2.00, 2.00, 0.00, NULL, 6, NULL, '2023-08-28 15:48:22', '2023-08-28 15:48:22'),
(88, 14, 2, NULL, NULL, 'تم مراجعه وزاره الداخليه و أفادوا بأنه تم رفض معامله أبناء أردنيات من قبل لجنه وزاره الداخليه بسبب مكوث العائله في السعوديه.', '2023-08-29', NULL, '10:14:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-29 10:16:42', '2023-08-29 10:16:42'),
(89, 91, 1, NULL, NULL, 'تم الحصول على أثبات الجنسيه للموكل و عائلته', '2023-08-29', NULL, '10:00:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-29 10:19:30', '2023-08-29 10:19:30'),
(90, 65, 1, NULL, NULL, 'تم أستصدار صوره جواز سفر طبق الأصل', '2023-08-29', NULL, '10:01:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-30 10:04:06', '2023-08-30 10:04:06'),
(91, 96, 1, NULL, NULL, 'تم أستصدار صوره جواز سفر طبق الأصل', '2023-08-30', NULL, '10:00:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-30 10:05:40', '2023-08-30 10:05:40'),
(92, 98, 1, NULL, NULL, 'تم دفع رسم 1 دينار قيمه طوابع', '2023-08-29', NULL, '10:10:00', '11:11:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-08-30 10:11:23', '2023-08-30 10:11:23'),
(93, 99, 1, NULL, NULL, 'تم دفع 1 دينار رسم طوابع', '2023-08-29', NULL, '10:11:00', '11:11:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-08-30 10:13:42', '2023-08-30 10:13:42'),
(94, 99, 2, NULL, NULL, 'تم أستصدار رقم شخصي للموكل', '2023-08-29', NULL, '10:13:00', '12:12:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-30 10:14:59', '2023-08-30 10:14:59'),
(95, 98, 2, NULL, NULL, 'تم أستصدار رقم شخصي للموكل', '2023-08-29', NULL, '10:11:00', '12:12:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-08-30 10:16:13', '2023-08-30 10:16:13'),
(96, 126, 1, NULL, NULL, 'تم أستصدار رقم شخصي للموكل', '2023-08-29', NULL, '09:54:00', '12:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-03 09:56:03', '2023-09-03 09:57:40'),
(97, 126, 2, NULL, NULL, 'تم دفع 1 دينار رسم طوابع على طلب أثبات دخول-مغادره أبراهيم عكلوك وذلك لغايات أستخراج الرقم الشخصي', '2023-08-29', NULL, '09:56:00', '10:11:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-09-03 09:57:25', '2023-09-03 09:57:25'),
(98, 127, 1, NULL, NULL, 'تم أستخراج أرقام شخصيه للموكل و عائلته و مجموعهم  7 أشخاص', '2023-08-15', NULL, '10:01:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-03 10:02:54', '2023-09-03 10:02:54'),
(99, 127, 2, NULL, NULL, 'تم اصدار أثبات دخول / مغادره من إداره الأقامه و الحدود للموكل و أسرته البالغ عددهم 7 أشخاص و تم دفع لكل شخص رسم بقيمه دينار وذلك لغايات أستخراج الرقم الشخصي', '2023-08-15', NULL, '10:02:00', '12:12:00', 7.00, 7.00, 0.00, NULL, 6, NULL, '2023-09-03 10:04:06', '2023-09-03 10:04:06'),
(100, 128, 1, NULL, NULL, 'تم أستصدار رقم شخصي', '2023-09-03', NULL, '10:20:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-03 10:23:53', '2023-09-03 10:23:53'),
(101, 128, 2, NULL, NULL, 'تم دفع رسم 1 دينار طوابع لأثبات دخول/ مغادره وذلك لغايات أستخراج رقم شخصي', '2023-08-29', NULL, '10:23:00', '11:11:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-09-03 10:25:18', '2023-09-03 10:25:18'),
(102, 129, 1, NULL, NULL, 'تم أستصدار رقم شخصي للموكله سهام', '2023-09-03', NULL, '10:01:00', '11:11:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-09-03 15:03:43', '2023-09-03 15:03:43'),
(103, 129, 2, NULL, NULL, 'استصداره رقم شخصي لشهاده وفاه زوج سهام', '2023-09-03', NULL, '10:03:00', '23:11:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-09-03 15:05:08', '2023-09-03 15:05:08'),
(104, 130, 1, NULL, NULL, 'تم أستصدار أرقام شخصيه للموكله و أبنائها', '2023-08-09', NULL, '10:56:00', '12:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-03 16:00:23', '2023-09-03 16:00:23'),
(105, 130, 2, NULL, NULL, 'أستخراج أثبات دخول/مغادره بقيمه دينار لكل طلب بمجموع 3 دنانير وذلك لغايات أستخراج الرقم الشخصي', '2023-08-09', NULL, '10:00:00', '11:00:00', 3.00, 3.00, 0.00, NULL, 6, '2023-09-04 14:21:14', '2023-09-03 16:02:31', '2023-09-04 14:21:14'),
(106, 130, 2, NULL, NULL, 'أستخراج أثبات دخول/مغادره بقيمه دينار لكل طلب بمجموع 3 دنانير وذلك لغايات أستخراج الرقم الشخصي', '2023-09-08', NULL, '10:00:00', '11:00:00', 3.00, 3.00, 0.00, NULL, 6, '2023-09-04 14:21:14', '2023-09-03 16:03:11', '2023-09-04 14:21:14'),
(107, 130, 2, NULL, NULL, 'أستخراج أثبات دخول/مغادره بقيمه دينار لكل طلب بمجموع 3 دنانير وذلك لغايات أستخراج الرقم الشخصي', '2023-09-08', NULL, '10:00:00', '11:00:00', 3.00, 3.00, 0.00, NULL, 6, '2023-09-04 14:21:14', '2023-09-03 16:03:39', '2023-09-04 14:21:14'),
(108, 130, 2, NULL, NULL, 'أستخراج أثبات دخول/مغادره بقيمه دينار لكل طلب بمجموع 3 دنانير وذلك لغايات أستخراج الرقم الشخصي', '2023-09-08', NULL, '10:00:00', '11:00:00', 3.00, 3.00, 0.00, NULL, 6, NULL, '2023-09-03 16:04:53', '2023-09-03 16:04:53'),
(109, 131, 1, NULL, NULL, 'تم أستخراج أثبات جنسيه للموكل و أبنته', '2023-09-03', NULL, '10:02:00', '11:01:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-03 17:04:06', '2023-09-03 17:04:06'),
(110, 132, 1, NULL, NULL, 'تم أستخراج أثبات جنسيه للموكله منى', '2023-09-03', NULL, '10:05:00', '23:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-03 17:06:44', '2023-09-03 17:06:44'),
(111, 22, 1, NULL, NULL, 'تم أستصدار الرقم الشخصي للموكله', '2023-07-02', NULL, '10:06:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-04 12:08:14', '2023-09-04 12:08:14'),
(112, 21, 1, NULL, NULL, 'تم أستصدار حجه وصايه للموكله على أبنها لدى محكمه مأدبا الشرعيه', '2023-07-04', NULL, '09:12:00', '11:11:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-04 12:21:55', '2023-09-04 12:21:55'),
(113, 21, 2, NULL, NULL, 'تم دقع رسوم 6 دنانير لأستصدار حجه وصايا مؤقته للموكله + 1 دينار مشروحات', '2023-07-04', NULL, '08:22:00', '10:10:00', 7.00, 7.00, 0.00, NULL, 6, NULL, '2023-09-04 12:24:48', '2023-09-17 10:50:21'),
(114, 23, 4, NULL, NULL, 'تم دفع رسوم تسجيل الدعوى بقيمه 40.20 دينار تحت وصل رقم 539233 و المحكمه أخذت 41 دينار', '2023-07-06', NULL, '09:26:00', '10:10:00', 41.00, 41.00, 0.00, NULL, 6, NULL, '2023-09-04 12:30:06', '2023-09-04 12:30:06'),
(115, 134, 1, NULL, NULL, 'تم حضور الجلسه من المحامي يوسف المومني وتأجلت الجلسه للشهود بتاريخ 17/09/2023', '2023-09-03', '2023-09-17', '09:44:00', '11:11:00', 0.00, 0.00, 0.00, 'فراس الحجازين', 6, NULL, '2023-09-04 12:44:56', '2023-09-17 16:31:03'),
(116, 135, 1, NULL, NULL, 'تم أستخراج رقم شخصي', '2023-08-15', NULL, '09:30:00', '11:30:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-04 13:31:21', '2023-09-04 13:31:21'),
(117, 135, 2, NULL, NULL, 'تم دفع 1 دينار طوابع أثبات دخول/مغادره لغايات أستخراج رقم شخصي', '2023-08-15', NULL, '10:31:00', '11:28:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-09-04 13:32:29', '2023-09-04 13:32:29'),
(118, 60, 1, NULL, NULL, 'تم تقديم طلب للحصول على الرقم الشخصي لأبن الموكل- أسامه طينه', '2023-08-10', NULL, '09:34:00', '10:34:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-04 13:36:41', '2023-09-04 13:36:41'),
(119, 60, 2, NULL, NULL, 'تم أستخراج أثبات دخول / مغادره للموكل لغايات الحصول على الرقم الشخصي', '2023-08-10', NULL, '10:36:00', '11:35:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-09-04 13:37:34', '2023-09-04 13:37:34'),
(120, 57, 1, NULL, NULL, 'تم أستلام كتاب تصويب وضع', '2023-08-08', NULL, '10:38:00', '11:38:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-04 13:41:16', '2023-09-04 13:41:16'),
(121, 59, 1, NULL, NULL, 'تم أستخراج شهاده ميلاد لأسامه أبن الموكل', '2023-08-10', NULL, '09:42:00', '10:41:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-04 13:43:51', '2023-09-04 13:43:51'),
(122, 138, 1, NULL, NULL, 'تم أستصدار حجه وصايا لغايه وزاره التربيه و التعليم', '2023-08-22', NULL, '09:00:00', '09:50:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-04 13:54:59', '2023-09-04 13:54:59'),
(123, 137, 1, NULL, NULL, 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه لوزاره الداخليه', '2023-08-22', NULL, '09:50:00', '22:40:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-04 13:56:17', '2023-09-04 13:56:17'),
(124, 136, 1, NULL, NULL, 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه وزاره التنميه الأجتماعيه', '2023-08-22', NULL, '11:58:00', '12:59:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-04 13:59:22', '2023-09-04 13:59:22'),
(125, 141, 1, NULL, NULL, 'تم أستصدار حجه وصايا لغايه وزاره التربيه و التعليم', '2023-08-22', NULL, '09:10:00', '10:10:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-04 14:14:45', '2023-09-04 14:14:45'),
(126, 140, 1, NULL, NULL, 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكل لغايه وزاره الداخليه', '2023-08-22', NULL, '10:15:00', '11:14:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-04 14:16:12', '2023-09-04 14:16:12'),
(127, 139, 1, NULL, NULL, 'تم أستصدار حجه وصايا من محكمه أربد الشرعيه على أبناء الموكله لغايه لوزاره التنميه الأجتماعيه', '2023-08-22', NULL, '11:17:00', '12:13:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-04 14:17:37', '2023-09-04 14:17:37'),
(128, 142, 1, NULL, NULL, 'تم دفع 6 دنانير لأستصدار حجه الوصايا و 1 دينار رسوم لمشروحات', '2023-07-04', NULL, '11:25:00', '12:12:00', 7.00, 7.00, 0.00, NULL, 6, NULL, '2023-09-04 14:44:39', '2023-09-04 14:45:04'),
(129, 142, 2, NULL, NULL, 'تم أستخراج حجه وصايا للموكله', '2023-07-04', NULL, '10:45:00', '11:14:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-04 14:50:54', '2023-09-04 14:50:54'),
(130, 143, 1, NULL, NULL, 'تأجلت الجلسه ليوم 6/9/2023', '2023-07-12', '2023-09-06', '12:22:00', '13:11:00', 0.00, 0.00, 0.00, 'اسيل رشق', 6, NULL, '2023-09-04 15:23:37', '2023-09-04 15:23:37'),
(131, 144, 1, NULL, NULL, 'تم تسجيل قضيه أثبات نسب', '2023-08-03', NULL, '09:08:00', '10:10:00', 0.00, 0.00, 0.00, 'حمد مطلب', 6, NULL, '2023-09-04 16:09:47', '2023-09-04 16:09:47'),
(132, 144, 2, NULL, NULL, 'تم تأجيل الجلسه للتبليغ بواسطه دائره قاضي القضاة وتم أستصدار التباليغ و الكتب لغايات تسليمها للدائره و تأجلت الى يوم الأحد 22/10/2023', '2023-08-20', NULL, '09:09:00', '11:10:00', 0.00, 0.00, 0.00, 'حمد مطلب', 6, NULL, '2023-09-04 16:11:05', '2023-09-04 16:11:05'),
(133, 144, 3, NULL, NULL, 'تم استصدار رقم تعريفي للمدعى عليه (علي صالح خلف 3333424131) وتم قيد الدعوى لدى محكمة مادبا الشرعية هيئة حمد السلايطة تحت الرقم 1108/2023 وموعد الجلسة الأولى في 20/8/2023', '2023-08-06', NULL, '09:11:00', '10:10:00', 0.00, 0.00, 0.00, 'حمد مطلب', 6, NULL, '2023-09-04 16:13:06', '2023-09-04 16:13:06'),
(134, 144, 4, NULL, NULL, 'تم دفع رسوم 42.200 لقيد الدعوى', '2023-08-06', NULL, '09:13:00', '10:10:00', 45.20, 45.20, 0.00, NULL, 6, NULL, '2023-09-04 16:14:22', '2023-09-04 16:14:22'),
(135, 144, 5, NULL, NULL, 'تم استلام الرد من ادارة الاقامة والحدود وتسليمه لمحكمة بتاريخ 2/8/2023 لمخاطبة دائرة قاضي القضاة لاستصدار الرقم التعريفي لغيات قيد الدعوى', '2023-08-02', NULL, '09:09:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-04 16:16:08', '2023-09-04 16:16:08'),
(136, 144, 6, NULL, NULL, 'تم مراجعة المركز الأمني وتسيم صورة عن جواز سفر المدعو علي حسب رد الاقامة والحدود وبانتظار الرد', '2023-07-31', NULL, '09:16:00', '10:10:00', 1.00, 1.00, 0.00, NULL, 6, NULL, '2023-09-04 16:17:12', '2023-09-04 16:17:12'),
(137, 145, 1, NULL, NULL, 'تأجلت الجلسه ليوم 5/9/2023', '2023-09-04', '2023-09-05', '12:00:00', '13:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-04 16:42:31', '2023-09-04 16:42:31'),
(138, 146, 1, NULL, NULL, 'تم  تـأجل الجلسه ليوم 5/9/2023 لشهودنا', '2023-09-04', '2023-09-05', '09:00:00', '10:10:00', 0.00, 0.00, 0.00, 'طه الحوامده', 6, '2023-09-05 14:04:14', '2023-09-04 16:48:11', '2023-09-05 14:04:14'),
(139, 146, 2, NULL, NULL, 'تم التأجيل لقلم', '2023-09-06', '2023-09-14', '10:33:00', '10:35:00', 0.00, 0.00, 0.00, 'الهيئه الخامسه', 6, '2023-09-20 09:58:33', '2023-09-05 13:35:01', '2023-09-20 09:58:33'),
(140, 147, 1, NULL, NULL, 'تم  تأجيل القضيه ليوم 7 شهر 9', '2023-07-07', '2023-09-07', '10:00:00', '11:11:00', 0.00, 0.00, 0.00, 'معالي سعد الدين', 6, NULL, '2023-09-05 13:58:49', '2023-09-05 13:58:49'),
(141, 148, 1, NULL, NULL, 'تم أجيل القضيه ليوم 6 شهر 9', '2023-07-04', '2023-09-06', '09:01:00', '10:10:00', 0.00, 0.00, 0.00, 'الهيئه الثانيه', 6, NULL, '2023-09-05 14:02:20', '2023-09-05 14:02:20'),
(142, 149, 1, NULL, NULL, 'تم تأجيل الجلسه لسماع شهودنا حول الأجازه و الأجور', '2023-09-05', '2023-09-14', '09:06:00', '10:30:00', 0.00, 0.00, 0.00, 'طه الحوامده', 6, NULL, '2023-09-05 14:07:56', '2023-09-05 14:07:56'),
(143, 150, 1, NULL, NULL, 'اعترافاته على تقديم دفوع و البيانات الداحضه- مهله نهائيه', '2023-09-05', '2023-09-19', '10:00:00', '11:11:00', 0.00, 0.00, 0.00, 'هبه المومني', 6, NULL, '2023-09-05 14:51:16', '2023-09-05 14:51:16'),
(144, 151, 1, NULL, NULL, 'تم دفع 54 دينار لغايات الرسوم لدى محكمه صلح جزاء الزرقاء', '2023-09-07', NULL, '12:23:00', '12:44:00', 54.00, 54.00, 0.00, NULL, 6, NULL, '2023-09-10 11:26:31', '2023-09-10 11:26:31'),
(145, 151, 2, NULL, NULL, 'تم تقديم لائحه شكوى ضد الأحوال المدنيه', '2023-09-07', NULL, '10:34:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-10 11:36:52', '2023-09-10 11:36:52'),
(146, 152, 1, NULL, NULL, 'في المحاكم الشرعيه يتم أخذ كسور المبلغ و بالتالي تم دفع رسوم بقيمه 41 لدعوى تفريق للأفتداء', '2023-09-07', NULL, '10:22:00', '11:11:00', 41.00, 41.00, 0.00, NULL, 6, NULL, '2023-09-10 14:24:30', '2023-09-17 10:38:13'),
(147, 152, 2, NULL, NULL, 'تم تحديد لجلسه ليوم 22/10/2023 للدعوى رقم 1304/2023', '2023-09-07', '2023-10-22', '09:24:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-10 14:25:45', '2023-09-17 10:39:29'),
(148, 147, 2, NULL, NULL, 'تم تأجيل الجلسه لأحضار خبير للساعه 11:30', '2023-09-07', '2023-09-19', '11:30:00', '12:10:00', 0.00, 0.00, 0.00, 'معالي بيك سعد الدين', 6, NULL, '2023-09-11 09:52:12', '2023-09-18 09:55:01'),
(149, 143, 2, NULL, NULL, 'تم حضور الجلسه في شمال عمان لموكلتنا شركه الذكاء في القضيه رقم 2437/2023 وتم سماع شهاده المشتكي محمد برهوم و تم رفع لجلسه للتدقيق', '2023-09-06', '2023-09-21', '09:13:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-11 10:15:45', '2023-09-11 10:15:45'),
(150, 52, 1, NULL, NULL, 'تم تحديد أول جلسه في يوم الخميس', '2023-09-01', '2023-09-14', '10:21:00', '11:11:00', 0.00, 0.00, 0.00, 'روان حليمه', 6, NULL, '2023-09-11 10:21:58', '2023-09-11 15:17:14'),
(151, 153, 1, NULL, NULL, 'تم حضور الجلسهه المقرره في محكمه غرب عمان و تم الطلب على المحضر أمهالنا لتقديم مذكره دفوعنا و أعتراضاتنا على كتاب بنك الأسكان و القاضي رفض الطلب لكون الكتاب مورد في لملف من شهر 7 و الزميل ألتمس اعتماد الكتاب و ابرازها كبينه في الدعوى على ضوء قرار المحكمه و تم رفع الجلسه', '2023-09-06', '2023-09-20', '10:34:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-11 10:37:15', '2023-09-17 12:04:07'),
(152, 155, 1, NULL, NULL, 'تم تأجيل القضيه لتبليغ المصفي يمين عدم كذب الأقرار', '2023-09-25', '2023-09-25', '09:42:00', '10:30:00', 0.00, 0.00, 0.00, 'منذر الشرمان', 6, NULL, '2023-09-11 10:45:08', '2023-09-11 10:45:08'),
(153, 156, 1, NULL, NULL, 'تم تأجيل الجلسه لأتمام مساعي المصالحه', '2023-09-10', '2023-09-21', '10:46:00', '11:11:00', 0.00, 0.00, 0.00, 'مجد العجالين', 6, NULL, '2023-09-11 10:48:00', '2023-09-11 10:48:00'),
(154, 157, 1, NULL, NULL, 'تم تأجيل الجلسه لأحضار شهودنا (ملاحظة: لا نريد احضار الشهود ونريد تقديم مرافعة)', '2023-09-11', '2023-09-25', '09:23:00', '10:10:00', 0.00, 0.00, 0.00, 'رايه متروك', 6, NULL, '2023-09-11 14:46:01', '2023-09-11 15:53:18'),
(155, 158, 1, NULL, NULL, 'تم تأجيل لجلسه للتدقيق في بينه المتهمين و المدعى عليها الشرق الأوسط للأدخنه', '2023-09-11', '2023-09-25', '09:00:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-11 14:55:17', '2023-09-11 14:55:17'),
(156, 159, 1, NULL, NULL, 'تم تأجيل الجلسه لمذكرتنا حول تقرير الخبره', '2023-07-10', '2023-09-12', '09:10:00', '10:10:00', 0.00, 0.00, 0.00, 'مناور علي أبو الغنم', 6, NULL, '2023-09-11 15:12:13', '2023-09-11 15:12:13'),
(157, 143, 3, NULL, NULL, 'تم تأجيل الجلسه', '2023-09-13', '2023-09-06', '09:09:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-11 15:14:25', '2023-09-11 15:14:25'),
(158, 133, 1, NULL, NULL, 'تم أفهامنا بموعد الجلسه بتاريخ 19/09/2023', '2023-09-01', '2023-09-19', '09:22:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-11 15:23:15', '2023-09-11 15:23:15'),
(159, 160, 1, NULL, NULL, 'تأجلت للتدقيق', '2023-09-11', '2023-09-19', '09:36:00', '10:10:00', 0.00, 0.00, 0.00, 'هيئه خالد القطاونه', 6, NULL, '2023-09-11 16:38:17', '2023-09-11 16:43:17'),
(160, 161, 1, NULL, NULL, 'لتحديد موقفنا ضد القضيه الجزائيه ما اذاذ كانت مازالت منظوره ام لا', '2023-09-17', '2023-09-17', '09:46:00', '10:10:00', 0.00, 0.00, 0.00, 'هيئه الرئيس', 6, NULL, '2023-09-11 16:47:40', '2023-09-11 16:47:40'),
(161, 159, 2, NULL, NULL, 'تم تقديم مذكرة حول تقرير الخبرة وطلب عدم اعتماده واو دعوة الخبير للمناقشة وتم رفع القضيه للتدقيق الجلسة القادمة 20/9/2023 الساعة التاسعة صباحا', '2023-09-12', '2023-09-20', '09:00:00', '09:10:00', 0.00, 0.00, 0.00, 'بلال ملكاوي', 18, NULL, '2023-09-12 12:28:49', '2023-09-12 12:28:49'),
(162, 162, 1, NULL, NULL, 'تم حضور أول جلسه و تأجلت لأحضار أفاده محمد برهوم لسماع أفادته', '2023-07-27', '2023-09-13', '09:50:00', '10:10:00', 0.00, 0.00, 0.00, 'عبير حمد', 6, NULL, '2023-09-12 13:51:52', '2023-09-12 13:51:52'),
(163, 87, 1, NULL, NULL, 'تم أستصدار شهاده راما بنت الموكله من بعد أستلام كتاب تصحيح وضع', '2023-09-11', NULL, '09:18:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-12 14:19:17', '2023-09-12 14:19:17'),
(164, 87, 2, NULL, NULL, 'تم أستصدار شهاده ساره بنت الموكله من بعد أستلام كتاب تصحيح وضع', '2023-09-11', NULL, '09:19:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-12 14:19:54', '2023-09-12 14:19:54'),
(165, 195, 1, NULL, NULL, 'تم التواصل مع زوج رتيبة عبر الهاتف وتبين انه لم يصدر دفتر خدمة علم بعد للتقدم لطلب الحصول على جنسية.', '2023-09-12', NULL, '13:19:00', '13:21:00', 0.00, 0.00, 0.00, NULL, 17, NULL, '2023-09-12 14:25:40', '2023-09-12 14:25:40'),
(166, 152, 3, NULL, NULL, 'تم تأجيل الدعوى لتاريخ 22/11/2023', '2023-09-13', '2023-11-22', '09:18:00', '10:10:00', 0.00, 0.00, 0.00, 'أحمد مطالب السلايطه', 6, NULL, '2023-09-13 11:23:55', '2023-09-13 11:23:55'),
(167, 152, 4, NULL, NULL, 'تم طلب تبليغ زوج ايات الحصري حسب الأصول', '2023-09-13', '2023-11-22', '09:23:00', '10:10:00', 0.00, 0.00, 0.00, 'أحمد مطالب السلايطه', 6, NULL, '2023-09-13 11:29:05', '2023-09-13 11:29:05'),
(168, 52, 2, NULL, NULL, 'تم تأجيل الجلسه لتبليغ المدعى عليه الأول شفيقه مالكه المركبه لعدم وجود رقم هاتف متنقل للمدعى عليها الأولى, و يستوجب علينا تبليغ المدعى عليها الأولى عن طريق أرامكس و حسب الأصول', '2023-09-14', '2023-09-18', '10:10:00', '11:10:00', 0.00, 0.00, 0.00, 'روان حليمه', 6, NULL, '2023-09-14 13:56:36', '2023-09-14 13:56:36'),
(169, 149, 2, NULL, NULL, 'تم تأجيل الجلسه لأحضار شهودنا', '2023-09-14', '2023-09-18', '10:00:00', '10:20:00', 0.00, 0.00, 0.00, 'طه حوامده', 6, NULL, '2023-09-14 13:59:15', '2023-09-14 13:59:15'),
(170, 16, 1, NULL, NULL, 'تحديد موعد للحضور لدعوى قيد الولاده لبنت الموكل ميرا', '2023-06-21', '2023-06-21', '09:09:00', '10:10:00', 0.00, 0.00, 0.00, 'معن محمد', 6, NULL, '2023-09-17 10:12:54', '2023-09-17 10:12:54'),
(171, 16, 2, NULL, NULL, 'صدر القرار بتاريخ 21/6/2023 وتم ختمه قطعي وتم مراجعة الأحوال لاستخراج شهادة الميلاد ورفض الطلب لحين تسليم المدعي اوراقه', '2023-06-21', NULL, '09:12:00', '10:10:00', 0.00, 0.00, 0.00, 'معن محمد', 6, NULL, '2023-09-17 10:13:37', '2023-09-17 10:13:37'),
(172, 16, 3, NULL, NULL, 'تم دفع الرسوم لغايات تسجيل الدعوى', '2023-06-19', NULL, '13:06:00', '13:33:00', 59.00, 59.00, 0.00, NULL, 6, NULL, '2023-09-17 10:19:29', '2023-09-17 10:19:29'),
(173, 16, 4, NULL, NULL, 'تم دفع رسوم المحاكم البدائيه', '2023-06-22', NULL, '10:15:00', '10:50:00', 6.00, 6.00, 0.00, NULL, 6, NULL, '2023-09-17 10:20:42', '2023-09-17 10:20:42'),
(174, 20, 6, NULL, NULL, '17/8/2023 تم فصل الدعوى بتثبيت الزواج واسقاط حق الاستئناف وتسليم بلوط 10 دنانير مواصلات.', '2023-08-17', NULL, '09:26:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-17 10:30:28', '2023-09-17 10:30:28'),
(175, 142, 3, NULL, NULL, 'تم مراجعة المركز الأمني لاستلام الرد وتم استلام الحجة  بتاريخ 10/7/2023 وتم تسليمها للمكتب.', '2023-07-10', NULL, '09:35:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-17 10:36:29', '2023-09-17 10:36:29'),
(176, 21, 3, NULL, NULL, 'تم مراجعة المركز الأمني لاستلام الرد وتم استلام الحجة  بتاريخ 10/7/2023 وتم تسليمها للمكتب.', '2023-07-10', NULL, '09:43:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-17 10:43:47', '2023-09-17 10:43:47'),
(177, 23, 5, NULL, NULL, 'تم تاجيلها للتبليغ مرة أخرى بناء على طلب المكتب بالتأخير لحين حصولها على الجنسية موعدها القادم 22/10/2023', '2023-09-06', '2023-10-22', '09:53:00', '10:10:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-17 10:55:13', '2023-09-17 10:55:13'),
(178, 40, 2, NULL, NULL, 'تم دفع 46 دينار + 1 دينار مشروحات للموكله وذلك لغايات تسجيل الدعوى تحت رقم 1673/2023', '2023-07-18', '2023-08-08', '09:20:00', '10:10:00', 47.00, 47.00, 0.00, 'هيئه علي الزبيدي', 6, NULL, '2023-09-17 11:00:50', '2023-09-17 11:02:17'),
(179, 40, 3, NULL, NULL, 'تم تقديم التوضيح وفصل الدعوى واسقاط الحق بالاستئناف بتاريخ 8/8/2023 والمراجعة بعد شهر عند عودتها مصدقة', '2023-08-08', NULL, '09:02:00', '10:10:00', 0.00, 0.00, 0.00, 'علي رضوان فرج الزبيدي', 6, NULL, '2023-09-17 11:04:14', '2023-09-17 11:04:14'),
(180, 200, 1, NULL, NULL, 'ذم و قدح و تحقير', '2023-09-17', '2023-10-08', '10:00:00', '11:10:00', 0.00, 0.00, 0.00, 'رنا حويطات', 6, NULL, '2023-09-17 12:20:23', '2023-09-18 10:09:15'),
(181, 199, 1, NULL, NULL, 'تأجلت لسماع شهودنا', '2023-09-17', '2023-10-03', '10:00:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-17 12:24:11', '2023-09-17 12:24:11'),
(182, 146, 2, NULL, NULL, 'تم تأجيلها لتقديم مرافعتنا الساعه 10', '2023-09-14', '2023-09-25', '10:00:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, '2023-09-20 09:57:16', '2023-09-17 12:27:33', '2023-09-20 09:57:16'),
(183, 161, 2, NULL, NULL, 'تأجلت ليوم 1/10/2023', '2023-09-17', '2023-10-01', '10:00:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-17 12:29:28', '2023-09-17 12:29:28'),
(184, 134, 2, NULL, NULL, 'تأجلت لشهودنا على الساعه 12', '2023-09-17', '2023-10-03', '10:28:00', '11:33:00', 0.00, 0.00, 0.00, 'فراس الحجازين', 6, NULL, '2023-09-17 16:30:48', '2023-09-17 16:30:48'),
(185, 201, 1, NULL, NULL, 'تم تأجيل الجلسه لمذكره التبليغ', '2023-07-04', '2023-09-06', '09:04:00', '10:10:00', 0.00, 0.00, 0.00, 'الهيئه الثانيه', 6, NULL, '2023-09-18 10:06:14', '2023-09-18 10:06:14'),
(186, 201, 2, NULL, NULL, 'تم تأجيل الجلسه للتدقيق', '2023-09-06', '2023-09-21', '09:06:00', '11:10:00', 0.00, 0.00, 0.00, 'الهيئه الثانيه', 6, NULL, '2023-09-18 10:07:35', '2023-09-21 12:31:34'),
(187, 145, 2, NULL, NULL, 'تأجلت للقرار', '2023-09-05', '2023-09-19', '09:20:00', '10:10:00', 0.00, 0.00, 0.00, 'الهيئه الأولى', 6, NULL, '2023-09-18 10:25:46', '2023-09-18 10:25:46'),
(188, 162, 2, NULL, NULL, 'تأجلت لعدم احضار المشتكي', '2023-09-13', '2023-09-26', '09:32:00', '10:10:00', 0.00, 0.00, 0.00, 'عبير حمد', 6, NULL, '2023-09-18 10:33:42', '2023-09-18 10:33:42'),
(189, 202, 1, NULL, NULL, 'تأجلت لعدم احضار المشتكي', '2023-09-13', '2023-09-26', '09:55:00', '11:11:00', 0.00, 0.00, 0.00, 'عبير حمد', 6, NULL, '2023-09-18 10:56:28', '2023-09-18 10:56:28'),
(190, 202, 2, NULL, NULL, 'تم حضور أول جلسه و تأجلت لأحضار أفاده محمد برهوم لسماع أفادته', '2023-07-27', '2023-09-13', '09:56:00', '11:11:00', 0.00, 0.00, 0.00, 'عبير حمد', 6, '2023-09-18 11:04:05', '2023-09-18 10:57:20', '2023-09-18 11:04:05'),
(191, 202, 2, NULL, NULL, 'تم حضور أول جلسه و تأجلت لأحضار أفاده محمد برهوم لسماع أفادته', '2023-07-27', NULL, '10:04:00', '11:11:00', 0.00, 0.00, 0.00, 'عبير حمد', 6, '2023-09-18 11:07:28', '2023-09-18 11:04:57', '2023-09-18 11:07:28'),
(192, 203, 1, NULL, NULL, 'أول جلسه للتبليغ', '2023-09-18', '2023-09-19', '09:36:00', '11:10:00', 0.00, 0.00, 0.00, 'بيان بيك العتيبي', 6, NULL, '2023-09-18 13:37:26', '2023-09-18 13:37:26'),
(193, 52, 3, NULL, NULL, 'التمسنا تقديم تبليغ للنشر و تم أستلام التبليغ و تقديمه للتبليغ.', '2023-09-18', '2023-09-25', '09:12:00', '11:11:00', 0.00, 0.00, 0.00, 'روان حليمه', 6, NULL, '2023-09-18 15:14:17', '2023-09-18 15:14:17'),
(194, 149, 3, NULL, NULL, 'تأجلت لبقيه شهودنا', '2023-09-18', '2023-09-24', '09:15:00', '11:11:00', 0.00, 0.00, 0.00, 'طه حوامده', 6, NULL, '2023-09-18 15:15:59', '2023-09-18 15:15:59'),
(195, 169, 1, NULL, NULL, 'تم مراجعة مديرية شؤون الاجئين للاستفسار عن كتاب تصويب الاوضاع وهو قيد التحضير غير جاهز', '2023-09-18', NULL, '09:00:00', '22:00:00', 0.00, 0.00, 0.00, NULL, 18, NULL, '2023-09-18 16:02:40', '2023-09-18 16:02:40'),
(196, 133, 2, NULL, NULL, 'تم تكرير اللائحه الجوابيه و تم تقديم قائمه البينات و التمسنا ابراز البيانات الخطيه و سماع البينه الشخصيه و سلم موكل المدعى عليه مذكره الدفوع و البيانات و الاعتراضات و تم أخذ نسخه و طلبنا أمهالنا للأطلاع (هنالك مدد) للرد على اللائحه.', '2023-09-19', '2023-09-26', '09:00:00', '10:10:00', 0.00, 0.00, 0.00, 'نور ملكاوي', 6, NULL, '2023-09-19 13:05:19', '2023-09-19 16:48:35'),
(197, 204, 1, NULL, NULL, 'تم تقديم طلب من الموكل وذلك لغايات الحصول على بدل مواصلات', '2023-09-19', NULL, '12:33:00', '13:30:00', 100.00, 0.00, 100.00, NULL, 6, NULL, '2023-09-19 14:34:37', '2023-09-19 14:34:37'),
(198, 150, 2, NULL, NULL, 'تأجلت الجلسه السابقه لعدم تقديم مذكره', '2023-09-19', '2023-10-10', '09:00:00', '11:11:00', 0.00, 0.00, 0.00, 'هبه غازى محمد المومني', 6, NULL, '2023-09-19 16:51:33', '2023-09-19 16:51:33'),
(199, 153, 2, NULL, NULL, 'تم حضور الجلسه و تأجلت لتقديم مرافعتنا الساعه 9 صباحاً', '2023-09-20', '2023-10-04', '09:00:00', '11:11:00', 0.00, 0.00, 0.00, 'احلام الدبايبه', 6, NULL, '2023-09-20 09:48:41', '2023-09-20 09:48:41'),
(200, 206, 1, NULL, NULL, 'تم تأجيلها لتقديم مرافعتنا الساعه 10', '2023-09-14', '2023-09-25', '09:55:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, '2023-09-20 10:28:25', '2023-09-20 09:56:56', '2023-09-20 10:28:25'),
(201, 206, 2, NULL, NULL, 'تم التأجيل لقلم', '2023-09-06', '2023-09-14', '09:56:00', '11:11:00', 0.00, 0.00, 0.00, 'الهيئه الخامسه', 6, NULL, '2023-09-20 09:58:26', '2023-09-20 09:58:26'),
(202, 206, 3, NULL, NULL, 'تم تأجيلها لتقديم مرافعتنا الساعه 10', '2023-09-14', '2023-09-25', '09:24:00', '11:11:00', 0.00, 0.00, 0.00, 'الهيئه الخامسه', 6, NULL, '2023-09-20 10:25:43', '2023-09-24 09:52:19'),
(203, 159, 3, NULL, NULL, 'اعتماد تقرير الخبرة ورفع الجلسة لتقديم مرافعة الزميل', '2023-09-20', '2023-09-28', '09:00:00', '22:00:00', 0.00, 0.00, 0.00, 'بلال ملكاوي', 18, NULL, '2023-09-20 11:01:04', '2023-09-20 11:02:51'),
(204, 153, 3, NULL, NULL, 'تم تقديم مذكرة اعتراضية حول قرار المحكمة الاعدادي الصادر بتاريخ 6/9/2023، وتم تكليفنا لتقديم مرافعتنا وانتظاراً لذلك تم رفع الجلسة الى يوم الاربعاء، تاريخ 4/10/2023', '2023-02-09', '2023-10-04', '09:05:00', '10:00:00', 0.00, 0.00, 0.00, 'احلام الدبابية', 17, NULL, '2023-09-20 11:26:53', '2023-09-20 11:26:53'),
(205, 208, 1, NULL, NULL, 'تم أستخراج أثبات مغادره-دخول وذلك لغايات أستخراج أرقام شخصيه، تم دفع 1 دينار لكل أثبات مغادره- دخول بمجموع 3 دنانير ل 3 أشخاص', '2023-09-20', NULL, '10:00:00', '11:11:00', 3.00, 3.00, 0.00, NULL, 6, NULL, '2023-09-20 14:03:01', '2023-09-20 14:03:01'),
(206, 208, 2, NULL, NULL, 'تم أستصدار أرقام شخصيه لأبناء الموكله', '2023-09-20', NULL, '09:00:00', '11:11:00', 0.00, 0.00, 0.00, NULL, 6, NULL, '2023-09-20 14:04:30', '2023-09-20 14:04:30'),
(207, 209, 1, NULL, NULL, 'تأجلت لأحضار موكلنا', '2023-09-25', '2023-09-25', '09:00:00', '11:11:00', 0.00, 0.00, 0.00, 'هنا شاكر مختار الشوا', 6, NULL, '2023-09-20 15:21:06', '2023-09-20 15:21:06'),
(208, 160, 2, NULL, NULL, 'جلسه فاصله', '2023-09-19', '2023-09-20', '09:39:00', '11:10:00', 0.00, 0.00, 0.00, 'هيئه خالد القطاونه', 6, NULL, '2023-09-21 11:40:36', '2023-09-21 11:40:36'),
(209, 201, 3, NULL, NULL, 'تكليف المساعد الضريبي بتقديم اقرارات المبيعات 2018 و 6 + 2019/7', '2023-09-21', '2023-10-12', '09:00:00', '10:30:00', 0.00, 0.00, 0.00, 'الهيئه الثانيه', 6, NULL, '2023-09-21 12:33:41', '2023-09-21 12:33:41'),
(210, 149, 4, NULL, NULL, 'تم ختم بيناتنا و تأجلت لمرافعتهم', '2023-09-24', '2023-10-03', '09:10:00', '10:11:00', 0.00, 0.00, 0.00, 'طه حوامده', 6, NULL, '2023-09-24 12:45:28', '2023-09-24 12:45:28'),
(211, 147, 3, NULL, NULL, 'تم التأجيل لتبليغ الخبير ودعوته للمناقشة', '2023-09-19', '2023-09-24', '10:02:00', '23:02:00', 0.00, 0.00, 0.00, 'معالي سعد الدين', 1, NULL, '2023-09-24 13:04:10', '2023-09-24 13:04:10'),
(212, 147, 4, NULL, NULL, 'تم مناقشة الخبير طارق الصرايرة، واستمهلت لتحديد موقفي على ضوء مناقشة الخبير', '2023-09-24', '2023-10-03', '10:20:00', '11:40:00', 0.00, 0.00, 0.00, 'معالي سعد الدين', 1, NULL, '2023-09-24 13:05:19', '2023-09-24 13:05:19'),
(213, 204, 2, NULL, NULL, 'تم دفع بدل مواصلات لمحمد فياض و عائلته بقيمه 100 دينار/ تم تجهيز المبلغ و أستلامه من قبل الموكل بتاريخ 21 شهر 9 و تم توقيع على الأستلام من قبل الموكل  بتاريخ 24 من شهر 9', '2023-09-24', NULL, '16:06:00', '16:42:00', 100.00, 100.00, 0.00, NULL, 6, NULL, '2023-09-25 10:08:41', '2023-09-25 10:08:41'),
(214, 155, 2, NULL, NULL, 'تم تأجيل الجلسه لتبليغ المصفي', '2023-09-25', '2023-10-03', '09:00:00', '10:10:00', 0.00, 0.00, 0.00, 'منذر الشرمان', 6, NULL, '2023-09-25 13:32:57', '2023-09-25 13:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `problems_procedure_files`
--

CREATE TABLE `problems_procedure_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `problems_procedure_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `problems_procedure_files`
--

INSERT INTO `problems_procedure_files` (`id`, `problems_procedure_id`, `file_name`, `file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 42, NULL, 'images/problem_procedure_files/2HghNWy41cHki4CMNADAu8283HnK9chX13KLzmSN.pdf', '2023-08-07 16:26:25', '2023-08-07 16:26:25', NULL),
(2, 43, NULL, 'images/problem_procedure_files/2Sbrg5u6brBrk2cdSSAryaVJMv7SsY3Z2S0TuSdR.pdf', '2023-08-15 13:37:59', '2023-08-15 13:37:59', NULL),
(3, 44, NULL, 'images/problem_procedure_files/dfguTu7kUSkcmIcLxX5KjJA0rEaUtWJXIBwBpSsu.jpg', '2023-08-15 14:09:00', '2023-08-15 14:09:00', NULL),
(4, 45, NULL, 'images/problem_procedure_files/pmLk4WGrPfmLFvVqYlIC4ZRTPrTTn7C0uv0uoNTu.jpg', '2023-08-15 14:13:33', '2023-08-15 14:13:33', NULL),
(5, 46, NULL, 'images/problem_procedure_files/KaPvxdPgaWDS7ydbagnSXZUJCC0GFrkvk3mp0odI.pdf', '2023-08-15 14:25:40', '2023-08-15 14:25:40', NULL),
(6, 47, NULL, 'images/problem_procedure_files/Ziaq4qSj1F0RYRtDMSTx4BMjd2CdA8pqUfG8Zmw2.pdf', '2023-08-15 14:27:01', '2023-08-15 14:27:01', NULL),
(7, 48, NULL, 'images/problem_procedure_files/y8g9vJKHGlJpLKBmeeGVjKZBaUW5je3NYncABFuQ.pdf', '2023-08-15 14:29:06', '2023-08-15 14:29:06', NULL),
(8, 49, NULL, 'images/problem_procedure_files/IhLggv8daGFMGu4ozsVN5S0GTYMserpHPfRY8OBp.pdf', '2023-08-16 12:15:34', '2023-08-16 12:15:34', NULL),
(9, 51, NULL, 'images/problem_procedure_files/1DbrjLxxvnIWIyI6FDawB0NnNeMdWuo4IZBdmHdN.pdf', '2023-08-16 16:03:04', '2023-08-16 16:03:04', NULL),
(10, 52, NULL, 'images/problem_procedure_files/rxYMZig6LMtYXPdxqvXZbJA2nxJ9wRq0TeAm7Zgr.pdf', '2023-08-16 16:17:26', '2023-08-16 16:17:26', NULL),
(11, 18, NULL, 'images/problem_procedure_files/q4UJaFa0z5DVFkf4F6EbYraAe71zEdI8MMErQnZc.pdf', '2023-08-16 16:53:58', '2023-08-16 16:53:58', NULL),
(12, 18, NULL, 'images/problem_procedure_files/uyV4qAbpg0yaetVRwOYPO4Cf5Hw8HIjhiS0Ilf45.pdf', '2023-08-16 16:56:26', '2023-08-16 16:56:26', NULL),
(13, 53, NULL, 'images/problem_procedure_files/vGXTA1NcESyxHRMh6ritKZ6H0OjgtCtd1SeA2WPM.doc', '2023-08-19 12:51:22', '2023-08-19 12:51:22', NULL),
(14, 54, NULL, 'images/problem_procedure_files/xLS4QFLhCMmEYNJeKsVl0rzyH3pp8h9xU9kDeMDC.doc', '2023-08-19 13:10:20', '2023-08-19 13:16:33', '2023-08-19 13:16:33'),
(15, 54, NULL, 'images/problem_procedure_files/YAJ2sj1XepTYql5ZQO2OVamJ4KRTvplp7xLj1miB.doc', '2023-08-19 13:17:46', '2023-08-19 13:18:57', '2023-08-19 13:18:57'),
(16, 54, NULL, 'images/problem_procedure_files/58ibZEIeZFMtXNINfjn5D0hB5NNzfuiBel7APeZZ.doc', '2023-08-19 13:17:46', '2023-08-19 13:18:57', '2023-08-19 13:18:57'),
(17, 54, NULL, 'images/problem_procedure_files/1vTinnCXFbrsLSZW8BWPMV5NqMmU9y9Rrlq0EjRb.doc', '2023-08-19 13:17:46', '2023-08-19 13:18:57', '2023-08-19 13:18:57'),
(18, 54, NULL, 'images/problem_procedure_files/JzSlOPZSgcCfxuFd6txb5BvqYuw5i3bL2pd2UB4g.doc', '2023-08-19 13:17:46', '2023-08-19 13:18:57', '2023-08-19 13:18:57'),
(19, 54, 'ؤلالااا', 'images/problem_procedure_files/bZq0BaYlcq026JBoA0TghOfqSlwb1lVPOjgd6Ccw.doc', '2023-08-19 13:17:46', '2023-08-19 13:18:57', '2023-08-19 13:18:57'),
(20, 55, NULL, 'images/problem_procedure_files/NPRkxp7FD30G4e2IjxQiEOExvxSqmKFj9cXaAh1u.pdf', '2023-08-20 16:05:03', '2023-08-20 16:05:03', NULL),
(21, 56, NULL, 'images/problem_procedure_files/WccUawCoove2bMv2PfV4nowBNHfo5mqERCYkUA8z.pdf', '2023-08-20 16:14:43', '2023-08-20 16:14:43', NULL),
(22, 56, NULL, 'images/problem_procedure_files/AYsvpbRHmnNfOgVpmh6ejjN7Z8RVfRkrjqANOKhz.pdf', '2023-08-20 16:21:08', '2023-08-20 16:21:08', NULL),
(23, 61, NULL, 'images/problem_procedure_files/Bch9T5gRbnSel2W5n2Lpo7KjeWu9WdwIuUmFPlhA.pdf', '2023-08-20 16:47:31', '2023-08-20 16:47:31', NULL),
(24, 62, NULL, 'images/problem_procedure_files/fEQGW8Jw9va704vT56nmgjuF1hR1vqwQFCCL85fr.pdf', '2023-08-20 16:51:14', '2023-08-20 16:51:14', NULL),
(25, 63, NULL, 'images/problem_procedure_files/7ILkafdgpWDzrdEJfiR4RL7KAdLUI9tnABooD1gJ.jpg', '2023-08-21 11:42:56', '2023-08-21 11:42:56', NULL),
(26, 64, NULL, 'images/problem_procedure_files/uKBUkCwFW3lZBm1T3xojcwAPShQ6gHt6TzFyutlI.pdf', '2023-08-23 13:26:10', '2023-08-23 13:26:10', NULL),
(27, 65, NULL, 'images/problem_procedure_files/IoTfYGL3aWu4RU2Q95PTZd35I46uyHVJpgCB4TT1.jpg', '2023-08-23 13:27:40', '2023-08-23 13:27:40', NULL),
(28, 66, NULL, 'images/problem_procedure_files/ld5TufKGYb9pYbynaq0aTkCcjfSr0x67QVEGbTx3.jpg', '2023-08-23 13:28:21', '2023-08-23 13:28:21', NULL),
(29, 67, NULL, 'images/problem_procedure_files/NM5kCeTBfBWd6LrFnfE6BEokhpF91RJOaYRloTIk.jpg', '2023-08-23 13:29:17', '2023-08-23 13:29:17', NULL),
(30, 68, NULL, 'images/problem_procedure_files/o3VMAjwBl6UGcYmx2Rmza0Q92obhHN70ZeD2YGkG.pdf', '2023-08-23 13:34:09', '2023-08-23 13:34:09', NULL),
(31, 69, NULL, 'images/problem_procedure_files/O1PXZkVly4ZWg0AicU78fxWfuJfYcRBkWAMsBMF7.jpg', '2023-08-23 13:34:53', '2023-08-23 13:34:53', NULL),
(32, 70, NULL, 'images/problem_procedure_files/RwuZfKc70TYYtE7rCPAaTrwZchtEIPZDGfAAG2VA.jpg', '2023-08-23 13:35:38', '2023-08-23 13:35:38', NULL),
(33, 71, NULL, 'images/problem_procedure_files/Mc1zQ1XkVYQ4FSxv7sjCkgugyLkqfNgQQUqXJYq8.jpg', '2023-08-23 13:36:23', '2023-08-23 13:36:23', NULL),
(34, 72, NULL, 'images/problem_procedure_files/wCBowyAWBczAHpW115vVLh2dcS9VyroNouSFA4ue.pdf', '2023-08-23 14:06:17', '2023-08-23 14:09:50', '2023-08-23 14:09:50'),
(35, 73, NULL, 'images/problem_procedure_files/NZMQgdxlBrlW5m0uYaxPyEGXJ14K8hBrMWEdx3no.pdf', '2023-08-23 14:07:24', '2023-08-23 14:07:24', NULL),
(36, 72, NULL, 'images/problem_procedure_files/XmwMn9WXNA0ZgKnVOfEMBKMYd4u1klxLlXRBFQyP.pdf', '2023-08-23 14:09:23', '2023-08-23 14:09:23', NULL),
(37, 29, NULL, 'images/problem_procedure_files/lGWgBCGPyqql0fo19UlEBFzctPMaeH2gjEdpFXGR.pdf', '2023-08-23 14:15:21', '2023-08-23 14:15:21', NULL),
(38, 74, NULL, 'images/problem_procedure_files/owAWyxTTyO8WDgwELG15b7dGRQIH2mJnLRzFAdrI.pdf', '2023-08-23 14:24:03', '2023-08-23 14:24:03', NULL),
(39, 75, NULL, 'images/problem_procedure_files/qdvirsC8LJVpD6zlxlj4A5xlGZJuvMl1Hsuo6Ire.pdf', '2023-08-23 14:30:21', '2023-08-23 14:30:21', NULL),
(40, 76, NULL, 'images/problem_procedure_files/h91l4kkvqVsU03Qengy7yyXoabWe2LVHwfX66qKR.jpg', '2023-08-23 14:34:54', '2023-08-23 14:34:54', NULL),
(41, 79, NULL, 'images/problem_procedure_files/uRfPEsFz8jfRkdWdfPLotIkmZ26T5K0sYz6a6UFZ.pdf', '2023-08-23 14:49:21', '2023-08-23 14:49:21', NULL),
(42, 81, NULL, 'images/problem_procedure_files/8lVVmeCoqoC2wdwHBkTWcPuaagwhMKrqfOHSXctT.jpg', '2023-08-27 16:25:43', '2023-08-27 16:25:43', NULL),
(43, 83, NULL, 'images/problem_procedure_files/xWZHxdmeqfV244SZkRSQ00GrKAn2WDS9czfbYZKj.pdf', '2023-08-28 14:03:54', '2023-08-28 14:03:54', NULL),
(44, 84, NULL, 'images/problem_procedure_files/e6XlJav2szHD0uUv76RjGxmFoiNaTW8JHdtXyczD.jpg', '2023-08-28 15:41:38', '2023-09-05 13:21:40', NULL),
(45, 85, NULL, 'images/problem_procedure_files/anzptZmkinlHeCh3JQmg5T71nvs85Mn0K1nt5PbQ.pdf', '2023-08-28 15:43:48', '2023-08-28 15:43:48', NULL),
(46, 86, NULL, 'images/problem_procedure_files/lm1jMxZmHwRqhT81cmZGKW5Cw96YROh9crMKRMKU.jpg', '2023-08-28 15:45:02', '2023-08-28 15:45:02', NULL),
(47, 87, NULL, 'images/problem_procedure_files/UfCoatE7yXT2JkcWrveg4Y61Hae7WPt17mllnkRJ.pdf', '2023-08-28 15:48:22', '2023-08-28 15:48:22', NULL),
(48, 87, NULL, 'images/problem_procedure_files/EKdqun7JP7LcbCW73IY09B6mp5jHhvpm6mG96ltl.jpg', '2023-08-28 15:48:22', '2023-08-28 15:48:22', NULL),
(49, 87, NULL, 'images/problem_procedure_files/szjY3gAdwJyo0HlSF8Z0lGXKboem7yS2NUUuoJ0c.jpg', '2023-08-28 15:48:22', '2023-08-28 15:48:22', NULL),
(50, 49, NULL, 'images/problem_procedure_files/MZqGWPTpTPB8sbNznIXyUQQy8gpNzlquKr5OUMg1.pdf', '2023-08-29 10:17:09', '2023-08-29 10:17:09', NULL),
(51, 89, NULL, 'images/problem_procedure_files/3Pi4FcPMGfpMMUxSE6ctvpDXMy9lkeeIfVmV2hIS.jpg', '2023-08-29 10:19:30', '2023-08-29 10:19:30', NULL),
(52, 89, NULL, 'images/problem_procedure_files/UW3OmfCjLDFl8UOMLxjoY03NPWcsYK4r6FtgAo9W.jpg', '2023-08-29 10:19:30', '2023-08-29 10:19:30', NULL),
(53, 89, NULL, 'images/problem_procedure_files/FERnxsjPFf5I9MAwhzEU5M1GYpM20zHXMlEeNNs6.jpg', '2023-08-29 10:19:30', '2023-08-29 10:19:30', NULL),
(54, 89, NULL, 'images/problem_procedure_files/tm6yqwhEwIH3A6S25kEKSG26OpEcfwS2NyIpHxWz.jpg', '2023-08-29 10:19:30', '2023-08-29 10:19:30', NULL),
(55, 90, NULL, 'images/problem_procedure_files/bfigvl3V5fqvwaMxekMVbxn6OjqIJBR5AbXMwwj9.pdf', '2023-08-30 10:04:06', '2023-08-30 10:04:06', NULL),
(56, 91, NULL, 'images/problem_procedure_files/1fWBxLfGPCFnnIsSWNuWyIDq1SMqVWbLXhBpZSWF.pdf', '2023-08-30 10:05:40', '2023-08-30 10:05:40', NULL),
(57, 92, NULL, 'images/problem_procedure_files/ZFXN9GwaukShFIMwcXGz418zoSnDOzAHJiGpDRBa.pdf', '2023-08-30 10:11:23', '2023-08-30 10:11:23', NULL),
(58, 93, NULL, 'images/problem_procedure_files/l2vG9AT04cbdCRpphNiI6hU3p1KlPZP7hYpHAGPh.pdf', '2023-08-30 10:13:42', '2023-08-30 10:13:42', NULL),
(59, 94, NULL, 'images/problem_procedure_files/bqvaYdhn42oaN5DgJMGgmwxjOr1I6f8oZ82AQr5T.pdf', '2023-08-30 10:14:59', '2023-08-30 10:14:59', NULL),
(60, 95, NULL, 'images/problem_procedure_files/GZWVDIx2DeM01cVgvUzVsvbtzXf0lrWcjG0lpMWo.pdf', '2023-08-30 10:16:13', '2023-08-30 10:16:13', NULL),
(61, 96, NULL, 'images/problem_procedure_files/dk3xvwW8SJwFtKK4YlWJFAHe4JrICYZUIkpOEbOR.pdf', '2023-09-03 09:56:03', '2023-09-03 09:56:03', NULL),
(62, 97, NULL, 'images/problem_procedure_files/nDgVDWVN23DNIs1S0kpCXz2thGZyrPnh3gzYHkxj.pdf', '2023-09-03 09:57:25', '2023-09-03 09:57:25', NULL),
(63, 98, NULL, 'images/problem_procedure_files/hD6I83h28nRpmQ6GUmBc1o9UU4d00HqmzxttfLJo.pdf', '2023-09-03 10:02:54', '2023-09-03 10:02:54', NULL),
(64, 99, NULL, 'images/problem_procedure_files/ornA0sWLzlZs12suzwUXzXiWNrBFGE6U6ynZir9y.pdf', '2023-09-03 10:04:06', '2023-09-03 10:04:06', NULL),
(65, 100, NULL, 'images/problem_procedure_files/ILadnlmKnY3RZiSbZ64U1MaJgTHQ7g4NPVRBPrQd.pdf', '2023-09-03 10:23:53', '2023-09-03 10:23:53', NULL),
(66, 101, NULL, 'images/problem_procedure_files/b4f2ylpBF5D3FzUvWuYfeLEjy5ZpO46u1nk004Vd.pdf', '2023-09-03 10:25:18', '2023-09-03 10:25:18', NULL),
(67, 102, NULL, 'images/problem_procedure_files/9fFkuQQ5r7PKi4C6YNyt6tnIkSncJJpBCwVHB0k2.pdf', '2023-09-03 15:03:43', '2023-09-03 15:03:43', NULL),
(68, 103, NULL, 'images/problem_procedure_files/2XpnYgACXY5Fkn7OorwsuutJIKSwKUWr4ybOOePy.jpg', '2023-09-03 15:05:09', '2023-09-03 15:05:09', NULL),
(69, 104, NULL, 'images/problem_procedure_files/iiH6En8VCvLwwdLHVLxL4Adu8TbGbce3qesU6QNM.pdf', '2023-09-03 16:00:23', '2023-09-03 16:00:23', NULL),
(70, 108, NULL, 'images/problem_procedure_files/LJXekTvT7liSZ2KfRUP91oPID2Pr148LzvUYj22B.pdf', '2023-09-03 16:04:53', '2023-09-03 16:04:53', NULL),
(71, 109, NULL, 'images/problem_procedure_files/J0RF9pV66oUA3oLwHXFFXxxxoSaZbLnwWweuH2wT.pdf', '2023-09-03 17:04:06', '2023-09-03 17:04:06', NULL),
(72, 110, NULL, 'images/problem_procedure_files/Jm3RFgPF2mIOokUHZ71DKr7Fgox9bNiWGPbh7CdO.pdf', '2023-09-03 17:06:44', '2023-09-03 17:06:44', NULL),
(73, 111, NULL, 'images/problem_procedure_files/UuJ3j2Icr5ItefhAgbnvImx9DVGW7G9eEdZTsxnO.pdf', '2023-09-04 12:08:14', '2023-09-04 12:08:14', NULL),
(74, 112, NULL, 'images/problem_procedure_files/YngfTF0f577rk9VFNsNsrFe44c7sjgqA1HnfDuQD.pdf', '2023-09-04 12:21:55', '2023-09-04 12:21:55', NULL),
(75, 113, NULL, 'images/problem_procedure_files/vToJPIw8aFoGNq1EUe7DJVdVpaUeN5op6wrwrGxY.pdf', '2023-09-04 12:24:48', '2023-09-17 10:50:39', '2023-09-17 10:50:39'),
(76, 114, NULL, 'images/problem_procedure_files/MjVSNVer1wca2uzskaGQHgThnItMU0KJdevedole.pdf', '2023-09-04 12:30:06', '2023-09-04 12:30:06', NULL),
(77, 116, NULL, 'images/problem_procedure_files/SNOdmE6wWRkUuePB7QEcowRuMmACsqWX6LmIcvuJ.pdf', '2023-09-04 13:31:22', '2023-09-04 13:31:22', NULL),
(78, 117, NULL, 'images/problem_procedure_files/EzL2tugx6ehzxZUqhjsOs3RntgHOVot608ZFznIM.pdf', '2023-09-04 13:32:29', '2023-09-04 13:32:29', NULL),
(79, 118, NULL, 'images/problem_procedure_files/Qx12LQICXYLhFVe1e4O6PkA5QcoHqqPoKLXLsvz3.jpg', '2023-09-04 13:36:41', '2023-09-04 13:36:41', NULL),
(80, 119, NULL, 'images/problem_procedure_files/0znQmkbi7Q3J2wT4RyHseHADUK0XopeVUpxyt604.jpg', '2023-09-04 13:37:34', '2023-09-04 13:37:34', NULL),
(81, 120, NULL, 'images/problem_procedure_files/qIDjMR7yVacZg2YKj4KmBQKAF59apLeSTYZIj4Xh.jpg', '2023-09-04 13:41:16', '2023-09-04 13:41:16', NULL),
(82, 121, NULL, 'images/problem_procedure_files/01yQ7Um6SZ9osU0N6sKl0LDPgB51qG5t8TpmD9Ue.jpg', '2023-09-04 13:43:51', '2023-09-04 13:43:51', NULL),
(83, 122, NULL, 'images/problem_procedure_files/vI742AjH6uhqM660nfofFY77iXkQ60MT2xGsWL4r.jpg', '2023-09-04 13:54:59', '2023-09-04 13:54:59', NULL),
(84, 123, NULL, 'images/problem_procedure_files/odT3XnSWfacnpCEDTf2jutxMLI8Y6wVgUHzvxp0I.jpg', '2023-09-04 13:56:17', '2023-09-04 13:56:17', NULL),
(85, 124, NULL, 'images/problem_procedure_files/wv5wDVJRlPHeu5w2ExrNZEinfhA5XEzP7FoorwOp.jpg', '2023-09-04 13:59:22', '2023-09-04 13:59:22', NULL),
(86, 125, NULL, 'images/problem_procedure_files/1kiGs6EY6nuGar5RWpvFODFkjxaN2vVvhPLkVRgT.jpg', '2023-09-04 14:14:45', '2023-09-04 14:14:45', NULL),
(87, 126, NULL, 'images/problem_procedure_files/sRBK6SwxWADo3RmyOa60P8r1SjJBGfX6grKDMRCP.jpg', '2023-09-04 14:16:12', '2023-09-04 14:16:12', NULL),
(88, 127, NULL, 'images/problem_procedure_files/uw3BNhMavXA7Ei2bjqrk2f4S3v5vM0ebPNT3iix7.jpg', '2023-09-04 14:17:37', '2023-09-04 14:17:37', NULL),
(89, 128, NULL, 'images/problem_procedure_files/KNlBLmaLbQ97BMqKjkaLAaBAnY714SzquyVYc5Lm.pdf', '2023-09-04 14:44:39', '2023-09-04 14:51:47', '2023-09-04 14:51:47'),
(90, 129, NULL, 'images/problem_procedure_files/SUhA2zDpn8sgPUaJyDuShhQYPwWrShkYwc4Ff78t.pdf', '2023-09-04 14:50:54', '2023-09-04 14:50:54', NULL),
(91, 128, NULL, 'images/problem_procedure_files/suKHKGpjjMDwfGfGSnbRqe6pEoEWgKtVQSiw5ubb.pdf', '2023-09-04 14:54:19', '2023-09-04 14:54:19', NULL),
(92, 131, NULL, 'images/problem_procedure_files/jCRDHBG3W5Tl7W2CQtTwOiUtNN30TqIHyjwcCfo1.pdf', '2023-09-04 16:09:47', '2023-09-04 16:09:47', NULL),
(93, 134, NULL, 'images/problem_procedure_files/S9Dhf3DRSPo0XsMNHdhQJtIbEiEuruFquft7RjT9.pdf', '2023-09-04 16:14:22', '2023-09-04 16:14:22', NULL),
(94, 144, NULL, 'images/problem_procedure_files/gJCAwZ2DAzXHlWlYD9ZnaYy4zXUPgOXYyFSHOnev.pdf', '2023-09-10 11:26:31', '2023-09-10 11:26:31', NULL),
(95, 145, NULL, 'images/problem_procedure_files/Vq2AxmrOQCSmaskCkMWC0y8t3SayMJSOpPMNNA3N.pdf', '2023-09-10 11:36:52', '2023-09-10 11:36:52', NULL),
(96, 146, NULL, 'images/problem_procedure_files/pUC4ZaQc7jQYSTq0XDWR8zYAcGs5NJf7h9DnXU5J.jpg', '2023-09-10 14:24:30', '2023-09-10 14:24:30', NULL),
(97, 147, NULL, 'images/problem_procedure_files/vg61N7J6Hv0Z1PCnAD38CHNii5dKZ5ZAN05TNyCk.jpg', '2023-09-10 14:25:45', '2023-09-10 14:25:45', NULL),
(98, 154, NULL, 'images/problem_procedure_files/l8YLlIrSnN2PRKhwyA7kJJmJ7SgxLWpJFrjerLUb.pdf', '2023-09-11 14:46:01', '2023-09-11 14:46:01', NULL),
(99, 161, NULL, 'images/problem_procedure_files/V0Xz2yEOTvGuL37sFhhd6vEgXA2aR7Km9GbU66ZZ.pdf', '2023-09-12 12:28:49', '2023-09-12 12:28:49', NULL),
(100, 163, NULL, 'images/problem_procedure_files/sal7bAxvyDS3T0LhPcxXGqiTUDtXMRx3NveHFaJI.jpg', '2023-09-12 14:19:17', '2023-09-12 14:19:17', NULL),
(101, 164, NULL, 'images/problem_procedure_files/by8NH4Q4QtSID1cMitwA0LX7tfSB9w7mON1mQsHE.jpg', '2023-09-12 14:19:54', '2023-09-12 14:19:54', NULL),
(102, 166, NULL, 'images/problem_procedure_files/t3bmoG7l5qfDzgb9mcviMPyvaNlVAfiQXFDyGZEl.jpg', '2023-09-13 11:23:55', '2023-09-13 11:23:55', NULL),
(103, 167, NULL, 'images/problem_procedure_files/KZgtmdBaCka8I9eKWA5yJF4oxplcOI1lykfm8d4I.jpg', '2023-09-13 11:29:05', '2023-09-13 11:29:05', NULL),
(104, 170, NULL, 'images/problem_procedure_files/Ei7Y0KJM1TcDhEtVD0Juda6TDj3oIj4GweNHEsQz.jpg', '2023-09-17 10:12:54', '2023-09-17 10:12:54', NULL),
(105, 171, NULL, 'images/problem_procedure_files/4HjGQ0oQjQAf00TK9bY6VYa2Vi76asVRHHsQWZtq.jpg', '2023-09-17 10:13:37', '2023-09-17 10:13:37', NULL),
(106, 172, NULL, 'images/problem_procedure_files/9HTl7JkyAar60CUpkgatywhYUjPs0W6aueEDIGIL.jpg', '2023-09-17 10:19:29', '2023-09-17 10:19:29', NULL),
(107, 173, NULL, 'images/problem_procedure_files/4bMlLnekjrhL7btLpkTlsYVTWaHpFPeGpvSGypSH.jpg', '2023-09-17 10:20:42', '2023-09-17 10:20:42', NULL),
(108, 9, NULL, 'images/problem_procedure_files/tn3nXoEVtJ6QNXwz3SRAzwALUuQqlD32AfNclPf6.pdf', '2023-09-17 10:26:40', '2023-09-17 10:26:40', NULL),
(109, 174, NULL, 'images/problem_procedure_files/9RvD2TwJfvMaJATROvHCcrSXSo2Mb2dDiRXon7KX.pdf', '2023-09-17 10:30:28', '2023-09-17 10:30:28', NULL),
(110, 6, NULL, 'images/problem_procedure_files/MMyFuQOSQIy1FQyF8tgy6ANCcGEsZSbEV8LGl1a5.jpg', '2023-09-17 10:31:28', '2023-09-17 10:31:28', NULL),
(111, 6, NULL, 'images/problem_procedure_files/9NZ6msKDgg3j4Tw837yKzv3knPTRwVxFoXalJAdg.jpg', '2023-09-17 10:31:44', '2023-09-17 10:32:11', '2023-09-17 10:32:11'),
(112, 113, NULL, 'images/problem_procedure_files/ZtcwkmJhZE79z3yx0RlQA4im44cRH4qu8H38Vsyg.pdf', '2023-09-17 10:51:09', '2023-09-17 10:51:09', NULL),
(113, 5, NULL, 'images/problem_procedure_files/4M66Tq13UyqaSVbCjxIrrh8rdgiuMHYv9R2S1tTK.pdf', '2023-09-17 10:58:27', '2023-09-17 10:58:27', NULL),
(114, 178, NULL, 'images/problem_procedure_files/KL0YOI6iJ097M7EeHmOEv85SxcYcYDnbbgg0uCbs.pdf', '2023-09-17 11:00:50', '2023-09-17 11:00:50', NULL),
(115, 197, NULL, 'images/problem_procedure_files/IiVtbM4LCUcKTCvWJB3ueFNgM3VOGCr0EAQlmU5p.jpg', '2023-09-19 14:34:37', '2023-09-19 14:34:37', NULL),
(116, 205, NULL, 'images/problem_procedure_files/PipqjhUPkvlKJ9cj5B9FS0KH2ouJtkRSYfZ0XBBF.jpg', '2023-09-20 14:03:01', '2023-09-20 14:03:01', NULL),
(117, 205, NULL, 'images/problem_procedure_files/YXpDEVwO1WVK0yeTs5IUaazMG9OyCUTL0QioSZG3.jpg', '2023-09-20 14:03:28', '2023-09-20 14:03:28', NULL),
(118, 205, NULL, 'images/problem_procedure_files/1xgeTj8U9uVjpjAtVvtGr9I2Is8QKwaEG60MwNa9.jpg', '2023-09-20 14:03:46', '2023-09-20 14:03:46', NULL),
(119, 206, NULL, 'images/problem_procedure_files/kM176onzMNWNdnkMHg64O9EQlsYVxuYXQrPbx195.jpg', '2023-09-20 14:04:47', '2023-09-20 14:04:47', NULL),
(120, 206, NULL, 'images/problem_procedure_files/dVpklPD1DqIM6azDMRqFGkw5gi3ujjYKvioUwQHn.jpg', '2023-09-20 14:05:01', '2023-09-20 14:05:01', NULL),
(121, 206, NULL, 'images/problem_procedure_files/2hgypWfRFu7ZFbJhDn01UxfG8iooClN3ws1eRfwc.jpg', '2023-09-20 14:05:13', '2023-09-20 14:05:13', NULL),
(122, 213, NULL, 'images/problem_procedure_files/XIXfo1Z6UnG2pchHYPwolEorUXHPppbd0srk6GpE.jpg', '2023-09-25 10:08:41', '2023-09-25 10:08:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `problem_clients`
--

CREATE TABLE `problem_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `problem_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `problem_clients`
--

INSERT INTO `problem_clients` (`id`, `problem_id`, `client_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 56, 83, '2023-08-15 13:33:57', '2023-08-15 14:22:40', '2023-08-15 14:22:40'),
(2, 58, 77, '2023-08-15 14:05:35', '2023-08-15 14:05:35', NULL),
(3, 56, 83, '2023-08-15 14:22:40', '2023-08-15 14:22:40', NULL),
(4, 61, 82, '2023-08-15 14:24:00', '2023-08-20 13:52:54', '2023-08-20 13:52:54'),
(5, 62, 56, '2023-08-16 16:15:46', '2023-08-20 13:52:43', '2023-08-20 13:52:43'),
(6, 16, 44, '2023-08-16 16:40:12', '2023-08-20 13:54:02', '2023-08-20 13:54:02'),
(7, 15, 55, '2023-08-16 16:41:31', '2023-08-20 13:54:11', '2023-08-20 13:54:11'),
(8, 20, 44, '2023-08-16 16:42:56', '2023-08-20 13:53:44', '2023-08-20 13:53:44'),
(9, 21, 56, '2023-08-16 16:43:36', '2023-08-20 13:53:33', '2023-08-20 13:53:33'),
(10, 18, 55, '2023-08-16 16:45:10', '2023-08-20 13:53:53', '2023-08-20 13:53:53'),
(11, 40, 59, '2023-08-16 16:46:09', '2023-08-20 13:53:13', '2023-08-20 13:53:13'),
(12, 23, 56, '2023-08-16 16:46:38', '2023-08-20 13:53:23', '2023-08-20 13:53:23'),
(13, 62, 56, '2023-08-20 13:52:43', '2023-08-20 13:52:43', NULL),
(14, 61, 82, '2023-08-20 13:52:54', '2023-08-20 13:52:54', NULL),
(15, 40, 59, '2023-08-20 13:53:13', '2023-09-17 10:56:51', '2023-09-17 10:56:51'),
(16, 23, 56, '2023-08-20 13:53:23', '2023-09-17 10:42:38', '2023-09-17 10:42:38'),
(17, 21, 56, '2023-08-20 13:53:33', '2023-09-17 10:42:48', '2023-09-17 10:42:48'),
(18, 20, 44, '2023-08-20 13:53:44', '2023-09-17 10:22:47', '2023-09-17 10:22:47'),
(19, 18, 55, '2023-08-20 13:53:53', '2023-08-20 17:07:39', '2023-08-20 17:07:39'),
(20, 16, 44, '2023-08-20 13:54:02', '2023-08-20 13:54:02', NULL),
(21, 15, 55, '2023-08-20 13:54:11', '2023-08-20 17:07:51', '2023-08-20 17:07:51'),
(22, 77, 80, '2023-08-20 16:41:06', '2023-08-20 16:41:06', NULL),
(23, 18, 55, '2023-08-20 17:07:39', '2023-08-23 14:01:08', '2023-08-23 14:01:08'),
(24, 15, 55, '2023-08-20 17:07:51', '2023-08-23 14:11:34', '2023-08-23 14:11:34'),
(25, 18, 55, '2023-08-23 14:01:08', '2023-08-23 14:01:08', NULL),
(26, 15, 55, '2023-08-23 14:11:34', '2023-08-23 14:11:46', '2023-08-23 14:11:46'),
(27, 15, 55, '2023-08-23 14:11:46', '2023-08-23 14:11:46', NULL),
(28, 81, 55, '2023-08-23 14:43:01', '2023-08-26 19:12:34', '2023-08-26 19:12:34'),
(29, 81, 54, '2023-08-26 19:12:34', '2023-08-26 19:13:57', '2023-08-26 19:13:57'),
(30, 81, 55, '2023-08-26 19:12:34', '2023-08-26 19:13:57', '2023-08-26 19:13:57'),
(31, 81, 54, '2023-08-26 19:13:57', '2023-08-26 19:13:57', NULL),
(32, 89, 111, '2023-08-28 15:46:31', '2023-08-28 15:46:31', NULL),
(33, 98, 90, '2023-08-30 10:10:28', '2023-08-30 10:10:28', NULL),
(34, 99, 91, '2023-08-30 10:11:50', '2023-08-30 10:11:50', NULL),
(35, 133, 129, '2023-09-04 12:38:38', '2023-09-19 13:27:37', '2023-09-19 13:27:37'),
(36, 134, 36, '2023-09-04 12:44:08', '2023-09-04 12:44:08', NULL),
(37, 136, 79, '2023-09-04 13:50:54', '2023-09-04 13:50:54', NULL),
(38, 137, 79, '2023-09-04 13:52:14', '2023-09-04 13:52:14', NULL),
(39, 138, 79, '2023-09-04 13:53:13', '2023-09-04 13:53:13', NULL),
(40, 139, 63, '2023-09-04 14:10:42', '2023-09-04 14:10:42', NULL),
(41, 140, 63, '2023-09-04 14:11:46', '2023-09-04 14:11:46', NULL),
(42, 141, 63, '2023-09-04 14:12:28', '2023-09-04 14:14:01', '2023-09-04 14:14:01'),
(43, 141, 63, '2023-09-04 14:14:01', '2023-09-04 14:14:01', NULL),
(44, 142, 55, '2023-09-04 14:25:14', '2023-09-04 14:25:14', NULL),
(45, 143, 34, '2023-09-04 15:22:06', '2023-09-04 15:22:06', NULL),
(46, 144, 72, '2023-09-04 16:08:25', '2023-09-04 16:08:25', NULL),
(47, 145, 52, '2023-09-04 16:41:27', '2023-09-18 10:16:39', '2023-09-18 10:16:39'),
(48, 146, 42, '2023-09-04 16:46:48', '2023-09-05 14:05:12', '2023-09-05 14:05:12'),
(49, 147, 47, '2023-09-05 13:57:06', '2023-09-18 10:15:24', '2023-09-18 10:15:24'),
(50, 148, 35, '2023-09-05 14:01:03', '2023-09-05 14:01:03', NULL),
(51, 146, 42, '2023-09-05 14:05:12', '2023-09-05 14:09:25', '2023-09-05 14:09:25'),
(52, 149, 54, '2023-09-05 14:06:21', '2023-09-05 14:08:56', '2023-09-05 14:08:56'),
(53, 149, 54, '2023-09-05 14:08:56', '2023-09-05 14:08:56', NULL),
(54, 146, 42, '2023-09-05 14:09:25', '2023-09-05 14:09:25', NULL),
(55, 150, 133, '2023-09-05 14:49:18', '2023-09-05 14:49:18', NULL),
(56, 151, 97, '2023-09-10 11:23:34', '2023-09-10 11:23:34', NULL),
(57, 152, 55, '2023-09-10 14:22:10', '2023-09-17 10:40:20', '2023-09-17 10:40:20'),
(58, 52, 81, '2023-09-11 10:31:38', '2023-09-11 10:31:38', NULL),
(59, 153, 40, '2023-09-11 10:34:35', '2023-09-19 14:50:27', '2023-09-19 14:50:27'),
(60, 154, 49, '2023-09-11 10:41:27', '2023-09-11 10:41:27', NULL),
(61, 155, 49, '2023-09-11 10:42:19', '2023-09-12 12:01:17', '2023-09-12 12:01:17'),
(62, 156, 38, '2023-09-11 10:46:41', '2023-09-11 10:46:41', NULL),
(63, 157, 48, '2023-09-11 14:23:12', '2023-09-11 14:23:12', NULL),
(64, 158, 37, '2023-09-11 14:53:33', '2023-09-11 14:53:33', NULL),
(65, 159, 39, '2023-09-11 15:10:18', '2023-09-12 12:16:38', '2023-09-12 12:16:38'),
(66, 160, 62, '2023-09-11 16:36:27', '2023-09-11 16:36:38', '2023-09-11 16:36:38'),
(67, 160, 62, '2023-09-11 16:36:38', '2023-09-11 16:43:39', '2023-09-11 16:43:39'),
(68, 160, 62, '2023-09-11 16:43:39', '2023-09-11 16:48:18', '2023-09-11 16:48:18'),
(69, 161, 45, '2023-09-11 16:46:07', '2023-09-11 16:48:43', '2023-09-11 16:48:43'),
(70, 160, 62, '2023-09-11 16:48:18', '2023-09-11 16:48:18', NULL),
(71, 161, 45, '2023-09-11 16:48:43', '2023-09-17 12:14:51', '2023-09-17 12:14:51'),
(72, 155, 49, '2023-09-12 12:01:17', '2023-09-12 12:01:38', '2023-09-12 12:01:38'),
(73, 155, 49, '2023-09-12 12:01:38', '2023-09-12 12:01:38', NULL),
(74, 159, 39, '2023-09-12 12:16:38', '2023-09-12 12:16:38', NULL),
(75, 162, 76, '2023-09-12 13:50:22', '2023-09-18 10:32:38', '2023-09-18 10:32:38'),
(76, 20, 44, '2023-09-17 10:22:47', '2023-09-17 10:22:47', NULL),
(77, 152, 55, '2023-09-17 10:40:20', '2023-09-17 10:40:20', NULL),
(78, 23, 56, '2023-09-17 10:42:38', '2023-09-17 10:42:38', NULL),
(79, 21, 56, '2023-09-17 10:42:48', '2023-09-17 10:42:48', NULL),
(80, 40, 59, '2023-09-17 10:56:51', '2023-09-17 10:56:51', NULL),
(81, 197, 51, '2023-09-17 11:07:36', '2023-09-17 11:07:36', NULL),
(82, 161, 45, '2023-09-17 12:14:51', '2023-09-17 12:14:51', NULL),
(83, 199, 50, '2023-09-17 12:16:11', '2023-09-17 12:16:11', NULL),
(84, 200, 139, '2023-09-17 12:19:00', '2023-09-17 12:19:00', NULL),
(85, 201, 47, '2023-09-18 10:04:33', '2023-09-18 10:14:19', '2023-09-18 10:14:19'),
(86, 201, 47, '2023-09-18 10:14:19', '2023-09-18 10:14:19', NULL),
(87, 147, 47, '2023-09-18 10:15:24', '2023-09-18 10:15:24', NULL),
(88, 145, 52, '2023-09-18 10:16:39', '2023-09-18 10:16:39', NULL),
(89, 162, 76, '2023-09-18 10:32:38', '2023-09-18 10:32:38', NULL),
(90, 202, 34, '2023-09-18 10:55:07', '2023-09-18 11:06:34', '2023-09-18 11:06:34'),
(91, 202, 34, '2023-09-18 11:06:34', '2023-09-18 11:06:34', NULL),
(92, 203, 146, '2023-09-18 13:36:15', '2023-09-18 13:36:15', NULL),
(93, 133, 129, '2023-09-19 13:27:37', '2023-09-19 14:50:07', '2023-09-19 14:50:07'),
(94, 133, 129, '2023-09-19 14:50:07', '2023-09-19 14:50:07', NULL),
(95, 153, 40, '2023-09-19 14:50:27', '2023-09-19 14:50:27', NULL),
(96, 205, 45, '2023-09-19 16:38:04', '2023-09-19 16:38:04', NULL),
(97, 206, 54, '2023-09-20 09:55:41', '2023-09-20 10:01:22', '2023-09-20 10:01:22'),
(98, 206, 54, '2023-09-20 10:01:22', '2023-09-20 10:01:35', '2023-09-20 10:01:35'),
(99, 206, 54, '2023-09-20 10:01:35', '2023-09-20 10:02:19', '2023-09-20 10:02:19'),
(100, 206, 54, '2023-09-20 10:02:19', '2023-09-20 10:02:19', NULL),
(101, 209, 45, '2023-09-20 15:19:12', '2023-09-20 15:19:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `full_name_ar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name_en` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_work` date DEFAULT NULL,
  `graduation_date` date DEFAULT NULL,
  `university_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insurance_no` int(11) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finger_print_id` int(11) DEFAULT NULL,
  `user_name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `client_files`
--
ALTER TABLE `client_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_files_client_id_foreign` (`client_id`);

--
-- Indexes for table `client_permissions`
--
ALTER TABLE `client_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_permissions_main_client_id_foreign` (`main_client_id`),
  ADD KEY `client_permissions_sub_client_id_foreign` (`sub_client_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_position_id_foreign` (`position_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `positions_department_id_foreign` (`department_id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problems_admin_id_foreign` (`admin_id`),
  ADD KEY `problems_client_id_foreign` (`client_id`);

--
-- Indexes for table `problems_other_person_other_lawer`
--
ALTER TABLE `problems_other_person_other_lawer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problems_other_person_other_lawer_problem_id_foreign` (`problem_id`);

--
-- Indexes for table `problems_procedure`
--
ALTER TABLE `problems_procedure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problems_procedure_problem_id_foreign` (`problem_id`);

--
-- Indexes for table `problems_procedure_files`
--
ALTER TABLE `problems_procedure_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problems_procedure_files_problems_procedure_id_foreign` (`problems_procedure_id`);

--
-- Indexes for table `problem_clients`
--
ALTER TABLE `problem_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problem_clients_problem_id_foreign` (`problem_id`),
  ADD KEY `problem_clients_client_id_foreign` (`client_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_position_id_foreign` (`position_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `client_files`
--
ALTER TABLE `client_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `client_permissions`
--
ALTER TABLE `client_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `problems_other_person_other_lawer`
--
ALTER TABLE `problems_other_person_other_lawer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `problems_procedure`
--
ALTER TABLE `problems_procedure`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `problems_procedure_files`
--
ALTER TABLE `problems_procedure_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `problem_clients`
--
ALTER TABLE `problem_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_files`
--
ALTER TABLE `client_files`
  ADD CONSTRAINT `client_files_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `client_permissions`
--
ALTER TABLE `client_permissions`
  ADD CONSTRAINT `client_permissions_main_client_id_foreign` FOREIGN KEY (`main_client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `client_permissions_sub_client_id_foreign` FOREIGN KEY (`sub_client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `problems_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `problems_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `problems_procedure`
--
ALTER TABLE `problems_procedure`
  ADD CONSTRAINT `problems_procedure_problem_id_foreign` FOREIGN KEY (`problem_id`) REFERENCES `problems` (`id`);

--
-- Constraints for table `problems_procedure_files`
--
ALTER TABLE `problems_procedure_files`
  ADD CONSTRAINT `problems_procedure_files_problems_procedure_id_foreign` FOREIGN KEY (`problems_procedure_id`) REFERENCES `problems_procedure` (`id`);

--
-- Constraints for table `problem_clients`
--
ALTER TABLE `problem_clients`
  ADD CONSTRAINT `problem_clients_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `problem_clients_problem_id_foreign` FOREIGN KEY (`problem_id`) REFERENCES `problems` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
