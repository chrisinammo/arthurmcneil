<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );
jimport( 'joomla.application.component.model' );
JModel::addIncludePath(COM_FABRIK_FRONTEND.DS.'models');

class FabrikViewHome {


	/**
	* Display home page
	*/
	
	function show( )
	{
			global $mosConfig_live_site;
?>
<div style="background-color:#1c1c1c;color:white;text-align:left;padding:10px;">
<img src="<?php echo $mosConfig_live_site;?>/administrator/components/com_fabrik/images/logo2.png" alt="Fabrik" />

<h2>About</h2>
<p>Fabrik is an open source Joomla form and database management component.</p>
<p>
Fabrik gives people the power to create applications that run inside Joomla without requiring knowledge of mySQL and PHP, all from within the familiar Joomla administration interface.
</p>
<p>
Fabrik provides you with all the tools that you need to create applications that range in complexity from simple contact 
forms to complex applications such as a job application site or bug tracking systems.</p> 

<h3>Tools</h3>

<p>
	<a href="index.php?option=com_fabrik&c=home&task=reset">Reset Fabrik</a>
</p>

<h3>Sample data</h3>

<a href="index.php?option=com_fabrik&task=installSampleData">Install Sample data</a>

<h3>Useful Links</h3>
<ul>
<li><a href="http://fabrikar.com/">Fabrik web site</a></li>
<li><a href="http://fabrikar.com/index.php?option=com_smf&Itemid=9">Forum</a><li>
<li><a href="http://fabrikar.com/index.php?option=com_openwiki&Itemid=11">Documentation WIKI</a></li>
</ul>

<a href="http://fabrikar.com/index.php?option=com_registration">
<img  style="border:0;" src="http://fabrikar.com/images/stories/subscribe.jpg">
</a>

<h2>Migration</h2>
<p>By clicking on the link below Fabrik will attempt to migrate from Fabrik 1.0.4 to Fabrik 2.0.</p>
<p>This includes:</p>
<ul>
	<li>Tables, forms, groups, elements, validations & validation rules</li>
	<li>Any database tables created by mosForms</li>
	<li>MosForm menu items</li>
	<li>MosForm Templates</li>
</ul>
<p>The migrator will leave all mosForms data in place, except for the menu items which are overwritten with the corresponding fabrik links.</p>
<h2>To do!</h2>
</div>
	<?php }
	


}
?>