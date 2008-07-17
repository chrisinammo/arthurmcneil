<?php
/*
Page:           rpc.php
Created:        Aug 2006
Last Mod:       Mar 18 2007
This page handles the 'AJAX' type response if the user
has Javascript enabled.
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
Licensed under a Creative Commons Attribution 3.0 License.
http://creativecommons.org/licenses/by/3.0/
See readme.txt for full credit details.
--------------------------------------------------------- 
Modified by Bernard Gilly for AlphaContent on 30 Jan 2008
http://www.alphaplug.com
Last revision : 26 May 2008 for AlphaContent version 4.0.0
*/

header("Cache-Control: no-cache");
header("Pragma: nocache");

if(!defined("_JEXEC")) {
   DEFINE( "_JEXEC", 1 );
}

$path = str_replace("//components/com_alphacontent/assets/includes/alphacontent.rpc.php", "", getenv("SCRIPT_FILENAME") );
$path = str_replace("/components/com_alphacontent/assets/includes/alphacontent.rpc.php", "", getenv("SCRIPT_FILENAME") );

require_once( $path . "/configuration.php" );

if( class_exists( "JConfig" ) ) {
	$config = new JConfig();
	$rating_conn = mysql_connect($config->host, $config->user, $config->password) or die  ('Error connecting to mysql');
	mysql_select_db($config->db, $rating_conn);
	$mosConfig_absolute_path = $path;
	$dbprefix = $config->dbprefix;
} 

//getting the values
$vote_sent        = preg_replace("/[^0-9]/","",$_REQUEST['j']);
$id_sent          = preg_replace("/[^0-9a-zA-Z]/","",$_REQUEST['q']);
$ip_num           = preg_replace("/[^0-9\.]/","",$_REQUEST['t']);
$units            = preg_replace("/[^0-9]/","",$_REQUEST['c']);
$component        = preg_replace("/[^0-9a-zA-Z_]/","",$_REQUEST['p']);
$mosConfig_lang   = preg_replace("/[^0-9a-zA-Z_-]/","",$_REQUEST['lang']);
$userid           = preg_replace("/[^0-9]/","",$_REQUEST['user']);
$rating_unitwidth = preg_replace("/[^0-9]/","",$_REQUEST['u']); // width
$model			  = preg_replace("/[^0-9a-zA-Z_]/","",$_REQUEST['m']);
$cid			  = preg_replace("/[^0-9]/","",$_REQUEST['cid']);
$rid			  = preg_replace("/[^0-9]/","",$_REQUEST['rid']);
$infos			  = preg_replace("/[^0-9]/","",$_REQUEST['infos']);
$tense		  	  = $_REQUEST['v'];
$ip 			  = $_SERVER['REMOTE_ADDR'];

if ($vote_sent > $units) die("Sorry, vote appears to be invalid."); // kill the script because normal users will never see this.

//connecting to the database to get some information
$query = mysql_query("SELECT total_votes, total_value, used_ips, component FROM ".$dbprefix."alpha_rating WHERE id='".$id_sent."' AND component='".$component."' AND cid='".$cid."' AND rid='".$rid."'")or die(" Error: ".mysql_error());
$numbers = mysql_fetch_assoc($query);
$checkIP = unserialize($numbers['used_ips']);
$count = $numbers['total_votes']; //how many votes total
$current_rating = $numbers['total_value']; //total number of rating added together and stored

$sum = $vote_sent+$current_rating; // add together the current vote value and the total vote value
//$tense = ($count<=1) ? 'vote' : 'votes'; //plural form votes/vote

// checking to see if the first vote has been tallied
// or increment the current number of votes
($sum==0 ? $added=0 : $added=$count+1);

// if it is an array i.e. already has entries the push in another value
$useridstring = "uid" . $userid . ";";
((is_array($checkIP)) ? array_push($checkIP,$ip_num,$useridstring) : $checkIP=array($ip_num,$useridstring));
$insertip=serialize($checkIP);

$user_registered = ( $userid > 0 )? " OR used_ips LIKE '%uid".$userid.";%'" : "" ;

//IP check when voting
$voted=mysql_num_rows(mysql_query("SELECT used_ips FROM ".$dbprefix."alpha_rating WHERE ( used_ips LIKE '%".$ip."%'".$user_registered." ) AND id='".$id_sent."' AND component='".$component."' AND cid='".$cid."' AND rid='".$rid."'"));

if(!$voted) {     //if the user hasn't yet voted, then vote normally...
	if (($vote_sent >= 1 && $vote_sent <= $units) && ($ip == $ip_num)) { // keep votes within range, make sure IP matches - no monkey business!
		$update = "UPDATE ".$dbprefix."alpha_rating SET total_votes='".$added."', total_value='".$sum."', used_ips='".$insertip."' , component='".$component."' WHERE id='".$id_sent."' AND component='".$component."' AND cid='".$cid."' AND rid='".$rid."'";
		$result = mysql_query($update);		
	} 
} //end for the "if(!$voted)"

// these are new queries to get the new values!
$newtotals = mysql_query("SELECT total_votes, total_value, used_ips, component FROM ".$dbprefix."alpha_rating WHERE id='".$id_sent."' AND component='".$component."' AND cid='".$cid."' AND rid='".$rid."'")or die(" Error: ".mysql_error());
$numbers = mysql_fetch_assoc($newtotals);
$count = $numbers['total_votes'];//how many votes total
$current_rating = $numbers['total_value'];//total number of rating added together and stored

// $new_back is what gets 'drawn' on your page after a successful 'AJAX/Javascript' vote
$new_back = array();

$new_back[] .= '<div class="ratingbar">';
$new_back[] .= '<ul class="unit-rating" style="width:'.$units*$rating_unitwidth.'px;float:left;">';
$new_back[] .= '<li class="current-rating" style="width:'.@number_format($current_rating/$count,2)*$rating_unitwidth.'px;">Current rating.</li>';
$new_back[] .= '<li class="r1-unit">1</li>';
$new_back[] .= '<li class="r2-unit">2</li>';
$new_back[] .= '<li class="r3-unit">3</li>';
$new_back[] .= '<li class="r4-unit">4</li>';
$new_back[] .= '<li class="r5-unit">5</li>';
$new_back[] .= '<li class="r6-unit">6</li>';
$new_back[] .= '<li class="r7-unit">7</li>';
$new_back[] .= '<li class="r8-unit">8</li>';
$new_back[] .= '<li class="r9-unit">9</li>';
$new_back[] .= '<li class="r10-unit">10</li>';
$new_back[] .= '</ul>';
if ( $infos ) {
	$new_back[] .='<span class="votinginfo">';
	$new_back[] .='<strong> ' . @number_format($sum/$added,1) . '</strong>/' . $units . ' ('.$count.' '.$tense.')';
	$new_back[] .='</span>';
}
$new_back[] .= '</div>';
$new_back[] .= '<div style="clear:both;"></div>';

$allnewback = join("\n", $new_back);

// ========================
@mysql_close($rating_conn);

//name of the div id to be updated | the html that needs to be changed
$output = "unit_long" . $id_sent . $model . "|" . $allnewback;
echo $output;
?>