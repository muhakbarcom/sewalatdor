-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2021 at 08:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewalatdor`
--

-- --------------------------------------------------------

--
-- Table structure for table `akbr_contoh`
--

CREATE TABLE `akbr_contoh` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akbr_contoh`
--

INSERT INTO `akbr_contoh` (`id`, `nama`, `alamat`, `email`) VALUES
(1, 'Muhammad Akbar', 'Sarijadi, Bandung', 'muhammad.akbar5999@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_sewa` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_sewa`, `stok`) VALUES
(1, 'Tas Gunung/Carrier', 10000, 10),
(2, 'Tenda Dome', 50000, 6),
(3, 'Jaket Gunung', 20000, 8),
(4, 'Sepatu Gunung', 10000, 20),
(5, 'Sleeping bag', 10000, 11),
(6, 'Matras', 5000, 4),
(7, 'Senter', 5000, 3),
(8, 'Headlamp', 7000, 7),
(9, 'Sarung tangan', 3000, 5),
(10, 'Tongkat Gunung', 9000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_sewa`
--

CREATE TABLE `detail_sewa` (
  `id_detail_sewa` int(11) NOT NULL,
  `id_sewa` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_sewa`
--

INSERT INTO `detail_sewa` (`id_detail_sewa`, `id_sewa`, `id_barang`, `jumlah_barang`, `total_harga_sewa`) VALUES
(33, 17, 1, 1, 10000),
(34, 18, 2, 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `frontend_menu`
--

CREATE TABLE `frontend_menu` (
  `id_menu` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frontend_menu`
--

INSERT INTO `frontend_menu` (`id_menu`, `label`, `link`, `id`, `sort`) VALUES
(1, 'Home', 'frontend/index', 'Home', 0),
(2, 'Features', 'frontend/features', 'Features', 1),
(3, 'About', 'frontend/about', 'about', 2),
(4, 'Sign in', 'login', 'signin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(3, 'kasir', 'kasir pentyewaan alat outdoor');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 8),
(1, 89),
(1, 42),
(1, 43),
(1, 44),
(1, 1),
(3, 1),
(5, 1),
(1, 40),
(1, 92),
(5, 92),
(1, 95),
(5, 95),
(1, 96),
(5, 96),
(1, 100),
(5, 100),
(1, 101),
(5, 101),
(1, 102),
(5, 102),
(1, 104),
(5, 104),
(1, 105),
(5, 105),
(1, 106),
(5, 106),
(1, 107),
(5, 107),
(1, 3),
(2, 3),
(3, 3),
(1, 110),
(3, 110),
(1, 113),
(3, 113),
(1, 111),
(3, 111);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `list_session_token`
--

CREATE TABLE `list_session_token` (
  `session_id` int(11) NOT NULL,
  `session_token` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `active_time` datetime NOT NULL,
  `expire_time` datetime NOT NULL,
  `is_login` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_session_token`
--

INSERT INTO `list_session_token` (`session_id`, `session_token`, `admin_id`, `active_time`, `expire_time`, `is_login`) VALUES
(12, 'mFu6GqJ9laWV3G9pwgch9pETdg', 1, '2021-01-07 12:35:04', '2021-01-07 12:50:04', 0),
(13, 'S7oAgkk63Xm8n2MGzXIdnJsXho', 1, '2021-01-07 12:41:35', '2021-01-07 12:56:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(10, '::1', 'sisin', 1612027833);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `npm` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `npm`, `nama`, `tgl_lahir`) VALUES
(1, 2193001, 'Alvi Yatul Wardah', '2000-12-09'),
(2, 2193002, 'Aryaputra Wicaksono', '2001-05-30'),
(3, 2193003, 'Charles Marpaung', '2000-10-19'),
(4, 2193004, 'Ester Cibro', '2001-04-07'),
(5, 2193005, 'Fajar Somantri', '2000-08-10'),
(6, 2193006, 'Genta Tabah Pengabdian', '2001-04-20'),
(7, 2193007, 'Gerald Rajagukguk', '2001-06-03'),
(8, 2193008, 'Grenius Natanael Sidabutar', '2001-12-31'),
(9, 2193009, 'Ilfah Rifany', '2001-06-02'),
(10, 2193010, 'Khaliza Diva Qintanada', '2001-09-07'),
(11, 2193011, 'Koestiyandi Prayoga', '2001-05-17'),
(12, 2193012, 'Mita Hasanah', '2000-07-19'),
(13, 2193013, 'Muhammad Akbar', '1999-09-05'),
(14, 2193014, 'Nazzilla Auliya Putri', '2000-08-11'),
(15, 2193015, 'Popy Geovani', '2001-04-30'),
(16, 2193016, 'Prita Fitria Waluyo', '2001-01-09'),
(17, 2193017, 'Savia Almira Salsabilla', '2001-02-14'),
(18, 2193018, 'Tegar Nova Silviana', '2001-11-08'),
(19, 2193019, 'Thifal Irbah Anan', '2000-07-04'),
(20, 2193020, 'Vinda Ayu Lestari', '2001-01-20'),
(21, 2193021, 'Zsa Zsa Sabilla', '2001-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `scan_jaminan` varchar(50) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `alamat`, `scan_jaminan`) VALUES
(3, 'Muhammad Akbar', 'asdasd', 'fjaar.png'),
(4, 'Popy', 'Muara Enim', 'popo.png');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 99,
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(125) NOT NULL,
  `label` varchar(25) NOT NULL,
  `link` varchar(125) NOT NULL,
  `id` varchar(25) NOT NULL DEFAULT '#',
  `id_menu_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `sort`, `level`, `parent_id`, `icon`, `label`, `link`, `id`, `id_menu_type`) VALUES
(1, 0, 1, 0, 'empty', 'MAIN NAVIGATION', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', '#', 1),
(8, 8, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 6, 1, 0, 'empty', 'DEV', '#', '#', 1),
(42, 11, 2, 40, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 12, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 13, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 9, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(92, 3, 1, 0, 'empty', 'MASTER DATA', '#', 'masterdata', 1),
(107, 7, 2, 40, 'fas fa-cog', 'Setting', 'setting', 'setting', 1),
(110, 4, 2, 92, 'fas fa-box-open', 'Barang', 'barang', 'barang', 1),
(111, 2, 2, 1, 'fas fa-exchange-alt', 'Sewa', 'view_sewa', 'sewa', 1),
(113, 5, 2, 92, 'fas fa-user-friends', 'Member', 'member', 'member', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id_menu_type` int(11) NOT NULL,
  `type` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id_menu_type`, `type`) VALUES
(1, 'Side menu');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `kode`, `nama`, `nilai`) VALUES
(1, 'default.jpg', 'Sewalatdor', 'www.muhakbar.com');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id_sewa` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `tgl_sewa` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status` enum('dipinjam','kembali') NOT NULL DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id_sewa`, `id_member`, `id_user`, `tgl_sewa`, `tgl_kembali`, `tgl_pengembalian`, `denda`, `total_bayar`, `status`) VALUES
(17, 4, 1, '2021-01-30', '2021-01-29', '2021-01-30', 10000, 20000, 'kembali'),
(18, 4, 1, '2021-01-30', '2021-02-06', '2021-01-30', 0, 50000, 'kembali');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `image`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@muhakbar.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'WcHCQ5vcXwT1z99BvJUWnu', 1268889823, 1612027838, 1, 'Akbar', 'Admin', 'ADMIN', '0', 'akbr_pp_2.jpg'),
(10, '::1', 'sisin@gmail.com', '$2y$08$BFIi.RhdT.XU5enWa1Zqqur1QBU35Xy8tSBLpuBiuHQ2yEqcegfpC', NULL, 'sisin@gmail.com', NULL, NULL, NULL, NULL, 1612028695, NULL, 1, 'Sisin', 'Ms', 'Poltekpos', '089999999', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(33, 10, 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_detail_sewa`
-- (See below for the actual view)
--
CREATE TABLE `view_detail_sewa` (
`id_detail_sewa` int(11)
,`id_sewa` int(11)
,`nama_barang` varchar(100)
,`harga_sewa` int(11)
,`jumlah_barang` int(11)
,`total_harga_sewa` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sewa`
-- (See below for the actual view)
--
CREATE TABLE `view_sewa` (
`id_sewa` int(11)
,`Nama_Peminjam` varchar(50)
,`Nama_Kasir` varchar(101)
,`Tanggal_sewa` date
,`Tanggal_kembali` date
,`Tanggal_pengembalian` date
,`Denda` int(11)
,`Total_bayar` varchar(14)
,`STATUS` enum('dipinjam','kembali')
);

-- --------------------------------------------------------

--
-- Structure for view `view_detail_sewa`
--
DROP TABLE IF EXISTS `view_detail_sewa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail_sewa`  AS  (select `detail_sewa`.`id_detail_sewa` AS `id_detail_sewa`,`sewa`.`id_sewa` AS `id_sewa`,`barang`.`nama_barang` AS `nama_barang`,`barang`.`harga_sewa` AS `harga_sewa`,`detail_sewa`.`jumlah_barang` AS `jumlah_barang`,`detail_sewa`.`total_harga_sewa` AS `total_harga_sewa` from (((`detail_sewa` join `sewa` on(`detail_sewa`.`id_sewa` = `sewa`.`id_sewa`)) join `barang` on(`detail_sewa`.`id_barang` = `barang`.`id_barang`)) join `member` on(`sewa`.`id_member` = `member`.`id_member`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sewa`
--
DROP TABLE IF EXISTS `view_sewa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sewa`  AS  (select `sewa`.`id_sewa` AS `id_sewa`,`member`.`nama` AS `Nama_Peminjam`,concat(`users`.`first_name`,' ',`users`.`last_name`) AS `Nama_Kasir`,`sewa`.`tgl_sewa` AS `Tanggal_sewa`,`sewa`.`tgl_kembali` AS `Tanggal_kembali`,`sewa`.`tgl_pengembalian` AS `Tanggal_pengembalian`,`sewa`.`denda` AS `Denda`,concat('Rp.',`sewa`.`total_bayar`) AS `Total_bayar`,`sewa`.`status` AS `STATUS` from ((`sewa` join `member` on(`sewa`.`id_member` = `member`.`id_member`)) join `users` on(`sewa`.`id_user` = `users`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akbr_contoh`
--
ALTER TABLE `akbr_contoh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD PRIMARY KEY (`id_detail_sewa`),
  ADD KEY `id_sewa` (`id_sewa`),
  ADD KEY `id_barang_fk` (`id_barang`);

--
-- Indexes for table `frontend_menu`
--
ALTER TABLE `frontend_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `list_session_token`
--
ALTER TABLE `list_session_token`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `FK__list_admin` (`admin_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `npm` (`npm`) USING BTREE;

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id_menu_type`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `id_member_fk` (`id_member`),
  ADD KEY `id_user_fkk` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akbr_contoh`
--
ALTER TABLE `akbr_contoh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_sewa`
--
ALTER TABLE `detail_sewa`
  MODIFY `id_detail_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `frontend_menu`
--
ALTER TABLE `frontend_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `list_session_token`
--
ALTER TABLE `list_session_token`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD CONSTRAINT `id_barang_fk` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_sewa` FOREIGN KEY (`id_sewa`) REFERENCES `sewa` (`id_sewa`);

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `id_member_fk` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_user_fkk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
