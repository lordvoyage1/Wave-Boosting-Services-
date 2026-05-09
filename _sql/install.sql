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

insert  into `general_options`(`id`,`name`,`value`) values (67,'enable_https','0'),(68,'is_maintenance_mode','0'),(69,'enable_disable_homepage',''),(70,'website_desc','SmartPanel - #1 SMM Reseller Panel - Best SMM Panel for Resellers. Also well known for TOP SMM Panel and Cheap SMM Panel for all kind of Social Media Marketing Services. SMM Panel for Facebook, Instagram, YouTube and more services!            '),(71,'website_keywords','smm panel, SmartPanel, smm reseller panel, smm provider panel, reseller panel, instagram panel, resellerpanel, social media reseller panel, smmpanel, panelsmm, smm, panel, socialmedia, instagram reseller panel            '),(72,'website_title','SmartPanel - SMM Panel Reseller Tool'),(73,'website_favicon','http://yourhost/assets/images/favicon.png'),(74,'embed_head_javascript',''),(75,'website_logo','http://yourhost/assets/images/logo.png'),(76,'website_logo_white','http://yourhost/assets/images/logo-white.png'),(77,'enable_service_list_no_login',''),(78,'disable_signup_page',''),(79,'notification_popup_content',''),(80,'is_cookie_policy_page',''),(81,'enable_api_tab',''),(82,'contact_tel','+12345678'),(83,'contact_email','do-not-reply@smartpanel.com'),(84,'contact_work_hour','Mon - Sat 09 am - 10 pm'),(85,'social_facebook_link',''),(86,'social_twitter_link',''),(87,'social_instagram_link',''),(88,'social_pinterest_link',''),(89,'social_tumblr_link',''),(90,'social_youtube_link',''),(91,'copy_right_content','Copyright &copy; 2020 - SmartPanel'),(92,'embed_javascript',''),(93,'enable_notification_popup','0'),(94,'default_limit_per_page','10'),(95,'enable_goolge_recapcha',''),(96,'admin_auto_logout_when_change_ip','0'),(97,'website_logo_mark','http://yourhost/assets/images/logo-mark.png'),(98,'default_price_percentage_increase','30'),(99,'website_name','SmartPanel Free By Anh Nguyen'),(100,'is_clear_ticket','0'),(101,'default_clear_ticket_days','30'),(102,'default_pending_ticket_per_user','2'),(103,'default_min_order','300'),(104,'default_max_order','5000'),(105,'default_price_per_1k','0.80'),(106,'enable_drip_feed','0'),(107,'default_drip_feed_runs','10'),(108,'default_drip_feed_interval','30'),(109,'enable_explication_service_symbol','0'),(110,'enable_news_announcement','0'),(111,'enable_signup_skype_field','0'),(112,'google_capcha_site_key',''),(113,'google_capcha_secret_key',''),(114,'cookies_policy_page','<p><strong>Lorem Ipsum</strong></p><p>Lorem ipsum dolor sit amet, in eam consetetur consectetuer. Vivendo eleifend postulant ut mei, vero maiestatis cu nam. Qui et facer mandamus, nullam regione lucilius eu has. Mei an vidisse facilis posidonium, eros minim deserunt per ne.</p><p>Duo quando tibique intellegam at. Nec error mucius in, ius in error legendos reformidans. Vidisse dolorum vulputate cu ius. Ei qui stet error consulatu.</p><p>Mei habeo prompta te. Ignota commodo nam ei. Te iudico definitionem sed, placerat oporteat tincidunt eu per, stet clita meliore usu ne. Facer debitis ponderum per no, agam corpora recteque at mel.</p>'),(115,'terms_content','<p><strong>Lorem Ipsum</strong></p><p>Lorem ipsum dolor sit amet, in eam consetetur consectetuer. Vivendo eleifend postulant ut mei, vero maiestatis cu nam. Qui et facer mandamus, nullam regione lucilius eu has. Mei an vidisse facilis posidonium, eros minim deserunt per ne.</p><p>Duo quando tibique intellegam at. Nec error mucius in, ius in error legendos reformidans. Vidisse dolorum vulputate cu ius. Ei qui stet error consulatu.</p><p>Mei habeo prompta te. Ignota commodo nam ei. Te iudico definitionem sed, placerat oporteat tincidunt eu per, stet clita meliore usu ne. Facer debitis ponderum per no, agam corpora recteque at mel.</p>'),(116,'policy_content','<p><strong>Lorem Ipsum</strong></p><p>Lorem ipsum dolor sit amet, in eam consetetur consectetuer. Vivendo eleifend postulant ut mei, vero maiestatis cu nam. Qui et facer mandamus, nullam regione lucilius eu has. Mei an vidisse facilis posidonium, eros minim deserunt per ne.</p><p>Duo quando tibique intellegam at. Nec error mucius in, ius in error legendos reformidans. Vidisse dolorum vulputate cu ius. Ei qui stet error consulatu.</p><p>Mei habeo prompta te. Ignota commodo nam ei. Te iudico definitionem sed, placerat oporteat tincidunt eu per, stet clita meliore usu ne. Facer debitis ponderum per no, agam corpora recteque at mel.</p>'),(117,'is_active_manual',''),(118,'manual_payment_content','You can make a manual payment to cover an outstanding balance. Once time, open a ticket and contact with Administrator.'),(119,'verification_email_subject','{{website_name}} - Please validate your account'),(120,'verification_email_content','<p><strong>Welcome to {{website_name}}! </strong></p><p>Hello <strong>{{user_firstname}}</strong>!</p><p> Thank you for joining! We&#39;re glad to have you as community member, and we&#39;re stocked for you to start exploring our service.  If you don&#39;t verify your address, you won&#39;t be able to create a User Account.</p><p>  All you need to do is activate your account by click this link: <br>  {{activation_link}} </p><p>Thanks and Best Regards!</p>'),(121,'email_welcome_email_subject','{{website_name}} - Getting Started with Our Service!'),(122,'email_welcome_email_content','<p><strong>Welcome to {{website_name}}! </strong></p><p>Hello <strong>{{user_firstname}}</strong>!</p><p>Congratulations! <br>You have successfully signed up for our service - {{website_name}} with follow data</p><ul><li>Firstname: {{user_firstname}}</li><li>Lastname: {{user_lastname}}</li><li>Email: {{user_email}}</li><li>Timezone: {{user_timezone}}</li></ul><p>We want to exceed your expectations, so please do not hesitate to reach out at any time if you have any questions or concerns. We look to working with you.</p><p>Best Regards,</p>'),(123,'email_new_registration_subject','{{website_name}} - New Registration'),(124,'email_new_registration_content','<p>Hi Admin!</p><p>Someone signed up in <strong>{{website_name}}</strong> with follow data</p><ul><li>Firstname {{user_firstname}}</li><li>Lastname: {{user_lastname}}</li><li>Email: {{user_email}}</li><li>Timezone: {{user_timezone}}</li></ul> '),(125,'email_password_recovery_subject','{{website_name}} - Password Recovery'),(126,'email_password_recovery_content','<p>Hi<strong> {{user_firstname}}! </strong></p><p>Somebody (hopefully you) requested a new password for your account. </p><p>No changes have been made to your account yet. <br>You can reset your password by click this link: <br>{{recovery_password_link}}</p><p>If you did not request a password reset, no further action is required. </p><p>Thanks and Best Regards!</p>                '),(127,'email_payment_notice_subject','{{website_name}} -  Thank You! Deposit Payment Received'),(128,'email_payment_notice_content','<p>Hi<strong> {{user_firstname}}! </strong></p><p>We&#39;ve just received your final remittance and would like to thank you. We appreciate your diligence in adding funds to your balance in our service.</p><p>It has been a pleasure doing business with you. We wish you the best of luck.</p><p>Thanks and Best Regards!</p>'),(129,'is_verification_new_account','0'),(130,'is_welcome_email','0'),(131,'is_new_user_email','0'),(132,'is_payment_notice_email','0'),(133,'is_ticket_notice_email','0'),(134,'is_ticket_notice_email_admin','0'),(135,'is_order_notice_email','0'),(136,'email_from',''),(137,'email_name',''),(138,'email_protocol_type','php_mail'),(139,'smtp_server',''),(140,'smtp_port',''),(141,'smtp_encryption',''),(142,'smtp_username',''),(143,'smtp_password',''),(144,'currency_symbol','$'),(145,'currency_decimal','2'),(146,'currency_decimal_separator','dot'),(147,'currency_thousand_separator','comma');

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
   Wave Boosting Services - Branding & Configuration Updates
   ============================================================ */

