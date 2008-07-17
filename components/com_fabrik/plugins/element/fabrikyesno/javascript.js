var fbCheckBox = fbElement.extend({

	initialize: function(element, options) {
		this.plugin = 'fabrikcheckbox';
		this.setOptions(element, options);
	},

	setOptions: function( element ) {
		this.element = $(element);

		var d = new Array();
		this.options = Object.extend({
			element:       'default',
			defaultVal: d
		}, arguments[1] || {});
		var ok = true;
		this.subElements = new Array();
		var optCounter = 0;
		var testId = ''; 	
		while(ok){
			testId = element + '_' + optCounter;
			if($(testId)){
				this.subElements.push($(testId));
				optCounter ++;
			}else{
				ok = false;
			} 
		}
	},

	addNewEvent: function( action, js ){
		if(action == 'load'){
			eval(js);
		}else{
			this.subElements.each( function(el){
				(el).addEvent( action, function(e){
					eval(js);
				} );
			});
		}
	},

	update: function(val){
		if (!this.options.editable) {
			this.element.innerHTML = val;
			return;
		}
		var r = this.baseName + '_' + val;
		if ($(r)) {
			r.checked = 'checked';
		}
		else {
		}
	}

});