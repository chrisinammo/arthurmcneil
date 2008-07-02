<?php

/*
 * Helper class for Gavick TabMods module
*
* Gavick TabMods
* @package Joomla!
* @Copyright (C) 2008 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ version $Revision: 2.0 $
*/

class TabModsHelper{
	
	var $moduleWidth, $moduleHeight, $tabsGroupID, $tabsScroll, $activator, $animation, $animationType, $animationSpeed, $buttons, $styleCSS, $styleFile, $useMoo, $useScript, $tabsTitles, $tabsModules, $style, $hstyle, $styleCSSfile, $modGetter, $animationFun, $module_id, $animationInterval, $styleType;
	
	function init(&$params){
		$this->moduleWidth = $params->get('moduleWidth', 0);
		$this->moduleHeight = $params->get('moduleHeight', 0);
		$this->tabsGroupID = $params->get('tabsGroupID', 0);
		$this->styleCSS =  $params->get('styleCSS', 'style1');
		$this->styleFile = $params->get('styleFile', '');
		
		$this->tabsTitles = array();
		$this->tabsModules = array();

		$db	=& JFactory::getDBO();
		// przygotowanie zapytania MySQL
		$query = 'SELECT * FROM #__gk_tabsman_tabs WHERE group_id = '.$this->tabsGroupID.' ORDER BY `order` ASC;';
		// wykonanie zapytania MySQL
		$db->setQuery($query);
		// przetworzenie wyników zapytania
		$rows = $db->loadObjectList();
		
		foreach($rows as $row){
			$this->tabsTitles[] = $row->name;
			$this->tabsModules[] = $row->content;
		}
		
		if(strpos($this->moduleHeight,'px') === false) $this->moduleHeight = 0;
		if(strpos($this->moduleWidth,'px') === false && strpos($this->moduleWidth,'%') === false ) $this->moduleWidth = 0;

		if($this->moduleHeight == 0){
			$this->style = ($this->moduleWidth == 0) ? '' : 'width: '.$this->moduleWidth.';';
			$this->hstyle = ($this->moduleWidth == 0) ? '' : 'width: '.$this->moduleWidth.';';
		}
		else{
			$this->style = ($this->moduleWidth == 0) ? 'height: '.$this->moduleHeight.';' : 'height: '.$this->moduleHeight.';width: '.$this->moduleWidth.';';
			$this->hstyle = ($this->moduleWidth == 0) ? '' : 'width: '.$this->moduleWidth.';';
		}
		
		$this->styleCSSfile = ($this->styleCSS == "own") ? $this->styleFile : $this->styleCSS;
	}
	
	function render(&$params){
		$this->activator = $params->get('activator','click');
		$this->animation = $params->get('animation',0);
		$this->animationSpeed = $params->get('animationSpeed', 1000);
		$this->animationInterval = $params->get('animationInterval', 5000);
		$this->useMoo = $params->get('useMoo',1);
		$this->useScript = $params->get('useScript',1);
		$this->animationType = $params->get('animationType', 1);
		$this->buttons = $params->get('buttons', 1);
		$this->styleCSS = $params->get('styleCSS', 'style');
		$this->animationFun = $params->get('animationFun', 33);
		$this->module_id = $params->get('module_id', '-mod');
		$this->styleType = $params->get('styleType', 0);
		
		require(JModuleHelper::getLayoutPath('mod_tabmods','default'));
	}
	
	function moduleRender(){
		for($i = 0;$i<count($this->tabsModules);$i++){
			$this->modGetter = &JModuleHelper::getModules($this->tabsModules[$i]);
			require(JModuleHelper::getLayoutPath('mod_tabmods','module'));
		}
	}
}

?>