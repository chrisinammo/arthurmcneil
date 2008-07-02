<?php

/*
 * Helper class for Gavick TabArts module
*
* Gavick TabMods
* @package Joomla!
* @Copyright (C) 2008 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ version $Revision: 1.0 $
*/

class TabArtsHelper{
	
	var $moduleWidth, $moduleHeight, $tabsGroupID, $tabsScroll, $activator, $animation, $animationType, $animationSpeed, $buttons, $styleCSS, $styleFile, $useMoo, $useScript, $tabsTitles, $tabsArts, $style, $styleCSSfile, $modGetter, $animationFun, $module_id, $animationInterval, $showTitle, $textLimit, $textLimitValue, $styleType, $hstyle;
	
	function init(&$params){
		$this->moduleWidth = $params->get('moduleWidth', 0);
		$this->moduleHeight = $params->get('moduleHeight', 0);
		$this->tabsGroupID = $params->get('tabsGroupID', 0);
		$this->styleCSS =  $params->get('styleCSS', 'style1');
		$this->styleFile = $params->get('styleFile', '');
		$this->showTitle = $params->get('showTitle', '');
		$this->textLimit = $params->get('textLimit', 0);
		$this->textLimitValue = $params->get('textLimitValue', 200);
		
		$this->tabsTitles = array();
		$this->tabsArts = array();

		$db	=& JFactory::getDBO();
		// przygotowanie zapytania MySQL
		$query = 'SELECT * FROM #__gk_tabsman_tabs WHERE group_id = '.$this->tabsGroupID.' ORDER BY `order` ASC;';
		// wykonanie zapytania MySQL
		$db->setQuery($query);
		// przetworzenie wyników zapytania
		$rows = $db->loadObjectList();
		
		foreach($rows as $row){
			$this->tabsTitles[] = $row->name;
			$this->tabsArts[] = $row->content;
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
		
		require(JModuleHelper::getLayoutPath('mod_tabarts','default'));
	}
	
	function articleRender(){
		$db	=& JFactory::getDBO();
		// przygotowanie zapytania MySQL
		$where = '';
		for($i = 1; $i < count($this->tabsArts); $i++) $where .= 'OR (id = '.$this->tabsArts[$i].')';
		$query = 'SELECT id, title, introtext FROM #__content WHERE ( (id = '.$this->tabsArts[0].') '.$where.' );';
		// wykonanie zapytania MySQL
		$db->setQuery($query);
		// przetworzenie wyników zapytania
		$artsTitles = array();
		$artsContent = array();
		
		foreach($db->loadObjectList() as $row){
			$artsTitles[$row->id] = $row->title;
			$artsContent[$row->id] = $row->introtext;
		}
		
		for($i = 0;$i < count($this->tabsArts);$i++){
			($this->showTitle == 1) ? $title = '<h4>'.$artsTitles[$this->tabsArts[$i]].'</h4>' : $title = '';
			
			($this->textLimit == 0) ? $content = $artsContent[$this->tabsArts[$i]] : $content = (substr(strip_tags($artsContent[$this->tabsArts[$i]]), 0, $this->textLimitValue)).'...';
			
			require(JModuleHelper::getLayoutPath('mod_tabarts','module'));
		}
	}
}

?>