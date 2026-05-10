/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.25-MariaDB : Database - smm_free
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`smm_free` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `smm_free`;

/*Table structure for table `api_providers` */

DROP TABLE IF EXISTS `api_providers`;

CREATE TABLE `api_providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `balance` decimal(15,5) DEFAULT NULL,
  `currency_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `changed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_user_id_foreign` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `api_providers` */

insert  into `api_providers`(`id`,`ids`,`uid`,`name`,`url`,`key`,`type`,`balance`,`currency_code`,`description`,`status`,`created`,`changed`) values (5,'7412ae9d4804118de1cc758cb1dd1bdb',NULL,'Vnsmm','https://vnsmm.net/api/v1','GkPrAsqIghrCzjJUyTFxXQfjatTr5nQG','standard',0.00000,NULL,'',1,'2024-12-12 10:46:34','2024-12-12 10:46:34');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `changed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

/*Data for the table `categories` */

/*Table structure for table `faqs` */

DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `answer` longtext DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `changed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `faqs` */

/*Table structure for table `general_custom_page` */

DROP TABLE IF EXISTS `general_custom_page`;

CREATE TABLE `general_custom_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `pid` int(1) DEFAULT 1,
  `position` int(1) DEFAULT 0,
  `name` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `general_custom_page` */

/*Table structure for table `general_file_manager` */

DROP TABLE IF EXISTS `general_file_manager`;

CREATE TABLE `general_file_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `file_name` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `file_type` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `file_ext` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `file_size` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `is_image` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `image_width` int(11) DEFAULT NULL,
  `image_height` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=316 DEFAULT CHARSET=latin1;

/*Data for the table `general_file_manager` */

/*Table structure for table `general_lang` */

DROP TABLE IF EXISTS `general_lang`;

CREATE TABLE `general_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` varchar(100) DEFAULT NULL,
  `lang_code` varchar(10) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `general_lang` */

/*Table structure for table `general_lang_list` */

DROP TABLE IF EXISTS `general_lang_list`;

CREATE TABLE `general_lang_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` varchar(225) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `country_code` varchar(225) DEFAULT NULL,
  `is_default` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `general_lang_list` */

insert  into `general_lang_list`(`id`,`ids`,`code`,`country_code`,`is_default`,`status`,`created`) values (1,'b8afe93284c0a92dc37737362aa2eaf6','en','GB',1,1,'2024-12-12 10:28:13');

/*Table structure for table `general_news` */

DROP TABLE IF EXISTS `general_news`;

CREATE TABLE `general_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `changed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_user_id_foreign` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `general_news` */

/*Table structure for table `general_options` */

DROP TABLE IF EXISTS `general_options`;

CREATE TABLE `general_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4;

/*Data for the table `general_options` */

