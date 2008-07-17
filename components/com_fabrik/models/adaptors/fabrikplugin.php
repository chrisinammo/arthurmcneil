<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * fabrik plugin installer adaptor 
 */
class JInstallerFabrikPlugin extends JObject{
	
	/**
	 * Constructor
	 *
	 * @access	protected
	 * @param	object	$parent	Parent object [JInstaller instance]
	 * @return	void
	 * @since	1.5
	 */
	function __construct(&$parent)
	{
		$this->parent =& $parent;
	}
	
	function install(){
		// Get a database connector object
		$db =& $this->parent->getDBO();
		// Get the extension manifest object
		$manifest =& $this->parent->getManifest();
		$this->manifest =& $manifest->document;

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Manifest Document Setup Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Set the component name
		$name =& $this->manifest->getElementByPath('name');
		
		$this->set('name', $name->data());

		// Get the component description
		$description = & $this->manifest->getElementByPath('description');
		if (is_a($description, 'JSimpleXMLElement')) {
			$this->parent->set('message', $this->get('name').'<p>'.$description->data().'</p>');
		} else {
			$this->parent->set('message', $this->get('name'));
		}

		/*
		 * Backward Compatability
		 * @todo Deprecate in future version
		 */
		$type = $this->manifest->attributes('type');
		// Set the installation path
		$element =& $this->manifest->getElementByPath('files');
		if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
			$files =& $element->children();
			foreach ($files as $file) {
				if ($file->attributes($type)) {
					$pname = $file->attributes($type);
					break;
				}
			}
		}
		$group = $this->manifest->attributes('group');
		
		$path = JPATH_ROOT.DS.'components'.DS.'com_fabrik'.DS.'plugins'.DS.$group.DS.$this->get('name');
		if (!empty ($pname) && !empty($group)) {
			$this->parent->setPath('extension_root', $path);
		} else {
			$this->parent->abort('Plugin Install: '.JText::_('No plugin file specified'));
			return false;
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Filesystem Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// If the plugin directory does not exist, lets create it

		$created = false;
		if (!file_exists($this->parent->getPath('extension_root'))) {
			if (!$created = JFolder::create($this->parent->getPath('extension_root'))) {
				$this->parent->abort('Plugin Install: '.JText::_('Failed to create directory').': "'.$this->parent->getPath('extension_root').'"');
				return false;
			}
		}

		/*
		 * If we created the plugin directory and will want to remove it if we
		 * have to roll back the installation, lets add it to the installation
		 * step stack
		 */
		if ($created) {
			$this->parent->pushStep(array ('type' => 'folder', 'path' => $this->parent->getPath('extension_root')));
		}
		

		// Copy all necessary files
		if ($this->parent->parseFiles($element, -1) === false) {
			// Install failed, roll back changes
			$this->parent->abort();
			return false;
		}
		// Parse optional tags -- media and language files for plugins go in admin app
		$this->parent->parseMedia($this->manifest->getElementByPath('media'), 1);
		$this->parent->parseLanguages($this->manifest->getElementByPath('languages'), 1);
		/**
		 * ---------------------------------------------------------------------------------------------
		 * Database Processing Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Check to see if a plugin by the same name is already installed
		$query = 'SELECT `id`' .
				' FROM `#__fabrik_plugins`' .
				' WHERE type = '.$db->Quote($group) .
				' AND name = '.$db->Quote($pname);
		$db->setQuery($query);

		if (!$db->Query()) {
			// Install failed, roll back changes
			$this->parent->abort('Plugin Install: '.$db->stderr(true));
			return false;
		}
		$id = $db->loadResult();

		// Was there a module already installed with the same name?
		if ($id) {
			// Install failed, roll back changes
			$this->parent->abort('Plugin Install: '.JText::_('Plugin').' "'.$pname.'" '.JText::_('already exists!'));
			return false;
		} else {
			$row = new fabrikPlugin( $db );
			$row->name = $pname;
			$row->type = $group;
			$row->label = $this->get('name');
			
			$row->state = 1;
			$row->iscore = 0;


			if (!$row->store()) {
				// Install failed, roll back changes
				$this->parent->abort('Plugin Install: '.$db->stderr(true));
				return false;
			}

			// Since we have created a plugin item, we add it to the installation step stack
			// so that if we have to rollback the changes we can undo it.
			$this->parent->pushStep(array ('type' => 'plugin', 'id' => $row->id));
		}

		/**
		 * ---------------------------------------------------------------------------------------------
		 * Finalization and Cleanup Section
		 * ---------------------------------------------------------------------------------------------
		 */

		// Lastly, we will copy the manifest file to its appropriate place.
		if (!$this->parent->copyManifest(-1)) {
			// Install failed, rollback changes
			$this->parent->abort('Plugin Install: '.JText::_('Could not copy setup file'));
			return false;
		}
		return true;
	}
	
	function uninstall(){
		
	}	
	
}
?>