UPDATE `general_options` SET `value` = 'Wave Boosting Services - #1 SMM Panel | Boost TikTok, YouTube, Instagram, Facebook & More' WHERE `name` = 'website_desc';
UPDATE `general_options` SET `value` = 'smm panel, wave boosting, wave panel, boost followers, boost likes, tiktok panel, youtube panel, instagram panel, facebook panel, cheap smm panel' WHERE `name` = 'website_keywords';
UPDATE `general_options` SET `value` = 'Wave Boosting Services - SMM Panel' WHERE `name` = 'website_title';
DELETE FROM `general_options` WHERE `name` = 'website_favicon';
UPDATE `general_options` SET `value` = 'delostvoyage@gmail.com' WHERE `name` = 'contact_email';
UPDATE `general_options` SET `value` = 'delostvoyage@gmail.com' WHERE `name` = 'email_from';
UPDATE `general_options` SET `value` = 'Wave Boosting Services' WHERE `name` = 'email_name';
UPDATE `general_options` SET `value` = 'Copyright &copy; 2025 Wave Platforms, Inc. All Rights Reserved.' WHERE `name` = 'copy_right_content';
UPDATE `general_options` SET `value` = 'Wave Boosting Services' WHERE `name` = 'website_name';
DELETE FROM `general_options` WHERE `name` IN ('website_logo', 'website_logo_white', 'website_logo_mark');
UPDATE `general_options` SET `value` = '' WHERE `name` = 'social_facebook_link';
UPDATE `general_options` SET `value` = '' WHERE `name` = 'social_twitter_link';
UPDATE `general_options` SET `value` = '' WHERE `name` = 'social_instagram_link';
UPDATE `general_options` SET `value` = '' WHERE `name` = 'social_pinterest_link';
UPDATE `general_options` SET `value` = '' WHERE `name` = 'social_tumblr_link';
UPDATE `general_options` SET `value` = 'https://www.youtube.com/@Wave-platfoms' WHERE `name` = 'social_youtube_link';

