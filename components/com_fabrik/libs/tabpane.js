/**
 * @author Robert
 */
tabPane = new Class( {
	initialize: function(element, options) {
		this.sElement = element;
		this.options = Object.extend({
      		headingList:'headings',
      		startTab: '',
			tabClass:'tab'
    	}, options);
		var hl = $(this.options.headingList);
		this.hlist = $A($ES('li', $(hl)));
		this.tabEvent = this.onTab.bindAsEventListener(this);
		this.hlist.each(function(h){
			h.addEvent( 'click', this.tabEvent );
    	}.bind(this));
		
		if(this.options.startTab != ''){
    		if($(this.options.startTab)){
				this.dotab($(this.options.startTab));	
			}
    	}
	}, 
	
	onTab: function (event){
		var e = new Event(event);
		this.doTab(e.target);
		e.stop();
	},
	
	doTab: function(l){
		//work out which tab was clicked 
		for(var i=0;i<this.hlist.length;i++){
			if(this.hlist[i].innerHTML == l.innerHTML){
				break;
			}
		}
		var c = l.id;
		this.hlist.each(function(h){
			h.removeClass('activeTab');
    	});
		l.addClass('activeTab');
		var tabs = $ES('.' + this.options.tabClass, $(this.element));
		for(var t=0;t<tabs.length;t++){
			if( t != i ){
				Element.setStyles(tabs[t], {display:'none'});
			}else{
				Element.setStyles(tabs[t], {display:'block'});
			}
		}
	}
});