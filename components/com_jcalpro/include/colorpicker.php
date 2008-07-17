<?PHP
/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com). 
Extcal (http://sourceforge.net/projects/extcal) was renamed 
and adapted to become a Mambo/Joomla! component by 
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes. 

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: colorpicker.php - Color picker palette$

Revision date: 03/07/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>

<script type="text/javascript">
function on(k,myObject) {
	if(document.getElementById||(document.all && !(document.getElementById))){
			document.sample.style.backgroundColor= colors[k];
			document.forms['colorpicker'].hextext.value = colors[k];
	}
}

function setColor(k) {
  opener.document.forms['adminForm'].color.value = colors[k];
  opener.getElement('colorpickerbg').style.backgroundColor= opener.getElement('color').value;
  window.close();
}
function off(k,myObject) {
	if(document.getElementById||(document.all && !(document.getElementById))){
			//sample.style.backgroundColor= colors[k];
	}
}

var colors = new Array(
<?php
	for($red=0; $red<6;$red++) {
		$rhex = dechex($red * 0x33);
		$rhex = (strlen($rhex) < 2)?"0".$rhex:$rhex;
		for($blue=0; $blue<6;$blue++) {
			$bhex = dechex($blue * 0x33);
			$bhex = (strlen($bhex) < 2)?"0".$bhex:$bhex;
			for($green=0; $green<6;$green++) {
				$ghex = dechex($green * 0x33);
				$ghex = (strlen($ghex) < 2)?"0".$ghex:$ghex;
				$sep = ($red || $green || $blue)?",":"";
				echo strtoupper("$sep'#".$rhex.$ghex.$bhex."'\n");
			}
		}
	}
?>
,'#000000'
,'#111111'
,'#222222'
,'#333333'
,'#444444'
,'#555555'
,'#666666'
,'#777777'
,'#888888'
,'#999999'
,'#AAAAAA'
,'#BBBBBB'
,'#CCCCCC'
,'#DDDDDD'
,'#EEEEEE'
,'#FFFFFF'
,'#FFFFFF'
,'#FFFFFF'
);

var counter=0;


</script>
<title>Color Picker</title>
<style type="text/css">
<!--
.hextext {
	font: 11px Arial, Helvetica, sans-serif;
	color: #000000;
	background-color: #D8D8D8;
	border: 0px solid #D8D8D8;
}

.samplecell {
	border-color: black;
	border: 0px solid black;

}

.samplecell:hover {
  border-color: white;
}
-->
</style>
</head>

<body bgcolor="#D0D0D0" onBlur="setTimeout('window.close()',5000)" marginwidth="0" marginheight="0" leftmargin="0" topmargin="0">

<form name="colorpicker" action="colorpicker.php">
<table border="0" cellpadding="0" cellspacing="1" bgcolor="#000000" align="center">
	<tr bgcolor="#D8D8D8">
		<td colspan="18" height="23">
			<table border="0" cellpadding="0" cellspacing="2" width="100%">
				<tr>
					<td style="border: #000000 solid 1px" width="40" height="17" bgcolor="#000000"><img name="sample" alt="" src="../images/spacer.gif" width="40" height="17" border="0"></td>
					<td width="100%" height="17" align="center"><input type="text" name="hextext" id="hextext" value="#000000" size="7" class="hextext" readonly="true"></td>
				</tr>
			</table>
		</td>
	</tr>

<script type="text/javascript">
  var k;
  for (var l = 0; l<2; l++) {
	  for (var i = 0; i<6; i++) {
	    document.write("<tr>");
	    for (var k =0; k<3; k++) {
		    for (var j =0; j<6; j++) {
		          c=j+i*6+k*36+l*108;
		          document.write('<td class="samplecell" onmouseover="on('+c+', this)" onmouseout="off('+c+', this)" bgcolor="'+
		            colors[c]+'" class="samplecell"><a href="javascript:setColor('+c+');//'+colors[c]+'" style="cursor: crosshair"><img name="c'+c+'" src="../images/spacer.gif" width="8" height="8" border="0"><\/a><\/td>');
		    }
	    }
	    document.writeln("<\/tr>");
	  }
  }
  document.write("<tr>");
    for (var j =0; j<18; j++) {
          c=j+216;
          
          document.write('<td class="samplecell" onmouseover="on('+c+', this)" onmouseout="off('+c+', this)" bgcolor="'+
          	colors[c]+'" class="samplecell"><a href="javascript:setColor('+c+');//'+colors[c]+'"><img name="c'+c+'" src="../images/spacer.gif" width="8" height="8" border="0"><\/a><\/td>');
    }
  document.writeln("<\/tr>");
</script>
</table>
</form>

  </body>
</html>
