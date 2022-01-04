-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2021 at 04:35 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(200) NOT NULL,
  `product_category_id` varchar(200) NOT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `product_retail_price` varchar(200) DEFAULT NULL,
  `product_wholesale_price` varchar(200) DEFAULT NULL,
  `product_quantity` varchar(200) DEFAULT NULL,
  `product_access_level` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_category_id`, `product_name`, `product_retail_price`, `product_wholesale_price`, `product_quantity`, `product_access_level`) VALUES
('00ea0f31f3eed6b55bdf91395dcc0521fd3659a3', '7106-3747', 'Mke Mwema 1  Kiongozi  Bks', '8', '0', '8', 'store_1'),
('02780e196206f5b6eb5471eea8460a1828c3be25', '3692-9470', 'Bright And Keen Badge', '80', '0', '80', 'store_1'),
('049b604744bdd49f0550970493ffe0b1bba560f8', '7106-3747', 'Hatua Kwa Hatua Kiongozi Bks', '100', '0', '30', 'store_1'),
('062ce49cca2232e22eaffb58755a1d21e5655551', '7106-3747', 'Mpango Wa Mungu Kwa Njamii Bks', '80', '0', '10', 'store_1'),
('07065ba19017d117e64925ccbe329c258da0291b', '5398-7534', 'Crowns', '80', '0', '287', 'store_1'),
('0cb51520f725516f308e1cc39044785559f78762', '3064-2536', 'Mjane Mkristo Na Maisha Yake', '80', '0', '124', 'store_1'),
('1247036262952fc15ecea249cbd375fbc1d47ce4', '3692-9470', 'Ties', '200', '0', '0', 'store_1'),
('14396fb00d0d227e3f98f82f179a17c5d7fd8fe8', '7106-3747', 'Maisha Ya Petro  Certificates', '40', '0', '207', 'store_1'),
('1479429027af0937dd5d9c6b87aa793f3bff3bd2', '7834-5943', 'Star Badges', '60', '0', '375', 'store_1'),
('158f5369e75c58d4d00229e4e31ee9576e42b757', '3064-2536', 'Mjane Mkristo Na Maisha Yake (Kig)', '0', '0', '36', 'store_1'),
('160923b291d74441e2fd7f2b0f493cb398b0d3f4', '5398-7534', 'Membership Cards', '20', '0', '147', 'store_1'),
('16c9ed77e1a2d0aee860a869d7de0339ee8e0d20', '7834-5943', 'Nyota Ya Kandeti ', '80', '0', '107', 'store_1'),
('18b9b71d00d2c0b4fc26bcc042b11d1f287d8e5b', '7106-3747', 'Tabia Njema Certificate', '40', '0', '92', 'store_1'),
('1a360ab9806ae3c5d4e9c668936d5458da40f033', '7106-3747', 'Mama Yao Cert', '0', '0', '55', 'store_1'),
('1d72539222a7d6152d6638030acc9a686f636017', '7106-3747', 'Badges', '80', '0', '70', 'store_1'),
('1e77493554632b947e0a89c64e5369f3437899de', '5437-8223', 'Community Bible Study (James)', '120', '0', '15', 'store_1'),
('21ef37a0952c0cc058ca32edb5f1acbf99a332ff', '0571-7102', 'The Church Certificates', '40', '0', '160', 'store_1'),
('26b850fca94aedd067a427c933d216185ce7af64', '7106-3747', 'Mke Mwema 1 Bks', '80', '0', '259', 'store_1'),
('289583841f7e6da059665bb1910b2ff4cd21dea8', '5437-8223', 'Kilasi', '70', '0', '26', 'store_1'),
('29d78a4b4e88b8ce4ad6f0306f2c1357c063e4fe', '5043-4287', 'Examining My Life', '80', '0', '320', 'store_1'),
('2a6e95fc09b8fc1e601e60acdc5c2239fd291f96', '5043-4287', 'Examining My Life Certificate', '40', '0', '61', 'store_1'),
('2f945bfdb18eeb559a39989d310df2208ef6950e', '7106-3747', 'Mke Mwema 2 Certificate', '40', '0', '85', 'store_1'),
('30f7f0558b1be8d2c9797678aca21f4e1f4f4a0a', '3064-2536', 'Headscalves', '200', '0', '60', 'store_1'),
('31915f8ed0054b05a603aae40b7e5124be0e47bf', '3692-9470', 'Battalion Boys books', '80', '0', '55', 'store_1'),
('34e2780f6d5b3d33b472cf0d84fcd0d17a764553', '6538-7633', 'Ndeto Na Meko Ma Yesu', '200', '0', '53', 'store_1'),
('36250196f65cfeecbfe9d05398a23d20b259ba62', '4528-2385', 'Headscalves', '200', '0', '0', 'store_1'),
('36c5362f308bd43477872ae39449e4bcaf2c63d7', '3064-2536', 'Badges', '80', '0', '1', 'store_1'),
('3c13360a3d086b6d7041f47910ec068f0729ad08', '5437-8223', 'Mbathi Sya Kumutaia  Ngai', '400', '0', '113', 'store_1'),
('3df98152e6eb1a31bc032918588b51a3b4622fc8', '6538-7633', 'Mauvoo Ma Mwambiliilyo', '200', '0', '337', 'store_1'),
('3e5d3a109e73c650fe573f78f3d0d2f7099901b8', '0571-7102', 'Christian Life Management Cert', '40', '0', '46', 'store_1'),
('3e6d3ef8954e291e311ecaa1af272c95d10f60fe', '6538-7633', 'Mauvoo Ma Mose', '200', '0', '66', 'store_1'),
('3f3d3fb45c0b640bc14b4655cf1c87f014c89c2f', '5043-4287', 'My Freedom Book', '80', '0', '62', 'store_1'),
('418820375f1659df6cb289b814d8106dabb965a6', '5043-4287', 'Bearing Fruit Bks', '80', '0', '240', 'store_1'),
('42514c2f2113c4d413f121bbdb634dfaa13cacfe', '5398-7534', 'Meeting Plan', '80', '0', '17', 'store_1'),
('431c120a5afdd1d2e644ec88fd16057011ddd060', '3064-2536', 'Wanjane Katika Bibilia', '80', '0', '422', 'store_1'),
('525f929d8dac71420b017f101919bdeaa9d85619', '6538-7633', 'Maundu Ma Usengya Weuni', '0', '0', '16', 'store_1'),
('5347-0889', '1407-0121', 'Ties', '250', '0', '80', 'store_1'),
('58bbd3963bc3cf32fbd5ce34db759104e22fabb5', '7106-3747', 'Headscalves', '200', '0', '90', 'store_1'),
('59bf3cd373a58609fc11f4939ae76989e438d16c', '0571-7102', 'The Leader And Leadership Books', '80', '0', '106', 'store_1'),
('5b2400df495bb7cc011932596879e18741427a3a', '7106-3747', 'Maisha Ya Petro Bks', '80', '0', '58', 'store_1'),
('5cdefe10e8f1ca11fd51c47cd5e6801be94069c5', '0571-7102', 'Badges ', '80', '0', '90', 'store_1'),
('5d604a6ea2b9b343c7725b14a9df8a75975e68ae', '4528-2385', 'Kumtafuta Yesu', '450', '0', '11', 'store_1'),
('5dbd21e3bd1e1a30c694d4ebb1884288565af297', '7106-3747', 'Mama Yao Kiongozi Bks', '0', '0', '5', 'store_1'),
('5f07c19374d0580d4a0092c2351e2680f222ccaf', '0571-7102', 'Leader And Leadership (KIG)', '80', '0', '8', 'store_1'),
('5f82fd588ce6194d3835240685b255e6e4e0fae7', '0571-7102', 'Kiongozi Na Uongozi Books', '80', '0', '0', 'store_1'),
('616d1697817555a381c57c286878822c666374a2', '6538-7633', 'Maovoo Ma Yosevu', '200', '0', '14', 'store_1'),
('64c29b4e6ea8a016d5fad7e7ee2fe3f6f1c07257', '0571-7102', 'The Church Books', '80', '0', '365', 'store_1'),
('67600e1feff55ac62b2bb5fce3189f1924e01b08', '5437-8223', 'Majibizano', '70', '0', '122', 'store_1'),
('67ee5acba121acd853b03287da48f1b00d7eb4b9', '7106-3747', 'Hatua Kwa Hatua Certificates', '40', '0', '0', 'store_1'),
('6ee88772b7a7d3ed63634b67b81e2e1ce27670cd', '7106-3747', 'Umezaliwa Kukua Bks', '250', '0', '34', 'store_1'),
('6f2a4069e8a6ef9a3a3fc83f73604aaaa0ea31e9', '5437-8223', 'Infant Certifificates', '40', '0', '260', 'store_1'),
('7532a15a323f52e6412eb5cdecc61fbc00915305', '6538-7633', 'Ndaviti Asumbi Na Athani', '200', '0', '55', 'store_1'),
('773ca3dfb61c61ac6978a881470cc7d3b2bd7ba5', '5437-8223', 'Holy Communion Cards', '15', '0', '200', 'store_1'),
('7864ba3ebeb4688242052855154d01ab21f192f9', '7106-3747', 'Hatua Kwa Hatua Bks', '100', '0', '148', 'store_1'),
('7b15f460d06c37ec748bb489ffc1941031ef90ee', '0571-7102', 'The Church Doctrine Certificate', '40', '0', '310', 'store_1'),
('7b2c9234f37951bcf8fd55996bd70cbca7bcb85d', '5043-4287', 'Ties', '250', '0', '45', 'store_1'),
('7cc37269eaf8c0f133437de6e7cce4dd8ac69b5a', '7106-3747', 'Wanawake Wa Bibilia Bks', '80', '0', '75', 'store_1'),
('80a4127be1ea332404ef2853e1a6229c94714787', '7106-3747', 'Mke Mwema 2 Bks', '80', '0', '122', 'store_1'),
('81fc508e300955d51e8abbe01f91d98aba7e2524', '7106-3747', 'Kitabu Cha Upishi', '200', '0', '51', 'store_1'),
('842538bf84f79934e8bb28fd148d6e8538037619', '7834-5943', 'Meeting Plan Books', '80', '0', '4', 'store_1'),
('84a99f7e2e90bc4c6ecfa8efd982103dee6f4c71', '0571-7102', 'Usimamizi Wa Kanisa', '80', '0', '2', 'store_1'),
('907a60754e26f8303855c82acce11b354a9c7850', '5398-7534', 'Kueneza Injili Badges', '60', '0', '85', 'store_1'),
('91c4c273c3beb320ac1b9ef308532a27f2f7aee1', '5398-7534', 'Usomaji Wa Bibilia Badges', '60', '0', '8', 'store_1'),
('9611e808a989dfa12a0519867b2080330bd141da', '0571-7102', 'The Leader And Leadership Cert', '40', '0', '102', 'store_1'),
('9904794171b542293c0800e5b31a772090d6c0cd', '7834-5943', 'Star Crowns', '80', '0', '255', 'store_1'),
('9a8131fbac5f00c653b5b5c85ee021e2c1043630', '5398-7534', 'Utunzaji Wa Nyumba', '80', '0', '47', 'store_1'),
('9b7066e99c9ea7776a46360f131fbb385d98bf12', '5398-7534', 'Makandeti Wa Kristo', '80', '0', '208', 'store_1'),
('a0c9b73aefb3e59deb9b696917dccf972dc9214f', '5398-7534', 'Cookery Books', '60', '0', '121', 'store_1'),
('a3bcff1c4ffa6672a2a6943bd17601f744cf5559', '7106-3747', 'Tabia Njema Bks', '80', '0', '134', 'store_1'),
('a404a8e1970583ec8c22357eee9e3d47721e5eb5', '7106-3747', 'Tabia Njema Kiongozi Bks', '90', '0', '17', 'store_1'),
('a4cb39687337a6e9ef56a33cef10aca435aeffa7', '5437-8223', 'Tithe Envelopes', '15', '0', '317', 'store_1'),
('a67ab0a1fc717f0870fd736c8494a1ebab227ce2', '7106-3747', 'Mke Mwema 2 Kiongozi Bks', '90', '0', '14', 'store_1'),
('a721cb902d342d2fb2accf80759fa8e0b26bcca2', '5398-7534', 'Utunzaji Wa Nyumba Badges', '60', '0', '55', 'store_1'),
('a833aaca6ed00d63be33d36c00f8554f5b95276a', '7106-3747', 'Mama Ya Wote Walio Hai Bks', '80', '0', '47', 'store_1'),
('ab0213d7e815b7a77eb7896a4b8a120599e94bd0', '3064-2536', 'Wanjane Katika Bibilia (KIG)', '100', '0', '10', 'store_1'),
('ab70896570139b9cbc581294209e3e2f01ab1ded', '0571-7102', 'Leader Management Teacher Books', '100', '0', '0', 'store_1'),
('ad50562ad6bb5563c450a3ad166329c7d6a2789b', '7106-3747', 'Mama Mteule Certificate', '0', '0', '118', 'store_1'),
('af93a4a3eb7aaccdc4353354a39f4c5db0cc1851', '5437-8223', 'Books Of Bible', '80', '0', '34', 'store_1'),
('afb523ba357ec7bccbd92e2bfffbbfeb7dad9f98', '3692-9470', 'Star Badges', '60', '0', '207', 'store_1'),
('b0106a32e68bb630d502dd2acb6db56d2c1505e1', '7106-3747', 'Mama Mteule Kiongozi Bks', '0', '0', '48', 'store_1'),
('b09d1906f35a11144fe6a5630581add666f21695', '5398-7534', 'Caddette Activity Book', '0', '0', '25', 'store_1'),
('baa4350893977190922ddd63ef9e1b0629507973', '5437-8223', 'AIC Rct. Books', '200', '0', '27', 'store_1'),
('bd47ea0b721e0c21f8693b3fe4916a2727523296', '4528-2385', 'Bee Certificates', '60', '0', '50', 'store_1'),
('c4e6a4b90f2a1fc26a905b8b1c6668f49a567b60', '5398-7534', 'How To Behave', '80', '0', '56', 'store_1'),
('c537af9f6720c780e656fa2da53a87e1b7264493', '3692-9470', 'Shield Badges', '40', '0', '37', 'store_1'),
('c5c69bdaf197f05d54b30c893521416f8f3e4ba3', '7106-3747', 'Wanawake Wa Bibilia Certificate', '40', '0', '0', 'store_1'),
('c65cb66b8661ab13fe9a4fc9ac39da6f42585a8f', '3692-9470', 'Hats', '0', '0', '57', 'store_1'),
('c6c576a7feda233da5ada03066faac6fa806eb38', '5437-8223', 'Baptismal Certificate Books', '250', '0', '4', 'store_1'),
('c8266efddea15d0ef58e41c81fab06f39bf61869', '5398-7534', 'Uraia Mwema Badges', '60', '0', '130', 'store_1'),
('cb49f652d1551db256918c2f805ed4ba962e302a', '7106-3747', 'Wanawake Wa Bibilia Kiongozi Bks', '100', '0', '9', 'store_1'),
('ce867acdc9aa0f5cd3944fc3741f6b8f1a75c2f2', '0571-7102', 'Cloth Badges', '200', '0', '60', 'store_1'),
('ce875dd3bcd4c35b04c5dc31b76fdfbaa433d297', '7834-5943', 'Membership Cards', '20', '0', '46', 'store_1'),
('d006148b58bd64473c6c831f915ecf937c755960', '5043-4287', 'My Freedom Cert', '40', '0', '25', 'store_1'),
('d375cedefc7141e575200280e9deaa5303726bc9', '5398-7534', 'Child Care Badges', '60', '0', '2', 'store_1'),
('d43920f5e91316356e3666f057a8e183284273ba', '5398-7534', 'Child Care', '80', '0', '10', 'store_1'),
('d507606dac33198b3a257db910ce55d90db55d20', '7106-3747', 'Mke Mwema 1 Certificate', '40', '0', '43', 'store_1'),
('d59c3d203f03066743f6767bca505648e0ce7329', '5043-4287', 'Bearing Fruit Cert', '40', '0', '69', 'store_1'),
('d637151ecc59a5a5bb39618cab15368438922d86', '5043-4287', 'Songs Of Joy', '80', '0', '84', 'store_1'),
('d774a817e48b23640dabbaa0e737aafbcc0aec9e', '7106-3747', 'Mama Mteule Bks', '80', '0', '106', 'store_1'),
('d9cd5c2c23d69f114e4a2aa3bb0523404fb15e35', '5437-8223', 'Quiet Time', '80', '0', '48', 'store_1'),
('dd9c94a5dac35c109d7d37219f821d7f2e101490', '4528-2385', 'Badges', '80', '0', '54', 'store_1'),
('de57487464eb3d8070417158e09b107ef7eaad69', '0571-7102', 'Mafundisho Ya  Kanisa Books', '80', '0', '0', 'store_1'),
('e043d3b98a12e4af1819c18c326e7935a3a5b583', '0571-7102', 'Christian Life Management', '80', '0', '55', 'store_1'),
('e1d6d6e0ce04dac066e1006f1bd0087c384f0d1a', '5398-7534', 'Uimbaji Badges', '60', '0', '106', 'store_1'),
('e3aeed0ca91f40e1299b7a59f294efbef281159d', '3064-2536', 'Mjane Mkristo Na Maisha Yake Cert', '40', '0', '230', 'store_1'),
('e52375b059932c7692e586b0711ad366b257eb50', '6538-7633', 'Registers', '60', '0', '36', 'store_1'),
('e78929d8def8e38cfced62f003775ae079a53d1d', '5398-7534', 'Sewing Badges', '60', '0', '11', 'store_1'),
('e7b042c8a3395e2a370a00be898af95591b0ca7f', '0571-7102', 'The Principles Of Counselling Cert', '40', '0', '71', 'store_1'),
('e7d8a92589baec47466a33a7f0e178a3a364a872', '5437-8223', 'C.E.D Hand Book Manual', '150', '0', '47', 'store_1'),
('e991baca9acd89e5086ab036b6bcc9aa8b087ecf', '3064-2536', 'Wanjane Katika Bibilia Cert', '40', '0', '0', 'store_1'),
('ead0ba6137f5e8b370b93665405d51e66f7e638e', '0571-7102', 'The Church Doctrine Books', '80', '0', '115', 'store_1'),
('f3d5e128074d9d0ee8bd776983be85f184446517', '4528-2385', 'Ties', '200', '0', '35', 'store_1'),
('f49d86eec4be38ee9b79496a649333518989aacc', '5398-7534', 'Natujifunze Kupika', '80', '0', '45', 'store_1'),
('f86f2c2df8ae4b6f0533849d74b37b68ef7f3070', '7834-5943', 'Nyota Ya Kandeti Kiongozi', '80', '0', '0', 'store_1'),
('fcad9e3c7fb999d6c1af212cef4d47292055df80', '6538-7633', 'Mauvoo Ma Athukumi Ma Ngai', '0', '0', '11', 'store_1'),
('fd803d63112768bda19a751d56ea279004c1bb32', '5398-7534', 'Natujifunze Kushona', '80', '0', '24', 'store_1');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `category_id` varchar(200) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_name`) VALUES
('0571-7102', 'CHF'),
('1407-0121', 'Choir Music'),
('3064-2536', 'CWP'),
('3692-9470', 'CSB'),
('4528-2385', 'BEE'),
('5043-4287', 'CYA'),
('5398-7534', 'CSC'),
('5437-8223', 'Others'),
('6538-7633', 'Sunday School'),
('7106-3747', 'CWF'),
('7834-5943', 'CSC STAR');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` varchar(200) NOT NULL,
  `sale_product_id` varchar(200) NOT NULL,
  `sale_quantity` varchar(200) DEFAULT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sale_user_id` varchar(200) DEFAULT NULL,
  `sale_customer_name` varchar(200) DEFAULT NULL,
  `sale_customer_phoneno` varchar(200) DEFAULT NULL,
  `sale_customer_address` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(200) NOT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `user_access_level` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_access_level`) VALUES
('0314047b42eb00a4dc9a660b07148c086af393cf3c', 'System Administrator', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'admin'),
('27fe387a8dc5b2228f05d8edb0318c533dca5334f1', 'Martin Mbithi', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'staff'),
('c677b7c16b7a7cb52c0cbd9e5e57bc39ce2ca1ea3d', 'User Test 2', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'staff'),
('d054b820d56a7b575be827a3728f9c43285b63f41e', 'Test User', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'store_1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `ProductCategory` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `UserSaleRecord` (`sale_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `ProductCategory` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `UserSaleRecord` FOREIGN KEY (`sale_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
