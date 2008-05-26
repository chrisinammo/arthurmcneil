<?php
/**
 * @version		$Id: form.php 9944 2008-01-14 21:10:22Z eddieajau $
 * @package		Joomla.Framework
 * @subpackage	HTML
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

/**
 * Utility class for form elements
 *
 * @static
 * @package 	Joomla.Framework
 * @subpackage	HTML
 * @version		1.5
 */
class JHTMLForm
{
	/**
	 * Displays a hidden token field to reduce the risk of CSRF exploits
	 *
	 * Use in conjuction with JRequest::checkToken
	 *
	 * @static
	 * @return	void
	 * @since	1.5
	 */
	function token()
	{
		return '<input type="hidden" name="'.JUtility::getToken().'" value="1" />';
	}
}