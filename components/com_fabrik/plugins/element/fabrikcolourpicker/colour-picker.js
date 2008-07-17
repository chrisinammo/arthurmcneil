var SliderField = new Class({
	initialize: function(field, slider) {
		this.field 		= $(field);
		this.slider 	= slider;
		this.eventChange = this.update.bindAsEventListener(this);
		this.field.addEvent( "change", this.eventChange); 
	},
	
  destroy: function() {
    this.field.removeEvent( "change", this.eventChange); 
  },
  
  update: function(){
		if (!this.options.editable) {
			this.element.innerHTML = val;
			return;
		}
		this.slider.set(parseInt(this.field.value));
  }	
});

var ColourPicker = new Class({
	initialize: function(handle, output, options) {
		
		this.options = Object.extend({
			liveSite 	:'',
			closeImage: 'components/com_fabrik/plugins/element/fabrikColourPicker/images/close.gif',
			handleImage: 'components/com_fabrik/plugins/element/fabrikColourPicker/images/handle.gif',
			trackImage: 'components/com_fabrik/plugins/element/fabrikColourPicker/images/track.gif',
			red:0,
			green:0,
			blue:0
		}, options || {});
		
		this.aSwatchColours = new Array(
			new Array('255,0,0', '255,255,0', '0,255,0', '0,255,255', '0,0,255', '255,0,255', '255,255,255', '230,230,230', '217,217,217', '204,204,204', '191,191,191', '179,179,179', '166,166,166', '153,153,153', '140,140,140', '128,128,128'),
			new Array('223,0,41', '249,244,0', '0,159,98', '0,178,235', '61,17,123', '226,0,127', '115,115,115', '102,102,102', '89,89,89', '77,77,77', '64,64,64', '51,51,51', '38,38,38', '26,26,26', '13,13,13', '0,0,0'),
			new Array('243,158,119', '246,181,128', '249,205,138', '255,249,157', '119,225,158', '168,213,157', '137,201,157', '140,204,202', '141,207,244', '148,170,214', '149,149,198', '150,129,183', '174,136,184', '199,144,186', '244,160,189', '244,159,155'),
			new Array('234,107,72', '240,148,80', '245,183,87', '253,246,102', '169,212,109', '120,196,112', '47,180,114', '60,184,181', '63,187,239', '95,135,197', '102,110,176', '106,79,154', '142,86,155', '175,93,156', '237,107,158', '236,107,118'),
			new Array('223,0,41', '231,101,26', '238,156,0', '249,244,0', '125,198,34', '0,176,59', '0,159,98', '0,164,158', '0,178,235', '0,105,179', '50,67,149', '61,17,123', '102,9,123', '146,0,123', '226,0,127', '225,0,87'),
			new Array('150,0,24', '155,64,14', '160,104,0', '168,164,0', '82,132,19', '0,117,36', '0,105,63', '0,109,105', '0,119,158', '0,68,119', '30,42,99', '38,7,81', '66,4,81', '97,0,81', '152,0,83', '151,0,56'),
			new Array('108,0,14', '112,45,7', '116,74,0', '122,119,0', '58,95,11', '0,84,24', '0,75,44', '0,78,75', '0,85,114', '0,47,85', '19,28,70', '25,4,57', '46,2,57', '68,0,57', '110,0,59', '109,0,38') 
		);
		
		this.options.closeImage = this.options.liveSite + "/" + this.options.closeImage;
		this.options.handleImage = this.options.liveSite + "/" + this.options.handleImage;
		this.options.trackImage = this.options.liveSite + "/" + this.options.trackImage;
		this.setOutputs(output);
		this.hiddenField		= $(this.options.hiddenField || '');
		this.redField = null;
		this.handle = $(handle);
		this.showSwatch = true;
		this.showCloseButton = true;
		this.showCloseIcon = true;
	 	//create the table to hold the scroller
		this.table 	= new Element('table');
		this.tbody   = new Element('tbody');
		var aColours = ['red', 'green', 'blue'];
		
		if(this.showCloseIcon){
			var closeIcon = this.createCloseIcon( handle );
			this.handle.appendChild( closeIcon ); 
		}
		if(this.showSwatch){
			this.createColourSwatch( handle );
				this.addSwatchClickEvents( handle );			
		}
		
		this.createColourSlideHTML(handle, 'red', 'Red:', this.options.red); 
		this.createColourSlideHTML(handle, 'green', 'Green:', this.options.green); 
		this.createColourSlideHTML(handle, 'blue', 'Blue:', this.options.blue); 
  	this.table.appendChild( this.tbody );    
    this.handle.appendChild( this.table );  
		for(var i=0;i<aColours.length;i++){
			var col = aColours[i];
			var opts = {steps:255, 'color':col,'parentObj':this, max:255, offset: 1,onChange: function(pos){
			switch(this.options.color){
				case 'red':
					this.options.parentObj.updateredOutput(pos);
					break;
				case 'green':
					this.options.parentObj.updategreenOutput(pos);
					break;
				case 'blue':
					this.options.parentObj.updateblueOutput(pos);
					break;
				}
			}};
			
	
			this[col + "Slider"] = new Slider($(handle+col+'track'), $(handle+col+'handle') ,opts);
		}
		this.handle.hide();
		//this makes the class update when someone enters a value into 
		this.redFieldChange = this.updateRed.bindAsEventListener(this);
		this.redField.addEvent( "change", this.redFieldChange);
		this.greenFieldChange = this.updateGreen.bindAsEventListener(this);
		this.greenField.addEvent( "change", this.greenFieldChange);	
		this.blueFieldChange = this.updateBlue.bindAsEventListener(this);
		this.blueField.addEvent( "change", this.blueFieldChange);	
	
		this.updateOutputs();
		if(this.showCloseButton){
			var closeButton = this.createCloseButton( handle, 'Close' );
			this.handle.appendChild( closeButton ); 
		}
			new Drag.Move(handle);
		
		
	},

	createColourSwatch: function( handle ){
		this.fUpdateFromSwatch = this.updateFromSwatch.bindAsEventListener(this);
		var swatchDiv = new Element('div', {
		'styles': {
			'float': 'left'
		}
		});
		swatchDiv.setAttribute('className', 'swatchBackground');

		for(var i=0;i<this.aSwatchColours.length;i++){
			var swatchLine = new Element('div', {'styles':{'width':'160px'}});
			var line = this.aSwatchColours[i];
			for(var j=0;j<line.length;j++){
				var colour = line[j];
				var swatchId = handle+'swatch-' + i + '-' +  j;
				swatchLine.adopt(
					new Element('div', {'id':swatchId, 'styles':{
					'float':'left','width':'10px','cursor':'crosshair','height':'10px','background-color':'rgb(' + colour + ')'	
					}})
				)
			}
			swatchDiv.adopt(swatchLine);
		}
		this.handle.adopt(swatchDiv);	
	},
	
	addSwatchClickEvents: function( handle ){
		for(var i=0;i<this.aSwatchColours.length;i++){
			var line = this.aSwatchColours[i];
			for(var j=0;j<line.length;j++){
				var colour = line[j];
				var swatchId = handle+'swatch-' + i + '-' +  j;
				$(swatchId).addEvent( "click", this.fUpdateFromSwatch);	
			}
		}	
	},
	
	updateFromSwatch: function(event){
		var e = new Event(event);
		var sColour = e.target.style.background;
		var c = new Color(e.target.getStyle('background-color'));
		var red = c[0];
		var green = c[1];
		var blue = c[2];		
		this.updateAll(red, green, blue);		
	},
	
	updateredOutput: function(value){
		this.options.red = parseInt(value);
		this.redField.value = parseInt(value);
		this.updateOutputs();
	  },
	  	
	  updategreenOutput: function(value){
		this.options.green = parseInt(value);
		this.greenField.value = parseInt(value);
		this.updateOutputs();
	  },
	  	
	  updateblueOutput: function(value){
		this.options.blue = parseInt(value);
		this.blueField.value = parseInt(value);
		this.updateOutputs();
	  }, 
	  
 	updateOutputs: function(){
		var sRgb = "rgb(" + this.options.red + ", " + this.options.green + ", " + this.options.blue + ")"; 
	  	for(var i=0;i<this.aOutputs.length;i++){
  			if(this.aOutputs[i].length == 2){
  				if(this.aOutputs[i][1] == 'color'){
  					this.aOutputs[i][0].style.color = "rgb(" + this.options.red + ", " + this.options.green + ", " + this.options.blue + ")";
  				}else{
  					this.aOutputs[i][0].style.backgroundColor = "rgb(" + this.options.red + ", " + this.options.green + ", " + this.options.blue + ")";	  				
  				}
			}
		}
		this.hiddenField.value = sRgb;;
  	},
	
	update: function(val){
		if (!this.options.editable) {
			this.element.innerHTML = val;
			return;
		}
		val = val.replace('rgb(', '');
		val = val.replace(')', '');
		val = val.split(",");
		this.updateAll(val[0], val[1], val[2]);
	},
  	
	updateAll: function(red, green, blue){
		this.redSlider.set(parseInt(red));
  		this.redField.value = red ;
  		this.options.red = red ;	
  		this.greenSlider.set(parseInt(green));
  		this.greenField.value = green ;
  		this.options.green = green ;	
    	this.blueSlider.set(parseInt(blue));
  		this.blueField.value = blue ;
  		this.options.blue = blue ;		
		this.updateOutputs();	
  	},	


  	setOutputs: function(output){
	    this.aOutputs = $A(output);
	    for(var i=0;i<this.aOutputs.length;i++){
	    	this.aOutputs[i][0] = 	 $(this.aOutputs[i][0]);
	    }
  	},
  	
  	updateRed: function(evt){
		if(isNaN(parseInt(this.redField.value))){
			var val = 0;
  		}else{
			this.options.red = parseInt(this.redField.value);
			this.redSlider.set(this.options.red);
  			this.updateOutputs();
  		}
  	},
  	
  	updateGreen: function(evt){
  		if(isNaN(parseInt(this.greenField.value))){
			var val = 0;
  		}else{
  			this.options.green= parseInt(this.greenField.value);
  			this.greenSlider.set(this.options.green);
  			this.updateOutputs();
  		}
  	},  	
  	
  	updateBlue: function(evt){
  		if(isNaN(parseInt(this.blueField.value))){
			var val = 0;
  		}else{
  			this.options.blue = parseInt(this.blueField.value);
  			this.blueSlider.set(this.options.blue);
  			this.updateOutputs();
  		}
  	},
	  	
  	createCloseButton: function( picker, sClose ){
 	  	var div = new Element('div', {'styles':{
			'width':'375px','text-align':'right'
		}});
		var picker = $(picker);
  		var input = new Element('input', {'class':'button','value':sClose,'type':'button', 'events':
		{
			'click':function(){picker.toggle();}
		}});
  		div.appendChild(input);
  		return div; 	
  	},
	
	createCloseIcon: function( picker ){
		var div = new Element('div', {'styles':{
			'width':'375px','text-align':'right'
		}}).adopt(
  		new Element('img', {'src':this.options.closeImage, 'styles':{'cursor':'pointer'}, 'events':{
			'click': function(e){
				e.target.parentNode.parentNode.setStyle('display','none');
				e = new Event(e);
				e.stop();
			}	
		}})
		);
  		return div;
  	},
	
	createColourSlideHTML: function(handle, colour, label, value){
		
	    var Track = new Element('div', {'id':handle+colour+'track','styles':{
			'height':'5px','width':'123px'
		}}).adopt(
			new Element('img', {'src':this.options.trackImage, 'width':'123px','height':'4px'})
		);
 	    
	    var sliderDiv = new Element('div', {'id':handle+colour+'handle','styles':{
			'width':'11px','height':'21px','top':'-15px'
		}}).adopt(
		 	new Element('img', {'src':this.options.handleImage, 'width':'11px','height':'21px'})
		);

	   var sliderField = new Element('input', {'type':'text','id':handle+colour+'redField', 'size':'3','class':'input','value':value});
		
		var tr1 	= new Element('tr').adopt(
		[
			new Element('td').appendText(label),
			new Element('td').adopt([Track.adopt(sliderDiv)]),
			new Element('td').adopt(sliderField)
		]); 

    this.tbody.appendChild(tr1);
		this[colour + "Field"] = sliderField;
  	}
});
