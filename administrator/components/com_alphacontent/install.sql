CREATE TABLE IF NOT EXISTS `#__alpha_rating` (
  `ref` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `total_votes` int(11) NOT NULL default '0',
  `total_value` int(11) NOT NULL default '0',
  `used_ips` longtext NOT NULL default '',
  `component` varchar(30) NOT NULL default '',
  `cid` int(11) NOT NULL default '0',
  `rid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ref`)
) TYPE=MyISAM;
