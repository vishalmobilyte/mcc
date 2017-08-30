-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2017 at 04:06 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anganwadi`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_requests`
--

CREATE TABLE `api_requests` (
  `id` char(36) NOT NULL,
  `http_method` varchar(10) NOT NULL,
  `endpoint` varchar(2048) NOT NULL,
  `token` varchar(2048) DEFAULT NULL,
  `ip_address` varchar(50) NOT NULL,
  `request_data` longtext,
  `response_code` int(5) NOT NULL,
  `response_data` longtext,
  `exception` longtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_keys`
--

CREATE TABLE `auth_keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_keys`
--

INSERT INTO `auth_keys` (`id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 'a152e84173914146e4bc4f391sd0f686ebc4f31', 0, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(11) NOT NULL,
  `pagename` varchar(255) DEFAULT NULL,
  `pageheading` text NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `pagecontent` text NOT NULL,
  `pageurl` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `pagename`, `pageheading`, `banner_image`, `pagecontent`, `pageurl`, `link`, `company_name`, `phone_no`, `email`, `location`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created`, `modified`) VALUES
(1, 'Terms & Conditions', 'I am working with mobilyte.inc since January 2014', 'NN8Oxeo9cqCq6hI.png', '<div class="entry-header">\r\n<h1 class="entry-title">Payment Terms &amp; Conditions</h1>\r\n</div>\r\n<div class="entry-content">\r\n<p>At Sky2C, we accept a wide variety of payment modes including cash,  credit card, money order, cashier&rsquo;s check, certified check, company  check, traveler&rsquo;s check and PayPal.  To ensure prompt delivery of your  shipment, payment must be made before the shipment and deliverables are  received, until and unless prior arrangements for credit terms have been  approved.</p>\r\n<h3>Payment by Check or Money Order</h3>\r\n<p><strong>We accept payments via:</strong></p>\r\n<ul>\r\n<li>Personal Checks</li>\r\n<li>Cashier checks</li>\r\n<li>Traveler&rsquo;s checks</li>\r\n<li>Certified checks</li>\r\n<li>Company checks</li>\r\n<li>Money order</li>\r\n</ul>\r\n<p>Checks or money orders should be made payable to <strong>Sky2C Freight Systems, Inc.</strong> You may also mail or courier your payment to our corporate headquarters address.</p>\r\n<p><strong>Sky2C Freight Systems, Inc.</strong><br /> <strong>4221 Business Center Drive</strong><br /> <strong>Suite # 5 &amp; 6</strong><br /> <strong>Fremont, CA 94538</strong></p>\r\n<h3>Payment by Cash, Credit Card, or Wire Transfer</h3>\r\n<p>We also accept cash payments. You may also make a deposit directly  into our account, pay via credit card, or wire transfer the money. Bank  account information can be obtained by calling or emailing us at your  convenience. <a href="http://www.sky2c.com/contact-us.htm">Contact us</a> for more details.</p>\r\n<p>Please note that credit card payments are subject to a processing fee.  Details for this service fee are as follows:</p>\r\n<ul>\r\n<li>For transactions under $1,000: 4%</li>\r\n<li>For transactions exceeding $1,000: 3%</li>\r\n</ul>\r\n<h3>Additional Information</h3>\r\n<ul>\r\n<li>We must to receive the credit verification from the bank before any orders are processed and delivered.</li>\r\n<li>If payment does not reach us in time or the credit does not get  approved, Sky2C cannot be held responsible for any extra storage or  incidental charges.</li>\r\n<li>Exceptions in delayed payment can be made after authorization from your sales representative.</li>\r\n<li>Any bounced checks or returned payments are subject to a fee of $25.</li>\r\n<li>If you have an established credit with Sky2C, your invoices should be cleared on or before the due date specified.</li>\r\n<li>In case of late payments, an interest at the rate of 18% will be applicable.</li>\r\n</ul>\r\n<h3>Agreements</h3>\r\n<p><strong>The customer hereby agrees that:</strong></p>\r\n<ul>\r\n<li>Unless informed, failure in making the payments can result in a lien  on future shipments. This will include storage charges along with  security of subsequent shipments held pursuant to the Section 3051.5 of  the California civil code.</li>\r\n<li>The California State Law will control any claim or controversy that  may arise and the venue for any action between the two parties shall be  limited to Alameda County, California.</li>\r\n<li>Customer also consents that should any claim be served outside of  California in order to initiate arbitration in California, the claim be  limited to litigation in a California small claims court.</li>\r\n</ul>\r\n</div>', 'terms', 'Home/cms/terms', '', '0', '', '', 1, 'Live3Times - Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', '0000-00-00 00:00:00', '2017-03-28 09:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `country_codes`
--

CREATE TABLE `country_codes` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_codes`
--

INSERT INTO `country_codes` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `allowed_vars` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `email_from` varchar(250) NOT NULL,
  `email_name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `alias`, `subject`, `allowed_vars`, `description`, `email_from`, `email_name`, `status`, `modified`) VALUES
(23, 'Registration', 'registration', 'Sky2c - New Registration', '{full_name},{email},{username},{password},{phone}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Registration</strong></span></span><span style="color: #039dc4; font-size: small;"><strong> </strong></span><br /></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Hello {full_name},</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top">\r\n<p>Your account has been created over Sky2C; Following are the details. Kindly review</p>\r\n<p>Email : {email}</p>\r\n<p>Username : {username}</p>\r\n<p><span style="font-family: Arial,Helvetica,sans-serif;">Password : {password}</span></p>\r\n<p>Phone<span style="font-family: Arial,Helvetica,sans-serif;"><span style="font-family: Arial,Helvetica,sans-serif;"> : {phone}</span></span></p>\r\n<p>If you have any questions please contact us at <a href="mailto:info@sitterguide.com">info@sky2c.com</a></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody style="color: #fff;">\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Team Sky2c</p>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></span></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-04-12 06:31:52'),
(20, 'Password Reset', 'reset_password', 'Sky2c - Reset Password', '{full_name}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Reset Password</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">Hello {full_name},</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Your password has been reset successfully.</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class="system_contmail" colspan="2">If you any query please let us know straight away at:<a href="http://mce_host/cmspages/email-template-edit/sky2c@gmail.com"> sky2c@gmail.com</a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody style="color: #fff;">\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Team Sky2c</p>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></span></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-02-15 09:14:19'),
(21, 'Forgot Password', 'forgot_password_api', 'Sky2c - Forgot Password', '{user},{verification_code}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Forgot Password</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Hello {user},</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top">You have requested for reset your password, Kindly review the below details</td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Your verification code is:<br /> {verification_code}</p>\r\n<br />Note: This code will be expired with in 15 minutes</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody style="color: #fff;">\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Team Sky2c</p>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></span></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-02-17 11:58:11'),
(22, 'Change Password', 'change_password_api', 'Sky2c - Change Password', '{name},{password}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Change Password</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\n</tr>\n<tr>\n<td valign="top">Hi {name},</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">\n<p>You have changed your password successfully. Your new password is {password}.</p>\n<p>If you have any questions please contact us at <a href="http://mce_host/cmspages/email-template-edit/info@sky2c.com">sky2c@gmail.com</a></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">&nbsp;</td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\n<tbody style="color: #fff;">\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Team Sky2c</p>\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></span></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n</tbody>\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-02-15 09:11:52'),
(4, 'Change Password', 'change_password', 'Sky2c - Change Password', '{name},{password}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Change Password</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\n</tr>\n<tr>\n<td valign="top">Hi {name},</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">\n<p>You have changed your password successfully. You new password is {password}.</p>\n<p>If you have any questions please contact us at <a href="http://mce_host/cmspages/email-template-edit/info@sky2c.com">info@sky2c.com</a></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">&nbsp;</td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\n<tbody style="color: #fff;">\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Team Sky2c</p>\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></span></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n</tbody>\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-02-15 09:13:09'),
(24, 'Change Password', 'change_password_by_admin', 'Sky2c - Change Password', '{name},{password}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Change Password</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\n</tr>\n<tr>\n<td valign="top">Hi {name},</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">\n<p>Your password has been changed by admin. Your new password is {password}.</p>\n<p>If you have any questions please contact us at <a href="http://mce_host/cmspages/email-template-edit/info@sky2c.com">info@sky2c.com</a></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">&nbsp;</td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\n<tbody style="color: #fff;">\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Team Sky2c</p>\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></span></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n</tbody>\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-02-15 09:13:09'),
(1, 'Forgot Password', 'forgot_password', 'Sky2c - Forgot Password', '{user},{link}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Forgot Password</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Hello {user},</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top">You have requested for reset your password, Kindly review the below details</td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>To create a new password, just follow this link:<br /> {link}</p>\r\n<br />Note: This link will be expired with in 24 hours</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody style="color: #fff;">\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Team Sky2c</p>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></span></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-02-17 11:58:51'),
(25, 'Resend Code', 'resend_code_api', 'Sky2c - Resend code', '{user},{code}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Resend Code</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Hello {user},</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n<p>Your resend code is:<br /> {code}</p>\r\n<br />Note: This code will be expired with in 15 minutes</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody style="color: #fff;">\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Team Sky2c</p>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></span></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-02-17 11:58:51'),
(26, 'Order Assignment', 'order_assign_to_agent', 'Sky2c - Order Assignment', '{agent_name},{assign_by_email},{assigned_by_name},{order_info}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Order Assignment</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\n</tr>\n<tr>\n<td valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">Hello {agent_name},</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top"><br /></td>\n</tr>\n<tr>\n<td valign="top">\n<p>You have recieved new order, Kindly review details below.</p>\n<p>Assigned By : {assigned_by_name}({assign_by_email})</p>\n<p>Order Info : </p>\n{order_info}\n\n\n</td>\n</tr>\n<tr>\n<td class="system_contmail" colspan="2">If you any query please let us know straight away at:<a href="mailto:sky2c@gmail.com"> sky2c@gmail.com</a></td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\n<tbody style="color: #fff;">\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Team Sky2c</p>\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></span></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n</tbody>\n</table>\n', 'info@sky2c.com', 'Sky2c', 1, '2017-02-15 09:14:19'),
(27, 'Order Assignment', 'order_response_to_agent', 'Sky2c - Order Response', '{agent_name},{driver_name},{action},{order_id},{pkg_number},{pkg_title}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - {action} Order</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">Hello {agent_name},</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n	<p>Driver({driver_name}) have {action} your order, Kindly review details below.</p>\r\n	<p>Order Id : {order_id}</p>\r\n	<p>Package No : {pkg_number}</p>\r\n	<p>package Title : {pkg_title}</p>\r\n	<p></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class="system_contmail" colspan="2">If you any query please let us know straight away at:<a href="mailto:sky2c@gmail.com"> sky2c@gmail.com</a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody style="color: #fff;">\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Team Sky2c</p>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></span></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n', 'info@sky2c.com', 'Sky2c', 1, '2017-02-15 09:14:19'),
(28, 'Order Assignment', 'order_response_to_driver', 'Sky2c - Order Response', '{agent_name},{driver_name},{action},{order_id},{pkg_number},{pkg_title}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\r\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\r\n<tbody>\r\n<tr style="height: 36px;" height="36">\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - {action} Order</strong></span></span><span style="color: #039dc4; font-size: small;"><strong>&nbsp;</strong></span><br /></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top">\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\r\n<tbody>\r\n<tr>\r\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">Hello {driver_name},</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 25px;" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top">\r\n	<p>You have {action} the order of {agent_name}, Kindly review details below.</p>\r\n	<p>Order Id : {order_id}</p>\r\n	<p>Package No : {pkg_number}</p>\r\n	<p>package Title : {pkg_title}</p>\r\n	<p></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class="system_contmail" colspan="2">If you any query please let us know straight away at:<a href="mailto:sky2c@gmail.com"> sky2c@gmail.com</a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></td>\r\n<td style="width: 30px;" width="30" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\r\n</tr>\r\n<tr>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\r\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \r\n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\r\n<tbody style="color: #fff;">\r\n<tr>\r\n<td style="width: 500px; height: 20px;" width="500" valign="top">\r\n<p style="font-weight: bold;">Team Sky2c</p>\r\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</span></span></td>\r\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n', 'info@sky2c.com', 'Sky2c', 1, '2017-02-15 09:14:19'),
(29, 'New Customer', 'registration_invitation', 'Sky2c - Invitation for register', '{username},{password},{link}', '<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>\n<table style="border-collapse: collapse; border-spacing: 0; border: 1px solid #039DC4; background-color: #fff; padding: 0;" border="0" cellspacing="0" cellpadding="0" align="center">\n<tbody>\n<tr style="height: 36px;" height="36">\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n<td style="width: 500px; background-color: #039dc4;" width="500" valign="middle"><span style="background-color: #039dc4;"><span style="color: white; font-size: small;"><strong> Sky2c - Invitation For Registration</strong></span></span><span style="color: #039dc4; font-size: small;"><strong> </strong></span><br /></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="middle"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top">\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n<td style="width: 500px;" width="500" valign="top"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">\n<tbody>\n<tr>\n<td valign="top"><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/logo.png" alt="" /><br /></td>\n</tr>\n<tr>\n<td valign="top">\n<p>Hello {full_name},</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="height: 25px;" valign="top">\n<p>New customer has been created into system, Following are the details. Kindly review</p>\n<p>Email : Need to setup by customer</p>\n<p>Username : {username}</p>\n<p><span style="font-family: Arial,Helvetica,sans-serif;">Password : {password}</span></p>\n<p><span style="font-family: Arial,Helvetica,sans-serif;">Click here for login : {link}<br /></span></p>\n<p>If you have any questions please contact us at <a href="mailto:info@sitterguide.com">info@sky2c.com</a></p>\n</td>\n</tr>\n<tr>\n<td valign="top"><br /></td>\n</tr>\n</tbody>\n</table>\n</span></td>\n<td style="width: 30px;" width="30" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="height: 20px;" colspan="3" valign="top"><br /></td>\n</tr>\n<tr>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><br /></td>\n<td style="background-color: #039dc4; padding: 15px 0;" valign="top"><span style="background-color: #039dc4;"><span style="font-family: Arial,Helvetica,sans-serif;"> \n<table style="border-collapse: collapse; border-spacing: 0; text-align: justify; padding: 0;" border="0" cellspacing="0" cellpadding="0" width="500" height="128" align="left">\n<tbody style="color: #fff;">\n<tr>\n<td style="width: 500px; height: 20px;" width="500" valign="top">\n<p style="font-weight: bold;">Team Sky2c</p>\n<p><span style="font-family: Arial; font-size: xx-small;">Notice:  The information in this email and in any  attachments is confidential  and intended solely for the attention and use of the  named addressee.  This information may be subject to legal professional or other   privilege or may otherwise be protected by work product immunity or  other legal  rules. It must not be disclosed to any person without  authorization. If you are  not the intended recipient, or a person  responsible for delivering it to the  intended recipient, you are not  authorized to and must not disclose, copy,  distribute, or retain this  message or any part of  it.</span></p>\n</td>\n</tr>\n</tbody>\n</table>\n</span></span></td>\n<td style="width: 30px; background-color: #039dc4;" width="30" valign="top"><span style="background-color: #039dc4;"> </span></td>\n</tr>\n</tbody>\n</table>', 'info@sky2c.com', 'Sky2c', 1, '2017-03-02 10:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `descrates_app_id` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `source` text NOT NULL,
  `destination` text NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_date_time` datetime NOT NULL,
  `shipment_type` varchar(255) NOT NULL,
  `house_bill_number` varchar(255) NOT NULL,
  `booking_number` varchar(255) NOT NULL,
  `customer_reference` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `transportation_method` varchar(255) NOT NULL,
  `type_of_move` varchar(255) NOT NULL,
  `type_of_service` varchar(255) NOT NULL,
  `vessel_name` varchar(255) NOT NULL,
  `voyage_flight_number` varchar(255) NOT NULL,
  `pickup_date` datetime NOT NULL,
  `drop_off_date` datetime NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Assigned, 3=Completed',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `descrates_app_id`, `customer_id`, `source`, `destination`, `transaction_id`, `transaction_date_time`, `shipment_type`, `house_bill_number`, `booking_number`, `customer_reference`, `payment_method`, `transportation_method`, `type_of_move`, `type_of_service`, `vessel_name`, `voyage_flight_number`, `pickup_date`, `drop_off_date`, `status`, `created`, `modified`) VALUES
(1, '103000990', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '3', '2017-03-30 07:26:09', '2017-05-05 05:04:52'),
(2, '103000668', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '2', '2017-03-30 09:47:36', '2017-05-05 09:30:24'),
(3, '103000669', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '2', '2017-03-30 09:47:41', '2017-05-04 07:40:10'),
(4, '103000671', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '2', '2017-03-30 09:47:46', '2017-05-04 07:38:02'),
(5, '103000676', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '3', '2017-03-30 09:48:09', '2017-05-08 09:19:34'),
(6, '103000677', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '1', '2017-03-30 09:48:14', '2017-05-02 12:48:18'),
(7, '103000552', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:51:53', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '2', '2017-03-30 11:06:28', '2017-05-08 09:46:28'),
(8, '103000870', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '1', '2017-03-30 11:09:50', '2017-05-02 11:59:10'),
(9, '103000100', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '1', '2017-03-31 05:07:17', '2017-05-03 05:21:53'),
(10, '103000200', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '3', '2017-04-04 07:44:09', '2017-05-04 06:38:59'),
(11, '103000201', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-04 09:45:37', '2017-04-20 11:40:47'),
(12, '103000202', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-05 05:20:40', '2017-04-20 11:43:41'),
(13, '103000203', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-05 08:58:46', '2017-04-21 11:43:51'),
(14, '103000204', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-05 08:59:42', '2017-04-20 11:47:16'),
(15, '103000205', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-05 09:00:02', '2017-04-20 11:48:13'),
(16, '103000209', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-05 09:07:45', '2017-04-20 11:50:08'),
(17, '103000207', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-05 09:11:30', '2017-04-20 11:51:42'),
(18, '103000208', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:51:44', '2017-04-20 11:55:17'),
(19, '103000210', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:52:35', '2017-04-20 11:57:23'),
(20, '103000211', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:52:55', '2017-04-20 11:59:33'),
(21, '103000212', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:53:14', '2017-04-20 12:07:08'),
(22, '103000213', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:53:29', '2017-04-20 12:09:05'),
(23, '103000214', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:53:48', '2017-04-27 11:43:36'),
(24, '103000215', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:54:04', '2017-04-20 12:22:52'),
(25, '103000216', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '2', '2017-04-06 03:54:20', '2017-05-08 05:37:18'),
(26, '103000217', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:54:32', '2017-04-24 05:51:50'),
(27, '103000218', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:54:44', '2017-04-06 03:54:44'),
(28, '103000219', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:54:59', '2017-05-03 05:44:51'),
(29, '103000220', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:55:13', '2017-04-14 04:15:57'),
(30, '103000221', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:55:26', '2017-04-17 05:50:25'),
(31, '103000222', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:57:29', '2017-04-13 12:31:06'),
(32, '103000223', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:57:42', '2017-04-13 11:57:59'),
(33, '103000224', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:57:54', '2017-04-12 12:10:04'),
(34, '103000225', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:58:14', '2017-04-12 12:09:35'),
(35, '103000226', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '3', '2017-04-06 03:58:26', '2017-05-04 06:35:11'),
(36, '103000227', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:59:36', '2017-04-12 12:08:29'),
(37, '103000228', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:59:47', '2017-04-12 12:08:02'),
(38, '103000229', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 03:59:58', '2017-04-12 12:07:36'),
(39, '103000230', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 04:00:11', '2017-05-02 09:26:44'),
(40, '103000231', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 04:00:51', '2017-05-02 07:23:30'),
(41, '103000232', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 04:01:24', '2017-05-02 07:16:26'),
(42, '103000233', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 04:02:07', '2017-05-03 04:55:35'),
(43, '103000234', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 04:03:19', '2017-05-02 09:14:42'),
(44, '103000235', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 04:03:47', '2017-05-01 05:41:43'),
(45, '103000236', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 04:05:59', '2017-04-28 05:25:59'),
(46, '103000237', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-06 04:08:08', '2017-05-03 07:58:00'),
(47, '103000238', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '2', '2017-04-07 04:28:59', '2017-05-08 07:38:45'),
(48, '103000290', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-10 04:07:42', '2017-04-21 12:25:23'),
(49, '103000290:01', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-04 00:00:00', '1', '2017-04-13 10:33:15', '2017-04-19 13:06:53'),
(50, '103000675', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '1', '2017-05-02 11:58:28', '2017-05-03 04:25:29'),
(51, '103000678', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '3', '2017-05-02 11:58:48', '2017-05-04 07:34:38'),
(52, '103000680', 152, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '000221020000991', '2017-02-28 11:35:26', 'House', '001620', '2584725560', 'ref# 103000552', 'Prepaid', 'Ocean Export', 'CY/CY', 'PP', 'PERFORMANCE', '004W', '2017-03-04 00:00:00', '2017-04-24 00:00:00', '2', '2017-05-02 11:58:54', '2017-05-04 07:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_assignments`
--

CREATE TABLE `order_assignments` (
  `id` int(11) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `source` text NOT NULL COMMENT 'Enter manually by agent',
  `destination` text NOT NULL COMMENT 'Enter manually by agent',
  `status_by` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Assigned, 3=Completed',
  `status_to` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Assigned, 3=Completed',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_assignments`
--

INSERT INTO `order_assignments` (`id`, `assign_by`, `assign_to`, `order_id`, `package_id`, `tracking_number`, `source`, `destination`, `status_by`, `status_to`, `created`, `modified`) VALUES
(1, 1, 173, 35, 45, '', 'dd', 'fvccv', '3', '3', '2017-05-04 06:35:56', '2017-05-04 06:01:56'),
(2, 1, 1, 10, 16, '', '', '', '3', '3', '2017-05-04 06:51:16', '2017-05-04 06:38:58'),
(3, 1, 1, 52, 69, '', 'hgjg', 'gdfhf', '2', '2', '2017-05-04 07:32:06', '2017-05-04 07:32:06'),
(4, 1, 1, 51, 68, '', 'j', 'drf', '3', '3', '2017-05-04 07:35:08', '2017-05-04 07:34:38'),
(5, 1, 1, 4, 4, '', 'hjn', 'jj', '2', '2', '2017-05-04 07:38:02', '2017-05-04 07:38:02'),
(6, 1, 1, 3, 3, '', 'ff', 'ffg', '2', '2', '2017-05-04 07:40:10', '2017-05-04 07:40:10'),
(7, 1, 173, 7, 10, '', 'xx', 'ccc', '2', '2', '2017-05-04 09:23:33', '2017-05-04 09:23:33'),
(8, 1, 173, 47, 64, '', 'zz', 'zz', '2', '2', '2017-05-08 07:38:45', '2017-05-08 07:38:45'),
(9, 230, 173, 1, 1, '', 'abc', 'xyz', '3', '3', '2017-05-05 05:05:46', '2017-05-05 04:45:40'),
(10, 1, 173, 2, 2, '', 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '2', '1', '2017-05-08 10:33:06', '2017-05-08 10:31:46'),
(11, 1, 173, 2, 5, '', 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '2', '1', '2017-05-08 10:33:06', '2017-05-08 10:32:40'),
(12, 1, 173, 2, 8, '', 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '2', '1', '2017-05-08 10:33:06', '2017-05-08 10:32:40'),
(13, 1, 173, 2, 9, '', 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '2', '1', '2017-05-08 10:33:06', '2017-05-08 10:32:40'),
(14, 1, 173, 25, 35, '', 'l;', ';l\'l', '2', '2', '2017-05-08 05:37:18', '2017-05-08 05:37:18'),
(15, 1, 173, 5, 6, '', 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', '3', '3', '2017-05-08 09:20:54', '2017-05-08 09:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `order_assignment_logs`
--

CREATE TABLE `order_assignment_logs` (
  `id` int(11) NOT NULL,
  `order_assignment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `shipment_type` enum('self','driver','3rdparty') NOT NULL,
  `shipping_carrier_id` int(11) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Accept,3=Completed,4=Reject',
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_assignment_logs`
--

INSERT INTO `order_assignment_logs` (`id`, `order_assignment_id`, `order_id`, `package_id`, `assign_by`, `assign_to`, `source`, `destination`, `shipment_type`, `shipping_carrier_id`, `tracking_number`, `status`, `created`, `modified`) VALUES
(1, 1, 35, 45, 173, 176, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'driver', 0, '', '3', '2017-05-04', '2017-05-04'),
(2, 2, 10, 16, 1, 226, '', '', 'driver', 0, '', '3', '2017-05-04', '2017-05-04'),
(3, 3, 52, 69, 1, 1, 'hgjg', 'gdfhf', '3rdparty', 1, '449044304137821', '2', '2017-05-04', '2017-05-04'),
(4, 4, 51, 68, 1, 1, 'j', 'drf', '3rdparty', 1, '111111111111', '3', '2017-05-04', '2017-05-04'),
(5, 5, 4, 4, 1, 1, 'hjn', 'jj', '3rdparty', 1, '797843158299', '2', '2017-05-04', '2017-05-04'),
(6, 6, 3, 3, 1, 1, 'ff', 'ffg', '3rdparty', 2, '1Z9999W99999999999', '2', '2017-05-04', '2017-05-04'),
(7, 7, 7, 10, 173, 176, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'driver', 0, '', '2', '2017-05-04', '2017-05-04'),
(8, 9, 1, 1, 173, 176, 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'driver', 0, '', '3', '2017-05-05', '2017-05-05'),
(9, 8, 47, 64, 173, 173, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'self', 0, '', '2', '2017-05-05', '2017-05-05'),
(10, 14, 25, 35, 173, 173, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'self', 0, '', '2', '2017-05-08', '2017-05-08'),
(11, 14, 25, 35, 173, 173, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'self', 0, '', '2', '2017-05-08', '2017-05-08'),
(12, 8, 47, 64, 173, 173, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'self', 0, '', '2', '2017-05-08', '2017-05-08'),
(13, 8, 47, 64, 173, 173, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'self', 0, '', '2', '2017-05-08', '2017-05-08'),
(14, 15, 5, 6, 173, 176, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'driver', 0, '', '3', '2017-05-08', '2017-05-08'),
(15, 10, 2, 2, 173, 176, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'driver', 0, '', '4', '2017-05-08', '2017-05-08'),
(16, 11, 2, 5, 173, 176, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'driver', 0, '', '4', '2017-05-08', '2017-05-08'),
(17, 12, 2, 8, 173, 176, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'driver', 0, '', '4', '2017-05-08', '2017-05-08'),
(18, 13, 2, 9, 173, 176, 'MGM COPIERS, PO BOX 360794, MILPITAS, 950360000, US', 'S P ASSOCIATE, 1/11959 ULDHANPUR, DELHI, 110032, IN', 'driver', 0, '', '4', '2017-05-08', '2017-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `party_type` varchar(255) NOT NULL,
  `party_code` varchar(255) NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `state_or_province_code` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `party_type`, `party_code`, `party_name`, `address_1`, `city_name`, `state_or_province_code`, `postal_code`, `country_code`, `created_date`) VALUES
(1, 1, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-30 07:26:09'),
(2, 1, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-30 07:26:09'),
(3, 1, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-30 07:26:09'),
(4, 1, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-30 07:26:09'),
(5, 1, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-30 07:26:09'),
(6, 1, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-30 07:26:09'),
(7, 2, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-30 09:47:36'),
(8, 2, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-30 09:47:36'),
(9, 2, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-30 09:47:36'),
(10, 2, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-30 09:47:36'),
(11, 2, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-30 09:47:36'),
(12, 2, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-30 09:47:36'),
(13, 3, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-30 09:47:41'),
(14, 3, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-30 09:47:41'),
(15, 3, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-30 09:47:42'),
(16, 3, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-30 09:47:42'),
(17, 3, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-30 09:47:42'),
(18, 3, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-30 09:47:42'),
(19, 4, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-30 09:47:46'),
(20, 4, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-30 09:47:46'),
(21, 4, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-30 09:47:46'),
(22, 4, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-30 09:47:46'),
(23, 4, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-30 09:47:46'),
(24, 4, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-30 09:47:46'),
(25, 5, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-30 09:48:09'),
(26, 5, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-30 09:48:09'),
(27, 5, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-30 09:48:09'),
(28, 5, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-30 09:48:09'),
(29, 5, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-30 09:48:09'),
(30, 5, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-30 09:48:10'),
(31, 6, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-30 09:48:14'),
(32, 6, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-30 09:48:14'),
(33, 6, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-30 09:48:14'),
(34, 6, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-30 09:48:14'),
(35, 6, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-30 09:48:14'),
(36, 6, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-30 09:48:14'),
(37, 7, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-30 11:06:28'),
(38, 7, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-30 11:06:28'),
(39, 7, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-30 11:06:28'),
(40, 7, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-30 11:06:28'),
(41, 7, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-30 11:06:28'),
(42, 7, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-30 11:06:28'),
(43, 8, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-30 11:09:50'),
(44, 8, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-30 11:09:51'),
(45, 8, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-30 11:09:51'),
(46, 8, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-30 11:09:51'),
(47, 8, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-30 11:09:51'),
(48, 8, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-30 11:09:51'),
(49, 9, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-03-31 05:07:18'),
(50, 9, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-03-31 05:07:18'),
(51, 9, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-03-31 05:07:18'),
(52, 9, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-03-31 05:07:18'),
(53, 9, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-03-31 05:07:18'),
(54, 9, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-03-31 05:07:18'),
(55, 10, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-04 07:44:09'),
(56, 10, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-04 07:44:09'),
(57, 10, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-04 07:44:09'),
(58, 10, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-04 07:44:09'),
(59, 10, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-04 07:44:09'),
(60, 10, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-04 07:44:09'),
(61, 11, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-04 09:45:37'),
(62, 11, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-04 09:45:37'),
(63, 11, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-04 09:45:38'),
(64, 11, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-04 09:45:38'),
(65, 11, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-04 09:45:38'),
(66, 11, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-04 09:45:38'),
(67, 12, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-05 05:20:40'),
(68, 12, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-05 05:20:40'),
(69, 12, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-05 05:20:40'),
(70, 12, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-05 05:20:40'),
(71, 12, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-05 05:20:40'),
(72, 12, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-05 05:20:40'),
(73, 13, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-05 08:58:46'),
(74, 13, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-05 08:58:46'),
(75, 13, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-05 08:58:47'),
(76, 13, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-05 08:58:47'),
(77, 13, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-05 08:58:47'),
(78, 13, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-05 08:58:47'),
(79, 14, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-05 08:59:42'),
(80, 14, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-05 08:59:42'),
(81, 14, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-05 08:59:42'),
(82, 14, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-05 08:59:43'),
(83, 14, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-05 08:59:43'),
(84, 14, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-05 08:59:43'),
(85, 15, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-05 09:00:03'),
(86, 15, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-05 09:00:03'),
(87, 15, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-05 09:00:03'),
(88, 15, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-05 09:00:03'),
(89, 15, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-05 09:00:03'),
(90, 15, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-05 09:00:03'),
(91, 16, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-05 09:07:45'),
(92, 16, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-05 09:07:45'),
(93, 16, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-05 09:07:45'),
(94, 16, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-05 09:07:45'),
(95, 16, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-05 09:07:45'),
(96, 16, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-05 09:07:45'),
(97, 17, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-05 09:11:31'),
(98, 17, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-05 09:11:31'),
(99, 17, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-05 09:11:31'),
(100, 17, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-05 09:11:31'),
(101, 17, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-05 09:11:31'),
(102, 17, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-05 09:11:31'),
(103, 18, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:51:44'),
(104, 18, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:51:44'),
(105, 18, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:51:44'),
(106, 18, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:51:44'),
(107, 18, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:51:44'),
(108, 18, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:51:44'),
(109, 19, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:52:35'),
(110, 19, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:52:35'),
(111, 19, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:52:35'),
(112, 19, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:52:35'),
(113, 19, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:52:35'),
(114, 19, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:52:35'),
(115, 20, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:52:55'),
(116, 20, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:52:55'),
(117, 20, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:52:55'),
(118, 20, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:52:55'),
(119, 20, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:52:55'),
(120, 20, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:52:55'),
(121, 21, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:53:15'),
(122, 21, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:53:15'),
(123, 21, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:53:15'),
(124, 21, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:53:15'),
(125, 21, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:53:15'),
(126, 21, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:53:15'),
(127, 22, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:53:29'),
(128, 22, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:53:29'),
(129, 22, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:53:30'),
(130, 22, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:53:30'),
(131, 22, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:53:30'),
(132, 22, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:53:30'),
(133, 23, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:53:48'),
(134, 23, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:53:48'),
(135, 23, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:53:48'),
(136, 23, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:53:48'),
(137, 23, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:53:48'),
(138, 23, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:53:48'),
(139, 24, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:54:04'),
(140, 24, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:54:04'),
(141, 24, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:54:04'),
(142, 24, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:54:04'),
(143, 24, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:54:04'),
(144, 24, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:54:04'),
(145, 25, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:54:20'),
(146, 25, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:54:20'),
(147, 25, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:54:20'),
(148, 25, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:54:20'),
(149, 25, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:54:20'),
(150, 25, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:54:20'),
(151, 26, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:54:32'),
(152, 26, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:54:32'),
(153, 26, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:54:32'),
(154, 26, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:54:32'),
(155, 26, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:54:32'),
(156, 26, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:54:32'),
(157, 27, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:54:44'),
(158, 27, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:54:44'),
(159, 27, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:54:44'),
(160, 27, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:54:44'),
(161, 27, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:54:45'),
(162, 27, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:54:45'),
(163, 28, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:54:59'),
(164, 28, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:54:59'),
(165, 28, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:54:59'),
(166, 28, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:54:59'),
(167, 28, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:54:59'),
(168, 28, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:54:59'),
(169, 29, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:55:13'),
(170, 29, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:55:13'),
(171, 29, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:55:13'),
(172, 29, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:55:13'),
(173, 29, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:55:13'),
(174, 29, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:55:13'),
(175, 30, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:55:26'),
(176, 30, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:55:26'),
(177, 30, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:55:26'),
(178, 30, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:55:26'),
(179, 30, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:55:26'),
(180, 30, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:55:26'),
(181, 31, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:57:29'),
(182, 31, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:57:29'),
(183, 31, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:57:29'),
(184, 31, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:57:29'),
(185, 31, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:57:29'),
(186, 31, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:57:29'),
(187, 32, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:57:42'),
(188, 32, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:57:42'),
(189, 32, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:57:42'),
(190, 32, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:57:42'),
(191, 32, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:57:42'),
(192, 32, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:57:42'),
(193, 33, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:57:54'),
(194, 33, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:57:54'),
(195, 33, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:57:54'),
(196, 33, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:57:54'),
(197, 33, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:57:54'),
(198, 33, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:57:54'),
(199, 34, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:58:14'),
(200, 34, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:58:14'),
(201, 34, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:58:14'),
(202, 34, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:58:14'),
(203, 34, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:58:14'),
(204, 34, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:58:14'),
(205, 35, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:58:26'),
(206, 35, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:58:26'),
(207, 35, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:58:26'),
(208, 35, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:58:26'),
(209, 35, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:58:26'),
(210, 35, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:58:26'),
(211, 36, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:59:36'),
(212, 36, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:59:36'),
(213, 36, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:59:37'),
(214, 36, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:59:37'),
(215, 36, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:59:37'),
(216, 36, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:59:37'),
(217, 37, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:59:47'),
(218, 37, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:59:47'),
(219, 37, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:59:47'),
(220, 37, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:59:47'),
(221, 37, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:59:47'),
(222, 37, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:59:47'),
(223, 38, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 03:59:58'),
(224, 38, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 03:59:58'),
(225, 38, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 03:59:59'),
(226, 38, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 03:59:59'),
(227, 38, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 03:59:59'),
(228, 38, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 03:59:59'),
(229, 39, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 04:00:11'),
(230, 39, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 04:00:11'),
(231, 39, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 04:00:12'),
(232, 39, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 04:00:12'),
(233, 39, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 04:00:12'),
(234, 39, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 04:00:12'),
(235, 40, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 04:00:51'),
(236, 40, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 04:00:51'),
(237, 40, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 04:00:51'),
(238, 40, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 04:00:51'),
(239, 40, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 04:00:51'),
(240, 40, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 04:00:51'),
(241, 41, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 04:01:24'),
(242, 41, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 04:01:24'),
(243, 41, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 04:01:24'),
(244, 41, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 04:01:24'),
(245, 41, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 04:01:24'),
(246, 41, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 04:01:24'),
(247, 42, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 04:02:07'),
(248, 42, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 04:02:07'),
(249, 42, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 04:02:07'),
(250, 42, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 04:02:07'),
(251, 42, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 04:02:07'),
(252, 42, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 04:02:07'),
(253, 43, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 04:03:19'),
(254, 43, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 04:03:19'),
(255, 43, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 04:03:19'),
(256, 43, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 04:03:19'),
(257, 43, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 04:03:19'),
(258, 43, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 04:03:19'),
(259, 44, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 04:03:47'),
(260, 44, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 04:03:47'),
(261, 44, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 04:03:47'),
(262, 44, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 04:03:47'),
(263, 44, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 04:03:47'),
(264, 44, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 04:03:47'),
(265, 45, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 04:05:59'),
(266, 45, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 04:05:59'),
(267, 45, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 04:05:59'),
(268, 45, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 04:06:00'),
(269, 45, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 04:06:00'),
(270, 45, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 04:06:00'),
(271, 46, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-06 04:08:08'),
(272, 46, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-06 04:08:08'),
(273, 46, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-06 04:08:08'),
(274, 46, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-06 04:08:08'),
(275, 46, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-06 04:08:08'),
(276, 46, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-06 04:08:08'),
(277, 47, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-07 04:28:59'),
(278, 47, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-07 04:28:59'),
(279, 47, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-07 04:28:59'),
(280, 47, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-07 04:28:59'),
(281, 47, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-07 04:28:59'),
(282, 47, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-07 04:28:59'),
(283, 48, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-10 04:07:42'),
(284, 48, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-10 04:07:42'),
(285, 48, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-10 04:07:42'),
(286, 48, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-10 04:07:42'),
(287, 48, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-10 04:07:43'),
(288, 48, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-10 04:07:43'),
(289, 49, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-04-13 10:33:15'),
(290, 49, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-04-13 10:33:15'),
(291, 49, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-04-13 10:33:15'),
(292, 49, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-04-13 10:33:15'),
(293, 49, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-04-13 10:33:15'),
(294, 49, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-04-13 10:33:15'),
(295, 50, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-05-02 11:58:28'),
(296, 50, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-05-02 11:58:28'),
(297, 50, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-05-02 11:58:29'),
(298, 50, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-05-02 11:58:29'),
(299, 50, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-05-02 11:58:29'),
(300, 50, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-05-02 11:58:29'),
(301, 51, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-05-02 11:58:48'),
(302, 51, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-05-02 11:58:48'),
(303, 51, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-05-02 11:58:48'),
(304, 51, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-05-02 11:58:48'),
(305, 51, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-05-02 11:58:48'),
(306, 51, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-05-02 11:58:48'),
(307, 52, 'Account', 'GLOCOP01', 'GLOBAL COPIERS', '210-220 RUTHERFORD RD S', 'BRAMPTON', 'ON', 'L6W 3J6', 'CA', '2017-05-02 11:58:54'),
(308, 52, 'Shipper', 'MGMCOP02', 'MGM COPIERS', 'PO BOX 360794', 'MILPITAS', 'CA', '950360000', 'US', '2017-05-02 11:58:54'),
(309, 52, 'Consignee', 'SPAS01', 'S P ASSOCIATE', '1/11959 ULDHANPUR', 'DELHI', '', '110032', 'IN', '2017-05-02 11:58:54'),
(310, 52, 'Notify', 'SAMAS01', 'SAME AS CONSIGNEE', '', '', '', '', 'US', '2017-05-02 11:58:55'),
(311, 52, 'Carrier', 'OOCUS01', 'OOCL (USA) INC.', '10913 S.RIVER FRONT PARKWAY, S', 'SOUTH JORDAN', 'UT', '840950000', 'US', '2017-05-02 11:58:55'),
(312, 52, 'Forwarder', '10', 'SKY 2 C FREIGHT SYSTEMS, INC.', '4221 BUSINESS CENTER DRIVE', 'FREMONT', 'CA', '945380000', 'US', '2017-05-02 11:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_locations`
--

CREATE TABLE `order_locations` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `location_type` varchar(255) NOT NULL,
  `location_id_qualifier` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `state_or_province_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_locations`
--

INSERT INTO `order_locations` (`id`, `order_id`, `location_type`, `location_id_qualifier`, `location_id`, `location_name`, `state_or_province_code`, `country_code`, `created_date`) VALUES
(1, 1, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-30 07:26:09'),
(2, 1, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-30 07:26:09'),
(3, 2, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-30 09:47:36'),
(4, 2, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-30 09:47:37'),
(5, 3, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-30 09:47:42'),
(6, 3, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-30 09:47:42'),
(7, 4, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-30 09:47:46'),
(8, 4, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-30 09:47:46'),
(9, 5, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-30 09:48:10'),
(10, 5, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-30 09:48:10'),
(11, 6, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-30 09:48:14'),
(12, 6, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-30 09:48:14'),
(13, 7, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-30 11:06:28'),
(14, 7, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-30 11:06:28'),
(15, 8, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-30 11:09:51'),
(16, 8, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-30 11:09:51'),
(17, 9, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-03-31 05:07:18'),
(18, 9, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-03-31 05:07:18'),
(19, 10, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-04 07:44:09'),
(20, 10, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-04 07:44:09'),
(21, 11, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-04 09:45:38'),
(22, 11, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-04 09:45:38'),
(23, 12, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-05 05:20:40'),
(24, 12, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-05 05:20:40'),
(25, 13, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-05 08:58:47'),
(26, 13, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-05 08:58:47'),
(27, 14, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-05 08:59:43'),
(28, 14, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-05 08:59:43'),
(29, 15, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-05 09:00:03'),
(30, 15, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-05 09:00:03'),
(31, 16, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-05 09:07:45'),
(32, 16, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-05 09:07:45'),
(33, 17, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-05 09:11:31'),
(34, 17, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-05 09:11:31'),
(35, 18, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:51:44'),
(36, 18, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:51:44'),
(37, 19, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:52:35'),
(38, 19, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:52:35'),
(39, 20, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:52:55'),
(40, 20, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:52:55'),
(41, 21, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:53:15'),
(42, 21, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:53:15'),
(43, 22, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:53:30'),
(44, 22, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:53:30'),
(45, 23, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:53:48'),
(46, 23, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:53:48'),
(47, 24, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:54:04'),
(48, 24, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:54:04'),
(49, 25, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:54:20'),
(50, 25, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:54:20'),
(51, 26, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:54:32'),
(52, 26, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:54:32'),
(53, 27, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:54:45'),
(54, 27, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:54:45'),
(55, 28, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:54:59'),
(56, 28, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:54:59'),
(57, 29, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:55:13'),
(58, 29, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:55:13'),
(59, 30, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:55:26'),
(60, 30, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:55:26'),
(61, 31, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:57:29'),
(62, 31, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:57:29'),
(63, 32, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:57:42'),
(64, 32, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:57:42'),
(65, 33, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:57:54'),
(66, 33, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:57:54'),
(67, 34, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:58:14'),
(68, 34, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:58:14'),
(69, 35, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:58:26'),
(70, 35, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:58:26'),
(71, 36, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:59:37'),
(72, 36, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:59:37'),
(73, 37, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:59:47'),
(74, 37, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:59:47'),
(75, 38, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 03:59:59'),
(76, 38, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 03:59:59'),
(77, 39, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 04:00:12'),
(78, 39, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 04:00:12'),
(79, 40, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 04:00:51'),
(80, 40, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 04:00:51'),
(81, 41, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 04:01:24'),
(82, 41, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 04:01:24'),
(83, 42, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 04:02:07'),
(84, 42, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 04:02:07'),
(85, 43, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 04:03:19'),
(86, 43, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 04:03:19'),
(87, 44, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 04:03:47'),
(88, 44, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 04:03:47'),
(89, 45, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 04:06:00'),
(90, 45, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 04:06:00'),
(91, 46, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-06 04:08:08'),
(92, 46, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-06 04:08:08'),
(93, 47, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-07 04:28:59'),
(94, 47, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-07 04:28:59'),
(95, 48, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-10 04:07:43'),
(96, 48, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-10 04:07:43'),
(97, 49, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-04-13 10:33:15'),
(98, 49, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-04-13 10:33:15'),
(99, 50, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-05-02 11:58:29'),
(100, 50, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-05-02 11:58:29'),
(101, 51, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-05-02 11:58:48'),
(102, 51, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-05-02 11:58:49'),
(103, 52, 'PortOfLoad', 'UN', 'USNYC', 'NEW YORK', 'NY', 'US', '2017-05-02 11:58:55'),
(104, 52, 'PortOfDischarge', 'UN', 'INCCU', 'CALCUTTA', '', 'IN', '2017-05-02 11:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_packages`
--

CREATE TABLE `order_packages` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `equipment_initial` varchar(255) NOT NULL,
  `equipment_number` varchar(255) NOT NULL,
  `quantity_shipped` varchar(255) NOT NULL,
  `unit_of_measure` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `gross_weight` varchar(255) NOT NULL,
  `weight_unit` varchar(255) NOT NULL,
  `quantity_packaging_units` varchar(255) NOT NULL,
  `package_number` varchar(255) NOT NULL,
  `package_title` varchar(255) NOT NULL,
  `package_weight` float NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1=Open, 2=Assigned, 3=Completed',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_packages`
--

INSERT INTO `order_packages` (`id`, `order_id`, `equipment_initial`, `equipment_number`, `quantity_shipped`, `unit_of_measure`, `description`, `gross_weight`, `weight_unit`, `quantity_packaging_units`, `package_number`, `package_title`, `package_weight`, `status`, `created`, `modified`) VALUES
(1, 1, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000990-01', '45G0', 0, '3', '2017-05-05 05:05:46', '2017-05-05 04:44:13'),
(2, 2, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000668-03', '45G0', 0, '2', '2017-05-05 09:30:24', '2017-05-05 09:30:24'),
(3, 3, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000669-01', '45G0', 0, '2', '2017-05-04 07:40:10', '2017-05-04 07:40:10'),
(4, 4, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000671-01', '45G0', 0, '2', '2017-05-04 07:38:02', '2017-05-04 07:38:02'),
(5, 2, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000668-01', '45G0', 0, '2', '2017-05-05 09:30:24', '2017-05-05 09:30:24'),
(6, 5, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000676-01', '45G0', 0, '3', '2017-05-08 09:20:54', '2017-05-08 09:17:19'),
(7, 6, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000677-01', '45G0', 0, '1', '2017-05-04 05:42:03', '2017-05-02 12:48:18'),
(8, 2, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000668-02', '45G0', 0, '2', '2017-05-05 09:30:24', '2017-05-05 09:30:24'),
(9, 2, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000668-04', '45G0', 0, '2', '2017-05-05 09:30:24', '2017-05-05 09:30:24'),
(10, 7, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000552-01', '45G0', 0, '2', '2017-05-04 09:23:01', '2017-05-04 09:23:01'),
(11, 8, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000870-01', '45G0', 0, '1', '2017-05-02 11:59:04', '2017-05-02 11:59:04'),
(12, 8, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000870-02', '45G0', 0, '1', '2017-05-02 11:59:10', '2017-05-02 11:59:10'),
(13, 9, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000100-02', '45G0', 0, '1', '2017-05-04 05:42:03', '2017-05-03 05:21:52'),
(14, 9, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000100-03', '45G0', 0, '1', '2017-05-04 05:42:03', '2017-05-03 05:21:53'),
(15, 9, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000100-04', '45G0', 0, '1', '2017-05-04 05:42:03', '2017-05-03 05:21:53'),
(16, 10, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000200-04', '45G0', 0, '3', '2017-05-04 06:51:16', '2017-05-04 06:38:58'),
(17, 11, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000201-01', '58A2', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:40:47'),
(18, 12, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000202-01', '58A2', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:43:41'),
(19, 13, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000203-01', '58A2', 0, '1', '2017-04-21 12:41:55', '2017-04-21 11:43:51'),
(20, 13, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000203-02', '58A2', 0, '1', '2017-04-21 12:41:55', '2017-04-21 11:43:51'),
(21, 13, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000203-03', '58A2', 0, '1', '2017-04-21 12:41:55', '2017-04-21 11:43:51'),
(22, 14, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000204-01', '58A2', 0, '1', '2017-04-21 12:41:55', '2017-04-20 11:47:16'),
(23, 15, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000205-01', '58A2', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:48:13'),
(24, 13, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000203-04', '28E4', 0, '1', '2017-04-21 12:41:55', '2017-04-21 11:43:51'),
(25, 14, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000204-05', '47E6', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:47:16'),
(26, 16, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000209-07', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:50:08'),
(27, 17, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000207-01', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:51:42'),
(28, 18, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000208-01', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:55:17'),
(29, 19, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000210-01', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:57:23'),
(30, 20, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000211-01', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-20 11:59:33'),
(31, 21, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000212-01', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-20 12:07:08'),
(32, 22, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000213-01', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-20 12:09:05'),
(33, 23, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000214-01', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-04-27 11:43:36'),
(34, 24, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000215-01', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-20 12:22:52'),
(35, 25, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000216-01', '37E5', 0, '2', '2017-05-08 05:27:05', '2017-05-08 05:27:05'),
(36, 26, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000217-01', '37E5', 0, '1', '2017-04-24 06:49:32', '2017-04-24 03:48:41'),
(37, 27, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000218-01', '37E5', 0, '1', '2017-04-06 03:54:45', '2017-04-06 03:54:45'),
(38, 28, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000219-01', '37E5', 0, '1', '2017-05-04 05:42:03', '2017-05-03 03:44:19'),
(39, 29, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000220-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-14 04:15:57'),
(40, 30, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000221-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-17 05:50:25'),
(41, 31, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000222-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-13 12:31:06'),
(42, 32, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000223-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-13 11:57:59'),
(43, 33, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000224-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-12 12:10:04'),
(44, 34, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000225-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-12 12:09:35'),
(45, 35, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000226-01', '37E5', 0, '3', '2017-05-04 06:35:56', '2017-05-04 06:01:21'),
(46, 36, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000227-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-12 12:08:29'),
(47, 37, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000228-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-12 12:08:02'),
(48, 38, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000229-01', '37E5', 0, '1', '2017-04-19 12:50:58', '2017-04-12 12:07:35'),
(49, 39, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000230-01', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 09:26:44'),
(50, 39, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000230-02', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 07:31:20'),
(51, 39, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000230-03', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 09:23:00'),
(52, 40, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000231-01', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 07:21:20'),
(53, 40, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000231-02', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 07:23:30'),
(54, 41, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000232-01', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 06:22:36'),
(55, 41, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000232-02', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 07:16:26'),
(56, 42, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000233-01', '37E5', 0, '1', '2017-05-04 05:42:03', '2017-05-03 04:55:35'),
(57, 42, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000233-02', '37E5', 0, '1', '2017-05-04 05:42:03', '2017-05-03 04:55:35'),
(58, 43, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000234-01', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 05:56:07'),
(59, 43, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000234-02', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-02 09:14:42'),
(60, 44, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000235-01', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-01 05:41:43'),
(61, 44, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000235-02', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-05-01 05:41:43'),
(62, 45, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000236-03', '37E5', 0, '1', '2017-05-02 11:12:39', '2017-04-27 11:48:41'),
(63, 46, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000237-01', '37E5', 0, '1', '2017-05-04 05:42:03', '2017-05-03 07:58:00'),
(64, 47, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000238-01', '37E5', 0, '2', '2017-05-04 09:34:10', '2017-05-04 09:34:10'),
(65, 48, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000290:01', '37E5', 0, '1', '2017-04-21 12:41:55', '2017-04-21 12:25:23'),
(66, 49, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000290:01', '37E5', 0, '1', '2017-04-21 11:27:16', '2017-04-19 13:06:53'),
(67, 50, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000675-01', '45G0', 0, '1', '2017-05-04 05:42:03', '2017-05-03 04:25:29'),
(68, 51, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000678-01', '45G0', 0, '3', '2017-05-04 07:35:08', '2017-05-04 07:34:38'),
(69, 52, 'TBA:', '1', '120', 'PKG', 'UNITS OF OLD AND USED DIGITAL MULTIFUNCTION DEVICE WITH ACCESSORIES', '38000.00', 'LB', '0', '103000680-01', '45G0', 0, '2', '2017-05-04 07:32:06', '2017-05-04 07:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE `order_tracking` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tracking_description` text NOT NULL,
  `third_party_status` varchar(255) NOT NULL,
  `third_party_status_date` datetime NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `zip` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `customer_signature` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`id`, `order_id`, `package_id`, `user_id`, `tracking_description`, `third_party_status`, `third_party_status_date`, `latitude`, `longitude`, `location`, `zip`, `city`, `state`, `country`, `status`, `customer_signature`, `created`, `modified`) VALUES
(1, 35, 45, 176, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 1, '', '2017-05-04 06:35:10', '2017-05-04 06:35:10'),
(2, 35, 45, 176, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '30.708438', '76.702034', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 1, '', '2017-05-04 06:35:24', '2017-05-04 06:35:24'),
(3, 35, 45, 176, 'Order has been drop off', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 2, '', '2017-05-04 06:35:39', '2017-05-04 06:35:39'),
(4, 35, 45, 176, 'Order has been delivered', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 4, 'YoSRKjXQfAsbXAt.jpg', '2017-05-04 06:35:57', '2017-05-04 06:35:57'),
(5, 10, 16, 226, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 1, '', '2017-05-04 06:39:10', '2017-05-04 06:39:10'),
(6, 10, 16, 226, 'Order has been drop off', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 2, '', '2017-05-04 06:50:51', '2017-05-04 06:50:51'),
(7, 10, 16, 226, 'Order has been delivered', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 4, 'z6nCPJQjOGDoMbE.jpg', '2017-05-04 06:51:16', '2017-05-04 06:51:16'),
(8, 51, 68, 1, 'Delivered', 'DL', '2017-04-01 00:00:00', '', '', 'ISTANBUL  Turkey', '', '', '', '', 0, '', '2017-05-04 07:35:08', '2017-05-04 07:35:08'),
(9, 51, 68, 1, 'On FedEx vehicle for delivery', 'OD', '2017-04-01 00:00:00', '', '', 'ISTANBUL  Turkey', '', '', '', '', 0, '', '2017-05-04 07:35:08', '2017-05-04 07:35:08'),
(10, 51, 68, 1, 'At local FedEx facility', 'AF', '2017-03-27 00:00:00', '', '', 'MARKHAM ON Canada', '', '', '', '', 0, '', '2017-05-04 07:35:08', '2017-05-04 07:35:08'),
(11, 1, 1, 176, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '30.708495', '76.702244', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 1, '', '2017-05-05 05:05:08', '2017-05-05 05:05:08'),
(12, 1, 1, 176, 'Order has been delivered', '', '0000-00-00 00:00:00', '30.708459', '76.702259', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 4, 'VrnsQl78G4CXwIw.jpg', '2017-05-05 05:05:47', '2017-05-05 05:05:47'),
(13, 25, 35, 173, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '30.708477', '76.702260', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 1, '', '2017-05-08 05:37:38', '2017-05-08 05:37:38'),
(14, 47, 64, 173, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '28.6544346', '77.16888', '76, Munshi Ram Sethi Marg, Block 22, West Patel Nagar, Patel Nagar, New Delhi, Delhi 110008, India', '110008', 'New Delhi', 'Delhi', 'India', 1, '', '2017-05-08 07:35:52', '2017-05-08 07:35:52'),
(15, 47, 64, 173, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '28.6544346', '77.16888', '76, Munshi Ram Sethi Marg, Block 22, West Patel Nagar, Patel Nagar, New Delhi, Delhi 110008, India', '110008', 'New Delhi', 'Delhi', 'India', 1, '', '2017-05-08 07:39:06', '2017-05-08 07:39:06'),
(16, 47, 64, 173, 'Order has been drop off', '', '0000-00-00 00:00:00', '30.7086032', '76.7020391', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 2, '', '2017-05-08 08:51:04', '2017-05-08 08:51:04'),
(17, 5, 6, 176, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 1, '', '2017-05-08 09:19:41', '2017-05-08 09:19:41'),
(18, 5, 6, 176, 'Order has been drop off', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 2, '', '2017-05-08 09:20:19', '2017-05-08 09:20:19'),
(19, 5, 6, 176, 'Order has been delivered', '', '0000-00-00 00:00:00', '30.7086614', '76.7021744', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 4, 'RAWdyVlEPA5xwzR.jpg', '2017-05-08 09:20:59', '2017-05-08 09:20:59'),
(20, 7, 10, 176, 'Order has been picked up from client location', '', '0000-00-00 00:00:00', '30.708438', '76.702034', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 1, '', '2017-05-08 09:46:42', '2017-05-08 09:46:42'),
(21, 7, 10, 176, 'Order has been drop off', '', '0000-00-00 00:00:00', '30.708438', '76.702034', 'E-37, Phase 8, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab 160071, India', '160071', 'SAS Nagar', 'Punjab', 'India', 2, '', '2017-05-08 09:47:29', '2017-05-08 09:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `role`, `status`) VALUES
(1, 'super_admin', 'Super Admin', 1),
(2, 'staff_member', 'Staff Member', 1),
(3, 'agent', 'Agent', 1),
(4, 'driver', 'Driver', 1),
(5, 'customer', 'Customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `view` int(11) NOT NULL,
  `add_edit` int(11) NOT NULL,
  `delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `site_owner_email` varchar(255) NOT NULL,
  `new_user_notification_email` varchar(255) NOT NULL,
  `input_text_limit` varchar(255) NOT NULL,
  `otp_message` text NOT NULL,
  `login_message` text NOT NULL,
  `fedex_access_key` varchar(255) NOT NULL,
  `fedex_password` varchar(255) NOT NULL,
  `fedex_account_number` varchar(255) NOT NULL,
  `fedex_meter_number` varchar(255) NOT NULL,
  `ups_access_code` varchar(255) NOT NULL,
  `ups_user_id` varchar(255) NOT NULL,
  `ups_password` varchar(255) NOT NULL,
  `twilio_sid` varchar(255) NOT NULL,
  `twilio_auth_token` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_owner_email`, `new_user_notification_email`, `input_text_limit`, `otp_message`, `login_message`, `fedex_access_key`, `fedex_password`, `fedex_account_number`, `fedex_meter_number`, `ups_access_code`, `ups_user_id`, `ups_password`, `twilio_sid`, `twilio_auth_token`, `created`) VALUES
(1, 'Sky2C Freight Systems Inc', 'info@sky2c.com', 'info@sky2c.com', '70', 'You have initiated for reset password on sky2c that needs an OTP. Never share it with anyone.The OTP is ', 'as login OTP. OTP is confidential. Sky2c never calls you asking for OTP. Never share it with anyone.', 'ZB8OKnGiWQyu8EYX', 'e9iM0wntdwpSbNdNhUBEfQSz6', '510087720', '118778822', '2D21A7373710C2C8', 'Sky2C38503', 'Newark@325', 'ACd0c204ac545cca1d7efc1eff31853ff0', '3c9521eafac2b68a697a67ee484a0298', '2017-05-08 11:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_carriers`
--

CREATE TABLE `shipping_carriers` (
  `id` int(11) NOT NULL,
  `carrier_name` enum('fedex','ups','dhl','yrc','estes') NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country_code` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_carriers`
--

INSERT INTO `shipping_carriers` (`id`, `carrier_name`, `phone`, `country_code`, `status`, `created`, `modified`) VALUES
(1, 'fedex', '9998885550', 91, 1, '2017-04-12 10:20:34', '2017-04-12 10:20:34'),
(2, 'ups', '4521789630', 1, 1, '2017-04-04 12:10:49', '2017-03-30 06:33:55'),
(3, 'dhl', '5556664440', 1, 1, '2017-04-04 12:10:51', '2017-03-28 08:49:42'),
(4, 'yrc', '8523697410', 1, 1, '2017-04-04 12:10:54', '2017-03-30 06:35:52'),
(5, 'estes', '8523697411', 1, 1, '2017-04-13 09:32:00', '2017-04-13 09:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE `smtp_settings` (
  `id` int(11) NOT NULL,
  `from_email` text NOT NULL,
  `from_name` text NOT NULL,
  `smtp_port` text NOT NULL,
  `smtp_secure` text NOT NULL,
  `smtp_auth` text NOT NULL,
  `smtp_host` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smtp_settings`
--

INSERT INTO `smtp_settings` (`id`, `from_email`, `from_name`, `smtp_port`, `smtp_secure`, `smtp_auth`, `smtp_host`, `username`, `password`, `created`) VALUES
(1, 'rahul.jain@mobilyte.com', 'Sky2c Frieght Systems Inc', '587', 'TLS', 'Yes', 'smtp.gmail.com', 'betasoftsystems.dummy@gmail.com', '@Password12', '2016-11-02 00:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `title` enum('Open','Assigned','Unassigned','Completed','Active','Inactive') NOT NULL,
  `use_for` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `title`, `use_for`) VALUES
(1, 'Open', 'order'),
(2, 'Assigned', 'order'),
(3, 'Unassigned', 'order'),
(4, 'Completed', 'order'),
(5, 'Active', 'common'),
(6, 'Inactive', 'common');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `descartes_customer_id` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `is_verified` tinyint(2) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `new_pass_key` varchar(255) NOT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `forgot_password_limit_exceeded` tinyint(2) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `country_code` varchar(255) NOT NULL,
  `OTP` varchar(255) DEFAULT NULL,
  `otp_requested` datetime DEFAULT NULL,
  `otp_limit_exceeded` int(11) NOT NULL DEFAULT '0',
  `profile_image` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `is_approved` tinyint(4) NOT NULL DEFAULT '0',
  `agreement_accept` enum('0','1') NOT NULL COMMENT '1="Accept", 0 = "Not Accepted Yet" ',
  `last_login` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `descartes_customer_id`, `parent_id`, `role`, `name`, `username`, `email`, `is_verified`, `password`, `new_pass_key`, `new_password_requested`, `forgot_password_limit_exceeded`, `phone`, `country_code`, `OTP`, `otp_requested`, `otp_limit_exceeded`, `profile_image`, `status`, `is_approved`, `agreement_accept`, `last_login`, `created`, `modified`) VALUES
(1, '', 0, '1', 'Rahul Jain', 'admin', 'rahul.jain@mobilyte.com', 0, '$2y$10$KuKp1Z7HnCpQ1MKI6RYfhulqwRlG2RsfZVutyGC4Q04OtYir1kI5y', 'be8b6b837e6ac9b6c6b043b2ced891ee', '2017-04-07 04:26:30', 0, '1234010101', '0', '', NULL, 0, 'btrTBrxshZD3ocl.png', 1, 0, '0', '2017-02-07 00:00:00', '2017-02-08 00:00:00', '2017-04-14 04:51:04'),
(40, '', 1, '2', 'Skycstaff', 'Staff', 'staff@yopmail.com', 0, '$2y$10$vuxou6LIQI1yHHWKPowNheBVgwyHsEioMple5PyCFqlz9o0MddYQ.', '', NULL, 0, '9874563210', '+91', NULL, NULL, 0, 'TG4OxG8uTt8mS4l.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-17 15:20:00', '2017-05-03 05:00:21'),
(38, '', 1, '3', 'Sky2C Agent', 'agent1', 'agent@yopmail.com', 0, '$2y$10$hLQeRSRlJ7izRy4h/QyGYOAMj2cNm7Ia4xvU2metZorTO8jiKuplO', '271079', '2017-03-07 05:10:33', 1, '1234567890', '0', '123456', '2017-03-02 05:57:02', 0, 'leC8sPZ27mZU22z.jpg', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-17 15:16:06', '2017-03-07 05:10:09'),
(39, '', 1, '4', 'Sky2C Driver', 'driver', 'driver@yopmail.com', 0, '$2y$10$hErBH5j1BgcNsPAhNzl6puvCzqGZNQPGrCihUESeJO3T0Rp2ej3ci', '', NULL, 0, '1234564560', '0', '123456', '2017-03-20 04:59:32', 0, 'cYqzcDCoojoOMYI.jpg', 1, 1, '0', '0000-00-00 00:00:00', '2017-02-17 15:18:52', '2017-03-29 07:29:09'),
(41, '', 1, '5', 'rajni', 'raj32', 'rajni@yopmail.com', 0, '$2y$10$CUb4Co2ZDnzJay2UGq1ZF.GX/HIrcECDKS2I9gb16hqlDHA3PqAKu', '', NULL, 0, '5478977877', '7', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-20 06:25:14', '2017-05-08 09:42:59'),
(43, '', 1, '3', 'vinod change', 'vinodchange', 'agent_vinod@yopmail.com', 0, '$2y$10$pHehkmPcC7hup6ssIKbH/OnZ60pIkKIvNkTSZCPOvG3FyWJgYLzua', '', NULL, 0, '3214569630', '91', NULL, NULL, 0, 'D8glexR1hEx2cFJ.jpg', 1, 1, '1', '0000-00-00 00:00:00', '2017-02-21 10:54:40', '2017-03-24 12:10:06'),
(44, '', 1, '2', 'Rhonda Townsend', 'ligal', 'yoyo@yopmail.com', 0, '$2y$10$kDVb6MK2smC4U5GKjST7luqD5HpITi4WZz2Qo3SydZusU4Uu7BxVK', '', NULL, 0, '3845532144', '1684', NULL, NULL, 0, 'tqlP608bVfaCkZk.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-21 12:10:48', '2017-02-21 12:10:48'),
(45, '', 43, '4', 'kitu', 'kite', 'kerry@yopmail.com', 0, '$2y$10$EJ8U5xeEKUbLa0.HtNonGuYbXx8zIq9qh5DtaMDOYfj3jLvHmDaPK', '', NULL, 0, '6987744444', '65', NULL, NULL, 0, 'YLMhQE4SumfPl7r.jpeg', 1, 1, '0', '0000-00-00 00:00:00', '2017-02-22 04:32:21', '2017-03-21 11:14:24'),
(46, '', 43, '4', 'Tyrone Mcknight', 'bycod', 'pele@yopmail.com', 0, '$2y$10$d5gqfW76w7ly7kAUS5QI.uImEwbSu1FpgUTc6ed9/yXz5nsedHpdm', '417284', '2017-02-23 11:56:22', 0, '5675987357', '590', '123456', '2017-02-23 09:45:26', 0, '6r9xVIATF2t2jRq.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:44:42', '2017-03-10 09:42:44'),
(47, '', 43, '4', 'Oliver Larsen', 'fuzecaju', 'sony@yopmail.com', 0, '$2y$10$bjyiGZ.E2cqAs4WnXrGrpuXcJudN2xYCmTgOHNvAFFLGnZTsDCBbi', '114739', '2017-02-23 11:44:13', 0, '2928064918', '298', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:46:04', '2017-02-23 11:44:13'),
(48, '', 43, '4', 'Montana Hale', 'tytiqif', 'jerry@yopmail.com', 0, '$2y$10$qrhd5rpPqpwqbJaYrxnWbuHLNcOgwTlNnGeUUkeez1TDYVbFZIK9y', '', NULL, 0, '7877633862', '58', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:47:01', '2017-03-16 09:06:40'),
(49, '', 43, '4', 'Scarlett Pennington', 'tihinefaw', 'scarlet@yopmail.com', 0, '$2y$10$AfujjA9t5ubpnvPqgUS7KOOHqMWigTJ7y.VTFPzHs7fRmELhnuOAu', '', NULL, 0, '5775616220', '61', '123456', '2017-02-23 10:48:51', 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:48:04', '2017-02-22 04:48:04'),
(50, '', 43, '4', 'Genevieve Warner', 'fozofijox', 'raj12@yopmail.com', 0, '$2y$10$Cj44/sVd6tGqA7mTm.xTNuLg2D/dUrrztfgNLwKm9qOzLG8Vm8L6q', '', NULL, 0, '1377620488', '503', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:48:58', '2017-03-10 07:52:20'),
(51, '', 43, '4', 'Zenia Barron', 'sogibacik', 'zeny@yopmail.com', 0, '$2y$10$O03b9EfyiqzbsG0WS3FwOurcQXXYOuI6vzRyC9BuVS2TaZlS7s4aC', '', NULL, 0, '4524545454', '968', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:50:09', '2017-02-22 04:50:09'),
(52, '', 43, '4', 'Quin Cotton', 'pucahywyh', 'Quick@yopmail.com', 0, '$2y$10$q9SadNLwSUGP0Je5wVSsmuabaffEupHPJm7iFNdtGeYFh99n2HM5u', '', NULL, 0, '3454778774', '387', '123456', '2017-02-23 09:42:30', 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:51:21', '2017-02-22 04:51:21'),
(53, '', 43, '4', 'Miriam Fields', 'qitavyfiw', 'henry@yopmail.com', 0, '$2y$10$K4TiOIUlbLhqXqPmrAxBdu1OgdWfHxmW2BN7ceZZJhbEtbMTlo0cu', '', NULL, 0, '9672893016', '966', NULL, NULL, 0, '', 0, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:52:42', '2017-03-14 05:40:16'),
(54, '', 43, '4', 'jery', 'hemru', 'jerry1@yopmail.com', 0, '$2y$10$3McGEvfDsE/CPxW7bBLAaufe1tY1NPdQfqELO4cgR.V.LBrnR5EG2', '', NULL, 0, '1654646646', '0', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:54:47', '2017-03-24 06:13:56'),
(55, '', 43, '4', 'Nita Carrillo', 'zebyvipe', 'beta@yopmail.com', 0, '$2y$10$qaaBGOzU4.iZc3GVfjCH9uluEcxqstIkbPciauV8IJrcowCi4FIn.', '', NULL, 0, '7877633861', '376', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:56:01', '2017-03-24 06:14:16'),
(56, '', 43, '4', 'Cassady Hawkins', 'rifegog', 'ashish@yopmail.com', 0, '$2y$10$Fzuvo.EbyA0MtjhAPTOjZeSQHd/WcDw8U6uWBGJxQ0HnQGYMxnCn6', '', NULL, 0, '1353632663', '963', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 04:58:02', '2017-02-22 04:58:02'),
(57, '', 43, '4', 'Byron Ballard', 'sovexyj', 'samsy@yopmail.com', 0, '$2y$10$G40rfCDfIrICFHnPRs4/2OZK7wP4/b6QW19y.tnhPqf2Ac./Rldx2', '', NULL, 0, '9139713678', '55', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 05:02:10', '2017-02-22 05:02:10'),
(58, '', 43, '4', 'Zenia Barlow', 'jykudomip', 'teddy@yopmail.com', 0, '$2y$10$X/Q6gTEbPYh8V2bXALNBVeV0w1nONm8fJYdTY06CqmjdrOXnQb9UW', '', NULL, 0, '2237386925', '47', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 05:02:54', '2017-02-22 05:02:54'),
(59, '', 1, '3', 'Cara Lancaster', 'qaviqy', 'qatesterdummy@gmail.com', 0, '$2y$10$PzQz6LDWoxIiDZG2Jvwln.5wpg8Nw1RexzU3gDnxTJAO.9VHC0PXu', '', NULL, 0, '4465454544', '297', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 06:44:25', '2017-02-22 06:44:25'),
(60, '', 1, '2', 'Griffin Camacho', 'tefynecaq', 'baby@yopmail.com', 0, '$2y$10$CyTe5uCyNfa.5/4RFizZAuq4ufiUSKWPwWtmqzQpXGxkHGeVgqUfe', '', NULL, 0, '3434344444', '960', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 06:45:42', '2017-02-22 06:45:42'),
(61, '', 1, '2', 'Tana Fischer', 'qijupeq', 'firstname.lastname@yopmail.com', 0, '$2y$10$fa2Uh8lIeKTOpCiAF/DT3.tTw0eJ.zIK81pSpL4pWsRvH12XeA2wO', '', NULL, 0, '5655454444', '34', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 06:50:21', '2017-03-27 04:16:32'),
(62, '', 1, '2', 'Maia Blackwell', 'liwosobyji', 'email@anual.yopmail.com', 0, '$2y$10$OKaxvJankiOOHx5TTjjX5.7fYzj5EG7nTA3UhwP7YQjnPrQE/0ieu', '', NULL, 0, '4564644454', '86', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 06:51:57', '2017-02-22 06:51:57'),
(63, '', 1, '3', 'Keegan Huffman', 'zelyb', 'savy@yopmail.com', 0, '$2y$10$pCWOO2mXHnty8ONqdwWf6OoA7QsgMI5Og2HN0G9ci822BvrAXbFzS', '', NULL, 0, '4344444444', '228', '123456', '2017-02-23 11:51:04', 0, 'K9N23SY5K1i4k0z.png', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-22 06:54:24', '2017-03-03 09:42:03'),
(64, '', 1, '3', 'Ursula Moran', 'cugubevu', 'qaserver@yopmail.com', 0, '$2y$10$kr7hOz2.HrupSkcjMC0ofeHJfzuGpB2svtpel4m/UBUwooeHsMR4C', '', NULL, 0, '2142545454', '34', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 06:55:19', '2017-02-22 06:55:19'),
(65, '', 1, '3', 'Blair Lamb', 'wopov', 'sulad@yopmail.com', 0, '$2y$10$jSdWz09.T9IvzgZcAk1rouGKavPhi6u3CkXXjMdA/RMnzp7fyi5cC', '', NULL, 0, '5775676577', '995', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 06:55:44', '2017-02-22 06:55:44'),
(66, '', 1, '3', 'Dalton Maynard', 'qutirekel', 'safi@yopmail.com', 0, '$2y$10$1ayase4znNZCU3jIWBiWieG1MDTwGKkFMb29mEZ5Rac5YBccIH.dS', '', NULL, 0, '4646465444', '386', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-22 06:56:18', '2017-02-23 08:59:39'),
(67, '', 1, '3', 'asd', 'asd', 'asd@yopmail.com', 0, '$2y$10$UkRHzHdXjS.ljE9buDB.4.Hy2EzHhyG1LDablgtfxxFVar36hkCKO', '672897', '2017-02-23 09:18:29', 0, '1234567895', '227', '123456', '2017-02-23 09:19:30', 1, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-22 09:12:29', '2017-02-23 09:18:29'),
(69, '', 1, '2', 'Staff', 'test', 'sudheer.reddy@mobilyte.com', 0, '$2y$10$2xcrN57inelAmQG1PA0lpuP3EdmX0b1bk8KSGCy6h10NnwkWTuGY6', '', NULL, 0, '7799496699', '49', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 10:52:54', '2017-02-23 06:12:52'),
(68, '', 1, '4', 'asdf', 'asdf', 'asdf@yopmail.com', 0, '$2y$10$2oQuJAgVG2G6plrTvGQYfe1zGXjfivg2NM4fCTX6MPRrLGswCSHTq', '', NULL, 0, '9463060488', '227', '123456', '2017-02-22 09:20:30', 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 09:16:32', '2017-04-11 04:46:25'),
(70, '', 1, '3', 'agent', 'agenttest', 'dudekula.rajak@mobilyte.com', 0, '$2y$10$HbEX6lUk6YrDncuej2iuBeIMnXfZItWTwPofiY8Myvzx9.ZaJrWI2', '', NULL, 0, '1234567899', '1', NULL, NULL, 0, '96BJellbYOQY6P5.jpg', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-22 11:13:56', '2017-02-23 06:25:27'),
(71, '', 1, '4', 'Minerva Daniels', 'raquqor', 'gyla@yopmail.com', 0, '$2y$10$sJtRkcrVklSxYDwJ0CILweBeWgfpttPao0pWRKe6dmQw72SopS5EG', '', NULL, 0, '4444444252', '357', '123456', '2017-02-23 11:03:19', 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 11:19:50', '2017-02-22 11:19:50'),
(72, '', 1, '4', 'test', 'driver2', 'test@gmail.com', 0, '$2y$10$aoZEuUgmLaRgtKBzz0Ty3.xBMdWKgatu/lkFW1awr3BdhM2mrF54C', '', NULL, 0, '3214567890', '0', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 12:05:56', '2017-02-22 12:05:56'),
(73, '', 1, '4', 'test', 'driver21', 'test123@gmail.com', 0, '$2y$10$2SgzmC6C0FKc/7QqQ428b.KP3l.KX1YGXmd4IxxSAimOtuN04SN9u', '', NULL, 0, '3214067890', '0', '123456', '2017-02-23 10:56:29', 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 12:06:29', '2017-02-22 12:06:29'),
(74, '', 1, '3', 'Nomlanga Hatfield', 'pusufifuk', 'cujigiryve@hotmail.com', 0, '$2y$10$AL9xE.jVIfWBcf9A6ocgv.NhkLRy1qKFQN6pYLEoL.Jn8ozLynUXa', '', NULL, 0, '4646747474', '1767', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 12:06:42', '2017-02-22 12:06:42'),
(75, '', 1, '4', 'test', 'test2', 'test2@gmail.com', 0, '$2y$10$Vpt7PS.1kTIXzGhtuo9OjeG5pij2XVZUd8nCC1Jo3DhU/J3OigRRC', '', NULL, 0, '8907654321', '0', '123456', '2017-02-23 10:54:57', 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-22 12:29:07', '2017-02-22 12:29:07'),
(78, '', 1, '4', 'Sukant Sharma', 'Sukant', 'sukant@mobilyte.com', 0, '$2y$10$1bJY4c.CwDC7O26Z6U4Jm.oYc0vhc2NQXOhlM0be554wEIFK2zLMC', '', NULL, 0, '9872749463', '91', NULL, NULL, 0, 'qUdNi3y5E1VToUK.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-23 13:40:27', '2017-03-02 11:02:52'),
(76, '', 1, '3', 'Ginger Lopez', 'qidocuca', 'fiku@yopmail.com', 0, '$2y$10$A5v9Ij1e6NCPwlNOrlBk0e3lN3Q6XQID4St5as2aDP4qcIgqZUInK', '', NULL, 0, '4454545454', '1784', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-23 10:52:00', '2017-02-23 10:52:00'),
(77, '', 1, '3', 'Sky2C Agent', 'agent', 'agent12@yopmail.com', 0, '$2y$10$2KK7aAYI0jZr.9gDqcBh9ez8QVZrc48R49ZRn9O7iAzB6ktarevLu', '123456', '2017-02-23 11:48:53', 0, '1234567812', '0', '123456', '2017-02-23 11:48:53', 0, 'leC8sPZ27mZU22z.jpg', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-17 15:16:06', '2017-03-02 09:05:14'),
(79, '', 1, '3', 'Paula Johns', 'hevaco', 'pola@yopmail.com', 0, '$2y$10$Nu1LYarY0fUBMLvSb.Ut8.WzEcgdEwVujtI6zPlvbG1JxD6OmDE8O', '', NULL, 0, '4564545545', '252', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-28 05:10:11', '2017-02-28 09:04:47'),
(80, '', 1, '3', 'Rylee Foreman', 'fysymega', 'sami@yopmail.com', 0, '$2y$10$pbHH3a7sLPvdeyjwDIVyZOmWoqzXk/E0DQ9iUXNZ3CKcXETnFsb0q', '', NULL, 0, '4654454545', '972', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-28 05:11:46', '2017-02-28 05:11:46'),
(81, '', 1, '3', 'Breanna Owens', 'lypykufu', 'vubo@yopmail.com', 0, '$2y$10$jwbcib4TtIEPBQAjw6klbedC1y1.KboxzPPyta.9e6CHV5w8XYiRS', '', NULL, 0, '5554454544', '95', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-28 05:16:43', '2017-02-28 05:16:43'),
(82, '', 1, '3', 'Priscilla Washington', 'lynom', 'ripa@yopmail.com', 0, '$2y$10$hNOs4WRVDom9.EKYQKxTJeO3lmrMdMTurJLX2nMDFFsjcCfoCfore', '', NULL, 0, '7777444444', '504', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-28 05:17:50', '2017-02-28 05:17:50'),
(83, '', 1, '3', 'Howard Hudson', 'celesyzi', 'dipu@yopmail.com', 0, '$2y$10$MuNlET3uIA0oOFmV03GUMuYkBWO5VfUQ18snQOSnte6MOrsnbMrtW', '', NULL, 0, '5455457444', '30', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-28 05:18:33', '2017-02-28 05:18:33'),
(84, '', 1, '3', 'Montana Melton', 'jijuq', 'judu@yopmail.com', 0, '$2y$10$X6I5buUXEp91zu5tyBIOWOiguVZtOojBL3bETf8qaduouw9R4f1zy', '', NULL, 0, '5545454444', '1809', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-28 05:19:24', '2017-02-28 05:19:24'),
(85, '', 1, '3', 'Rajah Patton', 'haxyqo', 'lufo@yopmail.com', 0, '$2y$10$r5wmLyxeUNq1k04JI.OQZ.IFhi5PrSaybdURcC1Yf6g6Jk9OzpJGW', '', NULL, 0, '5456465444', '251', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-28 05:21:01', '2017-02-28 06:37:45'),
(86, '', 1, '3', 'Lael Wall', 'pylil', 'zawi@yopmail.com', 0, '$2y$10$uHTO2V/hiOUQwJjO7WLRlui3oPiOaU6hmjR173fE6cSDEdCaWcdTC', '', NULL, 0, '7657575745', '43', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-28 05:22:00', '2017-04-07 11:13:23'),
(87, '', 1, '3', 'Hall Avila', 'fuparer', 'dengu@yopmail.com', 0, '$2y$10$NR7lJBsmsSWxlP1B1j3zhOvl4OmKf71YFnLpbqW6yC3OovH24BKIu', '', NULL, 0, '4797747777', '500', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-02-28 05:22:46', '2017-03-06 11:00:34'),
(88, '', 1, '3', 'Mannix Wood', 'peqipef', 'sala@yopmail.com', 0, '$2y$10$6ZrfjyEHZFRYTNNQPTsUvO.Qd7QbCY1LVzMD7xFfBa8p4ksIxHSwO', '', NULL, 0, '7845877777', '1767', NULL, NULL, 0, 'l2uOECH3nbWCwco.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-28 05:24:02', '2017-03-20 07:58:34'),
(89, '', 1, '2', 'Paula Beach', 'hocamijugu', 'lily@yopmail.com', 0, '$2y$10$BLcIyAmqCPVBCnSMUZrzT.tJUSnoKKeWutfvGo9mNSVPye.Z.xf.q', '', NULL, 0, '6455454444', '299', NULL, NULL, 0, '3IzfqUgdNVTUxUv.png', 1, 0, '0', '0000-00-00 00:00:00', '2017-02-28 11:24:19', '2017-03-02 11:33:05'),
(90, '', 38, '4', 'Rashad Pollard', 'zozykolum', 'qafybezyh@gmail.com', 0, '$2y$10$KeJC4k0gZeI7qMWzQ4cfleYNZOW4Hbu8UKHDvoV.2DmUBahOmKvP2', '', NULL, 0, '4555555555', '224', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-01 05:26:00', '2017-03-01 05:26:00'),
(91, '', 1, '3', 'New Agent1hh', 'newagenthehheh', 'newagent@yopmail.com', 0, '$2y$10$Rn9NUVF3TojMii8d.S7cf.r7cZX1HA80uZBFfCsTG/NfMgLTHdjeK', '', NULL, 0, '1233211235', '+91', NULL, NULL, 0, 'RTxsrSftbnN1po0.jpg', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-03 06:49:01', '2017-03-27 04:21:24'),
(92, '', 1, '2', 'Idona Kline', 'xusotazaly', 'jomobegoti@hotmail.com', 0, '$2y$10$pUzkS2s.TshRhfVvLmLKeuP2AYeAELVhknNLEAocSFhcR3Tun.Iu.', '', NULL, 0, '6591031793', '20', NULL, NULL, 0, 'FAkZYXdrNZfUxEA.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-03 13:00:41', '2017-03-03 13:00:41'),
(93, '', 1, '2', 'Lev Hinton', 'debufojomy', 'hii@yopmail.com', 0, '$2y$10$XCkfPAEKsnyLmG6fFotCUei80sKWMo2/BhTXef2okaWqHSDDHpNnS', '', NULL, 0, '5454545445', '1809', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-03 13:01:22', '2017-03-03 13:01:22'),
(94, '', 1, '4', 'Ferris Lynch', 'libuwyg', 'xuri@hotmail.com', 0, '$2y$10$0PFM4CuscCwIzJmLlbWLuOai7tp0NF28DYY0ZWVoDHcnet.4qv4Ge', '', NULL, 0, '2647385092', '1664', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-06 04:40:36', '2017-03-06 04:40:36'),
(95, '', 1, '2', 'Phoebe Huber', 'didaqunoma', 'demo@yopmail.com', 0, '$2y$10$YQAeAAstT0U4XBAV2WNIj.09BL7I6FroRgt4cA.mRlXCO7/1r/e6a', '', NULL, 0, '5879054969', '967', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-06 05:07:14', '2017-03-06 05:07:14'),
(96, '', 1, '2', 'Jane Tate', 'mihopusaf', 'public@yopmail.com', 0, '$2y$10$WkRljTOTw5lA7MknxWQscOSk8j3i0yWjKLisl524BOY1HFi3Ox11m', '', NULL, 0, '9428298026', '291', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-06 06:22:52', '2017-03-06 10:52:56'),
(97, '', 1, '3', 'Maryam Elliott', 'ciqibilyq', 'zojaqivev@yahoo.com', 0, '$2y$10$sOUZXdISYuWImXPFsCHyyuCDWWKQpodruDfCaRLeVw5gmKccw/.DW', '', NULL, 0, '4836354838', '234', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-06 07:24:48', '2017-03-06 07:24:48'),
(98, '', 1, '3', 'fsdfsdf', 'sdfsdfsdf', 'sdfsdfsdfs@sdasdas.com', 0, '$2y$10$iWvb3HIf//.4T0JkouQxV.2iUwWMAjVWFhLWwMmJg0r0YFZzBAh7i', '', NULL, 0, '1231231235', '0', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-06 07:26:16', '2017-03-06 07:26:16'),
(99, '', 1, '4', 'ddd', 'jerry', 'jerry2@yopmail.com', 0, '$2y$10$5d.zbxnxZJz0ZWd8QKlmxOPgHAM/cbpr3EgmbALJxwj8WWHxKmvYm', '', NULL, 0, '6987777798', '44', NULL, NULL, 0, '', 1, 1, '0', '0000-00-00 00:00:00', '2017-03-06 07:50:56', '2017-04-11 04:58:57'),
(100, '', 1, '2', 'Mollie Delacruz', 'rerubawug', 'wygo@hotmail.com', 0, '$2y$10$cft0/igyRuJEBd/fVONWCuyI4AV5XksfYDN7.qEeL0i37CjY22i1W', '', NULL, 0, '9993788466', '27', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-06 08:55:58', '2017-03-06 08:55:58'),
(101, '', 1, '3', 'Funsuk Vangdu', 'funsuk', 'funsuk@yopmail.com', 0, '$2y$10$BpwORyoFf1JlS52IpV/jIuGw7ZmvucWSaSv9uu0HXK.7tiTJ1bhhi', '', NULL, 0, '0154145887', '233', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-06 11:36:11', '2017-03-06 11:37:53'),
(102, '', 1, '4', 'Donald Trump', 'donald', 'donald@yopmail.com', 0, '$2y$10$jPFkWdvuVbNDrB4FqU9qy.tSPZY2RExLZJMxJxofNx7ZqNgPzjZ3i', '', NULL, 0, '0714585474', '267', NULL, NULL, 0, '', 1, 1, '0', '0000-00-00 00:00:00', '2017-03-07 05:42:42', '2017-04-11 05:26:31'),
(103, '', 1, '4', 'Jescie Burns', 'bizaty', 'puhecuhy@hotmail.com', 0, '$2y$10$8hxVPhZU0R50gsEvCuJviuazTHGZ6U/fg2fOj3DZBTA7Cl0Gv5mSq', '', NULL, 0, '2547444444', '70', NULL, NULL, 0, 'dhZLl1CCiXkFX43.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-07 05:44:21', '2017-03-07 05:44:21'),
(104, '', 1, '4', 'Piper Hester', 'tokomuq', 'ripu@yopmail.com', 0, '$2y$10$x4Qqm4c5sBCqNPivwWRrEOJ44/Y.CJUkwbR5IPiYAF0/SQcDeRLjO', '', NULL, 0, '6446464644', '251', NULL, NULL, 0, 'FEcrlyNLfBUROYX.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-07 05:45:22', '2017-03-07 05:45:22'),
(105, '', 1, '4', 'Laura Gill', 'tepewutixu', 'barak@yopmail.com', 0, '$2y$10$RKlz67Sz8hws0K7fuLcmzOoUl/1P12g084jJxH.AGkJdmMgTLKdyS', '', NULL, 0, '6354321451', '596', NULL, NULL, 0, 'k04fpIpnljeerjC.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-07 05:48:52', '2017-03-08 04:46:00'),
(106, '', 101, '4', 'Ramesh babu', 'ramesh', 'ramesh@yopmail.com', 0, '$2y$10$.DiO6uXRC/M..3pv/zfSg.HMqT5YWzAbBn7VNRBP6mKxJPlCBnmPS', '', NULL, 0, '0718548965', '229', NULL, NULL, 0, '', 0, 0, '0', '0000-00-00 00:00:00', '2017-03-07 07:46:08', '2017-03-07 08:07:08'),
(107, '', 1, '4', 'Hanae Bryant', 'wuwanyzid', 'xulo@gmail.com', 0, '$2y$10$VdU2rNpe1L3lTjiiRIaWoemCeuf8WcBO8Ew1L9IH95PHPQmvafImy', '', NULL, 0, '1425225222', '380', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-08 04:28:38', '2017-03-08 04:28:38'),
(108, '', 1, '4', 'Jolie Morgan', 'putekac', 'paguqubumi@hotmail.com', 0, '$2y$10$jRET41UPPAUa3OWcp5NGAOUvXJcK4TuRlPG..cU2Ip6yHACyEgqFO', '', NULL, 0, '2147744444', '1', NULL, NULL, 0, 'CsEVC4aZNrbnSKj.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-08 04:48:39', '2017-03-08 04:48:39'),
(109, '', 1, '4', 'Kirestin Watts', 'ticyn', 'qi@yopmail.com', 0, '$2y$10$Sw2X6l9RGfn318vW5MCyiONPQKV/ha9tY.tnYCBBlOUnPGgjmySDa', '', NULL, 0, '2356544454', '853', NULL, NULL, 0, 'CsdEcCmLYfpZiu4.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-08 04:50:18', '2017-03-08 04:50:18'),
(110, '', 38, '4', 'App driver', 'appdriver', 'appdriver@yopmail.com', 0, '$2y$10$Znv9LkSRt2LT6APd8Yeate54.ROiLWrA7Et.ve1tIKI9uNZCzIA3m', '', NULL, 0, '3845532140', '1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-08 06:42:59', '2017-03-08 06:42:59'),
(120, '', 43, '4', 'ft yh', 'xxx', 'qw@y.com', 0, '$2y$10$C3eZWbvv2E7wwwKH0mwI3OamPAAn/QKyjHUsJwZfRCfO.QOcY/1Fu', '', NULL, 0, '1234567855', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 09:23:31', '2017-03-10 09:23:31'),
(121, '', 43, '4', 'App nd', 'mmmhg', 'apk@yopmail.com', 0, '$2y$10$f.ouZ.XspZZUu9es27WgGuC4rqlx4MI2WqXxx6qrNgDfLrCqF2QwS', '', NULL, 0, '6592536623', '1', NULL, NULL, 0, 'NyDfskmuGRxmLR5.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 09:32:32', '2017-03-10 09:32:32'),
(122, '', 43, '4', 'tttttt', 'tttyyyy', 'ccc@gmail.com', 0, '$2y$10$veE6Vj0QMgvGRLDip/2Niu9cWUKPnTw9qZ8ozeMVhz.9z5071FFqm', '', NULL, 0, '9625835545', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 09:40:38', '2017-03-10 09:40:38'),
(114, '', 38, '4', 'App driver', 'appdrivser', 'appdrivesr@yopmail.com', 0, '$2y$10$bcmFq6NA7/95P4mK8zjameIXwoA9EJdyCyqkIOK9s2G2rPT7.iH1y', '', NULL, 0, '3845532155', '1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 07:29:07', '2017-03-10 07:29:07'),
(123, '', 43, '4', 'Alka ', ' Rai', 'alka@gmail.com', 0, '$2y$10$A85aa9N8NYqJ.60KZlMQcuSvZJ8ZjxfnI1RCMRIHiKP45zrxOqpny', '', NULL, 0, '1111111111', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 09:54:03', '2017-03-10 09:54:03'),
(124, '', 43, '4', 'hh', 'bbx', 'ff@gmail.com', 0, '$2y$10$GNG7WDn9Qo02USVgyP/biOP7xNLlOlVaFLOsJkZ7XJvdBRPlUWapC', '', NULL, 0, '6523698527', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 10:49:33', '2017-03-10 10:49:33'),
(125, '', 43, '4', 'ghhhjjhjj', 'cghj', 'ash@gmail.com', 0, '$2y$10$lb0V/Qz.EFzMYtlf9pZC0uy7vkAZzTpESV2Fgi..PPy3cfloqZ472', '', NULL, 0, '5369583369', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 10:51:40', '2017-03-24 10:24:02'),
(126, '', 43, '4', 'yy', 'hh', 'fg@gmail.com', 0, '$2y$10$ZLHqEUpB7YbHXH5nRHygO.CTWxfYb8sIg6hpjQpSjQaaYgfoT1/.G', '', NULL, 0, '5369853369', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 10:59:36', '2017-03-10 10:59:36'),
(127, '', 43, '4', 'gy', 'gh', 'gg@gmail.com', 0, '$2y$10$qu5quv6VvQtye4M1zhDxx.uSG1IyANI4hCpuOlpyPD.Ls4zX52XDy', '', NULL, 0, '4258369852', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 11:05:51', '2017-03-10 11:05:51'),
(128, '', 43, '4', 'App ndsdsd', 'mmmhssg', 'apksds@yopmail.com', 0, '$2y$10$ARl5CCZqGHTRvk7DiANLX.6t0RaXEtbh0G59fBcrVcY11WZGFetkq', '', NULL, 0, '6592536628', '1', NULL, NULL, 0, 'HhpFs6ulVbpm9FB.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 11:09:10', '2017-03-10 11:09:10'),
(129, '', 43, '4', 'gdh', 'dhhd', 'ss@gmail.com', 0, '$2y$10$etLbyymrM.cfTRagyWpdjuDuDMdr3qVWjpR42/Y9gffr2vmmAhXP6', '', NULL, 0, '5236985569', '91', NULL, NULL, 0, 'VME8HilB9bqxswl.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 11:14:08', '2017-03-10 11:14:08'),
(130, '', 43, '4', 'nj', 'nn', 'dff@gmail.com', 0, '$2y$10$66y7iDxeRXbq4HIB5ORii.KYDwvhTUHF1HC5FsOAW1MxHy1EF9F8C', '', NULL, 0, '8569856698', '91', NULL, NULL, 0, 'PDGuRw7AxItTs6l.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 11:17:28', '2017-03-10 11:17:28'),
(131, '', 43, '4', 'yg', 'gg', 'dd@gmail.com', 0, '$2y$10$6xNw9MHmU5hdyBqRxJ1S8.wT8wuNmJO2lJrWzZhMZC7Y84tTELrIC', '', NULL, 0, '5236985546', '91', NULL, NULL, 0, 'ixbQg2XYviUwxhL.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 11:18:44', '2017-03-10 11:18:44'),
(132, '', 43, '4', 'hh', 'jj', 'ddf@gmail.com', 0, '$2y$10$66kcBRu0jUccHdAH/zESx.YncAo1H9ittTcEW8XlqkIciJpmPr/ua', '', NULL, 0, '3569825546', '91', NULL, NULL, 0, 'IFBYXUfzUyRZv7r.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 11:25:31', '2017-03-10 11:25:31'),
(133, '', 43, '4', 'Amanpal', 'stylishh', 'stylish@yopmail.com', 0, '$2y$10$Szf4qVjZXBjVYwFPBKRpxeoMbVl/ehaLCEf6S8E/aIagANoHkTcxq', '', NULL, 0, '9875478555', '10', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 13:31:08', '2017-03-10 13:31:08'),
(134, '', 43, '4', 'rahaj', 'ajsdja', 'asdbha@yopmail.com', 0, '$2y$10$O1tD0we1WqFyOCnvyN3y6eBuHIfL7hRFwDfIZhz6b4yD1OrUKT9eG', '', NULL, 0, '5612123123', '10', NULL, NULL, 0, '9Ngs5RRI7qh0Sgl.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 13:48:49', '2017-03-10 13:48:49'),
(135, '', 43, '4', 'adsad', 'asdsa', 'asdsa@yopmail.com', 0, '$2y$10$DhUPT5Dwrh30y6keWvBkQegMkItP8bscYGb4Fq1fyry.M7t059H0S', '', NULL, 0, '1189489616', '10', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 13:53:02', '2017-03-10 13:53:02'),
(136, '', 43, '4', 'adasdas', 'asdasdasdareter', 'asdasjk@yopmail.com', 0, '$2y$10$QPmteSqqS31AqsR8ZVCzdex8K1vuU6vYTUgcUX/yNHRL05YCbJtlm', '', NULL, 0, '7897981212', '10', NULL, NULL, 0, 'fqfclq4CcG7c8CA.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-10 13:54:07', '2017-03-10 13:54:07'),
(137, '', 43, '4', 'driveriOS', 'iOSD', 'iosdriver@yopmail.com', 0, '$2y$10$hgVn39kqOaBeR77GkD.joO4OIRNx4g04PoLaCl/0DMNR1pb9i6Bfa', '', NULL, 0, '0987654321', '+55', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-14 07:07:13', '2017-03-14 07:07:13'),
(138, '', 1, '3', 'mali1', 'mali', 'mali@yopmail.com', 0, '$2y$10$3x4dRiS04Y1fiW04b5tbC.UUgYfBticU4KnZgCa7Y.OECN5A.4cqW', '351112', '2017-03-24 10:43:27', 0, '3214787960', '91', NULL, NULL, 0, 'LBlRJCStpMWVPWY.png', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-15 06:12:14', '2017-03-29 07:26:46'),
(140, '', 43, '4', 'marchD', 'Drivermarch', 'march@yopmail.com', 0, '$2y$10$LuVNYz.V7/nKkp4VumIVUO9xjRwy51sUzskLu4WAb2rIFljkvjaVS', '', NULL, 0, '8888888888', '+1 264', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-15 06:54:57', '2017-03-15 06:54:57'),
(139, '', 1, '4', 'Sloane Morgan', 'domuw', 'mali2@yopmail.com', 0, '$2y$10$gEqENeY5GNHZCJya02zNUOWM4CiPMlWirW9uTZi3Dytbfr47Q9JtW', '', NULL, 0, '5744544444', '269', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-15 06:31:50', '2017-03-15 06:31:50'),
(141, '', 43, '4', 'malika', 'maloka', 'mallika@yopmail.com', 0, '$2y$10$GPdOP10ln3fKf3VY1V3ySOtn5ymbKHon9UULlOADy.jhvsWIqspYG', '', NULL, 0, '9494949499', '+1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-16 09:06:01', '2017-03-24 06:35:57'),
(142, '', 43, '4', 'Harpreet', 'happy', 'happie@yopmail.com', 0, '$2y$10$9PyqsRc0iRLIiZTOmJYXLeP4QxeR38LVsmjxwQfuv2SGcHSpefgIe', '', NULL, 0, '4561237890', '+1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-16 13:00:27', '2017-03-21 07:36:48'),
(143, '', 1, '3', 'Odette Mayer', 'rubeheb', 'den@yopmail.com', 0, '$2y$10$1oTMj83COvnrlxpzWJtV7O0Nh6fGcaOOcApohL8tyi0Z4D.yQ.K.y', '', NULL, 0, '5478777777', '7', NULL, NULL, 0, 'JubvSjctnUUCl5h.jpg', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-20 05:17:54', '2017-03-23 07:25:03'),
(144, '', 1, '2', 'Idola Velasquez', 'nysugol', 'piga@yopmail.com', 0, '$2y$10$fRduYK60Q8AmBBOa3Xl3leXoIoSvXO.FGNuWT51xJXPohZ2p3kpim', '', NULL, 0, '5444744447', '599', NULL, NULL, 0, 'dPYvalv6SnoXNIC.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-20 05:21:40', '2017-03-20 05:21:40'),
(145, '', 43, '4', 'Seth Trevino', 'qikyni', 'gippy@yopmail.com', 0, '$2y$10$eY/0CTOl0cS.6E/T4apcW.4uhhdof8V6y4GBYLiBBYPsp2w7CQdkq', '', NULL, 0, '5455544444', '257', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-20 05:47:59', '2017-03-20 05:47:59'),
(146, '', 1, '2', 'Perry Emerson', 'huvecibah', 'perry@yopmail.com', 0, '$2y$10$q.N4PkQnbpWyAI74gsmpZ.jkq77p11DrsfusCvsgXDWxDhdSiED3q', '', NULL, 0, '5412569877', '232', NULL, NULL, 0, 'NruVMsOhTIu0b8k.png', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-20 05:55:06', '2017-03-20 05:55:06'),
(147, '', 1, '3', 'Phillip Ramos', 'sutubisedi', 'phillip@yopmail.com', 0, '$2y$10$h0E2RTAsqhTTV4umYSq0ieZSSuZCk9FX9rWEDS/x82LEkgmhL/Nru', '', NULL, 0, '5415874542', '34', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-20 06:13:37', '2017-03-23 09:08:01'),
(148, '', 1, '3', 'Sydnee Walton', 'guryxaq', 'kitu@yopmail.com', 0, '$2y$10$I.gAygZFkx30A6LrMyHJ7.XWTwM0QQOxy4muWt7GCVazIpKOIeuZ6', '', NULL, 0, '4556645444', '263', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-20 07:55:16', '2017-03-20 07:55:16'),
(149, '', 1, '3', 'Shana Kaufman', 'heguheto', 'shana@yopmail.com', 0, '$2y$10$k4s0kkHbm4YS6wEmyG/YleCI4mcmjj5/gZe36ljRb4QNGWI4MQWxm', '', NULL, 0, '5478548965', '354', NULL, NULL, 0, 'Mk5F9Q7g18ne5lW.png', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-20 09:25:40', '2017-03-20 09:27:02'),
(150, '', 1, '3', 'Miranda Garrett', 'kohakeza', 'miranda@yopmail.com', 0, '$2y$10$7M3.yuYo0/XwkcGLVYYQ9eWd94R7PcL6ZkdTQwl6vxvbGS8/uMRqy', '', NULL, 0, '8547458745', '299', NULL, NULL, 0, 'AcpPkaWOQreOIbb.png', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-20 09:28:17', '2017-03-20 09:29:12'),
(151, '', 1, '4', 'Cynthia Hunterrr', 'dupele', 'swati@yopmail.com', 0, '$2y$10$tsXtfAeLoZRHXAciGcsslOuPzzd4D/o6RvOkJ.wtPIXjQX3dvoLly', '', NULL, 0, '5478787878', '248', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-22 06:00:52', '2017-03-22 06:00:52'),
(152, 'GLOCOP01', 0, '5', 'henry', 'GLOCOP01', 'vikashj@yopmail.com', 0, '$2y$10$TSSLdWOE/7LIt5PKfY4FKefeiPQ9rdETtZb/F3EOZQrwEh0oFV0dO', '', NULL, 0, '9658748484', 'AQ', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-23 05:43:52', '2017-05-08 09:52:28'),
(153, '', 138, '4', 'jungle', 'book', 'jun@yopmail.com', 0, '$2y$10$FaV6F6HBk0v94fxLLCUp3.t6nmbW31I5sCbrI.uI.J2o0NwdE8P0m', '', NULL, 0, '6451245544', '+46', NULL, NULL, 0, 'zi11lEach3Hki0h.jpg', 0, 1, '0', '0000-00-00 00:00:00', '2017-03-23 06:52:12', '2017-03-24 10:42:11'),
(154, '', 138, '4', 'navi', 'narinder', 'navi@yopmail.com', 0, '$2y$10$/AcY538r7ODP9YFLX8qCzuz6e7MiievNJwECz8.tapW3QmPdzX4aq', '', NULL, 0, '3121554545', '+46', NULL, NULL, 0, '', 0, 0, '0', '0000-00-00 00:00:00', '2017-03-23 06:55:36', '2017-03-23 12:06:22'),
(155, '', 0, '4', 'av', 'va', 'uv@yopmail.com', 0, '$2y$10$6StSc4mXzPVm1IKdtssFPOsEKrvCArlhW8hJj0ISUIfLY5ZdKSQz.', '', NULL, 0, '5412444441', '+376', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-23 07:26:35', '2017-03-23 07:26:35'),
(156, '', 138, '4', 'mani', 'mn', 'mani@yopmail.com', 0, '$2y$10$iTywGZehJk35cMO0.YqEQOAqrVHFo0Bf6hCSDbGfT.u71CzOHkH2y', '', NULL, 0, '8541424142', '+376', NULL, NULL, 0, 'wH3omCmay3k48VA.jpg', 1, 1, '0', '0000-00-00 00:00:00', '2017-03-23 09:15:06', '2017-03-29 07:30:16'),
(157, '', 138, '4', 'acer', 'aser', 'krit@yopmail.com', 0, '$2y$10$Wfuze4HBy5TvVPEn8umtHe6VQSI2jzx1yoMaK/Ej/qhC/iapd776a', '', NULL, 0, '6524224444', '+46', NULL, NULL, 0, 'OETHxdHMZz878P4.jpg', 1, 1, '0', '0000-00-00 00:00:00', '2017-03-23 12:19:08', '2017-03-29 07:30:11'),
(158, '', 43, '4', 'mohnish', 'singh', 'mohnish@gmail.com', 0, '$2y$10$jcFTMEVz1wMiQqFA.1YGh.s/HGjZxFLQkj2S7D32e.HYUQdeUP.Fy', '', NULL, 0, '9815835597', '+46', '123456', '2017-03-24 06:20:36', 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-24 06:18:16', '2017-03-24 06:18:16'),
(159, '', 43, '4', 'ali', 'sinhs', 'ddsinhs@yopmail.com', 0, '$2y$10$rayb0Z8Qja0mF.qZvwH4XejLKx5vsAl17CmvLOxXwdCJ4offjt.cq', '', NULL, 0, '9635689258', '+91', NULL, NULL, 0, '', 0, 0, '0', '0000-00-00 00:00:00', '2017-03-24 06:32:50', '2017-03-24 06:33:53'),
(160, '', 91, '4', 'Allegra Cameron', 'xityjisuh', 'victor@yopmail.com', 0, '$2y$10$LY1lpCA23c.z9ZpwD7..NeUouf/E55rvHvelS9I22Jc65oO0LP4/6', '', NULL, 0, '5475745777', '975', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-24 11:22:42', '2017-03-24 11:22:42'),
(161, '', 91, '4', 'Blair Battle', 'rugurecy', 'goli@yopmail.com', 0, '$2y$10$V5AnkOOcst6oOFN/a2pqEujf2d3M.RpcqeRo.VfXi1IPlGySBxLdy', '', NULL, 0, '6287454544', '226', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-24 11:23:22', '2017-03-24 14:11:10'),
(162, '', 91, '4', 'gelly', 'gio', 'gelly@yopmail.com', 0, '$2y$10$Boflx../lZRWgUb9v5tCrOThdixOywvIiYmM4v2T7HJk93NtV7ZF.', '', NULL, 0, '6524142244', '+46', NULL, NULL, 0, 'pUjKkf8hChVdWaM.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-24 12:11:13', '2017-03-24 12:11:13'),
(163, '', 1, '2', 'kritika', 'sachin3', 'kritika.kanotra6@yopmail.com', 0, '$2y$10$jkyURlHSBj4rTJ9LSGZs4ee1whppq5UrFqweAG3KVY2hPf2lQBY/6', '', NULL, 0, '5878974812', '0', NULL, NULL, 0, '7COlAdNCEvYNpOm.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 07:57:58', '2017-03-27 07:57:58'),
(164, '', 1, '2', 'kritika', 'sachin36', 'kritika.kanotra66@yopmail.com', 0, '$2y$10$iZxcOME7b4mfxtxpIM2qXeoCYAon5diRANGv/VfFKEKyYJpnYDEr6', '', NULL, 0, '5878974813', '0', NULL, NULL, 0, 'Dv0iJz1ibSjl9PD.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 08:03:52', '2017-03-27 08:03:52'),
(165, '', 1, '2', 'Aurora Mayer', 'duridop', 'bywu@gmail.com', 0, '$2y$10$O2mnQEc4b.Dr9Va3G.HEt.l2GoIxOi3.MrA6ffgMagSwbggnkUZui', '', NULL, 0, '5454546544', '57', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 08:04:53', '2017-03-27 08:04:53'),
(166, '', 1, '2', 'Warren Marquez', 'wapozuno', 'joly@gmail.com', 0, '$2y$10$ViB4Woyu2p/IQclbdC0xM.VWubmOhT0nDtr7q9oTTvqE2U9RrTd06', '', NULL, 0, '8784848487', '853', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 10:55:58', '2017-03-27 10:55:58'),
(167, '', 1, '2', 'Cally Burks', 'bejesuvase', 'joly@yopmail.com', 0, '$2y$10$pQv3EvVsnYmjlPwk5EQGbuUOPwG1Ig7qPHLtljwp2udy73/FkgKcC', '', NULL, 0, '6325644564', '232', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 10:56:35', '2017-03-27 10:56:35'),
(168, '', 1, '2', 'Echo Lopez', 'sycylu', 'zavi@yopmail.com', 0, '$2y$10$Z4D6AHd3SCqYRwvOeMTskOBVu1bjytgU1LDSvyRcL6Lq4QvzI6ZSu', '', NULL, 0, '4787877777', '221', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 10:57:13', '2017-03-27 10:57:13'),
(169, '', 1, '3', 'Quyn Skinner', 'husebe', 'rynoxoqid@gmail.com', 0, '$2y$10$pN0UvJFLI7rORQehS0PQsesa1nPydeB0UaHNkQXnFZzJFSmsE9/DO', '', NULL, 0, '6987487447', '596', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 10:57:45', '2017-03-27 10:57:45'),
(170, '', 1, '4', 'Celeste Hardin', 'reposi', 'jonusyry@yahoo.com', 0, '$2y$10$8eKVOqyP3Jbzpj2vLFPEN.C18CZWN9tEKFgPUxo6BKwunwwo/PQby', '', NULL, 0, '3654788778', '255', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 10:58:10', '2017-03-27 10:58:10'),
(171, '', 1, '2', 'Zorita Boone', 'cimacoquk', 'vozysyfahy@hotmail.com', 0, '$2y$10$.hiNBPTPfozi9kYzoStpxeI881BGWWXasbuVryWPU521k6D6Fcv.K', '', NULL, 0, '9787878787', '242', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 10:59:49', '2017-03-27 10:59:49'),
(172, '', 1, '3', 'Steel Pruitt', 'sakuleva', 'mew@yopmail.com', 0, '$2y$10$tVqXDtqpqcwABY9qNDv.je7hzW/itlYVX4.LFngOsFWKptIZ550eO', '', NULL, 0, '6987488484', '298', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 11:01:26', '2017-03-27 11:01:26'),
(173, '', 1, '3', 'Zeke', 'Zeke Agent', 'zeke@yopmail.com', 0, '$2y$10$cfs9pl4aoRN/9QAgpbWVr.ME3N4KupCa5h2NaKGHvG6o9qiKFXlF.', '210069', '2017-04-11 11:03:08', 0, '9888069373', '+91', NULL, NULL, 0, '7u4h7gxfF5EFwQl.jpg', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-27 11:03:45', '2017-05-05 05:07:59'),
(174, '', 173, '4', 'Cherokee Gill', 'pohykuva', 'wega@yopmail.com', 0, '$2y$10$sBlfYIPzVwe/6ssXAjaHD.QyZ/e2epPSwO2Rwwm1tvbY04FtUD/Eq', '', NULL, 0, '9674147474', '964', NULL, NULL, 0, 'HdKPo80MqrVZOmg.png', 1, 1, '0', '0000-00-00 00:00:00', '2017-03-27 11:13:07', '2017-04-12 12:24:45'),
(175, '', 1, '2', 'sam', 'simran', 'sam@yopmail.com', 0, '$2y$10$G1cS4cCzmrWgHB3wj/3Aiu8buv8NtNU8h5P.bGD1lbiSy3PM19w02', '', NULL, 0, '9888495200', '0', NULL, NULL, 0, '20WWBt9IJkeK4BM.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-03-27 14:58:00', '2017-04-03 06:06:00'),
(176, '', 173, '4', 'Wifi', 'Wifi', 'wifi@yopmail.com', 0, '$2y$10$taEqIQ7nqb2pxChgZHA6aea6YjoNvcK1j7ogBJSLR5jLcV8FZvKqe', '4c1f7a20a191a783cf8225012340199e', '2017-03-28 06:41:17', 0, '9896098962', '+91', '123456', '2017-04-10 12:03:08', 0, '5kCXMRuJu8uMcyt.jpg', 1, 1, '0', '0000-00-00 00:00:00', '2017-03-28 06:38:38', '2017-05-05 05:14:48'),
(177, '', 1, '3', 'Dheeraj', 'dheerajg', 'dheerajg@yopmail.com', 0, '$2y$10$QFqjsJujo.Pw3w5vTus2pOyBjoDRRx1ivUvZX3ZIpPl8LrkT36xvO', '', NULL, 0, '9888069737', '91', NULL, NULL, 0, 'oTIfbyq41fiESO7.png', 1, 0, '1', '0000-00-00 00:00:00', '2017-03-28 09:52:23', '2017-03-28 09:53:09'),
(178, '', 177, '4', 'bharti', 'bhartis', 'bhartis@yopmail.com', 0, '$2y$10$lmDJlrb9Y6XyaqnVUF.BHuz4xg8R9Dx9Yy1BUbSyLq6DhG..sumYS', '', NULL, 0, '9995551110', '91', NULL, NULL, 0, '', 1, 1, '0', '0000-00-00 00:00:00', '2017-03-28 10:00:30', '2017-03-28 10:11:15'),
(179, '', 76, '4', 'Jain Saab', 'jainsaab', 'jainsaab@yopmail.com', 0, '$2y$10$M094sYoN0xTA/K0BiNY2heO2oZs4XBV/GhuMNkEQ3U57Y0eJEwwqO', '', NULL, 0, '8885554447', '1', NULL, NULL, 0, '3JbZzaSKBBidOzy.jpg', 1, 1, '0', '0000-00-00 00:00:00', '2017-04-03 05:08:40', '2017-04-03 05:16:11'),
(180, '', 1, '2', 'lovelesh', 'love', 'love@yopmail.com', 0, '$2y$10$a2CBD8sOpXFplh8rwoABfOTY/r7Qv7sVVQqt8wvivROkwyn86Le0C', '', NULL, 0, '6574577544', '0', NULL, NULL, 0, 'lnAMLvogAv8Bvfv.png', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-03 06:48:38', '2017-04-03 06:48:38'),
(181, '', 1, '2', 'Dheeraj', 'dheeraj19', 'dheeraj.gaur@mobilyte1.com', 0, '$2y$10$f2X2WFLGmbquRDIUb3Pn5OiybrOC1oc.XfSnHbVmVDGAM6bS81x3e', '', NULL, 0, '7086015255', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-05 10:35:55', '2017-04-07 04:47:41'),
(182, '', 1, '2', 'Dheeraj', 'dheeraj191', 'dheeraj.gaur@mobilyte.com', 0, '$2y$10$pjnDYmnkEL/2VmBsE6wnL..q9ZCWosvrhE2bya6.y.nf51CvZeRZG', '188238', '2017-04-05 10:58:53', 0, '7086015256', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-05 10:50:23', '2017-04-05 10:58:53'),
(183, '', 1, '2', 'Happy', 'Singh1', 'happy@yopmail.com', 0, '$2y$10$8c5nx3JqSQcjmRE7CTaA9eYaE.TjJg.eHCDKd8DT0qyvYuptPrGOO', '', NULL, 0, '0000000000', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-05 11:23:08', '2017-04-06 09:00:44'),
(184, '', 173, '4', 'Mr Jain', 'tingu', 'tan@yopmail.com', 0, '$2y$10$YxTEIF13jX5ewA/JcD71Eun3mhLthnoxtAfnb7T3HxgsPuTMVd80O', '', NULL, 0, '6524142424', '+46', NULL, NULL, 0, 'catQySpS2KJeVzV.png', 1, 1, '0', '0000-00-00 00:00:00', '2017-04-06 07:45:40', '2017-04-21 11:46:51'),
(190, '', 173, '4', 'Buckminster Alvarado', 'salu1', 'salman@yopmail.com', 0, '$2y$10$uvzwPF6XIYIRIW6VlGTia.Y3fhs6Qdxz.88YBLPUKOQhI.k2e.9jK', '', NULL, 0, '2544444444', '27', NULL, NULL, 0, '', 1, 1, '0', '0000-00-00 00:00:00', '2017-04-11 06:04:43', '2017-04-12 12:24:57'),
(185, '', 1, '2', 'hello', 'jelly1', 'jelly@yopmail.com', 0, '$2y$10$Zf9K7/86wFCUlTTvybn19ezNiGLaM/zlLtxC9Q4JGzNymN2/tfnti', '', NULL, 0, '9687458745', '20', NULL, NULL, 0, '9uhEy6hGppfseo9.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-07 04:05:57', '2017-04-13 09:59:41'),
(186, '', 1, '3', 'Wynne Riggs', 'vicky1', 'vicky@yopmail.com', 0, '$2y$10$jh5weh3nW94y.xiYwUVL5uC8e1cP28OP2jzBAD8AHl/HazzzG/AiW', '', NULL, 0, '6587487444', '1441', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-04-07 04:13:14', '2017-04-07 04:16:32'),
(187, '', 1, '4', ' Day', 'nicky1', 'nicky@yopmail.com', 0, '$2y$10$r0TheeUFlYkMwe/6CA.MFuxyEB1Z7g.lDP1eU3RDSY0cB16ZuXui2', '', NULL, 0, '6457847745', '375', NULL, NULL, 0, '', 1, 1, '0', '0000-00-00 00:00:00', '2017-04-07 04:14:46', '2017-04-12 07:37:56'),
(188, '', 186, '4', 'Chloe Delgado', 'micky1', 'micky@yopmail.com', 0, '$2y$10$I1z5GA0NMaU4qhbyvTkl/e7OIFWIVH8ugirvWJ.7jXXE9DFhlAN1.', '', NULL, 0, '6587477554', '995', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-07 04:17:10', '2017-04-07 04:17:59'),
(189, '', 1, '3', 'alka', 'ralkr', 'alka1@yopmail.com', 0, '$2y$10$xK3QCcWHAlcSsS8SR8QmYubSoFno92.6a0.XyBeSuKxaBCE/Q9BUy', '', NULL, 0, '9999999999', '91', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-04-07 06:01:41', '2017-04-07 06:02:35'),
(191, '', 1, '2', 'Hyder Gowher', 'HYDTEST', 'sky2cusa@gmail.com', 0, '$2y$10$3D2BYHxy3zc66Qb4xQigvuhk2J1FiPLIDVQ5IGB9Jlz./y3LcXali', '', NULL, 0, '5106730910', '1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-12 23:33:43', '2017-04-12 23:33:43'),
(192, '', 1, '3', 'Anil Tandon', 'aniltest', 'anil@sky2c.com', 0, '$2y$10$3NTCLvZBLMioWsE.QppRjOARS4l.oDqxRwXrqNsZb84i/HGCGA3i2', '', NULL, 0, '5106735806', '1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-12 23:40:49', '2017-04-12 23:40:49'),
(193, '', 1, '3', 'Tarun ', 'tarun1', 'tarun@sky2c.com', 0, '$2y$10$y5QCWaeYdmtsSN87VzhjUOFBDakvRHidqtsv2UBsRZV0rzQZoVzgi', '', NULL, 0, '5106730911', '1', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-04-12 23:53:31', '2017-04-12 23:53:31'),
(194, '', 193, '4', 'Tarun', 'tarun', 'nikhil.samdani@mobilyte.com', 0, '$2y$10$ftdDk/b4Sh7qQdoVfltwne3TXPHcmgBhQxnM26c2f/xhfYlRMLIye', '', NULL, 0, '4089105780', '1', '123456', '2017-04-13 00:31:03', 0, '', 1, 1, '0', '0000-00-00 00:00:00', '2017-04-13 00:28:24', '2017-04-13 00:39:05'),
(195, '', 1, '4', 'Hyder', 'Hyd', 'hyder.gowher@gmail.com', 0, '$2y$10$szWy1qz6jnJUQFqztMgOKuiYzEArOoOLvcAxReb0EWrFz9Q79CGFS', '', NULL, 0, '5103727350', '1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-13 01:44:26', '2017-04-13 01:44:26'),
(196, '', 1, '4', 'rahul', 'rahul1', 'Rahul@yopmail.com', 0, '$2y$10$qoNe088FBIOFO9iJatymzefi2uE7J6200ca3UXeqFLYjkduPv2Cde', '', NULL, 0, '6464446544', '964', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-18 09:28:57', '2017-04-18 09:30:01'),
(197, '', 1, '4', 'rich', 'richa', 'richa@yopmail.com', 0, '$2y$10$XExwR7FsKITBakcsvWTaRO/BlH7Lc9BBZaTOBShfFRe9ZN6YDINfa', '', NULL, 0, '5557878578', '971', NULL, NULL, 0, '', 1, 1, '0', '0000-00-00 00:00:00', '2017-04-18 09:31:01', '2017-04-18 09:36:45'),
(198, '', 1, '3', 'sa', 'simran1', 'sam2@yopmail.com', 0, '$2y$10$1NBfyzGG6hNPUQsYEr1WEOv5E2mwlvZ4HJrsHYxBmLP/vzAKn0e8i', '', NULL, 0, '9474587845', '1', NULL, NULL, 0, 'GSn6x25iWm6PwnW.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 07:42:02', '2017-04-19 07:42:02'),
(199, '', 1, '3', 'Macey Mccall', 'dytuk', 'xopuz@yahoo.com', 0, '$2y$10$z7dXNH61B5acXOelPWhJIOBGl7orVkTbXeYQUWq8cfbbOlNNtPsbm', '', NULL, 0, '5666666666', '1340', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 09:28:13', '2017-04-19 09:28:13'),
(200, '', 1, '3', 'juie', 'imran7', 'sao@yopmail.com', 0, '$2y$10$DUo3Yrtqq6SSRpqbO8Wcy.dxRUvgR/w0vOk9bLxfMGJDhP4gtSAoe', '', NULL, 0, '9474587775', '1', NULL, NULL, 0, 'qvtHit0whdqUHpd.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 09:34:25', '2017-04-19 09:34:25'),
(201, '', 1, '3', 'uie', 'mran7', 'iuoo@yopmail.com', 0, '$2y$10$Dt1LAxJ4Rsu9qSVtLtSGduywR7Jx22JajQuDZ5dTYAhx.HPGiIq/6', '', NULL, 0, '9474587175', '1', NULL, NULL, 0, '5eiG2aJOUKcqvfZ.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 09:36:10', '2017-04-19 09:36:10'),
(202, '', 1, '3', 'ui', 'mra7', 'uoo@yopmail.com', 0, '$2y$10$YWyAZydbQY43SG27wNXyEu0p78ca1w1YH9n.3HNXu9kha8/m/38/q', '', NULL, 0, '9474587275', '1', NULL, NULL, 0, 'mcevIHCrtB8Vg2g.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 09:48:19', '2017-04-19 09:48:19'),
(203, '', 1, '3', 'uop', 'mrrt7', 'uop@yopmail.com', 0, '$2y$10$GxK2dedei9xRXm/TOqq5x.9XVnqySK9Is4boTIzF1bE.UJukgv5vu', '', NULL, 0, '9474587285', '1', NULL, NULL, 0, 'mLbE4Qn5GI6GwYr.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 09:53:06', '2017-04-19 09:53:06'),
(204, '', 1, '3', 'upop', 'mrrpt7', 'uopp@yopmail.com', 0, '$2y$10$Mlz/oNuvYl/b3EgQ0sfhuulXU5mcBmHknzGc6eFFA51mnrQIyKZnW', '', NULL, 0, '9474587215', '1', NULL, NULL, 0, 'P5fHksjmXd3a8zJ.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 09:58:06', '2017-04-19 09:58:06'),
(205, '', 1, '3', 'qeop', 'cdrpl7', 'opp@yopmail.com', 0, '$2y$10$x9u0QTVyPih9fj3yRIHlaeuMKIGWqJervBhPXNpvhr723vSabmS0S', '', NULL, 0, '8474587015', '1', NULL, NULL, 0, 'A4N6mnKoScEdmKB.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 10:21:55', '2017-04-19 10:21:55'),
(206, '', 1, '3', 'opo', 'cdrl7', 'oppo@yopmail.com', 0, '$2y$10$RBhPje/gv78tVKlfYTRVD.t.Ba.kKn3Ol8Mv3xy.EHuR.XYm6iikO', '', NULL, 0, '8574587015', '1', NULL, NULL, 0, 'dG7BYujj1UMhm6b.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 10:26:56', '2017-04-19 10:26:56'),
(207, '', 1, '4', 'uokp', 'mrkrt7', 'uopk@yopmail.com', 0, '$2y$10$DWsd.ZeZI6kaR2nQ9JFzE.rRDj/iJC4wnQ5hZLMhk.29IaUfFOZyK', '', NULL, 0, '9474587281', '1', NULL, NULL, 0, 'c2yymxCSt5HOdQF.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 10:27:27', '2017-04-19 10:27:27'),
(208, '', 173, '4', 'Autumn Patel', 'mogikenej', '', 0, '$2y$10$ZP8A2a11yaQFsBnJweRJMOH90lrktTEaXWieEmiTo9gK8uojJXtRi', '', NULL, 0, '6546465445', '505', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-19 11:34:07', '2017-05-05 08:07:29'),
(209, '', 1, '2', 'opiw', 'wdwl7', 'owppo1@yopmail.com', 0, '$2y$10$igGTAOpmCBVBAiIUXiLFgehzlHdi9/CeybcnHnMb8d917crUTKQAm', '', NULL, 0, '8274587015', '1', NULL, NULL, 0, 'ZkliHbwI05p6Mdt.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 05:37:01', '2017-04-20 05:37:01'),
(210, '', 1, '3', 'odpo', 'cddrl7', 'oppod@yopmail.com', 0, '$2y$10$oj0T9FjyUY8ii6RKWzfYP.8.57Hze.VwNY0nxvCvJ0DeBhbkk/0gW', '', NULL, 0, '8574387015', '1', NULL, NULL, 0, 'MXyxVUm66vD8Rb7.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 05:37:19', '2017-04-20 05:37:19'),
(211, '', 1, '4', 'duokp', 'drkrt7', 'copk@yopmail.com', 0, '$2y$10$IzVl0ITtp9P4HZIVkaTIxeOcsVJdeoZF7PWxk1MRhHYM34DZtzPp2', '', NULL, 0, '9374587281', '1', NULL, NULL, 0, 'kCK9H2Luq9galb7.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 05:37:36', '2017-04-20 05:37:36'),
(212, '', 1, '2', 'apiw', 'wzwl7', 'ewppo1@yopmail.com', 0, '$2y$10$JO..uLNlHpi.05xZMsZe4.BsVYESP9iGGT0fEkJwCepqlKjrXeak.', '', NULL, 0, '8254587015', '1', NULL, NULL, 0, 'cNq199JmDh2e64a.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 05:58:02', '2017-04-20 05:58:02'),
(213, '', 1, '3', 'dpo', 'ddrl7', 'ppod@yopmail.com', 0, '$2y$10$9hIK8vueqHjaGc3iz5oD.uWHkzZC2Cs0WNsdYmrs5nqGuJQPz6hJG', '', NULL, 0, '8514387015', '1', NULL, NULL, 0, 'kXhY8Y1LeRKcqXG.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 05:58:15', '2017-04-20 05:58:15'),
(214, '', 1, '4', 'uokp', 'dkrt7', 'oppk@yopmail.com', 0, '$2y$10$RgWyfdC4zM1HBXGyLjXrreP9s.KdEymfKx2MkINj0L/JEEEvs2lnK', '', NULL, 0, '9324587281', '1', NULL, NULL, 0, 'OJvccqm1xaYm2Ar.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 05:58:36', '2017-04-20 05:58:36'),
(215, '', 1, '2', 'amiw', 'wxzwl7', 'eppo1@yopmail.com', 0, '$2y$10$PFvG670mrXFlHO4rljTajeetP2xuTPzkuiQK.3M93F.Mw3G8PPwcC', '', NULL, 0, '8154587015', '1', NULL, NULL, 0, 'z8lvsJFLZ05qGIJ.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 06:01:17', '2017-04-20 06:01:17'),
(216, '', 1, '3', 'dp', 'ddl7', 'pod@yopmail.com', 0, '$2y$10$TbMKNXIkQavMtfg.6GfhVucT0n7xOzSYbvTJyAkN8udE3I2ADgqHG', '', NULL, 0, '8513387015', '1', NULL, NULL, 0, 'ocLlGJLEU7XuByj.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 06:01:36', '2017-04-20 06:01:36'),
(217, '', 1, '4', 'aokp', 'zkrt7', 'oxpk@yopmail.com', 0, '$2y$10$oxs0VrW.G/NCxiMHzqGbbumck/cl4yPbn31skejSUOwcGhsJCOaUe', '', NULL, 0, '9322587281', '1', NULL, NULL, 0, 'w9StHXHKyTh8uLS.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 06:01:56', '2017-04-20 06:01:56'),
(218, '', 1, '2', 'amin', 'wxzwl0', 'eopo1@yopmail.com', 0, '$2y$10$S3JyrbjiBBAamsQhhdqoFe5LRVrLk/.fnepZd0JH9NQtsBKb43YR2', '', NULL, 0, '9684587015', '1', NULL, NULL, 0, 'OSaZDyit7RrpQrx.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 06:06:30', '2017-04-20 06:06:30'),
(219, '', 1, '3', 'jp', 'dal7', 'pvad@yopmail.com', 0, '$2y$10$Gf.Hfe/Ch7VIjWtl04PvtO4Qhcfdca6cOKhPsNXPu5jss9fCNA8/K', '', NULL, 0, '8512387015', '1', NULL, NULL, 0, '8dXN7Cv8rZvAjsh.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 06:06:48', '2017-04-20 06:06:48'),
(220, '', 1, '4', 'lqkp', 'mart7', 'omak@yopmail.com', 0, '$2y$10$tqKwG/ru7Jei5UxR/SPvueco1VtWCoz0w56CXdKLkdut2jysoq3PG', '', NULL, 0, '9322580281', '1', NULL, NULL, 0, '18i6mL4pzGm22kj.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 06:07:16', '2017-04-20 06:07:16'),
(221, '', 1, '2', 'QAStaff', 'mann', 'mann@yopmail.com', 0, '$2y$10$2/NrI2ePz3oOrJgVtYzqyeC/I0EOY/LHAfcVGYFe2Nd8rWbYs3eu2', '', NULL, 0, '9826226688', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 07:50:07', '2017-04-20 07:50:07'),
(222, '', 1, '2', 'aamin', 'axzwl0', 'qopo1@yopmail.com', 0, '$2y$10$qQ1DLBjc1dveTvW4tFGtJec6.9GwDtHbnHjHiL.OwglnGITsHknz2', '', NULL, 0, '9284587015', '1', NULL, NULL, 0, 'GL5n75yEegxdjX3.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 09:57:46', '2017-04-20 09:57:46'),
(223, '', 1, '3', 'jap', 'adal7', 'pvaad@yopmail.com', 0, '$2y$10$h6SVDSWBduTgVyp13kIxX.AwYYE7kdfamFJZz27MRy/MxVH.3YUd.', '', NULL, 0, '8312387015', '1', NULL, NULL, 0, '1twYw3AqgxlE2pK.jpg', 1, 0, '1', '0000-00-00 00:00:00', '2017-04-20 09:58:06', '2017-05-01 05:38:45'),
(224, '', 1, '4', 'sqkp', 'smart7', 'omask@yopmail.com', 0, '$2y$10$OftQS/inTmgols7GUffyouucPdiCLqXIaR4Dn6gJLiwDLr1bhleH6', '', NULL, 0, '9322980281', '1', NULL, NULL, 0, 'JA64l0UEwI1o0hv.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 09:58:32', '2017-04-20 09:58:32'),
(225, '', 1, '2', 'qamin', 'qxzwl0', 'qqpo1@yopmail.com', 0, '$2y$10$NWa2uqnWiq1gPg1WNokMeO0obA/qRA200ex00.T70OUYxWX2Vwb82', '', NULL, 0, '9282587015', '1', NULL, NULL, 0, 'gh7P88QZhiu1ro4.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-04-20 10:23:10', '2017-04-20 10:23:10'),
(226, '', 1, '2', 'Kirk Anthony', 'Daisy', 'tani@yopmail.com', 0, '$2y$10$i7HuE0LK3RB5WKQqzfcTu./Lb5xXy0CzdJ/PFm9R1ohoktH89Kr2q', '', NULL, 0, '2222222222', '91', NULL, NULL, 0, 'vA7vFpuhS7MRLv3.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-01 05:32:29', '2017-05-08 10:39:29'),
(227, '', 1, '3', 'Jacob Tait', 'jacob', 'jacob@yopmail.com', 0, '$2y$10$Zw.np9AkXQeoDou1zmsfquxQDCiac3uyt/t58eqMW4AGonL2FvFhi', '', NULL, 0, '1233212312', '36', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-01 05:51:15', '2017-05-01 05:51:38');
INSERT INTO `users` (`id`, `descartes_customer_id`, `parent_id`, `role`, `name`, `username`, `email`, `is_verified`, `password`, `new_pass_key`, `new_password_requested`, `forgot_password_limit_exceeded`, `phone`, `country_code`, `OTP`, `otp_requested`, `otp_limit_exceeded`, `profile_image`, `status`, `is_approved`, `agreement_accept`, `last_login`, `created`, `modified`) VALUES
(229, '', 1, '2', 'Shayama', 'shayamaK', 'shayama@yopmail.com', 0, '$2y$10$WRunINc/SR14hK.CmsIfJeidXaJgT.hM5doalkBslzoQUNl1xMidG', '', NULL, 0, '8989898989', 'US', NULL, NULL, 0, 'a5fJKTMThDbDPnd.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 04:38:32', '2017-05-05 04:38:32'),
(228, '', 1, '3', 'Maya Barber', 'ricky', 'rick@yopmail.com', 0, '$2y$10$eJBQ4oKNTjwVs8bKlbnOTerFKb/N43fdQNYER1l7dZc1mv00ym2ki', '', NULL, 0, '5555555555', 'MY', NULL, NULL, 0, '', 1, 0, '1', '0000-00-00 00:00:00', '2017-05-03 06:08:31', '2017-05-03 06:08:31'),
(230, '', 1, '2', 'shyama', 'shyamaxyz', 'shyama@yopmail.com', 0, '$2y$10$i5rQimbwGE4lrwnvYem9U.3iiOyAT6GNAHE30HxLWfwc5geWMepGe', '', NULL, 0, '8989889898', 'US', NULL, NULL, 0, 'ftKuIGgGQpEh7Qp.jpg', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 04:39:59', '2017-05-05 04:39:59'),
(231, '', 173, '4', 'chh', 'df', '', 0, '$2y$10$/OZZ.fI9BQBCDTZzH9pcheGcXbKA/K4zXZOWvGY4g5nsn6KkzwrbK', '', NULL, 0, '8552422555', '+1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 10:44:53', '2017-05-05 10:44:53'),
(232, '', 173, '4', 'App driver12321', 'appdriver213', 'appdriv12er@yopmail.com', 0, '$2y$10$g3hchDkJuQwSTGJoMfQLPODeJgpX1IYq.mEpOKnphZ65ZnAQFiAVC', '', NULL, 0, '9781721456', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 10:49:13', '2017-05-05 10:49:13'),
(233, '', 173, '4', 'App driver12321', 'appdriver2123', '', 0, '$2y$10$D1jO62/UF3q1Ao79miJFUu2m7wYDpBP/gK8Fco3d.SXXMR.qH.Lq6', '', NULL, 0, '9781721453', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 10:49:49', '2017-05-05 10:49:49'),
(234, '', 173, '4', 'hehdhdhdhd', 'hdhdhdhdhdhd', '', 0, '$2y$10$9hxmNYZi1OyZvulotz2RI.HLt.Yqz6qFeJI/kZO7G/gTlak6cRCNm', '', NULL, 0, '9785421542', '+1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 12:25:32', '2017-05-05 12:25:32'),
(235, '', 173, '4', 'App drivers', 'appdrivers', 'gmail@yopmail.com', 0, '$2y$10$Wckwspp/WQ7wGL4DXCUdBe1W1ZmA31P6Uxy/HUGJNelsJxBSsn4iW', '', NULL, 0, '9998887772', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 12:27:34', '2017-05-05 12:27:34'),
(236, '', 173, '4', 'App driver12321', 'appdriver44', '', 0, '$2y$10$fIMcudHfsu.GteEfBpUMIO57i0MuPz1Xpe2pwFriKkWYhhXGiimwy', '', NULL, 0, '9787821453', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 12:31:55', '2017-05-05 12:31:55'),
(237, '', 173, '4', 'App drivers', 'appdriverss', '', 0, '$2y$10$2oKF9SPxbdacOMFrMZf/F.onYUXrVC06BUN.Z3Z5vF2a4X94YZaOC', '', NULL, 0, '9998887776', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 12:32:23', '2017-05-05 12:32:23'),
(238, '', 173, '4', 'App drivers', 'appdriveq', '', 0, '$2y$10$BdxHDPfI9PVbuSKevilDQek22o2MaYhXCrZlp3iICV8Ns7GgotqDC', '', NULL, 0, '9998887771', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 12:35:09', '2017-05-05 12:35:09'),
(239, '', 173, '4', 'App drivers', 'appdrivea', '', 0, '$2y$10$K7EQozmHZSzHsg8ZCknkbuQP3RgvRncfYNnuYJWxXhLISn3tqotN6', '', NULL, 0, '9998887732', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 12:36:32', '2017-05-05 12:36:32'),
(240, '', 173, '4', 'App drivers', 'appdrivvf', '', 0, '$2y$10$.eT2mUymzqw8WxNtjw5XAeeNqQ0.uwjpid98plU6Kc81xacIDBvAS', '', NULL, 0, '9998887785', '91', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 12:38:32', '2017-05-05 12:38:32'),
(241, '', 173, '4', 'gsgs', 'gahs', '', 0, '$2y$10$/6xPVz1LHXiDr6Gis9P/7.oWg5MdYeekOXF5WdXyqWT0EQ9KKwQB6', '', NULL, 0, '5104265198', '+1', NULL, NULL, 0, '', 1, 0, '0', '0000-00-00 00:00:00', '2017-05-05 12:39:25', '2017-05-05 12:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_title` varchar(255) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `scanned_image` varchar(255) NOT NULL,
  `expiary_date` date NOT NULL DEFAULT '0000-00-00',
  `issued_date` date NOT NULL DEFAULT '0000-00-00',
  `issued_by` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `document_title`, `document_number`, `scanned_image`, `expiary_date`, `issued_date`, `issued_by`, `status`, `created`, `modified`) VALUES
(30, 39, 'Voter cards', 'VOTER-INDIA-03', 'MKgV55euljW1QW6.png', '2017-03-25', '2017-03-21', 'Punjab Govtt', 0, '2017-03-22 12:21:31', '2017-03-22 12:33:09'),
(32, 39, 'Voter card', 'VOTER-INDIA-03', 'Tk7oTImH27teNwR.png', '2017-03-25', '2017-03-21', 'Punjab Govtt', 0, '2017-03-22 12:24:58', '2017-03-22 12:24:58'),
(38, 156, 'hsjjsjsjs', 'jsisizi1333', 'OqvgXQfLZAnpGAV.jpg', '2017-03-01', '2017-03-31', 'hsjsjsj', 0, '2017-03-23 11:05:58', '2017-03-23 12:39:26'),
(39, 157, 'ghjj', 'ghjjh67788', '', '2017-03-31', '2017-05-24', 'ghsj', 0, '2017-03-23 12:21:29', '2017-03-23 12:21:29'),
(41, 153, 'hjj', 'ghk', 'FYUe3dvmYcC0sJb.jpg', '2017-03-30', '2017-03-08', 'th', 0, '2017-03-24 10:13:08', '2017-03-24 10:13:08'),
(42, 161, 'ternary', '514774747474', 'X3Y98n6fFsFw4lk.jpg', '2017-03-15', '2015-07-07', 'dcdls', 0, '2017-03-24 11:35:16', '2017-03-24 11:35:16'),
(44, 174, 'LICENCE COPY', '45AGTWEG4454', 'phqn9IM4tPd1cki.png', '2033-03-21', '2015-06-07', 'ROHIT DTDC', 0, '2017-03-27 11:36:40', '2017-03-29 11:44:25'),
(46, 178, 'DL', 'IND2017789654123', '', '2017-03-28', '2017-03-08', 'Haryana', 0, '2017-03-28 10:01:22', '2017-03-28 10:01:22'),
(47, 179, 'DL', 'INDHAr145236', '', '2017-04-17', '2017-04-03', 'Haryana Govt', 0, '2017-04-03 05:13:01', '2017-04-03 05:13:01'),
(49, 184, 'driver licence', 'hr-1234567890', 'CQne104LsU4PyZB.png', '2020-04-06', '2017-02-05', 'haryana govtt', 0, '2017-04-06 09:37:50', '2017-04-06 09:37:50'),
(57, 188, 'Licence', '9', '380HIxIDj3vKE51.jpg', '2017-04-28', '1999-04-21', 'dlca', 0, '2017-04-07 04:20:24', '2017-04-07 04:20:37'),
(59, 176, 'iosCer', '45345terg', '', '2017-04-07', '2006-04-19', 'ss', 0, '2017-04-07 09:57:20', '2017-04-20 08:03:08'),
(60, 99, 'ferytt', '23144rfff', '', '2017-04-26', '2012-02-06', 'dldlsc', 0, '2017-04-11 04:55:39', '2017-04-11 04:55:39'),
(61, 102, 'fred', 'lois2133', '', '2015-04-06', '2004-01-06', 'bluedart', 0, '2017-04-11 05:04:08', '2017-04-11 05:04:08'),
(62, 190, 'sshakery', '364wd44', '', '2017-12-12', '2017-04-04', 'fff', 0, '2017-04-11 06:12:29', '2017-04-11 06:12:29'),
(63, 187, 'ww', '33eee', '', '2017-04-17', '2003-02-04', 'dd', 0, '2017-04-11 10:43:17', '2017-04-11 10:43:17'),
(64, 194, 'dl', '3456', 'pJyx78Pp5U4yS8x.jpg', '2017-05-10', '2015-04-12', 'sfo', 0, '2017-04-13 00:38:29', '2017-04-13 00:38:29'),
(65, 197, 'hero', 'h32637', '', '2017-04-11', '2008-04-15', 'bjdfgj', 0, '2017-04-18 09:34:05', '2017-04-18 09:34:05'),
(66, 176, 'abac', 'dfsdf', 'rnRwEo51Qg7lVX6.png', '2017-05-06', '2017-05-03', 'dsdsf', 0, '2017-05-05 04:51:00', '2017-05-05 04:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `notification_from` int(11) NOT NULL,
  `notification_to` int(11) NOT NULL,
  `description` text NOT NULL,
  `read_status` tinyint(4) NOT NULL DEFAULT '0',
  `notification_type` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `order_id`, `package_id`, `notification_from`, `notification_to`, `description`, `read_status`, `notification_type`, `created_date`) VALUES
(1, 35, 45, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-04 06:01:21'),
(2, 35, 45, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-04 06:01:56'),
(3, 35, 45, 176, 173, 'Order has been accepted by Wifi', 1, 'order', '2017-05-04 06:02:35'),
(4, 35, 0, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-04 06:34:54'),
(5, 35, 0, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-04 06:35:03'),
(6, 35, 0, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-04 06:35:11'),
(7, 35, 45, 176, 173, 'Order has been picked up from client location', 1, 'track', '2017-05-04 06:35:16'),
(8, 35, 45, 176, 173, 'Order has been picked up from client location', 1, 'track', '2017-05-04 06:35:25'),
(9, 35, 45, 176, 173, 'Order has been drop off', 1, 'track', '2017-05-04 06:35:40'),
(10, 35, 45, 176, 173, 'Order has been delivered', 1, 'track', '2017-05-04 06:35:58'),
(11, 10, 0, 1, 226, 'New order has been assigned by Rahul Jain', 1, 'order', '2017-05-04 06:38:58'),
(12, 10, 16, 226, 1, 'Order has been picked up from client location', 1, 'track', '2017-05-04 06:39:11'),
(13, 10, 16, 226, 1, 'Order has been drop off', 1, 'track', '2017-05-04 06:50:52'),
(14, 10, 16, 226, 1, 'Order has been delivered', 1, 'track', '2017-05-04 06:51:17'),
(15, 7, 10, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-04 09:23:01'),
(16, 7, 10, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-04 09:23:33'),
(17, 47, 64, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-04 09:34:10'),
(18, 7, 10, 176, 173, 'Order has been accepted by Wifi', 1, 'order', '2017-05-04 11:04:44'),
(19, 1, 1, 230, 173, 'New order has been asigned by Shyama', 1, 'order', '2017-05-05 04:44:13'),
(20, 1, 1, 173, 176, 'New order has been asigned by Zeke', 1, 'order', '2017-05-05 04:45:40'),
(21, 1, 1, 176, 173, 'Order has been Accepted by Wifi', 1, 'order', '2017-05-05 04:48:05'),
(22, 1, 0, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-05 05:04:51'),
(23, 1, 1, 176, 173, 'Order has been picked up from client location', 1, 'track', '2017-05-05 05:05:10'),
(24, 1, 1, 176, 173, 'Order has been delivered', 1, 'track', '2017-05-05 05:05:48'),
(25, 47, 64, 173, 173, 'New order has been assigned by Zeke', 1, 'order', '2017-05-05 08:18:22'),
(26, 2, 2, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-05 09:30:24'),
(27, 2, 5, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-05 09:30:24'),
(28, 2, 8, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-05 09:30:24'),
(29, 2, 9, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-05 09:30:24'),
(30, 25, 35, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-08 05:27:05'),
(31, 25, 35, 173, 173, 'New order has been assigned by Zeke', 1, 'order', '2017-05-08 05:28:13'),
(32, 25, 0, 1, 173, 'New order has been assigned by Rahul Jain', 1, 'order', '2017-05-08 05:37:18'),
(33, 25, 35, 173, 173, 'Order has been picked up from client location', 1, 'track', '2017-05-08 05:37:39'),
(34, 47, 0, 1, 173, 'New order has been assigned by Rahul Jain', 1, 'order', '2017-05-08 07:35:43'),
(35, 47, 64, 173, 173, 'Order has been picked up from client location', 1, 'track', '2017-05-08 07:35:53'),
(36, 47, 0, 1, 173, 'New order has been assigned by Rahul Jain', 1, 'order', '2017-05-08 07:38:45'),
(37, 47, 64, 173, 173, 'Order has been picked up from client location', 1, 'track', '2017-05-08 07:39:12'),
(38, 47, 64, 173, 173, 'Order has been drop off', 1, 'track', '2017-05-08 08:51:09'),
(39, 5, 6, 1, 173, 'New order has been asigned by Rahul Jain', 1, 'order', '2017-05-08 09:17:19'),
(40, 5, 6, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-08 09:18:15'),
(41, 5, 6, 176, 173, 'Order has been accepted by Wifi', 1, 'order', '2017-05-08 09:18:48'),
(42, 5, 0, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-08 09:19:34'),
(43, 5, 6, 176, 173, 'Order has been picked up from client location', 1, 'track', '2017-05-08 09:19:43'),
(44, 5, 6, 176, 173, 'Order has been drop off', 1, 'track', '2017-05-08 09:20:20'),
(45, 5, 6, 176, 173, 'Order has been delivered', 1, 'track', '2017-05-08 09:21:00'),
(46, 7, 0, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-08 09:46:28'),
(47, 7, 10, 176, 173, 'Order has been picked up from client location', 1, 'track', '2017-05-08 09:46:44'),
(48, 7, 10, 176, 173, 'Order has been drop off', 1, 'track', '2017-05-08 09:47:31'),
(49, 2, 2, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-08 10:31:46'),
(50, 2, 5, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-08 10:32:40'),
(51, 2, 8, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-08 10:32:40'),
(52, 2, 9, 173, 176, 'New order has been assigned by Zeke', 1, 'order', '2017-05-08 10:32:40'),
(53, 2, 2, 176, 173, 'Order has been rejected by Wifi', 1, 'order', '2017-05-08 10:33:06'),
(54, 2, 5, 176, 173, 'Order has been rejected by Wifi', 1, 'order', '2017-05-08 10:33:06'),
(55, 2, 8, 176, 173, 'Order has been rejected by Wifi', 1, 'order', '2017-05-08 10:33:06'),
(56, 2, 9, 176, 173, 'Order has been rejected by Wifi', 1, 'order', '2017-05-08 10:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `email_notification` int(11) NOT NULL,
  `mobile_notification` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_requests`
--
ALTER TABLE `api_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_keys`
--
ALTER TABLE `auth_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_codes`
--
ALTER TABLE `country_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `order_assignments`
--
ALTER TABLE `order_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`assign_to`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_assignment_logs`
--
ALTER TABLE `order_assignment_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_locations`
--
ALTER TABLE `order_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_packages`
--
ALTER TABLE `order_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `status_2` (`status`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_carriers`
--
ALTER TABLE `shipping_carriers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_id` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_keys`
--
ALTER TABLE `auth_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `country_codes`
--
ALTER TABLE `country_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `order_assignments`
--
ALTER TABLE `order_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `order_assignment_logs`
--
ALTER TABLE `order_assignment_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;
--
-- AUTO_INCREMENT for table `order_locations`
--
ALTER TABLE `order_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `order_packages`
--
ALTER TABLE `order_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `order_tracking`
--
ALTER TABLE `order_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shipping_carriers`
--
ALTER TABLE `shipping_carriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
