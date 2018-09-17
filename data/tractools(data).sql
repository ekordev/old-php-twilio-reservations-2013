/*
SQLyog Ultimate v8.55 
MySQL - 5.1.49-community : Database - tractools
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tractools` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tractools`;

/*Table structure for table `ams_contacts` */

DROP TABLE IF EXISTS `ams_contacts`;

CREATE TABLE `ams_contacts` (
  `contactID` bigint(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) DEFAULT 'NULL',
  `lname` varchar(100) DEFAULT 'NULL',
  `fbUid` decimal(20,0) NOT NULL DEFAULT '0',
  `usr` varchar(100) DEFAULT 'NULL',
  `pwd` varchar(100) DEFAULT 'NULL',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `banlist` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`contactID`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

/*Data for the table `ams_contacts` */

insert  into `ams_contacts`(`contactID`,`fname`,`lname`,`fbUid`,`usr`,`pwd`,`active`,`banlist`) values ('1','James','Van Leuvaan','570506173','james','mccrsvnl#1','1','0'),('2','Carissa','Campeotto','503777020','carissa','trestle#1','1','0'),('146','Eric','Elder','507857026','ericelder','trestle#1','1','0'),('162','Herb','Van Grootel','1068780303','herb_vg','corvette420','1','0'),('164','Masha','Tikhonova','814015499','NULL','NULL','1','0'),('163','Mary','Finamore Campeotto','100001494025731','mary','boccoli#1','1','0'),('171','Maria','Bayer','100002269711527','maria','trestle#1','1','0'),('166','Tiffany','Chung','503769040','tiffany','pescoltd#1','1','0');

/*Table structure for table `ams_contacttype` */

DROP TABLE IF EXISTS `ams_contacttype`;

CREATE TABLE `ams_contacttype` (
  `contactTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `contactType` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`contactTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ams_contacttype` */

insert  into `ams_contacttype`(`contactTypeID`,`contactType`) values ('1','System Administrator'),('2','Domain Administrator'),('3','Facebook User'),('4','User'),('5','Guest');

/*Table structure for table `ams_details` */

DROP TABLE IF EXISTS `ams_details`;

CREATE TABLE `ams_details` (
  `detailsID` int(11) NOT NULL AUTO_INCREMENT,
  `contactID` int(11) NOT NULL DEFAULT '0',
  `credentialsID` int(11) NOT NULL DEFAULT '5',
  `contactTypeID` int(11) DEFAULT '0',
  `gender` varchar(6) DEFAULT 'NULL',
  `email` varchar(100) DEFAULT NULL,
  `mobileID` decimal(10,0) NOT NULL DEFAULT '0',
  `mphone` varchar(20) DEFAULT 'NULL',
  `bbm` varchar(100) DEFAULT 'NULL',
  `mailinglist` tinyint(1) NOT NULL DEFAULT '0',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`detailsID`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

/*Data for the table `ams_details` */

insert  into `ams_details`(`detailsID`,`contactID`,`credentialsID`,`contactTypeID`,`gender`,`email`,`mobileID`,`mphone`,`bbm`,`mailinglist`,`creationDate`) values ('1','1','1','1','male','james@trestleresources.com','5','6047215474',NULL,'0','0000-00-00 00:00:00'),('2','2','1','2','female','carissa@pescoltd.ca','3','6046030577',NULL,'0','0000-00-00 00:00:00'),('55','146','5','2','male','Eric.elder84@gmail.com','3','7788863742',NULL,'0','2010-11-23 19:38:37'),('68','162','1','5','male','herb_vg@hotmail.com','0',NULL,NULL,'0','2011-02-12 16:52:05'),('69','163','5','2','female','mary.campeotto@boccolihair.com','0',NULL,NULL,'0','2011-02-12 20:04:59'),('70','164','5','5','female','Masha@grafikavision.com','4','6048373255',NULL,'0','2011-02-15 09:56:56'),('75','166','5','2','female','tiffany@pescoltd.ca','0',NULL,NULL,'0','2011-03-28 13:22:53'),('76','177','5','0','female','maria.bayer@trestleresources.com','0',NULL,NULL,'0','2011-04-04 01:27:21');

/*Table structure for table `cms_companies` */

DROP TABLE IF EXISTS `cms_companies`;

CREATE TABLE `cms_companies` (
  `cmsID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) unsigned NOT NULL DEFAULT '0',
  `locationID` int(11) unsigned NOT NULL DEFAULT '0',
  `categoryID` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cmsID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cms_companies` */

insert  into `cms_companies`(`cmsID`,`companyID`,`locationID`,`categoryID`,`description`,`creationDate`,`active`) values ('1','33','25','13',NULL,'2011-03-07 19:16:02','1');

/*Table structure for table `cms_content` */

DROP TABLE IF EXISTS `cms_content`;

CREATE TABLE `cms_content` (
  `contentID` int(11) NOT NULL AUTO_INCREMENT,
  `pageID` int(11) NOT NULL DEFAULT '0',
  `widgetID` int(11) NOT NULL DEFAULT '0',
  `orderID` int(11) NOT NULL DEFAULT '0',
  `details` text,
  PRIMARY KEY (`contentID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cms_content` */

insert  into `cms_content`(`contentID`,`pageID`,`widgetID`,`orderID`,`details`) values ('1','1','1','1','Boccoli: Italian for curl<p>Boccoli is a boutique hair salon with long-established roots in Vancouver\'s east side. It first opened in its 1340 Naniamo Street location in 1991. Though the space was small, the salon was soon busy and filled with faithful clientele. In 2007, after careful planning, Boccoli moved into the space next door, 1336 Naniamo. The new sleek, modern design reflects the sense of style clients have come to rely on.</p><p>Awarded L\'Oreal\'s platinum salon status, Boccoli has built its reputation with consistently high standards. Vidal Sassoon trained, stylists stay up to date on industry trends with regular L\'Oreal professional training sessions and yearly trips to the meeting of the Organization Mondiale Coiffure in Paris.</p><p>Boccoli\'s high standards for quality carry through to the products used and sold at the salon. Each product is carefully chosen to ensure it\'s healthy not only for the client, but also for the environment. Says co-owner Mary Campeotto, if I don\'t love the product, it doesn\'t go on to my client\'s head.</p><p>The salon offers a full range of services, specializing in colour.</p><p>Clients keep coming back to Boccoli because it\'s a calm oasis in their otherwise hectic lives. They know they can depend on a consistently high-quality hair style, but it\'s more than that. Clients know the stylists listen carefully and give honest and reliable styling advice.</p><p>The goal, says Mary is that the client feels amazing not only on the outside but also on the inside, and that the beauty comes through. It\'s about having an experience.</p>'),('2','1','4','2','<iframe src=\"http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FBoccoli-Hair-Salon%2F183585118337670&amp;width=249&amp;colorscheme=light&amp;show_faces=true&amp;stream=true&amp;header=false&amp;height=395\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:249px; height:395px;\" allowTransparency=\"true\"></iframe>'),('3','1','5','3','<div id=\"twitter\" title=\"boccoli_hair\"></div>');

/*Table structure for table `cms_flickr` */

DROP TABLE IF EXISTS `cms_flickr`;

CREATE TABLE `cms_flickr` (
  `imagesID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL DEFAULT '0',
  `flickrID` int(11) NOT NULL DEFAULT '0',
  `usr` varchar(255) DEFAULT 'NULL',
  `pwd` varchar(255) DEFAULT 'NULL',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`imagesID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cms_flickr` */

/*Table structure for table `cms_pages` */

DROP TABLE IF EXISTS `cms_pages`;

CREATE TABLE `cms_pages` (
  `pageID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pageID',
  `scid` int(11) NOT NULL DEFAULT '0' COMMENT 'categoryID (for cms_Pages table)',
  `sid` int(11) NOT NULL DEFAULT '0',
  `ssid` int(11) NOT NULL DEFAULT '0',
  `widgetID` int(11) NOT NULL DEFAULT '1',
  `widgetTypeID` int(11) NOT NULL DEFAULT '1',
  `isRoot` tinyint(1) NOT NULL DEFAULT '0',
  `langID` int(11) NOT NULL DEFAULT '4',
  `orderID` int(11) NOT NULL DEFAULT '0',
  `companyID` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT 'NULL',
  `content` text,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pageID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `cms_pages` */

insert  into `cms_pages`(`pageID`,`scid`,`sid`,`ssid`,`widgetID`,`widgetTypeID`,`isRoot`,`langID`,`orderID`,`companyID`,`title`,`content`,`creationDate`,`active`) values ('1','0','0','0','1','1','1','4','1','33','About Us','Boccoli: Italian for curl<p>Boccoli is a boutique hair salon with long-established roots in Vancouver\'s east side. It first opened in its 1340 Naniamo Street location in 1991. Though the space was small, the salon was soon busy and filled with faithful clientele. In 2007, after careful planning, Boccoli moved into the space next door, 1336 Naniamo. The new sleek, modern design reflects the sense of style clients have come to rely on.<p><p><p><p>Awarded L\'Oreal\'s platinum salon status, Boccoli has built its reputation with consistently high standards. Vidal Sassoon trained, stylists stay up to date on industry trends with regular L\'Oreal professional training sessions and yearly trips to the meeting of the Organization Mondiale Coiffure in Paris.<p><p><p><p>Boccoli\'s high standards for quality carry through to the products used and sold at the salon. Each product is carefully chosen to ensure it\'s healthy not only for the client, but also for the environment. Says co-owner Mary Campeotto, if I don\'t love the product, it doesn\'t go on to my client\'s head.<p><p><p><p>The salon offers a full range of services, specializing in colour.<p><p><p><p>Clients keep coming back to Boccoli because it\'s a calm oasis in their otherwise hectic lives. They know they can depend on a consistently high-quality hair style, but it\'s more than that. Clients know the stylists listen carefully and give honest and reliable styling advice.<p><p><p><p>The goal, says Mary is that the client feels amazing not only on the outside but also on the inside, and that the beauty comes through. It\'s about having an experience.<p><p><p><p><span><span><p><span><span><p><span><span><p><p><span><span><p><span><span><p><span><span><p>','2011-03-07 22:44:26','1'),('2','0','0','0','1','1','1','4','2','33','Services','<p>this is a description with links for the type and method of overall services.</p>','2011-03-07 22:46:48','1'),('3','0','0','0','1','1','1','4','3','33','Gallery','[Gallery]','2011-03-07 22:46:51','1'),('4','0','0','0','1','1','1','4','4','33','Contact','[contactForm]','2011-03-07 22:47:04','1'),('5','1','0','0','1','1','0','4','1','33','Mission Statement',NULL,'2011-03-10 04:41:43','1'),('6','1','0','0','1','1','0','4','2','33','About the Owners',NULL,'2011-03-10 04:41:45','1'),('7','1','0','0','1','1','0','4','3','33','Stylists',NULL,'2011-03-10 04:41:46','1'),('8','2','0','0','1','1','0','4','1','33','Hair Styling',NULL,'2011-03-10 05:12:23','1'),('9','2','0','0','1','1','0','4','2','33','Hair Texturing',NULL,'2011-03-10 05:12:24','1'),('10','2','0','0','1','1','0','4','3','33','Hair Coloring',NULL,'2011-03-10 05:12:25','1'),('11','4','0','0','1','1','0','4','2','33','Google',NULL,'2011-03-10 05:14:34','1'),('12','4','0','0','1','1','0','4','3','33','Translink',NULL,'2011-03-10 05:14:35','1'),('13','4','0','0','1','1','0','4','1','33','Operating Hours',NULL,'2011-03-10 05:14:36','1');

/*Table structure for table `cms_pagewidgets` */

DROP TABLE IF EXISTS `cms_pagewidgets`;

CREATE TABLE `cms_pagewidgets` (
  `pageWidgetID` int(11) NOT NULL AUTO_INCREMENT,
  `widgetID` int(11) NOT NULL DEFAULT '0',
  `widgetTypeID` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `scid` int(11) NOT NULL DEFAULT '0',
  `orderID` int(11) NOT NULL DEFAULT '0',
  `contentID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pageWidgetID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cms_pagewidgets` */

insert  into `cms_pagewidgets`(`pageWidgetID`,`widgetID`,`widgetTypeID`,`cid`,`scid`,`orderID`,`contentID`) values ('1','1','3','1','0','1','1'),('2','5','3','1','0','2','2'),('3','4','3','1','0','3','3');

/*Table structure for table `cms_widgets` */

DROP TABLE IF EXISTS `cms_widgets`;

CREATE TABLE `cms_widgets` (
  `widgetID` int(11) NOT NULL AUTO_INCREMENT,
  `widgetTypeID` int(11) NOT NULL DEFAULT '1' COMMENT 'Entire Page Widget or Page Area Widget',
  `widget` varchar(255) DEFAULT 'NULL' COMMENT 'Widget Name',
  PRIMARY KEY (`widgetID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `cms_widgets` */

insert  into `cms_widgets`(`widgetID`,`widgetTypeID`,`widget`) values ('1','3','Paragraph'),('2','3','Unordered List'),('3','3','Ordered List'),('4','3','fb-likebox'),('5','3','twitter'),('6','3','fb-friendslist');

/*Table structure for table `cms_widgettype` */

DROP TABLE IF EXISTS `cms_widgettype`;

CREATE TABLE `cms_widgettype` (
  `widgetTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `widgetType` varchar(255) DEFAULT 'NULL',
  `desc` text,
  PRIMARY KEY (`widgetTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `cms_widgettype` */

insert  into `cms_widgettype`(`widgetTypeID`,`widgetType`,`desc`) values ('1','Section','<p>A section is a root website page, which shows up in the primary navigation of a website such as \\\"Home,\\\" \\\"About Us,\\\" or \\\"Contact Us.\\\"  Pages marked as sections, will be the first level of \\\"links\\\" which a visitor to your website, or facebook page would see, as a primary option for viewing.</p>'),('2','Page','<p>A page by our definition, is any type of general content page (with paragraphs and images), within a section of the website. It would be the \\\"second\\\" level page which a visitor would view, and be able to click to view, within it\\\'s associated web site section.</p>\r\n<p>Pages can have text, images, forms, or dynamic objects, similar to many of the web pages you\\\'ve seen when you\\\'ve surfed the internet.</p>'),('3','Object','<p>An <strong>object</strong> is an element within a web page. Such as a paragraph, an image, or form. It can also be something dynamic like a twitter feed, or Facebook comment\\\'s section. Generally an object would be placed within a specific region within one of the template pages.</p>'),('4','Application','<p>An <strong>application</strong> is a full page object. To keep it simple for you, we\'ve wrapped our applications as stand-alone objects, as they are managed separately with distinct features related to their function. Such as an online Shopping Cart, or Image Gallery, or Job Board. The nature of these types of applications, require more control than one would assign to a paragraph, or a feedback form.</p>');

/*Table structure for table `coming_soon` */

DROP TABLE IF EXISTS `coming_soon`;

CREATE TABLE `coming_soon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `coming_soon` */

insert  into `coming_soon`(`id`,`email`) values ('3','james@trestleresources.com');

/*Table structure for table `crm_banlist` */

DROP TABLE IF EXISTS `crm_banlist`;

CREATE TABLE `crm_banlist` (
  `banlistID` bigint(20) NOT NULL AUTO_INCREMENT,
  `contactID` decimal(10,0) DEFAULT NULL,
  `bandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`banlistID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `crm_banlist` */

/*Table structure for table `crm_categories` */

DROP TABLE IF EXISTS `crm_categories`;

CREATE TABLE `crm_categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `crm_categories` */

insert  into `crm_categories`(`categoryID`,`category`) values ('1','Nightclub'),('2','Pub'),('3','Lounge'),('4','Cafe'),('5','Restaurant'),('6','Live Entertainment'),('7','Social Networking'),('8','Fashion'),('9','Bands'),('10','Private Functions'),('11','Online Company'),('12','DJ/VJ'),('13','Hair Salon');

/*Table structure for table `crm_companies` */

DROP TABLE IF EXISTS `crm_companies`;

CREATE TABLE `crm_companies` (
  `companyID` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(255) DEFAULT '(NULL)',
  `company` varchar(255) DEFAULT '(NULL)',
  `image` text NOT NULL,
  `nickname` varchar(255) DEFAULT '(NULL)',
  `isHosted` tinyint(1) NOT NULL DEFAULT '0',
  `domain` varchar(255) DEFAULT '(NULL)',
  `fb_domain` varchar(255) DEFAULT '(NULL)',
  PRIMARY KEY (`companyID`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

/*Data for the table `crm_companies` */

insert  into `crm_companies`(`companyID`,`fbid`,`company`,`image`,`nickname`,`isHosted`,`domain`,`fb_domain`) values ('35','111631562246891','Public Edge Solutions Co Ltd','http://www.pescoltd.ca/img/Facebook/logo_facebook.png','pescoltd','1','pescoltd.ca','http://www.facebook.com/PESCOLTD'),('34','(NULL)','Trestle Resources Inc','','trestle','1','trestleresources.com','(NULL)'),('33','(NULL)','Boccoli Hair Salon','','boccolihair','1','boccolihair.com','(NULL)'),('36','168615374071','Donnelly Group','http://www.donnellygroup.ca/templates/dhmsplash/images/DHMlogo.jpg','dhm','0','dhm.com','(NULL)'),('37','127573377285494','Cinema Public House','http://www.donnellygroup.ca/cinema/templates/cinema/images/cinema.png','cinema','0','donnellygroup.ca/cinema/','(NULL)'),('38','149724741707576','Shine Night Club','http://www.pescoltd.ca/img/venues/shine.jpg','shine','0','shinenightclub.com','(NULL)');

/*Table structure for table `crm_details` */

DROP TABLE IF EXISTS `crm_details`;

CREATE TABLE `crm_details` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` decimal(10,0) NOT NULL DEFAULT '0',
  `parentID` decimal(10,0) NOT NULL DEFAULT '0',
  `addressID` decimal(10,0) NOT NULL DEFAULT '0',
  `cityID` decimal(10,0) NOT NULL DEFAULT '0',
  `countryID` decimal(10,0) NOT NULL DEFAULT '0',
  `contactID` decimal(10,0) NOT NULL DEFAULT '0',
  `details` text,
  `imageURL` blob,
  `wwwURL` varchar(100) DEFAULT '(NULL)',
  `fbURL` varchar(255) DEFAULT '(NULL)',
  `comments` text,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`detailID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `crm_details` */

insert  into `crm_details`(`detailID`,`companyID`,`parentID`,`addressID`,`cityID`,`countryID`,`contactID`,`details`,`imageURL`,`wwwURL`,`fbURL`,`comments`,`creationDate`,`active`) values ('1','33','0','0','0','37','0',NULL,NULL,'boccolihair.com','Boccoli-Hair-Salon/183585118337670',NULL,'2010-08-19 15:42:43','1'),('2','34','0','0','0','37','1',NULL,NULL,'trestleresources.ca',NULL,NULL,'2010-08-19 15:42:43','1'),('7','35','0','0','0','37','2',NULL,NULL,'pescoltd.ca','Pesco-Ltd-Public-Edge-Solutions-Co-Ltd/171362846243655',NULL,'2011-02-12 19:29:22','1'),('8','34','0','0','0','37','1',NULL,NULL,'tractools.com',NULL,NULL,'2011-02-12 19:53:56','1'),('9','37','36','0','0','37','2',NULL,NULL,NULL,NULL,NULL,'2011-04-30 16:38:31','1');

/*Table structure for table `crm_locations` */

DROP TABLE IF EXISTS `crm_locations`;

CREATE TABLE `crm_locations` (
  `locationID` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyID` decimal(10,0) DEFAULT NULL,
  `companyTypeID` decimal(10,0) DEFAULT NULL,
  `detailsID` decimal(10,0) DEFAULT NULL,
  `Name` varchar(150) DEFAULT 'NULL',
  `abbr` varchar(25) DEFAULT 'NULL',
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isPrimary` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`locationID`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `crm_locations` */

insert  into `crm_locations`(`locationID`,`companyID`,`companyTypeID`,`detailsID`,`Name`,`abbr`,`creationDate`,`isPrimary`) values ('1','1','1',NULL,'Caprice','caprice','2011-02-12 16:35:28','0'),('2','1','2',NULL,'Dover Arms','dover','2011-02-12 16:35:39','0'),('3','1','2',NULL,'LUX','lux','2011-02-12 16:35:53','0'),('4','1','2',NULL,'PIVO','pivo','2011-02-12 16:35:56','0'),('5','1','1',NULL,'Celebrities','celebs','2011-02-12 16:36:04','0'),('6','1','1',NULL,'Venue','venue','2011-02-12 16:36:24','0'),('7','2','1',NULL,'Republic','republic','2011-02-12 16:36:56','0'),('8','2','2',NULL,'Lamplighter','lamplighter','2011-02-12 16:37:08','0'),('9','2','2',NULL,'Smiley\'s','smileys','2011-02-12 16:38:38','0'),('10','2','1',NULL,'Post Modern','postmodern','2011-02-12 16:38:54','0'),('11','2','2',NULL,'The Calling','calling','2011-02-12 16:39:05','0'),('12','2','2',NULL,'The Academic','academic','2011-02-12 16:39:13','0'),('13','2','2',NULL,'The Cinema','cinema','2011-02-12 16:39:23','0'),('14','2','2',NULL,'Granville Room','granville','2011-02-12 16:39:39','0'),('15','2','2',NULL,'Metropole','metropole','2011-02-12 16:39:46','0'),('16','2','2',NULL,'Library Square','librarysquare','2011-02-12 16:39:59','0'),('17','3','1',NULL,'Au Bar','aubar','2011-02-12 16:40:46','0'),('18','3','2',NULL,'Garfinkels','garfinkels','2011-02-12 16:40:55','0'),('19','3','2',NULL,'Forum','forum','2011-02-12 16:40:59','0'),('20','3','2',NULL,'Ocean Side','oceanside','2011-02-12 16:41:14','0'),('21','3','2',NULL,'Mountain Club','mountainclub','2011-02-12 16:41:24','0'),('22','3','1',NULL,'Tonic','tonic','2011-02-12 16:41:31','0'),('23','3','2',NULL,'Savage Beagle','savagebeagle','2011-02-12 16:42:00','0'),('24','34','11',NULL,'TRACTools','tractools','2011-02-12 19:53:21','0'),('25','33','13',NULL,'Boccoli Hair Salon','boccolihair','2011-02-12 20:09:15','1');

/*Table structure for table `ems_eventdetails` */

DROP TABLE IF EXISTS `ems_eventdetails`;

CREATE TABLE `ems_eventdetails` (
  `dtailsID` int(11) NOT NULL AUTO_INCREMENT,
  `eventID` int(11) NOT NULL DEFAULT '0',
  `day` int(11) NOT NULL DEFAULT '0',
  `month` int(11) NOT NULL DEFAULT '1',
  `year` int(11) NOT NULL DEFAULT '2011',
  `startTime` time NOT NULL DEFAULT '00:00:00',
  `endTime` time NOT NULL DEFAULT '00:00:00',
  `info` text,
  `eventImage` text NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`dtailsID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ems_eventdetails` */

insert  into `ems_eventdetails`(`dtailsID`,`eventID`,`day`,`month`,`year`,`startTime`,`endTime`,`info`,`eventImage`,`creationdate`) values ('1','1','6','0','0','22:00:00','03:00:00','The Strip Fridays<br /><br />Cinema Public House<br />10PM - 3AM<br /><br />Hosted By<br />Carissa C<br /><br />Featuring<br />DJ Mikhail Daroux.<br /><br />$5 Heineken and Peroni bottles<br />$7.60 double highballs<br />','http://a1.sphotos.ak.fbcdn.net/hphotos-ak-snc6/181780_10150097833842021_503777020_6714979_8001842_n.jpg','2011-05-03 11:29:08'),('2','2','7','0','0','22:00:00','03:00:00','Girls On Top Saturdays<br /><br />Cinema Public House<br />10:00 PM - 3:00 AM<br /><br />Cover : $8.00<br /><br />Hosted By<br />Carissa and KFE<br /><br />Featuring<br />Blondtron<br /><br />All girls, all the time!<br />$5 Kronenbourg or Anchor Steam bottles<br />$7.60 double highballs<br />','http://a6.sphotos.ak.fbcdn.net/hphotos-ak-ash4/190245_10150097834057021_503777020_6714981_5164505_n.jpg','2011-05-03 11:29:13');

/*Table structure for table `ems_events` */

DROP TABLE IF EXISTS `ems_events`;

CREATE TABLE `ems_events` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `fbeid` bigint(20) NOT NULL DEFAULT '0',
  `venueID` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT '(NULL)',
  `reoccurring` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `createdBy` int(11) NOT NULL DEFAULT '0',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ems_events` */

insert  into `ems_events`(`eventID`,`fbeid`,`venueID`,`title`,`reoccurring`,`notes`,`createdBy`,`creationDate`) values ('1','121434854603419','37','On The Strip','1','Free entry before 10 pm','0','2011-05-01 17:48:41'),('2','221914711155553','37','Girls On Top','1','Free entry before 10 pm','0','2011-05-08 17:48:41');

/*Table structure for table `ems_guest` */

DROP TABLE IF EXISTS `ems_guest`;

CREATE TABLE `ems_guest` (
  `guestID` int(11) NOT NULL AUTO_INCREMENT,
  `eventID` int(11) NOT NULL DEFAULT '0',
  `contactID` int(11) NOT NULL DEFAULT '0',
  `numberInvited` decimal(10,0) NOT NULL DEFAULT '0',
  `numberAccepted` decimal(10,0) NOT NULL DEFAULT '0',
  `numberArrived` decimal(10,0) NOT NULL DEFAULT '0',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `arriveTime` time NOT NULL DEFAULT '00:00:00',
  `GLID` varchar(255) DEFAULT 'NULL',
  `arrived` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`guestID`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

/*Data for the table `ems_guest` */

/*Table structure for table `ems_guestlist` */

DROP TABLE IF EXISTS `ems_guestlist`;

CREATE TABLE `ems_guestlist` (
  `guestlistID` int(11) NOT NULL AUTO_INCREMENT,
  `guestID` int(11) NOT NULL DEFAULT '0',
  `contactID` int(11) NOT NULL DEFAULT '0',
  `arrived` tinyint(1) NOT NULL DEFAULT '0',
  `arriveTime` time DEFAULT '00:00:00',
  `arriveStatus` tinyint(1) NOT NULL DEFAULT '0',
  `GLID` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`guestlistID`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

/*Data for the table `ems_guestlist` */

/*Table structure for table `fb_applications` */

DROP TABLE IF EXISTS `fb_applications`;

CREATE TABLE `fb_applications` (
  `fbAppID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'tractoolsID',
  `companyID` int(11) NOT NULL DEFAULT '0',
  `ttAppName` varchar(255) DEFAULT 'NULL',
  `appName` varchar(255) DEFAULT 'NULL' COMMENT 'Facebook Application Name',
  `nickname` varchar(255) DEFAULT 'NULL',
  `appID` varchar(255) DEFAULT 'NULL' COMMENT 'Facebook Application ID',
  `apiKey` varchar(255) DEFAULT 'NULL' COMMENT 'Facebook API Key',
  `appSecret` varchar(255) DEFAULT 'NULL' COMMENT 'Facebook Secret Key',
  `baseURL` varchar(255) DEFAULT 'NULL' COMMENT 'Server Page for this particular application (ie: jobboard = http://www.tractools.com/fb/jobboard/)',
  `fbappBaseUrl` varchar(255) DEFAULT 'NULL' COMMENT 'The Facebook Application Base URL',
  `pageUrl` varchar(255) DEFAULT 'NULL' COMMENT 'The Facebook Client Fan Page URL',
  `fbStreamMsg` text NOT NULL,
  `fbInviteMsg` text NOT NULL,
  `permissions` varchar(255) DEFAULT 'NULL',
  `fbContactEmail` varchar(255) DEFAULT 'NULL' COMMENT 'Facebook Contact Email',
  `supportURL` varchar(255) DEFAULT 'NULL' COMMENT 'Facebook Support URL',
  `adminURL` varchar(255) DEFAULT 'NULL' COMMENT 'Administrator Edit Page',
  `edit` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fbAppID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `fb_applications` */

insert  into `fb_applications`(`fbAppID`,`companyID`,`ttAppName`,`appName`,`nickname`,`appID`,`apiKey`,`appSecret`,`baseURL`,`fbappBaseUrl`,`pageUrl`,`fbStreamMsg`,`fbInviteMsg`,`permissions`,`fbContactEmail`,`supportURL`,`adminURL`,`edit`) values ('1','0',NULL,'Tractools',NULL,'169227033128164','cd4852705074942e395715f44e868b28','6a6c963f453b060609764e61c17401ea',NULL,'tractools',NULL,'','','email,user_about_me,create_event,publish_stream,status_update,user_birthday,user_location,user_work_history','info@tractools.com','http:/www.trestleresources.ca/contact.php',NULL,'1'),('2','33','cms','Boccoli Hair Salon','boccolihair','152106091511753','dc05d302be0df69216b3e1a245a58f49','8563ec9f266ac5b801a66954c47d459e',NULL,NULL,NULL,'','',NULL,'info@boccolihair.com','http://www.boccolihair.com/?default.php?cid=5&sid=12',NULL,'1'),('3','35','jobboard','PESCOLTD Careers','pescoltd','111631562246891','3fb1308374b2f16d9c5e62e252c80fea','f241c04f26befbfd17aee1bcc518c66e','jobboard/','pescoltd','Pesco-Ltd-Public-Edge-Solutions-Co-Ltd/171362846243655','PESCO has excellent career opportunities in various media and entertainment markets. Whether it\\\'s technology, graphics, marketing, promotions, or sales, Public Edge Solutions is the place to be!','PESCO has excellent career opportunities in various media and entertainment markets. Whether it\\\'s technology, graphics, marketing, promotions, or sales, Public Edge Solutions is the place to be!',NULL,'careers@pescoltd.ca','http://www.pescoltd.ca/support.php',NULL,'1'),('4','33','jobboard','Boccoli Careers','boccoli','132764066792299','0dca6815ce79d90d6faf7e9711bd0361','93eb96182581653466325c77b54b4c12','jobboard/','boccolihair','Boccoli-Hair-Salon/183585118337670','Boccoli Hair Salon is a family owned and operated community salon, located in the little Italy section of the Vancouver East Side. If you\\\'re interested in one of our many opportunities, then send us a message!','Come and visit us, at http://www.boccolihair.com We\\\'re always happy to have feedback from old and new customers alike!',NULL,'careers@boccolihair.com','http://www.boccolihair.com/?default.php?cid=5&sid=12',NULL,'1'),('5','35','cms','PESCOLTD CMS','pescoltd','212739468743388','2127ca612b63d708488e884b882b0e39','a739c7134ff7c674b464a4b0ceb78ac9','cms/','pescoltd_cms','/Pesco-Ltd-Public-Edge-Solutions-Co-Ltd/171362846243655?v=app_212739468743388','PESCO Ltd is your one stop source for information on events, fashion, trends and a personal touch on the pulse of our Vancouver! Come and visit us on Facebook or on the web at www.pescoltd.ca for more information!','PESCO Ltd is your one stop source for information on events, fashion, trends and a personal touch on the pulse of our Vancouver! Come and visit us on Facebook or on the web at www.pescoltd.ca for more information!','email,status_updates,user_birthday,user_location','info@pescoltd.ca','http://www.pescoltd.ca/support.php',NULL,'1'),('6','35','guestlist','PESCOLTD GuestList','pescoltd','208484942515480','438d0f096cc7a1db1d6b94a8da4679d7','3fc0cbd672914e4ffc5f703ea7ad8999','http://www.pescoltd.ca/fb/guestlist','http://apps.facebook.com/glvpesco/','http://www.facebook.com/PESCOLTD','Try out the PESCO Real Time Guest List system! Invite your friends on Facebook, or send the invite to friends not on Facebook through your smartphone, or email address! No more waiting for confirmation of your special event, or night out on the town!','You have a guest list invitation waiting for you! Come to the PESCO fan page, and confirm your guest list now!','email,user_about_me,sms,create_event,publish_stream,status_update,user_birthday','info@pescoltd.ca','http://www.pescoltd.ca/support.php',NULL,'1');

/*Table structure for table `fb_requests` */

DROP TABLE IF EXISTS `fb_requests`;

CREATE TABLE `fb_requests` (
  `glid` int(11) NOT NULL AUTO_INCREMENT,
  `fb_user_id` bigint(20) unsigned NOT NULL,
  `request_id` bigint(20) NOT NULL,
  `eid` bigint(20) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) DEFAULT '(NULL)',
  `outstanding` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`glid`),
  UNIQUE KEY `unique_pair` (`fb_user_id`,`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `fb_requests` */

/*Table structure for table `fb_tt_applications` */

DROP TABLE IF EXISTS `fb_tt_applications`;

CREATE TABLE `fb_tt_applications` (
  `appListID` int(11) NOT NULL AUTO_INCREMENT,
  `appName` varchar(255) DEFAULT 'NULL',
  `appNickName` varchar(100) DEFAULT 'NULL',
  `fbDirectory` varchar(255) DEFAULT 'NULL',
  `fbAdminDirectory` varchar(255) DEFAULT 'NULL',
  `fbDefinitionKey` int(11) NOT NULL DEFAULT '0',
  `fbAppDescription` text,
  PRIMARY KEY (`appListID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `fb_tt_applications` */

insert  into `fb_tt_applications`(`appListID`,`appName`,`appNickName`,`fbDirectory`,`fbAdminDirectory`,`fbDefinitionKey`,`fbAppDescription`) values ('1','Job Board','jobboard','fb/jobboard',NULL,'0','Career\'s Listing Job Board'),('2','Guest List','guestlist','fb/guestlist',NULL,'0','Guest List Management Software'),('3','e-Commerce','events','fb/commerce',NULL,'0','Facebook Shopping Cart'),('9','CMS','cms','fb/cms',NULL,'0','Content Management System'),('10','CRM','crm','fb/crm',NULL,'0','Customer Relationship Management System'),('11','EMS','ems','fb/ems',NULL,'0','Event Management System');

/*Table structure for table `fb_userapps` */

DROP TABLE IF EXISTS `fb_userapps`;

CREATE TABLE `fb_userapps` (
  `fbUsrAppsID` int(11) NOT NULL AUTO_INCREMENT,
  `contactID` int(11) NOT NULL DEFAULT '0',
  `companyID` int(11) NOT NULL DEFAULT '0',
  `fbUsrID` varchar(255) NOT NULL DEFAULT '0',
  `fbAppID` varchar(255) NOT NULL DEFAULT '0',
  `fbOrderID` int(11) NOT NULL DEFAULT '0',
  `fbEdit` tinyint(1) NOT NULL DEFAULT '0',
  `fbDel` tinyint(1) NOT NULL DEFAULT '0',
  `fbAdd` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`fbUsrAppsID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `fb_userapps` */

insert  into `fb_userapps`(`fbUsrAppsID`,`contactID`,`companyID`,`fbUsrID`,`fbAppID`,`fbOrderID`,`fbEdit`,`fbDel`,`fbAdd`,`active`) values ('1','1','35','570506173','194545173906891','1','1','1','1','1'),('2','1','0','570506173','152106091511753','2','1','1','1','1'),('3','1','35','570506173','111631562246891','3','1','1','1','1'),('4','163','0','100001494025731','132764066792299','1','1','1','1','1'),('5','1','0','570506173','132764066792299','4','1','1','1','1'),('6','2','35','503777020','111631562246891','1','1','1','1','1'),('7','2','35','503777020','132764066792299','2','1','1','1','1'),('10','162','35','1068780303','111631562246891','1','1','1','1','1'),('11','162','0','1068780303','132764066792299','2','1','1','1','1'),('12','166','35','503769040','111631562246891','1','0','0','0','1'),('13','164','35','814015499','194545173906891','1','0','0','0','1'),('14','164','0','814015499','152106091511753','2','0','0','0','1'),('15','164','35','814015499','111631562246891','3','0','0','0','1'),('19','166','35','503769040','111631562246891','0','0','0','0','1'),('17','2','0','503777020','152106091511753','3','0','0','0','1'),('18','164','0','814015499','152106091511753','4','0','0','0','1');

/*Table structure for table `fb_users` */

DROP TABLE IF EXISTS `fb_users`;

CREATE TABLE `fb_users` (
  `fbUsrID` bigint(20) NOT NULL AUTO_INCREMENT,
  `contactID` decimal(10,0) NOT NULL DEFAULT '0',
  `contactTypeID` int(11) NOT NULL DEFAULT '0',
  `fbID` varchar(255) NOT NULL DEFAULT '0',
  `fbUrl` varchar(255) DEFAULT 'NULL',
  `fbPic` varchar(255) DEFAULT 'NULL',
  `fbEmail` varchar(255) DEFAULT 'NULL',
  `fbblocked` tinyint(1) NOT NULL DEFAULT '0',
  `user_Likes` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`fbUsrID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `fb_users` */

insert  into `fb_users`(`fbUsrID`,`contactID`,`contactTypeID`,`fbID`,`fbUrl`,`fbPic`,`fbEmail`,`fbblocked`,`user_Likes`) values ('1','1','1','570506173','http://www.facebook.com/jvleuvaan','http://profile.ak.fbcdn.net/hprofile-ak-snc4/186296_570506173_4094586_q.jpg','james@trestleresources.com','0','1'),('2','2','1','503777020','http://www.facebook.com/carissa.campeotto','http://a7.sphotos.ak.fbcdn.net/hphotos-ak-snc3/28237_403418277020_503777020_4778007_4455966_n.jpg','carissa@pescoltd.ca','0','1'),('4','162','1','1068780303','http://www.facebook.com/people/Herb-Van-Grootel/1068780303','http://profile.ak.fbcdn.net/hprofile-ak-snc4/195648_1068780303_5820814_n.jpg','herb_vg@hotmail.com','0','1'),('5','163','0','100001494025731','http://www.facebook.com/people/Mary-Finamore-Campeotto/100001494025731','http://profile.ak.fbcdn.net/hprofile-ak-snc4/49864_100001494025731_3379_n.jpg','mfin604@hotmail.com','0','1'),('6','166','0','503769040','http://www.facebook.com/profile.php?id=503769040','http://profile.ak.fbcdn.net/hprofile-ak-snc4/187451_503769040_2004354_n.jpg','tee_eye_eff_eff@hotmail.com','0','1'),('7','164','0','814015499','http://www.facebook.com/people/Masha-Tikhonova/814015499','http://profile.ak.fbcdn.net/hprofile-ak-snc4/186799_814015499_6825331_n.jpg','masha@grafikavision.com','0','1'),('17','177','0','100002269711527','http://www.facebook.com/people/Maria-Bayer/100002269711527','http://profile.ak.fbcdn.net/hprofile-ak-snc4/195661_100002269711527_2224635_n.jpg','mbayer25@gmail.com','0','1'),('18','146','1','507857026','http://www.facebook.com/people/Eric-Elder/507857026','http://profile.ak.fbcdn.net/hprofile-ak-snc4/203413_507857026_812878_n.jpg','eric.elder84@gmail.com','0','1');

/*Table structure for table `hrm_careers` */

DROP TABLE IF EXISTS `hrm_careers`;

CREATE TABLE `hrm_careers` (
  `jobID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) DEFAULT NULL,
  `title` varchar(765) DEFAULT NULL,
  `description` blob,
  `qualifications` blob,
  `requirements` blob,
  `postStartDate` datetime DEFAULT NULL,
  `postEndDate` datetime DEFAULT NULL,
  `startSalary` decimal(12,0) DEFAULT NULL,
  `endSalary` decimal(12,0) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `positionType` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`jobID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `hrm_careers` */

insert  into `hrm_careers`(`jobID`,`companyID`,`title`,`description`,`qualifications`,`requirements`,`postStartDate`,`postEndDate`,`startSalary`,`endSalary`,`city`,`province`,`country`,`positionType`,`active`) values ('1','35','Street Promoter','We\'re currently looking for intelligent, motivated, socially active indivdiuals for various retail and street promotions within the downtown core, specifically on Granville (club district) and the Gastown area. If you are over the age of 21, with an established network within the Vancouver Lower Mainland, we would love to hear from you!',' 	<ul>\r\n	<li> Microsoft Word, Microsoft Excel</li>\r\n	<li> Must have a mobile phone (not pay and talk)</li>\r\n	<li> Available evenings and weekends</li>\r\n\r\n	</ul>','<br /><strong>For International Students</strong>\r\n 	<ul>\r\n	<li> Must be attending one of the prominent international schools within the downtown core of Vancouver</li>\r\n	<li> Must have a good working knowledge of conversational English</li>\r\n	<li> Must be available evenings and weekends (approximately 3 hours a night, Monday - Saturday)</li>\r\n	<li> Dress well</li>\r\n	<li> Able to speak to people fluidly and comfortably</li>\r\n	<li> Must be legally eligible to work in Canada or have a student Visa in good standing</li>\r\n	<li> Must be familiar with the downtown core, local amenities, and night clubs</li>\r\n	</ul>\r\n <strong>For Other Students</strong>\r\n 	<ul>\r\n 	<li> Must be attending one of the prominent post secondary schools within the lower mainland of Vancouver</li>\r\n 	<li> Must have a good working knowledge of conversational English, written, and grammar.</li>\r\n 	<li> Must be available evenings and weekends (approximately 3 hours a night, Monday - Saturday)</li>\r\n 	<li> Dress well</li>\r\n 	<li> Able to speak to people fluidly and comfortably</li>\r\n 	<li> Must be legally eligible to work in Canada or have a student Visa in good standing</li>\r\n	<li> Must be familiar with the downtown core, local amenities, and night clubs</li>\r\n	</ul>','2011-03-01 00:00:00','2012-10-01 00:00:00',NULL,NULL,NULL,NULL,NULL,'2','1'),('2','35','Retail Promoter','We\'re currently looking for individuals, with professional attitudes, appearance, and style to fulfill our requirement for retail tour marketing and promotions. If you think that you have what it takes to speak to individuals within various retail outlets, both in the downtown core, and surrounding area\'s please, forward your resume via the submission options below.','<ul>\r\n	<li>21 years of age or older</li>\r\n	<li>Excellent grasp of the english language both spoken and written</li>\r\n	<li>Professional attire</li>\r\n	<li>Some experience with Microsoft Office products (MS-Word, MS-Excel) appreciated</li>\r\n	<li>Able to learn a supplied script, yet also able to answer questions, through basic product knowledge</li>\r\n	<li>Comfortable on internet communities such as Facebook, LinkedIn, Google, and Twitter.</li>\r\n</ul>','<ul>\r\n	<li>Highly energetic</li>\r\n	<li>Friendly personality</li>\r\n	<li>Positive attitude</li>\r\n</ul>','2011-03-01 00:00:00','2012-10-01 00:00:00',NULL,NULL,NULL,NULL,NULL,'3','1'),('3','35','Junior Programmer','We are currently screening individuals who are in post secondary school for the position of entry level Intern programmer. This is a paid position for the proper candidate, with an opportunity to move to full-time, if the skills and abilities demonstrate better than average results.','<ul>\r\n	<li>PHP</li>\r\n	<li>Python</li>\r\n	<li>Ruby</li>\r\n	<li>ColdFusion</li>\r\n	<li>SQL</li>\r\n	<li>FQL</li>\r\n	<li>FBML</li>\r\n	<li>HTML5</li>\r\n	<li>CSS3</li>\r\n	<li>UNIX/LINUX</li>\r\n	<li>Windows Environments</li>\r\n	<li>Apple Environments</li>\r\n	<li>Ubuntu Environments</li>\r\n	<li>OOP</li>\r\n	<li>AOP</li>\r\n	<li>mySQL</li>\r\n	<li>MSSQL</li>\r\n	<li>jQuery</li>\r\n	<li>Javascript</li>\r\n	<li>Prototype</li>\r\n	<li>ECMA</li>\r\n	<li>AS3</li>\r\n	<li>XML</li>\r\n	<li>XSL</li>\r\n</ul>\r\n<br />\r\nDon\'t be overwhelmed by the list. We\'re willing to train the right candidates. ','<ul>\r\n	<li>Eagerness to learn</li>\r\n	<li>Quick thinker</li>\r\n	<li>3 dimensional abstract thinker</li>\r\n	<li>Not trapped in idea\'s or concepts</li>\r\n	<li>desire to function within a team environment</li>\r\n	<li>good grasp of english both written, and spoken</li>\r\n</ul>','2011-03-01 00:00:00','2012-10-01 00:00:00',NULL,NULL,NULL,NULL,NULL,'6','1'),('4','35','Graphic Designer','We are currently screening individuals who are in post secondary school (not written in stone) for the position of entry level junior designer. This is a paid position for the proper candidate, with an opportunity to move to full-time, if the skills and abilities demonstrate better than average results.','<ul>\r\n	<li>Photoshop</li>\r\n	<li>Illustrator</li>\r\n	<li>Print Work</li>\r\n	<li>Web graphic work (not web design)</li>\r\n	<li>Image optimization</li>\r\n</ul>','<ul>\r\n	<li>Eagerness to learn</li>\r\n	<li>Quick thinker</li>\r\n	<li>3 dimensional abstract thinker</li>\r\n	<li>Not trapped in idea\'s or concepts</li>\r\n	<li>desire to function within a team environment</li>\r\n	<li>good grasp of english both written, and spoken</li>\r\n</ul>','2011-03-01 00:00:00','2012-10-01 00:00:00',NULL,NULL,NULL,NULL,NULL,'6','1'),('5','35','Marketing Reps','We are currently looking to fill entry level promotional sales and marketing positions.<br />\r\n<br />\r\nWe are a young and diverse marketing firm specializing in client acquisitions and promotional marketing for 5 up and coming local start-up companies.We are currently offering progressive positions for long term growth in a fun, fast paced, energetic environment. Anyone with ambitious goals, strong work ethic and personality is welcome to apply.<br />\r\n<br />\r\nNo experience is necessary we will train and promote from within. A qualified candidate will learn in the areas of Corporate and Event Marketing, team management, human resources and campaign development and we offer travel opportunities, potential growth into management and very competitive wages.<br />\r\n<br />\r\nArea\'s of opportunity include Fashion Boutique\'s. Trade Shows, Night club, pub and bar promotions. Corporate, retail and private client event promotions and marketing.<br />\r\n<br />\r\nSo if you’re interested in advancement and you have aggressive goals for success, please submit your resume for consideration. ','<ul>\r\n	<li>21 years of age or older</li>\r\n	<li>Excellent grasp of the english language both spoken and written</li>\r\n	<li>Professional attire</li>\r\n	<li>Some experience with Microsoft Office products (MS-Word, MS-Excel) appreciated</li>\r\n	<li>Able to learn a supplied script, yet also able to answer questions, through basic product knowledge</li>\r\n	<li>Comfortable on internet communities such as Facebook, LinkedIn, Google, and Twitter.</li>\r\n</ul>','<ul>\r\n	<li>Highly energetic</li>\r\n	<li>Friendly personality</li>\r\n	<li>Positive attitude</li>\r\n</ul>','2011-03-01 00:00:00','2012-10-01 00:00:00',NULL,NULL,NULL,NULL,NULL,'2','1');

/*Table structure for table `hrm_employees` */

DROP TABLE IF EXISTS `hrm_employees`;

CREATE TABLE `hrm_employees` (
  `employeeID` int(11) NOT NULL AUTO_INCREMENT,
  `contactID` int(11) NOT NULL DEFAULT '0',
  `detailsID` int(11) NOT NULL DEFAULT '0',
  `empTypeID` int(11) NOT NULL DEFAULT '0',
  `companyID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`employeeID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `hrm_employees` */

insert  into `hrm_employees`(`employeeID`,`contactID`,`detailsID`,`empTypeID`,`companyID`) values ('1','1','1','2','34'),('2','2','2','2','34'),('3','2','2','2','35'),('4','146','2','2','34'),('5','163','69','12','33');

/*Table structure for table `hrm_employeetypes` */

DROP TABLE IF EXISTS `hrm_employeetypes`;

CREATE TABLE `hrm_employeetypes` (
  `employeeTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `employeeType` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`employeeTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `hrm_employeetypes` */

insert  into `hrm_employeetypes`(`employeeTypeID`,`employeeType`) values ('1','President'),('2','Vice President'),('3','Sales'),('4','Marketing'),('5','Promotions'),('6','Street Promoter'),('7','Administration'),('8','Accounting'),('9','Owner'),('10','Accounting'),('11','Owner'),('12','co-Owner');

/*Table structure for table `hrm_positions` */

DROP TABLE IF EXISTS `hrm_positions`;

CREATE TABLE `hrm_positions` (
  `positionTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `positionType` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`positionTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `hrm_positions` */

insert  into `hrm_positions`(`positionTypeID`,`positionType`) values ('1','Full-Time'),('2','Part-Time'),('3','Temporary'),('4','Seasonal'),('5','Intern'),('6','contract');

/*Table structure for table `hrm_resumes` */

DROP TABLE IF EXISTS `hrm_resumes`;

CREATE TABLE `hrm_resumes` (
  `resumeID` int(11) NOT NULL AUTO_INCREMENT,
  `jobID` int(11) NOT NULL DEFAULT '0',
  `contactID` int(11) NOT NULL DEFAULT '0',
  `fbID` int(11) NOT NULL DEFAULT '0',
  `location` varchar(255) DEFAULT 'NULL',
  `uploaded` tinyint(1) NOT NULL DEFAULT '0',
  `uploadResume` varchar(255) DEFAULT 'NULL',
  `uploadXML` text,
  `submitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewDate` datetime DEFAULT NULL,
  `interviewed` tinyint(1) NOT NULL DEFAULT '0',
  `hired` tinyint(1) NOT NULL DEFAULT '0',
  `hireDate` datetime DEFAULT NULL,
  PRIMARY KEY (`resumeID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `hrm_resumes` */

/*Table structure for table `hrm_skillset` */

DROP TABLE IF EXISTS `hrm_skillset`;

CREATE TABLE `hrm_skillset` (
  `skillsetID` int(11) NOT NULL AUTO_INCREMENT,
  `skillTypeID` int(11) NOT NULL DEFAULT '0',
  `skillset` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`skillsetID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `hrm_skillset` */

insert  into `hrm_skillset`(`skillsetID`,`skillTypeID`,`skillset`) values ('1','1','English Spelling'),('2','1','English Grammar'),('3','1','Mathematics'),('4','1','Microsoft Word'),('5','1','Microsoft Excel'),('6','1','Microsoft Powerpoint'),('7','1','Microsoft Access'),('8','2','Microsoft SQL Server'),('9','1','Google Apps'),('10','1','Facebook'),('11','1','Twitter'),('12','1','LinkedIn'),('13','2','PHP'),('14','2','mySQL'),('15','2','ASP 3.0'),('16','2','ASP.NET'),('17','2','Dot.NET Framework'),('18','2','C++'),('19','2','C#'),('20','2','Python'),('21','2','Ruby On Rails'),('22','2','ColdFusion'),('23','2','Javascript'),('24','2','jQuery'),('25','2','Prototype');

/*Table structure for table `hrm_skilltype` */

DROP TABLE IF EXISTS `hrm_skilltype`;

CREATE TABLE `hrm_skilltype` (
  `skillTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `skillType` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`skillTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `hrm_skilltype` */

insert  into `hrm_skilltype`(`skillTypeID`,`skillType`) values ('1','Office'),('2','Programming');

/*Table structure for table `pim_details` */

DROP TABLE IF EXISTS `pim_details`;

CREATE TABLE `pim_details` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `eventID` decimal(10,0) NOT NULL DEFAULT '0',
  `typeID` decimal(10,0) NOT NULL DEFAULT '0',
  `locationID` decimal(10,0) NOT NULL DEFAULT '0',
  `eventStartDate` date NOT NULL DEFAULT '0000-00-00',
  `eventEndDate` date DEFAULT '0000-00-00',
  `eventStartTime` time NOT NULL DEFAULT '00:00:00',
  `eventEndTime` time DEFAULT '00:00:00',
  `details` text,
  PRIMARY KEY (`detailID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `pim_details` */

insert  into `pim_details`(`detailID`,`eventID`,`typeID`,`locationID`,`eventStartDate`,`eventEndDate`,`eventStartTime`,`eventEndTime`,`details`) values ('1','1','3','11','2011-02-05','2011-02-06','21:30:00','03:00:00','Donec in erat odio. Sed ac nisi sed est tincidunt adipiscing. Sed volutpat suscipit ipsum, eu lobortis nunc ullamcorper id. Nam consectetur ligula in lorem pharetra consectetur. Suspendisse potenti. Pellentesque ut lacus elit, non aliquet sapien. Nam blandit diam in massa pulvinar ultrices. Nam mattis libero a est volutpat tincidunt. Ut eget condimentum quam. Sed fringilla dapibus tristique.'),('2','2','10','11','2011-02-06','2011-02-07','20:30:00','02:00:00','Donec in erat odio. Sed ac nisi sed est tincidunt adipiscing. Sed volutpat suscipit ipsum, eu lobortis nunc ullamcorper id. Nam consectetur ligula in lorem pharetra consectetur. Suspendisse potenti. Pellentesque ut lacus elit, non aliquet sapien. Nam blandit diam in massa pulvinar ultrices. Nam mattis libero a est volutpat tincidunt. Ut eget condimentum quam. Sed fringilla dapibus tristique.'),('3','2','10','11','2011-02-08','2011-02-09','20:30:00','02:00:00','Donec in erat odio. Sed ac nisi sed est tincidunt adipiscing. Sed volutpat suscipit ipsum, eu lobortis nunc ullamcorper id. Nam consectetur ligula in lorem pharetra consectetur. Suspendisse potenti. Pellentesque ut lacus elit, non aliquet sapien. Nam blandit diam in massa pulvinar ultrices. Nam mattis libero a est volutpat tincidunt. Ut eget condimentum quam. Sed fringilla dapibus tristique.'),('4','2','10','11','2011-02-11','2011-02-12','20:30:00','02:00:00','Donec in erat odio. Sed ac nisi sed est tincidunt adipiscing. Sed volutpat suscipit ipsum, eu lobortis nunc ullamcorper id. Nam consectetur ligula in lorem pharetra consectetur. Suspendisse potenti. Pellentesque ut lacus elit, non aliquet sapien. Nam blandit diam in massa pulvinar ultrices. Nam mattis libero a est volutpat tincidunt. Ut eget condimentum quam. Sed fringilla dapibus tristique.'),('5','2','10','11','2011-02-21','2011-02-22','20:30:00','02:00:00','Donec in erat odio. Sed ac nisi sed est tincidunt adipiscing. Sed volutpat suscipit ipsum, eu lobortis nunc ullamcorper id. Nam consectetur ligula in lorem pharetra consectetur. Suspendisse potenti. Pellentesque ut lacus elit, non aliquet sapien. Nam blandit diam in massa pulvinar ultrices. Nam mattis libero a est volutpat tincidunt. Ut eget condimentum quam. Sed fringilla dapibus tristique.'),('6','2','10','11','2011-02-22','2011-02-23','20:30:00','02:00:00','Donec in erat odio. Sed ac nisi sed est tincidunt adipiscing. Sed volutpat suscipit ipsum, eu lobortis nunc ullamcorper id. Nam consectetur ligula in lorem pharetra consectetur. Suspendisse potenti. Pellentesque ut lacus elit, non aliquet sapien. Nam blandit diam in massa pulvinar ultrices. Nam mattis libero a est volutpat tincidunt. Ut eget condimentum quam. Sed fringilla dapibus tristique.'),('7','3','9','11','2011-02-28','2011-03-01','20:30:00','02:00:00','Donec in erat odio. Sed ac nisi sed est tincidunt adipiscing. Sed volutpat suscipit ipsum, eu lobortis nunc ullamcorper id. Nam consectetur ligula in lorem pharetra consectetur. Suspendisse potenti. Pellentesque ut lacus elit, non aliquet sapien. Nam blandit diam in massa pulvinar ultrices. Nam mattis libero a est volutpat tincidunt. Ut eget condimentum quam. Sed fringilla dapibus tristique.');

/*Table structure for table `pim_events` */

DROP TABLE IF EXISTS `pim_events`;

CREATE TABLE `pim_events` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `reoccuring` tinyint(1) NOT NULL DEFAULT '0',
  `event` varchar(255) DEFAULT 'NULL',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locationID` decimal(10,0) NOT NULL,
  `addressID` decimal(10,0) NOT NULL,
  PRIMARY KEY (`eventID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `pim_events` */

insert  into `pim_events`(`eventID`,`reoccuring`,`event`,`creationDate`,`locationID`,`addressID`) values ('1','1','Event 1','2011-02-05 11:22:23','11','0'),('2','1','Event 2','2011-02-05 15:46:19','11','0'),('3','1','Event 3','2011-02-28 17:39:35','11','0'),('4','1','Event 4','2011-02-03 10:12:57','11','0');

/*Table structure for table `pim_type` */

DROP TABLE IF EXISTS `pim_type`;

CREATE TABLE `pim_type` (
  `typeID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`typeID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `pim_type` */

insert  into `pim_type`(`typeID`,`type`) values ('1','Social Networking'),('2','Fashion'),('3','Club'),('4','Lounge'),('5','Special Event (DJ)'),('6','Live Bands'),('7','Live Theatre'),('8','Musical'),('9','Private Party'),('10','Public House');

/*Table structure for table `tt_addresses` */

DROP TABLE IF EXISTS `tt_addresses`;

CREATE TABLE `tt_addresses` (
  `addressID` int(11) NOT NULL AUTO_INCREMENT,
  `referenceID` decimal(10,0) NOT NULL DEFAULT '0',
  `address1` varchar(100) DEFAULT 'NULL',
  `address2` varchar(100) DEFAULT 'NULL',
  `POBox` varchar(10) DEFAULT 'NULL',
  `cityID` decimal(10,0) NOT NULL DEFAULT '0',
  `stateID` decimal(10,0) NOT NULL DEFAULT '0',
  `countryID` decimal(10,0) NOT NULL DEFAULT '0',
  `postalCodeID` decimal(10,0) NOT NULL DEFAULT '0',
  `primary` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`addressID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tt_addresses` */

insert  into `tt_addresses`(`addressID`,`referenceID`,`address1`,`address2`,`POBox`,`cityID`,`stateID`,`countryID`,`postalCodeID`,`primary`) values ('1','0','901 Granville Street','at Smithe',NULL,'0','0','0','0','1');

/*Table structure for table `tt_cities` */

DROP TABLE IF EXISTS `tt_cities`;

CREATE TABLE `tt_cities` (
  `cityID` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(100) DEFAULT 'NULL',
  `abbr` varchar(20) DEFAULT 'NULL',
  PRIMARY KEY (`cityID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tt_cities` */

/*Table structure for table `tt_countries` */

DROP TABLE IF EXISTS `tt_countries`;

CREATE TABLE `tt_countries` (
  `countryID` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) DEFAULT 'NULL',
  `abbr` varchar(10) DEFAULT 'NULL',
  PRIMARY KEY (`countryID`)
) ENGINE=MyISAM AUTO_INCREMENT=246 DEFAULT CHARSET=utf8;

/*Data for the table `tt_countries` */

insert  into `tt_countries`(`countryID`,`country`,`abbr`) values ('1','Andorra','AD'),('2','United Arab Emirates','AE'),('3','Afghanistan','AF'),('4','Antigua & Barbuda','AG'),('5','Anguilla','AI'),('6','Albania','AL'),('7','Armenia','AM'),('8','Netherlands Antilles','AN'),('9','Angola','AO'),('10','Antarctica','AQ'),('11','Argentina','AR'),('12','American Samoa','AS'),('13','Austria','AT'),('14','Australia','AU'),('15','Aruba','AW'),('16','Azerbaijan','AZ'),('17','Bosnia and Herzegovina','BA'),('18','Barbados','BB'),('19','Bangladesh','BD'),('20','Belgium','BE'),('21','Burkina Faso','BF'),('22','Bulgaria','BG'),('23','Bahrain','BH'),('24','Burundi','BI'),('25','Benin','BJ'),('26','Bermuda','BM'),('27','Brunei Darussalam','BN'),('28','Bolivia','BO'),('29','Brazil','BR'),('30','Bahama','BS'),('31','Bhutan','BT'),('32','Burma (no longer exists)','BU'),('33','Bouvet Island','BV'),('34','Botswana','BW'),('35','Belarus','BY'),('36','Belize','BZ'),('37','Canada','CA'),('38','Cocos (Keeling) Islands','CC'),('39','Central African Republic','CF'),('40','Congo','CG'),('41','Switzerland','CH'),('42','CÃ´te D\'ivoire (Ivory Coast)','CI'),('43','Cook Iislands','CK'),('44','Chile','CL'),('45','Cameroon','CM'),('46','China','CN'),('47','Colombia','CO'),('48','Costa Rica','CR'),('49','Czechoslovakia (no longer exists)','CS'),('50','Cuba','CU'),('51','Cape Verde','CV'),('52','Christmas Island','CX'),('53','Cyprus','CY'),('54','Czech Republic','CZ'),('55','German Democratic Republic (no longer exists)','DD'),('56','Germany','DE'),('57','Djibouti','DJ'),('58','Denmark','DK'),('59','Dominica','DM'),('60','Dominican Republic','DO'),('61','Algeria','DZ'),('62','Ecuador','EC'),('63','Estonia','EE'),('64','Egypt','EG'),('65','Western Sahara','EH'),('66','Eritrea','ER'),('67','Spain','ES'),('68','Ethiopia','ET'),('69','Finland','FI'),('70','Fiji','FJ'),('71','Falkland Islands (Malvinas)','FK'),('72','Micronesia','FM'),('73','Faroe Islands','FO'),('74','France','FR'),('75','France, Metropolitan','FX'),('76','Gabon','GA'),('77','United Kingdom (Great Britain)','GB'),('78','Grenada','GD'),('79','Georgia','GE'),('80','French Guiana','GF'),('81','Ghana','GH'),('82','Gibraltar','GI'),('83','Greenland','GL'),('84','Gambia','GM'),('85','Guinea','GN'),('86','Guadeloupe','GP'),('87','Equatorial Guinea','GQ'),('88','Greece','GR'),('89','South Georgia and the South Sandwich Islands','GS'),('90','Guatemala','GT'),('91','Guam','GU'),('92','Guinea-Bissau','GW'),('93','Guyana','GY'),('94','Hong Kong','HK'),('95','Heard & McDonald Islands','HM'),('96','Honduras','HN'),('97','Croatia','HR'),('98','Haiti','HT'),('99','Hungary','HU'),('100','Indonesia','ID'),('101','Ireland','IE'),('102','Israel','IL'),('103','India','IN'),('104','British Indian Ocean Territory','IO'),('105','Iraq','IQ'),('106','Islamic Republic of Iran','IR'),('107','Iceland','IS'),('108','Italy','IT'),('109','Jamaica','JM'),('110','Jordan','JO'),('111','Japan','JP'),('112','Kenya','KE'),('113','Kyrgyzstan','KG'),('114','Cambodia','KH'),('115','Kiribati','KI'),('116','Comoros','KM'),('117','St. Kitts and Nevis','KN'),('118','Korea, Democratic People\'s Republic of','KP'),('119','Korea, Republic of','KR'),('120','Kuwait','KW'),('121','Cayman Islands','KY'),('122','Kazakhstan','KZ'),('123','Lao People\'s Democratic Republic','LA'),('124','Lebanon','LB'),('125','Saint Lucia','LC'),('126','Liechtenstein','LI'),('127','Sri Lanka','LK'),('128','Liberia','LR'),('129','Lesotho','LS'),('130','Lithuania','LT'),('131','Luxembourg','LU'),('132','Latvia','LV'),('133','Libyan Arab Jamahiriya','LY'),('134','Morocco','MA'),('135','Monaco','MC'),('136','Moldova, Republic of','MD'),('137','Madagascar','MG'),('138','Marshall Islands','MH'),('139','Mali','ML'),('140','Mongolia','MN'),('141','Myanmar','MM'),('142','Macau','MO'),('143','Northern Mariana Islands','MP'),('144','Martinique','MQ'),('145','Mauritania','MR'),('146','Monserrat','MS'),('147','Malta','MT'),('148','Mauritius','MU'),('149','Maldives','MV'),('150','Malawi','MW'),('151','Mexico','MX'),('152','Malaysia','MY'),('153','Mozambique','MZ'),('154','Namibia','NA'),('155','New Caledonia','NC'),('156','Niger','NE'),('157','Norfolk Island','NF'),('158','Nigeria','NG'),('159','Nicaragua','NI'),('160','Netherlands','NL'),('161','Norway','NO'),('162','Nepal','NP'),('163','Nauru','NR'),('164','Neutral Zone (no longer exists)','NT'),('165','Niue','NU'),('166','New Zealand','NZ'),('167','Oman','OM'),('168','Panama','PA'),('169','Peru','PE'),('170','French Polynesia','PF'),('171','Papua New Guinea','PG'),('172','Philippines','PH'),('173','Pakistan','PK'),('174','Poland','PL'),('175','St. Pierre & Miquelon','PM'),('176','Pitcairn','PN'),('177','Puerto Rico','PR'),('178','Portugal','PT'),('179','Palau','PW'),('180','Paraguay','PY'),('181','Qatar','QA'),('182','RÃ©union','RE'),('183','Romania','RO'),('184','Russian Federation','RU'),('185','Rwanda','RW'),('186','Saudi Arabia','SA'),('187','Solomon Islands','SB'),('188','Seychelles','SC'),('189','Sudan','SD'),('190','Sweden','SE'),('191','Singapore','SG'),('192','St. Helena','SH'),('193','Slovenia','SI'),('194','Svalbard & Jan Mayen Islands','SJ'),('195','Slovakia','SK'),('196','Sierra Leone','SL'),('197','San Marino','SM'),('198','Senegal','SN'),('199','Somalia','SO'),('200','Suriname','SR'),('201','Sao Tome & Principe','ST'),('202','Union of Soviet Socialist Republics (no longer exists)','SU'),('203','El Salvador','SV'),('204','Syrian Arab Republic','SY'),('205','Swaziland','SZ'),('206','Turks & Caicos Islands','TC'),('207','Chad','TD'),('208','French Southern Territories','TF'),('209','Togo','TG'),('210','Thailand','TH'),('211','Tajikistan','TJ'),('212','Tokelau','TK'),('213','Turkmenistan','TM'),('214','Tunisia','TN'),('215','Tonga','TO'),('216','East Timor','TP'),('217','Turkey','TR'),('218','Trinidad & Tobago','TT'),('219','Tuvalu','TV'),('220','Taiwan, Province of China','TW'),('221','Tanzania, United Republic of','TZ'),('222','Ukraine','UA'),('223','Uganda','UG'),('224','United States Minor Outlying Islands','UM'),('225','United States of America','US'),('226','Uruguay','UY'),('227','Uzbekistan','UZ'),('228','Vatican City State (Holy See)','VA'),('229','St. Vincent & the Grenadines','VC'),('230','Venezuela','VE'),('231','British Virgin Islands','VG'),('232','United States Virgin Islands','VI'),('233','Viet Nam','VN'),('234','Vanuatu','VU'),('235','Wallis & Futuna Islands','WF'),('236','Samoa','WS'),('237','Democratic Yemen (no longer exists)','YD'),('238','Yemen','YE'),('239','Mayotte','YT'),('240','Yugoslavia','YU'),('241','South Africa','ZA'),('242','Zambia','ZM'),('243','Zaire','ZR'),('244','Zimbabwe','ZW'),('245','Unknown or unspecified country','ZZ');

/*Table structure for table `tt_credentials` */

DROP TABLE IF EXISTS `tt_credentials`;

CREATE TABLE `tt_credentials` (
  `credentialID` int(11) NOT NULL AUTO_INCREMENT,
  `credential` varchar(100) DEFAULT 'NULL',
  `HashControl` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`credentialID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `tt_credentials` */

insert  into `tt_credentials`(`credentialID`,`credential`,`HashControl`) values ('1','System Administrator','NULL'),('2','Administrator','NULL'),('3','Team Leader','NULL'),('4','Promoter','NULL'),('5','Guest Host','NULL'),('6','Guest Guests','NULL'),('7','Club Manager','NULL'),('8','Coat Check','NULL'),('9','Bar Manager','NULL'),('10','Club Owner','NULL'),('11','GL Door person',NULL),('12','GL VIP person',NULL);

/*Table structure for table `tt_languages` */

DROP TABLE IF EXISTS `tt_languages`;

CREATE TABLE `tt_languages` (
  `langID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'TRACTools Language ID',
  `Lang` varchar(255) DEFAULT 'NULL',
  `code` varchar(5) DEFAULT 'NULL',
  `LCID` varchar(10) DEFAULT 'NULL',
  PRIMARY KEY (`langID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `tt_languages` */

insert  into `tt_languages`(`langID`,`Lang`,`code`,`LCID`) values ('1','English - United States','en','en-us'),('2','English - Great Britian','en','en-gb'),('3','English - Australia','en','en-au'),('4','English - Canada','en','en-ca'),('5','English - New Zealand','en','en-nz'),('6','English - Ireland','en','en-ie'),('7','French - Belgium','fr','fr-be'),('8','French - Canada','fr','fr-ca'),('9','French - France','fr','fr-fr'),('10','French - Luxembourg','fr','fr-lu'),('11','French - Switzerland','fr','fr-ch'),('12','Italian - Italy','it','it-it'),('13','Italian - Switzerland','it','it-ch'),('14','Dutch - Belgium','nl','nl-be'),('15','Dutch - Netherlands','nl','nl-nl');

/*Table structure for table `tt_mobilecarrier` */

DROP TABLE IF EXISTS `tt_mobilecarrier`;

CREATE TABLE `tt_mobilecarrier` (
  `mobileID` int(11) NOT NULL AUTO_INCREMENT,
  `Carrier` varchar(255) DEFAULT 'NULL',
  `CarrierExtension` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`mobileID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `tt_mobilecarrier` */

insert  into `tt_mobilecarrier`(`mobileID`,`Carrier`,`CarrierExtension`) values ('1','Bell','txt.bellmobility.ca'),('2','Telus','msg.telus.com'),('3','Rogers','rci.rogers.com'),('4','Fido','fido.ca'),('5','Koodo','msg.koodomobile.com'),('6','Virgin','vmobile.ca'),('7','Solo','txt.bell.ca'),('8','Presidents Choice','txt.bell.ca'),('9','MTS','text.mtsmobility.com'),('10','Saskatchewan Telecom','sms.sasktel.com'),('11','Wind Mobile','msg.wind.ca');

/*Table structure for table `tt_postalcodes` */

DROP TABLE IF EXISTS `tt_postalcodes`;

CREATE TABLE `tt_postalcodes` (
  `postalcodeID` int(11) NOT NULL AUTO_INCREMENT,
  `postalcode` varchar(20) DEFAULT 'NULL',
  `longitude` decimal(20,0) DEFAULT NULL,
  `latitude` decimal(20,0) DEFAULT '0',
  PRIMARY KEY (`postalcodeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tt_postalcodes` */

/*Table structure for table `tt_state` */

DROP TABLE IF EXISTS `tt_state`;

CREATE TABLE `tt_state` (
  `stateID` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(100) DEFAULT 'NULL',
  `abbr` varchar(10) DEFAULT 'NULL',
  PRIMARY KEY (`stateID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tt_state` */

/*Table structure for table `tt_titles` */

DROP TABLE IF EXISTS `tt_titles`;

CREATE TABLE `tt_titles` (
  `titleID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`titleID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `tt_titles` */

insert  into `tt_titles`(`titleID`,`title`) values ('1','Street Promoter'),('2','Retail Promoter'),('3','Computer Programmer'),('4','Graphic Designer'),('5','Sales Representative'),('6','Marketing Representative'),('7','Disc Jockey'),('8','Executive Assistant'),('9','Intern'),('10','Entry Level Programmer'),('11','Hair Stylist'),('12','Hair Color Stylist'),('13','L\'Oreal Professional'),('14','Sales Associate'),('15','Marketing Associate'),('16','Secratary'),('17','Junior Programmer'),('18','Senior Programmer'),('19','Entry Level Marketing');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