insert  into `general_options`(`id`,`name`,`value`) values (67,'enable_https','0'),(68,'is_maintenance_mode','0'),(69,'enable_disable_homepage',''),(70,'website_desc','Loishvizo Boosting Solutions - #1 SMM Panel Uganda | Boost TikTok, YouTube, Instagram & More'),(71,'website_keywords','loishvizo smm panel, smm panel uganda, tiktok followers, youtube views, instagram likes, smm reseller panel, boost followers, pesapal smm panel, ugx smm panel'),(72,'website_title','Loishvizo Boosting Solutions - SMM Panel'),(73,'website_favicon',''),(74,'embed_head_javascript',''),(75,'website_logo',''),(76,'website_logo_white',''),(77,'enable_service_list_no_login',''),(78,'disable_signup_page',''),(79,'notification_popup_content',''),(80,'is_cookie_policy_page',''),(81,'enable_api_tab',''),(82,'contact_tel','+256 707 291 063'),(83,'contact_email','loishvizo@gmail.com'),(84,'contact_work_hour','Mon - Sat 08:00 AM - 10:00 PM (EAT)'),(85,'social_facebook_link',''),(86,'social_twitter_link',''),(87,'social_instagram_link',''),(88,'social_pinterest_link',''),(89,'social_tumblr_link',''),(90,'social_youtube_link',''),(91,'copy_right_content','Copyright &copy; 2026 Loishvizo Boosting Solutions. All Rights Reserved.'),(92,'embed_javascript',''),(93,'enable_notification_popup','0'),(94,'default_limit_per_page','10'),(95,'enable_goolge_recapcha',''),(96,'admin_auto_logout_when_change_ip','0'),(97,'website_logo_mark',''),(98,'default_price_percentage_increase','30'),(99,'website_name','Loishvizo Boosting Solutions'),(100,'is_clear_ticket','0'),(101,'default_clear_ticket_days','30'),(102,'default_pending_ticket_per_user','2'),(103,'default_min_order','300'),(104,'default_max_order','5000'),(105,'default_price_per_1k','0.80'),(106,'enable_drip_feed','0'),(107,'default_drip_feed_runs','10'),(108,'default_drip_feed_interval','30'),(109,'enable_explication_service_symbol','0'),(110,'enable_news_announcement','0'),(111,'enable_signup_skype_field','0'),(112,'google_capcha_site_key',''),(113,'google_capcha_secret_key',''),(114,'cookies_policy_page','<p><strong>Lorem Ipsum</strong></p><p>Lorem ipsum dolor sit amet, in eam consetetur consectetuer. Vivendo eleifend postulant ut mei, vero maiestatis cu nam. Qui et facer mandamus, nullam regione lucilius eu has. Mei an vidisse facilis posidonium, eros minim deserunt per ne.</p><p>Duo quando tibique intellegam at. Nec error mucius in, ius in error legendos reformidans. Vidisse dolorum vulputate cu ius. Ei qui stet error consulatu.</p><p>Mei habeo prompta te. Ignota commodo nam ei. Te iudico definitionem sed, placerat oporteat tincidunt eu per, stet clita meliore usu ne. Facer debitis ponderum per no, agam corpora recteque at mel.</p>'),(115,'terms_content','<p><strong>Lorem Ipsum</strong></p><p>Lorem ipsum dolor sit amet, in eam consetetur consectetuer. Vivendo eleifend postulant ut mei, vero maiestatis cu nam. Qui et facer mandamus, nullam regione lucilius eu has. Mei an vidisse facilis posidonium, eros minim deserunt per ne.</p><p>Duo quando tibique intellegam at. Nec error mucius in, ius in error legendos reformidans. Vidisse dolorum vulputate cu ius. Ei qui stet error consulatu.</p><p>Mei habeo prompta te. Ignota commodo nam ei. Te iudico definitionem sed, placerat oporteat tincidunt eu per, stet clita meliore usu ne. Facer debitis ponderum per no, agam corpora recteque at mel.</p>'),(116,'policy_content','<p><strong>Lorem Ipsum</strong></p><p>Lorem ipsum dolor sit amet, in eam consetetur consectetuer. Vivendo eleifend postulant ut mei, vero maiestatis cu nam. Qui et facer mandamus, nullam regione lucilius eu has. Mei an vidisse facilis posidonium, eros minim deserunt per ne.</p><p>Duo quando tibique intellegam at. Nec error mucius in, ius in error legendos reformidans. Vidisse dolorum vulputate cu ius. Ei qui stet error consulatu.</p><p>Mei habeo prompta te. Ignota commodo nam ei. Te iudico definitionem sed, placerat oporteat tincidunt eu per, stet clita meliore usu ne. Facer debitis ponderum per no, agam corpora recteque at mel.</p>'),(117,'is_active_manual',''),(118,'manual_payment_content','You can make a manual payment to cover an outstanding balance. Once time, open a ticket and contact with Administrator.'),(119,'verification_email_subject','{{website_name}} - Please validate your account'),(120,'verification_email_content','<p><strong>Welcome to {{website_name}}! </strong></p><p>Hello <strong>{{user_firstname}}</strong>!</p><p> Thank you for joining! We&#39;re glad to have you as community member, and we&#39;re stocked for you to start exploring our service.  If you don&#39;t verify your address, you won&#39;t be able to create a User Account.</p><p>  All you need to do is activate your account by click this link: <br>  {{activation_link}} </p><p>Thanks and Best Regards!</p>'),(121,'email_welcome_email_subject','{{website_name}} - Getting Started with Our Service!'),(122,'email_welcome_email_content','<p><strong>Welcome to {{website_name}}! </strong></p><p>Hello <strong>{{user_firstname}}</strong>!</p><p>Congratulations! <br>You have successfully signed up for our service - {{website_name}} with follow data</p><ul><li>Firstname: {{user_firstname}}</li><li>Lastname: {{user_lastname}}</li><li>Email: {{user_email}}</li><li>Timezone: {{user_timezone}}</li></ul><p>We want to exceed your expectations, so please do not hesitate to reach out at any time if you have any questions or concerns. We look to working with you.</p><p>Best Regards,</p>'),(123,'email_new_registration_subject','{{website_name}} - New Registration'),(124,'email_new_registration_content','<p>Hi Admin!</p><p>Someone signed up in <strong>{{website_name}}</strong> with follow data</p><ul><li>Firstname {{user_firstname}}</li><li>Lastname: {{user_lastname}}</li><li>Email: {{user_email}}</li><li>Timezone: {{user_timezone}}</li></ul> '),(125,'email_password_recovery_subject','{{website_name}} - Password Recovery'),(126,'email_password_recovery_content','<p>Hi<strong> {{user_firstname}}! </strong></p><p>Somebody (hopefully you) requested a new password for your account. </p><p>No changes have been made to your account yet. <br>You can reset your password by click this link: <br>{{recovery_password_link}}</p><p>If you did not request a password reset, no further action is required. </p><p>Thanks and Best Regards!</p>                '),(127,'email_payment_notice_subject','{{website_name}} -  Thank You! Deposit Payment Received'),(128,'email_payment_notice_content','<p>Hi<strong> {{user_firstname}}! </strong></p><p>We&#39;ve just received your final remittance and would like to thank you. We appreciate your diligence in adding funds to your balance in our service.</p><p>It has been a pleasure doing business with you. We wish you the best of luck.</p><p>Thanks and Best Regards!</p>'),(129,'is_verification_new_account','0'),(130,'is_welcome_email','0'),(131,'is_new_user_email','0'),(132,'is_payment_notice_email','0'),(133,'is_ticket_notice_email','0'),(134,'is_ticket_notice_email_admin','0'),(135,'is_order_notice_email','0'),(136,'email_from',''),(137,'email_name',''),(138,'email_protocol_type','php_mail'),(139,'smtp_server',''),(140,'smtp_port',''),(141,'smtp_encryption',''),(142,'smtp_username',''),(143,'smtp_password',''),(144,'currency_symbol','$'),(145,'currency_decimal','2'),(146,'currency_decimal_separator','dot'),(147,'currency_thousand_separator','comma');

