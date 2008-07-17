/**
 * @author Robert
 */
var fbAjaxUpdater = Class.create();
		fbAjaxUpdater.prototype = Object.extend(new fbElement(), {
			initialize: function(element, options) {
				this.setOptions(element, options);
this.target = element + '_child';

this.cid = 1;
$(element).addEvent( 'change', function(e){
var id = $F(Event.element(e));

new Ajax.Updater(this.target, 'index.php', {
						parameters :{
							'option':'com_fabrik',
							'format':'raw',
							'task':'elementPluginAjax',
							'plugin':'fabrikAjaxUpdater',
							'method':'ajax_loadChildFields',
							'cid':this.cid,
							'table':this.table,
							'connector':this.connector,
							'id':id,
							'label':this.label,
							'value':this.value
						}
					});			

	}.bind(this));
			},
	setConnector: function(c){
	this.connector = c;
	},
	
	setLabel: function(c){
	this.label = c;
	},
	
	setValue: function(c){
	this.value = c;
	},
	
	setTable: function(c){
	this.table = c;
	}
});