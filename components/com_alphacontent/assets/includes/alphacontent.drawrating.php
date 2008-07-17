<?php
/*
Page:           drawrating.php
Created:        Aug 2006
Last Mod:       Mar 18 2007
The function that draws the rating bar.
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
Licensed under a Creative Commons Attribution 3.0 License.
http://creativecommons.org/licenses/by/3.0/
See readme.txt for full credit details.
--------------------------------------------------------- 
Modified by Bernard Gilly for AlphaContent on 21 Apr 2008
http://www.alphaplug.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

function rating_bar( $id, $units='', $component, $rating_unitwidth='', $static='', $model='', $cid=0, $rid=0, $infovoting=1 ) {
	global $mainframe;
	
	$db	=& JFactory::getDBO();
	$user = & JFactory::getUser();	
	$userid = $user->id;
	
	$document	= & JFactory::getDocument();
	$lang       = $document->getLanguage();
	
	//set some variables
	$ip = $_SERVER['REMOTE_ADDR'];
	if (!$units) {$units = 5;}
	if (!$static) {$static = FALSE;}
	if (!$rating_unitwidth) {$rating_unitwidth = 16;}
	
	// get votes, values, ips for the current rating bar
	$query = "SELECT total_votes, total_value, used_ips, component FROM #__alpha_rating WHERE id='".$id."' AND component='".$component."' AND cid='".$cid."' AND rid='".$rid."'";
	$db->setQuery( $query );
	$numbers = $db->loadObjectList();
	
	if (!$numbers){
		$sql = "INSERT INTO #__alpha_rating (`id`,`total_votes`, `total_value`, `used_ips`, `component`, `cid`, `rid`) VALUES ('".$id."', '0', '0', '', '".$component."', '".$cid."', '".$rid."')";
		$db->setQuery( $sql );
		$db->query();
		// get votes, values, ips for the current rating bar
		$query = "SELECT total_votes, total_value, used_ips, component FROM #__alpha_rating WHERE id='".$id."' AND component='".$component."' AND cid='".$cid."' AND rid='".$rid."'";
		$db->setQuery( $query );	
		$numbers = $db->loadObjectList();
	}
	
	if ($numbers[0]->total_votes < 1) {
		$count = 0;
	} else {
		$count=$numbers[0]->total_votes; //how many votes total
	}
	$current_rating=$numbers[0]->total_value; //total number of rating added together and stored
	$tense=($count<=1) ? JText::_('AC_VOTE') : JText::_('AC_VOTES'); //plural form votes/vote
	
	$v=($count<1) ? JText::_('AC_VOTE') : JText::_('AC_VOTES'); //plural form votes/vote for after voting
	
	// determine whether the user has voted, so we know how to draw the ul/li
	$user_registered = ( $userid > 0 )? " OR used_ips LIKE '%uid".$userid.";%'" : "" ;

	$query = "SELECT used_ips FROM #__alpha_rating WHERE ( used_ips LIKE '%".$ip."%'".$user_registered." ) AND id='".$id."' AND component='".$component."' AND cid='".$cid."' AND rid='".$rid."'";
	$db->setQuery( $query );	
	$voted = $db->loadResult();
	
	// now draw the rating bar
	$rating_width = @number_format($current_rating/$count,2)*$rating_unitwidth;
	$rating1 = @number_format($current_rating/$count,1);
	$rating2 = @number_format($current_rating/$count,2);
	
	if ($static == 'static') {
	
			$static_rater = array();
			$static_rater[] .= '<div class="ratingblock">';
			$static_rater[] .= '<div id="unit_long'.$id.$model.'">';
			$static_rater[] .= '<div class="ratingbar"><ul id="unit_ul'.$id.$model.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;float:left;">';
			$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
			$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;"></li>';
			$static_rater[] .= '</ul>';
			if ( $infovoting ) {
			  $static_rater[].='<span class="votinginfo">';
			  $static_rater[].='<strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.')';  
			  $static_rater[].='</span>';
			}
			$static_rater[] .= '</div>';
			$static_rater[] .= '</div>';
			$static_rater[] .= '</div>'."\n\n";
			$static_rater[].='<div style="clear:both;"></div>';
			return join("\n", $static_rater);
	
	} else {
		  $rater ='';
		  $rater.='<div class="ratingblock">';		  
		  $rater.='<div id="unit_long'.$id.$model.'">';		  
		  $rater.='<div class="ratingbar">';
		  $rater.='<ul id="unit_ul'.$id.$model.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;float:left;">';
		  $rater.='<li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
		  $rater.='<li class="current-rating" style="width:'.$rating_width.'px;"></li>';
		  
		  $url = JURI::base();  
		  $url = substr($url,0, strrpos($url,'/'));		  
		  
		  for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
			   if(!$voted) { // if the user hasn't yet voted, draw the voting stars
				  $rater.='<li><a href="components/com_alphacontent/assets/includes/alphacontent.db.php?j='.$ncount.'&amp;q='.$id.'&amp;t='.$ip.'&amp;c='.$units.'&amp;u='.$rating_unitwidth.'&amp;p='.$component.'&amp;lang='.$lang.'&amp;user='.$userid.'&amp;s='.$url.'&amp;m='.$model.'&amp;cid='.$cid.'&amp;rid='.$rid.'&amp;infos='.$infovoting.'&amp;v='.$v.'" title="'.$ncount.' '.JText::_('AC_OUT_OF').' '.$units.'" class="r'.$ncount.'-unit rater" rel="nofollow">'.$ncount.'</a></li>';
			   }
		  }
		  $ncount=0; // resets the count
	
		  $rater.='</ul>';
		  if ( $infovoting ) {
			  $rater.='<span class="votinginfo">';
			  $rater.='<strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.')';
			  $rater.='</span>';
		  }
		  
		  $rater.='</div>'; 
		  $rater.='</div>';
		  $rater.='</div>';
		  
		  $rater.='<div style="clear:both;"></div>';
		  return $rater;
	 }
}
?>