/**
* Events Component for Joomla 1.0.x
*
* @version     $Id: editical.js 975 2008-02-16 14:53:20Z geraint $
* @package     Events
* @copyright   Copyright (C) 2006 JEvents Project Group
* @licence     http://www.gnu.org/copyleft/gpl.html
* @link        http://forge.joomla.org/sf/projects/jevents
*/

Date.prototype.getYMD =  function()
{
	month = "0"+(temp.getMonth()+1);
	day = "0"+temp.getDate();
	// MSIE 7 still doesn't support negative num1 in substr!!
	var result = temp.getFullYear()+"-"+month.substr(month.length-2)+"-"+day.substr(day.length-2);
	//alert(result);
	return result;
};
Date.prototype.addDays = function(days)
{
	return new Date(this.getTime() + days*24*60*60*1000);
};
Date.prototype.dateFromYMD = function(ymd){
	parts = ymd.split("-");
	//alert(parts[0]+" "+parts[1]+" "+parts[2]);
	temp = new Date(parts[0],parts[1]-1,parts[2],0,0,0,0);
	return temp;
};

function highlightElem(elem){
	elem.style.color="red";
	elem.style.fontWeight="bold";
	document.getElementById("valid_dates").value=0;
}
function normaliseElem(elem) {
	elem.style.color="";
	elem.style.fontWeight="";
	document.getElementById("valid_dates").value=1;
}

function checkTimeFormat(time){
	if (time.value.indexOf(":")>0){
		normaliseElem(time);
		return true;
	}
	else if (time.value.indexOf("-")>0){
		time.value = time.value.replace(/-/g,":");
		normaliseElem(time);
		return true;
	}
	else {
		alert("Hours and minutes must be separated by a ':' or '-'");
		highlightElem(time);
		return false;
	}
}

function checkValidTime(time){
	parts = time.value.split(":");
	if (parts.length!=2) {
		return false;
	}
	if (parseInt(parts[0],10)<0 || parseInt(parts[0],10)>=24){
		return false
	}
	if (parseInt(parts[1],10)<0 || parseInt(parts[1],10)>=60 ){
		return false;
	}
	return true;
}

function checkTime(time){
	if (!checkTimeFormat(time)){
		return false;
	}
	set12hTime(time);

	if (!checkValidTime(time)){
		alert("invalid time");
		highlightElem(time);
		return false;
	}
	else normaliseElem(time);

	
	checkEndTime();
}

/* 
* Does nothing at this stage
*/
function checkInterval() {
	
}

function set12hTime(time24h){
	if (time24h.id=="end_time"){
		time = document.getElementById("end_12h");
		pm   = document.getElementById("endPM");
		am   = document.getElementById("endAM");
	}
	else {
		time = document.getElementById("start_12h");
		pm   = document.getElementById("startPM");
		am   = document.getElementById("startAM");
	}

	parts = time24h.value.split(":");
	hour  = parseInt(parts[0], 10);
	min   = parseInt(parts[1], 10);
	if ((hour >= 12) ){
		ampm = pm;
	} else {
		ampm = am;
	}
	if (hour > 12){
		hour = hour - 12;
	}
	if (hour == 0) hour = 12;

	if (hour < 10) hour = "0"+hour;
	if (min  < 10) min  = "0"+min;
	time.value = hour+":"+min;
	ampm.checked = true;
}


function set24hTime(time12h){
	if (time12h.id=="end_12h"){
		time = document.getElementById("end_time");
		pm = document.getElementById("endPM");
	}
	else {
		time = document.getElementById("start_time");
		pm = document.getElementById("startPM");
	}
	
	if (!checkValidTime(time12h)){
		alert("invalid time");
		highlightElem(time12h);
		return false;
	}
	else {
		normaliseElem(time12h);	
		parts = time12h.value.split(":");
		hour = parseInt(parts[0],10);
		if (pm.checked) {
			if (hour < 12) {
				time.value = (hour+12)+":"+parts[1];
			} else {
				time.value = time12h.value;
			}
		}
		else {
			if (hour == 0) {
				time.value = "12:"+parts[1];
			} else {
				time.value = time12h.value;
			}
		}			
	}
	if (!checkValidTime(time)){
		alert("invalid time");
		highlightElem(time12h);
		return false;
	}
	else {
		normaliseElem(time12h);	
		return true;
	}	
}

