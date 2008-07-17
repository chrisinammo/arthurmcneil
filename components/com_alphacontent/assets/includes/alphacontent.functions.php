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

 // no direct access
defined('_JEXEC') or die('Restricted access');

eval(stripslashes(base64_decode('ZnVuY3Rpb24gZ2V0QUNDb3B5cmlnaHROb3RpY2UoKSB7DQoJDQoJcmVxdWlyZV9vbmNlIChKUEFUSF9TSVRFLkRTLlwnYWRtaW5pc3RyYXRvclwnLkRTLlwnY29tcG9uZW50c1wnLkRTLlwnY29tX2FscGhhY29udGVudFwnLkRTLlwnYXNzZXRzXCcuRFMuXCdpbmNsdWRlc1wnLkRTLlwndmVyc2lvbi5waHBcJyApOw0KCQ0KCSRjb3B5U3RhcnQgPSAyMDA4OyANCgkkY29weU5vdyA9IGRhdGUoXCdZXCcpOyAgDQoJaWYgKCRjb3B5U3RhcnQgPT0gJGNvcHlOb3cpIHsgDQoJCSRjb3B5U2l0ZSA9ICRjb3B5U3RhcnQ7DQoJfSBlbHNlIHsNCgkJJGNvcHlTaXRlID0gJGNvcHlTdGFydC5cIi1cIi4kY29weU5vdyA7DQoJfSANCgkkbm90aWNlQUNDb3B5cmlnaHQgPSBcIjxkaXYgc3R5bGU9XFxcImNsZWFyOmJvdGg7dGV4dC1hbGlnbjpjZW50ZXI7XFxcIj48c3BhbiBjbGFzcz1cXFwic21hbGxcXFwiPjxiciAvPlBvd2VyZWQgYnkgPGEgaHJlZj1cXFwiaHR0cDovL3d3dy5hbHBoYXBsdWcuY29tXFxcIiB0YXJnZXQ9XFxcIl9ibGFua1xcXCI+QWxwaGFDb250ZW50PC9hPiBcIiAuIEpURVhUOjpfKFwnX0FMUEhBQ09OVEVOVF9OVU1fVkVSU0lPTlwnKSAuIFwiJm5ic3A7JmNvcHk7Jm5ic3A7XCI7DQoJJG5vdGljZUFDQ29weXJpZ2h0IC49ICRjb3B5U2l0ZSAuIFwiIC0gQWxsIHJpZ2h0cyByZXNlcnZlZDwvc3Bhbj48L2Rpdj5cIjsNCgkNCgllY2hvICRub3RpY2VBQ0NvcHlyaWdodDsJCQ0KfQ0KDQpmdW5jdGlvbiBmaW5kSU1HKCAkY29udGVudHRleHQsICRzaG93Zmlyc3RpbWcgKSB7CQ0KCSRpbWFnZSA9IFwiXCI7DQoJaWYgKCBwcmVnX21hdGNoX2FsbChcJyNzcmM9XCIoLiopXCIjVWlzXCcsICRjb250ZW50dGV4dCwgJG1hdGNoICkgKSB7DQoJCWlmICggY291bnQoJG1hdGNoKSApIHsNCgkJCSRuID0gc2l6ZW9mKCRtYXRjaFsxXSk7DQoJCQlpZiAoICRzaG93Zmlyc3RpbWc9PVwnMlwnICkgew0KCQkJCSRpbWFnZSA9ICRtYXRjaFsxXVskbi0xXTsNCgkJCX0gZWxzZSAkaW1hZ2UgPSAkbWF0Y2hbMV1bMF07DQoJCX0NCgl9DQoJcmV0dXJuICRpbWFnZTsNCn0NCg0KZnVuY3Rpb24gYWNTbWFydFN1YnN0ciggJHRleHQsICRsZW5ndGg9MjUwICkgew0KCWlmICggc3RybGVuKCR0ZXh0KSA+ICRsZW5ndGggKSB7ICAgICANCgkJJHRleHQgPSBzdWJzdHIoICR0ZXh0LCAwLCAkbGVuZ3RoICk7DQoJCSRibGFua3BvcyA9IHN0cnJwb3MoICR0ZXh0LCBcJyBcJyApOyAgICANCgkJJHRleHQgPSBzdWJzdHIoICR0ZXh0LCAwLCAkYmxhbmtwb3MgKTsgICAgDQoJCSR0ZXh0IC49IFwiLi4uXCI7DQoJfSAgDQoJcmV0dXJuICR0ZXh0OyAgDQp9DQoNCmZ1bmN0aW9uIGFjUHJlcGFyZUFscGhhQ29udGVudCggJHRleHQsICRsZW5ndGg9MjUwLCAkdGFncz1cJ1wnICkgew0KCS8vIHN0cmlwcyB0YWdzIHdvblwndCByZW1vdmUgdGhlIGFjdHVhbCBqc2NyaXB0DQoJJHRleHQgPSBwcmVnX3JlcGxhY2UoIFwiXCc8c2NyaXB0W14+XSo+Lio/PC9zY3JpcHQ+XCdzaVwiLCBcIlwiLCAkdGV4dCApOw0KCSR0ZXh0ID0gcHJlZ19yZXBsYWNlKCBcJy97Lis/fS9cJywgXCdcJywgJHRleHQpOw0KCS8vIHJlcGxhY2UgbGluZSBicmVha2luZyB0YWdzIHdpdGggd2hpdGVzcGFjZQ0KCSR0ZXh0ID0gcHJlZ19yZXBsYWNlKCBcIlwnPChiclteLz5dKj8vfGhyW14vPl0qPy98LyhkaXZ8aFsxLTZdfGxpfHB8dGQpKT5cJ3NpXCIsIFwnIFwnLCAkdGV4dCApOw0KCS8vcmV0dXJuIGh0bWxfZW50aXR5X2RlY29kZShhY1NtYXJ0U3Vic3RyKCBzdHJpcF90YWdzKCAkdGV4dCwgJHRhZ3MgKSwgJGxlbmd0aCwgJHNlYXJjaHdvcmQgKSk7DQoJcmV0dXJuIGh0bWxfZW50aXR5X2RlY29kZSggYWNTbWFydFN1YnN0ciggc3RyaXBfdGFncyggJHRleHQsICR0YWdzICksICRsZW5ndGggKSApOw0KfQ0K')));

