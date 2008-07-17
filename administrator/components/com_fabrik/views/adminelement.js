//this array contains all the javascript element plugin objects 
var pluginControllers = new Array();

var fabrikAdminElement = new Class({
	initialize:function(plugins){
		this.options = Object.extend({
		}, arguments[0] || {});
		this.translate = Object.extend({
		}, arguments[1] || {});

		this.watchPluginDd();
		this.setParentViz();
	},
	
	watchPluginDd: function(){
		$('detailsplugin').addEvent('change', function(e){
			var event = new Event(e);
			var sel = event.target;
			var opt = sel.getValue();
			$$('.elementSettings').each(function(tab){
				if(opt == tab.id.replace('page-', '')){
					tab.setStyles({display:'block'});
				}else{
					tab.setStyles({display:'none'}); 
				}
			});
		});
		if($('page-'+this.options.plugin)){
			$('page-'+this.options.plugin).setStyles({display:'block'});
		};
	},
	
	setParentViz: function(){
		if (this.options.parentid != 0) {
			myFX = new Fx.Style('elementFormTable', 'opacity', {
				duration: 500,
				wait: false
			});
			myFX.set(0);
			$('unlink').addEvent('click', function(e){
				var s = (this.checked) ? "" : "readonly";
				if (this.checked) {
					myFX.start(0, 1);
				}
				else {
					myFX.start(1, 0);
				}
			});
		}
		if($('swapToParent')){
			$('swapToParent').addEvent('click', function(e){
				e = new Event(e);
				var el = $(e.target);
				var f =$('adminForm');
				f.task.value = 'parentredirect';
				var to = el.className.replace('element_', '');;
				f.redirectto.value = to;
				f.submit();
			})
		}
	}
});

function setAllCheckBoxes(elName, val){
	var els = document.getElementsByName(elName);
	var c = els.length; 
	for(i = 0; i < c; i++) {
		els[i].checked = val;	
	}
}	

function setAllDropDowns(elName, selIndex){
	els = document.getElementsByName(elName);
	c = els.length; 
	for(i = 0; i < c; i++) {
		els[i].selectedIndex = selIndex;	
	}		
}		

function setAll(t, elName){
	els = document.getElementsByName(elName);
	c = els.length 
	for(i = 0; i < c; i++) {
		els[i].value = t;
	}		
}

function deleteSubElements(sTagId){
	var oNode = $(sTagId);
	oNode.parentNode.removeChild(oNode);
}
