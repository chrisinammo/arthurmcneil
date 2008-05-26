<?php
/**
* @version		$Id: footer.php 9764 2007-12-30 07:48:11Z ircmaxell $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$version = new JVersion();

// NOTE - You may change this file to suit your site needs
?>
<div align="center">
	&copy; <?php echo JHTML::_('date',  'now', '%Y' ) . ' ' . $mainframe->getCfg('sitename'); ?>
</div>

<div align="center">
	<?php echo $version->URL; ?>
</div>