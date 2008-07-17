<?php
/*
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: version.php 185 2006-10-16 10:14:22Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

 // no direct access
defined( '_VALID_MOS' ) or die( 'No Direct Access' );

//JEvents locale checking function
function checkLocale(){
	global $mosConfig_locale, $mainframe;
	echo "<div align='left'>";
	echo "<h2>Simple locale testing routines</h2>";
		
	
	
	$currentLocale = setlocale(LC_TIME, 0);
	echo "Your current system locale is :  $currentLocale<br/>";
	echo "Joomla has set your locale as :  $mosConfig_locale<br/><hr/>";
	
	$testLocale =  $mainframe->getUserStateFromRequest( "jev_locale", 'jev_locale', "de_DE" );
	?>
	<h3>try out a locale string</h3>
	<form action="index2.php" method="get" style="font-size:1;">
    	<table cellpadding="4" cellspacing="4" border="0"  style='background-color:#cccccc'>
      		<tr>
      			<td >
      					<input type="hidden" name="option" value="com_events" />
      					<input type="hidden" name="task" value="checklocale" />
      					<input type="text" name="jev_locale" size="30" maxlength="50" class="inputbox" value="<?php echo $testLocale;?>" />
      			</td>
      			<td>
      					<input class="button" type="submit" name="push" value="Test Locale" />
      			</td>
      		</tr>
      		<tr>
      		<tr style='font-weight:bold'>
      		<td>Today's day name in this locale (<?php echo $testLocale;?>) is :</td>
      		<td>
			<?php	
				setlocale(LC_TIME, $testLocale);
				echo strftime("<span style='font-size:1.5em;color:red;'>%A</span>");
			?>
      		</td>
      		</tr>
      	</table>
      </form>
<?php	

	$today = strftime("%A");
	setlocale(LC_TIME, $mosConfig_locale);
	
	// UNIX type strings
	?>
	<hr/>
	<h3>Typical unix locale values are tried out below</h3>
	<?php
	$today = strftime("%A");
	setlocale(LC_TIME, "fi_FI");
	echo $today.strftime(" in Finnish (using fi_FI) is %A,")."<br/>";
	setlocale(LC_TIME, "fr_FR");
	echo $today.strftime(" in French (using fr_FR) is %A")."<br/>";
	setlocale(LC_TIME, "de_DE");
	echo $today.strftime(" in German (using de_DE) is %A.")."<br/>";
	$x = setlocale(LC_TIME, "cy_GB");
	echo $x." ".$today.strftime(" in Welsh (using cy_GB) is %A.")."<br/>";
	
	// windows type strings
	echo "<hr/>";
	echo "<h2>For information about setting locale for windows servers see the following links:</h2>";

	echo "See: http://www.unicode.org/onlinedat/countries.html<br/>";
	echo "Also see : http://msdn.microsoft.com/library/default.asp?url=/library/en-us/vclib/html/_crt_language_strings.asp<br/>";
	echo "Also see : http://docs.moodle.org/en/Table_of_locales<br/>";
	
	echo "http://msdn.microsoft.com/library/default.asp?url=/library/en-us/intl/nls_238z.asp<br/>";
	echo "http://www.loc.gov/standards/iso639-2/php/English_list.php<hr/>";
	
	echo "<h3>For windows servers you could try the following pattern</h3>";
	
	setlocale(LC_TIME, "FIN");
	echo $today.strftime(" in Finnish (using FIN) is %A,")."<br/>";
	setlocale(LC_TIME, "FRA");
	echo $today.strftime(" in French (using FRA) is %A")."<br/>";
	setlocale(LC_TIME, "DEU");
	echo $today.strftime(" in German (using DEU) is %A.")."<br/>";
	 
	setlocale(LC_TIME, "cym_gbr");
	echo $today.strftime(" in Welsh (using cym_gbr) is %A.")."<br/>";
	
	setlocale(LC_TIME, "german");
	echo $today.strftime(" in German (using german) is %A.")."<br/>";
	setlocale(LC_TIME, "welsh");
	echo $today.strftime(" in Welsh (using welsh) is %A.")."<br/>";

	if (@exec("locale -a",$output)){
		echo "<h3>Your server supports the following locales</h3>";
		echo "<p>Choose the one most suited to your requirements</p>";
		echo "<pre>";
		print_r($output);
		echo "</pre>";
	}	
}
