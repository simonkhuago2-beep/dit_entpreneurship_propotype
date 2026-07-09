-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2017 at 06:52 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cctech_travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `datee` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `cust_id`, `balance`, `datee`) VALUES
(1, 3, 630, '2016-11-16 12:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE IF NOT EXISTS `availability` (
  `id` int(11) NOT NULL,
  `hId` int(11) NOT NULL,
  `rId` int(11) NOT NULL,
  `start` datetime DEFAULT NULL,
  `ending` datetime DEFAULT NULL,
  `title` text
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `hId`, `rId`, `start`, `ending`, `title`) VALUES
(1, 2, 1, '2017-02-23 00:00:00', '2017-01-28 00:00:00', 'Single Room'),
(2, 2, 1, '2017-02-24 00:00:00', '2017-01-29 00:00:00', 'Single Room'),
(6, 2, 2, '2017-01-27 00:00:00', '2017-01-28 00:00:00', 'Double Bed Booked'),
(7, 2, 2, '2017-01-28 00:00:00', '2017-01-29 00:00:00', 'Double Bed Booked'),
(8, 2, 2, '2017-01-29 00:00:00', '2017-01-30 00:00:00', 'Double Bed Booked'),
(9, 2, 2, '2017-02-07 00:00:00', '2017-02-08 00:00:00', 'Double Bed Booked'),
(10, 2, 2, '2017-02-08 00:00:00', '2017-02-09 00:00:00', 'Double Bed Booked'),
(11, 2, 2, '2017-02-09 00:00:00', '2017-02-10 00:00:00', 'Double Bed Booked'),
(13, 2, 1, '2017-02-06 00:00:00', '2017-02-07 00:00:00', 'Sr');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `trans_type` varchar(255) NOT NULL,
  `trans_details` text NOT NULL,
  `trans_cost` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `made_by` int(11) NOT NULL,
  `datee` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `markup_price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `trans_id`, `trans_type`, `trans_details`, `trans_cost`, `payment_status`, `payment_mode`, `made_by`, `datee`, `markup_price`) VALUES
(1, '2F7302A6-32B5-4225-B681-74937D2190B2', 'transfers', '{"id":"1","name":"kareen igbo","tel":"+234585521222","email":"kigbo@mail.com","pick_addr":"this is the pick address","pick_date":"2017-01-27","pick_time":"08:00", "drop_addr":"this is the drop off address","drop_date":"2017-01-27","drop_time":"09:30"}', 150, 1, 'accounts', 3, '2017-01-27 21:55:27', 0),
(2, '84700A03-B779-45F5-B804-7B3B321A47A9', 'excursions', '{"id":"1","name":"Josh Coldwaters","tel":"+1255545555","email":"josh@mail.com","date":"2017-02-28","time":"01:00"}', 450, 1, 'accounts', 3, '2017-02-27 16:57:17', 500),
(3, 'A3D795A2-8949-48E2-B81B-72BB3D90D365', 'tours', '{"id":"1","name":"Saint Cyrl John","tel":"+235656688885","email":"saint@mail.com"}', 270, 1, 'accounts', 3, '2017-02-27 14:46:06', 0),
(4, '1D60A876-B519-4CED-ADFB-A6E038E7B1F7', 'events', '{"id":"3","name":"Aba Kcaesy ","tel":"+23325478855","email":"abak@mail.com"}', 150, 1, 'accounts', 3, '2017-01-27 21:55:38', 0),
(5, '206F87DF-6F02-4594-8330-AF974DF8E247', 'hotels', '{"roomId":"2","hotelId":"2",       "name":"kennedy chizobah","tel":"+2333332546564","email":"kcaesy@gmail.com","city":"lagos","zip":"234","request":"uests can use our restaurant in the neighbourhood for breakfast: Monday to Saturday from 9:00 am to 12:00 am for Euro 6,50, on Sundays from 9:00 am to 15:00 pm for Euro 9,00.The hotel may charge City Taxes or a Resort Fee, paid directly at the hotel","breakfast":"","rollaway":"","extrabed":"",\n            "adult":"2","child":"0","checkin":"2017-01-27","checkout":"2017-01-29","days":"2","roomqty":"2"}', 520, 1, 'accounts', 3, '2017-02-14 11:27:25', 0),
(8, 'FC9EAF8B-4DA3-4300-A893-C1519B9C30E0', 'hotels', '{"roomId":"2","hotelId":"2",\r\n            "name":"Esther uzoh","tel":"2525025145","email":"esther@mail.com","city":"legon","zip":"2225",\r\n            "request":"","breakfast":"15","rollaway":"","extrabed":"",\r\n            "adult":"1","child":"0","checkin":"2017-02-07","checkout":"2017-02-09","days":"2","roomqty":"1"}', 330, 1, 'accounts', 3, '2017-02-14 11:29:50', 350),
(9, '9094581F-66D6-4B22-8D9B-A93C6E150B9E', 'transfers', '{"id":"1","name":"aba kcaesy","tel":"222514555","email":"kcaesy@gmail.com",\n            "pick_addr":"aaaa","pick_date":"2017-02-07","pick_time":"00:22",\n            "drop_addr":"jjjjj","drop_date":"2017-02-07","drop_time":"14:22"\n            }', 150, 0, 'direct', 0, '2017-02-27 16:44:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL,
  `user_send` int(11) NOT NULL,
  `user_rec` int(11) NOT NULL,
  `msg` text NOT NULL,
  `tym` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_send`, `user_rec`, `msg`, `tym`, `status`) VALUES
