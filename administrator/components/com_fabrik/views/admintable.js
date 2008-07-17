

///////////////////////////////////////////////////
//todo: this is similar to the form admin manager class - can we refractor somehow?

var TablePluginManager = new Class({
	initialize: function(plugins){
		this.counter = 0;
		this.plugins = plugins;
		this.translate = Object.extend({
			'action':'Acton',
			'do':'Do ',
			'del':'Delete',
			'in':' in ',
			'on':' on ',
			'options':'Options',
			'please_select': 'Please select'
		}, arguments[1] || {});
		this.watchAdd();
		this.deletePluginClick = this.deletePlugin.bindAsEventListener(this);
	},
	
	_makeSel: function(c, name, pairs, sel){
		var opts = [];
		opts.push(new Element('option', {'value':''}).appendText(this.translate.please_select) );
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
		$('addPlugin').addEvent('click', function(e){
			new Event(e).stop();
			this.addAction('', '', '', '');
		}.bind(this))
	},
	
	watchDelete: function(){
		var b =  $ES('#plugins .delete');
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
							new Element('td').adopt(
							this._makeSel('inputbox elementtype', 'params[plugin][]', this.plugins, plugin))
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
		c.injectInside($('plugins'));
		
		// show the active plugin 
		var activePlugin = $E(' #formAction_' + this.counter + ' .page-' + plugin);
		if(activePlugin){
			activePlugin.setStyle('display','block');	
		}
		
		//watch the drop down
		$E('#formAction_' + this.counter + ' .elementtype').addEvent('change', function(e){
			e = new Event(e);
			var id = $(e.target).up(2).id.replace('formAction_', '');
			$$('#formAction_' + id + ' .elementSettings').each(function(d){
				d.style.display = 'none'; 
			});
			var s = e.target.getValue();
			if(s != ''){
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
})

var tableForm = new Class({
	
	initialize: function(){
		this.options = Object.extend({}, arguments[0] || {});
		this.translate = Object.extend({}, arguments[1] || {});
		this.watchTableDd();
		this.addAJoinClick = this.addAJoin.bindAsEventListener(this);
		if( $('addAJoin') ){
			$('addAJoin').addEvent('click', this.addAJoinClick );
		}
		this.joinCounter = 0;
		this.watchDbName();
	},
	
	watchDbName: function(){
		if($('database_name')){
			$('database_name').addEvent('blur', function(e){
				if($('database_name').getValue() == ''){
					$('tablename').disabled = false;
				}else{
					$('tablename').disabled = true;
				}
			})	
		}
	},
	
	_buildOptions: function( data, sel ){
		var opts = [];
		if(data.length > 0 ){
			if(typeof(data[0]) == 'object' ){
				data.each(function(o){
					if(o[0] == sel){
						opts.push( new Element('option', {'value':o[0], 'selected':'selected'}).appendText(o[1]) );
					}else{
						opts.push( new Element('option', {'value':o[0]}).appendText(o[1]) );
					}
				});
			}else{
				data.each(function(o){
					if(o == sel){
						opts.push( new Element('option', {'value':o, 'selected':'selected'}).appendText(o) );
					}else{
						opts.push( new Element('option', {'value':o}).appendText(o) );
					}
				});
			}
		}
		return opts;	
	},
	
	addAJoin:function(e){
		this.addJoin();
		new Event(e).stop();
	},
	
	watchTableDd: function(){
		if($('tablename')){
		$('tablename').addEvent('change', function(e){
			var cid = $('connection_id').getValue();
			var table = $('tablename').getValue();
			var url = 'index.php?option=com_fabrik&no_html=1&task=ajax_updateColumDropDowns&cid=' + cid + '&table=' + table;
			var myAjax = new Ajax(url, { method:'post', 
				onComplete: function(r){
				eval( r );
				}}).request();
		});
		}
	},
		
	watchFieldList: function(name){
		$A(document.getElementsByName(name)).each(function(dd){
			dd.addEvent('change', function(e){
				var event = new Event(e); 
				var sel = event.target.parentNode.parentNode.parentNode.parentNode;
				var activeJoinCounter = sel.id.replace('join', '');
				this.updateJoinStatement(activeJoinCounter);
			}.bind(this));
		}.bind(this));	
	},
	
	_findActiveTables: function(){
		var t = $$('.join_from').merge($$('.join_to'));
		t.each(function(sel){
			var v  = sel.getValue();
			if(this.options.activetableOpts.indexOf(v) === -1){
				this.options.activetableOpts.push(v);
			}
		}.bind(this));
		this.options.activetableOpts.sort();
	},
	
	addJoin:function(groupId, joinId, joinType, joinToTable, thisKey, joinKey, joinFromTable, joinFromFields, joinToFields){
		//new vars
		joinType = joinType ? joinType : 'left';
		joinFromTable = joinFromTable ? joinFromTable : '';
		joinToTable = joinToTable ? joinToTable : '';
		thisKey = thisKey ? thisKey : '';
		joinKey = joinKey ? joinKey : '';
		//end
		//kept
    groupId = groupId ? groupId : '';
		joinId = joinId ? joinId : '';

		this._findActiveTables();
		joinFromFields = joinFromFields ? joinFromFields : [['-', '']];
		joinToFields = joinToFields ? joinToFields : [['-', '']];
		
		var sContent = new Element('table', {'class':'adminform', 'id':'join' + this.joinCounter}).adopt(
			new Element('tbody').adopt([
			new Element('tr').adopt(
				[
					new Element('td').adopt(
						[
							new Element('input', {'type':'hidden', 'name':'join_id[]','value':joinId}),
							new Element('input', {'type':'hidden', 'name':'group_id[]','value':groupId})
						]
					).appendText(this.translate.joinType),
					
					new Element('td').adopt(
						new Element('select', {
							'name':'join_type[]',
							'class':'inputbox'
							}).adopt(this._buildOptions( this.options.joinOpts, joinType)
						)
					)
				]
			),
			
			new Element('tr').adopt(
				[
					new Element('td').appendText(this.translate.joinFromTable),
					new Element('td').adopt(
						new Element('select', {
							'name':'join_from_table[]',
							'class':'inputbox join_from'}).adopt(this._buildOptions( this.options.activetableOpts, joinFromTable)
						)
					)
				]
			),
			
			new Element('tr').adopt(
				[
					new Element('td').appendText(this.translate.joinToTable),
					new Element('td').adopt(
						new Element('select', {
							'name':'table_join[]',
							'class':'inputbox join_to'}).adopt(this._buildOptions( this.options.tableOpts, joinToTable)
						)
					)
				]
			),
			
			new Element('tr').adopt(
				[
					new Element('td').appendText(this.translate.thisTablesIdCol),
					new Element('td', {'id':'joinThisTableId' + this.joinCounter }).adopt(
						new Element('select', {
							'name':'table_key[]',
							'class':'table_key inputbox'}).adopt(this._buildOptions( joinFromFields, thisKey)
						)
					)
				]
			),
			
			new Element('tr').adopt(
				[
					new Element('td').appendText(this.translate.joinTablesIdCol),
					new Element('td', {'id':'joinJoinTableId' + this.joinCounter }).adopt(
						new Element('select', {
							'name':'table_join_key[]',
							'class':'table_join_key inputbox'}).adopt(this._buildOptions( joinToFields, joinKey)
						)
					)
				]
			),
			
			new Element('tr').adopt(
				[
					new Element('td', {'colspan':'2'}).adopt(
						[
							new Element('div', {
								 'id':'join-desc-'+ this.joinCounter,
								 'styles': {'margin':'5px','background-color':'#fefefe','padding':'5px','border':'1px dotted #666666'}
							}),
							new Element('a', {
								'href':'#',
								'class':'removeButton',
								'events': {
									'click': function(e){
									    this.deleteJoin(e);
										return false;
									}.bind(this)
								}
							}).appendText(this.translate.del)
						]
					)
				]
			)
		]));
		var d = new Element('div', {'id':'join'}).adopt(sContent);
		d.injectInside($('joindtd'));  
		this.updateJoinStatement(this.joinCounter);
		this.watchJoins();
		this.joinCounter++;
	},
			
	deleteJoin:function(e){
		e = new Event(e);
		e.stop();
		var t = e.target.up(2);
		t.effect('opacity').start(1, 0).chain( function(){t.remove()}
		
		);
	},
	
	watchJoins: function(){
		$$('.join_from').each(function(dd){
			dd.removeEvents('change');
			dd.addEvent('change', function(e){
				var event = new Event(e);
				var sel = event.target.parentNode.parentNode.parentNode.parentNode;
				var activeJoinCounter = sel.id.replace('join', '');
				this.updateJoinStatement(activeJoinCounter);
				var table = event.target.getValue();
				var conn = $('connection_id').getValue();
		
				var url = 'index.php?option=com_fabrik&c=table&no_html=1&task=ajax_loadTableDropDown&table=' + table + '&conn=' + conn;
					var myAjax = new Ajax(url, { method:'post', 
					update: $('joinThisTableId' + activeJoinCounter),
					onComplete: function(r){
						this.watchFieldList('table_key[]');
					}.bind(this)}).request();
			}.bind(this));
		}.bind(this));	
		
		$$('.join_to').each(function(dd){
			dd.removeEvents('change');
			dd.addEvent('change', function(e){
				var event = new Event(e);
				var sel = event.target.parentNode.parentNode.parentNode.parentNode;
				var activeJoinCounter = sel.id.replace('join', '');
				this.updateJoinStatement(activeJoinCounter);
				var table = event.target.getValue();
				var conn = $('connection_id').getValue();
				var url = 'index.php?name=table_join_key[]&option=com_fabrik&c=table&no_html=1&task=ajax_loadTableDropDown&table=' + table + '&conn=' + conn;
								
				var myAjax = new Ajax(url, { method:'post', 
				update: $('joinJoinTableId' + activeJoinCounter ),
				onComplete: function(r){
					this.watchFieldList('table_join_key[]');
				}.bind(this)}).request();
			}.bind(this));
		}.bind(this));	
	
		this.watchFieldList('join_type[]');
		this.watchFieldList('table_join_key[]');
		this.watchFieldList('table_key[]');
	},
	
	updateJoinStatement:function(activeJoinCounter){
		var fields = $$('#join' + activeJoinCounter + ' .inputbox');
		var type = fields[0].getValue();
		var fromTable = fields[1].getValue();
		var toTable = fields[2].getValue();
		var fromKey = fields[3].getValue();
		var toKey = fields[4].getValue();
		var str = type + " JOIN " + toTable + " ON " + fromTable + "." + fromKey + " = " + toTable + "." + toKey;
		$('join-desc-'+ activeJoinCounter).innerHTML = str;				
	}

});

////////////////////////////////////////////

var adminFilters = new Class({
	initialize: function( el, fields ) {
		this.el = $(el);
		this.fields = fields;
		this.options = Object.extend({}, arguments[2] || {});
		this.translate = Object.extend({
		}, arguments[3] || {});
	
		this.filters = new Array();
		this.counter = 0;
		this.onDeleteClick = this.deleteFilterOption.bindAsEventListener(this);
	},
	
	addHeadings: function(){
		$('filterContainer').adopt(new Element('tr', {'id':'filterTh', 'class':'title'}).adopt(
			new Element('th').appendText(this.translate.join),
			new Element('th').appendText(this.translate.field),
			new Element('th').appendText(this.translate.condition),
			new Element('th').appendText(this.translate.eval),
 			new Element('th').adopt(
	 			new Element('span', {'class':'editlinktip'}).adopt(
					new Element('span', {}).appendText(this.translate.applyFilterTo)
				)
			),
			new Element('th').appendText(this.translate.del)			 
		));
	},
	
	deleteFilterOption: function( event ){
		var e = new Event(event);
		e.stop();
		var element = $(e.target);
		element.removeEvent( "click", this.onDeleteClick);
    	var tr = element.parentNode.parentNode;
    	var table = tr.parentNode;
    	table.removeChild(tr);
    	this.counter --;
    	if(this.counter == 0){
    		var th = $('filterTh');
    		table.removeChild(th);
    	}
	},
	
	addFilterOption: function( selJoin, selFilter, selCondition, selValue, selAccess, eval, grouped ){
		if(this.counter <= 0){
			this.addHeadings();
		}
		selJoin = selJoin ? selJoin : '';
		selFilter = selFilter ? selFilter : '';
		selCondition = selCondition ? selCondition : '';
		selValue = selValue ? selValue : '';
		selAccess = selAccess ? selAccess : '';
		grouped = grouped ? grouped: '';
		var conditionsDd = this.options.filterCondDd;					
		var tr = new Element('tr');
		if(this.counter > 0){
			var opts = {'type':'radio', 'name':'params[filter-grouped][' + this.counter + ']', 'value':'1' };
			opts.checked = (grouped == "1") ? "checked" : "";
			var groupedYes = new Element('label').adopt(
				new Element('input', opts)
			).appendText(this.translate.yes);
			opts.value = '0';
			opts.checked = (grouped != "1") ? "checked" : "";
			var groupedNo = new Element('label').adopt(
				new Element('input', opts)
			).appendText(this.translate.no);
		}
		if( this.counter == 0){
			var joinDd = new Element('span').appendText('WHERE').adopt(
				new Element('input', {'type':'hidden','id':'paramsfilter-join', 'class':'inputbox','name':'params[filter-join][]','value':selJoin}));
		}else{
			if(selJoin == 'AND'){
				var and =  new Element('option', {'value':'AND','selected':'selected'}).appendText('AND');
				var or = new Element('option', {'value':'OR'}).appendText('OR')
			}else{
				var and =  new Element('option', {'value':'AND'}).appendText('AND');
				var or = new Element('option', {'value':'OR','selected':'selected'}).appendText('OR')
			}
			var joinDd = new Element('select', {'id':'paramsfilter-join', 'class':'inputbox','name':'params[filter-join][]'}).adopt(
		[and, or]);
		}

					
		var td = new Element('td');
		
		
		if(this.counter <= 0){
			td.appendChild(new Element('input', {'type':'hidden', 'name':'params[filter-grouped][' + this.counter + ']', 'value':'0'}));
		}else{
			
			td.appendChild( new Element('span').appendText(this.translate.grouped));
			td.appendChild(new Element('br'));
			td.appendChild(groupedNo);
			td.appendChild(groupedYes);
			td.appendChild(new Element('br'));
		}
		td.appendChild(joinDd);
		
		var td1 = new Element('td');
		td1.innerHTML = this.fields;
		var td2 = new Element('td');
		td2.innerHTML = conditionsDd;
		var td3 = new Element('td');
		
		var opts = {'type':'radio', 'name':'params[filter-eval][' + this.counter + ']', 'value':'1' };
		opts.checked = (eval == "1") ? "checked" : "";
		
		var evalYes = new Element('label').adopt(
			new Element('input', opts)
		).appendText(this.translate.yes);
		
		
		opts.value = '0';
		opts.checked = (eval != "1") ? "checked" : "";
		
		var evalNo = new Element('label').adopt(
			new Element('input', opts)
		).appendText(this.translate.no);
		
		var td4 = new Element('td');
		td4.innerHTML = this.options.filterAccess;
		var td5 = new Element('td');
		
		var textArea = new Element('textarea', {'name':'params[filter-value][]', 'cols':17, 'rows':4 }).appendText(selValue);
		td3.appendChild(textArea);
		td3.appendChild(new Element('br'));
		td3.appendChild( new Element('span').appendText(this.translate.eval));
		td3.appendChild(evalNo);
		td3.appendChild(evalYes);
		
		if( selJoin!='' || selFilter!='' || selCondition!='' || selValue!=''){
			var checked = true;
		}else{
			var checked = false;
		}
		var delId = this.el.id + "-del-" + this.counter;
		var a = new Element('a', {href:'#', 'id':delId, 'class':'removeButton'});
		//a.appendText('[-]');
		td5.appendChild(a);
		tr.appendChild(td);
		tr.appendChild(td1);
		tr.appendChild(td2);
		tr.appendChild(td3);
		tr.appendChild(td4);
		tr.appendChild(td5);

		this.el.appendChild(tr);
		
		$(delId).addEvent('click', this.onDeleteClick);
		
		$(this.el.id + "-del-" + this.counter).click = this.onDeleteClick;
		
		/*set default values*/ 
		if( selJoin != '' ){
			var sels = $A(td.getElementsByTagName('SELECT'));
			if(sels.length >= 1){
				for(i=0;i<sels[0].length;i++){
					if(sels[0][i].value == selJoin){
						sels[0].options.selectedIndex = i;
					}
				}
			}
		}
		if( selFilter != '' ){
			var sels = $A(td1.getElementsByTagName('SELECT'));
			if(sels.length >= 1){
				for(var i=0;i<sels[0].length;i++){
					if(sels[0][i].value == selFilter){
						sels[0].options.selectedIndex = i;
					}
				}
			}
		}				

		if( selCondition != '' ){
			var sels = $A(td2.getElementsByTagName('SELECT'));
			if(sels.length >= 1){
				for(var i=0;i<sels[0].length;i++){
					if(sels[0][i].value == selCondition){
						sels[0].options.selectedIndex = i;
					}
				}
			}
		}	
		
		if( selAccess != '' ){
			var sels = $A(td4.getElementsByTagName('SELECT'));
			if(sels.length >= 1){
				for(var i=0;i<sels[0].length;i++){
					if(sels[0][i].value == selAccess){
						sels[0].options.selectedIndex = i;
					}
				}
			}
		}					
		this.counter ++;
	}
	
})

