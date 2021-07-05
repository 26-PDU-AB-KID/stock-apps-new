-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 07:30 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `convert_data`
--

CREATE TABLE `convert_data` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `raw_material_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount_raw_material` double(10,2) NOT NULL,
  `amount_product` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `convert_data`
--

INSERT INTO `convert_data` (`id`, `date`, `raw_material_id`, `product_id`, `supplier_id`, `amount_raw_material`, `amount_product`) VALUES
(3, '2021-06-25 09:13:39', 2, 3, 2, 2.00, 2.00),
(4, '2021-06-25 09:14:19', 2, 3, 2, 2.00, 2.00),
(5, '2021-06-25 09:14:43', 2, 3, 2, 2.00, 2.00),
(6, '2021-06-25 09:15:32', 1, 2, 1, 1.00, 1.00),
(7, '2021-06-25 09:16:41', 2, 3, 2, 2.00, 2.00),
(8, '2021-06-28 06:13:18', 1, 1, 1, 1.50, 3.00),
(9, '2021-06-28 06:13:38', 1, 1, 1, 1.50, 3.00),
(10, '2021-06-28 06:13:49', 1, 1, 1, 1.50, 3.00),
(11, '2021-06-28 06:14:29', 1, 1, 1, 1.50, 3.00),
(12, '2021-06-28 08:37:56', 1, 2, 1, 1.00, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(128) NOT NULL,
  `pic` varchar(128) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `remark_deleted` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `code`, `name`, `pic`, `phone`, `address`, `created_at`, `updated_at`, `is_deleted`, `remark_deleted`, `deleted_at`) VALUES
(1, 'CUST00001', 'baldin', 'prasetia', '082364851723', 'Jalan - jalan Sentra Niaga', '2021-06-17 04:45:38', NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `name` varchar(128) NOT NULL,
  `product_unit` varchar(10) NOT NULL,
  `weight` int(11) NOT NULL,
  `cost_of_goods` decimal(10,0) NOT NULL,
  `selling_price_of_goods` decimal(10,0) NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `per_pcs` decimal(10,2) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `remark_deleted` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `name`, `product_unit`, `weight`, `cost_of_goods`, `selling_price_of_goods`, `raw_material_id`, `per_pcs`, `unit_id`, `created_at`, `updated_at`, `is_deleted`, `remark_deleted`, `deleted_at`) VALUES