INSERT IGNORE INTO `general_options` (`name`, `value`) VALUES
('social_tiktok_link', 'https://www.tiktok.com/@itsmeddy?_r=1&_t=ZS-95zn8eiI69V'),
('social_whatsapp_link', 'https://whatsapp.com/channel/0029VbDD5xgBlHpjUBmayj30'),
('admin_emails', 'delostvoyage@gmail.com,meddymususwa126@gmail.com,voyagedelost@gmail.com'),
('wave_hero_image', 'https://media.istockphoto.com/id/1504173168/photo/futuristic-energy-sphere-on-black-background-representing-ai-and-future-technologies-3d.jpg?s=612x612&w=0&k=20&c=lNbKE07EEb7bpsKTf1Pmm1enLnfwooepNLsSa4hAAE4=');

/* Update admin staff emails */
UPDATE `general_staffs` SET `email` = 'delostvoyage@gmail.com', `first_name` = 'Wave', `last_name` = 'Admin' WHERE `id` = 10;

/* Add extra admin staff */
INSERT IGNORE INTO `general_staffs` (`ids`, `role_id`, `admin`, `login_type`, `first_name`, `last_name`, `email`, `password`, `timezone`, `settings`, `activation_key`, `reset_key`, `history_ip`, `status`, `changed`, `created`)
VALUES
('wave_admin_2', 1, 1, NULL, 'Wave', 'Admin2', 'meddymususwa126@gmail.com', '$2a$08$zcgCYoZYr3Uhp/JxvUuQTe7KMVUyxHjsSXgBaG1aUba0ouTyVi/vG', 'Africa/Nairobi', NULL, NULL, NULL, '127.0.0.1', 1, NOW(), NOW()),
('wave_admin_3', 1, 1, NULL, 'Wave', 'Admin3', 'voyagedelost@gmail.com', '$2a$08$zcgCYoZYr3Uhp/JxvUuQTe7KMVUyxHjsSXgBaG1aUba0ouTyVi/vG', 'Africa/Nairobi', NULL, NULL, NULL, '127.0.0.1', 1, NOW(), NOW());

