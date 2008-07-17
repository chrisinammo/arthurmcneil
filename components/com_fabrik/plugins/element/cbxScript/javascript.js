var fbCBXScript = fbElement.extend({
	update: function(val){
		if (!this.options.editable) {
			this.element.innerHTML = val;
			return;
		}
		this.element.innerHTML = val;
	}
});