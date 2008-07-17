/**
 * @author Robert
 */
var fbElement =  new Class({
	initialize: function(element, options) {
		this.plugin = '';
		this.strElement = element;
		this.setOptions(element, options);
	},
	setOptions: function(element, options) {
		if($(element)){
			this.element = $(element);
		}
		this.options = {
			element:  element,
			defaultVal: '',
			editable:false
		}
	Object.extend(this.options, options || {});
	},
	
	//used for elements like checkboxes or radio buttons
	
	_getSubElements: function(){
		var ok = true;
		var optCounter = 0;
		var testId = ''; 	
		this.subElements = new Array();
		while(ok){
			testId = this.options.element + '_' + optCounter;
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
			if(!this.element){
				this.element = $(this.strElement);
			}
			this.element.addEvent( action, function(e){
				eval(js);
				e = new Event(e);
				e.stop();
			} );
			
			this.element.addEvent('blur', function(e){
				this.validate();
			}.bind(this))
		}
	},
	
	//store new options created by user in hidden field
	addNewOption: function(val, label)
	{
		var added = $(this.options.element + '_additions').value;
		var json = {'val':val,'label':label};
		if(added != ''){
			var a = Json.evaluate(added);
		}else{
			var a = new Array();
		}
		a.push(json);
		var s = '[';
		for(var i=0;i<a.length;i++){
			s += Json.toString(a[i]) + ','
		}
		s = s.substring(0, s.length-1) + ']';
		$(this.options.element + '_additions').value = s;
	},
	
	//below functions can override in plugin element classes
	
	update: function(val){
		if (this.options.editable) {
			this.element.value = val;
		}else{
			this.element.innerHTML = val;
		}
	},
	
	reset: function()
	{
		fconsole(this.options);
		this.update(this.options.defaultVal);
	},
	
	onsubmit: function(){
		return true;
	}
});