INSERT IGNORE INTO `payments` (`id`, `type`, `name`, `min`, `max`, `sort`, `new_users`, `status`, `params`)

UPDATE `payments` SET `status` = 0 WHERE `type` IN ('paypal', 'stripe');

/* Enable services page for non-logged-in visitors */
UPDATE `general_options` SET `value` = '1' WHERE `name` = 'enable_service_list_no_login';
/* Set currency */
INSERT IGNORE INTO `general_options` (`name`, `value`) VALUES ('currency_code', 'USD');
UPDATE `general_options` SET `value` = 'USD' WHERE `name` = 'currency_code';
UPDATE `general_options` SET `value` = '$' WHERE `name` = 'currency_symbol';

/* ============================================================
   SMM Service Categories
   ============================================================ */
INSERT IGNORE INTO `categories` (`id`, `ids`, `uid`, `name`, `desc`, `image`, `sort`, `status`, `created`, `changed`) VALUES
(1,  'cat_tiktok',    10, 'TikTok',           'Boost your TikTok presence with real engagement',       '', 1,  1, NOW(), NOW()),
(2,  'cat_youtube',   10, 'YouTube',           'Grow your YouTube channel fast and organically',        '', 2,  1, NOW(), NOW()),
(3,  'cat_instagram', 10, 'Instagram',         'Increase your Instagram reach and engagement',          '', 3,  1, NOW(), NOW()),
(4,  'cat_facebook',  10, 'Facebook',          'Expand your Facebook page and post reach',              '', 4,  1, NOW(), NOW()),
(5,  'cat_twitter',   10, 'Twitter / X',       'Grow your Twitter/X audience and engagement',           '', 5,  1, NOW(), NOW()),
(6,  'cat_telegram',  10, 'Telegram',          'Build your Telegram community with real members',       '', 6,  1, NOW(), NOW()),
(7,  'cat_spotify',   10, 'Spotify',           'Boost your Spotify streams and monthly listeners',      '', 7,  1, NOW(), NOW()),
(8,  'cat_soundcloud',10, 'SoundCloud',        'Grow your SoundCloud audience and plays',               '', 8,  1, NOW(), NOW()),
(9,  'cat_linkedin',  10, 'LinkedIn',          'Build your professional LinkedIn presence',             '', 9,  1, NOW(), NOW()),
(10, 'cat_traffic',   10, 'Website Traffic',   'Drive real targeted visitors to your website',          '', 10, 1, NOW(), NOW());

