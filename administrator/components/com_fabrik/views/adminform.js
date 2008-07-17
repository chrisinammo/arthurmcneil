fabrikAdminForm = new Class({
	initialize:function(plugins){
		this.plugins = plugins;
		this.counter = 0;
		this.translate = Object.extend({
			'action':'Acton',
			'do':'Do ',
			'del':'Delete',
			'in':' in ',
			'on':' on ',
			'options':'Options',
			'please_select': 'Please select'
		}, arguments[1] || {});
		
		this.deletePluginClick = this.deletePlugin.bindAsEventListener(this);
		this.opts = {};
		this.opts.actions = [{'value':'front','label':'Front end'},{'value':'back','label':'Back end'},{'value':'both','label':'Both'}];
		this.opts.when = [{'value':'new','label':'New'}, {'value':'edit','label':'Edit'},{'value':'both','label':'Both'}]
		this.selPlugins = this._makeSel('inputbox elementtype', 'params[plugin_events][]', this.plugins, ''); 
		this.watchAdd();
	},
	
	_makeSel: function(c, name, pairs, sel){
		var opts = [];
		opts.push(new Element('option', {'value':''}).appendText(this.translate.please_select) )
		pairs.each(function(pair){
			if(pair.value == sel){
				opts.push(new Element('option', {'value':pair.value, 'selected':'selected'}).appendText(pair.label) )
			}else{
				opts.push(new Element('option', {'value':pair.value}).appendText(pair.label) )
			}
		})
		return new Element('select', {'class':c,'name':name}).adopt(opts);
	},
	
	addPlugin: function(o){
		this.plugins.push(o);
	},
	
	watchAdd: function(){
		$('addAction').addEvent('click', function(e){
			new Event(e).stop();
			this.addAction('', '', '', '');
		}.bind(this))
	},
	
	watchDelete: function(){
		var b =  $ES('#formActions .delete');
		b.each(function(c){
			c.removeEvents('click');
		})
		b.each(function(c){
			c.addEvent('click', this.deletePluginClick);
		}.bind(this))
	},
	
	addAction: function(pluginHTML, plugin, loc, when){
		var td = new Element('td');
		td.innerHTML = pluginHTML;
		var td = new Element('td');
		var str  = '';
		this.plugins.each(function(aPlugin){
			fconsole(aPlugin);
			if(aPlugin.value == plugin){
				str += pluginHTML;
			}else{
				str += aPlugin.html;
			}	
		}.bind(this));
		td.innerHTML = str;
		var display =  'block';
		
			var c = new Element('div', {'class':'actionContainer'}).adopt(
			new Element('table', {'class':'adminform','id':'formAction_' + this.counter, 'styles':{'display':display}}).adopt(
			new Element('tbody').adopt(
				[
					new Element('tr').adopt(
						[
							new Element('td').appendText(this.translate.action),
							new Element('td').appendText(this.translate['do'] + ' ').adopt(
									this._makeSel('inputbox elementtype', 'params[plugin][]', this.plugins, plugin)).appendText(' ' + this.translate['in'] + ' '
								).adopt(
									this._makeSel('inputbox elementtype', 'params[plugin_locations][]', this.opts.actions, loc)).appendText(' ' + this.translate['on'] + ' '
								).adopt(
									this._makeSel('inputbox events', 'params[plugin_events][]', this.opts.when, when)
								)
						]
					),
					new Element('tr').adopt(
					[
						new Element('td').appendText(this.translate.options),
						td
					]),
					new Element('tr').adopt(
						new Element('td', {'colspan':'2'}).adopt(
							new Element('a', {'href':'#', 'class':'delete removeButton'
							}).appendText(this.translate.del)
						)
					)
				]
			))
		);
		
		c.injectInside($('formActions'));
		
		// show the active plugin 
		var activePlugin = $E(' #formAction_' + this.counter + ' .page-' + plugin);
		if(activePlugin){
			activePlugin.setStyle('display','block');	
		}
		
		//watch the drop down
		$E('#formAction_' + this.counter + ' .elementtype').addEvent('change', function(e){
			e = new Event(e);
			var id = $(e.target).up(3).id.replace('formAction_', '');
			$$('#formAction_' + id + ' .elementSettings').each(function(d){
				d.style.display = 'none'; 
			});
			var s = e.target.getValue();
			if(s != this.translate.please_select){
				$E('#formAction_' + id + ' .page-' + s).style.display ='block'; 
			}
			e.stop();
		}.bind(this));
		this.watchDelete();
		
		//show any tips 
		var myTips = new Tips($$('.hasTip'),{}); 
		this.counter ++;
		
	},
	
	deletePlugin: function(e){
		e = new Event(e);
		e.stop();
		$(e.target).up(3).remove();
		this.counter --;
	}
	
});