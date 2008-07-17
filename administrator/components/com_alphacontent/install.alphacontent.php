<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */
defined('_JEXEC') or die('Restricted access');

defined('JPATH_BASE') or die();
global $mainframe;

// include version
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'assets'.DS.'includes'.DS.'version.php');

// Copyright
$copyStart = 2005; 
$copyNow = date('Y');  
if ($copyStart == $copyNow) { 
	$copySite = $copyStart;
} else {
	$copySite = $copyStart." - ".$copyNow ;
}

$file_destination_php = JPATH_PLUGINS.DS.'content'.DS.'alphacontent.php';
$file_destination_xml = JPATH_PLUGINS.DS.'content'.DS.'alphacontent.xml';

$file_orginal_php = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontent.php';
$file_orginal_xml = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_alphacontent'.DS.'install'.DS.'plugins'.DS.'alphacontent.xml';

@copy ($file_orginal_php, $file_destination_php );
@copy ($file_orginal_xml, $file_destination_xml );

// publish plugin 
$db	=& JFactory::getDBO(); 
$query = "INSERT INTO `#__plugins` VALUES ('', 'AlphaContent', 'alphacontent', 'content', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', '')";
$db->setQuery( $query );
$db->query();

if (!file_exists ($file_destination_php ) && !file_exists($file_destination_php ) ) {
	$mainframe->redirect( 'index.php?option=com_alphacontent','NOTICE: AlphaContent plugin is not successfully installed. Make sure that the plugin directory is writeable' );
} else {
?>
<table width="100%" border="0">
<tr>
  <td><img src="components/com_alphacontent/assets/images/alphacontent.jpg"></td>
  <td>
	<strong>AlphaContent - A Joomla Directory Component</strong><br />
	<font class="small">&copy; <?php echo $copySite ; ?> - Bernard Gilly<br />
	Released under donationware licence - All Rights Reserved - <a href="http://www.alphaplug.com" target="_blank">www.alphaplug.com</a></font><br />
  </td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
  <td background="E0E0E0" style="border:1px solid #999999;color:green;font-weight:bold;" colspan="2">Installation finished.</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
</table>
<?php } ?>