/* ============================================================
   SMM Services — TikTok (cate_id=1)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_tt_fol',    10,1,'TikTok Followers',               'Real-looking TikTok followers. Fast delivery.',              0.8000,  0.8000, 0,0,0, 100,  1000000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_fol_hq', 10,1,'TikTok Followers [High Quality]','Premium high-retention TikTok followers.',                  2.0000,  2.0000, 0,0,0, 100,   200000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_lik',    10,1,'TikTok Likes',                   'Instant TikTok likes for any public video.',                 0.3000,  0.3000, 0,0,0,  50,   500000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_view',   10,1,'TikTok Video Views',             'Fast video views delivered within minutes.',                 0.1000,  0.1000, 0,0,0, 500, 10000000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_cmt',    10,1,'TikTok Comments [Custom]',       'Custom TikTok comments from real-looking accounts.',         5.0000,  5.0000, 0,0,0,  10,     1000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_share',  10,1,'TikTok Shares',                  'Boost video distribution with organic-looking shares.',      0.8000,  0.8000, 0,0,0, 100,   100000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_sview',  10,1,'TikTok Story Views',             'Increase your TikTok story view count.',                     0.2000,  0.2000, 0,0,0, 500,  1000000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_live',   10,1,'TikTok Live Views',              'Real concurrent viewers for your TikTok Live streams.',      2.5000,  2.5000, 0,0,0, 100,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_save',   10,1,'TikTok Saves (Favorites)',       'Increase saves/favorites on your TikTok posts.',             0.5000,  0.5000, 0,0,0, 100,   200000,'manual','default',0,1,NOW(),NOW()),
('svc_tt_fol_df', 10,1,'TikTok Followers [Drip-Feed]',  'Gradual follower delivery to mimic organic growth.',         1.2000,  1.2000, 0,0,0, 100,   100000,'manual','default',1,1,NOW(),NOW());

/* ============================================================
   SMM Services — YouTube (cate_id=2)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_yt_sub',    10,2,'YouTube Subscribers',            'Real-looking YouTube subscribers. Safe delivery.',           1.5000,  1.5000, 0,0,0, 100,   100000,'manual','default',0,1,NOW(),NOW()),
('svc_yt_sub_hq', 10,2,'YouTube Subscribers [Non-Drop]', 'Premium subscribers with 30-day refill guarantee.',         4.0000,  4.0000, 0,1,1, 100,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_yt_view',   10,2,'YouTube Views',                  'High-retention YouTube video views.',                        0.1500,  0.1500, 0,0,0,1000, 10000000,'manual','default',0,1,NOW(),NOW()),
('svc_yt_view_hr',10,2,'YouTube Views [High Retention]', '60%+ audience retention views for better rankings.',         0.5000,  0.5000, 0,0,0,1000,  1000000,'manual','default',0,1,NOW(),NOW()),
('svc_yt_lik',    10,2,'YouTube Likes',                  'Boost your video likes for better social proof.',            0.5000,  0.5000, 0,0,0,  50,   100000,'manual','default',0,1,NOW(),NOW()),
('svc_yt_cmt',    10,2,'YouTube Comments [Custom]',      'Custom comments on your YouTube videos.',                    6.0000,  6.0000, 0,0,0,   5,      500,'manual','default',0,1,NOW(),NOW()),
('svc_yt_share',  10,2,'YouTube Shares',                 'Increase share count on your YouTube videos.',               1.5000,  1.5000, 0,0,0,  50,    10000,'manual','default',0,1,NOW(),NOW()),
('svc_yt_wh',     10,2,'YouTube Watch Hours',            'Monetization-safe watch hours (4000 hrs required).',        10.0000, 10.0000, 0,0,0,  10,     1000,'manual','default',0,1,NOW(),NOW()),
('svc_yt_sub_df', 10,2,'YouTube Subscribers [Drip-Feed]','Gradual subscriber delivery for safe growth.',               2.0000,  2.0000, 0,0,0, 100,    50000,'manual','default',1,1,NOW(),NOW()),
('svc_yt_live',   10,2,'YouTube Live Views',             'Real concurrent viewers for YouTube Live streams.',           3.0000,  3.0000, 0,0,0, 100,    20000,'manual','default',0,1,NOW(),NOW());

/* ============================================================
   SMM Services — Instagram (cate_id=3)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_ig_fol',    10,3,'Instagram Followers',            'Real-looking Instagram followers. Fast start.',              0.7000,  0.7000, 0,0,0, 100,   500000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_fol_hq', 10,3,'Instagram Followers [HQ]',      'Premium followers with 30-day refill guarantee.',            2.5000,  2.5000, 0,1,1, 100,   100000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_lik',    10,3,'Instagram Likes',                'Auto-likes on your latest Instagram posts.',                 0.2500,  0.2500, 0,0,0,  50,   500000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_view',   10,3,'Instagram Video Views',          'Fast video view delivery for Reels and posts.',              0.1200,  0.1200, 0,0,0, 500,  5000000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_reel',   10,3,'Instagram Reel Views',           'Boost reel views for better Explore placement.',             0.1000,  0.1000, 0,0,0,1000,  5000000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_sview',  10,3,'Instagram Story Views',          'Increase story view count instantly.',                       0.1500,  0.1500, 0,0,0, 500,  2000000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_cmt',    10,3,'Instagram Comments [Custom]',    'Custom comments from real-looking profiles.',                4.0000,  4.0000, 0,0,0,  10,     1000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_save',   10,3,'Instagram Saves',                'Boost post saves for algorithm reach increase.',             0.5000,  0.5000, 0,0,0,  50,   100000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_igtv',   10,3,'Instagram IGTV Views',           'Real views for your IGTV long-form video content.',         0.1500,  0.1500, 0,0,0, 500,  2000000,'manual','default',0,1,NOW(),NOW()),
('svc_ig_fol_df', 10,3,'Instagram Followers [Drip-Feed]','Organic-paced follower delivery over time.',                 1.0000,  1.0000, 0,0,0, 100,   100000,'manual','default',1,1,NOW(),NOW());

/* ============================================================
   SMM Services — Facebook (cate_id=4)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_fb_plik',   10,4,'Facebook Page Likes',            'Real-looking Facebook page likes for brand growth.',         0.8000,  0.8000, 0,0,0, 100,   500000,'manual','default',0,1,NOW(),NOW()),
('svc_fb_fol',    10,4,'Facebook Page Followers',        'Increase your Facebook page follower count.',                0.8000,  0.8000, 0,0,0, 100,   200000,'manual','default',0,1,NOW(),NOW()),
('svc_fb_postlik',10,4,'Facebook Post Likes',            'Likes on any public Facebook post.',                         0.3000,  0.3000, 0,0,0,  50,   200000,'manual','default',0,1,NOW(),NOW()),
('svc_fb_cmt',    10,4,'Facebook Comments [Custom]',     'Custom comments on public Facebook posts.',                  5.0000,  5.0000, 0,0,0,   5,      500,'manual','default',0,1,NOW(),NOW()),
('svc_fb_share',  10,4,'Facebook Post Shares',           'Organic-looking post shares for viral reach.',               1.5000,  1.5000, 0,0,0,  50,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_fb_view',   10,4,'Facebook Video Views',           '3-second video views to boost post reach.',                  0.1000,  0.1000, 0,0,0,1000,  5000000,'manual','default',0,1,NOW(),NOW()),
('svc_fb_grp',    10,4,'Facebook Group Members',         'Add real-looking members to your Facebook group.',           2.0000,  2.0000, 0,0,0, 100,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_fb_event',  10,4,'Facebook Event Attendees',       'Boost event attendance interest count.',                     2.5000,  2.5000, 0,0,0,  50,    10000,'manual','default',0,1,NOW(),NOW()),
('svc_fb_reel',   10,4,'Facebook Reel Views',            'Boost views on your Facebook Reels.',                        0.1200,  0.1200, 0,0,0,1000,  3000000,'manual','default',0,1,NOW(),NOW());

/* ============================================================
   SMM Services — Twitter / X (cate_id=5)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_tw_fol',    10,5,'Twitter/X Followers',            'Real-looking Twitter/X followers. Fast delivery.',           1.0000,  1.0000, 0,0,0, 100,   200000,'manual','default',0,1,NOW(),NOW()),
('svc_tw_lik',    10,5,'Twitter/X Likes',                'Increase likes on your tweets quickly.',                     0.4000,  0.4000, 0,0,0,  50,   200000,'manual','default',0,1,NOW(),NOW()),
('svc_tw_ret',    10,5,'Twitter/X Retweets',             'Real-looking retweets to boost content reach.',              1.0000,  1.0000, 0,0,0,  50,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_tw_cmt',    10,5,'Twitter/X Replies [Custom]',     'Custom replies on any public tweet.',                        5.0000,  5.0000, 0,0,0,   5,      500,'manual','default',0,1,NOW(),NOW()),
('svc_tw_imp',    10,5,'Twitter/X Impressions',          'Boost tweet impression count for better reach.',             0.3000,  0.3000, 0,0,0,1000,  5000000,'manual','default',0,1,NOW(),NOW()),
('svc_tw_visit',  10,5,'Twitter/X Profile Visits',       'Drive traffic to your Twitter/X profile.',                   0.5000,  0.5000, 0,0,0, 500,  2000000,'manual','default',0,1,NOW(),NOW()),
('svc_tw_spaces', 10,5,'Twitter/X Spaces Listeners',     'Real listeners for your Twitter Spaces broadcast.',          3.0000,  3.0000, 0,0,0,  50,    10000,'manual','default',0,1,NOW(),NOW());

/* ============================================================
   SMM Services — Telegram (cate_id=6)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_tg_mem',    10,6,'Telegram Channel Members',       'Real-looking Telegram channel members.',                     0.9000,  0.9000, 0,0,0, 100,   500000,'manual','default',0,1,NOW(),NOW()),
('svc_tg_grp',    10,6,'Telegram Group Members',         'Add real-looking members to your Telegram group.',           1.5000,  1.5000, 0,0,0, 100,   200000,'manual','default',0,1,NOW(),NOW()),
('svc_tg_view',   10,6,'Telegram Post Views',            'Fast post view delivery for any public channel.',            0.0800,  0.0800, 0,0,0,1000, 10000000,'manual','default',0,1,NOW(),NOW()),
('svc_tg_react',  10,6,'Telegram Reactions 👍',          'Add positive reactions to your Telegram posts.',             0.8000,  0.8000, 0,0,0, 100,   100000,'manual','default',0,1,NOW(),NOW()),
('svc_tg_share',  10,6,'Telegram Post Shares',           'Organic-looking shares for your channel posts.',             1.0000,  1.0000, 0,0,0, 100,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_tg_mem_df', 10,6,'Telegram Members [Drip-Feed]',   'Gradual member delivery for organic channel growth.',        1.5000,  1.5000, 0,0,0, 100,   100000,'manual','default',1,1,NOW(),NOW());

/* ============================================================
   SMM Services — Spotify (cate_id=7)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_sp_play',   10,7,'Spotify Plays',                  'Real Spotify song plays to boost chart position.',           0.2000,  0.2000, 0,0,0,1000,  5000000,'manual','default',0,1,NOW(),NOW()),
('svc_sp_fol',    10,7,'Spotify Followers',              'Grow your Spotify artist followers count.',                  2.0000,  2.0000, 0,0,0, 100,   100000,'manual','default',0,1,NOW(),NOW()),
('svc_sp_ml',     10,7,'Spotify Monthly Listeners',      'Increase your monthly listeners for credibility.',           3.0000,  3.0000, 0,0,0, 100,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_sp_plfol',  10,7,'Spotify Playlist Followers',     'Add followers to your Spotify playlist.',                    2.0000,  2.0000, 0,0,0, 100,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_sp_save',   10,7,'Spotify Track Saves',            'Real saves/add-to-library for your tracks.',                 1.5000,  1.5000, 0,0,0, 100,    50000,'manual','default',0,1,NOW(),NOW());

/* ============================================================
   SMM Services — SoundCloud (cate_id=8)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_sc_play',   10,8,'SoundCloud Plays',               'Fast SoundCloud track play delivery.',                       0.1500,  0.1500, 0,0,0,1000,  5000000,'manual','default',0,1,NOW(),NOW()),
('svc_sc_fol',    10,8,'SoundCloud Followers',           'Grow your SoundCloud follower base.',                        1.5000,  1.5000, 0,0,0, 100,   100000,'manual','default',0,1,NOW(),NOW()),
('svc_sc_lik',    10,8,'SoundCloud Likes',               'Increase likes on your SoundCloud tracks.',                  1.0000,  1.0000, 0,0,0, 100,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_sc_cmt',    10,8,'SoundCloud Comments',            'Custom comments on your SoundCloud tracks.',                 4.0000,  4.0000, 0,0,0,  10,      500,'manual','default',0,1,NOW(),NOW()),
('svc_sc_rep',    10,8,'SoundCloud Reposts',             'Reposts to expand your track distribution.',                 1.2000,  1.2000, 0,0,0, 100,    20000,'manual','default',0,1,NOW(),NOW());

/* ============================================================
   SMM Services — LinkedIn (cate_id=9)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_li_fol',    10,9,'LinkedIn Followers',             'Grow your LinkedIn company or profile followers.',           3.0000,  3.0000, 0,0,0,  50,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_li_lik',    10,9,'LinkedIn Post Likes',            'Boost engagement on your LinkedIn posts.',                   1.2000,  1.2000, 0,0,0,  50,    20000,'manual','default',0,1,NOW(),NOW()),
('svc_li_cmt',    10,9,'LinkedIn Comments [Custom]',     'Professional custom comments on your posts.',                6.0000,  6.0000, 0,0,0,   5,      200,'manual','default',0,1,NOW(),NOW()),
('svc_li_visit',  10,9,'LinkedIn Profile Views',         'Drive traffic to your LinkedIn profile.',                    1.5000,  1.5000, 0,0,0, 100,    50000,'manual','default',0,1,NOW(),NOW()),
('svc_li_conn',   10,9,'LinkedIn Connections',           'Expand your professional network connections.',              3.5000,  3.5000, 0,0,0,  50,    10000,'manual','default',0,1,NOW(),NOW());

/* ============================================================
   SMM Services — Website Traffic (cate_id=10)
   ============================================================ */