/*Table structure for table `general_purchase` */

DROP TABLE IF EXISTS `general_purchase`;

CREATE TABLE `general_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `pid` text DEFAULT NULL,
  `purchase_code` text DEFAULT NULL,
  `version` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `general_purchase` */

insert  into `general_purchase`(`id`,`ids`,`pid`,`purchase_code`,`version`) values (1,'8068ec7f79145fe55dea67dd63b012c3','23595718','ITEM-PURCHASE-CODE','4.0');

/*Table structure for table `general_sessions` */

DROP TABLE IF EXISTS `general_sessions`;

CREATE TABLE `general_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `general_sessions` */

insert  into `general_sessions`(`id`,`ip_address`,`timestamp`,`data`) values ('cdn3sl6psk06qgmt9g6jt435t5lf7fj5','127.0.0.1',1733975104,'sid|s:2:\"10\";staff_current_info|a:3:{s:10:\"first_name\";s:5:\"Evans\";s:9:\"last_name\";s:6:\"Nguyen\";s:8:\"timezone\";s:14:\"Asia/Singapore\";}__ci_last_regenerate|i:1733975104;langCurrent|O:8:\"stdClass\":7:{s:2:\"id\";s:1:\"1\";s:3:\"ids\";s:32:\"b8afe93284c0a92dc37737362aa2eaf6\";s:4:\"code\";s:2:\"en\";s:12:\"country_code\";s:2:\"GB\";s:10:\"is_default\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2024-12-12 10:28:13\";}'),('b8juau39a9jjkutf57a013uvi2tf2t37','127.0.0.1',1733975560,'__ci_last_regenerate|i:1733975268;langCurrent|O:8:\"stdClass\":7:{s:2:\"id\";s:1:\"1\";s:3:\"ids\";s:32:\"b8afe93284c0a92dc37737362aa2eaf6\";s:4:\"code\";s:2:\"en\";s:12:\"country_code\";s:2:\"GB\";s:10:\"is_default\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2024-12-12 10:28:13\";}sid|s:2:\"10\";staff_current_info|a:3:{s:10:\"first_name\";s:5:\"Evans\";s:9:\"last_name\";s:6:\"Nguyen\";s:8:\"timezone\";s:14:\"Asia/Singapore\";}');

/*Table structure for table `general_staffs` */

DROP TABLE IF EXISTS `general_staffs`;

CREATE TABLE `general_staffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `role_id` int(1) DEFAULT NULL,
  `admin` int(1) DEFAULT NULL,
  `login_type` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `timezone` text DEFAULT NULL,
  `settings` longtext DEFAULT NULL,
  `activation_key` text DEFAULT NULL,
  `reset_key` text DEFAULT NULL,
  `history_ip` text DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `general_staffs` */

insert  into `general_staffs`(`id`,`ids`,`role_id`,`admin`,`login_type`,`first_name`,`last_name`,`email`,`password`,`timezone`,`settings`,`activation_key`,`reset_key`,`history_ip`,`status`,`changed`,`created`) values (10,'0daef7a15e4c230f9d3a0db5975de031',1,1,NULL,'Evans','Nguyen','admin@gmail.com','$2a$08$zcgCYoZYr3Uhp/JxvUuQTe7KMVUyxHjsSXgBaG1aUba0ouTyVi/vG','Asia/Singapore',NULL,NULL,'3eff98f1c51c947d15f2283c304a1470','127.0.0.1',1,'2024-12-12 10:48:35',NULL);

/*Table structure for table `general_subscribers` */

DROP TABLE IF EXISTS `general_subscribers`;

CREATE TABLE `general_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `general_subscribers` */

/*Table structure for table `general_transaction_logs` */

DROP TABLE IF EXISTS `general_transaction_logs`;

CREATE TABLE `general_transaction_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `payer_email` varchar(255) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `transaction_id` text DEFAULT NULL,
  `txn_fee` double DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

/*Data for the table `general_transaction_logs` */

/*Table structure for table `general_users` */

DROP TABLE IF EXISTS `general_users`;

CREATE TABLE `general_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `login_type` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `timezone` text DEFAULT NULL,
  `more_information` text DEFAULT NULL,
  `settings` longtext DEFAULT NULL,
  `desc` longtext DEFAULT NULL,
  `balance` decimal(15,4) DEFAULT 0.0000,
  `custom_rate` int(11) NOT NULL DEFAULT 0,
  `api_key` varchar(191) DEFAULT NULL,
  `spent` varchar(225) DEFAULT NULL,
  `activation_key` text DEFAULT NULL,
  `reset_key` text DEFAULT NULL,
  `history_ip` text DEFAULT NULL,
  `ref_key` varchar(10) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

