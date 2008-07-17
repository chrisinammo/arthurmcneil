var fbDropdown = fbElement.extend({
	initialize: function(element, options) {
		this.plugin = 'fabrikdropdown';
		this.setOptions(element, options);
		if(this.options.allowadd){
			var id = this.element.id;
			$( this.element.id + '_dd_add_entry').addEvent( 'click', function(event){
				var label = $(id + '_ddLabel').value;
				if($( id + '_ddVal')){
					var val = $( id + '_ddVal').value;
				}else{
					var val = label;
				}
				var opt = new Element('option', {'value':val}).appendText(label).injectInside($(this.element.id));
				//$('" . $this->_elementHTMLId . "').innerHTML +='<option value=\"' + val + '\">' + label + '</option>'
				var e = new Event(event).stop();
				if ($(id + '_ddVal')) {
					$(id + '_ddVal').value = '';
				}
				$(id + '_ddLabel').value = '';
				this.addNewOption(val, label);
			}.bind(this));
		}
	},
	
	reset: function()
	{
		var v = this.options.defaultVal.join(this.options.splitter);
		this.update(v);
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
		var activevals = val.split(this.options.splitter);
		this.element.empty();
		var d = $H(this.options.data);
		d.each(function(val, key){
			var sel = false;
			activevals.each(function(v){
				if(v == key){
					sel = true;
				}
			})
			var o = new Element('option', {'value':key, 'selected':sel}).appendText(val)
			this.element.adopt(o);
		}.bind(this));
		

		var r = this.baseName + '_' + val;
		if ($(r)) {
			r.checked = 'checked';
		}
	}
});
	
