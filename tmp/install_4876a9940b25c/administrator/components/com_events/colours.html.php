<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: colours.html.php 844 2007-07-12 07:06:31Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>
<style>
div#newColorPicker {
	position:absolute;
	display:none;
	z-index:999;
}
.colorTable {
	background-color:#f0f0f0;
	border:solid 1px #222222;	
}
.colorpickertile {
  width                 : 20px;
  height                : 20px;
  margin                : 1px;
  border-left           : 1px solid ThreeDShadow;
  border-top            : 1px solid ThreeDShadow;
  border-right          : 1px solid ThreeDHighlight;
  border-bottom         : 1px solid ThreeDHighlight;
}
.colorpickertile:hover {
  border-right           : 1px solid ThreeDShadow;
  border-bottom          : 1px solid ThreeDShadow;
  border-left            : 1px solid ThreeDHighlight;
  border-top         	 : 1px solid ThreeDHighlight;
}
#colorpreview {
  font-size				 : 10pt;
  font-weight			 : bold;
  padding-left           : 0.5em;
  background-color		 : #FFFFFF;	
  color					 : #000000;
  border-left            : 1px solid ThreeDShadow;
  border-top             : 1px solid ThreeDShadow;
  border-right           : 1px solid ThreeDHighlight;
  border-bottom          : 1px solid ThreeDHighlight;
}
a#colorPickButton{
	border: 1px solid #000000; 
	font-family:Verdana; 
	font-weight: bold; 
	font-size:10px; 
	background:#eeeeee;
	text-decoration: none;
}
td#cancel {
	font-family:Verdana; 
	font-weight: bold; 
	font-size:10px; 
	text-align:right;
}
</style>
<script language="JavaScript" type="text/javascript">
function showPreview(evt) {
	if (window.event) target = window.event.srcElement;
	else target = evt.target;
	if (!target) return;
	parts = target.id.split("_");
	brightness=parts[0];
	bc=parts[1];
	cp = document.getElementById('colorpreview');
	//cp.innerHTML=target.id;
	cp.style.backgroundColor="#"+bc;
	if (brightness=="dark") cp.style.color="#FFFFFF";
	else cp.style.color="#000000";
}
function setcolors() {
	alldivs = document.getElementsByTagName('div');
	for(i=0;i<alldivs.length;i++){
		if (alldivs[i].className=="colorpickertile") {
			parts = alldivs[i].id.split("_");
			alldivs[i].style.backgroundColor="#"+parts[1];
			if (alldivs[i].attachEvent) {
				alldivs[i].attachEvent("onmousedown",makeChoice)
				alldivs[i].attachEvent("onmouseover",showPreview)
			}
			else {
				alldivs[i].onmousedown = makeChoice;
				alldivs[i].onmouseover = showPreview;
			}
		}
	}
}
function makeChoice(evt) {	
	if (window.event) target = window.event.srcElement;
	else target = evt.target;
	if (!target) return;
	parts = target.id.split("_");
	brightness=parts[0];
	bc=parts[1];
	
	cp = document.getElementById('colorpreview');
	document.getElementById("newColorPicker").style.display="none";
	//alert("background color is '#"+bc+"' text will be "+brightness);
	document.getElementById("pick1064797275field").value="#"+bc;
	document.getElementById("pick1064797275").style.backgroundColor="#"+bc;
	if (brightness=="dark") document.getElementById("pick1064797275").style.color="white";
	else document.getElementById("pick1064797275").style.color="black";
}
function cancelColors(){
	document.getElementById("newColorPicker").style.display="none";
}
function showColors(){
	document.getElementById("newColorPicker").style.display="block";
	
}
function setPickerColor(catcol,rowcol){
	if (document.adminForm.useCatColor.checked) {
		document.adminForm.color_bar.value=catcol;
		document.getElementById("pick1064797275").style.backgroundColor=catcol;
	} else {
		document.adminForm.color_bar.value=rowcol;
		document.getElementById("pick1064797275").style.backgroundColor=rowcol;
	}
}
function togglePicker(catcol,rowcol){
	setPickerColor(catcol,rowcol);
	currentStyle = document.getElementById("colorPickButton").style.visibility;
	document.getElementById("colorPickButton").style.visibility=(currentStyle=="visible")?"hidden":"visible";
}