(1, 1, 2, 'hello ', '2017-01-31 12:01:08', 1),
(2, 2, 1, 'hi', '2017-01-25 08:53:37', 1),
(3, 2, 1, 'Good day Admin', '2017-01-24 16:53:08', 1),
(4, 1, 2, 'testing empty msg', '2017-02-01 14:27:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL,
  `groups` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stars` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT 'Ghana',
  `city` varchar(255) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `facilities` varchar(500) NOT NULL,
  `services` varchar(500) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `plain` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  `established` date NOT NULL,
  `renovated` date NOT NULL,
  `renovations` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `descp` text NOT NULL,
  `langs` text NOT NULL,
  `norms` text NOT NULL,
  `gen_note` text NOT NULL,
  `img_one` varchar(255) NOT NULL,
  `img_two` varchar(255) NOT NULL,
  `img_three` varchar(255) NOT NULL,
  `comm` int(11) NOT NULL,
  `activate` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `map` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `groups`, `name`, `stars`, `addr`, `country`, `city`, `zip`, `landmark`, `contact_email`, `tel`, `facilities`, `services`, `fullname`, `position`, `username`, `email`, `password`, `salt`, `plain`, `verified`, `established`, `renovated`, `renovations`, `skype`, `lastLogin`, `descp`, `langs`, `norms`, `gen_note`, `img_one`, `img_two`, `img_three`, `comm`, `activate`, `created`, `map`) VALUES
(1, 1, '', '', '', 'Ghana', '', '', '', 'admin@admin.com', '', '', '', 'Super Admin', 'Administrator', 'admin', 'admin@admin.com', 'f1329102dc7b2f7491fc2891cdab94a63fe06744e381aaf388ee947275b29127', 'nåÇ§Í¬‚ça°€m©\\‡Å‰‚Ó‚ÍOXÿœÎ´µ©', 'password', 1, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', '', '', '', '', '', '', '', 0, 1, '2016-02-17 20:30:12', ''),
(2, 4, 'First Hotel Limited', '4', 'Bortianor on the Kasoa-Kaneshi road, Les Vegas Junction', 'Ghana', 'Accra', '', 'West hills mall', 'first@hotel.com', '03025666658', 'Pool,Kids Playground,Event Centers,Bar/Restaurant', 'Laundry ,Car Wash,Shoe shine,Massage', 'First Manager', 'Hotel Manager', 'f_mangr', 'first@hotel.com', 'f1329102dc7b2f7491fc2891cdab94a63fe06744e381aaf388ee947275b29127', 'nåÇ§Í¬‚ça°€m©\\‡Å‰‚Ó‚ÍOXÿœÎ´µ©', 'password', 1, '2014-07-01', '2015-10-10', 'Rooms,Lobby,stirs', '', '0000-00-00 00:00:00', 'Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcorper vulputate nisi, et fringilla ante convallis quis. Nullam vel tellus non elit suscipit volutpat. Integer id felis et nibh rutrum dignissim ut non risus. In tincidunt urna quis sem luctus, sed accumsan magna pellentesque. Donec et iaculis tellus. Vestibulum ut iaculis justo, auctor sodales lectus. Donec et tellus tempus, dignissim maurornare, consequat lacus. Integer dui neque, scelerisque nec sollicitudin sit amet, sodales a erat. Duis vitae condimentum ligula. Integer eu mi nisl. Donec massa dui, commodo id arcu quis, venenatis scelerisque velit. \n\nPraesent eros turpis, commodo vel justo at, pulvinar mollis eros. Mauris aliquet eu quam id ornare. Morbi ac quam enim. Cras vitae nulla condimentum, semper dolor non, faucibus dolor. Vivamus adipiscing eros quis orci fringilla, sed pretium lectus viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec nec velit non odio aliquam suscipit. Sed non neque faucibus, condimentum lectus at, accumsan enim. Fusce pretium egestas cursus. Etiam consectetur, orci vel rutrum volutpat, odio odio pretium nisiodo tellus libero et urna. Sed commodo ipsum ligula, id volutpat risus vehicula in. Pellentesque non massa eu nibh posuere bibendum non sed enim. Maecenas lobortis nulla sem, vel egestas dui ullamcorper ac. \n\nSed scelerisque lectus sit amet faucibus sodales. Proin ut risus tortor. Etiam fermentum tellus auctor, fringilla sapien et, congue quam. In a luctus tortor. Suspendisse eget tempor libero, ut sollicitudin ligula. Nulla vulputate tincidunt est non congue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus at est imperdiet, dapibus ipsum vel, lacinia nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus id interdum lectus, ut elementum elit. Nullam a molestie magna. Praesent eros turpis, commodo vel justo at, pulvinar mollis eros. Mauris aliquet eu quam id ornare. Morbi ac quam enim. Cras vitae nulla condimentum, semper dolor non, faucibus dolor. Vivamus adipiscing eros quis orci fringilla, sed pretium lectus viverra.', '', 'Please be advised that our lobby and breakfast area will be closed for renovation starting from 19-10-2015 for approximately 5 weeks. We apologize for any Inconvenience and offer our sincere thanks for your patience and support. Complimentary coffee and tea will be served at the temporary reception area. Guests can use our restaurant in the neighbourhood for breakfast: Monday to Saturday from 9:00 am to 12:00 am for Euro 6,50, on Sundays from 9:00 am to 15:00 pm for Euro 9,00.The hotel may charge City Taxes or a Resort Fee, paid directly at the hotelBaby cot subject to availability and may have an additional cost.Note that some hotels may require cash or credit card deposit as guarantee. This will be returned on departure minus any deduction incurred during the stay. ', 'Please note that these requests are not covered under this booking cost.Additional charges may/may not incur depending upon the Hotel. Selecting these requests does not guarantee their availability. Status of your request shall be updated after confirming with the hotel', 'libs/profiles/slide1.jpg', '', '', 0, 1, '2016-07-17 18:13:57', '<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d127059.62666109105!2d-0.1442266002917659!3d5.623962824831271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0xfdf84b1249b55d5%3A0x4ef0b8ac0563ce22!2spaloma+hotel+spintex!3m2!1d5.6239669999999995!2d-0.074186!5e0!3m2!1sen!2sng!4v1487002283797" width="870" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>'),
(3, 2, 'First Agency', '0', 'Lorem Ipsum is simply dummy text', 'Ghana', 'Accra', '', '', 'first_agency@email.com', '0302225548', '', '', 'first Agency manager', 'CEO/Manger', 'f_agency', 'manager@fagency.com', '71232487547fbb11fba0e65c757758f2e0d6be0ff7ca8de4161dfde9aedccf0b', 'yíGe”OEÝßûãô!¥ÉbùÏ³´yÊÎc9…ÉÍj ù', 'password', 0, '0000-00-00', '0000-00-00', '', 'kcaesy', '0000-00-00 00:00:00', '', '', '', '', '', '', '', 9, 1, '2017-02-10 00:40:31', ''),
(4, 4, 'second hotels limited', '3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Togo', 'Lome', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Secondhotel@mail.com', '+233-25554444', '', '', 'Firstname Lastname', 'Accountant', 'display_name', 'Secondhotel@mail.com', '9d097898b5853a939059eb79cffdce00adf6e2f50af03184c4ed9afc1b50b71c', '£8§·eô£ôØ#Õ"’¢–•ÌâÇu\\·$¹{zVd˜', 'password', 1, '2014-08-19', '0000-00-00', '', '', '0000-00-00 00:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.', 'English, French', '', '', 'libs/profiles/architecture-projects01.jpg', '', '', 0, 1, '2016-07-24 22:01:26', ''),
(5, 4, 'third hotel limited', '4', 'Lorem Ipsum is simply dummy text', 'Ghana', 'Accra', '', '', '', '', '', '', 'first last name', 'ceo/manager', '3rd_hotel', '3rdhotel@mail.com', '22f03b30c33e751791273ae86a97e1c2dd6b6e73e17dc24dcdb169bb181d7651', 'Y¹%?ù…7¯Jv‘‰ÿj•ƒù%ðüý¡4Kø5Ýã', 'password', 1, '2015-11-17', '0000-00-00', '', '', '0000-00-00 00:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.', 'English, French', '', '', 'libs/profiles/photo1.png', '', '', 0, 1, '2016-07-24 22:40:11', ''),
(6, 4, 'best western hotel', '3', 'Lorem Ipsum is simply dummy text ', 'Ghana', 'Accra', '', '', 'b_western@info.com', '02556651588', '', '', 'first middle last name', 'marketing manager', 'manger_bwh', 'manger@bwh.com', 'f0d98f649870db3e86fe4bc877e4604c144c21e21bbef712929715c0de1166f7', 's†ŠY~Kéœþ™Å+Øþ>\r‘¼«xëFžß§(äî@', 'password', 1, '2014-10-07', '0000-00-00', '', '', '0000-00-00 00:00:00', 'Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.', '', '', '', 'libs/profiles/slider4.jpg', '', '', 0, 1, '2016-07-24 23:02:13', ''),
(7, 4, 'Lodge Afric ', 'Guest House', 'Bortianor on the Kasoa-Kaneshi road, Les Vegas Junction', 'Ghana', 'Accra', '', 'West hills mall', 'first@hotel.com', '03025666658', 'Pool,Bar', 'Laundry ,Car Wash', 'First Manager', 'Hotel Manager', 'lodgeAfric', 'logde@afric.com', 'f1329102dc7b2f7491fc2891cdab94a63fe06744e381aaf388ee947275b29127', 'nåÇ§Í¬‚ça°€m©\\‡Å‰‚Ó‚ÍOXÿœÎ´µ©', 'password', 1, '2014-07-01', '2015-10-10', 'Rooms,Lobby,stirs', '', '0000-00-00 00:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.', '', '', '', 'libs/profiles/slider3.png', '', '', 0, 1, '2016-07-17 18:13:57', ''),
(8, 4, 'Abachi Guest House', 'Guest House', 'Suite 4 Level 1, 141 Bridge Road London, E2 8DY.', 'England', 'London', '420', 'Close to the WESTMINSTER Abbey', 'abachi@guesthse.com', '+402115555966', '', '', 'Abachi Kelechi', 'CEO/Manager', 'Abachi', 'abachi@mail.com', 'bb2f43cf021aaf4fcb8356f1ec5efc8c4e7bddd407ce2d29793e198a98e79e19', 'q¿ºÇÍÂ+Ä¿ôê«\ZšZÊè«æþfnWe>eÐö', 'password', 0, '2016-02-23', '0000-00-00', '', '', '0000-00-00 00:00:00', '', '', '', '', '', '', '', 0, 0, '2017-01-12 03:12:32', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `e_time` time NOT NULL,
  `e_date` date NOT NULL,
  `city` varchar(255) NOT NULL,
  `loc` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `datee` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `price` int(11) NOT NULL,
  `sup_name` varchar(255) NOT NULL,
  `sup_addr` text NOT NULL,
  `sup_email` varchar(255) NOT NULL,
  `sup_tel` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `type`, `title`, `body`, `e_time`, `e_date`, `city`, `loc`, `image`, `status`, `datee`, `price`, `sup_name`, `sup_addr`, `sup_email`, `sup_tel`, `image1`, `image2`) VALUES
(1, 'AGM', 'Ghana eCommerce', '<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;"><span style="font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;">THE 2016 eCOMMERCE EXHIBITION</span></div>\r\n<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;"><span style="font-family: ''Century Gothic'', sans-serif; font-size: 10pt; text-align: justify;">As a major industry player, your company is invited to participate at the above e-commerce, online and electronic financial transactions exhibition and conference at the plush Alisa Hotel in Accra. &nbsp;In its third successful year, the event is under the theme:</span></div>\r\n<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;">\r\n<p class="MsoNoSpacing" style="margin: 0px; padding: 5px 0px; text-align: justify;"><strong><span style="font-size: 10pt; font-family: ''Century Gothic'', sans-serif; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">&lsquo;Transforming Ghana&rsquo;s Online Businesses through Technology, Innovation &amp; Opportunity"</span></strong></p>\r\n</div>', '09:00:00', '2016-10-27', 'Accra', 'Alisa Hotel', 'uploads/events/eccom.jpg', 1, '2017-01-30 10:52:29', 200, 'Global Destinations Consult', '', '', '+23324794321', '', ''),
(2, 'AGM', '3rd Ghana eCommerce', '<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;"><span style="font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;">THE 2016 eCOMMERCE EXHIBITION</span></div>\r\n<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;"><span style="font-family: ''Century Gothic'', sans-serif; font-size: 10pt; text-align: justify;">As a major industry player, your company is invited to participate at the above e-commerce, online and electronic financial transactions exhibition and conference at the plush Alisa Hotel in Accra. &nbsp;In its third successful year, the event is under the theme:</span></div>\r\n<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;">\r\n<p class="MsoNoSpacing" style="margin: 0px; padding: 5px 0px; text-align: justify;"><strong><span style="font-size: 10pt; font-family: ''Century Gothic'', sans-serif; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">&lsquo;Transforming Ghana&rsquo;s Online Businesses through Technology, Innovation &amp; Opportunity"</span></strong></p>\r\n</div>', '09:00:00', '2016-11-10', 'Accra', 'Alisa Hotel', 'uploads/events/eccom.jpg', 1, '2017-02-01 10:02:13', 150, 'Global Destinations Consult', '', '', '+23324794321', '', ''),
(3, 'AGM', 'Technology Student Association', '<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;"><span style="font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;">THE 2016 eCOMMERCE EXHIBITION</span></div>\r\n<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;"><span style="font-family: ''Century Gothic'', sans-serif; font-size: 10pt; text-align: justify;">As a major industry player, your company is invited to participate at the above e-commerce, online and electronic financial transactions exhibition and conference at the plush Alisa Hotel in Accra. &nbsp;In its third successful year, the event is under the theme:</span></div>\r\n<div style="color: #330022; font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; font-size: small;">\r\n<p class="MsoNoSpacing" style="margin: 0px; padding: 5px 0px; text-align: justify;"><strong><span style="font-size: 10pt; font-family: ''Century Gothic'', sans-serif; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;">&lsquo;Transforming Ghana&rsquo;s Online Businesses through Technology, Innovation &amp; Opportunity"</span></strong></p>\r\n</div>', '09:00:00', '2016-12-08', 'Lagos', 'Golden Hotel Ikeja', 'uploads/events/eccom.jpg', 1, '2017-03-01 10:15:12', 150, 'Global Destinations Consult', 'new supplier address', 'supplier@mail.com', '+23324794321', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `excursion`
--

CREATE TABLE IF NOT EXISTS `excursion` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `infant` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `duration` varchar(255) NOT NULL,
  `sup_name` varchar(255) NOT NULL,
  `sup_email` varchar(255) NOT NULL,
  `sup_tel` varchar(255) NOT NULL,
  `sup_addr` text NOT NULL,
  `map` text NOT NULL,
  `overview` text NOT NULL,
  `details` text NOT NULL,
  `highlights` text NOT NULL,
  `meeting` text NOT NULL,
  `special` text NOT NULL,
  `status` int(11) NOT NULL,
  `datee` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `excursion`
--

INSERT INTO `excursion` (`id`, `title`, `type`, `infant`, `price`, `image`, `image1`, `image2`, `pdf`, `country`, `city`, `start`, `duration`, `sup_name`, `sup_email`, `sup_tel`, `sup_addr`, `map`, `overview`, `details`, `highlights`, `meeting`, `special`, `status`, `datee`) VALUES
(1, 'Accra City Tour', 'All', 1, 350, 'uploads/excursion/travel-12.jpg', 'uploads/excursion/567x330x1.jpg', 'uploads/excursion/567x330x3.jpg', 'uploads/excursion/history.txt', 'Ghana', 'Nkorkor', '2017-03-01', '8 Hours', 'Global Destinations Consult', 'global@mail.com', '+233247943218', 'P.O.Box 1367, Kanashie', '<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d127059.62666109105!2d-0.1442266002917659!3d5.623962824831271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0xfdf84b1249b55d5%3A0x4ef0b8ac0563ce22!2spaloma+hotel+spintex!3m2!1d5.6239669999999995!2d-0.074186!5e0!3m2!1sen!2sng!4v1487002283797" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>', '<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">DESTINATION:&nbsp;</span></strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">ACCRA<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; COUNTRY:&nbsp;</strong>GHANA</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">OPERATING DAYS:&nbsp;</span></strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">TUESDAYS &amp; THURSDAYS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>DURATION:&nbsp;</strong>8 HOURS</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">TRANPORTAION:&nbsp;</span></strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">COMPLIMENTARY<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;TYPE:&nbsp;</strong>GROUP TOUR</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">MINIMUM NUMBER:&nbsp;</span></strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">4<strong>&nbsp;</strong></span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">PACKAGE INCLUDES: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">Transfers from hotel to start point, All Entrance Tickets, Lunch, Professional Tour Guiding</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">(All confirmed documents will be sent via mail immediately payment is received)</span></p>', '<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">This is a group tours scheduled on Tuesdays and Thursdays. This day trip is set in the heart of the capital, however away from the hustle and bustle of the main city. This is a trip designed to give Tourists the most recreational and aesthetic experience ever within a day. The package contains elements of education, exposure and a taste of African warmth, hospitality and beauty. Please note that bookings can be confirmed based on availability.</span></em></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">Participant will be pick up from the respective accommodation. The tour begins with a journey to the Ghana&rsquo;s National Museum. From the Museum, we shall walk through the local traditional market; the Makola Market. This is one of the largest and busiest local markets in West Africa. Here we experience an amazing scenery, sights and smell that characterizes our markets, an experience you won&rsquo;t get anywhere.</span></em></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">The tour continues with a trip down memory lane as we learn about the African Man of the Century, Osagyefo Dr. Kwame Nkrumah at the Kwame Nkrumah Museum. Participants shall then have a taste of African arts and culture as are exposed to the intricacies of the Arts Centre</span></em></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">From here, participants take a tour through Jamestown, major custodians of the Ga (Accra) land. We shall visit the Colonial Light House. The tour continues with a journey to the Liberation Square and Ghana&rsquo;s Independence Square as we are exposed to the bare facts of an independence that excited Freedom through West Africa. From here, we take a break as we enjoy one of Ghana&rsquo;s scenic wealth; the amazing white sand beaches.</span></em></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">Participants will be drop off at their respective accommodation.</span></em></p>', '<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Visit to National Museum</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Taste of rich traditional Ghanaian meal</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Exposure to real African Arts and Culture at the Arts Center</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Journey into the past through the eyes of the Usher Fort/Lighthouse</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Visit Kwame Nkrumah Mausoleum</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Drive through the Makola Market (one of the busiest local markets in West Africa)</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Visit to the Dubois Memorial Centre</span></p>', '', '<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">EXCLUSION</span></strong></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">All Personal Shopping and Personal Activitiie</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;"><span style="font-family: ''Open Sans'', Arial, sans-serif; font-size: 13px; text-align: start; color: #666666; font-weight: bold;">Summary of The Day:&nbsp;</span><span style="font-family: ''Open Sans'', Arial, sans-serif; font-size: 13px; text-align: start;">After roaming Rome, you shall now visit Venice on the next leg of your 12-day Europe Tour! Take note of the scenery on the way - vineyards and orchards flash in front of a majestic mountain backdrop. The diversity of the Italian landscape will continue to impress. And then ... Venice. A unique city, perched across 118 islands, known for its canals, gondolas, Venetian masks, piazzas, art, and traditional glass and lace making. Your tour leader will introduce you to the city with an orientation walk so you can use your free time in the early evening to explore. See the world-famous St Marks Square, Grand Canal and Rialto Bridge. The evening is yours to enjoy authentic Italian delights, with hundreds of fantastic local restaurants and bars to choose from. After an espresso, explore Venice the traditional way - from the canals. Take a gondola ride which gives you a completely different perspective and appreciation for the amazing structure of this supremely unique location.</span></span></p>', 1, '2017-02-25 23:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `excursion_booking`
--

CREATE TABLE IF NOT EXISTS `excursion_booking` (
  `id` int(11) NOT NULL,
  `agent` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `excursion_date` date NOT NULL,
  `excursion_time` time NOT NULL,
  `datee` datetime NOT NULL,
  `orderId` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `excursion_booking`
--

INSERT INTO `excursion_booking` (`id`, `agent`, `trans_id`, `payment`, `cost`, `fullname`, `email`, `tel`, `excursion_date`, `excursion_time`, `datee`, `orderId`) VALUES
(1, 2, 1, 1, 450, 'mary doe', 'mary@mail.com', '+233-9625225', '2017-01-09', '13:00:00', '2017-01-08 14:52:09', 'B3F5323B-FA1E-4713-9D5E-78D22475A216');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Administartor', '{"Admin": 1}'),
(2, 'Agent', '{"Agent": 2}'),
(3, 'Standard User', '{"Stand": 3}'),
(4, 'Hotel', '{"Hotel": 4}');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `hid`, `path`, `file_type`, `added`) VALUES
(1, 2, 'libs/gallery/slide1.jpg', 'image', '2017-01-21 15:52:44'),
(2, 6, 'libs/gallery/slider3.png', 'image', '2017-05-07 21:46:40'),
(3, 4, 'libs/gallery/slider4.jpg', 'image', '2017-02-15 13:13:47'),
(4, 5, 'libs/gallery/slider5.jpg', 'image', '2017-02-15 13:13:58'),
(5, 7, 'libs/gallery/slide1.jpg', 'image', '2017-02-15 13:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE IF NOT EXISTS `notify` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `tym` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`id`, `type`, `tag`, `comment`, `status`, `tym`) VALUES
(1, 'Registration', 'hotel', 'new user registration ', 1, '2017-01-26 12:10:06'),
(2, 'Registration', 'agency', 'new user registration', 1, '2017-01-26 12:09:59'),
(3, 'Booking', 'transfers', 'New transfer booking.', 1, '2017-01-30 17:05:05'),
(4, 'Booking', 'excursions', 'New Excursion Booking.', 1, '2017-01-31 11:14:22'),
(5, 'Booking', 'tours', 'New Tour Booking.', 1, '2017-02-01 11:06:44'),
(6, 'Booking', 'events', 'New Events Booking.', 1, '2017-01-31 11:16:59'),
(7, 'Booking', 'hotels', 'New Hotel Booking.', 1, '2017-01-31 11:35:57'),
(8, 'Booking', 'hotels', 'New Hotel Booking.', 1, '2017-02-13 07:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `hid` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `details` text NOT NULL,
  `status` int(11) NOT NULL,
  `datee` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `title`, `hid`, `room`, `rate`, `details`, `status`, `datee`) VALUES
(1, 'Early Bird', 2, 1, 10, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem', 1, '2017-01-17 16:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `hotel` int(11) NOT NULL,
  `comment` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reply` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `bookId`, `hotel`, `comment`, `image`, `added`, `reply`) VALUES
