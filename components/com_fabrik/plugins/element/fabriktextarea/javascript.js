var fbTextarea = fbElement.extend({
	initialize: function(element, options) {
		this.plugin = 'fabriktextarea';
		this.elementtype_id = 'fabrikDisplayText';
		this.setOptions(element, options);
		if($(element + '_counter')){
			this.warningFX = $(element + '_counter').effects({duration: 1000, transition: Fx.Transitions.Quart.easeOut});
			this.origCol = $(element + '_counter').getStyle('color');
			if (this.options.wysiwyg) {
				this.container =  tinyMCE.getInstanceById(element).getDoc();
				var eventHandler = this.informKeyPress.bindAsEventListener(this);
				tinyMCE.addEvent(this.container,"keydown",eventHandler);
			}else{
				this.container = $(element); 
				this.container.addEvent('keydown', function(e){
					this.informKeyPress();
				}.bind(this))
			}
		}
	},
	
	getContent:function()
	{
		if (this.options.wysiwyg) {
			return tinyMCE.getContent().replace(/<\/?[^>]+(>|$)/g, "");
		}else{
			return this.container.value;
		}
	},
	
	setContent: function(c)
	{
		if (this.options.wysiwyg) {
			return tinyMCE.setContent(c);
		}else{
			this.container.value = c;
		}
	},
	
	informKeyPress: function()
	{
		var content = this.getContent();
		var charsLeft =  this.options.max - (content.length + 1);
		if(charsLeft < 0){
			this.setContent( content.substring(0,this.options.max) )
			charsLeft = 0;
			this.warningFX.start({'opacity':0, 'color':'#FF0000'}).chain(function(){
				this.start({'opacity':1, 'color':'#FF0000'}).chain(function(){
				this.start( {'opacity':0,'color':this.origCol}).chain(function(){
					this.start({'opacity':1})
				})
			})
		});
		}
		$(this.options.element + '_counter').setHTML(charsLeft);
	},
	
	update: function(val){
		if (!this.options.editable) {
			this.element.innerHTML = val;
			return;
		}
		this.setContent(val);
	}
});