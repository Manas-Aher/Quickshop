-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2025 at 02:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `image`, `quantity`, `user_email`) VALUES
(11, 'MSI GeForce RTX 5080', 85000.00, 'msi_graphic_card1.png', 1, 'manasaher123@gmail.com'),
(12, 'Samsung Odyssey OLED G9', 108000.00, 'samsung_monitor.jpg', 1, 'manasaher123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(100) NOT NULL,
  `flat` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `total_products` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `placed_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `name`, `number`, `email`, `method`, `flat`, `street`, `city`, `state`, `country`, `pin_code`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, '', '45555555555555555556', 'htrshsthsh@gmail.com', 'credit card', 'fgfgn', 'fhff', 'yjdryjd', 'dyjdtyjtdy', 'djtyjdtyj', 'tjtyjtyj', 'HyperX Alloy Origin 60 (1) , MSI GeForce RTX 5080 (1) ', 103500.00, '2025-12-25 14:52:30', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT 'CPU Cases',
  `stock` int(11) DEFAULT 100,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `description`, `category`, `stock`, `created_at`) VALUES
(1, 'RGB Gaming Case', 6500.00, 'case1.png', 'Tempered glass RGB gaming case', 'CPU Cases', 45, '2025-12-18 22:00:35'),
(2, 'Mid Tower Case', 4500.00, 'case2.png', 'ATX mid tower with good airflow', 'CPU Cases', 60, '2025-12-18 22:00:35'),
(3, 'Full Tower Case', 9500.00, 'case3.png', 'Full tower with cable management', 'CPU Cases', 30, '2025-12-18 22:00:35'),
(4, 'Mini ITX Case', 5500.00, 'case4.jpg', 'Compact mini ITX case', 'CPU Cases', 40, '2025-12-18 22:00:35'),
(5, 'Premium RGB Case', 12000.00, 'case5.jpg', 'Premium case with RGB fans', 'CPU Cases', 25, '2025-12-18 22:00:35'),
(6, 'Budget Case', 25000.00, 'case6.jpg', 'Affordable ATX case', 'CPU Cases', 100, '2025-12-18 22:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT 'Electronics',
  `stock` int(11) DEFAULT 100,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `category`, `stock`, `created_at`) VALUES
(1, 'MSI GeForce RTX 5080', 85000.00, 'msi_graphic_card1.png', 'MSI RTX 5080 16G SUPRIM LIQUID SOC - 7680 x 4320 - 2.76 GHz Boost Clock - 256 bit Bus Width - PCI Express 5.0 x16 - DisplayPort - 3 x DisplayPort - HDMI (G5080-16SLS).', 'Graphic Card', 50, '2025-12-18 22:00:35'),
(2, 'HyperX Alloy Origin 60', 18500.00, 'hyper_keyboard.jpg', 'HyperX Alloy Origins 60 – Mechanical Gaming Keyboard, HyperX Red Switch (Linear), RGB LED Backlit,Side Printed Secondary Functions, NGENUITY Software Compatible, Black.', 'Gaming Keyboard', 100, '2025-12-18 22:00:35'),
(3, 'Logitech G502 X Lightspeed Plus', 13500.00, 'logitech_mouse.webp', 'Logitech G502 X Lightspeed Plus Wireless RGB Gaming Mouse - Optical Mouse with LIGHTFORCE Hybrid switches, LIGHTSYNC RGB, Hero 25K Gaming Sensor, Compatible with PC/macOS/Windows - Black.', 'Gaming Mouse', 150, '2025-12-18 22:00:35'),
(4, 'ASUS ROG Pelta Wireless Gaming Headset', 22500.00, 'rog_headset.webp', 'ASUS ROG Pelta Wireless Gaming Headset (BT, ROG SpeedNova 2.4GHz, USB-C, Lightweight 309g, 50mm ROG Titanium-Plated Drivers, 10mm Super-Wideband Mic, RGB, 70HR Battery, for PC, Switch, PS5)- Black.\r\n', 'Gaming Headphone', 75, '2025-12-18 22:00:35'),
(5, 'Samsung Odyssey OLED G9', 108000.00, 'samsung_monitor.jpg', 'Samsung Odyssey OLED G9 49-inch(124.4cm) Dual QHD 5120 x 1440 Curved 1800R Gaming Monitor, 240Hz, 0.03ms, FreeSync Premium Pro, G-Sync, Quantum Dot, HDR10+, Speaker, HAS (LS49CG930SWXXL, Silver)\r\n', 'Gaming Monitor', 40, '2025-12-18 22:00:35'),
(6, 'MSI GeForce RTX 4060Ti', 65000.00, 'msi_graphic_card.webp', 'MSI GeForce RTX 4060 Ti Ventus 2X Black 8G OC Graphics Card -NVIDIA RTX 4060 Ti, 8GB GDDR6 Memory, 18Gbps, PCIe 4.0, DLSS3.', 'Graphic Card', 25, '2025-12-18 22:00:35'),
(7, 'TeamGroup T-Force Xtreem ARGB ', 21500.00, 'ram2.jpg', 'TeamGroup T-Force Xtreem ARGB 16GB (8GBx2) 3600MHz DDR4 Gaming Memory.', 'RAM', 200, '2025-12-18 22:00:35'),
(8, 'Gigabyte 512 SSD', 8500.00, 'ssd1.jpg', 'Fast NVMe SSD storage', 'Electronics', 100, '2025-12-18 22:00:35'),
(9, 'AORUS P1200W', 18000.00, 'power_supply.png', 'Digital LCD monitor\r\n80 PLUS Platinum certified\r\nFully modular design\r\n100% Japanese capacitors\r\nCompact size design\r\n140mm smart double ball bearing fan\r\nFan dust removal function\r\nSingle +12V rail\r\nOVP/OPP/SCP/UVP/OCP/OTP protection\r\n10 years warranty (Adjusted according to different regions).', 'Power Supply', 60, '2025-12-18 22:00:35'),
(10, 'GIGABYTE B760 GAMING X AX', 7500.00, 'motherboard3.jpg', 'GIGABYTE B760 GAMING X AX LGA 1700Socket ATX Intel B75 Chipset DDR5 Motherboard for Desktop.', 'Motherboard', 80, '2025-12-18 22:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `email_verified_at` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `verification_code`, `email_verified_at`, `reset_token`, `created_at`) VALUES
(8, 'Manas', '3618635786', 'manasaher123@gmail.com', '$2y$10$Bd1O7NQBrKIifIloXQkW3.GQwKUxePOvvYt96BdJG.iI2K6YGRSDO', '207221', '2025-12-26 04:37:00', NULL, '2025-12-25 23:06:39'),
(9, 'Mandar', '2938428472', 'mandaraher14@gmail.com', '$2y$10$E8wLFyLAX7uJD7eVFoe7WuMrHL8S8sYb54ZmkoP9cNJep55WCFkkq', '425318', '2025-12-26 04:39:00', NULL, '2025-12-25 23:08:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `idx_placed_on` (`placed_on`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_price` (`price`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
