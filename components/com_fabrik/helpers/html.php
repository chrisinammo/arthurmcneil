<?php
/**
* @package Joomla
* @subpackage Fabrik
* @copyright Copyright (C) 2005 Rob Clayburn. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Content Component HTML Helper
 *
 * @static
 * @package		Joomla
 * @subpackage	Content
 * @since 1.5
 */
class FabrikHelperHTML
{

	function packageJS()
	{
		static $packagejsincluded;
		if (JRequest::getVar('tmpl') == 'component') {
			//inside component tmpl - package should be loaded
			return;
		}
		if (!isset( $packagejsincluded )) {
			$document =& JFactory::getDocument();
			// Load the javascript 
			FabrikHelperHTML::script( 'package.js', 'components/com_fabrik/views/package/', true );
			//dont have this inside an onload
			$script = "var oPackage = new fabrikPackage({'liveSite':'" . JURI::root() . "'});	";
			$document->addScriptDeclaration( $script );
			$packagejsincluded = true;
		}
	}

	/**
	 * @param string element select to auto create windows for  - was default = a.modal
	 */

	function mocha($selector='', $params = array())
	{
		static $modals;
		static $included;

		$document =& JFactory::getDocument();

		// Load the necessary files if they haven't yet been loaded
		if (!isset( $included )) {

			// Load the javascript and css
			FabrikHelperHTML::script( 'mocha.js', 'components/com_fabrik/libs/', true );
			JHTML::stylesheet( 'mocha.css', 'components/com_fabrik/libs/mocha/css/' );
			$included = true;
		}

		if (!isset( $modals )) {
			$modals = array();
		}

		$sig = md5( serialize( array( $selector,$params ) ) );
		if (isset($modals[$sig]) && ($modals[$sig])) {
			return;
		}
		
		$script = "
		window.addEvent('load', function(){";
		if (array_key_exists( 'dock', $params ) && $params['dock']) {
			$script .= "
		var dock = new Element('div', {'id':'mochaDock'}).adopt(
		[new Element('div', {id:'mochaDockPlacement'}),
		new Element('div', {'id':'mochaDockAutoHide'})]
		);
		dock.injectInside(document.body);
";
		}
		$script .= "
		document.mochaScreens = new MochaScreens();
		document.mochaDesktop = new MochaDesktop();
	";
			
		if ($selector == '') {
			$script .= "\n})";
			$document->addScriptDeclaration($script);
			return;
		}

		// Setup options object
		$opt['ajaxOptions']	= (isset($params['ajaxOptions']) && (is_array($params['ajaxOptions']))) ? $params['ajaxOptions'] : null;
		$opt['size']		= (isset($params['size']) && (is_array($params['size']))) ? $params['size'] : null;
		$opt['onOpen']		= (isset($params['onOpen'])) ? $params['onOpen'] : null;
		$opt['onClose']		= (isset($params['onClose'])) ? $params['onClose'] : null;
		$opt['onUpdate']	= (isset($params['onUpdate'])) ? $params['onUpdate'] : null;
		$opt['onResize']	= (isset($params['onResize'])) ? $params['onResize'] : null;
		$opt['onMove']		= (isset($params['onMove'])) ? $params['onMove'] : null;
		$opt['onShow']		= (isset($params['onShow'])) ? $params['onShow'] : null;
		$opt['onHide']		= (isset($params['onHide'])) ? $params['onHide'] : null;

		$options = JHTMLBehavior::_getJSObject($opt);
		// Attach modal behavior to document

			$script .= "
			$$('".$selector."').each(function(el) {
				el.addEvent('click', function(e) {
					new Event(e).stop();

//todo un hardwire this!

					var c= mochaSearch.content;
					var o = {
						title: 'Mocha UI Version 0.7',
						loadMethod: 'xhr',
						width: 300,
						height: 150,
						contentType:'',
						content:c,
						id:el.id
					}
					var lastWin = document.mochaDesktop.newWindowfromElement(el, o);

					mochaSearch.makeEvents();
				});
			});
	});";
		
		$document->addScriptDeclaration($script);

		// Set static array
		$modals[$sig] = true;
		return;
	}

	/** test not sure if needed ***/
	
