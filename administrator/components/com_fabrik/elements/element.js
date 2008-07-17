var fabrikelementElement = new Class({
	
	initialize: function( el ){
		this.el = $(el);
		this.options = Object.extend({
			'plugin':'chart'
		}, arguments[1] || {});
		this.updateMeEvent = this.updateMe.bindAsEventListener(this);
		$(this.options.conn).addEvent('change', this.updateMeEvent );
		$(this.options.table).addEvent('change', this.updateMeEvent );
			
		//see if there is a connection selected
		var v = $(this.options.conn).getValue();
		if(v != '' && v != -1){
			this.periodical = this.updateMe.periodical(500, this);
		}
	},
	
	updateMe: function(e){
		if(e){
			new Event(e).stop();
		}
		var cid = $(this.options.conn).getValue();
		var table = $(this.options.table).getValue();
		//keep repeating the perioical untill the table drop down is completed
		if(!table){
			return;
		}
		$clear(this.periodical);
		var url = this.options.livesite + '/index.php?option=com_fabrik&format=raw&task=elementPluginAjax&g=visualization&plugin=' + this.options.plugin + '&method=ajax_fields&k=2&t=' + table + 'cid=' + cid;
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