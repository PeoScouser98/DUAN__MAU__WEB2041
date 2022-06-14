-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 09, 2022 lúc 08:25 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerce`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `cate_id` int(10) NOT NULL,
  `cate_name` varchar(100) NOT NULL,
  `cate_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`cate_id`, `cate_name`, `cate_icon`) VALUES
(20, 'Game Console', '<i class=\"bi bi-controller\"></i>'),
(21, 'Laptop', '<i class=\"bi bi-laptop\"></i>'),
(22, 'Earphone', '<i class=\"bi bi-earbuds\"></i>'),
(24, 'Mobile', '<i class=\"bi bi-phone\"></i>'),
(25, 'Tablet', '<i class=\"bi bi-tablet-fill\"></i>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(100) NOT NULL,
  `content` varchar(255) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `user_id`, `product_id`, `comment_date`) VALUES
(2, 'gooooddddd!!!!!!!!', 'quanghiep031', 24, '2022-06-02 17:59:31'),
(7, 'xịn quá =)))))', 'quanghiep031', 24, '2022-06-06 11:45:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `total_amount` int(10) NOT NULL,
  `placed_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_id` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `placed_on`, `status_id`) VALUES
(6, 'quanghiep031', 2400, '2022-06-05 05:14:43', 3),
(7, 'nambui1998', 2370, '2022-06-06 14:31:11', 2),
(8, 'quanghiep031', 1210, '2022-06-07 10:40:50', 2),
(9, 'quanghiep031', 1200, '2022-06-07 07:53:35', 1),
(10, 'quanghiep031', 3610, '2022-06-09 02:46:27', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `amount`) VALUES
(4, 6, 24, 1, 1200),
(5, 6, 30, 3, 3600),
(7, 7, 30, 2, 2400),
(8, 8, 26, 1, 1200),
(9, 9, 24, 1, 1200),
(10, 10, 24, 1, 1200),
(11, 10, 26, 2, 2400);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(1) NOT NULL,
  `status_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_status`
--

INSERT INTO `order_status` (`status_id`, `status_name`) VALUES
(1, 'pending'),
(2, 'completed'),
(3, 'canceled');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `cate_id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `discount` float NOT NULL,
  `product_description` longtext NOT NULL,
  `stock` int(10) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `cate_id`, `product_name`, `price`, `product_img`, `discount`, `product_description`, `stock`) VALUES
(24, 20, 'Playstation 4', 1200, 'ps4-slim.webp', 0, 'Product name\n\nPlayStation®4\n\nProduct code\n\nCUH-2000 series\n\nMain processor\n\nSingle-chip custom processor\n\nCPU : x86-64 AMD “Jaguar”, 8 cores\n\nGPU : 1.84 TFLOPS, AMD Radeon™ based graphics engine\n\nMemory\n\nGDDR5 8GB\n\nStorage size*\n\n500GB, 1TB\n\nExternal dimensions\n\nApprox. 265×39×288 mm (width × height × length) \n(excludes largest projection)\n\nMass\n\nApprox. 2.1 kg\n\nBD/ DVD drive\n(read only)\n\nBD × 6 CAV\nDVD × 8 CAV\n\nInput/ Output\n\nSuper-Speed USB (USB 3.1 Gen1) port × 2 \nAUX port × 1\n\nNetworking\n\nEthernet（10BASE-T, 100BASE-TX, 1000BASE-T）×1\n\nIEEE 802.11 a/b/g/n/ac\n\nBluetooth®v4.0\n\nPower\n\nAC 100-240V, 50/60Hz\n\nPower consumption\n\nMax. 165W\n\nOperating Temperature\n\n5 ºC – 35ºC\n\nAV output\n\nHDMI™ out port (HDR output supported)', 98),
(26, 20, 'Xbox One S', 1200, 'xbox-series-x-console.jpg', 0, 'Unlike Sony, which has kept the PS4’s hardware under wraps, Microsoft had no qualms about showing off the Xbox One. The machine resembles a shiny black set-top box with a slot-loading Blu-ray drive, and it only works in horizontal orientation. Microsoft and AMD partnered to make the custom 40-nanometer chip with an 8-core CPU and GPU that powers the One. It has 8GB of RAM, a 500GB hard drive, USB 3.0, and 802.11n Wi-Fi.\n\nThe system isn’t just a game console, however. The One has good reason to look like a set-top box: it doubles as one. It features an HDMI pass-through so the console can sit between your cable or satellite operator’s set-top box and your TV. You can tune channels with your voice, use a TV guide directly from the Xbox, and multitask between gaming, TV, Skype, Internet Explorer, and more.', 98),
(30, 20, 'PS4 Dualshock Gray', 1200, 'ps4-controler.jpg', 0, 'Game controller', 95),
(31, 21, 'Macbook Air M1 - 2020', 2000, 'macbook_pro.jpg', 0, 'Laptop for officers', 100),
(34, 21, 'MSI Modern 14', 1000, 'msi_modern_14.png', 0, 'Laptop for officers', 100),
(35, 22, 'SteelSeries Arctis 3', 400, 'steelseries-arctis-3.webp', 10, 'Gaming Earphone from SteelSeries', 100),
(36, 22, 'Wireless Earbud Sony XM4', 450, 'WF1000XM4_Black_1-500x500.jpg', 10, 'Wireless Earbud from Sony', 100),
(37, 22, 'Wireless Earphone Sony WH1000', 380, 'SonyWH1000XM4_Black_3-500x500.jpg', 0, 'Wireless Earphone Sony from Sony', 100),
(38, 22, 'SteelSeries Arctis 5 - White', 1000, 'steelseries-arctis-5-white.png', 0, 'Gaming Earphone of SteelSeries', 100),
(39, 21, 'Macbook Pro 2021 - Silver', 2500, 'MacBookPro-2020-M1-Silver.jpg', 0, 'High-end Macbook serie of Apple', 100),
(40, 21, 'Macbook Air M1 - Pink Rose', 2000, 'The-New-Macbook-Rose-3-600x439.jpg', 0, 'Exclusive High-end M1 chipset of Apple ', 100),
(41, 21, 'Acer Nitro 5', 1300, 'acer-niitro-5.jpg', 0, 'Gaming laptop of Acer - Nitro Series', 100),
(42, 21, 'Razer Blade  - 13inch', 2200, 'razer-blade-13inch.png', 0, 'Laptop gaming of Razer with RTX3080Ti ', 100),
(43, 21, 'Asus ROG Flow - X13', 3500, 'asus-rog-flow-13.jpg', 0, 'Powerful Gaming Laptop with E-GPU ASUS ROG XG13', 100),
(44, 21, 'Asus ROG Strix G512', 2300, 'ASUS-ROG-G512-IAL013T-i5-10300H-GTX-1650Ti-06.jpg', 0, 'Powerful Gaming Laptop From Asus with corei7-11th gene & GTX1660Ti', 100),
(45, 20, 'Dualshock Camoflage Green', 400, 'tay_cam_ps4_mau_xanh_camo_grande.jpg', 0, 'Playstation 4 Dualshock Camo limited edition', 100),
(46, 20, 'PS4 Dualshock Camoflage Blue', 400, 'dc4-blue-camo-1.jpg', 0, 'Playstation 4 Dualshock camouflage limited edtion ', 100),
(47, 20, 'PS4 Dualshock Urban Camo', 400, 'avatar.jpg', 0, 'Playstation 4 Dualshock Camo Limited Edition', 100),
(48, 20, 'Playstation 4 Pro Red Spider', 1500, 'ps4-pro-spider.jpeg', 0, 'High-end Game console from Sony with limited red spider skin!', 100),
(49, 20, 'Playstation 4 Unlimited-play', 1200, 'ps4-limited-edition.jpeg', 0, 'Playstation 4 with limited skin', 100),
(50, 20, 'Xbox One X', 2000, 'xboxonex.webp', 20, 'Game console Xbox series X from Microsoft', 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` varchar(20) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `avatar` varchar(999) NOT NULL DEFAULT 'default.jpg',
  `role_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_password`, `user_name`, `email`, `address`, `phone`, `avatar`, `role_id`) VALUES
