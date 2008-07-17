var fbDatabasejoin = fbElement.extend({
	initialize: function(element, options) {
		this.plugin = 'fabrikdatabasejoin';
		this.options = Object.extend({
			'liveSite':'',
			'popupform':49,
			'id':0,
			'formid':0,
			'key':'',
			'label':''
		}, options || {});
		
		this.setOptions(element, this.options);
		//if users can add records to the database join drop down
		
		if($(element + '_add')){

			this.startEvent = this.start.bindAsEventListener(this);
			$(element + '_add').addEvent('click', this.startEvent);
			
			//register the popup window with the form this element is in
			//do this so that the database join drop down can be updated
			oPackage.bindListener('form_' + this.options.popupform, 'form_' + this.options.formid);
		}
	},
	
	start: function(event){
		var e = new Event(event);
		var url = this.options.liveSite + "/index.php?option=com_fabrik&view=form&tmpl=component&_postMethod=ajax&fabrik=" + this.options.popupform
		document.mochaDesktop.newWindow({
			id: 'popupwin',
			title: 'Add',
			contentType: 'xhr',
			loadMethod:'xhr',
			contentURL: url,
			width: 320,
			height: 320,
			x: 20,
			y: 60
		});
	},
	
	update: function(val){
		if (!this.options.editable) {
			this.element.innerHTML = '';
			if(val === ''){
				return;
			}
			val = val.split(this.options.splitter);
			var h = $H(this.options.data);
			val.each(function(v){
				this.element.innerHTML += h.get(v) + "<br />";	
			}.bind(this));
			return;
		}
		//@TODO test
		this.element.selectedIndex = val;
	},
	
	appendInfo: function(data){
		var opts = [];
		if(data == ''){
			return;
		}
		var key = this.options.key;
		var label = this.options.label;
		data = data.data;
		outerLoop:
		for(var i=0;i<data.length;i++){
			var group = data[i];
			for(var j=0;j<group.length;j++){
				var row = group[j];
				if( row[key] && row[label] ){
					//make ajax call to update this dd
					
					new Ajax( 'index.php', {
						data :{
							'option':'com_fabrik',
							'format':'raw',
							'task':'elementPluginAjax',
							'plugin':'fabrikdatabasejoin',
							'method':'ajax_getOptions',
							'element_id':this.options.id,
							'formid':this.options.formid
						},
						onSuccess:function(json){
							if(json != ''){
								json = eval("(" + json +")");
							}
							json.each(function(row){
								var opt = new Element('option', {'value':row.value}).appendText(row.text);
								if(this.options.defaultVal.indexOf(row.value) != -1){
									opt.selected = "selected";
								}
								opts.push(opt);
							}.bind(this));
							$(this.element.id).empty() ;
							$(this.element.id).adopt(opts);
						}.bind(this)
					}).request();
					break outerLoop;
				}
			}
		}
	
	}
});