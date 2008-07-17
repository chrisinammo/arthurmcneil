var fabrikPackage = new Class({
	
	initialize: function(){
		
		this.options = Object.extend({
			'overlayOpactiy':0.7,
			'opactiyFXDuration':1200,
			liveSite 	:'',
			'tmpl':'components/com_fabrik/views/package/tmpl/default/images/'
		}, arguments[0] || {});
		
		this.blocks = new Hash();
		window.addEvent('domready', function(){
			if($('fbPackageStatus')){
				this.loadingFx = new Fx.Style($('fbPackageStatus'), 'opacity', {duration:500, wait:false});		
				this.loadingFx.set(0);
			}
		}.bind(this))
	},
	
	//@TODO: replace with mocha windows 
	
	findAndWatchSubmit: function(winId){
		//get all submit buttons which will also close the win
		$(winId).getElements('input[id^=fabrikSubmit]').addEvent('click', function(e){
			//this.hideWindow(winId);
		}.bind(this))
	},

	startLoading: function(senderBlock, msg){
		msg = $pick(msg, 'loading');
		if($('fbPackageStatus')){
			$('fbPackageStatus').getElement('span').setText(msg);
			$('fbPackageStatus').show();
			$('fbPackageStatus').effect('opacity', {'duration':500}).start(0, 1);
		}else{
			if($(senderBlock)){
				var i = new Element('img', {'src':this.options.liveSite + this.options.tmpl + 'ajax-loader.gif'});
				var s = new Element('span').appendText(msg);
				new Element('div', {'id':'fbPackageStatus'}).adopt(i).adopt(s).injectInside($(senderBlock));
			}
		}
	},
	
	stopLoading: function(){
		if($('fbPackageStatus')){
			$('fbPackageStatus').effect('opacity', {'duration':500}).start(1, 0);
			$('fbPackageStatus').hide();
		}
	},

	addBlock: function( blockid, block ){
		this.blocks.set(blockid, block);
	},
	
	removeBlock: function( blockid ){
		//attempt to remove block? from memory
		this.blocks.set(blockid, null);
		this.blocks.remove( blockid );
	},
	
	//bind a block object to listen to another block objects messages
	
	bindListener: function( fromId, toId ){
		this.blocks.each(function(val, key){
			if( toId == key ){
				val.addListenTo(fromId);
			}
		});	
	},
	
	//broadcast messages to all blocks
	
	sendMessage: function( senderBlock, task, taskStatus, json ){
		if(json != ''){
			json = eval("(" + json +")");
		}
		this.blocks.each(function(block, key){
			block.receiveMessage( senderBlock, task, taskStatus, json );
		});
		this.stopLoading();
	},
	
	submitfabrikTable: function(tableid, task){
		this.blocks.each(function(block, key){
			if(key == 'table_' +  tableid){
				block.submitfabrikTable(task);
			}
		});
	},
	
	fabrikNavOrder: function(tableid, orderby, orderdir){
		this.blocks.each(function(block, key){
			if(key == 'table_' +  tableid){
				block.fabrikNavOrder(orderby, orderdir);
			}
		});
	}
});