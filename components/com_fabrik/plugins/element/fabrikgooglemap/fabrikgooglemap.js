var fbGoogleMap = fbElement.extend({
	initialize: function(element, options) {
		this.element = $(element);
		this.element_map = element + "_map";
		this.options = Object.extend({
			'lat':0,
			'lon':0,
			'zoomlevel':'13',
			'control':'',
			'maptypecontrol':'0',
			'overviewcontrol':'0',
			'scalecontrol':'0',
			'drag':0
		}, options || {});
		
		this.setOptions(element, options);
		
		document.addEvent('domready', function(){
			if (GBrowserIsCompatible()) {
				this.map = new GMap2($(this.element_map));
				this.map.setCenter(new GLatLng(this.options.lat, this.options.lon), this.options.zoomlevel.toInt());
				var point = new GLatLng(this.options.lat, this.options.lon);
				var opts = {};
				if(this.options.drag == 1){
					opts.draggable = true;
				}else{
					opts.draggable = false;
				}
				this.marker = new GMarker(point, opts);
				GEvent.addListener(this.marker, "dragend", function() {
  					//this.marker.openInfoWindowHtml(this.marker.getLatLng());
					this.element.value = this.marker.getLatLng() + ":" + this.map.getZoom();
  				}.bind(this));
				GEvent.addListener(this.map, "zoomend", function(oldLevel, newLevel){
					this.element.value = this.marker.getLatLng() + ":" + this.map.getZoom();
				}.bind(this));
				this.map.addOverlay(this.marker);
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
			}	
		}.bind(this))
	}
});