	function modal($selector='a.modal', $params = array())
	{
		return;
		static $modals;
		static $included;

		$document =& JFactory::getDocument();

		// Load the necessary files if they haven't yet been loaded
		if (!isset($included)) {

			// Load the javascript and css
			FabrikHelperHTML::script('modal2.js', 'components/com_fabrik/libs/', true);
			JHTML::stylesheet('modal.css');

			$included = true;
		}

		if (!isset($modals)) {
			$modals = array();
		}

		$sig = md5(serialize(array($selector,$params)));
		if (isset($modals[$sig]) && ($modals[$sig])) {
			return;
		}
		
		// Setup options object
		$opt['ajaxOptions']	= (isset($params['ajaxOptions']) && (is_array($params['ajaxOptions']))) ? $params['ajaxOptions'] : null;
		$opt['size']		= (isset($params['size']) && (is_array($params['size']))) ? $params['size'] : null;
		$opt['onOpen']		= (isset($params['onOpen'])) ? $params['onOpen'] : null;
		$opt['onClose']		= (isset($params['onClose'])) ? $params['onClose'] : null;
		$opt['onUpdate']	= (isset($params['onUpdate'])) ? $params['onUpdate'] : null;
		$opt['onResize']	= (isset($params['onResize'])) ? $params['onResize'] : null;
		$opt['onMove']		= (isset($params['onMove'])) ? $params['onMove'] : null;
		$opt['onShow']		= (isset($params['onShow'])) ? $params['onShow'] : null;
		$opt['onHide']		= (isset($params['onHide'])) ? $params['onHide'] : null;

		$options = JHTMLBehavior::_getJSObject($opt);
		// Attach modal behavior to document
		$document->addScriptDeclaration("
		window.addEvent('domready', function() {

			SqueezeBox2.initialize(".$options.");

			$$('".$selector."').each(function(el) {
				el.addEvent('click', function(e) {
					new Event(e).stop();
					SqueezeBox2.fromElement(el);
				});
			});
		});");

		// Set static array
		$modals[$sig] = true;
		return;
	}
	
		/**
	 * show form to allow users to email form to a friend
	 * @param object form
	 */
	function emailForm( $oForm, $template='' )
	{
		global $mosConfig_db;
		$document =& JFactory::getDocument();
		
		$document->setTitle( $oForm->label );
		$document->addStyleSheet("templates/'. $template .'/css/template_css.css");
		?>
		<form method="post" action="index.php?option=com_fabrik&amp;task=sendEmail&amp;tmpl=component" name="frontendForm">
			<table>
				<tr>
					<td>
						<label for="email"><?php echo JText::_('Your friend\'s e-mail:') ?></label>
					</td>
					<td>
						<input type="text" size="25" name="email" id="email"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="yourname"><?php echo JText::_('Your Name:'); ?></label>
					</td>
					<td>
						<input type="text" size="25" name="yourname" id="yourname"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="youremail"><?php echo JText::_('Your e-mail:'); ?></label>
					</td>
					<td>
						<input type="text" size="25" name="youremail" id="youremail"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="subject"><?php echo JText::_('Message subject:'); ?></label>
					</td>
					<td>
						<input type="text" size="40" maxlength="40" name="subject" id="subject"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<input type="submit" name="submit" class="button" value="<?php echo JText::_('Send e-mail'); ?>" />
					&nbsp;&nbsp;
					<input type="button" name="cancel" value="<?php echo JText::_('Cancel'); ?>" class="button" onclick="window.close();" />
					</td>
				</tr>
			</table>
				<input type="hidden" name="fabrik" value="<?php echo $oForm->id;?>" />
		<input type="hidden" name="<?php echo JUtility::getHash( $mosConfig_db );?>" value="1" />
		</form>
		<?php
	}
	
	/**
	 * once email has been sent to a frind show this message 
	 */
	 
	function emailSent( $to, $template='' )
	{
		$config =& JFactory::getConfig();
		$document =& JFactory::getDocument();
		$document->setTitle( $config->getValue('sitename') );
		$document->addStyleSheet("templates/'. $template .'/css/template_css.css" );
		?>
		<span class="contentheading"><?php echo JText::_('This item has been sent to')." $to";?></span><br />
		<br />
		<br />
		<a href='javascript:window.close();'>
		<span class="small"><?php echo JText::_('Close Window');?></span>
		</a>
<?php
	}
	 
	/**
	 * writes a print icon
	 * @param object form
	 * @param object parameters
	 * @param int row id
	 * @return string print html icon/link
	 */
	 
	function printIcon( $oForm, $params, $rowid = '' )
	{
		$config		=& JFactory::getConfig();
		if ($params->get( 'print' )) {
			$status = "status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=400,height=250,directories=no,location=no";
			$link = JRoute::_(  "index.php?option=com_fabrik&tmpl=component&view=details&fabrik=". $oForm->id . "&tableid=" . $oForm->table_id . "&rowid=" . $rowid );
			if ($params->get( 'icons' )) {
				$image = mosAdminMenus::ImageCheck( 'printButton.png', '/images/M_images/', NULL, NULL, _CMN_PRINT, _CMN_PRINT );
			} else {
				$image = '&nbsp;'. _CMN_PRINT;
			}
			if ($params->get( 'popup', 1 )) {
				$ahref = '<a href="javascript:void(0)" onclick="javascript:window.print(); return false" title="' . _CMN_PRINT . '">';	
			} else {
				$ahref = "<a href='#' onclick=\"window.open('$link','win2','$status;');return false;\"  title='" .  _CMN_PRINT . "'>";
			}
			$return = $ahref .
			$image .
			"</a>";
			return $return;
		}	 		
	}
	 
	/**
	* Writes Email icon
	* @param object form
	* @param object parameters
	* @return string email icon/link html
	*/
	
	function emailIcon( $oForm, $params )
	{
		$config		=& JFactory::getConfig();
		$popup = $params->get( 'popup', 1 );
		if ($params->get( 'email' ) && !$popup) {
			$status = "status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=400,height=250,directories=no,location=no";
			$link = JRoute::_( "index.php?option=com_fabrik&task=emailForm&tmpl=component&fabrik=". $oForm->id );
			if ($params->get( 'icons' )) {
				$image = mosAdminMenus::ImageCheck( 'emailButton.png', '/images/M_images/', NULL, NULL, _CMN_EMAIL, _CMN_EMAIL );
			} else {
				$image = '&nbsp;'. _CMN_EMAIL;
			}
			return "<a href='#' onclick=\"window.open('$link','win2','$status;');return false;\"  title='" .  _CMN_EMAIL . "'>
			$image
			</a>";
		}
	}
	
		/**
	  * @param string selected join
	  */
 
	function joinTypeList( $sel = '' )
	{
	 	$joinTypes = array( );
	 	$joinTypes[] = JHTML::_('select.option', 'inner', JText::_( 'Inner join' ) );
	 	$joinTypes[] = JHTML::_('select.option', 'left', JText::_( 'Left join' ) );
		$joinTypes[] = JHTML::_('select.option', 'right', JText::_( 'Right join' ) );
		return JHTML::_('select.genericlist',  $joinTypes, 'join_type[]', 'class="inputbox" size="1" ', 'value', 'text', $sel );
	}
	 
	 /**
	  * yes no options for list with please select options
	  *
	  * @param string $sel
	  * @param string default label
	  */
	 
	 function yesNoOptions( $sel = '', $default = '' )
	 	{
	 	if ($default == '') {
	 		$default = JText::_( 'Please select');
	 	}
	 	$yesNoList[] = JHTML::_('select.option', "", $default );
		$yesNoList[] = JHTML::_('select.option', "1", JText::_( 'Yes') );
		$yesNoList[] = JHTML::_('select.option', "0", JText::_( 'No') );
		return $yesNoList;
	 }
	 
	 function tableList( $sel = '' )
	 {
			
	 		$db =& JFactory::getDBO();
			$db->setQuery("select id, label from #__fabrik_tables where state = '1'");
			$rows = $db->loadObjectList();
			return JHTML::_('select.genericlist', $rows, 'fabrik__swaptable', 'class="inputbox" size="1" ', 'id', 'label', $sel );
	 }
	 
	
	function GetImageFolders( &$folders, $path, $default='/' )
	{
		$javascript = "onchange=\"changeDynaList( 'imagefiles', folderimages, document.adminForm.folders.options[document.adminForm.folders.selectedIndex].value, 0, 0);  previewImage( 'imagefiles', 'view_imagefiles', '$path/' );\"";
		return	 	JHTML::_('select.genericlist',  $folders, 'folders', 'class="inputbox" size="1" '. $javascript, 'value', 'text', $default );
	}
	
	function loadCalendar()
	{
		static $calendarLoaded;

		// Only load once
		if ($calendarLoaded) {
			return;
		}
		$calendarLoaded = true;
		JHTML::_('behavior.calendar');	
	}
	
	/**
	* Generates an HTML radio list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @returns string HTML for the select list
	*/
			
	function radioList( &$arr, $tag_name, $tag_attribs, $selected=null, $key='value', $text='text' )
	{
		reset( $arr );
		$html = "";
		for ($i=0, $n=count( $arr ); $i < $n; $i++) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = ( isset($arr[$i]->id) ? @$arr[$i]->id : null);

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " checked=\"checked\"" : '');
			}
			$html .= "\n\t<div class=\"fabrikRadioDiv\" id=\"$tag_name" . "_div_" . "$k\"><input type=\"radio\" name=\"$tag_name\" id=\"$tag_name$k\" value=\"".$k."\"$extra $tag_attribs />";
			$html .= "\n\t<label for=\"$tag_name$k\">$t</label></div>";
		}
		$html .= "\n";
		return $html;
	}
	
	/**
	 * hack to get the editior code without it being written out to the page straight away
	 * think this returns a simple text field
	 */
	
	function getEditorArea( $name, $content, $hiddenField, $width, $height, $col, $row )
	{
		$editor =& JFactory::getEditor();
		return $editor->display( $name,  $content, $width, $height, $col, $row, false ) ;
	}
	
	/**
	 * 
	 */

	function PdfIcon( $model, $params, $rowId, $attribs = array())
	{
		global $Itemid;
		$url	    = '';
		$text	= '';
		$view = JRequest::getVar( 'view' );
		if ( $view == 'form' || $view == 'details' ){
			$form = $model->getForm();
			$table = $model->_table->getTable();
			$user =& JFactory::getUser();
			$url = "index.php?option=com_fabrik&view=details&format=pdf&fabrik=". $form->id . "&tableid=" . $table->id . "&rowid=" . $rowId;
		} else {
			$table = $model->getTable();
			$url = "index.php?option=com_fabrik&view=table&format=pdf&tableid=" . $table->id;			
		}
				
		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		//if ($params->get('show_icons')) {
			$text = JHTML::_('image.site', 'pdf_button.png', '/images/M_images/', NULL, NULL, JText::_('PDF'), JText::_('PDF'));
		//} else {
		//	$text = JText::_('PDF').'&nbsp;';
		//}

		$attribs['title']	= '"'.JText::_( 'PDF' ).'"';
		$attribs['onclick'] = "\"window.open(this.href,'win2','".$status."'); return false;\"";
		$attribs['rel']     = '"nofollow"';

		$output = JHTML::_('link', JRoute::_($url), $text, $attribs);
		return $output;
	}
	
	/**
	 * overwrite standard J mootools file with mootools 1.2beta2
	 * this isnt really going to work out - too much incompatibilty between the two code bases
	 * even with "compatibility mode" on will try again when final 1.2 is out
	 */
	function mootools()
	{
		return;
		static $mootools;
		if (!isset( $mootools )) {
			$mootools = true;
			$fbConfig =& JComponentHelper::getParams( 'com_fabrik' );
			if ($fbConfig->get( 'usefabrik_mootools' )) {
				$document =& JFactory::getDocument();
				foreach ($document->_scripts as $script=>$type ) {
					if ($script == '/fabrik2.0.x/media/system/js/mootools.js') {
						unset( $document->_scripts[$script] );
					}
				}
				$config = &JFactory::getConfig();
				$debug = $config->getValue('config.debug');
			
				// TODO NOTE: Here we are checking for Konqueror - If they fix thier issue with compressed, we will need to update this
				$konkcheck = strpos (strtolower($_SERVER['HTTP_USER_AGENT']), "konqueror");
		
				if ($debug || $konkcheck) {
					FabrikHelperHTML::script( 'mootools-beta-1.2b2-compatible-uncompressed.js', 'components/com_fabrik/libs/', false );
				} else {
					FabrikHelperHTML::script( 'mootools-beta-1.2b2-compatible.js', 'components/com_fabrik/libs/', false );
				}
			}
		}
	}
	
	/**
	 * wrapper for JHTML::Script()
	 */
	function script( $filename, $path = 'media/system/js/', $mootools = true)
	{
		/*$fbConfig =& JComponentHelper::getParams( 'com_fabrik' );
		if ($fbConfig->get( 'usefabrik_mootools' )) {
			$mootools = false;
		}*/
		JHTML::script( $filename, $path, $mootools );
	}
		
	
}
?>