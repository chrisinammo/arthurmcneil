DROP TABLE IF EXISTS `#__gk_tabsman_groups`;
DROP TABLE IF EXISTS `#__gk_tabsman_tabs`;
			
CREATE TABLE `#__gk_tabsman_groups` (
`id` int(11) NOT NULL auto_increment,
`name` varchar(110) NOT NULL default '',
`desc` mediumtext NOT NULL default '',
`module` varchar(110) NOT NULL default '',
PRIMARY KEY  (`id`)
) TYPE=MyISAM;
			
CREATE TABLE `#__gk_tabsman_tabs` (
`id` int(11) unsigned NOT NULL auto_increment,
`group_id` int(11) unsigned NOT NULL,
`name` varchar(110) NOT NULL default '',
`content` varchar(110) NOT NULL default '',
`order` int(4) unsigned NOT NULL,
PRIMARY KEY  (`id`)
) TYPE=MyISAM;