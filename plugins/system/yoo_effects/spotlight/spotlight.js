
/* (C) 2008 YOOtheme.com */

var YOOSpotlight = new Class({

	initialize: function(element, options) {	
		this.setOptions({
			duration: 600,
			transition: Fx.Transitions.quadInOut,
			wait: false
		}, options);
		
		$$(element).each(function(el, i){
			if ((el.getTag() == 'div' || el.getTag() == 'span') && el.getStyle('background-image') != 'none') {
				this.createOver(el, i);				
			}
		}.bind(this));
	},
		
	createOver: function(el, i){
		var image = el.getStyle('background-image').replace(/^(\S+)\.(gif|jpg|jpeg|png)/, "$1_spotlight.$2");
		var overlay = new Element(el.getTag(), { 'styles': el.getStyles('width','height') });
		var fxs = new Fx.Styles(overlay, this.options);
		
		overlay.setStyles({ 'display': 'block', 'background-image': image, 'opacity': 0 });
		overlay.injectInside(el);

		el.addEvent('mouseenter', function(e){
			fxs.start({ 'opacity': 1 });
		}.bind(this));
		el.addEvent('mouseleave', function(e){
			fxs.start({ 'opacity': 0 });
		}.bind(this));
	}	
	
});

YOOSpotlight.implement(new Options);

/* Add on window load */
window.addEvent('load', function() { new YOOSpotlight('div.spotlight, span.spotlight'); });