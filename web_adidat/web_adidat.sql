-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th7 06, 2025 lúc 05:33 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_adidat`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins_log`
--

CREATE TABLE `admins_log` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(2, 'Áo'),
(3, 'Dép'),
(1, 'Giày');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(320) NOT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` enum('Chưa xác nhận','Chờ xử lý','Hoàn thành') NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `customer_name`, `phone_number`, `email`, `city`, `district`, `address`, `note`, `status`, `total`) VALUES
(54, '2025-07-05 16:52:16', 'dat', '0998877666', 'dat@gmail.com', 'hcm', '12', '12', '', 'Chờ xử lý', 3000000.00),
(55, '2025-07-05 16:52:47', 'dat', '0998877666', 'dat@gmail.com', 'hcm', '12', '12', '', 'Hoàn thành', 6000000.00),
(56, '2025-07-05 20:29:08', 'dat', '0998877666', 'dat@gmail.com', 'hcm', '12', '12', '1236', 'Hoàn thành', 3000000.00),
(57, '2025-07-06 09:13:26', 'dat', '0998877666', 'dat@gmail.com', 'hcm', '12', '12', '', 'Chưa xác nhận', 1800000.00),
(58, '2025-07-06 09:40:09', 'dat', '0399999999', 'dat@gmail.com', 'hcm', '12', '12', '', 'Hoàn thành', 6000000.00),
(59, '2025-07-06 10:13:05', 'dat', '0399999999', 'dat@gmail.com', 'hcm', '12', '12', '', 'Hoàn thành', 3600000.00),
(60, '2025-07-06 11:07:27', 'dat', '0399999999', 'dat@gmail.com', 'hcm', '12', '12', '', 'Chưa xác nhận', 1800000.00),
(61, '2025-07-06 15:22:39', 'dat', '0399999999', 'dat@gmail.com', 'hcm', '12', '12', '', 'Chưa xác nhận', 3000000.00),
(62, '2025-07-06 15:23:34', 'dat', '0399999999', 'dat@gmail.com', 'hcm', '12', '12', '', 'Chưa xác nhận', 1000000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_value` varchar(10) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` bigint(20) NOT NULL,
  `product_size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `size_value`, `quantity`, `unit_price`, `product_size_id`) VALUES
