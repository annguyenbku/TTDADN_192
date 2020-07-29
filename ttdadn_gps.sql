-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 18, 2020 lúc 06:13 AM
-- Phiên bản máy phục vụ: 10.4.10-MariaDB
-- Phiên bản PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ttdadn_gps`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `deviceroute`
--

CREATE TABLE `deviceroute` (
  `id` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `decription` varchar(255) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `deviceroute`
--

INSERT INTO `deviceroute` (`id`, `id_device`, `latitude`, `longitude`, `decription`, `date_update`) VALUES
(1, 2, 108, 14, 'Mô tả 1', '2020-07-13 00:12:12'),
(2, 1, 109, 14, 'Mô tả 2', '2020-07-07 00:08:07'),
(4, 6, 108, 15, NULL, '2020-07-14 17:00:00'),
(5, 6, 108, 15, NULL, '2020-07-14 17:00:00'),
(6, 6, 109, 14, NULL, '2020-06-30 17:00:00'),
(7, 6, 110, 13, NULL, '2020-07-19 17:00:00'),
(8, 6, 0, 0, NULL, '2020-07-18 03:28:01'),
(9, 6, 0, 0, NULL, '2020-07-18 03:29:08'),
(10, 6, 0, 0, NULL, '2020-07-18 03:33:28'),
(11, 6, 0, 0, NULL, '2020-07-18 03:33:30'),
(12, 6, 0, 0, NULL, '2020-07-18 03:38:21'),
(13, 6, 0, 0, NULL, '2020-07-18 03:38:36'),
(14, 6, 0, 0, NULL, '2020-07-18 03:38:37'),
(15, 6, 0, 0, NULL, '2020-07-18 03:41:31'),
(16, 6, 0, 0, NULL, '2020-07-18 03:42:14'),
(17, 6, 0, 0, NULL, '2020-07-18 03:42:17'),
(18, 6, 0, 0, NULL, '2020-07-18 03:43:44'),
(19, 6, 0, 0, NULL, '2020-07-18 03:47:44'),
(20, 6, 0, 0, NULL, '2020-07-18 03:50:01'),
(21, 6, 0, 0, NULL, '2020-07-18 03:51:03'),
(22, 6, 0, 0, NULL, '2020-07-18 03:56:23'),
(23, 6, 0, 0, NULL, '2020-07-18 03:59:50'),
(24, 6, 0, 0, NULL, '2020-07-18 04:03:39'),
(25, 6, 109, 12, NULL, '2020-07-18 04:09:29'),
(26, 6, 110, 10, NULL, '2020-07-18 04:10:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `modecode` varchar(20) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `description_device` varchar(255) DEFAULT NULL,
  `dateregister` datetime DEFAULT NULL,
  `licensePlate` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `devices`
--

INSERT INTO `devices` (`id`, `user_id`, `name`, `brand`, `modecode`, `color`, `description_device`, `dateregister`, `licensePlate`, `created_at`) VALUES
(1, 2, 'Xe Air Blade', 'HONDA', 'A123', 'Black', NULL, '2020-07-01 00:00:00', 'BC4851', '2020-07-12 17:00:00'),
(2, 2, 'Xe Air Blade', 'FDFD', 'A123', 'PINK', NULL, '2020-07-01 00:00:00', 'BC4851', '2020-07-12 17:00:00'),
(3, 1, 'Exciter', 'YAMAHA', 'AB12312', 'Red', NULL, '2020-07-02 00:00:00', 'BC852512', '2020-07-07 22:00:12'),
(6, 5, 'ABC', 'HONDA', 'AB123123', 'Pink', 'Đây là xe AB', '2020-07-13 11:25:43', NULL, '2020-07-13 04:25:43'),
(7, 5, 'Exciter', 'YAMAHA', 'AB123', 'Red', NULL, NULL, NULL, NULL),
(8, 5, 'Exciter', 'YAMAHA', 'AB123', 'Red', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gps_message`
--

CREATE TABLE `gps_message` (
  `id` int(11) NOT NULL,
  `mess` varchar(255) NOT NULL,
  `date_GPS` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `gps_message`
--

INSERT INTO `gps_message` (`id`, `mess`, `date_GPS`) VALUES
(1, 'fsgdhfjmgkjjhgfđsfdgfbhngmh,mn', '2020-07-08 17:00:00'),
(2, 'asdfsadfsadfsda', NULL),
(3, '[{device_id: GPS,values:[109,12]}]', NULL),
(4, '[{device_id: GPS,values:[109,12]}]', NULL),
(5, '[{device_id: GPS,values:[109,12]}]', NULL),
(6, '[{device_id: GPS,values:[109,12]}]', NULL),
(7, '[{device_id: GPS,values:[109,12]}]', NULL),
(8, '[{\"device_id\": \"GPS\",\"values\":[\"109\",\"12\"]}]', NULL),
(9, '[{\"device_id\": \"GPS\",\"values\":[\"110\",\"10\"]}]', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `idcard` varchar(20) DEFAULT NULL,
  `license_number` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `permission` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `birthday`, `address`, `email`, `phonenumber`, `idcard`, `license_number`, `gender`, `permission`, `created_at`) VALUES
(1, 'user01', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL, 'quanghieu@gmail.com', NULL, NULL, NULL, NULL, 1, NULL),
(2, 'abc123', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL, 'quanghieu1@gmail.com', NULL, NULL, NULL, NULL, 2, '2020-07-12 05:02:44'),
(3, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'aaaaaaaaaa', 'BN', '2020-07-01', 'Thu Duc - TP HCM', 'user1@gmail.com', '0123356262', '123426244', 'LC952663', NULL, 2, '2020-07-13 03:14:38'),
(4, '', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2020-07-18 02:30:31'),
(5, 'quanghieu', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 'quanghieu123@gmail.com', NULL, NULL, NULL, NULL, NULL, '2020-07-18 02:41:03');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `deviceroute`
--
ALTER TABLE `deviceroute`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gps_message`
--
ALTER TABLE `gps_message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `deviceroute`
--
ALTER TABLE `deviceroute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `gps_message`
--
ALTER TABLE `gps_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
