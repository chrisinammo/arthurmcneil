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

	var $_id 			= null;
	
	function setId($id)
	{
		$this->_id = $id;
	}
	
	function getGroupProperties( &$groupModel )
	{
		$group 				= new stdClass(  );
		$model				=& $this->getModel();
		$groupTable 	=& $groupModel->getGroup();
		$groupParams 	=& $groupModel->getParams();
		$group->canRepeat = ($model->_editable) ? $groupParams->get( 'repeat_group_button', '0' ) : 0;
		$addJs 				= str_replace( '"', "'",  $groupParams->get( 'repeat_group_js_add' ) );
		$group->addJs 	= str_replace( array("\n", "\r"), "",  $addJs );
		$delJs 			= str_replace('"', "'",  $groupParams->get( 'repeat_group_js_delete' ) );
		$group->delJs 	= str_replace( array("\n", "\r"), "",  $delJs );
		$showGroup 		= $groupParams->def( 'repeat_group_show_first', '1' );
		if ($showGroup == 0) {
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
	 * main setup routine for displaying the form/detail view
	 * @param string template
	 */

	function display( $tpl = null )
	{
		global $mainframe, $_SESSION;
		
		$config		=& JFactory::getConfig();
		$model		=& $this->getModel();
		
			//Get the active menu item
		$usersConfig = &JComponentHelper::getParams( 'com_fabrik' );
		
		if ( !isset( $this->_id ) ) {
			$model->setId( $usersConfig->get( 'fabrik', JRequest::getInt( 'fabrik' ) ) );
		} else {
			//when in a package the id is set from the package view
			$model->setId( $this->_id );
		}

		$model->getForm();
		$model->render();
		
		if ( !$model->canPublish( ) ) {
			if ( !$model->_admin ) {
				echo JText::_( 'Sorry this form is not published' );
				return false;
			}
		}
		
		if ( $model->_isModule ) {
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
		if ( $access == 0 ) {
			echo JText::_('ALERTNOTAUTH');
			return false;
		}
		if ( $access == 1 && $model->_editable == '1' ) {
			$model->_editable = 0;
		}
		if ( is_object( $model->_table )) {
			$joins = $model->_table->getJoins( );
			$model->getJoinGroupIds( $joins );
		}
		$model->getPageTitle( );
		

		$params =& $model->getParams();
		$params->def( 'icons', $mainframe->getCfg( 'icons' ) );
		$pop =  (JRequest::getVar('tmpl') == 'component') ? 1 : 0;
		$params->set( 'popup', $pop );
		$this->form_template = JRequest::getVar( 'layout', $form->form_template );
		$view = JRequest::getVar('view', 'form');
		if( $view == 'details' ){
			$model->_editable = false;
		}
		if( $model->_editable ){
			foreach( $model->_data as $key=>$val ){
				if(is_string($val)){
					$data[$key] = htmlspecialchars( $val, ENT_QUOTES );
				}
			}
		}
		
		$model->addCustomFiles( );
				
		$params		=& $model->getParams();
		$aWYSIWYGNames = array();
		//$model 	=& $this->getModel();
		$form 	=& $model->getForm();
		foreach ( $model->_groups as $groupModel ) {
			foreach ( $groupModel->_aElements as $elementModel ) {
				$res = $elementModel->useEditor();
				if ( $res != false ) {
					$aWYSIWYGNames[] = $res;
				}
			}
		}
		$namedData = array();
		$this->form 			= $form;
		if ( $model->_admin ) {
			$model->_rootPath = JURI::base() ."/administrator/index.php";
			$this->form->action = JURI::base()  . "/index.php";
			$this->form->formid = "adminForm";
			$this->form->name 	= "adminForm";
			$this->form->js 		= "onsubmit=\"javascript:submit_form();\"";
		} else {
			//$model->_rootPath = (!$this->_inPackage) ? JURI::base()."/index.php?" : JURI::base()."/index.php?format=raw&format=raw";
			$model->_rootPath = JURI::base()."/index.php?";
			$this->form->action = $model->_rootPath."&option=com_fabrik";
			$this->form->formid = "form_".$model->_id;
			$this->form->name 	= "form_".$model->_id;
			$this->form->js 		= "";
		}
		
		$this->form->js 	= $model->_js;
		$this->form->encType = $model->getFormEncType();;
		
		if (count( $model->_arErrors ) > 0) {
			$this->form->error = $form->error;
		} else {
			$this->form->error = '';
		}
		$aGroups 			= array();
		$jsActions 			= array();
		$allJsActions = $model->getJsActions();
		$this->showEmail = $params->get( 'email', 0 );
	
		$model->loadValidationRuleClasses( );
		foreach ( $model->_groups as $groupModel ) {
			$activeData = $model->_data;
			$groupTable =& $groupModel->getGroup();
			if ( $groupTable->state != 0 ) {
				$group = $this->getGroupProperties( $groupModel );
				$aElements = array();
				//check if group is acutally a table join

				if ( array_key_exists( $groupTable->id, $model->_aJoinGroupIds ) ) {
					
					$joinId = $model->_aJoinGroupIds[$groupTable->id];
				
					$element 			= new stdClass();
					//add in row id for join data
					$element->label = '';
					$element->error = '';
					//something wrong with this bit below i think - oform->_table might be incorrect???
					foreach ( $model->_table->_aJoins as $oJoin ) {
						if ( $oJoin->id == $joinId ) {
							$key = $oJoin->table_join . $model->_joinTableElementStep . $oJoin->table_join_key;
							if ( array_key_exists( 'join', $model->_data ) ){
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
					
					if ( is_object( $model->_table ) ) {
						$tableId = $model->_table->id;
					} else {
						$tableId = '';
					}
					$joinTable = $joinModel->loadFromGroupId( $groupTable->id, $tableId );
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
								if( array_key_exists( $smallerElHTMLName, $activeData ) ){
									$c = count($activeData[$smallerElHTMLName]);
									if ( $c > $repeatGroup ) { $repeatGroup = $c;}
								}
							}
						}
					}
				} else {
					$foreignKey = null;
					$activeData = $model->_data;
					$repeatGroup = 1;
				}
				$aSubGroups = array();
				for ( $c = 0; $c < $repeatGroup; $c++ ) {
					$aSubGroupElements = array();
					foreach ( $groupModel->_aElements as $elementModel ) {
						
						$elementTable =& $elementModel->getElement();
						$element 			= new stdClass( );
						$elementModel->loadLanguage( ); 
						$elHTMLName			= $elementModel->getFullName( true, true );
						$elementHTMLId 	= $elementModel->getHTMLId( );
						$jsActions[]		= $elementModel->getFormattedJSActions( $allJsActions );
						//if the element is in a join AND is the join's foreign key then we don't show the element 
						
						if ( $elementTable->name == $foreignKey ) {
							$element->label 	= '';
							$elementModel->_element->hidden = true;
						} else {
							$element->label 	= $elementModel->getLabel( );
						}
						$element->id		= $elementModel->getHTMLId( );
						$element->className = "fb_el_" . $elementTable->id;
						$element->element 	=  $this->_getElement( $elementModel, $activeData, $c );
						$element->element_ro = $this->_getROElement( $elementModel, $activeData, $c );
						$aElements[$element->id] = $element;
						$namedData[$elHTMLName] = $element;
						if( $elHTMLName )
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


		foreach( $this->groups as $group ){?>
		<div class="fabrikGroup" id="group<?php echo $group->id;?>" style="<?php echo $group->css;?>">
		<h3><?php echo $group->title;?></h3>
		<?php if($group->canRepeat){
			$subgroupCounter = 0;
			foreach($group->subgroups as $subgroup){
			?>
				<div class="fabrikSubGroup" id="subgroup<?php echo $group->id . "_" . $subgroupCounter;?>">
				<div class="fabrikSubGroupElements">
					<?php foreach( $subgroup as $element ){?>
						<div class="fabrikElement" id="<?php echo $element->className;?>">
							<?php if($element->error != ''){?>
								<div class="fabrikError"><?php echo $element->error;?></div>
							<?php }?> 
							<?php echo $element->label;?>
							<div class="fabirkElement">
								<?php echo $element->element;?>
							</div>
						</div>
					<?php }?>
				</div>
				<?php $subgroupCounter ++;
			} ?>
		<?php }else{?>
			<?php foreach( $group->elements as $element ){
			?>
				<div class="fabrikElement" id="<?php echo $element->className;?>">
				<?php echo $element->label;?>
				<div class="fabirkElement">
					<?php echo $element->element;?>
				</div>
				</div>
				<br />
			<?php }
		 }?>
	</div>
<?php
	}

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
		if (! $elementModel->canView( ) && !$elementModel->canUse() ) {
			return '';
		}
		if (! $elementModel->canUse() ) {
			$editable = false;
		}
		$elementModel->_shortHTMLName = $elementModel->getFullName( false, true, false );
		$elementModel->_editable 	= $editable;
		$elementModel->getDefaultValue( $data, true, $repeatCounter );
		$elementModel->getHTMLId( );
		return $elementModel->render( $data, $repeatCounter );
	}
	
	/**
	 * @access private
	 * @param object element model
	 * @param array data
	 * @param int repeat group counter 
	 */

	function _getROElement( &$elementModel, $data, $repeatCounter = 0 )
	{
		if (! $elementModel->canView( ) && !$elementModel->canUse() ) {
			return '';
		}
		$elementModel->_editable 	= false;
		return $elementModel->render( $data, $repeatCounter );
	}
	


}
?>