(1, '4237358296241', 'ayo berkebun gula aren semut', 'gram', 500, '14500', '17500', 1, '0.50', 1, '2021-06-22 04:03:32', NULL, '0', NULL, NULL),
(2, '8110097030833', 'Ayo Berkebun Gula Aren Semut', 'gram', 1000, '31700', '34700', 1, '1.00', 1, '2021-06-21 08:16:08', '2021-06-25 09:15:32', '0', NULL, NULL),
(3, '8955500786046', 'Ayo Berkebun Gula Aren Cair', 'liter', 1000, '32000', '35000', 2, '1.00', 2, '2021-06-21 09:10:44', '2021-06-25 09:16:41', '0', NULL, NULL),
(4, '4237358296241', 'ayo berkebun gula aren semut', 'gram', 500, '14500', '17500', 1, '1.00', 1, '2021-06-22 04:02:06', NULL, '1', 'hapus gula aren semut', '2021-06-22 04:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials`
--

CREATE TABLE `raw_materials` (
  `id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(128) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `remark_deleted` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `raw_materials`
--

INSERT INTO `raw_materials` (`id`, `code`, `name`, `unit_id`, `created_at`, `updated_at`, `is_deleted`, `remark_deleted`, `deleted_at`) VALUES
(1, 'RAW00001', 'gula aren curah', 1, '2021-06-17 04:46:33', '2021-06-17 04:55:23', '0', NULL, NULL),
(2, 'RAW00002', 'gula aren cair', 2, '2021-06-17 04:46:45', NULL, '0', NULL, NULL),
(3, 'RAW00003', 'madu', 1, '2021-06-22 06:44:27', NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_products`
--

CREATE TABLE `stock_in_products` (
  `id` int(11) NOT NULL,
  `no_transaction` varchar(128) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `supplier_id` int(11) NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_unit` varchar(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `price` int(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_in_products`
--

INSERT INTO `stock_in_products` (`id`, `no_transaction`, `date`, `supplier_id`, `raw_material_id`, `product_id`, `product_unit`, `amount`, `price`, `created_at`) VALUES
(1, 'INV-IN-06-21020001', '2021-06-21 17:00:00', 1, 1, 2, 'gram', '10.00', 250000, '2021-06-29 09:46:44'),
(2, 'INV-IN-06-21020002', '2021-06-21 17:00:00', 2, 1, 1, 'gram', '10.00', 100000, '2021-06-29 09:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_raw_materials`
--

CREATE TABLE `stock_in_raw_materials` (
  `id` int(11) NOT NULL,
  `no_transaction` varchar(128) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `supplier_id` int(11) NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `price` int(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_in_raw_materials`
--

INSERT INTO `stock_in_raw_materials` (`id`, `no_transaction`, `date`, `supplier_id`, `raw_material_id`, `unit_id`, `amount`, `price`, `created_at`) VALUES
(1, 'INV-IN-06-21020001', '2021-06-02 17:00:00', 0, 0, 0, '20.00', 4000000, '2021-06-17 05:35:41'),
(2, 'INV-IN-06-21020002', '2021-06-09 17:00:00', 1, 1, 1, '20.00', 3000000, '2021-06-17 05:38:40'),
(3, 'INV-IN-06-21020003', '2021-05-31 17:00:00', 2, 2, 2, '5.00', 100000, '2021-06-17 05:52:02'),
(4, 'INV-IN-06-21020004', '2021-06-02 17:00:00', 2, 2, 2, '1.00', 25000, '2021-06-17 05:54:05'),
(5, 'INV-IN-06-21020005', '2021-06-11 17:00:00', 2, 2, 2, '2.00', 50000, '2021-06-17 05:55:06'),
(6, 'INV-IN-06-21020006', '2021-06-04 17:00:00', 1, 1, 1, '1.00', 25000, '2021-06-17 05:55:25'),
(7, 'INV-IN-06-21020007', '2021-06-03 17:00:00', 1, 1, 1, '2.00', 100000, '2021-06-17 05:56:03'),
(8, 'INV-IN-06-21020008', '2021-06-11 17:00:00', 1, 1, 1, '2.00', 50000, '2021-06-17 05:56:38'),
(9, 'INV-IN-06-21020009', '2021-06-07 17:00:00', 1, 1, 1, '2.00', 40000, '2021-06-17 06:05:42'),
(10, 'INV-IN-06-21020010', '2021-06-06 17:00:00', 1, 1, 1, '1.00', 20000, '2021-06-17 06:06:25'),
(11, 'INV-IN-06-21020011', '0000-00-00 00:00:00', 1, 1, 1, '10.00', 200000, '2021-06-21 03:46:34'),
(12, 'INV-IN-06-21020012', '0000-00-00 00:00:00', 2, 2, 2, '10.00', 100000, '2021-06-21 04:09:14'),
(13, 'INV-IN-06-21020013', '2021-06-02 17:00:00', 2, 2, 2, '1.00', 20000, '2021-06-21 04:19:26'),
(14, 'INV-IN-06-21020014', '2021-06-02 17:00:00', 1, 2, 2, '10.00', 200000, '2021-06-22 06:46:41'),
(15, 'INV-IN-06-21020015', '2021-06-01 17:00:00', 1, 2, 2, '100.00', 1000000, '2021-06-22 06:47:28'),
(16, 'INV-IN-06-21020016', '2021-06-20 17:00:00', 1, 2, 2, '1.00', 15000, '2021-06-22 06:48:25'),
(17, 'INV-IN-06-21020017', '2021-06-14 17:00:00', 1, 2, 2, '1.00', 15000, '2021-06-22 06:51:01'),
(18, 'INV-IN-06-21020018', '2021-06-08 17:00:00', 1, 2, 2, '1.00', 15000, '2021-06-22 06:52:34'),
(19, 'INV-IN-06-21020019', '2021-06-21 17:00:00', 1, 2, 2, '1.00', 14000, '2021-06-22 06:58:15'),
(20, 'INV-IN-06-21020020', '2021-06-21 17:00:00', 2, 3, 1, '1.00', 25000, '2021-06-22 06:58:46'),
(21, 'INV-IN-06-21020021', '2021-06-15 17:00:00', 1, 2, 2, '1.00', 12000, '2021-06-22 08:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_products`
--

CREATE TABLE `stock_out_products` (
  `no_transaction` varchar(32) NOT NULL,
  `date` datetime NOT NULL,
  `total_price` int(11) NOT NULL,
  `client_money` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `paid` enum('0','1') NOT NULL,
  `ppn` enum('0','1') NOT NULL,
  `ttd` enum('0','1') NOT NULL,
  `materai` enum('0','1') NOT NULL,
  `shipping` enum('0','1') NOT NULL,
  `amount_shipping` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_product_details`
--

CREATE TABLE `stock_out_product_details` (
  `id` int(11) NOT NULL,
  `no_transaction` varchar(32) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `selling_price_of_goods` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price_subtotal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_products`
--

CREATE TABLE `stock_products` (
  `id` int(11) NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `remark_deleted` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_products`
--

INSERT INTO `stock_products` (`id`, `raw_material_id`, `product_id`, `supplier_id`, `amount`, `created_at`, `updated_at`, `is_deleted`, `remark_deleted`, `deleted_at`) VALUES
(1, 1, 1, 1, 3, '2021-06-28 06:14:29', NULL, '0', '', NULL),
(2, 1, 2, 1, 21, '2021-06-28 08:37:56', '2021-06-29 09:46:44', '0', '', NULL),
(3, 1, 1, 2, 10, '2021-06-28 09:59:00', '2021-06-29 09:48:39', '0', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_raw_materials`
--

CREATE TABLE `stock_raw_materials` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `remark_deleted` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_raw_materials`
--

INSERT INTO `stock_raw_materials` (`id`, `supplier_id`, `raw_material_id`, `amount`, `created_at`, `updated_at`, `is_deleted`, `remark_deleted`, `deleted_at`) VALUES
(1, 1, 1, '34.50', '2021-06-17 04:46:53', '2021-06-28 08:37:56', '0', NULL, NULL),
(2, 2, 2, '127.00', '2021-06-17 04:47:33', '2021-06-25 09:16:41', '0', NULL, NULL),
(3, 2, 3, '1.00', '2021-06-22 06:44:55', '2021-06-22 06:58:46', '0', NULL, NULL),
(4, 1, 2, '3.00', '2021-06-22 06:46:13', '2021-06-22 08:54:16', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `remark_deleted` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `created_at`, `updated_at`, `is_deleted`, `remark_deleted`, `deleted_at`) VALUES
(1, 'endar', 'Jalan Damai Sejahtera', '2021-06-17 04:46:06', '2021-06-22 05:28:16', '0', NULL, NULL),
(2, 'kris', 'Jalan Tengah', '2021-06-17 04:47:25', NULL, '0', NULL, NULL),
(3, 'jeni', 'Jalan - Jalan', '2021-06-28 09:50:07', NULL, '1', 'lagi pengen aja', '2021-06-28 09:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `symbol` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `symbol`) VALUES
(1, 'Kilogram', 'kg'),
(2, 'Liter', 'l');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_workunit` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_workunit`, `name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'superuser', 'superuser@gmail.com', '$2y$10$B.qoPo99crqhglk.T7shReH3aZalyvZqOOuDD4XAYVOMrVIZJuESe', 'superuser', 1, '2021-05-20 03:28:45', NULL),
(2, 1, 'endar deby kurniawan', 'endar@gmail.com', '$2y$10$G1f1O00xVFv19Mv3kX.ZV.ipmBMcoak5ICrE0xPJhW0dLQDS6D94G', 'admin', 1, '2021-05-20 03:53:38', '2021-05-27 05:36:53');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_stock_raw_material_by_raw_materials`
-- (See below for the actual view)
--
CREATE TABLE `view_stock_raw_material_by_raw_materials` (
`raw_material_id` int(11)
,`code` varchar(16)
,`raw_material_name` varchar(128)
,`unit_name` varchar(128)
,`stock` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_stock_raw_material_by_suppliers`
-- (See below for the actual view)
--
CREATE TABLE `view_stock_raw_material_by_suppliers` (
`stock_raw_material_id` int(11)
,`supplier_id` int(11)
,`raw_material_id` int(11)
,`unit_id` int(11)
,`supplier_name` varchar(128)
,`code` varchar(16)
,`raw_material_name` varchar(128)
,`unit_name` varchar(128)
,`symbol` varchar(16)
,`amount` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Structure for view `view_stock_raw_material_by_raw_materials`
--
DROP TABLE IF EXISTS `view_stock_raw_material_by_raw_materials`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_raw_material_by_raw_materials`  AS  select `stock_raw_materials`.`raw_material_id` AS `raw_material_id`,`raw_materials`.`code` AS `code`,`raw_materials`.`name` AS `raw_material_name`,`units`.`name` AS `unit_name`,sum(`stock_raw_materials`.`amount`) AS `stock` from ((`stock_raw_materials` left join `raw_materials` on(`stock_raw_materials`.`raw_material_id` = `raw_materials`.`id`)) left join `units` on(`raw_materials`.`unit_id` = `units`.`id`)) where `stock_raw_materials`.`is_deleted` = '0' group by `stock_raw_materials`.`raw_material_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_stock_raw_material_by_suppliers`
--
DROP TABLE IF EXISTS `view_stock_raw_material_by_suppliers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_raw_material_by_suppliers`  AS  select `stock_raw_materials`.`id` AS `stock_raw_material_id`,`suppliers`.`id` AS `supplier_id`,`raw_materials`.`id` AS `raw_material_id`,`units`.`id` AS `unit_id`,`suppliers`.`name` AS `supplier_name`,`raw_materials`.`code` AS `code`,`raw_materials`.`name` AS `raw_material_name`,`units`.`name` AS `unit_name`,`units`.`symbol` AS `symbol`,`stock_raw_materials`.`amount` AS `amount` from (((`stock_raw_materials` left join `suppliers` on(`stock_raw_materials`.`supplier_id` = `suppliers`.`id`)) left join `raw_materials` on(`stock_raw_materials`.`raw_material_id` = `raw_materials`.`id`)) left join `units` on(`raw_materials`.`unit_id` = `units`.`id`)) where `stock_raw_materials`.`is_deleted` = '0' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `convert_data`
--
ALTER TABLE `convert_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_materials`
--
ALTER TABLE `raw_materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `stock_in_products`
--
ALTER TABLE `stock_in_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_in_raw_materials`
--
ALTER TABLE `stock_in_raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_products`
--
ALTER TABLE `stock_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_raw_materials`
--
ALTER TABLE `stock_raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `convert_data`
--
ALTER TABLE `convert_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `raw_materials`
--
ALTER TABLE `raw_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_in_products`
--
ALTER TABLE `stock_in_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_in_raw_materials`
--
ALTER TABLE `stock_in_raw_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stock_products`
--
ALTER TABLE `stock_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_raw_materials`
--
ALTER TABLE `stock_raw_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
