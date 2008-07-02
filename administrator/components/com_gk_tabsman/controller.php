<?php
/*
 */

class TabsController{

	/**
		Metoda klasy wyœwietlaj¹ca wszystkie grupy komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
		
		Do pracy wymaga klasy TabsView.
	**/

	function viewTabsGroups(){
		// zmienne globalne
		global $mainframe, $option;

		// inicjalizacja zmiennej bazy danych oraz infomracji o u¿ytkowniku
		$db		=& JFactory::getDBO();
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		
		// wykonanie zapytania mysql
		//$query = 'SELECT * FROM #__gk_tabsman_groups;';
		
		$query = 'SELECT g.id, g.name, g.desc, g.module, COUNT( DISTINCT t.id ) AS tamount FROM #__gk_tabsman_groups AS g LEFT JOIN #__gk_tabsman_tabs AS t ON t.group_id = g.id GROUP BY g.id;';
		$db->setQuery($query);
		// zapisanie wyników zapytania w zmiennej $rows
		$rows = $db->loadObjectList();
		
		// do³¹czenie klasy TabsView
		require_once (JPATH_COMPONENT.DS.'admin.gk_tabsman.html.php');
		// wywo³anie funkcji klasy TabsView z przekazaniem jej danych z zapytania oraz parametru option i danych o u¿ytkowniku
		TabsView::showTabsGroups($rows, $option, $client);
	}
	
	/**
		Metoda klasy wyœwietlaj¹ca dan¹ grupê komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
		
		Do pracy wymaga klasy TabsView.
	**/
	
	function viewTabsGroup(){
		global $mainframe, $option;

		// inicjalizacja zmiennej bazy danych oraz infomracji o u¿ytkowniku
		$db		=& JFactory::getDBO();
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		// odczytanie ID wybranej z listy grupy
		if(isset($_GET['cids'])){
			$cid = array(htmlspecialchars($_GET['cids']));
		}else {
			$cid    = JRequest::getVar( 'cid', array(0), '', 'array' );
		}
		
		// wykonanie zapytania mysql
		$query = 'SELECT * FROM #__gk_tabsman_tabs WHERE group_id = '.$cid[0].' ORDER BY `order`;';
		$db->setQuery($query);
		// przechowanie wyników zapytania w zmiennej $rows
		$rows = $db->loadObjectList();
		
		$query = 'SELECT * FROM #__gk_tabsman_groups WHERE id = '.$cid[0].' LIMIT 1;';
		$db->setQuery($query);
		foreach($db->loadObjectList() as $n) $module = $n->module;
		// do³¹czenie pliku klasy TabsView
		require_once (JPATH_COMPONENT.DS.'admin.gk_tabsman.html.php');
		// wywo³anie funkcji klasy TabsView z przekazaniem jej danych z zapytania oraz parametru option i danych o u¿ytkowniku
		TabsView::showTabsGroup($rows, $module, $cid[0], $option, $client);
	}
	
	/**
		Metoda klasy wyœwietlaj¹ca formularz dodawania grupy komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
		
		Do pracy wymaga klasy TabsView.
	**/
	
	function addTabsGroup(){
		global $mainframe, $option;
		// pobranie informacji o u¿ytkowniku
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		// do³¹czenie plików klasy TabsView
		require_once (JPATH_COMPONENT.DS.'admin.gk_tabsman.html.php');
		// wywo³anie funkcji klasy TabsView z przekazaniem parametru option i informacji o u¿ytkowniku
		TabsView::showAddTabsGroup($option, $client);
	}
	
	/**
		Metoda klasy wyœwietlaj¹ca formularz edytowania grupy komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
		
		Do pracy wymaga klasy TabsView.
	**/
	