/*Data for the table `general_users` */

/*Table structure for table `general_users_price` */

DROP TABLE IF EXISTS `general_users_price`;

CREATE TABLE `general_users_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `general_users_price` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ids` text CHARACTER SET utf8 DEFAULT NULL,
  `type` enum('direct','api') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'direct',
  `cate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_order_id` int(11) DEFAULT NULL,
  `service_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'default',
  `api_provider_id` int(11) DEFAULT NULL,
  `api_service_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_order_id` int(11) DEFAULT 0,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usernames` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hashtags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hashtag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_posts` int(11) DEFAULT NULL,
  `sub_min` int(11) DEFAULT NULL,
  `sub_max` int(11) DEFAULT NULL,
  `sub_delay` int(11) DEFAULT NULL,
  `sub_expiry` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_response_orders` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_response_posts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_status` enum('Active','Paused','Completed','Expired','Canceled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(15,4) DEFAULT NULL,
  `formal_charge` decimal(15,4) DEFAULT NULL,
  `profit` decimal(15,4) DEFAULT NULL,
  `status` enum('active','completed','processing','inprogress','pending','partial','canceled','refunded','awaiting','error','fail') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `start_counter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remains` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_drip_feed` int(1) DEFAULT 0,
  `runs` int(11) DEFAULT 0,
  `interval` int(2) DEFAULT 0,
  `dripfeed_quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `refill` int(1) DEFAULT 0 COMMENT '1 -->active 0 --> Not Allowed',
  `refill_status` int(1) DEFAULT NULL COMMENT '1 - Pending, 3 - In Process, 2 - Awaiting, 4 - Rejected, 5 - Fail, 7 - Complete',
  `refill_date` datetime DEFAULT NULL COMMENT 'Refill update Time',
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=379032 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(225) NOT NULL,
  `min` double NOT NULL,
  `max` double NOT NULL,
  `sort` int(3) DEFAULT NULL,
  `new_users` int(1) NOT NULL DEFAULT 0 COMMENT '1:Allowed, 0: Not Allowed',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1 -> ON, 0 -> OFF',
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

insert  into `payments`(`id`,`type`,`name`,`min`,`max`,`sort`,`new_users`,`status`,`params`) values (13,'paypal','Paypal Checkout',10,100,NULL,1,0,'{\"type\":\"paypal\",\"name\":\"Paypal Checkout\",\"min\":\"10\",\"max\":\"100\",\"new_users\":\"1\",\"status\":\"1\",\"take_fee_from_user\":\"0\",\"option\":{\"environment\":\"sandbox\",\"client_id\":\"\",\"secret_key\":\"\"}}'),(14,'stripe','Stripe Checkout',5,100,NULL,0,0,'{\"type\":\"stripe\",\"name\":\"Stripe Checkout\",\"min\":\"5\",\"max\":\"100\",\"new_users\":\"0\",\"status\":\"1\",\"option\":{\"tnx_fee\":\"10\",\"environment\":\"sandbox\",\"public_key\":\"\",\"secret_key\":\"\"}}');

INSERT IGNORE INTO `payments`(`id`,`type`,`name`,`min`,`max`,`sort`,`new_users`,`status`,`params`) VALUES
(20,'airtel_money','Airtel Money (Uganda)',5000,5000000,10,1,1,'{\"type\":\"airtel_money\",\"name\":\"Airtel Money Uganda\",\"min\":\"5000\",\"max\":\"5000000\",\"new_users\":\"1\",\"status\":\"1\",\"currency\":\"UGX\",\"option\":{\"tnx_fee\":\"0\"}}'),
(21,'mtn_money','MTN Mobile Money (Uganda)',5000,5000000,11,1,1,'{\"type\":\"mtn_money\",\"name\":\"MTN Mobile Money Uganda\",\"min\":\"5000\",\"max\":\"5000000\",\"new_users\":\"1\",\"status\":\"1\",\"currency\":\"UGX\",\"option\":{\"tnx_fee\":\"0\"}}'),
(22,'mastercard','Mastercard',1,1000,12,1,1,'{\"type\":\"mastercard\",\"name\":\"Mastercard\",\"min\":\"1\",\"max\":\"1000\",\"new_users\":\"1\",\"status\":\"1\",\"currency\":\"USD\",\"option\":{\"tnx_fee\":\"0\"}}');

/*Table structure for table `payments_bonus` */

DROP TABLE IF EXISTS `payments_bonus`;

CREATE TABLE `payments_bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` varchar(100) DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `bonus_from` double NOT NULL,
  `percentage` double NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payments_bonus` */

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ids` text DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `price` decimal(15,4) DEFAULT NULL,
  `original_price` decimal(15,4) DEFAULT NULL,
  `deny_duplicates` int(1) DEFAULT 0,
  `refill` int(1) NOT NULL DEFAULT 0,
  `refill_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 -> provider , 0 -> manual',
  `min` int(50) DEFAULT NULL,
  `max` int(50) DEFAULT NULL,
  `add_type` enum('manual','api') DEFAULT 'manual',
  `type` varchar(100) DEFAULT 'default',
  `api_service_id` varchar(200) DEFAULT NULL,
  `api_provider_id` int(11) DEFAULT NULL,
  `dripfeed` int(1) DEFAULT 0,
  `status` int(1) DEFAULT 1,
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `services` */

