<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class fabrikViewForm extends JView{
	
	var $_template 	= null;
	var $_errors 	= null;
	var $_data 		= null;
	var $_rowId 	= null;
	var $_params 	= null;

	
	function getGroupProperties( $oGroup )
	{
		$group 			= new stdClass(  );
		$groupParams 	= new fabrikParams( $oGroup->attribs );
		$group->canRepeat = $groupParams->get( 'repeat_group_button', '0' );
		$addJs 			= str_replace( '"', "'",  $groupParams->get( 'repeat_group_js_add' ) );
		$group->addJs 	= str_replace( array("\n", "\r"), "",  $addJs );
		$delJs 			= str_replace('"', "'",  $groupParams->get( 'repeat_group_js_delete' ) );
		$group->delJs 	= str_replace( array("\n", "\r"), "",  $delJs );
		$showGroup 		= $groupParams->def( 'repeat_group_show_first', '1' );
		if($showGroup == 0){
			$oGroup->css .= ";display:none;";
		}
		$rubbish = array ("<br />", "<br>");
		$group->css 	= trim( str_replace( $rubbish, "", $oGroup->group_css ) );
		$group->id 		= $oGroup->id;
		$group->title 	= $oGroup->label;
		$group->name	= $oGroup->name;
		if( $group->canRepeat == 1 && $this->_oForm->_editable ){
			$group->delId =   "delGroup_" . $oGroup->id ;
			$group->addId = "addGroup_" . $oGroup->id;
			$group->displaystate = '1';
		} else {
			$group->delId = '';
			$group->addId = '';
			$group->displaystate = '0';
		}
		return $group;
	}
	
	function display()
	{
		global $_MAMBOTS;
		//error_reporting(0);
		//facebook specific stuff
		// the facebook client library
	/*	require_once  'components/com_fabrik/libs/facebook-client/facebook.php';
		
		// Get these from http://developers.facebook.com
		$appapikey = '202a65725bc4a7c83a9084a1e9a2b15b';
		$appsecret = 'e4135385bd31130390c661ca4a36c791';
		$facebook = new Facebook($appapikey, $appsecret);
		$user = $facebook->require_login();
	
		$appcallbackurl = 'http://fabrikar.com/versions/2.0/index.php?option=com_fabrik&Itemid=3&format=facebook&no_html=1';
		//catch the exception that gets thrown if the cookie has an invalid session_key in it
		try {
		  if (!$facebook->api_client->users_isAppAdded()) {
		    $facebook->redirect($facebook->get_add_url());
		  }
		} catch (Exception $ex) {
		  //this will clear cookies for your application and redirect them to a login prompt
		//  $facebook->set_user(null, null);
		 // $facebook->redirect($appcallbackurl);
		}
		$facebookid = $facebook->get_loggedin_user();
		*/
		$aWYSIWYGNames = array();
		$tplName = $tpl;
		$tpl = $tpl ."/template.php";
		foreach( $this->_oForm->_groups as $oGroup ){
			foreach( $oGroup->_aElements as $elementModel ){
					$res = $elementModel->useEditor();
					if( $res != false ){
						$aWYSIWYGNames[] = $res;
					}
				}
			}
		}
		$namedData = array();
		
		$this->form 			= new stdClass();
		$this->form->title 		= $this->_oForm->label;
		$this->form->intro 		= $this->_oForm->intro;
		$this->form->editable 	= $this->_oForm->_editable;
	
		$this->form->action = "";

		
		$this->form->js 	= $this->_oForm->_js;
		$this->form->name 	= $this->_oForm->_formName;
		$this->form->formid	= $this->_oForm->_formId;
		$this->form->encType = $this->_oForm->_enctype;
		$this->_includeTemplateCSSFile( $tplName );
		
		if(count($this->_errors) > 0){
			$this->form->error = $this->_oForm->error;
		}else{
			$this->form->error = '';
		}
		$aGroups 			= array();
		$jsActions 			= array();
		$allJsActions = $this->_oForm->getJsActions();
		$this->showEmail = $this->_params->get( 'email', 0 );
		if (JRequest::getVar('tmpl') != 'component') {
			if ( $this->showEmail ){
				$this->emailLink = FabrikHelperHTML::emailIcon( $this->_oForm, $this->_params ) ;
			}
	
			$this->showPrint = $this->_params->get( 'print', 0 );
			if ( $this->showPrint ){
				$this->printLink = FabrikHelperHTML::printIcon( $this->_oForm, $this->_params, $this->_rowId );
			}
	
			$this->showPDF = $this->_params->get( 'pdf', 0 );
			if ( $this->showPDF ){
				$this->pdfLink = FabrikHelperHTML::pdfIcon( $this->_oForm, $this->_params, $this->_rowId );
			}
		}		
		$this->_oForm->loadValidationRuleClasses( );
		
		foreach( $this->_oForm->_groups as $oGroup ){
			if($oGroup->state != 0){
				$group = $this->getGroupProperties( $oGroup );
				
				$aElements = array();
				//check if group is acutally a table join
				if( array_key_exists( $oGroup->id, $this->_oForm->_aJoinGroupIds ) ){
					$joinId = $this->_oForm->_aJoinGroupIds[$oGroup->id];
					$element 			= new stdClass();
					//add in row id for join data
					$element->label = '';
					$element->error = '';
					//something wrong with this bit below i think - oform->_table might be incorrect???
					foreach(  $this->_oForm->_table->_aJoins as $oJoin ){
						if( $oJoin->id == $joinId ){
							$key = $oJoin->table_join . $this->_oForm->_joinTableElementStep . $oJoin->table_join_key;
							if( array_key_exists( 'join', $this->_data ) ){
								$val = $this->_data['join'][$joinId][$key];
							} else {
								$val = '';
							}
							$element->element = '<input type="hidden" id="join.' . $joinId . '.rowid" name="join[' . $joinId . '][rowid]" value="' . $val . '" />';
						}
					}
					$aElements[] = $element;
				}
				if($oGroup->canRepeat() || array_key_exists($oGroup->id, $this->_oForm->_aJoinGroupIds)){
					
					$repeatGroup = 1;
					$activeData = $this->_data;
					$oJoin = new fabrikJoin( $db );
					if( is_object($this->_oForm->_table) ){
						$tableId = $this->_oForm->_table->id;
					}else{
						$tableId = '';
						
					}
					$oJoin->loadFromGroupId( $oGroup->id, $tableId );
					$foreignKey = $oJoin->table_join_key;
					//need to duplicate this perhaps per the number of times that a repeat group occurs in the default data?
			
					if(is_array($this->_oForm->_joinDefaultData)){
						
						if(array_key_exists($oJoin->id, $this->_oForm->_joinDefaultData)){
							
							$activeData = $this->_oForm->_joinDefaultData[$oJoin->id];
							reset($oGroup->_aElements);
							$tmpElement = current($oGroup->_aElements);
							$smallerElHTMLName = $tmpElement->getFullName( false, true, false);
							$repeatGroup = count($activeData[$smallerElHTMLName]);
						}else{
							//guess at how many repeated groups were posted
							$tmpElement = current($oGroup->_aElements);
							foreach($oGroup->_aElements as $tmpElement){
								$smallerElHTMLName = $tmpElement->getFullName( false, true, false);
								if( array_key_exists( $smallerElHTMLName, $activeData ) ){
									$c = count($activeData[$smallerElHTMLName]);
									if( $c > $repeatGroup ){ $repeatGroup = $c;}
								}
							}
						}
					}
				}else{
					
					$foreignKey = null;
					$activeData = $this->_data;
					$repeatGroup = 1;
				}
				$aSubGroups = array();
				for( $c = 0; $c < $repeatGroup; $c++ ){
					$aSubGroupElements = array();
					foreach( $oGroup->_aElements as $elementModel ){
						$element 			= new stdClass( );
						$elementModel->loadLanguage( ); 
						$elHTMLName			= $elementModel->getFullName( true, true );
						$elementHTMLId 		= $elementModel->getHTMLId( );
						$jsActions[]		= $elementModel->getFormattedJSActions( $allJsActions );
						//if the element is in a join AND is the join's foreign key then we don't show the element 
						
						if( $elementModel->name == $foreignKey ){
							$element->label 	= '';
							$element->error 	= '';
							$elementModel->_element->hidden = true;
						}else{
							$element->label 	= $elementModel->getLabel( );
							$element->error 	= $this->_getErrorMsg( $elHTMLName, $this->_errors, $elementModel->_element->plugin, $c );
						}
						$element->id		= $elementModel->getHTMLId( );
						$element->className = "fb_el_" . $element->id;
						$element->element 	=  $this->_getElement( $oGroup, $elementModel, $elHTMLName, $activeData, $c );
						$element->element_ro = $this->_getROElement( $oGroup, $elementModel, $elHTMLName, $activeData, $c );
						$aElements[$element->id] = $element;
						$namedData[$elHTMLName] = $element;
						$aSubGroupElements[] = $element;
					}
					//if its a repeatable group put in subgroup 
					if($oGroup->canRepeat()){
						$aSubGroups[] = $aSubGroupElements;
					}
				}
				//testing ?? if no repeat group select and without this lin no fields were being draw?
				
				//end test
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
		$this->_addJavascript( $aWYSIWYGNames, $this->_oForm->_table->id, $actions );
		$this->_oForm->getFormManagementJS( $actions );
		$this->_loadTmplBottom( );

		//below this will be replaced in J1.5 with call to parent class
		$templateDir =  'components/com_fabrik/views/form/tmpl/';
		if( $this->_admin ){
			$templateDir = '../' . $templateDir;
		}

		if(!is_null($tpl) && file_exists($templateDir . $tpl)){
			$this->_template = $templateDir . $tpl;
		}else{
			$this->_template = $templateDir . '/default/template.php';
		}
		$form = $this->_oForm;
		// start capturing output into a buffer
		ob_start();
		// include the requested template filename in the local scope
		// (this will execute the view logic).

		require( $this->_template );

		// done with the requested template; get the buffer and
		// clear it.
		$this->_output = ob_get_contents();
		ob_end_clean();
		return $this->_output;	 
	
	}
	
	/**
	 * get any html errror messages for form element
	 * @param string parsed element name
	 * @param array error messages
	 * @param int group element type
	 * @param int repeat count
	 * @return string error messages
	 */

	function _getErrorMsg( $parsed_name, $arErrors, $groupeltype, $repeatCount = 0 ){
		$err_msg = '';
		$parsed_name = rtrim($parsed_name, "[]");
		if (isset ($arErrors[$parsed_name])) {
			if( array_key_exists( $repeatCount, $arErrors[$parsed_name] ) ){
				if(is_array($arErrors[$parsed_name][$repeatCount])){
					foreach ($arErrors[$parsed_name][$repeatCount] as $el_err_msg) {
						$err_msg .= "$el_err_msg<br/>";
					}
				}
			}
		}
		//TODO: this is wrong 
		if ($groupeltype == '8') { // file upload element has extra error messages
			if (isset ($arErrors['ul_userfile'])) {
				foreach ($arErrors['ul_userfile'] as $el_err_msg) {
					$err_msg .= "$el_err_msg<br/>";
				}
			}
		}
		return $err_msg;
	}
	
	function _getElement( &$oGroup, &$elementModel, $elHTMLName, $data, $repeatCounter = 0 ){
		$elementModel->getParams();
		$editable = $this->_oForm->_editable;
		if(! $elementModel->canView( ) && !$elementModel->canUse() ){
			return '';
		}
		if(! $elementModel->canUse() ){
			$editable = false;
		}
		$elementModel->_editable 	= $editable;
		$elementModel->_element->default  	= $elementModel->getDefaultValue( $data, true, $repeatCounter );
		$elementHTMLId 			= $elementModel->getHTMLId( );
		$elementModel->_shortHTMLName = $elementModel->getFullName( false, true, false );
		return $elementModel->render( $data, $repeatCounter );
	}
	
	function _getROElement( &$oGroup, &$elementModel, $elHTMLName, $data, $repeatCounter = 0 ){
		$elementModel->getParams();
		if(! $elementModel->canView( ) && !$elementModel->canUse() ){
			return '';
		}
		$elementModel->_editable 	= false;
		return $elementModel->render( $oGroup, $data, $elHTMLName, $this->_oForm, $repeatCounter );
	}
	
	function _includeTemplateCSSFile( $formTemplate ){
		echo "<style>";
		include  "components/com_fabrik/views/form/tmpl/" .$formTemplate . "/template.css";
		echo "</style>";
		
		
	}

	function _addJavascript( $aWYSIWYGNames, $tableId ){
		$document =& JFactory::getDocument();
		$str ="";
		$str .= "function submit_form(){";
		jimport( 'joomla.html.editor' );
		$editor =& JFactory::getEditor();
		echo $editor->save( 'label' );
		foreach ( $aWYSIWYGNames as $parsedName ) {
			$str .= $editor->save( $parsedName );
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
		}";
		$document->addScriptDeclaration( $str );
	}

	function _loadTmplBottom( ){
		global $Itemid, $_SERVER;
		$cursor = JRequest::getInt( 'fabrik_cursor', 0 );
		$total 	= JRequest::getInt( 'fabrik_total', 0 );
		$reffer = 'http://apps.facebook.com/prefabrik';
		
		
		$aHiddenFields = "<input type='hidden' name='tableid' value='" . $this->_oForm->_table->id . "' id = 'tableid' />\n
		<input type='hidden' name='fabrik' value='" . $this->_oForm->id . "' id = 'fabrik' />\n
		<input type='hidden' name='task' value='processForm' id = 'task' />\n
		<input type='hidden' name='rowid' value='" . $this->_rowId . "' id = 'rowid' />\n
		<input type='hidden' name='Itemid' value='" . $Itemid . "' id = 'Itemid' />\n
		<input type='hidden' name='option' value='com_fabrik' id = 'option' />\n
		<input type='hidden' name='form_id' value='" . $this->_oForm->id . "' id = 'form_id' />\n
		<input type='hidden' name='fabrik_frommodule' value='" . $this->_oForm->_isModule . "' id = 'fabrik_frommodule' />\n
		<input type='hidden' name='fabrik_cursor' value='" . $cursor . "' id = 'fabrik_cursor' />\n
		<input type='hidden' name='fabrik_total' value='" . $total . "' id = 'fabrik_total' />\n
		<input type='hidden' name='returntoform' value='0' id='returntoform' />\n
		<input type='hidden' name='fabrik_referrer' value='" . $reffer . "' id='fabrik_referrer' />";
		$this->_oForm->loadParams();
		
		$this->form->resetButton = $this->_oForm->_params->get('reset_button', 0) == "1" ? "<input type=\"reset\" class=\"button\" name=\"Reset\" value=\"" . $this->_oForm->_params->get('reset_button_label') . "\" />\n" : '';
		$this->form->copyButton =  $this->_oForm->_params->get('copy_button', 0) == "1" ?	"<input type=\"submit\" class=\"button\" name=\"Copy\" value=\"" . $this->_oForm->_params->get('copy_button_label') . "\" />\n" : '';
		if( $this->_oForm->_postMethod == 'post'){
			$this->form->submitButton =  "<input type=\"submit\" id=\"fabrikSubmit" . $this->_oForm->id . "\" class=\"button\" name=\"Submit\" value=\"" . $this->_oForm->submit_button_label ."\" />\n " ;
		}else{
			$this->form->submitButton =  "<input type=\"button\" id=\"fabrikSubmit" . $this->_oForm->id . "\" class=\"button\" name=\"Submit\" value=\"" . $this->_oForm->submit_button_label ."\" />\n " ;
		}
		//if( $this->_oForm->_inPackage == '1' ){
			//$aHiddenFields .= "<input type='hidden' name='_inPackage' id='_inPackage' value='1' />";
			$aHiddenFields .= "<input type='hidden' name='format' id='format' value='raw' />";
			$aHiddenFields .= "<input type='hidden' name='_senderBlock' id='_senderBlock' value='form_" .$this->_oForm->id . "' />";
		//}
		$this->hiddenFields = $aHiddenFields;
	}
}
?>