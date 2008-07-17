var fbLink = fbElement.extend({

	initialize: function(element, options) {
		this.plugin = 'fabrikLink';
		this.setOptions(element, options);
	},

	setOptions: function( element ) {
		this.element = $(element);
		var d = new Array();
		this.options = Object.extend({
			element:       element,
			defaultVal: d
		}, arguments[1] || {});
		var ok = true;
		this.linkField = $(element + '_link');
		this.subElements = [this.element, this.linkField];
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
	}

});