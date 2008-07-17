<?php
/**
 * @package Joomla
 * @subpackage Fabrik
 * @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class fabrikViewForm extends JView
{

	var $_template 	= null;
	var $_errors 	= null;
	var $_data 		= null;
	var $_rowId 	= null;
	var $_params 	= null;
	var $_isMambot = null;

	var $_id 			= null;

	function copy()
	{
		$serialized_contents = serialize( $this );
		return unserialize( $serialized_contents );
	}

	function setId($id)
	{
		$this->_id = $id;
	}

	function getGroupProperties( &$groupModel )
	{
		$group 				= new stdClass();
		$model				=& $this->getModel();
		$groupTable 	=& $groupModel->getGroup();
		$groupParams 	=& $groupModel->getParams();
		$group->canRepeat = ($model->_editable) ? $groupParams->get( 'repeat_group_button', '0' ) : 0;

		$addJs 				= str_replace( '"', "'",  $groupParams->get( 'repeat_group_js_add' ) );
		$group->addJs = str_replace( array("\n", "\r"), "",  $addJs );
		$delJs 				= str_replace('"', "'",  $groupParams->get( 'repeat_group_js_delete' ) );
		$group->delJs = str_replace( array("\n", "\r"), "",  $delJs );
		$showGroup 		= $groupParams->def( 'repeat_group_show_first', '1' );
		
		$pages =& $model->getPages();
		$startpage = isset($model->sessionModel->last_page) ? $model->sessionModel->last_page: 0;
		if (!in_array($groupTable->id, $pages[$startpage]) || $showGroup == 0) {
			$groupTable->css .= ";display:none;";
		}
		$rubbish 				= array ("<br />", "<br>");
		$group->css 		= trim( str_replace( $rubbish, "", $groupTable->css ) );
		$group->id 			= $groupTable->id;
		$group->title 	= $groupTable->label;
		$group->name		= $groupTable->name;
		if ( $group->canRepeat == 1 && $model->_editable ) {
			$group->delId =   "delGroup_" . $groupTable->id ;
			$group->addId = "addGroup_" . $groupTable->id;
			$group->displaystate = '1';
		} else {
			$group->delId = '';
			$group->addId = '';
			$group->displaystate = '0';
		}
		return $group;
	}
	
	/**
	 * query all active form plugins to see if they inject cutsom html into the top
	 * or bottom of the formr
	 *
	 * @param object $model
	 */
	
	function _getFormPluginHTML( &$model )
	{
		$pluginManager =& JModel::getInstance( 'Pluginmanager', 'FabrikModel' );
		$formPlugins =& $pluginManager->getPlugInGroup( 'form' );
		$form =& $model->getForm();
		$top = array();
		$bottom = array();
		foreach ($formPlugins as $plugin) {
			$plugin->attribs = $form->attribs; 
			$top[] 		= $plugin->getTopContent();
			$bottom[] = $plugin->getBottomContent();
		}
		$this->plugintop 		= implode( "<br />", $top );
		$this->pluginbottom = implode( "<br />", $bottom );
	}

	/**
	 * main setup routine for displaying the form/detail view
	 * @param string template
	 */

	function display( $tpl = null )
	{
		global $mainframe, $_SESSION;
		$w = new FabrikWorker();
		$config		=& JFactory::getConfig();
		$model		=& $this->getModel();
		$document =& JFactory::getDocument();
		//Get the active menu item
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );

		if (!isset( $this->_id )) {
			$model->setId( $usersConfig->get( 'fabrik', JRequest::getInt( 'fabrik' ) ) );
		} else {
			//when in a package the id is set from the package view
			$model->setId( $this->_id );
		}
		$form 	=& $model->getForm();

		$model->render();
		$this->isMultiPage = $model->isMultiPage();
		$this->_getFormPluginHTML($model);
		$tableModel =& $model->_table;
		$table = is_object( $tableModel ) ? $tableModel->getTable() : null;
		if (!$model->canPublish( )) {
			if (!$model->_admin) {
				echo JText::_( 'Sorry this form is not published' );
				return false;
			}
		}

		if ($model->_isModule) {
			if (!defined( '_FABRIK_SESSIONSTART' )) {
				define( '_FABRIK_SESSIONSTART', '1' );
				session_start();
			}
			if (array_key_exists( 'fabrik', $_SESSION ) && array_key_exists( 'moduleErrors', $_SESSION['fabrik'] )) {
				$this->_arErrors = $_SESSION['fabrik']['moduleErrors'];
				unset( $_SESSION['fabrik']['moduleErrors'] );
			}
		}

		$access = $model->checkAccessFromTableSettings( );
		if ($access == 0) {
			return JError::raiseWarning( 500, JText::_( 'ALERTNOTAUTH' ) );
		}
		$model->_editable = ($access == 1 && $model->_editable == '1') ? false : true;
		if (is_object( $tableModel )) {
			$joins = $tableModel->getJoins( );
			$model->getJoinGroupIds( $joins );
		}
		if (!$this->_isMambot) {
			$title = $model->getPageTitle( );
			$document->setTitle( $w->parseMessageForPlaceHolder( $title, $_REQUEST ) );
		}
		$params =& $model->getParams();
		$params->def( 'icons', $mainframe->getCfg( 'icons' ) );
		$pop =  (JRequest::getVar('tmpl') == 'component') ? 1 : 0;
		$params->set( 'popup', $pop );

		$view = JRequest::getVar( 'view', 'form' );
		if ($view == 'details') {
			$model->_editable = false;
		}

		if ($model->_editable) {
			foreach ($model->_data as $key=>$val) {
				if (is_string( $val )) {
					$data[$key] = htmlspecialchars( $val, ENT_QUOTES );
				}
			}
		}

		$model->addCustomFiles( );

		if (stristr( "{Add/Edit}", $form->label )) {
			$replace = ($model->_rowId == '') ? JText::_('Add') : JText::_('Edit');
			$form->label = str_replace( "{Add/Edit}", $replace, $form->label );
		}

		$namedData = array();
		$this->form 			= $form;

		if ($model->_admin) {
			$model->_rootPath = JURI::base() ."/administrator/index.php";
			$this->form->action = JURI::base()  . "/index.php";
			$this->form->formid = "adminForm";
			$this->form->name 	= "adminForm";
		} else {
			$model->_rootPath = JURI::base()."/index.php?" ;
			$this->form->action = $model->_rootPath."&amp;option=com_fabrik";
			if ($model->_postMethod == 'ajax') {
				$this->form->action  .= "&format=raw";
			}
			$this->form->formid = "form_".$model->_id;
			$this->form->name 	= "form_".$model->_id;
		}
		$this->form->encType = $model->getFormEncType();;
		$this->form->origerror = $this->form->error;
		$this->form->error  = (count( $model->_arErrors ) > 0) ? $form->error : '';
		$aGroups 			= array();
		$jsActions 			= array();
		$allJsActions = $model->getJsActions();
		$this->_addButtons();

		$model->loadValidationRuleClasses( );
		foreach ($model->_groups as $groupModel) {
			$activeData = $model->_data;
			$groupTable =& $groupModel->getGroup();
			if ($groupTable->state != 0) {
				$group = $this->getGroupProperties( $groupModel );
				$aElements = array();
				//check if group is acutally a table join

				if (array_key_exists( $groupTable->id, $model->_aJoinGroupIds )) {
					$joinId = $model->_aJoinGroupIds[$groupTable->id];
					$element 			= new stdClass();
					//add in row id for join data
					$element->label = '';
					$element->error = '';
					$element->className = '';
					//something wrong with this bit below i think - oform->_table might be incorrect???
					foreach ($tableModel->_aJoins as $oJoin) {
						if ($oJoin->id == $joinId) {
							$key = $oJoin->table_join . $model->_joinTableElementStep . $oJoin->table_join_key;
							if (array_key_exists( 'join', $model->_data )) {
								$val = $this->_data['join'][$joinId][$key];
							} else {
								$val = '';
							}
							$element->element = '<input type="hidden" id="join.' . $joinId . '.rowid" name="join[' . $joinId . '][rowid]" value="' . $val . '" />';
						}
					}
					$aElements[] = $element;
				}
				if ($groupModel->canRepeat() || array_key_exists( $groupTable->id, $model->_aJoinGroupIds )) {
					$repeatGroup = 1;
					$activeData = $model->_data;
					$joinModel = Jmodel::getInstance( 'Join', 'FabrikModel');
					$tableId = (is_object( $table )) ? $table->id : '';
					$joinTable = $joinModel->loadFromGroupId( $groupTable->id, $tableId );
					$foreignKey  = '';
					if (is_object( $joinTable )) {
						$foreignKey = $joinTable->table_join_key;
						//need to duplicate this perhaps per the number of times that a repeat group occurs in the default data?
						if (is_array( $model->_joinDefaultData )) {
							if (array_key_exists( $joinTable->id, $model->_joinDefaultData )) {
								$activeData = $model->_joinDefaultData[$joinTable->id];
								reset( $groupModel->_aElements );
								$tmpElement = current( $groupModel->_aElements );
								$smallerElHTMLName = $tmpElement->getFullName( false, true, false );
								$repeatGroup = count( $activeData[$smallerElHTMLName] );
							} else {

								//guess at how many repeated groups were posted
								$tmpElement = current( $groupModel->_aElements );
								foreach ($groupModel->_aElements as $tmpElement) {
									$smallerElHTMLName = $tmpElement->getFullName( false, true, false );
									if (array_key_exists( $smallerElHTMLName, $activeData )) {
										$c = count($activeData[$smallerElHTMLName]);
										if ( $c > $repeatGroup ) { $repeatGroup = $c;}
									}
								}
							}
						}
					} else {
						//get the number of repeat groups for non join repeat groups when editing a record
						$repeatGroup = 1;
						foreach ($groupModel->_aElements as $tmpElement) {
							$smallerElHTMLName = $tmpElement->getFullName( false, true, false );
							$d = @$model->_data[$smallerElHTMLName];
							if (is_string($d) && strstr( $d, $tmpElement->_groupSplitter )) {
								$d = explode( $tmpElement->_groupSplitter, $d );
							}
							$c = count($d);
							if ( $c > $repeatGroup ) { $repeatGroup = $c;}
						}
					}
				} else {
					$foreignKey = null;
					$activeData = $model->_data;
					$repeatGroup = 1;
				}
				$aSubGroups = array();
				for ($c = 0; $c < $repeatGroup; $c++) {
					$aSubGroupElements = array();
					foreach ($groupModel->_aElements as $elementModel) {
						$elementTable =& $elementModel->getElement();
						$element 			= new stdClass( );

						if ($elementModel->isHidden() && !$model->_editable) {
							continue;
						}
						$elementModel->loadLanguage( );
						$elHTMLName			= $elementModel->getFullName( true, true );
						$elementHTMLId 	= $elementModel->getHTMLId( );
						$jsActions[]		= $elementModel->getFormattedJSActions( $allJsActions );
						//if the element is in a join AND is the join's foreign key then we don't show the element
						
						if ($elementTable->name == $foreignKey) {
							$element->label 	= '';
							$element->error 	= '';
							$elementModel->_element->hidden = true;
						} else {
							$element->label 	= $elementModel->getLabel( );
							$element->error 	= $this->_getErrorMsg( $elHTMLName, $model->_arErrors, $elementTable->plugin, $c );
						}
						$element->hidden = $elementModel->isHidden();
						$element->id		= $elementModel->getHTMLId();
						$element->className = "fb_el_" . $element->id;
						$element->element 	=  $this->_getElement( $elementModel, $activeData, $c );
						$editable = $model->_editable;

						if (!$elementModel->canUse()) {
							$editable = false;
						}

						$element->element_ro = $this->_getROElement( $elementModel, $activeData, $c );
						$aElements[$elementTable->name] = $element;
						$namedData[$elHTMLName] = $element;
						if ($elHTMLName)
							$aSubGroupElements[] = $element;
					}
					//if its a repeatable group put in subgroup
					if ($groupModel->canRepeat()) {
						$aSubGroups[] = $aSubGroupElements;
					}
				}
				$group->elements = $aElements;
				$group->subgroups = $aSubGroups;
				$aGroups[$group->name] = $group;
			}
		}
		$this->groups = $aGroups;
		$this->data = $namedData;
		//add in the javascript element observers
		$actions = trim(implode("\n", $jsActions));
		$this->jsActions = '';

		$model->getFormManagementJS( $actions );
		$this->_addJavascript( $tableModel->_id, $actions );
		$this->_loadTmplBottom( );

		//force front end templates
		$this->_basePath = COM_FABRIK_FRONTEND . DS . 'views' ;

		$t = ($model->_editable)?  $form->form_template : $form->view_only_template;
		$form->form_template = JRequest::getVar( 'layout', $t );
		$tmpl = JRequest::getVar( 'layout', $form->form_template );
		$this->_includeTemplateCSSFile( $tmpl );

		$this->message = @$model->sessionModel->status;

		$this->_setPath( 'template', $this->_basePath.DS.$this->_name.DS.'tmpl'.DS.$tmpl );
		if ($this->_isMambot) {
			return $this->loadTemplate();
		} else {
			parent::display( );
		}
	}

	/**
	 * add buttons to the view e.g. print, pdf
	 */

	function _addButtons()
	{
		$model		=& $this->getModel();
		$params 	=& $model->getParams();
		$this->showEmail = $params->get( 'email', 0 );

		if (JRequest::getVar('tmpl') != 'component') {
			if ($this->showEmail) {
				$this->emailLink = FabrikHelperHTML::emailIcon( $model, $params );
			}

			$this->showPrint = $params->get( 'print', 0 );
			if ($this->showPrint) {
				$this->printLink = FabrikHelperHTML::printIcon( $model, $params, $model->_rowId );
			}

			$this->showPDF = $params->get( 'pdf', 0 );
			if ($this->showPDF) {
				$this->pdfLink = FabrikHelperHTML::pdfIcon( $model, $params, $model->_rowId );
			}
		} else {
			$this->showPDF = $this->showPrint = false;
		}
	}

	/**
	 * get any html errror messages for form element
	 * @param string parsed element name
	 * @param array error messages
	 * @param int group element type
	 * @param int repeat count
	 * @return string error messages
	 */

	function _getErrorMsg( $parsed_name, &$arErrors, $groupeltype, $repeatCount = 0 )
	{
		$err_msg = '';
		
		$parsed_name = rtrim( $parsed_name, "[]" );
		if (isset( $arErrors[$parsed_name] )) {
			if (array_key_exists( $repeatCount, $arErrors[$parsed_name] )) {
				if (is_array( $arErrors[$parsed_name][$repeatCount] )) {
					foreach ($arErrors[$parsed_name][$repeatCount] as $el_err_msg) {
						$err_msg .= "$el_err_msg<br/>";
					}
				} else {
					$err_msg .= $arErrors[$parsed_name][$repeatCount];
				}
			}
		}
		return $err_msg;
	}

	/**
	 * @access private
	 * @param object element model
	 * @param array data
	 * @param int repeat group counter
	 */

	function _getElement( &$elementModel, $data, $repeatCounter = 0 )
	{
		$model =& $this->getModel();
		$editable = $model->_editable;
		if (!$elementModel->canView( ) && !$elementModel->canUse()) {
			return '';
		}
		if (!$elementModel->canUse()) {
			$editable = false;
		}

		$elementModel->_shortHTMLName = $elementModel->getFullName( false, true, false );
		$elementModel->_editable 	= $editable;
		$elementModel->getDefaultValue( $data, true, $repeatCounter );
		$htmlid = $elementModel->getHTMLId( );
		$e = $elementModel->render( $data, $repeatCounter );
		if ($editable) {
			return $e;
		} else {
			if ($model->_postMethod == 'ajax') {
				return "<div id='$htmlid'>" . $this->_getROElement( $elementModel, $data, $repeatCounter ) . "</div>"; //placeholder to be updated by ajax code
			} else {
				return $this->_getROElement( $elementModel, $data, $repeatCounter );
			}
		}
	}

	/**
	 * @access private
	 * @param object element model
	 * @param array data
	 * @param int repeat group counter
	 */

	function _getROElement( &$elementModel, $data, $repeatCounter = 0 )
	{
		if (!$elementModel->canView( ) && !$elementModel->canUse()) {
			return '';
		}
		$elementModel->_editable 	= false;
		return $elementModel->render( $data, $repeatCounter );
	}

	/**
	 * include the template css files
	 *
	 * @param string template name
	 */
	function _includeTemplateCSSFile( $formTemplate )
	{
		$config		=& JFactory::getConfig();
		$document =& JFactory::getDocument();
		$ab_css_file = JPATH_SITE.DS."components".DS."com_fabrik".DS."views".DS."form".DS."tmpl".DS."$formTemplate".DS."template.css";
		$live_css_file = COM_FABRIK_LIVESITE  . "/components/com_fabrik/views/form/tmpl/$formTemplate/template.css";
		if (file_exists( $ab_css_file )) {
			$document->addStyleSheet($live_css_file);
		}
	}

	/**
	 * append the form javascript into the document head
	 * @param int table id
	 * @param string extra js code to add
	 */

	function _addJavascript( $tableId, $actions )
	{
		$model 			=& $this->getModel();
		$aWYSIWYGNames = array();
		foreach ($model->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$res = $elementModel->useEditor();
				if ($res !== false) {
					$aWYSIWYGNames[] = $res;
				}
			}
		}

		$params =& $model->getParams();
		FabrikHelperHTML::packageJS();
		$tableModel =& $model->getTableModel();
		$table 			=& $tableModel->getTable();
		$document 	=& JFactory::getDocument();
		$form				=& $model->getForm();
		FabrikHelperHTML::mocha( );
		FabrikHelperHTML::script( 'package.js', 'components/com_fabrik/views/package/', true );
		JHTML::_('behavior.tooltip');
		$key = str_replace( ".", "___", $table->db_primary_key );
		$key = str_replace( "`", "", $key );

		//tmp = component when the form is loaded in a pop up window - presumes the doc body has
		//already been loaded

		//can't be domready as it gets fired when wysiwyg editor gets loaded
		if (JRequest::getVar('tmpl') == 'component') {
			$startJs = '';
			$endJs = '';
		} else {
			$startJs = "window.addEvent('load', function(){";
			$endJs = "});\n";
		}
		$ajaxValidation = ($this->isMultiPage) ? true : $params->get('ajax_validations');

		$start_page = isset($model->sessionModel->last_page) ? $model->sessionModel->last_page : 0;
		$str ="$startJs

		var ofabrik = new fabrikForm( ".$model->_id.", {
			'admin':       '".$model->_admin."',
			'postMethod': '".$model->_postMethod."',
			'ajaxValidation': '".$ajaxValidation."',
			'primaryKey': '$key',
			'liveSite': '" . COM_FABRIK_LIVESITE . "',
			'error':'".@$form->origerror."',
			'pages':" . FastJSON::encode($model->getPages()) . ",
			'page_save_groups':".FastJSON::encode($model->getPageSaveGroups()) . ",
			'start_page':" . $start_page  . "
		});\n";
		$str .= "ofabrik.addListenTo('table_" . $tableModel->_id . "');\n";
		$str .= "ofabrik.addListenTo('form_" . $model->_id . "');\n";
		$str .= "oPackage.addBlock('form_". $model->_id."', ofabrik);\n";
		//instantaite js objects for each element

		$groupstr = '';
		$vstr = '';
		$aObjs = array();
		$str .= "ofabrik.addElements([\n";
		foreach ($model->_groups as $groupModel) {
			foreach ($groupModel->_aElements as $elementModel) {
				$fullName = $elementModel->getFullName( );
				$id = $elementModel->getHTMLId( );
				$elementModel->_editable = ($model->_editable);
				if ($js = $elementModel->elementJavascript( )) {
					$aObjs[] =  $js;
				}
				
				if(!empty($elementModel->_aValidations)){
					$element =& $elementModel->getElement();
					$elName = $elementModel->getHTMLName( );
					$id = $elementModel->getHTMLId( );
					$vstr .= "ofabrik.watchValidation('$elName', '$id');\n";
				}
				
			}
			$groupParams = $groupModel->getParams();
			$addJs 			= str_replace( '"', "'",  $groupParams->get( 'repeat_group_js_add' ) );
			$addJs 			= str_replace( array("\n", "\r"), "",  $addJs );
			$delJs 			= str_replace('"', "'",  $groupParams->get( 'repeat_group_js_delete' ) );
			$gdelJs 		= str_replace( array("\n", "\r"), "",  $delJs );

			$groupstr .= "ofabrik.addGroupJS($groupModel->_id, 'delete', \"$delJs\");\n";
			$groupstr .= "ofabrik.addGroupJS($groupModel->_id, 'add', \"$addJs\");\n";
		}
		$str .= implode(",\n", $aObjs);
		$str .= "]\n);\n";
		$str .= $groupstr;
		$str .=  $actions;
		$str .= $vstr;
		$str .= $endJs;

		$str .= "function submit_form(){";
		if (!empty( $aWYSIWYGNames )) {
			jimport( 'joomla.html.editor' );
			$editor =& JFactory::getEditor();
			$str .= $editor->save( 'label' );

			foreach ($aWYSIWYGNames as $parsedName) {
				$str .= $editor->save( $parsedName );
			}
		}
		$str .="
			return false;
		}
			
		function submitbutton(button){
			if(button==\"cancel\"){
				document.location = '".JRoute::_('index.php?option=com_fabrik&task=viewTable&cid='.$tableId). "';
			}
			if(button == \"cancelShowForm\"){
				return false;
			}
		}
