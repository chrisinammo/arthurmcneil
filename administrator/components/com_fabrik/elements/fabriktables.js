var fabriktablesElement = new Class({
	
	initialize: function( el ){
		this.el = $(el);
		this.options = Object.extend({
		conn:null
		}, arguments[1] || {});
		this.updateMeEvent = this.updateMe.bindAsEventListener(this);
		$(this.options.conn).addEvent('change', this.updateMeEvent );
		//see if there is a connection selected
		var v = $(this.options.conn).getValue();
		if(v != '' && v != -1){
			this.updateMe();
		}
	},
	
	updateMe: function(e){
		if(e){
			new Event(e).stop();
		}
		
		var cid = $(this.options.conn).getValue();
		var url = this.options.livesite + '/index.php?option=com_fabrik&format=raw&task=elementPluginAjax&g=visualization&plugin=chart&method=ajax_tables&cid=' + cid;
		var myAjax = new Ajax(url, { method:'post', 
			onComplete: function(r){
				var opts = eval(r);
				this.el.empty();
				opts.each( function(opt){
					var o = {'value':opt.value};
					if(opt.value == this.options.value){
						o.selected = 'selected';
					}
					new Element('option', o).appendText(opt.label).injectInside(this.el);
				}.bind(this));
			}.bind(this)
		}).request();
	}
});