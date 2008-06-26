/**
* Events Component for Joomla 1.0.x
*
* @version     $Id: view_detail.js 916 2008-01-03 13:43:27Z geraint $
* @package     Events
* @copyright   Copyright (C) 2006 JEvents Project Group
* @licence     http://www.gnu.org/copyleft/gpl.html
* @link        http://forge.joomla.org/sf/projects/jevents
*/

var myFaderTimeout=null;
var interval=10000;
if (myFaderTimeout) clearTimeout(myFaderTimeout);

var opacities = new Array();
var increments = 10;
var pause = 50;
var currentOpacity = 0;

for (var i=0;i<=increments ;i++){
	opacities[i] = (i*1.0)/(increments*1.0);
}

function closeAllDialogs(){
	currentOpacity=0;
	if (myFaderTimeout) clearTimeout(myFaderTimeout);
	var myDiv = document.getElementById("action_dialog");
	if (myDiv) myDiv.style.visibility="hidden";
	var myDiv = document.getElementById("ical_dialog");
	if (myDiv) myDiv.style.visibility="hidden";	
}

function clickEditButton(){
	closeAllDialogs();
	if (currentOpacity<0) currentOpacity = 0;
	fadeIn("action_dialog");
}

function closedialog() {
	if (currentOpacity>opacities.length) currentOpacity =opacities.length;
	fadeOut("action_dialog");
}

function clickIcalButton(){
	closeAllDialogs();
	if (currentOpacity<0) currentOpacity = 0;
	fadeIn("ical_dialog");
}

function closeical() {
	if (currentOpacity>opacities.length) currentOpacity =opacities.length;
	fadeOut("ical_dialog");
}

function fadeIn(dlg) {
	var myDiv = document.getElementById(dlg);
	currentOpacity++;
	if (currentOpacity>=opacities.length){
		if (myFaderTimeout) clearTimeout(myFaderTimeout);
	}
	else {
		//window.status=opacities[currentOpacity];
		myDiv.style.opacity=opacities[currentOpacity];
		myDiv.style.filter="alpha(opacity="+(100*opacities[currentOpacity])+")";
		myDiv.style.visibility="visible";	
		if (myFaderTimeout) clearTimeout(myFaderTimeout);
		myFaderTimeout = setTimeout("fadeIn('"+dlg+"')",pause);
	}
}

function fadeOut(dlg) {
	var myDiv = document.getElementById(dlg);
	currentOpacity--;
	if (currentOpacity<=0){
		if (myFaderTimeout) clearTimeout(myFaderTimeout);
		myDiv.style.visibility="hidden";
	}
	else {
		myDiv.style.opacity=opacities[currentOpacity];
		//window.status = opacities[currentOpacity];
		myDiv.style.filter="alpha(opacity="+(100*opacities[currentOpacity])+")";
		if (myFaderTimeout) clearTimeout(myFaderTimeout);
		myFaderTimeout = setTimeout("fadeOut('"+dlg+"')",pause);
	}
}
