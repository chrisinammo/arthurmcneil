var fbRadio = fbElement.extend({

	initialize: function(element, options) {
		
		this.plugin = 'fabrikradiobutton';
		this.setOptions(element, options);
		if(this.options.allowadd){
			
			var id = this.options.element;
			$( id + '_dd_add_entry').addEvent( 'click', function(event){
				var label = $(id + '_ddLabel').value;
				if($( id + '_ddVal')){
					var val = $( id + '_ddVal').value;
				}else{
					var val = label;
				}
				
				var r = this.subElements.getLast().findUp('div').clone();
				r.getElement('input').value = val;
				var lastid = r.getElement('input').id.replace(id + '_', '').toInt();
				lastid ++;
				r.getElement('input').id = id + '_' + lastid;
				r.getElement('span').setText(label);
				r.injectAfter(this.subElements.getLast().findUp('div'));
				this._getSubElements();
				var e = new Event(event).stop();
				if ($(id + '_ddVal')) {
					$(id + '_ddVal').value = '';
				}
				$(id + '_ddLabel').value = '';
				this.addNewOption(val, label);
			}.bind(this));
		}

	},

	setOptions: function( element ) {
		this.element = $(element);
		var d = new Array();
		this.options = Object.extend({
			element:       element,
			defaultVal: d
		}, arguments[1] || {});
		this._getSubElements();
	},

	addNewEvent: function( action, js ){
		if(action == 'load'){
			eval(js);
		}else{
			this._getSubElements();
			this.subElements.each( function(el){
				(el).addEvent( action, function(e){
					eval(js);
				} );
			});
		}
	},

	update: function(val){
		if (!this.options.editable) {
			if(val === ''){
				this.element.innerHTML = '';
				return;
			}
			this.element.innerHTML =$H(this.options.data).get(val);
			return;
		}
		
		this._getSubElements();
		this.subElements.each( function(el){
			var chx = false;
			if(val == el.value){
				chx = true;
			}
			el.checked = chx;
		}.bind(this));
	
	}

});