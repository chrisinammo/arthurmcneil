var fbDateTime = fbElement.extend({
	initialize: function(element, options) {
		this.setOptions(element, options);
		this.hour = '0';
		this.plugin = 'fabrikdate';
		this.minute = '00';
		this.buttonBg = '#ffffff';
		this.buttonBgSelected = '#88dd33';
		this.startElement = element;
		this.setUp = false;
		this._getSubElements();
	},
	
	onsubmit: function(){
		if (this.options.showtime) {
			var d = this.element.getValue();
			var t = this.timeElement.getValue();
			this.element.value = d + ' ' + t; 
			this.timeElement.value = ''
		}
		return true;
	},
	
	_getSubElements: function(){
		if ($(this.options.element + '_time')) {
			
			this.timeElement = $(this.options.element + '_time');
		}
		if($(this.options.element + '_button')){
			$(this.options.element + '_button').removeEvents('click');
			$(this.options.element + '_button').addEvent('click', function(e){
				this.showCalendar('y-mm-dd')
			}.bind(this));
		}
		if($(this.options.element + '_button_time')){
			$(this.options.element + '_button_time').removeEvents('click');
			$(this.options.element + '_button_time').addEvent('click', function(e){
				this.showTime()
			}.bind(this));
			if( ! this.setUp){
			if( this.timeElement ){
				this.dropdown = this.makeDropDown();
				$(this.timeElement).parentNode.appendChild(this.dropdown);
				this.setAbsolutePos(this.timeElement);
				this.setUp = true;
				}
			}
		}
	},
	
	addNewEvent: function( action, js ){
		this._getSubElements();
		
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
		}
	},
	
	update: function(val){
		if (!this.options.editable) {
			this.element.innerHTML = val;
			return;
		}
		var bits = val.split(" ");
		var date = bits[0];
		var time = (bits.length > 1) ? bits[1].substring(0, 5) : '00:00';
		var timeBits = time.split(":");
		this.hour = timeBits[0];
		this.minute = timeBits[1];
		this.element.value = date;
		this.stateTime();
	},
	
	showCalendar:function( format){
		return showCalendar(this.element.id, format);
	},
	
	getAbsolutePos: function(el) {
		var r = { x: el.offsetLeft, y: el.offsetTop };
		if (el.offsetParent) {
			var tmp = this.getAbsolutePos(el.offsetParent);
			r.x += tmp.x;
			r.y += tmp.y;
		}
		return r;
	},
	
	setAbsolutePos: function(el){
		var r = this.getAbsolutePos(el);
		var div = $(this.startElement + '_hourContainer');
		div.setStyles({position:'absolute', left:r.x, top:r.y + 30});
	},

	makeDropDown:function(){
		var handle = new Element('div', {
			styles:{
				'height':'20px',
				'curor':'move',
				'color':'#dddddd',
				'padding':'2px;',
				'background-color':'#333333'
			},
			'id':this.startElement + '_handle'
		}).appendText(this.options.timelabel);
		var d = new Element('div', {
			'id':this.startElement + '_hourContainer',
			'className':'fbDateTime',
			'styles':{
				'z-index':999999,
				display:'none',
				cursor:'move',width:'264px',height:'100px',border:'1px solid #999999',backgroundColor:'#EEEEEE'
			}
		});
	
		d.appendChild(handle);
		for(var i=0;i<24;i++){
			var h = new Element('div', {styles:{width:'20px','float':'left','cursor':'pointer','background-color':'#ffffff','margin':'1px','text-align':'center'}});
			h.innerHTML = i;
			h.className = 'fbdateTime-hour';
			d.appendChild(h);
			$(h).addEvent( 'click', function(event){
				var e = new Event(event);
				this.hour = $(e.target).innerHTML;
				this.stateTime();
				this.setActive();
			}.bind(this));
			$(h).addEvent( 'mouseover', function(event){
				var e = new Event(event);
				var h = $(e.target);
				if(this.hour != h.innerHTML){
					e.target.setStyles( {background:'#cbeefb'});
				}
			}.bind(this));
			$(h).addEvent( 'mouseout', function(event){
				var e = new Event(event);
				var h = $(e.target);
				if(this.hour != h.innerHTML){
					h.setStyles({background:this.buttonBg});
				}
			}.bind(this));
		}
		var d2 = new Element('div', {styles:{clear:'both',paddingTop:'5px'}});
		for(var i=0;i<12;i++){
			var h = new Element('div', {styles:{width:'41px','float':'left','cursor':'pointer','background':'#ffffff','margin':'1px','text-align':'center'}});
			h.setStyles();
			h.innerHTML = ':' + (i * 5);
			h.className = 'fbdateTime-minute';
			d2.appendChild(h);
			$(h).addEvent( 'click', function(e){
				e = new Event(e);
				this.minute = this.formatMinute(e.target.innerHTML);
				this.stateTime();
				this.setActive();
			}.bind(this));
			(h).addEvent( 'mouseover', function(event){
				var e = new Event(event);
				var h = $(e.target);
				if(this.minute != this.formatMinute(h.innerHTML)){
					e.target.setStyles({background:'#cbeefb'});
				}
			}.bind(this));
			$(h).addEvent( 'mouseout', function(event){
				var e = new Event(event);
				var h = $(e.target);
				if(this.minute != this.formatMinute(h.innerHTML)){
					e.target.setStyles({background:this.buttonBg});	
				}
			}.bind(this) );
		}
		d.appendChild(d2);

		document.addEvent( 'click', function(event){
			var e = new Event(event);
			var t = $(e.target);
			if(t != $(this.element.id + '_button_time')){
				if(!t.within(this.dropdown)){
					$(this.dropdown).setStyles({'display':'none'});
				}
			}
		}.bind(this));
		new Drag.Move(d);
		return d;
	},
	
	toggleTime: function(){
		if(this.dropdown.style.display == 'none'){
			$(this.dropdown).setStyles({'display':'block'});
		}else{
			$(this.dropdown).setStyles({'display':'none'});
		}
	},

	formatMinute:function(m){
		m = m.replace(':','');
		if(m.length == 1){
			m = '0' + m;
		}
		return m;
	},

	stateTime:function(){
		if(this.timeElement){
			$(this.timeElement.id.replace('[]', '')).value = this.hour+ ':' + this.minute;	
		}
	},

	showTime:function(){
		el = this.timeElement;
		this.toggleTime();
		this.setActive();
	},

	setActive: function(){
		//var hours = $A(this.dropdown.getElementsByClassName(''));
		var hours = this.dropdown.getElements('.fbdateTime-hour')
		hours.each(function(e){
			e.setStyles({backgroundColor:this.buttonBg});
		}, this);
		//var mins = $A(this.dropdown.getElementsByClassName('fbdateTime-minute'));
		var mins = this.dropdown.getElements('.fbdateTime-minute');
		mins.each(function(e){
			e.setStyles({backgroundColor:this.buttonBg});
		}, this);
		hours[this.hour].setStyles({backgroundColor:this.buttonBgSelected});
		mins[this.minute / 5].setStyles({backgroundColor:this.buttonBgSelected});
	}
});