	function editTabsGroup(){
		global $mainframe;
		
		// inicjalizacja podstawowych zmiennych
		$option	= JRequest::getCmd('option');
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		$db		=& JFactory::getDBO();
		
		// pobranie ID grupy do edycji
		$cid    = JRequest::getVar( 'cid', array(0), '', 'array' );
		
		// przygotowanie zapytania MySQL
		$query = 'SELECT * FROM #__gk_tabsman_groups WHERE id = '.$cid[0].';';
		
		// wykonanie zapytania MySQL
		$db->setQuery($query);
		
		// przetworzenie wyników zapytania
		foreach($db->loadObjectList() as $row){
			$GID = $row->id;
			$Gname = $row->name;
			$Gdesc = $row->desc;
			$Gmodule = $row->module;
		}
		
		// do³¹czenie plików klasy TabsView
		require_once (JPATH_COMPONENT.DS.'admin.gk_tabsman.html.php');
		// wywo³anie funkcji klasy TabsView z przekazaniem parametrów grupy oraz parametru option i informacji o u¿ytkowniku
		TabsView::showEditTabsGroup($GID, $Gname, $Gdesc, $Gmodule, $option, $client);
	}
	
	/**
		Metoda klasy usuwajaca dan¹ grupê komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
	**/
	
	function removeTabsGroup(){
		global $mainframe;
		
		// inicjalizacja podstawowych zmiennych
		$option	= JRequest::getCmd('option');
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		$db		=& JFactory::getDBO();
		
		// pobranie ID grupy do usuniecia
		$cid    = JRequest::getVar( 'cid', array(0), '', 'array' );
		
		// przygotowanie zapytania MySQL
		$query = 'DELETE FROM #__gk_tabsman_groups WHERE id = '.$cid[0].';';
		
		// wykonanie zapytania MySQL
		$db->setQuery($query);
		$db->query();
		
		// Wykonanie przekierowania wraz z wyœwietleniem odpowiedniego komunikatu.
		$mainframe->redirect('index.php?option='.$option.'&client='.$client->id, JText::_('Group has been removed...'));
	}
	
	/**
		Metoda klasy zapisuj¹ca grupy komponentu po dodaniu lub edycji
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
	**/	
	
	function saveTabsGroup(){
		global $mainframe;
		
		// inicjalizacja zmiennych potrzebnych do pracy
		$db		=& JFactory::getDBO();
		$option	= JRequest::getCmd('option');
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		$task = JRequest::getCmd('task');

		// je¿eli grupa jest edytowana
		if($task == "apply_group"){
			// pobranie zmiennych z formularza
			$name = htmlspecialchars(JRequest::getString( 'name', '', 'post' ));
			$desc = htmlspecialchars(JRequest::getString( 'desc', '', 'post' ));
			$module = htmlspecialchars(JRequest::getString( 'module', '', 'post' ));
			$id = htmlspecialchars(JRequest::getVar( 'id', 0, '', 'int' ));
			// przygotowanie zapytania
			$query_name = 'UPDATE #__gk_tabsman_groups SET `name` = "'.$name.'", `desc` = "'.$desc.'", `module` = "'.$module.'" WHERE id = '.$id.';';
		}
		
		// je¿eli grupa jest dodawania
		if($task == "save_group"){
			// pobranie zmiennych
			$name = htmlspecialchars(JRequest::getString( 'name', '', 'post' ));
			$desc = htmlspecialchars(JRequest::getString( 'desc', '', 'post' ));
			$module = htmlspecialchars(JRequest::getString( 'module', '', 'post' ));
			// przygotowanie zapytania
			$query_name = 'INSERT INTO #__gk_tabsman_groups (`id`, `name`, `desc`, `module`) VALUES(DEFAULT, "'.$name.'", "'.$desc.'", "'.$module.'")';
		}
		
		// przygodowanie i wykonanie zapytania
		$db->setQuery($query_name);
		$db->query();
		
		// przekierowanie w zale¿noœci od zadania - zmiana typu komunikatu
		if($task == "apply_group"){
			$mainframe->redirect('index.php?option='.$option.'&client='.$client->id, JText::_('Group has been edited...'));
		}
		else{
			$mainframe->redirect('index.php?option='.$option.'&client='.$client->id, JText::_('Group has been added...'));
		}
	}
	
	/**
		Metoda klasy wyœwietlaj¹ca formularz dodawania taba do grupy komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
		
		Do pracy wymaga klasy TabsView.
	**/
	
