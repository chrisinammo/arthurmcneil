/**
 * @author Robert
 */
var fabrikForm = new Class({

  initialize: function(id){
    this.id = id;
    
    this.options = Object.extend({
      'admin': false,
      'postMethod': 'post',
      'primaryKey': null,
      'error': '',
      'delayedEvents': false,
			'updatedMsg': 'Form saved',
			'liveSite':'',
			'pages':[],
			'page_save_groups':[],
			'start_page':0
    }, arguments[1] ||
    {});
		this.currentPage = this.options.start_page;
    this.formElements = $H({});
    this.delGroupJS = $H({});
    this.duplicateGroupJS = $H({});
    
    this.listenTo = $A();
    this.bufferedEvents = $A();
    this.duplicatedGroups = {};
    
    this.clickDeleteGroup = this.deleteGroup.bindAsEventListener(this);
    this.clickDuplicateGroup = this.duplicateGroup.bindAsEventListener(this);
    
    this.setUp();
  },
  
  setUp: function(){
    this.form = $('form_' + this.id);
    this.watchGroupButtons();
    this.watchSubmit();
		this.createPages();
  },
	
	createPages: function()
	{
		if(this.options.pages.length > 1){
			$('fabrikSubmit' + this.id).disabled="disabled";
			this.form.getElement('.fabrikPagePrevious').disabled="disabled";
			var url = this.options.liveSite + 'index.php?option=com_fabrik&format=raw&task=ajax_validate&form_id='+this.id;
			
			this.form.getElement('.fabrikPageNext').addEvent('click', function(e){
				oPackage.startLoading('form_' + this.id, 'validating');
				var d = this.getPageElements();			
				var myAjax = new Ajax(url, { method:'post', 
					data:d.obj,
					onComplete: function(r){
						oPackage.stopLoading();
						r = eval( "(" + r + ")" );
						if (!this._showGroupError(r, d)) {
							this.changePage(1);
							this.saveGroupsToDb();
						}
					}.bind(this)
				}).request();
				new Event(e).stop();
			 }.bind(this))
			 this.form.getElement('.fabrikPagePrevious').addEvent('click', function(e){
				oPackage.startLoading('form_' + this.id, 'validating');
				var d = this.getPageElements();			
				var myAjax = new Ajax(url, { method:'post', 
					data:d.obj,
					onComplete: function(r){
						oPackage.stopLoading();
						r = eval( "(" + r + ")" );
						if (!this._showGroupError(r, d)) {
							this.changePage(-1);
							this.saveGroupsToDb();
						}
					}.bind(this)
				}).request();
				new Event(e).stop();
					
			 }.bind(this))
			 this.setPageButtons();
		}
	},
	
	getPageElements: function()
	{
		var d = new Hash();
		//get elements to validate
		this.options.pages[this.currentPage].each(function(id){
			var g = ($('group'+id));
			this.formElements.each(function(el, k){
				if(g.getElement('#'+k)){
					var element = g.getElement('#'+k);
					d.set(k, element.getValue());
				}
			}.bind(this))
		}.bind(this))
		return d;
	},
	
	saveGroupsToDb: function()
	{
		var orig = this.form.getElement('input[name=format]').value;
		var origprocess = this.form.getElement('input[name=task]').value;
		this.form.getElement('input[name=format]').value = 'raw';
		this.form.getElement('input[name=task]').value = 'savepage';
		
		var url = this.options.liveSite + 'index.php?option=com_fabrik&format=raw&page=' + this.currentPage;
		oPackage.startLoading('form_' + this.id, 'saving page');
		new Ajax(url, { method:'post', 
			data: this.form.toQueryString(),
			onComplete: function(r){
				this.form.getElement('input[name=format]').value = orig;
				this.form.getElement('input[name=task]').value = origprocess;
				if (this.options.postMethod == 'ajax') {
					oPackage.sendMessage('form_' + this.id, 'updateRows', 'ok', json);
				}
				oPackage.stopLoading();
			}.bind(this)
		}).request();
	},
	
	changePage: function(dir){
		fconsole(this.currentPage);
		if(this.currentPage + dir >= 0 && this.currentPage + dir < this.options.pages.length){
			this.currentPage += dir;
		}
		this.setPageButtons();
		this.options.pages.each(function(gids){
			gids.each(function(id){
				$('group'+id).hide();
			})
		})
		this.options.pages[this.currentPage].each(function(id){
			$('group'+id).show('inline');
		})
	},
  
	setPageButtons: function()
	{
		if(this.currentPage == this.options.pages.length -1){
			 $('fabrikSubmit' + this.id).disabled="";
			 this.form.getElement('.fabrikPageNext').disabled="disabled";
		}else{
			//$('fabrikSubmit' + this.id).disabled="disabled";
			this.form.getElement('.fabrikPageNext').disabled="";
		}
		if(this.currentPage == 0){
			this.form.getElement('.fabrikPagePrevious').disabled="disabled";
		}else{
			this.form.getElement('.fabrikPagePrevious').disabled="";
		}
	},
	
	addElements: function(a){
		for(var i=0;i<a.length;i++){
			this.addElement(a[i], a[i].element.id);
		}	
	},
		
	addElement: function(oEl, elId){
		elId = elId.replace('[]', '');
		this.formElements.set(elId, oEl);
	},
	  
	// we have to buffer the events in a pop up window as 
	//the dom inserted when the window loads appears after the ajax evalscripts  
	
	dispatchEvent: function(elementType, elementId, action, js){
		if (!this.options.delayedEvents) {
			var el = this.formElements.get(elementId);
			if (el) {
				el.addNewEvent(action, js);
			}
		}
		else {
			this.bufferEvent(elementType, elementId, action, js);
		}
	},
	
	bufferEvent: function(elementType, elementId, action, js){
	  this.bufferedEvents.push([elementType, elementId, action, js]);
	},
  
	//call this after the popup window has loaded
	processBufferEvents: function(){
		this.setUp();
		this.options.delayedEvents = false;
		this.bufferedEvents.each(function(r){
			//refresh the element ref
			var elementId = r[1];
			var el = this.formElements.get(elementId);
			el.element = $(elementId);
			this.dispatchEvent(r[0], elementId, r[2], r[3]);
		}.bind(this));
	},
  
	action: function(task, element){
		var oEl = this.formElements.find(function(oEl){
			return (oEl.element.id == element);
		})
		eval('oEl.' + task + '()');
	},
  
	watchValidation: function(elName, id){
		$(id).addEvent('blur', function(event){
			var e = new Event(event);
			var element = $(e.target);
			var elEr = $(id+'_error');
			
			var img = new Element('img', {'src':this.options.liveSite + '/components/com_fabrik/views/package/tmpl/default/images/ajax-loader.gif', alt:'loading...'});
			img.injectTop(elEr);
			var d = new Hash();
			d.set(element.id, element.getValue());
			var url = this.options.liveSite + 'index.php?option=com_fabrik&format=raw&task=ajax_validate&element_name='+elName+'&form_id='+this.id;
			var myAjax = new Ajax(url, { method:'post', 
				data:d.obj,
				onComplete: function(r){
					r = eval( "(" + r + ")" );
					this._showElementError(r, id);
			}.bind(this)}).request();
		}.bind(this));
	},
	
	_showGroupError: function(r, d){
		var shown = false;
		d.each(function(v, k){
			if(r[k]){
				this._showElementError(r[k], k);
				shown = true;
			}
		}.bind(this));
		return shown;
	},
	
	_showElementError: function(r, id)
	{
		var elEr = $(id+'_error');
		var msg = '';
		for(var i=0;i<r.length;i++){
			for(var j=0;j<r[i].length;j++){
				msg += r[i][j] + '<br />';
			}
		}
		$(id+'_error').setHTML(msg);
		if(msg != ''){
			elEr.setStyle('opacity', 0);
			elEr.removeClass('fabrikHide');
			this.showMainError();
			new Fx.Style(elEr, 'opacity', {duration:500, onComplete:function(e){
					
		 }.bind(this)}).start(0,1);
		}else{
			new Fx.Style(elEr, 'opacity', {duration:500, onComplete:function(e){
				elEr.addClass('fabrikHide');
				this.showMainError();
		 }.bind(this)}).start(1, 0);
		}
	},
	
	showMainError: function(){
		var mainEr = this.form.getElement('.fabrikMainError');
		mainEr.setHTML(this.options.error);
		var activeValidations = this.form.getElements('.fabrikError').filter(function(e, index){
			 return !e.hasClass('fabrikHide') && !e.hasClass('fabrikMainError');
		});
		if(activeValidations.length > 0 && mainEr.hasClass('fabrikHide')){
			mainEr.removeClass('fabrikHide');
			new Fx.Style(mainEr, 'opacity', {duration:500}).start(0, 1);
		}
		if(activeValidations.length == 0 ){
			new Fx.Style(mainEr, 'opacity', {duration:500, onComplete:function(){
				mainEr.addClass('fabrikHide');
			}}).start(1, 0);
		}
	},
	
	watchSubmit: function(){
		if(!$('fabrikSubmit' + this.id)){
			return;
		}
		(this.form).addEvent('submit', function(e){
			e = new Event(e);
			this.formElements.each(function(el, key){
				if(!el.onsubmit()){
					e.stop();
				}
			});
		}.bind(this))
	  
		if (this.options.postMethod == 'ajax') {
			if (this.form) {
				this.form.reset();
				$('fabrikSubmit' + this.id).removeEvents('click');
				$('fabrikSubmit' + this.id).addEvent('click', function(){
					oPackage.startLoading('form_' + this.id);
					this.form.send({
						onComplete: function(json){
							oPackage.sendMessage('form_' + this.id, 'updateRows', 'ok', json);
							//this.clearForm();
						}.bind(this)
					});
				}.bind(this));
			}
		}
	},
  
	watchGroupButtons: function(){
		this.unwatchGroupButtons();
		$$('.deleteGroup').each(function(g, i){
			g.addEvent('click', this.clickDeleteGroup);
		}.bind(this));
		$$('.addGroup').each(function(g, i){
			g.addEvent('click', this.clickDuplicateGroup);
		}.bind(this));
		$$('.fabrikSubGroup').each(function(subGroup){
			subGroup.addEvent('mouseenter', function(e){
				subGroup.getElement('.fabrikGroupRepeater').effect('opacity', {
					wait: false,
					duration: 500
				}).start(0.3, 1);
			});
			subGroup.addEvent('mouseleave', function(e){
				subGroup.getElement('.fabrikGroupRepeater').effect('opacity', {
					wait: false,
					duration: 500
				}).start(1, 0.3);
			});
		});
	},
  
	unwatchGroupButtons: function(){
		$$('.deleteGroup').each(function(g, i){
			g.removeEvent('click', this.clickDeleteGroup);
		}.bind(this));
		$$('.addGroup').each(function(g, i){
			g.removeEvent('click', this.clickDuplicateGroup);
		}.bind(this));
		$$('.fabrikSubGroup').each(function(subGroup){
			subGroup.removeEvents('mouseenter');
			subGroup.removeEvents('mouseleave');
		});
	},
  
	addGroupJS: function(groupId, e, js){
		if (e == 'delete') {
			this.delGroupJS.set(groupId, js);
		}
		else {
			this.duplicateGroupJS.set(groupId, js);
		}
	},
  
	deleteGroup: function(event){
		var e = new Event(event);
		var b = $(e.target).findUp('a');
		var i = b.id.replace('delGroup_', '');
		var subgroups = $$('#group' + i + ' .fabrikSubGroup');
		if (subgroups.length > 1) {
			var subGroup = $(e.target).findUp('div').getPrevious().getParent();
			var js = this.delGroupJS.get(i);
			var myFx = new Fx.Style(subGroup, 'opacity', {
				duration: 300,
				onComplete: function(){
					if (subgroups.length != 0) {
						subGroup.remove();
					}
					eval(js);
				}
			});
			myFx.start(1, 0);
		}
		e.stop();
	},
  
	/* duplicates the groups sub group and places it at the end of the group */
	
	duplicateGroup: function(e){
		new Event(e).stop();
		var b = $(e.target).findUp('a');
		var i = b.id.replace('addGroup_', '');
		var js = this.duplicateGroupJS.get(i);
		var group = $('group' + i);
		var subgroups = $$('#group' + i + ' .fabrikSubGroup');
		var c = subgroups.length;
		if (group.style.display == 'none') {
			group.style.display = 'block';
		}
		else {
			var subgroup = $('subgroup' + i + '_0');
			var clone = null;
			var found = false;
			for (var j in this.duplicatedGroups) {
				if (j == i) {
					found = true;
				}
			}
			if (!found) {
				this.duplicatedGroups[i] = clone;
				clone = subgroup.cloneNode(true);
			}
			else {
				if (!subgroup) {
					clone = this.duplicatedGroups[i];
				}
				else {
					clone = subgroup.cloneNode(true);
				}
			}
			
			group.appendChild(clone);
			clone.id = 'subgroup' + i + '_' + c;
			var children = $(clone.id).getElements('.fabrikinput')
			
			//remove values and increment ids
			children.each(function(cNode){
				if (cNode.nodeType == 1 && cNode.id != '') {
					var oldId = cNode.id;
					var found = false;
					this.formElements.each(function(e){
						if (e.element && e.element.id == oldId) {
							cNode.value = e.options.defaultVal;
							found = true;
						}
					});
					if (!found) {
						cNode.value = '';
					}
					
					if (cNode.id.indexOf('[]') != -1) {
						cNode.id = cNode.id.replace('[]', '') + c + '[]';
					}
					else {
						cNode.id = cNode.id + c;
					}
					if (cNode.name) {
						r = eval('/\[' + '0' + ']/');
						cNode.name = cNode.name.replace(r, '1');
					}
				}
			}.bind(this));
			c = c + 1;
			var myFx = new Fx.Style(clone, 'opacity', {
			  duration: 500
			}).set(0);
			myFx.start(1);
		}
		eval(js);
		this.unwatchGroupButtons();
		this.watchGroupButtons();
	},
  
	update: function(o){
		if (o.id == this.id && o.model == 'form') {
			var data = o.data;
			this.form.getElement('input[name=rowid]').value = data.rowid;
			this.formElements.each(function(el, key){
				if (data[key]) {
					var v = (eval("data." + key));
					el.update(v);
				}
			}.bind(this))
		}else{
			//not sure this is a good idea - testing resetting of submitted form module
			this.formElements.each(function(el, key){
				el.reset();
			}.bind(this))
		}
	},
	
	showErrors: function(data){
		if (data.id == this.id) {
			//show errors
			var errors = new Hash(data.errors);
			if (errors.length > 0) {
				this.form.getElement('.fabrikMainError').setHTML(this.options.error);
				this.form.getElement('.fabrikMainError').removeClass('fabrikHide');
				errors.each(
					function(a, key){
						if ($(key + '_error')) {
							var e = $(key + '_error');
							e.removeClass('fabrikHide');
							var msg = new Element('span');
							for (var x = 0; x < a.length; x++) {
								for (var y = 0; y < a[x].length; y++) {
									new Element('div').appendText(a[x][y]).injectInside(e);
								}
							}
						}else{
							fconsole(key + '_error' + ' not found');
						}
					}
				)
			}
		}
	},
  
	/** add additional data to an element - e.g database join elements */
	appendInfo: function(data){
		this.formElements.each(function(el, key){
			if (el.appendInfo) {
				el.appendInfo(data);
			}
		}.bind(this));
	},
	
	addListenTo: function(blockId){
		this.listenTo.push(blockId);
	},
  
	clearForm: function(){
		this.formElements.each(function(el, key){
			if (key == this.options.primaryKey) {
			  this.form.getElement('input[name=rowid]').value = '';
			}
			el.update('');
		}.bind(this));
		//reset errors
		this.form.getElements('.fabrikError').empty();
		this.form.getElements('.fabrikError').addClass('fabrikHide');
	},
  
	receiveMessage: function(senderBlock, task, taskStatus, data){
		if (this.listenTo.indexOf(senderBlock) != -1) {
			if (task == 'processForm') {
		  
			}
			//a row from the table has been loaded
			if (task == 'update') {
				this.update(data);
			}
			if (task == 'clearForm') {
				this.clearForm();
			}
		}
		  
		if(senderBlock == 'form_' + this.id){
			var id = 'fabrik_update_msg_' + this.id;
			var d= new Element('div', {'id':id, 'class':'update_msg'}).appendText(this.options.updatedMsg);
			d.injectBefore(this.form);
			
			var myfx = new Fx.Style(id, 'opacity', {duration:500});
			myfx.set(0);
			myfx.start(0, 1).chain(function(){
				this.start(1, 0).chain(function(){
					$(id).remove();
				});
			})
		}

		//a form has been submitted which contains data that should be updated in this form
		// currently for updating database join drop downs, data is used just as a test to see if the dd needs 
		// updating. If found a new ajax call is made from within the dd to update itself
		// $$$ hugh - moved showErrors() so it only runs if data.errors has content
		if (task == 'updateRows') {
			if (!data.errors || data.errors.length == 0) {
				this.clearForm();
				this.appendInfo(data);
				this.update(data);
			}
			else {
				this.showErrors(data);
			}
		}
	}
});
