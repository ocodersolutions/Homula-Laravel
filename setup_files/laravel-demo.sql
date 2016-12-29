-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2016 at 10:21 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `icon` varchar(500) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `link` varchar(500) NOT NULL,
  `target` varchar(50) NOT NULL,
  `publisher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `alias`, `icon`, `parent_id`, `link`, `target`, `publisher`) VALUES
(1, 'HOME', 'home', '', 0, '', '', 1),
(2, 'BUY', 'buy', '', 0, '', '', 1),
(3, 'SELL', 'sell', '', 0, '', '', 1),
(4, 'LEASE', 'lease', '', 0, '', '', 1),
(5, 'COMMERCIAL', 'commercial', '', 0, '', '', 1),
(6, 'PROFESSIONAL FINDER', 'professional-finder', '', 0, '', '', 1),
(7, 'MORTGAGE', 'mortgage', '', 0, '', '', 1),
(8, 'CALCULATORS', 'calculators', '', 0, '', '', 1),
(9, 'ADVICE', 'advice', '', 0, '', '', 1),
(10, 'ABOUT US', 'about-us', '', 0, '', '', 1),
(11, 'NEWS', 'news', '', 0, '', '', 1),
(12, 'RESALES HOME', 'resales-home', '<img src="http://homula-laravel.local/images/resales-home.png" alt="">', 2, '', '', 1),
(13, 'NEW CONSTRUCTION HOME', 'new-construction-home', '<img src="http://homula-laravel.local/images/new-construction-home.png" alt="">', 2, '', '', 1),
(14, 'NEW CONSTRUCTION CONDO', 'new-construction-condo', '<img src="http://homula-laravel.local/images/new-construction-condo.png" alt="">', 2, '', '', 1),
(15, 'EXCLUSIVE HOMES', 'exclusive-homes', '<img src="http://homula-laravel.local/images/exclusive-home.png" alt="">', 2, '', '', 1),
(16, 'OPEN HOUSE', 'open-house', '<img src="http://homula-laravel.local/images/open-house.png" alt="">', 2, '', '', 1),
(17, 'COMING SOON', 'coming-soon', '<img src="http://homula-laravel.local/images/coming-soon.png" alt="">', 2, '', '', 1),
(18, 'BUSINESS', 'business', '<img src="http://homula-laravel.local/images/business-homula.png" alt="">', 2, '', '', 1),
(19, 'FREE HOME EVALUATION', 'free-home-evaluation', '<img src="http://homula-laravel.local/images/free-home-evluation-homula.png" alt="">', 3, '', '', 1),
(20, 'FREE HOME REPORT', 'free-home-report', '<img src="http://homula-laravel.local/images/free-home-report-homula.png" alt="">', 3, '', '', 1),
(21, 'FIND A REALTOR', 'find-a-realtor', '<img src="http://homula-laravel.local/images/find-retailer-copy.png" alt="">', 3, '', '', 1),
(22, 'LIST MY HOUSE', 'list-my-house', '<img src="http://homula-laravel.local/images/list-my-home-homula.png" alt="">', 3, '', '', 1),
(23, 'LEASE SEARCH', 'lease-search', '<img src="http://homula-laravel.local/images/search-copy.png" alt="">', 4, '', '', 1),
(24, 'MAP SEARCH', 'map-search', '<img src="http://homula-laravel.local/images/search-copy.png" alt="">', 4, '', '', 1),
(25, 'COMMERCIAL SEARCH', 'commercial-search', '<img src="http://homula-laravel.local/images/search-copy.png" alt="">', 4, '', '', 1),
(26, 'BUSINESS', 'business', '<img src="http://homula-laravel.local/images/business-copy.png" alt="">', 4, '', '', 1),
(27, 'UTILITY', 'utility', '<img src="http://homula-laravel.local/images/utility-copy.png" alt="">', 4, '', '', 1),
(28, 'SEARCH', 'search', '<img src="http://homula-laravel.local/images/search-copy.png" alt="">', 4, '', '', 1),
(29, 'SEARCH', 'search', '<img src="http://homula-laravel.local/images/search-2.png" alt="">', 5, '', '', 1),
(30, 'ADVANCED SEARCH', 'advanced-search', '<img src="http://homula-laravel.local/images/ad-search2.png" alt="">', 5, '', '', 1),
(31, 'LIST YOUR PROPERTY', 'list-your-property', '<img src="http://homula-laravel.local/images/home-listing2.png" alt="">', 5, '', '', 1),
(32, 'FIND A COMMERCIAL REALTOR', 'find-a-commercial-realtor', '<img src="http://homula-laravel.local/images/find-retaile2.png" alt="">', 5, '', '', 1),
(33, 'REAL ESTATE PROFESSIONAL', 'real-estate-professional', '<img src="http://homula-laravel.local/images/real-estate-professiona-homula.png" alt="">', 6, '', '', 1),
(34, 'LEASING AGENT', 'leasing-agent', '<img src="http://homula-laravel.local/images/leasing-agent1-homula.png" alt="">', 6, '', '', 1),
(35, 'MORTGAGE BROKER', 'mortgage-broker', '<img src="http://homula-laravel.local/images/Mortage-broker-copy.png" alt="">', 6, '', '', 1),
(36, 'HOME INSPECTOR', 'home-inspector', '<img src="http://homula-laravel.local/images/homeinspector-homula.png" alt="">', 6, '', '', 1),
(37, 'REAL ESTATE LAWYER', 'real-estate-lawyer', '<img src="http://homula-laravel.local/images/lawyer-homula.png" alt="">', 6, '', '', 1),
(38, 'APPRAISER', 'appraiser', '<img src="http://homula-laravel.local/images/appraiser-homula.png" alt="">', 6, '', '', 1),
(39, 'PROPERTY MANAGEMENT', 'property-management', '<img src="http://homula-laravel.local/images/property-management-homula.png" alt="">', 6, '', '', 1),
(40, 'HOME STAGERS', 'home-stagers', '<img src="http://homula-laravel.local/images/home-stagers-homula.png" alt="">', 6, '', '', 1),
(41, 'INSURANCE BROKERS', 'insurance-brokers', '<img src="http://homula-laravel.local/images/insurance-broker-homula.png" alt="">', 6, '', '', 1),
(42, 'MOVING COMPANY', 'moving-company', '<img src="http://homula-laravel.local/images/moving-company-homula.png" alt="">', 6, '', '', 1),
(43, 'GRAPHIC DESIGNER', 'graphic-designer', '<img src="http://homula-laravel.local/images/photographers-reps-homula.png" alt="">', 6, '', '', 1),
(44, 'LAWYERS(FIRMS)', 'lawyers-firms', '<img src="http://homula-laravel.local/images/sign-supplir-copy.png" alt="">', 6, '', '', 1),
(45, 'SIGN INSTALLERS', 'sign-installers', '<img src="http://homula-laravel.local/images/shape-homula.png" alt="">', 6, '', '', 1),
(46, 'PRINTERS', 'printers', '<img src="http://homula-laravel.local/images/printer-homula.png" alt="">', 6, '', '', 1),
(47, 'PHOTOGRAPHERS (PROPERTIES)', 'photographers-properties', '<img src="http://homula-laravel.local/images/photographer-homula.png" alt="">', 6, '', '', 1),
(48, 'PHOTOGRAPHERS (REPS)', 'photographers-reps', '<img src="http://homula-laravel.local/images/photographers-reps-homula.png" alt="">', 6, '', '', 1),
(49, 'MORTGAGE BROKER', 'mortgage-broker', '<img src="http://homula-laravel.local/images/Mortage-broker-copy.png" alt="">', 7, '', '', 1),
(50, 'MORTGAGE INSURANCE CALCULATOR', 'mortgage-insurance-calculator', '<img src="http://homula-laravel.local/images/mortgage-insurance-calculator-copy.png" alt="">', 7, '', '', 1),
(51, 'MORTGAGE RATGES', 'mortgage-ratges', '<img src="http://homula-laravel.local/images/mortage-rates-copy.png" alt="">', 7, '', '', 1),
(52, 'NEW MORTGAGE CALCULATOR', 'new-mortgage-calculator', '<img src="http://homula-laravel.local/images/mortage-calculater-copy.png" alt="">', 7, '', '', 1),
(53, 'MORTGAGE CALCULATOR', 'mortgage-calculator', '<img src="http://homula-laravel.local/images/mortage-calculater-copy.png" alt="">', 8, '', '', 1),
(54, 'MORTGAGE INSURANCE CALCULATOR', 'mortgage-insurance-calculator', '<img src="http://homula-laravel.local/images/mortgage-insurance-calculator-copy.png" alt="">', 8, '', '', 1),
(55, 'LAND TRANSFER TAX CALCULATOR', 'land-transfer-tax-calculator', '<img src="http://homula-laravel.local/images/land-transfer-tax-calculator-copy.png" alt="">', 8, '', '', 1),
(56, 'ONTARIO MORTGAGE CALCULATOR', 'ontario-mortgage-calculator', '<img src="http://homula-laravel.local/images/land-transfer-tax-calculator-copy.png" alt="">', 8, '', '', 1),
(57, 'FAQ', 'faq', '<img src="http://homula-laravel.local/images/faq-1.png" alt="">', 9, '', '', 1),
(58, 'ASK A QUESTION', 'ask-a-question', '<img src="http://homula-laravel.local/images/Ask-a-question.png" alt="">', 9, '', '', 1),
(59, 'HELP CENTRE', 'help-centre', '<img src="http://homula-laravel.local/images/help-center-copy.png" alt="">', 9, '', '', 1),
(60, 'CONTACT US', 'contact-us', '<img src="http://homula-laravel.local/images/contact.png" alt="">', 9, '', '', 1),
(61, 'REALESTATE MARKET', 'realestate-market', '<img src="http://homula-laravel.local/images/news1.png" alt="">', 11, '', '', 1),
(62, 'WEEKLY BLOG', 'weekly-blog', '<img src="http://homula-laravel.local/images/news2.png" alt="">', 11, '', '', 1),
(63, 'TORONTO REALESTATE', 'toronto-realestate', '<img src="http://homula-laravel.local/images/toronto-realestate.png" alt="">', 11, '', '', 1),
(64, 'MLS LISTING', 'mls-listing', '<img src="http://homula-laravel.local/images/news1.png" alt="">', 11, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-post', 'Create Posts', 'create new blog posts', '2016-09-21 02:34:09', '2016-09-21 02:34:09'),
(2, 'edit-user', 'Edit Users', 'edit existing users', '2016-09-21 02:34:09', '2016-10-20 19:20:27'),
(3, 'read', 'Read', 'read', '2016-10-20 19:16:49', '2016-10-20 19:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'Project Owner', 'User is the owner of a given project 1', '2016-09-21 02:34:09', '2016-10-20 19:31:29'),
(2, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2016-09-21 02:34:09', '2016-09-21 02:34:09'),
(3, 'register', 'Register', 'Register', '2016-10-20 19:33:52', '2016-10-20 19:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(16, 1),
(16, 2),
(16, 3),
(18, 1),
(18, 2),
(18, 3),
(19, 1),
(20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first`, `middle`, `last`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(16, 'tester01', NULL, NULL, NULL, 'tester01@gmail.com', '$2y$10$5Ryr3t/cJrLAGwaAJYt0ye80ROdFmvZguD53yys3/OS/xEGBzIbta', 'Gm2a1645BlKivCvhcJGQh4d9IJWozzgFIn02cY8iXS73IGZWERxyCYL9QU3j', '2016-12-16 01:31:16', '2016-12-20 00:09:13'),
(18, 'admin', NULL, NULL, NULL, 'admin@gmail.com', '$2y$10$8LCnS/H7363VR3SBDssUoOEQZ80H5XzcBHiULsfYAijgmJLODx2fC', 'IQzoVyBble8DpzX9J85dh1GWNEwGE9PBtkhxC53dxH0rn9U95bwRitAWxQyz', '2016-12-20 00:09:30', '2016-12-20 02:18:31'),
(19, 'owner', NULL, NULL, NULL, 'owner@gmail.com', '$2y$10$aP1.tg.xO5FDKEbvEVurK.Bb328L2PcgEgkfxTWpnkyxD5ZeD44WC', 'S0ej8CrgqLhr0VH9qYRVq9pdyxtneDEigf6xlGKbQEqM3wvAg79mAekF3HWl', '2016-12-20 00:09:58', '2016-12-20 00:10:01'),
(20, 'register', NULL, NULL, NULL, 'register@gmail.com', '$2y$10$ndSNAqAy7hXzpaT3a9mX5.Wz5GmqjROtM5Gxd8F/UKkrcEUTfvHCe', '6KeYcXVoFXRxJb6O0pB4XCGGxytSELM6a3CbodhLhkY1H04SFiSvW6JBCLAO', '2016-12-20 00:10:22', '2016-12-20 02:19:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
