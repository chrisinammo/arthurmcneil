/**
* @version		$Id: menu.js 9765 2007-12-30 08:21:02Z ircmaxell $
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/**
 * JMenu javascript behavior
 *
 * @author		Johan Janssens <johan.janssens@joomla.org>
 * @package		Joomla
 * @since		1.5
 * @version     1.0
 */
var JMenu = new Class({
	initialize: function(el)
	{
		var elements = $ES('li', el);
		var nested = null
		for (var i=0; i<elements.length; i++)
		{
			var element = elements[i];

			element.addEvent('mouseover', function(){ this.addClass('hover'); });
			element.addEvent('mouseout', function(){ this.removeClass('hover'); });

			//find nested UL
			nested = $E('ul', element);
			if(!nested) {
				continue;
			}

			//declare width
			var offsetWidth  = 0;

			//find longest child
			for (k=0; k < nested.childNodes.length; k++) {
				var node  = nested.childNodes[k]
				if (node.nodeName == "LI")
					offsetWidth = (offsetWidth >= node.offsetWidth) ? offsetWidth :  node.offsetWidth;
			}

			//match longest child
			for (l=0; l < nested.childNodes.length; l++) {
				var node = nested.childNodes[l]
				if (node.nodeName == "LI") {
					$(node).setStyle('width', offsetWidth+'px');
				}
			}

			$(nested).setStyle('width', offsetWidth+'px');
		}
	}
});