function getCategories ( $ncat, $subcats, $sectionid, $url, $params, $showmore=1, $char ) {
	$catlist = "";
	$more = 0;
	$cat  = @explode ( "\n", $subcats );
	$nsubcats = count($cat);
	$char = stripslashes($char);
	if ( $ncat>$params->get('limitnumcat') && $params->get('limitnumcat')>0 && $showmore ) $more = 1;
	if ( $sectionid!='0' ) {
		if ($char=='<li>') $catlist .= "<ul>";
		$endli = ($char== '<li>')? "</li>" : "";
		for ( $i=0; $i < $ncat; $i++ ){
			$subcat = @explode ( "|", $cat[$i] );
			if ( $subcat[0]!='' ) {				
				$sep = ( $i < ($nsubcats-1) ) ? $char . " "  : "" ;
				$linkcat = $url . "&amp;section=" . $sectionid . "&amp;category=" . $subcat[0] ;
				if ( $endli=='</li>' ) {
					$sep = ""; 
					$catlist .= "<li>";
				}
				$catlist .= "<a href=\"" . JRoute::_($linkcat) . "\">" . $subcat[1] . "</a>" . $endli.$sep;
			}
		}
		if ( $more ) {
			$linkcat = $url . "&amp;section=" . $sectionid;
			$catlist .= $char . " <a href=\"" . JRoute::_($linkcat) . "\">...</a>" . $endli;
		}
		if ($char== '<li>') $catlist .= "</ul>";
		$endli = "";
	}
	return $catlist;
}