function checkEndTime() {
	start_time = document.getElementById("start_time");
	starttimeparts = start_time.value.split(":");
	start_date = document.getElementById("publish_up");
	startdateparts = start_date.value.split("-");	
	startDate = new Date(startdateparts[0],parseInt(startdateparts[1],10)-1,startdateparts[2],starttimeparts[0],starttimeparts[1],0);
	
	end_time = document.getElementById("end_time");
	endtimeparts = end_time.value.split(":");
	end_date = document.getElementById("publish_down");
	enddateparts = end_date.value.split("-");
	endDate = new Date(enddateparts[0],parseInt(enddateparts[1],10)-1,enddateparts[2],endtimeparts[0],endtimeparts[1],0);
	//alert(endDate +" vs "+startDate);
	endfield = (document.adminForm.view12Hour.checked) ? document.getElementById("end_12h") : end_time;
		
	if (endDate>=startDate){
		normaliseElem(endfield);
		normaliseElem(end_date);
		return true;
	}
	else {
		highlightElem(end_date);
		highlightElem(endfield);
		//alert("end date and time must be after start date and time");
		return false;
	}	
}

function check12hTime(time12h){
	if (!checkTimeFormat(time12h)){
		return false;
	}
	set24hTime(time12h);
	checkEndTime();
}

function checkDates(elem){
	forceValidDate(elem);
	checkEndTime();
}

function forceValidDate(elem){
	oldDate = new Date();
	oldDate = oldDate.dateFromYMD(elem.value);
	newDate = oldDate.getYMD();
	if (newDate!=elem.value) {
		elem.value = newDate;
		alert("invalid date has been corrected - please check");
	}
}

function toggleView12Hour(){
	if (document.adminForm.view12Hour.checked) {
			document.getElementById('start_24h_area').style.display="none";
			document.getElementById('end_24h_area').style.display="none";
			document.getElementById('start_12h_area').style.display="inline";
			document.getElementById('end_12h_area').style.display="inline";
	} else {
			document.getElementById('start_24h_area').style.display="inline";
			document.getElementById('end_24h_area').style.display="inline";
			document.getElementById('start_12h_area').style.display="none";
			document.getElementById('end_12h_area').style.display="none";
	}
}
		
function toggleAMPM(elem)
{
	if (elem=="startAM" || elem=="startPM"){
		time12h = document.getElementById("start_12h");
	}
	else {
		time12h = document.getElementById("end_12h");
	}
	set24hTime(time12h);
	checkEndTime();
}

function toggleAllDayEvent()
{
	var checked = document.adminForm.allDayEvent.checked;
	var starttime = document.adminForm.start_time;
	var startdate = document.adminForm.publish_up;
	var endtime = document.adminForm.end_time;
	var enddate = document.adminForm.publish_down;
	var spm   = document.getElementById("startPM");
	var	sam   = document.getElementById("startAM");
	var epm   = document.getElementById("endPM");
	var	eam   = document.getElementById("endAM");

	if (document.adminForm.view12Hour.checked){
		hide_start = document.adminForm.start_12h;
		hide_end   = document.adminForm.end_12h;
	} else {
		hide_start = starttime;
		hide_end   = endtime;
	}

	if (checked){
		// set 24h fields	
		temp = new Date();
		temp = temp.dateFromYMD(startdate.value);
		//temp = temp.addDays(1);
		starttime.value="00:00";
		starttime.disabled=true;
		hide_start.disabled=true;
		enddate.value = temp.getYMD();
		endtime.value="23:59";
		endtime.disabled=true;
		hide_end.disabled=true;

		sam.disabled=true;
		spm.disabled=true;
		eam.disabled=true;
		epm.disabled=true;
	}
	else {
		// set 24h fields
		hide_start.disabled=false;
		starttime.value="08:00";
		starttime.disabled=false;
		hide_end.disabled=false;
		endtime.value="17:00";
		endtime.disabled=false;
		enddate.value = startdate.value;

		sam.disabled=false;
		spm.disabled=false;
		eam.disabled=false;
		epm.disabled=false;
		
	}

	if (document.adminForm.start_12h){
		// move to 12h fields
		set12hTime(starttime);
		set12hTime(endtime);
	}

}

function toggleCountUntil(cu){
	inputtypes = new Array("cu_count","cu_until");
	for (var i=0;i<inputtypes.length;i++) {
		inputtype = inputtypes[i];
		elem = document.getElementById(inputtype);
		inputs = elem.getElementsByTagName('input');
		for (var e=0;e<inputs.length;e++){
			inputelem = inputs[e];
			if (inputelem.name!="countuntil"){
				if (inputtype==cu){
					inputelem.disabled = false;
					inputelem.parentNode.style.backgroundColor="#ffffff";
				}
				else {
					inputelem.disabled = true;
					inputelem.parentNode.style.backgroundColor="#dddddd";
				}
			}
		}
	}
}

