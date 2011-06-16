-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

-- 
-- Table `tl_xml_exchange`
-- 

CREATE TABLE `tl_xml_exchange` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `type` varchar(32) NOT NULL default '',
  `pageTree` text NULL,
  `inherit` char(1) NOT NULL default '',
  `pages` blob NULL,
  `articles` blob NULL,
  `contentElements` blob NULL,
  `module` blob NULL,
  `moduleFields` blob NULL,
  PRIMARY KEY  (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;