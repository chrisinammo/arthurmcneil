//PopupWin = new Class({
var PopupWin = {
	initialize: function(content, activator) {
		//offset: -125,
		this.options = Object.extend({
			offset: 0,
			delay: 500,
			winFX: {
				duration: 350,
				wait: false
			},
			opacityFX: {
				wait: false	
			}
		}, arguments[2] || {});	
		this.content = $(content);
		this.build();
		this.activator = $(activator); //roll over image 
		this.container = this.activator;
		if(!this.content || !this.activator) return;
		this.init();
		this.container.addEvents({
			'mouseenter': this.show.bind(this),
			'mouseleave': this.hide.bind(this)
		});
		
		return this;
	},
	
	build: function() {
		this.overlay = new Element('div', {
			id: 'sbox-overlay',
			styles: {
				display: 'none',
				zIndex: this.options.zIndex
			}
		});
		this.content = new Element('div', {
			id: 'sbox-content'
		});
		this.btnClose = new Element('a', {
			id: 'sbox-btn-close',
			href: '#'
		});
		this.window = new Element('div', {
			id: 'sbox-window',
			styles: {
				display: 'none',
				zIndex: this.options.zIndex + 2
			}
		}).adopt(this.btnClose, this.content);

		if (!window.ie6) {
			this.overlay.setStyles({
				position: 'fixed',
				top: 0,
				left: 0
			});
			this.window.setStyles({
				position: 'fixed',
				top: '50%',
				left: '50%'
			});
		} else {
			this.overlay.style.setExpression('marginTop', 'document.documentElement.scrollTop + "px"');
			this.window.style.setExpression('marginTop', '0 - parseInt(this.offsetHeight / 2) + document.documentElement.scrollTop + "px"');

			this.overlay.setStyles({
				position: 'absolute',
				top: '0%',
				left: '0%'
				//,marginTop: "expression(document.documentElement.scrollTop + 'px')"
			});

			this.window.setStyles({
				position: 'absolute',
				top: '0%',
				left: '0%'
				//,marginTop: "(expression(0 - parseInt(this.offsetHeight / 2) + document.documentElement.scrollTop + 'px')"
			});
		}

		$(document.body).adopt(this.overlay, this.window);

		this.fx = {
			overlay: this.overlay.effect('opacity', {
				duration: this.options.fxOverlayDuration,
				wait: false}).set(0),
			window: this.window.effects({
				duration: this.options.fxResizeDuration,
				wait: false}),
			content: this.content.effect('opacity', {
				duration: this.options.fxContentDuration,
				wait: false}).set(0)
		};
	},

	fromElement: function(el, options) {
		this.initialize();
		this.element = $(el);
		if (this.element && this.element.rel) options = $merge(options || {}, Json.evaluate(this.element.rel));
		this.setOptions(this.presets, options);
		this.assignOptions();
		this.url = (this.element ? (this.options.url || this.element.href) : el) || '';

		if (this.options.handler) {
			var handler = this.options.handler;
			return this.setContent(handler, this.parsers[handler].call(this, true));
		}
		var res = false;
		for (var key in this.parsers) {
			if ((res = this.parsers[key].call(this))) return this.setContent(key, res);
		}
		return this;
	},
	
	init: function(){
		this.win = new Element('div', {'class': 'popupWin', 'styles':{'position':'absolute'}}).inject(this.container);
		this.win.adopt(this.content);
		this.pos();
		this.activatorFx = this.activator.effect('opacity', this.options.opacityFX);
	},
	
	pos: function(){
		if(this.activator){
			var pos2 = this.activator.getCoordinates();
			this.startPos = -0.75 * this.win.offsetWidth + pos2.left + this.options.offset;
			this.middlePos = -this.win.offsetWidth + pos2.left + this.options.offset;
			this.finishPos = -1.25 * this.win.offsetWidth + pos2.left + this.options.offset;
			this.winFx = this.win.effects(this.options.winFX);
			this.win.setStyles({
				opacity: 0,
				left: this.startPos,
				top: pos2.top
			});
		}
	},
	
	show: function(){
		this.pos();
		if(this.timer) $clear(this.timer);
		this.effStart = $merge({
			left: this.middlePos
		}, !(true || Client.Engine.webkit) ? {} : {
			opacity: 1
		});
		this.winFx.stop().start(this.effStart).clearChain();
	},
	
	hide: function(){
		this.effStop = $merge({
			left: this.finishPos
		}, !(true || Client.Engine.webkit) ? {} : {
			opacity: 0
		});
		
		this.timer = (function(){
			this.winFx.start(this.effStop).chain(function(){
				this.win.setStyles({
					'left': this.startPos,
					'opacity': 0
				});
			}.bind(this));
		}).delay(this.options.delay, this);
	},
	
	assignOptions: function() {
		this.overlay.setProperty('class', this.options.classOverlay);
		this.window.setProperty('class', this.options.classWindow);
	},
	extend: $extend
};

PopupWin.extend(Events.prototype);
PopupWin.extend(Options.prototype);
PopupWin.extend(Chain.prototype);