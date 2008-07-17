/**
 * @author Robert
 */
var fbAjaxUpdater = Class.create();
	fbAjaxUpdater.prototype = Object.extend(new fbElement(), {
		initialize: function(element, options) {
			this.setOptions(element, options);
			$(element).addEvent( 'change', function(e){
				var id = $F(Event.element(e));
				new Ajax.Request( 'index2.php', {
				parameters :{
					'option':'com_fabrik',
					'format':'raw',
					'task':'elementPluginAjax',
					'plugin':'fabrikAjaxUpdater',
					'method':'do_ajax',
					'id':id,
					'element_id':this.elementId,
					onSuccess: function(res) {
					    fconsole(res);
					  }
				}
			});			
		}.bind(this));
	},
	setElementId: function(i){
		this.elementId = i;
	},
	setCode: function(c){
		this.code = c;
	}
});

fbAjaxUpdater = Class.create();
	fbAjaxUpdater.prototype = Object.extend(new fbElement(), {
		initialize: function(element, options) {
			this.setOptions(element, options);
			$(element).addEvent( 'change', function(e){
				var id = $F(Event.element(e));
				new Ajax.Request( 'index2.php', {
				parameters :{
					'option':'com_fabrik',
					'format':'raw',
					'task':'elementPluginAjax',
					'plugin':'fabrikAjaxUpdater',
					'method':'do_ajax',
					'id':id,
					'element_id':this.elementId,
					onSuccess: function(transport){
					}
				}
			});			
		}.bind(this));
	},
	setElementId: function(i){
		this.elementId = i;
	}
});