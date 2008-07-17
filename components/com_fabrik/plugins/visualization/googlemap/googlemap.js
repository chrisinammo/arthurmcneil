var fbGoogleTableMap = new Class({
	initialize: function(element, options) {
		
		this.element_map = element;
		this.element = $(element);
		this.options = Object.extend({
			'lat':0,
			'lon':0,
			'zoomlevel':'13',
			'control':'',
			'maptypecontrol':'0',
			'overviewcontrol':'0',
			'scalecontrol':'0'
		}, options || {});
		
		window.addEvent('domready', function(){
			if (GBrowserIsCompatible()) {
				this.map = new GMap2($(this.element_map));
				this.map.setCenter(new GLatLng(this.options.lat, this.options.lon), this.options.zoomlevel.toInt());
				switch(this.options.control){
					case 'GLargeMapControl':
						this.map.addControl(new GLargeMapControl());
						break;
					case 'GSmallMapControl':
						this.map.addControl(new GSmallMapControl());
						break;
					case 'GSmallZoomControl':
						this.map.addControl(new GSmallZoomControl());
						break;
				}
				if(this.options.scalecontrol != '0'){
					this.map.addControl(new GScaleControl());
				}
				if(this.options.maptypecontrol != '0'){
					this.map.addControl(new GMapTypeControl());
				}
				if(this.options.overviewcontrol != '0'){
					this.map.addControl(new GOverviewMapControl());
				}
				 var bounds = new GLatLngBounds();
				this.options.icons.each(function(i){
					bounds.extend(new GLatLng(i[0], i[1]));
					this.addIcon(i[0], i[1], i[2]);
				}.bind(this));
				//set the map to center on the center of all the points
			  this.map.setCenter(bounds.getCenter());
			}
		}.bind(this))
	},
	
	addIcon: function(lat, lon, html){
		var point = new GLatLng(lat, lon);
		var marker = new GMarker(point);
		GEvent.addListener(marker, "click", function() {
  			marker.openInfoWindowHtml(html);
  		}.bind(this));
		this.map.addOverlay(marker);
	}

});