";
		$document->addScriptDeclaration( $str );
	}

	function _loadTmplBottom( )
	{
		global $Itemid, $_SERVER;
		$model 	=& $this->getModel();
		$params =& $model->getParams();
		$form 	=& $model->getForm();
		$cursor = JRequest::getInt( 'fabrik_cursor', '' );
		$total 	= JRequest::getInt( 'fabrik_total', '' );
		$reffer = '';
		if (array_key_exists( 'HTTP_REFERER', $_SERVER ) ){
			$reffer = $_SERVER['HTTP_REFERER'];
		}
		$aHiddenFields = "<input type='hidden' name='tableid' value='" . $model->_table->_id . "' id = 'tableid' />\n
		<input type='hidden' name='fabrik' value='" . $model->_id . "' id = 'fabrik' />\n
		<input type='hidden' name='task' value='processForm' id = 'task' />\n
		<input type='hidden' name='rowid' value='" . $model->_rowId . "' id = 'rowid' />\n
		<input type='hidden' name='Itemid' value='" . $Itemid . "' id = 'Itemid' />\n
		<input type='hidden' name='option' value='com_fabrik' id = 'option' />\n
		<input type='hidden' name='c' value='form' id = 'c' />\n
		<input type='hidden' name='form_id' value='" . $model->_id . "' id = 'form_id' />\n
		<input type='hidden' name='fabrik_frommodule' value='" . $model->_isModule . "' id = 'fabrik_frommodule' />\n
		<input type='hidden' name='fabrik_cursor' value='" . $cursor . "' id = 'fabrik_cursor' />\n
		<input type='hidden' name='fabrik_total' value='" . $total . "' id = 'fabrik_total' />\n
		<input type='hidden' name='returntoform' value='0' id='returntoform' />\n
		<input type='hidden' name='fabrik_referrer' value='" . $reffer . "' id='fabrik_referrer' />\n
		<input type='hidden' name='fabrik_postMethod' value='" . $model->_postMethod . "' id='fabrik_postMethod' />";

		$aHiddenFields .= JHTML::_( 'form.token' );

		$this->form->resetButton = $params->get('reset_button', 0) == "1" ?	"<input type=\"reset\" class=\"button\" name=\"Reset\" value=\"" . $params->get('reset_button_label') . "\" />\n" : '';
		$this->form->copyButton = $params->get('copy_button', 0) == "1" ?	"<input type=\"submit\" class=\"button\" name=\"Copy\" value=\"" . $params->get('copy_button_label') . "\" />\n" : '';
		$this->form->gobackButton = $params->get('goback_button', 0) == "1" ?	"<input type=\"button\" class=\"button\" name=\"Goback\" onclick=\"history.back()\" value=\"" . $params->get('goback_button_label') . "\" />\n" : '';
		if ($model->_editable) {
			$button = ( $model->_postMethod == 'post') ? "submit" : "button";
			$this->form->submitButton = '';
			if ($this->isMultiPage) {
				$this->form->submitButton .= "<input type='button' class='fabrikPagePrevious button' name='fabrikPagePrevious' value='" . JText::_('Previous') ."' />\n";
				$this->form->submitButton .= "<input type='button' class='fabrikPageNext button' name='fabrikPageNext' value='" . JText::_('Next') ."' />\n";
			}
			$this->form->submitButton .= "<input type=\"$button\" id=\"fabrikSubmit" . $model->_id . "\" class=\"button\" name=\"Submit\" value=\"" . $form->submit_button_label ."\" />\n " ;
		} else {
			$this->form->submitButton = '';
		}
		$format = ( $model->_postMethod == 'post' ) ? 'html' : 'raw';
		$aHiddenFields .= "<input type='hidden' name='format' value='$format' />";
		$aHiddenFields .= "<input type='hidden' name='_senderBlock' id='_senderBlock' value='form_" .$form->id . "' />";
		$this->hiddenFields = $aHiddenFields;
	}
}
?>