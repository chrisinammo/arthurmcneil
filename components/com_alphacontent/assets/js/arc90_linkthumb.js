/*

Link Thumbnail v2.0.1
(c) Arc90, Inc.

http://www.arc90.com
http://lab.arc90.com

Licensed under : Creative Commons Attribution 2.5 http://creativecommons.org/licenses/by/2.5/

*/

/* Globals */
var arc90_navigator = navigator.userAgent.toLowerCase();
var arc90_isOpera = arc90_navigator.indexOf('opera') >= 0? true: false;
var arc90_isIE = arc90_navigator.indexOf('msie') >= 0 && !arc90_isOpera? true: false;
var arc90_isSafari = arc90_navigator.indexOf('safari') >= 0 || arc90_navigator.indexOf('khtml') >= 0? true: false;
var arc90_linkThumbUseClassName = true;

var arc90_linksources = [['http://images.websnapr.com/?size=s&url=', 160, 120],
						  ['http://thumbnails.alexa.com/image_server.cgi?size=small&url=', 160, 120],
						  ['http://msnsearch.srv.girafa.com/srv/i?s=MSNSEARCH&r=', 160, 120]];
var arc90_linksource = 0;

function arc90_linkpic() {
	var b = document.domain;
	var A = document.getElementsByTagName('A');

	for (var i = 0, l = A.length, c = 0; i < l; i++) {
		var a = A[i];
		var h = a.href;
		if ((b == '' || h.indexOf(b) < 0) && h.indexOf('://') > 0 && ((arc90_linkThumbUseClassName && a.className.indexOf('linkthumb') >= 0) || !arc90_linkThumbUseClassName)) {
			try {
				a.className += ' arc90_linkpicLNK';
				if (a.id == '')
					a.id = 'arc90_link'+ i;
				var d = arc90_newNode('div', 'arc90_linkpic'+ i, 'arc90_linkpic');
				var m = arc90_newNode('img', '', 'arc90_linkpicIMG');
				// var n = h.replace(/[^:]*:\/\/([^:\/]*)(:{0,1}\/{1}.*)/, '$1');
				var n = escape(h);
				m.src = arc90_linksources[arc90_linksource][0] + n;
				m.width = arc90_linksources[arc90_linksource][1];
				m.height = arc90_linksources[arc90_linksource][2];
				m.style.width = arc90_linksources[arc90_linksource][1] +'px';
				m.style.height = arc90_linksources[arc90_linksource][2] +'px';
				m.border = 0;
				m.alt = '[Picture of '+ n +']';
				m.title = a.title;
				d.style.zIndex = '9999';
				d.style.position = 'absolute';

				d.appendChild(m);
				document.body.appendChild(d);

				arc90_addEvent(a, 'mouseover',	function () { arc90_showThumb(arc90_isIE? event.srcElement.id: this.id); } );
				arc90_addEvent(a, 'mouseout',	function () { arc90_hideThumb(arc90_isIE? event.srcElement.id: this.id); } );
			} catch(err) {
				a = null;
			}
		}
	}
}

function arc90_showThumb(id) {
	try {
		var k = document.getElementById(id);
		var top = arc90_findDimension(k, 'Top');
		var lnh = arc90_getStyle(k, 'lineHeight', 'font-size');
		var default_height = 20;

		if (!lnh)
			lnh = default_height;
		else if (lnh.indexOf('pt') > 0)
			lnh = parseInt(lnh) * 1.3;
		else if (lnh.indexOf('em') > 0)
			lnh = parseInt(lnh) * 10;
		else if (lnh.indexOf('px') > 0)
			lnh = parseInt(lnh);
		else if (arc90_isNumeric(lnh))
			lnh = parseInt(arc90_isIE? lnh * 10: arc90_isOpera? lnh/100: lnh); // IE brings back em units
		else
			lnh = default_height;
		var lft = arc90_findDimension(k, 'Left');
		var nlf = arc90_findMatchingDimensionViaNodes(k, 'Left', lft, 0);
		var pid = id.replace(/arc90_link/, 'arc90_linkpic');
		var p = document.getElementById(pid);
		p.style.display = 'block';
		p.style.top = (top + (arc90_isIE && nlf? lnh + 8: 4) + lnh) + 'px';
		p.style.left = lft + 'px';
	} catch(err) { return; }
}

function arc90_hideThumb(id) {
	try {
		var k = document.getElementById(id);
		var pid = id.replace(/arc90_link/, 'arc90_linkpic');
		var p = document.getElementById(pid);
		p.style.display = 'none';
	} catch(err) { return; }
}

function arc90_getStyle(obj, styleIE, styleMoz) {
	if (arc90_isString(obj)) obj = document.getElementById(obj);
	if (obj.currentStyle)
		return obj.currentStyle[styleIE];
	else if (window.getComputedStyle)
		return document.defaultView.getComputedStyle(obj, null).getPropertyValue(styleMoz);
}

function arc90_findDimension(obj, pType) {
	if (arc90_isString(obj)) obj = document.getElementById(obj);
	var cur = 0;
	if(obj.offsetParent)
		while(obj.offsetParent) {
			switch(pType.toLowerCase()) {
			case "width":
				cur += obj.offsetWidth; break;
			case "height":
				cur += obj.offsetHeight; break;
			case "top":
				cur += obj.offsetTop; break;
			case "left":
				cur += obj.offsetLeft; break;
			}
			obj = obj.offsetParent;
		}
	return cur;
}

function arc90_findMatchingDimensionViaNodes(obj, pType, matching, notMatching) {
	var cur = 0, counter = 0;
	notMatching = notMatching == null? -1: notMatching;
	if(obj.parentNode)
		while(obj.parentNode) {
			cur = arc90_findDimension(obj, pType);
			if (cur == matching && cur != notMatching)
				counter++;
			if (counter >= 2) return true;
			obj = obj.parentNode;
		}
	return false;
}

/* Events */
function arc90_isString(o) { return (typeof(o) == "string"); }

function arc90_isNumeric(o) { return (typeof(parseFloat(o).toString() == 'NaN'? 'xxx': parseFloat(o)) == "number" && parseFloat(o) != ''); }

function arc90_addEvent(e, meth, func, cap) {
	if (arc90_isString(e))	e = document.getElementById(e);

	if (e.addEventListener){
		e.addEventListener(meth, func, cap);
    	return true;
	}	else if (e.attachEvent)
		return e.attachEvent("on"+ meth, func);
	return false;
}

/* Nodes */
function arc90_newNode(t, i, s, x, c) {
	var node = document.createElement(t);
	if (x != null && x != '') {
		var n = document.createTextNode(x);
		node.appendChild(n);
	}
	if (i != null && i != '')
		node.id = i;
	if (s != null && s != '')
		node.className = s;
	if (c != null && c != '')
		node.appendChild(c);
	return node;
}

/* Onload */
arc90_addEvent(window, 'load', arc90_linkpic);