(15, 54, 29, '0', 1, 3000000, NULL),
(16, 55, 29, '0', 2, 3000000, NULL),
(17, 56, 29, '0', 1, 3000000, NULL),
(18, 57, 25, '0', 1, 1800000, NULL),
(19, 58, 29, '0', 1, 3000000, NULL),
(20, 58, 29, '0', 1, 3000000, NULL),
(21, 59, 28, '0', 1, 1800000, NULL),
(22, 59, 28, '0', 1, 1800000, NULL),
(23, 60, 28, '0', 1, 1800000, NULL),
(24, 61, 29, 'XL', 1, 3000000, NULL),
(25, 62, 21, '42', 1, 1000000, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `image_url`, `category_id`) VALUES
(1, 'Giày Samba OG', 'Đôi giày classic bằng da mềm mại với mũi giày chữ T bằng da lộn.', 1890000, 'uploads/Giay_Samba_OG.jpg', 1),
(2, 'Giày Adizero Boston 13', 'Giày chạy siêu nhẹ, lý tưởng cho tập luyện tốc độ và chuẩn bị thi đấu.', 4000000, 'uploads/giay-adizero-boston-13.jpg', 1),
(3, 'Dép adilette', 'Ra mắt lần đầu vào năm 1972, adilette đã trở thành mẫu dép phổ biến nhất trên toàn cầu. Với thiết kế phù hợp cho nghỉ ngơi và thư giãn, mẫu dép siêu nhẹ này có quai dép co giãn và thân dép ôm chân cho cảm giác thoải mái dài lâu.', 950000, 'uploads/dep-adilette.jpg', 3),
(4, 'Dép adilette Lumia', 'Đôi dép slip-on nhanh khô hoàn hảo cho những hành trình phiêu lưu bên làn nước.', 750000, 'uploads/dep-adilette-lumia.jpg', 3),
(5, 'Đôi giày Adizero Boston 13', 'Đôi giày chạy bộ siêu nhẹ có sử dụng chất liệu tái chế.', 4000000, 'uploads/doi-giay-adizero-boston-13.jpg', 1),
(13, 'Giày Adizero EVO SL', 'Giày thiết kế lấy cảm hứng từ tốc độ, phù hợp cho những ai đam mê phong cách sống nhanh.', 4000000, 'uploads/giay-adizero-evo-sl.jpg', 1),
(14, 'Giày Cloudfoam Walk Lounger', 'Giày siêu nhẹ, không dây, dễ dàng mang vào và tháo ra.', 1700000, 'uploads/giay-cloudfoam-walk-lounger.jpg', 1),
(15, 'Giày chạy bộ Duramo RC2', 'Giày chạy bộ nhẹ nhàng, êm ái – đồng hành cùng bạn mỗi ngày.', 110000, 'uploads/giay-chay-bo-duramo-rc2.jpg', 1),
(16, 'Giày Y-3 Regu 2002', 'Giày da dáng thấp từ thương hiệu Y-3', 10990000, 'uploads/giay-y-3-regu-2002.jpg', 1),
(17, 'Dép Adilette Shower Manchester United', 'Những đôi dép kinh điển dành cho người hâm mộ Manchester United.', 3100000, 'uploads/Dep_Adilette_Shower_Manchester_United_DJen_JS4963.jpg', 3),
(20, 'Dép Sandal ZNSORY', 'Dép sandal phong cách casual với quai dán tiện lợi.', 1000000, 'uploads/Dep_Sandal_ZNSORY_DJen_JR3122.jpg', 3),
(21, 'Dép Sục adilette', 'Đôi dép sục cho cảm giác thoải mái mỗi ngày.', 1000000, 'uploads/Dep_Suc_adilette_Mau_xanh_da_troi_JI2241.jpg', 3),
(22, 'MER TM POLO BM', 'MER TM POLO BM', 2300000, 'uploads/MER_TM_POLO_BM_DJen_JW5391_01_laydown.jpg', 2),
(23, 'Áo đấu sân nhà Manchester United mùa giải 25/26', 'Được thiết kế để mang lại cảm giác thoải mái, mẫu áo sân nhà kinh điển của Man Utd này mang đậm phong cách Old Trafford.', 2200000, 'uploads/Ao_djau_san_nha_Manchester_United_mua_giai_25-26_DJo_JI7428.jpg', 2),
(24, 'Áo Thủ Môn Có Cổ', 'Chiếc áo có cổ lấy cảm hứng từ những mẫu áo thủ môn cổ điển.', 1450000, 'uploads/Ao_Thu_Mon_Co_Co_trang_KB5435.jpg', 2),
(25, 'Áo Real Madrid US Pack', 'Áo bóng chày khuy cài dành cho fan Real Madrid.\r\nHai thế giới thể thao giao thoa trong chiếc áo Real Madrid này từ adidas. Kết hợp phong cách áo bóng chày đậm chất Mỹ với thiết kế lấy cảm hứng từ bóng đá truyền thống, chiếc áo này nổi bật với sọc dọc, hàng cúc cài và huy hiệu Los Blancos. Dù bạn cổ vũ trên khán đài hay thư giãn tại nhà, chiếc áo nổi bật này vẫn mang đến phong cách thể thao cho mọi dịp.', 1800000, 'uploads/Ao_Real_Madrid_US_Pack_trang_JN3073.jpg', 2),
(26, 'Áo Đấu Sân Nhà Real Madrid Mùa Giải 2025/2026 Chính Hãng', 'Tôn vinh thánh địa huyền thoại của Real Madrid với mẫu áo đấu adidas được thiết kế tập trung vào hiệu suất thi đấu.\r\nĐược xây dựng trên nền tảng vững chắc. Chiếc áo đấu sân nhà Real Madrid chính hãng lần này đánh dấu cột mốc nâng cấp sân Bernabéu, với các chi tiết hình khối, kết cấu và màu sắc nhẹ nhàng gợi lại một chặng đường lịch sử đầy huy hoàng. Ra đời để chinh chiến tại Bernabéu mùa giải 25/26, chiếc áo này kết hợp thiết kế hiệu suất cao cho những pha bóng thần tốc cùng huy hiệu ép nhiệt – biểu tượng thiêng liêng thắp lửa cảm hứng.', 3000000, 'uploads/Ao_DJau_San_Nha_Real_Madrid_Mua_Giai_2025-2026_Chinh_Hang_trang_JV5918_DM1.jpg', 2),
(27, 'Áo Thủ Môn Có Cổ', 'Chiếc áo có cổ lấy cảm hứng từ những mẫu áo thủ môn cổ điển.', 1450000, 'uploads/Ao_Thu_Mon_Co_Co_trang_KB5435.jpg', 2),
(28, 'Áo Real Madrid US Pack', 'Áo bóng chày khuy cài dành cho fan Real Madrid.\r\nHai thế giới thể thao giao thoa trong chiếc áo Real Madrid này từ adidas. Kết hợp phong cách áo bóng chày đậm chất Mỹ với thiết kế lấy cảm hứng từ bóng đá truyền thống, chiếc áo này nổi bật với sọc dọc, hàng cúc cài và huy hiệu Los Blancos. Dù bạn cổ vũ trên khán đài hay thư giãn tại nhà, chiếc áo nổi bật này vẫn mang đến phong cách thể thao cho mọi dịp.', 1800000, 'uploads/Ao_Real_Madrid_US_Pack_trang_JN3073.jpg', 2),
(29, 'Áo Đấu Sân Nhà Real Madrid Mùa Giải 2025/2026 Chính Hãng', 'Tôn vinh thánh địa huyền thoại của Real Madrid với mẫu áo đấu adidas được thiết kế tập trung vào hiệu suất thi đấu.\r\nĐược xây dựng trên nền tảng vững chắc. Chiếc áo đấu sân nhà Real Madrid chính hãng lần này đánh dấu cột mốc nâng cấp sân Bernabéu, với các chi tiết hình khối, kết cấu và màu sắc nhẹ nhàng gợi lại một chặng đường lịch sử đầy huy hoàng. Ra đời để chinh chiến tại Bernabéu mùa giải 25/26, chiếc áo này kết hợp thiết kế hiệu suất cao cho những pha bóng thần tốc cùng huy hiệu ép nhiệt – biểu tượng thiêng liêng thắp lửa cảm hứng.', 3000000, 'uploads/Ao_DJau_San_Nha_Real_Madrid_Mua_Giai_2025-2026_Chinh_Hang_trang_JV5918_DM1.jpg', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_size`
--

CREATE TABLE `product_size` (
  `product_size_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_value` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_size`
--

INSERT INTO `product_size` (`product_size_id`, `product_id`, `size_value`) VALUES
(7, 3, '38'),
(8, 3, '39'),
(9, 3, '40'),
(21, 3, '42'),
(55, 1, '38'),
(56, 1, '39'),
(57, 1, '40'),
(58, 1, '41'),
(59, 1, '42'),
(60, 2, '38'),
(61, 2, '39'),
(62, 2, '40'),
(63, 2, '41'),
(64, 2, '42'),
(70, 4, '38'),
(71, 4, '39'),
(72, 4, '40'),
(73, 4, '41'),
(74, 4, '42'),
(75, 5, '38'),
(76, 5, '39'),
(77, 5, '40'),
(78, 5, '41'),
(79, 5, '42'),
(80, 13, '38'),
(81, 13, '39'),
(82, 13, '40'),
(83, 13, '41'),
(84, 13, '42'),
(85, 21, '38'),
(86, 21, '39'),
(87, 21, '40'),
(88, 21, '41'),
(89, 21, '42'),
(90, 15, '38'),
(91, 15, '39'),
(92, 15, '40'),
(93, 15, '41'),
(94, 15, '42'),
(100, 14, '38'),
(101, 14, '39'),
(102, 14, '40'),
(103, 14, '41'),
(104, 14, '42'),
(105, 16, '38'),
(106, 16, '39'),
(107, 16, '40'),
(108, 16, '41'),
(109, 16, '42'),
(110, 17, '38'),
(111, 17, '39'),
(112, 17, '40'),
(113, 17, '41'),
(114, 17, '42'),
(115, 20, '38'),
(116, 20, '39'),
(117, 20, '40'),
(118, 20, '41'),
(119, 20, '42'),
(136, 26, 'L'),
(137, 26, 'M'),
(138, 26, 'S'),
(139, 26, 'XL'),
(140, 28, 'L'),
(141, 28, 'M'),
(142, 28, 'S'),
(143, 28, 'XL'),
(144, 29, 'L'),
(145, 29, 'M'),
(146, 29, 'S'),
(147, 29, 'XL'),
(148, 27, 'L'),
(149, 27, 'M'),
(150, 27, 'S'),
(151, 27, 'XL'),
(152, 25, 'L'),
(153, 25, 'M'),
(154, 25, 'S'),
(155, 25, 'XL'),
(156, 24, 'L'),
(157, 24, 'M'),
(158, 24, 'S'),
(159, 24, 'XL'),
(160, 23, 'L'),
(161, 23, 'M'),
(162, 23, 'S'),
(163, 23, 'XL'),
(164, 22, 'L'),
(165, 22, 'M'),
(166, 22, 'S'),
(167, 22, 'XL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'dat', 'dat@gmail.com', '$2y$10$p/U.VoDVbwe2MgG7d99/q.HBEbGSoDbazeJucAhFdhhRSzE41eoeK', 'customer'),
(5, 'admin', 'admin@example.com', '$2y$10$xpnPKLtIj5ZE66r/x.gDO.iMI3mfSSR1zKvZHA8Lh0o/WeK.ebWUK', 'admin'),
(6, 'hieu', 'hieu@gmail.com', '$2y$10$9fBv8zTFc1BROg2t7wY/mul.jGuXwVog0lWaTAVeiSBEOKblcWaG.', 'customer'),
(7, 'a', 'a@gmail.com', '$2y$10$q.SU47tj5AVRt8Y8mq2H3eYdR.AKnwQcdET2VNs511S/3cpiJqNYW', 'customer');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_carts`
--

CREATE TABLE `user_carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_carts`
--

INSERT INTO `user_carts` (`id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
(116, 1, 26, 'S', 1, '2025-07-06 15:32:25', '2025-07-06 15:32:25');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins_log`
--
ALTER TABLE `admins_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_product_size` (`product_size_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`product_size_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `user_carts`
--
ALTER TABLE `user_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins_log`
--
ALTER TABLE `admins_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `product_size`
--
ALTER TABLE `product_size`
  MODIFY `product_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `user_carts`
--
ALTER TABLE `user_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_product_size` FOREIGN KEY (`product_size_id`) REFERENCES `product_size` (`product_size_id`),
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_carts`
--
ALTER TABLE `user_carts`
  ADD CONSTRAINT `user_carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
