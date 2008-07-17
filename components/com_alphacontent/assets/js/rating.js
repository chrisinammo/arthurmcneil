/*
Page:           rating.js
Created:        Aug 2006
Last Mod:       Mar 11 2007
Handles actions and requests for rating bars.	
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
Licensed under a Creative Commons Attribution 3.0 License.
http://creativecommons.org/licenses/by/3.0/
See readme.txt for full credit details.
--------------------------------------------------------- */

var xmlhttp
	/*@cc_on @*/
	/*@if (@_jscript_version >= 5)
	  try {
	  xmlhttp=new ActiveXObject("Msxml2.XMLHTTP")
	 } catch (e) {
	  try {
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")
	  } catch (E) {
	   xmlhttp=false
	  }
	 }
	@else
	 xmlhttp=false
	@end @*/
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	 try {
	  xmlhttp = new XMLHttpRequest();
	 } catch (e) {
	  xmlhttp=false
	 }
	}
	function myXMLHttpRequest() {
	  var xmlhttplocal;
	  try {
	    xmlhttplocal= new ActiveXObject("Msxml2.XMLHTTP")
	 } catch (e) {
	  try {
	    xmlhttplocal= new ActiveXObject("Microsoft.XMLHTTP")
	  } catch (E) {
	    xmlhttplocal=false;
	  }
	 }

	if (!xmlhttplocal && typeof XMLHttpRequest!='undefined') {
	 try {
	  var xmlhttplocal = new XMLHttpRequest();
	 } catch (e) {
	  var xmlhttplocal=false;
	  alert('couldn\'t create xmlhttp object');
	 }
	}
	return(xmlhttplocal);
}

function sndReq(vote,id_num,ip_num,units,thewidth,thecomponent,thelang,theuser,sef,m,cid,rid,infos,v) {
	var theUL = document.getElementById('unit_ul'+id_num); // the UL
	
	// switch UL with a loading div
	theUL.innerHTML = '<div class="loading"></div>';

    xmlhttp.open('get', sef+'/components/com_alphacontent/assets/includes/alphacontent.rpc.php?j='+vote+'&q='+id_num+'&t='+ip_num+'&c='+units+'&u='+thewidth+'&p='+thecomponent+'&lang='+thelang+'&user='+theuser+'&m='+m+'&cid='+cid+'&rid='+rid+'&infos='+infos+'&v='+v);
	xmlhttp.setRequestHeader("Cache-Control","no-cache");
    xmlhttp.onreadystatechange = handleResponse;
    xmlhttp.send(null);
}

function handleResponse() {	
  if(xmlhttp.readyState == 4){
	  
	  //alert(document.location.href);
		if (xmlhttp.status == 200){
			
        var response = xmlhttp.responseText;
        var update = new Array();
		
			if(response.indexOf('|') != -1) {				
				update = response.split('|');
				changeText(update[0], update[1]);
				// if module on the same page, refresh module too...
				changeText(update[0]+'moduleATR', update[1]);
			}
		}
    }
}

function changeText( div2show, text ) {
    // Detect Browser
    var IE = (document.all) ? 1 : 0;
    var DOM = 0; 
    if (parseInt(navigator.appVersion) >=5) {DOM=1};
	
    // Grab the content from the requested "div" and show it in the "container"
    if (DOM) {
        var viewer = document.getElementById(div2show);
        viewer.innerHTML = text;
    }  else if(IE) {
        document.all[div2show].innerHTML = text;
    }
}

/* =============================================================== */
var ratingAction = {
		'a.rater' : function(element){
			element.onclick = function(){

				var parameterString = this.href.replace(/.*\?(.*)/, "$1"); // onclick="sndReq('j=1&q=2&t=127.0.0.1&c=5');
				var parameterTokens = parameterString.split("&"); // onclick="sndReq('j=1,q=2,t=127.0.0.1,c=5');
				var parameterList = new Array();
	
				for (j = 0; j < parameterTokens.length; j++) {
					var parameterName = parameterTokens[j].replace(/(.*)=.*/, "$1"); // j
					var parameterValue = parameterTokens[j].replace(/.*=(.*)/, "$1"); // 1
					parameterList[parameterName] = parameterValue;
				}
				var theratingID = parameterList['q'];
				var theVote     = parameterList['j'];
				var theuserIP   = parameterList['t'];
				var theunits    = parameterList['c'];
				var thewidth    = parameterList['u'];
				var thecomponent= parameterList['p'];
				var thelang     = parameterList['lang'];
				var theuser     = parameterList['user'];
				var sef         = parameterList['s'];
				var m	        = parameterList['m'];
				var cid         = parameterList['cid'];
				var rid         = parameterList['rid'];
				var infos       = parameterList['infos'];
				var v       	= parameterList['v'];
				
				sndReq(theVote,theratingID,theuserIP,theunits,thewidth,thecomponent,thelang,theuser,sef,m,cid,rid,infos,v); return false;
			}
		}
		
	};
Behaviour.register(ratingAction);