function insertImageDirectory( $image, $title, $width='80') {

	$image4directory = "";
	
	// Insert image section/category			
	if ( $image!='' ) {
		$image4directory = "<img src=\"" . JURI::base() . "images/stories/" . $image . "\" class=\"ac_image_directory\" width=\"" . $width . "px\" title=\"" . $title . "\" alt=\"" . $title . "\" />";
	}
	return $image4directory;
}

function showIconNew ( $created, $numdaynew=7, $lang ){

	$icon_new = "";
	$cdate = $created;
	$cjour = substr($cdate,8,2); 
	$cmois = substr($cdate,5,2); 
	$cannee = substr($cdate,0,4); 
			
	$timestamp = @mktime(0,0,0,$cmois,$cjour,$cannee);
	$cmaintenant = time();							
	$ecart_secondes = $cmaintenant - $timestamp;
	$ecart_jours = floor($ecart_secondes / (60*60*24)); 			
	
	if ( $numdaynew > '0' ){ 
		if ($ecart_jours <= $numdaynew){
			// set default icons
			$new_icon = "new_en-gb.gif";		
			// Get icon in right language if exists
			if (file_exists(JPATH_SITE."/components/com_alphacontent/assets/images/new_".$lang.".gif")){
				$new_icon = "new_".$lang.".gif";
			}
			$icon_new = " <span style=\"vertical-align:middle\"><img src=\"".JURI::base()."/components/com_alphacontent/assets/images/".$new_icon."\" alt=\"\" /></span>";
		}
	}
	return $icon_new;
}

function showIconHot( $hits, $numhitshot=50, $lang ){
	
	$icon_hot = "";
	if ( $numhitshot > '0' ){ 
		if($hits >= $numhitshot){
			$hot_icon = "hot_en-gb.gif";
			// Get icon in right language if exists
			if (file_exists(JPATH_SITE."/components/com_alphacontent/assets/images/hot_".$lang.".gif")){
				$hot_icon = "hot_".$lang.".gif";
			}			
			$icon_hot = " <span style=\"vertical-align:middle\"><img src=\"".JURI::base()."/components/com_alphacontent/assets/images/".$hot_icon."\" alt=\"\" /></span>";
		}
	}
	return $icon_hot;
}

function buildWhereComment ( $commentsystem, $idarticle ){
	
	switch ( $commentsystem ) {
	
		case 'yvcomment':
			$wherecomment = "parentid = '" . intval($idarticle) . "' AND `state` = '1'";
			break;
		
		default:
			$wherecomment = '';
	
	}
	return $wherecomment;


}

function getNumberComments( $commentsystem, $idarticle ) {

	$db =& JFactory::getDBO();
	$numcomments = 0;
	$wherecomment = buildWhereComment ( $commentsystem, $idarticle );
	
	if ( $wherecomment ) {
		$query = "SELECT COUNT(*) FROM #__" . $commentsystem . " WHERE " . $wherecomment;
		$db->setQuery( $query );
		$num = $db->loadResult();
		$numcomments = $num[0];
	}
	return $numcomments;
}

function showShareThis( $params ) {

	$sharethis = ( $params->get('showsharethiswidget')=='1' ) ? stripslashes( $params->get('sharethiscode') ) : '' ;
	
	return $sharethis;

}

function showRSSicon( $params, $section, $category, $menuid ) {
	global $mainframe;
	
	$rss2    = "";
	$linkRSS = "";
	if ( $section>=0 ) $linkRSS  = JRoute::_( "index.php?option=com_alphacontent&amp;task=showRSS&amp;s=$section&amp;m=$menuid" );	
	if ( $category ) $linkRSS = JRoute::_( "index.php?option=com_alphacontent&amp;task=showRSS&amp;s=$section&amp;c=$category&amp;m=$menuid" );	

	$rss2 .= "<a href=\"".$linkRSS."\">";
	//$rss2 .= "<span class=\"ac_rss2\"><img src=\"".JURI::base()."/components/com_alphacontent/assets/images/rss.png\" alt=\"RSS.2\" /></span>";
	$rss2 .= "<span class=\"ac_rss2\">" . JText::_('AC_RSS') . "</span>";
	$rss2 .= "</a>";
	
	return $rss2;
}
?>