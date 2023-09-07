-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2023 at 12:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projecthk2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_ads`
--

CREATE TABLE `tb_ads` (
  `ads_id` int(11) NOT NULL,
  `type_ads` varchar(50) NOT NULL,
  `image_ads` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ads`
--

INSERT INTO `tb_ads` (`ads_id`, `type_ads`, `image_ads`, `start_date`, `end_date`, `product_id`, `cate_id`) VALUES
(29, 'product', 'public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg', '2023-08-31', '2023-09-08', 50, 0),
(30, 'product', 'public/images/banners/z4458312748906_3aa64dfd22570cf823444c917822bb09_(1).jpg', '2023-09-05', '2023-09-19', 56, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cancelled`
--

CREATE TABLE `tb_cancelled` (
  `cancelled_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cancelled`
--

INSERT INTO `tb_cancelled` (`cancelled_id`, `reason`, `order_id`, `product_id`) VALUES
(1, 'Out of stock', 960985, 54),
(3, 'Out of stock', 960985, 54);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `flavor` varchar(50) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`cate_id`, `cate_name`) VALUES
(30, 'Round cake sample - VIP2'),
(37, 'Salted Egg Sponge Cake'),
(38, 'Fruit Cake'),
(39, 'Round cake sample');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cate_size`
--

CREATE TABLE `tb_cate_size` (
  `cate_size_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `increase_size` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cate_size`
--

INSERT INTO `tb_cate_size` (`cate_size_id`, `cate_id`, `size_id`, `increase_size`) VALUES
(16, 30, 1, 0),
(17, 30, 2, 50000),
(18, 30, 3, 140000),
(19, 30, 4, 260000),
(20, 30, 5, 470000),
(43, 37, 1, 0),
(44, 37, 2, 80000),
(45, 37, 3, 150000),
(46, 37, 4, 270000),
(47, 37, 5, 400000),
(48, 38, 1, 0),
(49, 38, 2, 40000),
(50, 38, 3, 80000),
(51, 38, 4, 140000),
(52, 38, 5, 200000),
(53, 39, 1, 0),
(54, 39, 2, 40000),
(55, 39, 3, 90000),
(56, 39, 4, 180000),
(57, 39, 5, 310000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_comments`
--

CREATE TABLE `tb_comments` (
  `comment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `reply_username` varchar(30) DEFAULT NULL,
  `content` varchar(1000) NOT NULL,
  `inbox_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_comments`
--

INSERT INTO `tb_comments` (`comment_id`, `product_id`, `user_id`, `parent_id`, `reply_id`, `reply_username`, `content`, `inbox_date`) VALUES
(33, 57, 32, 1, 0, NULL, 'good', '2023-09-03 20:55:56'),
(34, 56, 32, 1, 0, '', 'good', '2023-09-03 20:57:07'),
(35, 44, 32, 1, 0, '', 'good', '2023-09-03 20:59:17'),
(36, 55, 53, 1, 0, '', 'good', '2023-09-05 15:44:09'),
(37, 57, 32, 2, 33, 'Nhi_Customer', 'hello', '2023-09-05 15:48:30'),
(38, 57, 32, 1, 0, '', 'i like you  . ****', '2023-09-05 15:48:44'),
(39, 44, 53, 1, 0, '', 'hello', '2023-09-05 16:17:14'),
(40, 56, 53, 1, 0, '', 'alo 1234', '2023-09-05 16:57:18'),
(41, 56, 53, 2, 40, 'vickden12', '123asd', '2023-09-05 16:57:38'),
(42, 56, 53, 2, 34, 'Nhi_Customer', '123asd', '2023-09-05 16:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_coupon`
--

CREATE TABLE `tb_coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(30) NOT NULL,
  `discount_coupon` float NOT NULL,
  `condition_used_coupon` float NOT NULL,
  `qti_used_coupon` int(11) NOT NULL,
  `qti_coupon` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` bit(1) NOT NULL COMMENT '0=active, 1=noactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_coupon`
--

INSERT INTO `tb_coupon` (`coupon_id`, `coupon_name`, `discount_coupon`, `condition_used_coupon`, `qti_used_coupon`, `qti_coupon`, `start_date`, `end_date`, `status`) VALUES
(16, 'muadifungngai', 10000, 100000, 1, 100, '2023-08-30', '2023-09-08', b'0'),
(24, 'dsffsdf', 10000, 100000, 1, 10, '2023-09-05', '2023-09-15', b'0'),
(25, 'cake001', 10000, 100000, 2, 10, '2023-09-05', '2023-09-21', b'0'),
(26, 'cakecircle', 10000, 100000, 2, 10, '2023-09-05', '2023-09-15', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_depot_coupon`
--

CREATE TABLE `tb_depot_coupon` (
  `depot_coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `count_used` int(11) NOT NULL,
  `status_coupon` bit(1) NOT NULL COMMENT '0=Still_in_use, 1=limit_reached'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_depot_coupon`
--

INSERT INTO `tb_depot_coupon` (`depot_coupon_id`, `user_id`, `coupon_id`, `count_used`, `status_coupon`) VALUES
(3, 53, 16, 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_flavor`
--

CREATE TABLE `tb_flavor` (
  `flavor_id` int(11) NOT NULL,
  `flavor_name` varchar(30) NOT NULL,
  `qti_flavor` int(11) NOT NULL,
  `deleted_flavor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_flavor`
--

INSERT INTO `tb_flavor` (`flavor_id`, `flavor_name`, `qti_flavor`, `deleted_flavor`) VALUES
(12, 'Blueberry', 5, 0),
(13, 'Strawberry', 5, 0),
(14, 'Mango', 5, 0),
(15, 'Pineapple', 5, 0),
(16, 'Peach', 10, 0),
(17, 'Socola Black', 5, 0),
(18, 'Socola Milk', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_like_comments`
--

CREATE TABLE `tb_like_comments` (
  `like_comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `vote` bit(1) NOT NULL COMMENT '1=like, 0=unlike',
  `vote_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_like_comments`
--

INSERT INTO `tb_like_comments` (`like_comment_id`, `user_id`, `comment_id`, `vote`, `vote_date`) VALUES
(28, 32, 33, b'0', '2023-09-03 20:56:05'),
(30, 32, 35, b'1', '2023-09-03 20:59:23'),
(31, 53, 36, b'1', '2023-09-05 15:44:15'),
(32, 53, 40, b'1', '2023-09-05 16:57:24'),
(33, 53, 34, b'0', '2023-09-05 16:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_news`
--

CREATE TABLE `tb_news` (
  `new_id` int(11) NOT NULL,
  `new_cate_id` int(11) NOT NULL,
  `new_title` varchar(225) NOT NULL,
  `new_summary` text NOT NULL,
  `new_description` text NOT NULL,
  `new_image` varchar(255) NOT NULL,
  `deleted` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_news`
--

INSERT INTO `tb_news` (`new_id`, `new_cate_id`, `new_title`, `new_summary`, `new_description`, `new_image`, `deleted`) VALUES
(111, 5, 'khuong', '<p>Nếu ng&agrave;y 8/3 l&agrave; ng&agrave;y quốc tế phụ nữ th&igrave; ở Việt Nam, ch&uacute;ng ta c&ograve;n c&oacute; một ng&agrave;y ri&ecirc;ng biệt để t&ocirc;n vinh người phụ nữ Việt Nam.</p>\r\n\r\n<div class=\"ddict_btn\" style=\"left:48px; top:29px\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" /></div>\r\n\r\n<div class=\"ddict_btn\" style=\"left:752px; top:24px\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" /></div>\r\n\r\n<div class=\"ddict_btn\" style=\"left:66px; top:58px\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" /></div>\r\n', '<p>Nếu ng&agrave;y 8/3 l&agrave; ng&agrave;y quốc tế phụ nữ th&igrave; ở Việt Nam, ch&uacute;ng ta c&ograve;n c&oacute; một ng&agrave;y ri&ecirc;ng biệt để t&ocirc;n vinh người phụ nữ Việt Nam. Ng&agrave;y 20/10 hằng năm l&agrave; ng&agrave;y Phụ nữ Việt Nam, l&agrave; ng&agrave;y m&agrave; ch&uacute;ng ta d&agrave;nh tặng những b&oacute; hoa tươi thắm, những m&oacute;n qu&agrave; nhỏ đầy t&igrave;nh thương c&ugrave;ng một chiếc b&aacute;nh kem được trang tr&iacute; thật đẹp, thật &yacute; nghĩa d&agrave;nh tặng người phụ nữ m&agrave; ta y&ecirc;u qu&yacute;.</p>\r\n\r\n<p>Kh&ocirc;ng cần cầu kỳ hay ph&ocirc; trương, những m&oacute;n qu&agrave; đơn giản nhưng tinh tế sẽ khiến người phụ nữ của bạn xi&ecirc;u l&ograve;ng. Một chiếc b&aacute;nh kem thật ngon, thật đẹp, hấp dẫn rất ph&ugrave; hợp để bạn d&agrave;nh tặng cho mẹ, vợ, người y&ecirc;u... H&atilde;y c&ugrave;ng t&igrave;m hiểu những mẫu b&aacute;nh kem ph&ugrave; hợp, để c&oacute; được một m&oacute;n qu&agrave; thiết thực v&agrave; &yacute; nghĩa nhất..</p>\r\n\r\n<p><strong>Gợi &yacute; tuyệt vời cho bạn. Với c&aacute;c loại b&aacute;nh kem nhiều h&igrave;nh d&aacute;ng kh&aacute;c nhau:</strong></p>\r\n\r\n<p><strong><img src=\"https://thuhuongbakery.com.vn/source/banh%20kem%2020-10/22.jpg\" style=\"height:600px; width:400px\" />&nbsp;</strong></p>\r\n\r\n<p><strong>B&aacute;nh Kem Tươi 20/10&nbsp;</strong>(Nhẹ Nh&agrave;ng)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20kem%2020-10/6.jpg\" style=\"height:600px; width:400px\" />&nbsp;</strong></p>\r\n\r\n<p><strong>B&aacute;nh Mousse Chanh Leo 20/10</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20kem%2020-10/14.jpg\" style=\"height:600px; width:400px\" />&nbsp;</strong></p>\r\n\r\n<p><strong>B&aacute;nh kem tươi 20/10&nbsp;</strong>(Sự lựa chọn nhiều nhất)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20kem%2020-10/16.jpg\" style=\"height:600px; width:400px\" />&nbsp;</strong></p>\r\n\r\n<p><strong>B&aacute;nh kem tươi Chocolate 20/10</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20kem%2020-10/5.jpg\" style=\"height:600px; width:400px\" />&nbsp;</strong></p>\r\n\r\n<p><strong>Red velvet cake heart&nbsp;</strong>(cho t&igrave;nh y&ecirc;u đ&ocirc;i lứa)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20kem%2020-10/8.jpg\" style=\"height:500px; width:400px\" />&nbsp;</strong></p>\r\n\r\n<p><strong>B&aacute;nh Kem Tươi 20/10&nbsp;</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20kem%2020-10/30.jpg\" style=\"height:600px; width:400px\" />&nbsp;</strong></p>\r\n\r\n<p><strong>B&aacute;nh Kem Tươi 20/10</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20kem%2020-10/32.jpg\" style=\"height:500px; width:400px\" />&nbsp;</strong></p>\r\n\r\n<p><strong>B&aacute;nh Kem Tươi 20/10&nbsp;</strong>(Hoa Hướng Dương)</p>\r\n\r\n<div class=\"ddict_btn\" style=\"left:55px; top:32px\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" /></div>\r\n', 'public/new_images/Banh opera 001.jpg', b'0'),
(112, 5, 'Top popular cake designs', '<p>Kh&ocirc;ng cần cầu kỳ hay ph&ocirc; trương, những m&oacute;n qu&agrave; đơn giản nhưng tinh tế sẽ khiến người phụ nữ của bạn xi&ecirc;u l&ograve;ng.</p>\r\n', '<p>Gi&aacute;ng Sinh đang về&hellip; Merry Christmas ❤️❤️<br />\r\nGi&aacute;ng sinh l&agrave; thời gian để d&agrave;nh cho gia đ&igrave;nh, bạn b&egrave; v&agrave; những Người y&ecirc;u thương... C&ugrave;ng nhau tạo ra những khoảnh khắc m&agrave; bạn sẽ nhớ m&atilde;i kh&ocirc;ng bao giờ qu&ecirc;n. Ch&uacute;c mừng bạn v&agrave; gia đ&igrave;nh c&oacute; một m&ugrave;a Gi&aacute;ng Sinh vui vẻ</p>\r\n\r\n<p>Xin ph&eacute;p cho</p>\r\n\r\n<p>Thu Hương Bakrery đ&oacute;n Gi&aacute;ng Sinh c&ugrave;ng bạn bằng những sản phẩm ngọt ng&agrave;o của ch&uacute;ng t&ocirc;i</p>\r\n\r\n<p>C&oacute; B&aacute;nh, C&oacute; Nến, V&agrave; C&oacute; Hoa&hellip;</p>\r\n\r\n<p>There are so many gifts I want to give to you this Christmas. Peace, love, joy, happiness are all presents I am sending your way</p>\r\n\r\n<p>Li&ecirc;n hệ đặt trước để kịp c&oacute; những m&oacute;n qu&agrave; Gi&aacute;ng Sinh &Yacute; Nghĩa nhất cho người th&acirc;n bạn nh&eacute;!!!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dưới đ&acirc;y l&agrave; những mẫu B&aacute;nh Gi&aacute;ng Sinh được y&ecirc;u th&iacute;ch nhất năm 2022</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img src=\"https://thuhuongbakery.com.vn/source/banh%20noel%202022/banh%20giang%20sinh%20banh%20noel.jpg\" style=\"height:753px; width:500px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20noel%202022/2022-12-05%2011-59-43%20(B%2CRadius8%2CSmoothing4)2.jpg\" style=\"height:750px; width:500px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20noel%202022/thu%20h%C6%B0%C6%A1ng%20noel0078.jpg\" style=\"height:750px; width:500px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20noel%202022/thu%20h%C6%B0%C6%A1ng%20noel0085.jpg\" style=\"height:750px; width:500px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/banh%20noel%202022/thu%20h%C6%B0%C6%A1ng%20noel0102.jpg\" style=\"height:750px; width:500px\" /></p>\r\n', 'public/new_images/Entremet 005.jpg', b'0'),
(113, 5, 'Moon Cake Thu Huong Bakery', '<h2>Tết Trung Thu l&agrave; một trong những ng&agrave;y tết trọng đại của d&acirc;n tộc Việt Nam v&agrave; l&agrave; dịp gia đ&igrave;nh qu&acirc;y quần đo&agrave;n tụ c&ugrave;ng nhau ph&aacute; cỗ, ngắm trăng.</h2>\r\n\r\n<div class=\"ddict_btn\" style=\"left:470px; top:24px\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" /></div>\r\n', '<p>Bộ sưu tập&nbsp;<a href=\"https://thuhuongbakery.com.vn/danh-muc/banh-trung-thu\">B&aacute;nh Trung Thu 2022</a>&nbsp;của Thu Hương Bakery l&agrave; sự kết hợp giữa n&eacute;t hiện đại v&agrave; văn h&oacute;a truyền thống trong từng mẫu thiết kế. Đồng thời cũng l&agrave; sự tổng hợp h&agrave;i h&ograve;a giữa c&aacute;c yếu tố thi&ecirc;n nhi&ecirc;n v&agrave; t&iacute;n ngưỡng l&acirc;u đời của người d&acirc;n Việt Nam.</p>\r\n\r\n<p>Ch&uacute;ng ta vừa trải qua một giai đoạn rất d&agrave;i với nhiều kh&oacute; khăn, thử th&aacute;ch của dịch bệnh nhưng kh&ocirc;ng v&igrave; thế m&agrave; ch&uacute;ng ta gục ng&atilde;. Th&ocirc;ng qua bộ sưu tập Trung Thu 2022 Thu Hương Bakery muốn gửi tới kh&aacute;ch h&agrave;ng lời cầu ch&uacute;c cho sự phục hồi v&agrave; vươn l&ecirc;n mạnh mẽ giống như h&igrave;nh ảnh chuyển động của Mặt Trăng, d&ugrave; c&oacute; ng&agrave;y trăng khuyết đến đ&acirc;u th&igrave; cũng sẽ c&oacute; ng&agrave;y trăng tr&ograve;n.</p>\r\n\r\n<p>Đồng thời Thu Hương Bakery cũng muốn gửi gắm th&ocirc;ng điệp rằng: D&ugrave; x&atilde; hội ng&agrave;y c&agrave;ng ph&aacute;t triển, con người ng&agrave;y c&agrave;ng bận rộn th&igrave; cũng kh&ocirc;ng n&ecirc;n chạy theo những gi&aacute; trị vật chất m&agrave; l&atilde;ng qu&ecirc;n những gi&aacute; trị tinh thần. Trao nhau những m&oacute;n qu&agrave; Trung Thu &yacute; nghĩa l&agrave; dịp qu&yacute; gi&aacute; để gắn kết, đồng thời g&igrave;n giữ những gi&aacute; trị tươi đẹp trong bản sắc văn h&oacute;a của d&acirc;n tộc.</p>\r\n\r\n<p>Tại Thu Hương Bakery, Ch&uacute;ng t&ocirc;i vẫn lu&ocirc;n g&igrave;n giữ v&agrave; kết nối qu&aacute; khứ &ndash; hiện tại &ndash; tương lai.</p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/TinTuc/BANH%20TRUNG%20THU%201.png\" style=\"height:293px; width:600px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/TinTuc/BANH%20TRUNG%20THU%202.png\" style=\"height:293px; width:600px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/TinTuc/BANH%20TRUNG%20THU%203.png\" style=\"height:212px; width:600px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/Banh%20Trung%20Thu%202022/TV1.jpg\" style=\"height:603px; width:600px\" /></p>\r\n', 'public/new_images/Red Velvet Cake 1 (1).jpg', b'0'),
(114, 5, 'Moon cake collection', '<p>Bộ sưu tập&nbsp;của Thu Hương Bakery l&agrave; sự kết hợp giữa n&eacute;t hiện đại v&agrave; văn h&oacute;a truyền thống trong từng mẫu thiết kế</p>\r\n\r\n<div class=\"ddict_btn\" style=\"left:216px; top:38px\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" /></div>\r\n', '<p>Ch&uacute;ng ta vừa trải qua một giai đoạn rất d&agrave;i với nhiều kh&oacute; khăn, thử th&aacute;ch của dịch bệnh nhưng kh&ocirc;ng v&igrave; thế m&agrave; ch&uacute;ng ta gục ng&atilde;. Th&ocirc;ng qua bộ sưu tập Trung Thu 2022 Thu Hương Bakery muốn gửi tới kh&aacute;ch h&agrave;ng lời cầu ch&uacute;c cho sự phục hồi v&agrave; vươn l&ecirc;n mạnh mẽ giống như h&igrave;nh ảnh chuyển động của Mặt Trăng, d&ugrave; c&oacute; ng&agrave;y trăng khuyết đến đ&acirc;u th&igrave; cũng sẽ c&oacute; ng&agrave;y trăng tr&ograve;n.</p>\r\n\r\n<p>Đồng thời Thu Hương Bakery cũng muốn gửi gắm th&ocirc;ng điệp rằng: D&ugrave; x&atilde; hội ng&agrave;y c&agrave;ng ph&aacute;t triển, con người ng&agrave;y c&agrave;ng bận rộn th&igrave; cũng kh&ocirc;ng n&ecirc;n chạy theo những gi&aacute; trị vật chất m&agrave; l&atilde;ng qu&ecirc;n những gi&aacute; trị tinh thần. Trao nhau những m&oacute;n qu&agrave; Trung Thu &yacute; nghĩa l&agrave; dịp qu&yacute; gi&aacute; để gắn kết, đồng thời g&igrave;n giữ những gi&aacute; trị tươi đẹp trong bản sắc văn h&oacute;a của d&acirc;n tộc.</p>\r\n\r\n<p>Tại Thu Hương Bakery, Ch&uacute;ng t&ocirc;i vẫn lu&ocirc;n g&igrave;n giữ v&agrave; kết nối qu&aacute; khứ &ndash; hiện tại &ndash; tương lai.</p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/TinTuc/BANH%20TRUNG%20THU%201.png\" style=\"height:293px; width:600px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/TinTuc/BANH%20TRUNG%20THU%202.png\" style=\"height:293px; width:600px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/TinTuc/BANH%20TRUNG%20THU%203.png\" style=\"height:212px; width:600px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://thuhuongbakery.com.vn/source/Banh%20Trung%20Thu%202022/TV1.jpg\" style=\"height:603px; width:600px\" /></p>\r\n', 'public/new_images/banh-sinh-nhat-hoa-baby-viet-lich-bat-mat.jpg', b'0'),
(115, 6, 'khuong1', '<p>hi</p>\r\n', '<p>hello</p>\r\n', 'public/new_images/BDCV150.jpg', b'0'),
(116, 6, 'khuong2', '<p>rtete</p>\r\n', '<p>211</p>\r\n', 'public/new_images/BNCV150.jpg', b'0'),
(117, 6, 'khuong3', '<p>1123</p>\r\n', '<p>qeqeq</p>\r\n', 'public/new_images/Cat-Tuong-4-900x900.jpg', b'0'),
(118, 6, 'khuong4', '<p>qưeqe</p>\r\n', '<p>53453453</p>\r\n', 'public/new_images/Kim-Bao-4-1-900x900.jpg', b'0'),
(119, 6, 'khuong5', '<p>2131</p>\r\n', '<p>435345</p>\r\n', 'public/new_images/Phu-Quy-1b.jpg', b'0'),
(120, 6, 'khuong6', '<p>24124</p>\r\n', '<p>123124</p>\r\n', 'public/new_images/Thinh-Vuong-6-900x900.jpg', b'0'),
(121, 6, 'khuong7', '<p>34234</p>\r\n', '<p>124124</p>\r\n', 'public/new_images/Trong-Dong-2.jpg', b'0'),
(122, 6, 'khuong8', '<p>21412</p>\r\n', '<p>5232423</p>\r\n', 'public/new_images/Van-Long-4.jpg', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_news_cate`
--

CREATE TABLE `tb_news_cate` (
  `new_cate_id` int(11) NOT NULL,
  `new_cate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_news_cate`
--

INSERT INTO `tb_news_cate` (`new_cate_id`, `new_cate_name`) VALUES
(5, 'Moon cake collection'),
(6, 'Chrismas cake');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `receiver_name` varchar(50) NOT NULL,
  `receiver_phone` varchar(10) NOT NULL,
  `receiver_address` varchar(225) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL,
  `deposit` float NOT NULL,
  `coupon_used` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `total_pay` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `user_id`, `receiver_name`, `receiver_phone`, `receiver_address`, `receiver_email`, `order_date`, `deposit`, `coupon_used`, `status`, `total_pay`) VALUES
(315766, 53, 'Nguyễn Trường Phi', '0332880003', 'Số19-TL16-P.Thạnh Lộc-Q.12', 'ashuraitproz0003@gmail.com', '2023-09-05 11:56:44', 503100, '', 'prepare', 1677000),
(527077, 53, 'Nguyễn Trường Phi', '0332880003', 'Số19-TL16-P.Thạnh Lộc-Q.12', 'ashuraitproz0003@gmail.com', '2023-09-05 11:21:51', 826800, '', 'shipping', 2756000),
(559129, 53, 'Nguyễn Trường Phi', '0332880003', 'Số19-TL16-P.Thạnh Lộc-Q.12', 'ashuraitproz0003@gmail.com', '2023-09-05 11:56:48', 503100, '', 'prepare', 1677000),
(737223, 59, 'khiem dang', '123456789', '123asdasdasf', 'abc@gmail.com', '2023-09-03 10:56:24', 164700, '', 'cancelled', 549000),
(778016, 59, 'khiem dang', '1234567890', 'banh ko rau', 'abc@gmail.com', '2023-09-04 11:21:40', 200100, '', 'prepare', 667000),
(932096, 32, 'Nguyễn Trường Phi', '0332880003', 'Số19-TL16-P.Thạnh Lộc-Q.12', 'ashuraitproz0003@gmail.com', '2023-09-05 11:05:01', 701100, '', 'completed', 2337000),
(960985, 59, 'khiem dang', '1234567890', '123asdasdasf', 'dangkhiem155@gmail.com', '2023-09-03 10:59:07', 167700, '', 'shipping', 559000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(30) NOT NULL,
  `flavor` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sale_product` float DEFAULT NULL,
  `total_money` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`order_detail_id`, `user_id`, `order_id`, `product_id`, `size`, `flavor`, `quantity`, `sale_product`, `total_money`) VALUES
(31, 59, 809033, 57, '30', 'Blueberry', 2, 1098000, 1098000),
(32, 59, 737223, 57, '30', 'Blueberry', 1, 549000, 549000),
(33, 59, 960985, 54, '30', 'Blueberry', 1, 559000, 559000),
(34, 59, 778016, 49, '12', 'Blueberry', 1, 667000, 189000),
(35, 59, 778016, 59, '12', 'Mango', 2, 667000, 478000),
(36, 32, 932096, 51, '30', 'Blueberry', 3, 2337000, 2337000),
(37, 53, 527077, 48, '30', 'Blueberry', 4, 2756000, 2756000),
(38, 53, 315766, 54, '30', 'Strawberry', 3, 1677000, 1677000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_products`
--

CREATE TABLE `tb_products` (
  `product_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(5000) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `view` int(11) NOT NULL,
  `qty_warehouse` int(11) NOT NULL,
  `deleted` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_products`
--

INSERT INTO `tb_products` (`product_id`, `cate_id`, `product_name`, `image`, `price`, `description`, `create_date`, `update_date`, `view`, `qty_warehouse`, `deleted`) VALUES
(41, 30, 'CCVIP-2300', 'public/images/products/z4637318043779_5b8b56e506824c227b8a45c1c0bad042.jpg', 329000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 10:54:53', '2023-08-26 11:22:41', 1, 50, b'0'),
(42, 30, 'CCSGP-2023', 'public/images/products/z4637318053371_6e54133a7395a40a04b055c06b026309.jpg', 239000, '<p>Kh&aacute;ch cần tư vấn c&aacute;c mẫu b&aacute;nh , cứ nhắn tin cho em nh&eacute; . Tiệm em lu&ocirc;n lu&ocirc;n cam kết &nbsp;:<br />\r\n- Kh&aacute;ch đặt b&aacute;nh ng&agrave;y n&agrave;o , tiệm l&agrave;m v&agrave;o ng&agrave;y đ&oacute; =&gt; B&aacute;nh lu&ocirc;n tươi mới 100%&nbsp;<br />\r\n- Kh&ocirc;ng chất bảo quản v&agrave; phụ gia . Chỉ sử dụng nguy&ecirc;n liệu được mua tại c&aacute;c si&ecirc;u thị&nbsp;<br />\r\n- Tiệm l&agrave;m theo c&ocirc;ng thức đặc biệt ( &Iacute;T NGỌT) si&ecirc;u ngon v&agrave; vừa miệng d&ugrave;ng<br />\r\n- B&aacute;nh sẽ được chụp h&igrave;nh v&agrave; gởi kh&aacute;ch xem trước khi giao đến tay người nhận<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 Mỗi chiếc b&aacute;nh kh&aacute;ch đặt b&ecirc;n em , đều sẽ được tặng 1 combo ( Dao - Dĩa - Nĩa - Nến )<br />\r\n📌 TIỆM C&Oacute; NHẬN ĐẶT B&Aacute;NH NHẬN TRONG NG&Agrave;Y trước 13h mỗi ng&agrave;y , đặt trước 5-6 tiếng l&agrave; kh&aacute;ch nhận được nh&eacute; ✨</p>\r\n\r\n<p>#banhkemtuthietke #ngocnhibakery #banhkemtheoyeucau #banhkemsinhnhat #𝑵𝒈𝒐𝒄𝑵𝒉𝒊𝑩𝒂𝒌𝒆𝒓𝒚 #bentocake #banhkemtuoi #banhkemngon #banhkemhanquoc #banhkemsinhnhat #cakedecorating #bento</p>\r\n', '2023-08-26 10:58:10', '2023-08-26 10:59:54', 2, 50, b'0'),
(43, 30, 'CCSGP-447', 'public/images/products/z4637318057384_a5bf06c68c5957b97bc041764229597f.jpg', 239000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 11:16:23', '2023-08-26 11:22:30', 0, 50, b'0'),
(44, 30, 'CCGIRL-003', 'public/images/products/z4637318068623_c109d1af0fe9d1a17ae8e0aaba2100d4.jpg', 239000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 11:18:17', '2023-08-26 11:22:15', 81, 50, b'0'),
(45, 30, 'CCSGPLOVE-02', 'public/images/products/z4637318069924_20c3443351af82ebc02777c6bf798ed1.jpg', 239000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 11:22:00', NULL, 3, 50, b'0'),
(46, 30, 'CCSGPQUEEN-79', 'public/images/products/z4637318082982_6e7774a93ec77d1b07273ee9daf86116.jpg', 249000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 11:24:31', '2023-08-26 11:28:23', 0, 50, b'0'),
(47, 30, 'CCSGP-2289', 'public/images/products/z4637318088104_cc2d51c72f08f4fc305d9b1fa3b21007.jpg', 229000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 11:25:33', NULL, 14, 50, b'0'),
(48, 30, 'CCSGP-4560', 'public/images/products/z4637318091911_960d530f7912352dd2ad6bd19172fd32.jpg', 219000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 11:30:22', NULL, 5, 46, b'0'),
(49, 38, 'Fruit Cake MSM-003', 'public/images/products/z4637482714926_d51b29caa7c2db5829bc93ad247a99eb.jpg', 189000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 12:37:21', NULL, 128, 50, b'0'),
(50, 37, 'Special HNY-2023-CC', 'public/images/products/z4637328427854_c9dc7d636c56d24cf0512223f4757afe.jpg', 379000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 12:41:58', NULL, 30, 37, b'0'),
(51, 37, 'Special HNY-2023-CC01', 'public/images/products/z4637328435867_af6168feb48c97137425ca99f00aa045.jpg', 379000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 12:43:55', NULL, 40, 37, b'1'),
(52, 37, 'Special Single Flower-CC', 'public/images/products/z4637328457354_8fe23d0e1692cee17d7202ab7b8daf8f.jpg', 359000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 12:45:34', NULL, 65, 20, b'0'),
(53, 37, 'Specila Portrait-CC', 'public/images/products/z4637328480192_e4f6bbae321a56c56fe9b496f40000ac.jpg', 389000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 12:47:05', NULL, 45, 30, b'0'),
(54, 37, 'Cake Icon Happy-Strawbery', 'public/images/products/z4637483630093_5fc9f16a8b2dbb058ed64fbbc6d45150.jpg', 159000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 12:49:59', NULL, 4, 47, b'0'),
(55, 38, 'Fruit Cake MSM-229', 'public/images/products/z4637483375586_38ba0558b13b1d32a55c8e53c4a88011.jpg', 119000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 12:51:09', NULL, 4, 40, b'0'),
(56, 39, 'Round Cake Sample 2000', 'public/images/products/z4637331200717_88f815b46ff00b30a821dc02680a3fe0.jpg', 239000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 13:00:45', '2023-08-26 13:09:31', 7, 30, b'0'),
(57, 39, 'Round Cake Sample 2001', 'public/images/products/z4637331214887_5dd6f29b71f4cae918210c38ce974c9d.jpg', 239000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 13:01:59', NULL, 31, 20, b'0'),
(59, 39, 'Round Cake Sample 2003', 'public/images/products/z4637331215749_51d1c60b31a4591b063878cf6c607c6a.jpg', 239000, '<p>Customers need advice on cake samples, just message me. My shop always commits &nbsp;:<br />\r\n- On which day the customer orders the cake, the shop makes it on that day =&gt; The cake is always 100% fresh<br />\r\n- No preservatives and additives. Only use ingredients purchased at supermarkets<br />\r\n- The shop follows a special recipe (LESS SWEET) which is super delicious and delicious to use<br />\r\n- Cakes will be photographed and sent to customers to see before being delivered to the recipient<br />\r\n☎️ Hotline : 0707 364 628<br />\r\n&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;<br />\r\n🎉 For each cake you order with me, you will get 1 combo ( Knife - Fork - Fork - Candle )<br />\r\n📌THE STORE HAS TO RECEIVE BOOKING RECEIVED IN THE DAY before 13:00 every day, order 5-6 hours in advance and customers will receive it. ✨</p>\r\n', '2023-08-26 13:07:00', '2023-09-05 15:53:31', 37, 18, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_return`
--

CREATE TABLE `tb_return` (
  `return_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `customer_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_revenues`
--

CREATE TABLE `tb_revenues` (
  `revenue_id` int(11) NOT NULL,
  `income` float NOT NULL,
  `date_pay` date NOT NULL,
  `expense` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_revenues`
--

INSERT INTO `tb_revenues` (`revenue_id`, `income`, `date_pay`, `expense`) VALUES
(1, 1200000, '2023-08-02', 800000),
(2, 3000000, '2023-08-02', 2000000),
(3, 400000, '2023-07-05', 350000),
(4, 500000, '2023-07-19', 400000),
(5, 900000, '2023-06-15', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reviews`
--

CREATE TABLE `tb_reviews` (
  `danhgia_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale`
--

CREATE TABLE `tb_sale` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `percent_sale` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sale`
--

INSERT INTO `tb_sale` (`sale_id`, `product_id`, `percent_sale`, `start_date`, `end_date`) VALUES
(8, 49, 20, '2023-08-26', '2023-08-30'),
(9, 52, 30, '2023-09-15', '2023-09-20'),
(20, 60, 10, '2023-09-05', '2023-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_shop_history`
--

CREATE TABLE `tb_shop_history` (
  `shop_history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_shop_history`
--

INSERT INTO `tb_shop_history` (`shop_history_id`, `user_id`, `action`, `action_time`) VALUES
(1, 37, 'has added a new voucher muadidungngai', '2023-08-30 04:00:46'),
(2, 37, 'has added a new voucher dfsdfs', '2023-08-30 04:30:41'),
(3, 37, 'has added a new voucher muadidungngai', '2023-08-30 04:35:28'),
(4, 37, 'has deleted a voucher muadidungngai', '2023-08-30 04:35:31'),
(5, 37, 'has added a new voucher muadifungngai', '2023-08-30 11:10:54'),
(6, 37, 'has applied a discount to productCCGIRL-003', '2023-08-30 14:58:29'),
(7, 37, 'has updated the status for size 12 to display', '2023-08-30 16:02:21'),
(8, 37, 'has temporarily suspended the operation of flavor Socola Black', '2023-08-30 16:03:21'),
(9, 37, 'has updated the status for flavor Socola Black to display', '2023-08-30 16:03:30'),
(10, 37, 'has temporarily suspended the operation of product Round Cake Sample 2002', '2023-08-31 02:03:08'),
(11, 37, 'has temporarily suspended the operation of flavor Blueberry', '2023-08-31 02:10:15'),
(12, 37, 'has temporarily suspended the operation of size 12', '2023-08-31 02:10:16'),
(13, 37, 'has updated the status for flavor Blueberry to display', '2023-08-31 02:10:29'),
(14, 37, 'has updated the status for size 12 to display', '2023-08-31 02:10:32'),
(15, 37, 'has added advertisements to category Salted Egg Sponge Cake', '2023-08-31 03:05:03'),
(16, 37, 'has deleted a advertisements category', '2023-08-31 03:08:23'),
(17, 37, 'has added advertisements to product Special HNY-2023-CC', '2023-08-31 03:10:36'),
(18, 37, 'has deleted a advertisements product', '2023-08-31 03:14:51'),
(19, 37, 'has added advertisements to category Salted Egg Sponge Cake', '2023-08-31 03:15:03'),
(20, 37, 'has added advertisements to product Special HNY-2023-CC', '2023-08-31 03:24:47'),
(21, 37, 'has updated the quantity to  for product', '2023-08-31 13:56:13'),
(22, 37, 'has temporarily suspended the operation of product Round Cake Sample 2003', '2023-08-31 13:57:39'),
(23, 37, 'has updated the status for product Round Cake Sample 2003 to display', '2023-08-31 13:57:41'),
(24, 37, 'has temporarily suspended the operation of product Round Cake Sample 2003', '2023-09-05 13:27:40'),
(25, 37, 'has updated product Round Cake Sample 2003 to working status', '2023-09-05 13:27:44'),
(26, 37, 'has temporarily suspended the operation of product Round Cake Sample 2003', '2023-09-05 13:28:42'),
(27, 37, 'has updated product Round Cake Sample 2003 to working status', '2023-09-05 13:29:47'),
(28, 37, 'has temporarily suspended the operation of product Round Cake Sample 2003', '2023-09-05 13:29:56'),
(29, 37, 'has updated product Round Cake Sample 2003 to working status', '2023-09-05 13:29:59'),
(30, 37, 'has deleted a product Round Cake Sample 2002', '2023-09-05 13:34:27'),
(31, 37, 'has deleted a voucher fdgd4531vfd', '2023-09-05 14:03:46'),
(32, 37, 'has deleted a voucher ', '2023-09-05 14:03:47'),
(33, 37, 'has deleted a voucher fgdf34243', '2023-09-05 14:04:02'),
(34, 37, 'has deleted a voucher ', '2023-09-05 14:04:04'),
(35, 37, 'has deleted a voucher oiuiu564654', '2023-09-05 14:04:16'),
(36, 37, 'has deleted a voucher ', '2023-09-05 14:04:21'),
(37, 37, 'has temporarily suspended the operation of voucher code dsgdvcvbcvbc', '2023-09-05 14:05:56'),
(38, 37, 'has temporarily suspended the operation of voucher code dsgdvcvbcvbc', '2023-09-05 14:06:25'),
(39, 37, 'has deleted a voucher dsgdvcvbcvbc', '2023-09-05 14:10:56'),
(40, 37, 'has deleted a voucher sfduiyuiyu', '2023-09-05 14:11:02'),
(41, 37, 'has deleted a voucher sdfsdfvbc', '2023-09-05 14:11:50'),
(42, 37, 'has deleted a voucher mdfdsdfsd', '2023-09-05 14:13:17'),
(43, 37, 'has added a new voucher dsffsdf', '2023-09-05 14:13:59'),
(44, 37, 'has temporarily suspended the operation of voucher code muadifungngai', '2023-09-05 14:14:07'),
(45, 37, 'has temporarily suspended the operation of voucher code muadifungngai', '2023-09-05 14:16:14'),
(46, 37, 'has temporarily suspended the operation of voucher code dsffsdf', '2023-09-05 15:27:24'),
(47, 37, 'has updated coupon dsffsdf to working status', '2023-09-05 15:27:29'),
(48, 37, 'has updated coupon muadifungngai to working status', '2023-09-05 15:27:32'),
(49, 37, 'has updated to product Round Cake Sample 2003', '2023-09-05 15:53:31'),
(50, 37, 'has temporarily suspended the operation of product Round Cake Sample 2003', '2023-09-05 15:53:40'),
(51, 37, 'has updated product Round Cake Sample 2003 to working status', '2023-09-05 15:53:43'),
(52, 37, 'has temporarily suspended the operation of product Round Cake Sample 2003', '2023-09-05 15:53:56'),
(53, 37, 'has updated product Round Cake Sample 2003 to working status', '2023-09-05 15:54:07'),
(54, 37, 'has temporarily suspended the operation of product Round Cake Sample 2003', '2023-09-05 15:54:16'),
(55, 37, 'has updated product Round Cake Sample 2003 to working status', '2023-09-05 15:54:19'),
(56, 37, 'has added a new product category cake circle', '2023-09-05 15:54:52'),
(57, 37, 'has updated to product category cake circle', '2023-09-05 15:55:05'),
(58, 37, 'has deleted a category cake circle', '2023-09-05 15:55:08'),
(59, 37, 'has added a new flavor milk', '2023-09-05 15:55:31'),
(60, 37, 'has temporarily suspended the operation of flavor milk', '2023-09-05 15:55:36'),
(61, 37, 'has updated the status for flavor milk to display', '2023-09-05 15:55:40'),
(62, 37, 'has deleted a flavor milk', '2023-09-05 15:55:46'),
(63, 37, 'has added a new size 35', '2023-09-05 15:55:58'),
(64, 37, 'has temporarily suspended the operation of size 35', '2023-09-05 15:56:05'),
(65, 37, 'has updated the status for size 35 to display', '2023-09-05 15:56:11'),
(66, 37, 'has deleted a size 35', '2023-09-05 15:56:13'),
(67, 37, 'has added a new product Cake Happy', '2023-09-05 15:57:17'),
(68, 37, 'has added a new voucher cake001', '2023-09-05 15:58:27'),
(69, 37, 'has temporarily suspended the operation of voucher code cake001', '2023-09-05 15:58:32'),
(70, 37, 'has updated coupon cake001 to working status', '2023-09-05 15:58:36'),
(71, 37, 'has temporarily suspended the operation of voucher code muadifungngai', '2023-09-05 15:58:48'),
(72, 37, 'has applied a discount to productCake Happy', '2023-09-05 15:59:27'),
(73, 37, 'has deleted sale to product Cake Happy', '2023-09-05 15:59:41'),
(74, 37, 'has applied a discount to productCake Happy', '2023-09-05 15:59:58'),
(75, 37, 'has added a new voucher cakecircle', '2023-09-05 16:00:56'),
(76, 37, 'has added advertisements to product Round Cake Sample 2000', '2023-09-05 16:02:10'),
(77, 37, 'has deleted a advertisements category', '2023-09-05 16:02:42'),
(78, 37, 'has temporarily suspended the operation of product Special HNY-2023-CC01', '2023-09-05 16:18:40'),
(79, 37, 'has temporarily suspended the operation of product Cake Happy', '2023-09-05 16:18:45'),
(80, 37, 'has updated product Cake Happy to working status', '2023-09-05 16:18:47'),
(81, 37, 'has deleted a product Cake Happy', '2023-09-05 16:18:50'),
(82, 37, 'has temporarily suspended the operation of product Round Cake Sample 2003', '2023-09-05 16:18:55'),
(83, 37, 'has added a new flavor milk', '2023-09-05 16:19:35'),
(84, 37, 'has temporarily suspended the operation of flavor milk', '2023-09-05 16:19:39'),
(85, 37, 'has updated the status for flavor milk to display', '2023-09-05 16:19:41'),
(86, 37, 'has deleted a flavor milk', '2023-09-05 16:19:47'),
(87, 37, 'has updated coupon muadifungngai to working status', '2023-09-05 16:20:15'),
(88, 37, 'has temporarily suspended the operation of voucher code cakecircle', '2023-09-05 16:20:18'),
(89, 37, 'has updated to voucher cakecircle', '2023-09-05 16:20:24'),
(90, 37, 'has deleted sale to product CCGIRL-003', '2023-09-05 16:20:39'),
(91, 37, 'has added advertisements to product CCSGPLOVE-02', '2023-09-05 16:20:58'),
(92, 37, 'has updated advertisements to product CCSGPLOVE-02', '2023-09-05 16:21:09'),
(93, 37, 'has deleted a advertisements product', '2023-09-05 16:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_size`
--

CREATE TABLE `tb_size` (
  `size_id` int(11) NOT NULL,
  `size_name` int(11) NOT NULL,
  `qti_boxes_size` int(11) NOT NULL,
  `deleted_size` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_size`
--

INSERT INTO `tb_size` (`size_id`, `size_name`, `qti_boxes_size`, `deleted_size`) VALUES
(1, 12, 50, b'0'),
(2, 16, 50, b'0'),
(3, 20, 50, b'0'),
(4, 25, 50, b'0'),
(5, 30, 50, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_thumbnail`
--

CREATE TABLE `tb_thumbnail` (
  `thumbnail_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_thumbnail`
--

INSERT INTO `tb_thumbnail` (`thumbnail_id`, `product_id`, `thumbnail`) VALUES
(64, 46, 'public/images/products/z4637318088273_351d0e5ef567e9903dea1da24b489cf0.jpg'),
(65, 49, 'public/images/products/z4637482728082_4fbc2b1d4ae2a50514d64c02e97c7ebc.jpg'),
(66, 49, 'public/images/products/z4637482741639_3e04fba4d7b40e7374b798f6c86855c3.jpg'),
(67, 49, 'public/images/products/z4637482744657_7a5fbea60cc9651cd9fd564a11dab7b3.jpg'),
(68, 49, 'public/images/products/z4637483048560_f50d85d03869cfb614fc7d4c892caaf6.jpg'),
(69, 50, 'public/images/products/z4637328433464_21044552402600a8d20a1c6ce23b074c.jpg'),
(70, 50, 'public/images/products/z4637328457121_30eb5f7eb3ca57347106f4a3a27de2fe.jpg'),
(71, 51, 'public/images/products/z4637328445320_44b12d32ff5b28085e3cd2dbff1adba4.jpg'),
(72, 51, 'public/images/products/z4637328467428_2511412d1436f06c7b6617f1cae8e7eb.jpg'),
(73, 54, 'public/images/products/z4637483634518_98e539b8b8f19da7bbe630bc53f9bd96.jpg'),
(74, 54, 'public/images/products/z4637483643988_1a79a17691ae6d0558553a7bc901d43c.jpg'),
(75, 55, 'public/images/products/z4637483385928_31a8680f79a3227994825dda123631c7.jpg'),
(76, 55, 'public/images/products/z4637483386160_247dd4f61b89a2b3d3b1dcd6f8391a14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `salary` float DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0=inactive\r\n,1=active',
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 1 COMMENT '1=user,2=admin,3=owner',
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `stt_delete` int(11) NOT NULL DEFAULT 0 COMMENT '0=normal\r\n1=deleted',
  `recent_day_login` datetime DEFAULT NULL,
  `sex` varchar(200) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `token_login` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `email`, `phone`, `salary`, `token`, `status`, `password`, `role`, `create_date`, `stt_delete`, `recent_day_login`, `sex`, `address`, `birthday`, `token_login`) VALUES
(32, 'Nhi_Customer', 'thiennhi12421@gmail.com', '0707364628', NULL, '69a5835ad1d4f117d03bf01db5df6726', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-08-16 15:24:56', 0, '2023-09-05 15:51:10', 'Female', 'nha cua nhi xinh dep', '1982-06-24', '46bd74eebd43535df9978f33b85c60db'),
(34, 'Admin001', 'nhilnts2210037@fpt.edu.vn', '0707364628', 2000, 'ffe224f68db925b09387c14c69d2734f', 1, '25d55ad283aa400af464c76d713c07ad', 2, '2023-08-18 12:41:39', 0, '2023-09-02 22:01:49', NULL, NULL, NULL, '4e275dc13fac2408df22d8963552e7b6'),
(35, 'Nhi_Owner', 'ngocnhiloi2510@gmail.com', '0707364628', NULL, '013e5f8ebf44b4b76633eadde697277f', 1, 'e10adc3949ba59abbe56e057f20f883e', 3, '2023-08-18 13:00:26', 0, '2023-09-03 13:02:26', 'undefined', '', '2003-08-14', '80b207a45cc7db1ca232098c4777e206'),
(37, 'philogic', 'ashuraitproz0003@gmail.com', '0909009009', NULL, '890e77e72611a09a01a6c0db24c2d5d9', 1, 'e10adc3949ba59abbe56e057f20f883e', 3, '2023-08-19 14:13:37', 0, '2023-09-05 16:57:56', NULL, NULL, NULL, 'd83d83104581b460f7c42e9ba97d3ae2'),
(50, 'PhiNguyen23', 'phinguyen23@gmail.com', '0982347643', NULL, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-08-30 16:29:23', 0, NULL, NULL, NULL, NULL, NULL),
(51, 'TruongDo123', 'truongdo123@gmail.com', '0987265563', NULL, NULL, 0, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-08-30 16:29:23', 0, '2023-08-30 16:30:18', 'Male', '', '2001-06-25', 'b6c69f192f5b9346cc0d0a7bdf7d9595'),
(52, 'thienvo2311', 'thienvo2311@gmail.com', '0903975481', NULL, NULL, 0, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-08-30 21:25:51', 0, NULL, NULL, NULL, NULL, NULL),
(53, 'vickden12', 'vickvo@gmail.com', '0987265233', NULL, NULL, 1, '25d55ad283aa400af464c76d713c07ad', 1, '2023-08-30 21:25:51', 0, '2023-09-05 16:55:01', 'Male', 'nha cua vick', '2000-06-08', '503eec00c43b0e8241ef08826b8dc676'),
(54, 'Admin002', 'nhiloi2510@gmail.com', '0234734824', 2500, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e', 2, '2023-08-30 21:37:31', 0, NULL, NULL, NULL, NULL, NULL),
(55, 'Admin003', 'ngoctam1703@gmail.com', '0903344557', 2200, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e', 2, '2023-08-30 21:40:49', 0, NULL, NULL, NULL, NULL, NULL),
(56, 'Admin004', 'nudo2406@gmail.com', '0707543527', 3200, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e', 2, '2023-08-30 21:42:13', 0, NULL, NULL, NULL, NULL, NULL),
(57, 'Admin005', 'taihuu170395@gmail.com', '0903975481', 2900, NULL, 0, 'e10adc3949ba59abbe56e057f20f883e', 2, '2023-08-30 21:43:10', 0, NULL, NULL, NULL, NULL, NULL),
(58, 'Phinguyen23', 'phinguyen123@gmail.com', '0907733229', 2500, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e', 2, '2023-08-30 21:45:41', 0, NULL, NULL, NULL, NULL, NULL),
(59, 'DoTruong', 'dotruong123@gmail.com', '0707364628', 2500, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e', 2, '2023-08-30 21:46:39', 0, NULL, NULL, NULL, NULL, NULL),
(60, 'PhiParadox', 'PhiParadox123@gmail.com', '0982347643', NULL, NULL, 0, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-09-02 18:19:18', 0, NULL, NULL, NULL, NULL, NULL),
(61, 'CoHaiBeo', 'cohaibeo21@gmail.com', '0987265233', NULL, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-09-02 18:19:18', 0, NULL, NULL, NULL, NULL, NULL),
(62, 'MoHai123', 'mohai123@gmail.com', '0982347643', NULL, NULL, 1, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-09-02 18:19:28', 0, NULL, NULL, NULL, NULL, NULL),
(63, 'TeamLanKhue', 'lankhueteam@gmail.com', '0987265233', NULL, NULL, 0, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-09-02 18:19:28', 0, '2023-09-03 13:32:34', NULL, NULL, NULL, '6ea3c8c0e58dc5b49545dcc69139e574'),
(64, 'nhi123456', 'nguyentruongphi15032003@gmail.com', '0903975481', NULL, '548244e8ab3ecf0a77302a3d3ea859ff', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, '2023-09-05 15:46:41', 0, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_ads`
--
ALTER TABLE `tb_ads`
  ADD PRIMARY KEY (`ads_id`);

--
-- Indexes for table `tb_cancelled`
--
ALTER TABLE `tb_cancelled`
  ADD PRIMARY KEY (`cancelled_id`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `tb_cate_size`
--
ALTER TABLE `tb_cate_size`
  ADD PRIMARY KEY (`cate_size_id`);

--
-- Indexes for table `tb_comments`
--
ALTER TABLE `tb_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tb_coupon`
--
ALTER TABLE `tb_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `tb_depot_coupon`
--
ALTER TABLE `tb_depot_coupon`
  ADD PRIMARY KEY (`depot_coupon_id`);

--
-- Indexes for table `tb_flavor`
--
ALTER TABLE `tb_flavor`
  ADD PRIMARY KEY (`flavor_id`);

--
-- Indexes for table `tb_like_comments`
--
ALTER TABLE `tb_like_comments`
  ADD PRIMARY KEY (`like_comment_id`);

--
-- Indexes for table `tb_news`
--
ALTER TABLE `tb_news`
  ADD PRIMARY KEY (`new_id`);

--
-- Indexes for table `tb_news_cate`
--
ALTER TABLE `tb_news_cate`
  ADD PRIMARY KEY (`new_cate_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tb_return`
--
ALTER TABLE `tb_return`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `tb_revenues`
--
ALTER TABLE `tb_revenues`
  ADD PRIMARY KEY (`revenue_id`);

--
-- Indexes for table `tb_reviews`
--
ALTER TABLE `tb_reviews`
  ADD PRIMARY KEY (`danhgia_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_sale`
--
ALTER TABLE `tb_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `tb_shop_history`
--
ALTER TABLE `tb_shop_history`
  ADD PRIMARY KEY (`shop_history_id`);

--
-- Indexes for table `tb_size`
--
ALTER TABLE `tb_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `tb_thumbnail`
--
ALTER TABLE `tb_thumbnail`
  ADD PRIMARY KEY (`thumbnail_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_ads`
--
ALTER TABLE `tb_ads`
  MODIFY `ads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_cancelled`
--
ALTER TABLE `tb_cancelled`
  MODIFY `cancelled_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_cate_size`
--
ALTER TABLE `tb_cate_size`
  MODIFY `cate_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tb_comments`
--
ALTER TABLE `tb_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_coupon`
--
ALTER TABLE `tb_coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_depot_coupon`
--
ALTER TABLE `tb_depot_coupon`
  MODIFY `depot_coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_flavor`
--
ALTER TABLE `tb_flavor`
  MODIFY `flavor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_like_comments`
--
ALTER TABLE `tb_like_comments`
  MODIFY `like_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_news`
--
ALTER TABLE `tb_news`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tb_news_cate`
--
ALTER TABLE `tb_news_cate`
  MODIFY `new_cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tb_products`
--
ALTER TABLE `tb_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tb_return`
--
ALTER TABLE `tb_return`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_revenues`
--
ALTER TABLE `tb_revenues`
  MODIFY `revenue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_reviews`
--
ALTER TABLE `tb_reviews`
  MODIFY `danhgia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_sale`
--
ALTER TABLE `tb_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_shop_history`
--
ALTER TABLE `tb_shop_history`
  MODIFY `shop_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tb_size`
--
ALTER TABLE `tb_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_thumbnail`
--
ALTER TABLE `tb_thumbnail`
  MODIFY `thumbnail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_reviews`
--
ALTER TABLE `tb_reviews`
  ADD CONSTRAINT `tb_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tb_products` (`product_id`),
  ADD CONSTRAINT `tb_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