	function addTab(){
		global $mainframe, $option;
		// pobranie informacji o u¿ytkowniku
		$db		=& JFactory::getDBO();
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		$gid = htmlspecialchars(JRequest::getVar( 'gid', '', '', 'int' ));
		$query = 'SELECT * FROM #__gk_tabsman_groups WHERE id = '.$gid.';';
		$db->setQuery($query);
		
		// przechowanie wyników zapytania w zmiennej $rows
		foreach($db->loadObjectList() as $row){
			$rowid = $row->id;
			$rowmod = $row->module;
		}
		
		// do³¹czenie plików klasy TabsView
		require_once (JPATH_COMPONENT.DS.'admin.gk_tabsman.html.php');
		// wywo³anie funkcji klasy TabsView z przekazaniem parametru option i informacji o u¿ytkowniku
		TabsView::showAddTab($rowid, $rowmod, $option, $client);
	}

	/**
		Metoda klasy wyœwietlaj¹ca formularz edytowania taba grupy komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
		
		Do pracy wymaga klasy TabsView.
	**/
	
	function editTab(){
		global $mainframe, $option;
		// pobranie informacji o u¿ytkowniku
		$db		=& JFactory::getDBO();
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		$gid = htmlspecialchars(JRequest::getVar( 'gid', '', '', 'int' ));
		$query = 'SELECT * FROM #__gk_tabsman_groups WHERE id = '.$gid.';';
		$db->setQuery($query);
		
		// przechowanie wyników zapytania w zmiennej $rows
		foreach($db->loadObjectList() as $row){
			$rowid = $row->id;
			$rowmod = $row->module;
		}
		
		// pobranie ID taba do usuniecia
		$cid    = JRequest::getVar( 'cid', array(0), '', 'array' );
		
		// do³¹czenie plików klasy TabsView
		require_once (JPATH_COMPONENT.DS.'admin.gk_tabsman.html.php');
		// wywo³anie funkcji klasy TabsView z przekazaniem parametru option i informacji o u¿ytkowniku
		TabsView::showEditTab($rowid, $rowmod, $cid[0], $option, $client);
	}
	
	/**
		Metoda klasy usuwajaca dany tab z grupy komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
	**/	
	
	function removeTab(){
		global $mainframe;
		
		// inicjalizacja podstawowych zmiennych
		$option	= JRequest::getCmd('option');
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		$db		=& JFactory::getDBO();
		// pobranie ID grupy taba
		$gid = htmlspecialchars(JRequest::getVar( 'gid', '', '', 'int' ));
		// pobranie ID taba do usuniecia
		$cid    = JRequest::getVar( 'cid', array(0), '', 'array' );
		
		// przygotowanie zapytania MySQL
		$query = 'DELETE FROM #__gk_tabsman_tabs WHERE id = '.$cid[0].';';
		
		// wykonanie zapytania MySQL
		$db->setQuery($query);
		$db->query();
		
		// Wykonanie przekierowania wraz z wyœwietleniem odpowiedniego komunikatu.
		$mainframe->redirect('index.php?option='.$option.'&client='.$client->id.'&task=view_group&cids='.$gid, JText::_('Tab has been removed...'));
	}
	
	
	
	
	
	
	
	function saveTab(){
		global $mainframe;
		
		// inicjalizacja zmiennych potrzebnych do pracy
		$db		=& JFactory::getDBO();
		$option	= JRequest::getCmd('option');
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		$task = JRequest::getCmd('task');

		// je¿eli grupa jest edytowana
		if($task == "apply_tab"){
			// pobranie zmiennych z formularza
			$name = htmlspecialchars(JRequest::getString( 'name', '', 'post' ));
			$con = htmlspecialchars(JRequest::getString( 'content', '', 'post' ));
			$gid = htmlspecialchars(JRequest::getString( 'gid', '', 'post' ));
			$id = htmlspecialchars(JRequest::getString( 'id', '', 'post' ));
			// przygotowanie zapytania
			$query = 'UPDATE #__gk_tabsman_tabs SET `name` = "'.$name.'", `content` = "'.$con.'" WHERE id = '.$id.';';
		}
		
		// je¿eli grupa jest dodawania
		if($task == "save_tab"){
			// pobranie zmiennych
			$name = htmlspecialchars(JRequest::getString( 'name', '', 'post' ));
			$con = htmlspecialchars(JRequest::getString( 'content', '', 'post' ));
			$gid = htmlspecialchars(JRequest::getString( 'id', '', 'post' ));
			
			$q = 'SELECT * FROM #__gk_tabsman_tabs WHERE group_id = '.$gid.' ORDER BY `order` DESC LIMIT 1;';
			$db->setQuery($q);
			// przechowanie wyników zapytania w zmiennej $rows
			foreach($db->loadObjectList() as $r){
				$max_order = $r->order;
			}
			// przygotowanie zapytania
			$query= 'INSERT INTO #__gk_tabsman_tabs (`id`, `group_id`,`name`, `content`, `order`) VALUES(DEFAULT, "'.$gid.'", "'.$name.'", "'.$con.'", '.($max_order+1).')';
		}
		
		// przygodowanie i wykonanie zapytania
		$db->setQuery($query);
		$db->query();
		
		// przekierowanie w zale¿noœci od zadania - zmiana typu komunikatu
		if($task == "apply_tab"){
			$mainframe->redirect('index.php?option='.$option.'&client='.$client->id.'&task=view_group&cids='.$gid, JText::_('Tab has been edited...'));
		}
		else{
			$mainframe->redirect('index.php?option='.$option.'&client='.$client->id.'&task=view_group&cids='.$gid, JText::_('Tab has been added...'));
		}
	}
	
