<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: compat15.php 1076 2008-05-02 14:22:06Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2008 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined("_VALID_MOS") or die("Direct Access to this location is not allowed");

global $_VERSION;
if (floatval($_VERSION->getShortVersion())>=1.5){

// get some legacy constants from Joomla core components
	$tmplang = & JFactory::getLanguage();
	$tmplang->load('com_content');
	$tmplang->load('mod_search');
	if (!defined('_E_WARNTITLE'))	define('_E_WARNTITLE',	JTEXT::_('ARTICLE MUST HAVE A TITLE'));
	if (!defined('_E_WARNCAT'))		define('_E_WARNCAT',	JTEXT::_('SELECT A CATEGORY'));
	if (!defined('_E_STATE'))		define('_E_STATE',		JTEXT::_('STATE'));
	if (!defined('_E_HITS'))		define('_E_HITS',		JTEXT::_('HITS'));
	if (!defined('_E_CREATED'))		define('_E_CREATED',	JTEXT::_('CREATED'));
	if (!defined('_E_LAST_MOD'))	define('_E_LAST_MOD',	JTEXT::_('MODIFIED'));
	if (!defined('_E_EDIT'))		define('_E_EDIT',		JTEXT::_('EDIT'));
	if (!defined('_SEARCH_TITLE'))	define('_SEARCH_TITLE',	JTEXT::_('SEARCH'));
	if (!defined('_CMN_PRINT'))		define('_CMN_PRINT',	JTEXT::_('PRINT'));
}
?>