<?php
/**
 * @package		Joomla
 * @subpackage	Fabik
 * @copyright	Copyright (C) 2005 - 2008 Pollen 8 Design Ltd. All rights reserved.
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die();

jimport( 'joomla.plugin.plugin' );

/**
 * Fabrik content plugin - renders forms and tables
 *
 * @package		Joomla
 * @subpackage	Content
 * @since 		1.5
 */
class plgContentFabrik extends JPlugin
{

	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param object $subject The object to observe
	 * @param object $params  The object that holds the plugin parameters
	 * @since 1.5
	 */
	function plgContentFabrik( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}

	/**
	 * Example prepare content method
	 *
	 * Method is called by the view
	 *
	 * @param 	object		The article object.  Note $article->text is also available
	 * @param 	object		The article params
	 * @param 	int			The 'page' number
	 */
	
	function onPrepareContent( &$article, &$params, $limitstart )
	{
		// Get plugin info
		$plugin =& JPluginHelper::getPlugin('content', 'fabrik');
		$params = new JParameter( $plugin->params );
		
		// simple performance check to determine whether bot should process further
		$botRegex = ($params->get( 'Botregex' ) != '') ? $params->get( 'Botregex' ) : 'fabrik';
		
		if (JString::strpos( $article->text, $botRegex) === false) {
			return true;
		}
		$regex = "/{" .$botRegex ."\s*.*?}/i";	
		$article->text = preg_replace_callback($regex, array($this, 'replaceWithFabrikForm'), $article->text);
	}

	function replaceWithFabrikForm( $match )
	{
		$match = $match[0];
		$match = trim($match, "{");
		$match = trim($match, "}");
		$match = explode(" ", $match);
		array_shift($match);
		$user = JFactory::getUser();
		$usersConfig 	=& JComponentHelper::getParams( 'com_fabrik' );
		foreach ($match as $m) {
			$m = explode("=", $m);
			switch ($m[0])
			{
				case 'view':
					$viewName = $m[1];
					break;
				case 'id':
					$id = $m[1];
					break;
				case 'layout':
					$layout = $m[1];
					break;
				case 'row':
					$row = $m[1];
					if ($row == -1) {
						$row = $user->get('id');
					}
					$usersConfig->set('rowid', $row);
					break;
			}
		}
		if (!isset( $viewName )) {
			return;
		}
		$this->generalIncludes( $viewName );
		
		$document =& JFactory::getDocument();
		$viewType	= $document->getType();
		$controller = new FabrikController();
		
		// Set the default view name from the Request
		$view = &$controller->getView( $viewName, $viewType );
		
		// Push a model into the view
		$model	= &$controller->getModel( $viewName );
		
		if ($viewName == 'form') {
			$model->_postMethod = 'ajax';
		}
		
		if (!JError::isError( $model )) {
			$model->setAdmin( false );
			$view->setModel( $model, true );
		}
		
		// Display the view
		$view->assign( 'error', $controller->getError() );
		$view->setId( $id );
		$view->_isMambot = true;
		return $view->display();
	}
	
	/**
	 * load the required fabrik files
	 *
	 * @param string $view
	 */
	
	function generalIncludes( $view )
	{
		if (!defined('COM_FABRIK_BASE') ) 
		{
			define( "COM_FABRIK_BASE",  JPATH_BASE );
			define( "COM_FABRIK_FRONTEND",  JPATH_BASE.DS.'components'.DS.'com_fabrik' );
			define( "COM_FABRIK_LIVESITE",  JURI::base() );
		}
		require_once('components/com_fabrik/controller.php');
		require_once('components/com_fabrik/models/parent.php');
		JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_fabrik'.DS.'tables' );
		JModel::addIncludePath( COM_FABRIK_BASE.DS.'components'.DS.'com_fabrik'.DS.'models' );
		require_once('components/com_fabrik/views/'.$view.'/view.html.php');
	}

}