if (window.attachEvent) window.attachEvent("onload", setcolors);
else window.onload=setcolors;
</script>
<div id="newColorPicker">
    <table border="0" cellpadding="1" cellspacing="1" class="colorTable">
        <tr>
          <td><div class="colorpickertile" id='light_FFFFFF'></div></td>
          <td><div class="colorpickertile" id='light_FFCCCC'></div></td>
          <td><div class="colorpickertile" id='light_FFCC99'></div></td>
          <td><div class="colorpickertile" id='light_FFFF99'></div></td>
          <td><div class="colorpickertile" id='light_FFFFCC'></div></td>
          <td><div class="colorpickertile" id='light_99FF99'></div></td>
          <td><div class="colorpickertile" id='light_99FFFF'></div></td>
          <td><div class="colorpickertile" id='light_CCFFFF'></div></td>
          <td><div class="colorpickertile" id='light_CCCCFF'></div></td>
          <td><div class="colorpickertile" id='light_FFCCFF'></div></td>
        </tr>
        <tr>
          <td><div class="colorpickertile" id='light_CCCCCC'></div></td>
          <td><div class="colorpickertile" id='dark_FF6666'></div></td>
          <td><div class="colorpickertile" id='light_FF9966'></div></td>
          <td><div class="colorpickertile" id='light_FFFF66'></div></td>
          <td><div class="colorpickertile" id='light_FFFF33'></div></td>
          <td><div class="colorpickertile" id='light_66FF99'></div></td>
          <td><div class="colorpickertile" id='light_33FFFF'></div></td>
          <td><div class="colorpickertile" id='light_66FFFF'></div></td>
          <td><div class="colorpickertile" id='dark_9999FF'></div></td>
          <td><div class="colorpickertile" id='light_FF99FF'></div></td>
        </tr>
        <tr>
          <td><div class="colorpickertile" id='light_C0C0C0'></div></td>
          <td><div class="colorpickertile" id='dark_FF0000'></div></td>
          <td><div class="colorpickertile" id='dark_FF9900'></div></td>
          <td><div class="colorpickertile" id='light_FFCC66'></div></td>
          <td><div class="colorpickertile" id='light_FFFF00'></div></td>
          <td><div class="colorpickertile" id='light_33FF33'></div></td>
          <td><div class="colorpickertile" id='light_66CCCC'></div></td>
          <td><div class="colorpickertile" id='light_33CCFF'></div></td>
          <td><div class="colorpickertile" id='dark_6666CC'></div></td>
          <td><div class="colorpickertile" id='dark_CC66CC'></div></td>
        </tr>
        <tr>
          <td><div class="colorpickertile" id='dark_999999'></div></td>
          <td><div class="colorpickertile" id='dark_CC0000'></div></td>
          <td><div class="colorpickertile" id='dark_FF6600'></div></td>
          <td><div class="colorpickertile" id='light_FFCC33'></div></td>
          <td><div class="colorpickertile" id='light_FFCC00'></div></td>
          <td><div class="colorpickertile" id='dark_33CC00'></div></td>
          <td><div class="colorpickertile" id='light_00CCCC'></div></td>
          <td><div class="colorpickertile" id='dark_3366FF'></div></td>
          <td><div class="colorpickertile" id='dark_6633FF'></div></td>
          <td><div class="colorpickertile" id='dark_CC33CC'></div></td>
        </tr>
        <tr>
          <td><div class="colorpickertile" id='dark_666666'></div></td>
          <td><div class="colorpickertile" id='dark_990000'></div></td>
          <td><div class="colorpickertile" id='dark_CC6600'></div></td>
          <td><div class="colorpickertile" id='dark_CC9933'></div></td>
          <td><div class="colorpickertile" id='dark_999900'></div></td>
          <td><div class="colorpickertile" id='dark_009900'></div></td>
          <td><div class="colorpickertile" id='dark_339999'></div></td>
          <td><div class="colorpickertile" id='dark_3333FF'></div></td>
          <td><div class="colorpickertile" id='dark_6600CC'></div></td>
          <td><div class="colorpickertile" id='dark_993399'></div></td>
        </tr>
        <tr>
          <td><div class="colorpickertile" id='dark_333333'></div></td>
          <td><div class="colorpickertile" id='dark_660000'></div></td>
          <td><div class="colorpickertile" id='dark_993300'></div></td>
          <td><div class="colorpickertile" id='dark_996633'></div></td>
          <td><div class="colorpickertile" id='dark_666600'></div></td>
          <td><div class="colorpickertile" id='dark_006600'></div></td>
          <td><div class="colorpickertile" id='dark_336666'></div></td>
          <td><div class="colorpickertile" id='dark_000099'></div></td>
          <td><div class="colorpickertile" id='dark_333399'></div></td>
          <td><div class="colorpickertile" id='dark_663366'></div></td>
        </tr>
        <tr>
          <td><div class="colorpickertile" id='dark_000000'></div></td>
          <td><div class="colorpickertile" id='dark_330000'></div></td>
          <td><div class="colorpickertile" id='dark_663300'></div></td>
          <td><div class="colorpickertile" id='dark_663333'></div></td>
          <td><div class="colorpickertile" id='dark_333300'></div></td>
          <td><div class="colorpickertile" id='dark_003300'></div></td>
          <td><div class="colorpickertile" id='dark_003333'></div></td>
          <td><div class="colorpickertile" id='dark_000066'></div></td>
          <td><div class="colorpickertile" id='dark_330099'></div></td>
          <td><div class="colorpickertile" id='dark_330033'></div></td>
        </tr>
        <tr>
          <td colspan="7"><div id="colorpreview">This is a preview</div></td>
          <td colspan="3" id="cancel"><a href="javascript:cancelColors()">Cancel</a></td>
        </tr>
    </table>
</div>