function toggleWhichBy(wb)
{
	inputtypes = new Array("byyearday","byweekno","bymonthday","bymonth","byday");
	for (var i=0;i<inputtypes.length;i++) {
		inputtype = inputtypes[i];
		elem = document.getElementById(inputtype);
		inputs = elem.getElementsByTagName('input');
		for (var e=0;e<inputs.length;e++){
			inputelem = inputs[e];
			if (inputelem.name!="whichby"){
				if (inputtype==wb){
					inputelem.disabled = false;
					inputelem.parentNode.style.backgroundColor="#ffffff";
				}
				else {
					inputelem.disabled = true;
					inputelem.parentNode.style.backgroundColor="#dddddd";
				}
			}

		}
	}
}

function toggleFreq(freq)
{
	var myDiv = document.getElementById('interval_div');
	var byyearday = document.getElementById('byyearday');
	var byweekno = document.getElementById('byweekno');
	var bymonthday = document.getElementById('bymonthday');
	var bymonth = document.getElementById('bymonth');
	var byday = document.getElementById('byday');
	var weekofmonth = document.getElementById('weekofmonth');
	var intervalLabel = document.getElementById('interval_label');
	switch (freq) {
		case "NONE":
		{
			myDiv.style.display="none";
			byyearday.style.display="none";
			bymonth.style.display="none";
			byweekno.style.display="none";
			bymonthday.style.display="none";
			byday.style.display="none";
		}
		break;
		case "YEARLY":
		{
			intervalLabel.innerHTML="years";
			myDiv.style.display="block";
			byyearday.style.display="block";
			document.getElementById('byd').checked="checked";
			toggleWhichBy("byyearday");
			bymonth.style.display="none";
			byweekno.style.display="none";
			bymonthday.style.display="none";
			byday.style.display="none";
		}
		break;
		case "MONTHLY":
		{
			intervalLabel.innerHTML="months";
			myDiv.style.display="block";
			byyearday.style.display="none";
			bymonth.style.display="none";
			byweekno.style.display="none";
			bymonthday.style.display="block";
			document.getElementById('bmd').checked="checked";
			toggleWhichBy("bymonthday");
			byday.style.display="block";
			weekofmonth.style.display="block";
			toggleWeekNums(true);
		}
		break;
		case "WEEKLY":
		{
			intervalLabel.innerHTML="weeks";
			myDiv.style.display="block";
			byyearday.style.display="none";
			bymonth.style.display="none";
			byweekno.style.display="none";
			bymonthday.style.display="none";
			byday.style.display="block";
			document.getElementById('bd').checked="checked";
			toggleWhichBy("byday");
			weekofmonth.style.display="none";
			toggleWeekNums(false);
		}
		break;
		case "DAILY":
		{
			intervalLabel.innerHTML="days";
			myDiv.style.display="block";
			byyearday.style.display="none";
			bymonth.style.display="none";
			byweekno.style.display="none";
			bymonthday.style.display="none";
			byday.style.display="none";
			document.getElementById('bd').checked="checked";
			//toggleWhichBy("byday");
			weekofmonth.style.display="none";
		}
		break;
	}
}

function fixRepeatDates(){
	start_time = document.getElementById("start_time");
	starttimeparts = start_time.value.split(":");
	start_date = document.getElementById("publish_up");
	startdateparts = start_date.value.split("-");	
	startDate = new Date(startdateparts[0],parseInt(startdateparts[1],10)-1,startdateparts[2],0,0,0,0);
	//alert(startDate);
	bmd = document.adminForm.bymonthday;
	if (bmd.value.indexOf(",")<=0) {
		bmd.value = parseInt(startdateparts[2],10);
	}
	
	byd = document.adminForm.byyearday;
	if (byd.value.indexOf(",")<=0) {
		yearStart = new Date(startdateparts[0],0,0,0,0,0,0);
		days = ((startDate-yearStart)/(24*60*60*1000));
		byd.value = parseInt(days,10);
	}
	
	bd = document.adminForm["weekdays[]"];
	for(var day=0;day<bd.length;day++){
		bd[day].checked=false;
	}
	bd[startDate.getDay()].checked=true;

	unt = document.getElementById('until');
	unt.value = start_date.value;
	
}

function toggleWeekNums(newstate){
	wn = document.adminForm["weeknums[]"];
	for(var w=0;w<wn.length;w++){
		wn[w].checked=newstate;
	}
}