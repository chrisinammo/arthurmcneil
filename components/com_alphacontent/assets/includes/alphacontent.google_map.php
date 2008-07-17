<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<script src="http://maps.google.com/maps?file=api&amp;v=2.x<?php if( $_GET['google_map_key'] != "" ) {  echo  '&amp;key=' . $_GET['google_map_key'];} ?>" type="text/javascript"></script>
<script type="text/javascript">

var map;
var marker = null;	

function initialize() {
  if (GBrowserIsCompatible()) {
     map = new GMap2(document.getElementById("map_canvas"));
     map.setCenter(new GLatLng(<?php echo $_GET['latitude']; ?>, <?php echo $_GET['longitude']; ?>),
                              <?php echo $_GET['zoom']; ?>);
     
     map.setMapType(G_NORMAL_MAP);	
      
     marker = new GMarker(new GLatLng(<?php echo $_GET['marker_lat']; ?>, <?php echo $_GET['marker_lon']; ?>));
     GEvent.addListener(marker,  "mouseover",  addMessag);
     map.addOverlay( marker );

	var mapTypeControl = new GMapTypeControl();
    var topRight = new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(5,5));
	
	if( (<?php echo $_GET['menu_map']; ?>) !=0) {
		map.addControl(mapTypeControl, topRight); 
	}
	if( (<?php echo $_GET['control_map']; ?>) !=0 ) {	
		map.addControl(new GSmallMapControl());
	}
  }
}
  
function addMessag() {
  marker.openInfoWindowHtml("<?php echo $_GET['messag']; ?>");
}

</script>
</head>  
<body onload="initialize()" onunload="GUnload()">
  <div id="map_canvas" style="width: <?php echo $_GET['map_width'];?>px; height: <?php echo $_GET['map_height']; ?>px;border: 1px solid black; float: rigth;" align="center"></div>
</body>
</html>