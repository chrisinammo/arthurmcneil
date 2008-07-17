var adminVisualizationChart = new Class({
	
	initialize: function(){
		this.options = Object.extend({
		}, arguments[0] || {});
		this.updateFieldsEvent = this.updateFields.bindAsEventListener(this);
		this.addRowEvent = this.addRow.bindAsEventListener(this);
		$('paramschart_table').addEvent('change', this.updateFieldsEvent);
		this.watchDelete();
		$('chart_addElement').addEvent('click', this.addRowEvent);
		for(var i=1;i<this.options.elements.length;i++){
			this.addRow();
		}
		this.periodical = this.updateFields.periodical(100, this);
	},
	
	updateValues: function(){
		$$('.chart_addElementtable').each(function(t, x){
			t.getElement('select').getElements('option').each(function(opt, y){
				if(opt.value == this.options.elements[x]){
					t.getElement('select').selectedIndex = y;
				}
			}.bind(this));
			var fields = t.getElements('input'); 
			fields[0].value = this.options.axis_labels[x];
			fields[1].value = this.options.colours[x];
		}.bind(this))		
	},
	
	addRow: function(e){
		var t = $$('.chart_addElementtable').getLast();
		t.clone().injectAfter(t);
		if(e){
			new Event(e).stop();	
		}
		this.watchDelete();
		this.updateValues();
	},
	
	watchDelete: function(){
		$$('.chart_deleteElementtable').removeEvents();
		$$('.chart_deleteElementtable').show();
		$E('.chart_deleteElementtable').hide();
		$$('.chart_deleteElementtable').addEvent('click', function(event){
			var e = new Event(event);
			if($$('.chart_deleteElementtable').length > 1){
				$(e.target).findUp('tr').remove();
				this.watchDelete();
			}
			e.stop();
		}.bind(this));
	},
	
	updateFields: function(e){
		var table = $('paramschart_table').getValue();
		if(table != ''){
			$clear(this.periodical);
			$$('.'+this.options.targetClass).empty();
			var url = this.options.livesite + '/index.php?option=com_fabrik&format=raw&task=elementPluginAjax&g=visualization&plugin=chart&method=ajax_fields&k=2&t=' + table;
			var myAjax = new Ajax(url, { method:'post', 
				onComplete: function(r){
					var opts = eval(r);
					
					opts.each( function(opt, x){
						var o = {'value':opt.value};
						if(opt.value == this.options.value){
							o.selected = 'selected';
						}
						$$('.'+this.options.targetClass).each(function(selList){
							var option = new Element('option', o).appendText(opt.label); 
							option.injectInside(selList);	
						})
					}.bind(this));
					this.updateValues();
				}.bind(this)
			}).request();
			if(e){
				new Event(e).stop();
			}
		}
	}
})