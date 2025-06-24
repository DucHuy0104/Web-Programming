-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th6 24, 2025 lúc 07:11 PM
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
-- Cơ sở dữ liệu: `adidas`
--

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
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `customer_name`, `phone_number`, `email`, `city`, `district`, `address`, `note`, `status`) VALUES
(1, '2024-04-05 09:31:40', 'Nguyễn Văn A', '0123456789', 'nguyenvana@example.com', 'Hà Nội', 'Ba Đình', 'Số 10, Phố ABC', 'Giao hàng trước 5h chiều', 'Chưa xác nhận'),
(2, '2024-04-05 09:31:40', 'Trần Thị B', '0987654321', 'tranthib@example.com', 'Hồ Chí Minh', 'Quận 1', 'Số 20, Đường XYZ', 'Giao hàng sau 7 ngày', 'Hoàn thành'),
(7, '2024-04-08 03:48:06', 'abc', '1234', 'abc@gmail.com', 'CT', 'Ninh Kiềua', '123', '123', 'Chờ xử lý'),
(8, '2024-04-08 12:58:25', 'fdsa', 'dfsa', '4@gmail.com', '4321', '2341', 'fdsafdsa', '4321', 'Chờ xử lý'),
(9, '2024-04-08 13:05:02', '5423', '5432', '4@gmail.com', 'rewq', 'tre', 'trq', 'rewq', 'Chờ xử lý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_value` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `size_value`, `quantity`, `unit_price`) VALUES
(1, 1, 1, 40, 2, 3000000),
(2, 1, 3, 40, 1, 300000),
(3, 2, 2, 37, 1, 2900000),
(4, 2, 5, 38, 3, 1100000),
(12, 7, 2, 38, 1, 4900000),
(13, 8, 4, 40, 1, 1800000),
(14, 9, 4, 40, 1, 1800000);

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
  `size_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_size`
--

INSERT INTO `product_size` (`product_size_id`, `product_id`, `size_value`) VALUES
(1, 1, 39),
(2, 1, 40),
(3, 1, 41),
(4, 2, 36),
(5, 2, 37),
(6, 2, 38),
(7, 3, 38),
(8, 3, 39),
(9, 3, 40),
(10, 4, 40),
(11, 4, 41),
(12, 4, 42),
(13, 5, 36),
(14, 5, 37),
(15, 5, 38),
(16, 4, 42),
(17, 13, 42),
(18, 14, 42),
(19, 5, 42),
(21, 3, 42),
(22, 15, 42),
(23, 16, 42),
(24, 1, 42),
(25, 2, 42),
(31, 17, 32),
(36, 17, 40);

--
-- Chỉ mục cho các bảng đã đổ
--

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
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `product_size`
--
ALTER TABLE `product_size`
  MODIFY `product_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