	/**
		Metoda klasy ustawiajaca kolejnoœæ tabów w grupie komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
	**/		
	
	function savePositions(){
		global $mainframe, $option;
		
		$db			= & JFactory::getDBO();
		$order		= JRequest::getVar( 'order', array (0), '', 'array' );
		$gid = htmlspecialchars(JRequest::getString( 'gid', '', 'post' ));
		
		JArrayHelper::toInteger($order, array(0));
		
		$query = 'SELECT * FROM #__gk_tabsman_tabs WHERE group_id = '.$gid.' ORDER BY `order` ASC;';
		$db->setQuery($query);
		
		$rowTab = array();
		// przechowanie wyników zapytania w zmiennej $rows
		foreach($db->loadObjectList() as $row){
			$rowTab[] = array(
				"roder" => $row->order, 
				"rid" => $row->id
			);
		}
		
		for($j = 0; $j < count($rowTab); $j++){
			if($order[$j] != $rowTab[$j]["rorder"]){
				$query = 'UPDATE #__gk_tabsman_tabs SET `order` = '.$order[$j].' WHERE id = '.$rowTab[$j]["rid"].';';
				$db->setQuery($query);
				$db->query();
			}
		}
		
		$mainframe->redirect('index.php?option='.$option.'&client='.$client->id.'&task=view_group&cids='.$gid, JText::_('Tab order has been saved...'));
	}
	
	/**
		Metoda klasy wyœwietlaj¹ca pomoc i informacje komponentu
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
		
		Do pracy wymaga klasy TabsView.
	**/	
	
	function viewHelp(){
		global $mainframe;

		// tradycyjna inicjalizacja zmiennych ;)
		$option	= JRequest::getCmd('option');
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		
		// do³¹czenie plików klasy TabsView
		require_once (JPATH_COMPONENT.DS.'admin.gk_tabsman.html.php');
		// wywo³anie funkcji klasy TabsView z przekazaniem parametru option i informacji o u¿ytkowniku
		TabsView::showHelp($option, $client);
	}

	/**
		Metoda klasy anuluj¹ca ostatnio wykonywan¹ operacjê
		nie pobiera ¿adnych zmiennych, lecz korzysta ze zmiennych globalnych.
	**/	
	
	function cancelTabs(){
		global $mainframe;

		// tradycyjna inicjalizacja zmiennych ;)
		$option	= JRequest::getCmd('option');
		$client	=& JApplicationHelper::getClientInfo(JRequest::getVar('client', '0', '', 'int'));
		$cid = htmlspecialchars(JRequest::getString( 'id', '', 'post' ));
		
		// przechwycenie danych FTP (czy coœ takiego)
		jimport('joomla.client.helper');
		JClientHelper::setCredentialsFromRequest('ftp');
		
		// wykonanie przekierowania wraz ze stosownym komunikatem typu notice
		if($cid != ''){
			$mainframe->redirect('index.php?option='.$option.'&client='.$client->id.'&task=view_group&cids='.$cid, JText::_('Previous action has been canceled...'), 'notice');
		}else{
			$mainframe->redirect('index.php?option='.$option.'&client='.$client->id, JText::_('Previous action has been canceled...'), 'notice');
		}
	}
}