('admin', '03011998', 'Adminstrator', 'hieptqph19231@fpt.edu.vn', '60/66/Nguyễn Hoàng/Mỹ Đình/Hà Nội', '0336089988', 'avatar.jpg', 1),
('nambui1998', '123456789', 'Nam Bùi', 'buihuunam1998@gmail.com', 'Hải Phòng', '0969074970', 'default.jpg', 2),
('quanghiep031', '03011998', 'Quang Hiệp', 'cholon031@gmail.com', 'Hải Phòng', '0336089988', '10603457_112137535832540_6541284337749077936_n.jpg', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(2) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wish_list`
--

CREATE TABLE `wish_list` (
  `wish_list_id` int(10) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `wish_list`
--

INSERT INTO `wish_list` (`wish_list_id`, `user_id`) VALUES
(2, 'nambui1998'),
(1, 'quanghiep031');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wish_list_detail`
--

CREATE TABLE `wish_list_detail` (
  `list_detail_id` int(10) NOT NULL,
  `wish_list_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `wish_list_detail`
--

INSERT INTO `wish_list_detail` (`list_detail_id`, `wish_list_id`, `product_id`) VALUES
(10, 0, 30),
(11, 0, 31),
(12, 0, 24),
(13, 0, 24),
(14, 0, 24),
(15, 0, 24),
(16, 0, 24),
(17, 1, 24),
(18, 1, 50),
(19, 1, 30);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Chỉ mục cho bảng `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK1` (`role_id`);

--
-- Chỉ mục cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Chỉ mục cho bảng `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`wish_list_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `wish_list_detail`
--
ALTER TABLE `wish_list_detail`
  ADD PRIMARY KEY (`list_detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `wish_list_id` (`wish_list_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `wish_list_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `wish_list_detail`
--
ALTER TABLE `wish_list_detail`
  MODIFY `list_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`status_id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`);

--
-- Các ràng buộc cho bảng `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `wish_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `wish_list_detail`
--
ALTER TABLE `wish_list_detail`
  ADD CONSTRAINT `wish_list_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
