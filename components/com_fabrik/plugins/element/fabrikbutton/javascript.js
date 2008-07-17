var fbButton = fbElement.extend({
	initialize: function(element, options) {
		this.plugin = 'fabrikButton';
		this.setOptions(element, options);
	},
	setOptions: function( element ) {
		this.element = $(element);

		var d = new Array();
		this.options = Object.extend({
			element:      element,
			defaultVal: d
		}, arguments[1] || {});
	}
});