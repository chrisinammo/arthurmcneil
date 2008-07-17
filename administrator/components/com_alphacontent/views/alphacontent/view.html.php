<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component AlphaContent
 * @copyright Copyright (C) 2008 Bernard Gilly
 * @license : DonationWare
 * @Website : http://www.alphaplug.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

Jimport( 'joomla.application.component.view');

class configurationViewAlphacontent extends JView {

	function edit($tpl = null) {
	
  		$document =& JFactory::getDocument();
  		JHTML::_('behavior.mootools');
		$document->addScriptDeclaration("window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });");
		
		ac_Jimport( 'joomla.html.html.select');
		
		$lists = array();
				
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_NONE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_CONTENTSECTION' ) );
		$options[] = JHTMLSelect::Option( '2', JText::_( 'AC_STATICSCONTENT' ) );
		$options[] = JHTMLSelect::Option( '3', JText::_( 'AC_WEBLINKSSECTION' ) );
		$options[] = JHTMLSelect::Option( '4', JText::_( 'AC_CONTACTSSECTION' ) );
		$options[] = JHTMLSelect::Option( '5', JText::_( 'AC_FEATUREDBELOW' ) );		
		$lists['list_homeresult'] = JHTMLSelect::genericlist( $options, 'list_homeresult', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_homeresult );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', '1' );
		$options[] = JHTMLSelect::Option( '1', '2' );
		$lists['list_numcols'] = JHTMLSelect::radiolist( $options, 'list_numcols', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_numcols );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_NONE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_TEXTONLY' ) );
		$options[] = JHTMLSelect::Option( '2', JText::_( 'AC_ORIGINALINTRO' ) );
		$lists['list_introstyle'] = JHTMLSelect::genericlist( $options, 'list_introstyle', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_introstyle );
		$lists['list_titlelinkable'] = JHTMLSelect::booleanlist('list_titlelinkable', 1, $this->alphacontent_configuration->list_titlelinkable );		
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_numindex'] = JHTMLSelect::radiolist( $options, 'list_numindex', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_numindex );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_iconnew'] = JHTMLSelect::radiolist( $options, 'list_iconnew', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_iconnew );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_iconhot'] = JHTMLSelect::radiolist( $options, 'list_iconhot', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_iconhot );
		$options = array();
		$options[] = JHTMLSelect::Option( 'created', JText::_( 'AC_DATECREATED' ) );
		$options[] = JHTMLSelect::Option( 'modified', JText::_( 'AC_DATEMODIFIED' ) );
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_DONOTSHOW' ) );
		$lists['list_showdate'] = JHTMLSelect::genericlist( $options, 'list_showdate', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_showdate );
		$options = array();
		$options[] = JHTMLSelect::Option( JText::_( 'DATE_FORMAT_LC' ), JText::_( 'DATE_FORMAT_LC' ) );
		$options[] = JHTMLSelect::Option( JText::_( 'DATE_FORMAT_LC2' ), JText::_( 'DATE_FORMAT_LC2' ) );
		$lists['list_formatdate'] = JHTMLSelect::genericlist( $options, 'list_formatdate', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_formatdate );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showauthor'] = JHTMLSelect::radiolist( $options, 'list_showauthor', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showauthor );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showsectioncategory'] = JHTMLSelect::radiolist( $options, 'list_showsectioncategory', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showsectioncategory );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showhits'] = JHTMLSelect::radiolist( $options, 'list_showhits', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showhits );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_shownumcomments'] = JHTMLSelect::radiolist( $options, 'list_shownumcomments', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_shownumcomments );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_NONE' ) );
		$options[] = JHTMLSelect::Option( 'yvcomment', 'Yvcomment' );
		$lists['list_commentsystem'] = JHTMLSelect::genericlist( $options, 'list_commentsystem', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_commentsystem );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showprint'] = JHTMLSelect::radiolist( $options, 'list_showprint', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showprint );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showpdf'] = JHTMLSelect::radiolist( $options, 'list_showpdf', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showpdf );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showemail'] = JHTMLSelect::radiolist( $options, 'list_showemail', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showemail );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showreadmore'] = JHTMLSelect::radiolist( $options, 'list_showreadmore', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showreadmore );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showlinkmap'] = JHTMLSelect::radiolist( $options, 'list_showlinkmap', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showlinkmap );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_shownumberpagetotal'] = JHTMLSelect::radiolist( $options, 'list_shownumberpagetotal', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_shownumberpagetotal );
		$options = array();
		$options[] = JHTMLSelect::Option( '5', '5' );
		$options[] = JHTMLSelect::Option( '6', '6' );
		$options[] = JHTMLSelect::Option( '8', '8' );
		$options[] = JHTMLSelect::Option( '10', '10' );
		$options[] = JHTMLSelect::Option( '12', '12' );
		$options[] = JHTMLSelect::Option( '15', '15' );
		$options[] = JHTMLSelect::Option( '16', '16' );
		$options[] = JHTMLSelect::Option( '18', '18' );
		$options[] = JHTMLSelect::Option( '20', '20' );
		$options[] = JHTMLSelect::Option( '25', '25' );
		$options[] = JHTMLSelect::Option( '30', '30' );
		$options[] = JHTMLSelect::Option( '40', '40' );
		$options[] = JHTMLSelect::Option( '50', '50' );
		$options[] = JHTMLSelect::Option( '30', '30' );
		$options[] = JHTMLSelect::Option( '100', '100' );
		$options[] = JHTMLSelect::Option( '200', '200' );
		$options[] = JHTMLSelect::Option( '500', '500' );
		$options[] = JHTMLSelect::Option( '1000', '1000' );		
		$lists['list_resultperpage'] = JHTMLSelect::genericlist( $options, 'list_resultperpage', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_resultperpage );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showsearchbox'] = JHTMLSelect::radiolist( $options, 'list_showsearchbox', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showsearchbox );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showsearchboxbutton'] = JHTMLSelect::radiolist( $options, 'list_showsearchboxbutton', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showsearchboxbutton );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['list_showorderinglist'] = JHTMLSelect::radiolist( $options, 'list_showorderinglist', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->list_showorderinglist );
		$options = array();
		$options[] = JHTMLSelect::Option( 'title ASC',  JText::_( 'AC_TITLEAZ' ) );
		$options[] = JHTMLSelect::Option( 'title DESC',  JText::_( 'AC_TITLEZA' ) );
		$options[] = JHTMLSelect::Option( 'created ASC',  JText::_( 'AC_DATECREATEDASC' ) );
		$options[] = JHTMLSelect::Option( 'created DESC',  JText::_( 'AC_DATECREATEDDESC' ) );
		$options[] = JHTMLSelect::Option( 'modified ASC',  JText::_( 'AC_DATEMODIFIEDASC' ) );
		$options[] = JHTMLSelect::Option( 'modified DESC',  JText::_( 'AC_DATEMODIFIEDDESC' ) );
		$options[] = JHTMLSelect::Option( 'hits ASC',  JText::_( 'AC_HITSASC' ) );
		$options[] = JHTMLSelect::Option( 'hits DESC',  JText::_( 'AC_HITSDESC' ) );
		$options[] = JHTMLSelect::Option( 'rating ASC',  JText::_( 'AC_RATINGASC' ) );
		$options[] = JHTMLSelect::Option( 'rating DESC',  JText::_( 'AC_RATINGDESC' ) );
		$options[] = JHTMLSelect::Option( 'author ASC',  JText::_( 'AC_AUTHORASC' ) );
		$options[] = JHTMLSelect::Option( 'author DESC',  JText::_( 'AC_AUTHORDESC' ) );
		$options[] = JHTMLSelect::Option( '0',  JText::_( 'AC_DEFAULTORDERING' ) );		
		$lists['list_defaultordering'] = JHTMLSelect::genericlist( $options, 'list_defaultordering', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_defaultordering );
		$options = array();
		$options[] = JHTMLSelect::Option( '0',  JText::_( 'AC_NO' ) );
		$options[] = JHTMLSelect::Option( '1',  JText::_( 'AC_FIRST' ) );
		$options[] = JHTMLSelect::Option( '2',  JText::_( 'AC_LAST' ) );
		$lists['list_showimage'] = JHTMLSelect::genericlist( $options, 'list_showimage', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_showimage );
		$options = array();
		$options[] = JHTMLSelect::Option( '0',  JText::_( 'AC_LEFT' ) );
		$options[] = JHTMLSelect::Option( '1',  JText::_( 'AC_RIGHT' ) );
		$options[] = JHTMLSelect::Option( '2',  JText::_( 'AC_ALTERNATE' ) );
		$lists['list_imageposition'] = JHTMLSelect::genericlist( $options, 'list_imageposition', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->list_imageposition );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['showmaptypemenu'] = JHTMLSelect::radiolist( $options, 'showmaptypemenu', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->showmaptypemenu );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['showmapcontrolsmenu'] = JHTMLSelect::radiolist( $options, 'showmapcontrolsmenu', 'class="inputbox"' ,'value', 'text', $this->alphacontent_configuration->showmapcontrolsmenu );
		$lists['activeglobalsystemrating'] = JHTMLSelect::booleanlist('activeglobalsystemrating', 1, $this->alphacontent_configuration->activeglobalsystemrating );		
		$options = array();
		$options[] = JHTMLSelect::Option( '5', '5' );
		$options[] = JHTMLSelect::Option( '6', '6' );
		$options[] = JHTMLSelect::Option( '7', '7' );
		$options[] = JHTMLSelect::Option( '8', '8' );
		$options[] = JHTMLSelect::Option( '9', '9' );
		$options[] = JHTMLSelect::Option( '10', '10' );
		$lists['numstars'] = JHTMLSelect::genericlist( $options, 'numstars', 'class="inputbox" size="1"' ,'value', 'text', $this->alphacontent_configuration->numstars );
		$options = array();
		$options[] = JHTMLSelect::Option( '0', JText::_( 'AC_HIDE' ) );
		$options[] = JHTMLSelect::Option( '1', JText::_( 'AC_SHOW' ) );
		$lists['showsharethis'] = JHTMLSelect::booleanlist('showsharethis', 1, $this->alphacontent_configuration->showsharethis );
		
		$this->assignRef('lists', $lists);
		
		parent::display( $tpl) ;
		
	}
}
?>
