fabrikCalendar = new Class({
	initialize: function(el){
		this.el  = $(el);
		this.SECOND = 1000; // the number of milliseconds in a second
		this.MINUTE = this.SECOND * 60; // the number of milliseconds in a minute
		this.HOUR = this.MINUTE * 60; // the number of milliseconds in an hour
		this.DAY = this.HOUR * 24; // the number of milliseconds in a day
		this.WEEK = this.DAY * 7; // the number of milliseconds in a week
		this.date = new Date();
		this.entries = $A()
		this.listenTo = $A();
		this.droppables = {'month':[],'week':[],'day':[]};
		
		this.desktop = new MochaDesktop();
		//load in the add event form
		
		/**
		 *DONE USING MOCHA WINDOW INSTEAD - NEED TO TEST WHAT HAPPENS IN PACKAGE WITH REGARDS TO LISTENERS
		  
		 var url = 'index.php?option=com_fabrik&format=raw&task=ajax_addEventForm&tmpl=component' ;
		
		new Ajax(url, {
			'evalScripts':'true',
			method: 'get',
			onComplete:function(res){
				$E('.fbPackageContent', this.win).empty().setHTML(res);
				ofabrik.processBufferEvents();
				this.addListenTo('form_' + ofabrik.id );
				oPackage.findAndWatchSubmit('addCalendarEvent');
			}.bind(this)}
		).request();
		*/

	},
	addListenTo: function(blockId){
		this.listenTo.push(blockId);
	},
	
	receiveMessage: function( senderBlock, task, taskStatus, json ){
		if(this.listenTo.indexOf(senderBlock) != -1 ){
			if(task == 'updateRows'){
				var formId = senderBlock.replace("form_", "");
				this.removeFormEvents(formId);
				
				json = eval(json);
				for(i=0;i<json.length;i++){
					for(j=0;j<json[i].length ;j++){
						var o = json[i][j];
						this.addEntry({'link':'','date':o.jos_fabrik_calendar_events___start_date,'label':o.jos_fabrik_calendar_events___label,'colour':'#EEEEEE', 'formid':formId});
					}
				}
			}
			this.showMonth();
		}		
	},
	
	removeFormEvents: function(formId){
		for(var j=this.entries.length-1;j>=0;j--){
			if(this.entries[j].formid == formId){
				this.entries.remove(this.entries[j]);
			}
		}
	},
	
	showMonth: function(){
		//set the date to the first day of the month
		//this.date.setDate(1);
		var firstDate = new Date();
		firstDate.setTime(this.date.valueOf());
		firstDate.setDate(1);
		
		var wday = firstDate.getDay();
		var numDays = firstDate.getMonthDays();
		var trs = $ES('#monthView tr', this.el);
		var inNextMonth = false;
		
		var previousMonth = new Date();
		previousMonth.setTime(firstDate.valueOf());
		previousMonth.setMonth(previousMonth.getMonth() - 1);
		var prevMonthDays = previousMonth.getMonthDays();
		
		var c = 0; // counter
		if(firstDate.getDay() !== 0){
			var firstDayDay =  firstDate.getDay();
			firstDate.setMonth(firstDate.getMonth() - 1);
			firstDate.setDate(  firstDate.getMonthDays() - firstDayDay + 1);
		}
		var dayHeight = $E('.day', $('monthView')).getCoordinates().height;
		var dayWidth = $E('.day', $('monthView')).getCoordinates().width;
		for(i=1;i<trs.length;i++){
			var tds = $ES('td', trs[i]);
			tds.each(function(td){
				if(c - wday >= numDays ){
					c = 0;
					inNextMonth = true;
				}
				if(c < wday || inNextMonth ){
					td.addClass('otherMonth');
				}
				if(c >= wday){ // this month
					day = (c + 1 - wday);
				}else{
					if(inNextMonth){ // next month
						day = c + 1;	
					}else{
						//previous month
						day = prevMonthDays -  wday + c + 1;
					}
				}
				td.empty();
				td.adopt(
					new Element('div', {'class':'date','styles':{'background-color':'#E8EEF7'}}).appendText(day)
				)
				var j = 0;
				this.entries.each(function(entry){
					if(entry.date.equalsTo(firstDate)){
						var bg = (entry.colour != '') ? entry.colour : this.options.entryColor;
						var eventCont = new Element('div', {
							'class':'fabrikEvent',
							'id': 'fabrikEvent_' + entry.id,
							'styles':{
								'background-color':bg,
								'width':dayWidth + 'px',
								'cursor':'pointer',
								'height':'20px',
								'border':'1px solid #666666'
							}
						})
						if(entry.link != ''){
							var x = new Element('a', {'href':entry.link}).appendText(entry.label)
						}else{
							var x = new Element('span').appendText(entry.label)
						}
						td.adopt(
							eventCont.adopt(x)
						)
					}
					j ++;
				}.bind(this));
				firstDate.setTime(firstDate.getTime() + this.DAY);
				c ++;	
			}.bind(this));
		}
		
		this.popWin = this._makePopUpWin();
		
		this.entries.each(function(entry){
			var item = $('fabrikEvent_' + entry.id);
			if(item){
				this.makeDragMonthEntry(item);
			}
		}.bind(this));
		this._highLightToday();
		$('monthDisplay').innerHTML = this.options.months[this.date.getMonth()] + " " + this.date.getFullYear();
	},
	
	_makePopUpWin: function(){
		//todo: events arent being triggered here??!!!
		var del = new Element('div').adopt(
		new Element('a',{
			'href':'#',
			'events':{
				'mouseenter': function(){
					//@todo
				},
				'mouseleave':  function(){
					//@too
				},
				'click':function(e){
					//@todo
					//this.deleteEntry(e);
				}
			}}).adopt(
			new Element('img', {
				'src':'components/com_fabrik/views/calendar/tmpl/' + this.options.tmpl + '/images/del.png', 'alt':'del',
			'class':'fabrikDeleteEvent'
			})).appendText('delete')
		)
		
		var edit = new Element('div').adopt(
			new Element('a', {
				'href':'#'
			}).appendText('Edit')
		)
		del.addEvent('mousewithin', function(){
			//@todo
		});
		
		return new Element('div', {'class':'popWin', 'styles':{'border':'1px solid black'}}).adopt(
		[
			del,
			edit
		]
		);
	},
	
	makeDragMonthEntry: function(item){
		//@TODO need to implement this correctly for 2.0RC1
		return;
		var drops = $ES('.day', $('monthView'));
		var highLightColor = this.options.colors.highlight;
		var todayColor = this.options.colors.today;
		var bgColor = this.options.colors.bg;
		var visid = this.options.calendarId;
		var dropFx = drops.effect('background-color', {wait: false}); 
		item.addEvent('mousedown', function(e) {
			e = new Event(e).stop();
			var clone = this.clone()
			.setStyles(this.getCoordinates()) // this returns an object with left/top/bottom/right, so its perfect
			.setStyles({'opacity': 0.7, 'position': 'absolute'})
			.addEvent('emptydrop', function() {
				drops.removeEvents();
				this.remove();
			}).inject(document.body);
 				
			drops.addEvents({
			'drop': function(dragEl) {
				drops.removeEvents(); 
				
				item.inject(this);
				item.setStyles({'opacity': 1, 'position': ''});
				if(clone.parentNode){
					clone.remove();
				}
				
				this.setStyle('background-color', highLightColor);
				var newDate = this.className.replace("day ", "").replace(" otherMonth", "").toInt();
				var i = dragEl.id.replace('fabrikEvent_', '');
				
				var d = new Date(newDate);
				var m = d.getMonth() + 1;
				dd = d.getFullYear() + '-' + m + '-' + d.getDate()  + ' ' + d.getHours() +':'+d.getMinutes() + ':' + d.getSeconds();

				var url = 'index.php?option=com_fabrik&format=raw&view=visualization&visualizationid=' + visid + '&plugintask=updateevent&id='+i ;
				new Ajax(url, {'data':{
					'start_date':dd
				}}).request();
		
				
			},
			'over': function() {
				this.setStyle('background-color', highLightColor);
			},
			'leave': function() {
				var myEffects = this.effects({duration: 500, transition: Fx.Transitions.Sine.easeInOut});
				var toCol= (this.hasClass('today')) ? todayColor : bgColor;
				myEffects.start({'background-color': [highLightColor, toCol]});
			}
			});
			var drag = clone.makeDraggable({
				droppables: $ES('.day', $('monthView'))
			}); // this returns the dragged element
	 
			drag.start(e); // start the event manual
		});
	},

	showWeek: function(){
		var trs = $ES('#weekView tr', this.el);
		//put dates in top row
		var ths = $ES('th', trs[0]);

		var wday = this.date.getDay();
		//get first date of week
		var firstDate = new Date()
		firstDate.setTime(this.date.getTime() -  (wday * this.DAY));
		this.date = firstDate;
		//get last date of week
		var lastDate = new Date();
		lastDate.setTime(this.date.getTime()  +  ((6 - wday) * this.DAY) );
		
		for(i=1;i<trs.length;i++){//clear out old data
			var tds = $ES('td', trs[i]);
			for(j=1;j<tds.length;j++){
				var td = tds[j];
				td.empty();
				if(j == wday + 1){
					td.addClass('selectedDay');
				}else{
					td.removeClass('selectedDay');
				}
			}
		}
		var counterDate = new Date();
		counterDate.setTime(this.date.getTime());
		for(i=0;i<ths.length;i++){
			ths[i].innerHTML = this.options.shortDays[counterDate.getDay()] + ' ' + counterDate.getDate() + '/' + this.options.shortMonths[counterDate.getMonth()] ;
			
			//check events
			this.entries.each(function(entry){
				if(entry.date.equalsTo(counterDate)){
					
					var hour = entry.date.getHours();
					var td = $ES('td', trs[hour+1])[i+1]
					var bg = (entry.colour != '') ? entry.colour : this.options.colors.entryColor;
					td.adopt(new Element('div', {
						'styles':{
							'background-color':bg
						}
					}).adopt(
					new Element('a', {
						'href':entry.link
					}).appendText(entry.label)
					))
				}
			}.bind(this))	
			counterDate.setTime(counterDate.getTime() + this.DAY);			
		}
		$('monthDisplay').innerHTML = (firstDate.getDate()) + "  " + this.options.months[firstDate.getMonth()] + " " + firstDate.getFullYear();
		$('monthDisplay').innerHTML += " - " +(  lastDate.getDate()) + "  " + this.options.months[lastDate.getMonth()] + " " + lastDate.getFullYear();		
	},
	
	showDay: function(){
		var trs = $ES('#dayView tr', this.el);
		//put date in top row
		trs[0].childNodes[1].innerHTML = this.options.days[this.date.getDay()];
			
		for(i=1;i<trs.length;i++){//clear out old data
			var td = $ES('td', trs[i])[1];
			td.empty();
		}
	
		//check events
		this.entries.each(function(entry){
			if(entry.date.equalsTo(this.date)){
				var hour = entry.date.getHours();
				var td = $ES('td', trs[hour+1])[1]
				var bg = (entry.colour != '') ? entry.colour : this.options.colors.entryColor;
				td.adopt(new Element('div', {
					'styles':{
						'background-color':bg
					}
				}).adopt(
				new Element('a', {
					'href':entry.link
				}).appendText(entry.label)
				))
			}
		}.bind(this))		
		$('monthDisplay').innerHTML = (this.date.getDate()) + "  " + this.options.months[this.date.getMonth()] + " " + this.date.getFullYear();
	},
	
	renderMonthView: function(){
		this.date.setDate(1);
		var firstDate = new Date();
		firstDate.setTime(this.date.valueOf());
		if(firstDate.getDay() !== 0){
			var firstDayDay =  firstDate.getDay();
			firstDate.setMonth(firstDate.getMonth() - 1);
			firstDate.setDate(  firstDate.getMonthDays() - firstDayDay + 1);
		}
		
		this.options.viewType = 'monthView';
		if(!this.mothView){
			tbody = new Element('tbody', {'id':'viewContainerTBody'});
			var tr = new Element('tr');
			for(d=0;d<7;d++){
				tr.adopt( new Element('th', {'class':'dayHeading',
				'styles':{
				'width':'80px','height':'20px','text-align':'center',	'color':this.options.colors.headingColor,'background-color':this.options.colors.headingBg
				}
				}).appendText(this.options.days[d]) );
			}
			tbody.appendChild(tr);
			
			var highLightColor = this.options.colors.highlight;
			var bgColor = this.options.colors.bg;
			var todayColor = this.options.colors.today;
			for(var i=0;i<5;i++){
				var tr = new Element('tr');
				var parent = this;
				for(d=0;d<7;d++){
					//'display': 'table-cell', doesnt work in IE7
					var bgCol = this.options.colors.bg
					var extraClass ='';
					tr.adopt( new Element('td', {'class':'day ' + firstDate.getTime() + extraClass,
					'styles':{
						'width':'90px',
						'height':'80px',
						'background-color':bgCol,
						'vertical-align':'top',
						'padding':0,
						'border':'1px solid #cccccc'
					},
					
					'events':{
						'mouseenter':function(){
							this.setStyles({'background-color':highLightColor})
						},
						'mouseleave':function(){
							var myEffects = this.effects({duration: 500, transition: Fx.Transitions.Sine.easeInOut});
							var toCol = (this.hasClass('today')) ? todayColor : bgColor;
							myEffects.start({'background-color': [highLightColor, toCol]});
						},
						'click':function(e){
							parent.date.setTime(this.className.split(" ")[1]);
							parent.el.getElements('td').each(function(td){
								td.removeClass('selectedDay');
								if(td != this){
									td.setStyles({'background-color':'#F7F7F7'})
								}
							}.bind(this));
							this.addClass('selectedDay');
						},
						'dblclick':function(e){
							e = new Event(e);
							var rawd = (e.target.className.replace("day", "").replace("selectedDay", "").replace("otherMonth", "").trim());
							var thisDay = new Date();
							thisDay.setTime(rawd);
							var m = thisDay.getMonth()+1;
							
							m = (m < 10 )? "0" + m : m;
							var day = thisDay.getDate();
							day = (day <  10 )? "0" + day : day;
							d = thisDay.getFullYear() + "-" + m + "-" + day;
							document.mochaDesktop.newWindow({
								id: 'adeventx-' + rawd,
								title: 'Add event',
								contentType: 'xhr',
								loadMethod:'xhr',
								contentURL: 'http://localhost/fabrik2.0.x/index.php?option=com_fabrik&tmpl=component&view=visualization&Itemid=12&plugintask=chooseaddevent&id=' + this.options.calendarId + '&d=' + d + '&rawd=' + rawd,
								width: 320,
								height: 320,
								evalScripts:true,
								x: 20,
								y: 60
							});
							
						}.bind(this)
					}
					}));
					firstDate.setTime(firstDate.getTime() + this.DAY);
				}
				tbody.appendChild(tr);
			}
			this.mothView = new Element('table', {'id':'monthView',
			'styles':{'border-collapse':'collapse'}
			}).adopt(
				tbody
			);
			$('viewContainer').appendChild(this.mothView);
		}
		this.showView('monthView');
	},
	
	_highLightToday: function(){
		var today = new Date();
		$ES('td', 'viewContainerTBody').each(
			function(td){
				var newDate = new Date(td.className.replace("day ", "").replace(" otherMonth", "").toInt());
				if(today.equalsTo(newDate)){
					 td.addClass('today');
					 td.setStyle('background-color',this.options.colors.today);
				}else{
					td.removeClass('today');
				}
			}.bind(this)
		)
	},

	renderDayView: function(){
		this.options.viewType = 'dayView';
		if(!this.dayView){
			tbody = new Element('tbody');
			var tr = new Element('tr');
			for(d=0;d<2;d++){
				if(d == 0){
					tr.adopt( new Element('td', {'class':'day'}));
				}else{
					tr.adopt( new Element('th', {'class':'dayHeading',
					'styles':{
					'width':'80px','height':'20px','text-align':'center',	'color':this.options.headingColor,'background-color':this.options.colors.headingBg
					}
					}).appendText(this.options.days[this.date.getDay()]) );	
				}
			}
			tbody.appendChild(tr);
			
			for(var i=0;i<24;i++){
				var tr = new Element('tr');
				for(d=0;d<2;d++){
					if(d == 0){
						var hour = (i.length == 1)? i + '0:00' : i + ':00';
						tr.adopt( new Element('td', {'class':'day'}).appendText(hour));
					}else{
						//'display': 'table-cell',
						tr.adopt( new Element('td', {'class':'day',
						'styles':{
						'width':'100%',
						'height':'10px',
						'background-color':'#F7F7F7',
						'vertical-align':'top',
						'padding':0,
						'border':'1px solid #cccccc'
						},
						'events':{
							'mouseenter':function(e){
								this.setStyles({
									'background-color':'#FFFFDF'	
								})
							},
							'mouseleave':function(e){
								this.setStyles({
									'background-color':'#F7F7F7'	
								})
							}	
						}
						}));
					}
				}
				tbody.appendChild(tr);
			}
			this.dayView = new Element('table', {'id':'dayView',
			'styles':{'border-collapse':'collapse'}
			}).adopt(
				tbody
			);
			$('viewContainer').appendChild(this.dayView);	
		}
		this.showDay();
		this.showView('dayView');	
	},
	
	showView: function (view){
		if($('dayView')){$('dayView').style.display = 'none';}
		if($('weekView')){$('weekView').style.display = 'none';}
		if($('monthView')){$('monthView').style.display = 'none';}
		$(view).style.display = 'block';
		
	},
	
	renderWeekView: function(){
		this.options.viewType = 'weekView';
		if(!this.weekView){
			
			tbody = new Element('tbody');
			var tr = new Element('tr');
			for(d=0;d<8;d++){
				if(d == 0){
					tr.adopt( new Element('td', {'class':'day'}));
				}else{
					tr.adopt( new Element('th', {'class':'dayHeading',
					'styles':{
					'width':'80px','height':'20px','text-align':'center',	'color':this.options.headingColor,'background-color':this.options.colors.headingBg
					}
					}).appendText(this.options.days[d-1]) );	
				}
			}
			tbody.appendChild(tr);
			
			for(var i=0;i<24;i++){
				var tr = new Element('tr');
				for(d=0;d<8;d++){
					if(d == 0){
						var hour = (i.length == 1)? i + '0:00' : i + ':00';
						tr.adopt( new Element('td', {'class':'day'}).appendText(hour));
					}else{
						//'display': 'table-cell',
						tr.adopt( new Element('td', {'class':'day',
						'styles':{
						'width':'90px',
						'height':'10px',
						'background-color':'#F7F7F7',
						
						'vertical-align':'top',
						'padding':0,
						'border':'1px solid #cccccc'
						},
						'events':{
							'mouseenter':function(e){
								this.setStyles({
									'background-color':'#FFFFDF'	
								})
							},
							'mouseleave':function(e){
								if(!this.hasClass('selectedDay')){
									this.setStyles({
										'background-color':'#F7F7F7'	
									})
								}
							}	
						}
						}));
					}
				}
				tbody.appendChild(tr);
			}
			this.weekView = new Element('table', {'id':'weekView',
			'styles':{'border-collapse':'collapse'}
			}).adopt(
				tbody
			);
			$('viewContainer').appendChild(this.weekView);
		}
		this.showWeek();
		this.showView('weekView');
	},
	
	render: function(){
		
				
		this.options = Object.extend({
			days:  ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
			shortDays: ['Sun', 'Mon', 'Tues', 'Wed', 'Thur', 'Fri', 'Sat'],
			months: ['Januaray', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
			shortMonths: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
			viewType: 'month',
			calendarId: 1,
			tmpl:'default',
			colors:{'bg':'#F7F7F7','highlight':'#FFFFDF','headingBg':'#C3D9FF',
			'today':'#dddddd','headingColor':'#135CAE','entryColor':'#eeffff'}
		}, arguments[1] || {});
		
		this.aText = Object.extend({
			next:  'Next',
			previous: 'Previous',
			day:'day',
			week:'Week',
			month:'Month',
			'key':'Key'
		}, arguments[2] || {});	
		
		var nav = new Element('div', {'class':'calendarNav', 'id':'calendarNav'}).adopt(  
		new Element('input', {
			'id':'previousPage',
			'type':'button',
			'value':this.aText.previous
		}),
		new Element('input', {
			'id':'nextPage',
			'type':'button',
			'value':this.aText.next
		}),
		new Element('div', {
			'id':'monthDisplay'
		}),
		new Element('ul', {'class':'viewMode'}).adopt(
				new Element('li', {'id':'dayViewLink'}).appendText(this.aText.day),
				new Element('li', {'id':'weekViewLink'}).appendText(this.aText.week),
				new Element('li', {'id':'monthViewLink'}).appendText(this.aText.month)
			)
		);
		
		this.el.appendChild(nav);
		//this.el.appendChild(new Element('div', {'id':'viewContainer', styles:{'position':'relative','background-color':'#EFEFEF','padding':'5px'}}));
		//position relative messes up the drag of events
		this.el.appendChild(new Element('div', {'id':'viewContainer', styles:{'background-color':'#EFEFEF','padding':'5px'}}));
		this.renderMonthView();
	
		$('nextPage').addEvent('click',  this.nextPage.bindAsEventListener(this));
		$('previousPage').addEvent('click',  this.previousPage.bindAsEventListener(this));
		$('dayViewLink').addEvent('click', this.renderDayView.bindAsEventListener(this));
		$('weekViewLink').addEvent('click', this.renderWeekView.bindAsEventListener(this));
		$('monthViewLink').addEvent('click', this.renderMonthView.bindAsEventListener(this));
		
		this.showMonth();
	},
	
	addEntry: function(o){
		//test if time was passed as well
		if(o.date){
			var d = o.date.split(' ');
			d = d[0];
			if(d.trim() == ""){
				return;
			}
			var d = d.split('-');
			var d2 = new Date();
			var y = (d[0]).toInt();
			var m = (d[1]).toInt()-1;
			var day = (d[2]).toInt();
			d2.setFullYear(y, m, day);
			o.date = d2;
			this.entries.push(o);
		}
		
	},
	
	deleteEntry: function(e){
		e = new Event(e);
		var div = e.target.getParent();
		var i = div.id.replace('fabrikEvent_', '');
		div.remove();
		//load in the add event form
		var url = 'index.php?option=com_fabrik&format=raw&format=raw&task=ajax_deleteEvent&id='+i ;
		new Ajax(url, {}).request();
	},
	
	addEntries: function(a){
		a.each( function(o){
			this.addEntry(o);
		}.bind(this));
		this.showMonth();
	},
	
	removeEntry: function(eventId){
		this.entries.remove(this.entries[eventId]);
		this.showMonth();
	},
	
	nextPage: function(){
		switch(this.options.viewType){
			case 'dayView':
				this.date.setTime(this.date.getTime() + this.DAY);
				this.showDay();
				break;
			case 'weekView':
				this.date.setTime(this.date.getTime() + this.WEEK);
				this.showWeek();
				break;
			break;
			case 'monthView':
				this.date.setMonth(this.date.getMonth() + 1);
				this.showMonth();
				break;
		}
	},
	
	previousPage: function(){
		switch(this.options.viewType){
			case 'dayView':
				this.date.setTime(this.date.getTime() - this.DAY);
				this.showDay();
				break;
			case 'weekView':
				this.date.setTime(this.date.getTime() - this.WEEK);
				this.showWeek();
				break;
			break;
			case 'monthView':
				this.date.setMonth(this.date.getMonth() - 1);
				this.showMonth();
				break;
		}
	},
	
	addLegend: function(a){
		var ul = new Element('ul');
		a.each(function(l){
			var li = new Element('li');
			li.adopt( new Element('div', {'styles':
			{'background-color':l.colour}}),
			new Element('span').appendText(l.label)
			);
			ul.appendChild(li);
		}.bind(this));
		new Element('div', {'id':'legend'}).adopt([
		new Element('h3').appendText(this.aText.key),
		ul
		]).injectAfter(	this.el  );
	}
});

// BEGIN: DATE OBJECT PATCHES

/** Adds the number of days array to the Date object. */
Date._MD = new Array(31,28,31,30,31,30,31,31,30,31,30,31);

/** Constants used for time computations */
Date.SECOND = 1000 /* milliseconds */;
Date.MINUTE = 60 * Date.SECOND;
Date.HOUR   = 60 * Date.MINUTE;
Date.DAY    = 24 * Date.HOUR;
Date.WEEK   =  7 * Date.DAY;

/** Returns the number of days in the current month */
Date.prototype.getMonthDays = function(month) {
	var year = this.getFullYear();
	if (typeof month == "undefined") {
		month = this.getMonth();
	}
	if (((0 == (year%4)) && ( (0 != (year%100)) || (0 == (year%400)))) && month == 1) {
		return 29;
	} else {
		return Date._MD[month];
	}
};

/** Returns the number of the week.  The algorithm was "stolen" from PPK's
 * website, hope it's correct :) http://www.xs4all.nl/~ppk/js/week.html */
Date.prototype.getWeekNumber = function() {
	var now = new Date(this.getFullYear(), this.getMonth(), this.getDate(), 0, 0, 0);
	var then = new Date(this.getFullYear(), 0, 1, 0, 0, 0);
	var time = now - then;
	var day = then.getDay();
	(day > 3) && (day -= 4) || (day += 3);
	return Math.round(((time / Date.DAY) + day) / 7);
};

/** Checks dates equality (ignores time) */
Date.prototype.equalsTo = function(date) {
	return ((this.getFullYear() == date.getFullYear()) &&
		(this.getMonth() == date.getMonth()) &&
		(this.getDate() == date.getDate()));
};

/** Prints the date in a string according to the given format. */
Date.prototype.print = function (frm) {
	var str = new String(frm);
	var m = this.getMonth();
	var d = this.getDate();
	var y = this.getFullYear();
	var wn = this.getWeekNumber();
	var w = this.getDay();
	var s = new Array();
	s["d"] = d;
	s["dd"] = (d < 10) ? ("0" + d) : d;
	s["m"] = 1+m;
	s["mm"] = (m < 9) ? ("0" + (1+m)) : (1+m);
	s["y"] = y;
	s["yy"] = new String(y).substr(2, 2);
	s["w"] = wn;
	s["ww"] = (wn < 10) ? ("0" + wn) : wn;
	with (Calendar) {
		s["D"] = _DN3[w];
		s["DD"] = _DN[w];
		s["M"] = _MN3[m];
		s["MM"] = _MN[m];
	}
	var re = /(.*)(\W|^)(d|dd|m|mm|y|yy|MM|M|DD|D|w|ww)(\W|$)(.*)/;
	while (re.exec(str) != null) {
		str = RegExp.$1 + RegExp.$2 + s[RegExp.$3] + RegExp.$4 + RegExp.$5;
	}
	return str;
};