(1, 5, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dumm', '', '2017-02-04 22:34:33', 0),
(2, 0, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dumm', '', '2017-02-27 14:12:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `vacant` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `descp` text NOT NULL,
  `adult` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `meal_plan` varchar(255) NOT NULL,
  `brkfst` int(11) NOT NULL,
  `extra` int(11) NOT NULL,
  `rollaway` int(11) NOT NULL,
  `admin_price` int(11) NOT NULL,
  `agent_price` int(11) NOT NULL,
  `imgOne` varchar(255) NOT NULL,
  `imgTwo` varchar(255) NOT NULL,
  `facil` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hid`, `name`, `qty`, `vacant`, `price`, `descp`, `adult`, `child`, `meal_plan`, `brkfst`, `extra`, `rollaway`, `admin_price`, `agent_price`, `imgOne`, `imgTwo`, `facil`, `date`, `views`) VALUES
(1, 2, 'Single Bed', 10, 9, 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 2, 1, 'Not Included', 10, 40, 20, 0, 90, 'libs/profiles/slider2.jpg', '', 'Air Condition,\r\nShower,\r\nTelevision', '2016-07-24 19:27:12', 0),
(2, 2, 'Double Bed', 10, 7, 150, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 2, 2, 'Not Included', 15, 20, 20, 0, 120, 'libs/profiles/hotel_03.png', '', 'Fan,Television,Shower,Reading Table', '2016-11-12 11:04:35', 0),
(3, 7, 'Single Bed', 12, 12, 110, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 2, 1, 'Not Included', 10, 40, 20, 0, 95, 'libs/profiles/slider2.jpg', 'libs/profiles/', 'Air Condition,\r\nShower,\r\nTelevision', '2016-07-24 19:27:12', 0),
(4, 7, 'Excutive Double Bed', 5, 5, 250, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 2, 1, 'Free', 15, 20, 20, 0, 230, 'libs/profiles/Majesty.jpg', '', 'Fan,Television,Shower,Reading Table', '2016-11-12 11:04:35', 0),
(5, 6, 'Excutive Double Bed', 5, 5, 250, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 2, 1, 'Free', 15, 20, 20, 0, 230, 'libs/profiles/Majesty.jpg', '', 'Fan,Television,Shower,Reading Table', '2016-11-12 11:04:35', 0),
(6, 5, 'Single Bed', 10, 10, 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 2, 1, 'Coffee', 10, 40, 20, 0, 90, 'libs/profiles/slider2.jpg', '', 'Air Condition,\r\nShower,\r\nTelevision', '2016-07-24 19:27:12', 0),
(7, 4, 'Double Bed', 10, 7, 150, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 2, 2, 'Not Included', 15, 20, 20, 0, 135, 'libs/profiles/hotel_03.png', '', 'Fan,Television,Shower,Reading Table', '2016-11-12 11:04:35', 0),
(8, 4, 'Excutive Double Bed', 5, 5, 250, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 2, 1, 'Half loaf', 15, 20, 20, 0, 230, 'libs/profiles/Majesty.jpg', '', 'Fan,Television,Shower,Reading Table', '2016-11-12 11:04:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `commission` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `commission`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE IF NOT EXISTS `tours` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `infant` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `duration` varchar(50) NOT NULL,
  `sup_name` varchar(255) NOT NULL,
  `sup_tel` varchar(60) NOT NULL,
  `sup_email` varchar(255) NOT NULL,
  `sup_addr` text NOT NULL,
  `map` text NOT NULL,
  `overview` text NOT NULL,
  `details` text NOT NULL,
  `highlights` text NOT NULL,
  `meeting` text NOT NULL,
  `special` text NOT NULL,
  `status` int(11) NOT NULL,
  `datee` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `title`, `type`, `infant`, `price`, `image`, `image1`, `image2`, `pdf`, `country`, `city`, `start`, `duration`, `sup_name`, `sup_tel`, `sup_email`, `sup_addr`, `map`, `overview`, `details`, `highlights`, `meeting`, `special`, `status`, `datee`) VALUES
(1, 'Cape Tour', 'All', 1, 400, 'uploads/tours/travel-12.jpg', 'uploads/tours/567x330x1.jpg', 'uploads/tours/567x330x3.jpg', 'uploads/tours/history.txt', 'Ghana', 'Accra', '2017-03-01', '3 Days', 'Global Destinations Consult', '+233247943218', 'glodestinations@hotmail.com', 'P.O.Box 1367, Kanashie', '<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d127059.62666109105!2d-0.1442266002917659!3d5.623962824831271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0xfdf84b1249b55d5%3A0x4ef0b8ac0563ce22!2spaloma+hotel+spintex!3m2!1d5.6239669999999995!2d-0.074186!5e0!3m2!1sen!2sng!4v1487002283797" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>', '<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">DESTINATION:&nbsp;</span></strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">ACCRA<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; COUNTRY:&nbsp;</strong>GHANA</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">OPERATING DAYS:&nbsp;</span></strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">TUESDAYS &amp; THURSDAYS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>DURATION:&nbsp;</strong>8 HOURS</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">TRANPORTAION:&nbsp;</span></strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">COMPLIMENTARY<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;TYPE:&nbsp;</strong>GROUP TOUR</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">MINIMUM NUMBER:&nbsp;</span></strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">4<strong>&nbsp;</strong></span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">PACKAGE INCLUDES: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">Transfers from hotel to start point, All Entrance Tickets, Lunch, Professional Tour Guiding</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">(All confirmed documents will be sent via mail immediately payment is received)</span></p>', '<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">This is a group tours scheduled on Tuesdays and Thursdays. This day trip is set in the heart of the capital, however away from the hustle and bustle of the main city. This is a trip designed to give Tourists the most recreational and aesthetic experience ever within a day. The package contains elements of education, exposure and a taste of African warmth, hospitality and beauty. Please note that bookings can be confirmed based on availability.</span></em></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">Participant will be pick up from the respective accommodation. The tour begins with a journey to the Ghana&rsquo;s National Museum. From the Museum, we shall walk through the local traditional market; the Makola Market. This is one of the largest and busiest local markets in West Africa. Here we experience an amazing scenery, sights and smell that characterizes our markets, an experience you won&rsquo;t get anywhere.</span></em></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">The tour continues with a trip down memory lane as we learn about the African Man of the Century, Osagyefo Dr. Kwame Nkrumah at the Kwame Nkrumah Museum. Participants shall then have a taste of African arts and culture as are exposed to the intricacies of the Arts Centre</span></em></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">From here, participants take a tour through Jamestown, major custodians of the Ga (Accra) land. We shall visit the Colonial Light House. The tour continues with a journey to the Liberation Square and Ghana&rsquo;s Independence Square as we are exposed to the bare facts of an independence that excited Freedom through West Africa. From here, we take a break as we enjoy one of Ghana&rsquo;s scenic wealth; the amazing white sand beaches.</span></em></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><em><span style="font-family: ''Cambria Math'',serif;">Participants will be drop off at their respective accommodation.</span></em></p>', '<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Visit to National Museum</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Taste of rich traditional Ghanaian meal</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Exposure to real African Arts and Culture at the Arts Center</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Journey into the past through the eyes of the Usher Fort/Lighthouse</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Visit Kwame Nkrumah Mausoleum</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Drive through the Makola Market (one of the busiest local markets in West Africa)</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">Visit to the Dubois Memorial Centre</span></p>', '', '<p class="MsoNormal" style="text-align: justify; line-height: normal;"><strong><span style="font-size: 12.0pt; font-family: ''Cambria Math'',serif;">EXCLUSION</span></strong></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;">All Personal Shopping and Personal Activitiie</span></p>\r\n<p class="MsoNormal" style="text-align: justify; line-height: normal;"><span style="font-family: ''Cambria Math'',serif;"><span style="font-family: ''Open Sans'', Arial, sans-serif; font-size: 13px; text-align: start; color: #666666; font-weight: bold;">Summary of The Day:&nbsp;</span><span style="font-family: ''Open Sans'', Arial, sans-serif; font-size: 13px; text-align: start;">After roaming Rome, you shall now visit Venice on the next leg of your 12-day Europe Tour! Take note of the scenery on the way - vineyards and orchards flash in front of a majestic mountain backdrop. The diversity of the Italian landscape will continue to impress. And then ... Venice. A unique city, perched across 118 islands, known for its canals, gondolas, Venetian masks, piazzas, art, and traditional glass and lace making. Your tour leader will introduce you to the city with an orientation walk so you can use your free time in the early evening to explore. See the world-famous St Marks Square, Grand Canal and Rialto Bridge. The evening is yours to enjoy authentic Italian delights, with hundreds of fantastic local restaurants and bars to choose from. After an espresso, explore Venice the traditional way - from the canals. Take a gondola ride which gives you a completely different perspective and appreciation for the amazing structure of this supremely unique location.</span></span></p>', 1, '2017-02-25 23:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `tour_booking`
--

CREATE TABLE IF NOT EXISTS `tour_booking` (
  `id` int(11) NOT NULL,
  `agent` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `excursion_date` date NOT NULL,
  `excursion_time` time NOT NULL,
  `datee` datetime NOT NULL,
  `orderId` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int(11) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `images` varchar(300) NOT NULL,
  `vehicle` varchar(300) NOT NULL,
  `persons` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `class` varchar(100) NOT NULL,
  `datee` datetime NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pick_up` varchar(255) NOT NULL,
  `drop_off` varchar(255) NOT NULL,
  `sup_name` varchar(255) NOT NULL,
  `sup_addr` text NOT NULL,
  `sup_email` varchar(255) NOT NULL,
  `sup_tel` varchar(255) NOT NULL,
  `policy` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `cat`, `images`, `vehicle`, `persons`, `price`, `class`, `datee`, `country`, `city`, `pick_up`, `drop_off`, `sup_name`, `sup_addr`, `sup_email`, `sup_tel`, `policy`) VALUES
(1, 'Daily Rentals', 'uploads/cars/car1.jpg', 'Sedan', 3, 150, 'daily', '2016-12-20 08:18:02', 'Ghana', 'Accra', 'Intra City  ', 'Intra City  ', 'Supplier Name', 'Suite 4 Level 1, 141 Bridge Road\nLondon, E2 8DY.', 'supplier@email.com', '+2315480000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.'),
(2, 'Daily Rentals', 'uploads/cars/car3.jpg', '4x4', 4, 200, 'daily', '2016-11-18 09:28:00', 'Ghana', 'Accra', 'Intra City  ', 'Intra City  ', 'Supplier Name', 'Suite 4 Level 1, 141 Bridge Road\nLondon, E2 8DY.', 'supplier@email.com', '+2315480000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.'),
(3, 'Daily Rentals', 'uploads/cars/car2.jpg', 'Caravan', 9, 0, 'daily', '2016-11-18 09:29:27', 'Ghana', 'Accra', 'Intra City  ', 'Intra City  ', 'travelAfric car Rebtals', '2221 Lincoln Blvd 90291 Venice, Los Angeles.', 'no-reply@domain.com', '123 456 7890', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.'),
(4, 'Daily Rentals', 'uploads/cars/car4.png', 'Bus', 3, 500, 'daily', '2016-11-18 09:29:42', 'Ghana', 'Accra', 'Intra City  ', 'Intra City  ', '', '', '', '', ''),
(5, 'Daily Rentals', '', 'Sedan', 3, 0, 'daily', '2016-11-18 09:30:06', 'Ghana', 'Accra', 'Inter City', 'Inter City', '', '', '', '', ''),
(6, 'Daily Rentals', '', '4x4', 2, 0, 'daily', '2016-11-18 09:30:26', 'Ghana', 'Accra', 'Inter City', 'Inter City', '', '', '', '', ''),
(7, 'Daily Rentals', '', 'Caravan', 3, 0, 'daily', '2016-11-18 09:30:43', 'Ghana', 'Accra', 'Inter City', 'Inter City', '', '', '', '', ''),
(8, 'Daily Rentals', '', 'Bus', 3, 0, 'daily', '2016-11-18 09:30:56', 'Ghana', 'Accra', 'Inter City', 'Inter City', '', '', '', '', ''),
(9, 'Point to Point', 'uploads/cars/car8.png', 'Sedan', 3, 200, 'point', '2016-11-18 11:32:35', 'Ghana', 'Accra', 'Airport', 'Accommodation ', '', '', '', '', ''),
(10, 'Point to Point', 'uploads/cars/car5.png', '4x4', 4, 200, 'point', '2016-11-18 11:34:04', 'Ghana', 'Accra', 'Airport', 'Accommodation ', 'I-Travel car remtals', '2221 Lincoln Blvd 90291 Venice, Los Angeles.', 'no-reply@domain.com', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.'),
(11, 'Point to Point', 'uploads/cars/car2.jpg', 'Caravan', 9, 100, 'point', '2016-11-18 11:34:17', 'Ghana', 'Accra', 'Airport', 'Accommodation ', '', '', '', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the standard dummy text.'),
(12, 'Point to Point', 'uploads/cars/car9.png', 'Bus', 30, 500, 'point', '2016-11-18 11:34:33', 'Ghana', 'Accra', 'Airport', 'Accommodation ', '', '', '', '', ''),
(13, 'Point to Point', '', 'Sedan', 3, 0, 'point', '2016-11-18 11:32:35', 'Ghana', 'Accra', 'Accommodation ', 'Accommodation ', '', '', '', '', ''),
(14, 'Point to Point', '', '4x4', 4, 0, 'point', '2016-11-18 11:34:04', 'Ghana', 'Accra', 'Accommodation ', 'Accommodation ', '', '', '', '', ''),
(15, 'Point to Point', '', 'Caravan', 9, 0, 'point', '2016-11-18 11:34:17', 'Ghana', 'Accra', 'Accommodation ', 'Accommodation ', '', '', '', '', ''),
(16, 'Point to Point', '', 'Bus', 30, 0, 'point', '2016-11-18 11:34:33', 'Ghana', 'Accra', 'Accommodation ', 'Accommodation ', '', '', '', '', ''),
(17, 'Point to Point', '', 'Sedan', 3, 0, 'point', '2016-11-18 11:32:35', 'Ghana', 'Accra', 'Airport', 'Port', '', '', '', '', ''),
(18, 'Point to Point', '', '4x4', 4, 0, 'point', '2016-11-18 11:34:04', 'Ghana', 'Accra', 'Airport', 'Port', '', '', '', '', ''),
(19, 'Point to Point', '', 'Caravan', 9, 0, 'point', '2016-11-18 11:34:17', 'Ghana', 'Accra', 'Airport', 'Port', '', '', '', '', ''),
(20, 'Point to Point', '', 'Bus', 30, 0, 'point', '2016-11-18 11:34:33', 'Ghana', 'Accra', 'Airport', 'Port', '', '', '', '', ''),
(21, 'Point to Point', '', 'Sedan', 3, 0, 'point', '2016-11-18 11:32:35', 'Ghana', 'Accra', 'Accommodation ', 'Port/Station', '', '', '', '', ''),
(22, 'Point to Point', '', '4x4', 4, 0, 'point', '2016-11-18 11:34:04', 'Ghana', 'Accra', 'Accommodation ', 'Port/Station', '', '', '', '', ''),
(23, 'Point to Point', '', 'Caravan', 9, 0, 'point', '2016-11-18 11:34:17', 'Ghana', 'Accra', 'Accommodation ', 'Port/Station', '', '', '', '', ''),
(24, 'Point to Point', '', 'Bus', 30, 0, 'point', '2016-11-18 11:34:33', 'Ghana', 'Accra', 'Accommodation ', 'Port/Station', '', '', '', '', ''),
(25, 'Point to Point', '', 'Sedan', 3, 0, 'point', '2016-11-18 11:32:35', 'Ghana', 'Accra', 'Other', 'Other', '', '', '', '', ''),
(26, 'Point to Point', '', '4x4', 4, 0, 'point', '2016-11-18 11:34:04', 'Ghana', 'Accra', 'Other', 'Other', '', '', '', '', ''),
(27, 'Point to Point', '', 'Caravan', 9, 0, 'point', '2016-11-18 11:34:17', 'Ghana', 'Accra', 'Other', 'Other', '', '', '', '', ''),
(28, 'Point to Point', '', 'Bus', 30, 0, 'point', '2016-11-18 11:34:33', 'Ghana', 'Accra', 'Other', 'Other', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transfers_booking`
--

CREATE TABLE IF NOT EXISTS `transfers_booking` (
  `id` int(11) NOT NULL,
  `agent` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `pick_addr` varchar(255) NOT NULL,
  `pick_date` date NOT NULL,
  `pick_time` varchar(255) NOT NULL,
  `drop_addr` text NOT NULL,
  `drop_date` varchar(255) NOT NULL,
  `drop_time` varchar(255) NOT NULL,
  `datee` datetime NOT NULL,
  `orderId` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfers_booking`
--

INSERT INTO `transfers_booking` (`id`, `agent`, `trans_id`, `payment`, `cost`, `fullname`, `email`, `tel`, `pick_addr`, `pick_date`, `pick_time`, `drop_addr`, `drop_date`, `drop_time`, `datee`, `orderId`) VALUES
(1, 2, 10, 1, 200, 'fname lname', 'ss@dd.com', '2222222254', 'Suite 4 Level 1, 141 Bridge Road\nLondon, E2 8DY.', '2016-12-14', '06:00', '2221 Lincoln Blvd 90291 Venice, Los Angeles.', '2016-12-16', '08:00', '2016-12-13 17:18:35', '7B0C9E68-7692-427E-BBFB-C3961F03E005');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'Client',
  `fname` varchar(70) NOT NULL,
  `lname` varchar(70) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `fname`, `lname`, `username`, `tel`, `email`, `password`, `salt`, `regDate`) VALUES
(1, 'admin', 'Super', 'Admin', 'admin', '05479814', 'admin@admin.com', '644cceade8fe9abeeb6f9a4b835a56538f598b3fd8e3c5c219a0cc6056c4b9b8', '0SÃYÖØ×üµ¬‰¸5\rß~©ODUzœ…ªQÔ', '2016-02-17 20:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL,
  `hash` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cust_id` (`cust_id`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excursion`
--
ALTER TABLE `excursion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excursion_booking`
--
ALTER TABLE `excursion_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_booking`
--
ALTER TABLE `tour_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers_booking`
--
ALTER TABLE `transfers_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `excursion`
--
ALTER TABLE `excursion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `excursion_booking`
--
ALTER TABLE `excursion_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tour_booking`
--
ALTER TABLE `tour_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `transfers_booking`
--
ALTER TABLE `transfers_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