/*Table structure for table `ticket_messages` */

DROP TABLE IF EXISTS `ticket_messages`;

CREATE TABLE `ticket_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `author` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support` int(1) DEFAULT 0 COMMENT '1 - From support , 0 - From client',
  `ticket_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `changed` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_messages_user_id_foreign` (`uid`),
  KEY `ticket_messages_ticket_id_foreign` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ticket_messages` */

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('new','pending','closed','answered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_read` double NOT NULL DEFAULT 0,
  `admin_read` double NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `changed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_user_id_foreign` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tickets` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;

/* ============================================================
   Loishvizo Boosting Solutions - Branding & Configuration
   ============================================================ */

/* Core branding */
UPDATE `general_options` SET `value` = 'Loishvizo Boosting Solutions' WHERE `name` = 'website_name';
UPDATE `general_options` SET `value` = 'Loishvizo Boosting Solutions - #1 SMM Panel Uganda | Boost TikTok, YouTube, Instagram & More' WHERE `name` = 'website_title';
UPDATE `general_options` SET `value` = 'Loishvizo Boosting Solutions - Ultra-fast SMM panel Uganda. Boost TikTok followers, YouTube views, Instagram likes, Spotify streams instantly. UGX payments via PesaPal, MTN Mobile Money, Airtel Money.' WHERE `name` = 'website_desc';
UPDATE `general_options` SET `value` = 'loishvizo smm panel, smm panel uganda, tiktok followers, youtube views, instagram likes, smm reseller panel, boost followers, pesapal smm panel, ugx smm panel' WHERE `name` = 'website_keywords';
UPDATE `general_options` SET `value` = 'Copyright &copy; 2026 Loishvizo Boosting Solutions. All Rights Reserved.' WHERE `name` = 'copy_right_content';
UPDATE `general_options` SET `value` = 'loishvizo@gmail.com' WHERE `name` = 'contact_email';
UPDATE `general_options` SET `value` = 'loishvizo@gmail.com' WHERE `name` = 'email_from';
UPDATE `general_options` SET `value` = 'Loishvizo Boosting Solutions' WHERE `name` = 'email_name';
UPDATE `general_options` SET `value` = '+256 707 291 063' WHERE `name` = 'contact_tel';
UPDATE `general_options` SET `value` = 'Mon - Sat 08:00 AM - 10:00 PM (EAT)' WHERE `name` = 'contact_work_hour';

/* Clear old logo/favicon paths so admin can set new ones */
UPDATE `general_options` SET `value` = '' WHERE `name` IN ('website_logo', 'website_logo_white', 'website_logo_mark', 'website_favicon');

/* Social links */
UPDATE `general_options` SET `value` = 'https://www.youtube.com/@loishvizo' WHERE `name` = 'social_youtube_link';
UPDATE `general_options` SET `value` = '' WHERE `name` IN ('social_facebook_link', 'social_twitter_link', 'social_instagram_link', 'social_pinterest_link', 'social_tumblr_link');
INSERT IGNORE INTO `general_options` (`name`, `value`) VALUES
('social_tiktok_link', 'https://www.tiktok.com/@loishvizo'),
('social_whatsapp_link', 'https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30'),
('admin_emails', 'Ishamvizo2005@gmail.com,loishvizo@gmail.com,delostvoyage@gmail.com,meddymususwa126@gmail.com');
UPDATE `general_options` SET `value` = 'https://www.tiktok.com/@loishvizo' WHERE `name` = 'social_tiktok_link';
UPDATE `general_options` SET `value` = 'https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30' WHERE `name` = 'social_whatsapp_link';
UPDATE `general_options` SET `value` = 'Ishamvizo2005@gmail.com,loishvizo@gmail.com,delostvoyage@gmail.com,meddymususwa126@gmail.com' WHERE `name` = 'admin_emails';

/* Feature flags */
UPDATE `general_options` SET `value` = '1' WHERE `name` = 'enable_service_list_no_login';
UPDATE `general_options` SET `value` = '1' WHERE `name` = 'enable_api_tab';
INSERT IGNORE INTO `general_options` (`name`, `value`) VALUES ('is_cookie_policy_page', '1');
UPDATE `general_options` SET `value` = '1' WHERE `name` = 'is_cookie_policy_page';

/* Currency: UGX */
INSERT IGNORE INTO `general_options` (`name`, `value`) VALUES ('currency_code', 'UGX');
INSERT IGNORE INTO `general_options` (`name`, `value`) VALUES ('currency_symbol', 'UGX ');
UPDATE `general_options` SET `value` = 'UGX' WHERE `name` = 'currency_code';
UPDATE `general_options` SET `value` = 'UGX ' WHERE `name` = 'currency_symbol';
UPDATE `general_options` SET `value` = '0' WHERE `name` = 'currency_decimal';
UPDATE `general_options` SET `value` = 'none' WHERE `name` = 'currency_decimal_separator';
UPDATE `general_options` SET `value` = 'comma' WHERE `name` = 'currency_thousand_separator';

/* Disable unused payment gateways */
UPDATE `payments` SET `status` = 0 WHERE `type` IN ('paypal', 'stripe', 'airtel_money', 'mtn_money', 'mastercard');

/* PesaPal payment method */
INSERT IGNORE INTO `payments` (`id`, `type`, `name`, `min`, `max`, `sort`, `new_users`, `status`, `params`) VALUES
(23, 'pesapal', 'PesaPal (MTN MoMo / Airtel Money / Mastercard / Visa)', 5000, 10000000, 1, 1, 1,
'{"type":"pesapal","name":"PesaPal","min":"5000","max":"10000000","new_users":"1","status":"1","consumer_key":"5Tj1LQ/T7CHpBKwGa+qpsg//M5aKqciy","consumer_secret":"","sandbox":"0","option":{"tnx_fee":"0"}}');
UPDATE `payments` SET `status` = 1, `sort` = 1, `name` = 'PesaPal (MTN MoMo / Airtel Money / Mastercard / Visa)', `min` = 5000, `max` = 10000000, `new_users` = 1 WHERE `type` = 'pesapal';

/* ============================================================
   SMM Categories (16 platforms)
   ============================================================ */
-- Ensure no duplicate categories
DELETE FROM `categories` WHERE `id` > 16;
INSERT INTO `categories` (`id`, `ids`, `uid`, `name`, `sort`, `status`, `created`, `changed`) VALUES
(1,  'cat_tiktok',    NULL, 'TikTok',       1,  1, NOW(), NOW()),
(2,  'cat_instagram', NULL, 'Instagram',    2,  1, NOW(), NOW()),
(3,  'cat_youtube',   NULL, 'YouTube',      3,  1, NOW(), NOW()),
(4,  'cat_facebook',  NULL, 'Facebook',     4,  1, NOW(), NOW()),
(5,  'cat_twitter',   NULL, 'Twitter / X',  5,  1, NOW(), NOW()),
(6,  'cat_telegram',  NULL, 'Telegram',     6,  1, NOW(), NOW()),
(7,  'cat_spotify',   NULL, 'Spotify',      7,  1, NOW(), NOW()),
(8,  'cat_soundcloud',NULL, 'SoundCloud',   8,  1, NOW(), NOW()),
(9,  'cat_linkedin',  NULL, 'LinkedIn',     9,  1, NOW(), NOW()),
(10, 'cat_whatsapp',  NULL, 'WhatsApp',     10, 1, NOW(), NOW()),
(11, 'cat_pinterest', NULL, 'Pinterest',    11, 1, NOW(), NOW()),
(12, 'cat_twitch',    NULL, 'Twitch',       12, 1, NOW(), NOW()),
(13, 'cat_snapchat',  NULL, 'Snapchat',     13, 1, NOW(), NOW()),
(14, 'cat_discord',   NULL, 'Discord',      14, 1, NOW(), NOW()),
(15, 'cat_reddit',    NULL, 'Reddit',       15, 1, NOW(), NOW()),
(16, 'cat_threads',   NULL, 'Threads',      16, 1, NOW(), NOW());

/* ============================================================
   SMM Services — all prices in UGX per 1,000 units
   Prices shown are UGX per 1,000 units ordered
   ============================================================ */
-- Wipe any old/legacy services first for a clean install
DELETE FROM `services`;
-- Reset auto-increment
ALTER TABLE `services` AUTO_INCREMENT = 1;
INSERT INTO `services` (`id`,`ids`,`cate_id`,`name`,`price`,`original_price`,`min`,`max`,`add_type`,`type`,`status`,`created`,`changed`) VALUES
/* TikTok */
(1, 'svc_tt_followers',1,'TikTok Followers - Real & Active',2000.0000,1400.0000,100,100000,'manual','default',1,NOW(),NOW()),
(2, 'svc_tt_likes',    1,'TikTok Likes - Fast Delivery',     800.0000, 560.0000,100,50000, 'manual','default',1,NOW(),NOW()),
(3, 'svc_tt_views',    1,'TikTok Video Views - Ultra Fast',  250.0000, 175.0000,1000,1000000,'manual','default',1,NOW(),NOW()),
(4, 'svc_tt_comments', 1,'TikTok Custom Comments',          5000.0000,3500.0000,10,1000,  'manual','custom_comments',1,NOW(),NOW()),
(5, 'svc_tt_shares',   1,'TikTok Shares',                   1500.0000,1050.0000,100,10000,'manual','default',1,NOW(),NOW()),
(6, 'svc_tt_story',    1,'TikTok Story Views',               400.0000, 280.0000,500,1000000,'manual','default',1,NOW(),NOW()),
(7, 'svc_tt_saves',    1,'TikTok Saves / Bookmarks',        1000.0000, 700.0000,100,20000,'manual','default',1,NOW(),NOW()),
/* Instagram */
(8, 'svc_ig_followers',2,'Instagram Followers - High Quality',2500.0000,1750.0000,100,50000,'manual','default',1,NOW(),NOW()),
(9, 'svc_ig_likes',    2,'Instagram Post Likes - Instant',    700.0000, 490.0000,100,100000,'manual','default',1,NOW(),NOW()),
(10,'svc_ig_views',    2,'Instagram Video Views',             350.0000, 245.0000,500,1000000,'manual','default',1,NOW(),NOW()),
(11,'svc_ig_story',    2,'Instagram Story Views',             500.0000, 350.0000,100,50000,'manual','default',1,NOW(),NOW()),
(12,'svc_ig_reels',    2,'Instagram Reel Views',              400.0000, 280.0000,500,500000,'manual','default',1,NOW(),NOW()),
(13,'svc_ig_saves',    2,'Instagram Saves',                   600.0000, 420.0000,100,50000,'manual','default',1,NOW(),NOW()),
/* YouTube */
(14,'svc_yt_views',    3,'YouTube Views - High Retention',   1200.0000, 840.0000,1000,500000,'manual','default',1,NOW(),NOW()),
(15,'svc_yt_subs',     3,'YouTube Subscribers - Real',       3500.0000,2450.0000,100,20000,'manual','default',1,NOW(),NOW()),
(16,'svc_yt_likes',    3,'YouTube Likes',                     900.0000, 630.0000,100,50000,'manual','default',1,NOW(),NOW()),
(17,'svc_yt_hours',    3,'YouTube Watch Hours (Monetization)',8000.0000,5600.0000,100,10000,'manual','default',1,NOW(),NOW()),
(18,'svc_yt_comments', 3,'YouTube Comments Custom',          6000.0000,4200.0000,5,500,   'manual','default',1,NOW(),NOW()),
/* Facebook */
(19,'svc_fb_pagelikes',4,'Facebook Page Likes',              1800.0000,1260.0000,100,50000,'manual','default',1,NOW(),NOW()),
(20,'svc_fb_followers',4,'Facebook Profile Followers',       1500.0000,1050.0000,100,50000,'manual','default',1,NOW(),NOW()),
(21,'svc_fb_postlikes',4,'Facebook Post Likes',               700.0000, 490.0000,100,50000,'manual','default',1,NOW(),NOW()),
(22,'svc_fb_views',    4,'Facebook Video Views',              450.0000, 315.0000,1000,500000,'manual','default',1,NOW(),NOW()),
/* Twitter / X */
(23,'svc_tw_followers',5,'Twitter/X Followers',              2000.0000,1400.0000,100,50000,'manual','default',1,NOW(),NOW()),
(24,'svc_tw_likes',    5,'Twitter/X Post Likes',              600.0000, 420.0000,100,100000,'manual','default',1,NOW(),NOW()),
(25,'svc_tw_retweets', 5,'Twitter/X Retweets',               1000.0000, 700.0000,100,20000,'manual','default',1,NOW(),NOW()),
/* Telegram */
(26,'svc_tg_members',  6,'Telegram Channel Members',         1500.0000,1050.0000,100,100000,'manual','default',1,NOW(),NOW()),
(27,'svc_tg_views',    6,'Telegram Post Views',               300.0000, 210.0000,1000,500000,'manual','default',1,NOW(),NOW()),
(28,'svc_tg_group',    6,'Telegram Group Members',            1800.0000,1260.0000,100,50000,'manual','default',1,NOW(),NOW()),
/* Spotify */
(29,'svc_sp_streams',  7,'Spotify Track Streams',             900.0000, 630.0000,1000,500000,'manual','default',1,NOW(),NOW()),
(30,'svc_sp_followers',7,'Spotify Artist Followers',         2500.0000,1750.0000,100,20000,'manual','default',1,NOW(),NOW()),
(31,'svc_sp_monthly',  7,'Spotify Monthly Listeners',        3000.0000,2100.0000,100,50000,'manual','default',1,NOW(),NOW()),
/* SoundCloud */
(32,'svc_sc_plays',    8,'SoundCloud Track Plays',            700.0000, 490.0000,1000,500000,'manual','default',1,NOW(),NOW()),
(33,'svc_sc_followers',8,'SoundCloud Followers',             2500.0000,1750.0000,100,20000,'manual','default',1,NOW(),NOW()),
/* LinkedIn */
(34,'svc_li_followers',9,'LinkedIn Page Followers',          4000.0000,2800.0000,100,10000,'manual','default',1,NOW(),NOW()),
(35,'svc_li_connections',9,'LinkedIn Connections',           5000.0000,3500.0000,50,5000, 'manual','default',1,NOW(),NOW()),
(36,'svc_li_likes',    9,'LinkedIn Post Likes',              1200.0000, 840.0000,50,20000,'manual','default',1,NOW(),NOW()),
/* WhatsApp */
(37,'svc_wa_members', 10,'WhatsApp Channel Members',         2500.0000,1750.0000,100,10000,'manual','default',1,NOW(),NOW()),
/* Pinterest */
(38,'svc_pn_followers',11,'Pinterest Followers',             2000.0000,1400.0000,100,20000,'manual','default',1,NOW(),NOW()),
/* Twitch */
(39,'svc_tw_ch_followers',12,'Twitch Followers',             3000.0000,2100.0000,100,20000,'manual','default',1,NOW(),NOW()),
(40,'svc_tw_ch_views', 12,'Twitch Channel Views',            2000.0000,1400.0000,1000,100000,'manual','default',1,NOW(),NOW()),
/* Snapchat */
(41,'svc_snap_followers',13,'Snapchat Followers',            2500.0000,1750.0000,100,20000,'manual','default',1,NOW(),NOW()),
/* Discord */
(42,'svc_dc_members',  14,'Discord Server Members',          2000.0000,1400.0000,100,20000,'manual','default',1,NOW(),NOW()),
/* Reddit */
(43,'svc_rd_upvotes',  15,'Reddit Post Upvotes',             8000.0000,5600.0000,10,1000, 'manual','default',1,NOW(),NOW()),
/* Threads */
(44,'svc_th_followers',16,'Threads Followers',               2000.0000,1400.0000,100,20000,'manual','default',1,NOW(),NOW()),
(45,'svc_th_likes',    16,'Threads Post Likes',               700.0000, 490.0000,100,50000,'manual','default',1,NOW(),NOW());

/* ============================================================
   FAQs — Real Loishvizo Content
   ============================================================ */
INSERT IGNORE INTO `faqs` (`id`,`question`,`answer`,`sort`,`status`,`created`,`changed`) VALUES
(1,'How quickly will my order be delivered?','Most orders begin within 0-2 hours of payment confirmation. Smaller orders complete within hours; larger orders may take 1-5 days. Track your order status from your dashboard.',1,1,NOW(),NOW()),
(2,'Is my social media account safe?','Yes. We only need your public profile link or username — never your password. Our delivery methods are designed to protect your account.',2,1,NOW(),NOW()),
(3,'What payment methods do you accept?','We accept MTN Mobile Money, Airtel Money, MasterCard, and Visa through our secure PesaPal checkout. All transactions are processed in UGX.',3,1,NOW(),NOW()),
(4,'What if my order is not fully delivered?','If an order does not deliver after 72 hours, open a support ticket. We will investigate and refund any undelivered portion to your account balance.',4,1,NOW(),NOW()),
(5,'Can I place multiple orders at once?','Yes! You can place multiple orders simultaneously from your dashboard. Each order is tracked independently.',5,1,NOW(),NOW()),
(6,'Do you offer refills for dropped followers?','Yes, many services include free refill guarantees. Check the service description before ordering. Refill requests can be submitted from the Orders page.',6,1,NOW(),NOW()),
(7,'How do I contact support?','Open a ticket from your dashboard, email loishvizo@gmail.com, or WhatsApp us at +256 707 291 063. We respond within 30 minutes during business hours.',7,1,NOW(),NOW()),
(8,'Is there an API for resellers?','Yes! We provide a full REST API for resellers. Log in and visit the API section in your dashboard to get your API key and documentation.',8,1,NOW(),NOW()),
(9,'What is the minimum order amount?','The minimum varies by service — most services start at 100 units. The minimum deposit is UGX 5,000.',9,1,NOW(),NOW()),
(10,'Do you serve customers outside Uganda?','Yes! While we specialise in East African payments, we accept international cards via PesaPal and serve customers worldwide.',10,1,NOW(),NOW());

/* Admin staff accounts */
INSERT IGNORE INTO `general_staffs` (`ids`,`role_id`,`admin`,`first_name`,`last_name`,`email`,`password`,`status`,`created`,`changed`) VALUES
('lv_admin_001',1,1,'Isha','Mvizo','Ishamvizo2005@gmail.com','google_oauth_only',1,NOW(),NOW()),
('lv_admin_002',1,1,'Lois','Hvizo','loishvizo@gmail.com','google_oauth_only',1,NOW(),NOW()),
('lv_admin_003',1,1,'Delos','Voyage','delostvoyage@gmail.com','google_oauth_only',1,NOW(),NOW()),
('lv_admin_004',1,1,'Meddy','Mususwa','meddymususwa126@gmail.com','google_oauth_only',1,NOW(),NOW());
UPDATE `general_staffs` SET `admin`=1, `status`=1 WHERE `email` IN ('Ishamvizo2005@gmail.com','loishvizo@gmail.com','delostvoyage@gmail.com','meddymususwa126@gmail.com');

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
