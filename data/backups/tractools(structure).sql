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

/*Table structure for table `ams_contacttype` */

DROP TABLE IF EXISTS `ams_contacttype`;

CREATE TABLE `ams_contacttype` (
  `contactTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `contactType` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`contactTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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

/*Table structure for table `cms_widgets` */

DROP TABLE IF EXISTS `cms_widgets`;

CREATE TABLE `cms_widgets` (
  `widgetID` int(11) NOT NULL AUTO_INCREMENT,
  `widgetTypeID` int(11) NOT NULL DEFAULT '1' COMMENT 'Entire Page Widget or Page Area Widget',
  `widget` varchar(255) DEFAULT 'NULL' COMMENT 'Widget Name',
  PRIMARY KEY (`widgetID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `cms_widgettype` */

DROP TABLE IF EXISTS `cms_widgettype`;

CREATE TABLE `cms_widgettype` (
  `widgetTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `widgetType` varchar(255) DEFAULT 'NULL',
  `desc` text,
  PRIMARY KEY (`widgetTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `coming_soon` */

DROP TABLE IF EXISTS `coming_soon`;

CREATE TABLE `coming_soon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `crm_banlist` */

DROP TABLE IF EXISTS `crm_banlist`;

CREATE TABLE `crm_banlist` (
  `banlistID` bigint(20) NOT NULL AUTO_INCREMENT,
  `contactID` decimal(10,0) DEFAULT NULL,
  `bandate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`banlistID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `crm_categories` */

DROP TABLE IF EXISTS `crm_categories`;

CREATE TABLE `crm_categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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

/*Table structure for table `hrm_employeetypes` */

DROP TABLE IF EXISTS `hrm_employeetypes`;

CREATE TABLE `hrm_employeetypes` (
  `employeeTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `employeeType` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`employeeTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `hrm_positions` */

DROP TABLE IF EXISTS `hrm_positions`;

CREATE TABLE `hrm_positions` (
  `positionTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `positionType` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`positionTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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

/*Table structure for table `hrm_skillset` */

DROP TABLE IF EXISTS `hrm_skillset`;

CREATE TABLE `hrm_skillset` (
  `skillsetID` int(11) NOT NULL AUTO_INCREMENT,
  `skillTypeID` int(11) NOT NULL DEFAULT '0',
  `skillset` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`skillsetID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Table structure for table `hrm_skilltype` */

DROP TABLE IF EXISTS `hrm_skilltype`;

CREATE TABLE `hrm_skilltype` (
  `skillTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `skillType` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`skillTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

/*Table structure for table `pim_type` */

DROP TABLE IF EXISTS `pim_type`;

CREATE TABLE `pim_type` (
  `typeID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`typeID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

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

/*Table structure for table `tt_cities` */

DROP TABLE IF EXISTS `tt_cities`;

CREATE TABLE `tt_cities` (
  `cityID` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(100) DEFAULT 'NULL',
  `abbr` varchar(20) DEFAULT 'NULL',
  PRIMARY KEY (`cityID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tt_countries` */

DROP TABLE IF EXISTS `tt_countries`;

CREATE TABLE `tt_countries` (
  `countryID` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) DEFAULT 'NULL',
  `abbr` varchar(10) DEFAULT 'NULL',
  PRIMARY KEY (`countryID`)
) ENGINE=MyISAM AUTO_INCREMENT=246 DEFAULT CHARSET=utf8;

/*Table structure for table `tt_credentials` */

DROP TABLE IF EXISTS `tt_credentials`;

CREATE TABLE `tt_credentials` (
  `credentialID` int(11) NOT NULL AUTO_INCREMENT,
  `credential` varchar(100) DEFAULT 'NULL',
  `HashControl` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`credentialID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `tt_languages` */

DROP TABLE IF EXISTS `tt_languages`;

CREATE TABLE `tt_languages` (
  `langID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'TRACTools Language ID',
  `Lang` varchar(255) DEFAULT 'NULL',
  `code` varchar(5) DEFAULT 'NULL',
  `LCID` varchar(10) DEFAULT 'NULL',
  PRIMARY KEY (`langID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `tt_mobilecarrier` */

DROP TABLE IF EXISTS `tt_mobilecarrier`;

CREATE TABLE `tt_mobilecarrier` (
  `mobileID` int(11) NOT NULL AUTO_INCREMENT,
  `Carrier` varchar(255) DEFAULT 'NULL',
  `CarrierExtension` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`mobileID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `tt_postalcodes` */

DROP TABLE IF EXISTS `tt_postalcodes`;

CREATE TABLE `tt_postalcodes` (
  `postalcodeID` int(11) NOT NULL AUTO_INCREMENT,
  `postalcode` varchar(20) DEFAULT 'NULL',
  `longitude` decimal(20,0) DEFAULT NULL,
  `latitude` decimal(20,0) DEFAULT '0',
  PRIMARY KEY (`postalcodeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tt_state` */

DROP TABLE IF EXISTS `tt_state`;

CREATE TABLE `tt_state` (
  `stateID` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(100) DEFAULT 'NULL',
  `abbr` varchar(10) DEFAULT 'NULL',
  PRIMARY KEY (`stateID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tt_titles` */

DROP TABLE IF EXISTS `tt_titles`;

CREATE TABLE `tt_titles` (
  `titleID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT 'NULL',
  PRIMARY KEY (`titleID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