INSERT IGNORE INTO `services` (`ids`,`uid`,`cate_id`,`name`,`desc`,`price`,`original_price`,`deny_duplicates`,`refill`,`refill_type`,`min`,`max`,`add_type`,`type`,`dripfeed`,`status`,`created`,`changed`) VALUES
('svc_web_ww',    10,10,'Website Traffic [Worldwide]',   'Real human visitors from around the world.',                 0.5000,  0.5000, 0,0,0,1000, 10000000,'manual','default',0,1,NOW(),NOW()),
('svc_web_us',    10,10,'Website Traffic [USA]',         'Targeted US visitors for your website.',                    2.5000,  2.5000, 0,0,0, 500,  1000000,'manual','default',0,1,NOW(),NOW()),
('svc_web_eu',    10,10,'Website Traffic [Europe]',      'Targeted European visitors for your website.',              2.0000,  2.0000, 0,0,0, 500,  1000000,'manual','default',0,1,NOW(),NOW()),
('svc_web_seo',   10,10,'SEO Traffic [Organic Search]',  'Targeted visitors from Google/Bing search results.',        1.5000,  1.5000, 0,0,0,1000,  5000000,'manual','default',0,1,NOW(),NOW()),
('svc_web_af',    10,10,'Website Traffic [Africa]',      'Targeted African visitors including Uganda, Kenya, etc.',   1.0000,  1.0000, 0,0,0, 500,  2000000,'manual','default',0,1,NOW(),NOW());

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
